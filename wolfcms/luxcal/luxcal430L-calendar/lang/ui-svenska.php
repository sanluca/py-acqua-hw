<?php
/*
= LuxCal event calendar lamguage file =

This file has been produced by LuxSoft. Please send comments / improvements to rb@luxsoft.eu.

Translation to swedish by Christer "Scunder" Nordahl.

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//LuxCal ui language file version
define("LUI","4.3.0");
define("ISOCODE","se");

/* -- Titles on the Header of the Calendar -- */

$months = array("Januari","Februari","Mars","April","Maj","Juni","Juli","Augusti","September","Oktober","November","December");
$months_m = array("Jan","Feb","Mar","Apr","Maj","Jun","Jul","Aug","Sep","Okt","Nov","Dec");
$wkDays = array("Söndag","Måndag","Tisdag","Onsdag","Torsdag","Fredag","Lördag","Söndag");
$wkDays_l = array("Sön","Mån","Tis","Ons","Tor","Fre","Lör","Sön");
$wkDays_m = array("Sö","Må","Ti","On","To","Fr","Lö","Sö");
$wkDays_s = array("S","M","T","O","T","F","L","S");


/* -- User Interface texts -- */

$xx = array(

//general
"submit" => "Skicka",
"none" => "Ingen.",
"back" => "Tillbaka",
"by" => "av",
"of" => "av",
"done" => "Klar",
"at_time" => "kl", //date and time separator (e.g. 10-04-2016 @ 10:45)
"no_way" => "Du har inte rättighet att göra detta",

//index.php
"title_log_in" => "Logga in",
"title_upcoming" => "Kommande händelser",
"title_event" => "Händelse",
"title_add_event" => "Skapa händelse",
"title_check_event" => "Kontrollera händelse",
"title_search" => "Sök text",
"title_user_guide" => "LuxCal användarhandbok",
"title_settings" => "Kalenderinställningar",
"title_edit_cats" => "Redigera kategorier",
"title_edit_users" => "Redigera användare",
"title_edit_groups" => "Redigera användargrupper",
"title_manage_db" => "Hantera databas",
"title_changes" => "Sparade/Redigerade/Raderade händelser",
"title_csv_import" => "Importera CSV-fil",
"title_ics_import" => "Importera iCal-fil",
"title_ics_export" => "Exportera iCal-fil",
"idx_public_name" => "Gäst",

//header.php
"hdr_button_back" => "Tillbaka till ursprunglig sida",
"hdr_button_options" => "Alternativ",
"hdr_options_submit" => "Gör ditt val och klicka 'Klar'",
"hdr_options_panel" => "Alternativ-menyer",
"hdr_select_date" => "Välj datum",
"hdr_calendar" => "Kalender",
"hdr_view" => "Visa",
"hdr_lang" => "Språk",
"hdr_all_cats" => "Alla kategorier",
"hdr_all_groups" => "All Groups",
"hdr_all_users" => "Alla användare",
"hdr_year" => "År",
"hdr_month_full" => "Månad",
"hdr_month_work" => "Arbetsmånad",
"hdr_week_full" => "Vecka",
"hdr_week_work" => "Arbetsvecka",
"hdr_day" => "Dag",
"hdr_upcoming" => "Kommande",
"hdr_changes" => "Ändringar",
"hdr_select_admin_functions" => "Välj administrativ funktion",
"hdr_admin" => "Administration",
"hdr_settings" => "Inställningar",
"hdr_categories" => "Kategorier",
"hdr_users" => "Användare",
"hdr_groups" => "Användargrupper",
"hdr_database" => "Databas",
"hdr_import_csv" => "Importera CSV-fil",
"hdr_import_ics" => "Importera iCal-fil",
"hdr_export_ics" => "Exportera iCal-fil",
"hdr_back_to_cal" => "Tillbaka till kalender",
"hdr_button_print" => "Skriv ut",
"hdr_print_page" => "Skriv ut sida",
"hdr_button_toap" => "Approve",
"hdr_toap_list" => "Events to be approved",
"hdr_button_todo" => "Att-göra",
"hdr_todo_list" => "Att-göra lista",
"hdr_button_upco" => "Kommande",
"hdr_upco_list" => "Kommande händelser",
"hdr_button_search" => "Sök",
"hdr_search" => "Sök text",
"hdr_button_add" => "Skapa",
"hdr_add_event" => "Skapa händelse",
"hdr_button_help" => "Hjälp",
"hdr_help" => "Användarhandbok",
"hdr_log_in" => "Logga In",
"hdr_button_log_in" => "Logga in",
"hdr_button_log_out" => "Logga ut",
"hdr_today" => "idag", //dtpicker.js
"hdr_clear" => "rensa", //dtpicker.js

//event.php
"evt_no_title" => "Titel saknas",
"evt_no_start_date" => "Startdatum saknas",
"evt_bad_date" => "Felaktigt datum",
"evt_bad_rdate" => "Felaktigt slutdatum för repetition",
"evt_no_start_time" => "Starttid saknas",
"evt_bad_time" => "Felaktid tidsangivelse",
"evt_end_before_start_time" => "Sluttid före starttid",
"evt_end_before_start_date" => "Slutdatum före startdatum",
"evt_until_before_start_date" => "Repetition slut före startdatum",
"evt_no_recur_if_overlay" => "Categorie with overlap check; recurring events not allowed",
"evt_private_no_ovl_check" => "Categorie with overlap check; no check for private events",
"evt_approved" => "Händelse godkänd",
"evt_apd_locked" => "Händelse godkänd och låst",
"evt_title" => "Titel",
"evt_venue" => "Plats",
"evt_category" => "Kategori",
"evt_description" => "Beskrivning",
"evt_date_time" => "Datum / tid",
"evt_mailer" => "skickat av ",
"evt_private" => "Privat händelse",
"evt_start_date" => "Start",
"evt_end_date" => "Slut",
"evt_select_date" => "Välj datum",
"evt_select_time" => "Välj tid",
"evt_all_day" => "Heldag",
"evt_change" => "Ändra",
"evt_set_repeat" => "Ställ repetition",
"evt_set" => "OK",
"evt_help" => "hjälp",
"evt_repeat_not_supported" => "Angiven repetition stöds inte",
"evt_no_repeat" => "Ingen repetition",
"evt_repeat_on" => "Repetera var",
"evt_until" => "tills",
"evt_blank_no_end" => "blankt: tills vidare",
"evt_each_month" => "varje månad",
"evt_interval2_1" => "första",
"evt_interval2_2" => "andra",
"evt_interval2_3" => "tredje",
"evt_interval2_4" => "fjärde",
"evt_interval2_5" => "sista",
"evt_period1_1" => "dag(ar)",
"evt_period1_2" => "vecka(or)",
"evt_period1_3" => "månad(er)",
"evt_period1_4" => "år",
"evt_rpt_value_invalid" => "Ogiltigt repetitionsvärde",
"evt_notify" => "Meddela per epost",
"evt_now_and_or" => "nu och/eller",
"evt_event_added" => "Ny händelse",
"evt_event_edited" => "Ändrad händelse",
"evt_event_deleted" => "Raderad händelse",
"evt_days_before_event" => "dag(ar) före händelsen till epostadress(er):",
"evt_mail_help" => "Meddelande via epost kan skickas direkt (nu) och/eller x antal dagar före händelsen. I fältet nedan anges epost-mottagare och/eller namn på filer innehållande epost-mottagare. Varje adress/filnamn ska avskiljas med semikolon. Fältet kan innehålla max 255 tecken. Filer innehållande listor med epost-mottagare (en per rad) bör ligga i mappen \'emlists\'.<br>Om filtillägg inte anges antas det vara .txt.",
"evt_eml_list_too_long" => "Fältet för epostadresser/listfiler har för många tecken (max 255 tecken).",
"evt_eml_list_missing" => "Det saknas epostadress(er) för meddelande",
"evt_not_in_past" => "Meddelandedatum har passerat",
"evt_not_days_invalid" => "Meddelandedagar ogiltiga",
"evt_status" => "Status",
"evt_descr_help" => "Följande teckenkoder kan användas i beskrivningen ...<br>- HTML tags &lt;b&gt;, &lt;i&gt;, &lt;u&gt; och &lt;s&gt; för fet, kursiv, understruken och överstruken text.<br>- små bilder (miniatyrer) i följande format: mapp/bild_namn.ext eller bild_namn.ext. Om mapp inte anges, antas den vara  \'thumbnails\'. Mappen måste vara en undermapp i kalendermappen och filtillägget måste vara  .gif, .jpg or .png. Miniatyrbilderna ska laddas upp via FTP.<br>- URL-länkar i följande format: url eller url [namn], där \'namn\' blir länkens titel. T.ex. www.google.com [sök].<br>URL länkar kan också användas i \'extra\' fälten",
"evt_confirm_added" => "händelse skapad",
"evt_confirm_saved" => "händelse sparad",
"evt_confirm_deleted" => "händelse raderad",
"evt_add_close" => "Spara och stäng",
"evt_add" => "Spara",
"evt_edit" => "Redigera",
"evt_save_close" => "Spara och stäng",
"evt_save" => "Spara",
"evt_clone" => "Spara som ny",
"evt_delete" => "Radera",
"evt_close" => "Stäng",
"evt_open_calendar" => "Öppna kalender",
"evt_added" => "Skapad",
"evt_edited" => "Redigerad",
"evt_is_repeating" => "är en repetativ händelse.",
"evt_is_multiday" => "är en flerdygns-händelse.",
"evt_edit_series_or_occurrence" => "Vill du ändra i hela händelseserien eller bara denna enstaka händelsen?",
"evt_edit_series" => "Ändra serien",
"evt_edit_occurrence" => "Ändra denna enstaka händelse",

//views
"vws_add_event" => "Skapa händelse",
"vws_view_month" => "Visa månad",
"vws_view_week" => "Visa vecka",
"vws_view_day" => "Visa dag",
"vws_click_for_full" => "för stor kalender klicka månad",
"vws_view_full" => "Visa stora kalendern",
"vws_prev_month" => "Föregående månad",
"vws_next_month" => "Nästa månad",
"vws_today" => "Idag",
"vws_back_to_today" => "Tillbaka till aktuell månad",
"vws_week" => "Vecka",
"vws_wk" => "v.",
"vws_time" => "Tid",
"vws_events" => "Händelser",
"vws_all_day" => "Heldag",
"vws_earlier" => "Tidigare",
"vws_later" => "Senare",
"vws_venue" => "Plats",
"vws_events_for_next" => "Kommande händelser för följande",
"vws_days" => "dag(ar)",
"vws_added" => "Skapad",
"vws_edited" => "Redigerad",
"vws_notify" => "Meddela",
"vws_check_mark" => "Markering",
"vws_none_due_in" => "Inga förestående händelser inom följande",
"vws_download" => "Ladda ned",
"vws_download_title" => "Ladda ned en textfil med dessa händelser",

//changes.php
"chg_from_date" => "Från datum",
"chg_select_date" => "Välj startdatum",
"chg_notify" => "Meddela",
"chg_days" => "Dag(ar)",
"chg_added" => "Skapad",
"chg_edited" => "Redigerad",
"chg_deleted" => "Raderad",
"chg_changed_on" => "Ändrad den",
"chg_changes" => "Ändringar",
"chg_no_changes" => "Inga ändringar.",

//search.php
"sch_define_search" => "Definiera sökning",
"sch_search_text" => "Sök text",
"sch_event_fields" => "Händelsefält",
"sch_all_fields" => "Alla fält",
"sch_title" => "Titel",
"sch_description" => "Beskrivning",
"sch_venue" => "Plats",
"sch_user_group" => "User group",
"sch_event_cat" => "Händelsekategori",
"sch_all_groups" => "All Groups",
"sch_all_cats" => "Alla kategorier",
"sch_occurring_between" => "Inträffar mellan",
"sch_select_start_date" => "Välj startdatum",
"sch_select_end_date" => "Välj slutdatum",
"sch_search" => "Sök",
"sch_invalid_search_text" => "Söktext saknas eller är för kort",
"sch_bad_start_date" => "Felaktigt startdatum",
"sch_bad_end_date" => "Felaktigt slutdatum",
"sch_no_results" => "Inga resultat funna",
"sch_new_search" => "Ny sökning",
"sch_calendar" => "Gå till kalender",
"sch_extra_field1" => "Extra fält 1",
"sch_extra_field2" => "Extra fält 2",
"sch_instructions" =>
"<h4>Instruktioner för textsökning</h4>
<p>Kalenderns databas kan genomsökas efter händelser med specifik text.</p>
<br><p><b>Söktext</b>: De valda fälten (se nedan) i varje händelse kommer att 
genomsökas. Sökningen skiljer INTE på små/STORA bokstäver.</p>
<p>Två jokertecken kan användas i söksträngen:</p>
<ul>
<li>Understrykningstecken (_) i söktexten matchar ett enstaka 
tecken.<br>T.ex. : '_e_r' matchar 'beer', 'dear', 'heir'.</li>
<li>Et-tecken (&amp;) i söktexten matchar ett antal olika 
tecken.<br>E.g.: 'de&amp;r' matches 'December', 'dear', 'developer'.</li>
</ul>
<p>Anges ingen text alls, eller bara en ampersand (&amp;), matchas all text och därför alla händelser.</p>
<br><p><b>Händelsefält</b>: Endast de valda fälten genomsöks.</p>
<br><p><b>Händelsekategori</b>: Endast fält med den valda kategorin genomsöks.</p>
<br><p><b>Inträffar mellan</b>: Start- och slutdatum anges frivilligt. Ett 
tomt startdatum innebär 1 år tillbaks i tiden och ett tomt slutdatum 
innebär 1 år framåt i tiden.</p>
<br><p>Sökresultaten visas i kronologisk ordning.</p>",

//stand-alone sidebar (lcsbar.php)
"ssb_upco_events" => "Kommande händelser",
"ssb_all_day" => "Heldag",
"ssb_none" => "Inga händelser."
);
?>
