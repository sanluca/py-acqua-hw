<?php
/*
= LuxCal user management page =

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
		(isset($_REQUEST['uid']) and !preg_match('%^\d{1,6}$%', $_REQUEST['uid'])) or
		(isset($_GET['mode']) and !preg_match('%^(add|edit)$%', $_GET['mode'])) or
		(isset($_GET['delExe']) and !preg_match('%^\w$%', $_GET['delExe']))
	) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); }

//initialize
$adminLang = (file_exists('./lang/ai-'.strtolower($_SESSION['cL']).'.php')) ? $_SESSION['cL'] : "English";
require './lang/ai-'.strtolower($adminLang).'.php';

$user = array();
$user['id'] = isset($_REQUEST["uid"]) ? $_REQUEST["uid"] : 0;
$user['name'] = isset($_POST["uName"]) ? trim($_POST["uName"]) : '';
$user['mail'] = isset($_POST["email"]) ? trim($_POST["email"]) : '';
$user['pword'] = isset($_POST['pword']) ? $_POST['pword'] : '';
$user['newPw'] = isset($_POST['newPw']) ? $_POST['newPw'] : '';
$user['grpID'] = isset($_POST['grpID']) ? $_POST['grpID'] : '';
$mode = isset($_REQUEST["mode"]) ? $_REQUEST["mode"] : '';

function showUsers() {
	global $ax, $privs;

	echo "<fieldset><legend>{$ax['usr_list_of_users']}</legend>\n";
	$stH = stPrep("SELECT u.ID, u.name AS uname, u.email, u.login0, u.login1, u.loginCnt, g.name AS gname, g.color FROM users AS u INNER JOIN groups AS g ON g.ID = u.groupID WHERE u.status >= 0 ORDER BY CASE WHEN u.ID <= 2 THEN u.ID ELSE u.name END");
	stExec($stH,null);
	echo "<table class='list'>
		<tr><th>{$ax['usr_id']}</th><th>{$ax['usr_name']}</th><th>{$ax['usr_email']}</th><th>{$ax['usr_group']}</th><th>{$ax['usr_login_0']}</th><th>{$ax['usr_login_1']}</th><th>{$ax['usr_login_cnt']}</th><th></th></tr>\n";
	while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
		$firstLoginD = ($row['login0'] != '9999-00-00') ? IDtoDD($row['login0']) : '';
		$lastLoginD = ($row['login1'] != '9999-00-00') ? IDtoDD($row['login1']) : '';
		$style = $row['color'] ? " style='background-color:{$row['color']};'" : '';
		echo "<tr><td>{$row['ID']}</td><td><b>{$row['uname']}</b></td><td>{$row['email']}</td>";
		echo "<td{$style}>{$row['gname']}</td><td>{$firstLoginD}</td><td>{$lastLoginD}</td><td>{$row['loginCnt']}</td>";
		if ($privs == 9 or $row['ID'] != 2) { echo "<td>[<a href='index.php?lc&amp;mode=edit&amp;uid={$row['ID']}'>{$ax['usr_edit']}</a>]"; }
		if ($row['ID'] > 2 and $row['ID'] != $_SESSION['uid']) { echo "&nbsp;&nbsp;[<a href='index.php?lc&amp;delExe=y&amp;uid={$row['ID']}'>{$ax['usr_delete']}</a>]"; }
		echo "</td></tr>\n";
	}
	echo "</table>\n";
	echo "</fieldset>
		<button class='noPrint' type='button' onclick=\"window.location.href='index.php?lc&amp;mode=add'\">{$ax['usr_add']}</button>&nbsp;&nbsp;
		<button class='noPrint' type='button' onclick=\"window.location.href='index.php?lc&amp;cP=93'\">{$ax['usr_go_to_groups']}</button>\n";
}

function editUser(&$user) {
	global $ax, $privs, $mode;

	$uid = $user['id'];
	echo "<form action='index.php?lc' method='post'>
		<input type='hidden' name='token' value='{$_SESSION['token']}'>\n";
	echo "<fieldset>";
	if ($mode != 'add') {
		$stH = stPrep("SELECT * FROM users WHERE ID = ?");
		stExec($stH,array($uid));
		$row = $stH->fetch(PDO::FETCH_ASSOC);
		$stH = null;
		if ($row) {
			$user['name'] = $row['name'];
			$user['mail'] = $row['email'];
			$user['pword'] = $row['password'];
			$user['grpID'] = $row['groupID'];
		}
		$pwNote = "<sup>*</sup>:<div style='font-size: .8em'><sup>*</sup> {$ax['usr_if_changing_pw']}</div>";
		echo "<legend>{$ax['usr_edit_user']}</legend>\n";
	} else {
		echo "<legend>{$ax['usr_add']}</legend>\n";
		$pwNote = ':';
	}
	echo "<input type='hidden' name='uid' id='uid' value='{$uid}'>
		<input type='hidden' name='pword' id='pword' value=\"{$user['pword']}\">
		<input type='hidden' name='mode' id='mode' value=\"{$mode}\">\n";
	echo "<table class='list'>\n";
	if ($mode != 'add') { echo "<tr><td>{$ax['usr_id']}:</td><td>&nbsp;{$user['id']}</td></tr>\n"; }
	echo "<tr><td>{$ax['usr_name']}:</td><td><input type='text' id='uName' name='uName' size='30' value=\"{$user['name']}\"></td></tr>\n";
	if ($uid != 1) { //not public access
		echo "<tr><td>{$ax['usr_email']}:</td><td><input type='text' name='email' size='30' value=\"{$user['mail']}\"></td></tr>\n";
		echo "<tr><td>{$ax['usr_password']}{$pwNote}</td><td><input type='password' name='newPw' size='30'></td></tr>\n";
	}
	echo "<tr><td>{$ax['usr_group']}:</td>";
	if ($uid == $_SESSION['uid'] or $uid == 2) {
		$stH = stPrep("SELECT name, color FROM groups WHERE ID = ?");
		stExec($stH,array($user['grpID']));
		$row = $stH->fetch(PDO::FETCH_ASSOC);
		$stH = null;
		$color = $row['color'] ? " style='background-color:{$row['color']};'" : '';
		echo "<td><input type='hidden' name='group' id='group' value='{$user['grpID']}'><span{$color}>{$row['name']}</span></td>\n";
	} else {
		$stH = stPrep("SELECT ID, name, color FROM groups WHERE status >= 0 ORDER BY name");
		stExec($stH,null);
		echo "<td><select name='grpID'>\n";
		while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
			if ($privs == 9 or $row['ID'] != 2) {
				$color = $row['color'] ? " style='background-color:{$row['color']};'" : '';
				$selected = $row['ID'] == $user['grpID'] ? " selected='selected'" : '';
				echo "<option value='{$row['ID']}'{$color}{$selected}>{$row['name']}</option>\n";
			}
		}
		echo "</select></td></tr>\n";
	}
	echo "</table>\n</fieldset>\n";
	if ($mode == 'add') {
		echo "<input type='submit' name='addExe' value=\"{$ax['usr_add_profile']}\">";
	} else {
		echo "<input type='submit' name='updExe' value=\"{$ax['usr_upd_profile']}\">";
	}
	echo "&nbsp;&nbsp;&nbsp;<input type='submit' name='back' value=\"{$ax['back']}\">
		</form>\n";
}

function addUser(&$user) { //add user account
	global $ax, $set, $mode, $rxEmail;

	do {
		if (!$user['name'] or !$user['mail'] or !$user['newPw']) { $msg = $ax['usr_cred_required']; break; }
		if (!preg_match("/^[\w\s\._-]{2,}$/u", $user['name'])) { $msg = $ax['usr_un_invalid']; break; }
		if (!preg_match($rxEmail,$user['mail'])) { $msg = $ax['usr_em_invalid']; break; }
		$stH = stPrep("SELECT name, email FROM users WHERE (name = ? OR email = ?) AND status >= 0");
		stExec($stH,array($user['name'],$user['mail']));
		$row = $stH->fetch(PDO::FETCH_ASSOC);
		$stH = null;
		if ($row) { // name or email already exists
			$msg = $row['name'] == $user['name'] ? $ax['usr_name_exists'] : $ax['usr_email_exists'];
			break;
		}
		$password = md5($user['newPw']);
		$stH = stPrep("INSERT INTO users (name, password, email, groupID, language) VALUES (?,?,?,?,?)");
		$result = stExec($stH,array($user['name'],$password,$user['mail'],$user['grpID'],$set['language']));
		if (!$result) { $msg = "Database Error: {$ax['usr_not_added']}"; break; }
		$stH = stPrep("SELECT last_insert_rowid()");
		$row = $stH->fetch(PDO::FETCH_NUM);
		$stH = null;
		$user['id'] = $row[0]; //set id to new user
		$msg = $ax['usr_added'];
		$mode = '';
	} while (false);
	return $msg;
}

function updateUser($user) { //update user account
	global $ax, $set, $mode, $rxEmail;

	do {
		if (!preg_match("/^[\w\s\._-]{2,}$/u", $user['name'])) { $msg = $ax['usr_un_invalid']; break; }
		if ($user['id'] > 1) { //not Public User
			if (!preg_match($rxEmail,$user['mail'])) { $msg = $ax['usr_em_invalid']; break; }
		}
		if ($user['newPw']) { $user['pword'] = md5($user['newPw']); }
		$stH = stPrep("UPDATE users SET name = ?, password = ?, email = ?, groupID = ?, language = ? WHERE ID = ?");
		$result = stExec($stH,array($user['name'],$user['pword'],$user['mail'],$user['grpID'],$set['language'], $user['id']));
		if (!$result) { $msg .= "Database Error: {$ax['usr_not_updated']}"; break; }
		$msg = $ax['usr_updated'];
		$mode = '';
	} while (false);
	return $msg;
}

function deleteUser($user) { //delete user account
	global $ax;
	
	do {
		if ($user['id'] == $_SESSION['uid']) { $msg = $ax['usr_cant_delete_yourself']; break; }
		$stH = stPrep("UPDATE users SET status = -1 WHERE ID = ?");
		stExec($stH,array($user['id']));
		$deleted = $stH->rowCount();
		if (!$deleted) { $msg = "Database Error: {$ax['usr_not_deleted']}"; break; }
		$msg = $ax['usr_deleted'];
	} while (false);
	return $msg;
}

//Control logic
if ($privs >= 4) { //manager or admin
	$msg = '';
	if (isset($_POST['addExe'])) {
		$msg = addUser($user);
	} elseif (isset($_POST['updExe'])) {
		$msg = updateUser($user);
	} elseif (isset($_GET['delExe'])) {
		$msg = deleteUser($user);
	}
	echo "<p class='error'>{$msg}</p>
		<div class='scrollBoxAd'>
		<div class='centerBox'>\n";
	if (!$mode or isset($_POST["back"])) {
		showUsers(); //no add / no edit
	} else {
		editUser($user); //add or edit
	}
	echo "</div>\n</div>\n";
} else {
	echo "<p class='error'>{$ax['no_way']}</p>\n";
}
?>
