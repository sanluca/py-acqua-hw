<?php
/*
= LuxCal Calendar Administrator Tools =

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

*/

//heredocs
$actT = <<<TXT
<p>These tools will help you to . . .
<ul>
<li>Test if your LuxCal calendar environment is configured correctly</li>
<li>Add one or more new calendars</li>
<li>Set one of the calendars as the default calendar</li>
<li>Delete one or more existing calendars</li>
<li>Replicate data from one or more database tables in a backup file to one or 
more existing calendars</li>
<li>Back up calendar data to a .sql file for one or more calendars</li>
<li>Download a .sql backup file form the calendar's <kbd>files</kbd> folder</li>
<li>Import a calendar backup file of a previous LuxCal version</li>
</ul>
TXT;

$act0T = <<<TXT
<h5>Test configuration</h5>
<p>This action can be used to run a number of tests to see if your LuxCal 
calendar environment is configured correctly for the calendar to run properly. 
</p>
<p>The following tests can be executed:</p>
<ul>
<li>PHP version: to test if the correct PHP version is used</li>
<li>PHP database extension: to test if the PHP Data Object extension is enabled 
for your database </li>
<li>File permissions: to see if the calendar has the required write access to 
certain folders, like the <kbd>root</kbd> folder, the <kbd>files</kbd>, etc.
</li>
<li>PHP sessions: to test if PHP sessions are enabled in the PHP installation 
and are working correctly</li>
<li>Browser cookies: to check if cookies are enabled in your browser and are 
working correctly</li>
</ul>
TXT;

$act1T = <<<TXT
<h5>Create new calendars</h5>
<p>This action will add one or more new calendars to the database folder. This 
may be useful if you want to run several independent calendars with one LuxCal 
installation.</p>
<br>
<p><b>Calendar ID(s) / Title(s)</b></p>
To add new calendars, specify for each calendar an ID - title pair in the format 
'calendar ID = calendar Title', e.g. home = My Home Calendar. 
Each ID = title pair must be specified on a separate line.</p>
<p>A calendar ID is a text string of max. 20 lower-case alphanumeric characters 
and the title is a normal text string of maximum 100 characters. For each ID = 
title pair a calendar database will be created, with file name &lt;ID&gt;.cdb.
</p>
<p>After the calendars are created, the calendar ID can be used to select a 
specific calendar. For instance to select the calendar with ID 'home' the 
following URL should be used: http://www.mysite.xxx/calendar/<b>?cal=home</b>.
</p>
<br>
<p><b>Calendar email address (optional)</b></p>
<p>The calendar email address is used in email reports, reminders, etc. If no 
email address is specified, the administrator email address will be taken 
instead.</p>
<br>
<p><b>Administrator name</b>, <b>email</b> and <b>password</b></p>
<p>These fields must be completed and <b>should be remembered</b>. They will be 
required later to log in to the new calendars.</p>
TXT;

$act2T = <<<TXT
<h5>Set default calendar</h5>
<p>This action will set one of the existing calendars as the default calendar.
</p>
<p>When multiple calendars are installed, a specific calendar can be launched by 
adding "?cal=calID" to the URL, where calID is the name of the database file 
(without extension) of the calendar to be launched. When this string is not 
added to the URL, the default calendar will be launched.
</p>
<p>The ID of the default calendar will be saved in the lcconfig.php file.</p>
<br>
<p><b>Select calendar(s)</b></p>
<p>Select the calendar that should become the default.</p>
TXT;

$act3T = <<<TXT
<h5>Delete calendars</h5>
<p>This action will delete one or more calendars (read: calendar databases).</p>
<p>Deleted calendar databases are not lost. Deleting is done by changing the 
database file name extension of the selected calendars from '.cdb' to '.bak'.
</p>
<p>Deleted calendars will not be visible any more to the calendar software. If 
needed, a deleted calendar can be restored by changing the related database file 
name extension back to '.cdb'.</p>
<br>
<p><b>Select calendar(s)</b></p>
<p>Select the calendars that should be deleted.</p>
TXT;

$act4T = <<<TXT
<h5>Replicate data and / or settings from file</h5>
<p>This function will replicate the contents of one or more tables of the 
selected source backup file to the selected calendars.</p>
<p>The source backup file can be created via this tool or in the source calendar 
via the admin's Database page. The backup file is created in the 
<kbd>files</kbd> folder and can be downloaded via this tool.
</p>
<p class='hilite'>IMPORTANT NOTE: When copying events, categories, users or user 
groups, extreme care must be taken that the event category IDs, the user IDs and 
the user group IDs of existing and replicated events match with the final event 
category IDs, user group IDs and user IDs in the destination calendar.</p>
<br>
<p><b>Select source .sql file</b></p>
<p>Select the source .sql backup file with the data to be replicated from your 
local computer.</p>
<br>
<p><b>Select table(s) to copy</b></p>
<p>Specify from which database tables in the backup file data should be copied.
</p>
<br>
<p><b>Select destination calendar(s)</b></p>
<p>Select the destination calendar(s) from the list of installed calendars.</p>
<br>
<p><span class='hilite'>You MUST read the following:</span></p>
<ul>
<li><b>Events table:</b> The events from the backup file will be added to the 
events table, so existing events will NOT be deleted in the destination tables.
</li>
<li><b>Categories table:</b> The data from the category table in the backup file 
will be copied to the categories table of the destination calendar(s).<br> 
<b>Existing categories in the destination calendars will be lost!</b></li>
<li><b>Users table:</b> The data from the users table in the backup file will be 
copied to the users table of the destination calendar(s).<br> 
<b>Existing user accounts in the destination calendars will be lost!</b></li>
<li><b>Groups table:</b> The data from the user groups table in the backup file 
will be copied to the user groups table of the destination calendar(s).<br> 
<b>Existing user groups in the destination calendars will be lost!</b></li>
<li><b>Settings table:</b> The data from the settings table in the backup file 
will be copied to the settings table of the destination calendar(s).<br> 
<b>The settings in the destination calendar will be overwritten by the source 
settings,</b> except for the calendar title, URL and email address; they are 
calendar specific and will remain unchanged.</li>
</ul>
TXT;

$act5T = <<<TXT
<h5>Back up calendars</h5>
<p>This action will back up the structure and contents of the database tables of 
one or more calendars to a .sql backup file.</p>
<p>Per selected calendar a backup file will be created in the <kbd>files</kbd> 
folder on the server, with the following file name:</p>
<p><b>calID-backup-yyyymmdd-hhmm.sql</b></p>
<p>Where calID is the file name of the calendar database (without extension), 
yyyymmdd is the current date and hhmm is the current time.</p>
<p>The backup files are in .sql format and . . .</p>
<ul>
<li>can be imported into a LuxCal calendar with the same version number, via the 
admin's Database page of the destination calendar.</li>
<li>can be imported directly into an SQL database tool on your server (e.g. 
phpLiteAdmin or phpMyAdmin) to completely re-create the calendar tables and 
their contents</li>
<li>can be used by the 'Replicate data and / or settings from file' option of 
this tool to restore or copy the contents of the tables to the same or one or 
more other calendars. For details select this option on the main menu</li>
</ul>
<br>
<p><b>Select calendar(s)</b></p>
Select the calendars to back up.
TXT;

$act6T = <<<TXT
<h5>Download backup file from <kbd>files</kbd> folder</h5>
<p>This function offers the possibility to download backup files with a '.sql' 
extension from the 'files' folder on the server.</p>
<p>These files can for instance be used by the 'replicate' function to copy the 
contents of one or more tables from these downloaded backup files to one or more 
other calendars. In this case ensure that the backup file was produced by a 
calendar with the same version as the target calendar(s).</p>
<br>
<p><b>Select backup file</b></p>
<p>Select the backup file to be downloaded from the <kbd>files</kbd> folder.</p>
TXT;

$act7T = <<<TXT
<h5>Import calendar backup file of a previous LuxCal version</h5>
<p>This action will import the contents of the MySQL or SQLite database tables 
of a calendar backup file of LuxCal version 2.7.2 or greater into the selected 
calendar.</p>
<p>After importing the contents of all tables, the database table schema will 
automatically be upgraded without loss of data.</p>
<p><span class='hilite'>For each table in the destination calendar, the existing 
records will be deleted before importing the new records from the backup file.
</span></p>
<br>
<p><b>Select source backup file</b></p>
<p>Select the LuxCal source backup file with the data to be imported from your 
local computer.</p>
<br>
<p><b>Select destination calendar</b></p>
<p>Select the destination calendar from the list of available calendars.</p>
TXT;

date_default_timezone_set(@date_default_timezone_get()); //set time zone

//sanity check
if (version_compare(PHP_VERSION, '5.2.3') < 0) { //check PHP version
	exit('<br><br><b>Wrong PHP version</b><br><br>You need version 5.2.3 or higher<br>Your current version is: '.PHP_VERSION);
}
foreach ($_REQUEST as $key => $value) { if (is_string($value)) $_REQUEST[$key] = htmlspecialchars(strip_tags(trim($value)),ENT_QUOTES,'UTF-8'); }

//set error reporting
error_reporting(E_ALL); //errors and notices
ini_set('display_errors',1);
ini_set('log_errors',1);

//if present, get config data
if (file_exists('./lcconfig.php')) { include './lcconfig.php'; }
if (empty($dbDir)) { $dbDir = 'db/'; }
if (empty($dbType)) { $dbType = 'MySQL'; }

require './common/toolbox.php';
require './common/toolboxd.php'; //database tools
require './common/toolboxx.php';

//initialize
$calID = '';
$calTitDefault = 'My Web Calendar';
$calUrlDefault = 'http://'.$_SERVER['SERVER_NAME'].rtrim(dirname($_SERVER['PHP_SELF']),'/').'/';
$calEmlDefault = 'admin@calendar.xxx';

//init menu selections
$allTabs = array('1'=>'events', '2'=>'categories', '3'=>'users', '4'=>'groups', '5'=>'settings');
$back = !empty($_POST['back']) ? true : false; //back
$action = (!empty($_POST['action']) and !$back) ? $_POST['action'] : ''; //selected action
$start = !empty($_POST['start']) ? true : false; //start action
$selTsts = !empty($_POST['tst']) ? $_POST['tst'] : array(); //array with selected tests
$selCals = !empty($_POST['cal']) ? $_POST['cal'] : array(); //array with selected calendars
$selTabs = !empty($_POST['tab']) ? $_POST['tab'] : array(); //array with selected tables
$bupFile = !empty($_POST['buFile']) ? $_POST['buFile'] : ''; //selected backup file
$newCals = !empty($_POST['calDef']) ? $_POST['calDef'] : ''; //cal ID = title pairs
$defCal = !empty($_POST['defCal']) ? $_POST['defCal'] : ''; //default calendar
$selCal = !empty($_POST['selCal']) ? $_POST['selCal'] : ''; //selected calendar
$calEml = !empty($_POST['calEml']) ? $_POST['calEml'] : ''; //cal email
$adName = !empty($_POST['adName']) ? $_POST['adName'] : ''; //admin name
$adMail = !empty($_POST['adMail']) ? $_POST['adMail'] : ''; //admin email
$adPwrd = !empty($_POST['adPwrd']) ? $_POST['adPwrd'] : ''; //admin password

//start PHP session (needed to be able to unset session variables later)
session_start();

//for session test
if (!$start) { //save session variables
	$_SESSION['lcSess1'] = 42; //create var 1
	$_SESSION['lcSess2'] = 'hitch-hiker'; //create var 2
} else { //get session values
	$lcSess1 = (isset($_SESSION['lcSess1'])) ? $_SESSION['lcSess1'] : '';
	$lcSess2 = (isset($_SESSION['lcSess2'])) ? $_SESSION['lcSess2'] : '';
}

//for cookie test
if (!$start) { //bake cookie
	setcookie('lcTest', serialize(array(43, 'galaxy')), time()+86400); //expire in 1 day
} else {
	//get cookie values and bake new cookie
	list($lcCook1,$lcCook2) = @unserialize(str_replace('\\','',($_COOKIE['lcTest']))); 
	setcookie('lcTest', serialize(array(43, 'galaxy')), time()+86400); //update time to 1 day
}

//get installed calendars
$calIDs = getCals(); //get calendar ID/title pairs

//check/set default calendar
if (reset($calIDs)) { //calendar(s) present
	if (empty($dbDef) or !isset($calIDs[$dbDef])) { $dbDef = key($calIDs); } //if no default, make first calendar default
} else {
	$dbDef = ''; //no calendar: no default
}
if (empty($defCal) and !empty($dbDef)) { $defCal = $dbDef; }

//create current calendar list
$curCalList = '';
foreach($calIDs as $ID => $title) {
	$curCalList .= "<br>&nbsp;&nbsp;{$ID} = {$title}".($ID == $defCal ? " <span class='mark'>(default)</span>" : '');
}
if (!empty($curCalList)) {$curCalList = substr($curCalList,4); } //remove first <br>

//connect to db and get admin credentials
if (!empty($dbDef)) {
	if ($dbH = dbConnect($dbDef,0)) { //connect to default db
		if ($stH = stPrep("SELECT name, email, password FROM `users` WHERE ID = ?",0)) {
			stExec($stH,array(2)); //get admin user data
			$row = $stH->fetch(PDO::FETCH_ASSOC);
			$stH = null; //release statement handle!
			if (!empty($row)) { //found
				if (!$adName) { $adName = $row['name']; }
				if (!$adMail) { $adMail = $row['email']; }
				$adPwMd5 = $row['password'];
				if ($adPwMd5 and !$adPwrd) { $adPwrd = '********'; }
			}
		}
		$dbH = null; //close db
	}
}

//get version info
$phpVersion = 'PHP: '.PHP_VERSION;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LuxCal Admin Tools</title>
<meta name="description" content="LuxCal web calendar - a LuxSoft product">
<meta name="keywords" content="LuxSoft, LuxCal, LuxCal web calendar">
<meta name="author" content="Roel Buining">
<meta name="robots" content="nofollow">
<link rel="icon" href="lcal.ico"/>
<style type="text/css">
* { padding:0; margin:0; }
body {font:11px arial, sans-serif; background:#E0E0E0; color:#2B3856; cursor:default;}
a, input, label, select {cursor:pointer;}
a {text-decoration:none;}
h3 {margin:8px 0; font-size:14pt;}
h4 {margin:6px 0; font-size:12pt;}
h5 {margin:2px 0; font-size:11pt;}
input, textarea, select {font:11px arial, sans-serif;}
input[type='text'], textarea {cursor:text;}
input[type="text"] { width:240px; }
input[type="radio"], input[type="checkbox"], label {margin:2px; vertical-align: middle;}
input[type="submit"], input[type="button"] {margin:0 15px;}
input[disabled] {cursor:default;}
textarea {width:100%; height:120px;}
ul, ol {margin:0 20px;}
li {margin:5px 0;}
.title {font:bold 16px arial, sans-serif;}
.aside {width:45%; border:1px solid #808080; background:#FFFFFF; margin-top:30px; padding:15px; float:right; text-align:justify;}
.centerBox {display:table; margin:auto;}
.form {width:360px; border:1px solid #808080; background:#FFFFFF; padding:5px 15px;}
.resultBox {width:380px; border:1px solid #808080; background:#FFFFFF; padding:5px; text-align:justify;}
.bLine {position:absolute; left:0; bottom:50px; width:98%; text-align:center;}
.hilite {margin:10px 0; background:#F0A070;}
.mark {color:#AA0000;}
.greyout {color:#808080; cursor:default;}
.center {text-align:center;}
.flag {color:#FF3300;}
header {margin:6px 0; padding:0 1%; font-size:12pt; font-weight:bold;}
div.navBar {
	position:absolute; top:34px; left:0; right:0;
	padding:0 1%;
	background:#AAAAFF;
	text-align:center;
	border:1px #808080;
	border-style:solid none;
	line-height:20px;
	vertical-align:middle;
}
div.content {
	position:absolute; left:0; top:110px; right:0px; bottom:100px;
	padding:0 20px;
	overflow:auto;
}
div.endBar {
	position:absolute; left:0; right:0; bottom:10px;
	padding:0 1%;
	background:#AAAAFF;
	text-align:right;
	border:1px #808080;
	border-style:solid none;
	font-size:0.8em;
}
.floatL {float:left;}
.floatR {float:right;}
.footLB {font:italic bold 1.1em arial,sans-serif; }
.footLR {font:italic bold 1.1em arial,sans-serif; color:#AA0066;}
</style>
<script>
function $I(el) { return document.getElementById(el); }
function $C(el) { return document.getElementsByClassName(el); }
function $N(el) { return document.getElementsByName(el); }

function checkA(boxName) { //check "all" of N checkboxes
	var chBox0 = $I(boxName+'0');
	var chBoxes = $N(boxName+'[]');
	check0 = chBox0.checked ? true : false;
	for (var i=(chBoxes.length-1);i >= 0;i--) {
		if (chBoxes[i].disabled == false) {
			chBoxes[i].checked = check0;
		}
	}
}

function check1(boxName,checked) { //check 1 of N checkboxes
	var chBoxes = $N(boxName);
	for (var i=(chBoxes.length-1);i >= 0;i--) {
		chBoxes[i].checked = false;
	}
	checked.checked = true;
}

function checkN(boxName) { //check any of N checkboxes
	var chBoxes = $N(boxName+'[]');
	var check0 = true;
	for (var i=(chBoxes.length-1);i >= 0;i--) {
		if (!chBoxes[i].checked) { check0 = false; }
	}
	$I(boxName+'0').checked = check0;
}

function submit() {
	$I('form').submit();
}

function valForm() {
	var ok = true;
	if ($I('action').value == 'replicate') {
		ok = confirm("When replicating data, you must read\nthe IMPORTANT NOTE at the right.\n\nTHIS ACTION IS IRREVERSIBLE!\n\n\t\tPlease confirm");
	} else if ($I('action').value == 'import') {
		ok = confirm("When importing data, existing records will\nbe deleted before importing new records.\n\nTHIS ACTION IS IRREVERSIBLE!\n\n\t\tPlease confirm");
	}
	return ok;
}
</script>
</head>

<body>
<?php
echo "<header><span class='floatL'>LuxCal Event Calendar</span><span class='floatR'>Version: {$lcV}</span></header>";
echo "<div class='navBar'><span class='floatL'>Server date/time: ".date('Y-m-d H:i')."</span><span class='floatR'>{$phpVersion}</span><span class='title'>LuxCal Calendar Administrator Tools</span></div>";
echo "<div class='content'>";
if ($start) { //validate menu selections
	$errMsg = $resMsg = array();
	if ($action == 'test') {
		if (empty($selTsts)) { $errMsg[] = 'No tests selected'; }
	}
	if ($action == 'create') {
		$regEx = "~^([a-z0-9]{1,20}\s*=\s*[^<>?%$@{}\\^=]{1,100}[\r\n]+)+$~";
		if (!preg_match($regEx,$newCals."\n")) { $errMsg[] = "No or invalid calendar ID = title pair(s)"; }
		if (empty($adName)) { $errMsg[] = 'No admin name'; }
		if (!empty($calEml) and !preg_match($rxEmailX,$calEml)) { $errMsg[] = 'Invalid calendar email address'; }
		if (!preg_match($rxEmailX,$adMail)) { $errMsg[] = 'No or invalid admin email address'; }
		if (empty($adPwrd)) { $errMsg[] = 'No admin password'; }
	}
	if ($action == 'set') {
		if (empty($defCal)) { $errMsg[] = 'No calendar selected'; }
	}
	if (strpos(' delete replicate backup',$action)) {
		if (empty($selCals)) { $errMsg[] = 'No calendar selected'; }
	}
	if ($action == 'replicate') {
		if (empty($selTabs)) { $errMsg[] = 'No tables selected'; }
	}
	if (strpos(' import',$action)) {
		if (empty($selCal)) { $errMsg[] = 'No calendar selected'; }
	}
}

if (!$start or $errMsg) {
	echo '<aside class="aside">'."\n";
	echo '<h4>Instructions</h4>'."\n";
	switch ($action) { //show instructions
		case '': echo $actT; break;
		case 'test': echo $act0T; break;
		case 'create': echo $act1T; break;
		case 'set': echo $act2T; break;
		case 'delete': echo $act3T; break;
		case 'replicate': echo $act4T; break;
		case 'backup': echo $act5T; break;
		case 'download': echo $act6T; break;
		case 'import': echo $act7T; break;
	}
	echo "</aside>\n";
}
echo '<div class="centerBox">'."\n";
echo '<h3 class="center">LuxCal Calendar Administrator Tools</h3><br><br>'."\n";
if ($start and !$errMsg) {
	//Perform action
	switch ($action) {
	case 'test': //Process Test configuration
		$resMsg[] = "<h5>Configuration test successful</h5><br>";
		foreach ($selTsts as $v) {
			switch ($v) {
			case 'vers':
				//check PHP version
				if (version_compare(PHP_VERSION,'5.2.3') >= 0) {
					$resMsg[] = "PHP version ".PHP_VERSION." - Ok.";
				} else {
					$errMsg[] = "PHP version ".PHP_VERSION." too low. You need version 5.2.3 or higher.";
				}
			break;
			case 'sqli':
				//test if PDO-sqlite extension enabled
				if (extension_loaded('pdo_sqlite')) {
					$resMsg[] = "PHP PDO-SQLite extension enabled - Ok.";
				} else {
					$errMsg[] = "PHP PDO-SQLite extension NOT enabled<br>Ask your ISP to enable this extension.";
				}
			break;
			case 'perm':
				//check file permissions
				if (file_put_contents('./lctest.dat','LuxCal') === false) { //write test file
					$errMsg[] = "Error: Unable to write to the calendar's root folder. Check file permissions on your server.";
				} else {
					unlink('./lctest.dat'); //delete test file
					$resMsg[] = "Writing to the calendar's root folder - Ok.";
				}
				if (file_put_contents($dbDir.'index.html','') === false) { //write index file to db folder (to prevent dir listing)
					$errMsg[] = "Error: Unable to write to the calendar's database folder. Check file permissions on your server.";
				} else {
					$resMsg[] = "Writing to the calendar's database folder - Ok.";
				}
				if (file_put_contents('./files/lctest.dat','LuxCal') === false) { //write test file
					$errMsg[] = "Error: Unable to write to the calendar's 'files' folder. Check file permissions on your server.";
				} else {
					unlink('./files/lctest.dat'); //delete test file
					$resMsg[] = "Writing to the calendar's 'files' folder - Ok.";
				}
			break;
			case 'sess':
				if ($lcSess1 != 42 or $lcSess2 != 'hitch-hiker') { //test session vars
					$errMsg[] = "PHP sessions disabled or not working.";
				} else {
					$resMsg[] = "PHP sessions enabled and working - Ok.";
				}
			break;
			case 'cook':
				if ((empty($lcCook1) or $lcCook1 != 43) or (empty($lcCook2) or $lcCook2 != 'galaxy')) { //test cookies
					$errMsg = "Browser cookies disabled or not working.";
				} else {
					$resMsg[] = "Browser cookies enabled and working - Ok.";
				}
			}
		}
	break;
	
	case 'create': //Process Create calendars
		$nrCals = $nrPres = 0;
		$calArray = preg_split('~[\r\n]+~m',$newCals);
		$count = 0;
		foreach ($calArray as $newCal) { //create calendar
			list($calID,$calTitle) = explode('=',$newCal);
			$calID = trim($calID);
			$calTitle = trim($calTitle);
			if ($count == 0) { $topCal = $calID; $count++;}
			//create calendar or connect if already present
			if (!$dbH = dbConnect($calID,0)) {
				$errMsg[] = "Calendar $calID - Problem connecting to calendar.";
				continue;
			}
			//if not present, create tables
			$tabExist = 0;
			if (getTables('events') == false) {
				if (!createDbTable('events')) { $errMsg[] = "Error: Problem creating table 'events' in calendar {$calID}."; break; }
			} else {
				$tabExist++;
			}
			if (getTables('categories') == false) {
				if (!createDbTable('categories')) { $errMsg[] = "Error: Problem creating table 'categories' in calendar {$calID}."; break; }
			} else {
				$tabExist++;
			}
			if (getTables('users') == false) {
				if (!createDbTable('users')) { $errMsg[] = "Error: Problem creating table 'users' in calendar {$calID}."; break; }
			} else {
				$tabExist++;
			}
			if (getTables('groups') == false) {
				if (!createDbTable('groups')) { $errMsg[] = "Error: Problem creating table 'groups' in calendar {$calID}."; break; }
			} else {
				$tabExist++;
			}
			if (getTables('settings') == false) {
				$newTabSet = createDbTable('settings');
				if (!$newTabSet) { $errMsg[] = "Error: Problem creating table 'settings' in calendar {$calID}"; break; }
			} else {
				$tabExist++;
				$newTabSet = '';
			}
			//insert initial data in cat, user and settings tables
			$catSaved = initCats();
			if (!$catSaved) {
				$errMsg[] = "Error: Problem writing to database table 'categories' in calendar {$calID}."; break;
			}
			$adPwMd5 = md5($adPwrd);
			$usrSaved = initUsers($adName,$adMail,$adPwMd5);
			if (!$usrSaved) {
				$errMsg[] = "Error: Problem writing to database table 'users' in calendar {$calID}."; break;
			}
			$grpSaved = initGroups();
			if (!$grpSaved) {
				$errMsg[] = "Error: Problem writing to database table 'groups' in calendar {$calID}."; break;
			}
			$setSaved = true; //init
			if ($newTabSet) { //insert default settings
				$dbSet = array();
				$dbSet['calendarTitle'] = $calTitle;
				$dbSet['calendarUrl'] = $calUrlDefault.'?cal='.$calID;
				$dbSet['calendarEmail'] = (!empty($calEml) ? $calEml : $adMail);
				checkSettings($dbSet);
				$setSaved = saveSettings($dbSet,true);
				if (!$setSaved) {
					$errMsg[] = "Error: Unable to save settings to database table settings in calendar {$calID}."; break;
				}
			}
			if ($tabExist > 0) { $nrPres++; }
			$nrCals++;
		}

		if (!$dbDef) {
			$dbDef = $topCal; //set new default calendar
		}

		if (empty($errMsg)) { //set result message
			$resMsg[] = "<h5>Calendar creation successful</h5><br>";
			if ($nrPres) {
				$resMsg[] = "{$nrPres} calendar(s) already present.";
			}
			$resMsg[] = strval($nrCals-$nrPres)." calendar(s) created.";
		}
	break;

	case 'set': //process Set default calendar
		$dbDef = $defCal; //set new default calendar
		saveConfig();
		$resMsg[] = "<h5>Setting default calendar successful</h5><br>";
		$resMsg[] = "Default calendar set to '{$dbDef}' in lcconfig.php.";
	break;

	case 'delete': //process Delete calendars action
		$delCals = 0;
		foreach ($selCals as $calID) { //process calendars
			if (@rename($dbDir.$calID.'.cdb',$dbDir.$calID.'.bak')) { //delete: ext => bak
				unset($calIDs[$calID]);
				$delCals++;
			} else {
				$errMsg[] = "Error deleting calendar {$calID}.";
			}
		}
		if (empty($errMsg)) { //display result
			$resMsg[] = "<h5>Deletion successful</h5><br>";
			$resMsg[] = "{$delCals} calendar(s) deleted.";
		}
		$dbNames = array_keys($calIDs); //remaining calendars
		if (!in_array($dbDef,$dbNames)) { //default calendar deleted
			$dbDef = empty($dbNames) ? '' : $dbNames[0]; //set new default calendar, if any
			$resMsg[] = "<br>";
			$resMsg[] = "default calendar set to '{$dbDef}' in lcconfig.php.";
		}
		saveConfig(); //save configuration
	break;

	case 'replicate': //process Replicate data and / or settings from file
		if (empty($_FILES['fName']['tmp_name'])) {
			$errMsg[] = "No file selected."; break;
		}
		if (substr($_FILES['fName']['name'],-4) != '.sql') {
			$errMsg[] = "The selected file is not a .sql backup file."; break;
		}
		$fName = $_FILES['fName']['tmp_name']; //get backup file name
		//Read SQL queries from $fName
		$sqlArray = file($fName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		unlink($fName);
		//check version of backup file
		foreach ($sqlArray as $qLine) { //search 1st comment block
			if ($qLine[0] != '-' or preg_match('~LuxCal version:\s*(\d.\d)~i',$qLine,$matches)) { break; }
		}
		if (empty($matches) or $matches[1] != substr($lcV,0,3)) { //version not found or not matching
			$errMsg[] = "Source back up file not matching with calendar version {$lcV}."; break; //abort replicate
		}
		$tabList = implode('|',$selTabs); //list with selected tables
		//retain all INSERT queries for the selected tables
		$sqlInsArr = array(); //array with valid INSERT queries
		foreach ($sqlArray as $qLine) {
			$match = preg_match("~INSERT INTO [`'\"]?($tabList)[`'\"]? VALUES\s*\('?(.+?)'?,~i",$qLine,$matches);
			if ($match and substr($matches[2],0,8) != 'calendar') { //valid INSERT, flush calendar version|title|URL|email
				$sqlInsArr[] = $qLine.'--'.substr($matches[1],0,3); //appended table name used later by counter
			}
		}
		unset($sqlArray);
		//scrutinize INSERT queries
		$pattern = array("~[`'\"]?events[`'\"]? VALUES\s*\('\d+?'~","~\\\\+[\"']~"); //make event IDs NULL to trigger auto-increment , escape \', \\', etc. by ''
		$replacement = array("`events` VALUES (NULL","''");
		$sqlInsArr = preg_replace($pattern,$replacement,$sqlInsArr);  //final INSERT statements
//	file_put_contents('./files/test.sql',implode ("\n",$sqlInsArr)); //dump INSERTs of all selected tables - TEST LINE

		$resMsg[] = "<h5>Replicating data and / or settings from file</h5><br>";
		$resMsg[] = "Source backup file: {$_FILES['fName']['name']}:";
		foreach ($selCals as $calID) { //Process SQL INSERT queries for each selected calendar
			//connect to calendar
			if (!$dbH = dbConnect($calID,0)) {
				$errMsg[] = "Problem connecting to calendar {$calID}. Check your file permissions";
				continue;
			}
			$resMsg[] = "<br>Target calendar {$calID}:";
			//prepare tables for INSERT
			if (in_array('categories',$selTabs)) { //categories table selected
				createDbTable("categories"); //drop and recreate table
			}
			if (in_array('users',$selTabs)) { //users table selected
				createDbTable("users"); //drop and recreate table
			}
			if (in_array('groups',$selTabs)) { //users table selected
				createDbTable("groups"); //drop and recreate table
			}
			if (in_array('settings',$selTabs)) { //settings table selected
				$stH = dbQuery("DELETE FROM `settings` WHERE `name` NOT LIKE 'calendar%'"); //empty table, except calendar values
			}
			$eveCnt = $catCnt = $useCnt = $groCnt = $setCnt = 0; //init counters
			dbTransaction('begin');
			foreach ($sqlInsArr as $query) { //insert records
				$stH = dbQuery($query);
				if (!$stH) { break; }
				${substr($query,-3).'Cnt'}++; //increment INSERT counter
			}
			$result = dbTransaction('commit');
			if (!$result) { $errMsg[] = "Error inserting data in table {$matches[1]} of calendar {$calID}"; break; }
			foreach ($selTabs as $table) { //show result
				$resMsg[] = "- Inserted {$table}: ".${substr($table,0,3).'Cnt'};
			}
		}
	break;

	case 'backup': //process Backup calendars
		$buCals = array();
		foreach ($selCals as $calID) { //process calendars
			$dbH = dbConnect($calID); //connect to db
			$dbSet = getSettings();
			if (!$dbSet) {
				$errMsg[] = "Unable to load settings from calendar {$calID}"; break;
			}
			//get table names
			$tables = getTables();
			if (empty($tables)) {
				$errMsg[] = "No tables found in calendar {$calID}"; break;
			}
			//make file header
			$sqlFile = "--\n";
			$sqlFile .= "-- SQL DUMP ".date('Y.m.d @ H:i')."\n";
			$sqlFile .= "-- Calendar: {$dbSet['calendarTitle']}\n";
			$sqlFile .= "-- Database: {$dbDir}{$calID}.cdb\n";
			$sqlFile .= "--\n";
			$sqlFile .= "-- LuxCal version: {$lcV}\n";
			$sqlFile .= "-- http://www.luxsoft.eu\n";
			$sqlFile .= "--\n\n";
			//backup tables
			foreach ($tables as $table) {
				$sqlFile .= "\n-- ".str_repeat("=", 56)."\n\n--\n-- Table {$table}\n--\n\n";
				$sqlFile .= "DROP TABLE IF EXISTS `{$table}`;\n\n";
				$sqlFile .= getTableSql($table).";\n\n"; //get SQL code to create table
				$stH = dbQuery("SELECT * FROM `{$table}`");
				while($row = $stH->fetch(PDO::FETCH_NUM)) {
					$sqlFile .= "INSERT INTO `{$table}` VALUES(";
					foreach($row as $value) {
						$sqlFile .= isset($value) ? "'".addslashes(preg_replace("%\n%","\\n",$value))."'," : "'',";
					}
					$sqlFile = substr($sqlFile,0,-1).");\n"; //remove last ,
				}
				$stH = null; //release statement handle!
				$sqlFile .="\n";
			}
			//save .sql backup file
			$fName = "./files/{$calID}-dump-".date('Ymd-His').'.sql';
			if (file_put_contents($fName,$sqlFile) === false) { 
				$errMsg[] = "Could not save backup file {$fName}"; break;
			}
			$dbH = null; //close db
			$buCals[$calID] = $fName;
		}
		if (empty($errMsg)) { //display result
			$resMsg[] = "<h5>Back up successful</h5><br>";
			$resMsg[] = "Calendar(s) backed up.";
			foreach ($buCals as $buCal => $fName) {
				$resMsg[] = "- {$buCal} = {$calIDs[$buCal]}<br>&nbsp;&nbsp;&nbsp;&nbsp;(file name: {$fName})";
			}
		}
	break;

	case 'download': //process Download backup files
		if (!is_readable("./files/{$bupFile}")) {
			$errMsg[] = "Unable to read the selected file '{$bupFile}' in the 'files' folder.";
		} else {
			$matches = array();
			if (preg_match('~(^--.+?\r?\n)\s*\r?\n~s',file_get_contents("./files/{$bupFile}", NULL, NULL, 0, 500),$matches)) {
				$fHeader = preg_replace('~\r?\n~','<br>',$matches[1]);
			} else {
				$fHeader = "No header found.";
			}
			$resMsg[] = "<h5>File download prepared</h5><br>";
			$resMsg[] = "File name: {$bupFile}";
			$resMsg[] = "File header:<br>{$fHeader}";
			$resMsg[] = "<div class='center'><input type='button' onclick=\"window.open('dloader.php?ftd={$bupFile}&amp;rName={$bupFile}','_blank');\" value='start download'></div>";
		}
	break;

	case 'import': //process Import db tables from LuxCal 2.7.2+ calendar backup file
		if (empty($_FILES['fName']['tmp_name'])) {
			$errMsg[] = "No file selected."; break;
		} elseif (substr($_FILES['fName']['name'],-4) != '.sql') {
			$errMsg[] = "The selected file is not a .sql backup file."; break;
		}
		$fName = $_FILES['fName']['tmp_name']; //get backup file name
		//Read SQL queries from backup file
		$sqlArray = file($fName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		unlink($fName);
		//get version of backup file
		$lcVBup = '?.?';
		foreach ($sqlArray as $qLine) {
			if ($qLine[0] != '-') { break; }
			if (preg_match('~LuxCal version:\s*(\d.\d)~i',$qLine,$matches)) { //version found
				$lcVBup = $matches[1];
			}
		}
		$calID = $selCal; //set destination calendar
		$count = importSqlFile($sqlArray); //import SQL file
		if ($count['cat'] > 0 and $count['use'] > 0 and $count['gro'] > 0 and $count['set'] > 0) {
			$resMsg[] = "<h5>Importing LuxCal calendar data successful</h5><br>";
			$resMsg[] = "From file '{$_FILES['fName']['name']}' (LuxCal V{$lcVBup})";
			$resMsg[] = "Into calendar '{$selCal}'";
			$resMsg[] = "<br>";
			$resMsg[] = "- Table events: {$count['eve']} records inserted";
			$resMsg[] = "- Table users: {$count['use']} records inserted";
			$resMsg[] = "- Table groups: {$count['gro']} records inserted";
			$resMsg[] = "- Table categories: {$count['cat']} records inserted";
			$resMsg[] = "- Table settings: {$count['set']} records inserted";
			$lcVUpg = upgradeDb(); //upgrade db schema
			$resMsg[] = "<br>";
			$resMsg[] = "Imported database upgraded from V{$lcVUpg} to V".substr($lcV,0,3);
			$dbSet = getSettings(); //get imported settings
			checkSettings($dbSet); //check & complete settings
			saveSettings($dbSet); //save completed settings
			$resMsg[] = "<br>";
			$resMsg[] = "Imported settings verified/completed";
		} else {
			$errMsg[] = "The selected backup file could not be imported";
		}
		$stH = null; //release statement handle
		$dbH = null; //close db
	} //end of case
	
	session_unset(); //force retrieve of settings and selection of default calendar

	//display Action result
	echo '<div class="resultBox">'."\n";
	if (!empty($errMsg)) {
		echo "<h4>The following error(s) occurred</h4>\n";
		echo "<ul>\n";
		foreach ($errMsg as $msg) {
			echo "<li class='hilite'>{$msg}</li>\n";
		}
		echo "</ul>\n";
	} else {
		foreach ($resMsg as $msg) {
			echo ($msg[0] != '<') ? "<p>{$msg}</p>\n" : "{$msg}\n";
		}
	}
	echo "<br><br>\n<div class=\"center\">\n";
	echo "<input type='button' onclick=\"window.location='{$_SERVER['PHP_SELF']}'\" value='back to tools'>\n";
	echo "</div>\n";
	echo "</div>\n";
} else {
	if (empty($errMsg)) {
		if ($back or !$action) {
			echo '<p class="center">Choose an action.</p>'."\n";
		} else {
			echo '<p class="center">Complete the form and click the '.ucfirst($action).' button.</p>'."\n";
		}
	} else {
		foreach ($errMsg as $msg) {
			echo "<p class='hilite'>- {$msg}</p>\n";
		}
	}
	echo "<br>\n";
	echo "<form class='form' id='form' action='".htmlentities($_SERVER['PHP_SELF'])."' method='post' enctype='multipart/form-data'>\n";
	echo "<input type='hidden' name='MAX_FILE_SIZE' value='2050000'>\n";
	echo '<h4 class="hilite center">= read instructions =</h4>'."\n";
	if ($back or !$action) {
		$disabled1 = count($calIDs) < 2 ? ' disabled' : '';
		$greyout1 = $disabled1 ? " class='greyout'" : '';
		$disabled = !$calIDs ? ' disabled' : '';
		$greyout = $disabled ? " class='greyout'" : '';
		echo "<h5>Action</h5>\n";
		echo "<input type='radio' id='act0' onclick='submit()' name='action' value='test'>";
		echo "<label for='act0'> Test configuration</label><br>\n";
		echo "<input type='radio' id='act1' onclick='submit()' name='action' value='create'>";
		echo "<label for='act1'> Create new calendars</label><br>\n";
		echo "<input type='radio' id='act2' onclick='submit()' name='action' value='set'{$disabled1}>";
		echo "<label for='act2'{$greyout1}> Set default calendar</label><br>\n";
		echo "<input type='radio' id='act3' onclick='submit()' name='action' value='delete'{$disabled}>";
		echo "<label for='act3'{$greyout}> Delete calendars</label><br>\n";
		echo "<input type='radio' id='act4' onclick='submit()' name='action' value='replicate'{$disabled}>";
		echo "<label for='act4'{$greyout}> Replicate data and / or settings from file</label><br>\n";
		echo "<input type='radio' id='act5' onclick='submit()' name='action' value='backup'{$disabled}>";
		echo "<label for='act5'{$greyout}> Back up calendars</label><br>\n";
		echo "<input type='radio' id='act6' onclick='submit()' name='action' value='download'{$disabled1}>";
		echo "<label for='act6'{$greyout1}> Download backup file from 'files' folder</label><br>\n";
		echo "<input type='radio' id='act7' onclick='submit()' name='action' value='import'{$disabled}>";
		echo "<label for='act7'{$greyout}> Import calendar backup file of a previous LuxCal version</label><br>\n";
		echo "<br>\n";
		echo "<p><b>Currently installed calendar(s):</b></p>\n";
		if ($curCalList) {
			echo $curCalList;
			echo "<br><br>\n<div class=\"center\">\n";
			echo "<input type='button' onclick=\"window.location='index.php?cal={$dbDef}'\" value='start default calendar'/>\n";
			echo "</div>\n";
		} else {
		 echo 'none';
		}
	} else {
		echo "<input type='hidden' id='action' name='action' value='{$action}'/>\n";
	}
	switch ($action) {
	case 'test':
		echo "<h5>Test configuration</h5>\n<br>\n";
		echo "<p><b>Select tests:</b> </p>\n";
		$checked = !empty($_POST['tstAll']) ? " checked='checked'" : '';
		echo "<input type='checkbox' id='tst0' name='tstAll' value='all' onclick=\"checkA('tst');\"{$checked}><label for='tst0'> All tests</label><br>\n";
		$checked = (!empty($_POST['tst']) and in_array('vers',$_POST['tst'])) ? " checked='checked'" : '';
		echo "<input type='checkbox' id='tst1' name='tst[]' value='vers' onclick=\"checkN('tst');\"{$checked}><label for='tst1'> PHP version</label><br>\n";
		$checked = (!empty($_POST['tst']) and in_array('sqli',$_POST['tst'])) ? " checked='checked'" : '';
		echo "<input type='checkbox' id='tst1' name='tst[]' value='sqli' onclick=\"checkN('tst');\"{$checked}><label for='tst1'> PHP SQLite extension</label><br>\n";
		$checked = (!empty($_POST['tst']) and in_array('perm',$_POST['tst'])) ? " checked='checked'" : '';
		echo "<input type='checkbox' id='tst1' name='tst[]' value='perm' onclick=\"checkN('tst');\"{$checked}><label for='tst1'> File permissions</label><br>\n";
		$checked = (!empty($_POST['tst']) and in_array('sess',$_POST['tst'])) ? " checked='checked'" : '';
		echo "<input type='checkbox' id='tst2' name='tst[]' value='sess' onclick=\"checkN('tst');\"{$checked}><label for='tst2'> PHP sessions</label><br>\n";
		$checked = (!empty($_POST['tst']) and in_array('cook',$_POST['tst'])) ? " checked='checked'" : '';
		echo "<input type='checkbox' id='tst3' name='tst[]' value='cook' onclick=\"checkN('tst');\"{$checked}><label for='tst3'> Browser cookies</label><br>\n";
		echo "<br>\n";
		break;
	case 'create':
		echo "<h5>Create new calendars</h5>\n<br>\n";
		echo "<p><b>Calendar IDs / Titles:</b> (format per line: 'cal ID = cal title')</p>\n";
		echo "<textarea name='calDef'>{$newCals}</textarea><br>\n";
		echo "<table>\n";
		echo "<tr><td colspan='2'><b>Calendar:</b></td></tr>\n";
		echo "<tr><td>Email address:</td><td><input type='text' name='calEml' value='{$calEml}'></td></tr>\n";
		echo "<tr><td colspan='2'>&nbsp;</td></tr>\n";
		echo "<tr><td colspan='2'><b>Administrator:</b></td></tr>\n";
		echo "<tr><td>Name:</td><td><input type='text' name='adName' value='{$adName}'></td></tr>\n";
		echo "<tr><td>Email:</td><td><input type='text' name='adMail' value='{$adMail}'></td></tr>\n";
		echo "<tr><td>Password:</td><td><input type='text' name='adPwrd' value='{$adPwrd}'></td></tr>\n";
		echo "</table>\n";
		echo "<br>\n";
		break;
	case 'set':
		echo "<h5>Set default calendar</h5>\n<br>\n";
		echo "<p><b>Select calendar</b></p>\n";
		foreach ($calIDs as $k =>$v) {
			$checked = (!empty($_POST['defCal'])) ? " checked='checked'" : ($k == $dbDef ? " checked='checked'" : '');
			$curDef = ($k == $dbDef) ? " <span class='mark'>(current default)</span>" : '';
			echo "<input type='checkbox' id='{$k}' name='defCal' value='{$k}' onclick=\"check1('defCal',this);\"{$checked}><label for='{$k}'> {$k} - {$v}{$curDef}</label><br>\n";
		}
		echo "<br>\n";
		break;
	case 'delete':
		echo "<h5>Delete calendars</h5>\n<br>\n";
		echo "<p><b>Select calendar(s)</b></p>\n";
		$checked = !empty($_POST['calAll']) ? " checked='checked'" : '';
		echo "<input type='checkbox' id='cal0' name='calAll' value='all' onclick=\"checkA('cal');\"{$checked}><label for='cal0'> All calendars</label><br>\n";
		foreach ($calIDs as $k =>$v) {
			$checked = (!empty($_POST['cal']) and in_array($k,$_POST['cal'])) ? " checked='checked'" : '';
			$curDef = ($k == $dbDef) ? " <span class='mark'>(default)</span>" : '';
			echo "<input type='checkbox' id='cal{$k}' name='cal[]' value='{$k}' onclick=\"checkN('cal');\"{$checked}><label for='cal{$k}'> {$k} - {$v}{$curDef}</label><br>\n";
		}
		echo "<br>\n";
		break;
	case 'replicate':
		echo "<h5>Replicate data and / or settings from file</h5>\n<br>\n";
		echo "<p><b>Select source .sql file</b></p>\n";
		echo "<input type='file' name='fName'>\n";
		echo "<br><br>\n";
		echo "<p><b>Select table(s) to copy</b></p>\n";
		$checked = !empty($_POST['tabAll']) ? " checked='checked'" : '';
		echo "<input type='checkbox' id='tab0' name='tabAll' value='all' onclick=\"checkA('tab');\"{$checked}><label for='tab0'> All tables</label><br>\n";
		foreach ($allTabs as $k => $v) {
			$checked = (!empty($_POST['tab']) and in_array($v,$_POST['tab'])) ? " checked='checked'" : '';
			echo "<input type='checkbox' id='tab{$k}' name='tab[]' value='{$v}' onclick=\"checkN('tab');\"{$checked}><label for='tab{$k}'> {$v}</label><br>\n";
		}
		echo "<br>\n";
		echo "<p><b>Select destination calendar(s)</b></p>\n";
		$checked = !empty($_POST['calAll']) ? " checked='checked'" : '';
		echo "<input type='checkbox' id='cal0' name='calAll' value='all' onclick=\"checkA('cal');\"{$checked}><label for='cal0'> All calendars</label><br>\n";
		foreach ($calIDs as $k => $v) {
			$checked = (!empty($_POST['cal']) and in_array($k,$_POST['cal'])) ? " checked='checked'" : '';
			$curDef = ($k == $dbDef) ? " <span class='mark'>(default)</span>" : '';
			echo "<input type='checkbox' id='cal{$k}' name='cal[]' value='{$k}' onclick=\"checkN('cal');\"{$checked}><label for='cal{$k}'> {$k} - {$v}{$curDef}</label><br>\n";
		}
		echo "<br>\n";
		break;
	case 'backup':
		echo "<h5>Back up calendars</h5>\n<br>\n";
		echo "<p><b>Select calendar(s)</b></p>\n";
		$checked = !empty($_POST['calAll']) ? " checked='checked'" : '';
		echo "<input type='checkbox' id='cal0' name='calAll' value='all' onclick=\"checkA('cal');\"{$checked}><label for='cal0'> All calendars</label><br>\n";
		foreach ($calIDs as $k => $v) {
			$checked = (!empty($_POST['cal']) and in_array($k,$_POST['cal'])) ? " checked='checked'" : '';
			$curDef = ($k == $dbDef) ? " <span class='mark'>(default)</span>" : '';
			echo "<input type='checkbox' id='cal{$k}' name='cal[]' value='{$k}' onclick=\"checkN('cal');\"{$checked}><label for='cal{$k}'> {$k} - {$v}{$curDef}</label><br>\n";
		}
		echo "<br>\n";
		break;
	case 'download':
		echo "<h5>Download backup files from 'files' folder</h5>\n<br>\n";
		echo "<p><b>Select backup file</b></p>\n";
		echo "<select name='buFile' id='buFile'>\n";
		$dirScan = scandir('./files/');
		foreach ($dirScan as $entry) {
			if (substr($entry,-4) == '.sql') { //backup file found
					echo "<option value='{$entry}'>{$entry}</option>\n";
			}
		}
		echo "</select>\n";
		echo "<br><br>\n";
		break;
	case 'import':
		echo "<h5>Import backup file of previous LuxCal version</h5>\n<br>\n";
		echo "<p><b>Select source backup file</b></p>\n";
		echo "<input type='file' name='fName'>\n";
		echo "<br><br>\n";
		echo "<p><b>Select destination calendar</b></p>\n";
		foreach ($calIDs as $k => $v) {
			$checked = (!empty($_POST['selCal']) and in_array($k,$_POST['selCal'])) ? " checked='checked'" : '';
			$curDef = ($k == $dbDef) ? " <span class='mark'>(default)</span>" : '';
			echo "<input type='checkbox' id='{$k}' name='selCal' value='{$k}' onclick=\"check1('selCal',this);\"{$checked}><label for='{$k}'> {$k} - {$v}{$curDef}</label><br>\n";
		}
		echo "<br>\n";
	}
	echo "<div class='center'>\n";
	if ($action) {
		echo "<input type='submit' id='start' name='start' onclick='return valForm()' value='".ucfirst($action)."'>\n";
		echo "<input type='submit' name='back' value='Back'>\n";
	}
	echo "</div>\n";
	echo "</form>\n";
}
?>
</div>
</div>
<div class='bLine mark'><h4>AFTER USE REMOVE THE FILE <?php echo basename(__FILE__); ?> FILE FROM THE SERVER!</h4></div>
<div class='endBar'>
	design 2016 - powered by <a href='http://www.luxsoft.eu'><span class='footLB'>Lux</span><span class='footLR'>Soft</span></a>
</div>
<br>&nbsp;
</body>
</html>
