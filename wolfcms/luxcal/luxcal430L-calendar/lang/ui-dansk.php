<?php
/*
= LuxCal event calendar language file =

Oversat til dansk af Lars J. Helbo. Kommentarer, forbedringsforslag osv. til lars(at)salldata.dk
Additional Danish translations by FinnH - as is.
Additional Danish - John Schwartz. Sidst redigeret 24-11-2015

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//LuxCal ui language file version
define("LUI","4.3.0");
define("ISOCODE","da");

/* -- Titles on the Header of the Calendar -- */

$months = array("Januar","Februar","Marts","April","Maj","Juni","Juli","August","September","Oktober","November","December");
$months_m = array("Jan","Feb","Mar","Apr","Maj","Jun","Jul","Aug","Sep","Okt","Nov","Dec");
$wkDays = array("Søndag","Mandag","Tirsdag","Onsdag","Torsdag","Fredag","Lørdag","Søndag");
$wkDays_l = array("Søn","Man","Tir","Ons","Tor","Fre","Lør","Søn");
$wkDays_m = array("Sø","Ma","Ti","On","To","Fr","Lø","Sø");
$wkDays_s = array("S","M","T","O","T","F","L","S");


/* -- User Interface texts -- */

$xx = array(

//general
"submit" => "Udfør",
"none" => "Ingen.",
"back" => "Tilbage",
"by" => "af",
"of" => "i",
"done" => "Udfør",
"at_time" => "@", //date and time separator (e.g. 10-04-2016 @ 10:45)
"no_way" => "Du har ikke autorisation til denne funktion",

//index.php
"title_log_in" => "Log ind",
"title_upcoming" => "Kommende begivenheder",
"title_event" => "Begivenhed",
"title_add_event" => "Tilføj Begivenhed",
"title_check_event" => "Tjek begivenhed",
"title_search" => "Tekst Søgning",
"title_user_guide" => "LuxCal brugervejledning",
"title_settings" => "Kalenderindstillinger",
"title_edit_cats" => "Editer kategorier",
"title_edit_users" => "Editer brugere",
"title_edit_groups" => "Editer Bruger Grupper",
"title_manage_db" => "Vedligehold databasen",
"title_changes" => "Tilføje / ændre / slette begivenheder",
"title_csv_import" => "CSV fil-import",
"title_ics_import" => "iCal fil-import",
"title_ics_export" => "iCal fil-eksport",
"idx_public_name" => "Offentlig visning",

//header.php
"hdr_button_back" => "Tilbage til forrige side",
"hdr_button_options" => "Valg",
"hdr_options_submit" => "Foretag valg og klik 'Udfør'",
"hdr_options_panel" => "Valgmuligheder",
"hdr_select_date" => "Gå til dato ",
"hdr_calendar" => "Kalender",
"hdr_view" => "Visning",
"hdr_lang" => "Sprog",
"hdr_all_cats" => "Alle kategorier",
"hdr_all_groups" => "Alle Grupper",
"hdr_all_users" => "Alle brugere",
"hdr_year" => "År",
"hdr_month_full" => "Måned (7d)",
"hdr_month_work" => "Arbejdsmåned",
"hdr_week_full" => "Uge (7d)",
"hdr_week_work" => "Arbejdsuge",
"hdr_day" => "Dag",
"hdr_upcoming" => "Kommende",
"hdr_changes" => "Ændringer",
"hdr_select_admin_functions" => "Vælg admin funktion",
"hdr_admin" => "Administration",
"hdr_settings" => "Indstillinger",
"hdr_categories" => "Kategorier",
"hdr_users" => "Brugere",
"hdr_groups" => "Bruger Grupper",
"hdr_database" => "Database",
"hdr_import_csv" => "CSV import",
"hdr_import_ics" => "iCal import",
"hdr_export_ics" => "iCal export",
"hdr_back_to_cal" => "Tilbage til kalender visning",
"hdr_button_print" => "Udskriv",
"hdr_print_page" => "Udskriv denne side",
"hdr_button_toap" => "Approve",
"hdr_toap_list" => "Events til godkendelse",
"hdr_button_todo" => "Opgaver",
"hdr_todo_list" => "Opgaveliste",
"hdr_button_upco" => "Kommende",
"hdr_upco_list" => "Kommende begivenheder",
"hdr_button_search" => "Søg",
"hdr_search" => "Tekst søgning",
"hdr_button_add" => "Tilføj",
"hdr_add_event" => "Tilføj begivenhed",
"hdr_button_help" => "Hjælp",
"hdr_help" => "Brugervejledning",
"hdr_log_in" => "Log Ind",
"hdr_button_log_in" => "Log ind",
"hdr_button_log_out" => "Log ud",
"hdr_today" => "i dag", //dtpicker.js
"hdr_clear" => "slette", //dtpicker.js

//event.php
"evt_no_title" => "Ingen titel",
"evt_no_start_date" => "Ingen startdato",
"evt_bad_date" => "Forkert dato",
"evt_bad_rdate" => "Forkert gentagelse slutdato",
"evt_no_start_time" => "Ingen starttid",
"evt_bad_time" => "Forkert tid",
"evt_end_before_start_time" => "Sluttid før starttid",
"evt_end_before_start_date" => "Slutdato før startdato",
"evt_until_before_start_date" => "Gentagelse slutdato før startdato",
"evt_no_recur_if_overlay" => "Categorie with overlap check; recurring events not allowed",
"evt_private_no_ovl_check" => "Categorie with overlap check; no check for private events",
"evt_approved" => "Begivenhed godkendt",
"evt_apd_locked" => "Begivenhed godkendt og låst",
"evt_title" => "Titel",
"evt_venue" => "Sted",
"evt_category" => "Kategori",
"evt_description" => "Beskrivelse",
"evt_date_time" => "Dato / tid",
"evt_mailer" => "mailer",
"evt_private" => "Privat begivenhed",
"evt_start_date" => "Start",
"evt_end_date" => "Slut",
"evt_select_date" => "Vælg dato",
"evt_select_time" => "Vælg tid",
"evt_all_day" => "Hele dagen",
"evt_change" => "Ændre",
"evt_set_repeat" => "Sæt gentagelse",
"evt_set" => "OK",
"evt_help" => "hjælp",
"evt_repeat_not_supported" => "Angivet gentagelse ikke understøttet",
"evt_no_repeat" => "Ingen gentagelse",
"evt_repeat_on" => "Gentag hver",
"evt_until" => "indtil",
"evt_blank_no_end" => "blank: ingen ende",
"evt_each_month" => "hver måned",
"evt_interval2_1" => "første",
"evt_interval2_2" => "anden",
"evt_interval2_3" => "tredje",
"evt_interval2_4" => "fjerde",
"evt_interval2_5" => "sidste",
"evt_period1_1" => "dag",
"evt_period1_2" => "uge",
"evt_period1_3" => "måned",
"evt_period1_4" => "år",
"evt_rpt_value_invalid" => "Repetition value invalid",
"evt_notify" => "Alarmer",
"evt_now_and_or" => "nu og/eller",
"evt_event_added" => "Begivenhed blev oprettet",
"evt_event_edited" => "Begivenhed blev opdateret",
"evt_event_deleted" => "Begivenhed blev slettet",
"evt_days_before_event" => "dag(e) før begivenheden",
"evt_mail_help" => "Email påmindelser kan sendes straks eller det angivne antal dage før begivenhedens start. I feltet nedenfor kan modtager mail adresser og/eller navne på filer med modtager mail adresser angives. Adresser/filnavne adskilles med semikolon. Feltet kan indeholde max. 255 tegn. Filer med email adresser med en email adresse per linje skal findes i folderen \'emlists\'.<br>Hvis ingen extension angives, antages en fil med email adresser at have extension .txt.",
"evt_eml_list_too_long" => "Email-adresselisten er for lang.",
"evt_eml_list_missing" => "Der mangler en alarm-email",
"evt_not_in_past" => "Påmindelsesdato før dags dato",
"evt_not_days_invalid" => "Påmindelsesdage ugyldig",
"evt_status" => "Status",
"evt_descr_help" => "Følgende koder kan bruges i beskrivelsesfeltet ...<br>• HTML tags &lt;b&gt;, &lt;i&gt;, &lt;u&gt; og &lt;s&gt; for fed, kursiv, understreget og gennemstreget tekst.<br>• små billeder (thumbnails) i følgende format: folder/billede_navn.ext eller billede_navn.ext. Hvis ingen folder angives, bruges standard folder  \'thumbnails\'. Folderen skal være en subfolder under \'calendar\' og extension skal være .gif, .jpg eller .png. Thumbnail (billed) filer skal uploades via FTP.<br>• URL links i følgende format: url eller url [navn], hvor \'navn\' vises som titel for linket. Fx www.google.com [Søgning].<br>URL links kan også bruges i ekstrafelter, hvis disse benyttes",
"evt_confirm_added" => "begivenhed tilføjet",
"evt_confirm_saved" => "begivenhed gemt",
"evt_confirm_deleted" => "begivenhed slettet",
"evt_add_close" => "Tilføj og luk",
"evt_add" => "Tilføj",
"evt_edit" => "Editer",
"evt_save_close" => "Gem og luk",
"evt_save" => "Gem",
"evt_clone" => "Gem som Ny",
"evt_delete" => "Slet",
"evt_close" => "Luk",
"evt_open_calendar" => "Åbn kalender",
"evt_owner" => "Ejer",
"evt_added" => "Tilføjet",
"evt_edited" => "Ændret",
"evt_is_repeating" => "er en gentaget begivenhed.",
"evt_is_multiday" => "er en flerdages begivenhed.",
"evt_edit_series_or_occurrence" => "Vil du editere serien eller denne forekomst?",
"evt_edit_series" => "Editer serien",
"evt_edit_occurrence" => "Editer denne forekomst",

//views
"vws_add_event" => "Tilføj begivenhed",
"vws_view_month" => "Vis måned",
"vws_view_week" => "Vis uge",
"vws_view_day" => "Vis dag",
"vws_click_for_full" => "for fuld kalender, klik måned",
"vws_view_full" => "Vis fuld kalender",
"vws_prev_month" => "Forrige måned",
"vws_next_month" => "Næste måned",
"vws_today" => "Dag",
"vws_back_to_today" => "Tilbage til måneden for dags dato",
"vws_week" => "Uge",
"vws_wk" => "Uge",
"vws_time" => "Tid",
"vws_events" => "Begivenheder",
"vws_all_day" => "Hele dagen",
"vws_earlier" => "Tidligere",
"vws_later" => "Senere",
"vws_venue" => "Sted",
"vws_events_for_next" => "Kommende begivenheder for de næste",
"vws_days" => "dag(e)",
"vws_added" => "Tilføjet",
"vws_edited" => "Ændret",
"vws_notify" => "Alarmer",
"vws_check_mark" => "Tjekmærke",
"vws_none_due_in" => "Ingen begivenheder den følgende",
"vws_download" => "Download",
"vws_download_title" => "Download en tekstfil med disse begivenheder",

//changes.php
"chg_from_date" => "Fra dato",
"chg_select_date" => "Vælg startdato",
"chg_notify" => "Alarmer",
"chg_days" => "Dag(e)",
"chg_added" => "Tilføjet",
"chg_edited" => "Ændret",
"chg_deleted" => "Slettet",
"chg_changed_on" => "Ændret",
"chg_changes" => "Ændringer",
"chg_no_changes" => "Ingen ændringer.",

//search.php
"sch_define_search" => "Definer søgning",
"sch_search_text" => "Søgetekst",
"sch_event_fields" => "Begivenhedsfelter",
"sch_all_fields" => "Alle felter",
"sch_title" => "Titel",
"sch_description" => "Beskrivelse",
"sch_venue" => "Sted",
"sch_user_group" => "Bruger Gruppe",
"sch_event_cat" => "Begivenhedskategori",
"sch_all_groups" => "Alle Grupper",
"sch_all_cats" => "Alle kategorier",
"sch_occurring_between" => "Foregår mellem",
"sch_select_start_date" => "Vælg startdato",
"sch_select_end_date" => "Vælg slutdato",
"sch_search" => "Søg",
"sch_invalid_search_text" => "Søgetekst mangler eller for kort",
"sch_bad_start_date" => "Ugyldig startdato",
"sch_bad_end_date" => "Ugyldig slutdato",
"sch_no_results" => "Ingen resultater",
"sch_new_search" => "Ny Søgning",
"sch_calendar" => "Gå til kalender",
"sch_extra_field1" => "Ekstra felt 1",
"sch_extra_field2" => "Ekstra felt 2",
"sch_instructions" =>
"<h4>Tekst Søgning vejledning</h4>
<p>Der kan søges i kalenderdatabasen efter begivenheder som matcher specifik tekst.</p>
<br><p><b>Søgetekst</b>: Der søges i de valgte felter (se nedenfor) i hver begivenhed. Søgning tager ikke hensyn til store eller små bogstaver (er ikke case sensitiv).</p>
<p>To jokertegn (wildcard) kan bruges:</p>
<ul>
<li>Underscore (_) i søgeteksten vil matche ethvert enkelt tegn.<br>Fx: '_e_r' matcher 'sejr', 'Vejr', 'lejr'.</li>
<li>Ampersand (&amp;) i søgeteksten vil matche ethvert antal tegn.<br>Fx: 'de&amp;r' matcher 'December', 'deler', 'deltager'.</li>
</ul>
<p>Et tomt tekstfelt, eller bare en ampersand, vil passe med alt og derfor alle begivenheder.</p>
<br><p><b>Begivenhedsfelter</b>: Der søges kun i de valgte felter.</p>
<br><p><b>Begivenhedskategori</b>: Der søges kun begivenheder i den valgte kategori.</p>
<br><p><b>Foregår mellem</b>: Start og slutdato er begge valgfri. En blank startdato betyder: Et år tilbage i tid fra nu, og en blank slutdato betyder: Et år frem fra nu.</p>
<br><p>Søgeresultaterne vil blive vist i kronologisk orden.</p>",

//stand-alone sidebar (lcsbar.php)
"ssb_upco_events" => "Kommende begivenheder",
"ssb_all_day" => "Hele dagen",
"ssb_none" => "Ingen begivenheder."
);
?>
