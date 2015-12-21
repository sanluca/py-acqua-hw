<?php
/*
= LuxCal categories management page =

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

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
if (empty($lcV) or
		(isset($_REQUEST['cid']) and !preg_match('%^\d{1,4}$%', $_REQUEST['cid'])) or
		(isset($_GET['mode']) and !preg_match('%^(add|edit|sort)$%', $_GET['mode'])) or
		(isset($_GET['delExe']) and !preg_match('%^\w$%', $_GET['delExe']))
	) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); }

//initialize
$adminLang = (file_exists('./lang/ai-'.strtolower($_SESSION['cL']).'.php')) ? $_SESSION['cL'] : "English";
require './lang/ai-'.strtolower($adminLang).'.php';

$cat = array();
$cat['id'] = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : 0;
$cat['name'] = isset($_POST['cname']) ? trim($_POST['cname']) : '';
$cat['sqnce'] = isset($_POST['sqnce']) ? $_POST['sqnce'] : 1;
$cat['rpeat'] = isset($_POST['repeat']) ? $_POST['repeat'] : 0;
$cat['nolap'] = isset($_POST['nolap']) ? 1 : 0;
$cat['olErr'] = isset($_POST['olErr']) ? $_POST['olErr'] : $ax['cat_ol_error_msg'];
$cat['tSlot'] = isset($_POST['tSlot']) ? $_POST['tSlot'] : 0;
$cat['daybg'] = isset($_POST['daybg']) ? 1 : 0;
$cat['appro'] = isset($_POST['approve']) ? 1 : 0;
$cat['chBox'] = isset($_POST['chBox']) ? 1 : 0;
$cat['chLab'] = isset($_POST['chLab']) ? trim($_POST['chLab']) : '';
$cat['chMrk'] = isset($_POST['chMrk']) ? trim($_POST['chMrk']) : '&#x2713;';
$cat['color'] = isset($_POST['color']) ? $_POST['color'] : '';
$cat['bgrnd'] = isset($_POST['bgrnd']) ? $_POST['bgrnd'] : '';
$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';

//get number of cats
$stH = dbQuery("SELECT COUNT(*) FROM `categories` WHERE `status` >= 0");
$row = $stH->fetch(PDO::FETCH_NUM);
$stH = null;
$nrCats = $row[0];

function showCategories($bare) { //bare: no edit/add buttons
	global $ax;
	
	echo "<fieldset><legend>{$ax['cat_list']}</legend>\n";
	echo "<table class='list'>
		<tr><th>&nbsp;{$ax['cat_nr']}&nbsp;</th><th>&nbsp;{$ax['id']}&nbsp;</th><th>{$ax['cat_name']}</th><th>&nbsp;{$ax['cat_repeat']}&nbsp;</th><th>&nbsp;{$ax['cat_overlap']}&nbsp;</th><th>&nbsp;{$ax['cat_time_slot']}&nbsp;</th><th>&nbsp;{$ax['cat_approve']}&nbsp;</th><th>&nbsp;{$ax['cat_day_color']}&nbsp;</th><th>&nbsp;{$ax['cat_check_mark']}&nbsp;</th>".(!$bare ? '<th></th><th></th>': '')."</tr>\n";
	$stH = dbQuery("SELECT * FROM `categories` WHERE `status` >= 0 ORDER BY `sequence`");
	while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
		switch ($row['repeat']) {
			case 0: $repeat = ''; break;
			case 1: $repeat = $ax['cat_every_day']; break;
			case 2: $repeat = $ax['cat_every_week']; break;
			case 3: $repeat = $ax['cat_every_month']; break;
			case 4: $repeat = $ax['cat_every_year'];
		}
		$style = ($row['color'] ? "color:{$row['color']};" : '').($row['bgColor'] ? "background-color:{$row['bgColor']};" : '');
		$style = $style ? " style='{$style}'" : '';
		echo "<tr><td>{$row['sequence']}</td><td>{$row['ID']}</td><td{$style}>{$row['name']}</td><td>{$repeat}</td>
			<td>".($row['noverlap'] < 1 ? $ax['yes'] : $ax['no'])."</td>
			<td>".($row['defSlot'] > 0 ? $row['defSlot'] : '')."</td>
			<td>".($row['approve'] < 1 ? $ax['no'] : $ax['yes'])."</td>
			<td>".($row['dayColor'] < 1 ? $ax['no'] : $ax['yes'])."</td>
			<td>".($row['checkBx'] ? $row['checkMk'].': "'.$row['checkLb'].'"' : $ax['no']).'</td>';
		if (!$bare) {
			echo "<td>[<a href='index.php?lc&amp;mode=edit&amp;cid={$row['ID']}'>{$ax['cat_edit']}</a>]</td>
				<td>".(($row['ID'] != 1) ? "[<a href='index.php?lc&amp;delExe=y&amp;cid={$row['ID']}'>{$ax['cat_delete']}</a>]" : "")."</td>\n";
		}
		echo "</tr>\n";
	}
	echo "</table>\n";
	echo "</fieldset>\n";
	if (!$bare) {
		echo "<button class='noPrint' type='button' onclick=\"window.location.href='index.php?lc&amp;mode=add'\">{$ax['cat_add_new']}</button>\n";
		echo "&nbsp;&nbsp;&nbsp;<button class='noPrint' type='button' onclick=\"window.location.href='index.php?lc&amp;mode=sort'\">{$ax['cat_sort']}</button>\n";
	}
	echo "<br><br>\n";
}

function sortCategories() {
	$stH = dbQuery("SELECT `ID` FROM `categories` WHERE `status` >= 0 ORDER BY CASE WHEN `ID` < 2 THEN `ID` ELSE `name` END");
	$rowArray = $stH->fetchAll(PDO::FETCH_ASSOC);
	$stH = null;
	$stH = stPrep("UPDATE `categories` SET `sequence` = ? WHERE `ID` = ?");
	$count = 0;
	foreach ($rowArray as $row) {
		stExec($stH,array(++$count,$row['ID']));
	}
}

function editCategory($cat) {
	global $ax, $mode, $nrCats;
	
	echo "<form action='index.php?lc' method='post' name='cate'>
		<input type='hidden' name='token' value='{$_SESSION['token']}'>
		<input type='hidden' name='cid' id='cid' value='{$cat['id']}'>
		<input type='hidden' name='mode' id='mode' value='{$mode}'>\n";
	echo "<fieldset>";
	if ($mode == 'edit') { //edit
		$stH = stPrep("SELECT * FROM `categories` WHERE `ID` = ? LIMIT 1");
		stExec($stH,array($cat['id']));
		$row = $stH->fetch(PDO::FETCH_ASSOC);
		$stH = null;
		if ($row and !isset($_POST['cname'])) {
			$cat['name'] = $row['name'];
			$cat['sqnce'] = $row['sequence'];
			$cat['rpeat'] = $row['repeat'];
			$cat['nolap'] = $row['noverlap'];
			$cat['olErr'] = $row['olErrMsg'];
			$cat['tSlot'] = $row['defSlot'];
			$cat['appro'] = $row['approve'];
			$cat['daybg'] = $row['dayColor'];
			$cat['color'] = $row['color'];
			$cat['bgrnd'] = $row['bgColor'];
			$cat['chBox'] = $row['checkBx'];
			$cat['chLab'] = $row['checkLb'];
			$cat['chMrk'] = $row['checkMk'];
		}
		echo "<legend>{$ax['cat_edit_cat']}</legend>\n";
	} else { //add
		echo "<legend>{$ax['cat_add_new']}</legend>\n";
		$cat['sqnce'] = $nrCats + 1;
	}
	$style = ($cat['color'] ? "color:{$cat['color']};" : "").($cat['bgrnd'] ? "background-color:{$cat['bgrnd']};" : "");
	$style = $style ? " style='{$style}'" : '';
	$selected = array_fill(0,5,'');
	$selected[$cat['rpeat']] = " selected='selected'";
	echo "<table class='list'>\n";
	if ($mode != 'add') { echo "<tr><td>{$ax['id']}:</td><td>&nbsp;{$cat['id']}</td></tr>\n"; }
	echo	"<tr><td>{$ax['cat_name']}:</td><td><input type='text' id='cname' name='cname' value=\"{$cat['name']}\" size='20' maxlength='40'{$style}></td></tr>
		<tr><td>{$ax['cat_repeat']}:</td>
		<td><select name='repeat'>
		<option value='0'{$selected[0]}>-</option>
		<option value='1'{$selected[1]}>{$ax['cat_every_day']}</option>
		<option value='2'{$selected[2]}>{$ax['cat_every_week']}</option>
		<option value='3'{$selected[3]}>{$ax['cat_every_month']}</option>
		<option value='4'{$selected[4]}>{$ax['cat_every_year']}</option>
		</select></td></tr>
		<tr><td><label for='nov'>{$ax['cat_no_overlap']}<sup> *</sup></label>:</td><td><input type='checkbox' name='nolap' id='nov' value='1'".($cat['nolap'] ? " checked='checked'> " : ' > ')."&nbsp;&nbsp;{$ax['cat_ol_error_text']}: <input type='text' name='olErr' value='{$cat['olErr']}' size='40' maxlength='80'></td></tr>
		<tr><td>{$ax['cat_def_slot']}:</td><td><input type='text' name='tSlot' value='{$cat['tSlot']}' size='2' maxlength='3'> {$ax['cat_ts_no_etime']}</td></tr>
		<tr><td><label for='dbg'>{$ax['cat_day_color']}</label>:</td><td><input type='checkbox' name='daybg' id='dbg' value='1'".($cat['daybg'] ? " checked='checked'> " : ' > ')."</td></tr>
		<tr><td><label for='app'>{$ax['cat_approve']}</label>:</td><td><input type='checkbox' name='approve' id='app' value='1'".($cat['appro'] ? " checked='checked'> " : ' > ')."</td></tr>
		<tr><td><label for='chb'>{$ax['cat_check_mark']}</label>:</td><td><input type='checkbox' name='chBox' id='chb' value='1'".($cat['chBox'] ? " checked='checked'" : '').">
		&nbsp;&nbsp;{$ax['cat_label']}: <input type='text' name='chLab' value='{$cat['chLab']}' size='8' maxlength='20'>
		&nbsp;&nbsp;{$ax['cat_mark']}: <input type='text' name='chMrk' value='{$cat['chMrk']}' size='5' maxlength='10'></td></tr>
		<tr><td>{$ax['cat_text_color']}:</td><td><input type='text' id='color' name='color' value='{$cat['color']}' size='8' maxlength='10'><button class='noPrint' title=\"{$ax['cat_select_color']}\" onclick=\"cPicker('color','cname','t');return false;\">&larr;</button></td></tr>
		<tr><td>{$ax['cat_background']}:</td><td><input type='text' id='bgrnd' name='bgrnd' value='{$cat['bgrnd']}' size='8' maxlength='10'><button class='noPrint' title=\"{$ax['cat_select_color']}\" onclick=\"cPicker('bgrnd','cname','b');return false;\">&larr;</button></td></tr>
		<tr><td>{$ax['cat_sequence']}:</td><td><input type='text' name='sqnce' value='{$cat['sqnce']}' size='1' maxlength='2'> ({$ax['cat_in_menu']})</td></tr>
		</table>
		<sup>*</sup><span class='fontS'> {$ax['cat_no_ol_note']}</span>
		</fieldset>\n";
	if ($mode == 'add') {
		echo "<input type='submit' name='addExe' value=\"{$ax['cat_add']}\">";
	} else {
		echo "<input type='submit' name='updExe' value=\"{$ax['cat_save']}\">";
	}
	echo "&nbsp;&nbsp;&nbsp;<input type='submit' name='back' value=\"{$ax['back']}\">
		</form><br><br><br>\n";
}

function validateCat(&$cat) { //add category
	global $ax, $nrCats;

	$msg = ''; //init
	do {
		if (!$cat['name']) { $msg = $ax['cat_name_missing']; break; }
		if (($cat['color'] and !preg_match("/^#[0-9A-Fa-f]{6}$/", $cat['color'])) or ($cat['bgrnd'] and !preg_match("/^#[0-9A-Fa-f]{6}$/", $cat['bgrnd']))) { $msg = $ax['cat_invalid_color']; break; }
		if ($cat['nolap'] and !$cat['tSlot']) { $msg = $ax['cat_tslot_missing']; break; }
		if (!ctype_digit($cat['tSlot']) or $cat['tSlot'] < 0 or $cat['tSlot'] > 240) { $msg = $ax['cat_tslot_invalid']; break; }
		if ($cat['chBox'] and (!$cat['chLab'] or !$cat['chMrk'])) { $msg = $ax['cat_mark_label_missing']; break; }
		if (!ctype_digit($cat['sqnce']) or $cat['sqnce'] == 0) {
			$cat['sqnce'] = 1;
		} elseif ($cat['sqnce'] > $nrCats) {
			$cat['sqnce'] = $nrCats + 1;
		}
	} while (false);
	return $msg;
}

function addCat(&$cat) { //add category
	global $ax, $mode, $nrCats;
	
	do {
		//validate form fields
		if ($msg = validateCat($cat)) { break; }
		//renumber sequence
		$stH = stPrep("SELECT `ID` FROM `categories` WHERE `status` >= 0 AND `sequence` >= ? ORDER BY `sequence`");
		stExec($stH,array($cat['sqnce']));
		$rowArray = $stH->fetchAll(PDO::FETCH_ASSOC);
		$stH = null;
		$stH = stPrep("UPDATE `categories` SET `sequence` = ? WHERE `ID` = ?");
		$count = $cat['sqnce'];
		foreach ($rowArray as $row) {
			stExec($stH,array(++$count,$row['ID']));
		}
		//add new category
		$stH = stPrep("INSERT INTO `categories` (`name`,`sequence`,`repeat`,`noverlap`,`olErrMsg`,`defSlot`,`approve`,`dayColor`,`color`,`bgColor`,`checkBx`,`checkLb`,`checkMk`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
		stExec($stH,array($cat['name'],$cat['sqnce'],$cat['rpeat'],$cat['nolap'],$cat['olErr'],$cat['tSlot'],$cat['appro'],$cat['daybg'],$cat['color'],$cat['bgrnd'],$cat['chBox'],$cat['chLab'],$cat['chMrk']));
		$count = $stH->rowCount();
		if (!$count) { $msg = "Database Error: {$ax['cat_not_added']}"; break; }
		$msg = $ax['cat_added'];
		$mode = '';
	} while (false);
	return $msg;
}

function updateCat(&$cat) { //update category
	global $ax, $mode, $nrCats;
	
	do {
		//validate form fields
		if ($msg = validateCat($cat)) { break; }
		//update
		$stH = stPrep("UPDATE `categories` SET `name`=?,`sequence`=?,`repeat`=?,`noverlap`=?,`olErrMsg`=?,`defSlot`=?,`approve`=?,`dayColor`=?,`color`=?,`bgColor`=?,`checkBx`=?,`checkLb`=?,`checkMk`=? WHERE `ID`=?");
		stExec($stH,array($cat['name'],$cat['sqnce'],$cat['rpeat'],$cat['nolap'],$cat['olErr'],$cat['tSlot'],$cat['appro'],$cat['daybg'],$cat['color'],$cat['bgrnd'],$cat['chBox'],$cat['chLab'],$cat['chMrk'],$cat['id']));
		$count = $stH->rowCount();
		if (!$count) { $msg = "Database Error: {$ax['cat_not_updated']}"; break; }
		//renumber sequence
		$stH = dbQuery("SELECT `ID` FROM `categories` WHERE `status` >= 0 ORDER BY `sequence`");
		$rowArray = $stH->fetchAll(PDO::FETCH_ASSOC);
		$stH = null;
		$stH = stPrep("UPDATE `categories` SET `sequence` = ? WHERE `ID` = ?");
		$count = 1;
		foreach ($rowArray as $row) {
			if ($row['ID'] != $cat['id']) {
				if ($count == $cat['sqnce']) { $count++; }
				stExec($stH,array($count++,$row['ID']));
			}
		}
		$msg = $ax['cat_updated'];
		$mode = '';
	} while (false);
	return $msg;
}

function deleteCat($cat) { //delete category
	global $ax;
	
	$stH = stPrep("UPDATE `categories` SET `sequence` = 0, `status` = -1 WHERE `ID` = ?");
	stExec($stH,array($cat['id']));
	$count = $stH->rowCount();
	if (!$count) {
		$msg = "Database Error: {$ax['cat_not_deleted']}";
	} else {
		$msg = $ax['cat_deleted'];
		//renumber sequence
		$stH = dbQuery("SELECT `ID` FROM `categories` WHERE `status` >= 0 ORDER BY `sequence`");
		$rowArray = $stH->fetchAll(PDO::FETCH_ASSOC);
		$stH = null;
		$stH = stPrep("UPDATE `categories` SET `sequence` = ? WHERE `ID` = ?");
		$count = 1;
		foreach ($rowArray as $row) {
			stExec($stH,array($count++,$row['ID']));
		}
	}
	return $msg;
}

//Control logic
if ($privs >= 4) { //manager or admin
	$msg = '';
	if (isset($_POST['addExe'])) {
		$msg = addCat($cat);
	} elseif (isset($_POST['updExe'])) {
		$msg = updateCat($cat);
	} elseif (isset($_GET['delExe'])) {
		$msg = deleteCat($cat);
	}
	echo "<p class='error'>{$msg}</p>
		<div class='scrollBoxAd'>
		<div class='centerBox'>\n";
	if ($mode == 'sort') {
		sortCategories(); //sort on name
	}
	if (($mode != 'add' and $mode != 'edit') or isset($_POST['back'])) {
		showCategories(false); //no add / no edit
	} else {
		editCategory($cat); //add or edit
		showCategories(true);
	}
	echo "</div>\n</div>\n";
} else {
	echo "<p class='error'>{$ax['no_way']}</p>\n";
}
?>