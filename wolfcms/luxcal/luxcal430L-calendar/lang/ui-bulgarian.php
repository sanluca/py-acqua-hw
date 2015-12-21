<?php
/*
= LuxCal event calendar user interface language file =

This file has been produced by LuxSoft and has been translated by Radoslav Yovev.

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//LuxCal ui language file version
define("LUI","4.3.0");
define("ISOCODE","bg");

/* -- Titles on the Header of the Calendar and Date Picker -- */

$months = array("Януари","Февруари","Март","Април","Май","Юни","Юли","Август","Септември","Октомври","Ноември","Декември");
$months_m = array("Яну","Фев","Мар","Апр","Май","Юни","Юли","Авг","Сеп","Окт","Ное","Дек");
$wkDays = array("Неделя","Понеделник","Вторник","Сряда","Четвъртък","Петък","Събота","Неделя");
$wkDays_l = array("Нед","Пон","Вто","Сря","Чет","Пет","Съб","Нед");
$wkDays_m = array("Нд","Пн","Вт","Ср","Чт","Пт","Сб","Нд");
$wkDays_s = array("Н","П","В","С","Ч","П","С","Н");


/* -- User Interface texts -- */

$xx = array(

//general
"submit" => "Потвърди",
"none" => "None.",
"back" => "Върни",
"by" => "by",
"of" => "of",
"done" => "Готово",
"at_time" => "@", //date and time separator (e.g. 10-04-2016 @ 10:45)
"no_way" => "Нямате нужните права,за да извършите желаните от вас действия",

//index.php
"title_log_in" => "Влез",
"title_upcoming" => "Предстоящи събития",
"title_event" => "Събитие",
"title_add_event" => "ДОБАВИ събитие",
"title_check_event" => "Провери събитие",
"title_search" => "Текст за търсене",
"title_user_guide" => "Ръководство за потребителя",
"title_settings" => "Редактиране на настройките",
"title_edit_cats" => "Промени категория",
"title_edit_users" => "Промени потребители",
"title_edit_groups" => "Edit User Groups",
"title_manage_db" => "Настройки на базата данни",
"title_changes" => "Събития ДОБАВИ / Промени / Изтрий",
"title_csv_import" => "CSV File Import",
"title_ics_import" => "iCal File Import",
"title_ics_export" => "iCal File Export",
"idx_public_name" => "Общ изглед",

//header.php
"hdr_button_back" => "Върни се към предишмата страница",
"hdr_button_options" => "Опции",
"hdr_options_submit" => "Направете своят избор и натиснете 'Готово'",
"hdr_options_panel" => "Панел с опции",
"hdr_select_date" => "Отиди на дата",
"hdr_calendar" => "Календар",
"hdr_view" => "Изглед",
"hdr_lang" => "Език",
"hdr_all_cats" => "Всички категории",
"hdr_all_groups" => "All Groups",
"hdr_all_users" => "Всички потребители",
"hdr_year" => "Година",
"hdr_month_full" => "Месец",
"hdr_month_work" => "Работен месец",
"hdr_week_full" => "Седмица",
"hdr_week_work" => "Работна седмица",
"hdr_day" => "Ден",
"hdr_upcoming" => "Бъдещи събития",
"hdr_changes" => "Промени",
"hdr_select_admin_functions" => "Изберете Admin функции",
"hdr_admin" => "Мениджър",
"hdr_settings" => "Настройки",
"hdr_categories" => "Категория",
"hdr_users" => "Потребители",
"hdr_groups" => "User groups",
"hdr_database" => "База данни",
"hdr_import_csv" => "CSV Import",
"hdr_import_ics" => "iCal Import",
"hdr_export_ics" => "iCal Export",
"hdr_back_to_cal" => "Обратно към изглед Календар",
"hdr_button_print" => "Печат",
"hdr_print_page" => "Печат на тази страница",
"hdr_button_toap" => "Approve",
"hdr_toap_list" => "Events to be approved",
"hdr_button_todo" => "Todo",
"hdr_todo_list" => "Todo List",
"hdr_button_upco" => "Предстоящи",
"hdr_upco_list" => "Бъдещи назначенията",
"hdr_button_search" => "Търси",
"hdr_search" => "Търсене на текст",
"hdr_button_add" => "ДОБАВИ",
"hdr_add_event" => "ДОБАВИ събитие",
"hdr_button_help" => "Помощ",
"hdr_help" => "Ръководство за потребителя",
"hdr_log_in" => "Вход",
"hdr_button_log_in" => "Вход",
"hdr_button_log_out" => "ИЗХОД",
"hdr_today" => "Днес", //dtpicker.js
"hdr_clear" => "Близо", //dtpicker.js

//event.php
"evt_no_title" => "Без заглавие",
"evt_no_start_date" => "Без начална дата",
"evt_bad_date" => "Неправилен формат на датата",
"evt_bad_rdate" => "Неправилно повторение на крайната дата",
"evt_no_start_time" => "Без начално време",
"evt_bad_time" => "Неправилен формат на времето",
"evt_end_before_start_time" => "Крайното време е преди началното",
"evt_end_before_start_date" => "Крайната дата е преди началната",
"evt_until_before_start_date" => "Повторащ край преди началната дата",
"evt_no_recur_if_overlay" => "Categorie with overlap check; recurring events not allowed",
"evt_private_no_ovl_check" => "Categorie with overlap check; no check for private events",
"evt_approved" => "Одобрено събитие",
"evt_apd_locked" => "Одобрено и заключено събитие",
"evt_title" => "Заглавие",
"evt_venue" => "Място",
"evt_category" => "Категория",
"evt_description" => "Описание",
"evt_date_time" => "Дата / Час",
"evt_mailer" => "Напомняне",
"evt_private" => "Това е лично събитие",
"evt_start_date" => "Начало",
"evt_end_date" => "Завършено",
"evt_select_date" => "Изберете дата",
"evt_select_time" => "Изберете час",
"evt_all_day" => "Цял ден",
"evt_change" => "Промяна",
"evt_set_repeat" => "Задайте отново",
"evt_set" => "OK",
"evt_help" => "Помощ",
"evt_repeat_not_supported" => "Указано повторение не се поддържа",
"evt_no_repeat" => "Без повторение",
"evt_repeat_on" => "Всеки",
"evt_until" => "До това време",
"evt_blank_no_end" => "If Blank: I do not Bite",
"evt_each_month" => "Всеки месец",
"evt_interval2_1" => "Първи",
"evt_interval2_2" => "Втори",
"evt_interval2_3" => "Трети",
"evt_interval2_4" => "Четвърти",
"evt_interval2_5" => "Пети",
"evt_period1_1" => "дни",
"evt_period1_2" => "Седмици",
"evt_period1_3" => "Месеца",
"evt_period1_4" => "Години",
"evt_rpt_value_invalid" => "Repetition value invalid",
"evt_notify" => "Изпрати електронна поща",
"evt_now_and_or" => "предприятието и / или инцидент",
"evt_event_added" => "Ново Събитие",
"evt_event_edited" => "Променете събитие",
"evt_event_deleted" => "Изтриване на събитие",
"evt_days_before_event" => "Преди дни",
"evt_mail_help" => "Email reminders can be sent directly (now) or the specified number of days before the start of the event. In the field below, recipient mail addresses and/or names of files with recipient mail addresses can be specified. Each address/file name should be separated by a semicolon. The field can contain max. 255 karekter. Files with email addresses with one email address per line should be located in the folder \'emlists\'.<br>When omitted, the default file name extension of a file with email addresses is .txt.",
"evt_eml_list_too_long" => "Прекалено много символи в електронната поща.",
"evt_eml_list_missing" => "Има грешка в напомнянето за електронна поща.",
"evt_not_in_past" => "Датата за напомняне е в миналото",
"evt_not_days_invalid" => "Дните за напомняне са невалидни",
"evt_status" => "Статус",
"evt_descr_help" => "The following items can be used in the description field ...<br>• HTML tags &lt;b&gt;, &lt;i&gt;, &lt;u&gt; and &lt;s&gt; for bold, italic, underlined and striked-through text.<br>• small images (thumbnails) in the following format: folder/image_name.ext or image_name.ext. When omitted, the default folder is \'thumbnails\'. The folder must be a subfolder of the calendar and the extension must be .gif, .jpg or .png. The thumbnail (image) files should be uploaded via FTP.<br>• URL links in the following format: url or url [name], where \'name\' will be the title of the link. E.g. www.google.com [search].<br>URL links can also be used in the extra fields, if in use",
"evt_confirm_added" => "Добавени Събития",
"evt_confirm_saved" => "Запазени Събития",
"evt_confirm_deleted" => "Изтрити събития",
"evt_add_close" => "ДОБАВИ и затвори",
"evt_add" => "ДОБАВИ",
"evt_edit" => "Редактирай",
"evt_save_close" => "Запиши и затвори",
"evt_save" => "Записване",
"evt_clone" => "Запазване и Отваряне на ново",
"evt_delete" => "Изчисти",
"evt_close" => "Затвори",
"evt_open_calendar" => "Достъпен календар",
"evt_added" => "ДОБАВИ",
"evt_edited" => "Промени",
"evt_is_repeating" => "Събитието е повтарящо.",
"evt_is_multiday" => "Събитието продължава няколко дни.",
"evt_edit_series_or_occurrence" => "Искате ли да редактирате серията или това събитие?",
"evt_edit_series" => "Редактирайте серията",
"evt_edit_occurrence" => "Редактиране на това събитие",

//views
"vws_add_event" => "ДОБАВИ събитие",
"vws_view_month" => "Месечен изглед",
"vws_view_week" => "Седмичен изглед",
"vws_view_day" => "Дневен изглед",
"vws_click_for_full" => "Пълен месечен изглед",
"vws_view_full" => "Пълен изглед",
"vws_prev_month" => "Предходния месец",
"vws_next_month" => "Следващия месец",
"vws_today" => "Днес",
"vws_back_to_today" => "Този месец се връща в",
"vws_week" => "Седмица",
"vws_wk" => "сед",
"vws_time" => "Час",
"vws_events" => "Събития",
"vws_all_day" => "Цял ден",
"vws_earlier" => "По-рано",
"vws_later" => "По-късно",
"vws_venue" => "Място",
"vws_events_for_next" => "Печат на дните до следваща ",
"vws_days" => "Ден(дни)",
"vws_added" => "ДОБАВИ",
"vws_edited" => "Редактирай",
"vws_notify" => "Уведоми",
"vws_check_mark" => "Проверете за маркер",
"vws_none_due_in" => "Няма събития, предстоящи през следващите",
"vws_download" => "Свали",
"vws_download_title" => "Свали текстов файл с тези събития",

//changes.php
"chg_from_date" => "От дата",
"chg_select_date" => "Изберете начална дата",
"chg_notify" => "Напомняне",
"chg_days" => "Ден(дни)",
"chg_added" => "ДОБАВИ",
"chg_edited" => "Редактирай",
"chg_deleted" => "Изтрити",
"chg_changed_on" => "Заменен:",
"chg_changes" => "Промяна",
"chg_no_changes" => "Без промяна.",

//search.php
"sch_define_search" => "Дефинирайте търсене",
"sch_search_text" => "Търсене по текст",
"sch_event_fields" => "Търси по събитие",
"sch_all_fields" => "Всички полета",
"sch_title" => "Заглавие",
"sch_description" => "Описание",
"sch_venue" => "Местоположение",
"sch_user_group" => "User group",
"sch_event_cat" => "Категория на събитието",
"sch_all_groups" => "All Groups",
"sch_all_cats" => "Всички категории",
"sch_occurring_between" => "Настъпили между",
"sch_select_start_date" => "Изберете начална дата",
"sch_select_end_date" => "Изберете крайна дата",
"sch_search" => "Търси",
"sch_invalid_search_text" => "Търсеният текст липсва или е твърде кратък",
"sch_bad_start_date" => "Неправилна начална дата",
"sch_bad_end_date" => "Неправилна крайна дата",
"sch_no_results" => "Не са намерени резултати",
"sch_new_search" => "Ново търсене",
"sch_calendar" => "Отиди към календар",
"sch_extra_field1" => "Допълнително поле 1",
"sch_extra_field2" => "Допълнително поле 2",
"sch_instructions" =>
"<h4>Text Search Instructions</h4>
<p>The calendar database can be searched for events matching specific text.</p>
<br><p><b>Search text</b>: The selected fields (see below) of each event will 
be searched. The search is case insensitive.</p>
<p>Two wildcard characters can be used:</p>
<ul>
<li>Underscore characters (_) in the search text will match any single 
character.<br>E.g.: '_e_r' matches 'beer', 'dear', 'heir'.</li>
<li>Ampersand characters (&amp;) in the search text will match any number of 
characters.<br>E.g.: 'de&amp;r' matches 'December', 'dear', 'developer'.</li>
</ul>
<p>A blank search text field, or just an ampersand, will match any text and therefore all events.</p>
<br><p><b>Event fields</b>: The selected fields will be searched only.</p>
<br><p><b>Event category</b>: Events in the selected category will be searched 
only.</p>
<br><p><b>Occurring between</b>: The start and end date are both optional. A 
blank start date means: one year from now in the past and a blank end date 
means: one year from now in the future.</p>
<br><p>The search results will be displayed in chronological order.</p>",

//stand-alone sidebar (lcsbar.php)
"ssb_upco_events" => "Предстоящи събития",
"ssb_all_day" => "Цял ден",
"ssb_none" => "Няма събития."
);
?>
