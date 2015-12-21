<?php
//sanity check
if (empty($lcV)) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); } //launch via script only

//functions
function catMenu($selCat) {
	global $ucats;

	$stH = dbQuery("SELECT `ID`,`name`,`color`,`bgColor` FROM `categories` WHERE `status` >= 0".($ucats != '0' ? " AND `ID` IN ($ucats)" : '')." ORDER BY sequence");
	if ($stH) {
		while (list($ID,$name,$color,$bgColor) = $stH->fetch(PDO::FETCH_NUM)) {
			$selected = ($selCat == $ID) ? " selected='selected'" : '';
			$catColor = ($color ? "color:{$color};" : '').($bgColor ? "background-color:{$bgColor};" : '');
			echo "<option value='{$ID}'".($catColor ? " style='{$catColor}'" : '').$selected.">{$name}</option>\n";
		}
	}
}

function userMenu($selUser) {
	$stH = dbQuery("SELECT `ID`,`name` FROM `users` WHERE `status` >= 0 ORDER BY `name`");
	if ($stH) {
		while (list($ID,$name) = $stH->fetch(PDO::FETCH_NUM)) {
			$selected = ($selUser == $ID) ? " selected='selected'" : '';
			echo "<option value='{$ID}'{$selected}>{$name}</option>\n";
		}
	}
}

echo "<form id='event' name='event' method='post' action='index.php?lc&amp;xP=10'>
	<input type='hidden' name='token' value='{$_SESSION['token']}'>
	<input type='hidden' name='mode' value='{$mode}'>
	<input type='hidden' name='eid' value='{$eid}'>
	<input type='hidden' name='evD' value='{$evD}'>
	<input type='hidden' name='oUid' value='{$oUid}'>
	<input type='hidden' name='editN' value='{$editN}'>
	<input type='hidden' name='chd' value='{$chd}'>
	<input type='hidden' name='xda' value='{$xda}'>
	<input type='hidden' name='adt' value='{$adt}'>
	<input type='hidden' name='mdt' value='{$mdt}'>
	<input type='hidden' name='own' value=\"{$own}\">
	<input type='hidden' name='edr' value=\"{$edr}\">\n";
if ($app and $privs > 3) { //manager or admin
	echo "<div class='apdBar'><input type='checkbox' name='apd' id='apd' value='yes'".($apd ? " checked='checked'" : '')."><label for='apd'>{$xx['evt_approved']}</label></div>\n";
}
echo "<table class='evtForm'>
	<col class='col1'><col class='col2'><col class='col3'><col>
	<tr>
		<td>{$xx['evt_title']}:</td><td colspan='3'><input type='text' name='tit' id='tit' style='width:100%' maxlength='100' value=\"{$tit}\"></td>
	</tr>";
	$totEvtTempl = $set['evtTemplGen'].$set['evtTemplUpc'].$set['popBoxFields'];
	if (strpos($totEvtTempl,'1') !== false) {
		echo "<tr><td>{$xx['evt_venue']}:</td><td colspan='3'><input type='text' name='ven' id='ven' style='width:100%' maxlength='64' value=\"{$ven}\" list='venList'>\n";
		echo "<datalist id='venList'>\n";
		if (isset($_SESSION['venList'])) { //venue array exists
			ksort($_SESSION['venList'],SORT_LOCALE_STRING);
			foreach ($_SESSION['venList'] as $venue => $dummy) {
				ksort($_SESSION['venList'],SORT_LOCALE_STRING);
				echo "<option value='{$venue}'>\n"; //generate auto-complete value
			}
		}
		echo "</datalist>\n</td></tr>\n";
	}
	//category always required
	echo "<tr><td>{$xx['evt_category']}:</td><td colspan='2'>\n<select name='cid' id='cid'>"; catMenu($cid); echo "</select>\n</td>";
	echo "<td>";
	if ($_SESSION['uid'] > 1 and $pevts and ($set['privEvents'] == 1 or $set['privEvents'] == 2)) { //logged in
		echo "<input type='checkbox' name='pri' id='pri' value='yes'".($pri ? " checked='checked'" : '')."><label for='pri'>{$xx['evt_private']}</label>\n";
	}
	echo "</td>\n</tr>\n";
	if (strpos($totEvtTempl,'3') !== false) {
		echo "<tr><td class='arrow'>{$xx['evt_description']}:<br><br><span class='noPrint' onmouseover=\"pop(this,'".htmlspecialchars($xx['evt_descr_help'])."', 'normal')\">({$xx['evt_help']})</span></td>";
		echo "<td colspan='3'><textarea name='des' id='des' rows='3' cols='1' style='width:100%'>{$des}</textarea></td></tr>\n";
	}
	if (strpos($totEvtTempl,'4') !== false) {
		if ($_SESSION['uid'] > 1 or $set['xField1Public']) {
			echo "<tr><td class='arrow'>".($set['xField1Label'] ? "{$set['xField1Label']}" : $xx['sch_extra_field1']).":</td><td colspan='3'><input type='text' name='xf1' id='xf1' style='width:100%' maxlength='64' value=\"{$xf1}\"></td></tr>\n";
		} else {
			echo "<input type='hidden' name='xf1' value='{$xf1}'>";
		}
	}
	if (strpos($totEvtTempl,'5') !== false) {
		if ($_SESSION['uid'] > 1 or $set['xField2Public']) {
			echo "<tr><td class='arrow'>".($set['xField2Label'] ? "{$set['xField2Label']}" : $xx['sch_extra_field2']).":</td><td colspan='3'><input type='text' name='xf2' id='xf2' style='width:100%' maxlength='64' value=\"{$xf2}\"></td></tr>\n";
		} else {
			echo "<input type='hidden' name='xf2' value='{$xf2}'>";
		}
	}

	if ($ald == "all") {
		$hidden = " style=\"visibility: hidden;\"";
		$checked= " checked=\"checked\"";
	} else {
		$hidden = $checked = '';
	}
	echo "<tr><td colspan='4'><hr></td></tr>
	<tr>
		<td>{$xx['evt_start_date']}:</td>
		<td><input type='text' name='sda' id='sda' value='{$sda}' size='8'><button title=\"{$xx['evt_select_date']}\" onclick=\"dPicker(0,'nill','sda','eda');return false;\">&larr;</button></td>
		<td id='dTimeS'{$hidden}><input type='text' name='sti' id='sti' value='{$sti}' size='6'><button title=\"{$xx['evt_select_time']}\" onclick=\"tPicker('sti');return false;\">&larr;</button></td>
		<td><input type='checkbox' onclick=\"hide_times(this);\" name='ald' id='ald' value='all'{$checked}><label for='ald'>{$xx['evt_all_day']}</label></td>
	</tr>
	<tr>\n";
	if ($mevts) {
		echo "<td>{$xx['evt_end_date']}:</td>
		<td><input type='text' name='eda' id='eda' value='{$eda}' size='8'><button title=\"{$xx['evt_select_date']}\" onclick=\"dPicker(1,'nill','eda','sda');return false;\">&larr;</button></td>\n";
	} else {
		echo "<td colspan='2'></td>";
	}
	echo "<td id='dTimeE'{$hidden}><input type='text' name='eti' id='eti' value='{$eti}' size='6'><button title=\"{$xx['evt_select_time']}\" onclick=\"tPicker('eti');return false;\">&larr;</button></td>
		<td></td>
	</tr>\n";
	if ($revts) {
		echo "<tr>
			<td colspan='4'>{$repTxt}&nbsp;<button class='noPrint' type='button' onclick=\"show('repBox');\">{$xx['evt_change']}</button><br></td>
		</tr>\n";
	}
	if ($set['mailServer']) {
		echo "<tr><td colspan='4'><hr></td></tr>
			<tr>\n<td>{$xx['evt_notify']}:</td>
			<td colspan='3'>
			<input type='checkbox' name='non' id='non' value='yes'".($non ? " checked='checked'" : '')."><label for='non'>{$xx['evt_now_and_or']}</label>&nbsp;
			<input type='text' name='not' style='width:20px' maxlength='2' value=\"{$not}\"> {$xx['evt_days_before_event']}
			<span class='floatR arrow noPrint' onmouseover=\"pop(this,'".htmlspecialchars($xx['evt_mail_help'])."', 'normal')\">({$xx['evt_help']})</span>
			</td>\n</tr>
			<tr>
			<td colspan='4'>
			<input type='text' name='nml' id='nml' style='width:100%' maxlength='255' value=\"{$nml}\">
			</td>\n</tr>\n";
	}
	echo "<tr>\n<td colspan='4'><hr></td>\n</tr>
		<tr>\n<td>{$xx['evt_added']}:</td><td colspan='3'>".IDTtoDDT($adt)." {$xx['by']} ";
	if ($privs > 3) { //manager or admin
		echo "<select name='uid' id='uid'>\n";
			userMenu($uid);
		echo "</select>\n";
	} else {
		echo $own;
	}
	if ($mdt and $edr) { echo "</td>\n</tr>\n<tr>\n<td>{$xx['evt_edited']}:</td><td colspan='3'>".IDTtoDDT($mdt)." {$xx['by']} {$edr}"; }
	echo "</td>\n</tr>\n</table>\n";

	$selected = array_fill(0,5,'');
	$selected[$rp1] = " selected='selected'";
	if ($revts) {
echo "<div class='repBox' id='repBox'>
	<div class='floatC'><b>{$xx['evt_set_repeat']}</b><hr></div>
	<div>
		<input type='radio' name='r_t' id='r_t0' value='0'".(!$r_t ? " checked='checked'" : '')."><label for='r_t0'>{$xx['evt_no_repeat']}</label>
		<br>
		<input type='radio' name='r_t' id='r_t1' value='1'".($r_t == "1" ? " checked='checked'" : '')."><label for='r_t1'>{$xx['evt_repeat_on']}</label>
		<input type='text' name='ri1' style='width:20px' maxlength='2' onclick=\"\$I('r_t1').checked=true\" value='{$ri1}'>
		<select name='rp1' id='rp1' onclick=\"\$I('r_t1').checked=true\">
			<option value='1'{$selected[1]}>{$xx['evt_period1_1']}</option>
			<option value='2'{$selected[2]}>{$xx['evt_period1_2']}</option>
			<option value='3'{$selected[3]}>{$xx['evt_period1_3']}</option>
			<option value='4'{$selected[4]}>{$xx['evt_period1_4']}</option>
		</select>
		<br>
		<input type='radio' name='r_t' id='r_t2' value='2'".($r_t == "2" ? 'checked="checked"' : '')."><label for='r_t2'>{$xx['evt_repeat_on']}</label> ";
	$selected = array_fill(0,6,'');
	$selected[$ri2] = " selected='selected'";
echo "<select name='ri2' id='ri2' onclick=\"\$I('r_t2').checked=true\">
			<option value='1'{$selected[1]}>{$xx['evt_interval2_1']}</option>
			<option value='2'{$selected[2]}>{$xx['evt_interval2_2']}</option>
			<option value='3'{$selected[3]}>{$xx['evt_interval2_3']}</option>
			<option value='4'{$selected[4]}>{$xx['evt_interval2_4']}</option>
			<option value='5'{$selected[5]}>{$xx['evt_interval2_5']}</option>
		</select> ";
	$selected = array_fill(0,8,'');
	$selected[$rp2] = " selected='selected'";
echo "<select name='rp2' id='rp2' onclick=\"\$I('r_t2').checked=true\">
			<option value='1'{$selected[1]}>{$wkDays[1]}</option>
			<option value='2'{$selected[2]}>{$wkDays[2]}</option>
			<option value='3'{$selected[3]}>{$wkDays[3]}</option>
			<option value='4'{$selected[4]}>{$wkDays[4]}</option>
			<option value='5'{$selected[5]}>{$wkDays[5]}</option>
			<option value='6'{$selected[6]}>{$wkDays[6]}</option>
			<option value='7'{$selected[7]}>{$wkDays[7]}</option>
		</select>
		{$xx['of']} ";
	$selected = array_fill(0,13,'');
	$selected[$rpm] = " selected='selected'";
echo "<select name='rpm' id='rpm' onclick=\"\$I('r_t2').checked=true\">
			<option value='0'{$selected[0]}>{$xx['evt_each_month']}</option>
			<option value='1'{$selected[1]}>{$months[0]}</option>
			<option value='2'{$selected[2]}>{$months[1]}</option>
			<option value='3'{$selected[3]}>{$months[2]}</option>
			<option value='4'{$selected[4]}>{$months[3]}</option>
			<option value='5'{$selected[5]}>{$months[4]}</option>
			<option value='6'{$selected[6]}>{$months[5]}</option>
			<option value='7'{$selected[7]}>{$months[6]}</option>
			<option value='8'{$selected[8]}>{$months[7]}</option>
			<option value='9'{$selected[9]}>{$months[8]}</option>
			<option value='10'{$selected[10]}>{$months[9]}</option>
			<option value='11'{$selected[11]}>{$months[10]}</option>
			<option value='12'{$selected[12]}>{$months[11]}</option>
		</select>
		<br><br>{$xx['evt_until']} 
		<input type='text' name='rul' id='rul' value='{$rul}' size='9'>
		<button title=\"{$xx['evt_select_date']}\" onclick=\"dPicker(1,'nill','rul','sda');return false;\">&larr;</button> ({$xx['evt_blank_no_end']})
	</div>
	<div class='floatC'><hr><input type='submit' name='refresh' value=\"{$xx['evt_set']}\"></div>
</div>\n";
	}
echo "<div class='floatC noPrint'>\n";
if ($mode == "add" or $mode == "add_exe") {
	echo "<input type='submit' name='add_exe_cls' value=\"{$xx['evt_add_close']}\">
		&nbsp;&nbsp;<input type='submit' name='add_exe' value=\"{$xx['evt_add']}\">";
} else {
	echo "<input type='submit' name='upd_exe_cls' value=\"{$xx['evt_save_close']}\">
		&nbsp;&nbsp;<input type='submit' name='upd_exe' value=\"{$xx['evt_save']}\">
		&nbsp;&nbsp;<input type='submit' name='add_exe' value=\"{$xx['evt_clone']}\">\n";
	if ($set['evtDelButton'] == 1 or ($set['evtDelButton'] == 2 and $privs > 3)) {
		echo "&nbsp;&nbsp;<input type='submit' name='del_exe' value=\"{$xx['evt_delete']}\">\n";
	}
}
echo "&nbsp;&nbsp;<button type='button' onclick='javascript:self.close();'>{$xx['evt_close']}</button>
</div>
</form>\n";
?>
<script>$I("tit").focus();</script>
