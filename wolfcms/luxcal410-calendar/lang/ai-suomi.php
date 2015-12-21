<?php
/*
= LuxCal event calendar admin interface language file =

Finish translation: Heikki Laitala. Please send comments to rb@luxsoft.eu.

© Copyright 2009-2014 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//LuxCal ui language file version
define("LAI","4.1.0");

/* -- Admin Interface texts -- */

$ax = array(

//general
"none" => "Ei mitään",
"all" => "All",
"back" => "Takaisin",
"close" => "Close",
"always" => "always",
"at_time" => "@", //date and time separator (e.g. 11-09-2014 @ 10:45)
"year" => "Year",
"month" => "Month",
"week_day" => "Week/Day",
"upcoming" => "Upcoming",

//settings.php - fieldset headers + general
"set_general_settings" => "Yleinen",
"set_navbar_settings" => "Navigation Bar",
"set_event_settings" => "Events",
"set_user_settings" => "Käyttäjäasetukset",
"set_email_settings" => "Email Settings",
"set_perfun_settings" => "Periodic Functions (only relevant if cron job defined)",
"set_minical_settings" => "Mini Calendar (only relevant if used)",
"set_sidebar_settings" => "Stand-Alone Sidebar (only relevant if in use)",
"set_view_settings" => "Näkymät",
"set_dt_settings" => "Päivät/Ajat",
"set_save_settings" => "Tallenna asetukset",
"set_test_mail" => "Test Mail",
"set_mail_sent_to" => "Test mail sent to",
"set_mail_sent_from" => "This test mail was sent from your calendar's Settings page",
"set_missing_invalid" => "puuttuva tai virheellinen asetus (virhekohta korostettu)",
"set_settings_saved" => "Kalenteriasetukset talletettu",
"set_save_error" => "Tietokantavirhe - kalenteriasetusten talletus ei onnistunut",
"hover_for_details" => "Hover descriptions for details",
"default" => "default",
"enabled" => "sallittu",
"disabled" => "estetty",
"no" => "ei",
"yes" => "kyllä",
"or" => "tai",
"minutes" => "minuuttia",
"pixels" => "pikseliä",
"no_way" => "Sinulla ei ole oikeuksia tämän toiminnon suorittamiseen",

//settings.php - general settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"calVersionDb_label" => "Calendar version - Database",
"calVersionDb_text" => "Version of the installed calendar software and the folder/name of the currently used SQLite database file.",
"calTitle_label" => "Kalenterin nimi",
"calTitle_text" => "Näkyy otsikkorivillä ja käytetään sähköpostimuistutuksissa.",
"calUrl_label" => "Kalenterin URL",
"calUrl_text" => "Kalenterin www-osoite.",
"calEmail_label" => "Kalenterin emailosoite",
"calEmail_text" => "Lähettäjän emailosoite muistutusviestejä varten.<br>Muoto: \'email\' tai \'nimi&#8249;email&#8250;\'. \'nimi\' voi olla kalenterin nimi.",
"backLinkUrl_label" => "Link to parent page",
"backLinkUrl_text" => "URL of parent page. If specified, a Back button will be displayed on the left side of the Navigation Bar which links to this URL.<br>For instance to link back to the parent page from which the calendar was started.",
"timeZone_label" => "Aikavyöhyke",
"timeZone_text" => "Kalenterin aikavyöhyke, tarvitaan laskemaan nykyinen aika.",
"see" => "katso",
"notifSender_label" => "Sender of notification emails",
"notifSender_text" => "When the calendar sends reminder emails, the sender field of the email can contain either the calendar email address, or the email address of the user who created the event.<br>In case of the user email address, the receiver can reply to the email.",
"rssFeed_label" => "RSS feed links",
"rssFeed_text" => "If enabled: For users with at least \'view\' rights an RSS feed link will be visible in the footer of the calendar and an RSS feed link will be added to the HTML head of the calendar pages.",
"calendar" => "calendar",
"user" => "user",
"php_mail" => "PHP mail",
"smtp_mail" => "SMTP mail",

//settings.php - navigation bar settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"navButText_label" => "Navigation bar buttons with text",
"navButText_text" => "If enabled: On the navgation bar the buttons will be displayed with text. If disabled, the buttons are diplayed with icons.",
"sideLists_label" => "Todo / Upcoming buttons",
"sideLists_text" => "If enabled: A Todo / Upcoming button will be displayed on the navigation bar, which when clicked will open the Todo list / Upcoming list.",
"navTodoList_label" => "Todo button",
"navUpcoList_label" => "Upcoming button",
"optionsPanel_label" => "Options panel menus",
"optionsPanel_text" => "Enable/disable menus in the options panel.<br>The calendar menu is available to the admin to switch calendars. (enabling only useful if several calendars are installed)<br>The users menu can be used to display only events created by one specific user.<br>The categories menu can be used to display only events belonging to a specific event category.<br>The language menu can be used to select the user interface language. (enabling only useful if several languages are installed)",
"calMenu_label" => "calendar",
"userMenu_label" => "users",
"catMenu_label" => "categories",
"langMenu_label" => "language",
"defaultView_label" => "Default view on start-up",
"defaultView_text" => "Possible default views on calendar start-up are:<br>- Year<br>- Full Month<br>- Work Month *)<br>- Full Week<br>- Work Week *)<br>- Day<br>- Upcoming<br>- Changes<br>*) For work week days see on this page: Views - Work week days<br>Recommended choice: Month or Upcoming.",
"language_label" => "Default user interface language",
"language_text" => "The files ui-{language}.php, ai-{language}.php, ug-{language}.php and ug-layout.png must be present in the lang/ directory. {language} = selected user interface language. File names must be lower case!",

//settings.php - events settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"privEvents_label" => "Posting of private events",
"privEvents_text" => "Private events are only visible to the user who entered the event.<br>Enabled: users can enter private events.<br>Default: when adding new events, the \'private\' checkbox in the Event window will be checked by default.<br>Always: when adding new events they will always be private, the \'private\' checkbox in the Event window will not be shown.",
"details4All_label" => "Show event details to users",
"details4All_text" => "Disabled: event details will only be visible to the owner of the event and to users with \'post all\' rights.<br>All: event details will be visible to the owner of the event and to all other users.<br>Logged in: event details will be visible to the owner of the event and to logged in users.",
"evtDelButton_label" => "Show delete button in Event window",
"evtDelButton_text" => "Disabled: the Delete button in the Event window will not be visible. So users with edit rights will not be able to delete events.<br>Enabled: the Delete button in the Event window will be visible to all users.<br>Manager: the Delete button in the Event window will only be visible to users with \'manager\' rights.",
"eventColor_label" => "Event colors based on",
"eventColor_text" => "Events in the various calendar views can be displayed in the color assigned to the group to which the user who created the event belongs or the color of the event category.",
"xField1_label" => "Extra field 1 label",
"xField2_label" => "Extra field 2 label",
"xFieldx_text" => "Name of an optional text field. If this field is included in the event template hereafter, the field will be added as a free format text field to the Event window form and to the events displayed in all calendar views and pages.<br>The specified name can be max. 15 characters long. E.g. \'Email address\', \'Website\', \'Phone number\'.",
"logged_in" => 'logged in',
"manager_only" => 'manager',
"user_group" => "user group",
"event_cat" => "event category",

//settings.php - user accounts settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"selfReg_label" => "Self registration",
"selfReg_text" => "Allow users to register themselves and get access to the calendar.",
"selfRegGrp_label" => "Self registration user group",
"selfRegGrp_text" => "User group to which self-registered users will be assigned.",
"selfRegNot_label" => "Self registration notification",
"selfRegNot_text" => "Send a notification email to the calendar email address when a self-registration takes place.",
"restLastSel_label" => "Restore last user selections",
"restLastSel_text" => "The last user selections (the Option Panel settings) will be saved and when the user revisits the calendar later, the values will be restored.",
"cookieExp_label" => "'Remember me' cookie expiry days",
"cookieExp_text" => "Number of days before the cookie set by the \'Remember me\' option (during Log In) will expire.",
"view" => "katselu",
"post_own" => 'Varaa oma',
"post_all" => 'Varaa kaikille',
"manager" => 'Varaa/manager',

//settings.php - view settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"evtTemplGen_label" => "Event template - General views",
"evtTemplGen_text" => "The event fields to be displayed in the various calendar views can be specified by means of a sequence of numbers.<br>If a number is specified in the sequence, the corresponding field will be displayed.",
"evtTemplUpc_label" => "Event template - Upcoming view",
"evtTemplUpc_text" => "The event fields to be displayed in the Upcoming Events views can be specified by means of a sequence of numbers.<br>If a number is specified in the sequence, the corresponding field will be displayed.",
"popBoxFields_label" => "Hover box event fields",
"popBoxFields_text" => "The event fields to be displayed in the hover box with event details in the various calendar views can be specified by means of a sequence of numbers. <br>If a number is specified in the sequence, the corresponding field will be displayed.<br>If no fields are specified at all, no hover box will be displayed.",
"templFields_text" => "Meaning of the numbers:<br>1: Venue field<br>2: Event category field<br>3: Description field<br>4: Extra field 1 (see below)<br>5: extra field 2 (see below)<br>6: Email notification data (only if a notification has been requested)<br>7: Date/time added/edited and the associated user(s).<br>The order of the numbers determine the order of the displayed fields.",
"popBoxShow_label" => "Hover box with event details",
"popBoxShow_text" => "If enabled, a box with event details will be displayed when hovering an event in the selected views. The event details will not be displayed if no hover box event fields (see above) have been specified.",
"yearStart_label" => "Start month in Year view",
"yearStart_text" => "If a start month has been specified (1 - 12), in Year view the calendar will always start with this month and the year of this first month will only change as of the first day of the same month in the next year.<br>The value 0 has a special meaning: the start month is based on the current date and will fall in the first row of months.",
"colsToShow_label" => "Columns to show in Year view",
"colsToShow_text" => "Number of months to display in each row in Year view.<br>Recommended choice: 3 or 4.",
"rowsToShow_label" => "Rows to show in Year view",
"rowsToShow_text" => "Number of rows of four months each to display in Year view.<br>Recommended choice: 4, which gives you 16 months to scroll through.",
"weeksToShow_label" => "Weeks to show in Month view",
"weeksToShow_text" => "Number of weeks to display in Month view.<br>Recommended choice: 10, which gives you 2.5 months to scroll through.<br>The values 0 and 1 have a special meaning:<br>0: display exactly 1 month - blank leading and trailing days.<br>1: display exactly 1 month - display events on leading and trailing days.",
"workWeekDays_label" => "Work week days",
"workWeekDays_text" => "Days to be shown in each week in Work Month view and Work Week view.<br>Enter the number of each day that should be visible. Valid day numbers:<br>1 = Monday<br>2 = Tuesday<br>....<br>7 = Sunday<br>e.g. 12345 : Monday - Friday",
"lookaheadDays_label" => "Days to look ahead",
"lookaheadDays_text" => "Number of days to look ahead for events in the Upcoming Events view, the Todo List and the RSS feeds.",
"dwStartHour_label" => "Start hour in Day/Week view",
"dwStartHour_text" => "Hour at which a normal day of events starts.<br>Setting this value to e.g. 6, will avoid wasting space in Week/Day view for the quiet time between midnight and 6:00.<br>The time picker, used to enter a time, will also start at this hour.",
"dwEndHour_label" => "End hour in Day/Week view",
"dwEndHour_text" => "Hour at which a normal day of events ends.<br>E.g., setting this value to 18 will avoid wasting space in Week/Day view for the quiet time between 18:00 and midnight.<br>The time picker, used to enter a time, will also end at this hour.",
"dwTimeSlot_label" => "Time slot in Day/Week view",
"dwTimeSlot_text" => "Day/Week view time slot in number of minutes.<br>This value, together with the Start hour and End hour (see above) will determine the number of rows in Day/Week view.",
"dwTsHeight_label" => "Time slot height",
"dwTsHeight_text" => "Day/Week view time slot display height in number of pixels.",
"showLinkInMV_label" => "Show links in month view",
"showLinkInMV_text" => "If switched on, URLs in the event description will be displayed as hyperlink in month view",
"monthInDCell_label" => "Month in each day cell",
"monthInDCell_text" => "Display in month view the 3-letter month name for each day",

//settings.php - date/time settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"dateFormat_label" => "Date format (dd mm yyyy)",
"dateFormat_text" => "Text string defining the format of event dates in the calendar views and input fields.<br>Possible characters: y = year, m = month and d = day.<br>Non-alphanumeric character can be used as separator and will be copied literally.<br>Examples:<br>y-m-d: 2013-10-31<br>m.d.y: 10.31.2013<br>d/m/y: 31/10/2013",
"dateFormat_expl" => "e.g. y.m.d: 2013.10.31",
"MdFormat_label" => "Date format (dd month)",
"MdFormat_text" => "Text string defining the format of dates consisting of month and day.<br>Possible characters: M = month in text, d = day in digits.<br>Non-alphanumeric character can be used as separator and will be copied literally.<br>Examples:<br>d M: 12 April<br>M, d: July, 14",
"MdFormat_expl" => "e.g. M, d: July, 14",
"MdyFormat_label" => "Date format (dd month yyyy)",
"MdyFormat_text" => "Text string defining the format of dates consisting of day, month and year.<br>Possible characters: d = day in digits, M = month in text, y = year in digits.<br>Non-alphanumeric character can be used as separator and will be copied literally.<br>Examples:<br>d M y: 12 April 2013<br>M d, y: July 8, 2013",
"MdyFormat_expl" => "e.g. M d, y: July 8, 2013",
"MyFormat_label" => "Date format (month yyyy)",
"MyFormat_text" => "Text string defining the format of dates consisting of month and year.<br>Possible characters: M = month in text, y = year in digits.<br>Non-alphanumeric character can be used as separator and will be copied literally.<br>Examples:<br>M y: April 2013<br>y - M: 2013 - July",
"MyFormat_expl" => "e.g. M y: April 2013",
"DMdFormat_label" => "Date format (weekday dd month)",
"DMdFormat_text" => "Text string defining the format of dates consisting of weekday, day and month.<br>Possible characters: WD = weekday in text, M = month in text, d = day in digits.<br>Non-alphanumeric character can be used as separator and will be copied literally.<br>Examples:<br>WD d M: Friday 12 April<br>WD, M d: Monday, July 14",
"DMdFormat_expl" => "e.g. WD - M d: Sunday - April 6",
"DMdyFormat_label" => "Date format (weekday dd month yyyy)",
"DMdyFormat_text" => "Text string defining the format of dates consisting of weekday, day, month and year.<br>Possible characters: WD = weekday in text, M = month in text, d = day in digits, y = year in digits.<br>Non-alphanumeric character can be used as separator and will be copied literally.<br>Examples:<br>WD d M y: Friday 13 April 2013<br>WD - M d, y: Monday - July 16, 2013",
"DMdyFormat_expl" => "e.g. WD, M d, y: Monday, July 16, 2013",
"timeFormat_label" => "Time format (hh mm)",
"timeFormat_text" => "Text string defining the format of event times in the calendar views and input fields.<br>Possible characters: h = hours, H = hours with leading zeros, m = minutes, a = am/pm (optional), A = AM/PM (optional).<br>Non-alphanumeric character can be used as separator and will be copied literally.<br>Examples:<br>h:m: 18:35<br>h.m a: 6.35 pm<br>H:mA: 06:35PM",
"timeFormat_expl" => "e.g. h:m: 22:35 and h:mA: 10:35PM",
"weekStart_label" => "First day of the week",
"weekStart_text" => "A week can start with Sunday or Monday.",
"weekNumber_label" => "Display week numbers",
"weekNumber_text" => "The display of week numbers in Year, Month and Week view can be switched on or off",
"time_format_us" => "12-hour AM/PM",
"time_format_eu" => "24-hour",
"sunday" => "Sunnuntai",
"monday" => "Maanantai",
"time_zones" => "TIME ZONES",
"dd_mm_yyyy" => "dd-mm-yyyy",
"mm_dd_yyyy" => "mm-dd-yyyy",
"yyyy_mm_dd" => "yyyy-mm-dd",

//settings.php - email settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"mailServer_label" => "Mail server",
"mailServer_text" => "PHP mail is suitable for unauthenticated mail in small numbers. For greater numbers of mail or when authentication is required, SMTP mail should be used.<br>Using SMTP mail requires an SMTP mail server. The configuration parameters to be used for the SMTP server must be specified hereafter. If mail is disabled, the Send mail section in the Event window will be suppressed.",
"smtpServer_label" => "SMTP server name",
"smtpServer_text" => "If SMTP mail is selected, the SMTP server name should be specified here. For example gmail SMTP server: smtp.gmail.com.",
"smtpPort_label" => "SMTP port number",
"smtpPort_text" => "If SMTP mail is selected, the SMTP port number should be specified here. For example 25, 465 or 587. Gmail for example uses port number 465.",
"smtpSsl_label" => "SSL (Secure Sockets Layer)",
"smtpSsl_text" => "If SMTP mail is selected, select here if the secure sockets layer (SSL) should be enabled. For gmail: enabled",
"smtpAuth_label" => "SMTP authentication",
"smtpAuth_text" => "If SMTP authentication is selected, the username and password specified hereafter will be used to authenticate the SMTP mail.",
"smtpUser_label" => "SMTP username",
"smtpUser_text" => "If SMTP mail is selected, specify here the SMTP user name. For gmail this is the part of your email address before the @.",
"smtpPass_label" => "SMTP password",
"smtpPass_text" => "If SMTP mail is selected, specify here the SMTP password.",

//settings.php - periodic function settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"cronSummary_label" => "Admin cron job summary",
"cronSummary_text" => "Send a cron job summary to the calendar administrator.<br>Enabling is only useful if a cron job has been activated for the calendar.",
"chgEmailList_label" => "Email destinations for changes",
"chgEmailList_text" => "Destination email addresses periodically receiving an email with calendar changes.<br>Email addresses separated by semicolons.",
"chgNofDays_label" => "Days to look back for changes",
"chgNofDays_text" => "Number of days to look back for the summary of calendar changes.<br>If the number of days is set to 0 no summary of changes will be sent.",
"icsExport_label" => "Daily export of iCal events",
"icsExport_text" => "If enabled: All events in the date range -1 week until +1 yesr will be exported in iCalendar format in a .ics file in the \'files\' folder.<br>The file name will be the calendar name with blanks replaced by underscores. Old files will be overwritten by new files.",
"eventExp_label" => "Event expiry days",
"eventExp_text" => "Number of days after the event due date when the event expires and will be automatically deleted.<br>If 0 or if no cron job is running, no events will be automatically deleted.",
"maxNoLogin_label" => "Max. nr of days not logged in",
"maxNoLogin_text" => "If a user has not logged in during this number of days, his/her account will be automatically deleted.<br>If this value is set to 0, user accounts will never be deleted.",

//settings.php - mini calendar / sidebar settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"miniCalView_label" => "Mini calendar view",
"miniCalView_text" => "Possible views for the mini calendar are:<br>- Full Month<br>- Work Month *)<br>- Full Week<br>- Work Week *)<br>*) For work week days see on this page: Views - Work week days",
"miniCalPost_label" => "Mini calendar event posting",
"miniCalPost_text" => "If enabled, users can:<br>- post new events in the mini calendar by clicking the top bar of a day cell<br>- edit/delete events by clicking an event square<br>Note: The access rights of the Public User will be applicable.",
"popFieldsMcal_label" => "Event fields - mini calendar hover box",
"popFieldsMcal_text" => "The event fields to be displayed in an overlay when the user hovers an event in the mini calendar can be specified by means of a sequence of numbers.<br>If no fields are specified at all, no hover box will be displayed..<br>If no fields are specified at all, no hover box will be displayed",
"mCalUrlFull_label" => "Mini cal URL to full calendar",
"mCalUrlFull_text" => "When clicking the month at the top of the mini calendar, to go to the full calendar, the user will be directed to this URL.<br>If not specified, the full calendar will open in a new window.<br>This URL is in particular useful when the full calendar is embedded in an existing user page.",
"popFieldsSbar_label" => "Event fields - sidebar hover box",
"popFieldsSbar_text" => "The event fields to be displayed in an overlay when the user hovers an event in the stand-alone sidebar can be specified by means of a sequence of numbers.<br>If no fields are specified at all, no hover box will be displayed.",
"showLinkInSB_label" => "Show links in sidebar",
"showLinkInSB_text" => "Display URLs from the event description as a hyperlink in the upcoming events sidebar",
"sideBarDays_label" => "Days to look ahead in sidebar",
"sideBarDays_text" => "Number of days to look ahead for events in the sidebar.",

//login.php
"log_log_in" => "Kirjaudu",
"log_remember_me" => "Muista minut",
"log_register" => "Rekisteröidy",
"log_change_my_data" => "Muuta tietoja",
"log_change" => "Muuta",
"log_un_or_em" => "Käyttäjänimi tai sähköpostiosoite",
"log_un" => "Käyttäjänimi",
"log_em" => "Sähköpostiosoite",
"log_pw" => "Salasana",
"log_new_un" => "Uusi käyttäjänimi",
"log_new_em" => "Uusi sähköposti",
"log_new_pw" => "Uusi salasana",
"log_pw_msg" => "Here are your log in details for calendar",
"log_pw_subject" => "Sinun %% salasanasi", //%% will be replaced by calendar name
"log_npw_subject" => "Sinun uusi %% salasanasi", //%% will be replaced by calendar name
"log_npw_sent" => "Uusi salasanasi kirjautumiseen on lähetetty",
"log_registered" => "Rekisteröinti onnistui - Salasanasi kirjautumiseen on lähetetty sähköpostilla",
"log_not_registered" => "Rekisteröinti ei onnistunut",
"log_un_exists" => "Käyttäjänimi on jo olemassa",
"log_em_exists" => "Sähköpostiosoite on jo olemassa",
"log_un_invalid" => "Virheellinen käyttäjätunnus (min pituus 2 merkkiä: A-Z, a-z, 0-9, ja _-.) ",
"log_em_invalid" => "Virheellinen sähköpostiosoite",
"log_un_em_invalid" => "Tunnusta/sähköpostiosoitetta ei tunnistettu",
"log_un_em_pw_invalid" => "Tunnusta/sähköpostiosoitetta tai salasanaa ei tunnistettu",
"log_no_un_em" => "Kirjautuminen vaaditaan. Jos olet unohtanut salasanasi, jätä salasana-kenttä tyhjäksi ja paina (Lähetä uusi salasana), jolloin palvelin lähettää käyttäjän email-osoitteeseen uuden salasanan.",
"log_no_un" => "Kirjoita käyttäjätunnuksesi",
"log_no_em" => "Kirjoita sähköpostiosoitteesi",
"log_no_pw" => "Kirjoita salasanasi",
"log_no_rights" => "Kirjautuminen estetty: sinulla ei ole katseluoikeuksia - ota yhteys ylläpitoon",
"log_send_new_pw" => "Lähetä uusi salasana",
"log_if_changing" => "Vain jos olet vaihtamassa salasanaasi",
"log_no_new_data" => "Ei vaihdettavaa tietoa",
"log_invalid_new_un" => "Virheellinen uusi käyttäjätunnus (min pituus 2 merkkiä: A-Z, a-z, 0-9, ja _-.) ",
"log_new_un_exists" => "Käyttäjänimi on jo olemassa",
"log_invalid_new_em" => "Virheellinen sähköpostiosoite",
"log_new_em_exists" => "Sähköpostiosoite on jo olemassa",
"log_ui_language" => "Valitse kieli",
"log_new_reg" => "New user registration",
"log_date_time" => "Date / time",

//categories.php
"cat_list" => "List of Categories",
"cat_edit" => "Edit",
"cat_delete" => "Delete",
"cat_add_new" => "Add New Category",
"cat_add" => "Add",
"cat_edit_cat" => "Edit Category",
"cat_sort" => "Sort On Name",
"cat_id" => "ID",
"cat_id_expl" => "needed when using the sidebar with specified categories",
"cat_name" => "Category name",
"cat_sequence" => "Sequence",
"cat_in_menu" => "in menu",
"cat_text_color" => "Text Color",
"cat_background" => "Background",
"cat_select_color" => "Select Color",
"cat_save" => "Save",
"cat_added" => "Category Added",
"cat_updated" => "Category Updated",
"cat_deleted" => "Category Deleted",
"cat_invalid_color" => "Color format invalid (#XXXXXX where X = HEX-value)",
"cat_not_added" => "Category Not Added",
"cat_not_updated" => "Category not updated",
"cat_not_deleted" => "Category not deleted",
"cat_nr" => "#",
"cat_repeat" => "Repeat",
"cat_every_day" => "every day",
"cat_every_week" => "every week",
"cat_every_month" => "every month",
"cat_every_year" => "every year",
"cat_approve" => "Events need approval",
"cat_public" => "Public",
"cat_check_mark" => "Check mark",
"cat_label" => "label",
"cat_mark" => "mark",
"cat_name_missing" => "Category name is missing",
"cat_mark_label_missing" => "Check mark/label is missing",

//users.php
"usr_list_of_users" => "Käyttäjälista",
"usr_id" => "User ID",
"usr_name" => "Tunnus",
"usr_email" => "Sähköposti",
"usr_group" => "Group",
"usr_password" => "Salasana",
"usr_edit_user" => "Muokkaa profiilia",
"usr_add" => "Lisää käyttäjä",
"usr_edit" => "Muokkaa",
"usr_delete" => "Poista",
"usr_login_0" => "Ensimmäinen kirjautuminen",
"usr_login_1" => "Viimeisin kirjautuminen",
"usr_login_cnt" => "Kirjautumisia",
"usr_add_profile" => "Lisää profiili",
"usr_upd_profile" => "Päivitä profiili",
"usr_if_changing_pw" => "Vain jos haluat muuttaa salasanaasi",
"usr_pw_not_updated" => "Salasanaa ei muutettu",
"usr_added" => "Käyttäjä lisätty",
"usr_updated" => "Profiili päivitetty",
"usr_deleted" => "Käyttäjä poistettu",
"usr_not_added" => "Käyttäjää ei lisätty",
"usr_not_updated" => "Profiilia ei päivitetty",
"usr_not_deleted" => "Käyttäjää ei poistettu",
"usr_cred_required" => "Tunnus, sähköpostiosoite ja salasana vaaditaan",
"usr_name_exists" => "Käyttäjänimi on jo käytössä",
"usr_email_exists" => "Sähköpostiosoite on jo käytössä",
"usr_un_invalid" => "Virheellinen käyttäjätunnus (min pituus 2 merkkiä: A-Z, a-z, 0-9, ja _-.) ",
"usr_em_invalid" => "Virheellinen sähköpostiosoite",
"usr_cant_delete_yourself" => "Et voi poistaa oma tunnustasi",
"usr_go_to_groups" => "Go to Ryhmät",

//groups.php
"grp_list_of_groups" => "Luettele ryhmät",
"grp_id" => "Ryhmä ID",
"grp_name" => "Ryhmänimi",
"grp_privs" => "Oikeudet",
"grp_categories" => "Categories",
"grp_all_cats" => "all categories",
"grp_edit_group" => "Muokkaa Ryhmä",
"grp_edit" => "Muokkaa",
"grp_delete" => "Poista",
"grp_view" => "Katseluoikeudet",
"grp_post_own" => "Omien varauksien lisäys/muutos",
"grp_post_all" => "Kaikkien varauksien lisäys/muutos",
"grp_manager" => "Post/edit + manager",
"grp_admin" => "Admin-oikeudet",
"grp_add_group" => "Add Ryhmä",
"grp_upd_group" => "Update Ryhmä",
"grp_no_rights" => "Ei oikeuksia",
"grp_added" => "Ryhmä poistettu",
"grp_updated" => "Ryhmä päivitetty",
"grp_deleted" => "Ryhmä poistettu",
"grp_not_added" => "Ryhmä ei poistettu",
"grp_not_updated" => "Ryhmä ei päivitetty",
"grp_not_deleted" => "Ryhmä ei poistettu",
"grp_in_use" => "Ryhmä is in use",
"grp_cred_required" => "Ryhmänimi, Oikeudet ja Categories vaaditaan",
"grp_name_exists" => "Ryhmänimi on jo käytössä",
"grp_name_invalid" => "Virheellinen ryhmä (min pituus 2 merkkiä: A-Z, a-z, 0-9, ja _-.) ",
"grp_background" => "Taustaväri",
"grp_select_color" => "Valitse väri",
"grp_invalid_color" => "Virheellinen väri (sallitut #XXXXXX where X = HEX-value)",
"grp_go_to_users" => "Go to Käyttäjät",

//database.php
"mdb_dbm_functions" => "Database Functions",
"mdb_noshow_tables" => "Cannot get table(s)",
"mdb_noshow_restore" => "Cannot find backup file",
"mdb_file_not_sql" => "Backup file type not '.sql'",
"mdb_compact" => "Compact database",
"mdb_compact_table" => "Compact table",
"mdb_compact_error" => "Error",
"mdb_compact_done" => "Done",
"mdb_purge_done" => "Deleted events definitively removed",
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
"cro_not_sum_title" => "SÄHKÄPOSTIMUISTUTUKSET",
"cro_not_sent_to" => "Muistutukset lähetetty",
"cro_no_not_dates_due" => "Ei muistutusten aikaa valittu",
"cro_all_day" => "Koko pv",
"cro_mailer" => "lähettäjä",
"cro_subject" => "Aihe",
"cro_event_due_in" => "Seuraava varaus on",
"cro_event_due_today" => "The following event is due today",
"cro_due_in" => "On",
"cro_due_today" => "Due today",
"cro_days" => "päivä(ä)",
"cro_date_time" => "Päivä / aika",
"cro_title" => "Otsikko",
"cro_venue" => "Paikka",
"cro_description" => "Selite",
"cro_category" => "Kategoria",
"cro_status" => "Status",
"cro_open_calendar" => "Siirry kalenteriin",
"cro_chg_sum_title" => "KALENTERIMUUTOKSET",
"cro_nr_changes_last" => "Muutoksia jäljellä",
"cro_report_sent_to" => "Raportti lähetetty",
"cro_no_report_sent" => "Ei raporttia lähetetty",
"cro_usc_sum_title" => "KÄYTTÄJÄTILIEN TARKISTUS",
"cro_nr_accounts_deleted" => "Käyttäjätilejä poistettu",
"cro_no_accounts_deleted" => "Ei käyttäjätilejä poistettu",
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
<h5>Backup database</h5>
<p>This function will create a backup of the full calendar database (tables 
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
<p>This form is used to import a <strong>Comma Separated Values (CSV)</strong> text 
file with event data into the LuxCal Calendar.</p>
<p>The order of columns in the CSV file must be: title, venue, category id (see 
below), date, end date, start time, end time and description. If the first row of 
the CSV file contains column headers, it will be ignored.</p>
<p>For proper handling of special characters, the CSV file must be UTF-8 encoded.</p>
<h5>Sample CSV files</h5>
<p>Sample CSV files (file extension .cvs) can be found in the 'files/' directory 
of your LuxCal download.</p>
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
<p>This form is used to import an <strong>iCalendar</strong> file with events into 
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
<p>The <b>iCal file name</b> (without extension) is optional. Created files will 
be stored in the \"files/\" directory on the server with the specified file name, 
or otherwise with the name of the calendar. The file extension will be <b>.ics</b>.
Existing files in the \"files/\" directory on the server with the same name will 
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
