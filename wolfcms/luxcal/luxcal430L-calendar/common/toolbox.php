<?php
/*
=== REGEX DEFINITIONS & TOOLBOX FUNCTIONS ===

� Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.
*/

/*---------- REGEX DEFINITIONS ----------*/

$rxEmail = '~^[^@\\".,\s\[\]]+(\.[^@\\".,\s\[\]]+)*@[a-z\d]+(-*[a-z\d]+)*(\.[a-z\d]+(-*[a-z\d]+)*)*(\.[a-z]{2,6})$~i'; //jd@skyweb.com

$rxEmailX = '~^(.+<)?[^@\\".,\s\[\]]+(\.[^@\\".,\s\[\]]+)*@[a-z\d]+(-*[a-z\d]+)*(\.[a-z\d]+(-*[a-z\d]+)*)*(\.[a-z]{2,6})>?$~i'; //John D. <jd@skyweb.com>

$rxULink = '~<a\s[^<>]*?href=["\'](https?://([^|<>\s]{5,}))["\'][^|<>]*?>([^|<>]*?)</a>~i'; //<a href=...>title</a>

$rxURL = '~(?:^|\s|\()(https?://)?((?:[\w-]+\.)+(?!jpg|gif|png)[a-z]{2,15}(?:[/?#:][^<>\s\[]*)?)(?:\s*\[\s*([^<>\[]+?)\s*\]|\s|<|\.|\)|$)~im'; //http://www.mysite.xxx [title]

$rxCalURL = '~^(https?://)?((?:[\w-]+\.)+[a-z]{2,15}(?:[/?#:][^<>\s\[]*)?|localhost|(?:[0-9]{1,3}\.){3}[0-9]{1,3})(/[^<>\s\[]+)*/?$~i'; //http://www.mysite.xxx/mycal/calendar.php (www.mysite.xxx | localhost | ip address)

$rxIMGTags = '~<img\s+src=["\'](?:.+?\w/)?(\w[^/]*/\w[^|<>\s"\'./]*\.(?:gif|jpg|png))["\'].*?>~i'; // <img src=...>

$rxIMG = '~(?:^|\s)(([^\s/.]*/)*([^\s/.]+\.(?:gif|jpg|png)))(?:\.|\s|$)~i'; //thumbnails/mynail.gif (or .jpg, or .png)


/*---------- TOOLBOX FUNCTIONS ----------*/

//Time formatting

function ITtoDT($time,$format = '') { //convert hh:mm(:ss) to display time
	global $set;
	if (!$time) { return ''; }
	if (!$format) { $format = $set['timeFormat']; }
	$ampm = stripos($format,'a') !== false;
	if ($ampm and substr($time,0,2) =='24') { $time = '12'.substr($time,2); }
	$phpFormat = str_replace(array('H','h','m'),array(($ampm ? 'h' : 'H'),($ampm ? 'g' : 'G'),'i'),$format);
	return date($phpFormat,strtotime($time));
}

function DTtoIT($time,$format = '') { //convert Display Time to ISO Time hh:mm
	global $set;
	$time = trim($time);
	if (!$time) { return ''; }
	if (!$format) { $format = $set['timeFormat']; }
	$ampm = stripos($format,'a') !== false;
	$regEx = $ampm ? '(0{0,1}[0-9]|1[0-2])[:.][0-5][0-9]\s*(a|A|p|P)(m|M)' : '(0{0,1}[0-9]|1[0-9]|2[0-4])[:.][0-5][0-9]([:.][0-5][0-9]){0,1}';
	if (!preg_match("%^".$regEx."$%",$time)) { return false; }
	$tStamp = strtotime($time);
	return ($tStamp < 1) ? false : date("H:i", $tStamp);
}

//Date formatting
function IDtoDD($date,$format = '') { //convert ISO date (yyyy mm dd) to display date
	global $set;
	if (!$date) { return ''; }
	if (!$format) { $format = $set['dateFormat']; }
	return str_replace(array('y','m','d'),array(substr($date,0,4),substr($date,5,2),substr($date,8,2)),$format);
}

function IDTtoDDT($dateTime) { //convert ISO date+time (yyyy mm dd hh:mm:ss) to display date
	global $xx;
	$date = substr($dateTime,0,10);
	if (!$date) { return ''; }
	$time = substr($dateTime,11,5);
	$dD = IDtoDD($date);
	$dT = ITtoDT($time);
	return $dD.($dT ? " {$xx['at_time']} {$dT}" : '');
}

function DDtoID($date,$format = '') { //validate display date and convert to ISO date (yyyy-mm-dd)
	global $set;
	$date = trim($date);
	if (!$date) { return ''; }
	if (!$format) { $format = $set['dateFormat']; }
	$indexY = strpos($format,'y') / 2;
	$indexM = strpos($format,'m') / 2;
	$indexD = strpos($format,'d') / 2;
	$split = preg_split('%[^\d]%',$date);
	if ($split[$indexY] < 1900 or $split[$indexY] > 2099) { return false; } //year out of range
	if (!checkdate(intval($split[$indexM]),intval($split[$indexD]),intval($split[$indexY]))) { return false; } //invalid date
	return $split[$indexY]."-".str_pad($split[$indexM], 2, "0", STR_PAD_LEFT)."-".str_pad($split[$indexD], 2, "0", STR_PAD_LEFT);
}

function makeD($date,$formatNr,$x3 = '') { //make long date
	global $set, $months, $months_m, $wkDays, $wkDays_l;
	$y = substr($date, 0, 4);
	$m = ltrim(substr($date, 5, 2),"0");
	$d = ltrim(substr($date, 8, 2),"0");
	if ($formatNr > 3) {
		$wdNr = date("N", mktime(12,0,0,$m,$d,$y));
		$wkDay = $x3 ? $wkDays_l[$wdNr] : $wkDays[$wdNr];
	}
	$month = $x3 ? $months_m[$m - 1] : $months[$m - 1];
	switch ($formatNr) {
	case 1: //Dec... 9 / 9 dec...
		return str_replace(array('d','M'),array($d,$month),$set['MdFormat']);
	case 2: //Dec... 9, 2010 / 9 dec... 2010
		return str_replace(array('d','y','M'),array($d,$y,$month),$set['MdyFormat']);
	case 3: //Dec... 2010 / dec... 2010
		return str_replace(array('y','M'),array($y,$month),$set['MyFormat']);
	case 4: //Mon..., Dec... 9 / mon 9 dec
		return str_replace(array('d','M','WD'),array($d,$month,$wkDay),$set['DMdFormat']);
	case 5: //Mon..., Dec... 9, 2010 / mon... 9 dec... 2010
		return str_replace(array('d','y','M','WD'),array($d,$y,$month,$wkDay),$set['DMdyFormat']);
	}
}

function makeHovT(&$evt) { //make hover box time
	switch ($evt['mde']) { //multi-day event?
		case 0: return ITtoDT($evt['sti']).($evt['eti'] ? ' - '.ITtoDT($evt['eti']) : ''); //no
		case 1: return (($evt['sti'] != '00:00' and $evt['sti'] != '') ? ITtoDT($evt['sti']) : '&bull;').'&middot;&middot;&middot;'; //first
		case 2: return '&middot;&middot;&middot;'; //in between
		case 3: return '&middot;&middot;&middot;'.(($evt['eti'] < '23:59' and $evt['eti'] != '') ? ITtoDT($evt['eti']) : '&bull;'); //last
	}
}

function makeE(&$evt,$template,$type,$glue,$show = '1234567') { //make event body using template
	global $set, $xx;

	if (!$set['xField1Public'] and $_SESSION['uid'] == 1) { $show = str_replace('4','',$show); } //exclude xField 1
	if (!$set['xField2Public'] and $_SESSION['uid'] == 1) { $show = str_replace('5','',$show); } //exclude xField 2

	$eArray = array();
	if ($type == 'br') { //type br
		foreach (str_split($template) as $fieldNr) {
			if (strpos($show,$fieldNr) !== false) {
				switch ($fieldNr) {
				case '1': 
					if ($evt['ven']) { $eArray[] = "{$xx['evt_venue']}: {$evt['ven']}"; } break;
				case '2':
					$eArray[] = "{$xx['evt_category']}: {$evt['cnm']}"; break;
				case '3':
					if ($evt['des']) { $eArray[] = $evt['des']; } break;
				case '4':
					if ($evt['xf1']) { $eArray[] = ($set['xField1Label'] ? "{$set['xField1Label']}: " : '').$evt['xf1']; } break;
				case '5':
					if ($evt['xf2']) { $eArray[] = ($set['xField2Label'] ? "{$set['xField2Label']}: " : '').$evt['xf2']; } break;
				case '6':
					if ($evt['rem'] >= 0) { $eArray[] = "{$xx['vws_notify']}: {$evt['rem']} {$xx['vws_days']}"; } break;
				case '7':
					$eArray[] = "{$xx['vws_added']}: ".IDTtoDDT($evt['adt'])." ({$evt['una']})";
					if ($evt['mdt'] and $evt['edr']) { $eArray[] = "{$xx['vws_edited']}: ".IDTtoDDT($evt['mdt'])." ({$evt['edr']})"; }
				}
			}
		}
	} else { //type td
		foreach (str_split($template) as $fieldNr) {
			if (strpos($show,$fieldNr) !== false) {
				switch ($fieldNr) {
				case '1': 
					if ($evt['ven']) { $eArray[] = "<tr><td>{$xx['evt_venue']}:</td><td>{$evt['ven']}</td></tr>"; } break;
				case '2':
					$eArray[] = "<tr><td>{$xx['evt_category']}:</td><td>{$evt['cnm']}</td></tr>"; break;
				case '3':
					if ($evt['des']) { $eArray[] = "<tr><td>{$xx['evt_description']}:</td><td>{$evt['des']}</td></tr>"; } break;
				case '4':
					if ($evt['xf1']) { $eArray[] = "<tr><td>{$set['xField1Label']}:</td><td>{$evt['xf1']}</td></tr>"; } break;
				case '5':
					if ($evt['xf2']) { $eArray[] = "<tr><td>{$set['xField2Label']}:</td><td>{$evt['xf2']}</td></tr>"; } break;
				case '6':
					if ($evt['rem'] >= 0) { $eArray[] = "<tr><td>{$xx['vws_notify']}:</td><td>{$evt['rem']} {$xx['vws_days']}</td></tr>"; } break;
				case '7':
					$eArray[] = "<tr><td>{$xx['vws_added']}:</td><td>".IDTtoDDT($evt['adt'])." ({$evt['una']})</td></tr>";
					if ($evt['mdt'] and $evt['edr']) { $eArray[] = "<tr><td>{$xx['vws_edited']}:</td><td>".IDTtoDDT($evt['mdt'])." ({$evt['edr']})</td></tr>"; }
				}
			}
		}
	}
	return implode($glue,$eArray);
}

//make calendar base URL
function calBaseUrl() {
	$baseUrl = 'http'.(!empty($_SERVER['HTTPS']) ? 's' : '').'://'.$_SERVER['SERVER_NAME'];
	if ($_SERVER["SERVER_PORT"] != '80') {
		$baseUrl .= ':'.$_SERVER['SERVER_PORT'];
	}
	$baseUrl .= rtrim(dirname($_SERVER["PHP_SELF"]),'/').'/'; // add calendar directory
	return $baseUrl;
}

//add URL and IMG tags
function addUrlImgTags($html,$ui='xx') {
	global $set, $rxURL, $rxIMG;

	if ($ui[0] == 'x') { //create URL links
		$html = preg_replace_callback($rxURL,function ($m) { return " <a class='link' href='".(!empty($m[1])?$m[1]:"http://").$m[2]."' target='_blank'>".(!empty($m[3])?$m[3]:$m[2])."</a>"; },$html);
	}
	if ($ui[1] == 'x') { //create image links
		$html = preg_replace_callback($rxIMG,function ($m) { return " <img src='".calBaseUrl().(!empty($m[2])?$m[2]:'thumbnails/')."{$m[3]}' alt='{$m[3]}'>"; },$html);
	}
	return $html;
}

//remove URL and IMG tags
function remUrlImgTags($html,$ui='xx') {
	global $rxULink, $rxIMGTags;

	if ($ui[0] == 'x') { //remove URL tags
		$html = preg_replace_callback($rxULink,function ($m) { return $m[1].($m[2]!=$m[3]?" [".$m[3]."]":""); },$html);
	}
	if ($ui[1] == 'x') { //remove image tags
		$html = preg_replace($rxIMGTags,"$1 ",$html); //remove tags
		$html = str_replace('thumbnails/','',$html); //remove default dir
	}
	return $html;
}

//chunk split unicode string
function chunk_split_unicode($str,$len,$eol) {
	$chunks = array_chunk(preg_split('%%u',$str,-1,PREG_SPLIT_NO_EMPTY),$len);
	$str = '';
	foreach ($chunks as $chunk) {
		$str .= implode($chunk).$eol;
	}
	return rtrim($str);
}

//emulate register_globals off
function unregisterGlobals() {
	if (ini_get('register_globals')) {
		if (isset($_REQUEST['GLOBALS']) || isset($_FILES['GLOBALS'])) { die('GLOBALS overwrite attempt detected'); }
		$knownGlobals = array('GLOBALS','_GET','_POST','_COOKIE','_REQUEST','_SERVER','_ENV','_FILES'); //vars that shouldn't be unset
		$superGlobals = array_merge($_GET,$_POST,$_COOKIE,$_SERVER,$_ENV,$_FILES,(isset($_SESSION) and is_array($_SESSION)) ? $_SESSION : array());
		foreach ($superGlobals as $k => $void) {
			if (!in_array($k,$knownGlobals) and isset($GLOBALS[$k])) { unset($GLOBALS[$k]); }
		}
	}
}

//transliterate text string (e.g. file name)
function translit($text,$strict=false) {
	setlocale(LC_CTYPE,'en_US');
	$transText = iconv('UTF-8','ASCII//TRANSLIT',$text);
	if ($strict) {
		return str_replace(array(' ','/','\\','?','%','*',':',';','{','}',"'",'"'),'_',$transText);
	} else {
		return $transText;
	}
}

//Validate index.php vars
function validVars() {
	$passed = true;
	foreach ($_GET as $key => $value) {
		switch ($key) {
		case 'lc': $passed = preg_match('~^1?$~',$value); break;
		case 'cal': $passed = preg_match('~^[a-z\d]{1,20}?$~',$value); break;
		case 'cP': $passed = preg_match('~^\d{1,2}$~',$value); break;
		case 'xP': $passed = preg_match('~^\d{1,2}$~',$value); break;
		case 'cG': $passed = (is_array($value) and ctype_digit(implode($value))); break;
		case 'cU': $passed = (is_array($value) and ctype_digit(implode($value))); break;
		case 'cC': $passed = (is_array($value) and ctype_digit(implode($value))); break;
		case 'cL': $passed = preg_match('~^[a-zA-Z]{1,12}$~',$value); break;
		case 'cD': $passed = empty($value) ? true : preg_match('~^\d{4}-\d{2}-\d{2}$~',$value); break;
		case 'nD': $passed = preg_match('~^\d{2,4}.\d{2}.\d{2,4}$~',$value); break;
		case 'hdr': $passed = preg_match('~^(0|1)$~',$value); break;
		case 'bake': $passed = preg_match('~^(0|1)$~',$value); break;
		case 'logout': $passed = preg_match('~^1?$~',$value); break;
		default: if (is_string($value)) $_GET[$key] = htmlspecialchars(strip_tags(trim($value)),ENT_QUOTES,'UTF-8');
		}
		if (!$passed) {
			logMessage('luxcal','Access denied. Invalid GET variable ('.$key.'='.htmlspecialchars($value,ENT_QUOTES,'UTF-8').')',true);
			exit('not permitted (index.php - invalid var: '.$key.')');
		}
	}
	if (empty($_SESSION)) { //session expired
		unset($_POST);
	} elseif (!empty($_POST)) { //validate POST vars
		if (empty($_SESSION['token']) or empty($_POST['token']) or $_SESSION['token'] != $_POST['token']) {
			logMessage('luxcal',"Access denied. Spoofed form submission detected.\nForm input keys:\n- ".implode("\n- ",array_keys($_POST)),true);
			exit("not permitted (CSRF)<br>SESSION['token']: {$_SESSION['token']}<br>POST['token']: {$_POST['token']}");
		}
		foreach ($_POST as $key => $value) {
			if (is_string($value)) {
				$_POST[$key] = strip_tags(trim($value),'<a><b><i><u><s><img><center>');
			}
		}
	}
}

//Log message
function logMessage($logName,$logMsg,$newMsg,$script='-') {
	date_default_timezone_set(@date_default_timezone_get());
	if ($script == '-') { $script = $_SERVER['PHP_SELF']; }
	file_put_contents("./logs/{$logName}.log", ($newMsg ? "\n".date('Y.m.d H:i:s')." Script: ".htmlentities($script) : '')." - {$logMsg}", FILE_APPEND);
}

//Save session data to cookie LCAL_<calID>
function saveLastSel($calID,$bake = 1) {
	global $set;

	$lastSet = array('cP' => $_SESSION['cP'],'cG' => $_SESSION['cG'],'cU' => $_SESSION['cU'],'cC' => $_SESSION['cC'],'cL' => $_SESSION['cL']);
	setcookie('LCAL_'.$calID, serialize($lastSet), time()+(86400 * $set['cookieExp']*$bake)); //keep data for 'cookieExp' days
}

//Load session data from cookie LCAL_<calID>
function loadLastSel($calID) {
	$lastSet = isset($_COOKIE['LCAL_'.$calID]) ? @unserialize($_COOKIE['LCAL_'.$calID]) : false;
	if ($lastSet) {
		$_SESSION['cP'] = $lastSet['cP'];
		$_SESSION['cG'] = isset($lastSet['cG']) ? $lastSet['cG'] : array(0); //cG in cookie as of V4.3
		$_SESSION['cU'] = $lastSet['cU'];
		$_SESSION['cC'] = $lastSet['cC'];
		$_SESSION['cL'] = $lastSet['cL'];
	}
}

//Check for mobile browser (returns 0: not mobile, 1: tablet or 2: mobile small screen size)
function isMobile() {
	$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$mobileAgents = array(
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		'wapr','webc','winw','winw','xda','xda-'
	);

	if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $userAgent)) {
		return 1; //mobile but tablet
	}
	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|mobile|phone|iphone|ipod|android|xoom)/i',$userAgent)) {
		return 2; //mobile
	} elseif ((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false)) {
		return 2; //mobile
	} elseif (in_array((substr($userAgent,0,4)),$mobileAgents)) {
		return 2; //mobile
	}
	return 0;
}

//Send emails
function sendMail($subject,$message,$emlList,$senderId=0) {
	global $set, $rxEmailX;
	if ($senderId) {//sender is user
		$stH = stPrep("SELECT `name`, `email` FROM `users` WHERE `ID` = ? limit 1");
		stExec($stH,array($senderId));
		list($name,$email) = $stH->fetch(PDO::FETCH_NUM);
		$from = "\"{$name}\" <{$email}>";
	} else { //sender is calendar
		$from = '"'.translit($set['calendarTitle'],true).'" <'.$set['calendarEmail'].'>';
	}
	$notArray = explode(";",$emlList);
	$emlArray = array();
	foreach ($notArray as $emlAorL) { //create email address list
		if (strpos($emlAorL,'@')) { //email address
			$emlArray[] = $emlAorL;
		} else { //email list
			$emlAorL .= strpos($emlAorL,'.') ? '' : '.txt';
			if (file_exists("./emlists/$emlAorL")) {
				$emlArray = array_merge($emlArray,file("./emlists/$emlAorL", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
			}
		}
	}
	$recipList = '';
	foreach ($emlArray as $emlAddress) { //create recipients list
		$emlAddress = trim($emlAddress);
		if (preg_match($rxEmailX,$emlAddress)) { //valid email address
			$recipList .= ', '.$emlAddress;
		}
	}
	$recipList = ltrim($recipList,' ,');
	$subject = '=?utf-8?B?'.base64_encode(htmlspecialchars_decode($subject,ENT_QUOTES)).'?='; //follow RFC 1342 for utf-8 encoding

	if ($set['mailServer'] <= 1) { //mail via PHP
		$headers = "MIME-Version: 1.0\nContent-type: text/html; charset=utf-8\nFrom: {$from}\nBcc: {$recipList}\nDate: ".date(DATE_RFC2822);
		if (!mail(null,$subject,$message,$headers)) { //send PHP mail
			logMessage('luxcal',"PHP mail to {$recipList} failed.",true);
			return false;
		}
//		logMessage('luxcal',"PHP mail sent . . .\n- To: ".strip_tags("{$recipList}\n- Subject: {$subject} \n- Message: {$message}"),true); //TEST
	} elseif ($set['mailServer'] == 2) { //mail via SMTP server
		$headers = "MIME-Version: 1.0\nContent-type: text/html; charset=utf-8\nDate: ".date(DATE_RFC2822);
		if (!smtpMail($from,$recipList,$subject,$message,$headers)) { // send SMTP mail
			return false;
		}
//		logMessage('luxcal',"SMTP mail sent . . .\n- To: ".strip_tags("{$recipList}\n- Subject: {$subject} \n- Message: {$message}"),true); //TEST
	}
	return '- '.str_replace("@","[at]",$recipList);
}

//send SMTP mail
function smtpMail($from,$recipList,$subject,$message,$headers) {
	global $set;
	$smtpServer = ($set['smtpSsl'] ? 'ssl://' : '').strtolower($set['smtpServer']);
	$toArray = explode(',', $recipList);
	$hits = array();
	$errMsg = $toString = '';
	foreach($toArray as $k => $v) {
		if (preg_match("~^([^<>@]*?)<?([^\s<>]*@[^\s<>]*)>?$~i",trim($v),$hits)) {
			$toArray[$k] = '<'.$hits[2].'>';
			$toString .= $hits[1].'<'.$hits[2].'>, ';
		} else {
			$errMsg .= "Error in 'to' field. "; break;
		}
	}
	$toString = rtrim($toString,' ,');
	$hits = array();
	if (preg_match("~^([^<>@]*?)<?([^\s<>]*@[^\s<>]*)>?$~i",trim($from),$hits)) {
		$fromS = '<'.$hits[2].'>';
	} else {
		$errMsg .= "Error in 'from' field.";
	}
	if ($errMsg) {
		logMessage('luxcal',"SMTP mail to {$recipList} failed.\n{$errMsg}");
		return false;
	}

	$cmdArray = array(); //keyword, data, expected return code
	$cmdArray[] = array ('Connect','','220');
	$cmdArray[] = array ('EHLO','EHLO '.$smtpServer,'250');
	if ($set['smtpAuth']) {
		$cmdArray[] = array ('AUTH LOGIN','AUTH LOGIN','334');
		$cmdArray[] = array ('User',base64_encode($set['smtpUser']),'334');
		$cmdArray[] = array ('Password',base64_encode($set['smtpPass']),'235');
	}
	$cmdArray[] = array ('MAIL FROM','MAIL FROM: '.$fromS,'250');
	foreach ($toArray as $email) { $cmdArray[] = array ('RCPT TO','RCPT TO: '.$email,'250'); }
	$cmdArray[] = array ('DATA','DATA','354');
	$cmdArray[] = array ('DATA string',"$headers\r\nFrom: $from\r\nTo: $toString\r\nSubject: $subject\r\nReply-To: $fromS\r\n\r\n$message\r\n.",'250');
	$cmdArray[] = array ('QUIT','QUIT','221');

	if (!($socket = fsockopen($smtpServer,$set['smtpPort'],$errNo,$errStr,20))) { //connect to socket
		logMessage('luxcal',"Could not connect to SMTP server {$smtpServer}, port {$set['smtpPort']} ({$errNo} - {$errStr})");
		return false;
	}
	foreach ($cmdArray as $cmdData) {
		if ($cmdData[0] != 'Connect') {
			fwrite($socket,$cmdData[1]."\r\n");
		}
		do { //ignore reply codes followed by a hyphen
			if (!($serverReply = fgets($socket, 256))) {
				logMessage('luxcal',"SMTP mail to {$recipList} failed.\nNo SMTP server reply code.");
				return false;
			}
		} while (substr($serverReply, 3, 1) != ' ');
		if (!(substr($serverReply, 0, 3) == $cmdData[2])) {
			logMessage('luxcal',"SMTP mail to {$recipList} failed.\n{$cmdData[0]}: SMTP server reply: {$serverReply}");
			return false;
		}
	}
	fclose($socket);
	return true;
}
?>