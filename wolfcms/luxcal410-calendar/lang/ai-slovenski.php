<?php
/*
= LuxCal event calendar admin interface language file =

This file has been produced by LuxSoft and has been translated by David.

© Copyright 2009-2014 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//LuxCal ui language file version
define("LAI","4.1.0");

/* -- Admin Interface texts -- */

$ax = array(

//general
"none" => "Brez",
"all" => "Vse",
"back" => "Nazaj",
"close" => "Zapri",
"always" => "vedno",
"at_time" => "@", //date and time separator (e.g. 11-09-2014 @ 10:45)
"year" => "Leto",
"month" => "Mesec",
"week_day" => "teden/dan",
"upcoming" => "Prihodnje",

//settings.php - fieldset headers + general
"set_general_settings" => "Splošne nastavitve",
"set_navbar_settings" => "Navigacijska vrstica",
"set_event_settings" => "Dogodki",
"set_user_settings" => "Uporabniški računi",
"set_email_settings" => "Nastavitve spletne pošte",
"set_perfun_settings" => "Periodic Functions<br>(only relevant if cron job defined)",
"set_minical_settings" => "Mini koledar<br>(pomebno samo če v uporabi)",
"set_sidebar_settings" => "Stand-Alone Sidebar<br>(only relevant if in use)",
"set_view_settings" => "Pogledi",
"set_dt_settings" => "Datumi / časi",
"set_save_settings" => "Shrani nastavitve",
"set_test_mail" => "Test Mail",
"set_mail_sent_to" => "Test mail sent to",
"set_mail_sent_from" => "This test mail was sent from your calendar's Settings page",
"set_missing_invalid" => "mankajoče ali neveljanvne nastavitve (background highlighted)",
"set_settings_saved" => "Nastavitve koledarja shranjene",
"set_save_error" => "Napaka v podatkovni bazi- nastavitve koledarja niso shranjene",
"hover_for_details" => "Za več informacij pojdite z miško nad element",
"default" => "privzeto",
"enabled" => "vključeno",
"disabled" => "izključeno",
"no" => "ne",
"yes" => "da",
"or" => "ali",
"minutes" => "minute",
"pixels" => "slikovnih pik",
"no_way" => "Nimate pooblastil za izvedbo tega dejanja!",

//settings.php - general settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"calVersionDb_label" => "Verzija koledarja",
"calVersionDb_text" => "Verzija nameščene programske opreme za koledar.",
"calTitle_label" => "Naslov koledarja.",
"calTitle_text" => "Prikazan v zgornji vrstici pri koledarju in uporabljen v email obveščanjih.",
"calUrl_label" => "URL koledarja",
"calUrl_text" => "Spletna stran koledarja",
"calEmail_label" => "Spletna pošta koledarja",
"calEmail_text" => "Naslov spletne pošte, ki je uporabljen za prejemanje in pošiljanje obvestil preko spletne pošte.<br>Format: \'email\' or \'ime&#8249;email&#8250;\'.",
"backLinkUrl_label" => "Povezava do starševske strani",
"backLinkUrl_text" => "URL do starševske strani. Ob navedni se bo prikazal na levi strani navigacijske vrstice gumb za nazaj, kateri je povezan na ta URL.<br>Na primer, za povezavo nazaj do starševske strani, s katere je bil koledar začet.",
"timeZone_label" => "Časovni pas",
"timeZone_text" => "Koledarjev časovni pas, uporabljen za izračun trenutnega časa.",
"see" => "poglej",
"notifSender_label" => "Pošiljatelj obveščevalne spletne pošte",
"notifSender_text" => "Ko opomnik pošlje obveščevalno spletno pošto, lahko pošiljateljevo polje vsebuje koledarjevo spletno pošto ali pa spletno pošto uporabnika, ki je ustvaril dogodek.<br>V primeru naslova uporabnikove spletne pošte, prejemnik lahko odgovori na pošto.",
"rssFeed_label" => "RSS povezave",
"rssFeed_text" => "Če je vključeno: Za uporabnike z namanj \'view\' pravicami, bojo RSS povezave vidne v nogi koledarja in RSS povezava bo dodana v HTML glavo koledarjevih strani.",
"calendar" => "koledar",
"user" => "uporabnik",
"php_mail" => "PHP pošta",
"smtp_mail" => "SMTP pošta",

//settings.php - navigation bar settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"navButText_label" => "Gumbi v navigacijski vrstici z tekstom",
"navButText_text" => "Če vključeno: Gumbi bodo v navigacijski vrstici prikazani z tekstom. Če izključeno: Gumbi bodo prikazani z ikonami.",
"sideLists_label" => "Todo / Upcoming buttons",
"sideLists_text" => "Če vključeno: If enabled: ZaNarediti / Prihajajoči gumb bo prikazan v navigacijski vrstici, kateri bo, če bo izbran, odprl spisek za ToDo / Prihajajoči.",
"navTodoList_label" => "Todo gumb",
"navUpcoList_label" => "Gumb Prihajajoči dogodki",
"optionsPanel_label" => "Možnosi oznaka",
"optionsPanel_text" => "Vključi/izključi menije v kontrolni plošči.<br>• The calendar menu is available to the admin to switch calendars. (enabling only useful if several calendars are installed)<br>• Uporabniški filter je lahko uporabljen za prikazovanje samo tistih dogodkov, ki so narejeni od enega specifičnega uporabnika.<br>• Filter za kategorije je lahko uporabljen za prikazovanje samo tistih dogodkov, ki spadajo v specifično kategorijo<br>• Meni za izbiranje jezika je lahko uporabljen za izbiranje jezika za uporabniški vmesnik.(Vključenje te možnosti je samo takrat koristno, ko je nameščenih več jezikov)",
"calMenu_label" => "calendar",
"userMenu_label" => "Uporabniški filter",
"catMenu_label" => "Filter za kategorije",
"langMenu_label" => "Izbira jezika",
"defaultView_label" => "Privzeti pogled ob zagonu",
"defaultView_text" => "Možni privzeti pogledi ob zagonu koledarja so:<br>- Leto<br>- Polni mesec<br>- Delovni mesec *)<br>- Polni teden<br>- Delovni teden*)<br>- Dan<br>- Prihajajoči<br>- Spremembe<br>*) Za dneve v delovnem tednu poglejte v: Pogledi - Dnevi v delovnem tednu<br>Priporočena izbira: Mesec ali Prihajajoči",
"language_label" => "Privzeti jezik uporabniškega vmesnika",
"language_text" => "Datoteke ui-{language}.php, ai-{language}.php, ug-{language}.php in ug-layout.png morajo biti prisotne v lang/ mapi. {language} = izbran jezik uporabniškega vmesnika. Imena datotek morajo biti zapisane z malimi črkami!",

//settings.php - events settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"privEvents_label" => "Pisanje osebnih dogodkov",
"privEvents_text" => "Osebni dogodki so vidni samo uporabniku, ki je vnesel dogodek.<br>Vključeno: uporabniki lahko izbirajo zasebne dogodke.<br>Privzeto: ob dodajanju novih dogodkov, bo po privzetem \'private\' izbirno polje v oknu dogodkov izbrano.<br>Vedno: ob dodajnaju novih dogodkov bodo vedno zasebni, \'private\' izbirno polje v oknu dogodkov ne bo prikazano.",
"details4All_label" => "Pokaži podrobnosti o dogodkih",
"details4All_text" => "Izključeno: podrobnosti dogodka bodo samo prikazane lastnikom dogodka in uporabnikom z \'post all\' pravicami.<br>Vključeno: podrobnosti dogodka bodo vidne lastniku dogodka in vsem drugim uporabnikom.<br>Prijavljen: podrobnosti dogodka bodo vidne lastniku dogodka in prijavljenim uporabnikom.",
"evtDelButton_label" => "Prikaži gumb za izbris v oknu dogodkov",
"evtDelButton_text" => "Izključeno: gumb za izbris ne bo viden v oknu dogodkov. Zato uporabniki s pravicami za spreminjanje ne bodo mogli brisati dogodkov.<br>Vključeno:  gumb za izbris v okdnu dogodkov bo viden vsem uporabnikom.<br>Upravitelj: gumb za izbris v oknu dogodkov bo viden samo uporabikom z \'manager\' pravicami.",
"eventColor_label" => "Dogodki osnovani na barvah",
"eventColor_text" => "Dogodki v različnih koledarskih pogledih so lahko prikazani z barvami, ki jih je dodelil ustvarjatelj dogodka ali barvo kategorije dogodka.",
"xField1_label" => "Oznaka za dodatno polje 1",
"xField2_label" => "Oznaka za dodatno polje 2",
"xFieldx_text" => "Ime neobveznega tekstovnega polja. Če je to polje dodano v dogodkovno predlogo hereafter, bo polje dodano kot tekstovna datoteka v prostem formatu v obrazec okna dogodkov in v dogodke, ki so prikazani v vseh pogledih koledarja in straneh.<br>Navedeno ime je lahko dolgo največ 15 znakov.",
"logged_in" => 'prijavljen',
"manager_only" => 'upravnik',
"user_group" => "user group",
"event_cat" => "kategorije dogodka",

//settings.php - user accounts settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"selfReg_label" => "Registriranje sebe",
"selfReg_text" => "Omogoča uporabnikom, da se registrirajo sami, za dostop do koledarja.",
"selfRegGrp_label" => "Self registration user group",
"selfRegGrp_text" => "User group to which self-registered users will be assigned.",
"selfRegNot_label" => "Obvestilo ob registriranju samega sebe",
"selfRegNot_text" => "Pošlje obveščevalno pošto na koledarjev email, če je registracija samega sebe pri uporabniku izvedena",
"restLastSel_label" => "Obnovi izbire zadnjega uporabnika",
"restLastSel_text" => "Seja zadnjega uporabnika (plošča nastavitev možnosti) bo shranjena in ko se uporabnik kaasneje vrne k koledarju, bodo nastavitve povrnjene.",
"cookieExp_label" => "'Zapomni se me' število dni preden poteče piškotek",
"cookieExp_text" => "število dni preden poteče piškotek ki je nastavljen pri \'Zapomni se me\' možnosti (možnost med vpisom).",
"view" => "pogled",
"post_own" => 'objavljaj/spreminjaj svoje',
"post_all" => 'objavljaj/spreminjajo vse',
"manager" => 'objavljaj/upravitelj',

//settings.php - view settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"evtTemplGen_label" => "Predloga dogodka - splošni pogledi",
"evtTemplGen_text" => "Polja dogodkov ki so prikazana v različnih koledarjevih pogledih so lahko določena s pomočjo niza števil.<br> Če je številka določena v nizu, bo priakzano ustrezno polje.",
"evtTemplUpc_label" => "Predloga dogodka - prihajajoči pogled",
"evtTemplUpc_text" => "Polja dogodka za prikaz v pogledu prihajajočih dogodkih so lahko določena z nizom števil.<br>Če je določena številka v nizu, bo prikazano ustrezno polje.",
"popBoxFields_label" => "Polja lebdečega okna (okno ki se prikaže ob premiku miške na tekst/gumb)",
"popBoxFields_text" => "Polja dogodka za prikaz v lebdečem oknu so lahko določena z nizom števil.<br>Če je določena številka v nizu, bo prikazano ustrezno polje.<br>Če ni določeno nobeno polje, lebdeče okno ne bo prikazano.",
"templFields_text" => "Pomen števil:<br>1: Polje kraja<br>2: Kategorija dogodka field<br>3: Polje opisa<br>4: Dodatno polje 1 (poglej spodaj)<br>5: Dodatno polje 2 (poglej spodaj)<br>6: Podatki opominjanja spletne pošte (samo če je bilo opomnenje zahtevanoo)<br>7: Datum/čas dodano/spremenjeno in povezan(i) uporabnik(i).<br>Zaporedje števil določa zaporedje zaporedje prikazanih polj.",
"popBoxShow_label" => "Lebdeče okno s podrobnosti o dogodku",
"popBoxShow_text" => "Če vključeno, okno s podrobnosti o dogodku bo prikazano ob premiku z miško nad dogodek v izbranih pogledih. Podrobnosti dogodka ne bodo prikazani če ni bilo določeno nobeno lebdeče okno s polji dogodka(poglej spodaj).",
"yearStart_label" => "Začni mesec v letnem pogledu",
"yearStart_text" => "Če je bil začeten mesec določen (1-12), se bo koledar v letnem pogledu zmeraj začel s tem mesecem in leto tega prvega meseca se bo samo spremenilo ob prvem dnevu istega meseca v drugem letu.<br>Vrednost 0 ima poseben pomen: začetni mesec je osnovan na trenutnem datumu in bo padel v prvo vrstico mesecev.",
"colsToShow_label" => "Stolpci za prikaz v letnem pogledu",
"colsToShow_text" => "Število mesecev za prikaz v vsaki vrstici v letnem pogledu<br>Priporočena izbira: 3 ali 4.",
"rowsToShow_label" => "Vrstice za prikaz v letnem pogledu",
"rowsToShow_text" => "Število vrstic od štirih mesecev, vsak za prikaz v letnem pogledu.<br>Priporočena izbira: 4, kar vam da 16 mesecev.",
"weeksToShow_label" => "Število tednov za prikaz v mesečnem pogledu",
"weeksToShow_text" => "Število tednov za prikaz v mesečnem pogledu.<br>Priporočena izbira: 10, kar vam da 2.5 meseca za premikanje čez.<br>Vrednost 0 in 1 imata posebni pomen:<br>0: prikaži točno 1 mesec - prazni vodilni in sledeči dnevi.<br>1: prikaži točno 1 mesec - prikaži dogodke na vodilne in sledeče dneve.",
"workWeekDays_label" => "Dnevi v delovnem tednu",
"workWeekDays_text" => "Dnevi ki bodo prikazani v vsakem tednu v pogledu delovnega meseca in pogledu delovnega tedna.<br>Vnesi število vsakega dneva ki bi moral biti viden. Veljavna števila dnevov:<br>1 = Ponedeljek<br>2 = Torek<br>....<br>7 = Nedelja<br>e.g. 12345 : Ponedeljek- petek",
"lookaheadDays_label" => "Dnevi za vpogled naprej",
"lookaheadDays_text" => "Število dni za vpogled naprej za dogodke v pogledu Prihajajoči dogodki,Todo spisku, in RSS pretoka.",
"dwStartHour_label" => "Začetna ura v pogledu dneva/tedna.",
"dwStartHour_text" => "Ura ob ob kateri se dogodki ob normalnem dnevu začnejo.<br>Npr., ob nastavitvi te vrednosti na 6 se izognemo izgubljanju prostora v pogledu dneva/tedna za tihi čas med polnočjo in 6:00.<br>Izbiralec časa,uporabljen za vnos časa, se bo tudi začelo ob tej uri.",
"dwEndHour_label" => "Ura za konec v pogledu dneva/tedna",
"dwEndHour_text" => "Ura ob kateri se normalni dan dogodkov konča.<br>Npr, ob nastavitvi te ure na 18 se izognemo izgubljanju prostora v pogledu tedna/dneva za tihi čas me 18:00 in polnočjo.<br>Izbiralec časa, uporabljen za vnos časa, se bo tudi končalo ob tej uri.",
"dwTimeSlot_label" => "Okno časa v pogledu dan/tedeni",
"dwTimeSlot_text" => "Število minut za okno časa v pogledu dan/teden.<br>Ta vrednost bo skupaj z začetno uro in knočno uro (poglej navzgor) določala število vrstic v pogledu dan/teden.",
"dwTsHeight_label" => "Višina okna časa",
"dwTsHeight_text" => "Število slikovnih pik za časovno okno v pogledu dan/teden.",
"showLinkInMV_label" => "Pokaži povezave v pogledu meseca",
"showLinkInMV_text" => "Prikaži URL naslove v opisu dogodka kot hiperpovezave v različnih pogledih.",
"monthInDCell_label" => "Mesec v vsaki celici dneva",
"monthInDCell_text" => "Prikaži v pogledu meseca 3-črkovno ime meseca za vsak dan",

//settings.php - date/time settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"dateFormat_label" => "Format dneva dogodka (dd mm yyyy)",
"dateFormat_text" => "Besedilni niz, ki definira format datumov dogodkov v pogledih koledarja in vbosnih poljih.<br>Možne črke: y = leto, m = mesec in d = dan.<br>Ne-alfanumerični znaki so lahko uporabljeni kot ločilniki in bodo kopirani dobesedno.<br>Primeri:<br>y-m-d: 2013-10-31<br>m.d.y: 10.31.2013<br>d/m/y: 31/10/2013",
"dateFormat_expl" => "Npr.: y.m.d: 2013.10.31",
"MdFormat_label" => "Format datuma (dd mesec)",
"MdFormat_text" => "Besedilni niz ki definira format datumov ki so sestavljeni z mesecom in dnevom.<br>Možne črke: M = mesec v tekstu, d = dan v številkah.<br>Ne-alfanumerični znaki so lahko uporabljeni kot ločilniki in bodo kopirani dobesedno.<br>Primeri:<br>d M: 12 April<br>M, d: Julij, 14",
"MdFormat_expl" => "Npr. M, d: Julij, 14",
"MdyFormat_label" => "Format datuma (dd mesec yyyy)",
"MdyFormat_text" => "Besedilni niz ki definira format datumov ki so sestavljeni z dnevom, mesecom in letom.<br>Možne črke: d = dan v številkah, M = mesec v tekstu, y = leto v številkah.<br>Ne-alfanumerični znaki so lahko uporabljeni kot ločilniki in bodo kopirani dobesedno.<br>Primeri:<br>d M y: 12 April 2013<br>M d, y: Julij 8, 2013",
"MdyFormat_expl" => "Npr. M d, y: Julij 8, 2013",
"MyFormat_label" => "Format datuma (mesec yyyy)",
"MyFormat_text" => "Besedilni niz ki definira format datumov ki so sestavljeni z mesecom in letom.<br>Možne črke: M = mesec v tekstu, y = leto v številkah.<br>Ne-alfanumerični znaki so lahko uporabljeni kot ločilniki in bodo kopirani dobesedno<br>Primeri:<br>M y: April 2013<br>y - M: 2013 - Julij",
"MyFormat_expl" => "Npr. M y: April 2013",
"DMdFormat_label" => "Format datuma (dan v tednu dd mesec)",
"DMdFormat_text" => "Besedilni niz ki definira format datumov ki so sestavljeni iz tedna, dneva in meseca.<br>Možne črke: wd = dan v tednu v obliki teksta, M = mesec v tekstu, d = dan v številkah.<br>Ne-alfanumerične znaki so lahko uporabljeni kot ločilniki in bodo kopirani dobesedno.<br>Primeri:<br>wd d M: Friday 12 April<br>WD, M d: Monday, Julij 14",
"DMdFormat_expl" => "Npr. wd - M d: Nedelja - April 6",
"DMdyFormat_label" => "Format datuma (dan v tednu dd mesec llll)",
"DMdyFormat_text" => "Besedilni niz ki definira format datumov ki so sestavljeni iz dneva v tednu, dneva, meseca in leta.<br>Možne črke: wd = dan v tednu v obliki teksta, M = mesec v tekstu, d = dan v številkah, l = leto v številkah.<br>Ne-alfanumerični znaki so lahko uporabljeni kot ločilniki in bodo kopirani dobesedno.<br>Primeri:<br>WD d M y: Petek 13 April 2013<br>WD - M d, y: Ponedeljek - Julij 16, 2013",
"DMdyFormat_expl" => "Npr. WD, M d, y: Ponedeljek, Julij 16, 2013",
"timeFormat_label" => "Časovni format (hh mm)",
"timeFormat_text" => "Besedilni niz ki definira format časov pri dogodkih v koledarjevih pogledih in vnosnih poljih.<br>Možne črke: h = ure, H = ure z vodilnimi ničlami, m = minute, a = am/pm (opcijsko), A = AM/PM (opcijsko).<br>Ne-alfanumeričn znaki so lahko uporabljeni kot ločilniki in bodo kopirani dobesedno.<br>Primeri:<br>h:m: 18:35<br>h.m a: 6.35 pm<br>H:mA: 06:35PM",
"timeFormat_expl" => "Npr. h:m: 22:35 in h:mA: 10:35PM",
"weekStart_label" => "Prvi dan v tednu",
"weekStart_text" => "Teden se lahko začne z nedeljo ali ponedeljkom.",
"weekNumber_label" => "Prikaži številke tedna",
"weekNumber_text" => "Prikazovanje številk tedna v letnem, mesečnem in tedenskem pogledu je lahko vključeno ali izključeno",
"time_format_us" => "12-urni AM/PM",
"time_format_eu" => "24-urni",
"sunday" => "Nedelja",
"monday" => "Ponedeljek",
"time_zones" => "Časovni pasovi",
"dd_mm_yyyy" => "dd-mm-yyyy",
"mm_dd_yyyy" => "mm-dd-yyyy",
"yyyy_mm_dd" => "yyyy-mm-dd",

//settings.php - email settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"mailServer_label" => "Poštni strežnik",
"mailServer_text" => "PHP spletna pošta je primerna za nepreverjeno pošto v majhnih številih. Za večje število pošte ali kadar je potrebna preverba, bi morala biti uporabljena SMTP pošta.<br>Uporaba SMTP pošte potrebuje SMTP strežnik. Konfiguracijski parametri za uporabo SMTP strežnika mora biti določeno nadaljno. Če je spletna pošta izključena, bo okno za pošiljanje pošte v oknu dogodka izključeno.",
"smtpServer_label" => "ime SMTP strežnika",
"smtpServer_text" => "Če je SMTP spletna pošta izbrana, mora biti ime SMTP strežnika določeno tukaj. Npr.: SMTP gmail strežnik za spletno pošto: smtp.gmail.com.",
"smtpPort_label" => "Številka SMTP vrat",
"smtpPort_text" => "Če je SMTP pošta izbrana, bi morala SMTP vrata določena tukaj. Npr.: 25, 465 ali 587. Gmail na primer uporablja številko vrat 465.",
"smtpSsl_label" => "SSL (Secure Sockets Layer)",
"smtpSsl_text" => "Če je izbrana SMTP spletna pošta, izberite tukaj če želite SSL imeti vključeno. Za gmail: vključeno",
"smtpAuth_label" => "SMTP avtentikacija",
"smtpAuth_text" => "Če je SMTP avtentikacija izbrana, bosta uporabniško ime in geslo, ki sta podana v nadaljnem, uporabljena pri avtentikaciji SMTP pošte.",
"smtpUser_label" => "SMTP uporabniško ime",
"smtpUser_text" => "Če je SMTP mail izbran, določite tukaj SMTP uporabniško ime. Za gmail je to del vašega naslova pred znakom @.",
"smtpPass_label" => "SMTP geslo",
"smtpPass_text" => "Če je SMTP pošta izbrana, določite tukaj SMTP geslo.",

//settings.php - periodic function settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"cronSummary_label" => "Admin cron job summary",
"cronSummary_text" => "Send a cron job summary to the calendar administrator.<br>Enabling is only useful if a cron job has been activated for the calendar.",
"chgEmailList_label" => "Email destinations for changes",
"chgEmailList_text" => "Destination email addresses periodically receiving an email with calendar changes.<br>Email addresses separated by semicolons.",
"chgNofDays_label" => "Days to look back for changes",
"chgNofDays_text" => "Number of days to look back for the summary of calendar changes.<br>If the number of days is set to 0 or if no cron job is running no summary of changes will be sent.",
"icsExport_label" => "Daily export of iCal events",
"icsExport_text" => "If enabled: All events in the date range -1 week until +1 yesr will be exported in iCalendar format in a .ics file in the \'files\' folder.<br>The file name will be the calendar name with blanks replaced by underscores. Old files will be overwritten by new files.",
"eventExp_label" => "Event expiry days",
"eventExp_text" => "Number of days after the event due date when the event expires and will be automatically deleted.<br>If 0 or if no cron job is running, no events will be automatically deleted.",
"maxNoLogin_label" => "Max. no. of days not logged in",
"maxNoLogin_text" => "If an account hasn\'t logged in for this many days it will be automatically deleted.<br>If this value is set to 0, user accounts will never be deleted.",

//settings.php - mini calendar / sidebar settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"miniCalView_label" => "Mini calendar view",
"miniCalView_text" => "Possible views for the mini calendar are:<br>- Full Month<br>- Work Month *)<br>- Full Week<br>- Work Week *)<br>*) For work week days see on this page: Views - Work week days",
"miniCalPost_label" => "Mini calendar event posting",
"miniCalPost_text" => "If enabled, users can:<br>- post new events in the mini calendar by clicking the top bar of a day cell<br>- edit/delete events by clicking an event square<br>Note: The access rights of the Public User will be applicable.",
"popFieldsMcal_label" => "Event fields - mini calendar hover box",
"popFieldsMcal_text" => "The event fields to be displayed in an overlay when the user hovers an event in the mini calendar can be specified by means of a sequence of numbers.<br>If no fields are specified at all, no hover box will be displayed.",
"mCalUrlFull_label" => "Mini cal URL to full calendar",
"mCalUrlFull_text" => "When clicking the month at the top of the mini calendar, to go to the full calendar, the user will be directed to this URL.<br>If not specified, the full calendar will open in a new window.<br>This URL is in particular useful when the full calendar is embedded in an existing user page.",
"popFieldsSbar_label" => "Event fields - sidebar hover box",
"popFieldsSbar_text" => "The event fields to be displayed in an overlay when the user hovers an event in the stand-alone sidebar can be specified by means of a sequence of numbers.<br>If no fields are specified at all, no hover box will be displayed.",
"showLinkInSB_label" => "Show links in sidebar",
"showLinkInSB_text" => "Display URLs from the event description as a hyperlink in the upcoming events sidebar",
"sideBarDays_label" => "Days to look ahead in sidebar",
"sideBarDays_text" => "Number of days to look ahead for events in the sidebar.",

//login.php
"log_log_in" => "Vpis",
"log_remember_me" => "Zapomni si me",
"log_register" => "Registracija",
"log_change_my_data" => "Spremeni moje podatke ",
"log_change" => "Spremeni",
"log_un_or_em" => "Uporabniško ime ali spletna pošta",
"log_un" => "Uporabniško ime",
"log_em" => "Spletna pošta",
"log_pw" => "Geslo",
"log_new_un" => "Novo uporabniško ime",
"log_new_em" => "Nov spletni naslov",
"log_new_pw" => "Novo geslo",
"log_pw_msg" => "Tukaj so vaše informacije za vpis v koledar",
"log_pw_subject" => "Vaše %% geslo", //%% will be replaced by calendar name
"log_npw_subject" => "Vaše novo %% geslo", //%% will be replaced by calendar name
"log_npw_sent" => "Vaše novo geslo je nastavljeno",
"log_registered" => "Registracija uspešna - vaše geslo je bilo poslano na vašo spletno pošto",
"log_not_registered" => "Registracija ni bila uspešna",
"log_un_exists" => "Uporabniško ime že obstaja",
"log_em_exists" => "Naslov spletne pošte že obstaja",
"log_un_invalid" => "Neveljavno uporabniško ime (najmanj dolžine 2: A-Ž, a-ž, 0-9, in _-.) ",
"log_em_invalid" => "Neveljaven naslov spletne pošte",
"log_un_em_invalid" => "Uporabniško ime/spletna pošta ni veljavno",
"log_un_em_pw_invalid" => "Uporabniško ime/spletna pošta ali geslo ni veljavno",
"log_no_un_em" => "Prosim vnesite svoje uporabniško ime/naslov spletne pošte",
"log_no_un" => "Prosim vnesite vaše uporabniško ime",
"log_no_em" => "Prosim vnesite vaš naslov spletne pošte",
"log_no_pw" => "Prosim vnesite vaše geslo",
"log_no_rights" => "Vpis zavrnjen: nimate nobenih pravic za ogled - kontaktirajte administratorja",
"log_send_new_pw" => "Pošlji novo geslo",
"log_if_changing" => "Samo če se spreminja",
"log_no_new_data" => "Ni podatkov za spremenitev",
"log_invalid_new_un" => "Neveljavno novo uporabniško ime (najmanj dolžine 2: A-Ž, a-ž, 0-9, in _-.) ",
"log_new_un_exists" => "Novo uporabniško ime že obstaja",
"log_invalid_new_em" => "Neveljaven nov naslov spletne pošte",
"log_new_em_exists" => "Nov naslov spletne pošte že obstaja",
"log_ui_language" => "Jezik uporabniškega vmesnika",
"log_new_reg" => "Registracija novega uporabnika",
"log_date_time" => "Datum / čas",

//categories.php
"cat_list" => "Spisek kategorij",
"cat_edit" => "Spremeni",
"cat_delete" => "Zbriši",
"cat_add_new" => "Dodaj novo kategorijo",
"cat_add" => "Dodaj",
"cat_edit_cat" => "Spremeni kategorijo",
"cat_sort" => "Sort On Name",
"cat_id" => "ID",
"cat_id_expl" => "needed when using the sidebar with specified categories",
"cat_name" => "Ime kategorije",
"cat_sequence" => "Zaporedje",
"cat_in_menu" => "v meniju",
"cat_text_color" => "Barva teksta",
"cat_background" => "Ozadje",
"cat_select_color" => "Izberi barvo",
"cat_save" => "Shrani",
"cat_added" => "Kategorija dodana",
"cat_updated" => "Kategorija posodobljena",
"cat_deleted" => "Kategorija izbrisana",
"cat_invalid_color" => "Format barve neveljaven (#XXXXXX kjer X = HEX-vrednost)",
"cat_not_added" => "Kategorija ni dodana",
"cat_not_updated" => "Kategorija ni posodobljena",
"cat_not_deleted" => "Kategorija ni izbrisana",
"cat_nr" => "#",
"cat_repeat" => "Ponovi",
"cat_every_day" => "vsak dan",
"cat_every_week" => "vsak teden",
"cat_every_month" => "vsak mesec",
"cat_every_year" => "vsako leto",
"cat_approve" => "Dogodki rabijo potrditev",
"cat_public" => "Javno",
"cat_check_mark" => "Oznaka za preverjanje",
"cat_label" => "nalepka",
"cat_mark" => "označba",
"cat_name_missing" => "Manjka ime kategorije",
"cat_mark_label_missing" => "Manjka označba/nalepka",

//users.php
"usr_list_of_users" => "Spisek uporabnikov",
"usr_id" => "ID uporabnika",
"usr_name" => "Uporabniško ime",
"usr_email" => "Spletna pošta",
"usr_group" => "Skupine",
"usr_password" => "Geslo",
"usr_edit_user" => "Spremeni uporabnikov profil",
"usr_add" => "Dodaj uporabnika",
"usr_edit" => "Spremeni",
"usr_delete" => "Izbriši",
"usr_login_0" => "Prvi vpis",
"usr_login_1" => "Zadnji vpis",
"usr_login_cnt" => "Vpisi",
"usr_add_profile" => "Dodaj profil",
"usr_upd_profile" => "Posodobi profil",
"usr_if_changing_pw" => "Samo če se spreminja geslo",
"usr_pw_not_updated" => "Geslo ni posodobljeno",
"usr_added" => "Uporabnik dodan",
"usr_updated" => "Uporabnikov profil dodan",
"usr_deleted" => "Uporabnik zbrisan",
"usr_not_added" => "Uporabnik ni bil dodan",
"usr_not_updated" => "Uporabnik ni bil posodobljen",
"usr_not_deleted" => "Uporabnik ni bil zbrisan",
"usr_cred_required" => "Uporabniško ime, naslov spletne pošte in geslo so potrebni.",
"usr_uname_exists" => "Uporabniško ime že obstaja",
"usr_email_exists" => "Naslov spletne pošte že obstaja",
"usr_un_invalid" => "Neveljavno uporabniško ime (najmanj dolžine 2: A-Ž, a-ž, 0-9, in _-.) ",
"usr_em_invalid" => "Neveljaven naslov spletne pošte",
"usr_cant_delete_yourself" => "Nemorete zbrisati samega sebe",
"usr_go_to_groups" => "Go to Spisek",

//groups.php
"grp_list_of_groups" => "Spisek skupine",
"grp_id" => "ID skupine",
"grp_name" => "Ime skupine",
"grp_privs" => "Pravice",
"grp_categories" => "Kategorije",
"grp_all_cats" => "vse kategorije",
"grp_edit_group" => "Spremeni uporabniška skupina",
"grp_edit" => "Spremeni",
"grp_delete" => "Izbriši",
"grp_view" => "Poglej",
"grp_post_own" => "Objavljaj/spremni svoje dogodke",
"grp_post_all" => "Objavljaj/spremeni vse dogodke",
"grp_manager" => "Objavljanje/spreminjanje + upravnika",
"grp_admin" => "administratorja",
"grp_add_group" => "Dodaj Skupine",
"grp_upd_group" => "Posodobi Skupine",
"grp_no_rights" => "Brez pravic dostopa",
"grp_added" => "Skupine dodan",
"grp_updated" => "Skupine posodobljen",
"grp_deleted" => "Skupine zbrisan",
"grp_not_added" => "Skupine ni bil dodan",
"grp_not_updated" => "Skupine ni bil posodobljen",
"grp_not_deleted" => "Skupine ni bil zbrisan",
"grp_in_use" => "Skupine is in use",
"grp_cred_required" => "Skupine name, Rights and Categories are required",
"grp_name_exists" => "Skupine  ime že obstaja",
"grp_name_invalid" => "Neveljavno skupine ime (najmanj dolžine 2: A-Ž, a-ž, 0-9, in _-.) ",
"grp_background" => "Barva ozadja",
"grp_select_color" => "Izberi barvo",
"grp_invalid_color" => "Format barve neveljaven (#XXXXXX kjer X = HEX-value)",
"grp_go_to_users" => "Go to Uporabnikov",

//database.php
"mdb_dbm_functions" => "Database Functions",
"mdb_noshow_tables" => "Cannot get table(s)",
"mdb_noshow_restore" => "Cannot find backup file",
"mdb_file_not_sql" => "Backup file type not '.sql'",
"mdb_compact" => "Compact database",
"mdb_compact_table" => "Compact table",
"mdb_compact_error" => "Error",
"mdb_compact_done" => "Done",
"mdb_purge_done" => "Deleted events permanently purged from the database",
"mdb_backup" => "Backup database",
"mdb_backup_table" => "Backup table",
"mdb_backup_file" => "Backup file",
"mdb_backup_done" => "Done",
"mdb_records" => "records",
"mdb_restore" => "Restore database",
"mdb_restore_table" => "Restore table",
"mdb_inserted" => "records inserted",
"mdb_db_restored" => "Database restored.",
"mdb_run_upgrade" => "Warning:<br>Backup file didn't match calendar version.<br>Run upgradexxx.php script.",
"mdb_events" => "Events",
"mdb_delete" => "delete",
"mdb_undelete" => "undelete",
"mdb_between_dates" => "occurring between",
"mdb_deleted" => "Events deleted",
"mdb_undeleted" => "Events undeleted",
"mdb_file_saved" => "Backup file saved in 'files' folder on server.","mdb_file_name" => "File name:","mdb_start" => "Start",
"mdb_no_function_checked" => "No function(s) selected",
"mdb_write_error" => "Writing backup file failed<br>Check permissions of 'files/' directory",

//import/export.php
"iex_file" => "Selected file",
"iex_file_name" => "iCal file name",
"iex_file_description" => "iCal file description",
"iex_filters" => "Event Filters",
"iex_upload_ics" => "Upload iCal File",
"iex_create_ics" => "Create iCal File",
"iex_upload_csv" => "Upload CSV File",
"iex_upload_file" => "Upload File",
"iex_create_file" => "Create File",
"iex_download_file" => "Download File",
"iex_fields_sep_by" => "Fields separated by",
"iex_birthday_cat_id" => "Birthday category ID",
"iex_default_cat_id" => "Default category ID",
"iex_if_no_cat" => "if no category found",
"iex_import_events_from_date" => "Import events occurring as of",
"iex_see_insert" => "see instructions on the right",
"iex_no_file_name" => "File name missing",
"iex_inval_field_sep" => "invalid or no field separator",
"iex_no_begin_tag" => "invalid iCal file (BEGIN-tag missing)",
"iex_date_format" => "Event date format",
"iex_time_format" => "Event time format",
"iex_number_of_errors" => "Number of errors in list",
"iex_bgnd_highlighted" => "background highlighted",
"iex_verify_event_list" => "Verify Event List, correct errors and click",
"iex_add_events" => "Add Events to Database",
"iex_select_ignore_birthday" => "Select Ignore and Birthday check boxes as required",
"iex_select_ignore" => "Select Ignore check box to ignore event",
"iex_title" => "Title",
"iex_venue" => "Venue",
"iex_owner" => "Owner",
"iex_category" => "Category",
"iex_date" => "Date",
"iex_end_date" => "End date",
"iex_start_time" => "Start time",
"iex_end_time" => "End time",
"iex_description" => "Description",
"iex_repeat" => "Repeat",
"iex_birthday" => "Birthday",
"iex_ignore" => "Ignore",
"iex_events_added" => "events added",
"iex_events_dropped" => "events dropped (already present)",
"iex_db_error" => "Database error",
"iex_csv_file_error_on_line" => "CSV file error on line",
"iex_ics_file_error_on_line" => "iCal file error on line",
"iex_between_dates" => "Occurring between",
"iex_changed_between" => "Added/modified between",
"iex_select_date" => "Select date",
"iex_select_start_date" => "Select start date",
"iex_select_end_date" => "Select end date",
"iex_all_cats" => "all categories",
"iex_all_users" => "all users",
"iex_no_events_found" => "No events found",
"iex_file_created" => "File created",
"iex_write error" => "Writing export file failed<br>Check permissions of 'files/' directory",

//lcalcron.php
"cro_sum_header" => "CRON JOB SUMMARY",
"cro_sum_trailer" => "END OF SUMMARY",
"cro_evc_sum_title" => "EVENTS EXPIRED",
"cro_nr_evts_deleted" => "Number of events deleted",
"cro_not_sum_title" => "EMAIL REMINDERS",
"cro_not_sent_to" => "Reminders sent to",
"cro_no_not_dates_due" => "No notification dates due",
"cro_all_day" => "All day",
"cro_mailer" => "mailer",
"cro_subject" => "Subject",
"cro_event_due_in" => "The following event is due in",
"cro_event_due_today" => "The following event is due today",
"cro_due_in" => "Due in",
"cro_due_today" => "Due today",
"cro_days" => "day(s)",
"cro_date_time" => "Date / time",
"cro_title" => "Title",
"cro_venue" => "Venue",
"cro_description" => "Description",
"cro_category" => "Category",
"cro_status" => "Status",
"cro_open_calendar" => "Open calendar",
"cro_chg_sum_title" => "CALENDAR CHANGES",
"cro_nr_changes_last" => "Number of changes last",
"cro_report_sent_to" => "Report sent to",
"cro_no_report_sent" => "No report emailed",
"cro_usc_sum_title" => "USER ACCOUNTS EXPIRED",
"cro_nr_accounts_deleted" => "Number of accounts deleted",
"cro_no_accounts_deleted" => "No accounts deleted",
"cro_ice_sum_title" => "EXPORTED EVENTS",
"cro_nr_events_exported" => "Number of events exported in iCalendar format to file",

//explanations
"xpl_manage_db" =>
"<h4>Manage Database Instructions</h4>
<p>On this page the following functions can be selected:</p>
<h5>Compact database</h5>
<p>When a user deletes an event, the event will be marked as 'deleted', but will 
not be removed from the database. The Compact Database function will permanently 
remove events deleted more than 30 days ago from the database and free the space 
occupied by these events.</p>
<h5>Back up database</h5>
<p>This function will create a backup of the full calendar database (tables, 
structure and contents) in .sql format. The backup will be saved in the 
<strong>files/</strong> directory with file name: 
<kbd>cal-dump-yyyymmdd-hhmmss.sql</kbd> (where 'yyyymmdd' = year, month, and 
day, and hhmmss = hour, minutes and seconds.</p>
<p>The backup file can be used to recreate the calendar database (structure and 
data), via the restore function described below or by using for instance the 
<strong>phpMyAdmin</strong> tool, which is provided by most web hosts.</p>
<h5>Restore database</h5>
<p>This function will restore the calendar database with the contents of the 
uploaded backup file (file type .sql).</p>
<p>When restoring the database, ALL CURRENTLY PRESENT DATA WILL BE LOST!</p>
<p>After restoring a backup file of a previous LuxCal version, you must run the 
latest upgradexxx.php script to ensure the database tables are up to date!</p>
<h5>Events</h5>
<p>This function will delete or undelete events which are occurring between the 
specified dates. If a date is left blank, there is no date limit; so if both 
dates are left blank, ALL EVENTS WILL BE DELETED!</p><br>
<p>IMPORTANT: When the database is compacted (see above), the events which are 
permanently removed from the database cannot be undeleted anymore!</p>",

"xpl_import_csv" =>
"<h4>CSV Import Instructions</h4>
<p>This form is used to import a CSV (Comma Separated Values) text file containing 
event data into the LuxCal Calendar</p>
<p>The order of columns in the CSV file must be: title, venue, category id (see 
below), date, end date, start time, end time and description. If the first row of 
the CSV file contains column headers, it will be ignored.</p>
<p>For proper handling of special characters, the CSV file must be UTF-8 encoded.</p>
<h5>Sample CSV files</h5>
<p>Sample CSV files (file extension .csv) can be found in the 'files/' directory 
of your LuxCal installation.</p>
<h5>Date and time format</h5>
<p>The selected event date format and event time format on the left must match the 
format of the dates and times in the uploaded CSV file.</p>
<h5>Table of Categories</h5>
<p>The calendar uses ID numbers to specify categories. The category IDs in the CSV 
file should correspond to the categories used in your calendar or be blank.</p>
<p>If in the next step you want to earmark events as 'birthday', the <strong>Birthday 
category ID</strong> must be set to the corresponding ID in the category list below.</p>
<p class='hilight'>Warning: Do not import more than 100 events at a time!</p>
<p>For your calendar, the following categories have currently been defined:</p>",

"xpl_import_ical" =>
"<h4>iCalendar Import Instructions</h4>
<p>This form is used to import an <strong>iCalendar</strong> event file into 
the LuxCal Calendar.</p>
<p>The file contents must meet the [<u><a href='http://tools.ietf.org/html/rfc5545' 
target='_blank'>RFC5545 standard</a></u>] of the Internet Engineering Task Force.</p>
<p>Only events will be imported; other iCal components, like: To-Do, Journal, Free / 
Busy, Time zone and Alarm, will be ignored.</p>
<h5>Sample iCal files</h5>
<p>Sample iCalendar files (file extension .ics) can be found in the 'files/' 
directory of your LuxCal download.</p>
<h5>Table of Categories</h5>
<p>The calendar uses ID numbers to specify categories. The category IDs in the 
iCalendar file should correspond to the categories used in your calendar or be 
blank.</p>
<p class='hilight'>Warning: Do not import more than 100 events at a time!</p>
<p>For your calendar, the following categories have currently been defined:</p>",

"xpl_export_ical" =>
"<h4>iCalendar Export Instructions</h4>
<p>This form is used to extract and export <strong>iCalendar</strong> events from 
the LuxCal Calendar.</p>
<p>Files will be created in the 'files/' directory on the server with the 
specified filename (no extension). (The filename extension is <b>.ics</b> and 
if not specified, the default filename is the calendar name.
Existing files in the 'files/' directory on the server with the same name will 
be overwritten by the new file.</p>
<p>The <b>iCal file description</b> (e.g. 'Meetings 2013') is optional. If 
entered, it will be added to the header of the exported iCal file.</p>
<p><b>Event filters</b>: The events to be extracted can be filtered by:</p>
<ul>
<li>event owner</li>
<li>event category</li>
<li>event start date</li>
<li>event added/last modified date</li>
</ul>
<p>Each filter is optional. A blank date means: no limit</p>
<br>
<p>The content of the file with extracted events will meet the 
[<u><a href='http://tools.ietf.org/html/rfc5545' target='_blank'>RFC5545 standard</a></u>] 
of the Internet Engineering Task Force.</p>
<p>When <b>downloading</b> the exported iCal file, the date and time will be 
added to the name of the downloaded file.</p>
<h5>Sample iCal files</h5>
<p>Sample iCalendar files (file extension .ics) can be found in the 'files/' 
directory of your LuxCal download.</p>"
);
?>
