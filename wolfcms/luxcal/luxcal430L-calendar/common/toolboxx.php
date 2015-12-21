<?php
/*
======== WORK BENCH TOOLS =========

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/
//settings definitions
$defSet = array( //name => default value, outline
	'calendarTitle' => array('LuxCal Calendar','Calendar title displayed in the top bar'),
	'calendarUrl' => array('http://'.$_SERVER['SERVER_NAME'].rtrim(dirname($_SERVER["PHP_SELF"]),'/').'/index.php','Calendar link (URL)'),
	'calendarEmail' => array('calendar@email.com','Sender in and receiver of email notifications'),
	'backLinkUrl' => array('','Nav bar Back button URL (blank: no button, url: Back button)'),
	'timeZone' => array('Europe/Amsterdam','Calendar time zone'),
	'notifSender' => array(0,'Sender of notification emails (0:calendar, 1:user)'),
	'rssFeed' => array(1,'Display RSS feed links in footer and HTML head (0:no, 1:yes)'),
	'navButText' => array(0,'Navigation buttons with text or icons (0:icons, 1:text)'),
	'navToapList' => array(1,'Display Toab List button on navbar (0:no, 1:yes)'),
	'navTodoList' => array(1,'Display Todo List button on navbar (0:no, 1:yes)'),
	'navUpcoList' => array(1,'Display Upco List button on navbar (0:no, 1:yes)'),
	'groupMenu' => array(1,'Display group filter menu in options panel (0:no, 1:yes)'),
	'userMenu' => array(1,'Display user filter menu in options panel (0:no, 1:yes)'),
	'catMenu' => array(1,'Display category filter menu in options panel(0:no, 1:yes)'),
	'langMenu' => array(0,'Display ui-language selection menu in options panel (0:no, 1:yes)'),
	'defaultView' => array(2,'Calendar view at start-up (1:year, 2:month, 3:work month, 4:week, 5:work week 6:day, 7:upcoming, 8:changes)'),
	'language' => array('English','Default user interface language'),
	'ownerTitle' => array(0,'Prepend owner to event title (0:disabled 1:enabled)'),
	'privEvents' => array(1,'Private events (0:disabled 1:enabled, 2:default, 3:always)'),
	'details4All' => array(1,'Show event details to x users (0:none, 1:all, 2:logged-in users)'),
	'evtDelButton' => array(1,'Display Delete button in Event window (0:no, 1:yes, 2:manager)'),
	'eventColor' => array(1,'Event colors (0:user color, 1:cat color)'),
	'xField1Label' => array('','Label optional extra event field 1'),
	'xField2Label' => array('','Label optional extra event field 2'),
	'xField1Public' => array(1,'Extra event field 1 for all users'),
	'xField2Public' => array(1,'Extra event field 2 for all users'),
	'selfReg' => array(0,'Self-registration (0:no, 1:yes)'),
	'selfRegGrp' => array(2,'Self-registration user group ID'),
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
	'showImageInMV' => array(0,'Show images in month view (0:no, 1:yes)'),
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
		"`ID` INTEGER PRIMARY KEY ".($dbType == 'SQLite' ? 'AUTOINCREMENT' : 'AUTO_INCREMENT'),
		"`type` TINYINT NOT NULL DEFAULT 0",
		"`private` TINYINT NOT NULL DEFAULT 0",
		"`title` TEXT DEFAULT NULL",
		"`venue` TEXT DEFAULT NULL",
		"`text1` TEXT DEFAULT NULL",
		"`text2` TEXT DEFAULT NULL",
		"`text3` TEXT DEFAULT NULL",
		"`catID` MEDIUMINT NOT NULL DEFAULT 1",
		"`userID` MEDIUMINT DEFAULT NULL",
		"`editor` TEXT NOT NULL DEFAULT ''",
		"`approved` TINYINT NOT NULL DEFAULT 0",
		"`checked` TEXT DEFAULT NULL",
		"`notify` TINYINT NOT NULL DEFAULT -1",
		"`notMail` TEXT DEFAULT NULL",
		"`sDate` VARCHAR(10) DEFAULT NULL",
		"`eDate` VARCHAR(10) NOT NULL DEFAULT '9999-00-00'",
		"`xDates` TEXT DEFAULT NULL",
		"`sTime` VARCHAR(5) DEFAULT NULL",
		"`eTime` VARCHAR(5) NOT NULL DEFAULT '99:00'",
		"`rType` TINYINT NOT NULL DEFAULT 0",
		"`rInterval` TINYINT NOT NULL DEFAULT 0",
		"`rPeriod` TINYINT NOT NULL DEFAULT 0",
		"`rMonth` TINYINT NOT NULL DEFAULT 0",
		"`rUntil` VARCHAR(10) NOT NULL DEFAULT '9999-00-00'",
		"`aDateTime` VARCHAR(16) NOT NULL DEFAULT '9999-00-00 00:00'",
		"`mDateTime` VARCHAR(16) NOT NULL DEFAULT '9999-00-00 00:00'",
		"`status` BOOLEAN NOT NULL DEFAULT 0"),
	"categories" => array(
		"`ID` INTEGER PRIMARY KEY ".($dbType == 'SQLite' ? 'AUTOINCREMENT' : 'AUTO_INCREMENT'),
		"`name` TEXT NOT NULL DEFAULT ''",
		"`sequence` TINYINT NOT NULL DEFAULT 1",
		"`repeat` TINYINT NOT NULL DEFAULT 0",
		"`noverlap` TINYINT NOT NULL DEFAULT 0",
		"`olErrMsg` TEXT NOT NULL DEFAULT ''",
		"`defSlot` TINYINT NOT NULL DEFAULT 0",
		"`approve` TINYINT NOT NULL DEFAULT 0",
		"`dayColor` TINYINT NOT NULL DEFAULT 0",
		"`color` TEXT DEFAULT NULL",
		"`bgColor` TEXT DEFAULT NULL",
		"`checkBx` TINYINT NOT NULL DEFAULT 0",
		"`checkLb` VARCHAR(16) NOT NULL DEFAULT 'approved'",
		"`checkMk` VARCHAR(16) NOT NULL DEFAULT '&#10003;'",
		"`status` BOOLEAN NOT NULL DEFAULT 0"),
	"users" => array(
		"`ID` INTEGER PRIMARY KEY ".($dbType == 'SQLite' ? 'AUTOINCREMENT' : 'AUTO_INCREMENT'),
		"`name` TEXT NOT NULL DEFAULT ''",
		"`password` TEXT NOT NULL DEFAULT ''",
		"`tPassword` TEXT DEFAULT NULL",
		"`email` TEXT NOT NULL DEFAULT ''",
		"`groupID` MEDIUMINT DEFAULT NULL",
		"`notCIDs` VARCHAR(128) NOT NULL DEFAULT ''",
		"`language` TEXT DEFAULT NULL",
		"`login0` VARCHAR(10) NOT NULL DEFAULT '9999-00-00'",
		"`login1` VARCHAR(10) NOT NULL DEFAULT '9999-00-00'",
		"`loginCnt` MEDIUMINT NOT NULL DEFAULT 0",
		"`status` BOOLEAN NOT NULL DEFAULT 0"),
	"groups" => array(
		"`ID` INTEGER PRIMARY KEY ".($dbType == 'SQLite' ? 'AUTOINCREMENT' : 'AUTO_INCREMENT'),
		"`name` TEXT NOT NULL DEFAULT ''",
		"`privs` TINYINT NOT NULL DEFAULT 0",
		"`catIDs` VARCHAR(128) NOT NULL DEFAULT '0'",
		"`rEvents` TINYINT NOT NULL DEFAULT 1",
		"`mEvents` TINYINT NOT NULL DEFAULT 1",
		"`pEvents` TINYINT NOT NULL DEFAULT 1",
		"`color` TEXT DEFAULT NULL",
		"`status` BOOLEAN NOT NULL DEFAULT 0"),
	"settings" => array(
		"`name` VARCHAR(16) NOT NULL DEFAULT ''",
		"`value` TEXT DEFAULT NULL",
		"`outline` TEXT DEFAULT NULL")
	);

function createDbTable($tableName) { //create database table
	global $tableDefs;

	$stH = dbQuery("DROP TABLE IF EXISTS `{$tableName}`");
	preg_match("~(events|categories|users|groups|settings)~i",$tableName,$match); //MySQL or SQLite db
	$stH = dbQuery("CREATE TABLE IF NOT EXISTS `{$tableName}` (\n".implode(",\n",$tableDefs[$match[1]]).")");
	return $stH;
}

function initCats() { //init categories table
	$stH = stPrep("REPLACE INTO `categories` (`ID`, `name`, `sequence`) VALUES (?,?,?)");
	if ($stH === false) { return false; }
	$result = stExec($stH,array(1,'no cat',1));
	return $result;
}

function initUsers($adName,$adMail,$adPwMd5) { //init users table
	$users = array(array(1,'Public Access','','',3),array(2,$adName,$adMail,$adPwMd5,2)); //public user + admin user
	dbTransaction('begin');
	$stH = stPrep("REPLACE INTO `users` (`ID`, `name`, `email`, `password`, `groupID`) VALUES (?,?,?,?,?)");
	if ($stH === false) { return false; }
	foreach($users as $user) {
		stExec($stH,$user);
	}
	$result = dbTransaction('commit');
	return ($result);
}

function initGroups() { //init groups table
	$groups = array(array(1,'No access',0,'0'),array(2,'Admin',9,'0'),array(3,'Read access',1,'0'),array(4,'Post Own',2,'0'),array(5,'Post All',3,'0'),array(6,'Manager',4,'0'));
	dbTransaction('begin');
	$stH = stPrep("REPLACE INTO `groups` (`ID`,`name`,`privs`,`catIDs`) VALUES (?,?,?,?)");
	if ($stH === false) { return false; }
	foreach($groups as $group) {
		stExec($stH,$group);
	}
	$result = dbTransaction('commit');
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
		$stH = stPrep("DELETE FROM `settings`"); // empty table
	} else {
		$stH = stPrep("DELETE FROM `settings` WHERE `name` NOT LIKE 'calendar%'"); //empty table, except calendar values
	}
	if ($stH === false) { return false; }
	$result = stExec($stH,null);
	if ($result) { //save settings
		$stH = stPrep("REPLACE INTO `settings` VALUES (?,?,?)"); //save
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
	global $dbType;

	//Save LuxCal version and db credentials to lcconfig.php
	if ($dbType == 'SQLite') { //SQLite
		global $lcV, $dbDir, $dbDef, $dbSel;

		$config = '<?php
/*
= LuxCal event calendar configuration =
*/
$lcV="'.$lcV.'"; //LuxCal version
$dbType="SQLite"; //db type (MySQL or SQLite)
$dbDir="'.(isset($dbDir) ? $dbDir : 'db/').'"; //db directory
$dbDef="'.(isset($dbDef) ? $dbDef : '').'"; //default calendar (db name)
$dbSel='.(isset($dbSel) ? $dbSel : 1).'; //selectable in Options panel
?>';
	} else { //MySQL
		global $lcV, $dbHost, $dbUnam, $dbPwrd, $dbName, $dbDef, $dbSel;

		$config = '<?php
/*
= LuxCal event calendar configuration =
*/
$lcV="'.$lcV.'"; //LuxCal version
$dbType="MySQL"; //db type (MySQL or SQLite)
$dbHost="'.$dbHost.'"; //MySQL server
$dbUnam="'.$dbUnam.'"; //database username
$dbPwrd="'.$dbPwrd.'"; //database password
$dbName="'.$dbName.'"; //database name
$dbDef="'.$dbDef.'"; //default calendar (prefix db table name)
$dbSel='.(isset($dbSel) ? $dbSel : 1).'; //selectable in Options panel
?>';
	}
	return file_put_contents('./lcconfig.php',$config);
}

function backupDatabase($tables,$echo) { //Create a backup file of the database tables
	global $ax, $calID, $set, $lcV;
	
	//make file header
	$sqlFile = "--\n";
	$sqlFile .= "-- SQL DUMP ".date('Y.m.d @ H:i')."\n";
	$sqlFile .= "-- Calendar: {$set['calendarTitle']}\n";
	$sqlFile .= "-- Calendar ID: {$calID}\n";
	$sqlFile .= "--\n";
	$sqlFile .= "-- LuxCal version: {$lcV}\n";
	$sqlFile .= "-- http://www.luxsoft.eu\n";
	$sqlFile .= "--\n\n";
	//backup tables
	foreach ($tables as $table) {
		if ($echo) { echo "{$ax['mdb_backup_table']} '{$table}' - "; }
		$sqlFile .= "\n-- ".str_repeat("=", 56)."\n\n--\n-- Table {$table}\n--\n\n";
		$sqlFile .= "DROP TABLE IF EXISTS `{$table}`;\n\n";
		$sqlFile .= getTableSql($table).";\n\n"; //get SQL code to create table
		$stH = dbQuery("SELECT * FROM `{$table}`");
		$counter = 0;
		while($row = $stH->fetch(PDO::FETCH_NUM)) {
			$sqlFile .= "INSERT INTO `{$table}` VALUES (";
			foreach($row as $value) {
				$sqlFile .= isset($value) ? "'".str_replace("'","''",$value)."'," : "'',";
			}
			$sqlFile = substr($sqlFile,0,-1).");\n";
			$counter++;
		}
		$stH = null; //release statement handle!
		$sqlFile .="\n";
		if ($echo) { echo "{$ax['mdb_backup_done']} ({$counter} {$ax['mdb_records']})<br>\n"; }
	}
	return $sqlFile;
}

function importSqlFile(&$sqlArray) { //Import a database backup file
	global $dbType;

	//init
	$query = '';
	$matches = array();
	$busy = false;
	$curTab = '';
	$count = array('cat' => 0, 'eve' => 0, 'use' => 0, 'gro' => 0, 'set' => 0); //init table counters
	//preprocess SQL queries
	$patTable = '~\s+["`]?(?:[a-z0-9]{1,20})?_?(events|categories|users|groups|settings)["`]?(\s*[(;V])~'; //strip calID_ and replace " by ` around table names
	$repTable = ' `$1`$2';
	$patLine = array('~\\\\+["\']~'); //modify escaped quotes
	$repLine = array("''");
	if ($dbType == 'SQLite') { //SQLite - solve MySQL incompatibilities
		$patLine[] = '~\).*ENGINE.*;~';
		$repLine[] = ');';
		$patLine[] = '~\sunsigned~';
		$repLine[] = '';
		$patLine[] = '~\sAUTO_?INCREMENT~';
		$repLine[] = '';
		$patLine[] = '~\s?COLLATE\s[\w]+~';
		$repLine[] = '';
		$patLine[] = '~\sclass=[^\s>]+~';
		$repLine[] = '';
	} else { //MySQL - solve SQLite incompatibilities
		$patLine[] = '~\sAUTOINCREMENT~';
		$repLine[] = ' AUTO_INCREMENT';
	}
	//restore
	dbTransaction('begin');
	foreach ($sqlArray as $qLine) {
		$qLine = trim($qLine);
		$qLine6 = substr($qLine,0,6);
		if ($qLine6 != 'INSERT' and $qLine6 != 'CREATE' and !$busy) { continue; } //skip line
		if (!$busy) { //begin INSERT or CREATE
			$busy = true;
			$qLine = preg_replace($patTable,$repTable,$qLine,1); //1 replacement
			preg_match('~`(events|categories|users|groups|settings)`~',$qLine,$matches); //find table name
			if ($qLine6 == 'CREATE') { //begin CREATE
				$stH = dbQuery("DROP TABLE IF EXISTS `{$matches[1]}`;\n"); //drop table before creating
			} else { //begin INSERT
				$curTab = substr($matches[1],0,3); //current table
				$qLine = str_replace('"','`',strstr($qLine,'VALUES',true)).strstr($qLine,'VALUES'); //replace "' by ` around possible column names
				if (substr($qLine,-1) == ';') { $count[$curTab]++; }
			}
		}
		if ($qLine6 != 'INSERT' and $curTab) { $count[$curTab]++; } //increment INSERT counter
		$qLine = preg_replace($patLine,$repLine,$qLine); //do it
		$query .= $qLine."\n";
		if (substr($qLine,-1) == ';') { //execute sql query
			$stH = dbQuery($query);
			$busy = false;
			$query = $curTab = '';
		}
	}
	dbTransaction('commit');
	return $count;
}

//
//Upgrade the current ($calID) database from 2.7.2+ to the latest version
//
function upgradeDb() { //upgrade $calID database from 2.7.2+
	/* === tables pre-processing === */
	//if users.sedit: set privs to 9 for admin accounts (sedit == 1)
	$stH = dbQuery("SELECT `sedit` FROM `users` LIMIT 1",0);
	if ($stH) { //column 'sedit' present (V2.7.2)
		$stH = null;
		dbQuery("UPDATE `users` SET `privs` = 9 WHERE `sedit` = 1");
	}
	//if users.privs: table groups not existing - create and populate
	$stH = dbQuery("SELECT `privs` FROM `users` LIMIT 1",0);
	if ($stH !== false) { //column 'privs' present
		$stH = null;
		createDbTable("groups");
		initGroups();
	}

	//create tables with new schema
	createDbTable("usersNew");
	createDbTable("groupsNew");
	createDbTable("categoriesNew");
	createDbTable("eventsNew");
	createDbTable("settingsNew");

	/* === tables version-processing === */
	dbTransaction('begin');
	do {
		//test if version < 3.1
		$stH = dbQuery("SELECT `approve` FROM `categories` LIMIT 1",0);
		if (!$stH) { //column 'approve' not present - version 2.7
			$lcVUpg = '2.7';
			dbQuery("INSERT INTO `eventsNew` (`ID`, `private`, `title`, `venue`, `text1`, `catID`, `userID`, `editor`, `checked`, `notify`, `notMail`, `sDate`, `eDate`, `xDates`, `sTime`, `eTime`, `rType`, `rInterval`, `rPeriod`, `rMonth`, `rUntil`, `aDateTime`, `mDateTime`, `status`) 
				SELECT `event_id`, `private`, `title`, `venue`, `description`, `category_id`, `user_id`, `editor`, `checked`, `notify`, `not_mail`, `s_date`, `e_date`, `x_dates`, `s_time`, `e_time`, `r_type`, `r_interval`, `r_period`, `r_month`, `r_until`, `a_date`, `m_date`, `status` FROM `events`"); //copy content events table
			dbQuery("INSERT INTO `usersNew` (`ID`, `name`, `password`, `tPassword`, `email`, `groupID`, `language`, `login0`, `login1`, `loginCnt`, `status`) 
				SELECT `user_id`, `user_name`, `password`, `temp_password`, `email`, `privs`, `language`, `login_0`, `login_1`, `login_cnt`, `status` FROM `users`"); //copy content users table
			dbQuery("INSERT INTO `groupsNew` SELECT * FROM `groups`"); //new table, no change
			dbQuery("INSERT INTO `categoriesNew` (`ID`, `name`, `sequence`, `repeat`, `color`, `bgColor`, `checkBx`, `checkLb`, `checkMk`, `status`) 
				SELECT `category_id`, `name`, `sequence`, `rpeat`, `color`, `background`, `check2`, `label2`, `mark2`, `status` FROM `categories`"); //copy content categories table
			dbQuery("INSERT INTO `settingsNew` (`name`, `value`, `outline`) 
				SELECT `name`, `value`, `description` FROM `settings`"); //copy content settings table
				break; //done
		}
		//test if version = 3.1
		$stH = dbQuery("SELECT `a_date` FROM `events` LIMIT 1",0);
		if ($stH !== false) { //column 'a_date' present - version 3.1
			$lcVUpg = '3.1';
			dbQuery("INSERT INTO `eventsNew` (`ID`, `private`, `title`, `venue`, `text1`, `catID`, `userID`, `editor`, `approved`, `checked`, `notify`, `notMail`, `sDate`, `eDate`, `xDates`, `sTime`, `eTime`, `rType`, `rInterval`, `rPeriod`, `rMonth`, `rUntil`, `aDateTime`, `mDateTime`, `status`) 
				SELECT `event_id`, `private`, `title`, `venue`, `description`, `category_id`, `user_id`, `editor`, `approved`, `checked`, `notify`, `not_mail`, `s_date`, `e_date`, `x_dates`, `s_time`, `e_time`, `r_type`, `r_interval`, `r_period`, `r_month`, `r_until`, `a_date`, `m_date`, `status` FROM `events`"); //copy content events table
			dbQuery("INSERT INTO `usersNew` (`ID`, `name`, `password`, `tPassword`, `email`, `groupID`, `language`, `login0`, `login1`, `loginCnt`, `status`) 
				SELECT `user_id`, `user_name`, `password`, `temp_password`, `email`, `privs`, `language`, `login_0`, `login_1`, `login_cnt`, `status` FROM `users`"); //copy content users table
			dbQuery("INSERT INTO `groupsNew` SELECT * FROM `groups`"); //new table, no change
			dbQuery("INSERT INTO `categoriesNew` (`ID`, `name`, `sequence`, `repeat`, `approve`, `color`, `bgColor`, `checkBx`, `checkLb`, `checkMk`, `status`) 
				SELECT `category_id`, `name`, `sequence`, `rpeat`, `approve`, `color`, `background`, `chbox`, `chlabel`, `chmark`, `status` FROM `categories`"); //copy content categories table
			dbQuery("INSERT INTO `settingsNew` (`name`, `value`, `outline`) 
				SELECT `name`, `value`, `description` FROM `settings`"); //copy content settings table
			break; //done
		}
		//test if version = 3.2
		$stH = dbQuery("SELECT `ID` FROM `events` LIMIT 1",0);
		if (!$stH) { //column 'ID' not present - version 3.2
			$lcVUpg = '3.2';
			dbQuery("INSERT INTO `eventsNew` (`ID`, `private`, `title`, `venue`, `text1`, `text2`, `text3`, `catID`, `userID`, `editor`, `approved`, `checked`, `notify`, `notMail`, `sDate`, `eDate`, `xDates`, `sTime`, `eTime`, `rType`, `rInterval`, `rPeriod`, `rMonth`, `rUntil`, `aDateTime`, `mDateTime`, `status`) 
				SELECT `event_id`, `private`, `title`, `venue`, `description`, `xfield1`, `xfield2`, `category_id`, `user_id`, `editor`, `approved`, `checked`, `notify`, `not_mail`, `s_date`, `e_date`, `x_dates`, `s_time`, `e_time`, `r_type`, `r_interval`, `r_period`, `r_month`, `r_until`, `a_datetime`, `m_datetime`, `status` FROM `events`"); //copy content events table
			dbQuery("INSERT INTO `usersNew` (`ID`, `name`, `password`, `tPassword`, `email`, `groupID`, `language`, `login0`, `login1`, `loginCnt`, `status`) 
				SELECT `user_id`, `user_name`, `password`, `temp_password`, `email`, `privs`, `language`, `login_0`, `login_1`, `login_cnt`, `status` FROM `users`"); //copy content users table
			dbQuery("INSERT INTO `groupsNew` SELECT * FROM `groups`"); //new table, no change
			dbQuery("INSERT INTO `categoriesNew` (`ID`, `name`, `sequence`, `repeat`, `approve`, `color`, `bgColor`, `checkBx`, `checkLb`, `checkMk`, `status`) 
				SELECT `category_id`, `name`, `sequence`, `rpeat`, `approve`, `color`, `background`, `chbox`, `chlabel`, `chmark`, `status` FROM `categories`"); //copy content categories table
			dbQuery("INSERT INTO `settingsNew` (`name`, `value`, `outline`) 
				SELECT `name`, `value`, `description` FROM `settings`"); //copy content settings table
			break; //done
		}
		//test if version = 4.1
		$stH = dbQuery("SELECT `dayColor` FROM `categories` LIMIT 1",0);
		if (!$stH) { //column 'dayColor' not present - version 4.1
			$lcVUpg = '4.1';
			dbQuery("INSERT INTO `eventsNew` (`ID`, `private`, `title`, `venue`, `text1`, `text2`, `text3`, `catID`, `userID`, `editor`, `approved`, `checked`, `notify`, `notMail`, `sDate`, `eDate`, `xDates`, `sTime`, `eTime`, `rType`, `rInterval`, `rPeriod`, `rMonth`, `rUntil`, `aDateTime`, `mDateTime`, `status`) 
				SELECT `ID`, `private`, `title`, `venue`, `text1`, `text2`, `text3`, `catID`, `userID`, `editor`, `approved`, `checked`, `notify`, `notMail`, `sDate`, `eDate`, `xDates`, `sTime`, `eTime`, `rType`, `rInterval`, `rPeriod`, `rMonth`, `rUntil`, `aDateTime`, `mDateTime`, `status` FROM `events`"); //copy content events table
			dbQuery("INSERT INTO `usersNew` (`ID`, `name`, `password`, `tPassword`, `email`, `groupID`, `language`, `login0`, `login1`, `loginCnt`, `status`) 
				SELECT `ID`, `name`, `password`, `tPassword`, `email`, `groupID`, `language`, `login0`, `login1`, `loginCnt`, `status` FROM `users`"); //copy content users table
			dbQuery("INSERT INTO `groupsNew` (`ID`, `name`, `privs`, `catIDs`, `color`, `status`) 
				SELECT `ID`, `name`, `privs`, `catIDs`, `color`, `status` FROM `groups`"); //copy content groups table
			dbQuery("INSERT INTO `categoriesNew` (`ID`, `name`, `sequence`, `repeat`, `approve`, `color`, `bgColor`, `checkBx`, `checkLb`, `checkMk`, `status`) 
				SELECT `ID`, `name`, `sequence`, `repeat`, `approve`, `color`, `bgColor`, `checkBx`, `checkLb`, `checkMk`, `status` FROM `categories`"); //copy content categories table
			dbQuery("INSERT INTO `settingsNew` SELECT * FROM `settings`"); //copy content settings table
			break; //done
		}
		//test if version = 4.2
		$stH = dbQuery("SELECT `noverlap` FROM `categories` LIMIT 1",0);
		if (!$stH) { //column 'overlay' not present - version 4.2
			$lcVUpg = '4.2';
			dbQuery("INSERT INTO `eventsNew` SELECT * FROM `events`"); //copy content events table
			dbQuery("INSERT INTO `usersNew` SELECT * FROM `users`"); //copy content users table
			dbQuery("INSERT INTO `groupsNew` (`ID`, `name`, `privs`, `catIDs`, `color`, `status`) 
				SELECT `ID`, `name`, `privs`, `catIDs`, `color`, `status` FROM `groups`"); //copy content groups table
			dbQuery("INSERT INTO `categoriesNew` (`ID`, `name`, `sequence`, `repeat`, `approve`, `dayColor`, `color`, `bgColor`, `checkBx`, `checkLb`, `checkMk`, `status`) 
				SELECT `ID`, `name`, `sequence`, `repeat`, `approve`, `dayColor`, `color`, `bgColor`, `checkBx`, `checkLb`, `checkMk`, `status` FROM `categories`"); //copy content categories table
			dbQuery("INSERT INTO `settingsNew` SELECT * FROM `settings`"); //copy content settings table
			break; //done
		}
		//version = current version (no changes)
		$lcVUpg = '4.3';
		dbQuery("INSERT INTO `eventsNew` SELECT * FROM `events`");
		dbQuery("INSERT INTO `usersNew` SELECT * FROM `users`");
		dbQuery("INSERT INTO `groupsNew` SELECT * FROM `groups`");
		dbQuery("INSERT INTO `categoriesNew` SELECT * FROM `categories`");
		dbQuery("INSERT INTO `settingsNew` SELECT * FROM `settings`");
	} while (0); //end of: process calendar $calID

	/* === tables post-processing === */
	$stH = dbQuery("SELECT `privs` FROM `users` LIMIT 1",0);
	if ($stH !== false) { //privs found, table groups is new
		$stH = null;
		//convert users.groupID (old privs) to new groupID
		$groups = array(0 => 1, 9 => 2, 1 => 3, 2 => 4, 3 => 5, 4 => 6);
		$stH = dbQuery("SELECT `ID`, `groupID` FROM `usersNew`"); //get groupID (old privs)
		while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
			dbQuery("UPDATE `usersNew` SET `groupID` = {$groups[$row['groupID']]} WHERE `ID` = {$row['ID']}");
		}
	}
	//groups.ID and users.groupID: renumber ID starting from 1
	$stH = dbQuery("SELECT * FROM `groupsNew` WHERE `ID` = 0");
	if ($row = $stH->fetch(PDO::FETCH_NUM)) { //column 'ID' = 0 exists - renumber
		$stH = dbQuery("SELECT `ID` FROM `groupsNew` ORDER BY `ID` DESC"); 
		while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
			dbQuery("UPDATE `groupsNew` SET `ID` = `ID` + 1 WHERE `ID` = {$row['ID']}"); //must be done in reverse order
		}
		dbQuery("UPDATE `usersNew` SET `groupID` = `groupID` + 1");
	}
	//correct groupIDs admin (3 -> 2) and read-access (2 -> 3)
	$stH = dbQuery("SELECT `ID`, `groupID` FROM `usersNew` WHERE `ID` = 2 and `groupID` = 3",0); //admin in group 3
	if ($row = $stH->fetch(PDO::FETCH_NUM)) {
		dbQuery("UPDATE `groupsNew` SET `ID` = 100 WHERE `ID` = 2"); //park read-only
		dbQuery("UPDATE `usersNew` SET `groupID` = 100 WHERE `groupID` = 2"); //idem
		dbQuery("UPDATE `groupsNew` SET `ID` = 2 WHERE `ID` = 3"); //set admin to 2
		dbQuery("UPDATE `usersNew` SET `groupID` = 2 WHERE `groupID` = 3"); //idem
		dbQuery("UPDATE `groupsNew` SET `ID` = 3 WHERE `ID` = 100"); //set parked to 3
		dbQuery("UPDATE `usersNew` SET `groupID` = 3 WHERE `groupID` = 100"); //idem
	}

	//events.checked: ;dd-mm-yyyya -> ;dd-mm-yyyy and drop ;dd-mm-yyyyb
	$stH = dbQuery("SELECT `ID`,`checked` FROM `eventsNew` WHERE `checked` LIKE '%a%'");
	while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
		$chBoxed = preg_replace(array('~;\d\d\d\d-\d\d-\d\db~','~(;\d\d\d\d-\d\d-\d\d)a~'),array('','$1'),$row['checked']); //drop ;dd-mm-yyyyb and trim a in ;dd-mm-yyyya
		dbQuery("UPDATE `eventsNew` SET `checked`='{$chBoxed}' WHERE `ID` = {$row['ID']}");
	}
	//events.sTime/eTime: truncate time to 00:00
	$stH = dbQuery("SELECT `sTime` FROM `eventsNew` LIMIT 1");
	if ($row = $stH->fetch(PDO::FETCH_NUM)) { //column 'sTime' exists
		if (strlen($row[0]) > 5) { //truncate times
			dbQuery("UPDATE `eventsNew` SET `sTime` = substr(`sTime`,1,5),`eTime` = substr(`eTime`,1,5)");
		}
	}
	//events.aDateTime/mDateTime: truncate time to 00:00
	$stH = dbQuery("SELECT `aDateTime` FROM `eventsNew` LIMIT 1");
	if ($row = $stH->fetch(PDO::FETCH_NUM)) { //column 'aDateTime' exists
		if (strlen($row[0]) > 16) { //truncate time
			dbQuery("UPDATE `eventsNew` SET `aDateTime` = substr(`aDateTime`,1,16),`mDateTime` = substr(`mDateTime`,1,16)");
		}
		if (strlen($row[0]) < 16) { //pad to yyyy-mm-dd 00:00
			dbQuery("UPDATE `eventsNew` SET `aDateTime` = substr(`aDateTime`,1,10)||' 00:00',`mDateTime` = substr(`mDateTime`,1,10)||' 00:00'");
		}
	}

	$stH = null; //release statement handle

	//drop original tables and rename new upgraded tables
	dbQuery("DROP TABLE `users`");
	dbQuery("ALTER TABLE `usersNew` RENAME TO `users`");
	dbQuery("DROP TABLE `groups`");
	dbQuery("ALTER TABLE `groupsNew` RENAME TO `groups`");
	dbQuery("DROP TABLE `categories`");
	dbQuery("ALTER TABLE `categoriesNew` RENAME TO `categories`");
	dbQuery("DROP TABLE `events`");
	dbQuery("ALTER TABLE `eventsNew` RENAME TO `events`");
	dbQuery("DROP TABLE `settings`");
	dbQuery("ALTER TABLE `settingsNew` RENAME TO `settings`");
	dbTransaction('commit');
	return $lcVUpg;
}
?>