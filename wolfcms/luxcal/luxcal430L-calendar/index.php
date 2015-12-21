<?php
/*
= LuxCal event calendar index =

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.

The LuxCal Web Calendar is free software: you can redistribute it and/or modify it under 
the terms of the GNU General Public License as published by the Free Software Foundation, 
either version 3 of the License, or (at your option) any later version.

The LuxCal Web Calendar is distributed in the hope that it will be useful, but WITHOUT 
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A 
PARTICULAR PURPOSE. See the GNU General Public License for more details.
*/

//get php toolboxes
require './common/toolboxd.php'; //database tools + LCV
require './common/toolbox.php'; //general tools

//set error reporting
//error_reporting(E_ERROR); //errors only
//ini_set('display_errors',0); ini_set('log_errors',1); //no error display
error_reporting(E_ALL); //errors, warnings and notices - test
ini_set('display_errors',1); ini_set('log_errors',1); //test

//proxies: don't cache
header("Cache-control: private");

//emulate register_globals off (deprecated as off PHP 5.3)
unregisterGlobals();

//start session
session_name('PHPSESSID');
session_start();
$sessID = session_id();

//validate GET / POST variables
validVars();

//strip slashes in case magic_quotes on (PHP < 5.4)
$_COOKIE = array_map('stripslashes', $_COOKIE);

//load config data
if (!file_exists('./lcconfig.php')) {//no current config data
	if (!file_exists('./lcaldbc.dat')) { //no config data: install
		header("Location: install".strtolower(substr(str_replace('.','',LCV),0,3)).".php"); exit();
	} else { //upgrade
		header("Location: upgrade".strtolower(substr(str_replace('.','',LCV),0,3)).".php"); exit();
	}
}
require './lcconfig.php';
if (isset($lcc)) { $lcV = $lcc; } //<V4
$nowTS = time(); //unix timestamp 

if (!isset($_GET['lc'])) { //external hit
	$_POST = array(); //reject post vars
	
	if (substr(LCV,0,6) != $lcV) { //LCV not current: upgrade
		header("Location: upgrade".strtolower(substr(str_replace('.','',LCV),0,3)).".php"); exit();
	}

	//set PHP session cookie to 30 days
	setcookie('PHPSESSID', $sessID, $nowTS+2592000);

	//set & bake calendar ID
	$calID = $_SESSION['cal'] = !empty($_GET['cal']) ? $_GET['cal'] : (isset($_COOKIE['LCALcid']) ? @unserialize($_COOKIE['LCALcid']) : $dbDef);
	setcookie('LCALcid', serialize($calID), $nowTS+2592000); //set calID cookie to 30 days

	//connect to db
	$dbH = dbConnect($calID);
	
	//get uid if user email passed by parent (SSO)
	if (!empty($_SESSION['lcUser']) or !empty($_GET['lcUser'])) {
		$stH = stPrep("SELECT `ID` FROM `users` WHERE `email` = ?");
		stExec($stH,array(empty($_SESSION['lcUser']) ? $_GET['lcUser'] : $_SESSION['lcUser']));
		unset($_SESSION['uid'],$_SESSION['lcUser'],$_GET['lcUser']);
		$row = $stH->fetch(PDO::FETCH_NUM);
		$stH = null; //release statement handle
		if (!empty($row)) { //user id found
			$_SESSION['uid'] = $row[0];
		}
	}
	//if no SSO get user ID
	if (empty($_SESSION['uid'])) {
		$_SESSION['uid'] = isset($_COOKIE['LCALuid']) ? @unserialize($_COOKIE['LCALuid']) : 1;
	}
	//get all calender IDs
	$_SESSION['calIDs'] = getCIDs();
} else { //internal hit
	//get calendar ID
	if (empty($_SESSION)) { //session expired, get cal & user ID from cookies
		$calID = $_SESSION['cal'] = isset($_COOKIE['LCALcid']) ? @unserialize($_COOKIE['LCALcid']) : $dbDef;
		$_SESSION['uid'] = isset($_COOKIE['LCALuid']) ? @unserialize($_COOKIE['LCALuid']) : 1;
	} elseif (isset($_POST['cal'])) {	//switch cal
		$calID = $_SESSION['cal'] = $_POST['cal'];
		setcookie('LCALcid', serialize($calID), $nowTS+2592000); //set calID cookie to 30 days
	} elseif (isset($_SESSION['cal'])) { //active cal
		$calID = $_SESSION['cal'];
	}
	//connect to db
	$dbH = dbConnect($calID);
}
//get settings from database
$set = getSettings();

//set time zone
date_default_timezone_set($set['timeZone']);

if (!isset($_GET['lc'])) { //external hit
	//update login data
	$stH = stPrep("UPDATE `users` SET `login0` = CASE WHEN substr(`login0`,1,1) = '9' THEN ? ELSE `login0` END, `login1` = ?, `loginCnt` = `loginCnt` + 1 WHERE `ID` = ?");
	stExec($stH,array(date('Y-m-d'),date('Y-m-d'),$_SESSION['uid']));
}

//load last selected cP, cG, cU, cP and cL
if ($set['restLastSel'] and $_SESSION['uid'] > 1) { loadLastSel($calID); }

//after login bake is set (1:bake, -1:eat cookie)
if (isset($_REQUEST['bake'])) {
	setcookie('LCALuid', serialize($_SESSION['uid']), $nowTS+86400*$set['cookieExp']*$_REQUEST['bake']); //set or refresh
	saveLastSel($calID,$_REQUEST['bake']);
}

//check for mobile browsers
if (!isset($_SESSION['mobile'])) {
	$_SESSION['mobile'] = isMobile() > 1; //mobile small screen size
}

//set header display
if (isset($_GET['hdr'])) { $_SESSION['hdr'] = $_GET['hdr']; }
elseif (!isset($_SESSION['hdr'])) { $_SESSION['hdr'] = 1; }

//set language
if (isset($_POST["cL"])) { $_SESSION['cL'] = $_POST['cL']; }
elseif (empty($_SESSION['cL'])) { $_SESSION['cL'] = $set['language']; }
if (!file_exists('./lang/ui-'.strtolower($_SESSION['cL']).'.php')) { $_SESSION['cL'] = 'English'; }
require './lang/ui-'.strtolower($_SESSION['cL']).'.php';

//get user data & set privs
if (isset($_GET["logout"])) { $_SESSION['uid'] = 1; } //public user
$stH = stPrep("SELECT u.`ID`,u.`name`,u.`email`,g.`privs`,g.`catIDs`,g.`rEvents`,g.`mEvents`,g.`pEvents` FROM `users` AS u INNER JOIN `groups` AS g ON g.`ID` = u.`groupID` WHERE u.`ID` = 1 OR u.`ID` = ? ORDER BY u.`ID` DESC"); //if userID not found, revert to public user
stExec($stH,array($_SESSION['uid']));
$row = $stH->fetch(PDO::FETCH_NUM);
list($uid,$uname,$umail,$privs,$ucats,$revts,$mevts,$pevts) = $row; //user & group data
$row = $stH->fetch(PDO::FETCH_NUM);
$pcats = $row != false ? $row[4] : ''; //public view categories
$stH = null; //release statement handle

if ($uid == 1) { //public user
	$_SESSION['uid'] = 1;
	$uname = $xx['idx_public_name'];
}

//set current page
if (isset($_REQUEST['cP'])) { $_SESSION['cP'] = intval($_REQUEST['cP']); }
if (empty($_SESSION['cP'])) { $_SESSION['cP'] = $set['defaultView']; }
$cP = (isset($_GET['xP'])) ? $_GET['xP'] : $_SESSION['cP']; //$xP: don't store in session
if (!$privs){ $cP = 20; } //no access: force login

//set group filter
if (isset($_REQUEST['cG'])) { $_SESSION['cG'] = $_REQUEST['cG']; }
elseif (!isset($_SESSION['cG'])) { $_SESSION['cG'] = array(0); }

//set user filter
if (isset($_REQUEST['cU'])) { $_SESSION['cU'] = $_REQUEST['cU']; }
elseif (!isset($_SESSION['cU'])) { $_SESSION['cU'] = array(0); }

//set category filter
if (isset($_REQUEST['cC'])) { $_SESSION['cC'] = $_REQUEST['cC']; }
elseif (!isset($_SESSION['cC'])) { $_SESSION['cC'] = array(0); }

//set current date
if (isset($_REQUEST['nD'])) { $_SESSION['cD'] = $_SESSION['nD'] = DDtoID($_REQUEST['nD']); }
elseif (isset($_GET['cD'])) { $_SESSION['cD'] = !empty($_GET['cD']) ? $_GET['cD'] : date("Y-m-d"); }
elseif (empty($_SESSION['cD'])) { $_SESSION['cD'] = date("Y-m-d"); }

//set rss get-method filter
$cF = "&amp;cal={$calID}";
foreach ($_SESSION['cG'] as $grp) { if ($grp) { $cF .= '&amp;cG%5B%5D='.$grp; } }
foreach ($_SESSION['cU'] as $usr) { if ($usr) { $cF .= '&amp;cU%5B%5D='.$usr; } }
foreach ($_SESSION['cC'] as $cat) { if ($cat) { $cF .= '&amp;cC%5B%5D='.$cat; } }
if ($cF) { $cF = '?'.substr($cF,5); }

if ((isset($_REQUEST['cP']) or isset($_REQUEST['cG']) or isset($_REQUEST['cU']) or isset($_REQUEST['cC']) or isset($_POST['cL'])) and $_SESSION['uid'] > 1) {
	saveLastSel($calID); //save last selected cP, cG, cU, cC, cL
}

//page definitions
//page, header, no hdr, mob hdr, footer, mob ftr, title, retrieve required, spec. attributes
$pages = array (
	 '1' => array ('views/year.php','f','0','m','f','0','','y',''),
	 '2' => array ('views/month.php','f','0','m','f','0','','y','fm'),
	 '3' => array ('views/month.php','f','0','m','f','0','','y','wm'),
	 '4' => array ('views/week.php','f','0','m','f','0','','y','fw'),
	 '5' => array ('views/week.php','f','0','m','f','0','','y','ww'),
	 '6' => array ('views/day.php','f','0','m','f','0','','y',''),
	 '7' => array ('views/upcoming.php','f','0','m','f','0',$xx['title_upcoming'],'y',''),
	 '8' => array ('views/changes.php','f','0','m','f','0',$xx['title_changes'],'y',''),

	'10' => array ('pages/event.php','e','e','e','0','0',$xx['title_event'],'y',''),
	'11' => array ('pages/eventcheck.php','e','e','e','0','0',$xx['title_check_event'],'',''),

	'20' => array ('pages/login.php','l','l','l','f','0',$xx['title_log_in'],'',''),
	'21' => array ('pages/search.php','a','a','a','f','0',$xx['title_search'],'y',''),
	'22' => array ('lang/ug-'.strtolower($_SESSION['cL']).'.php','h','h','h','0','0',$xx['title_user_guide'],'',''),

	'90' => array ('pages/settings.php','a','a','a','f','0',$xx['title_settings'],'',''),
	'91' => array ('pages/categories.php','a','a','a','f','0',$xx['title_edit_cats'],'',''),
	'92' => array ('pages/users.php','a','a','a','f','0',$xx['title_edit_users'],'',''),
	'93' => array ('pages/groups.php','a','a','a','f','0',$xx['title_edit_groups'],'',''),
	'94' => array ('pages/database.php','a','a','a','f','0',$xx['title_manage_db'],'',''),
	'95' => array ('pages/importICS.php','a','a','a','f','0',$xx['title_ics_import'],'',''),
	'96' => array ('pages/exportICS.php','a','a','a','f','0',$xx['title_ics_export'],'y',''),
	'97' => array ('pages/importCSV.php','a','a','a','f','0',$xx['title_csv_import'],'','')
);

if (!array_key_exists($_SESSION['cP'],$pages)) { $_SESSION['cP'] = $set['defaultView']; } //validate cP

$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : $pages[$cP][8]; //get mode

if (empty($_SESSION['token'])) {
	$_SESSION['token'] = md5(rand()); //set one-time token
}

$pageTitle = $pages[$cP][6];
//echo "LuxCal version: ".LCV."<br>"; print_r($set); die;//TEST LINE

if ($pages[$cP][7]) { //retrieve required
	require './common/retrieve.php';
}

/* build calendar page */
$hdrType = $_SESSION['hdr'] == 0 ? $pages[$cP][2] : (($_SESSION['mobile']) ? $pages[$cP][3] : $pages[$cP][1]);
$ftrType = $_SESSION['mobile'] ? $pages[$cP][5] : $pages[$cP][4]; //set footer type
require './common/header.php'; //header
require './'.$pages[$cP][0]; //body
require './common/footer.php'; //footer
?>
