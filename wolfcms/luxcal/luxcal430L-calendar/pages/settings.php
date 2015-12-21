<?php
/*
= Change Calendar Settings page =

� Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

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
require './lang/ai-'.strtolower($adminLang).'.php'; //admin language file
require './common/toolboxx.php'; //admin tools
$msg = "";

if ($privs != 9) { //no admin
	echo "<p class='error'>{$ax['no_way']}</p>\n"; exit;
}

function fieldsValid($fields) {
	if ($fields) {
		foreach (str_split($fields) as $fieldNr) {
			if (strpos(' 1234567',$fieldNr) === false or substr_count($fields,$fieldNr) > 1) { return false; }
		}
	}
	return true;
}

if (isset($_POST["save"])) { //get posted settings
	foreach ($defSet as $key => $void) {
		if (!isset($_POST['pSet'][$key])) {
			$pSet[$key] = 0; //set unchecked check box to unchecked
		} else {
			$pSet[$key] = is_numeric($_POST['pSet'][$key]) ? intval($_POST['pSet'][$key]) : trim($_POST['pSet'][$key]);
		}
	}
	$calMenu = isset($_POST['calMenu']) ? $_POST['calMenu'] : 0; //calendar menu in Opt panel
} else { //get current settings
	foreach ($defSet as $key => $value) {
		$pSet[$key] = isset($set[$key]) ? $set[$key] : $value[0];
	}
}
if (isset($_POST["mail"])) { //send test mail
	$msgText = "
<html>
<head>\n<title>{$pSet['calendarTitle']} - Test Mail</title>
<style type='text/css'>
* {padding:0; margin:0;}
body, p {background:#FFFFDD; color:#000099; font:12px arial, sans-serif;}
h3 {font-size:14px; font-weight:bold; margin:20px 0px; }
</style>
</head>
<body>
<h3>{$pSet['calendarTitle']}</h3>
<p>{$ax['set_mail_sent_from']}.</p>
<br>
<p><a href='{$pSet['calendarUrl']}'>{$ax['cro_open_calendar']}</a></p>
</body>
</html>
";
	$recipient = sendMail("LuxCal - {$ax['set_test_mail']}", $msgText, $pSet['calendarEmail']);
	$msg .= $ax['set_mail_sent_to'].' '.$recipient;	
}

$errors = array_fill(0, 34, ''); $i = 0; //init

if (isset($_POST["save"])) { //validate settings
	if (!$pSet['calendarTitle']) { $errors[$i] = ' class="inputError"'; } $i++;
	if (!$pSet['calendarUrl'] or !preg_match($rxCalURL,$pSet['calendarUrl'])) { $errors[$i] = " class='inputError'"; } $i++;
	if (substr($pSet['calendarUrl'],0,4) != 'http') { $pSet['calendarUrl'] = 'http://'.$pSet['calendarUrl']; }
	if (!$pSet['calendarEmail'] or !preg_match($rxEmailX, $pSet['calendarEmail'])) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['backLinkUrl'] and substr($pSet['backLinkUrl'],0,4) != 'http') { $pSet['backLinkUrl'] = 'http://'.$pSet['backLinkUrl']; }
	if (!$pSet['timeZone']) { $errors[$i] = " class='inputError'"; } $i++;
	if (!fieldsValid($pSet['evtTemplGen'])) { $errors[$i] = " class='inputError'"; } $i++;
	if (!fieldsValid($pSet['evtTemplUpc'])) { $errors[$i] = " class='inputError'"; } $i++;
	if (!fieldsValid($pSet['popBoxFields'])) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['cookieExp'] < 1 or $pSet['cookieExp'] > 365) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['yearStart'] < 0 or $pSet['yearStart'] > 12) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['colsToShow'] < 1 or $pSet['colsToShow'] > 6) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['rowsToShow'] < 1 or $pSet['rowsToShow'] > 10) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['weeksToShow'] < 0 or $pSet['weeksToShow'] > 20) { $errors[$i] = " class='inputError'"; } $i++;
	if (!preg_match("/^[1-7]{1,7}$/", $pSet['workWeekDays'])) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['lookaheadDays'] < 1 or $pSet['lookaheadDays'] > 365) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['dwStartHour'] < 0 or $pSet['dwStartHour'] > 18 or $pSet['dwStartHour'] > ($pSet['dwEndHour'] - 4)) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['dwEndHour'] > 24 or $pSet['dwEndHour'] < 6 or $pSet['dwStartHour'] > ($pSet['dwEndHour'] - 4)) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['dwTsHeight'] < 10 or $pSet['dwTsHeight'] > 60) { $errors[$i] = " class='inputError'"; } $i++;
//the following regexs use lookahead assertion
	if (!preg_match ('%^([ymd])([^\da-zA-Z])(?!\1)([ymd])\2(?!(\1|\3))[ymd]$%',$pSet['dateFormat'])) { $errors[$i] = " class='inputError'"; } $i++;
	if (!preg_match ('%^([Md])[^\da-zA-Z]+(?!\1)[Md]$%',$pSet['MdFormat'])) { $errors[$i] = " class='inputError'"; } $i++;
	if (!preg_match ('%^([Myd])[^\da-zA-Z]+(?!\1)([Myd])[^\da-zA-Z]+(?!(\1|\2))[Myd]$%',$pSet['MdyFormat'])) { $errors[$i] = " class='inputError'"; } $i++;
	if (!preg_match ('%^([My])[^\da-zA-Z]+(?!\1)[My]$%',$pSet['MyFormat'])) { $errors[$i] = " class='inputError'"; } $i++;
	if (!preg_match ('%^(WD|[Md])[^\da-zA-Z]+(?!\1)(WD|[Md])[^\da-zA-Z]+(?!(\1|\2))(WD|[Md])$%',$pSet['DMdFormat'])) { $errors[$i] = " class='inputError'"; } $i++;
	if (!preg_match ('%^(WD|[Mdy])[^\da-zA-Z]+(?!\1)(WD|[Mdy])[^\da-zA-Z]+(?!(\1|\2))(WD|[Mdy])[^\da-zA-Z]+(?!(\1|\2\3))(WD|[Mdy])$%',$pSet['DMdyFormat'])) { $errors[$i] = " class='inputError'"; } $i++;
	if (!preg_match ('%^([Hhm])[^\da-zA-Z](?!\1)[Hhm](\s?[aA])?$%',$pSet['timeFormat'])) { $errors[$i] = " class='inputError'"; } $i++;
	if (!$pSet['smtpServer'] and $pSet['mailServer'] == 2) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['smtpPort'] < 0 or $pSet['smtpPort'] > 10025) { $errors[$i] = " class='inputError'"; } $i++; //10025 max port nr for SMTP
	if (!$pSet['smtpUser'] and $pSet['smtpAuth'] and $pSet['mailServer'] == 2) { $errors[$i] = " class='inputError'"; } $i++;
	if (!$pSet['smtpPass'] and $pSet['smtpAuth'] and $pSet['mailServer'] == 2) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['chgNofDays'] < 0 or $pSet['chgNofDays'] > 30) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['eventExp'] < 0 or $pSet['eventExp'] > 999) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['maxNoLogin'] < 0 or $pSet['maxNoLogin'] > 365) { $errors[$i] = " class='inputError'"; } $i++;
	if (!fieldsValid($pSet['popFieldsMcal'])) { $errors[$i] = " class='inputError'"; } $i++;
	if (!fieldsValid($pSet['popFieldsSbar'])) { $errors[$i] = " class='inputError'"; } $i++;
	if ($pSet['sideBarDays'] < 1 or $pSet['sideBarDays'] > 365) { $errors[$i] = " class='inputError'"; } $i++;

	//no errors, save settings in database
	if (!in_array(" class='inputError'",$errors)) {
		if ($calMenu != $dbSel) {
			$dbSel = $calMenu;
			saveConfig(); //save config data
		}
		$result = saveSettings($pSet);
		if ($result) {
			$msg = $ax['set_settings_saved'];
		} else {
			$msg = $ax['set_save_error'];
		}
	} else { //errors found
		$msg .= $ax['set_missing_invalid'];
	}
}

echo "<br><p class=\"error noPrint\">".(($msg) ? $msg : $ax['hover_for_details'])."</p>\n";
//display form fields
echo "<form action='index.php?lc' method='post'>
	<input type='hidden' name='token' value='{$_SESSION['token']}'>
	<input class='button saveSettings noPrint' type='submit' name='save' value='{$ax['set_save_settings']}'>
	<div class='scrollBoxSe'>
	<div class='centerBoxFix'>";
$selected = " selected='selected'";
$i = 0; //init errors index
echo "<fieldset><legend>{$ax['set_general_settings']}</legend>
	
	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['calVersionDb_text'])."', 'normal')\">{$ax['calVersionDb_label']}:</div>
	<div class='sValue'>".LCV." - ".($dbType == 'SQLite' ? $dbDir : '')."{$calID}</div><br>
	
	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['calTitle_text'])."', 'normal')\">{$ax['calTitle_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[calendarTitle]' size='45' value=\"{$pSet['calendarTitle']}\"></div><br>
	
	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['calUrl_text'])."', 'normal')\">{$ax['calUrl_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[calendarUrl]' size='45' value=\"{$pSet['calendarUrl']}\"></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['backLinkUrl_text'])."', 'normal')\">{$ax['backLinkUrl_label']}:</div>
	<div class='sValue'><input type='text' name='pSet[backLinkUrl]' size='45' value=\"{$pSet['backLinkUrl']}\"></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['calEmail_text'])."', 'normal')\">{$ax['calEmail_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[calendarEmail]' size='24' value=\"{$pSet['calendarEmail']}\"> <input class='button noPrint' type='submit' name='mail' value=\"{$ax['set_test_mail']}\"></div><br>

	<div class=\"sLabel\" onmouseover=\"pop(this,'".htmlspecialchars($ax['timeZone_text'])."', 'normal')\">{$ax['timeZone_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[timeZone]' size='24' value=\"{$pSet['timeZone']}\"> {$ax['see']}: <strong>[<a href='http://us3.php.net/manual/en/timezones.php' target='_blank'>{$ax['time_zones']}</a>]</strong></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['notifSender_text'])."', 'normal')\">{$ax['notifSender_label']}:</div>
	<div class='sValue'><input type='radio' id='notc' name='pSet[notifSender]' value='0'".($pSet['notifSender'] == 0 ? " checked='checked'" : '')."><label for='notc'>{$ax['calendar']}</label>&nbsp;&nbsp;&nbsp;
	<input type='radio' id='notu' name='pSet[notifSender]' value='1'".($pSet['notifSender'] == 1 ? " checked='checked'" : '')."><label for='notu'>{$ax['user']}</label></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['rssFeed_text'])."', 'normal')\">{$ax['rssFeed_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[rssFeed]' value='1'".($pSet['rssFeed'] == 1 ? " checked='checked'" : '')."></div>
</fieldset>\n";
echo "<fieldset><legend>{$ax['set_navbar_settings']}</legend>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['navButText_text'])."', 'normal')\">{$ax['navButText_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[navButText]' value='1'".($pSet['navButText'] == 1 ? " checked='checked'" : '')."></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['sideLists_text'])."', 'normal')\">{$ax['sideLists_label']}:</div>
	<div class='sValue'><input type='checkbox' id='toap' name='pSet[navToapList]' value='1'".($pSet['navToapList'] == 1 ? " checked='checked'" : '')."><label for='toap'>{$ax['navToapList_label']}</label>&nbsp;&nbsp;

	<input type='checkbox' id='todo' name='pSet[navTodoList]' value='1'".($pSet['navTodoList'] == 1 ? " checked='checked'" : '')."><label for='todo'>{$ax['navTodoList_label']}</label>&nbsp;&nbsp;
	<input type='checkbox' id='upco' name='pSet[navUpcoList]' value='1'".($pSet['navUpcoList'] == 1 ? " checked='checked'" : '')."><label for='upco'>{$ax['navUpcoList_label']}</label></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['optionsPanel_text'])."', 'normal')\">{$ax['optionsPanel_label']}:</div>
	<div class='sValue'><input type='checkbox' id='calm' name='calMenu' value='1'".($dbSel == 1 ? " checked='checked'" : '')."><label for='calm'>{$ax['calMenu_label']}</label>&nbsp;&nbsp;
	<input type='checkbox' id='groupm' name='pSet[groupMenu]' value='1'".($pSet['groupMenu'] == 1 ? " checked='checked'" : '')."><label for='groupm'>{$ax['groupMenu_label']}</label>&nbsp;&nbsp;
	<input type='checkbox' id='userm' name='pSet[userMenu]' value='1'".($pSet['userMenu'] == 1 ? " checked='checked'" : '')."><label for='userm'>{$ax['userMenu_label']}</label>&nbsp;&nbsp;
	<input type='checkbox' id='catm' name='pSet[catMenu]' value='1'".($pSet['catMenu'] == 1 ? " checked='checked'" : '')."><label for='catm'>{$ax['catMenu_label']}</label>&nbsp;&nbsp;
	<input type='checkbox' id='langm' name='pSet[langMenu]' value='1'".($pSet['langMenu'] == 1 ? " checked='checked'" : '')."><label for='langm'>{$ax['langMenu_label']}</label></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['defaultView_text'])."', 'normal')\">{$ax['defaultView_label']}:</div>
	<div class='sValue'><select name='pSet[defaultView]'>
	<option value='1'".($pSet['defaultView'] == "1" ? $selected : '').">{$xx['hdr_year']}</option>
	<option value='2'".($pSet['defaultView'] == "2" ? $selected : '').">{$xx['hdr_month_full']}</option>
	<option value='3'".($pSet['defaultView'] == "3" ? $selected : '').">{$xx['hdr_month_work']}</option>
	<option value='4'".($pSet['defaultView'] == "4" ? $selected : '').">{$xx['hdr_week_full']}</option>
	<option value='5'".($pSet['defaultView'] == "5" ? $selected : '').">{$xx['hdr_week_work']}</option>
	<option value='6'".($pSet['defaultView'] == "6" ? $selected : '').">{$xx['hdr_day']}</option>
	<option value='7'".($pSet['defaultView'] == "7" ? $selected : '').">{$xx['hdr_upcoming']}</option>
	<option value='8'".($pSet['defaultView'] == "8" ? $selected : '').">{$xx['hdr_changes']}</option>
	</select></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['language_text'])."', 'normal')\">{$ax['language_label']}:</div>
	<div class='sValue'><select name='pSet[language]'>\n";
	$files = scandir("lang/");
	foreach ($files as $file) {
		if (substr($file, 0, 3) == "ui-") {
			$lang = strtolower(substr($file,3,-4));
			echo "\t<option value=\"{$lang}\"".(strtolower($pSet['language']) == $lang ? $selected : '').">".ucfirst($lang)."</option>\n";
		}
	}
echo "</select></div><br>
</fieldset>\n";
echo "<fieldset><legend>{$ax['set_event_settings']}</legend>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['ownerTitle_text'])."', 'normal')\">{$ax['ownerTitle_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[ownerTitle]' value='1'".($pSet['ownerTitle'] == 1 ? " checked='checked'" : '')."></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['privEvents_text'])."', 'normal')\">{$ax['privEvents_label']}:</div>
	<div class='sValue'><select name='pSet[privEvents]'>
	<option value='0'".($pSet['privEvents'] == "0" ? $selected : '').">{$ax['disabled']}</option>
	<option value='1'".($pSet['privEvents'] == "1" ? $selected : '').">{$ax['enabled']}</option>
	<option value='2'".($pSet['privEvents'] == "2" ? $selected : '').">{$ax['default']}</option>
	<option value='3'".($pSet['privEvents'] == "3" ? $selected : '').">{$ax['always']}</option>
	</select></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['privEvents_text'])."', 'normal')\">{$ax['privEvents_label']}:</div>
	<div class='sValue'><select name='pSet[privEvents]'>
	<option value='0'".($pSet['privEvents'] == "0" ? $selected : '').">{$ax['disabled']}</option>
	<option value='1'".($pSet['privEvents'] == "1" ? $selected : '').">{$ax['enabled']}</option>
	</select></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['details4All_text'])."', 'normal')\">{$ax['details4All_label']}:</div>
	<div class='sValue'><input type='radio' id='d4a0' name='pSet[details4All]' value='0'".($pSet['details4All'] == 0 ? " checked='checked'" : '')."><label for='d4a0'>{$ax['disabled']}</label>&nbsp;&nbsp;&nbsp;
	<input type='radio' id='d4a1' name='pSet[details4All]' value='1'".($pSet['details4All'] == 1 ? " checked='checked'" : '')."><label for='d4a1'>{$ax['enabled']}</label>&nbsp;&nbsp;&nbsp;
	<input type='radio' id='d4a2' name='pSet[details4All]' value='2'".($pSet['details4All'] == 2 ? " checked='checked'" : '')."><label for='d4a2'>{$ax['logged_in']}</label></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['evtDelButton_text'])."', 'normal')\">{$ax['evtDelButton_label']}:</div>
	<div class='sValue'><input type='radio' id='delb0' name='pSet[evtDelButton]' value='0'".($pSet['evtDelButton'] == 0 ? " checked='checked'" : '')."><label for='delb0'>{$ax['disabled']}</label>&nbsp;&nbsp;&nbsp;
	<input type='radio' id='delb1' name='pSet[evtDelButton]' value='1'".($pSet['evtDelButton'] == 1 ? " checked='checked'" : '')."><label for='delb1'>{$ax['enabled']}</label>&nbsp;&nbsp;&nbsp;
	<input type='radio' id='delb2' name='pSet[evtDelButton]' value='2'".($pSet['evtDelButton'] == 2 ? " checked='checked'" : '')."><label for='delb2'>{$ax['manager_only']}</label></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['eventColor_text'])."', 'normal')\">{$ax['eventColor_label']}:</div>
	<div class='sValue'><input type='radio' id='evtc0' name='pSet[eventColor]' value='0'".($pSet['eventColor'] == 0 ? " checked='checked'" : '')."><label for='evtc0'>{$ax['user_group']}</label>&nbsp;&nbsp;&nbsp;
	<input type='radio' id='evtc1' name='pSet[eventColor]' value='1'".($pSet['eventColor'] == 1 ? " checked='checked'" : '')."><label for='evtc1'>{$ax['event_cat']}</label></div><br>
	
	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['xFieldx_text'])."', 'normal')\">{$ax['xField1_label']}:</div>
	<div class='sValue'>{$ax['xField_label']}: <input type='text' name='pSet[xField1Label]' maxlength='15' size='12' value=\"{$pSet['xField1Label']}\">&nbsp;&nbsp;&nbsp;<input type='checkbox' id='xF1pub' name='pSet[xField1Public]' value='1'".($pSet['xField1Public'] == 1 ? " checked='checked'" : '')."><label for='xF1pub'>{$ax['xField_public']}</label></div>
	
	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['xFieldx_text'])."', 'normal')\">{$ax['xField2_label']}:</div>
	<div class='sValue'>{$ax['xField_label']}: <input type='text' name='pSet[xField2Label]' maxlength='15' size='12' value=\"{$pSet['xField2Label']}\">&nbsp;&nbsp;&nbsp;<input type='checkbox' id='xF2pub' name='pSet[xField2Public]' value='1'".($pSet['xField2Public'] == 1 ? " checked='checked'" : '')."><label for='xF2pub'>{$ax['xField_public']}</label></div>
</fieldset>\n";
echo "<fieldset><legend>{$ax['set_user_settings']}</legend>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['selfReg_text'])."', 'normal')\">{$ax['selfReg_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[selfReg]' value='1'".($pSet['selfReg'] == 1 ? " checked='checked'" : '')."></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['selfRegGrp_text'])."', 'normal')\">{$ax['selfRegGrp_label']}:</div>
	<div class='sValue'><select name='pSet[selfRegGrp]'>\n";
	$stH = dbQuery("SELECT `ID`,`name`,`color` FROM `groups` WHERE `status` >= 0 ORDER BY `name`");
	while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
		if ($row['ID'] != 2) {
			$color = $row['color'] ? " style='background-color:{$row['color']};'" : '';
			$selAttr = $row['ID'] == $pSet['selfRegGrp'] ? $selected : '';
			echo "<option value='{$row['ID']}'{$color}{$selAttr}>{$row['name']}</option>\n";
		}
	}
	echo "</select></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['selfRegNot_text'])."', 'normal')\">{$ax['selfRegNot_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[selfRegNot]' value='1'".($pSet['selfRegNot'] == 1 ? " checked='checked'" : '')."></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['restLastSel_text'])."', 'normal')\">{$ax['restLastSel_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[restLastSel]' value='1'".($pSet['restLastSel'] == 1 ? " checked='checked'" : '')."></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['cookieExp_text'])."', 'normal')\">{$ax['cookieExp_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[cookieExp]' maxlength='3' size='2' value='{$pSet['cookieExp']}'> (1 - 365)</div><br>
</fieldset>\n";
echo "<fieldset><legend>{$ax['set_view_settings']}</legend>
	
	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['evtTemplGen_text'].'<br>'.$ax['templFields_text'])."', 'normal')\">{$ax['evtTemplGen_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[evtTemplGen]' maxlength='7' size='6' value=\"{$pSet['evtTemplGen']}\"></div><br>
	
	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['evtTemplUpc_text'].'<br>'.$ax['templFields_text'])."', 'normal')\">{$ax['evtTemplUpc_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[evtTemplUpc]' maxlength='7' size='6' value=\"{$pSet['evtTemplUpc']}\"></div><br>
	
	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['popBoxFields_text'].'<br>'.$ax['templFields_text'])."', 'normal')\">{$ax['popBoxFields_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[popBoxFields]' maxlength='7' size='6' value=\"{$pSet['popBoxFields']}\"></div><br>
	
	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['popBoxShow_text'])."', 'normal')\">{$ax['popBoxShow_label']}:</div>
	<div class='sValue'><input type='checkbox' id='popby' name='pSet[popBoxYear]' value='1'".($pSet['popBoxYear'] == 1 ? " checked='checked'" : '')."><label for='popby'>{$ax['year']}</label>&nbsp;&nbsp;
	<input type='checkbox' id='popbm' name='pSet[popBoxMonth]' value='1'".($pSet['popBoxMonth'] == 1 ? " checked='checked'" : '')."><label for='popbm'>{$ax['month']}</label>&nbsp;&nbsp;
	<input type='checkbox' id='popbw' name='pSet[popBoxWkDay]' value='1'".($pSet['popBoxWkDay'] == 1 ? " checked='checked'" : '')."><label for='popbw'>{$ax['week_day']}</label>&nbsp;&nbsp;
	<input type='checkbox' id='popbu' name='pSet[popBoxUpc]' value='1'".($pSet['popBoxUpc'] == 1 ? " checked='checked'" : '')."><label for='popbu'>{$ax['upcoming']}</label></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['yearStart_text'])."', 'normal')\">{$ax['yearStart_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[yearStart]' maxlength='2' size='2' value='{$pSet['yearStart']}'> (1 - 12 {$ax['or']} 0)</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['colsToShow_text'])."', 'normal')\">{$ax['colsToShow_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[colsToShow]' maxlength='1' size='2' value='{$pSet['colsToShow']}'> (1 - 6)</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['rowsToShow_text'])."', 'normal')\">{$ax['rowsToShow_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[rowsToShow]' maxlength='2' size='2' value='{$pSet['rowsToShow']}'> (1 - 10)</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['weeksToShow_text'])."', 'normal')\">{$ax['weeksToShow_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[weeksToShow]' maxlength='2' size='2' value='{$pSet['weeksToShow']}'> (2 - 20 {$ax['or']} 0 {$ax['or']} 1)</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['workWeekDays_text'])."', 'normal')\">{$ax['workWeekDays_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[workWeekDays]' maxlength='7' size='5' value='{$pSet['workWeekDays']}'> (1: {$wkDays_l[1]}, 2: {$wkDays_l[2]} .... 7: {$wkDays_l[7]})</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['lookaheadDays_text'])."', 'normal')\">{$ax['lookaheadDays_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[lookaheadDays]' maxlength='3' size='2' value='{$pSet['lookaheadDays']}'> (1 - 365)</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['dwStartHour_text'])."', 'normal')\">{$ax['dwStartHour_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[dwStartHour]' maxlength='2' size='2' value='{$pSet['dwStartHour']}'> (0 - 18)</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['dwEndHour_text'])."', 'normal')\">{$ax['dwEndHour_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[dwEndHour]' maxlength='2' size='2' value='{$pSet['dwEndHour']}'> (6 - 24)</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['dwTimeSlot_text'])."', 'normal')\">{$ax['dwTimeSlot_label']}:</div>
	<div class='sValue'><select name='pSet[dwTimeSlot]'>
	<option value='10'".($pSet['dwTimeSlot'] == "10" ? $selected : '').">10</option>
	<option value='15'".($pSet['dwTimeSlot'] == "15" ? $selected : '').">15</option>
	<option value='20'".($pSet['dwTimeSlot'] == "20" ? $selected : '').">20</option>
	<option value='30'".($pSet['dwTimeSlot'] == "30" ? $selected : '').">30</option>
	<option value='60'".($pSet['dwTimeSlot'] == "60" ? $selected : '').">60</option>
	</select> {$ax['minutes']}</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['dwTsHeight_text'])."', 'normal')\">{$ax['dwTsHeight_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[dwTsHeight]' maxlength='2' size='2' value='{$pSet['dwTsHeight']}'> {$ax['pixels']} (10 - 60)</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['showInMView_text'])."', 'normal')\">{$ax['showInMView_label']}:</div>
	<div class='sValue'><input type='checkbox' id='showurl' name='pSet[showLinkInMV]' value='1'".($pSet['showLinkInMV'] == 1 ? " checked='checked'" : '')."><label for='showurl'>{$ax['urls']}</label>&nbsp;&nbsp;
	<input type='checkbox' id='showimg' name='pSet[showImageInMV]' value='1'".($pSet['showImageInMV'] == 1 ? " checked='checked'" : '')."><label for='showimg'>{$ax['images']}</label></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['monthInDCell_text'])."', 'normal')\">{$ax['monthInDCell_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[monthInDCell]' value='1'".($pSet['monthInDCell'] == 1 ? " checked='checked'" : '')."></div><br>
</fieldset>\n";
echo "<fieldset><legend>{$ax['set_dt_settings']}</legend>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['dateFormat_text'])."', 'normal')\">{$ax['dateFormat_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[dateFormat]' size='4' value='{$pSet['dateFormat']}'> ({$ax['dateFormat_expl']})</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['MdFormat_text'])."', 'normal')\">{$ax['MdFormat_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[MdFormat]' size='4' value='{$pSet['MdFormat']}'> ({$ax['MdFormat_expl']})</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['MdyFormat_text'])."', 'normal')\">{$ax['MdyFormat_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[MdyFormat]' size='4' value='{$pSet['MdyFormat']}'> ({$ax['MdyFormat_expl']})</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['MyFormat_text'])."', 'normal')\">{$ax['MyFormat_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[MyFormat]' size='4' value='{$pSet['MyFormat']}'> ({$ax['MyFormat_expl']})</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['DMdFormat_text'])."', 'normal')\">{$ax['DMdFormat_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[DMdFormat]' size='7' value='{$pSet['DMdFormat']}'> ({$ax['DMdFormat_expl']})</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['DMdyFormat_text'])."', 'normal')\">{$ax['DMdyFormat_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[DMdyFormat]' size='7' value='{$pSet['DMdyFormat']}'> ({$ax['DMdyFormat_expl']})</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['timeFormat_text'])."', 'normal')\">{$ax['timeFormat_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[timeFormat]' size='4' value='{$pSet['timeFormat']}'> ({$ax['timeFormat_expl']})</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['weekStart_text'])."', 'normal')\">{$ax['weekStart_label']}:</div>
	<div class='sValue'><input type='radio' id='wks0' name='pSet[weekStart]' value='0'".($pSet['weekStart'] == 0 ? " checked='checked'" : '')."><label for='wks0'>{$ax['sunday']}</label>&nbsp;&nbsp;&nbsp;
	<input type='radio' id='wks1' name='pSet[weekStart]' value='1'".($pSet['weekStart'] == 1 ? " checked='checked'" : '')."><label for='wks1'>{$ax['monday']}</label></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['weekNumber_text'])."', 'normal')\">{$ax['weekNumber_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[weekNumber]' value='1'".($pSet['weekNumber'] == 1 ? " checked='checked'" : '')."></div><br>
</fieldset>\n";
echo "<fieldset><legend>{$ax['set_email_settings']}</legend>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['mailServer_text'])."', 'normal')\">{$ax['mailServer_label']}:</div>
	<div class='sValue'><input type='radio' id='mails0' name='pSet[mailServer]' value='0'".($pSet['mailServer'] == 0 ? " checked='checked'" : '')."><label for='mails0'>{$ax['disabled']}</label>&nbsp;&nbsp;&nbsp;
	<input type='radio' id='mails1' name='pSet[mailServer]' value='1'".($pSet['mailServer'] == 1 ? " checked='checked'" : '')."><label for='mails1'>{$ax['php_mail']}</label>&nbsp;&nbsp;&nbsp;
	<input type='radio' id='mails2' name='pSet[mailServer]' value='2'".($pSet['mailServer'] == 2 ? " checked='checked'" : '')."><label for='mails2'>{$ax['smtp_mail']}</label></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['smtpServer_text'])."', 'normal')\">{$ax['smtpServer_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[smtpServer]' size='45' value=\"{$pSet['smtpServer']}\"></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['smtpPort_text'])."', 'normal')\">{$ax['smtpPort_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[smtpPort]' maxlength='5' size='4' value=\"{$pSet['smtpPort']}\"></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['smtpSsl_text'])."', 'normal')\">{$ax['smtpSsl_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[smtpSsl]' value='1'".($pSet['smtpSsl'] ? " checked='checked'" : '')."></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['smtpAuth_text'])."', 'normal')\">{$ax['smtpAuth_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[smtpAuth]' value='1'".($pSet['smtpAuth'] ? " checked='checked'" : '')."></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['smtpUser_text'])."', 'normal')\">{$ax['smtpUser_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[smtpUser]' size='45' value=\"{$pSet['smtpUser']}\"></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['smtpPass_text'])."', 'normal')\">{$ax['smtpPass_label']}:</div>
	<div class='sValue'><input type='password'{$errors[$i++]} name='pSet[smtpPass]' size='45' value=\"{$pSet['smtpPass']}\"></div><br>
</fieldset>\n";
echo "<fieldset><legend>{$ax['set_perfun_settings']}</legend>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['cronSummary_text'])."', 'normal')\">{$ax['cronSummary_label']}:</div>
	<div class='sValue'><input type='radio' id='acs0' name='pSet[adminCronSum]' value='0'".($pSet['adminCronSum'] == 0 ? " checked='checked'" : '')."><label for='acs0'>{$ax['disabled']}</label>&nbsp;&nbsp;&nbsp;
	<input type='radio' id='acs1' name='pSet[adminCronSum]' value='1'".($pSet['adminCronSum'] == 1 ? " checked='checked'" : '')."><label for='acs1'>{$ax['enabled']}</label></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['chgEmailList_text'])."', 'normal')\">{$ax['chgEmailList_label']}:</div>
	<div class='sValue'><input type='text' name='pSet[chgEmailList]' size='45' value=\"{$pSet['chgEmailList']}\"></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['chgNofDays_text'])."', 'normal')\">{$ax['chgNofDays_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[chgNofDays]' maxlength='2' size='2' value='{$pSet['chgNofDays']}'> (0 - 30)</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['icsExport_text'])."', 'normal')\">{$ax['icsExport_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[icsExport]' value='1'".($pSet['icsExport'] == 1 ? " checked='checked'" : '')."></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['eventExp_text'])."', 'normal')\">{$ax['eventExp_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[eventExp]' maxlength='3' size='2' value='{$pSet['eventExp']}'> (0 - 999)</div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['maxNoLogin_text'])."', 'normal')\">{$ax['maxNoLogin_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[maxNoLogin]' maxlength='3' size='2' value='{$pSet['maxNoLogin']}'> (0 - 365)</div><br>
</fieldset>\n";
echo "<fieldset><legend>{$ax['set_minical_settings']}</legend>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['miniCalView_text'])."', 'normal')\">{$ax['miniCalView_label']}:</div>
	<div class='sValue'><select name='pSet[miniCalView]'>
	<option value='1'".($pSet['miniCalView'] == '1' ? $selected : '').">{$xx['hdr_month_full']}</option>
	<option value='2'".($pSet['miniCalView'] == '2' ? $selected : '').">{$xx['hdr_month_work']}</option>
	</select></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['miniCalPost_text'])."', 'normal')\">{$ax['miniCalPost_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[miniCalPost]' value='1'".($pSet['miniCalPost'] == 1 ? " checked='checked'" : '')."></div><br>
	
	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['popFieldsMcal_text'].'<br>'.$ax['templFields_text'])."', 'normal')\">{$ax['popFieldsMcal_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[popFieldsMcal]' maxlength='7' size='6' value=\"{$pSet['popFieldsMcal']}\"></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['mCalUrlFull_text'])."', 'normal')\">{$ax['mCalUrlFull_label']}:</div>
	<div class='sValue'><input type='text' name='pSet[mCalUrlFull]' size='45' value='{$pSet['mCalUrlFull']}'></div><br>
</fieldset>\n";
echo "<fieldset><legend>{$ax['set_sidebar_settings']}</legend>
	
	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['popFieldsSbar_text'].'<br>'.$ax['templFields_text'])."', 'normal')\">{$ax['popFieldsSbar_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[popFieldsSbar]' maxlength='7' size='6' value=\"{$pSet['popFieldsSbar']}\"></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['showLinkInSB_text'])."', 'normal')\">{$ax['showLinkInSB_label']}:</div>
	<div class='sValue'><input type='checkbox' name='pSet[showLinkInSB]' value='1'".($pSet['showLinkInSB'] == 1 ? " checked='checked'" : '')."></div><br>

	<div class='sLabel' onmouseover=\"pop(this,'".htmlspecialchars($ax['sideBarDays_text'])."', 'normal')\">{$ax['sideBarDays_label']}:</div>
	<div class='sValue'><input type='text'{$errors[$i++]} name='pSet[sideBarDays]' maxlength='3' size='2' value='{$pSet['sideBarDays']}'> (1 - 365)</div><br>\n";
?>
</fieldset>
</div>
</div>
</form>
