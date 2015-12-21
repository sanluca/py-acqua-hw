<?php
/*
= LuxCal add/edit event page =

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
?>

<?php
function notifyNow(&$evt,$what) { //notify added/edited/deleted event
	global $xx, $set, $nml, $apd, $app, $tit, $cid, $sda, $eda, $sti, $eti, $r_t, $ald, $chd, $uid, $repTxt;
	
	$emlStyle = "background:#FFFFDD; color:#000099; font:12px arial, sans-serif;"; //email body style definition
	
	//get category data
	$stH = stPrep("SELECT `name`,`color`,`bgColor`,`checkBx`,`checkLb`,`checkMk` FROM `categories` WHERE `ID` = ?");
	stExec($stH,array($cid));
	$row = $stH->fetch(PDO::FETCH_ASSOC);
	$stH = null;
	
	//compose email message
	$noteText = $what == 'add_exe' ? $xx['evt_event_added'] : ($what == 'upd_exe' ? $xx['evt_event_edited'] : $xx['evt_event_deleted']);
	$dateTime = $sda;
	if ($sti) $dateTime .= ' '.$xx['at_time'].' '.$sti;
	if ($eda or $eti) $dateTime .= ' -';
	if ($eda) $dateTime .= ' '.$eda;
	if ($eda and $eti) $dateTime .= ' '.$xx['at_time'];
	if ($eti) $dateTime .= ' '.$eti;
	$dateTime .= ($ald == 'all' ? ' '.$xx['evt_all_day'] : '').($r_t ? ' ('.$repTxt.')' : '');
	$evD = DDtoID($sda);
	$status = '';
	if (!$eda and !$r_t) { //no multi-day and not repeating
		if ($row['checkBx']) { $status .= $row['checkLb'].': '.(strpos($chd, $evD) ? $row['checkMk'] : '- -'); }
	}
	$subject = "{$set['calendarTitle']} - {$noteText}: {$tit}";
	$catColor = ($row['color'] ? "color:{$row['color']};" : "").($row['bgColor'] ? "background-color:{$row['bgColor']};" : "");
	$eStyle = $catColor ? " style=\"{$catColor}\"" : "";
	$eBoxStyle = ' style="padding-left:5px;'.(($app and !$apd) ? ' border-left:2px solid #ff0000;' : '').'"';
	$calUrl = $set['calendarUrl'].(strpos($set['calendarUrl'],'?',6) ? '&amp;' : '?').'cD='.$evD;
	$evtText = makeE($evt,$set['evtTemplGen'],'td','','12345');
	$msgText = "
<html>
<head>\n<title>{$set['calendarTitle']} {$xx['evt_mailer']}</title>
<style type='text/css'>
body, p, table {{$emlStyle}}
td {vertical-align:top;}
</style>
</head>
<body>
<p>{$set['calendarTitle']} {$xx['evt_mailer']} ".IDtoDD(date("Y-m-d"))."</p>
<p>{$noteText}:</p>
<table{$eBoxStyle}>
	<tr><td>{$xx['evt_title']}:</td><td><b><span{$eStyle}>{$tit}</span></b></td></tr>
	".($status ? "<tr><td>{$xx['evt_status']}:</td><td>{$status}</td></tr>" : '')."
	<tr><td>{$xx['evt_date_time']}:</td><td>{$dateTime}</td></tr>
	{$evtText}
</table>
<p><a href='{$calUrl}'>{$xx['evt_open_calendar']}</a></p>
</body>
</html>
";
	//send notifications
	if ($nml) { //email address(es) to notify
		$sender = $set['notifSender'] ? $uid : 0;
		sendMail($subject, $msgText, $nml, $sender);
	}
}

function overlap($eid,$cid,$sDate,$eDate,$sTime,$eTime) { //check for no overlap
	global $evtList, $privs;
	//retrieve events in same date bracket and same category
	$filter = "c.`ID` = {$cid}".($eid ? " AND e.`ID` != {$eid}" : ''); //if update, exclude event self
	if ($eDate[1] == '9') { //no end date
		$eDate = $sDate;
	}
	$sTimeNew = mktime(substr($sTime,0,2),substr($sTime,3,2),0,substr($sDate,5,2),substr($sDate,8,2),substr($sDate,0,4));
	$eTimeNew = mktime(substr($eTime,0,2),substr($eTime,3,2),0,substr($eDate,5,2),substr($eDate,8,2),substr($eDate,0,4));
	$privsBu = $privs;
	$privs = 9; //set privs temporary to admin to catch all events
	retrieve($sDate,$eDate,'',$filter);
	$privs = $privsBu;
	//check for overlap
	foreach ($evtList as $date => $calEvts) {
		foreach ($calEvts as $evt) { //check each event on this day
			$sTimeC = ($evt['sti'] and $evt['mde'] < 2) ? $evt['sti'] : '00:00';
			$eTimeC = ($evt['eti'] and $evt['mde'] != 1 and $evt['mde'] != 2) ? $evt['eti'] : '23:59';
			$sTimeCal = mktime(substr($sTimeC,0,2),substr($sTimeC,3,2),0,substr($date,5,2),substr($date,8,2),substr($date,0,4));
			$eTimeCal = mktime(substr($eTimeC,0,2),substr($eTimeC,3,2),0,substr($date,5,2),substr($date,8,2),substr($date,0,4));
			if (($sTimeNew >= $sTimeCal and $sTimeNew < $eTimeCal) or ($sTimeCal >= $sTimeNew and $sTimeCal < $eTimeNew)) {
				return true;
			}
		}
	}
	return false;
}

//get input params
$eid = isset($_REQUEST['eid']) ? $_REQUEST['eid'] : 0;
$evD = isset($_REQUEST['evD']) ? $_REQUEST['evD'] : '';
$evTs = isset($_REQUEST['evTs']) ? $_REQUEST['evTs'] : '';
$evTe = isset($_REQUEST['evTe']) ? $_REQUEST['evTe'] : '';

//sanity check
if (empty($lcV) or
		(isset($eid) and !preg_match('%^\d{1,8}$%', $eid)) or
		(!empty($evD) and !preg_match('%^\d{2,4}-\d{2}-\d{2,4}$%', $evD)) or
		(!empty($evTs) and !preg_match('%^\d{2}:\d{2}$%', $evTs)) or
		(!empty($evTe) and !preg_match('%^\d{2}:\d{2}$%', $evTe)) or
		(isset($_GET['mode']) and !preg_match('%^(add|edit)$%', $_GET['mode']))
	) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); }

//check/update mode
$refresh = $close = false;
if (isset($_POST['refresh'])) {
	$refresh = true;
} else {
	if     (isset($_POST['add_exe_cls'])) { $mode = 'add_exe'; $close = true; }
	elseif (isset($_POST['add_exe'])) { $mode = 'add_exe'; }
	elseif (isset($_POST['upd_exe_cls'])) { $mode = 'upd_exe'; $close = true; }
	elseif (isset($_POST['upd_exe'])) { $mode = 'upd_exe'; }
	elseif (isset($_POST['del_exe_cls'])) { $mode = 'del_exe'; $close = true; }
	elseif (isset($_POST['del_exe'])) { $mode = 'del_exe'; }
}

$editN = (isset($_POST['editN'])) ? $_POST['editN'] : 0;
if (isset($_POST['edit_nx'])) { $editN = 2; } //edit series
if (isset($_POST['edit_1x'])) { $editN = 1; } //edit occurence

$eMsg = $wMsg = $cMsg = NULL;

//init event data
if ($mode == 'edit' and !$refresh) { //show/edit event
	$stH = stPrep("
		SELECT e.*,c.`name` AS cnm,c.`noverlap`,c.`olErrMsg`,c.`defSlot`,c.`approve`,c.`color`,c.`bgColor`,u.`name` AS own
		FROM `events` e
		INNER JOIN `categories` c ON c.`ID` = e.`catID`
		INNER JOIN `users` u ON u.`ID` = e.`userID`
		WHERE e.`ID` = ?");
	stExec($stH,array($eid));
	$row = $stH->fetch(PDO::FETCH_ASSOC);
	$stH = null;
	$adt = $row['aDateTime'];
	$mdt = $row['mDateTime'][0] != '9' ? $row['mDateTime'] : "";
	$edr = $row['editor'];
	$tit = $row['title'];
	$ven = $row['venue'];
	$desHtml = $row['text1']; //for eventreport
	$des = remUrlImgTags($desHtml);
	$xf1Html = $row['text2']; //for eventreport
	$xf1 = remUrlImgTags($xf1Html);
	$xf2Html = $row['text3']; //for eventreport
	$xf2 = remUrlImgTags($xf2Html);
	$des = str_replace(array("<br>", "<br />"), "\r\n", $des); //replace <br> by crlf
	$cid = $row['catID'];
	$uid = $row['userID'];
	$nml = ($row['notMail']) ? $row["notMail"] : $umail;
	$apd = $row['approved'];
	$pri = $row['private'];
	if ($editN == 1) {
		$sda = IDtoDD($evD);
		$eda = "";
		$r_t = 0;
	} else {
		$sda = IDtoDD($row['sDate']);
		$eda = ($row['eDate'][0] != "9") ? IDtoDD($row['eDate']) : "";
		$r_t = $row['rType'];
	}
	$xda = $row['xDates'];
	$sti = ITtoDT(substr($row['sTime'],0,5));
	$eti = ($row['eTime'][0] != "9") ? ITtoDT(substr($row['eTime'],0,5)) : "";
	$ri1 = $rp1 = 1;
	$ri2 = $rp2 = 0;
	if ($r_t == 1) {
		$ri1 = $row['rInterval'];
		$rp1 = $row['rPeriod'];
	} elseif ($r_t == 2) {
		$ri2 = $row['rInterval'];
		$rp2 = $row['rPeriod'];
	}
	$rpm = $row['rMonth'];
	$rul = ($row['rUntil'][0] != "9") ? IDtoDD($row['rUntil']) : '';
	$chd = $row['checked'];
	$not = $row['notify'];
	$nol = $row['noverlap'];
	$oem = $row['olErrMsg'];
	$dts = $row['defSlot'];
	$app = $row['approve'];
	$col = $row['color'];
	$bco = $row['bgColor'];
	$cnm = $row['cnm'];
	$own = $row['own'];
} else { //add
	$uid = isset($_POST['uid']) ? $_POST['uid'] : (isset($_POST['oUid']) ? $_POST['oUid'] : $_SESSION['uid']);
	$tit = isset($_POST['tit']) ? strip_tags(trim($_POST['tit']),'<b><i><u><s><center>') : '';
	$ven = isset($_POST['ven']) ? strip_tags(trim($_POST['ven']),'<b><i><u><s><center>') : '';
	$des = isset($_POST['des']) ? strip_tags(trim($_POST['des']),'<a><b><i><u><s><img>') : '';
	$xf1 = isset($_POST['xf1']) ? strip_tags(trim($_POST['xf1']),'<b><i><u><s><center>') : '';
	$xf2 = isset($_POST['xf2']) ? strip_tags(trim($_POST['xf2']),'<b><i><u><s><center>') : '';
	$cid = isset($_POST['cid']) ? $_POST['cid'] : 0;
	$nml = isset($_POST['nml']) ? trim($_POST['nml']," ;") : $umail;
	$apd = !empty($_POST['apd']) ? 1 : 0;
	$pri = !empty($_POST['pri']) ? 1 : (($set['privEvents'] >= 2 and $pevts) ? 1 : 0);
	$sda = isset($_POST['sda']) ? $_POST['sda'] : '';
	$eda = isset($_POST['eda']) ? $_POST['eda'] : '';
	$xda = isset($_POST['xda']) ? $_POST['xda'] : '';
	$sti = isset($_POST['sti']) ? $_POST['sti'] : '';
	$eti = isset($_POST['eti']) ? $_POST['eti'] : '';
	$r_t = isset($_POST['r_t']) ? $_POST['r_t'] : 0;
	$ri1 = isset($_POST['ri1']) ? $_POST['ri1'] : '1';
	$rp1 = isset($_POST['rp1']) ? $_POST['rp1'] : 1;
	$ri2 = isset($_POST['ri2']) ? $_POST['ri2'] : 0;
	$rp2 = isset($_POST['rp2']) ? $_POST['rp2'] : 0;
	$rpm = isset($_POST['rpm']) ? $_POST['rpm'] : 0;
	$rul = isset($_POST['rul']) ? $_POST['rul'] : '';
	$not = isset($_POST['not']) ? $_POST['not'] : -1;
	$adt = isset($_POST['adt']) ? $_POST['adt'] : '';
	$mdt = isset($_POST['mdt']) ? $_POST['mdt'] : '';
	$edr = isset($_POST['edr']) ? $_POST['edr'] : '';
	$chd = isset($_POST['chd']) ? $_POST['chd'] : '';
	$own = isset($_POST['own']) ? $_POST['own'] : $uname;
	if ($cid) {
		$stH = stPrep("SELECT `name`,`noverlap`,`olErrMsg`,`defSlot`,`approve` FROM `categories` WHERE `ID` = ? LIMIT 1");
		stExec($stH,array($cid));
		list($cnm,$nol,$oem,$dts,$app) = $stH->fetch(PDO::FETCH_NUM);
		$stH = null; //release statement handle
	} else {
		list($cnm,$app) = array('',0); //add new event
	}
}
$non = isset($_POST['non']) ? ($_POST['non'] == 'yes' ? 1 : 0) : 0; //notify now
$oUid = isset($_POST['oUid']) ? $_POST['oUid'] : $uid; //remember original user ID
$todayDT = date("Y-m-d H:i");
$todayD = substr($todayDT,0,10);

//check rights
$mayEdit = (($ucats == '0' or $cid == 0 or strpos($ucats,strval($cid)) !== false) and ($privs > 2 or ($privs == 2 and $uid == $_SESSION['uid']))); //edit rights
$mayView = (!$pri or $privs > 2 or $uid == $_SESSION['uid']); //view rights

//make repeat text
if ($ri1 == 0) { //$ri1 = 0 doesn't make sense
	$r_t = 0;
	$ri1 = 1;
}
switch ($r_t) {
	case 0: $repTxt = $xx['evt_no_repeat']; break;
	case 1: $repTxt = $xx['evt_repeat_on'].' '.$ri1.' '.$xx['evt_period1_'.$rp1]; break;
	case 2: $repTxt = $xx['evt_repeat_on'].' '.$xx['evt_interval2_'.$ri2].' '.$wkDays[$rp2].' '.$xx['of'].' '.($rpm ? $months[$rpm-1] : $xx['evt_each_month']);
}
if ($r_t > 0 and $rul) {
	$repTxt .= ' '.$xx['evt_until'].' '.$rul;
}

if ($refresh and !ctype_digit($ri1)) {
	$eMsg .= $xx['evt_rpt_value_invalid']."<br>";
}

if ($mode == "add" and !$refresh) { //add event - preset date/times if available
	if (isset($evD)) { $sda = IDtoDD($evD); }
	if (isset($evTs)) { $sti = ITtoDT($evTs); }
	if (isset($evTe)) { $eti = ITtoDT($evTe); }
}

//all day event?
$ald = isset($_POST['ald']) ? $_POST['ald'] : '';
if (DTtoIT($sti) == '00:00' and DTtoIT($eti) == '23:59') { $ald = 'all'; }
if ($ald == 'all') { $sti = $eti = ''; }

if (!$mayEdit) goto noEdit; //last minute rights check

//add/update event
if ($mode == "add_exe" or $mode == "upd_exe") {
	$from = array('&',"'",'"');
	$to = array('&amp;',"&#039;",'&quot;');
	$tit = str_replace($from,$to,$tit);
	$ven = str_replace($from,$to,$ven);
	$des = str_replace($from,$to,$des);
	$xf1 = str_replace($from,$to,$xf1);
	$xf2 = str_replace($from,$to,$xf2);
	//add URL and IMG tags
	$desHtml = addUrlImgTags($des);
	$xf1Html = addUrlImgTags($xf1);
	$xf2Html = addUrlImgTags($xf2);
	$desHtml = str_replace(array("\r\n", "\n", "\r"), "<br>", $desHtml); //replace newline by <br>
	//validate input fields
	do {
		if (!$tit) { $eMsg .= $xx['evt_no_title']."<br>"; break; }
		if ($sda) {
			$sDate = DDtoID($sda);
			if (!$sDate) { $eMsg .= $xx['evt_bad_date'].": ".$sda."<br>"; break; }
		} else {
			$eMsg .= $xx['evt_no_start_date']."<br>"; break;
		}
		if ($eda and $eda != $sda) {
			$eDate = DDtoID($eda);
			if (!$eDate) { 
				$eMsg .= $xx['evt_bad_date'].": ".$eda."<br>"; break;
			} elseif ($eDate < $sDate) {
				$eMsg .= $xx['evt_end_before_start_date']."<br>"; break;
			}
		} else { $eDate = '9999-00-00'; }
		if ($ald == 'all') {
			$sTime = '00:00';
			$eTime = '23:59';
		} else {
			if ($sti) {
				$sTime = DTtoIT($sti);
				if (!$sTime) { $eMsg .= $xx['evt_bad_time'].": ".$sti."<br>"; break; }
			} elseif ($eDate[0] != '9') {
				$sTime = '00:00';
				$sti = ITtoDT('00:00');
			} else {
				$eMsg .= $xx['evt_no_start_time']."<br>"; break;
			}
			if ($eti) { //end time specified
				$eTime = DTtoIT($eti);
				if (!$eTime) {
					$eMsg .= $xx['evt_bad_time'].": ".$eti."<br>"; break;
				} elseif (($eDate[0] == '9' or $eDate == $sDate) and $eTime < $sTime) {
					$eMsg .= $xx['evt_end_before_start_time']."<br>"; break;
				}
				if ($sTime == $eTime and $eDate[0] == '9') { $eTime = '99:00'; }
			} else { //no end time
				if ($eDate[0] != '9') { //end date specified
					$eTime = '23:59';
				} else {
					if ($dts) { //default time slot
						$secs = mktime(substr($sTime,0,2),substr($sTime,3,2)+$dts,0,1,1,1970) ;
						$eTime = $secs <= 86340 ? date('H:i',$secs) : '23:59';
					} else { //no end date
						$eTime = '99:00';
					}
				}
			}
		}
		if ($sTime == '00:00' and $eTime == '23:59') {
			$ald = 'all';
		}
		if ($r_t > 0 and $rul) {
			$runtil = DDtoID($rul);
			if (!$runtil) {
				$eMsg .= $xx['evt_bad_rdate'].": ".$rul."<br>"; break;
			} elseif ($runtil < $sDate) {
				$eMsg .= $xx['evt_until_before_start_date']."<br>"; break;
			}
		} else {
			$runtil = "9999-00-00";
		}
		if (!ctype_digit($ri1)) {
			$eMsg .= $xx['evt_rpt_value_invalid']."<br>"; break;
		}
		if (!$not or $not == '-' or !$set['mailServer']) {
			$not = -1;
		} elseif (!ctype_digit($not)) {
			$eMsg .= $xx['evt_not_days_invalid']."<br>"; break;
		} elseif ($sDate > $todayD and $sDate <= date("Y-m-d",time() + 86400 * $not)) { //$not >= 0
			$wMsg .= $xx['evt_not_in_past']."<br>";
		}
		if ((($not >= 0 and $sDate > $todayD) or $non) and strlen($nml) < 5) {
			$eMsg .= $xx['evt_eml_list_missing']."<br>"; break;
		}
		if (strlen($nml) > 255) { $eMsg .= $xx['evt_eml_list_too_long']."<br>"; break; }
		if ($nol) {
			if ($r_t) {
				$eMsg .= $xx['evt_no_recur_if_overlay']."<br>"; break;
			}
			if ($pri) {
				$wMsg .= $xx['evt_private_no_ovl_check']."<br>";
			}
			if (overlap($eid,$cid,$sDate,$eDate,$sTime,$eTime)) { $eMsg .= $oem."<br>"; break; }
		}
		//notify now
		if ($non) {
			$evtArr = array ('cnm' => $cnm, 'ven' => $ven, 'des' => $desHtml, 'xf1' => $xf1Html, 'xf2' => $xf2Html); //Html: with hyperlinks
			notifyNow($evtArr,$mode);
		}
		//update database
		//if owner changed, default notMail = owner email
		if ($uid != $oUid) {
			$stH = stPrep("SELECT `email` FROM `users` WHERE `ID` = ?");
			stExec($stH,array($uid));
			$row = $stH->fetch(PDO::FETCH_ASSOC);
			$stH = null;
			if ($row) {
				$nml = $row['email'];
			}
			$oUid = $uid; //set original user ID to current user
		}
		//set repeat params
		$r_i = $r_t == 1 ? $ri1 : ($r_t == 2 ? $ri2 : 0);
		$r_p = $r_t == 1 ? $rp1 : ($r_t == 2 ? $rp2 : 0);
		$r_m = $rpm;

		//update tables
		if ($mode == "add_exe") { //add new event
			$q = "INSERT INTO `events` (`private`,`title`,`venue`,`text1`,`text2`,`text3`,`catID`,`userID`,`approved`,`notify`,`notMail`,`sDate`,`eDate`,`sTime`,`eTime`,`rType`,`rInterval`,`rPeriod`,`rMonth`,`rUntil`,`aDateTime`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stH = stPrep($q); //add to events table
			$result = stExec($stH,array($pri,$tit,$ven,$desHtml,$xf1Html,$xf2Html,$cid,$uid,$apd,$not,$nml,$sDate,$eDate,$sTime,$eTime,$r_t,$r_i,$r_p,$r_m,$runtil,$todayDT));
			$stH = null;
			$eid = dbLastRowId(); //set id to new event
			$cMsg .= $xx['evt_confirm_added'];
		} else { //update event
			$edr = $uname;
			$adtStamp = mktime(substr($adt,11,2),substr($adt,14,2),0,substr($adt,5,2),substr($adt,8,2),substr($adt,0,4));
			$modDT = (time() - $adtStamp > 600) ? $todayDT : '9999-00-00 00:00'; //mod time not set if < 10 mins passed
			if ($editN != 1) { //update the series
				$stH = stPrep("UPDATE `events`
					SET `private`=?, `title`=?, `venue`=?, `text1`=?, `text2`=?, `text3`=?, `catID`=?, `userID`=?, `editor`=?, `approved`=?, `notify`=?, `notMail`=?, `sDate`=?, `eDate`=?, `sTime`=?, `eTime`=?, `rType`=?, `rInterval`=?, `rPeriod`=?, `rMonth`=?, `rUntil`=?, `mDateTime`=?
						WHERE `ID`=?"); //update events table
				stExec($stH,array($pri,$tit,$ven,$desHtml,$xf1Html,$xf2Html,$cid,$uid,$uname,$apd,$not,$nml,$sDate,$eDate,$sTime,$eTime,$r_t,$r_i,$r_p,$r_m,$runtil,$modDT,$eid));
				$cMsg .= $xx['evt_confirm_saved'];
			} else { //update 1 occurrence
				$xda .= ';'.$evD;
				$stH = stPrep("UPDATE `events` SET `editor`=?, `xDates`=?, `mDateTime`=? WHERE `ID`=?");
				stExec($stH,array($uname,$xda,$todayDT,$eid)); //exclude date from series
				$stH = stPrep("INSERT INTO `events` (`private`,`title`,`venue`,`text1`,`text2`,`text3`,`catID`,`userID`,`editor`,`approved`,`notify`,`notMail`,`sDate`,`eDate`,`sTime`,`eTime`,`rType`,`rInterval`,`rPeriod`,`rMonth`,`rUntil`,`aDateTime`,`mDateTime`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"); //add new event
				stExec($stH,array($pri,$tit,$ven,$desHtml,$xf1Html,$xf2Html,$cid,$uid,$uname,$apd,$not,$nml,$sDate,$eDate,$sTime,$eTime,$r_t,$r_i,$r_p,$r_m,$runtil,$adt,$todayDT,));
				$stH = stPrep("SELECT last_insert_rowid()");
				$row = $stH->fetch(PDO::FETCH_NUM);
				$stH = null;
				$eid = $row[0]; //set id to new event
				$editN = 0;
				$cMsg .= $xx['evt_confirm_added'];
			}
		}
		//refresh calendar and close event box 
		echo "\n<script>done('".($close ? 'cr' : 'r')."');</script>\n"; //c: close window, r: reload calendar
		$mode = "edit"; //not closed
	} while (false);
}

//delete event
if ($mode == "del_exe") {
	if ($editN != 1) { //delete series
		$stH = stPrep("UPDATE `events` SET `status` = -1, `mDateTime` = ? WHERE `ID` = ?"); //delete
		stExec($stH,array($todayDT,$eid));
	} else { //delete occurrence
		$xda .= ';'.$evD;
		$stH = stPrep("UPDATE `events` SET `xDates`=? WHERE `ID` = ?"); //exclude date
		stExec($stH,array($xda,$eid));
		$editN = 0;
	}
	$cMsg = $xx['evt_confirm_deleted'];
	//refresh calendar and close event box
	echo "\n<script>done('".($close ? 'cr' : 'r')."');</script>\n"; //c: close window, r: reload calendar
	$mode = "add"; //not closed
}

noEdit:

if ($not == -1) { $not = ''; }

if ($eMsg) echo '<p class="error">'.$eMsg."</p>\n";
if ($wMsg) echo '<p class="warning">'.$wMsg."</p>\n";
if ($cMsg) echo '<p class="confirm">'.$cMsg."</p>\n";

if (strpos($mode,'exe') === false or $mayEdit) {
	if (($r_t > 0 or $sda < $eda) and $mayEdit and !$editN and !$refresh and !$eMsg and !$cMsg) {
		require './pages/eventform0.php'; //ask series or occurence
	} elseif ($mayEdit and !($app and $apd and $privs < 4)) {
		require './pages/eventform1.php';
	} elseif ($mayView) {
		require './pages/eventreport.php';
	} else {
		exit('no view rights ('.substr(basename(__FILE__),0,-4).')');
	}
} else {
	echo $xx['no_way'];
}
?>
