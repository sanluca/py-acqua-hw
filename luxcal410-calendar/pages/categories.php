<?php
/*
= LuxCal categories management page =

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
$cat['pblic'] = isset($_POST['public']) ? 1 : 0;
$cat['appro'] = isset($_POST['approve']) ? 1 : 0;
$cat['chBox'] = isset($_POST['chBox']) ? 1 : 0;
$cat['chLab'] = isset($_POST['chLab']) ? trim($_POST['chLab']) : '';
$cat['chMrk'] = isset($_POST['chMrk']) ? trim($_POST['chMrk']) : '&#x2713;';
$cat['color'] = isset($_POST['color']) ? $_POST['color'] : '';
$cat['bgrnd'] = isset($_POST['bgrnd']) ? $_POST['bgrnd'] : '';
$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';

//get number of cats
$stH = stPrep("SELECT COUNT(*) FROM categories WHERE status >= 0");
stExec($stH,null);
$row = $stH->fetch(PDO::FETCH_NUM);
$stH = null;
$nrCats = $row[0];

function showCategories($bare) { //bare: no edit/add buttons
	global $ax;
	
	echo "<fieldset><legend>{$ax['cat_list']}</legend>\n";
	echo "<table class='list'>
		<tr><th>&nbsp;{$ax['cat_nr']}&nbsp;</th><th>({$ax['cat_id']}<sup>*</sup>)</th><th>{$ax['cat_name']}</th><th>&nbsp;{$ax['cat_repeat']}&nbsp;</th><th>&nbsp;{$ax['cat_approve']}&nbsp;</th><th>&nbsp;{$ax['cat_public']}&nbsp;</th><th>&nbsp;{$ax['cat_check_mark']}&nbsp;</th>".(!$bare ? '<th></th><th></th>': '')."</tr>\n";
	$stH = stPrep("SELECT * FROM categories WHERE status >= 0 ORDER BY sequence");
	stExec($stH,null);
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
		echo "<tr><td>{$row['sequence']}</td><td>({$row['ID']})</td><td{$style}>{$row['name']}</td><td>{$repeat}</td>
			<td>".($row['approve'] < 1 ? $ax['no'] : $ax['yes'])."</td>
			<td>".($row['public'] < 1 ? $ax['no'] : $ax['yes'])."</td>
			<td>".($row['checkBx'] ? $row['checkMk'].': "'.$row['checkLb'].'"' : $ax['no']).'</td>';
		if (!$bare) {
			echo "<td>[<a href='index.php?lc&amp;mode=edit&amp;cid={$row['ID']}'>{$ax['cat_edit']}</a>]</td>
				<td>".(($row['ID'] != 1) ? "[<a href='index.php?lc&amp;delExe=y&amp;cid={$row['ID']}'>{$ax['cat_delete']}</a>]" : "")."</td>\n";
		}
		echo "</tr>\n";
	}
	echo "</table>\n";
	echo "<sup>*</sup><span class='fontS'> {$ax['cat_id_expl']}</span>\n";
	echo "</fieldset>\n";
	if (!$bare) {
		echo "<button class='noPrint' type='button' onclick=\"window.location.href='index.php?lc&amp;mode=add'\">{$ax['cat_add_new']}</button>\n";
		echo "&nbsp;&nbsp;&nbsp;<button class='noPrint' type='button' onclick=\"window.location.href='index.php?lc&amp;mode=sort'\">{$ax['cat_sort']}</button>\n";
	}
	echo "<br><br>\n";
}

function sortCategories() {
	$stH = stPrep("SELECT ID FROM categories WHERE status >= 0 ORDER BY CASE WHEN ID < 2 THEN ID ELSE name END");
	stExec($stH,null);
	$rowArray = $stH->fetchAll(PDO::FETCH_ASSOC);
	$stH = null;
	$stH = stPrep("UPDATE categories SET sequence = ? WHERE ID = ?");
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
		$stH = stPrep("SELECT * FROM categories WHERE ID = ? LIMIT 1");
		stExec($stH,array($cat['id']));
		$row = $stH->fetch(PDO::FETCH_ASSOC);
		$stH = null;
		if ($row) {
			$cat['name'] = $row['name'];
			$cat['sqnce'] = $row['sequence'];
			$cat['rpeat'] = $row['repeat'];
			$cat['appro'] = $row['approve'];
			$cat['pblic'] = $row['public'];
			$cat['color'] = $row['color'];
			$cat['bgrnd'] = $row['bgColor'];
			$cat['chBox'] = $row['checkBx'];
			$cat['chLab'] = $row['checkLb'];
			$cat['chMrk'] = $row['checkMk'];
		}
		echo "<legend>{$ax['cat_edit_cat']}</legend>\n";
	} else { //add
		echo "<legend>{$ax['cat_add_new']}</legend>\n";
		$cat['pblic'] = 1; //is default
		$cat['sqnce'] = $nrCats + 1;
	}
	$style = ($cat['color'] ? "color:{$cat['color']};" : "").($cat['bgrnd'] ? "background-color:{$cat['bgrnd']};" : "");
	$style = $style ? " style='{$style}'" : '';
	echo "<table class='list'>
		<tr><td>{$ax['cat_name']}:</td><td><input type='text' id='cname' name='cname' value=\"{$cat['name']}\" size='20' maxlength='40'{$style}></td></tr>
		<tr><td>{$ax['cat_repeat']}:</td>
		<td><select name='repeat'>
		<option value='0'".($cat['rpeat'] == '0' ? " selected='selected'" : '').">-</option>
		<option value='1'".($cat['rpeat'] == '1' ? " selected='selected'" : '').">{$ax['cat_every_day']}</option>
		<option value='2'".($cat['rpeat'] == '2' ? " selected='selected'" : '').">{$ax['cat_every_week']}</option>
		<option value='3'".($cat['rpeat'] == '3' ? " selected='selected'" : '').">{$ax['cat_every_month']}</option>
		<option value='4'".($cat['rpeat'] == '4' ? " selected='selected'" : '').">{$ax['cat_every_year']}</option>
		</select></td></tr>
		<tr><td><label for='app'>{$ax['cat_approve']}</label>:</td><td><input type='checkbox' name='approve' id='app' value='1'".($cat['appro'] ? " checked='checked'> " : ' > ')."</td></tr>
		<tr><td><label for='pub'>{$ax['cat_public']}</label>:</td><td><input type='checkbox' name='public' id='pub' value='1'".($cat['pblic'] ? " checked='checked'> " : ' > ')."</td></tr>
		<tr><td><label for='chb'>{$ax['cat_check_mark']}</label>:</td><td><input type='checkbox' name='chBox' id='chb' value='1'".($cat['chBox'] ? " checked='checked'" : '').">
		&nbsp;&nbsp;{$ax['cat_label']}: <input type='text' id='chLab' name='chLab' value='{$cat['chLab']}' size='8' maxlength='20'>
		&nbsp;&nbsp;{$ax['cat_mark']}: <input type='text' id='chMrk' name='chMrk' value='{$cat['chMrk']}' size='5' maxlength='10'></td></tr>
		<tr><td>{$ax['cat_text_color']}:</td><td><input type='text' id='color' name='color' value='{$cat['color']}' size='8' maxlength='10'><button class='noPrint' title=\"{$ax['cat_select_color']}\" onclick=\"cPicker('color','cname','t');return false;\">&larr;</button></td></tr>
		<tr><td>{$ax['cat_background']}:</td><td><input type='text' id='bgrnd' name='bgrnd' value='{$cat['bgrnd']}' size='8' maxlength='10'><button class='noPrint' title=\"{$ax['cat_select_color']}\" onclick=\"cPicker('bgrnd','cname','b');return false;\">&larr;</button></td></tr>
		<tr><td>{$ax['cat_sequence']}:</td><td><input type='text' name='sqnce' value='{$cat['sqnce']}' size='1' maxlength='2'> ({$ax['cat_in_menu']})</td></tr>
		</table>
		</fieldset>\n";
	if ($mode == 'add') {
		echo "<input type='submit' name='addExe' value=\"{$ax['cat_add']}\">";
	} else {
		echo "<input type='submit' name='updExe' value=\"{$ax['cat_save']}\">";
	}
	echo "&nbsp;&nbsp;&nbsp;<input type='submit' name='back' value=\"{$ax['back']}\">
		</form><br><br><br>\n";
}

function addCat(&$cat) { //add category
	global $ax, $mode, $nrCats;
	
	do {
		if (($cat['color'] and !preg_match("/^#[0-9A-Fa-f]{6}$/", $cat['color'])) or ($cat['bgrnd'] and !preg_match("/^#[0-9A-Fa-f]{6}$/", $cat['bgrnd']))) { $msg = $ax['cat_invalid_color']; break; }
		if (!$cat['name']) { $msg = $ax['cat_name_missing']; break; }
		if ($cat['chBox'] and (!$cat['chLab'] or !$cat['chMrk'])) { $msg = $ax['cat_mark_label_missing']; break; }
		if (!ctype_digit($cat['sqnce']) or $cat['sqnce'] == 0) {
			$cat['sqnce'] = 1;
		} elseif ($cat['sqnce'] > $nrCats) {
			$cat['sqnce'] = $nrCats + 1;
		}
		//renumber sequence
		$stH = stPrep("SELECT ID FROM categories WHERE status >= 0 AND sequence >= ? ORDER BY sequence");
		stExec($stH,array($cat['sqnce']));
		$rowArray = $stH->fetchAll(PDO::FETCH_ASSOC);
		$stH = null;
		$stH = stPrep("UPDATE categories SET sequence = ? WHERE ID = ?");
		$count = $cat['sqnce'];
		foreach ($rowArray as $row) {
			stExec($stH,array(++$count,$row['ID']));
		}
		//add new category
		$stH = stPrep("INSERT INTO categories (name,sequence,repeat,approve,public,color,bgColor,checkBx,checkLb,checkMk) VALUES (?,?,?,?,?,?,?,?,?,?)");
		stExec($stH,array($cat['name'],$cat['sqnce'],$cat['rpeat'],$cat['appro'],$cat['pblic'],$cat['color'],$cat['bgrnd'],$cat['chBox'],$cat['chLab'],$cat['chMrk']));
		$count = $stH->rowCount();
		if (!$count) { $msg = "Database Error: {$ax['cat_not_added']}"; break; }
		$msg = $ax['cat_added'];
		$mode = '';
	} while (false);
	return $msg;
}

function updateCat($cat) { //update category
	global $ax, $mode, $nrCats;
	
	do {
		if (!$cat['name']) { $msg = $ax['cat_name_missing']; break; }
		if ($cat['chBox'] and (!$cat['chLab'] or !$cat['chMrk'])) { $msg = $ax['cat_mark_label_missing']; break; }
		if (($cat['color'] and !preg_match("/^(#[0-9A-Fa-f]{6})?$/", $cat['color'])) or ($cat['bgrnd'] and !preg_match("/^(#[0-9A-Fa-f]{6})?$/", $cat['bgrnd']))) { $msg = $ax['cat_invalid_color']; break; }
		if (!ctype_digit($cat['sqnce']) or $cat['sqnce'] == 0) {
			$cat['sqnce'] = 1;
		} elseif ($cat['sqnce'] > $nrCats) {
			$cat['sqnce'] = $nrCats;
		}
		//update
		$stH = stPrep("UPDATE categories SET name=?, sequence=?, repeat=?, approve=?, public=?, color=?, bgColor=?, checkBx=?, checkLb=?, checkMk=? WHERE ID=?");
		stExec($stH,array($cat['name'],$cat['sqnce'],$cat['rpeat'],$cat['appro'],$cat['pblic'],$cat['color'],$cat['bgrnd'],$cat['chBox'],$cat['chLab'],$cat['chMrk'],$cat['id']));
		$count = $stH->rowCount();
		if (!$count) { $msg = "Database Error: {$ax['cat_not_updated']}"; break; }
		//renumber sequence
		$stH = stPrep("SELECT ID FROM categories WHERE status >= 0 ORDER BY sequence");
		stExec($stH,null);
		$rowArray = $stH->fetchAll(PDO::FETCH_ASSOC);
		$stH = null;
		$stH = stPrep("UPDATE categories SET sequence = ? WHERE ID = ?");
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
	
	$stH = stPrep("UPDATE categories SET sequence = 0, status = -1 WHERE ID = ?");
	stExec($stH,array($cat['id']));
	$count = $stH->rowCount();
	if (!$count) {
		$msg = "Database Error: {$ax['cat_not_deleted']}";
	} else {
		$msg = $ax['cat_deleted'];
		//renumber sequence
		$stH = stPrep("SELECT ID FROM categories WHERE status >= 0 ORDER BY sequence");
		stExec($stH,null);
		$rowArray = $stH->fetchAll(PDO::FETCH_ASSOC);
		$stH = null;
		$stH = stPrep("UPDATE categories SET sequence = ? WHERE ID = ?");
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