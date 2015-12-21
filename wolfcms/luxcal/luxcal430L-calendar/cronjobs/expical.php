<?php
/*
= Export events in iCalendar format to .ics file in 'files' folder =

� Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

-------------------------------------------------------------------
 This script depends on and is executed via the file lcalcron.php.
 See lcalcron.php header for details.
-------------------------------------------------------------------

This file is part of the LuxCal Web Calendar.

--------- THIS SCRIPT USES THE FOLLOWING CALENDAR SETTINGS ----------
calendarTitle: The calendar title is used in the notification email
calendarUrl: The calendar URL is used in the notification email
---------------------------------------------------------------------
*/

//
//main program
//

function cronExpIcal() {
	global $lcV, $evtList, $set, $fileName;

	//set event date range
	$expIcalHist = 7; //-7 days (maybe an admin setting later)
	$sRange = date('Y-m-d',mktime(12,0,0) - 86400*$expIcalHist);
	$eRange = date('Y-m-d',time()+31536000); //+1 year
	
	$icsHead = "BEGIN:VCALENDAR
VERSION:2.0
METHOD:PUBLISH
PRODID:- // LuxCal {$lcV} // {$set['calendarTitle']} // EN
X-LC-CONTENT:user: all // cat: all // due: {$sRange} - {$eRange}
X-WR-CALNAME:Events
X-WR-TIMEZONE:".date_default_timezone_get()."
CALSCALE:GREGORIAN\r\n";

	//retrieve events from db
	retrieve($sRange,$eRange);
	$icsBody = '';
	$from = array(',',';','<br>');
	$to = array('\,','\;','\n');
	$nrExported = 0;
	$eidDone = array(); //events processed
	foreach ($evtList as $evtListDate) {
		foreach ($evtListDate as $evt) {
			if (!in_array($evt['eid'], $eidDone)) { //event not yet processed
				$vDescription = str_replace($from,$to,htmlspecialchars_decode(makeE($evt,$set['evtTemplGen'],'br','\n','345'),ENT_QUOTES));
				$vDescription = chunk_split_unicode($vDescription,72,"\r\n "); //fold to 72 chars line length
				//compile DTSTART and DTEND values
				$dateS = str_replace('-','',$evt['sda']);
				$dateE = ($evt['eda'][0] != '9') ? str_replace('-','',$evt['eda']) : $dateS;
				$timeS = str_replace(':','',$evt['sti']);
				$timeE = str_replace(':','',$evt['eti']);
				if ($timeS == '' and $timeE == '') { //all day
					$allDay = true;
					$dateE = date('Ymd',mktime (12,0,0,substr($dateE,4,2),substr($dateE,6,2)+1,substr($dateE,0,4))); //+1 day
				} else {
					$allDay = false;
					$dateS .= 'T'.$timeS.'00';
					$dateE .= 'T'.(($timeE) ? $timeE.'00' : $timeS.'01');
				}

				//compile RRULE property
				$rrule = '';
				if ($evt['r_t'] == 1) { //every 1|2|3|4 d|w|m|y
					$rrule .= "FREQ=";
					switch ($evt['r_p']) {
						case 1: $rrule .= 'DAILY'; break;
						case 2: $rrule .= 'WEEKLY'; break;
						case 3: $rrule .= 'MONTHLY'; break;
						case 4: $rrule .= 'YEARLY';
					}
					$rrule .= ";INTERVAL=".$evt['r_i'];
				}
				if ($evt['r_t'] == 2) { //every 1|2|3|4|5 m|t|w|t|f|s|s of the month
					$rrule .= $evt['r_m'] ? "FREQ=YEARLY" : "FREQ=MONTHLY";
					$rrule .= ";BYDAY=".(($evt['r_i'] != 5) ? $evt['r_i'] : '-1');
					switch ($evt['r_p']) {
						case 1: $rrule .= 'MO'; break;
						case 2: $rrule .= 'TU'; break;
						case 3: $rrule .= 'WE'; break;
						case 4: $rrule .= 'TH'; break;
						case 5: $rrule .= 'FR'; break;
						case 6: $rrule .= 'SA'; break;
						case 7: $rrule .= 'SU';
					}
					if ($evt['r_m']) {
						$rrule .= ";BYMONTH=".$evt['r_m'];
					}
				}
				if ($evt['r_u'][0] != '9') {
					$rrule .= ";UNTIL=".str_replace('-','',$evt['r_u']).'T235900';
				}
				$tStamp = mktime(substr($timeS,0,2),substr($timeS,2,2),0,substr($dateS,4,2),substr($dateS,6,2),substr($dateS,0,4));
				$icsBody .= "BEGIN:VEVENT\r\n";
				$icsBody .= "DTSTAMP:".gmdate('Ymd\THis\Z')."\r\n";
				if ($evt['adt']) {
					$icsBody .= "CREATED:".gmdate('Ymd\THis\Z', mktime(substr($evt['adt'],11,2),substr($evt['adt'],14,2),0,substr($evt['adt'],5,2),substr($evt['adt'],8,2)+1,substr($evt['adt'],0,4)))."\r\n";
				}
				if ($evt['mdt']) {
					$icsBody .= "LAST-MODIFIED:".gmdate('Ymd\THis\Z', mktime(substr($evt['mdt'],11,2),substr($evt['mdt'],14,2),0,substr($evt['mdt'],5,2),substr($evt['mdt'],8,2)+1,substr($evt['mdt'],0,4)))."\r\n";
				}
				$icsBody .= "UID:".gmdate("Ymd\THis\Z", $tStamp).trim(substr(iconv('UTF-8','ASCII//TRANSLIT//IGNORE',$evt['tit']),0,4))."-LuxCal@{$set['calendarUrl']}\r\n";
				$icsBody .= "SUMMARY:".str_replace(",","\,",htmlspecialchars_decode($evt['tit'],ENT_QUOTES))."\r\n";
				if ($evt['des']) { $icsBody .= "DESCRIPTION:{$vDescription}\r\n"; }
				$icsBody .= "CATEGORIES:".str_replace(",","\,",$evt['cnm'])."\r\n";
				if ($evt['pri']) { $icsBody .= "CLASS:PRIVATE\r\n"; }
				if ($evt['ven']) { $icsBody .= "LOCATION:".str_replace(",","\,",htmlspecialchars_decode($evt['ven'],ENT_QUOTES))."\r\n"; }
				if ($rrule) { $icsBody .= "RRULE:{$rrule}\r\n"; }
				$icsBody .= "DTSTART;".($allDay ? "VALUE=DATE" : "TZID=".date_default_timezone_get()).":{$dateS}\r\n";
				$icsBody .= "DTEND;".($allDay ? "VALUE=DATE" : "TZID=".date_default_timezone_get()).":{$dateE}\r\n"; //+1 ?
				$icsBody .= "END:VEVENT\r\n";
				$eidDone[] = $evt['eid']; //mark as processed
				$nrExported++;
			}
		}
	}
	$icsTail = "END:VCALENDAR";
	//save to iCal file
	$fileName = translit($set['calendarTitle'],true);
	file_put_contents("./files/{$fileName}.ics", $icsHead.$icsBody.$icsTail, LOCK_EX);
	return $nrExported;
}
?>
