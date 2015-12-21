<?php
/*
= LuxCal event calendar admin interface language file =

This file has been produced by LuxSoft and has been translated by Radoslav Yovev.

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//LuxCal ui language file version
define("LAI","4.3.0");

/* -- Admin Interface texts -- */

$ax = array(

//general
"none" => "He.",
"all" => "Всичко",
"back" => "Обратно",
"close" => "Затвори",
"always" => "Винаги",
"at_time" => "@", //date and time separator (e.g. 10-04-2016 @ 10:45)
"year" => "Година",
"month" => "Месец",
"week_day" => "Седмица/Ден",
"upcoming" => "Предстоящи",
"id" => "ID",

//settings.php - fieldset headers
"set_general_settings" => "Общи настройки",
"set_navbar_settings" => "Лента за навигация",
"set_event_settings" => "Събития",
"set_user_settings" => "Потребителски настройки",
"set_email_settings" => "Email настройки",
"set_perfun_settings" => "Периодични функции",
"set_minical_settings" => "Мини календар",
"set_sidebar_settings" => "Stand-Alone Sidebar<br>(only relevant if in use)",
"set_view_settings" => "Прегледай настройки",
"set_dt_settings" => "Дата/Час",
"set_save_settings" => "Запазване на настройките",
"set_test_mail" => "Test Mail",
"set_mail_sent_to" => "Test mail sent to",
"set_mail_sent_from" => "This test mail was sent from your calendar's Settings page",
"set_missing_invalid" => "Липсващи или неверни настройки",
"set_settings_saved" => "Настройките са запазени",
"set_save_error" => "Грешка в базата данни - Запазването на настройките за календара ПРОПАДНА",
"hover_for_details" => "Подробни описания и информация",
"default" => "Начални настройки",
"enabled" => "Разрешено",
"disabled" => "Забранено",
"no" => "НЕ",
"yes" => "ДА",
"or" => "ИЛИ",
"minutes" => "Минути",
"pixels" => "Пиксели",
"no_way" => "Нямате права да извършите тази операция",

//settings.php - general settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"calVersionDb_label" => "Версия на календара",
"calVersionDb_text" => "Версия на инсталрания програмен продукт за календара.",
"calTitle_label" => "Заглавие на календара",
"calTitle_text" => "Секцията в горната част на напомнянето календарната Виж имейл.",
"calUrl_label" => "Календар URL заглавие",
"calUrl_text" => "Календар URL текст.",
"calEmail_label" => "Календар Email",
"calEmail_text" => "The sender\'s email address used in notification emails.<br>Format: \'email\' or \'name&#8249;email&#8250;\'. \'name\' could be the calendar name.",
"backLinkUrl_label" => "Link to parent page",
"backLinkUrl_text" => "URL of parent page. If specified, a Back button will be displayed on the left side of the Navigation Bar which links to this URL.<br>For instance to link back to the parent page from which the calendar was started.",
"timeZone_label" => "Времева зона",
"timeZone_text" => "The calendar\'s time zone, used to calculate the current time.",
"see" => "Погледни",
"notifSender_label" => "Sender of notification emails",
"notifSender_text" => "When the calendar sends reminder emails, the sender field of the email can contain either the calendar email address, or the email address of the user who created the event.<br>In case of the user email address, the receiver can reply to the email.",
"rssFeed_label" => "RSS feed links",
"rssFeed_text" => "If enabled: For users with at least \'view\' rights an RSS feed link will be visible in the footer of the calendar and an RSS feed link will be added to the HTML head of the calendar pages.",
"calendar" => "Календар",
"user" => "Потребител",
"php_mail" => "PHP mail",
"smtp_mail" => "SMTP mail",

//settings.php - navigation bar settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"navButText_label" => "Navigation bar buttons with text",
"navButText_text" => "If enabled: On the navgation bar the buttons will be displayed with text. If disabled, the buttons are diplayed with icons.",
"sideLists_label" => "To Approve / Todo / Upcoming buttons",
"sideLists_text" => "If enabled: A Todo / Upcoming button will be displayed on the navigation bar, which when clicked will open the Todo list / Upcoming list.",
"navToapList_label" => "To approve button",
"navTodoList_label" => "Todo button",
"navUpcoList_label" => "Upcoming button",
"optionsPanel_label" => "Options panel menus",
"optionsPanel_text" => "Enable/disable menus in the options panel.<br>• The calendar menu is available to the admin to switch calendars. (enabling only useful if several calendars are installed)<br>• The groups menu can be used to display only events created by users in the selected groups.<br>• The users menu can be used to display only events created by the selected users.<br>• The categories menu can be used to display only events belonging to the selected event categories.<br>• The language menu can be used to select the user interface language. (enabling only useful if several languages are installed)",
"calMenu_label" => "calendar",
"groupMenu_label" => "groups",
"userMenu_label" => "Филтер за потребители",
"catMenu_label" => "Филтер за категория",
"langMenu_label" => "Избор на език",
"defaultView_label" => "Първоначален изглед",
"defaultView_text" => "Possible default views on calendar start-up are:<br>• Година<br>• Месец<br>• Седмица<br>• Ден<br>• Бъдещи събития<br>• Промени<br>Препоръчителни: Месеци или Бъдещ изглед на събития",
"language_label" => "Предварително дефинирани потребителски езици",
"language_text" => "The files ui-{language}.php, ai-{language}.php, ug-{language}.php and ug-layout.png must be present in the lang/ directory. {language} = selected user interface language. File names must be lower case!",

//settings.php - events settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"ownerTitle_label" => "Show event owner in front of event title",
"ownerTitle_text" => "In the various calendar views, show the event owner name in front of the calendar title.",
"privEvents_label" => "Posting of private events",
"privEvents_text" => "Private events are only visible to the user who entered the event.<br>Enabled: users can enter private events.<br>Default: when adding new events, the \'private\' check box in the Event window will be checked by default.<br>Always: when adding new events they will always be private, the \'private\' checkbox in the Event window will not be shown.",
"details4All_label" => "Show event details to users",
"details4All_text" => "Disabled: event details will only be visible to the owner of the event and to users with \'post all\' rights.<br>Enabled: event details will be visible to the owner of the event and to all other users.<br>Logged in: event details will be visible to the owner of the event and to logged in users.",
"evtDelButton_label" => "Show delete button in Event window",
"evtDelButton_text" => "Disabled: the Delete button in the Event window will not be visible. So users with edit rights will not be able to delete events.<br>Enabled: the Delete button in the Event window will be visible to all users.<br>Manager: the Delete button in the Event window will only be visible to users with \'manager\' rights.",
"eventColor_label" => "Event colors based on",
"eventColor_text" => "Events in the various calendar views can be displayed in the color assigned to the group to which the user who created the event belongs or the color of the event category.",
"xField1_label" => "Extra field 1",
"xField2_label" => "Extra field 2",
"xFieldx_text" => "Optional text field. If this field is included in the event template hereafter, the field will be added as a free format text field to the Event window form and to the events displayed in all calendar views and pages.<br>• label: optional text label for the extra field (max. 15 characters). E.g. \'Email address\', \'Website\', \'Phone number\'<br>• public: when checked, the field will be visible to all users; otherwise the field will only be visible to logged in users.",
"xField_label" => "label",
"xField_public" => "public",
"logged_in" => 'logged in',
"manager_only" => 'manager',
"user_group" => "user group",
"event_cat" => "event category",

//settings.php - user accounts settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"selfReg_label" => "Всеки може да бъде член.",
"selfReg_text" => "Всеки може да стане член, можете да редактирате.",
"selfRegGrp_label" => "Self registration user group",
"selfRegGrp_text" => "User group to which self-registered users will be assigned.",
"selfRegNot_label" => "Self registration notification",
"selfRegNot_text" => "Send a notification email to the calendar email address when a self-registration takes place.",
"restLastSel_label" => "Restore last user selections",
"restLastSel_text" => "The last user selections (the Option Panel settings) will be saved and when the user revisits the calendar later, the values will be restored.",
"cookieExp_label" => "'Remember me' cookie expiry days",
"cookieExp_text" => "Number of days before the cookie set by the \'Remember me\' option (during Log In) will expire.",
"view" => "Изглед",
"post_own" => 'Техните мнения',
"post_all" => 'Всички мнения',
"manager" => 'Post/manager',

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
"colsToShow_label" => "Година с оглед на броя на колоните",
"colsToShow_text" => "Година оглед колко колони ще бъде.<br>Препоръчителна: 3 и 4.",
"rowsToShow_label" => "Броя на редовете в изглед Година",
"rowsToShow_text" => "Колко редове ще бъдат в изглед Година<br>Препоръчително: 4, 4 Ако всичко е направено 16 месеца могат да се покажат.",
"weeksToShow_label" => "Вие сте в изглед за месец показва няколко седмици",
"weeksToShow_text" => "Посочете колко седмици ще се появят  в екрана за месец.<br>Препоръчително: 10, по този начин 2,5 Можете да получите месечен изглед. <br>The values 0 and 1 have a special meaning:<br>0: display exactly 1 month - blank leading and trailing days.<br>1: display exactly 1 month - display events on leading and trailing days.",
"workWeekDays_label" => "Дни от работната седмица",
"workWeekDays_text" => "Days to be shown in each week in Work Month view and Work Week view.<br>Enter the number of each day that should be visible. Valid day numbers:<br>1 = Понеделник<br>2 = Вторник<br>....<br>7 = Неделя<br>e.g. 12345 : Понеделник - Петък",
"lookaheadDays_label" => "Показва как сте Ще дойде ден,",
"lookaheadDays_text" => "Въведете ежедневно, за да се покаже пак следващата им среща.",
"dwStartHour_label" => "След Започване",
"dwStartHour_text" => "Тук можете да зададете часа до полунощ показва часовите зони.<br>Пример 7 нощи от 7 до 12 часа сутрин, ако писмено се превръща активни.<br>The time picker, used to enter a time, will also start at this hour.",
"dwEndHour_label" => "End hour in Day/Week view",
"dwEndHour_text" => "Hour at which a normal day of events ends.<br>E.g., setting this value to 18 will avoid wasting space in Week/Day view for the quiet time between 18:00 and midnight.<br>The time picker, used to enter a time, will also end at this hour.",
"dwTimeSlot_label" => "Time slot in Day/Week view",
"dwTimeSlot_text" => "Day/Week view time slot in number of minutes.<br>This value, together with the Start hour and End hour (see above) will determine the number of rows in Day/Week view.",
"dwTsHeight_label" => "Time slot height",
"dwTsHeight_text" => "Day/Week view time slot display height in number of pixels.",
"showInMView_label" => "Show in month view",
"showInMView_text" => "Enabled/disable the display in Month view of the following items:<br>• URLs in one of the event description fields (will be displayed as hyperlink)<br>• images in one of the event description fields",
"urls" => "URL links",
"images" => "images",
"monthInDCell_label" => "Month in each day cell",
"monthInDCell_text" => "Display in month view the 3-letter month name for each day",

//settings.php - date/time settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"dateFormat_label" => "Формат на датата (dd mm yyyy)",
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
"weekStart_label" => "Първи ден от седмицата",
"weekStart_text" => "В някои страни, седмицата започва в неделя.",
"weekNumber_label" => "Покажи номерата на седмиците",
"weekNumber_text" => "The display of week numbers in Year, Month and Week view can be enabled/disabled",
"time_format_us" => "12-часа AM/PM",
"time_format_eu" => "24-часа",
"sunday" => "Неделя",
"monday" => "Понеделник",
"time_zones" => "Времеви зони",
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
"chgEmailList_label" => "Промените да бъдат използвани за e-mail",
"chgEmailList_text" => "Вие можете да отбележите някакви промени, необходими на приятел.<br>
Можете да изпратите по електронна поща адреси със запетаи.",
"chgNofDays_label" => "Колко дни преди да забележите.",
"chgNofDays_text" => "Number of days to look back for the summary of calendar changes.<br>If the number of days is set to 0 no summary of changes will be sent.",
"icsExport_label" => "Daily export of iCal events",
"icsExport_text" => "If enabled: All events in the date range -1 week until +1 yesr will be exported in iCalendar format in a .ics file in the \'files\' folder.<br>The file name will be the calendar name with blanks replaced by underscores. Old files will be overwritten by new files.",
"eventExp_label" => "Event expiry days",
"eventExp_text" => "Number of days after the event due date when the event expires and will be automatically deleted.<br>If 0 or if no cron job is running, no events will be automatically deleted.",
"maxNoLogin_label" => "максимален брой символи на потребителско име за вход",
"maxNoLogin_text" => "Ако не влезете на потребителя, посочени тук, до деня, в края на деня, ако този пост ще бъде изтрит, когато потребителят.",

//settings.php - mini calendar / sidebar settings. Single quotes in the ......_text translations below must be escaped by a backslash (e.g. \')
"miniCalView_label" => "Mini calendar view",
"miniCalView_text" => "Possible views for the mini calendar are:<br>• Full Month<br>• Work Month *)<br>• Full Week<br>• Work Week *)<br>*) For work week days see on this page: Views - Work week days",
"miniCalPost_label" => "Добавяне на календарни събития чрез",
"miniCalPost_text" => "Използва се само за мини-календар.<br>Ако потребителят е активен:<br>• Добавяне на потребителски събития, които правят деня, като щракнете върху горната страна на земното кълбо направи добавяне и премахване на.<br>Note: The access rights of the Public User will be applicable.",
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
"log_log_in" => "Влез в системата",
"log_remember_me" => "Запомни ме",
"log_register" => "Ргистирам",
"log_change_my_data" => "Промяна на моята информация",
"log_change" => "Промяна",
"log_un_or_em" => "Потребителско име/E-mail",
"log_un" => "Потребителско име",
"log_em" => "Email",
"log_pw" => "Парола",
"log_new_un" => "Ново потребителско име",
"log_new_em" => "Нов Email",
"log_new_pw" => "Нова парола ",
"log_pw_msg" => "Here are your log in details for calendar",
"log_pw_subject" => "Вашата %% парола", //%% will be replaced by calendar name
"log_npw_subject" => "Вашата нова %% парола", //%% will be replaced by calendar name
"log_npw_sent" => "Вашата парола е изпратена",
"log_registered" => "Registration successful - Your password has been sent by email",
"log_not_registered" => "Registration not successful",
"log_un_exists" => "Вече съществува такъв потребител",
"log_em_exists" => "вече съществува имейл адрес.",
"log_un_invalid" => "Invalid username (min length 2: A-Z, a-z, 0-9, and _-.) ",
"log_em_invalid" => "Invalid email address",
"log_un_em_invalid" => "The username/email is not valid",
"log_un_em_pw_invalid" => "The username/email or password is not valid",
"log_no_un_em" => "Please enter your username/email",
"log_no_un" => "Please enter your username",
"log_no_em" => "Please enter your email address",
"log_no_pw" => "Please enter your password",
"log_no_rights" => "Login rejected: you have no view rights - Contact the administrator",
"log_send_new_pw" => "Изпрати ми моята парола",
"log_if_changing" => "Само при промени",
"log_no_new_data" => "Информацията не е променена",
"log_invalid_new_un" => "Invalid new username (min length 2: A-Z, a-z, 0-9, and _-.) ",
"log_new_un_exists" => "New username already exists",
"log_invalid_new_em" => "New email address invalid",
"log_new_em_exists" => "New email address already exists",
"log_ui_language" => "Потребителски език",
"log_new_reg" => "New user registration",
"log_date_time" => "Date / time",
"log_time_out" => "Time out",

//categories.php
"cat_list" => "Категории",
"cat_edit" => "Редактиране на категории",
"cat_delete" => "Изчисти",
"cat_add_new" => "Добавяне на нова категория",
"cat_add" => "ДОБАВИ",
"cat_edit_cat" => "Редактирай категория",
"cat_sort" => "Sort On Name",
"cat_name" => "Име на категория",
"cat_sequence" => "Сортиране по:",
"cat_in_menu" => "в менюто",
"cat_text_color" => "Цвят на шрифта",
"cat_background" => "Цвят на фона",
"cat_select_color" => "Изберете цвят",
"cat_save" => "Запази",
"cat_added" => "Категорията е добавена",
"cat_updated" => "Категорията е променена успешно",
"cat_deleted" => "Категорията е изтрита",
"cat_invalid_color" => "Грешен цветови код (#XXXXXX where X = HEX-value)",
"cat_not_added" => "Категорията не е добавена",
"cat_not_updated" => "Категорията не е променена",
"cat_not_deleted" => "Категорията не е изтрита",
"cat_nr" => "#",
"cat_repeat" => "Отново",
"cat_every_day" => "Всеки ден",
"cat_every_week" => "Всяка седмица",
"cat_every_month" => "Всеки месец",
"cat_every_year" => "Всяка година",
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
"cat_day_color" => "Day color",
"cat_approve" => "Нуждаят се от одобрение",
"cat_check_mark" => "Check mark",
"cat_label" => "label",
"cat_mark" => "mark",
"cat_name_missing" => "Category name is missing",
"cat_mark_label_missing" => "Check mark/label is missing",

//users.php
"usr_list_of_users" => "Списък с потребители",
"usr_name" => "Потребителско име",
"usr_email" => "Email",
"usr_group" => "Group",
"usr_password" => "Парола",
"usr_edit_user" => "Редактиране на потребителски профил",
"usr_add" => "ДОБАВИ потребител",
"usr_edit" => "Промяна на потребител",
"usr_delete" => "Изтий потребител",
"usr_login_0" => "Първо посещение",
"usr_login_1" => "Последно посещение",
"usr_login_cnt" => "Брой потребителски влизания",
"usr_add_profile" => "ДОБАВИ към профил",
"usr_upd_profile" => "Актуализиране на профил",
"usr_if_changing_pw" => "Парола може да бъде променена, ако",
"usr_pw_not_updated" => "Потребителската парола не е променена",
"usr_added" => "Добавяне на потребители",
"usr_updated" => "User profile updated",
"usr_deleted" => "Потребителят е изтрит",
"usr_not_added" => "Потребителят не е добавен",
"usr_not_updated" => "Потребителят не е променен",
"usr_not_deleted" => "Потребителят не е изтрит",
"usr_cred_required" => "Полетата име, имейл и парола са задължителни.",
"usr_uname_exists" => "Това потребителско име е заето",
"usr_email_exists" => "Email address already exists",
"usr_un_invalid" => "Invalid username (min length 2: A-Z, a-z, 0-9, and _-.) ",
"usr_em_invalid" => "Invalid email address",
"usr_cant_delete_yourself" => "Вие не можете да изтривате собствените си потребител.",
"usr_go_to_groups" => "Go to Groups",

//groups.php
"grp_list_of_groups" => "List of User Groups",
"grp_name" => "Group name",
"grp_privs" => "Rights",
"grp_categories" => "Event categories",
"grp_all_cats" => "all categories",
"grp_rep_events" => "Repeating events",
"grp_m-d_events" => "Multi-day events",
"grp_priv_events" => "Private events",
"grp_may_post_revents" => "May post repeating events",
"grp_may_post_mevents" => "May post multi-day events",
"grp_may_post_pevents" => "May post private events",
"grp_no_overlap" => "no overlap allowed",
"grp_edit_group" => "Edit User Group",
"grp_edit" => "Edit",
"grp_delete" => "Delete",
"grp_view" => "Преглед на потребителя",
"grp_post_own" => "Потребителски мнения",
"grp_post_all" => "Всички потребителски мнения",
"grp_manager" => "Post/edit + manager",
"grp_admin" => "Мениджър",
"grp_add_group" => "Add Group",
"grp_upd_group" => "Update Group",
"grp_no_rights" => "No access rights",
"grp_added" => "Group added",
"grp_updated" => "Group updated",
"grp_deleted" => "Group deleted",
"grp_not_added" => "Group not added",
"grp_not_updated" => "Group not updated",
"grp_not_deleted" => "Group not deleted",
"grp_in_use" => "Group is in use",
"grp_cred_required" => "Group name, Rights and Categories are required",
"grp_name_exists" => "Group name already exists",
"grp_name_invalid" => "Invalid group name (min length 2: A-Z, a-z, 0-9, and _-.) ",
"grp_background" => "Background color",
"grp_select_color" => "Select Color",
"grp_invalid_color" => "Color format invalid (#XXXXXX where X = HEX-value)",
"grp_go_to_users" => "Go to Users",

//database.php
"mdb_dbm_functions" => "Настройки на базата данни",
"mdb_noshow_tables" => "Таблиците не могат да бъдат доведени.",
"mdb_noshow_restore" => "No source backup file selected",
"mdb_file_not_sql" => "Source backup file should be an SQL file (extension '.sql')",
"mdb_compact" => "Compact database",
"mdb_compact_table" => "Моята съвместима таблица",
"mdb_compact_error" => "ГРЕШКА",
"mdb_compact_done" => "Завършен",
"mdb_purge_done" => "Изтритите събития са окончателно отстранени",
"mdb_backup" => "Database Backup",
"mdb_backup_table" => "Table Backup",
"mdb_backup_file" => "Backup file",
"mdb_backup_done" => "Завършено",
"mdb_records" => "records",
"mdb_restore" => "Restore database",
"mdb_restore_table" => "Restore table",
"mdb_inserted" => "records inserted",
"mdb_db_restored" => "Database restored.",
"mdb_no_bup_match" => "Backup file doesn't match calendar version.<br>Database not restored.",
"mdb_events" => "Events",
"mdb_delete" => "delete",
"mdb_undelete" => "undelete",
"mdb_between_dates" => "occurring between",
"mdb_deleted" => "Events deleted",
"mdb_undeleted" => "Events undeleted",
"mdb_file_saved" => "Файлът е записан.",
"mdb_no_function_checked" => "No function(s) selected",
"mdb_write_error" => "Writing backup file failed<br>Check permissions of 'files/' directory",

//import/export.php
"iex_file" => "Изберете файл",
"iex_file_name" => "iCal file name",
"iex_file_description" => "iCal Описание на файла",
"iex_filters" => "Event Filters",
"iex_upload_ics" => "iCal Качване на файл",
"iex_create_ics" => "iCal създаване на файл",
"iex_upload_csv" => "CSV изтегляне ",
"iex_upload_file" => "Изтегляне ",
"iex_create_file" => "Създаване на файл",
"iex_download_file" => "Запазване на файл",
"iex_fields_sep_by" => "Данни на маркировката за раздяла",
"iex_birthday_cat_id" => "Категория Рожден ден ID",
"iex_default_cat_id" => "Предварително Категория ID",
"iex_if_no_cat" => "Ако категорията е",
"iex_import_events_from_date" => "Събитията считано от тази дата: ",
"iex_see_insert" => "Вижте инструкциите по-долу.",
"iex_no_file_name" => "Грешка в името на файла",
"iex_inval_field_sep" => "invalid or no field separator",
"iex_no_begin_tag" => "invalid iCal file (BEGIN-tag missing)",
"iex_date_format" => "Формат на датата",
"iex_time_format" => "Времеви формат",
"iex_number_of_errors" => "Number of errors in list",
"iex_bgnd_highlighted" => "background highlighted",
"iex_verify_event_list" => "Verify Event List, correct possible errors and click",
"iex_add_events" => "Add Events to Database",
"iex_select_ignore_birthday" => "Select Ignore and Birthday check boxes as required",
"iex_select_ignore" => "Select Ignore check box to ignore event",
"iex_title" => "Заглавие",
"iex_venue" => "Yer",
"iex_owner" => "Owner",
"iex_category" => "Категория",
"iex_date" => "Дата",
"iex_end_date" => "Завършване",
"iex_start_time" => "Начално време",
"iex_end_time" => "Време за Край",
"iex_description" => "Обяснение",
"iex_repeat" => "Repeat",
"iex_birthday" => "Рожден ден",
"iex_ignore" => "Изчисти",
"iex_events_added" => "Събитията бяха добавени",
"iex_events_dropped" => "Събитията бяха изключени (вече съществуват)",
"iex_db_error" => "Грешка в базата данни",
"iex_csv_file_error_on_line" => "CSV file error on line",
"iex_ics_file_error_on_line" => "iCal file error on line",
"iex_between_dates" => "Между тази дата",
"iex_changed_between" => "Между датите Добавено / променено",
"iex_select_date" => "Изберете дата",
"iex_select_start_date" => "Select start date",
"iex_select_end_date" => "Select end date",
"iex_all_cats" => "Всички категории",
"iex_all_users" => "all users",
"iex_no_events_found" => "Събитие / дейност не е намерена",
"iex_file_created" => "Dosya Oluşturuldu",
"iex_write error" => "Writing export file failed<br>Check permissions of 'files/' directory",

//lcalcron.php
"cro_sum_header" => "CRON JOB SUMMARY",
"cro_sum_trailer" => "END OF SUMMARY",
"cro_evc_sum_title" => "EVENTS EXPIRED",
"cro_nr_evts_deleted" => "Number of events deleted",
"cro_not_sum_title" => "EMAIL REMINDERS",
"cro_not_sent_to" => "Reminders sent to",
"cro_no_not_dates_due" => "No notification dates due",
"cro_all_day" => "Всички дни",
"cro_mailer" => "mailer",
"cro_subject" => "Тема",
"cro_event_due_in" => "Причина за следните събития",
"cro_event_due_today" => "The following event is due today",
"cro_due_in" => "Оставащо",
"cro_due_today" => "Due today",
"cro_days" => "Ден(дни)",
"cro_date_time" => "Дата / час",
"cro_title" => "Заглавие",
"cro_venue" => "Място",
"cro_description" => "Обяснение",
"cro_category" => "Категория",
"cro_status" => "Статус",
"cro_open_calendar" => "Отворен календар",
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
"<h4>Инструкции мениджъра на базата данни</h4>
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
