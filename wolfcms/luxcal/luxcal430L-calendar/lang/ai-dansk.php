<?php
/*
= LuxCal event calendar admin interface language file =

This file has been produced by LuxSoft. Please send comments / improvements to rb@luxsoft.eu.
Additional Danish translations by FinnH.
Additional Danish - John Schwartz. Sidst redigeret 24-11-2015

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//LuxCal ui language file version
define("LAI","4.3.0");

/* -- Admin Interface texts -- */

$ax = array(

//general
"none" => "Ingen",
"all" => "Alle",
"back" => "Tilbage",
"close" => "Luk",
"always" => "altid",
"at_time" => "@", //date and time separator (e.g. 10-04-2016 @ 10:45)
"year" => "Year",
"month" => "Month",
"week_day" => "Week/Day",
"upcoming" => "Upcoming",
"id" => "ID",

//settings.php - fieldset headers + general
"set_general_settings" => "Kalenderindstillinger",
"set_navbar_settings" => "Navigationsbjælke",
"set_event_settings" => "Begivenheder",
"set_user_settings" => "Brugerindstillinger",
"set_email_settings" => "Email Indstillinger",
"set_perfun_settings" => "Periodiske Funktioner (kun relevant hvis cron job er konfigureret)",
"set_minical_settings" => "Mini Kalender (kun relevant hvis den bruges)",
"set_sidebar_settings" => "Fritstående Sidebjælke (kun relevant hvis den bruges)",
"set_view_settings" => "Visningsindstilinger",
"set_dt_settings" => "Dato/tid indstilinger",
"set_save_settings" => "Gem indstilinger",
"set_test_mail" => "Test Mail",
"set_mail_sent_to" => "Test mail sent to",
"set_mail_sent_from" => "Denne testmail var sendt fra din kalender",
"set_missing_invalid" => "manglende eller ugyldige indstillinger (baggrund farvemarkeret)",
"set_settings_saved" => "Kalenderindstilingerer gemt",
"set_save_error" => "Databasefejl - Gem kalender indstillinger mislykkedes",
"hover_for_details" => "Hold musemarkør over beskrivelser for detaljer",
"default" => "standard",
"enabled" => "aktiveret",
"disabled" => "deaktiveret",
"no" => "nej",
"yes" => "ja",
"or" => "eller",
"minutes" => "minutter",
"pixels" => "pixels",
"no_way" => "Du har ikke rettigheder til at udføre denne funktion",

//settings.php - general settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"calVersionDb_label" => "Kalender version - Database",
"calVersionDb_text" => "Versionsnummer for installeret kalender software and the folder/name of the currently used SQLite database file.",
"calTitle_label" => "Kalendertitel",
"calTitle_text" => "Vises i kalenderens topbjælke og bruges ved beskeder.",
"calUrl_label" => "Kalender URL",
"calUrl_text" => "Kalenderens webside-adresse",
"calEmail_label" => "Kalender email-adresse",
"calEmail_text" => "Afsenderens email adresse, bruges i besked-emails.<br>Format: \'email\' eller \'navn&#8249;email&#8250;\'. \'navn\' kan være kalenderens navn.",
"backLinkUrl_label" => "Link til overordnet side",
"backLinkUrl_text" => "URL for den overordnede side. Hvis angivet, vil en Tilbage-knap blive vist i venstre side af Navigationsbjælken, som linker til denne URL.<br>Fx for at linke tilbage til den overordnede hjemmeside hvorfra kalenderen blev åbnet.",
"timeZone_label" => "Tidszone",
"timeZone_text" => "Kalenderens tidszone, bruges til at beregne tidspunktet.",
"see" => "se",
"notifSender_label" => "Afsender for påmindelse emails",
"notifSender_text" => "Når kalenderen sender påmindelse emails, kan afsender feltet indeholde enten kalenderens email adresse, eller email adresse for den bruger, som oprettede begivenheden.<br>Hvis brugerens email adresse anvendes, kan modtagere besvare emailen.",
"rssFeed_label" => "RSS feed links",
"rssFeed_text" => "Hvis aktiveret: For brugere med mindst \'vise\' rettigheder, vil et RSS feed link blive vist i bunden af kalenderen, og et RSS feed link vil blive tilføjet HTML header på kalendersider.",
"calendar" => "kalender",
"user" => "bruger",
"php_mail" => "PHP mail",
"smtp_mail" => "SMTP mail",

//settings.php - navigation bar settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"navButText_label" => "Navigationsbjælke knapper med tekst",
"navButText_text" => "Hvis aktiveret: Knapper på navigationsbjælken vises med tekst. Hvis deaktiveret: Knapper på navigationsbjælken vises med ikoner.",
"sideLists_label" => "To Approve / Todo / Upcoming knapper",
"sideLists_text" => "Hvis aktiveret: Knappen Opgaveliste hhv. Kommende vises på navigationsbjælken, som kan klikkes på for at åbne Opgaveliste hhv. Kommende begivenheder.",
"navToapList_label" => "To approve knap",
"navTodoList_label" => "Opgaveliste knap",
"navUpcoList_label" => "Kommende begivenheder knap",
"optionsPanel_label" => "Options panel menuer",
"optionsPanel_text" => "Aktiver/deaktiver menuer i Valg panelet.<br>• Kalendermenuen gør det muligt for admin at skifte kalendere. (enabling er kun relevant hvis flere kalendere er installeret)<br>• Gruppemenuen kan anvendes til at vise, kun de brugere der tilhører den/de valgte gruppe(r).<br>• Menuen Brugere kan bruges til kun at vise begivenheder oprettet af den/de angivne brugere.<br>• Menuen Kategorier kan bruges til kun at vise begivenheder i den/de angivne kategorier.<br>• Menuen Sprog kan bruges til at vælge det ønskede sprog (kun relevant hvis der er installeret flere sprog).",
"calMenu_label" => "kalender",
"groupMenu_label" => "Grupper",
"userMenu_label" => "Bruger",
"catMenu_label" => "Kategori",
"langMenu_label" => "Sprog",
"defaultView_label" => "Standardvisning ved start",
"defaultView_text" => "Mulige standardvisninger ved starten af kalenderen er:<br>• År<br>• Måned<br>• Uge<br>• Dag<br>• Kommende<br>• Ændringer<br>Anbefalet valg: Måned eller Kommende.",
"language_label" => "Standard brugerinterface-sprog",
"language_text" => "Filerne ui-{sprog}.php, ai-{sprog}.php, ug-{sprog}.php og ug-layout.png skal findes i lang/ folderen. {sprog} = det valgte sprog til brugerinterfacet. Filnavne skal skrives med små bogstaver!",

//settings.php - events settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"ownerTitle_label" => "Vis event owner foran event titlen",
"ownerTitle_text" => "I diverse kalender visninger, vis event owner navnet foran kalendar titlen.",
"privEvents_label" => "Oprettelse af private begivenheder",
"privEvents_text" => "Private begivenheder er kun synlige for den bruger som har oprettet begivenheden.<br>Deaktiveret: brugere kan ikke oprette private begivenheder. \'Privat\' markeringsfeltet vil ikke blive vist i begivenhedsvinduet.<br>Aktiveret: brugere kan oprette private begivenheder ved at sætte markeringen \'Privat\'.<br>Standard: når nye begivenheder tilføjes, sættes markeringen \'Privat\' automatisk, og brugeren kan ændre markeringen.<br>Altid: når nye begivenheder tilføjes vil de altid være private, og \'Privat\' markeringsfeltet vil ikke blive vist i begivenhedsvinduet.",
"details4All_label" => "Visning af begivenhedsdetaljer for brugere",
"details4All_text" => "Deaktiveret: begivenhedsdetaljer vil kun være synlige for ejeren af begivenheden og for brugere med mindst \'Opret + editer alle begivenheder\' rettigheder.<br>Alle: begivenhedsdetaljer vil være synlige for ejeren af begivenheden og for alle andre brugere.<br>Logget ind: begivenhedsdetaljer vil være synlige for ejeren af begivenheden og for brugere som er logget ind.",
"evtDelButton_label" => "Vis sletteknap i begivenhedsvindue",
"evtDelButton_text" => "Deaktiveret: knappen Slet vil ikke være synlig i begivenhedsvinduet. Brugere med editeringsrettigheder vil ikke kunne slette begivenheder.<br>Aktiveret: knappen Slet vil være synlig i begivenhedsvinduet for alle brugere.<br>Manager: knappen Slet vil kun være synlig for brugere med \'manager\' rettigheder.",
"eventColor_label" => "Begivenhedsfarver baseres på",
"eventColor_text" => "Begivenheder i de forskellige kalendervisninger kan vises i farven som er tildelt brugeren som oprettede begivenheden eller farven for begivenhedskategorien.",
"xField1_label" => "Ekstra felt 1",
"xField2_label" => "Ekstra felt 2",
"xFieldx_text" => "Valgfrit tekstfelt. Hvis det sættes således op, vil feltet blive vist i diverse visninger.<br>• label: Valgfri text label for det extra felt (max. 15 characters). E.g. \'Email address\', \'Website\', \'Phone number\'<br>• public: Hvis valgt, vil feltet være synligt for alle brugere; ellers vil feltet kun være synligt for logged-in-users.",
"xField_label" => " overskrift",
"xField_public" => "public",
"logged_in" => 'logget ind',
"manager_only" => 'manager',
"user_group" => "ejer farve",
"event_cat" => "kategori farve",

//settings.php - user accounts settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"selfReg_label" => "Selvregistrering",
"selfReg_text" => "Tillad brugere at registrere sig selv for at få adgang til kalenderen.",
"selfRegGrp_label" => "Selvregistreringsrettigheder",
"selfRegGrp_text" => "Brugergruppe for hvilken selv-registrerede brugere vil blive tilknyttet.",
"selfRegNot_label" => "Selvregistrering advisering",
"selfRegNot_text" => "Send en advisering email til kalender email addressen når en selvregistrering foretages.",
"restLastSel_label" => "Gen-etabler seneste brugersession",
"restLastSel_text" => "Den seneste brugersession (Valgmuligheders indstillinger) bliver gemt, og når brugeren senere vender tilbage til kalenderen, vil værdierne blive anvendt igen.",
"cookieExp_label" => "'Husk mig' cookie udløbsdage",
"cookieExp_text" => "Antal dage før den cookie, som sættes med \'Husk mig\' funktionen (ved Log Ind), udløber.",
"view" => "vis",
"post_own" => 'opret/editer egne',
"post_all" => 'opret/editer alle',
"manager" => 'opret/manager',

//settings.php - view settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"evtTemplGen_label" => "Begivenhed skabelon - General views",
"evtTemplGen_text" => "Felter der skal vises i diverse kalendervisninger.<br>Hvis et nummer er medtaget, vil det tilhørende felt blive vist.",
"evtTemplUpc_label" => "Begivenhed skabelon - Upcoming view",
"evtTemplUpc_text" => "Felter der skal vises i Upcoming Events views kan vælges ved at angive dets nummer.<br>Hvis et nummer er medtaget, vil det tilhørende felt blive vist.",
"popBoxFields_label" => "Pop-up boks begivenhedsfelter",
"popBoxFields_text" => "Felter der skal vises i Hoover-boksen kan vælges ved at angive dets nummer.. <br>Hvis et nummer er medtaget, vil det tilhørende felt blive vist.<br>Hvis ingen felter er angivet, vil Hoover-boksen ikke blive vist.",
"templFields_text" => "Numrenes betydning:<br>1: Venue(sted)field<br>2: Event category field<br>3: Description field<br>4: Extra field 1 (see below)<br>5: extra field 2 (see below)<br>6: Email notification data (kun hvis en advisering er angivet)<br>7: Date/time added/edited og de(n) tilhørende bruger(e).<br>Numrenes rækkefølge afgør visningsrækkefølgen.",
"yearStart_label" => "Startmåned i års-visning",
"yearStart_text" => "Hvis en startmåned er angivet (1 - 12), vil års-visning af kalenderen altid starte med denne måned, og året for denne første måned vil først skifte ved den første dag i den samme måned i det næste år.<br>Værdien 0 har en speciel betydning: startmåneden er baseret på den aktuelle dato og vil falde i den første række af måneder.",
"colsToShow_label" => "Kolonner der vises i års-visning",
"colsToShow_text" => "Antal måneder der skal vises i hver række i års-visning.<br>Anbefalet valg: 3 eller 4.",
"rowsToShow_label" => "Rækker der vises i års-visning",
"rowsToShow_text" => "Antal rækker af måneder der vises i års-visningen.<br>Anbefalet valg: 4, hvilket giver 12 eller 16 måneder, at scrolle igennem med de anbefalede værdier for Kolonner.",
"weeksToShow_label" => "Uger der vises i måneds-visning",
"weeksToShow_text" => "Antal uger der vises i månedsvisning.<br>Anbefalet valg: 10, hvilket giver 2,5 måned at scrolle igennem.<br>Værdierne 0 og 1 har en speciel betydning:<br>0: vis præcis 1 måned - blank forudgående og efterfølgende dage.<br>1: vis præcis 1 måned - vis begivenheder på forudgående og efterfølgende dage.",
"workWeekDays_label" => "Dage i arbejdsuge",
"workWeekDays_text" => "Dage som skal vises i hver uge i Arbejdsmåned visning og Arbejdsuge visning.<br>Angiv numrene for hver dag der skal vises. Gyldige dagnumre er:<br>1 = Mandag<br>2 = Tirsdag<br>....<br>7 = Søndag<br>Fx 12345 : Mandag til Fredag",
"lookaheadDays_label" => "Dage der skal ses fremad",
"lookaheadDays_text" => "Antal dage der skal ses fremad i visningen Kommende begivenheder, Opgavelisten og RSS feeds.",
"dwStartHour_label" => "Starttime i dag-/ugevisning",
"dwStartHour_text" => "Time hvor en normal dags begivenheder starter.<br>Hvis denne værdi f.eks. sættes til 6, undgår man at spilde plads i dag-/ugevisning til de stille timer mellem midnat og 6.00.<br>Tidsvælgeren, som bruges til at vælge et tidspunkt, vil også starte ved denne time.",
"dwEndHour_label" => "Sluttime i dag-/ugevisnig",
"dwEndHour_text" => "Time hvor en normal dags begivenheder slutter.<br>Hvis denne værdi f.eks. sættes til 18, undgår man at spilde plads i dag-/ugevisning til de stille timer mellem 18:00 og midnat.<br>Tidsvælgeren, som bruges til at vælge et tidspunkt, vil også slutte ved denne time.",
"dwTimeSlot_label" => "Tidsintervaller i dag-/ugevisning",
"dwTimeSlot_text" => "Dag-/ugevisning tidsinterval i antal minutter.<br>Denne værdi vil sammen med Starttime og Sluttime (se ovenfor) afgøre antallet af rækker i dag/-ugevisning.",
"dwTsHeight_label" => "Tidsinterval højde",
"dwTsHeight_text" => "Tidsinterval feltets højde i antal pixels i dag-/ugevisning.",
"showInMView_label" => "Vis i månedsvisning",
"showInMView_text" => "Enabled/disable visning i Month view af de følgende ting:<br>• URLs i et af event description felterne (vil vises som hyperlink)<br>• images/billeder i et af følgende event description felter",
"urls" => "URL links",
"images" => "images",
"monthInDCell_label" => "Måned i hvert dagfelt",
"monthInDCell_text" => "3-bogstavs månedsnavn vises i hvert dagfelt i månedsvisning.",

//settings.php - date/time settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"dateFormat_label" => "Begivenhedsdatoformat (dd mm yyyy)",
"dateFormat_text" => "Tekststreng som definerer formatet for begivenhedsdatoer i kalendervisningerne og indtastningsfelter.<br>Mulige tegn: y = år, m = måned og d = dag.<br>Ikke-alfanumeriske tegn kan bruges som skilletegn, og vil blive kopieret tegn for tegn.<br>Eksempler:<br>y-m-d: 2013-10-31<br>m.d.y: 10.31.2013<br>d/m/y: 31/10/2013",
"dateFormat_expl" => "fx y.m.d: 2013.10.31",
"MdFormat_label" => "Datoformat (dd måned)",
"MdFormat_text" => "Tekststreng som definerer formatet for datoer som består af måned og dag.<br>Mulige tegn: M = måned i tekst, d = dato i tal.<br>Ikke-alfanumeriske tegn kan bruges som skilletegn, og vil blive kopieret tegn for tegn.<br>Eksempler:<br>d M: 12 April<br>M, d: Juli, 14",
"MdFormat_expl" => "fx M, d: Juli, 14",
"MdyFormat_label" => "Datoformat (dd måned yyyy)",
"MdyFormat_text" => "Tekststreng som definerer formatet for datoer som består af dag, måned og år.<br>Mulige tegn: d = dag i tal, M = måned i tekst, y = år i tal.<br>Ikke-alfanumeriske tegn kan bruges som skilletegn, og vil blive kopieret tegn for tegn.<br>Eksempler:<br>d M y: 12 April 2013<br>M d, y: Juli 8, 2013",
"MdyFormat_expl" => "fx M d, y: Juli 8, 2013",
"MyFormat_label" => "Datoformat (måned yyyy)",
"MyFormat_text" => "Tekststreng som definerer formatet for datoer som består af måned og år.<br>Mulige tegn: M = måned i tekst, y = år i tal.<br>Ikke-alfanumeriske tegn kan bruges som skilletegn, og vil blive kopieret tegn for tegn.<br>Eksempler:<br>M y: April 2013<br>y - M: 2013 - Juli",
"MyFormat_expl" => "fx M y: April 2013",
"DMdFormat_label" => "Datoformat (ugedag dd måned)",
"DMdFormat_text" => "Tekststreng som definerer formatet for datoer som består af ugedag, dag og måned.<br>Mulige tegn: WD = ugedag i tekst, M = måned i tekst, d = dag i tal.<br>Ikke-alfanumeriske tegn kan bruges som skilletegn, og vil blive kopieret tegn for tegn.<br>Eksempler:<br>WD d M: Fredag 12 April<br>WD, M d: Mandag, Juli 14",
"DMdFormat_expl" => "fx WD - M d: Søndag - April 6",
"DMdyFormat_label" => "Datoformat (ugedag dd måned yyyy)",
"DMdyFormat_text" => "Tekststreng som definerer formatet for datoer som består af ugedag, dag, måned og år.<br>Mulige tegn: WD = ugedag i tekst, M = måned i tekst, d = dag i tal, y = år i tal.<br>Ikke-alfanumeriske tegn kan bruges som skilletegn, og vil blive kopieret tegn for tegn.<br>Eksempler:<br>WD d M y: Fredag 13 April 2013<br>WD - M d, y: Mandag - Juli 16, 2013",
"DMdyFormat_expl" => "fx WD, M d, y: Mandag, Juli 16, 2013",
"timeFormat_label" => "Tidsformat (hh mm)",
"timeFormat_text" => "Tekststreng som definerer formatet for begivenhedstider i kalendervisningerne og indtastningsfelter.<br>Mulige tegn: h = timer, H = timer med foranstillede nuller, m = minutter, a = am/pm (valgfrit), A = AM/PM (valgfrit).<br>Ikke-alfanumeriske tegn kan bruges som skilletegn, og vil blive kopieret tegn for tegn.<br>Eksempler:<br>h:m: 18:35<br>h.m a: 6.35 pm<br>H:mA: 06:35PM",
"timeFormat_expl" => "fx h:m: 22:35 og h:mA: 10:35PM",
"weekStart_label" => "Ugens første dag",
"weekStart_text" => "Ugens første dag.",
"weekNumber_label" => "Vis ugenumre",
"weekNumber_text" => "Ugenumre vises i års-, måneds- og ugevisning.",
"time_format_us" => "12-timer AM/PM",
"time_format_eu" => "24-timer",
"sunday" => "Søndag",
"monday" => "Mandag",
"time_zones" => "TIME ZONES",
"dd_mm_yyyy" => "dd-mm-yyyy",
"mm_dd_yyyy" => "mm-dd-yyyy",
"yyyy_mm_dd" => "yyyy-mm-dd",

//settings.php - email settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"mailServer_label" => "Mail server",
"mailServer_text" => "PHP mail kan bruges ved ikke-autentificeret mail i mindre omfang. For større omfang eller hvis autentificering er påkrævet, anbefales det at anvende SMTP.<br>Brug af SMTP mail kræver en SMTP mail server. Konfigurationsoplysningerne skal angives herunder. Hvis mail er deaktiveret, vil Send mail afsnittet i begivenhedsvinduet ikke blive vist.",
"smtpServer_label" => "SMTP server navn",
"smtpServer_text" => "Hvis SMTP mail er valgt, skal SMTP server navnet angives her. Fx gmail SMTP server: smtp.gmail.com.",
"smtpPort_label" => "SMTP port nummer",
"smtpPort_text" => "Hvis SMTP mail er valgt, skal SMTP Port nummer angives her. Fx 25, 465 or 587. Gmail bruger for eksempel port nummer 465.",
"smtpSsl_label" => "SSL (Secure Sockets Layer)",
"smtpSsl_text" => "Hvis SMTP mail er valgt, kan her angives om secure sockets layer (SSL) skal anvendes. For gmail: aktiveret",
"smtpAuth_label" => "SMTP autentificering",
"smtpAuth_text" => "Hvis SMTP autentificering er valgt, vil det brugernavn og adgangskode som angives her blive anvendt til at autentificere SMTP mail.",
"smtpUser_label" => "SMTP brugernavn",
"smtpUser_text" => "Hvis SMTP mail er valgt, angives SMTP brugernavn her. For gmail vil dette være den del af email adressen som står før @.",
"smtpPass_label" => "SMTP adgangskode",
"smtpPass_text" => "Hvis SMTP mail er valgt, angives SMTP adgangskoden her.",

//settings.php - periodic function settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"cronSummary_label" => "Admin cron job oversigt",
"cronSummary_text" => "Send en cron job oversigt til kalender administratoren.<br>Aktivering er kun relevant hvis et cron job er blevet konfigureret for kalenderen.",
"chgEmailList_label" => "Emailmodtagere for ændringer",
"chgEmailList_text" => "Emailadresser, som periodisk modtager en email med kalenderændringer.<br>Email-adresser adskilt af semikolonner.",
"chgNofDays_label" => "Dage at se tilbage efter ændringer",
"chgNofDays_text" => "Antal dage, der skal ses tilbage efter kalender-ændringer.<br>Hvis antal dage sættes til 0 vil der ikke blive sendt en oversigt over ændringer.",
"icsExport_label" => "Daglig eksport af iCal begivenheder",
"icsExport_text" => "Hvis aktiveret: Alle begivenheder i datointervallet -1 uge til +1 år vil blive eksporteret i iCalendar format til en .ics fil i folderen \'files\'.<br>Filnavnet vil være kalenderens navn, hvor mellemrum erstattes af underscore-tegn (\'_\'). Eksisterende filer vil blive overskrevet af nye filer.",
"eventExp_label" => "Begivenhed udløb dage",
"eventExp_text" => "Antal dage efter begivenhedens slutdato, hvor begivenheden udløber og automatisk slettes.<br>Hvis antal dage sættes til 0 eller hvis der ikke er konfigureret et cron job, vil der ikke automatisk blive slettet begivenheder.",
"maxNoLogin_label" => "Max. antal dage ikke logget ind",
"maxNoLogin_text" => "Hvis en bruger ikke har logget ind i løbet af dette antal dage, vil brugerprofilen automatisk blive slettet.<br>Hvis værdien sættes til 0, vil brugerprofiler ikke blive slettet automatisk",

//settings.php - mini calendar / sidebar settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"miniCalView_label" => "Mini kalender visning",
"miniCalView_text" => "Mulige visninger for minikalenderen er:<br>• Måned (7d)<br>• Arbejdsmåned *)<br>• Uge (7d)<br>• Arbejdsuge *)<br>*) For dage i arbejdsuge, se under Visningsindstillinger - Dage i arbejdsuge",
"miniCalPost_label" => "Minikalender begivenhedsoprettelse",
"miniCalPost_text" => "Hvis aktiveret kan brugere:<br>• oprette nye begivenheder direkte fra minikalenderen ved at klikke på topbjælken i et datofelt<br>• editere/slette begivenheder ved at klikke på firkanten som angiver begivenheden<br>Bemærk: Adgangsrettighederne for brugerprofilen Offentlig adgang vil være gældende.",
"popFieldsMcal_label" => "Begivenhedsfelter - minikalender pop-up boks",
"popFieldsMcal_text" => "Begivenhedsfelter, der skal vises i en pop-up boks når musen føres hen over en begivenhed i minikalenderen, kan angives ved en række numre.<br>Hvis ingen numre specificeres, vil der ikke blive vist en pop-up boks når musen holdes over begivenheden.",
"mCalUrlFull_label" => "Minikalender URL til fuld kalender",
"mCalUrlFull_text" => "Ved klik på måneden i toppen af minikalenderen, for at komme til den fulde kalender, vil brugeren blive dirigeret til denne URL.<br>Hvis ingen URL angives, vil den fulde kalender blive åbnet i et nyt vindue.<br>Denne URL er specielt praktisk hvis den fulde kalender er indlagt i en eksisterende brugerside.",
"popFieldsSbar_label" => "Begivenhedsfelter - sidebjælke pop-up boks",
"popFieldsSbar_text" => "Begivenhedsfelter, der skal vises i en pop-up boks når musen føres hen over en begivenhed i den fritstående sidebjælke, kan angives ved en række numre.<br>Hvis ingen numre specificeres, vil der ikke blive vist en pop-up boks når musen holdes over begivenheden.",
"showLinkInSB_label" => "Vis links i sidebjælke",
"showLinkInSB_text" => "Vis URL\'er fra begivenhed beskrivelsesfeltet som et hyperlink i sidebjælken med kommende begivenheder.",
"sideBarDays_label" => "Antal dage at se frem i sidebjælke",
"sideBarDays_text" => "Antal dage som der skal ses frem efter begivenheder i sidebjælken.",

//login.php
"log_log_in" => "Log ind",
"log_remember_me" => "Husk mig",
"log_register" => "Registrer",
"log_change_my_data" => "Ændre mine data",
"log_change" => "Ændre",
"log_un_or_em" => "Brugernavn eller email",
"log_un" => "Brugernavn",
"log_em" => "Email",
"log_pw" => "Password",
"log_new_un" => "Nyt brugernavn",
"log_new_em" => "Ny email",
"log_new_pw" => "Nyt Password",
"log_pw_msg" => "Her er dine log in detaljer til at logge ind til",
"log_pw_subject" => "Dit %% Password", //%% will be replaced by calendar name
"log_npw_subject" => "Dit nye %% Password", //%% will be replaced by calendar name
"log_npw_sent" => "Dit nye password er blevet sendt.",
"log_registered" => "Registrering lykkedes - dit password er sendt til dig pr. email",
"log_not_registered" => "Registrering mislykkedes",
"log_un_exists" => "Brugernavn findes allerede",
"log_em_exists" => "Email-adresse findes allerede",
"log_un_invalid" => "Ugyldigt brugernavn (min. længde 2: A-Z, a-z, 0-9, og _-.) ",
"log_em_invalid" => "Ugyldig email-adresse",
"log_un_em_invalid" => "Brugernavn/email er ikke gyldig",
"log_un_em_pw_invalid" => "Dit brugernavn/email eller password er forkert",
"log_no_un_em" => "Du indtastede ikke brugernavn/email",
"log_no_un" => "Indtast dit brugernavn",
"log_no_em" => "Indtast din email-adresse",
"log_no_pw" => "Du indtastede ikke dit password",
"log_no_rights" => "Login afvist: du har ingen rettigheder til at se kalender - Kontakt administrator",
"log_send_new_pw" => "Send nyt password",
"log_if_changing" => "Kun hvis det ændres",
"log_no_new_data" => "Ingen data ændret",
"log_invalid_new_un" => "Ugyldigt brugernavn (min. længde 2: A-Z, a-z, 0-9, og _-.) ",
"log_new_un_exists" => "Nyt brugernavn findes allerede",
"log_invalid_new_em" => "Ny email-adresse ugyldig",
"log_new_em_exists" => "Ny email-adresse findes allerede",
"log_ui_language" => "Brugerinterface sprog",
"log_new_reg" => "Ny bruger registrering",
"log_date_time" => "Dato / tid",
"log_time_out" => "Time out",

//categories.php
"cat_list" => "Liste med kategorier",
"cat_edit" => "Editer",
"cat_delete" => "Slet",
"cat_add_new" => "Tilføj ny kategori",
"cat_add" => "Tilføj",
"cat_edit_cat" => "Editer kategori",
"cat_sort" => "Sort On Name",
"cat_name" => "Kategorinavn",
"cat_sequence" => "Rækkefølge",
"cat_in_menu" => "i menu",
"cat_text_color" => "Tekstfarve",
"cat_background" => "Baggrund",
"cat_select_color" => "Vælg farve",
"cat_save" => "Opdater",
"cat_added" => "Kategori tilføjet",
"cat_updated" => "Kategori opdateret",
"cat_deleted" => "Kategori slettet",
"cat_invalid_color" => "Farvekode ugyldig (#XXXXXX hvor X = HEX-værdi)",
"cat_not_added" => "Kategori ikke tilføjet",
"cat_not_updated" => "Kategori ikke opdateret",
"cat_not_deleted" => "Kategori ikke slettet",
"cat_nr" => "#",
"cat_repeat" => "Gentagelse",
"cat_every_day" => "hver dag",
"cat_every_week" => "hver uge",
"cat_every_month" => "hver måned",
"cat_every_year" => "hvert år",
"cat_overlap" => "Overlap tilladt",
"cat_no_overlap" => "Overlap ikke tilladt",
"cat_ol_error_text" => "Fejltekst ved overlap",
"cat_no_ol_note" => "Bemærk at allerede eksisterende events ikke bliver tjekket, og at de måske allerede overlapper",
"cat_ol_error_msg" => "event overlap; Vælg andet tidspunkt",
"cat_time_slot" => "Time slot",
"cat_def_slot" => "Default time slot (hvis ikke sluttid angives)",
"cat_ts_no_etime" => "minutes (0: none)",
"cat_tslot_missing" => "Default time slot mangler",
"cat_tslot_invalid" => "Invalid time slot",
"cat_day_color" => "Day color",
"cat_approve" => "Begivenheder kræver godkendelse",
"cat_check_mark" => "Tjekboks",
"cat_label" => "betegnelse",
"cat_mark" => "mærke",
"cat_name_missing" => "Kategorinavn mangler",
"cat_mark_label_missing" => "Tjekmærke/betegnelse mangler",

//users.php
"usr_list_of_users" => "Liste med brugere",
"usr_name" => "Brugernavn",
"usr_email" => "Email",
"usr_group" => "Gruppe",
"usr_password" => "Password",
"usr_edit_user" => "Editer bruger profil",
"usr_add" => "Tilføj bruger",
"usr_edit" => "Editer",
"usr_delete" => "Slet",
"usr_login_0" => "Første login",
"usr_login_1" => "Sidste login",
"usr_login_cnt" => "Logins",
"usr_add_profile" => "Tilføj profil",
"usr_upd_profile" => "Opdater profiler",
"usr_if_changing_pw" => "Kun hvis password skal ændres",
"usr_pw_not_updated" => "Password ikke opdateret",
"usr_added" => "Bruger tilføjet",
"usr_updated" => "Brugerprofil opdateret",
"usr_deleted" => "Bruger slettet",
"usr_not_added" => "Bruger ikke tilføjet",
"usr_not_updated" => "Bruger ikke opdateret",
"usr_not_deleted" => "Bruger ikke slettet",
"usr_cred_required" => "Brugernavn, email og password kræves",
"usr_name_exists" => "Brugernavn findes allerede",
"usr_email_exists" => "Emailadresse findes allerede",
"usr_un_invalid" => "Ugyldigt brugernavn (min. længde 2: A-Z, a-z, 0-9, og _-.) ",
"usr_em_invalid" => "Ugyldig email addresse",
"usr_cant_delete_yourself" => "Du kan ikke slette dig selv",
"usr_go_to_groups" => "Gå til gruppe",

//groups.php
"grp_list_of_groups" => "List of Bruger Gruppe",
"grp_name" => "Gruppenavn",
"grp_privs" => "Rettigheder",
"grp_categories" => "Kategorier",
"grp_all_cats" => "alle kategorier",
"grp_rep_events" => "Repeating events",
"grp_m-d_events" => "Multi-day events",
"grp_priv_events" => "Private events",
"grp_may_post_revents" => "May post repeating events",
"grp_may_post_mevents" => "May post multi-day events",
"grp_may_post_pevents" => "May post private events",
"grp_no_overlap" => "no overlap allowed",
"grp_edit_group" => "Edit User Group",
"grp_edit" => "Editer",
"grp_delete" => "Slet",
"grp_view" => "Vise calendar",
"grp_post_own" => "Opret/editer egne events",
"grp_post_all" => "Opret/editer alle events",
"grp_manager" => "Opret/Edit + manager",
"grp_admin" => "Administrator",
"grp_add_group" => "Tilføj Gruppe",
"grp_upd_group" => "Opdater Gruppe",
"grp_no_rights" => "Ingen adgangsrettigheder",
"grp_added" => "Gruppe tilføjet",
"grp_updated" => "Gruppe opdateret",
"grp_deleted" => "Gruppe slettet",
"grp_not_added" => "Gruppe ikke tilføjet",
"grp_not_updated" => "Gruppe ikke opdateret",
"grp_not_deleted" => "Gruppe ikke slettet",
"grp_in_use" => "Gruppe er i brug",
"grp_cred_required" => "Gruppenavn, Rettigheder og Kategorier kræves",
"grp_name_exists" => "Gruppenavn findes allerede",
"grp_name_invalid" => "Ugyldigt Gruppenavn (min længde 2: A-Z, a-z, 0-9, og _-.) ",
"grp_background" => "Baggrund farve",
"grp_select_color" => "Vælg farve",
"grp_invalid_color" => "Favekode ugyldig (#XXXXXX hvor X = HEX-værdi)",
"grp_go_to_users" => "Gå til brugere",

//database.php
"mdb_dbm_functions" => "Databasefunktioner",
"mdb_noshow_tables" => "Kan ikke hente tabel(ler)",
"mdb_noshow_restore" => "Kan ikke finde backupfil",
"mdb_file_not_sql" => "Source backup file skulle være en SQL file (extension '.sql')",
"mdb_compact" => "Komprimer database",
"mdb_compact_table" => "Komprimer tabel",
"mdb_compact_error" => "Fejl",
"mdb_compact_done" => "Udført",
"mdb_purge_done" => "Slettede begivenheder fjernet permanent",
"mdb_backup" => "Backup database",
"mdb_backup_table" => "Backup tabel",
"mdb_backup_file" => "Backup fil",
"mdb_backup_done" => "Udført",
"mdb_records" => "poster",
"mdb_restore" => "Gendan database",
"mdb_restore_table" => "Gendan tabel",
"mdb_inserted" => "poster indsat",
"mdb_db_restored" => "Database gendannet.",
"mdb_no_bup_match" => "Backupfil stemte ikke overens med kalender version.<br>Database not restored.",
"mdb_events" => "Begivenheder",
"mdb_delete" => "slet",
"mdb_undelete" => "gendan",
"mdb_between_dates" => "forekommer i perioden",
"mdb_deleted" => "Begivenheder slettet",
"mdb_undeleted" => "Begivenheder gendannet",
"mdb_file_saved" => "Backupfil gemt i 'files' folder på server.",
"mdb_file_name" => "Filnavn:",
"mdb_start" => "Start",
"mdb_no_function_checked" => "Ingen funktion(er) valgt",
"mdb_write_error" => "Fejl ved skrivning af backupfil<br>Tjek rettigheder for 'files/' folderen",

//import/export.php
"iex_file" => "Valgt fil",
"iex_file_name" => "iCal filnavn",
"iex_file_description" => "iCal fil-beskrivelse",
"iex_filters" => "Begivenhed filtre",
"iex_upload_ics" => "Opload iCal-fil",
"iex_create_ics" => "Opret iCal-fil",
"iex_upload_csv" => "Opload CSV-fil",
"iex_upload_file" => "Opload fil",
"iex_create_file" => "Opret fil",
"iex_download_file" => "Download fil",
"iex_fields_sep_by" => "Felter adskilt af",
"iex_birthday_cat_id" => "Fødselsdagskategori ID",
"iex_default_cat_id" => "Standardkategori ID",
"iex_if_no_cat" => "hvis ingen kategori findes",
"iex_import_events_from_date" => "Importer begivenheder der sker efter",
"iex_see_insert" => "se vejledning i højre side",
"iex_no_file_name" => "Filnavn mangler",
"iex_inval_field_sep" => "ugyldig eller manglende felt-adskiller",
"iex_no_begin_tag" => "ugyldig iCal-fil (BEGIN-tag mangler)",
"iex_date_format" => "Begivenheds-dato-format",
"iex_time_format" => "Begivenheds-tids-format",
"iex_number_of_errors" => "Antal fejl i listen",
"iex_bgnd_highlighted" => "baggrund fremhævet",
"iex_verify_event_list" => "Verificer begivenhedsliste, korriger fejl og klik",
"iex_add_events" => "Tilføj begivenheder til database",
"iex_select_ignore_birthday" => "Vælg fødselsdag og slet markeringsfelter som ønsket",
"iex_select_ignore" => "Vælg slet markeringsfelter for at ignorere begivenheder",
"iex_title" => "Titel",
"iex_venue" => "Sted",
"iex_owner" => "Ejer",
"iex_category" => "Kategori",
"iex_date" => "Dato",
"iex_end_date" => "Slutdato",
"iex_start_time" => "Starttid",
"iex_end_time" => "Sluttid",
"iex_description" => "Beskrivelse",
"iex_repeat" => "Gentagelse",
"iex_birthday" => "Fødselsdag",
"iex_ignore" => "Slet",
"iex_events_added" => "begivenheder tilføjet",
"iex_events_dropped" => "begivenheder udeladt (findes allerede)",
"iex_db_error" => "Databasefejl",
"iex_csv_file_error_on_line" => "CSV-filfejl på linje",
"iex_ics_file_error_on_line" => "iCal-filfejl på linje",
"iex_between_dates" => "Startdato i perioden",
"iex_changed_between" => "Tilføjet/ændret i perioden",
"iex_select_date" => "Vælg dato",
"iex_select_start_date" => "Vælg startdato",
"iex_select_end_date" => "Vælg slutdato",
"iex_all_cats" => "alle kategorier",
"iex_all_users" => "alle brugere",
"iex_no_events_found" => "Ingen begivenheder fundet",
"iex_file_created" => "Fil oprettet",
"iex_write error" => "Oprettelse af eksportfil mislykkedes<br>Tjek rettigheder for folderen 'files/'",

//lcalcron.php
"cro_sum_header" => "CRON JOB OVERSIGT",
"cro_sum_trailer" => "SLUT PÅ OVERSIGT",
"cro_evc_sum_title" => "BEGIVENHEDER UDLØBET",
"cro_nr_evts_deleted" => "Antal begivenheder slettet",
"cro_not_sum_title" => "EMAIL PÅMINDELSER",
"cro_not_sent_to" => "Påmindelser sendt til",
"cro_no_not_dates_due" => "Ingen påmindelsesdatoer nået",
"cro_all_day" => "Hele dagen",
"cro_mailer" => "mailer",
"cro_subject" => "Emne",
"cro_event_due_in" => "Følgende begivenhed sker om",
"cro_event_due_today" => "Følgende begivenhed sker i dag",
"cro_due_in" => "Sker om",
"cro_due_today" => "Sker i dag",
"cro_days" => "dag(e)",
"cro_date_time" => "Dato /tid",
"cro_title" => "Titel",
"cro_venue" => "Sted",
"cro_description" => "Beskrivelse",
"cro_category" => "Kategori",
"cro_status" => "Status",
"cro_open_calendar" => "Åben kalender",
"cro_chg_sum_title" => "KALENDER ÆNDRINGER",
"cro_nr_changes_last" => "Antal ændringer de seneste",
"cro_report_sent_to" => "Rapport sendt til",
"cro_no_report_sent" => "Ingen rapport emailet",
"cro_usc_sum_title" => "BRUGERPROFILER UDLØBET",
"cro_nr_accounts_deleted" => "Antal profiler slettet",
"cro_no_accounts_deleted" => "Ingen profiler slettet",
"cro_ice_sum_title" => "EKSPORTEREDE  BEGIVENHEDER",
"cro_nr_events_exported" => "Antal begivenheder eksporteret i iCalendar format til fil",

//explanations
"xpl_manage_db" =>
"<h4>Vedligehold Database vejledning</h4>
<p>På denne side kan følgende funktioner vælges:</p>
<h5>Komprimer database</h5>
<p>Når en bruger sletter en begivenhed, vil begivenheden blive markeret som 'slettet', men den fjernes ikke fra databasen. Komprimer Database funktionen fjerner begivenheder permanent, hvis det er mere end 30 dage siden de blev slettet, for at frigøre plads i databasen.</p>
<h5>Backup database</h5>
<p>Denne funktion vil oprette en backup af hele kalenderdatabasen (tabellernes struktur og indhold) i .sql format. Backupfilen gemmes i <strong>files/</strong> folderen med filnavn: 
<kbd>cal-dump-ååååmmdd-ttmmss.sql</kbd> (hvor 'ååååmmdd' = år, måned og dag, og ttmmss = time, minut og sekund.</p>
<p>Backupfilen kan bruges til at gendanne kalenderdatabasen (struktur og data), via gendannelsesfunktionnen beskrevet nedenfor, eller ved at bruge fx
<strong>phpMyAdmin</strong> værktøjet, som de fleste webhoteller stiller til rådighed.</p>
<h5>Gendan database</h5>
<p>Denne funktion vil gendanne kalenderdatabasen ud fra indholdet af den oploadede backup file (file type .sql).</p>
<p>Når databasen gendannes, vil ALLE NUVÆRENDE DATA VÆRE FJERNET! Kun de gendannede data vil være tilstede.</p>
<h5>Begivenheder</h5>
<p>Denne funktion vil slette eller gendanne begivenheder, som forekommer mellem de angivne datoer. Hvis et datofelt er tomt, vil der ikke være nogen grænse; så hvis begge datofelter er tomme, VIL ALLE BEGIVENHEDER BLIVE SLETTET!</p><br>
<p>VIGTIGT: Når databasen bliver komprimeret (se ovenfor), vil begivenheder som fjernes permanent fra databasen ikke længere kunne gendannes!</p>",

"xpl_import_csv" =>
"<h4>CSV import-vejledning</h4>
<p>Denne formular bruges til at importere en <strong>kommasepareret (CSV)</strong> tekst-fil med begivenheder til LuxCal kalenderen.</p>
<p>Rækkefølgen af kolonner i CSV-filen skal være: titel, sted, kategori-id (se herunder), dato, slutdato, starttid, sluttid og beskrivelse. Første række i CSV-filen, der bruges til kolonnebeskrivelser, ignoreres.</p>
<h5>Eksempel CSV-filer</h5>
<p>Eksempel CSV-filer findes i folderen 'files/' i din LuxCal-download.</p>
<h5>Dato- og tidsformat</h5>
<p>Det valgte begivenheds datoformat og begivenheds tidsformat til venstre skal passe til formatet for datoer og tider i den oploadede CSV-fil.</p>
<h5>Tabel med kategorier</h5>
<p>Kalenderen bruger ID-numre til at angive kategorier. Kategori-ID'erne i CSV-filen skal svare til kategorierne brugt i kalenderen eller være tomme.</p>
<p>Hvis du i næste skridt vil markere en begivenhed som 'fødselsdag', skal <strong>fødselsdags-
kategorien</strong> sættes til den tilsvarende ID i kategorilisten herunder.</p>
<p class='hilight'>ADVARSEL: Importer ikke mere end 100 begivenheder af gangen!</p>
<p>I din kalender er de følgende kategorier defineret i øjeblikket:</p>",

"xpl_import_ical" =>
"<h4>iCalendar import-vejledning</h4>
<p>Denne formular bruges til at importere en <strong>iCalendar</strong>-fil med begivenheder til LuxCal-kalender.</p>
<p>Filindholdet skal svare til standarden [<u><a href='http://tools.ietf.org/html/rfc5545' 
target='_blank'>RFC5545</a></u>] fra Internet Engineering Task Force.</p>
<p>Kun begivenheder importeres; andre iCal-komponenter, som: To-Do, Journal, Fri / optaget, Tidszone og Alarm, ignoreres.</p>
<p>Eksempel iCalendar-filer kan findes i folderen 'files/' i din LuxCal download.</p>
<h5>Tabel med kategorier</h5>
<p>Kalenderen bruger ID-numre til at angive kategorier. Kategori-ID'er i iCalendar-filen skal svare til kategorierne brugt i din kalender eller være tomme.</p>
<p class='hilight'>Advarsel: Importer ikke mere end 100 begivenheder af gangen!</p>
<p>I din kalender er de følgende kategorier defineret i øjeblikket:</p>",

"xpl_export_ical" =>
"<h4>iCalendar eksport-vejledning</h4>
<p>Denne formular bruges til at udlæse og eksportere <strong>iCalendar</strong> begivenheder fra LuxCal kalenderen.</p>
<p><b>iCal filnavnet</b> (uden extension) er valgfrit. 
Oprettede filer bliver gemt med det angivne filnavn på serveren i folderen \"files/\", eller med kalenderens navn hvis filnavn ikke er angivet. Filens extension vil være <b>.ics</b>.
En evt. eksisterende fil med det samme navn i folderen \"files/\" på serveren vil blive overskrevet af den nye fil.</p>
<p>iCal filbeskrivelsen (f.eks. 'Møder 2013') er valgfri. Hvis det indtastes, tilføjes det til headeren i den eksporterede iCal-fil.</p>
<p>Begivenhed filtre: De eksporterede begivenheder kan filtreres med:</p>
<ul>
<li>begivenhedsejer</li>
<li>begivenhedskategori</li>
<li>begivenhedsstartdato</li>
<li>begivenheds tilføjet/sidste ændringsdato</li>
</ul>
<p>Hvert filter er valgfrit. En blank dato betyder: ingen grænser</p>
<br>
<p>Indholdet af filen med udlæste begivenheder vil svare til standarden 
[<u><a href='http://tools.ietf.org/html/rfc5545' target='_blank'>RFC5545</a></u>] 
fra Internet Engineering Task Force.</p>
<p>Ved <b>download</b> af den eksporterede iCal fil vil dato og tid blive tilføjet til navnet på den downloadede fil.</p>
<p>Eksempel iCalendar-filer kan findes i folderen 'files/' i din LuxCal download.</p>"
);
?>
