<?php
/*
= function to retrieves event records from db =
Queries database starting from a specified date and dumps changed events in an arrays
Input params:
- start date (in 2014-04-28 format)
- allEvents; 0: apply normal filters, 1: no filters

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

function sortEvts($a,$b) { return strcmp(strval($a['sts']+1).$a['sda'].str_pad($a['sti'],5).$a['seq'], strval($b['sts']+1).$b['sda'].str_pad($b['sti'],5).$b['seq']); }

function grabChanges($sDate,$allEvents) { //query db for changes since $sDate
	global $set, $privs, $ucats, $evtList;
	
	//set filter
	$filter = '';
	if (!$allEvents) {
		if (count($_SESSION['cU']) > 0 and $_SESSION['cU'][0] != 0) {
			$filter .= " AND e.userID IN (".implode(",",$_SESSION['cU']).")";
		}
		if (count($_SESSION['cC']) > 0 and $_SESSION['cC'][0] != 0) {
			$filter .= " AND c.sequence IN (".implode(",",$_SESSION['cC']).")";
		}
		if ($_SESSION['uid'] == 1) { $filter .= " AND c.public = 1"; }
	}
	
	//retrieve events
	$q =
	"SELECT
		e.ID AS eid,
		e.private AS pri,
		e.title AS tit,
		e.venue AS ven,
		e.text1 AS des,
		e.text2 AS xf1,
		e.text3 AS xf2,
		e.userID AS uid,
		e.editor AS edr,
		e.approved AS apd,
		e.notify AS rem,
		e.sDate AS sda,
		e.eDate AS eda,
		e.sTime AS sti,
		e.eTime AS eti,
		e.rType AS r_t,
		e.rInterval AS r_i,
		e.rPeriod AS r_p,
		e.rMonth AS r_m,
		e.rUntil AS r_u,
		e.aDateTime AS adt,
		e.mDateTime AS mdt,
		e.status AS sts,
		c.name AS cnm,
		c.sequence AS seq,
		c.approve AS app,
		c.color AS cco,
		c.bgColor AS cbg,
		u.name AS una,
		g.color AS uco
	FROM events AS e
	INNER JOIN categories AS c ON c.ID = e.catID
	INNER JOIN users AS u ON u.ID = e.userID
	INNER JOIN groups AS g ON g.ID = u.groupID
	WHERE ".($ucats != '0' ? "c.ID IN ($ucats) AND " : '')."((SUBSTR(e.aDateTime,1,10) != '9999-00-00' AND SUBSTR(e.aDateTime,1,10) >= '$sDate') OR (SUBSTR(e.mDateTime,1,10) != '9999-00-00' AND SUBSTR(e.mDateTime,1,10) >= '$sDate'))".$filter;
	$stH = dbQuery($q);

	//process events
	while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
		$evt = array();
		if (($allEvents or ((!$row['app'] or $row['apd'] or $privs > 3) and !$row['pri'])) or ($row['uid'] == $_SESSION['uid']) or $privs == 9) { //private / not approved: only for current user + admin
			$evt['sda'] = $row['sda'];
			$evt['eda'] = ($row['eda'][0] != '9') ? $row['eda'] : '';
			if (($row['sti'] == '00:00') and ($row['eti'] == '23:59')) {
				$evt['ald'] = true;
				$evt['sti'] = $evt['eti'] = ''; //all day: start/end time = ""
			} else {
				$evt['ald'] = false;
				$evt['sti'] = $row['sti'];
				$evt['eti'] = ($row['eti'][0] != '9') ? $row['eti'] : ""; //no end time = ""
			}
			$evt['r_t'] = $row['r_t'];
			$evt['r_i'] = $row['r_i'];
			$evt['r_p'] = $row['r_p'];
			$evt['r_m'] = $row['r_m'];
			$evt['r_u'] = ($row['r_u'][0] != '9') ? $row['r_u'] : "";
			$evt['rem'] = $row['rem'];
			$evt['adt'] = $row['adt'];
			$evt['mdt'] = ($row['mdt'][0] != '9') ? $row['mdt'] : "";
			$evt['eid'] = $row['eid'];
			$evt['sts'] = $row['sts'];
			$evt['tit'] = $row['tit'];
			$evt['ven'] = $row['ven'];
			$evt['des'] = $row['des'];
			$evt['xf1'] = $row['xf1'];
			$evt['xf2'] = $row['xf2'];
			$evt['uid'] = $row['uid'];
			$evt['edr'] = $row['edr'];
			$evt['apd'] = $row['apd'];
			$evt['cnm'] = $row['cnm'];
			$evt['app'] = $row['app'];
			$evt['seq'] = str_pad($row['seq'],2,"0",STR_PAD_LEFT);
			$evt['uco'] = $row['uco'];
			$evt['cco'] = $row['cco'];
			$evt['cbg'] = $row['cbg'];
			$evt['una'] = $row['una'];
			$evt['mayE'] = ($privs > 2 or ($privs == 2 and $row['uid'] == $_SESSION['uid'])); //edit rights
			$modDate = substr(max($evt['adt'],$evt['mdt']),0,10);
			$evtList[$modDate][] = $evt;
		}
	}
	ksort($evtList);
	foreach ($evtList as &$events) { //sort event list per change date
		usort($events, 'sortEvts');
	}
}
?>