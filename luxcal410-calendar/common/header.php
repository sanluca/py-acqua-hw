<?php
/*
= Header for the LuxCal calendar pages =

© Copyright 2009-2014 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.

The LuxCal Web Calendar is free software: you can redistribute it and/or modify it under 
the terms of the GNU General Public License as published by the Free Software Foundation, 
either version 3 of the License, or (at your option) any later version.

The LuxCal Web Calendar is distributed in the hope that it will be useful, but WITHOUT 
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A 
PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with the LuxCal 
Web Calendar. If not, see: http://www.gnu.org/licenses/.
*/

//sanity check
if (empty($lcV)) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); } //launch via script only

//functions
function headerTop() {
echo "<style>
.content {margin-top:-48px;}
</style>";
}

function headerRss() {
global $set, $privs, $cF;

if ($privs > 0 and $set['rssFeed']) {
	echo '<link rel="alternate" type="application/rss+xml" title="LuxCal RSS Feed" href="http://'.$_SERVER['SERVER_NAME'].rtrim(dirname($_SERVER["PHP_SELF"]),'/').'/rssfeed.php'.$cF.'">'."\n";
}
}

function headerDtp() { //used by dtpicker.js
global $xx, $set, $mode, $months, $wkDays_m;

echo "<script>
var mode = \"{$mode}\";
var tFormat = \"{$set['timeFormat']}\";
var dFormat = \"{$set['dateFormat']}\";
var wStart = {$set['weekStart']};
var dwStartH = {$set['dwStartHour']};
var dwEndH = {$set['dwEndHour']};
var dpToday = \"{$xx['hdr_today']}\";
var dpClear = \"{$xx['hdr_clear']}\";
var dpMonths = new Array('",implode("','",$months),"');
var dpWkdays = new Array('",implode("','",$wkDays_m),"');
var dwTimeSlot = {$set['dwTimeSlot']};
</script>\n";
}

function admMenu() {
	global $xx, $cP, $privs;

	if ($privs >= 4) { //manager or admin rights
		echo "<select title=\"{$xx['hdr_select_admin_functions']}\" name='views' onchange='jumpMenu(this)'>
		<option value='#'>{$xx['hdr_admin']}&nbsp;</option>\n";
		if ($privs == 4) { //manager
			echo "<option value='index.php?lc&amp;cP=91'".($cP == "91" ? " selected='selected'>" : '>').$xx['hdr_categories']."</option>
			<option value='index.php?lc&amp;cP=92'".($cP == "92" ? " selected='selected'>" : '>').$xx['hdr_users']."</option>
			<option value='index.php?lc&amp;cP=93'".($cP == "93" ? " selected='selected'>" : '>').$xx['hdr_groups']."</option>\n";
		} else { //admin
			echo "<option value='index.php?lc&amp;cP=90'".($cP == "90" ? " selected='selected'>" : '>').$xx['hdr_settings']."</option>
<option value='index.php?lc&amp;cP=91'".($cP == "91" ? " selected='selected'>" : '>').$xx['hdr_categories']."</option>
<option value='index.php?lc&amp;cP=92'".($cP == "92" ? " selected='selected'>" : '>').$xx['hdr_users']."</option>
<option value='index.php?lc&amp;cP=93'".($cP == "93" ? " selected='selected'>" : '>').$xx['hdr_groups']."</option>
<option value='index.php?lc&amp;cP=94'".($cP == "94" ? " selected='selected'>" : '>').$xx['hdr_database']."</option>
<option value='index.php?lc&amp;cP=95'".($cP == "95" ? " selected='selected'>" : '>').$xx['hdr_import_ics']."</option>
<option value='index.php?lc&amp;cP=96'".($cP == "96" ? " selected='selected'>" : '>').$xx['hdr_export_ics']."</option>
<option value='index.php?lc&amp;cP=97'".($cP == "97" ? " selected='selected'>" : '>').$xx['hdr_import_csv']."</option>\n";
		}
		echo "</select> \n";
	}
}

function headerHdr() {
	global $set, $uname;

	echo "<header>
<span class='floatL'>{$set['calendarTitle']}</span><span class='floatR'>{$uname}</span><span class='noPrint'>".makeD(date("Y-m-d"),5)."</span>
</header>\n";
}

function calButton () {
	global $xx;

	echo "<button type='button' title=\"{$xx['hdr_back_to_cal']}\" onclick=\"window.location.href='index.php?lc&amp;cP=0'\">{$xx['hdr_calendar']}</button>\n";
}

function prtButton () {
	global $xx;

	if (!$_SESSION['mobile']) {
		echo "<button type='button' title=\"{$xx['hdr_print_page']}\" onclick='printNice();'>{$xx['hdr_button_print']}</button>\n";
	}
}

function tdlButton () {
	global $xx, $set;

	if ($set['navTodoList']) {
		echo "<button type='button' title=\"{$xx['hdr_todo_list']}\" onclick=\"show('taskBar')\">".($set['navButText'] ? $xx['hdr_button_todo'] : '&nbsp;&#8801;&nbsp;')."</button>\n";
	}
}

function upcButton () {
	global $xx, $set;

	if ($set['navUpcoList']) {
		echo "<button type='button' title=\"{$xx['hdr_upco_list']}\" onclick=\"show('upcoBar')\">".($set['navButText'] ? $xx['hdr_button_upco'] : '&nbsp;&#8804;&nbsp;')."</button>\n";
	}
}

function srcButton() {
	global $xx, $set;

	echo "<button type='button' title=\"{$xx['hdr_search']}\" onclick=\"window.location.href='index.php?lc&amp;cP=21'\">".($set['navButText'] ? $xx['hdr_button_search'] : '&nbsp;&#916;&nbsp;')."</button>\n";
}

function addButton() {
	global $xx, $set, $privs;

	if ($privs > 1) { //post rights
		echo "<button type='button' title=\"{$xx['hdr_add_event']}\" onclick=\"newE();\">".($set['navButText'] ? $xx['hdr_button_add'] : '&nbsp;+&nbsp;')."</button>\n";
	}
}

function hlpButton() {
	global $xx, $set;

	echo "<button type='button' title=\"{$xx['hdr_help']}\" onclick=\"help();\">".($set['navButText'] ? $xx['hdr_button_help'] : '&nbsp;?&nbsp;')."</button>\n";
}

function logButton() {
	global $xx;

	if ($_SESSION['uid'] == 1) { //public user
		echo "<button type='button' onclick='login()'>{$xx['hdr_button_log_in']}</button>\n";
	} else { //known user
		echo "<button type='button' onclick='logout()'>{$xx['hdr_button_log_out']}</button>\n";
	}
}

function urlButton() {
	global $xx, $set;

	if ($set['backLinkUrl']) {
		echo "<button type='button' title=\"{$xx['hdr_button_back']}\" onclick=\"window.location.href='{$set['backLinkUrl']}';\">{$xx['back']}</button>\n";
	}
}

function optButton() {
	global $xx;

	echo "<button type='button' title=\"{$xx['hdr_options_panel']}\" onclick=\"toggleLabel(this,'{$xx['hdr_button_options']}','{$xx['done']}'); show('optPanel','optMenu')\">{$xx['hdr_button_options']}</button>\n";
}

function dateForm() {
	global $xx;

	echo "<form class='inline' method='post' id='gotoD' name='gotoD' action='index.php?lc'>
		<input type='hidden' name='token' value='{$_SESSION['token']}'>
		<input style='width:62px;' type='text' name='nD' id='nD' value='".IDtoDD($_SESSION['cD'])."'>
		<button type='button' title=\"{$xx['hdr_select_date']}\" onclick=\"dPicker(0,'gotoD','nD');return false;\">&larr;</button>
	</form>\n";
}

function optPanel() { //make options panel
	global $xx, $set, $privs, $ucats, $cP, $xU, $dbDir, $dbSel;

	echo "<div id='optPanel'>
<h4 class='floatC'>{$xx['hdr_options_submit']}</h4>
<form name='optMenu' action='index.php?lc' method='post'>\n
<input type='hidden' name='token' value='{$_SESSION['token']}'>";
//	if ($dbSel) {
	if ($dbSel and $privs == 9) { //get calendar database IDs
		if (isset($_SESSION['calIDs']) and count($_SESSION['calIDs']) > 1) { //more than 1 calendar
			echo "<div class='option'>\n<div class='optHead'>{$xx['hdr_calendar']}</div>\n<div class='optList'>\n";
			foreach ($_SESSION['calIDs'] as $cal) {
				$checked = ($_SESSION['cal'] == $cal) ? " checked='checked'" : '';
				echo "<input type='checkbox' id='{$cal}' name='cal' value='{$cal}' onclick=\"check1('cal',this);\"{$checked}><label for='{$cal}'>".$cal."</label><br>\n";
			}
			echo "</div>\n</div>\n";
		}
	}
	echo "<div class='option'>\n<div class='optHead'>{$xx['hdr_view']}</div>\n<div class='optList'>
<input type='checkbox' id='cP1' name='cP' value='1' onclick=\"check1('cP',this);\"".($cP == "1" ? " checked='checked'" : '')."><label for='cP1'>{$xx['hdr_year']}</label><br>
<input type='checkbox' id='cP2' name='cP' value='2' onclick=\"check1('cP',this);\"".($cP == "2" ? " checked='checked'" : '')."><label for='cP2'>{$xx['hdr_month_full']}</label><br>
<input type='checkbox' id='cP3' name='cP' value='3' onclick=\"check1('cP',this);\"".($cP == "3" ? " checked='checked'" : '')."><label for='cP3'>{$xx['hdr_month_work']}</label><br>
<input type='checkbox' id='cP4' name='cP' value='4' onclick=\"check1('cP',this);\"".($cP == "4" ? " checked='checked'" : '')."><label for='cP4'>{$xx['hdr_week_full']}</label><br>
<input type='checkbox' id='cP5' name='cP' value='5' onclick=\"check1('cP',this);\"".($cP == "5" ? " checked='checked'" : '')."><label for='cP5'>{$xx['hdr_week_work']}</label><br>
<input type='checkbox' id='cP6' name='cP' value='6' onclick=\"check1('cP',this);\"".($cP == "6" ? " checked='checked'" : '')."><label for='cP6'>{$xx['hdr_day']}</label><br>
<input type='checkbox' id='cP7' name='cP' value='7' onclick=\"check1('cP',this);\"".($cP == "7" ? " checked='checked'" : '')."><label for='cP7'>{$xx['hdr_upcoming']}</label><br>
<input type='checkbox' id='cP8' name='cP' value='8' onclick=\"check1('cP',this);\"".($cP == "8" ? " checked='checked'" : '')."><label for='cP8'>{$xx['hdr_changes']}</label>
</div>\n</div>\n";
	if ($set['userMenu'] and $_SESSION['uid'] > 1) {
		echo "<div class='option'>\n<div class='optHead'>{$xx['hdr_users']}</div>\n<div class='optList'>\n";
		$stH = stPrep("SELECT u.ID, u.name, g.color FROM users AS u INNER JOIN groups AS g ON g.ID = u.groupID WHERE u.status >= 0 ORDER BY u.name");
		if (stExec($stH,null)) {
			echo "<input type='checkbox' id='cU0' name='cU[]' value='0' onclick=\"checkZ('cU',this);\"".(in_array(0, $_SESSION['cU']) ? " checked='checked'" : '')."><label for='cU0'>{$xx['hdr_all_users']}</label><br>\n";
			while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
				$xuID = $row['ID'];
				$checked = in_array($xuID, $_SESSION['cU']) ? " checked=\"checked\"" : "";
				$userColor = ($row['color']) ? " style='background-color:{$row['color']};'" : '';
				echo "<input type='checkbox' id='cU{$xuID}' name='cU[]' value='{$xuID}' onclick=\"checkN('cU',this);\"{$checked}><label for='cU{$xuID}'{$userColor}>{$row['name']}</label><br>\n";
			}
		}
		echo "</div>\n</div>\n";
	}
	if ($set['catMenu']) {
		echo "<div class='option'>\n<div class='optHead'>{$xx['hdr_categories']}</div>\n<div class='optList'>\n";
		$where = ' WHERE status >= 0'.($_SESSION['uid'] == 1 ? " AND public > 0" : "");
		$stH = stPrep("SELECT ID, name, sequence, color, bgcolor FROM categories".$where." ORDER BY sequence");
		if (stExec($stH,null)) {
			echo "<input type='checkbox' id='cC0' name='cC[]' value='0' onclick=\"checkZ('cC',this);\"".(in_array(0, $_SESSION['cC']) ? " checked='checked'" : '')."><label for='cC0'>{$xx['hdr_all_cats']}</label><br>\n";
			while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
				if ($ucats == '0' or in_array($row['ID'],explode(',',$ucats))) {
					$xC = $row['sequence'];
					$checked = in_array($xC, $_SESSION['cC']) ? " checked='checked'" : '';
					$catColor = ($row['color'] ? "color:{$row['color']};" : '').($row['bgColor'] ? "background-color:{$row['bgColor']};" : '');
					echo "<input type='checkbox' id='cC{$xC}' name='cC[]' value='{$xC}' onclick=\"checkN('cC',this);\"{$checked}><label for='cC{$xC}'".($catColor ? " style=\"".$catColor."\"" : "").">{$row['name']}</label><br>\n";
				}
			}
		}
		echo "</div>\n</div>\n";
	}
	if ($set['langMenu']) {
		echo "<div class='option'>\n<div class='optHead'>{$xx['hdr_lang']}</div>\n<div class='optList'>\n";
		$files = scandir("lang/");
		foreach ($files as $file) {
			if (substr($file, 0, 3) == "ui-") {
				$lang = strtolower(substr($file,3,-4));
				$checked = (strtolower($_SESSION['cL']) == $lang) ? " checked='checked'" : '';
				echo "<input type='checkbox' id='{$lang}' name='cL' value='{$lang}' onclick=\"check1('cL',this);\"{$checked}><label for='{$lang}'>".ucfirst($lang)."</label><br>\n";
			}
		}
		echo "</div>\n</div>\n";
	}
	echo "</form>\n</div>\n";
}

function sideBar() { //make sidebar with upcoming events
	global $xx, $set, $evtList;

	if ($set['navUpcoList']) {
		echo "<div id='upcoBar'>
			<img class='floatR point' onclick=\"show('upcoBar')\" src=\"images/close.png\" alt=\"close\">
			<div class='barHead move' onmousedown=\"dragMe('upcoBar',event)\">{$xx['hdr_upco_list']}</div>
			<div class='barBody'>\n";
		$curD = $_SESSION['cD'];
		$eTime = mktime(12,0,0,substr($curD,5,2),substr($curD,8,2),substr($curD,0,4)) + (($set['lookaheadDays']-1) * 86400); //Unix time of end date
		$eDate = date("Y-m-d", $eTime);
		retrieve($curD,$eDate,'uc');

		//display upcoming events
		if ($evtList) {
			$evtDone = array();
			$lastDate = '';
			foreach($evtList as $date => &$events) {
				foreach ($events as $evt) {
					if (!$evt['mde'] or !in_array($evt['eid'],$evtDone)) { //!mde or mde not processed
						$evtDone[] = $evt['eid'];
						$evtDate = $evt['mde'] ? makeD($evt['sda'],5)." - ".makeD($evt['eda'],5) : makeD($date,5);
						$evtTime = $evt['ald'] ? $xx['vws_all_day'] : ITtoDT($evt['sti']).($evt['eti'] ? ' - '.ITtoDT($evt['eti']) : '');
						$details = ($set['details4All'] == 1 or ($set['details4All'] == 2 and $_SESSION['uid'] > 1) or $evt['mayE']);
						$onClick = $details ? " class='point' onclick=\"editE({$evt['eid']},'{$date}');\"" : " class='arrow'";
						if ($set['eventColor']) {
							$eStyle = ($evt['cco'] ? "color:{$evt['cco']};" : '').($evt['cbg'] ? "background-color:{$evt['cbg']};" : '');
						} else {
							$eStyle = ($evt['uco'] ? "background-color:{$evt['uco']};" : '');
						}
						$eStyle = $eStyle ? " style='{$eStyle}'" : '';
						echo $lastDate != $evtDate ? "<h6>{$evtDate}</h6>\n" : '';
						echo "<p>{$evtTime}</p><p{$onClick}{$eStyle}>&nbsp;&nbsp;{$evt['tit']}</p><br>\n";
						$lastDate = $evtDate;
					}
				}
			}
		} else {
			echo $xx['none']."\n";
		}
		echo "</div>\n</div>\n";
	}
}

function todoList() { //make sidebar with todo list
	global $xx, $set, $privs, $evtList;
	
	if ($set['navTodoList']) {
		echo "<div id='taskBar'>
			<img class='floatR point' onclick=\"show('taskBar')\" src='images/close.png' alt='close'>
			<div class='barHead move' onmousedown=\"dragMe('taskBar',event)\">{$xx['hdr_todo_list']}</div>\n
			<div class='barBody'>\n";
		$curD = $_SESSION['cD'];
		$curT = mktime(12,0,0,substr($curD,5,2),substr($curD,8,2),substr($curD,0,4)); //current Unix time
		$startD = date("Y-m-d", $curT - (30 * 86400)); //current date - 1 month
		$endD = date("Y-m-d", $curT + (($set['lookaheadDays']-1) * 86400)); //current date + look ahead nr of days
		$filter = '(c.checkBx = 1)'; //events in cat with a check mark
		retrieve($startD,$endD,'u',$filter);

		//display todo list
		if ($evtList) {
			foreach($evtList as $date => &$events) {
				echo "<h6>".makeD($date,5)."</h6>\n";
				foreach ($events as $evt) {
					$evtTime = $evt['ald'] ? $xx['vws_all_day'] : ITtoDT($evt['sti']).($evt['eti'] ? ' - '.ITtoDT($evt['eti']) : '');
					$onClick = ($set['details4All'] == 1 or ($set['details4All'] == 2 and $_SESSION['uid'] > 1) or $evt['mayE']) ? " class='point' onclick=\"editE({$evt['eid']},'{$date}');\"" : " class='arrow'";
					if ($set['eventColor']) {
						$eStyle = ($evt['cco'] ? "color:{$evt['cco']};" : '').($evt['cbg'] ? "background-color:{$evt['cbg']};" : '');
					} else {
						$eStyle = ($evt['uco'] ? "background-color:{$evt['uco']};" : '');
					}
					$eStyle = $eStyle ? " style='{$eStyle}'" : '';
					$checkBx = '';
					if ($evt['cbx']) { $checkBx .= strpos($evt['chd'], $date) ? $evt['cmk'] : '&#x2610;'; }
					if ($checkBx) {
						$mayCheck = ($privs > 3 or ($privs > 1 and $evt['uid'] == $_SESSION['uid'])) ? true : false;
						$attrib = $mayCheck ? "class='chkBox floatL point' onclick=\"checkE({$evt['eid']},'{$date}');\" title=\"{$xx['vws_check_mark']}\"" : "class='chkBox floatL arrow'";
						$checkBx = "<div {$attrib}>".trim($checkBx)."</div>";
					}
					echo "<p>{$evtTime}</p>\n{$checkBx}<p{$onClick}{$eStyle}>&nbsp;&nbsp;{$evt['tit']}</p><br>\n";
				}
			}
		} else {
			echo $xx['none']."\n";
		}
		echo "</div>\n</div>\n";
	}
}

//start of HTML header
echo "<!DOCTYPE html>
<html lang=\"".ISOCODE."\">\n";
echo <<<TXT
<head>
<meta charset="utf-8">
<title>{$set['calendarTitle']}</title>
<meta name="description" content="LuxCal web calendar - a LuxSoft product">
<meta name="author" content="Roel Buining">
<meta name="robots" content="nofollow">
<link rel="icon" href="lcal.png" type="image/png">
<link rel="stylesheet" href="css/css.php" type="text/css">
<script src="common/toolbox.js"></script>\n
TXT;

switch ($hdrType) { //header types - 0: no, f: full, a: admin, l: login, m: mobile, e: event. h: help
	case '0': //no header (hdr=0)
		headerTop();
		headerDtp();
		echo <<<TXT
</head>\n
<body>
				
<div class='content'>\n
TXT;
		if ($pageTitle) echo "<br><h3 class='pageTitle'>{$pageTitle}</h3>\n";
		break;
	case 'f': //normal pages
		headerRss();
		headerDtp();
		echo <<<TXT
<script src="common/dtpicker.js"></script>
</head>\n
<body>\n
TXT;
		headerHdr();
		if ($privs > 0) { //view rights
			echo "<div class='navBar noPrint'>\n";
			echo "<div class='floatR'>\n";
			prtButton();
			admMenu();
			tdlButton();
			upcButton();
			srcButton();
			addButton();
			hlpButton();
			logButton();
			echo "</div>\n";
			urlButton();
			optButton();
			dateForm();
			echo "</div>\n";
			optPanel();
			sideBar(); //make side bar with upcoming events
			todoList(); //make side bar with todo list
		} else { //display dummy navbar
			echo <<<TXT
<div class='navBar noPrint'>
&nbsp;<div class='floatR'>
<button type='button' onclick="login()">{$xx['hdr_button_log_in']}</button>
</div>
</div>\n
TXT;
		}
		echo "<div class='content'>\n";
		if ($pageTitle) echo "<br><h3 class='pageTitle'>{$pageTitle}</h3>\n";
		break;
	case 'a': //admin pages
		headerDtp();
		echo <<<TXT
<script src="common/dtpicker.js"></script>
<script src="common/cpicker.js"></script>
</head>\n
<body>\n
TXT;
		headerHdr();
		echo "<div class='navBar noPrint'>\n";
		echo "<div class='floatR'>\n";
		calButton();
		prtButton();
		admMenu();
		hlpButton();
		logButton();
		echo "</div>\n";
		optButton();
		echo "</div>\n";
		optPanel();
		echo "<div class='content'>\n";
		if ($pageTitle) echo "<br><h3 class='pageTitle'>{$pageTitle}</h3>\n";
		break;
	case 'l': //log in page
		echo <<<TXT
</head>\n
<body>\n
TXT;
		headerHdr();
		echo "<div class='navBar'>&nbsp;</div>\n";
		echo "<div class='content'>\n";
		if ($pageTitle) echo "<br><h3 class='pageTitle'>{$pageTitle}</h3>\n";
		break;
	case 'm': //calendar pages - mobile device
		headerDtp();
		echo <<<TXT
<script src="common/dtpicker.js"></script>
</head>\n
<body>
<header>{$uname}</header>\n
TXT;
		if ($privs > 0) { //view rights
			echo "<div class='navBar noPrint'>\n";
			echo "<div class='floatR'>\n";
			addButton();
			logButton();
			echo "</div>\n";
			urlButton();
			optButton();
			dateForm();
			echo "</div>\n";
			optPanel();
		} else { //display dummy navbar
			echo <<<TXT
<div class='navBar noPrint'>
&nbsp;<div class='floatR'>
<button type='button' onclick="login()">{$xx['hdr_button_log_in']}</button>
</div>
</div>\n
TXT;
		}
		echo "<div class=\"content\">\n";
		if ($pageTitle) echo "<br><h3 class='pageTitle'>{$pageTitle}</h3>\n";
		break;
	case 'e': //event window
		headerDtp();
		echo <<<TXT
<script src="common/dtpicker.js"></script>
<script>window.onload = function() {winFit();}</script>
</head>\n
<body>
<div class='titleBar noPrint'>
{$pageTitle}<span class='floatR'><button type='button' onclick='printNice();'>{$xx['hdr_button_print']}</button></span>
</div>
<div class='contentE'>\n
TXT;
		break;
	case 'h': //help window
		$lcv = ($_SESSION['uid'] > 1) ? "<h5 class='floatC'><span class='footLB'>Lux</span><span class='footLR'>Cal</span> v".LCV."</h5>\n" : "&nbsp;\n";
		echo <<<TXT
</head>\n
<body>
<div class='titleBar'>
<h4 class='floatL'>{$pageTitle}</h4>
<img class='floatR point' onclick='javascript:self.close();' src='images/close.png' alt='close'>
{$lcv}
</div>
<div class='contentH scroll'>\n
TXT;
}
unset($hdrType);
?>
