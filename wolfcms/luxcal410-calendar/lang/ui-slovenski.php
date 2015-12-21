<?php
/*
= LuxCal event calendar user interface language file =

This file has been produced by LuxSoft and has been translated by David.

© Copyright 2009-2014 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//LuxCal ui language file version
define("LUI","4.1.0");
define("ISOCODE","sl");

/* -- Titles on the Header of the Calendar and Date Picker -- */

$months = array("Januar","Februar","Marc","April","Maj","Junij","Julij","Avgust","September","Oktober","November","December");
$months_m = array("Jan","Feb","Mar","Apr","Maj","Jun","Jul","Avg","Sep","Okt","Nov","Dec");
$wkDays = array("Nedelja","Ponedeljek","Torek","Sreda","Četrtek","Petek","Sobota","Nedelja");
$wkDays_l = array("Ned","Pon","Tor","Sre","Čet","Pet","Sob","Ned");
$wkDays_m = array("Ne","Po","To","Sr","Če","Pe","So","Ne");
$wkDays_s = array("N","P","T","S","Č","P","S","N");


/* -- User Interface texts -- */

$xx = array(

//general
"submit" => "Pošlji",
"none" => "Brez.",
"back" => "Nazaj",
"by" => "z",
"of" => "od",
"done" => "Narejeno",
"at_time" => "@", //date and time separator (e.g. 11-09-2014 @ 10:45)
"no_way" => "Nimate pooblastil za izvedbo tega dejanja",

//index.php
"title_log_in" => "Vpis",
"title_upcoming" => "Prihajajoči dogodki",
"title_event" => "Dogodek",
"title_add_event" => "Dodaj dogodek",
"title_check_event" => "Preglej dogodek",
"title_search" => "Iskanje po tekstu",
"title_user_guide" => "LuxCal uporabniški vodič",
"title_settings" => "Upravljaj nastavitve koledarja",
"title_edit_cats" => "Spremeni kategorije",
"title_edit_users" => "Spremeni uporabike",
"title_edit_groups" => "Spremeni uporabniška skupina",
"title_manage_db" => "Upravljaj podatkovne baze",
"title_changes" => "Dodani / spremenjeni / izbrisani dogodki",
"title_csv_import" => "Uvoz CSV datoteke",
"title_ics_import" => "Uvoz iCal datoteke",
"title_ics_export" => "Izvoz iCal datoteke",
"idx_public_name" => "Javni pogled",

//header.php
"hdr_button_back" => "Nazaj na starševsko stran",
"hdr_button_options" => "Možnosti",
"hdr_options_submit" => "Izberite svojo izbiro in pritisnite 'Naredi'",
"hdr_options_panel" => "Plošča z možnostmi",
"hdr_select_date" => "Pojdi do datuma",
"hdr_calendar" => "Koledar",
"hdr_view" => "Pogled",
"hdr_lang" => "Jezik",
"hdr_all_cats" => "Vse kategorije",
"hdr_all_users" => "Vsi uporabniki",
"hdr_year" => "Leto",
"hdr_month_full" => "Polni mesec",
"hdr_month_work" => "Delovni mesec",
"hdr_week_full" => "Polni teden",
"hdr_week_work" => "Delovni teden",
"hdr_day" => "Dan",
"hdr_upcoming" => "Prihajajoče",
"hdr_changes" => "Spremembe",
"hdr_select_admin_functions" => "Izberi možnosti upravitelja",
"hdr_admin" => "Administrator",
"hdr_settings" => "Nastavitve",
"hdr_categories" => "Kategorije",
"hdr_users" => "Uporabniki",
"hdr_groups" => "User groups",
"hdr_database" => "Podatkovna baza",
"hdr_import_csv" => "Uvoz CSV datoteke",
"hdr_import_ics" => "Uvoz iCal datoteke",
"hdr_export_ics" => "Izvoz iCal datoteke",
"hdr_back_to_cal" => "Nazaj do pogleda koledarja",
"hdr_button_print" => "Natisni",
"hdr_print_page" => "Natisni to stran",
"hdr_button_todo" => "ToDo",
"hdr_todo_list" => "Todo spisek",
"hdr_button_upco" => "Prihajajoče",
"hdr_upco_list" => "Prihajajoči dogodki",
"hdr_button_search" => "Išči",
"hdr_search" => "Iskanje teksta",
"hdr_button_add" => "Dodaj",
"hdr_add_event" => "Dodaj dogodek",
"hdr_button_help" => "Pomoč",
"hdr_help" => "Uporabniški vodič",
"hdr_log_in" => "Vpis",
"hdr_button_log_in" => "Vpis",
"hdr_button_log_out" => "Izpis",
"hdr_today" => "danes", //dtpicker.js
"hdr_clear" => "izbriši", //dtpicker.js

//event.php
"evt_no_title" => "Brez vrste",
"evt_no_start_date" => "Brez začetnega datuma",
"evt_bad_date" => "Napačen datum",
"evt_bad_rdate" => "Napčna ponovitev in datum",
"evt_no_start_time" => "Brez začetnega časa",
"evt_bad_time" => "Napačen čas",
"evt_end_before_start_time" => "Čas za konec dogodka je pred časom za začetek",
"evt_end_before_start_date" => "Datum za konec dogodka je pred datumom za začetek",
"evt_until_before_start_date" => "Konec ponovitve je pred začetnim datumom",
"evt_approved" => "Dogodek potrjen",
"evt_apd_locked" => "Dogodek potrjen in zaklenjen",
"evt_title" => "Vrsta",
"evt_venue" => "Ime in Priimek",
"evt_category" => "Kategorija",
"evt_description" => "Opis",
"evt_date_time" => "datum / čas",
"evt_mailer" => "pošiljatelj",
"evt_private" => "Zasebni dogodek(priporočljivo)",
"evt_start_date" => "Začetek",
"evt_end_date" => "Konec",
"evt_select_date" => "Izberi datum",
"evt_select_time" => "Izberi čas",
"evt_all_day" => "Ves dan",
"evt_change" => "Spremeni",
"evt_set_repeat" => "Nastavi ponovitev",
"evt_set" => "OK",
"evt_help" => "pomoč",
"evt_repeat_not_supported" => "Nastavljena ponovitev ni podprta",
"evt_no_repeat" => "Brez ponovitve",
"evt_repeat_on" => "Ponovi vsakih",
"evt_until" => "dokler",
"evt_blank_no_end" => "prazno: brez konca",
"evt_each_month" => "vsak mesec",
"evt_interval2_1" => "prvi",
"evt_interval2_2" => "drugi",
"evt_interval2_3" => "tretji",
"evt_interval2_4" => "četrti",
"evt_interval2_5" => "zadnji",
"evt_period1_1" => "dan",
"evt_period1_2" => "teden",
"evt_period1_3" => "meesec",
"evt_period1_4" => "leto",
"evt_rpt_value_invalid" => "Repetition value invalid",
"evt_notify" => "Pošli e-mail",
"evt_now_and_or" => "zdaj in/ali",
"evt_event_added" => "Nov dogodek",
"evt_event_edited" => "Spremenjeni dogodek",
"evt_event_deleted" => "Izbrisani dogodek",
"evt_days_before_event" => "dni pred dogodkom da:",
"evt_mail_help" => "Obvestila spletne pošte so lahko poslana direktno (zdaj) ali podano število dni pred začetkom dogodka. V polju spodaj, so lahko navedeni prejemnikovi naslovi spletne pošte in/ali imena datotek z prejemnikovi naslovi spletne pošte. Vsak naslov/datoteka mora biti ločena s podpičjem. Polje lahko vsebuje največ 255 znakov. Datoteke z naslovom spletne pošte z enim email naslovm v vrstici, bi se morale nahajti v mapi \'emlists\'.<br>Če je izpuščena sprememba končnice, je privzeta končnica datoteke z naslovi spletne pošte .txt.",
"evt_eml_list_too_long" => "Polje z naslovi spletnih pošt vsebuje preveč znakov.",
"evt_eml_list_missing" => "Manjka(jo) spletni naslov(i) za obveščanje.",
"evt_not_in_past" => "Obveščevalni datum v preteklosti",
"evt_not_days_invalid" => "Neveljavni obveščevalni dnevi",
"evt_status" => "Status",
"evt_descr_help" => "Naslednji elementi so lahko uporabljeni v polju za opis...<br>- HTML oznake &lt;b&gt;, &lt;i&gt;, &lt;u&gt; in &lt;s&gt; za odebeljen, poševen, podčrtan in prečrtan-čez tekst.<br>- majhne slike (ikone) v sledečih formatih: mapa/ime_slike.ext or ime_slike.ext. Če mapa ni podana, je privzeta mapa \'thumbnails\'. Mapa mora bit podmapa od koledarja in končnica mora biti .gif, .jpg ali .png. Slike v obliki ikone, naj bi bile naložene skozi FTP.<br>- URL povezave morajo biti v sledečem formatu: url ali url [ime], kjer je \'ime\' naslov povezave. Npr.: www.google.com [iskanje].<br>URL povezave, če so uporabljene, so lahko tudi dodane v dodatna polja",
"evt_confirm_added" => "dogodek dodan",
"evt_confirm_saved" => "dogodek shranjen",
"evt_confirm_deleted" => "dogodek zbrisan",
"evt_add_close" => "dodaj in zapri",
"evt_add" => "dodaj",
"evt_edit" => "Spremeni",
"evt_save_close" => "Shrani in zapri",
"evt_save" => "Shrani",
"evt_clone" => "Shrani kot novo",
"evt_delete" => "Zbriši",
"evt_close" => "Zapri",
"evt_open_calendar" => "Odpri koledar",
"evt_added" => "dodano",
"evt_edited" => "Edited",
"evt_is_repeating" => "je ponavljajoči dogodek.",
"evt_is_multiday" => "je dogodek, ki se dogaja skozi več dni.",
"evt_edit_series_or_occurrence" => "Ali želite spremeniti celo serijo ali samo ta pojav?",
"evt_edit_series" => "Spremeni serije",
"evt_edit_occurrence" => "Spremeni ta pojav",

//views
"vws_add_event" => "Dodaj dogodek",
"vws_view_month" => "Poglej mesec",
"vws_view_week" => "Poglej teden",
"vws_view_day" => "Poglej dan",
"vws_click_for_full" => "za celoten koledar kliknite mesec",
"vws_view_full" => "Poglej celoten koledar",
"vws_prev_month" => "Prejšnji mesec",
"vws_next_month" => "Naslednji mesec",
"vws_today" => "Danes",
"vws_back_to_today" => "Nazaj na mesc ki je danes",
"vws_week" => "Teden",
"vws_wk" => "tdn",
"vws_time" => "Čas",
"vws_events" => "Dogodki",
"vws_all_day" => "Ves dan",
"vws_earlier" => "Zgodnje",
"vws_later" => "Pozneje",
"vws_venue" => "Kraj",
"vws_events_for_next" => "Prihajajoči dogodki za naslednji",
"vws_days" => "dan(dnevi)",
"vws_added" => "Dodano",
"vws_edited" => "Spremenjeno",
"vws_notify" => "Obvesti",
"vws_check_mark" => "Označi označbo",
"vws_none_due_in" => "Ni dogodkov za naslednji mesec.",
"vws_download" => "Prenesi",
"vws_download_title" => "Prenesi tekstovno datoteko s temi dogodki",

//changes.php
"chg_from_date" => "Od datuma",
"chg_select_date" => "Izberi datum začetka",
"chg_notify" => "Obvesti",
"chg_days" => "dan(dni)",
"chg_added" => "Dodano",
"chg_edited" => "Spremenjeno",
"chg_deleted" => "Izbrisano",
"chg_changed_on" => "Spremenjeno na",
"chg_changes" => "Spremembe",
"chg_no_changes" => "Brez sprememb.",

//search.php
"sch_define_search" => "Opredeli iskanje",
"sch_search_text" => "Išči po tekstu",
"sch_event_fields" => "Polja dogodka",
"sch_all_fields" => "Vsa polja",
"sch_title" => "Naslov",
"sch_description" => "Opis",
"sch_venue" => "Vrsta",
"sch_event_cat" => "Kategorija dogodka",
"sch_all_cats" => "Vse kategorije",
"sch_occurring_between" => "Pojavljanje med",
"sch_select_start_date" => "Izberi datum začetka",
"sch_select_end_date" => "Izberi datum konca",
"sch_search" => "Iskanje",
"sch_invalid_search_text" => "Prazen vnos ali prekratka beseda za iskanje",
"sch_bad_start_date" => "Napačen datum začetka",
"sch_bad_end_date" => "Napačen datum konca",
"sch_no_results" => "Ni najdenih rezultatov",
"sch_new_search" => "Novo isaknje",
"sch_calendar" => "Pojdi na koledar",
"sch_extra_field1" => "Model avta",
"sch_extra_field2" => "Tel.",
"sch_instructions" =>
"<h4>Navodila za iskanje po tekstu</h4>
<p>Podatkovna baza koledarja je lahko iskana za dogodke ki se ujemajo z iskanim tekstom.</p>
<br><p><b>Išči tekst</b>: Izbrana polja (poglej spodaj) za vsak edogodek bodo iskana. Iskalnik ni občutjiv na velike ali male črke.</p>
<p>Dva nadomestna znaka(wildcard characters) sta lahko uporabljena:</p>
<ul>
<li>Podčrtani znaki (_) se bodo v polju za iskanje ujemali z vsakim enotnim znakom.<br>Npr.: '_e_r' se ujema z 'beer', 'dear', 'heir'.</li>
<li>'Ampersand' znaki(&amp;) seb odo v polju za iskanje ujemali z vsakim znakom .<br>Npr.: 'de&amp;r' se ujema z 'December', 'dear', 'developer'.</li>
</ul>
<p>Vendar pa mora iskani tekst vsebovati vsaj dva druga znaka.</p>
<br><p><b>Polja dogodkov:</b>: Izbrana polja bodo samo iskana.</p>
<br><p><b>Kategorija dogodkov</b>: Izbrani dogodki v kategorijah bodo samo iskani.</p>
<br><p><b>Pojavljanje med/b>: Začetni in končni datum sta oba opcijska. Prazen datum začetka pomeni: eno leto od danes v preteklosti, in prazen datum konca pomeni: eno leto od danes v prihodnosti.</p>
<br><p>Rezultati iskanja bodo prikazani v kronološkem zaporedju.</p>",

//stand-alone sidebar (lcsbar.php)
"ssb_upco_events" => "Prihajajoči dogodki",
"ssb_all_day" => "Ves dan",
"ssb_none" => "Ni dogodkov."
);
?>
