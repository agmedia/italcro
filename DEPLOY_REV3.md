# Italcro Revizija 3.0 — deploy i redoslijed ažuriranja

Datum pripreme: 2026-08-28

Ovo je runbook za produkcijski deploy promjena Revizije 3.0, sigurnog QIQO synca i pripreme `NarudzbaSend` outboxa. Vanjsko slanje narudžbi i destruktivni FULL syncovi namjerno su ugašeni dok se ne ispune niže navedeni uvjeti.

## 0. Trenutno provjereno lokalno

- Projekt radi na PHP-u **7.4.33**. Za ovaj OpenCart ne koristiti PHP 8.x.
- Produkcijski dump je uvezen lokalno.
- Sve migracije prolaze dva puta zaredom.
- OCMOD runtime je regeneriran i ključne izmjene su prisutne u `storage/modification`.
- Prolaze pricing, sync, transport, grouped-cart, payload, outbox/race, storefront HTTP i admin smoke testovi.
- Postojeći XShippingPro quoteovi i checkout ispod starog minimuma od 150 EUR rade.
- `NarudzbaSend` nije pozvan; outbox je prazan.

Poznate poslovne stavke koje nisu deploy blocker, ali traže podatak/odluku:

- tablica partner–artikl rabata je prazna dok Italcro ne potvrdi semantiku potpunog feeda;
- jedna postojeća autorizacija nema aktivno mapiranog komercijalista i zato je ispravno blokirana za ERP narudžbu;
- Letak nema odobren URL/PDF pa je vidljiv, ali onemogućen;
- Blog ruta radi, ali produkcijski dump nema blog sadržaj;
- budući prag/trošak dostave od 200 EUR nije implementiran jer je u zahtjevu odgođen; postojeći XShippingPro ostaje aktivan.

## 1. Obavezno prije deploya

1. Rezervirati maintenance window. Migracije mijenjaju MyISAM order/product tablice i tijekom `ALTER TABLE` mogu ih zaključati.
2. Napraviti i provjeriti:
   - puni SQL backup;
   - backup trenutačnog releasea;
   - backup produkcijskog `storage/modification` direktorija;
   - zapis trenutačne vrijednosti `config_maintenance`.
3. Rotirati ranije korištene QIQO vjerodajnice. Stara vjerodajnica bila je u povijesti repozitorija/debug skripti; nemoj je ponovno koristiti.
4. Tajne postaviti izvan repozitorija, kroz procesni environment ili neversionirani `upload/env.php`:
   - `QIQO_USERNAME`
   - `QIQO_PASSWORD`
   - `QIQO_SOAP_URL`
   - `QIQO_ALLOW_INSECURE_HTTP=0`
   - `QIQO_ORDER_USERNAME`
   - `QIQO_ORDER_PASSWORD`
5. Obični HTTP za QIQO ne uključivati osim ako je promet iza odobrenog VPN/private tunnela i IP allowliste. Preferirati HTTPS.
6. Ne kopirati s lokalnog računala:
   - `upload/config.php`, `upload/admin/config.php` ni `upload/env.php`;
   - `storage/session`, `storage/upload`, `storage/download` i logove;
   - lokalni `storage/modification`; njega treba regenerirati na produkciji;
   - lokalni image/cache sadržaj koji nije dio releasea.

Prije izrade release commita ponovno pregledati i stageati cijeli odobreni set. U ovom radnom stablu neke novododane datoteke imaju status `AM` (staged početna verzija + novija završna verzija u working treeu), pa se ne smije napraviti `git commit` bez završnog `git add` pregleda.

Preflight na produkciji:

```bash
php -r 'echo PHP_VERSION, PHP_EOL;'
php -m | rg -i 'curl|dom|json|mbstring|mysqli|openssl|simplexml'
git status --short
```

Očekivani PHP je 7.4.x i sve navedene ekstenzije moraju postojati.

## 2. Točan deploy redoslijed

### Korak 1 — uključi maintenance

Uključi ga iz OpenCart admina ili kontrolirano u bazi. Prije promjene zapiši izvornu vrijednost:

```sql
SELECT `value`
FROM `oc_setting`
WHERE `store_id` = 0
  AND `code` = 'config'
  AND `key` = 'config_maintenance';

UPDATE `oc_setting`
SET `value` = '1', `serialized` = 0
WHERE `store_id` = 0
  AND `code` = 'config'
  AND `key` = 'config_maintenance';
```

### Korak 2 — postavi novi kod

Deployati sve verzionirane izmjene kao jedan release. Ne puštati promet na mješavinu starog koda i nove sheme.

Ako se deploy radi u mjestu, maintenance mora ostati uključen od početka kopiranja do završnog smoke testa. Ako se koristi release/symlink strategija, pripremiti novi release, ali docroot prebaciti tek u koordiniranom trenutku s migracijama.

### Korak 3 — primijeni migracije ovim redoslijedom

Iz korijena projekta:

```bash
php scripts/run_sql_migration.php \
  upload/migration/2026-08-28_import_api_nonce.sql \
  upload/migration/2026-08-28_qiqo_price_precision.sql \
  upload/migration/2026-08-28_qiqo_safe_discount_sync.sql \
  upload/migration/2026-08-28_qiqo_authorization_orphan_cleanup.sql \
  upload/migration/2026-08-28_rev3_ux_configuration.sql \
  upload/migration/2026-08-28_qiqo_order_outbox.sql
```

Svaka mora završiti s `OK`. Migracije su idempotentne; isti se poziv smije ponoviti kao provjera. Precision migracija mora biti prije outbox migracije.

### Korak 4 — regeneriraj OCMOD

Tek nakon koda i migracija:

```bash
php scripts/refresh_opencart_modifications.php
```

Helper:

- čita i vraća stvarno maintenance stanje;
- prije regeneriranja atomski sklanja stari runtime u rollback direktorij;
- na PHP grešci vraća prethodni runtime;
- ne dira session/upload/download podatke.

Ako je produkcijski `DIR_MODIFICATION` symlink ili nije standardni `storage/modification`, helper će namjerno odbiti rad. Tada ručno napravi backup i koristi **Extensions → Modifications → Refresh**, uz uključen maintenance.

Provjeri najnoviji dio `storage/logs/ocmod.log`. U ovom starom projektu postoje upozorenja nekih legacy OCMOD dodataka; zato je važnije potvrditi stvarni generirani runtime i smoke test nego samo poruku gumba.

Minimalna provjera ključnog runtimea:

```bash
rg -n 'allow_grouped_variant|ocm_special|base_discount' \
  storage/modification/system/library/cart/cart.php

rg -n 'mpn_count|getQiqoPricingMap' \
  storage/modification/catalog/controller/account/wishlist.php \
  storage/modification/catalog/controller/product/search.php
```

Ne uređivati datoteke u `storage/modification` ručno.

### Korak 5 — provjeri bazne sigurnosne gateove

```sql
SELECT `key`, `value`
FROM `oc_setting`
WHERE `key` IN (
  'quickcheckout_minimum_order',
  'qiqo_full_snapshot_confirmed',
  'qiqo_full_snapshot_since',
  'qiqo_order_send_enabled',
  'qiqo_order_allow_insecure_http',
  'qiqo_order_outbox_start_at'
)
ORDER BY `key`;
```

Očekivano odmah nakon deploya:

- `quickcheckout_minimum_order = 0`
- `qiqo_full_snapshot_confirmed = 0`
- `qiqo_full_snapshot_since` je prazan
- `qiqo_order_send_enabled = 0`
- `qiqo_order_allow_insecure_http = 0`
- `qiqo_order_outbox_start_at` postoji

Provjera integriteta bez ispisa osobnih podataka:

```sql
SELECT COUNT(*) AS auth_orphans
FROM `oc_customer_qiqo_authorization` cqa
LEFT JOIN `oc_customer` c ON c.customer_id = cqa.customer_id
LEFT JOIN `oc_qiqo_partner` p ON p.partner_id = cqa.partner_id
LEFT JOIN `oc_qiqo_delivery_place` d ON d.delivery_place_id = cqa.delivery_place_id
WHERE c.customer_id IS NULL
   OR p.partner_id IS NULL
   OR p.active <> 1
   OR d.delivery_place_id IS NULL
   OR d.partner_id <> cqa.partner_id;

SELECT COUNT(*) AS missing_active_sales_rep
FROM `oc_customer_qiqo_authorization` cqa
INNER JOIN `oc_customer` c ON c.customer_id = cqa.customer_id
INNER JOIN `oc_qiqo_partner` p ON p.partner_id = cqa.partner_id AND p.active = 1
INNER JOIN `oc_qiqo_delivery_place` d
  ON d.delivery_place_id = cqa.delivery_place_id AND d.partner_id = cqa.partner_id
LEFT JOIN `oc_qiqo_sales_rep` r ON r.sales_rep_id = cqa.sales_rep_id
WHERE cqa.sales_rep_id IS NULL OR r.sales_rep_id IS NULL OR r.active <> 1;

SELECT COUNT(*) AS outbox_rows FROM `oc_qiqo_order_outbox`;
SELECT COUNT(*) AS partner_article_discounts FROM `oc_qiqo_partner_article_discount`;
```

`auth_orphans` mora biti 0. `missing_active_sales_rep` treba ručno mapirati prije ERP slanja. Prazan partner–artikl cache ne puniti dok se ne potvrdi FULL ugovor.

### Korak 6 — produkcijski smoke dok je maintenance uključen

Ne pokretati lokalne testove koji koriste fixture narudžbu/kupca izravno nad produkcijom. Na produkciji koristiti read-only provjere i kontrolirani ručni pregled.

Primjer:

```bash
ITALCRO_RELEASE_URL='https://produkcijska-domena.example'

curl -fsS -o /dev/null -w '%{http_code}\n' "$ITALCRO_RELEASE_URL/"
curl -fsS -o /dev/null -w '%{http_code}\n' "$ITALCRO_RELEASE_URL/admin/"
curl -fsS -o /dev/null -w '%{http_code}\n' "$ITALCRO_RELEASE_URL/blog"
curl -fsS -o /dev/null -w '%{http_code}\n' \
  "$ITALCRO_RELEASE_URL/index.php?route=product/search&search=300970"

curl -fsS -o /dev/null -w '%{http_code}\n' "$ITALCRO_RELEASE_URL/feed.php"
curl -fsS -o /dev/null -w '%{http_code}\n' \
  "$ITALCRO_RELEASE_URL/index.php?route=extension/feed/jeftinije"
curl -fsS -o /dev/null -w '%{http_code}\n' \
  "$ITALCRO_RELEASE_URL/index.php?route=extension/feed/google_base"
```

Očekivano: javne/admin stranice 200, a tri ugašena legacy feeda 404.

U browseru provjeriti:

1. prijava autoriziranog testnog kupca;
2. SKU 300970 u katalogu: 15% i približno 1,65 EUR, bez akcijskog 22% u katalogu;
3. isti SKU u košarici: 22% na količini 1, 25% na 24, 28% na 240;
4. postojeći XShippingPro quote;
5. checkout narudžbe ispod 150 EUR više nije blokiran;
6. wishlist X uklanja samo odabrani artikl;
7. Blog je u meniju; Letak je vidljiv, ali onemogućen dok nema URL;
8. admin QIQO FULL gumbi su onemogućeni i prikazuju upozorenje;
9. `https://.../upload` i stare debug/feed skripte vraćaju 404;
10. stranica ne ispisuje `Deprecated`, `Warning` ni `Fatal error`.

Read-only outbox provjera:

```bash
php scripts/reconcile_qiqo_order_outbox.php
```

Bez `--enqueue`. Očekivano je 0 missing eligible narudžbi odmah nakon deploya.

### Korak 7 — isključi maintenance

Tek kada su baza, OCMOD i smoke provjere uredni, vrati `config_maintenance` na vrijednost zapisanu prije deploya. Provjeri Home, login, katalog, košaricu i checkout još jednom izvana.

## 3. Redoslijed QIQO ažuriranja nakon deploya

### A. Rutinski, nedestruktivni update

Prvo potvrdi da novi QIQO credential i transport rade. Zatim u QIQO Importeru koristi ovaj redoslijed, jedan po jedan gumb, uz pregled poruke i loga nakon svakog koraka:

1. **Sync komercijalista (inkrementalno)**
2. **Sync partnera i komercijalista (inkrementalno)**
3. **Pokreni import artikala** — samo ako treba dodati nove artikle
4. **Ažuriraj količine artikala**
5. **Ažuriraj cijene artikala**
6. **Sync akcijskog cjenika** — inkrementalni gumb, bez oznake FULL
7. **Ažuriraj partnere na artiklima**

Svaki feed sada validira transport i cijeli batch prije pisanja. Prazan, neispravan ili konfliktan feed mora završiti greškom/no-opom, a ne brisanjem ili nuliranjem podataka.

Brend/grupa gumbi nisu dio rutinskog updatea:

- **Kreiraj proizvođače**, **Linkaj grupe** i **Linkaj brandove** koristiti samo u kontroliranom maintenance zahvatu;
- force linkanje ne pokretati bez svježeg backupa i prethodne provjere broja pogođenih artikala.

### B. FULL update — trenutno NE pokretati

Dok Italcro pisano ne potvrdi da poziv s dogovorenim `datum` vraća potpuni snapshot, ostaviti:

```text
qiqo_full_snapshot_confirmed = 0
qiqo_full_snapshot_since = prazno
```

To blokira:

- partner/komercijalist FULL;
- akcijski cjenik FULL;
- partner–artikl rabat FULL;
- kompletni partner sync koji uključuje FULL zamjenu.

Nakon potvrde Italcra:

1. napraviti SQL backup tablica `oc_qiqo_partner`, `oc_qiqo_delivery_place`, `oc_qiqo_sales_rep`, `oc_qiqo_action_price`, `oc_qiqo_partner_article_discount` i `oc_qiqo_sync_state`;
2. upisati odobreni početni datum u `qiqo_full_snapshot_since`;
3. privremeno postaviti `qiqo_full_snapshot_confirmed = 1`;
4. pokretati zasebno i provjeravati broj redaka:
   - partner/komercijalist FULL;
   - akcijski cjenik FULL;
   - partner–artikl rabat FULL;
5. potvrditi da broj partner–artikl rabata nije neočekivano 0;
6. vratiti `qiqo_full_snapshot_confirmed = 0` nakon kontroliranog zahvata.

Ne koristiti **Sync svih partner podataka** u istom zahvatu ako su tri pojedinačna FULL koraka već pokrenuta; to bi samo ponovilo dio posla i otežalo audit.

### C. “Onemogući artikle kojih nema u ERP-u”

Ovaj gumb ostaje blokiran. Produkcijski `oc_product` je MyISAM, pa transakcijski rollback nije moguć. Za uključivanje treba poseban projekt:

1. potvrđen full-catalog ugovor s ERP-om;
2. planirana konverzija/strategija za transakcijsku product tablicu;
3. backup, ratio sanity prag i kontrolirani test na stagingu.

## 4. Aktivacija NarudzbaSend — zaseban korak nakon deploya

Sam deploy ne uključuje slanje. Ostaviti:

```text
qiqo_order_send_enabled = 0
qiqo_order_allow_insecure_http = 0
```

Prije aktivacije moraju biti ispunjena sva četiri uvjeta:

1. Italcro potvrdi šalje li se C-100 `cijena` po 100 komada ili po fizičkoj jedinici i potvrdi zaokruživanje `ukupno`;
2. endpoint je dostupan kroz HTTPS ili odobren VPN/private tunnel;
3. sve aktivne autorizacije koje smiju slati imaju aktivnog komercijalista;
4. dogovoren je workflow za izmjenu/otkazivanje već poslane narudžbe jer dostavljeni API nema Cancel/Update metodu.

Kontrolirani test:

1. postaviti nove order vjerodajnice izvan repozitorija;
2. ostaviti automatsko slanje ugašeno;
3. napraviti jednu dogovorenu testnu narudžbu s običnim i C-100 retkom;
4. u admin outboxu pregledati payload bez slanja;
5. s Italcrom dogovoriti termin i privremeno uključiti transport/send gate;
6. poslati samo tu narudžbu i potvrditi njihov zapis u bazi;
7. tek nakon potpune potvrde odlučiti ostaje li slanje uključeno.

Status `uncertain` nikada ne slati ponovno naslijepo. Prvo provjeriti ERP, zatim koristiti operatersku potvrdu “nije poslano” ili označiti ručno potvrđeno slanje.

## 5. Rollback

Ako deploy padne prije puštanja prometa:

1. ostaviti maintenance uključen;
2. vratiti prethodni kod/release;
3. regenerirati OCMOD iz starog koda ili vratiti provjereni backup `storage/modification`;
4. vratiti bazu iz pre-deploy SQL backupa ako novi kod neće ostati aktivan;
5. ponoviti smoke prije gašenja maintenancea.

Ne vraćati samo staru bazu uz novi kod ni samo stari kod uz polovično migriranu bazu.

Ako outbox sadrži `sent` ili `uncertain`, te retke sačuvati tijekom rollbacka. Ne brisati ih i ne ponavljati slanje bez ERP provjere.

Nikada ne vraćati stare javne debug/feed skripte ni kompromitirane vjerodajnice.

## 6. Završna checklista

- [ ] PHP 7.4.x i potrebne ekstenzije
- [ ] DB + code + OCMOD backup provjeren
- [ ] stare QIQO vjerodajnice rotirane
- [ ] maintenance uključen
- [ ] kod postavljen bez lokalnih config/storage podataka
- [ ] šest migracija prošlo redoslijedom
- [ ] OCMOD regeneriran i ključni runtime marker provjeren
- [ ] sigurnosni gateovi ostali na 0
- [ ] auth orphan count = 0
- [ ] pricing SKU 300970 provjeren u katalogu i košarici
- [ ] XShippingPro i checkout ispod 150 EUR provjereni
- [ ] debug/legacy price feedovi vraćaju 404
- [ ] outbox reconciliation dry-run = 0
- [ ] maintenance isključen tek nakon smokea
- [ ] FULL sync i NarudzbaSend nisu uključeni bez zasebne potvrde
