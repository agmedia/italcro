# Revizija 3.4 — Git objava i provjera

## Pravila objave

Objaviti isključivo pregledani, testirani i pushani commit. Ne kopirati ni uređivati izvorni kod na serveru. Produkcijski checkout prije povlačenja sadrži lokalne prilagodbe iz ranijih objava; sačuvati njihov pregledani Git snapshot i privatnu sigurnosnu kopiju. Ne uključivati konfiguraciju, tajne, slike, generirani runtime, logove ili sesije u commit.

Prvo pregledati `git status` i razliku produkcijskog koda prema predloženom releaseu. Ranije izmjene koje su već uključene u release ne vraćati naslijepo nakon povlačenja. Za preostale prilagodbe pripremiti lokalni pregledani commit prije objave. Generirane datoteke i podatke izvan releasea ostaviti na mjestu. Prije Git promjene uključiti održavanje i provjeriti puni SQL backup prema `DEPLOY_REV3.md`. Koristiti samo fast-forward na pushani release; nikad `reset --hard`, prisilni checkout ili kopiranje izvora.

## Migracije i runtime

Na povučenom releaseu, uz provjeren backup:

```sh
php scripts/run_sql_migration.php upload/migration/2026-10-22_rev33_classifications.sql upload/migration/2026-11-02_rev34_complete_catalog.sql
php scripts/refresh_opencart_modifications.php
```

Postojeći globalni FULL gateovi i slanje narudžbi ostaju odvojeni. Nova migracija ne uključuje potpuni katalog sama.

## Podaci i upozorenja

Prvo pregledati puni povijesni odgovor, brojeve dodavanja/deaktiviranja, nedostajuće nazive i promjene kategorija. FULL način dodjeljuje svakom artiklu samo aktualnu mapiranu ERP kategoriju; stare veze se ne zadržavaju. Potpuno neaktivne duple šifre kojih nema u potvrđenom punom odgovoru ostaju netaknute, izvan plana. Duplikat aktivne ili vraćene ERP šifre prekida postupak prije upisa:

```sh
php scripts/sync_qiqo_catalog.php --complete-snapshot --since=2000-01-01
```

Tek kad je izvor potvrđen i pregled prihvatljiv:

```sh
php scripts/configure_qiqo_catalog.php --defer-unnamed=500172,503825,508223,502794,91317,444273,513735,400474,503713,511644,480576,480573,507182,506806,501039,509503,514400
php scripts/configure_qiqo_catalog.php --confirm-complete-snapshot=2000-01-01
php scripts/configure_qiqo_alerts.php --email=denis.baksa@italcro.hr
php scripts/run_qiqo_catalog_cycle.php
```

Primatelja je korisnik izričito odabrao 2.11.2026. Konfiguriranje ne šalje probnu poruku. Stvarni novi/promijenjeni incident šalje upozorenje; prihvaćanje poruke od mail adaptera ne dokazuje primitak u sandučiću.

Korisnik je 2.11.2026. izričito odabrao privremeno izostavljanje navedenih 17 novih aktivnih šifri bez naziva i njihovu prijavu Denisu. Iznimka vrijedi samo za te nove artikle dok naziv nedostaje; nakon dopune naziva slijedi automatski uvoz. Ostali novi artikli bez naziva i dalje blokiraju primjenu. Ne koristiti opći `--skip-unnamed-new` u FULL načinu.

Ciklus kataloga pozvati iz lokalnog serverskog crona svaki sat u minuti 52, apsolutnim putanjama do PHP-a i `scripts/run_qiqo_catalog_cycle.php`. Sačuvati postojeći crontab i dodati samo jednu imenovanu Italcro stavku. Postojećih pet EasyCron zadataka ne mijenja ovlasti. Potpuni ciklus sam radi pregled, zaključavanje, održavanje, novi provjeren SQL backup i primjenu; neizmijenjen katalog ne uključuje održavanje. Čuvaju se posljednja tri provjerena backupa. Neuspjeli djelomični upis ostavlja održavanje i zahtijeva pregled privatnog incidenta. Trajni privatni marker nastaje prije uključivanja održavanja; nakon prekida procesa sljedeći ciklus prijavljuje potrebu za pregledom. Ciklus i izravna FULL primjena provjeravaju privatnu dovršenu SQL kopiju, checksum, odgovarajuću bazu i svježinu do jednog sata.

## Obavezna provjera rezultata

```sh
php scripts/inspect_qiqo_revision.php --erp --partner=1020054
php scripts/inspect_qiqo_revision.php --partner=1050054
```

Inspektor dopušta samo SELECT/SHOW upite; obračun košarice provjerava bez konstruktora, izmjena košarice ili slanja narudžbe. Potvrditi: 500953 isključen ako ga nema u potvrđenom punom API odgovoru; 517480 dodan ako je aktivan; svaki 800/801 samo u Rasprodaji; crveni R; katalog prikazuje veći rabat kupca/artikla, akcijski uvjeti tek u košarici. Prazne ili izmišljene rabatne oznake nisu dopuštene.

Provesti pet postojećih poslova i potpuni ciklus, pregledati privatne rezultate u `.qiqo-private/cron/` i potvrditi maintenance=0. Provjeriti stvarne prijavljene stranice kao odgovarajući kupac. Ne tvrditi da su push, objava, primitak e-pošte ili provjere dovršeni bez odgovarajuće potvrde.
