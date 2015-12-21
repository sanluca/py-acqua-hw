<?php
/*
======== WORK BENCH TOOLS =========

© Copyright 2009-2014 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/
//settings definitions
$defSet = array( //name => default value, outline
	'lcVersion' => array($lcV,'Version number of current LuxCal installation'),
	'calendarTitle' => array('LuxCal Calendar','Calendar title displayed in the top bar'),
	'calendarUrl' => array('http://'.$_SERVER['SERVER_NAME'].rtrim(dirname($_SERVER["PHP_SELF"]),'/').'/index.php','Calendar link (URL)'),
	'calendarEmail' => array('calendar@email.com','Sender in and receiver of email notifications'),
	'backLinkUrl' => array('','Nav bar Back button URL (blank: no button, url: Back button)'),
	'timeZone' => array('Europe/Amsterdam','Calendar time zone'),
	'notifSender' => array(0,'Sender of notification emails (0:calendar, 1:user)'),
	'rssFeed' => array(1,'Display RSS feed links in footer and HTML head (0:no, 1:yes)'),
	'navButText' => array(0,'Navigation buttons with text or icons (0:icons, 1:text)'),
	'navTodoList' => array(1,'Display Todo List button on navbar (0:no, 1:yes)'),
	'navUpcoList' => array(1,'Display Upco List button on navbar (0:no, 1:yes)'),
	'userMenu' => array(1,'Display user filter menu in options panel (0:no, 1:yes)'),
	'catMenu' => array(1,'Display category filter menu in options panel(0:no, 1:yes)'),
	'langMenu' => array(0,'Display ui-language selection menu in options panel (0:no, 1:yes)'),
	'defaultView' => array(2,'Calendar view at start-up (1:year, 2:month, 3:work month, 4:week, 5:work week 6:day, 7:upcoming, 8:changes)'),
	'language' => array('English','Default user interface language'),
	'privEvents' => array(1,'Private events (0:disabled 1:enabled, 2:default, 3:always)'),
	'details4All' => array(1,'Show event details to x users (0:none, 1:all, 2:logged-in users)'),
	'evtDelButton' => array(1,'Display Delete button in Event window (0:no, 1:yes, 2:manager)'),
	'eventColor' => array(1,'Event colors (0:user color, 1:cat color)'),
	'xField1' => array('','Label optional extra event field 1'),
	'xField2' => array('','Label optional extra event field 2'),
	'selfReg' => array(0,'Self-registration (0:no, 1:yes)'),
	'selfRegGrp' => array(1,'Self-registration user group ID'),
	'selfRegNot' => array(0,'User self-reg notification to admin (0:no, 1:yes)'),
	'restLastSel' => array(1,'Restore last session when user revisits calendar'),
	'cookieExp' => array(30,'Number of days before a Remember Me cookie expires'),
	'evtTemplGen' => array('1234567','Event fields and order of fields in general views'),
	'evtTemplUpc' => array('12345','Event fields and order of fields in upcoming events view'),
	'popBoxFields' => array('12345','Event fields and order of fields in hover box'),
	'popBoxYear' => array(1,'Display hover box in year view (0:no, 1:yes)'),
	'popBoxMonth' => array(1,'Display hover box in month view (0:no, 1:yes)'),
	'popBoxWkDay' => array(1,'Display hover box in week/day view (0:no, 1:yes)'),
	'popBoxUpc' => array(1,'Display hover box in upcoming view (0:no, 1:yes)'),
	'yearStart' => array(0,'Start month in year view (1-12 or 0, 0:current month)'),
	'colsToShow' => array(3,'Number of months to show per row in year view'),
	'rowsToShow' => array(4,'Number of rows to show in year view'),
	'weeksToShow' => array(10,'Number of weeks to show in month view'),
	'workWeekDays' => array('12345','Days to show in work weeks (1:mo - 7:su)'),
	'lookaheadDays' => array(14,'Days to look ahead in upcoming view, todo list and RSS feeds'),
	'dwStartHour' => array(6,'Day/week view start hour'),
	'dwEndHour' => array(18,'Day/week view end hour'),
	'dwTimeSlot' => array(30,'Day/week time slot in minutes'),
	'dwTsHeight' => array(20,'Day/week time slot height in pixels'),
	'showLinkInMV' => array(1,'Show URL-links in month view (0:no, 1:yes)'),
	'monthInDCell' => array(0,'Show in month view month for each day (0:no, 1:yes)'),
	'dateFormat' => array('d.m.y','Date format: yyyy-mm-dd (y:yyyy, m:mm, d:dd)'),
	'MdFormat' => array('d M','Date format: dd month (d:dd, M:month)'),
	'MdyFormat' => array('d M y','Date format: dd month yyyy (d:dd, M:month, y:yyyy)'),
	'MyFormat' => array('M y','Date format: month yyyy (M:month, y:yyyy)'),
	'DMdFormat' => array('WD d M','Date format: weekday dd month (WD:weekday d:dd, M:month)'),
	'DMdyFormat' => array('WD d M y','Date format: weekday dd month yyyy (WD:weekday d:dd, M:month, y:yyyy)'),
	'timeFormat' => array('h:m','Time format (H:hh, h:h, m:mm, a:am|pm, A:AM|PM)'),
	'weekStart' => array(1,'Week starts on Sunday(0) or Monday(1)'),
	'weekNumber' => array(1,'Week numbers on(1) or off(0)'),
	'mailServer' => array(1,'Mail server (0:mail disabled, 1:PHP mail, 2:SMTP mail)'),
	'smtpServer' => array('','SMTP mail server name'),
	'smtpPort' => array(465,'SMTP port number'),
	'smtpSsl' => array(1,'Use SSL (Secure Sockets Layer) (0:no, 1:yes)'),
	'smtpAuth' => array(1,'Use SMTP authentication (0:no, 1:yes)'),
	'smtpUser' => array('','SMTP username'),
	'smtpPass' => array('','SMTP password'),
	'adminCronSum' => array(1,'Send cron job summary to admin (0:no, 1:yes)'),
	'chgEmailList' => array('','Recipient email addresses for calendar changes'),
	'chgNofDays' => array(1,'Number of days to look back for calendar changes'),
	'icsExport' => array(0,'Daily export of events in iCal format (0:no 1:yes)'),
	'eventExp' => array(0,'Number of days after due when an event expires / can be deleted (0:never)'),
	'maxNoLogin' => array(0,'Number of days not logged in, before deleting user account (0:never delete)'),
	'miniCalView' => array(1,'Mini calendar view (1:full month, 2:work month)'),
	'miniCalPost' => array(0,'Mini calendar event posting (0:no, 1:yes)'),
	'popFieldsMcal' => array('12345','Event fields in minical hover box (none: no box)'),
	'mCalUrlFull' => array('','Mini calendar link to full calendar'),
	'popFieldsSbar' => array('12345','Event fields in sidebar hover box (none: no box)'),
	'showLinkInSB' => array(1,'Show URL-links in sidebar (0:no, 1:yes)'),
	'sideBarDays' => array(14,'Days to look ahead in sidebar')
);

//database table definitions
$tableDefs = array(
	"events" => array(
		"ID INTEGER PRIMARY KEY",
		"type INTEGER NOT NULL DEFAULT 0",
		"private INTEGER NOT NULL DEFAULT 0",
		"title TEXT DEFAULT NULL",
		"venue TEXT DEFAULT NULL",
		"text1 TEXT DEFAULT NULL",
		"text2 TEXT DEFAULT NULL",
		"text3 TEXT DEFAULT NULL",
		"catID INTEGER NOT NULL DEFAULT 1",
		"userID INTEGER DEFAULT NULL",
		"editor TEXT NOT NULL DEFAULT ''",
		"approved INTEGER NOT NULL DEFAULT 0",
		"checked TEXT DEFAULT NULL",
		"notify INTEGER NOT NULL DEFAULT -1",
		"notMail TEXT DEFAULT NULL",
		"sDate TEXT DEFAULT NULL",
		"eDate TEXT NOT NULL DEFAULT '9999-00-00'",
		"xDates TEXT DEFAULT NULL",
		"sTime TEXT DEFAULT NULL",
		"eTime TEXT NOT NULL DEFAULT '99:00'",
		"rType INTEGER NOT NULL DEFAULT 0",
		"rInterval INTEGER NOT NULL DEFAULT 0",
		"rPeriod INTEGER NOT NULL DEFAULT 0",
		"rMonth INTEGER NOT NULL DEFAULT 0",
		"rUntil TEXT NOT NULL DEFAULT '9999-00-00'",
		"aDateTime DATETIME NOT NULL DEFAULT '9999-00-00 00:00'",
		"mDateTime DATETIME NOT NULL DEFAULT '9999-00-00 00:00'",
		"status BOOLEAN NOT NULL DEFAULT 0"),
	"categories" => array(
		"ID INTEGER PRIMARY KEY",
		"name TEXT NOT NULL DEFAULT ''",
		"sequence INTEGER NOT NULL DEFAULT 1",
		"repeat INTEGER NOT NULL DEFAULT 0",
		"approve INTEGER NOT NULL DEFAULT 0",
		"public INTEGER NOT NULL DEFAULT 1",
		"color TEXT DEFAULT NULL",
		"bgColor TEXT DEFAULT NULL",
		"checkBx INTEGER NOT NULL DEFAULT 0",
		"checkLb TEXT NOT NULL DEFAULT 'approved'",
		"checkMk TEXT NOT NULL DEFAULT '&#10003;'",
		"status BOOLEAN NOT NULL DEFAULT 0"),
	"users" => array(
		"ID INTEGER PRIMARY KEY",
		"name TEXT NOT NULL DEFAULT ''",
		"password TEXT NOT NULL DEFAULT ''",
		"tPassword TEXT DEFAULT NULL",
		"email TEXT NOT NULL DEFAULT ''",
		"groupID INTEGER DEFAULT NULL",
		"language TEXT DEFAULT NULL",
		"login0 TEXT NOT NULL DEFAULT '9999-00-00'",
		"login1 TEXT NOT NULL DEFAULT '9999-00-00'",
		"loginCnt INTEGER NOT NULL DEFAULT 0",
		"status BOOLEAN NOT NULL DEFAULT 0"),
	"groups" => array(
		"ID INTEGER PRIMARY KEY",
		"name TEXT NOT NULL DEFAULT ''",
		"privs INTEGER NOT NULL DEFAULT 0",
		"catIDs TEXT NOT NULL DEFAULT '0'",
		"color TEXT DEFAULT NULL",
		"status BOOLEAN NOT NULL DEFAULT 0"),
	"settings" => array(
		"name TEXT NOT NULL DEFAULT '' PRIMARY KEY",
		"value TEXT DEFAULT NULL",
		"outline TEXT DEFAULT NULL")
	);

function dbTableExists($tableName) { //test if database table exists
	global $dbH;

	$stH = stPrep("SELECT COUNT(*) FROM sqlite_master WHERE type='table' AND name=?");
	stExec($stH,array($tableName));
	$res = $stH->fetch(PDO::FETCH_NUM);
	$stH = null; //release statement handle!
	return $res[0];
}

function createDbTable($tableName) { //create database table
	global $tableDefs;

	switch ($tableName) {
	case 'events': //create table 'events'
		$stH = stPrep("CREATE TABLE IF NOT EXISTS events (\n".implode(",\n",$tableDefs['events']).")"); break;
	case 'categories': //create table 'categories'
		$stH = stPrep("CREATE TABLE IF NOT EXISTS categories (\n".implode(",\n",$tableDefs['categories']).")"); break;
	case 'users': //create table 'users'
		$stH = stPrep("CREATE TABLE IF NOT EXISTS users (\n".implode(",\n",$tableDefs['users']).")"); break;
	case 'groups': //create table 'groups'
		$stH = stPrep("CREATE TABLE IF NOT EXISTS groups (\n".implode(",\n",$tableDefs['groups']).")"); break;
	case 'settings': //create table 'settings'
		$stH = stPrep("CREATE TABLE IF NOT EXISTS settings (\n".implode(",\n",$tableDefs['settings']).")");
	}
	$result = $stH ? stExec($stH,null) : false; //execute statement
	return $result;
}

function initCats() { //init categories table
	$stH = stPrep("REPLACE INTO categories (ID, name, sequence) VALUES (?,?,?)");
	if ($stH === false) { return false; }
	$result = stExec($stH,array(1,'no cat',1));
	return $result;
}

function initUsers($adName,$adMail,$adPwMd5) { //init users table
	$stH = stPrep("REPLACE INTO users (ID, name, email, password, groupID) VALUES (?,?,?,?,?)");
	if ($stH === false) { return false; }
	$result = stExec($stH,array(1,'Public Access','','',1));
	$result = $result and stExec($stH,array(2,$adName,$adMail,$adPwMd5,2));
	return ($result);
}

function initGroups() { //init groups table
	$stH = stPrep("REPLACE INTO groups (ID, name, privs, catIDs) VALUES (?,?,?,?)");
	if ($stH === false) { return false; }
	$result = stExec($stH,array(0,'No access',0,'0'));
	$result = $result and stExec($stH,array(1,'Read access',1,'0'));
	$result = $result and stExec($stH,array(2,'Admin',9,'0'));
	$result = $result and stExec($stH,array(3,'Post Own',2,'0'));
	$result = $result and stExec($stH,array(4,'Post All',3,'0'));
	$result = $result and stExec($stH,array(5,'Manager',4,'0'));
	return ($result);
}

function checkSettings(&$dbSet) { //check & complete calendar settings
	global $defSet;
	
	foreach($defSet as $key => $value) {
		if (!isset($dbSet[$key])) { //set not-set settings to default value
			$dbSet[$key] = $value[0];
		}
	}
	foreach($dbSet as $key => $value) {
		if (!isset($defSet[$key])) { //delete redundant settings
			unset($dbSet[$key]);
		}
	}
}

function saveSettings(&$dbSet,$saveAll=true) { //save settings to calendar
	global $defSet;
	
	if ($saveAll) {
		$stH = stPrep("DELETE FROM settings"); // empty table
	} else {
		$stH = stPrep("DELETE FROM settings WHERE name NOT LIKE 'calendar%'"); //empty table, except calendar values
	}
	if ($stH === false) { return false; }
	$result = stExec($stH,null);
	if ($result) { //save settings
		$stH = stPrep("REPLACE INTO settings VALUES (?,?,?)"); //save
		if ($stH === false) { return false; }
		foreach($dbSet as $key => $value) {
			if ($saveAll or substr($value,0,8) != 'calendar') {
				if (!stExec($stH,array($key,$value,$defSet[$key][1]))) { return false; }
			}
		}
	}
	return $result;
}

function saveConfig() { //Save LuxCal version and db data to lcconfig.php
	global $lcV, $dbDir, $dbDef, $dbSel;

	$config = '<?php
/*
= LuxCal event calendar configuration =
*/
$lcV="'.$lcV.'"; //LuxCal version
$dbDir="'.(isset($dbDir) ? $dbDir : 'db/').'"; //db directory
$dbDef="'.(isset($dbDef) ? $dbDef : '').'"; //default calendar (db name)
$dbSel='.(isset($dbSel) ? $dbSel : 1).'; //Selectable in Options panel
?>';
	return file_put_contents('./lcconfig.php',$config);
}
?>