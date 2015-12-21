<?php
/*
= LuxCal event calendar admin interface language file =

This file has been produced by LuxSoft. Please send comments / improvements to rb@luxsoft.eu.

Translation to swedish by Christer "Scunder" Nordahl.

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//LuxCal ui language file version
define("LAI","4.3.0");

/* -- Admin Interface texts (ai) -- */

$ax = array(

//general
"none" => "Inga",
"all" => "Alla",
"back" => "Tillbaka",
"close" => "Stäng",
"always" => "alltid",
"at_time" => "kl", //datum och tid avskiljare (t.ex. 10-04-2016 kl 10:45)
"year" => "År",
"month" => "Månad",
"week_day" => "Vecka/Dag",
"upcoming" => "Kommande",
"id" => "ID",

//settings.php - fieldset headers + general
"set_general_settings" => "Allmänt",
"set_navbar_settings" => "Verktygsfält",
"set_event_settings" => "Händelser",
"set_user_settings" => "Användarkonton",
"set_email_settings" => "Epost-inställningar",
"set_perfun_settings" => "Schemalagda funktioner (endast om \'Cron Job\' används)",
"set_minical_settings" => "Minikalender (endast vid användning)",
"set_sidebar_settings" => "Fristående sidopanel (endast vid användning)",
"set_view_settings" => "Visningar",
"set_dt_settings" => "Datum/tid",
"set_save_settings" => "Spara inställningar",
"set_test_mail" => "Epost-test",
"set_mail_sent_to" => "Epost-test skickades till",
"set_mail_sent_from" => "Denna epost-test skickades från din kalenders Inställningssida",
"set_missing_invalid" => "saknade eller felaktiga inställningar (se markerad text)",
"set_settings_saved" => "Inställningar sparade",
"set_save_error" => "Fel i databas - inställningar ej sparade",
"hover_for_details" => "Peka på rubriker för förklaringar",
"default" => "förinställt",
"enabled" => "aktiverat",
"disabled" => "inaktiverat",
"no" => "nej",
"yes" => "ja",
"or" => "eller",
"minutes" => "minuter",
"pixels" => "punkter",
"no_way" => "Du har inte behörighet att utföra denna funktion",

//settings.php - general settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"calVersionDb_label" => "Kalenderversion - Databas",
"calVersionDb_text" => "Programvaruversion av den installerade kalendern och mappen/namnet på den aktuella SQLite databasfilen.",
"calTitle_label" => "Kalendertitel",
"calTitle_text" => "Visas i kalenderns namnlist och i epostmeddelanden.",
"calUrl_label" => "Kalenderns URL (Internet-länk)",
"calUrl_text" => "Kalenderns hemsidesadress.",
"calEmail_label" => "Kalenderns epostadress",
"calEmail_text" => "Epostadressen som används för att sända och ta emot meddelanden.<br>Format: \'e-post\' eller \'namn&#8249;e-post&#8250;\'.",
"backLinkUrl_label" => "Länk till ursprungssida",
"backLinkUrl_text" => "URL till ursprungssida. En \'Tillbaka\'-knapp som länkar till angiven plats kommer att visas till vänster i verktygsfältet.<br>Kan användas t.ex. för att användaren lätt ska kunna återvända till den sida Kalendern startades ifrån.",
"timeZone_label" => "Tidszon",
"timeZone_text" => "Kalenderns tidszon som används till att beräkna tidpunkter.", 
"see" => "se",
"notifSender_label" => "Avsändare för epostmeddelanden",
"notifSender_text" => "När kalendern skickar epostmeddelanden anges avsändaren som antingen kalenderadressen eller som adressen till den användare som skapade händelsen.<br>Om man anger användarens epostadress så kan mottagaren svara på meddelandet.",
"rssFeed_label" => "Länkar för RSS-flöde",
"rssFeed_text" => "Om aktiverat: För användare med rättigheter att visa kalendern blir en \'RSS feed link\' synlig i kalenderns sidfot, och en länk för RSS-flöde kommer att infogas i kalendersidornas HTML-huvud.",
"calendar" => "kalender",
"user" => "användare",
"php_mail" => "PHP epost",
"smtp_mail" => "SMTP epost",

//settings.php - navigation bar settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"navButText_label" => "Verktygsfältsknappar med text",
"navButText_text" => "Välj detta alternativ om verktygsfältets ikoner ska ersättas med text.",
"sideLists_label" => "Knapparna To Approve / Att-göra/Kommande händelser",
"sideLists_text" => "If enabled: A To Approve / Todo / Upcoming button will be displayed on the navigation bar, which when clicked will open the Events to be approved list / Todo list / Upcoming list.<br> The Events to be approved list will only be available to users with manager rights or higher.",
"navToapList_label" => "To approve button",
"navTodoList_label" => "Att-göra lista",
"navUpcoList_label" => "Kommande händelser",
"optionsPanel_label" => "Alternativ-menyer",
"optionsPanel_text" => "Visa/dölj menyer under verktygsfältets Alternativ-knapp.<br>• Kalendermenyn (synlig endast för administratör) används för att byta kalender (om flera kalendrar är installerade).<br>• The groups menu can be used to display only events created by users in the selected groups.<br>• Användarmenyn används för att visa en speciell användares händelser.<br>• Kategorimenyn för att visa en speciell kategori av händelser.<br>• Språkmenyn används för att ändra användargränssnittets språk (om flera språk är installerade).",
"calMenu_label" => "kalender",
"groupMenu_label" => "groups",
"userMenu_label" => "användare",
"catMenu_label" => "kategorier",
"langMenu_label" => "språk",
"defaultView_label" => "Standardvisning vid start",
"defaultView_text" => "Välj hur kalendern ska visas vid start.<br>Rekommenderat val: Månad eller Kommande.",
"language_label" => "Förinställt språk för användargränssnittet",
"language_text" => "Filerna ui-{språk}.php, ai-{språk}.php, ug-{språk}.php och ug-layout.png ska finnas i lang/ mappen. {språk} = det valda språket till användargränssnittet. Filnamnet ska skrivas med små bokstäver!",

//settings.php - events settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"ownerTitle_label" => "Show event owner in front of event title",
"ownerTitle_text" => "In the various calendar views, show the event owner name in front of the calendar title.",
"privEvents_label" => "Skapa privata händelser",
"privEvents_text" => "Privata händelser visas bara för användaren som skapade dom.<br>Aktiverat: Användare kan skapa privata händelser.<br>Förinställt: När ny händelse skapas är alternativrutan \'privat\' normalt markerad.<br>Alltid: När ny händelse skapas blir den alltid privat och alternativrutan \'privat\' i händelsefönstret visas inte.",
"details4All_label" => "Visa händelsedetaljer för användarna",
"details4All_text" => "Inaktiverat: Händelsedetaljer är bara synliga för den som skapade händelsen och för användare med rättigheter att skapa/redigera alla händelser.<br>Aktiverat: Händelsedetaljer är synliga för alla användare.<br>Inloggad: Händelsedetaljer är synliga för den som skapade händelsen och för inloggade användare.",
"evtDelButton_label" => "Visa \'Radera\'-knapp i händelsefönstret",
"evtDelButton_text" => "Inaktiverad: \'Radera\'-knappen i händelsefönstret visas inte. Användare med rätt att redigera kan ej radera händelser.<br>Aktiverad: \'Radera\'-knappen i händelsefönstret visas för alla användare.<br>Administratör: \'Radera\'-knappen i händelsefönstret visas endast för användare med administratörs-rättigheter.",
"eventColor_label" => "Händelsers färger baserade på",
"eventColor_text" => "Händelser i de olika kalendervisningarna kan visas i den färg som är kopplad till den grupp till vilken personen som skapade händelsen tillhör, eller i den färg som är kopplad till kategorin.",
"xField1_label" => "Extra fält 1",
"xField2_label" => "Extra fält 2",
"xFieldx_text" => "Frivilligt textfält. Om detta fält inkluderas i händelsemallen framöver, kommer fältet (textfält i fritt format) att ingå i händelseformuläret och i händelser som visas i alla kalendervisningar och sidor.<br>• etikett: frivillig textetikett för det extra fältet (max. 15 tecken). Exempelvis \'Epostadress\', \'Websida\', \'Telefonnummer\'.<br>• offentlig: fältet är synligt för alla användare (annars är det bara synligt för inloggade användare.",
"xField_label" => "etikett",
"xField_public" => "offentlig",
"logged_in" => "inloggad",
"manager_only" => "administratör",
"user_group" => "användargrupp",
"event_cat" => "händelsekategori",

//settings.php - user accounts settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"selfReg_label" => "Självregistrering",
"selfReg_text" => "Tillåt användare att registrera sig själva för att få tillgång till kalendern.",
"selfRegGrp_label" => "Användargrupp för självregistrerade",
"selfRegGrp_text" => "Den användargrupp som självregistrerade kommer att tillhöra.",
"selfRegNot_label" => "Meddelande om självregistrering",
"selfRegNot_text" => "Skicka ett epostmeddelande till kalenderns epostadress när en självregistrering sker.",
"restLastSel_label" => "Återställ senaste användarval",
"restLastSel_text" => "En användares senaste inställningar på Alternativpanelen sparas, och aktiveras åter vid användarens nästa inloggning.",
"cookieExp_label" => "Giltighetsdagar för \'Kom-ihåg-mig\' cookie",
"cookieExp_text" => "Antal dagar innan cookien (aktiverad vid inloggning genom \'Kom-ihåg-mig\' valet) förfaller.",
"view" => "visa",
"post_own" => "spara/redigera egna",
"post_all" => "spara/redigera alla",
"manager" => "spara/administratör",

//settings.php - view settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"evtTemplGen_label" => "Händelsers visningsstruktur",
"evtTemplGen_text" => "De händelsefält som ska visas i de olika kalendervisningarna kan väljas med hjälp av en siffersekvens.<br>Om en viss siffra finns med i sekvensen så kommer motsvarande fält att visas i angiven ordning.",
"evtTemplUpc_label" => "Visning av kommande händelser",
"evtTemplUpc_text" => "De händelsefält som ska visas i visning av kommande händelser kan väljas med hjälp av en siffersekvens.<br>Om en viss siffra finns med i sekvensen så kommer motsvarande fält att visas i angiven ordning.",
"popBoxFields_label" => "Inforutans händelsefält",
"popBoxFields_text" => "De händelsefält som ska visas i inforutan i de olika kalendervisningarna kan väljas med hjälp av en siffersekvens. <br>Varje siffra i sekvensen motsvarar ett av fälten som ska visas.<br>Om inga fält anges visas inte inforutan alls.",
"templFields_text" => "Siffrorna motsvarar:<br>1: Titelfält<br>2: Kategorifält<br>3: Beskrivningsfält<br>4: Extrafält 1 (se nedan)<br>5: Extrafält 2 (se nedan)<br>6: Epostadress (endast om ett meddelande har begärts)<br>7: Datum/tid skapad/ändrad och den eller de användare som sparat händelsen.<br>Siffrornas turordning bestämmer fältens visningsföljd.",
"popBoxShow_label" => "Inforuta med händelsedetaljer",
"popBoxShow_text" => "Ett minifönster med händelsedetaljer (inforuta) visas när man pekar på en händelse. Inforutan visas endast om minst 1 siffra angetts i 'Inforutans händelsefält' (se ovan).",
"yearStart_label" => "Startmånad i Årsvisning",
"yearStart_text" => "Om en startmånad har angetts (1-12), kommer Årsvisning alltid att börja med denna månad och visa 12 månader framåt.<br>Anges värdet 0 kommer alltid den aktuella månaden (innehållande visningsdagens datum) att vara den första i visningen.",
"colsToShow_label" => "Antal kolumner i årsvisning",
"colsToShow_text" => "Antal månader som ska visas på varje rad i årsvisning.<br>Rekommenderat val: 3 eller 4.",
"rowsToShow_label" => "Antal rader i års-visning",
"rowsToShow_text" => "Antal rader av månader som ska visas i årsvisningen.<br>Observera! Årsvisningen kan visa mer eller mindre är 1 år. T.ex. är 4 kolumner * 3 rader = 12 månader, medan 4 kolumner * 4 rader = 16 månader.",
"weeksToShow_label" => "Antal veckor i månadsvisning",
"weeksToShow_text" => "Antal veckor som ska visas i månadsvisning.<br>Rekommenderat val: 10, vilket ger 2,5 månader att scrolla igenom.<br>Värdena 0 och 1 har speciella betydelser:<br>0: visa exakt en månad med föregående och följande tomma rutor.<br>1: visa exakt en månad med innehåll i föregående och följande rutor.",
"workWeekDays_label" => "Arbetsveckodagar",
"workWeekDays_text" => "Bestämmer vilka veckodagar som ska visas i visningarna Arbetsvecka och Arbetsmånad.<br>Ange siffran för varje veckodag som ska visas. Giltiga värden:<br>1 = Måndag<br>2 = Tisdag<br>....<br>7 = Sunday<br>T.ex. 12345 = Måndag-Fredag",
"lookaheadDays_label" => "Antal dagar framöver",
"lookaheadDays_text" => "Antal dagar som ska visas framöver i visningarna Kommande händelser, Att-göra lista och i RSS-flöden.",
"dwStartHour_label" => "Starttimma i Dag- och Veckovisning",
"dwStartHour_text" => "Den timma då en normal dags händelser startar.<br>Om man t.ex. anger värdet 6 så undviker man att slösa utrymme i visningen för den lugna tiden mellan midnatt och 6:00.<br>Tidsmenyn som kan användas för att ange tid för händelse kommer också att starta vid samma tidpunkt.",
"dwEndHour_label" => "Sluttimma i Dag- och Veckovisning",
"dwEndHour_text" => "Den timma då en normal dags händelser slutar.<br>Om man t.ex. anger värdet 18 så undviker man att slösa utrymme i visningen för den lugna tiden mellan 18:00 och midnatt.<br>Tidsmenyn som kan användas för att ange tid för händelse kommer också att sluta vid samma tidpunkt.",
"dwTimeSlot_label" => "Tidsintervall i Dag- och Veckovisning",
"dwTimeSlot_text" => "Antal minuter för varje rad (tidsintervall) i visningarna Dag/Vecka.<br>Detta värde avgör tillsammans med Start- och Sluttimma (se ovan) antalet rader i Dag- och Veckovisning.",
"dwTsHeight_label" => "Radhöjd i Dag- och Veckovisning",
"dwTsHeight_text" => "Radhöjden (angivet i punkter) för varje rad i Dag- och Veckovisning.",
"showInMView_label" => "Visa i Månadsvy",
"showInMView_text" => "Välj visning av URL:er och bilder i en händelses beskrivningsfält.<br>En URL visas som en aktiv hyperlänk.",
"urls" => "URL länkar",
"images" => "bilder",
"monthInDCell_label" => "Månadsnamn i varje cell",
"monthInDCell_text" => "Visa månadsförkortning på varje dag i Månadsvisning",

//settings.php - date/time settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"dateFormat_label" => "Händelsers datumformat (dd mm yyyy)",
"dateFormat_text" => "En textsträng som definierar händelsers datumformat i kalendervisningar och inmatningsfält.<br>Giltiga tecken: y = år, m = månad och d = dag.<br>Icke alfanumeriska tecken kan användas som skiljetecken och visas då exakt som angivits.<br>Exempelvis:<br>y-m-d: 2013-10-31<br>m.d.y: 10.31.2013<br>d/m/y: 31/10/2013",
"dateFormat_expl" => "T.ex. y.m.d: 2013.10.31",
"MdFormat_label" => "Datumformat (dd month)",
"MdFormat_text" => "En textsträng som definierar datumformat bestående av månad och dag.<br>Giltiga tecken: M = månad i text, d = dag med siffror.<br>Icke alfanumeriska tecken kan användas som skiljetecken och visas då exakt som angivits.<br>Exempelvis:<br>d M: 12 April<br>M, d: Juli, 14",
"MdFormat_expl" => "T.ex. M, d: Juli, 14",
"MdyFormat_label" => "Datumformat (dd month yyyy)",
"MdyFormat_text" => "En textsträng som definierar datumformat bestående av dag, månad och år.<br>Giltiga tecken: d = dag med siffror, M = månad i text, y = år med siffror.<br>Icke alfanumeriska tecken kan användas som skiljetecken och visas då exakt som angivits.<br>Exempelvis:<br>d M y: 12 April 2013<br>M d, y: Juli 8, 2013",
"MdyFormat_expl" => "T.ex. M d, y: Juli 8, 2013",
"MyFormat_label" => "Datumformat (month yyyy)",
"MyFormat_text" => "En textsträng som definierar datumformat bestående av månad och år.<br>Giltiga tecken: M = månad i text, y = år med siffror.<br>Icke alfanumeriska tecken kan användas som skiljetecken och visas då exakt som angivits.<br>Exempelvis:<br>M y: April 2013<br>y - M: 2013 - Juli",
"MyFormat_expl" => "T.ex. M y: April 2013",
"DMdFormat_label" => "Datumformat (weekday dd month)",
"DMdFormat_text" => "En textsträng som definierar datumformat bestående av veckodag, dag och månad.<br>Giltiga tecken: WD = veckodag i text, M = månad i text, d = dag med siffror.<br>Icke alfanumeriska tecken kan användas som skiljetecken och visas då exakt som angivits.<br>Exempelvis:<br>WD d M: Fredag 12 April<br>WD, M d: Måndag, Juli 14",
"DMdFormat_expl" => "T.ex. WD - M d: Söndag - April 6",
"DMdyFormat_label" => "Datumformat (weekday dd month yyyy)",
"DMdyFormat_text" => "En textsträng som definierar datumformat bestående av veckodag, dag, månad och år.<br>Giltiga tecken: WD = veckodag i text, M = månad i text, d = dag med siffror, y = år med siffror.<br>Icke alfanumeriska tecken kan användas som skiljetecken och visas då exakt som angivits.<br>Exempelvis:<br>WD d M y: Fredag 13 April 2013<br>WD - M d, y: Måndag - Juli 16, 2013",
"DMdyFormat_expl" => "T.ex. WD, M d, y: Måndag, Juli 16, 2013",
"timeFormat_label" => "Tidsformat (hh mm)",
"timeFormat_text" => "En textsträng som definierar händelsers tidsformat i kalendervisningar och inmatningsfält.<br>Giltiga tecken: h = timmar, H = timmar med inledande nollor, m = minuter, a = am/pm (frivilligt), A = AM/PM (frivilligt).<br>Icke alfanumeriska tecken kan användas som skiljetecken och visas då exakt som angivits.<br>Exempelvis:<br>h:m: 18:35<br>h.m a: 6.35 pm<br>H:mA: 06:35PM",
"timeFormat_expl" => "T.ex. h:m: 22:35 och h:mA: 10:35PM",
"weekStart_label" => "Veckans första dag",
"weekStart_text" => "Ev vecka kan starta med söndag eller måndag.",
"weekNumber_label" => "Visa veckonummer",
"weekNumber_text" => "Veckonummer kan visas i visningarna för År, Månad och Vecka.",
"time_format_us" => "12-timmar AM/PM",
"time_format_eu" => "24-timmar",
"sunday" => "Söndag",
"monday" => "Måndag",
"time_zones" => "TIDSZONER",
"dd_mm_yyyy" => "dd-mm-yyyy",
"mm_dd_yyyy" => "mm-dd-yyyy",
"yyyy_mm_dd" => "yyyy-mm-dd",

//settings.php - email settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"mailServer_label" => "Epost-server",
"mailServer_text" => "PHP epost lämpar sig för oautentiserad epost i små mängder. För större mängder epost eller när det krävs autentisering bör SMTP epost användas.<br>Användande av SMTP epost kräver en SMTP epost-server. Konfigurations-inställningarna för SMTP server måste anges här nedan. Om epost är inaktiverat kommer Epost-alternativen i händelsefönstret att inaktiveras.",
"smtpServer_label" => "SMTP servernamn",
"smtpServer_text" => "Om SMTP epost är valt ska SMTP servernamn anges här. Till exempel - gmail SMTP server: smtp.gmail.com.",
"smtpPort_label" => "SMTP portnummer",
"smtpPort_text" => "Om SMTP epost är valt ska SMTP portnummer anges här. Till exempel 25, 465 or 587. (Gmail använder portnummer 465.)",
"smtpSsl_label" => "SSL (Secure Sockets Layer)",
"smtpSsl_text" => "Om SMTP epost är valt, välj då här ifall secure sockets layer (SSL) ska vara aktiverat. För gmail: enabled",
"smtpAuth_label" => "SMTP autentisering",
"smtpAuth_text" => "Om SMTP autentisering är valt kommer användarnamn och lösenord specificerat här nedan att användas för att autentisera SMTP epost.",
"smtpUser_label" => "SMTP användarnamn",
"smtpUser_text" => "Om SMTP epost är valt, ange här användarnamnet för SMTP. För gmail är användarnamnet den delen av din epostadress som är framför tecknet @ (snabel-a).",
"smtpPass_label" => "SMTP lösenord",
"smtpPass_text" => "Om SMTP epost är valt, ange då här lösenordet för SMTP.",

//settings.php - periodic function settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"cronSummary_label" => "Admin Cron Job sammanställning",
"cronSummary_text" => "Skicka en Cron Job sammanställning till kalenderns administratör.<br>Endast användbart om ett Cron Job har aktiverats för kalendern.",
"chgEmailList_label" => "Epostmottagare för ändringar",
"chgEmailList_text" => "Epostmottagare som regelbundet mottager ett epostmeddelande med kalender-ändringar.<br>Flera epostadresser ska avskiljas med semikolon.",
"chgNofDays_label" => "Dagar bakåt att söka ändringar",
"chgNofDays_text" => "Antal dagar att se tillbaka i tiden för sammanställning av kalender-ändringar.<br>Om antal dagar anges med 0 (eller om inget Cron Job är aktiverat) så kommer ingen sammanställning att skickas.",
"icsExport_label" => "Daglig iCal-export av händelser",
"icsExport_text" => "Alla händelser 1 vecka bakåt i tiden till 1 år framåt kan exporteras i iCalendar format som en .ics fil i \'files\' mappen.<br>Filnamnet blir kalenderns namn med blanksteg ersatta av understrykningstecken. Äldre filer ersätts av nya filer.",
"eventExp_label" => "Händelsers förfallodagar",
"eventExp_text" => "Antal dagar efter händelsedatum då händelsen förfaller och raderas.<br>Om antal dagar anges med 0 (eller om inget Cron Job är aktiverat) så kommer inga händelser att raderas.",
"maxNoLogin_label" => "Max antal dagar ej inloggad",
"maxNoLogin_text" => "Om en användare inte varit inloggad x antal dagar kommer dennes konto att raderas.<br>Om antal dagar anges med 0 kommer användarkonton aldrig att raderas.",

//settings.php - mini calendar / sidebar settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"miniCalView_label" => "Minikalenderns visning",
"miniCalView_text" => "Möjliga visningar för minikalendern är:<br>• Månad<br>• Arbetsmånad *)<br>• Vecka<br>• Arbetsvecka *)<br>*) För bestämning av arbetsdagar se sida: Visning - Arbetsdagar",
"miniCalPost_label" => "Minikalendar Skapa händelse",
"miniCalPost_text" => "Vid aktivering kan användare:<br>• skapa nya händelser i minikalendern genom att klicka överst i cellen<br>• ändra/radera händelser genom att klicka i händelserutan<br>Observera: Gästanvändarens rättigheter gäller.",
"popFieldsMcal_label" => "Händelsefält i minikalenderns inforuta",
"popFieldsMcal_text" => "De händelsefält som ska visas i inforutan när användaren pekar på en händelse i minikalendern kan väljas med hjälp av en siffersekvens.<br>Om inga fält väljs visas inte inforutan.",
"mCalUrlFull_label" => "Minikalenderns URL till full kalender",
"mCalUrlFull_text" => "Genom att klicka på månaden överst i minikalendern omdirigeras användaren via denna URL till den fulla kalendern.<br>Om ingen URL anges öppnas den fulla kalendern i ett nytt fönster.<br>Denna URL är speciellt användbar när den fulla kalendern är inbäddad i en existerande användarsida.",
"popFieldsSbar_label" => "Händelsefält i sidopanelens inforuta",
"popFieldsSbar_text" => "De händelsefält som ska visas i inforutan när användaren pekar på en händelse i den fristående sidopanelen kan väljas med hjälp av en siffersekvens.<br>Om inga fält väljs visas inte inforutan.",
"showLinkInSB_label" => "Visa länkar i sidopanelen",
"showLinkInSB_text" => "Visa URL:er i händelsers beskrivningsfält som aktiva hyperlänkar i sidopanelens Kommande-visning.",
"sideBarDays_label" => "Antal dagar framöver i sidopanelen",
"sideBarDays_text" => "Ange de antal dagar framåt i tiden som ska visas i sidopanelen.",

//login.php
"log_log_in" => "Logga in",
"log_remember_me" => "Kom ihåg mig",
"log_register" => "Registrera dig",
"log_change_my_data" => "Ändra mina uppgifter", 
"log_change" => "Ändra", 
"log_un_or_em" => "Användarnamn eller Epost",
"log_un" => "Användarnamn",
"log_em" => "Epost",
"log_pw" => "Lösenord",
"log_new_un" => "Nytt användarnamn",
"log_new_em" => "Ny epostadress",
"log_new_pw" => "Nytt lösenord",
"log_pw_msg" => "Här är dina inloggningsuppgifter för kalender",
"log_pw_subject" => "Ditt %% lösenord", //%% will be replaced by calendar name
"log_npw_subject" => "Ditt nya %% lösenord", //%% will be replaced by calendar name
"log_npw_sent" => "Ditt nya lösenord har skickats",
"log_registered" => "Registreringen lyckades - ditt lösenord har skickats till dig via epost.", 
"log_not_registered" => "Registrering misslyckades",
"log_un_exists" => "Användarnamnet är upptaget",
"log_em_exists" => "Epostadressen är upptagen",
"log_un_invalid" => "Ogiltigt användarnamn (min. längd 2: A-Z, a-z, 0-9, och _-.) ",
"log_em_invalid" => "Ogiltig epostadress",
"log_un_em_invalid" => "Användarnamn/e-post är ogiltigt",
"log_un_em_pw_invalid" => "Ditt användarnamn/e-post eller lösenord är ogiltigt",
"log_no_un_em" => "Ange ditt användarnamn/e-post", 
"log_no_un" => "Ange ditt användarnamn",
"log_no_em" => "Ange din epostadress",
"log_no_pw" => "Ange ditt lösenord",
"log_no_rights" => "Inloggning avvisades: du har inga visningsrättigheter - Kontakta administratören",//
"log_send_new_pw" => "Skicka nytt lösenord",
"log_if_changing" => "Bara vid ändring av",
"log_no_new_data" => "Ingen uppgift att ändra",
"log_invalid_new_un" => "Ogiltigt nytt användarnamn (min. längd 2: A-Z, a-z, 0-9, og _-.) ",
"log_new_un_exists" => "Nytt användarnamn är upptaget",
"log_invalid_new_em" => "Ny epostadress är ogiltig",
"log_new_em_exists" => "Ny epostadress är upptagen",
"log_ui_language" => "Användargränssnittets språk",
"log_new_reg" => "Registrera ny användare",
"log_date_time" => "Datum / tid",
"log_time_out" => "Time out",

//categories.php
"cat_list" => "Kategorilista",
"cat_edit" => "Redigera",
"cat_delete" => "Radera",
"cat_add_new" => "Skapa ny kategori",
"cat_add" => "Skapa",
"cat_edit_cat" => "Redigera kategori",
"cat_sort" => "Sortera efter namn",
"cat_name" => "Kategorinamn", 
"cat_sequence" => "Sekvens",
"cat_in_menu" => "i meny",
"cat_text_color" => "Textfärg",
"cat_background" => "Bakgrund",
"cat_select_color" => "Välj färg",
"cat_save" => "Spara",
"cat_added" => "Kategori skapad",
"cat_updated" => "Kategori uppdaterad",
"cat_deleted" => "Kategori raderad",
"cat_invalid_color" => "Färgformat ogiltigt (#XXXXXX där X = HEX-värde)",
"cat_not_added" => "Kategori ej skapad",
"cat_not_updated" => "Kategori ej uppdaterad",
"cat_not_deleted" => "Kategori ej raderad",
"cat_nr" => "#",
"cat_repeat" => "Repetera",
"cat_every_day" => "varje dag",
"cat_every_week" => "varje vecka",
"cat_every_month" => "varje månad",
"cat_every_year" => "varje år",
"cat_overlap" => "Overlap allowed",
"cat_no_overlap" => "No overlap allowed",
"cat_ol_error_text" => "error text, if overlap",
"cat_no_ol_note" => "Note that already existing events are not checked and consequently may overlap",
"cat_ol_error_msg" => "event overlap; select an other time",
"cat_time_slot" => "Time slot",
"cat_def_slot" => "Default time slot (if no end time specified)",
"cat_ts_no_etime" => "minutes (0: none)",
"cat_tslot_missing" => "Default time slot is missing",
"cat_tslot_invalid" => "Invalid time slot",
"cat_day_color" => "Färg på dag",
"cat_approve" => "Händelser behöver godkännas",
"cat_check_mark" => "Markeringstecken",
"cat_label" => "etikett",
"cat_mark" => "markering",
"cat_name_missing" => "Kategorinamn saknas",
"cat_mark_label_missing" => "Markerings-tecken/etikett saknas",

//users.php
"usr_list_of_users" => "Användarlista",
"usr_name" => "Användarnamn",
"usr_email" => "Epost",
"usr_group" => "Grupp",
"usr_password" => "Lösenord",
"usr_edit_user" => "Redigera användarprofil",
"usr_add" => "Skapa användare", 
"usr_edit" => "Redigera",
"usr_delete" => "Radera",
"usr_login_0" => "Första inloggning",
"usr_login_1" => "Senaste inloggning",
"usr_login_cnt" => "Inloggningar",
"usr_add_profile" => "Skapa profil",
"usr_upd_profile" => "Uppdatera profil",
"usr_if_changing_pw" => "Bara om lösenordet ska ändras",
"usr_pw_not_updated" => "Lösenord ej uppdaterat",
"usr_added" => "Användare skapad",
"usr_updated" => "Användarprofil uppdaterad",
"usr_deleted" => "Användare raderad",
"usr_not_added" => "Användare ej skapad",
"usr_not_updated" => "Användare ej uppdaterad",
"usr_not_deleted" => "Användare ej raderad",
"usr_cred_required" => "Användarnamn, epost och lösenord krävs",
"usr_name_exists" => "Användarnamn upptaget",
"usr_email_exists" => "Epostadress upptagen",
"usr_un_invalid" => "Ogiltigt användarnamn (min. längd 2: A-Z, a-z, 0-9, and _-.) ", //
"usr_em_invalid" => "Ogiltig epostadress",
"usr_cant_delete_yourself" => "Du kan inte radera dig själv",
"usr_go_to_groups" => "Gå till Grupper",

//groups.php
"grp_list_of_groups" => "Grupplista",
"grp_name" => "Gruppnamn",
"grp_privs" => "Rättigheter",
"grp_categories" => "Kategorier",
"grp_all_cats" => "alla kategorier",
"grp_rep_events" => "Repeating events",
"grp_m-d_events" => "Multi-day events",
"grp_priv_events" => "Private events",
"grp_may_post_revents" => "May post repeating events",
"grp_may_post_mevents" => "May post multi-day events",
"grp_may_post_pevents" => "May post private events",
"grp_no_overlap" => "no overlap allowed",
"grp_edit_group" => "Redigera användargrupp",
"grp_edit" => "Redigera",
"grp_delete" => "Radera",
"grp_view" => "Visa kalender",
"grp_post_own" => "Skapa/redigera egna händelser",
"grp_post_all" => "Skapa/redigera alla händelser",
"grp_manager" => "Skapa/redigera + administratör",
"grp_admin" => "Administratör",
"grp_add_group" => "Skapa grupp",
"grp_upd_group" => "Uppdatera grupp",
"grp_no_rights" => "Ingen behörighet",
"grp_added" => "Grupp skapad",
"grp_updated" => "Grupp uppdaterad",
"grp_deleted" => "Grupp raderad",
"grp_not_added" => "Grupp ej skapad",
"grp_not_updated" => "Grupp ej uppdaterad",
"grp_not_deleted" => "Grupp ej raderad",
"grp_in_use" => "Gruppen används för närvarande",
"grp_cred_required" => "Gruppnamn, Rättigheter och Kategorier krävs",
"grp_name_exists" => "Gruppnamn upptaget",
"grp_name_invalid" => "Ogiltigt gruppnamn (min. längd 2: A-Z, a-z, 0-9, and _-.) ",
"grp_background" => "Bakgrundsfärg",
"grp_select_color" => "Välj färg",
"grp_invalid_color" => "Färgformat ogiltigt (#XXXXXX där X = HEX-värde)",
"grp_go_to_users" => "Gå till Användare",

//database.php
"mdb_dbm_functions" => "Databas-funktioner",
"mdb_noshow_tables" => "Kan ej hämta tabell(er)",
"mdb_noshow_restore" => "Kan ej hitta säkerhetskopia",
"mdb_file_not_sql" => "Säkerhetskopia är ej av typ '.sql'",
"mdb_compact" => "Komprimera databas",
"mdb_compact_table" => "Komprimera tabell",
"mdb_compact_error" => "Fel",
"mdb_compact_done" => "Klar",
"mdb_purge_done" => "Raderade händelser är nu permanent borttagna från databasen",
"mdb_backup" => "Säkerhetskopiera databas",
"mdb_backup_table" => "Säkerhetskopiera tabell",
"mdb_backup_file" => "Säkerhetskopia",
"mdb_backup_done" => "Klar",
"mdb_records" => "poster",
"mdb_restore" => "Återställ databas",
"mdb_restore_table" => "Återställ tabell",
"mdb_inserted" => "poster infogade",
"mdb_db_restored" => "Databas återställd.",
"mdb_no_bup_match" => "Varning:<br>Säkerhetskopia är av annan version än kalendern.<br>Databas återställs inte.",
"mdb_events" => "Händelser",
"mdb_delete" => "radera",
"mdb_undelete" => "återskapa",
"mdb_between_dates" => "som inträffar mellan",
"mdb_deleted" => "Händelser raderade",
"mdb_undeleted" => "Händelser återskapade",
"mdb_file_saved" => "Säkerhetskopia sparad i mappen 'files' på servern.",
"mdb_file_name" => "Filnamn:",
"mdb_start" => "Start",
"mdb_no_function_checked" => "Ingen funktion vald",
"mdb_write_error" => "Säkerhetskopiering misslyckades<br>Kontrollera rättigheterna till mappen 'files/'",

//import/export.php
"iex_file" => "Vald fil",
"iex_file_name" => "iCal filnamn",
"iex_file_description" => "iCal filbeskrivning",
"iex_filters" => "Händelsefilter",
"iex_upload_ics" => "Ladda upp iCal-fil",
"iex_create_ics" => "Skapa iCal-fil",
"iex_upload_csv" => "Ladda upp CSV-fil",
"iex_upload_file" => "Ladda upp fil",
"iex_create_file" => "Skapa fil",
"iex_download_file" => "Ladda ner fil",
"iex_fields_sep_by" => "Fält avskiljda med",
"iex_birthday_cat_id" => "Födelsedags kategori-ID",
"iex_default_cat_id" => "Standard kategori-ID",
"iex_if_no_cat" => "om ingen kategori hittades",
"iex_import_events_from_date" => "Importera händelser som sker fr.o.m.",
"iex_see_insert" => "se instruktioner till höger på sidan",
"iex_no_file_name" => "Filnamn saknas",
"iex_inval_field_sep" => "ogiltig eller saknad fält-avskiljare",
"iex_no_begin_tag" => "ogiltig iCal-fil (BEGIN-tag saknas)",
"iex_date_format" => "Händelsers datumformat",
"iex_time_format" => "Händelsers tidsformat",
"iex_number_of_errors" => "Antal fel i listan",
"iex_bgnd_highlighted" => "markerad",
"iex_verify_event_list" => "Verifiera händelselista, korrigera fel och klicka",
"iex_add_events" => "Infoga händelser i databasen",
"iex_select_ignore_birthday" => "Markera Ignorera och Födelsedag efter behov",
"iex_select_ignore" => "Markera Ignorera för att ignorera händelse",
"iex_title" => "Titel",
"iex_venue" => "Plats",
"iex_owner" => "Ägare",
"iex_category" => "Kategori",
"iex_date" => "Datum",
"iex_end_date" => "Slutdatum",
"iex_start_time" => "Starttid",
"iex_end_time" => "Sluttid",
"iex_description" => "Beskrivning",
"iex_repeat" => "Repetition",
"iex_birthday" => "Födelsedag",
"iex_ignore" => "Ignorera",
"iex_events_added" => "händelser skapade",
"iex_events_dropped" => "händelser ignorerade (finns redan)",
"iex_db_error" => "Fel i databas",
"iex_csv_file_error_on_line" => "CSV-filfel på rad",
"iex_ics_file_error_on_line" => "iCal-filfel på rad",
"iex_between_dates" => "Inträffar mellan",
"iex_changed_between" => "Sparad/redigerad mellan",
"iex_select_date" => "Välj datum",
"iex_select_start_date" => "Välj startdatum",
"iex_select_end_date" => "Välj slutdatum",
"iex_all_cats" => "alla kategorier",
"iex_all_users" => "alla användare",
"iex_no_events_found" => "Inga händelser funna", 
"iex_file_created" => "Fil skapad",
"iex_write error" => "Skapande av exportfil misslyckades<br>Kontrollera rättigheterna till mappen 'files'",

//lcalcron.php
"cro_sum_header" => "CRON JOB SAMMANSTÄLLNING",
"cro_sum_trailer" => "SLUT PÅ SAMMANSTÄLLNING",
"cro_evc_sum_title" => "FÖRFALLNA HÄNDELSER",
"cro_nr_evts_deleted" => "Antal raderade händelser",
"cro_not_sum_title" => "EPOST MEDDELANDEN",
"cro_not_sent_to" => "Meddelanden skickade till",
"cro_no_not_dates_due" => "Inga aktuella meddelandedatum",
"cro_all_day" => "Heldag",
"cro_mailer" => "utskick",
"cro_subject" => "Ämne",
"cro_event_due_in" => "Följande händelse sker om",
"cro_event_due_today" => "Följande händelse sker idag",
"cro_due_in" => "Sker om",
"cro_due_today" => "Sker idag",
"cro_days" => "dag(ar)",
"cro_date_time" => "Datum / tid",
"cro_title" => "Titel", 
"cro_venue" => "Plats",
"cro_description" => "Beskrivning",
"cro_category" => "Kategori",
"cro_status" => "Status",
"cro_open_calendar" => "Öppna kalender",
"cro_chg_sum_title" => "KALENDER-ÄNDRINGAR",
"cro_nr_changes_last" => "Antal ändringar senaste",
"cro_report_sent_to" => "Rapport skickad till",
"cro_no_report_sent" => "Ingen rapport skickad",
"cro_usc_sum_title" => "FÖRFALLNA ANVÄNDARKONTON",
"cro_nr_accounts_deleted" => "Antal raderade konton",
"cro_no_accounts_deleted" => "Inga konton raderade",
"cro_ice_sum_title" => "EXPORTERADE HÄNDELSER",
"cro_nr_events_exported" => "Antal händelser exporterade i iCalendar-format till fil",

//explanations
"xpl_manage_db" =>
"<h4>Instruktioner för att hantera databas</h4>
<p>På denna sida kan följande funktioner väljas:</p>
<h5>Komprimera databas</h5>
<p>När en användare raderar en händelse markeras händelsen som 'raderad', men 
avlägsnas INTE från databasen. Komprimera-funktionen avlägsnar däremot helt 
och hållet händelser som är raderade av en användare för mer än 30 dagar sedan, 
och frigör därigenom utrymmet i databasen reserverat för dessa händelser.</p>
<h5>Säkerhetskopiera databas</h5>
<p>Denna funktion skapar en säkerhetskopia av kalenderns databas (struktur och 
innehåll) i .sql-format. (OBS! Endast de tabeller som tillhör LuxCal kalendern 
berörs.) 
Säkerhetskopian sparas i mappen <strong>files/</strong> med filnamnet: 
<kbd>cal-dump-yyyymmdd-hhmmss.sql</kbd> (där 'yyyymmdd' = år, månad, och dag, 
och hhmmss = timmar, minuter och sekunder.</p>
<p>Säkerhetskopian kan användas för att återskapa kalenderns databas-tabeller 
(struktur och innehåll) med hjälp av 'Återställ databas' (se nedan) eller genom 
att t.ex. använda <strong>phpMyAdmin</strong>-verktyget som de flesta webbhotell 
tillhandahåller för sina kunder.</p>
<h5>Återställ databas</h5>
<p>Denna funktion återställer kalenderns databas-tabeller (struktur och innehåll) 
med hjälp av en sparad säkerhetskopia (i .sql-format).</p>
<p>Vid återställande av databas kommer ALL DATA SOM I ÖGONBLICKET ÄR SPARADE I 
KALENDERNS TABELLER ATT RADERAS och ersättas med säkerhetskopians innehåll!</p>
<h5>Radera/Återskapa händelser</h5>
<p>Denna funktion raderar eller återskapar händelser som inträffar mellan de 
angivna datumen. Om ett datum utelämnas finns det ingen datumgräns, så om båda 
datum utelämnas KOMMER ALLA HÄNDELSER ATT RADERAS!</p><br>
<p>VIKTIGT: När databasen komprimeras (se ovan) kommer de 'raderade' 
händelserna att helt och hållet avlägsnas, och kan aldrig återskapas igen!</p>",

"xpl_import_csv" =>
"<h4>Instruktioner för import av CSV</h4>
<p>Detta formulär används för att importera en CSV (Comma Separated Values) textfil med 
händelsedata till kalendern.</p>
<p>Ordningen på kolumnerna i CSV-filen måste vara: titel, plats, kategori-id (se nedan), 
datum, slutdatum, starttid, sluttid och beskrivning. Om den första raden i CSV-filen 
består av kolumnrubriker ignoreras denna.</p>
<p>För korrekt behandling av internationella och speciella tecken måste CSV-filen vara 
sparad i UTF-8 teckenkod.</p>
<h5>CSV exempelfiler</h5>
<p>CSV exempelfiler med filändelsen .cvs finns i mappen 'files' i din LuxCal-
installation.</p>
<h5>Datum- och tidsformat</h5>
<p>Den valda händelsens datum- och tidsformat till vänster måste överensstämma med 
formatet på datum och tider i den uppladdade CSV-filen.</p>
<h5>Lista med Kategorier</h5>
<p>Kalendern använder ID-nummer för att ange kategorier. CSV-filens kategori-ID:n 
måste motsvara de kategorier som används i din kalender eller vara tomma.</p>
<p>Om du i nästa steg vill öronmärka händelser som 'födelsedag' måste <strong>
Födelsedagens kategori-ID</strong> vara satt till att motsvara samma ID 
i kategorin-listan nedan.</p>
<p class='hilight'>Varning: Importera aldrig mer än 100 händelser åt gången!</p>
<p>För närvarande har följande kategorier definierats i din kalender:</p>", 

"xpl_import_ical" =>
"<h4>Instruktioner för import av iCalendar</h4>
<p>Detta formulär används för att importera en <strong>iCalendar</strong> händelsefil 
till kalendern.</p>
<p>Innehållet i filen måste motsvara [<u><a href='http://tools.ietf.org/html/rfc5545' 
target='_blank'>RFC5545 standard</a></u>] av Internet Engineering Task Force.</p>
<p>Endast händelser importeras. Andra iCal-komponenter som t.ex: Att-Göra, Journal, Ledig / 
Upptagen, Tidszon och Påminnelse kommer att ignoreras.</p>
<h5>iCal exempelfiler</h5>
<p>iCal exempelfiler med filändelsen .ics finns i mappen 'files' i din LuxCal-
installation.</p>
<h5>Kategoritabell</h5>
<p>Kalendern använder ID-nummer för att ange kategorier. iCalendar-filens 
kategori-ID:n måste motsvara de kategorier som används i din kalender eller 
vara tomma .</p>
<p class='hilight'>Varning: Importera aldrig mer än 100 händelser åt gången!</p>
<p>För närvarande har följande kategorier definierats i din kalender:</p>", 

"xpl_export_ical" =>
"<h4>Instruktioner för export av iCalendar</h4>
<p>Detta formulär används för att extrahera och exportera <strong>iCalendar</strong>
-händelser från kalendern.</p>
<p>Filerna sparas i mappen 'files/' på servern. Ange filnamn utan filtillägg 
(filtillägget blir automatiskt <b>.ics</b>). Om inget filnamn anges får filen 
automatiskt samma namn som kalendern. Existerande filer med samma namn kommer 
att skrivas över av den nya filen.</p>
<p><b>iCal-filens beskrivning</b> (t.ex. 'Möten 2013') är valfritt. Om du anger 
den så läggs den till i sidhuvudet på den exporterade iCal-filen.</p>
<p><b>Händelsefilter</b>: Händelserna som extraheras kan filtreras genom:</p>
<ul>
<li>händelse ägare</li>
<li>händelse kategori</li>
<li>händelse startdatum</li>
<li>händelse sparad/redigerad-datum</li>
</ul>
<p>Varje filter är valfritt. Utelämnat datum avser: ingen gräns</p>
<br>
<p>Innehållet i filen med extraherade händelser måste motsvara 
[<u><a href='http://tools.ietf.org/html/rfc5545' target='_blank'>RFC5545 standard</a></u>] 
av Internet Engineering Task Force.</p>
<p>När nedladdning sker av den exporterade iCal-file kommer datum och tid att läggas till 
i namnet på den nedladdade filen.</p>
<h5>iCal exempelfiler</h5>
 <p>iCalendar exempelfiler med filändelsen .ics finns i mappen 'files' i din LuxCal-
installation.</p>"
);
?>
