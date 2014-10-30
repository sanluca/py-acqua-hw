<?php
/*
= LuxCal group management page =

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
		(isset($_REQUEST['gid']) and !preg_match('%^\d{1,6}$%', $_REQUEST['gid'])) or
		(isset($_GET['mode']) and !preg_match('%^(add|edit)$%', $_GET['mode'])) or
		(isset($_GET['delExe']) and !preg_match('%^\w$%', $_GET['delExe']))
	) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); }

//initialize
$adminLang = (file_exists('./lang/ai-'.strtolower($_SESSION['cL']).'.php')) ? $_SESSION['cL'] : "English";
require './lang/ai-'.strtolower($adminLang).'.php';

$group = array();
$group['id'] = isset($_REQUEST["gid"]) ? $_REQUEST["gid"] : 0;
$group['name'] = isset($_POST["name"]) ? trim($_POST["name"]) : '';
$group['privs'] = isset($_POST["privs"]) ? $_POST["privs"] : 0;
$group['catIDs'] = isset($_POST["cats"]) ? $_POST["cats"] : array('0');
$group['color'] = isset($_POST['color']) ? $_POST['color'] : '';
$mode = isset($_REQUEST["mode"]) ? $_REQUEST["mode"] : '';

function showGroups() {
	global $ax, $privs;

	//get category names
	$catArray = array(0 => $ax['grp_all_cats']);
	$stH = stPrep("SELECT ID,name FROM categories WHERE status >= 0");
	stExec($stH,null);
	while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
		$catArray[$row['ID']] = $row['name'];
	}
	//display group list
	echo "<fieldset><legend>{$ax['grp_list_of_groups']}</legend>\n";
	$stH = stPrep("SELECT * FROM groups WHERE status >= 0 ORDER BY CASE WHEN ID <= 2 THEN ID ELSE name END");
	stExec($stH,null);
	echo "<table class='list'>
		<tr><th>{$ax['grp_id']}</th><th>{$ax['grp_name']}</th><th>{$ax['grp_privs']}</th><th>{$ax['grp_categories']}</th><th></th></tr>\n";
	while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
		$style = $row['color'] ? " style='background-color:{$row['color']};'" : '';
		echo "<tr><td>{$row['ID']}</td><td{$style}><b>{$row['name']}</b></td>";
		echo '<td>';
		if ($row['privs'] == 0) { echo $ax['none']; }
		elseif ($row['privs'] == 1) { echo $ax['grp_view']; }
		elseif ($row['privs'] == 2) { echo $ax['grp_post_own']; }
		elseif ($row['privs'] == 3) { echo $ax['grp_post_all']; }
		elseif ($row['privs'] == 4) { echo $ax['grp_manager']; }
		elseif ($row['privs'] == 9) { echo $ax['grp_admin']; }
		echo "</td>";
		echo "<td>";
		$catIDs = explode(',',$row['catIDs']);
		foreach ($catIDs as $id) {
			if (isset($catArray[$id])) { echo $catArray[$id].'<br>'; }
		}
		echo "</td>";
		if ($privs == 9 or $row['privs'] < 9) { echo "<td>[<a href='index.php?lc&amp;mode=edit&amp;gid={$row['ID']}'>{$ax['grp_edit']}</a>]"; }
		if ($row['ID'] > 2) { echo "&nbsp;&nbsp;[<a href='index.php?lc&amp;delExe=y&amp;gid={$row['ID']}'>{$ax['grp_delete']}</a>]"; }
		echo "</td></tr>\n";
	}
	echo "</table>\n";
	echo "</fieldset>
		<button class='noPrint' type='button' onclick=\"window.location.href='index.php?lc&amp;mode=add'\">{$ax['grp_add_group']}</button>&nbsp;&nbsp;
		<button class='noPrint' type='button' onclick=\"window.location.href='index.php?lc&amp;cP=92'\">{$ax['grp_go_to_users']}</button>\n";
}

function editGroup(&$group) {
	global $ax, $privs, $mode;

	echo "<form action='index.php?lc' method='post'>\n
		<input type='hidden' name='token' value='{$_SESSION['token']}'>";
	echo "<fieldset>";
	if ($mode != 'add') {
		$stH = stPrep("SELECT * FROM groups WHERE ID = ?");
		stExec($stH,array($group['id']));
		$row = $stH->fetch(PDO::FETCH_ASSOC);
		$stH = null;
		if ($row) {
			$group['name'] = $row['name'];
			$group['privs'] = $row['privs'];
			$group['catIDs'] = explode(',',$row['catIDs']);
			$group['color'] = $row['color'];
		}
		echo "<legend>{$ax['grp_edit_group']}</legend>\n";
	} else {
		echo "<legend>{$ax['grp_add_group']}</legend>\n";
		$pwNote = ':';
	}
	$style = ($group['color'] ? " style='background-color:{$group['color']};'" : '');
	echo "<input type='hidden' name='gid' id='gid' value='{$group['id']}'>
		<input type='hidden' name='mode' id='mode' value=\"{$mode}\">";
	echo "<table class='list'>\n";
	if ($mode != 'add') { echo "<tr><td>{$ax['grp_id']}:</td><td>&nbsp;{$group['id']}</td></tr>\n"; }
	echo "<tr><td>{$ax['grp_name']}:</td><td><input type='text' id='name' name='name' size='30' value=\"{$group['name']}\"{$style}></td></tr>\n";
	echo "<tr><td>{$ax['grp_privs']}:</td>";
	if (isset($row) and $row['ID'] == 2) {
		echo "<input type='hidden' name='privs' id='privs' value='{$group['privs']}'></td>\n";
		echo "<td>{$ax['grp_admin']}</td></tr>\n";
	} else {
		echo "<td><select name='privs'>
			<option value='0'".($group['privs'] == 0 ? " selected='selected'" : '').">{$ax['grp_no_rights']}</option>
			<option value='1'".($group['privs'] == 1 ? " selected='selected'" : '').">{$ax['grp_view']}</option>
			<option value='2'".($group['privs'] == 2 ? " selected='selected'" : '').">{$ax['grp_post_own']}</option>
			<option value='3'".($group['privs'] == 3 ? " selected='selected'" : '').">{$ax['grp_post_all']}</option>
			<option value='4'".($group['privs'] == 4 ? " selected='selected'" : '').">{$ax['grp_manager']}</option>\n";
			if ($privs == 9) { //admin
				echo "<option value='9'".($group['privs'] == 9 ? " selected='selected'" : '').">{$ax['grp_admin']}</option>\n";
			}
		echo "</select></td></tr>\n";
	}
	echo "<tr><td>{$ax['grp_categories']}:</td>";
	$stH = stPrep("SELECT * FROM categories WHERE status >= 0 ORDER BY sequence");
	stExec($stH,null);
	$checked = in_array('0',$group['catIDs']) ? " checked='checked'" : '';
	echo "<td><input type='checkbox' id='cats0' name='cats[]' value='0' onclick=\"checkZ('cats',this);\"{$checked}><label for='cats0'>{$ax['grp_all_cats']}</label><br>\n";
	while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
		$checked = in_array(strval($row['ID']),$group['catIDs']) ? " checked='checked'" : '';
		echo "<input type='checkbox' id='cats{$row['ID']}' name='cats[]' value='{$row['ID']}' onclick=\"checkN('cats',this);\"{$checked}><label for='cats{$row['ID']}'>{$row['name']}</label><br>";
	}
	echo "</td></tr>\n";
	echo "<tr><td>{$ax['grp_background']}:</td><td><input type='text' id='color' name='color' value='{$group['color']}' size='8' maxlength='10'><button class='noPrint' title=\"{$ax['grp_select_color']}\" onclick=\"cPicker('color','name','b');return false;\">&larr;</button></td></tr>
		</table>\n
		</fieldset>\n";
	if ($mode == 'add') {
		echo "<input type='submit' name='addExe' value=\"{$ax['grp_add_group']}\">";
	} else {
		echo "<input type='submit' name='updExe' value=\"{$ax['grp_upd_group']}\">";
	}
	echo "&nbsp;&nbsp;&nbsp;<input type='submit' name='back' value=\"{$ax['back']}\">
		</form>\n";
}

function addGroup(&$group) { //add group
	global $ax, $set, $mode;

	do {
		if ($group['color'] and !preg_match("/^#[0-9A-Fa-f]{6}$/", $group['color'])) { $msg = $ax['grp_invalid_color']; break; }
		if (!$group['name']) { $msg = $ax['grp_cred_required']; break; }
		if (!preg_match("/^[\w\s\._-]{2,}$/u", $group['name'])) { $msg = $ax['grp_un_invalid']; break; }
		$stH = stPrep("SELECT name FROM groups WHERE name = ? AND status >= 0");
		stExec($stH,array($group['name']));
		$row = $stH->fetch(PDO::FETCH_ASSOC);
		$stH = null;
		if ($row) { //name already exists
			$msg = $ax['grp_name_exists']; break;
		}
		$stH = stPrep("INSERT INTO groups (name, privs, catIDs, color) VALUES (?,?,?,?)");
		$result = stExec($stH,array($group['name'],$group['privs'],implode(',',$group['catIDs']),$group['color']));
		if (!$result) { $msg = "Database Error: {$ax['grp_not_added']}"; break; }
		$msg = $ax['grp_added'];
		$mode = '';
	} while (false);
	return $msg;
}

function updateGroup($group) { //update group
	global $ax, $mode;

	do {
		if ($group['color'] and !preg_match("/^#[0-9A-Fa-f]{6}$/", $group['color'])) { $msg = $ax['grp_invalid_color']; break; }
		if (!preg_match("/^[\w\s\._-]{2,}$/u", $group['name'])) { $msg = $ax['grp_name_invalid']; break; }
		$stH = stPrep("UPDATE groups SET name = ?, privs = ?, catIDs = ?, color = ? WHERE ID = ?");
		$result = stExec($stH,array($group['name'],$group['privs'],implode(',',$group['catIDs']),$group['color'], $group['id']));
		if (!$result) { $msg .= "Database Error: {$ax['grp_not_updated']}"; break; }
		$msg = $ax['grp_updated'];
		$mode = '';
	} while (false);
	return $msg;
}

function deleteGroup($group) { //delete user group
	global $ax;
	
	do {
		$stH = stPrep("SELECT name FROM users WHERE groupID = ? AND status >= 0 limit 1");
		stExec($stH,array($group['id']));
		$row = $stH->fetch(PDO::FETCH_ASSOC);
		$stH = null;
		if ($row) { //group is in use
			$msg = $ax['grp_in_use'].' - '.$ax['grp_not_deleted']; break;
		}
		$stH = stPrep("UPDATE groups SET status = -1 WHERE ID = ?");
		stExec($stH,array($group['id']));
		$deleted = $stH->rowCount();
		if (!$deleted) { $msg = "Database Error: {$ax['grp_not_deleted']}"; break; }
		$msg = $ax['grp_deleted'];
	} while (false);
	return $msg;
}

//Control logic
if ($privs >= 4) { //manager or admin
	$msg = '';
	if (isset($_POST['addExe'])) {
		$msg = addGroup($group);
	} elseif (isset($_POST['updExe'])) {
		$msg = updateGroup($group);
	} elseif (isset($_GET['delExe'])) {
		$msg = deleteGroup($group);
	}
	echo "<p class='error'>{$msg}</p>
		<div class='scrollBoxAd'>
		<div class='centerBox'>\n";
	if (!$mode or isset($_POST["back"])) {
		showGroups(); //no add / no edit
	} else {
		editGroup($group); //add or edit
	}
	echo "</div>\n</div>\n";
} else {
	echo "<p class='error'>{$ax['no_way']}</p>\n";
}
?>
