<?php
/*
!!!!!!! AFTER UPLOADING THE LUXCAL FILES AND FOLDERS TO YOUR SERVER,   !!!!!!!
!!!!!!! THIS SCRIPT WILL RUN AUTOMATICALLY WHEN STARTING THE CALENDAR. !!!!!!!
!!!!!!! YOU MAY ALSO LAUNCH THIS SCRIPT VIA YOUR BROWSER AT ANY TIME.  !!!!!!!

� Copyright 2009-2016 LuxSoft - www.LuxSoft.eu
*/

//heredocs
$instructions = <<<EOT
<aside class="aside">
<h4>Instructions</h4>
<p><u>When this installation script runs for the first time</u> . . .</p>
<p>after entering and testing the required data, it will install a calendar with 
the specified name and title in the specified database folder.</p>
<p>After successful installation:</p>
<ul>
<li>the LuxCal version number, the name of the SQLite database folder and the 
name of the default calendar are stored in the file <kbd>lcconfig.php</kbd> in 
the calendar root folder</li>
<li>the default calendar settings are stored in the database table 
<kbd>settings</kbd></li>
<li>an administrator user account is created with the specified Administrator 
credentials</li>
</ul>
<p><u>When you launch this installation script a subsequent time</u> . . .</p>
<p>it will list the installed calendar(s) (name/title pairs) present in the 
specified database folder and offer the possibility to create more calendars and 
to change the database and administrator data.</p>
<p>When saving the data:</p>
<ul>
<li>specified calendars will be created if not present already</li>
<li>the calendar tables will be checked and missing tables will be created</li>
<li>the configuration data in the file <kbd>lcconfig.php</kbd> will be updated
</li>
<li>the Administrator credentials are saved/updated in the users table of each 
calendar</li>
</ul>
<br>
<p>Note: The administrator credentials can be changed later by the calendar 
administrator for each individual calendar.</p>
<br>
<p><u>Description of form fields:</u></p>
<br>
<p><b>New to install calendar(s)</b></p>
<p>Calendar name/title pairs (format: 'name = title', one per line) of new 
calendars to be created. The initially proposed calendar name = title pair is 
'mycal = is My Web Calendar'. If multiple calendars are installed, then - when 
starting a calendar - the calendar name is used to select a specific calendar.
</p>
<br>
<p><b>Database folder</b></p>
<p>Folder, relative to the calendar root, where the SQLite database will be 
stored. If not existing, the specified folder will be created. The proposed 
folder is 'db/'. However, if your ISP allows, it's good practice to place the 
database folder 'above' your website. To go one level up, use '<kbd>../</kbd>'.
</p>
<br>
<p><b>Default calendar</b></p>
<p>The name of the default calendar. In case of multiple calendars, this will be 
the default calendar when no explicit calendar is selected. The specified name 
must be present in the New to install or in the Installed calendar list.</p>
<br>
<p><b>Installed calendar(s)</b></p>
<p>List with the currently installed calendars in the specified database 
folder</p>
<br>
<p><b>Administrator Name</b>, <b>Email</b> and <b>Password</b></p>
<p>These values must be remembered as they are required later to log in to the 
calendar. When, in case of multiple calendars, the administrator name, email or 
password are changed, the values will be changed for all calendars.</p>
</aside>
EOT;

$saveOk = <<<EOT
<h4>Saving Data Successful</h4>
<ol>
<li>The calendar tables have been checked and completed if necessary.</li>
<li>The administrator credentials have been successfully updated in the admin 
user account of (each of) the calendar(s).</li>
<li>The LuxCal version number, the SQLite database folder and the name of the 
default calendar have been saved in the file <kbd>lcconfig.php</kbd> in the 
calendar's root folder.</li>
</ol>
<br>
<p><strong>Please note that it is good practice to directly . . .</strong></p>
<ul>
<li>back up the configuration file <kbd>lcconfig.php</kbd> in the root folder 
of the calendar</li>
<li>remove the files <kbd>installxxx.php</kbd> and <kbd>upgradexxx.php</kbd> 
from the calendar's root folder</li>
</ul>
<br>
<p>If needed, you can install/start the lctools.php file to further configure 
your calendar installation.</p>
EOT;

$installOk = <<<EOT
<h4>Installation Successful</h4>
<ol>
<li>The calendar(s) has(have) been created / configured successfully and the 
default calendar settings have been saved in the <kbd>settings</kbd> table of 
the / each calendar.</li>
<li>A user account for the 'public user' and for the 'administrator', with the 
specified administrator credentials, has been created in the <kbd>users</kbd> 
table.</li>
<li>The LuxCal version number and the SQLite database folder have been saved 
in the file <kbd>lcconfig.php</kbd> in the calendar's root directory.</li>
</ol>
<br>
<p><strong>Please note that it is good practice to directly . . .</strong></p>
<ul>
<li>back up the configuration file <kbd>lcconfig.php</kbd> in the calendar's 
root folder</li>
<li>remove the files <kbd>installxxx.php</kbd> and <kbd>upgradexxx.php</kbd> 
from the calendar's root folder</li>
<li>Log in to the / each calendar, go to the administration menu (top right) 
and:<br>
- on the Settings page set the TimeZone to your local time zone<br>
- on the Settings page choose your preferred settings<br>
- on the Categories page define a number of useful event categories</li>
<li>Protect the folders <kbd>emlists</kbd>, <kbd>files</kbd>, <kbd>logs</kbd> 
and the database folder. For instance: on *nix servers add to these folders a 
<kbd>.htaccess</kbd> file with 'Options -Indexes'</li>
</ul>
EOT;

//sanity check
foreach ($_REQUEST as $key => $value) { if (is_string($value)) $_REQUEST[$key] = htmlspecialchars(strip_tags(trim($value)),ENT_QUOTES,'UTF-8'); }

//set error reporting
error_reporting(E_ALL); //errors and notices
ini_set('display_errors',1);
ini_set('log_errors',1);

//get current LuxCal version
$lcV = implode('.',str_split(substr(basename(__FILE__),7,-4))).'L';

//init
$test = !empty($_POST['test']) ? true : false; //test configuration
$install = !empty($_POST['install']) ? true : false; //save/install calendars
$newCals = !empty($_POST['newCals']) ? trim($_POST['newCals']) : ''; //name = title pairs
$defCal = !empty($_POST['defCal']) ? trim($_POST['defCal']) : ''; //default calendar
$dbFolder = !empty($_POST['dbFolder']) ? trim($_POST['dbFolder'],'/ ').'/' : ''; //db folder
$adName = !empty($_POST['adNameP']) ? trim($_POST['adNameP']) : ''; //admin name
$adMail = !empty($_POST['adMailP']) ? trim($_POST['adMailP']) : ''; //admin mail address
$adPwrd = !empty($_POST['adPwrdP']) ? $_POST['adPwrdP'] : ''; //admin password
$adPwMd5 = !empty($_POST['adPwMd5']) ? $_POST['adPwMd5'] : ''; //md5 password
$dbNerror = $dbDerror = $dbFerror = $adNerror = $adEerror = $adPerror = '';

//prepare PHP session test
session_start();
if (!$install and !$test) { //save session test variables
	$_SESSION['lcSess1'] = 42;
	$_SESSION['lcSess2'] = 'hitchhiker';
}

//if present, get config data
if (file_exists('./lcconfig.php')) { include './lcconfig.php'; }
$dbDir = !empty($dbFolder) ? $dbFolder : (!empty($dbDir) ? $dbDir : 'db/');
if (empty($dbSel)) { $dbSel = 1; }
if (empty($dbType)) { $dbType = 'SQLite'; }

//get calendar tools
require './common/toolbox.php';
require './common/toolboxd.php'; //database tools
require './common/toolboxx.php'; //admin tools

//connect to db and get admin credentials
if (!empty($dbDef)) { //default calendar specified
	if (!$defCal) { $defCal = $dbDef; }
	if ($dbH = dbConnect($dbDef,0)) { //connect to default db
		if ($stH = dbQuery("SELECT `name`, `email`, `password` FROM `users` WHERE `ID` = 2",0)) { //get admin user data
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

//get installed calendars
$curCals = getCals();
if (empty($curCals)) {
	$curCalList = 'No calendars installed in the specified folder.';
	if (empty($newCals)) {
		$newCals = 'mycal = My Web Calendar';
		$defCal = 'mycal';
	}
} else {
	$curCalList = '';
	foreach($curCals as $name=>$title) {
		$curCalList .= $name.' = '.$title.($name == $defCal ? " <span class='mark'>(default)</span>" : '')."<br>";
	}
	$curCalList = substr($curCalList,0,-4);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LuxCal Event Calendar - Installation</title>
<meta name="description" content="LuxCal web calendar - a LuxSoft product">
<meta name="author" content="Roel Buining">
<meta name="robots" content="nofollow">
<link rel="icon" href="lcal.png" type="image/png">
<style type="text/css">
header, footer, aside {display:block;}
* { padding:0; margin:0;}
body {font:11px arial, sans-serif; background:#E0E0E0; color:#2B3856; cursor:default;}
a {text-decoration:none; cursor:pointer;}
header {padding:0 1%;}
h3 {margin:8px 0; font-size:14pt;}
h4 {margin:6px 0; font-size:12pt;}
h5 {margin:2px 0; font-size:11pt;}
td {vertical-align:top;}
input, textarea {font:11px arial, sans-serif;}
input[type="text"], textarea { width:100%;}
input[type="submit"], input[type="button"] { margin:0 15px; cursor:pointer;}
ul, ol {margin:0 20px;}
.flag {color:#FF3300;}
.floatR {float:right;}
.floatL {float:left;}
.aside {width:45%; border:1px solid #808080; background:#FFFFFF; padding:15px; float:right; text-align:justify;}
.centerBox {display:table; margin:auto;}
.resultBox {width:500px; border:1px solid #808080; background:#FFFFFF; padding:5px; text-align:justify;}
.form {width:370px; border:1px solid #808080; background:#FFFFFF; padding:5px 15px;}
.bLine {position:absolute; left:0; bottom:50px; width:98%; text-align:center;}
.hilite {background:#F0A070;}
.lolite {background:#70C070;}
.mark {color:#AA0000;}
.center {text-align:center;}
.col1 {width:85px;}
.col2 {width:275px;}
.title {font:bold 16px arial, sans-serif;}
header {margin:6px 0; padding:0 1%; font-size:12pt; font-weight:bold;}
div.navBar {
	position:absolute; top:32px; left:0; right:0;
	padding:0 1%;
	background:#AAAAFF;
	text-align:center;
	border:1px #808080;
	border-style:solid none;
	line-height:20px;
	vertical-align:middle;
}
div.content {
	position:absolute; left:0; top:110px; right:0px; bottom:90px;
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
.footLB {font:italic bold 1.1em arial,sans-serif; color:#0033FF;}
.footLR {font:italic bold 1.1em arial,sans-serif; color:#AA0066;}
</style>
</head>

<body>
<header>LuxCal Event Calendar</header>
<?php
echo "<div class='navBar'><span class='floatL'>LuxCal version: ".$lcV."</span><span class='floatR'>Your PHP version: ".PHP_VERSION."</span><span class='title'>Calendar Installation and Configuration</span></div>\n";
echo "<div class='content'>\n";
$errMsg = $okiMsg = array();
if ($test or $install) {
	//test PHP version
	if (version_compare(PHP_VERSION,'5.3.0') >= 0) {
		$okiMsg[] = "PHP version ".PHP_VERSION." Ok\n";
	} else {
		$errMsg[] = "PHP version ".PHP_VERSION." too low. You need version 5.3 or higher\n";
	}
	//test if PDO-sqlite extension enabled
	if (extension_loaded('pdo_sqlite')) {
		$okiMsg[] = "PHP PDO-SQLite extension Ok\n";
	} else {
		$errMsg[] = "PHP PDO-SQLite extension NOT enabled<br>Ask your ISP to enable this extension\n";
	}
	//test session variables
	if (!empty($_SESSION) and $_SESSION['lcSess1'] == 42 and $_SESSION['lcSess2'] == 'hitchhiker') {
		$okiMsg[] = "PHP sessions Ok\n";
	} else {
		$errMsg[] = "PHP sessions not working<br>Check PHP installation on your server\n";
	}
	//check for missing/invalid form fields
	$regEx = "~^(\w{1,15}\s*=\s*[^<>?%$@{}\\^=]{1,60}[\r\n]+)+$~";
	$dbNerror = (!empty($newCals) and !preg_match($regEx,$newCals."\n")) ? ' class="hilite"' : '';
	$dbDerror = (!preg_match('~^\w{1,15}$~i',$defCal)) ? ' class="hilite"' : '';
	$dbFerror = (!preg_match('~^(.{0,2}|\w+)/([^/]+/)*$~i',$dbDir)) ? ' class="hilite"' : '';
	$adNerror = !$adName ? ' class="hilite"' : '';
	$adEerror = (!preg_match($rxEmailX,$adMail)) ? ' class="hilite"' : '';
	$adPerror = !$adPwrd ? ' class="hilite"' : '';
	if (!$dbNerror) {
		$allCals = $curCals; //currently installed calendars
		if ($newCals) {
			$newCalPairs = preg_split('~[\r\n]+~m',$newCals);
			foreach ($newCalPairs as $newCalPair) { //get cal from newCals
				list($calID,$calTitle) = explode('=',$newCalPair);
				$allCals[trim($calID)] = trim($calTitle); //add/replace into $allCals
			}
		}
		if (!$dbDerror and !array_key_exists($defCal,$allCals)) {
			$dbDerror = ' class="hilite"';
			$errMsg[] = "Default calendar name unknown";
		}
	} else {
		$errMsg[] = "Error: No or invalid calendar name = title pair(s) (highlighted)";
	}
	if ($dbDerror or $dbFerror or $adNerror or $adEerror or $adPerror) {
		$errMsg[] = "Error: Missing or invalid form fields (highlighted)";
	} else {
		$okiMsg[] = "Form fields OK";
	}
	if (!$dbFerror) {
		//create db directory
		if (!is_dir($dbDir)) { //directory not existing
			if (mkdir($dbDir,0755)) {
				$okiMsg[] = "Creating directory '{$dbDir}'\n";
			} else {
				$errMsg[] = "Creating directory '{$dbDir}'<br>Check permissions on your server\n";
			}
		}
		//check file permissions before creating the db
		if (@file_put_contents($dbDir.'index.html','') === false) { //write empty index file to db folder (to prevent dir listing)
			$errMsg[] = "Writing to the database folder '{$dbDir}'<br>Check folder and file permissions on your server\n";
		} else {
			$okiMsg[] = "Writing to the database folder '{$dbDir}'\n";
		}
	}
}
if ($test) {
	if (@file_put_contents('./lctest.dat','LuxCal') === false) { //write test file
		$errMsg[] = "Writing to the calendar's root folder<br>Check file permissions on your server\n";
	} else {
		unlink('./lctest.dat'); //delete test file
		$okiMsg[] = "Writing to the calendar's root folder\n";
	}
	if (@file_put_contents('./files/lctest.dat','LuxCal') === false) { //write test file
		$errMsg[] = "Writing to the 'files' folder<br>Check file permissions on your server\n";
	} else {
		unlink('./files/lctest.dat'); //delete test file
		$okiMsg[] = "Writing to the 'files' folder\n";
	}
	//create empty sql.log
	if (@file_put_contents('./logs/sql.log','') === false) {
		$errMsg[] = "Writing an empty sql.log file to the 'logs' folder<br>Check file permissions on your server\n";
	} else {
		$okiMsg[] = "Writing an empty sql.log file to the 'logs' folder\n";
	}
	//create empty luxcal.log
	if (@file_put_contents('./logs/luxcal.log','') === false) {
		$errMsg[] = "Writing an empty luxcal.log file to the 'logs' folder<br>Check file permissions on your server\n";
	} else {
		$okiMsg[] = "Writing an empty luxcal.log file to the 'logs' folder\n";
	}
}

if ($install and empty($errMsg)) {
	//prepare db data
	$adPwMd5 = trim($adPwrd) == '********' ? $adPwMd5 : md5($adPwrd);
	foreach ($allCals as $name => $title) { //check / create calendar tables
		//connect to db
		if (!$dbH = dbConnect($name,0)) {
			$errMsg[] = "Calendar $name - Problem connecting to calendar<br>Check your database permissions\n";
			break;
		}
		//if not present, create tables
		$tabEve = $tabCat = $tabUsr = $tabGrp = $tabSet = true; //init
		if (getTables('events') == false) { $tabEve = createDbTable('events'); }
		if (getTables('categories') == false) { $tabCat = createDbTable('categories'); }
		if (getTables('users') == false) { $tabUsr = createDbTable('users'); }
		if (getTables('groups') == false) { $tabGrp = createDbTable('groups'); }
		if (getTables('settings') == false) { $tabSet = createDbTable('settings'); }
		//insert initial data in cat, user and settings tables
		$catSaved = $usrSaved = $setSaved = false; //init
		if ($tabCat) { $catSaved = initCats(); }
		if ($tabUsr) { $usrSaved = initUsers($adName,$adMail,$adPwMd5); }
		if ($tabGrp) { $grpSaved = initGroups(); }
		if ($tabSet) {
			$dbSet = array();
			$dbSet['calendarTitle'] = $title;
			$dbSet['calendarUrl'] = calBaseUrl().'?cal='.$name;
			$dbSet['calendarEmail'] = $adMail;
			checkSettings($dbSet);
			$setSaved = saveSettings($dbSet);
		}
		$dbH = null; //close db
		if (!$tabEve or !$tabCat or !$tabUsr or !$tabGrp or !$tabSet) {
			$errMsg[] = "Calendar: $name - Problem creating tables<br>Check your database permissions\n";
			break;
		}
		if (!$catSaved) {
			$errMsg[] = "Calendar: $name - Can not save initial data in the Categories table<br>Check your database permissions.\n";
			break;
		}
		if (!$usrSaved) {
			$errMsg[] = "Calendar: $name - Can not save initial data in the Users table<br>Check your database permissions.\n";
			break;
		}
		if (!$grpSaved) {
			$errMsg[] = "Calendar: $name - Can not save initial data in the Groups table<br>Check your database permissions.\n";
			break;
		}
		if (!$setSaved) {
			$errMsg[] = "Calendar: $name - Can not save default calendar settings in the Settings table. Check database permissions.</p>\n";
			break;
		}
	}

	if (empty($errMsg)) {
		//save configuration
		$dbDef = $defCal;
		saveConfig(); //save LuxCal version and db data
		
		session_unset(); //force retrieve of settings and selection of default calendar

		//installation successful
		echo "<div class='centerBox'>\n";
		echo "<div class='resultBox'>\n";
		echo ($newCals ? $installOk : $saveOk);
		echo "<br><div class='center'>\n";
		echo "<input type='button' onclick=\"window.location.href='{$_SERVER["PHP_SELF"]}'\" value='back to install'>\n";
		if (file_exists('./lctools.php')) {
			echo "<input type='button' onclick=\"window.location.href='lctools.php'\" value='start tools'>\n";
		}
		echo "<input type='button' onclick=\"window.location.href='index.php?cal={$defCal}'\" value='start calendar'>\n";
		echo "</div>\n</div>\n</div>\n";
	}
}

if (!$install or !empty($errMsg) ) { //display form
	//display header
	echo $instructions;
	echo "<div class='centerBox'>\n";
	if (!empty($errMsg)) {
		echo "<h5>Tests failed:</h5>\n";
		echo "<ul>\n";
		foreach ($errMsg as $msg) { echo "<li class='hilite'>{$msg}</li>\n"; }
		echo "</ul>\n";
	}
	if ($test and !empty($okiMsg)) {
		echo "<h5>Tests passed:</h5>\n";
		echo "<ul>\n";
		foreach ($okiMsg as $msg) { echo "<li class='lolite'>{$msg}</li>\n"; }
		echo "</ul>\n<br>\n";
	}
	if (empty($errMsg)) {
		if ($test) {
			echo "<p class='center'>Select 'install/save' to install the calendar(s) and to save the credentials.</p>\n";
		} else {
			echo "<p class='center'>Complete this form to configure/install the LuxCal Event Calendar.\n";
			echo "<br>Select 'test' to validate the form fields and select 'install/save' to continue.</p>\n";
		}
	} else {
		echo "<p class='center'>Correct/solve the errors/failures and test again.</p>\n";
	}
	
	//display form
	echo "<br>\n";
	echo "<form class='form' action= '".htmlentities($_SERVER['PHP_SELF'])."' method='post'>\n";
	echo "<input type='hidden' name='adPwMd5' value='{$adPwMd5}'>\n";
	echo "<h4 class='hilite center'>= read instructions =</h4>\n";
	echo "<table>\n";
	echo "<col class='col1'><col class='col2'>";
	echo "<tr><td colspan='2'><h5>Calendars</h5></td></tr>\n";
	echo "<tr><td>New to install:<br>(name = title)</td><td><textarea{$dbNerror} rows='2' name='newCals'>{$newCals}</textarea></td></tr>\n";
	echo "<tr><td>Default calendar:</td><td><input type='text'{$dbDerror} name='defCal' maxlength='15' value='{$defCal}'></td></tr>\n";
	echo "<tr><td>Database folder:</td><td><input type='text'{$dbFerror} name='dbFolder' value='{$dbDir}'><br>&nbsp;</td></tr>\n";
	echo "<tr><td>Installed:<br>(name = title)</td><td>{$curCalList}&nbsp;</td></tr>\n";
	echo "<tr><td colspan='2'><br><h5>Administrator</h5></td></tr>\n";
	echo "<tr><td>Name:</td><td><input type='text'{$adNerror} name='adNameP' value='{$adName}'></td></tr>\n";
	echo "<tr><td>Email:</td><td><input type='text'{$adEerror} name='adMailP' value='{$adMail}'></td></tr>\n";
	echo "<tr><td>Password:</td><td><input type='text'{$adPerror} name='adPwrdP' value='{$adPwrd}'></td></tr>\n";
	echo "</table>\n";
	echo "<br>\n";
	echo "<div class='center'>\n";
	echo "<input type='submit' name='test' value='test'>\n";
	if ($test and empty($errMsg)) {
		echo "<input type='submit' name='install' value='install/save'>\n";
	}
	echo "</div>\n";
	echo "</form>\n";
	echo "</div>\n";
}
?>
</div>
<div class="bLine mark"><h4>AFTER USE MAKE THE FILE <?php echo basename(__FILE__); ?> INACCESSIBLE OR REMOVE IT FROM THE SERVER !</h4></div>
<div class="endBar">
	design 2016 - powered by <a href="http://www.luxsoft.eu"><span class="footLB">Lux</span><span class="footLR">Soft</span></a>
</div>
<br>&nbsp;
</body>
</html>
