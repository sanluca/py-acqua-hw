<?php
/*
=== DATABASE RELATED FUNCTIONS - SQLITE ===

© Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

//Current LuxCal version
define("LCV","4.3.0L");

//Log message
function logError($logName,$logMsg,$newMsg,$script='-') {
	date_default_timezone_set(@date_default_timezone_get());
	if ($script == '-') { $script = $_SERVER['PHP_SELF']; }
	file_put_contents("./logs/{$logName}.log", ($newMsg ? "\n".date('Y.m.d H:i:s')." Script: ".htmlentities($script) : '')." - {$logMsg}", FILE_APPEND);
}

//Connect to database
function dbConnect($calID,$exitOnError=1) {
	global $dbDir;

	$fileName = "{$dbDir}{$calID}.cdb";
	if ($exitOnError and (!file_exists($fileName) or @filesize($fileName) == 0)) {
		exit("Calendar '{$dbDir}{$calID}' not found.");
	}
	try {
		$dbH = new PDO("sqlite:{$fileName}");
		$dbH->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		if ($exitOnError) {
			logError('sql',"Database connection error: ".$e->getMessage(),true);
			exit("Could not connect to the calendar database. See 'logs/sql.log'");
		} else {
			return false; //error
		}
	}
	return $dbH; //return db handle
}

//Query database
function dbQuery($query,$logError=1) {
global $dbH;

	try {
		$stH = $dbH->query($query);
	}
	catch (PDOException $e) {
		if ($logError) {
			logError('sql',"SQL query error: ".$e->getMessage()."\nQuery string: {$query}",true);
			exit("SQL error. See 'logs/sql.log'");
		} else {
			return false; //error
		}
	}
	return $stH; //result statement handle
}

//Begin / commit / roll back transaction
function dbTransaction($action,$logError=1) {
global $dbH;

	try {
		switch ($action[0]) {
			case 'b': $result = $dbH->beginTransaction(); break;
			case 'c': $result = $dbH->commit(); break;
			case 'r': $result = $dbH->rollBack();
		}
	}
	catch (PDOException $e) {
		if ($logError) {
			logError('sql',"SQL transaction error: ".$e->getMessage()."\nQuery: {$action} transaction",true);
			exit("SQL error. See 'logs/sql.log'");
		} else {
			return false; //error
		}
	}
	return $result;
}

//Get last inserted row ID
function dbLastRowId() {
global $dbH;

	return $dbH->lastInsertId();
}

//Prepare SQL statement 
function stPrep($query,$logError=1) {
global $dbH;

	try {
		$stH = $dbH->prepare($query);
	}
	catch (PDOException $e) {
		if ($logError) {
			logError('sql',"SQL prepare error: ".$e->getMessage()."\nQuery string: {$query}",true);
			exit("SQL error. See 'logs/sql.log'");
		} else {
			return false; //error
		}
	}
	return $stH; //successful
}

//Execute prepared statement 
function stExec($stH,$values,$logError=1) {
	try {
		$result = $stH->execute(!empty($values) ? $values : array());
	}
	catch (PDOException $e) {
		if ($logError) {
			logError('sql',"SQL execute error: ".$e->getMessage()."\nValues string: ".implode(',',$values),true);
			exit("SQL error. See 'logs/sql.log'");
		} else {
			return false; //error
		}
	}
	return $result; //successful
}

function getTableSql($table) { //get SQL code to create table
	$stH = dbQuery("SELECT `sql` FROM `sqlite_master` WHERE `type` = 'table' AND `name` = '{$table}'");
	$sqlCode = $stH->fetch(PDO::FETCH_NUM);
	$stH = null; //release statement handle!
	return $sqlCode[0];
}

function getTables($table='*') { //get array with one or all db tables
	$tableSet = $table == '*' ? "'events','categories','users','groups','settings'" : "'{$table}'";
	$tables = array();
	$stH = dbQuery("SELECT `name` FROM `sqlite_master` WHERE `type` = 'table' AND `name` IN ($tableSet)"); //get table names
	while ($row = $stH->fetch(PDO::FETCH_NUM)) {
		$tables[] = $row[0]; //add table name
	}
	$stH = null; //release statement handle!
	return $tables; //array with table names
}

function getCIDs() { //get array with installed calendar IDs
	global $dbDir;
	
	$cals = array();
	if (($dirScan = scandir($dbDir)) != false) {
		foreach($dirScan as $entry) {
			if (substr($entry,-4) == '.cdb') { //calendar db
				$cals[] = substr($entry,0,-4);
			}
		}
	}
	return $cals; //array with cal names
}

function getCals() { //get array with name and title of installed calendars
	global $dbH, $dbDir;

	$curCals = array();
	if (($dirScan = scandir($dbDir)) != false) {
		foreach($dirScan as $entry) {
			if (substr($entry,-4) == '.cdb') { //db
				$calID = substr($entry,0,-4);
				if ($dbH = dbConnect($calID,0)) { //connect to db and get calendar title
					if ($stH = dbQuery("SELECT `value` FROM `settings` WHERE `name` = 'calendarTitle'",0)) {
						if ($row = $stH->fetch(PDO::FETCH_NUM)) { //found
							$stH = null; //release statement handle
							$curCals[$calID] = $row[0]; //add calendar name and title
						}
					}
					$dbH = null; //close db
				}
			}
		}
	}
	return $curCals; //array with cal names & titles
}

function getSettings() { //Get settings from database
	$set = array();
	$stH = dbQuery("SELECT `name`,`value` FROM `settings`");
	while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
		$set[$row['name']] = is_numeric($row['value']) ? intval($row['value']) : $row['value'];
	}
	$stH = null; //release statement handle
	return $set; //array with settings
}
?>