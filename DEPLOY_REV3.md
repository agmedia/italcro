# Italcro Revizija 3.0/3.1 — deploy i redoslijed ažuriranja

Zadnje ažuriranje: 2026-10-21

### Ažuriranje iz administracije — 2026-10-21

QIQO Importer sada izravno prikazuje ažuriranje količina, osnovnih cijena i dobavljača postojećih artikala. Ti postupci ne dodaju nove artikle; učitavaju lokalne podatke jednom i spremaju samo promjene.

Gumb **Uvezi rabate iz ERP-a** pokreće zaseban PHP CLI posao u pozadini. Početni dohvat koristi spremljeni `qiqo_partner_article_initial_since`; nakon uspješnog uvoza gumb postaje **Ažuriraj rabate kupac–artikl** i preuzima promjene od zadnjeg uspješnog početka uvoza uz preklapanje od minute. Administrator vidi fazu, broj redaka, preuzete megabajte i rezultat te može zatvoriti i ponovno otvoriti stranicu.

Odgovor se preuzima u privatnu datoteku, provjerava strukturno i po svakom retku te priprema u privremenoj InnoDB tablici. Tek nakon uspješne provjere i privatne sigurnosne kopije slijedi transakcijski upis rabata i watermarka. Odsutni rabati ne brišu se. Početna oznaka dovršenosti objavljuje se nakon commita. Prekinut/neispravan odgovor i konfliktni duplikati ne objavljuju djelomične podatke.

Poslovi i sigurnosne kopije su u `.qiqo-private/discount-jobs/` izvan `upload/` web korijena i izvan Gita. Pokretanje/status zahtijevaju administratorsku sesiju; pokretanje dodatno traži modify dopuštenje i CSRF token. Server mora dopuštati PHP CLI i `exec`. Vanjski CSV/XML importer s ERP manifestom i dalje je dostupan kao alternativni kanal; nije preduvjet za izravni SOAP uvoz kroz novi gumb.

Na ovom cPanel serveru (PHP 7.4.33, libcurl 7.61.0) koristi se podržani `CURLOPT_PROGRESSFUNCTION`: izloženi `CURLOPT_XFERINFOFUNCTION` pri produkcijskoj provjeri nije prihvaćen. Radnik provjerava rezultat svake cURL opcije prije slanja; neuspjela postavka prekida posao i sprema samo naziv opcije u privatnu dijagnostiku. `CURLOPT_WRITEFUNCTION` ostaje aktivan za pisanje odgovora u datoteku; nakon njega se ne postavlja `CURLOPT_RETURNTRANSFER`, koji bi poništio streaming callback.

Produkcijska provjera 2026-10-21: administratorsko ažuriranje količina obradilo je 3316 promijenjenih artikala, a ažuriranje osnovnih cijena 208. Početni posao pokrenut iz admina završen je u 09:01:54 (Europe/Zagreb): HTTP 200, 282274415 bajtova, 2080148 provjerenih redaka i jednako toliko jedinstvenih parova u live tablici. Privatna sigurnosna kopija je potvrđena. `qiqo_partner_article_initial_complete=1`; watermark je početak posla `2026-10-21 08:58:43`, početni datum ostaje `2026-08-01 00:00:00`. Za kupca 103 (ERP partner 1020054) ERP je potvrdio 18% za sva četiri SKU-a 405052, 405054, 405056 i 405058. Nakon osvježavanja stranice kao Denis Bakša sva četiri retka TIPLA MS prikazuju 18%: cijene su redom 18,49 EUR, 26,36 EUR, 39,75 EUR i 81,40 EUR. Gumb je nakon završetka prešao na redovno inkrementalno ažuriranje.

Ovo je runbook za produkcijski deploy promjena Revizije 3.0–3.2, sigurnog QIQO synca i pripreme `NarudzbaSend` outboxa. Vanjsko slanje narudžbi i destruktivni FULL syncovi ostaju isključeni dok se ne ispune niže navedeni uvjeti. Početni partner–artikl uvoz dostupan je kroz novi administratorski gumb koji zakazuje zaseban posao na serveru.

## 0. Ranije lokalne provjere

Sljedeće točke opisuju lokalne provjere prije uvođenja novog pozadinskog uvoza. Nisu izvještaj o trenutačnom sadržaju produkcijske baze; njega provjeriti prema statusu posla i read-only upitima nakon uvoza.

- Projekt radi na PHP-u **7.4.33**. Za ovaj OpenCart ne koristiti PHP 8.x.
- Produkcijski dump je uvezen lokalno.
- Sve migracije, uključujući Rev3.1 ugovor, prolaze dva puta zaredom.
- OCMOD runtime je regeneriran i ključne izmjene su prisutne u `storage/modification`.
- Prolaze pricing, sync, transport, grouped-cart, payload, outbox/race, v1 contract gate, migration, storefront HTTP i admin smoke testovi.
- Grupirani proizvod 1058 prikazuje sva tri artikla, njihove VPC cijene, rabat od 15% i konačne cijene; gostu se cijene ne otkrivaju kada je uključen buyer-only prikaz.
- Potvrđeni API ugovor je ugrađen: C-100 cijena je na osnovici 100 komada, količina ostaje u komadima, a `ukupno` je neto zbroj stavki i dostave na dvije decimale.
- Postojeći XShippingPro quoteovi i checkout ispod starog minimuma od 150 EUR rade.
- `NarudzbaSend` nije pozvan; outbox je prazan.

Poznate poslovne stavke koje nisu deploy blocker, ali traže podatak/odluku:

- u izvornoj lokalnoj provjeri partner–artikl cache bio je prazan; endpoint je inkrementalan, a početno punjenje sada se obavlja novim pozadinskim uvozom. Procjena od približno 2 milijuna slogova nije potvrđen rezultat uvoza;
- jedna postojeća autorizacija nema aktivno mapiranog komercijalista i zato je ispravno blokirana za ERP narudžbu;
- Letak nema odobren URL/PDF pa je vidljiv, ali onemogućen;
- Blog ruta radi, ali produkcijski dump nema blog sadržaj;
- novo pravilo dostave do praga 250 EUR nije uključeno jer još nedostaju točan fiksni iznos, pravilo za točno 250,00 EUR i porezni tretman; postojeći XShippingPro ostaje aktivan.

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
5. Preferirati HTTPS ili odobreni VPN/private tunnel. Za postojeći QIQO read servis korisnik je 2026-10-21 izričito odobrio nastavak HTTP veze; samo za taj postojeći pristup koristi se neversionirani `QIQO_ALLOW_INSECURE_HTTP=1`. To odobrenje ne uključuje slanje narudžbi ni promjenu order gateova.
6. Ne kopirati s lokalnog računala:
   - `upload/config.php`, `upload/admin/config.php` ni `upload/env.php`;
   - `storage/session`, `storage/upload`, `storage/download` i logove;
   - lokalni `storage/modification`; njega treba regenerirati na produkciji;
   - lokalni image/cache sadržaj koji nije dio releasea.

Prije izrade release commita ponovno pregledati i stageati cijeli odobreni set. U ovom radnom stablu neke novododane datoteke imaju status `AM` (staged početna verzija + novija završna verzija u working treeu), pa se ne smije napraviti `git commit` bez završnog `git add` pregleda.

Preflight na produkciji:

```bash
php -r 'echo PHP_VERSION, PHP_EOL;'
php -m | grep -Ei 'curl|dom|json|mbstring|mysqli|openssl|simplexml|xmlreader'
git status --short
```

Očekivani PHP je 7.4.x i sve navedene ekstenzije moraju postojati.

Ako `git pull` prijavi lokalne izmjene, ne prepisivati ih. Posebno prvo pregledati `upload/feed.php` i `upload/feed_brands.php`, spremiti njihov diff izvan web-roota i napraviti imenovani, ciljani stash. Tek nakon toga koristiti `git pull --ff-only origin main`. Stash se poslije ne vraća naslijepo: svaku razliku usporediti s novim kodom i vratiti samo namjerne serverske prilagodbe.

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
  upload/migration/2026-08-28_qiqo_order_outbox.sql \
  upload/migration/2026-10-06_rev31_api_contract.sql
```

Svaka mora završiti s `OK`. Migracije su idempotentne; isti se poziv smije ponoviti kao provjera. Precision migracija mora biti prije outbox migracije.

Rev3.1 migracija odmah drži `qiqo_order_send_enabled=0`, verzionira payload, blokira stare neposlane v1 zapise i postavlja lokaciju preuzimanja `0001`. Prije izvođenja svejedno potvrditi da nema aktivnog `processing` ili `rebuilding` zapisa; njihov se ishod provjerava ručno, ne automatskim rebuildom.

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
grep -nE 'allow_grouped_variant|ocm_special|base_discount' \
  storage/modification/system/library/cart/cart.php

grep -nE 'mpn_count|getQiqoPricingMap|show_variant_prices' \
  storage/modification/catalog/controller/account/wishlist.php \
  storage/modification/catalog/controller/product/search.php \
  storage/modification/catalog/controller/product/product.php
```

Ne uređivati datoteke u `storage/modification` ručno.

Na lokalnoj/staging kopiji nakon migracije pokrenuti puni paket:

```bash
herd php tests/qiqo_order_payload_test.php
herd php tests/qiqo_pricing_resolver_test.php
herd php tests/qiqo_sync_guard_test.php
herd php tests/qiqo_transport_parse_test.php
herd php tests/qiqo_cart_group_guard_test.php
herd php tests/qiqo_rev31_migration_test.php
herd php tests/qiqo_outbox_lifecycle_test.php
herd php tests/qiqo_outbox_contract_gate_test.php
herd php tests/local_rev3_http_smoke.php
herd php tests/local_qiqo_admin_smoke.php
```

Na produkciji ne pokretati zadnjih pet testova: koriste kontrolne DB zapise, fixture narudžbu/kupca ili privremenog admin korisnika. Tamo koristiti niže navedene read-only provjere i ručni smoke.

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
  'qiqo_order_outbox_start_at',
  'qiqo_order_pickup_location_code',
  'qiqo_order_delivery_shipping_codes',
  'qiqo_partner_article_initial_since',
  'qiqo_partner_article_initial_complete'
)
ORDER BY `key`;
```

Očekivano pri prvom postavljanju, prije početnog uvoza rabata:

- `quickcheckout_minimum_order = 0`
- `qiqo_full_snapshot_confirmed = 0`
- `qiqo_full_snapshot_since` je prazan
- `qiqo_order_send_enabled = 0`
- `qiqo_order_allow_insecure_http = 0`
- `qiqo_order_outbox_start_at` postoji
- `qiqo_order_pickup_location_code = 0001`
- `qiqo_order_delivery_shipping_codes = xshippingpro.xshippingpro1`
- `qiqo_partner_article_initial_since = 2026-08-01 00:00:00`
- `qiqo_partner_article_initial_complete = 0`

Nakon uspješnog početnog uvoza `qiqo_partner_article_initial_complete = 1` očekivano je stanje. Ne vraćati ga na 0 pri redovnom deployu; usporediti ga s dovršenim poslom i stvarnim watermarkom.

Dodatna outbox provjera prije i poslije migracije:

```sql
SELECT status, COUNT(*) AS broj
FROM `oc_qiqo_order_outbox`
GROUP BY status
ORDER BY status;

SHOW COLUMNS FROM `oc_qiqo_order_outbox`
LIKE 'payload_contract_version';
```

`processing` i `rebuilding` moraju biti 0 prije deploya. Stari neposlani payloadovi nakon migracije smiju ostati samo blokirani dok ih operater ne obnovi prema ugovoru v2.

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

`auth_orphans` mora biti 0. `missing_active_sales_rep` treba ručno mapirati prije ERP slanja. Početno punjenje partner–artikl cachea pokrenuti gumbom **Uvezi rabate iz ERP-a**, koji posao izvršava u zasebnom CLI procesu; završetak potvrditi statusom i ovim upitima. Stara sinkrona akcija nije kanal za početni uvoz.

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
8. admin QIQO FULL gumbi su onemogućeni i prikazuju upozorenje; gumbi za ažuriranje artikala i pozadinski uvoz rabata dostupni su, a aktivan posao prikazuje fazu i stvarne brojače;
9. `https://.../upload` i stare debug/feed skripte vraćaju 404;
10. stranica ne ispisuje `Deprecated`, `Warning` ni `Fatal error`.
11. proizvod `product_id=1058` prikazuje SKU 514048, 514049 i 501112, svaki s VPC-om, rabatom 15% i konačnom cijenom;
12. Brza narudžba prikazuje „Narudžba – osnovica”, a checkout nakon promjene načina plaćanja zadržava valjani, ponovno izračunani način dostave;
13. atribut, pakiranje, C-100 oznaka, šifra i barkod nisu izmiješani između košarice i potvrde.

Read-only outbox provjera:

```bash
php scripts/reconcile_qiqo_order_outbox.php
```

Bez `--enqueue`. Očekivano je 0 missing eligible narudžbi odmah nakon deploya.

### Korak 7 — isključi maintenance

Tek kada su baza, OCMOD i smoke provjere uredni, vrati `config_maintenance` na vrijednost zapisanu prije deploya. Provjeri Home, login, katalog, košaricu i checkout još jednom izvana.

## 3. Redoslijed QIQO ažuriranja nakon deploya

### A. Rutinski, nedestruktivni update

Prvo potvrdi da QIQO vjerodajnice i transport rade. U glavnom dijelu QIQO Importera redoslijed je:

1. **Postojeći artikli** — prema potrebi pokrenuti **Ažuriraj količine artikala**, **Ažuriraj cijene artikala** ili **Ažuriraj dobavljače na artiklima**. Količine osvježavaju i podatke o pakiranju/minimalnoj količini. Dobavljač artikla nije rabat kupca.
2. **Ažuriraj podatke kupaca i cjenike** — u jednom prolazu preuzima partnere i njihove opće rabate, mjesta isporuke, komercijaliste i akcijski cjenik. Nakon toga nije potrebno zasebno ponavljati komercijaliste i akcijski cjenik ako nije bilo novih promjena.
3. **Uvezi rabate iz ERP-a**, odnosno nakon prvog uspješnog punjenja **Ažuriraj rabate kupac–artikl** — pokreće pozadinski posao za posebne rabate. Pratiti fazu, obrađene zapise i završnu poruku; zatvaranje stranice ne prekida posao.

Za nove artikle i promjene naziva/opisa otvoriti **Dodatna ažuriranja i potpuni katalog**: prvo **Pregled promjena prije uvoza**, zatim odobreni uvoz. Cjeloviti katalog već osvježava količine, cijene i dobavljače, pa ih nakon njega ne treba ponavljati. Na produkcijskim MyISAM tablicama potpuni upis i dalje zahtijeva kontrolirani CLI postupak s backupom i maintenanceom iz odjeljka 7; gumb za pregled ostaje dostupan.

Stara sinkrona partner–artikl akcija i **Ažuriraj sve podatke kupaca** ostaju zaključani dok prvo punjenje, readiness oznaka i watermark nisu provjereni. To ne blokira novi pozadinski gumb ni zasebne artikle/osnovne podatke kupaca. Nakon završetka uvoza osvježiti stranicu za ponovno učitavanje ostalih opcija. Stari watermark bez stvarno popunjene tablice ne otključava sinkronu akciju; za veće skupove i kasnije promjene koristiti pozadinski gumb.

Svaki feed sada validira transport i cijeli batch prije pisanja. Prazan, neispravan ili konfliktan feed mora završiti greškom/no-opom, a ne brisanjem ili nuliranjem podataka.

Brend/grupa gumbi nisu dio rutinskog updatea:

- **Kreiraj proizvođače**, **Linkaj grupe** i **Linkaj brandove** koristiti samo u kontroliranom maintenance zahvatu;
- force linkanje ne pokretati bez svježeg backupa i prethodne provjere broja pogođenih artikala.

### B. Početni partner–artikl import i FULL update

Italcro je potvrdio da `qPartnerArtikalRabatWeb` vraća samo promjene nakon `datum`, a prazan uspješan odgovor znači da promjena nije bilo. Zato se taj feed nikada ne koristi kao destruktivna FULL zamjena.

Početni dohvat od spremljenog datuma `2026-08-01 00:00:00` sada se može pokrenuti novim pozadinskim gumbom, koji odgovor čita i zapisuje postupno. Alternativa za vanjski izvoz ili odgovor koji prelazi ograničenje radnika jest CSV/XML izvoz, opcionalno gzip, s ERP manifestom: očekivani broj slogova, kontrolni zbroj i vremenski interval. Za taj kanal koristi se importer iz odjeljka 7.

Administratorski HTTP zahtjev samo zakazuje posao; preuzimanje i uvoz izvršava zaseban PHP CLI radnik. Cijeli početni skup ne obrađivati starom sinkronom akcijom unutar HTTP zahtjeva. Do potvrđenog dovršetka ostaviti:

```text
qiqo_partner_article_initial_complete = 0
```

Pozadinski radnik ili alternativni importer smije objaviti `qiqo_partner_article_initial_complete = 1` tek nakon provjere cijelog skupa i commita rabata zajedno s točnim watermarkom. Ne otključavati ga ručno tijekom preuzimanja ili pripreme podataka. Nakon toga prazan uspješan inkrementalni odgovor samo pomiče watermark; nikada ne briše postojeći cache.

Za ostale destruktivne FULL zamjene i dalje ostaviti:

```text
qiqo_full_snapshot_confirmed = 0
qiqo_full_snapshot_since = prazno
```

To blokira:

- partner/komercijalist FULL;
- akcijski cjenik FULL;
- sve ostale nepotvrđene FULL zamjene.

Nakon potvrde Italcra:

1. napraviti SQL backup tablica `oc_qiqo_partner`, `oc_qiqo_delivery_place`, `oc_qiqo_sales_rep`, `oc_qiqo_action_price`, `oc_qiqo_partner_article_discount` i `oc_qiqo_sync_state`;
2. upisati odobreni početni datum u `qiqo_full_snapshot_since`;
3. privremeno postaviti `qiqo_full_snapshot_confirmed = 1`;
4. pokretati zasebno i provjeravati broj redaka:
   - partner/komercijalist FULL;
   - akcijski cjenik FULL;
5. vratiti `qiqo_full_snapshot_confirmed = 0` nakon kontroliranog zahvata.

**Ažuriraj sve podatke kupaca** je kombinirani inkrementalni postupak za osnovne podatke i posebne rabate; nije dodatni FULL korak. Ne ponavljati njime već provedene pojedinačne radnje u istom zahvatu bez novih ERP promjena.

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

Potvrđeni API ugovor:

- `stavke[].cijena` je konačna neto cijena nakon primjenjivih rabata;
- za C-100 se `kolicina` šalje u komadima, a `cijena` na osnovici od 100 komada;
- `narudzba.ukupno` je neto zbroj stavki i neto dostave, zaokružen na dvije decimale;
- pickup koristi lokaciju `0001`, a dostava autoriziranu lokaciju kupca;
- payload se blokira ako se cijene na pet decimala, subtotal, dostava, porez i ukupno ne mogu međusobno uskladiti.

Prije aktivacije moraju biti ispunjeni svi uvjeti:

1. endpoint je dostupan kroz HTTPS ili odobren VPN/private tunnel;
2. integracijske vjerodajnice su rotirane i postavljene izvan repozitorija;
3. sve aktivne autorizacije koje smiju slati imaju aktivnog komercijalista;
4. Italcro potvrdi da pickup lokacija `0001` smije biti poslana uz partnera kupca;
5. dogovoren je workflow za izmjenu/otkazivanje već poslane narudžbe jer dostavljeni API nema Cancel/Update metodu;
6. novo pravilo dostave ima potvrđen fiksni iznos, prag i porezni tretman ili je kontrolna narudžba napravljena s unaprijed potvrđenom postojećom dostavom.

Kontrolirani test:

1. postaviti nove order vjerodajnice izvan repozitorija;
2. ostaviti automatsko slanje ugašeno;
3. napraviti jednu dogovorenu testnu narudžbu s običnim i C-100 retkom te poznatim načinom dostave;
4. u admin outboxu pregledati payload bez slanja;
5. s Italcrom dogovoriti termin i privremeno uključiti transport/send gate;
6. poslati samo tu narudžbu i potvrditi njihov zapis u bazi;
7. potvrditi kod Italcra zaglavlje, stavke, C-100 osnovicu, lokaciju, dostavu i ukupni neto iznos;
8. tek nakon potpune potvrde odlučiti ostaje li slanje uključeno.

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
- [ ] sedam migracija prošlo redoslijedom, uključujući `2026-10-06_rev31_api_contract.sql`
- [ ] OCMOD regeneriran i ključni runtime marker provjeren
- [ ] gateovi za FULL zamjene i slanje narudžbi ostali na 0; readiness rabata odgovara stvarnom dovršenju uvoza
- [ ] auth orphan count = 0
- [ ] pricing SKU 300970 provjeren u katalogu i košarici
- [ ] grupirani proizvod 1058 prikazuje sva tri artikla, rabat i konačne cijene
- [ ] XShippingPro i checkout ispod 150 EUR provjereni
- [ ] promjena načina plaćanja ne ostavlja zastarjeli shipping quote
- [ ] `qiqo_partner_article_initial_complete = 0` do potvrđenog završetka prvog uvoza; nakon završetka provjereni broj zapisa, watermark, readiness=1 i primjer rabata na webu
- [ ] debug/legacy price feedovi vraćaju 404
- [ ] outbox reconciliation dry-run = 0
- [ ] maintenance isključen tek nakon smokea
- [ ] FULL sync i NarudzbaSend nisu uključeni bez zasebne potvrde

## 7. Revizija 3.2 — ponovni uvoz i ispravci kataloga

Ponovni uvoz sada osvježava i postojeće SKU-ove: naziv/opis, grupu, cijene, količine, pakiranje, `sortkatalog` i `aktivan`. `aktivan=false` deaktivira artikl bez brisanja. ID artikla, povijesne narudžbe, lokalne slike, brendovi, kategorije i datumi uvođenja ostaju sačuvani. Artikli izostavljeni iz inkrementalnog odgovora ne deaktiviraju se.

Numeričke šifre u standardnoj, Mega Smart, autocomplete i brzoj pretrazi uspoređuju se s punim SKU-om ili barkodom. Lista želja označava kada treba odabrati varijantu/opcije; mobilne kontrole količine prelamaju se unutar kartice. Glavni meni sadrži redom Brza narudžba, Novo, Akcije, Blog, Brandovi i Letak.

### Postavljanje i kontrolirani ponovni uvoz

Primjenjuju se backup i maintenance koraci iz prethodnih odjeljaka. Prije bilo kakvog produkcijskog upisa sačuvati kod, lokalne razlike i postojeći OCMOD. Produkcija može imati lokalne promjene `php.ini`, `robots.txt` i generiranih slika; ne resetirati checkout.

Nakon postavljanja koda, uz uključen maintenance, napraviti provjeren puni dump izvan web direktorija. Skripta bez `--apply` samo provjerava uvjete:

```bash
php scripts/backup_qiqo_database.php --output-dir=/home/amds/private-backups/italcro
php scripts/backup_qiqo_database.php --output-dir=/home/amds/private-backups/italcro --apply
php scripts/run_sql_migration.php upload/migration/2026-10-14_qiqo_product_introduction_date.sql
php scripts/sync_rev32_modifications.php
php scripts/sync_rev32_modifications.php --apply
php scripts/refresh_opencart_modifications.php
php scripts/sync_qiqo_catalog.php
```

`sync_rev32_modifications.php` mijenja samo postojeći Baselov uvjet za oznaku Novo, čuvajući instalirane prilagodbe. Mega Smart Search učitava se iz `system/msmart_search.ocmod.xml` pri standardnom osvježavanju; ne dodavati duplu DB modifikaciju.

Pregled kataloga ispisuje broj novih, promijenjenih, nepromijenjenih, deaktiviranih i ponovno aktiviranih artikala. Cijeli ERP odgovor, reference i lokalni SKU-ovi validiraju se prije upisa. Ako postojeća shema nema obavezne stupce, postupak staje; ne zaobilaziti provjeru. Zadani ERP interval je posljednje dvije godine; za drukčiji dogovoreni početak koristiti eksplicitni `--since=YYYY-MM-DD`.

ERP grupa `0` označava nedodijeljenu grupu i sprema se kao prazan MPN. Postojeći SKU zadržava svoj lokalni naziv kada ERP nema naziv grupe. Novi SKU bez naziva zadano prekida cijeli uvoz; eksplicitni `--skip-unnamed-new` preskače samo takve nove SKU-ove i vraća `skipped_missing_names` i `skipped_skus`. Koristiti isti flag u pregledu i primjeni te navesti izostavljene artikle u izvještaju. Valjan numerički partner artikla sprema se i kada ga partner feed ne vraća, uz brojač `missing_partner_refs`; to ne mijenja autorizacije kupaca. Nedostajuće pozitivne grupe i neispravni obavezni podaci i dalje prekidaju cijeli batch.

Za produkcijske MyISAM tablice primijeniti pregledani plan uz stvarni upravo napravljeni dump:

```bash
php scripts/sync_qiqo_catalog.php --apply --allow-nontransactional --backup=/home/amds/private-backups/italcro/STVARNI-BACKUP.sql
```

MyISAM nema transakcijski rollback. CLI zato traži maintenance i čitljiv, neprazan backup izvan weba te ispisuje njegov SHA-256. Ako prijavi `partial=true`, ostaviti maintenance i provjeriti zahvaćene podatke/backup prije nastavka. Na InnoDB tablicama koristi transakciju. FULL zastavice i slanje narudžbi ovim se postupkom ne uključuju.

Nakon uspješnog importa ponovno pokrenuti isti pregled: očekuje se `added=0`, `updated=0` dok ERP nije promijenjen. Provjeriti artikle 509431, 440700, 405054, traženje nepostojeće šifre 405015, Akcije, Novo, listu želja i mobilne količine. Povijest narudžbi čita spremljene stavke narudžbe (`order_product`), pa deaktivacija artikla ne uklanja povijesne stavke.

Primijenjeni uvoz automatski čisti cache prefikse `product` i `megamenu` u webu i CLI-ju. Pregled ne čisti cache. Greška čišćenja zapisuje upozorenje u QIQO log, uz očuvan rezultat uspješnog upisa podataka.

### Početni rabati i datum novih artikala

Pravilo cijene ostaje: partner–artikl rabat ima prednost, uključujući eksplicitnih 0%; ako zapisa nema, koristi se rabat partnera. Prazan cache nije dokaz da ERP nema posebne rabate.

Za provjereni početni CSV/XML izvoz, opcionalno gzip, dodan je importer koji obrađuje redove postupno i puni privremeni staging. Potreban je ERP manifest: točan broj redaka, SHA-256, početni datum i watermark izvoza. Ne izmišljati te vrijednosti iz procjene od dva milijuna redaka.

```bash
php scripts/import_qiqo_partner_discounts.php --source=/home/amds/private-exports/rabati.xml.gz --expected-count=ERP_BROJ --sha256=ERP_SHA256 --since='2026-08-01 00:00:00' --watermark='ERP_DATUM_I_VRIJEME'
```

Tek nakon prolaska provjere ponoviti isti poziv s `--apply`. Importer provjerava cjelovitost gzipa/XML-a/CSV-a, broj i hash, konfliktne duplikate i vremenski interval. Ne briše stare rabate. Cache i watermark upisuje u jednoj InnoDB transakciji, a `initial_complete=1` objavljuje nakon uspješnog commita. Postojeća MyISAM `setting` tablica ne mora se konvertirati. Neuspjela objava readiness zastavice ostavlja potrebu za provjerom; nije razlog za ručno otključavanje stare sinkrone akcije.

Stranica **Novo**, „Novo u ponudi” carousel i oznaka **Novo** koriste `product.date_added` te zajednički broj dana iz Basel postavke **New label period** (`newlabel_status`). Postojeća vrijednost 60 dana ostaje sačuvana; promijeniti je samo kroz tu postavku. Vrijednost 0 isključuje prikaz novih artikala i oznake. Prazan carousel ne prikazuje se.

Ponovni uvoz postojećeg artikla čuva izvorni `date_added`, pa ne pokreće novo razdoblje prikaza. Novi artikl dobiva datum dodavanja u webshop pri prvom uvozu. ERP datum uvođenja i postojeći nullable stupac `qiqo_introduced_at` više nisu preduvjet za prikaz na stranici Novo niti određuju oznaku Novo.

Fotografije se povezuju iz točne ERP putanje. Poznati Windows izvor `\\SRV-TS01\Svasta\Italcro\Photo\...` (uključujući spremljeni prefiks `Slike//`) prevodi se u lokalne `Slike/...` ili `Portals/0/Photo/...` putanje. Redovni uvoz kataloga dopunjava praznu/nevaljanu glavnu sliku kada odgovarajuća datoteka postoji lokalno; valjane slike ostaju sačuvane. Uspješan uvoz artikla ne potvrđuje da je njegova fotografija dostupna. Vanjski izvor slika mora imati izričito konfiguriran puni HTTP/HTTPS URL; goli naziv hosta nije dovoljna konfiguracija.

Za zasebno povezivanje dostupnih slika trenutačnih artikala na stranici Novo koristiti donji pregled, zatim primjenu s novom privatnom putanjom izvještaja. Postupak ne preuzima ni prepisuje datoteke, ne mijenja cijene, rabate, dokumente ni datume artikala. Izvještaj sadrži stare/nove vrijednosti i popis neriješenih SKU-ova s izvornim putanjama. Ako datoteke nedostaju, prvo prenijeti ažurirani ERP Photo direktorij uz očuvanu strukturu u `upload/image/Portals/0/Photo/`, pa ponoviti pregled.

```bash
php scripts/repair_qiqo_product_images.php
php scripts/repair_qiqo_product_images.php --apply --report=/home/amds/private-backups/italcro/images-NOVI-DATUM.json
```

Paginacija kataloga koristi raspoloživu širinu za brojeve i strelice; prikaz broja rezultata prelazi u vlastiti red kada nema dovoljno mjesta. Na uskim zaslonima kontrole se centriraju i uredno prelamaju.

Novo pravilo dostave zasebno ostaje na čekanju dogovorenih poslovnih detalja.

### Lokalna provjera Revizije 3.2

Uz postojeće pricing/sync/cart provjere prolaze novi catalog, discount reader i Novo testovi. Testove s prefiksom `local_` pokretati samo nad lokalnom kopijom: koriste privremene/izolirane fixture tablice ili postojeće lokalne smoke račune.

```bash
herd php tests/qiqo_catalog_reimport_test.php
herd php tests/qiqo_discount_import_test.php
herd php tests/qiqo_new_product_test.php
herd php tests/local_qiqo_discount_import_test.php
herd php tests/local_qiqo_new_product_test.php
herd php tests/local_rev32_search_test.php
herd php tests/local_rev32_http_test.php
```
