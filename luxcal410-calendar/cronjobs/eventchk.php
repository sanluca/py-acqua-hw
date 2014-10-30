<?php
/*
= check events and delete event if expired more than $eventExp =

� Copyright 2009-2014 LuxSoft - www.LuxSoft.eu

-------------------------------------------------------------------
 This script depends on and is executed via the file lcalcron.php.
 See lcalcron.php header for details.
-------------------------------------------------------------------

This file is part of the LuxCal Web Calendar.

--------- THIS SCRIPT USES THE FOLLOWING CALENDAR SETTINGS --------
eventExp: Number of days after due date when event can be deleted
-------------------------------------------------------------------
*/

function cronEventChk() {
	global $set;
	
	//initialize
	$todayDT = date("Y-m-d H:i");
	$expireD = date("Y-m-d",time() - ($set['eventExp'] * 86400)); //expire date

	//delete events (set status to -1) which expired >= $set['eventExp'] days ago
	$stH = stPrep("UPDATE events e
		INNER JOIN categories c ON c.ID = e.catID
		SET e.status = -1, e.mDateTime = ?
		WHERE ((c.repeat = 0 AND e.rType = 0 AND (IF(e.eDate != '9999-00-00', e.eDate, e.sDate) <= ?)) OR e.rUntil <= ?)
	");
	stExec($stH,array($todayDT,$expireD,$expireD));
	$nrDeleted = $stH->rowCount();
	return $nrDeleted;
}
?>
