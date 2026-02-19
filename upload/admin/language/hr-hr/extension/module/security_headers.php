<?php
// Heading
$_['heading_title']                             = "Opencart sigurnosna zaglavlja";
// Text
$_['text_module']                               = "Moduli";
$_['text_success']                              = "Uspjeh: izmijenili ste sigurnosna zaglavlja Opencart!";
$_['text_edit']                                 = "Uredite postavke sigurnosnih zaglavlja";
$_['text_default']                              = "Zadana trgovina";
$_['text_select_store']                         = "Odaberite Trgovina";
$_['text_stores']                               = "Trgovine:";
$_['text_insecure']                             = "Nesiguran";
// Placeholder
$_['placeholder_expect_ct_report_uri']          = "Upišite url adresu izvješća..";
$_['placeholder_expect_ct_max_age']             = "Upišite maksimalnu dob u sekundama..";
$_['placeholder_strict_transport_security']     = "Upišite maksimalnu dob u sekundama..";
// Entry
$_['entry_status']                              = "Status proširenja";
$_['entry_X_Powered_By']                        = "X-Powered-By";
$_['entry_X_HTTP_Method_Override']              = "X-HTTP-Nadjačavanje metode";
$_['entry_proxy']                               = "HTTP proxy";
$_['entry_forward']                             = "HTTP prosljeđivanja";
$_['entry_ranges']                              = "HTTP rasponi";
$_['entry_X_XSS_Protection']                    = "X-XSS-Zaštita";
$_['entry_X_Frame_Options']                     = "X-Frame-Opcije";
$_['entry_X_Content_Type_Options']              = "X-Content-Type-Options";
$_['entry_Referrer_Policy']                     = "Politika preporuke";
$_['entry_Content_Security_Policy']             = "Sadržaj-Sigurnosna-Politika";
$_['entry_max_age']                             = "Maks. dob";

// About
$_['about_extension']                           = 'HTTP zaglavlja omogućuju klijentu i poslužitelju da proslijede dodatne informacije uz HTTP zahtjev ili odgovor. HTTP zaglavlje sastoji se od imena koje nije osjetljivo na velika i mala slova nakon čega slijedi dvotočka (:), a zatim njegova vrijednost. Razmak prije nego što se vrijednost zanemaruje.<br/><br/>Postoji mnogo stvari koje treba uzeti u obzir kada osiguravate svoje web mjesto ili web aplikaciju, ali dobro je mjesto za početak istražiti svoja HTTP sigurnosna zaglavlja i osigurati da ste u korak s najboljim praksama. U mnogim slučajevima vrlo ih je jednostavno implementirati i zahtijevaju samo malu promjenu konfiguracije web poslužitelja. HTTP sigurnosna zaglavlja pružaju još jedan sloj sigurnosti pomažući u ublažavanju napada i sigurnosnih ranjivosti.<br/></br/>Kad god preglednik zatraži stranicu od web poslužitelja, poslužitelj odgovara sadržajem zajedno s HTTP zaglavljima odgovora. Neka od ovih zaglavlja sadrže metapodatke o sadržaju kao što su kodiranje sadržaja, kontrola predmemorije, kodovi grešaka statusa itd.<br/>
<br/>
Uz njih postoje i HTTP sigurnosna zaglavlja koja govore vašem pregledniku kako da se ponaša prilikom rukovanja sadržajem vaše web stranice. Na primjer, korištenjem strict-transport-security možete natjerati preglednik da komunicira isključivo preko HTTPS-a. Postoji šest različitih HTTP sigurnosnih zaglavlja koje ćemo istražiti u nastavku (bez određenog redoslijeda) kojih biste trebali biti svjesni i preporučujemo implementaciju ako je moguće.';

$_['about_X_Powered_By']                        = "Mogu ga postaviti hosting okruženja ili drugi okviri i sadrži informacije o njima, a ne pruža nikakvu korisnost aplikaciji ili njezinim posjetiteljima. Poništite ovo zaglavlje kako biste izbjegli izlaganje potencijalnih ranjivosti.<br/><br/><strong>Preporuka: </strong>Onemogućeno";

$_['about_X_XSS_Protection']                    = "Zaglavlje x-xss-protection osmišljeno je kako bi se omogućio filtar skriptiranja na različitim mjestima (XSS) ugrađen u moderne web preglednike. To je obično omogućeno prema zadanim postavkama, ali njegova uporaba će ga primijeniti. Podržavaju ga Internet Explorer 8+, Chrome i Safari.<br/>Zaglavlje odgovora HTTP X-XSS-Protection značajka je Internet Explorera, Chromea i Safarija koja zaustavlja učitavanje stranica kada otkriju reflektirane napade skriptiranjem na više stranica (XSS). Iako su ove zaštite uvelike nepotrebne u modernim preglednicima kada web-mjesta provode snažnu Content-Security-Policy koja onemogućuje upotrebu ugrađenog JavaScripta (\'unsafe-inline\'), one i dalje mogu pružiti zaštitu za korisnike starijih web preglednika koji još ne podržavaju CSP.<br/><strong>Preporuka: </strong>1; mod=blok";

$_['about_X_Frame_Options']                     = 'Zaglavlje x-frame-options pruža zaštitu od klikova ne dopuštajući učitavanje iframeova na vašoj web stranici. Podržavaju ga IE 8+, Chrome 4.1+, Firefox 3.6.9+, Opera 10.5+, Safari 4+.<br/>Zaglavlje HTTP odgovora <strong>X-Frame-Options</strong> može se koristiti za označavanje treba li pregledniku biti dopušteno prikazati stranicu u <i>okviru</i>, <i>iframe</i>, <i>ugraditi</i> ili <i>objekt</i>. Web-mjesta to mogu koristiti za izbjegavanje napada clickjackinga, osiguravajući da njihov sadržaj nije ugrađen u druga web-mjesta.<br/>
<br/>
Dodatna sigurnost dostupna je samo ako korisnik koji pristupa dokumentu koristi preglednik koji podržava X-Frame-Options.<br/><strong>Preporuka: </strong>Same Origin';

$_['about_X_Content_Type_Options']              = 'Zaglavlje x-content-type-options sprječava Internet Explorer i Google Chrome da nanjuše odgovor od deklarirane vrste sadržaja. Ovo pomaže u smanjenju opasnosti od nasilnih preuzimanja i pomaže u tretiranju sadržaja na pravi način. <strong>X-Content-Type-Options</strong> HTTP zaglavlje odgovora je oznaka koju poslužitelj koristi za označavanje da se MIME tipovi oglašeni u zaglavljima Content-Type ne bi trebali mijenjati i slijediti. Ovo omogućuje isključivanje MIME tipa njuškanja, ili, drugim riječima, to je način da se kaže da su webmasteri znali što rade.<br/>
<br/>
Ovo je zaglavlje uveo Microsoft u IE 8 kao način za webmastere da blokiraju njuškanje sadržaja koje se događalo i moglo transformirati neizvršne MIME tipove u izvršne MIME tipove. Od tada su ga uveli i drugi preglednici, čak i ako su njihovi MIME algoritmi za njuškanje bili manje agresivni.<br/>
<br/>
Testeri sigurnosti web-mjesta obično očekuju da ovo zaglavlje bude postavljeno.<br/><strong>Preporuka: </strong>Bez njuškanja';

$_['about_Referrer_Policy']                     = 'Kada korisnik klikne poveznicu na jednom mjestu, izvoru, koji ga vodi na drugo mjesto, odredište, odredišno mjesto prima informacije o izvoru s kojeg je korisnik došao. Ovo je način na koji dobivamo mjerne podatke poput onih koje pruža Google Analytics o tome odakle dolazi naš promet. Znam da je 4000 korisnika došlo s Twittera ovaj tjedan jer kada posjete moju stranicu, postave referer[sic] zaglavlje u svom zahtjevu.<br/><br/>
<strong>Direktive</strong>
<br/><br/>
<strong>bez preporuke</strong>
<p>Zaglavlje Referer bit će u potpunosti izostavljeno. Uz zahtjeve se ne šalju informacije o preporuci.</p>
<strong>no-referrer-when-downgrade (zadano)</strong>
<p>Ovo je zadano ponašanje ako nije navedeno pravilo ili ako je navedena vrijednost nevažeća. Izvor, put i niz upita URL-a šalju se kao preporuka kada razina sigurnosti protokola ostane ista (HTTP→HTTP, HTTPS→HTTPS) ili se poboljša (HTTP→HTTPS), ali se\\'ne šalje na manje sigurna odredišta (HTTPS→HTTP).</p>
<strong>podrijetlo</strong>
<p>Samo pošaljite izvor dokumenta kao preporuku.</p>
<p>Na primjer, dokument na https://example.com/page.html će poslati referera https://example.com/.</p>
<strong>podrijetlo-prilikom-prijenosa</strong>
<p>Pošalji podrijetlo, putanju i niz upita kada izvodite zahtjev istog podrijetla, ali pošaljite samo podrijetlo dokumenta za druge slučajeve.</p>
<strong>isto porijeklo</strong>
<p>Preporuka će biti poslana za izvore s istog mjesta, ali zahtjevi s različitim izvorima neće slati informacije o preporuci.</p>
<strong>striktnog porijekla</strong>
<p>Samo pošaljite izvor dokumenta kao preporuku kada razina sigurnosti protokola ostane ista (HTTPS→HTTPS), ali ga nemojte\\'ne slati na manje sigurno odredište (HTTPS→HTTP).</p>
<strong>striktno-podrijetlo-prilikom-prelaska</strong>
<p>Pošalji podrijetlo, stazu i niz upita prilikom izvođenja zahtjeva istog podrijetla, pošalji podrijetlo samo kada razina sigurnosti protokola ostane ista (HTTPS→HTTPS) i ne šalji zaglavlje na manje sigurno odredište (HTTPS→HTTP).</p>
<strong>nesiguran-url</strong>
<p>Pošalji izvor, put i niz upita prilikom izvođenja bilo kojeg zahtjeva, bez obzira na sigurnost.</p>
<strong>Preporuka: </strong>Strogo kada je drugo podrijetlo';

$_['about_Strict_Transport_Security']           = 'Zaglavlje <strong>Strict Transport Security</strong> je sigurnosno poboljšanje koje web preglednicima ograničava pristup web poslužiteljima isključivo putem HTTPS-a. Ovo osigurava da se veza ne može uspostaviti putem nesigurne HTTP veze koja bi mogla biti podložna napadima.<br/><br/><strong>Primjer scenarija</strong><br/>
<br/>
Prijavite se na besplatnu WiFi pristupnu točku u zračnoj luci i počnete surfati webom, posjećujući svoju internetsku bankarsku uslugu kako biste provjerili stanje i platili nekoliko računa. Nažalost, pristupna točka koju\\'koristite zapravo je prijenosno računalo hakera\\', a oni\\'presreću vaš izvorni HTTP zahtjev i preusmjeravaju vas na klon stranice vaše banke\\' umjesto na pravu stvar. Sada su vaši privatni podaci izloženi hakeru.<br/><br/>
<strong>Strict Transport Security</strong> rješava ovaj problem; sve dok ste\\' jednom pristupili web stranici svoje banke\\' pomoću HTTPS-a, a web stranica banke\\' koristi <strong>Strict Transport Security</strong>, vaš će preglednik znati automatski koristiti samo HTTPS, što sprječava hakere u izvođenju ove vrste čovjek-u-sredi napad.<br/><br/><strong>Kako preglednik to rješava</strong>
<br/>
Prvi put kada se vašoj web stranici pristupi pomoću HTTPS-a i ona vrati zaglavlje <strong>Strict-Transport-Security</strong>, preglednik bilježi ove informacije, tako da će budući pokušaji učitavanja stranice pomoću HTTP-a automatski koristiti HTTPS umjesto njega.<br/>
<br/>
Kada istekne vrijeme isteka navedeno u zaglavlju <strong>Strict-Transport-Security</strong>, sljedeći pokušaj učitavanja stranice putem HTTP-a nastavit će se normalno umjesto automatskim korištenjem HTTPS-a.<br/>
<br/>
Kad god se zaglavlje <strong>Strict-Transport-Security</strong> isporuči pregledniku, ono će ažurirati vrijeme isteka za tu stranicu, tako da stranice mogu osvježiti ove informacije i spriječiti istek vremenskog ograničenja. Ako bude potrebno onemogućiti <strong>Strict-Transport-Security</strong>, postavljanje max-age na 0 (preko https veze) odmah će isteći zaglavlje <strong>Strict-Transport-Security</strong>, dopuštajući pristup putem http.<br/>
<strong>Preporuke: </strong><br/>Povremeno povećavajte vrijeme.';

$_['about_Expect_CT']                           = 'Zaglavlje <strong>Expect-CT</strong> sprječava korištenje pogrešno izdanih certifikata dopuštajući web stranicama izvješćivanje i opcionalno provođenje zahtjeva transparentnosti certifikata. Kada je ovo zaglavlje omogućeno, web-mjesto traži od preglednika da provjeri pojavljuje li se certifikat u javnim CT zapisima ili ne.<br/><br/>Zaglavlje <strong>Expect-CT</strong> omogućuje web-lokacijama da se uključe u izvješćivanje i/ili provedbu zahtjeva za transparentnošću certifikata, što sprječava upotrebu pogrešno izdanih certifikata za tu web-lokaciju neprimjetno.<br/>
<br/>
CT zahtjeve poslužitelji mogu zadovoljiti putem bilo kojeg od sljedećih mehanizama:
<ul>
   <li>X.509v3 proširenje certifikata za dopuštanje ugradnje potpisanih vremenskih oznaka certifikata koje izdaju pojedinačni zapisnici</li>
   <li>TLS proširenje tipa signed_certificate_timestamp poslano tijekom rukovanja</li>
   <li>Podržavanje OCSP klamanja (tj. status_request TLS ekstenzije) i pružanje SignedCertificateTimestampList</li>
</ul>
<br/><br/>
<strong>Preporuke: </strong><br/>max-age: Povremeno povećavajte vrijeme<br/>Report-Uri: https://report-uri.cloudflare.com/cdn-cgi/beacon/expect-ct';

$_['about_Content_Security_Policy']             = 'Zaglavlje content-security-policy pruža dodatni sloj sigurnosti. Ovo pravilo pomaže u sprječavanju napada poput Cross Site Scripting (XSS) i drugih napada ubacivanjem koda definiranjem izvora sadržaja koji su odobreni i na taj način dopušta pregledniku da ih učita.
<br/><br/>
Svi glavni preglednici trenutno nude potpunu ili djelomičnu podršku za politiku sigurnosti sadržaja. I neće prekinuti isporuku sadržaja ako se isporuči u stariji preglednik, jednostavno se neće izvršiti.
<br/><br/>
Postoje mnoge direktive koje možete koristiti s politikom sigurnosti sadržaja. Ovaj primjer u nastavku dopušta skripte s trenutne domene (definirane sa \'self\') kao i google-analytics.com.<br/><strong>Content Security Policy</strong> (CSP) je dodatni sloj sigurnosti koji pomaže u otkrivanju i ublažavanju određenih vrsta napada, uključujući Cross Site Scripting (XSS) i napade ubacivanjem podataka. Ovi se napadi koriste za sve, od krađe podataka do narušavanja stranice do distribucije zlonamjernog softvera.<br/>
<br/>
CSP je dizajniran da bude potpuno kompatibilan sa starijim verzijama (osim CSP verzije 2 gdje postoje neke izričito navedene nedosljednosti u kompatibilnosti sa prethodnim verzijama; više detalja ovdje, odjeljak 1.1). Preglednici koji ga ne\\'ne podržavaju i dalje rade s poslužiteljima koji ga implementiraju, i obrnuto: preglednici koji ne\\'ne podržavaju CSP jednostavno ga ignoriraju, funkcioniraju kao i obično, prema zadanim postavkama prema standardnoj politici istog porijekla za web sadržaj. Ako web mjesto\\'ne nudi CSP zaglavlje, preglednici također koriste standardna pravila istog porijekla.<br/>
<br/>
Da biste omogućili CSP, morate konfigurirati svoj web poslužitelj da vraća <strong>Content-Security-Policy</strong> HTTP zaglavlje (ponekad ćete vidjeti spominjanje zaglavlja X-Content-Security-Policy, ali to\\'je starija verzija i ne\\'ne morate je specificirati više).<br/><br/><strong>Preporuke: </strong><br/>upgrade-insecure-requests';

$_['about_X_HTTP_Method_Override']             = 'U određenim situacijama (na primjer, kada su usluga ili njezini korisnici iza pretjerano revnog korporativnog vatrozida ili ako je glavni potrošač web stranica), mogu biti dostupne samo GET i POST HTTP metode. U takvom slučaju, moguće je emulirati glagole koji nedostaju prosljeđivanjem prilagođenog zaglavlja u zahtjevima.
<br/><br/>
Na primjer, ažuriranjem resursa može se upravljati pomoću POST zahtjeva postavljanjem prilagođenog zaglavlja (na primjer, X-HTTP-Method-Override) na PUT kako bi se naznačilo da emuliramo PUT zahtjev putem POST zahtjeva.<br/><br/><strong>Preporuke: </strong><br/>Onemogućeno';

$_['about_forward']                            = 'Kada se klijent povezuje s poslužiteljem putem proxyja ili balansera opterećenja, neophodno je da krajnja točka koristi prilagođena HTTP zaglavlja kako bi mogla proslijediti identitet klijenta koji se povezuje.
<br/><br/>
X-Forwarded-For (XFF) zaglavlje jedno je od najčešće korištenih HTTP zaglavlja za tu svrhu. Služi kao mjesto na kojem svaki čvor za prosljeđivanje pohranjuje IP adresu svog izravnog klijenta koristeći zarez kao razdjelnik formirajući povijesni put HTTP veze. Međutim, HTTP je standard temeljen na tekstu i vrlo je lako krivotvoriti bilo koji dio njegovog sadržaja. 
<br/><br/>
 Krivotvorenjem XFF zaglavlja na ovaj način klijent može doći do neovlaštenih dijelova aplikacije, stvoriti moguće napade uskraćivanjem usluge ili krivotvoriti zabilježene IP adrese. 
 <br/>
<strong>Proslijeđeno</strong>
<p>Sadrži informacije s klijentske strane proxy poslužitelja koje se mijenjaju ili gube kada je proxy uključen u put zahtjeva.</p>
<strong>X-Proslijeđeno-Za</strong>
<p>Identificira izvorne IP adrese klijenta koji se spaja na web poslužitelj preko HTTP proxyja ili balansera opterećenja.</p>
<strong>X-Proslijeđeno-Host</strong>
<p>Identificira originalni host koji je klijent tražio da se poveže s vašim proxyjem ili balanserom opterećenja.</p>
<strong>X-Proslijeđeno-Proto</strong>
<p>Identificira protokol (HTTP ili HTTPS) koji je klijent koristio za povezivanje s vašim proxyjem ili balanserom opterećenja.</p>
<strong>Via</strong>
<p>Dodaju proxy-i, i prosljeđujući i obrnuti proxy-ji, i mogu se pojaviti u zaglavljima zahtjeva i zaglavljima odgovora.</p>
<strong>Preporuke: </strong><br/>Onemogućeno';

$_['about_ranges']                              = 'Zaglavlje "Raspon" namijenjeno je za podršku djelomičnim preuzimanjima. Klijent može zatražiti samo dio datoteke, umjesto da traži cijelu datoteku.<br/>
<br/>
RFC 2616 je pomalo dvosmislen kada su u pitanju zaglavlja "Range". Prije svega, uvodi zaglavlje "Accept-Ranges", koje poslužitelj može koristiti za signaliziranje da podržava zaglavlje "Range". Dalje, stoji da klijent svejedno može poslati zahtjev koristeći zaglavlje "Range", čak i ako poslužitelj ne\\'oglašava podršku za to. Poslužitelj također ima opciju slanja "Accept-Ranges: none" kako bi eksplicitno naveo da ne podržava ovu vrstu zaglavlja.<br/>
<br/>
Dakle, u čemu je problem\\'? Ispada da se različiti HTTP klijenti malo drugačije bave zaglavljima "Range". Konkretno, iOS Podcast klijent zahtijeva podršku za zaglavlje Range i preuzet će samo dijelove datoteke ako nisu podržani. Apple je nedavno obavijestio iTunes izdavače o ovom problemu i zahtijeva da se sadržaj nalazi na poslužiteljima koji podržavaju zaglavlje Range.<br/>
<br/>
Za poslužitelj to obično nije problem, zar\\'ne bi bilo nedavnog Apache DoS napada koji je prouzročio blokiranje Range zahtjeva.<br/>
<br/>
Raspon se koristi u zahtjevu za traženje određenog raspona (ili raspona) bajtova. Content-Range se koristi u odgovoru, za označavanje koje vam bajtove poslužitelj daje (koji se mogu razlikovati od raspona koji ste tražili), kao i koliko je dug cijeli sadržaj (ako je poznat).<br/><br/><strong>Preporuke: </strong><br/>Onemogućeno';

$_['about_proxy']                              = '<strong>httpoxy</strong> je skup ranjivosti koje utječu na kod aplikacije koji se izvodi u CGI ili okruženjima sličnim CGI. Svodi se na jednostavan sukob imenskog prostora:
<ul>
    <li>RFC 3875 (CGI) stavlja HTTP proxy zaglavlje iz zahtjeva u varijable okruženja kao HTTP_PROXY</li>
    <li>HTTP_PROXY je popularna varijabla okruženja koja se koristi za konfiguriranje odlaznog proxyja</li>
</ul>
To dovodi do ranjivosti koja se može daljinski iskoristiti. Ako koristite PHP ili CGI, trebali biste blokirati proxy zaglavlje. Evo kako.
<br/><br/>
<strong>httpoxy</strong> je ranjivost za web aplikacije na strani poslužitelja. Ako ne implementirate kod, ne morate se brinuti.
Što se može dogoditi ako je moja web aplikacija ranjiva?
<br/><br/>
Ako ranjivi HTTP klijent uspostavi odlaznu HTTP vezu dok radi u CGI aplikaciji na strani poslužitelja, napadač bi mogao:
<ul>
    <li>Proxy odlazne HTTP zahtjeve koje je napravila web aplikacija</li>
    <li>Usmjeriti poslužitelj da otvori odlazne veze na adresu i port po vlastitom izboru</li>
    <li>Vežite resurse poslužitelja prisiljavajući ranjivi softver da koristi zlonamjerni proxy</li>
</ul>
<strong>httpoxy</strong> iznimno je lako iskoristiti u osnovnom obliku. I očekujemo da će ga istraživači sigurnosti moći brzo skenirati. Srećom, ako nastavite čitati i ustanovite da ste pogođeni, dostupna su jednostavna ublažavanja.<br/>
Nije li ovo stara vijest? Je li to još uvijek problem?
<br/><br/>
<strong>httpoxy</strong> otkriven je sredinom 2016. Ako sada prvi put čitate o tome, vjerojatno se možete opustiti i odvojiti vrijeme za čitanje o ovom neobičnom povijesnom bugu za koji se nadamo da više ne utječe na aplikacije koje održavate. Ali trebali biste to provjeriti na vlastito zadovoljstvo.
<br/><br/>
Sadržaj ispod ove točke odražava izvornu objavu i ostavit ću web-mjesto otvoreno i uglavnom nepromijenjeno, osim što ću navesti verzije popravka gdje mogu. Pretpostavljam da samo kažem: vrijeme za hitnost bilo je prošle godine.<br/><br/><strong>Preporuke: </strong><br/>Onemogućeno';

$_['about_Feature_Policy']                      = 'HTTP Feature-Policy zaglavlje pruža mehanizam za dopuštanje i onemogućavanje korištenja značajki preglednika u vlastitom okviru i u sadržaju unutar bilo kojeg "iframe" elementa u dokumentu.<br/><br/>Pravila značajki se stvaraju kako bi se vlasnicima stranica omogućilo da omoguće i onemoguće određene značajke web platforme na svojim stranicama i stranicama koje ugrađuju. Mogućnost ograničavanja značajki koje vaša web-lokacija može koristiti je stvarno lijepa, ali mogućnost ograničavanja značajki koje web-lokacije koje ugradite mogu koristiti još je bolja zaštita.<br/><br/>Dostavljanje pravila o značajkama putem HTTP zaglavlja odgovora jednako je jednostavno kao i izdavanje drugih raznih sigurnosnih zaglavlja koja su nam dostupna. Jednostavno trebate odlučiti o ograničenjima koja\\' želite postaviti na svoju stranicu i izgraditi pravila za povratak.<br/><strong>Direktive</strong>
<br/>
<i>senzor-ambijentalnog-svjetla</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno prikupljanje informacija o količini svjetla u okruženju oko uređaja putem sučelja AmbientLightSensor.</p>
<i>automatska reprodukcija</i>
<p>Kontrolira je li trenutnom dokumentu dopuštena automatska reprodukcija medija zatraženih putem sučelja HTMLMediaElement. Kada je ovo pravilo omogućeno i nije bilo gesta korisnika, obećanje koje vraća HTMLMediaElement.play() odbacit će se uz DOMException. Atribut automatske reprodukcije na elementima <i>audio</i> i <i>video</i> bit će zanemaren.</p>
<i>akcelerometar</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno prikupljanje informacija o ubrzanju uređaja putem sučelja mjerača ubrzanja.</p>
<i>baterija</i>
<p>Kontrolira je li dopuštena upotreba Battery Status API-ja. Kada je ovo pravilo omogućeno, obećanje koje vraća Navigator.getBattery() odbacit će se s NotAllowedError DOMException.</p>
<i>kamera</i>
<p>Kontrolira je li trenutnom dokumentu dopuštena upotreba video ulaznih uređaja. Kada je ovo pravilo omogućeno, obećanje koje vraća getUserMedia() će odbiti s NotAllowedError DOMException.</p>
<i>display-capture</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno korištenje metode getDisplayMedia() za snimanje sadržaja zaslona. Kada je ovo pravilo omogućeno, obećanje koje vraća getDisplayMedia() odbacit će se s NotAllowedError ako se ne dobije dopuštenje za snimanje sadržaja display\\'s.</p>
<i>domena-dokumenta</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno postaviti document.domain. Kada je ovo pravilo omogućeno, pokušaj postavljanja document.domain neće uspjeti i uzrokovati izbacivanje SecurityError DOMException.</p>
<i>kriptirani-medij</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno korištenje API-ja proširenja šifriranih medija (EME). Kada je ovo pravilo omogućeno, obećanje koje vraća Navigator.requestMediaKeySystemAccess() će odbiti uz DOMException.</p>
<i>izvršenje-dok-nije-renderirano</i>
<p>Kontrolira trebaju li se zadaci izvršavati u okvirima dok\\'se ne prikazuju (npr. ako je iframe skriven ili prikazan: ništa).</p>
<i>izvršenje-izvan okvira za prikaz</i>
<p>Kontrolira trebaju li se zadaci izvršavati u okvirima dok su\\'izvan vidljivog okvira za prikaz.</p>
<i>cijeli zaslon</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno koristiti Element.requestFullScreen(). Kada je ovo pravilo omogućeno, vraćeni Promise odbija se s TypeError DOMException.</p>
<i>geolokacija</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno koristiti Geolocation Interface. Kada je ovo pravilo omogućeno, pozivi getCurrentPosition() i watchPosition() uzrokovat će pozivanje tih povratnih poziva funkcije\\' s kodom PositionError PERMISSION_DENIED.</p>
<i>žiroskop</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno prikupljanje informacija o orijentaciji uređaja putem sučelja žiroskopa.</p>
<i>magnetometar</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno prikupljanje informacija o orijentaciji uređaja putem sučelja magnetometra.</p>
<i>mikrofon</i>
<p>Kontrolira je li trenutnom dokumentu dopuštena upotreba audio ulaznih uređaja. Kada je ovo pravilo omogućeno, obećanje koje vraća MediaDevices.getUserMedia() odbacit će se s NotAllowedError.</p>
<i>midi</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno koristiti Web MIDI API. Kada je ovo pravilo omogućeno, obećanje koje vraća Navigator.requestMIDIAccess() će odbiti s DOMException.</p>
<i>plaćanje</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno koristiti API zahtjeva za plaćanje. Kada je ovo pravilo omogućeno, konstruktor PaymentRequest() izbacit će SecurityError DOMException.</p>
<i>slika u slici</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno reproducirati video u načinu slike u slici putem odgovarajućeg API-ja.</p>
<i>publickey-vjerodajnice</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno koristiti API za web autentifikaciju za stvaranje, pohranjivanje i dohvaćanje vjerodajnica javnog ključa.</p>
<i>zvučnik</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno reproducirati zvuk putem bilo koje metode.</p>
<i>sync-xhr</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno slanje sinkronih XMLHttpRequest zahtjeva.</p>
<i>usb</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno koristiti WebUSB API.</p>
<i>wake-lock</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno koristiti Wake Lock API za označavanje da uređaj ne bi trebao ući u način rada za uštedu energije.</p>
<i>vr</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno koristiti WebVR API. Kada je ovo pravilo omogućeno, obećanje koje vraća Navigator.getVRDisplays() odbacit će se uz DOMException. Imajte na umu da je WebVR standard u procesu zamjene s WebXR.</p>
<i>xr-spatial-tracking</i>
<p>Kontrolira je li trenutnom dokumentu dopušteno koristiti WebXR Device API za interakciju s WebXR sesijom. </p><br/>';


// Warning Info - Notes
$_['warning_Strict_Transport_Security']         = "<strong>Napomena:</strong><br/>Preglednik zanemaruje zaglavlje <strong>Strict-Transport-Security</strong> kada se vašoj stranici pristupa putem HTTP-a; to je zato što napadač može presresti HTTP veze i ubaciti zaglavlje ili ga ukloniti. Kada se vašem web-mjestu pristupa preko HTTPS-a bez grešaka certifikata, preglednik zna da vaše web-mjesto podržava HTTPS i poštovat će zaglavlje <strong>Strict-Transport-Security</strong>.";

$_['warning_Expect_CT']                         = '<strong>Napomena:</strong><br/>Kada web mjesto omogući <strong>Expect-CT</strong> zaglavlje, zahtijeva da preglednik provjeri pojavljuje li se bilo koji certifikat za to mjesto u javnim CT zapisnicima.<br/>
<br/>
Preglednici ignoriraju zaglavlje <strong>Expect-CT</strong> kada se šalje preko HTTP-a, zaglavlje ima učinak samo na HTTPS veze.';

$_['warning_Referrer_Policy']                   = "<strong>Napomena:</strong><br/>Originalni naziv zaglavlja <strong>Referer</strong> pogrešno je napisana riječ \\"referrer\\". Zaglavlje <strong>Referrer-Policy</strong> ne dijeli ovu pravopisnu pogrešku.";

$_['warning_X_Content_Type_Options']            = "<strong>Napomena:</strong><br/>X-Content-Type-Options samo primjenjuje blokiranje zahtjeva zbog nosniffa za odredišta zahtjeva \\"script\\" i \\"style\\". Međutim, također omogućuje Cross-Origin Read Blocking (CORB) za HTML, TXT, JSON i XML datoteke (isključujući SVG image/svg+xml).";

$_['warning_X_Frame_Options']                   = "<strong>Napomena:</strong><br/>HTTP zaglavlje Content-Security-Policy ima direktivu frame-ancestors koja zastarijeva ovo zaglavlje za podršku preglednicima.";

$_['warning_X_XSS_Protection']                  = '<strong>Napomena:</strong>
<ul>
<li>Chrome ima "Namjeru obustaviti i ukloniti XSS revizor"</li>
<li>Firefox nije i neće implementirati X-XSS-Protection</li>
<li>Edge je povukao svoj XSS filtar</li>
</ul>
<br/>To znači da ako ne trebate podržavati naslijeđene preglednike, preporučuje se da umjesto toga koristite Content-Security-Policy bez dopuštanja nesigurnih inline skripti.';

// Legends
$_['legend_extension']                          = "O proširenju";
$_['legend_X_Powered_By']                       = "X-Powered-By";
$_['legend_X_HTTP_Method_Override']             = "X-HTTP-Nadjačavanje metode";
$_['legend_proxy']                              = "HTTP proxy - (HTTPoxy)";
$_['legend_forward']                            = "HTTP prosljeđivanja";
$_['legend_ranges']                             = "HTTP rasponi";
$_['legend_X_XSS_Protection']                   = "X-XSS-Zaštita";
$_['legend_X_Frame_Options']                    = "X-Frame-Opcije";
$_['legend_X_Content_Type_Options']             = "X-Content-Type-Options";
$_['legend_Referrer_Policy']                    = "Politika preporuke";
$_['legend_Content_Security_Policy']            = "Sadržaj-Sigurnosna-Politika";
$_['legend_Strict_Transport_Security']          = "Stroga-transportna-sigurnost";
$_['legend_Expect_CT']                          = "Očekivati-CT";
$_['legend_Feature_Policy']                     = "Politika značajki";

// Feature Policies
$_['type_accelerometer']			= "Akcelerometar";
$_['type_ambient_light_sensor']			= "Senzor ambijentalnog svjetla";
$_['type_autoplay']				= "Automatska reprodukcija";
$_['type_camera']				= "Fotoaparat";
$_['type_fullscreen']				= "Cijeli zaslon";
$_['type_display_capture']			= "Prikaz snimanja";
$_['type_document_domain']			= "Domena dokumenta";
$_['type_encrypted_media']			= "Šifrirani mediji";
$_['type_geolocation']				= "Geolokacija";
$_['type_gyroscope']				= "Žiroskop";
$_['type_layout_animations']			= "Animacije izgleda";
$_['type_legacy_image_format']			= "Naslijeđeni format slike";
$_['type_magnetometer']				= "Magnetometar";
$_['type_microphone']				= "Mikrofon";
$_['type_midi']					= "Midi";
$_['type_oversized_images']			= "Predimenzionirane slike";
$_['type_payment']				= "Plaćanje";
$_['type_picture_in_picture']			= "Slika u slici";
$_['type_speaker']				= "Zvučnik";
$_['type_sync_xhr']				= "Sinkronizacija xhr";
$_['type_unoptimized_images']			= "Neoptimizirane slike";
$_['type_unsized_media']			= "Mediji bez veličine";
$_['type_usb']					= "USB";
$_['type_vr']					= "Vr";
$_['type_vibrate']				= "Vibrirati";
$_['type_webauthn']				= "Webauthn";

// Help Tooltip Feature Policies
$_['help_accelerometer']			= "Kontrolira je li trenutnom dokumentu dopušteno prikupljanje informacija o ubrzanju uređaja putem sučelja mjerača ubrzanja.";
$_['help_ambient_light_sensor']			= "Kontrolira je li trenutnom dokumentu dopušteno prikupljanje informacija o količini svjetla u okruženju oko uređaja putem sučelja AmbientLightSensor.";
$_['help_autoplay']				= "Kontrolira je li trenutnom dokumentu dopuštena automatska reprodukcija medija zatraženih putem sučelja HTMLMediaElement. Kada je ovo pravilo omogućeno i nije bilo gesta korisnika, obećanje koje vraća HTMLMediaElement.play() odbacit će se uz DOMException. Atribut automatske reprodukcije na elementima \\"audio\\" i \\"video\\" bit će zanemaren.";
$_['help_camera']				= "Kontrolira je li trenutnom dokumentu dopuštena upotreba video ulaznih uređaja. Kada je ovo pravilo omogućeno, obećanje koje vraća getUserMedia() odbacit će se uz NotAllowedError DOMException.";
$_['help_fullscreen']				= "Kontrolira smije li trenutni dokument koristiti Element.requestFullScreen(). Kada je ovo pravilo omogućeno, vraćeni Promise odbija se uz TypeError DOMException.";
$_['help_display_capture']			= "Kontrolira je li trenutnom dokumentu dopušteno korištenje metode getDisplayMedia() za snimanje sadržaja zaslona. Kada je ovo pravilo omogućeno, obećanje koje vraća getDisplayMedia() odbacit će se s NotAllowedError ako se ne dobije dopuštenje za snimanje sadržaja zaslona.";
$_['help_document_domain']			= "Kontrolira je li trenutnom dokumentu dopušteno postaviti document.domain. Kada je ovo pravilo omogućeno, pokušaj postavljanja document.domain neće uspjeti i uzrokovati izbacivanje SecurityError DOMException.";
$_['help_encrypted_media']			= "Kontrolira je li trenutnom dokumentu dopušteno korištenje API-ja proširenja šifriranih medija (EME). Kada je ovo pravilo omogućeno, obećanje koje vraća Navigator.requestMediaKeySystemAccess() će odbiti uz DOMException.";
$_['help_geolocation']				= "Kontrolira je li trenutnom dokumentu dopušteno koristiti Geolocation Interface. Kada je ovo pravilo omogućeno, pozivi getCurrentPosition() i watchPosition() uzrokovat će pozivanje povratnih poziva tih funkcija s kodom PositionError PERMISSION_DENIED.";
$_['help_gyroscope']				= "Kontrolira je li trenutnom dokumentu dopušteno prikupljanje informacija o orijentaciji uređaja putem sučelja Gyroscope.";
$_['help_layout_animations']			= "HTTP Feature-Policy zaglavlje layout-animations direktiva kontrolira je li trenutnom dokumentu dopušteno prikazivati ​​animacije izgleda.";
$_['help_legacy_image_format']			= "Direktiva HTTP Feature-Policy zaglavlja legacy-image-formats kontrolira je li trenutnom dokumentu dopušteno prikazivati ​​slike u naslijeđenim formatima.";
$_['help_magnetometer']				= "Kontrolira je li trenutnom dokumentu dopušteno prikupljanje informacija o orijentaciji uređaja putem sučelja magnetometra.";
$_['help_microphone']				= "Kontrolira je li trenutnom dokumentu dopuštena upotreba audio ulaznih uređaja. Kada je ovo pravilo omogućeno, obećanje koje vraća MediaDevices.getUserMedia() odbit će s NotAllowedError.";
$_['help_midi']					= "Kontrolira je li trenutnom dokumentu dopušteno koristiti Web MIDI API. Kada je ovo pravilo omogućeno, obećanje koje vraća Navigator.requestMIDIAccess() će odbiti uz DOMException.";
$_['help_oversized_images']			= "HTTP Feature-Policy zaglavlje oversized-images direktiva kontrolira je li trenutnom dokumentu dopušteno preuzimanje i prikaz velikih slika.";
$_['help_payment']				= "Kontrolira je li trenutnom dokumentu dopušteno koristiti API zahtjeva za plaćanje. Kada je ovo pravilo omogućeno, konstruktor PaymentRequest() izbacit će iznimku SecurityError DOMException.";
$_['help_picture_in_picture']			= "Kontrolira smije li trenutačni dokument reproducirati videozapis u načinu slike u slici putem odgovarajućeg API-ja.";
$_['help_speaker']				= "Kontrolira je li trenutnom dokumentu dopušteno reproducirati zvuk putem bilo koje metode.";
$_['help_sync_xhr']				= "Kontrolira je li trenutnom dokumentu dopušteno slanje sinkronih XMLHttpRequest zahtjeva.";
$_['help_unoptimized_images']			= "HTTP Feature-Policy zaglavlje unoptimized-images direktiva kontrolira je li trenutnom dokumentu dopušteno preuzimanje i prikaz neoptimiziranih slika.";
$_['help_unsized_media']			= "HTTP Feature-Policy zaglavlje unsized-media direktiva kontrolira je li trenutnom dokumentu dopušteno mijenjati veličinu medijskih elemenata nakon završetka početnog izgleda. Ovo ograničenje rješava problem \\"nestabilnosti izgleda\\" uzrokovan pružanjem zadanih dimenzija za slike čija veličina nije unaprijed navedena tako da slika ne mijenja veličinu nakon učitavanja.";
$_['help_usb']					= "Kontrolira smije li trenutni dokument koristiti WebUSB API.";
$_['help_vr']					= "Kontrolira je li trenutnom dokumentu dopušteno koristiti WebVR API. Kada je ovo pravilo omogućeno, obećanje koje vraća Navigator.getVRDisplays() odbacit će se uz DOMException. Imajte na umu da je WebVR standard u procesu zamjene s WebXR.";
$_['help_vibrate']				= "HTTP Feature-Policy zaglavlje vibrate direktiva kontrolira smije li trenutni dokument pokretati vibracije uređaja putem Vibration API-ja.";
$_['help_webauthn']				= "Direktiva publickey-credentials zaglavlja HTTP Feature-Policy kontrolira je li trenutnom dokumentu dopušten pristup API-ju Web Authentcation, tj. putem navigator.credentials.create({publicKey: ...,...}) i navigator.credentials.get({publicKey: ...,...}). Kada je ovo pravilo omogućeno, svaki pokušaj stvaranja vjerodajnica javnog ključa ili upita za njih rezultirat će pogreškom.";

// Error
$_['error_permission']                          = "Upozorenje: Nemate dozvolu za izmjenu Opencart sigurnosnih zaglavlja!";
$_['error_expect_ct_report_uri']                = "Upozorenje: <strong>Expect-CT</strong> Report-Uri je prazan. Preporuka: https://report-uri.cloudflare.com/cdn-cgi/beacon/expect-ct";
$_['error_data']                                = "Upozorenje: Pažljivo provjerite obrazac za pogreške!";
