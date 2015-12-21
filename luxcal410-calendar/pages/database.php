<?php
/*
= LuxCal database management page =

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

function mdbForm() {
	global $ax, $compact, $backup, $restore, $events, $delEvt, $fromD, $tillD;
	
	$comChecked = $compact > 0 ? " checked='checked'" : '';
	$bacChecked = $backup > 0 ? " checked='checked'" : '';
	$resChecked = $restore > 0 ? " checked='checked'" : '';
	$evtChecked = $events > 0 ? " checked='checked'" : '';
	$delChecked = $delEvt > 0 ? " checked='checked'" : '';
	$undChecked = !$delEvt > 0 ? " checked='checked'" : '';
	echo "<form action='index.php?lc' method='post' enctype='multipart/form-data'>
		<input type='hidden' name='token' value='{$_SESSION['token']}'>
		<input type='hidden' name='MAX_FILE_SIZE' value='2050000'>
		<fieldset>\n
		<legend>{$ax['mdb_dbm_functions']}</legend>\n
		<br><input type='checkbox' id='com' name='compact' value='yes'{$comChecked}><label for='com'> {$ax['mdb_compact']}</label><br>
		<br><input type='checkbox' id='bac' name='backup' value='yes'{$bacChecked}><label for='bac'> {$ax['mdb_backup']}</label><br>
		<br><input type='checkbox' id='res' name='restore' value='yes'{$resChecked}><label for='res'> {$ax['mdb_restore']}</label>&nbsp;&nbsp;&nbsp;&nbsp;
		<label>{$ax['iex_file']}:</label> <input type='file' name='fName'><br>
		<br><input type='checkbox' id='evt' name='events' value='yes'{$evtChecked}><label for='evt'> {$ax['mdb_events']}</label>: &nbsp;&nbsp;&nbsp;
		<input type='radio' id='del' name='delEvt' value='1'{$delChecked}><label for='del'> {$ax['mdb_delete']}</label>&nbsp;&nbsp;&nbsp;
		<input type='radio' id='und' name='delEvt' value='0'{$undChecked}><label for='und'> {$ax['mdb_undelete']}</label>\n<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$ax['mdb_between_dates']}: <input type='text' name='fromD' id='fromD' value='".IDtoDD($fromD)."' size='8'>
		<button title=\"{$ax['iex_select_start_date']}\" onclick=\"dPicker(1,'nill','fromD');return false;\">&larr;</button> &#8211;
		<input type='text' name='tillD' id='tillD' value='".IDtoDD($tillD)."' size='8'>
		<button title=\"{$ax['iex_select_end_date']}\" onclick=\"dPicker(1,'nill','tillD');return false;\">&larr;</button>
		</fieldset>\n
		<input type='submit' name='mdb_exe' value=\"{$ax['mdb_start']}\">\n
	</form>\n";
}

function processFunctions() {
	global $ax, $calID, $compact, $backup, $restore, $events, $delEvt, $fromD, $tillD;
	
	$fName = false;
	if ($compact) { compactDb(); }
	if ($backup) { $fName = backupTables(); }
	if ($restore) { restoreTables(); }
	if ($events) { delEvents($delEvt, $fromD, $tillD); }
	echo "<form action='index.php?lc' method='post'>
		<input type='hidden' name='token' value='{$_SESSION['token']}'>
		<input type='hidden' name='compact' id='compact' value='{$compact}'>
		<input type='hidden' name='backup' id='backup' value='{$backup}'>
		<input type='hidden' name='restore' id='restore' value='{$restore}'>
		<input type='hidden' name='events' id='events' value='{$events}'>
		<input type='hidden' name='delEvt' id='delEvt' value='{$delEvt}'>
		<input type='hidden' name='fromD' id='fromD' value='".IDtoDD($fromD)."'>
		<input type='hidden' name='tillD' id='tillD' value='".IDtoDD($tillD)."'>
		<input class='noPrint' type='submit' name='back' value=\"{$ax['back']}\">\n";
	if ($fName) {
		echo "&nbsp;&nbsp;&nbsp;&nbsp;<button class='noPrint' type='button' onclick=\"location.href='dloader.php?ftd={$fName}&amp;rName={$fName}'\">{$ax['iex_download_file']}</button>\n";
	}
	echo "</form>\n";
}


/* Compact database */
function compactDb() {
	global $ax;
	
	echo "<fieldset><legend>{$ax['mdb_compact']}</legend>\n";
	$deleteDT = date('Y-m-d H:i', time() - 86400*30); //remove if deleted more than 30 days ago
	//remove deleted events from db
	$stH = stPrep("DELETE FROM events WHERE status = -1 and mDateTime <= ?");
	stExec($stH,array($deleteDT));
	$stH = stPrep("VACUUM");
	if ($result = stExec($stH,null)) {
		echo "{$ax['mdb_compact_done']}.<br>{$ax['mdb_purge_done']}.<br>\n";		
	} else {
		echo "{$ax['mdb_compact_error']}.<br>\n";
	}
	echo "</fieldset>\n";
}

/* Backup db tables*/
function backupTables() {
	global $ax, $dbDir, $calID, $set, $lcV;
	
	echo "<fieldset><legend>{$ax['mdb_backup']}</legend>\n";
	//get table names
	$tables = array();
	$stH = dbQuery("SELECT name FROM sqlite_master WHERE type='table' AND name!='sqlite_sequence'");
	if (!$stH) {
		echo "{$ax['mdb_noshow_tables']}\n";
	} else {
		//save table names
		while ($row = $stH->fetch(PDO::FETCH_NUM)) { $tables[] = $row[0]; }
		$stH = null; //release statement handle!
		//make file header
		$sqlFile = "--\n";
		$sqlFile .= "-- SQL DUMP ".date('Y.m.d @ H:i')."\n";
		$sqlFile .= "-- Calendar: {$set['calendarTitle']}\n";
		$sqlFile .= "-- Database: {$dbDir}{$calID}.cdb\n";
		$sqlFile .= "--\n";
		$sqlFile .= "-- LuxCal version: {$lcV}\n";
		$sqlFile .= "-- http://www.luxsoft.eu\n";
		$sqlFile .= "--\n\n";
		//backup tables
		foreach ($tables as $table) {
			echo "{$ax['mdb_backup_table']} '{$table}' - ";
			$sqlFile .= "\n-- ".str_repeat("=", 56)."\n\n--\n-- Table {$table}\n--\n\n";
			$sqlFile .= "DROP TABLE IF EXISTS {$table};";
			$stH = dbQuery("SELECT sql FROM sqlite_master WHERE type='table' AND name='$table'");
			$createTableCode = $stH->fetch(PDO::FETCH_NUM); //SQL code for creating the table
			$stH = null; //release statement handle!
			$sqlFile .= "\n\n{$createTableCode[0]};\n\n";
			$stH = dbQuery("SELECT * FROM {$table}");
			$counter = 0;
			while($row = $stH->fetch(PDO::FETCH_NUM)) {
				$sqlFile .= "INSERT INTO \"{$table}\" VALUES (";
				foreach($row as $value) {
					$sqlFile .= isset($value) ? "'".str_replace("'","''",$value)."'," : '"",';
				}
				$sqlFile = substr($sqlFile,0,-1).");\n";
				$counter++;
			}
			$stH = null; //release statement handle!
			$sqlFile .="\n";
			echo "{$ax['mdb_backup_done']} ({$counter} {$ax['mdb_records']})<br>\n";
		}
		//save .sql dump file
		$fName = "./files/{$calID}-dump-".date('Ymd-His').'.sql';
		echo "<br>{$ax['mdb_file_name']} <strong>{$fName}</strong><br>\n";
		if (file_put_contents($fName, $sqlFile) !== false) {
			echo "{$ax['mdb_file_saved']}<br>\n";
			$result = basename($fName);
		} else {
			echo "<br><br><strong>{$ax['mdb_write_error']}</strong><br>\n";
			$result = false;
		}
	}
	echo "</fieldset>\n";
	return $result;
}

/* Restore db tables */
function restoreTables() {
	global $ax, $calID, $lcV;
	
	echo "<fieldset><legend>{$ax['mdb_restore']}</legend>\n";
	if (empty($_FILES['fName']['tmp_name'])) {
		echo "{$ax['mdb_noshow_restore']}\n";
	} elseif (substr($_FILES['fName']['name'],-4) != '.sql') {
		echo "{$ax['mdb_file_not_sql']}\n";
	} else {
		$buFile = $_FILES['fName']['tmp_name']; //get backup file name
		//Read SQL queries from $buFile
		$sqlQueries = file($buFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		unlink($buFile);
		$nrC = $nrE = $nrU = $nrG = $nrS = 0; //init counters
		$query = $lcVersion = '';
		$matches = array();
		//restore
		dbTransaction('begin');
		foreach ($sqlQueries as $qLine) {
			$qLine = trim($qLine);
			if (!$qLine) { continue; } //skip empty lines
			if (strpos('--/*',substr($qLine,0,2)) !== false) { //comment
				if (preg_match('~LuxCal version: ([0-9a-z.]{5,})~i',$qLine,$matches)) {
					$lcVersion = $matches[1]; //LuxCal version of backup file
				}
				continue; //skip comments
			}
			$query .= $qLine."\n";
			if (substr($qLine,-1) == ';') { //process query
				$stH = stPrep(trim($query)); //prepare statement
				if ($stH) { //success
					$result = stExec($stH,null); //execute statement
					if ($result and preg_match('~^INSERT\s+INTO\s+"?(events|users|groups|categories|settings)"?\s+~i',$query,$matches)) {
						switch ($matches[1]) {
							case 'events': $nrE++; break;
							case 'users': $nrU++; break;
							case 'groups': $nrG++; break;
							case 'categories': $nrC++; break;
							case 'settings': $nrS++;
						}
					}
				}
				$query = '';
			}
		}
		dbTransaction('commit');
		echo "{$ax['mdb_backup_file']}: '<strong>{$_FILES['fName']['name']}</strong>'<br><br>
{$ax['mdb_restore_table']} 'events' - {$nrE} {$ax['mdb_inserted']}<br>
{$ax['mdb_restore_table']} 'users' - {$nrU} {$ax['mdb_inserted']}<br>
{$ax['mdb_restore_table']} 'groups' - {$nrG} {$ax['mdb_inserted']}<br>
{$ax['mdb_restore_table']} 'categories' - {$nrC} {$ax['mdb_inserted']}<br>
{$ax['mdb_restore_table']} 'settings' - {$nrS} {$ax['mdb_inserted']}<br>\n";
		if ($nrC > 0 and $nrU > 0 and $nrG > 0 and $nrS > 0) {
			echo "<br><strong>{$ax['mdb_db_restored']}</strong><br>\n";
		}
		if ($lcVersion != $lcV) {
			echo "<br><strong>{$ax['mdb_run_upgrade']}</strong><br>\n";
		}
	}
	echo "</fieldset>\n";
}

/* (Un)delete events */
function delEvents($delEvt, $fromD, $tillD) {
	global $ax;
	
	$where = $delEvt ? "WHERE status >= 0 " : "WHERE status = -1 ";
	if ($fromD) { $where .= " AND sDate >= '$fromD'"; }
	if ($tillD) { $where .= " AND (CASE WHEN rType > 0 THEN rUntil ELSE CASE WHEN eDate != '9999-00-00' THEN eDate ELSE sDate END END <= '$tillD')"; }
	if ($delEvt) {
		$stH = dbQuery("UPDATE events SET status = -1, mDateTime = '".date("Y-m-d H:i")."' $where"); //delete
	} else {
		$stH = dbQuery("UPDATE events SET status = 0, mDateTime = '".date("Y-m-d H:i")."' $where"); //undelete
	}
	$nrAffected = $stH->rowCount();
	echo "<fieldset><legend>{$ax['mdb_events']}</legend>\n";
	echo ($delEvt ? $ax['mdb_deleted'] : $ax['mdb_undeleted']).": {$nrAffected}";
	echo "</fieldset>\n";
}

//init
$msg = '';
$compact = empty($_POST["compact"]) ? 0 : 1;
$backup = empty($_POST["backup"]) ? 0 : 1;
$restore = empty($_POST["restore"]) ? 0 : 1;
$events = empty($_POST["events"]) ? 0 : 1;
$delEvt = empty($_POST["delEvt"]) ? 0 : 1;
$fromD = (isset($_POST['fromD'])) ? DDtoID($_POST['fromD']) : ''; //from event date
$tillD = (isset($_POST['tillD'])) ? DDtoID($_POST['tillD']) : ''; //untill event date
if ($fromD and $tillD and $fromD > $tillD) {
	$temp = $fromD;
	$fromD = $tillD;
	$tillD = $temp;
}
$mdb_exe = isset($_POST["mdb_exe"]) ? 1 : 0;

//control logic
if ($privs == 9) {
	if ($mdb_exe and (!$compact and !$backup and !$restore and !$events)) { $msg = $ax['mdb_no_function_checked'];	}
	echo "<br><p class='error'>{$msg}</p>
		<div class='scrollBoxAd'>\n";
	if (!$mdb_exe or (!$compact and !$backup and !$restore and !$events)) {
		echo "<aside class='aside'>{$ax['xpl_manage_db']}</aside>
			<div class='centerBox'>\n";
		mdbForm(); //manage db form
		echo "</div>\n";
	} else {
		echo "<div class='centerBox'>\n";
		processFunctions();
		echo "</div>\n";
	}
	echo "</div>\n";
} else {
	echo "<p class='error'>{$ax['no_way']}</p>\n";
}
?>