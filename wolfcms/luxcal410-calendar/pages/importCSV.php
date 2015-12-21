<?php
/*
= CSV event file import script =

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

//initialize
$adminLang = (file_exists('./lang/ai-'.strtolower($_SESSION['cL']).'.php')) ? $_SESSION['cL'] : "English";
require './lang/ai-'.strtolower($adminLang).'.php';

$birthdayID = (isset($_POST['birthdayID'])) ? $_POST['birthdayID'] : '';
$dFormat = (isset($_POST['dFormat'])) ? $_POST['dFormat'] : 'y-m-d';
$tFormat = (isset($_POST['tFormat'])) ? $_POST['tFormat'] : 'h:m';

/* sub-functions */

function processEvtFields(&$sDate,&$eDate,&$sTime,&$eTime,&$title,&$catID) {
	global $dFormat, $tFormat;
	
	//Get calendar category ids
	$catIDs = array();
	$stH = stPrep("SELECT ID FROM categories WHERE status >= 0");
	if (stExec($stH,null) !== false) {
 		while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
			$catIDs[] = $row['ID'];
		}
	}
	//Processing
	$errors = 0;
	$nofDates = count($sDate);
	for ($i = 0; $i < $nofDates; $i++) {
		$error = 0;
		if (($IsDate = DDtoID($sDate[$i],$dFormat)) === false) { $error++; }
		if (($IeDate = DDtoID($eDate[$i],$dFormat)) === false) { $error++; }
		if (($IsTime = DTtoIT($sTime[$i],$tFormat)) === false) { $error++; }
		if (($IeTime = DTtoIT($eTime[$i],$tFormat)) === false) { $error++; }
		if (!$error) {
			if ($eDate[$i]) {
				if ($IsDate == $IeDate) { $eDate[$i] = ''; }
				elseif ($IeDate < $IsDate) {
					list($sDate[$i],$eDate[$i]) = array($eDate[$i],$sDate[$i]); //swap start and end date
				} elseif ($IeDate > $IsDate and !$IsTime and !$IeTime) { //all day
					$eDate[$i] = IDtoDD(date("Y-m-d",mktime(12,0,0,substr($IeDate,5,2),substr($IeDate,8,2),substr($IeDate,0,4)) - 86400),$dFormat); //-1 day
				}
			}
			if (!$sTime[$i] and $eTime[$i]) { $sTime[$i] = $eTime[$i]; }
			if ($sTime[$i] == $eTime[$i]) { $eTime[$i] = ''; }
			if ($eTime[$i]) {
				if ($IeTime < $IsTime) {
					list($sTime[$i],$eTime[$i]) = array($eTime[$i],$sTime[$i]); //swap start and end time
				}
			}
		}
		$errors += $error;
		if (!$title[$i]) { $errors++; } //title empty
		if (!in_array($catID[$i], $catIDs)) { $catID[$i] = 0; } //reset non-existing category IDs
	}
return $errors;
}

function eventInDb($title,$sDate,$eDate,$sTime,$eTime) {
	/* test if event present in db */
	$q =
	"SELECT
		title
	FROM events
	WHERE
		status >= 0 AND title = ? AND sDate = ? AND eDate = ? AND sTime = ? AND eTime = ?
	";
	$stH = stPrep($q);
	stExec($stH,array($title,$sDate,$eDate,$sTime,$eTime));
	$row = $stH->fetch(PDO::FETCH_ASSOC);
	$stH = null;
	return (!empty($row) ? true : false);
}


/* main-functions */

function instructions() {
	global $ax;
	
	echo "<aside class='aside'>\n{$ax['xpl_import_csv']}
		<table class='list'>
		<tr><th style='width:auto;'>ID</th><th style='width:auto;'>{$ax['iex_category']}</th></tr>\n";
	$stH = stPrep("SELECT ID, name FROM categories WHERE status >= 0 ORDER BY ID");
	if (stExec($stH,null) === false) { echo $ax['iex_db_error']; return; }
	while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr><td class='floatC'>{$row['ID']}</td><td>&nbsp;{$row['name']}</td></tr>\n";
	}
	echo "</table>\n</aside>\n";
}

function uploadFile() {
	global $ax, $birthdayID, $dFormat, $tFormat;
	
	$delimiter = (isset($_POST['delimiter'])) ? $_POST['delimiter'] : ',';
	echo "<form action='index.php?lc' method='post' enctype='multipart/form-data'>
		<input type='hidden' name='token' value='{$_SESSION['token']}'>
		<input type='hidden' name='MAX_FILE_SIZE' value='1000000'>
		<fieldset><legend>{$ax['iex_upload_csv']}</legend>\n
		<table class='list'>
		<tr><td class='label'>{$ax['iex_file']}:</td><td><input type='file' name='fileName'></td></tr>
		<tr><td class='label'>{$ax['iex_fields_sep_by']}:</td><td><input type='text' name='delimiter' value='{$delimiter}' size='1'></td></tr>
		<tr><td class='label'>{$ax['iex_birthday_cat_id']}:</td><td><input type='text' name='birthdayID' value='{$birthdayID}' size='1'> ({$ax['iex_see_insert']})</td></tr>
		<tr><td class='label'>{$ax['iex_date_format']}:</td><td>
		<input type='radio' name='dFormat' id='dmy' value='d-m-y'".($dFormat == 'd-m-y' ? " checked='checked'" : '')."><label for='dmy'>{$ax['dd_mm_yyyy']}</label>&nbsp;&nbsp;&nbsp;
		<input type='radio' name='dFormat' id='mdy' value='m-d-y'".($dFormat == 'm-d-y' ? " checked='checked'" : '')."><label for='mdy'>{$ax['mm_dd_yyyy']}</label>&nbsp;&nbsp;&nbsp;
		<input type='radio' name='dFormat' id='ymd' value='y-m-d'".($dFormat == 'y-m-d' ? " checked='checked'" : '')."><label for='ymd'>{$ax['yyyy_mm_dd']}</label></td></tr>
		<tr><td class='label'>{$ax['iex_time_format']}:</td><td>
		<input type='radio' name='tFormat' id='hma' value='h:ma'".($tFormat == 'h:ma' ? " checked='checked'" : '')."><label for='hma'>{$ax['time_format_us']}</label>&nbsp;&nbsp;&nbsp;
		<input type='radio' name='tFormat' id='hm' value='h:m'".($tFormat == 'h:m' ? " checked='checked'" : '')."><label for='hm'>{$ax['time_format_eu']}</label></td></tr>
		</table>\n
		</fieldset>\n
		<input type='submit' name='uploadFile' value=\"{$ax['iex_upload_file']}\">\n
		</form>\n
		<div style='clear:right'></div>\n";
}

function processUpload() {
	global $ax, $tFormat;
	
	$fileName = $_FILES['fileName']['tmp_name'];
	if (!$fileName) { return $ax['iex_no_file_name']; } //csv file missing
	if (strlen($_POST['delimiter']) != 1) { return $ax['iex_inval_field_sep']; } //invalid field delimiter
	$csvArray = file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
 	$lineNr = 0;
	//process events from CSV file
	foreach ($csvArray as $csvLine) {
		$csvFields = explode($_POST['delimiter'],$csvLine,8);
		foreach ($csvFields as $key => $value) { $csvFields[$key] = trim($csvFields[$key],' "\''); } //remove blanks & quotes
		$lineNr++;
		if ((!empty($csvFields[2]) and !ctype_digit($csvFields[2])) and $lineNr = 1) { continue; } //flush header line
		if (empty($csvFields[0])) { continue; } //flush events without title
		if (empty($csvFields[3]) or count($csvFields) < 4) { //fields empty or too few fields
			return "{$ax['iex_csv_file_error_on_line']}: {$lineNr}";
		}
		array_push($csvFields,'','','',''); //pad to ensure 8 fields
		list($title, $venue, $cat, $sDate, $eDate, $sTime, $eTime, $desc) = $csvFields;
		$_POST['title'][] = $title;
		$_POST['venue'][] = $venue;
		$_POST['catID'][] = $cat;
		$_POST['sDate'][] = $sDate;
		$_POST['eDate'][] = $eDate;
		if (DTtoIT($sTime,$tFormat) == '00:00' and DTtoIT($eTime,$tFormat) == '23:59') { //all day
			$sTime = $eTime = '';
		}
		$_POST['sTime'][] = preg_replace('~(\d\d?:\d\d):\d\d~','$1',$sTime); //remove seconds
		$_POST['eTime'][] = preg_replace('~(\d\d?:\d\d):\d\d~','$1',$eTime); //remove seconds
		$_POST['descr'][] = $desc;
		$_POST['birthday'][] = 0;
		$_POST['ignore'][] = 0;
	}
	unlink($fileName);
	return ''; //no error
}

function displayEvents($errors) {
	global $ax, $birthdayID, $dFormat, $tFormat;
	
	echo "<p class='error'>{$ax['iex_number_of_errors']}: {$errors} ({$ax['iex_bgnd_highlighted']})</p><br>
		<h4>{$ax['iex_verify_event_list']} \"{$ax['iex_add_events']}\"</h4>
		<br>{$ax['iex_select_ignore_birthday']}<br><br>\n";
//display event list
	echo "<form action='index.php?lc' method='post'>
		<input type='hidden' name='token' value='{$_SESSION['token']}'>
		<input type='hidden' name='birthdayID' value='{$birthdayID}'>
		<input type='hidden' name='dFormat' value='{$dFormat}'>
		<input type='hidden' name='tFormat' value='{$tFormat}'>\n";
	$nofEvents = count($_POST['title']);
	echo "<table>
		<tr><th>{$ax['iex_ignore']}</th><th>{$ax['iex_birthday']}</th><th>{$ax['iex_title']}</th><th>{$ax['iex_venue']}</th><th>{$ax['iex_category']}</th><th>{$ax['iex_date']}</th><th>{$ax['iex_end_date']}</th><th>{$ax['iex_start_time']}</th><th>{$ax['iex_end_time']}</th><th>{$ax['iex_description']}</th></tr>\n";
	for ($i = 0; $i < $nofEvents; $i++) {
		$tic = (!$_POST['title'][$i]) ? " class='inputError'" : '';
		$sdc = (DDtoID($_POST['sDate'][$i],$dFormat) === false) ? ' inputError' : '';
		$edc = (($_POST['eDate'][$i]) and (DDtoID($_POST['eDate'][$i],$dFormat) === false)) ? ' inputError' : '';
		$stc = (DTtoIT($_POST['sTime'][$i],$tFormat) === false) ? ' inputError' : '';
		$etc = (($_POST['eTime'][$i]) and (DTtoIT($_POST['eTime'][$i],$tFormat) === false)) ? ' inputError' : '';
		echo "<tr>
			<td class='floatC'><input type='checkbox' name='ignore[{$i}]' value='1'".(empty($_POST['ignore'][$i]) ? '' : " checked='checked'")."></td>
			<td class='floatC'><input type='checkbox' name='birthday[{$i}]' value='1'".(empty($_POST['birthday'][$i]) ? '' : " checked='checked'")."></td>
			<td><input type='text'{$tic} size='20' name='title[]' value=\"".substr($_POST['title'][$i],0,64)."\"></td>
			<td><input type='text' size='20' name='venue[]' value=\"".substr($_POST['venue'][$i],0,64)."\"></td>
			<td><input class='floatC' type='text' size='2' name='catID[]' value='{$_POST['catID'][$i]}'></td>
			<td><input class='floatC{$sdc}' type='text' size='10' name='sDate[]' value='{$_POST['sDate'][$i]}'></td>
			<td><input class='floatC{$edc}' type='text' size='10' name='eDate[]' value='{$_POST['eDate'][$i]}'></td>
			<td><input class='floatC{$stc}' type='text' size='5' name='sTime[]' value='{$_POST['sTime'][$i]}'></td>
			<td><input class='floatC{$etc}' type='text' size='5' name='eTime[]' value='{$_POST['eTime'][$i]}'></td>
			<td><textarea cols='30' rows='1' name='descr[]'>{$_POST['descr'][$i]}</textarea></td>
			</tr>\n";
	}
	echo "</table>
		<br><input class='noPrint' type='submit' name='addEvents' value=\"{$ax['iex_add_events']}\">
		<button class='noPrint' type='button' onclick=\"window.location.href='index.php?lc'\">{$ax['back']}</button>
		</form>\n";
}

function addEvents() {
	global $ax, $birthdayID, $dFormat, $tFormat;

	$msg = '';
	$nofEvents = count($_POST['title']);
	$added = $dropped = 0;
	for ($i = 0; $i < $nofEvents; $i++) {
		if (empty($_POST['ignore'][$i])) {
			$title = strip_tags($_POST['title'][$i]);
			$venue = strip_tags($_POST['venue'][$i]);
			$descr = strip_tags($_POST['descr'][$i],'<a>'); //allow URLs
			$sDate = DDtoID($_POST['sDate'][$i],$dFormat);
			$eDate = ($_POST['eDate'][$i]) ? DDtoID($_POST['eDate'][$i],$dFormat) : "9999-00-00";
			$sTime = DTtoIT($_POST['sTime'][$i],$tFormat);
			$eTime = ($_POST['eTime'][$i]) ? DTtoIT($_POST['eTime'][$i],$tFormat) : "99:00:00";
			if (empty($sTime)) { //all day
				$sTime = '00:00';
				$eTime = '23:59';
			}
			$catID = ($_POST['catID'][$i]) ? $_POST['catID'][$i] : 1; //no cat
			$rType = $rInterval = $rPeriod = $rMonth = 0;
			if (!empty($_POST['birthday'][$i]) or $catID == $birthdayID) { //birthday
				$catID = $birthdayID;
				$rType = 1;
				$rInterval = 1;
				$rPeriod = 4;
				$eDate = "9999-00-00";
			}
			if (!eventInDb($title,$sDate,$eDate,$sTime,$eTime)) { //add event to db
				$q = "INSERT INTO events (title,venue,text1,catID,userID,sDate,eDate,sTime,eTime,rType,rInterval,rPeriod,rMonth,aDateTime,mDateTime) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$stH = stPrep($q);
				$result = stExec($stH,array($title,$venue,$descr,$catID,$_SESSION['uid'],$sDate,$eDate,$sTime,$eTime,$rType,$rInterval,$rPeriod,$rMonth,date("Y-m-d H:i"),date("Y-m-d H:i")));
				if ($result) {
					$added++;
				} else {
					$msg = $ax['iex_db_error'];
				}
			} else {
				$dropped++;
			}
		}
	}
	if (!$msg) $msg = "{$added} {$ax['iex_events_added']}".($dropped > 0 ? " / {$dropped} {$ax['iex_events_dropped']}" : '');
	return $msg;
}


//control logic

$msg = ''; $errors = 0; //init
if ($privs == 9) { //admin
	if (isset($_POST['uploadFile'])) {
		$msg = processUpload();
	}
	if ((isset($_POST['uploadFile']) and !$msg) or isset($_POST['addEvents'])) {
		$errors = processEvtFields($_POST['sDate'],$_POST['eDate'],$_POST['sTime'],$_POST['eTime'],$_POST['title'],$_POST['catID']);
	}
	if (isset($_POST['addEvents']) and !$errors) {
		$msg = addEvents(); //add events to calendar
	}
	echo "<p class='error'>{$msg}</p>\n";
	echo "<div class='scrollBoxAd'>\n";
	if (!isset($_POST['uploadFile']) and !isset($_POST['addEvents']) or (isset($_POST['uploadFile']) and $msg)) {
		instructions();
	}
	echo "<div class='centerBox'>\n";
	if (!isset($_POST['uploadFile']) and !isset($_POST['addEvents']) or (isset($_POST['uploadFile']) and $msg)) {
		uploadFile();
	} elseif (!isset($_POST['addEvents']) or $errors) {
		displayEvents($errors); //file uploaded or errors, display events
	} else {
		echo "<button type='button' onclick=\"window.location.href='index.php?lc'\">{$ax['back']}</button>\n";
	}
	echo "</div>\n</div>\n";
} else {
	echo "<p class='error'>{$ax['no_way']}</p>\n";
}
?>
