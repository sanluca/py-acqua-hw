<?php
/*
= LuxCal calendar ldap tools =

� Copyright 2009-2016 LuxSoft - www.LuxSoft.eu

*/

//heredocs
$actT = <<<TXT
<p>This tool will help you to . . .
<ul>
<li>Choose a calendar to work on</li>
<li>Get and alter LDAP preferences</li>
<li>Test LDAP settings. <br>Supply Bind PW if Bind DN is set (for non-anonymous binds).</li>
<li>Import LDAP users into current calendar.<br>Supply Bind PW if Bind DN is set (for non-anonymous binds).</li>
</ul>
<p>
Note:<br>
This tool has only been tested with LDAP Servers based on OpenLDAP.<br>
You may experience problems or misfunctions with other kinds of servers !

TXT;

$act1T = <<<TXT
<h5>Choose a calendar</h5>
<p>This action will choose the calendar to work upon.
</p>
<p>When multiple calendars are installed in the database, you can
choose which to use for subsequent actions. This calendar is made
the default calendar(!).<br>
If there is only one, or no calendar has been chosen,<br>the default calendar will be used.
</p>
TXT;

$act2T = <<<TXT
<h5>Get and alter LDAP preferences</h5>
<p>This action will get your current LDAP settings and allows editing.
</p>
<p>Works on current default calendar. User data will not be affected.
</p><br>
<p>
<dl>
<dt>Enable LDAP:</dt><dd> Wether to use LDAP at all</dd>
<dt>LDAP version:</dt><dd>Protocol Version to use (2 or 3)</dd>
<dt>Environment String:</dt><dd>String to override settings in system LDAP configuration.<br>
                Set to TLS_REQCERT=NEVER to disable certificate validation (for self signed certs).<dd>
<dt>ServerURI:</dt><dd> E.g. ldaps://myserver.org/</dd>
<dt>Server Port:</dt><dd>Normally 389 (ldap) or 636 (ldaps: ldap with SSL)</dd>
<dt>Bind DN:</dt><dd> If the LDAP server doesn't support anonymous binds
to get the list of users, specify a dedicated account DN here, <br>e.g. uid=listmaster,dc=myserver,dc=org. Leave empty to use anonymous bind.</dd>
<dt>Base DN:<dt><dd>Base of user entries, e.g. ou=Users,dc=myserver,dc=org</dd>
<dt>Filter:<dt><dd>Optional user attribute filters, e.g. (&(uid=*)(host=ldap)) </dd>
<dt>Unique user attribute:</dt><dd>Unique user attribute containing the login name to authenticate against LDAP, e.g cn or uid</dd>
<dt>Real user name:</dt><dd>Attribute containing the users real name, e.g. gecos</dd>
<dt>User name extraction pattern:</dt><dd>regex to extract the user name from above field, e.g /^[^,]*/</dd>
<dt>Mail address:</dt><dd>Attribute containing the users Email address, e.g mailAddress<dd>
</dl>
</p>
TXT;

$act3T = <<<TXT
<h5>Test LDAP settings</h5>
<p>This action will try to connect to your LDAP-Server using the given settings.
</p>
<p>Check the command output for reasonable values.
</p>
TXT;

$act4T = <<<TXT
<h5>Import LDAP users</h5>
<p>This action will import user accounts from LDAP into the current calendar.
</p>
<p>You may select a group to assign the imported users to.<br>
After import, you can manage those accounts with the administration tool.<br>
Entries which are not selectable indicate already imported accounts. 
</p>
TXT;

date_default_timezone_set(@date_default_timezone_get()); //set time zone

//sanity check
if (version_compare(PHP_VERSION,'5.2.3') < 0) { //check PHP version
	exit('<br><br><b>Wrong PHP version</b><br><br>You need version 5.2.3 or higher<br>Your current version is: '.PHP_VERSION);
}
foreach ($_REQUEST as $key => $value) { if (is_string($value)) $_REQUEST[$key] = htmlspecialchars(strip_tags(trim($value)),ENT_QUOTES,'UTF-8'); }

//set error reporting
//error_reporting(E_ALL ^ E_NOTICE); //errors, no notices
error_reporting(E_ALL); //errors and notices - test line
ini_set('display_errors',1);
ini_set('log_errors',1);

//if present, get config data
if (file_exists('./lcconfig.php')) { include './lcconfig.php'; }
if (empty($dbDir)) { $dbDir = 'db/'; }
if (empty($dbType)) { $dbType = 'SQLite'; }

require './common/toolbox.php';
require './common/toolboxd.php'; //database tools
require './common/toolboxx.php';

//init menu selections
$back = !empty($_POST['back']) ? true : false; //back
$action = (!empty($_POST['action']) and !$back) ? $_POST['action'] : ''; //selected action
$start = !empty($_POST['start']) ? true : false; //start action
$defCal = !empty($_POST['defCal']) ? $_POST['defCal'] : ''; //default calendar
$selCal = !empty($_POST['selCal']) ? $_POST['selCal'] : ''; //selected calendar

$ldapSet=array(
        'ldapServer' => array(0,'LDAP server (0:ldap disabled, 1:ldap enabled)'),
        'ldapProto' => array(3,'LDAP protocol version'),
        'ldapEnv' => array('','LDAP environment settings'),
        'ldapURI' => array('','LDAP server URI'),
        'ldapPort' => array(636,'LDAP port number'),
        'ldapBindDN' =>array('','LDAP Bind DN'),
        'ldapDN' => array('','LDAP Base DN'),
        'ldapFilter' => array('','LDAP Filter'),
        'ldapUID' => array('','LDAP Attr. UID'),
        'ldapRN' => array('','LDAP Attr. real name'),
        'ldapRNpattern' => array('','LDAP Attr. real name extraction pattern'),
        'ldapMail' => array('','LDAP Attr. mail'),
); // default LDAP settings

$lf = !empty($_POST['lf']) ? $_POST['lf'] : array(); // possibly altered LDAP settings

//start PHP session (needed to be able to unset session variables later)
session_start();

//get installed calendars
$calIDs = getCals(); //get calendar ID/title pairs

//check/set default calendar
if (reset($calIDs)) { //calendar(s) present
	if (empty($dbDef) or !isset($calIDs[$dbDef])) { $dbDef = key($calIDs); } //if no default, make first calendar default
} else {
	$dbDef = ''; //no calendar: no default
}
if (empty($defCal) and !empty($dbDef)) { $defCal = $dbDef; }

//create current calendar list
$curCalList = '';
foreach($calIDs as $ID => $title) {
	$curCalList .= "<br>&nbsp;&nbsp;{$ID} = {$title}".($ID == $defCal ? " <span class='mark'>(default)</span>" : '');
}
if (!empty($curCalList)) {$curCalList = substr($curCalList,4); } //remove first <br>

//get version info
$phpVersion = 'PHP: '.PHP_VERSION;

// ---------------------------------- functions -----------------------------------------------------------

function loadLdapSettings() {
        global $dbDef;
        global $errMsg;   
        global $ldapSet;

        //connect to calendar
        if (!$dbH = dbConnect($dbDef,0)) {
            echo "Calendar $dbDef - Problem connecting to calendar.\n";
        }

        // get all settings
        $tmpset=array();
        $sql="SELECT `name`,`value` FROM `settings`"; 
        try{    // get settings from db if exists
    	   foreach($dbH->query($sql) as $row) {
              $tmpset[$row['name']]=is_numeric($row['value']) ? intval($row['value']) : $row['value'];
           }
        }
        catch (PDOException $e){
          $errMsg[]="Cant get settings from calendar\n";
    	  return 0;
        }

        // filter out ldap stuff
        foreach($ldapSet as $name => $value) {
           if(isset($tmpset[$name])){
             $ldapSet[$name][0]=$tmpset[$name];
           }
        }
        

}

function saveLdapSettings(){
        global $dbDef;
        global $errMsg;
        global $ldapSet;
        
        // copy possibly altered values to ldapSet
        foreach($_POST['lf'] as $n => $v){ 
           $ldapSet[$n][0]=$v;
        }

        //connect to calendar
        if (!$dbH = dbConnect($dbDef,0)) {
           echo "Calendar $dbDef - Problem connecting to calendar.\n";
        }

        // save ldapSet
        $stH = $dbH->prepare("REPLACE INTO `settings` VALUES (?,?,?)");
        foreach($ldapSet as $key => $value){
           try{
             $res=$stH->execute(array($key,$ldapSet[$key][0],$ldapSet[$key][1]));
           }
           catch (PDOException $e) {
             $errMsg[]= "SQLite error: ".$e->getMessage()."\n";
           }
        } 
}

function getLdapUsers(&$f=array()){
        global $ldapSet;
        global $errMsg;

        if($ldapSet['ldapServer'][0] != 1){
           $errMsg[]="LDAP not enabled in settings !";
           return(0);
        }

        if($ldapSet['ldapEnv'][0] != ''){
          putenv($ldapSet['ldapEnv'][0]);
        }
        
        if(!$conn=ldap_connect($ldapSet['ldapURI'][0],$ldapSet['ldapPort'][0])){
           $errMsg[]="LDAP connect error.";
           return(0);
        }

        ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, $ldapSet['ldapProto'][0]);

        
        if ((isset($ldapSet['ldapBindDN'][0])) && ($ldapSet['ldapBindDN'][0]!='')){
          if(!isset($_POST['bpw'])){
             $errMsg[]='Non-anonymous bind without password ?';
             return(0);
          }
          $ret=@ldap_bind($conn,$ldapSet['ldapBindDN'][0],$_POST['bpw']);
        }else{         
          $ret=@ldap_bind($conn);
        }
        if(ldap_error($conn)!='Success'){       
           $errMsg[]="LDAP bind error: ".ldap_error($conn);
           return(0);
        }
        $justthese = array($ldapSet['ldapUID'][0],$ldapSet['ldapRN'][0],$ldapSet['ldapMail'][0]);

        $search = @ldap_search($conn,$ldapSet['ldapDN'][0],$ldapSet['ldapFilter'][0],$justthese);
        if(ldap_error($conn)!='Success'){
           $errMsg[]="LDAP search error: ".ldap_error($conn);
           return(0);
        }
        $found=@ldap_get_entries($conn, $search);
        if(ldap_error($conn)!='Success'){
           $errMsg[]="LDAP find error: ".ldap_error($conn);
           return(0);
        }
        
        if($found['count']==0){
           $errMsg[]="No LDAP entries found";
           return(0);
        }
        
        if(! isset ($found[0][strtolower($ldapSet['ldapUID'][0])])){
           $errMsg[]="No values for 'ldapUID'";
           return(0);
        }
        if(! isset ($found[0][strtolower($ldapSet['ldapRN'][0])])){
           $errMsg[]="No values for 'ldapRN'";
           return(0);
        }
        if(! isset ($found[0][strtolower($ldapSet['ldapMail'][0])])){
           $errMsg[]="No values for 'ldapMail'";
           return(0);
        }
 
       // sort results alphabetically
       for($n=0;$n<$found["count"];$n++){
          $x=$found[$n][strtolower($ldapSet['ldapUID'][0])][0];
          $y=$found[$n][strtolower($ldapSet['ldapRN'][0])][0]; 
          preg_match($ldapSet['ldapRNpattern'][0],$y,$m);
          $y=$m[0];
          if(isset ($found[$n][strtolower($ldapSet['ldapMail'][0])])){
            $z=$found[$n][strtolower($ldapSet['ldapMail'][0])][0];
          }else{
            //echo "No mail for $x\n";
            $z=$x.'@undefined';
          }
          $f[$x]['rn'] = $y;
          $f[$x]['ml'] = $z;
        }
        ksort($f);

        return(count($f));
}

function getGroups(&$g=array()){
        global $dbDef;
        global $errMsg;
       
        //connect to calendar
        if (!$dbH = dbConnect($dbDef,0)) {
                    echo "Calendar $dbDef - Problem connecting to calendar.\n";
        }

        // get groups
        $stH = $dbH->prepare("SELECT `ID`,`name` FROM `groups` WHERE `status` >= 0");
        try{
             $res = $stH->execute();
           }
        catch (PDOException $e) {
             $errMsg[] = "SQLite error: ".$e->getMessage()."\n";
        }
        while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
              $g[$row['ID']] = $row['name'];
        }
        $stH=NULL;
        ksort($g);
        return(count($g));
}

function checkLdapUsers(&$u=array()){
        global $dbDef;
        global $errMsg;

        // this takes a list of ldap users and checks which of these are
        // already included in passwd. Sets flag in $u if exists 

        //connect to calendar
        if (!$dbH = dbConnect($dbDef,0)) {
                    echo "Calendar $dbDef - Problem connecting to calendar.\n";
        }
        
        // get passwd users
        $stH = $dbH->prepare("SELECT `name`,`email`,`status` FROM users");
        try{
             $res=$stH->execute();
           }
        catch (PDOException $e) {
             $errMsg[] = "SQLite error: ".$e->getMessage()."\n";
        }

        while ($row = $stH->fetch(PDO::FETCH_ASSOC)) {
              foreach($u as $key => $value){
                if(($u[$key]['rn'] == $row['name']) && ($u[$key]['ml'] == $row['email'])){
                  if($row['status'] != 0){
                    // user exists, but disabled
                    $u[$key]['flag']='dis';
                  }else{
                    $u[$key]['flag']='exi';
                  }
                }
              }
        }
        $stH=NULL;
}

function insertLdapUsers(){
       global $dbDef;
       global $errMsg;

       $g=$_POST['ldapgroup'];

        //connect to calendar
        if (!$dbH = dbConnect($dbDef,0)) {
                    echo "Calendar $dbDef - Problem connecting to calendar.\n";
        }
        $stH = $dbH->prepare("INSERT INTO users (`name`,`password`,`email`,`groupID`,`language`) VALUES (?,?,?,?,?)");
        $added=0;
        foreach($_POST['ldapsel'] as $v){

            // get info from POST array
            $ua=explode('|',urldecode($v));
            $lpw='LDAP|'.$ua[0];  // encode LDAP cn in passwd

            try{
               $res=$stH->execute(array($ua[1],$lpw,$ua[2],$g,'english'));
            }
            catch (PDOException $e) {
               $errMsg[] = "SQLite error: ".$e->getMessage()."\n";
               $added--;
            }
            $added ++;
        }
        return($added);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>LuxCal Calendar Tools</title>
<meta name="description" content="LuxCal web calendar - a LuxSoft product">
<meta name="keywords" content="LuxSoft, LuxCal, LuxCal web calendar">
<meta name="author" content="Roel Buining">
<meta name="robots" content="nofollow">
<link rel="icon" href="lcal.ico"/>
<style type="text/css">
* { padding:0; margin:0; }
dd {margin-left: 20px; }
body {font:11px arial, sans-serif; background:#E0E0E0; color:#2B3856; cursor:default;}
a {text-decoration:none; cursor:pointer;}
h3 {margin:8px 0; font-size:14pt;}
h4 {margin:6px 0; font-size:12pt;}
h5 {margin:2px 0; font-size:11pt;}
input, textarea, select, table {font:11px arial, sans-serif;}
select {padding:1px 4px 0 8px;}
input[type="text"] { width:240px; }
input[type="radio"], input[type="checkbox"], label {margin:2px; vertical-align: middle; cursor:pointer;}
input[type="submit"], input[type="button"] {margin:0 15px; cursor:pointer;}
input[disabled] {cursor:default;}
textarea {width:100%; height:120px;}
ul, ol {margin:0 20px;}
li {margin:5px 0;}
.aside {width:45%; border:1px solid #808080; background:#FFFFFF; margin-top:80px; padding:15px; float:right; text-align:justify;}
.centerBox {display:table; margin:auto;}
.form {width:500px; border:1px solid #808080; background:#FFFFFF; padding:5px 15px;}
.resultBox {width:380px; border:1px solid #808080; background:#FFFFFF; padding:5px; text-align:justify;}
.bLine {position:absolute; left:0; bottom:50px; width:98%; text-align:center;}
.hilite {margin:10px 0; background:#F0A070;}
.mark {color:#AA0000;}
.greyout {color:#808080; cursor:default;}
.center {text-align:center;}
.flag {color:#FF3300;}
header {margin:6px 0; padding:0 1%; font-size:12pt; font-weight:bold;}
div.navBar {
	position:absolute; top:34px; left:0; right:0;
	padding:0 1%;
	background:#AAAAFF;
	text-align:right;
	border:1px #808080;
	border-style:solid none;
	line-height:20px;
	vertical-align:middle;
}
div.content {
	position:absolute; left:0; top:110px; right:0px; bottom:100px;
	padding:0 20px;
	overflow:auto;
}
div.endBar {
	position:absolute; left:0; right:0; bottom:10px;
	padding:0 1%;
	background:#AAAAFF;
	text-align:right;
	border:1px #808080;
	border-style:solid none;
	font-size:0.8em;
}
.footLB {font:italic bold 1.1em arial,sans-serif; }
.footLR {font:italic bold 1.1em arial,sans-serif; color:#AA0066;}
</style>
</head>

<body>
<header>LuxCal Event Calendar</header>
<div class="navBar"><?php echo $phpVersion; ?></div>
<div class="content">

<?php
if ($start) { //validate menu selections
	$errMsg = array();
	if ($action == 'set Calendar') {
		if (empty($defCal)) { $errMsg[] = 'No calendar selected'; }
	}
}

if (!$start or $errMsg) {
	echo '<aside class="aside">'."\n";
	echo '<h4>Instructions</h4>'."\n";
	switch ($action) { //show instructions
		case '': echo $actT; break;
		case 'set Calendar': echo $act1T; break;
                case 'set Values': echo $act2T; break;
                case 'test': echo $act3T; break;
                case 'import Users': echo $act4T; break;
	}
	echo "</aside>\n";
}
echo '<div class="centerBox">'."\n";
echo '<h3 class="center">LuxCal Calendar LDAP Tools</h3><br><br>'."\n";

// ----------------------------------------------------
if ($start and !$errMsg) {
	//Perform action
	switch ($action) {
        case 'set Calendar': //process Set default calendar
                $dbDef = $defCal; //set new default calendar
                saveConfig();
                $resMsg = "<h5>Setting default calendar successful</h5>\n<br><p><b>Default calendar set to '{$dbDef}' in lcconfig.php</b></p>\n";
	break;
        case 'set Values': //process Enter values
                saveLdapSettings();                
                $resMsg = "<h5>Saving settings successful</h5>\n<br><p><b>Values have been added to '{$dbDef}' successfully</b></p>\n";
                
        break;
        case 'test': //test current ldap settings
                loadLDAPSettings();

                $found=array();
                $res=getLdapUsers($found);

                if($res == 0){
                  $resMsg="<h3>No entries found - check LDAP settings</h3>\n";
                }else{
                  echo '<div class="resultBox">'."\n";   
                  echo "<table>
                  <tr><th>UID</th><th>Full Name</th><th>Email</th></tr>\n";
                  foreach($found as $u=>$n){
                    echo "<tr><td>$u</td><td>{$found[$u]['rn']}</td><td>{$found[$u]['ml']}</td></tr>\n";
                  }     
                  echo "</table>\n";
                  echo '</div>'."\n";
                  $resMsg = "<h5>Connection testing successful</h5>\n<br><p><b>Found $res entries - check if results look reasonable !<b></p>\n";
                }
        break;
        case 'import Users': // import ldap users
              if(! isset($_POST['ldapsel'])){
                $resMsg = "No entries selected - nothing imported";
              }else{
                $ret=insertLdapUsers();
                $resMsg = "$ret users imported";
              } 
        break;
	}
	
	session_unset(); //force retrieve of settings and selection of default calendar

	//display Action result
	echo '<div class="resultBox">'."\n";
	if (!empty($errMsg)) {
		echo "<h4>The following error(s) occurred</h4>\n";
		echo "<ul>\n";
		foreach ($errMsg as $msg) {
			echo "<li class='hilite'>{$msg}</li>\n";
		}
		echo "</ul>\n";
	} else {
		echo $resMsg;
	}
	echo "<br><br>\n<div class=\"center\">\n";
	echo "<input type='button' onclick=\"window.location='{$_SERVER['PHP_SELF']}'\" value='back to tools'>\n";
	echo "</div>\n";
	echo "</div>\n";
} else {  // ---------------------------------------------------------------------------------------------
	if (empty($errMsg)) {
		if ($back or !$action) {
			echo '<p class="center">Choose an action.</p>'."\n";
		} else {
			echo '<p class="center">Complete the form and click the '.ucfirst($action).' button.</p>'."\n";
		}
	} else {
		foreach ($errMsg as $msg) {
			echo "<p class='hilite'>- {$msg}</p>\n";
		}
	}
	echo "<br>\n";
	echo "<form class='form' id='form' action='".htmlentities($_SERVER['PHP_SELF'])."' method='post' enctype='multipart/form-data'>\n";
	echo "<input type='hidden' name='MAX_FILE_SIZE' value='2050000'>\n";
	echo '<h4 class="hilite center">= read instructions =</h4>'."\n";
	if ($back or !$action) {
		$disabled1 = count($calIDs) < 2 ? ' disabled' : '';
		$greyout1 = $disabled1 ? " class='greyout'" : '';
		$disabled = !$calIDs ? ' disabled' : '';
		$greyout = $disabled ? " class='greyout'" : '';
		echo "<h5>Action</h5>\n";
		echo "<input type='radio' id='act0' onclick='submit()' name='action' value='set Calendar'{$disabled1}>";
		echo "<label for='act0'{$greyout1}> Set default calendar</label><br>\n";
                echo "<input type='radio' id='act1' onclick='submit()' name='action' value='set Values'>";
                echo "<label for='act1'> Get and alter LDAP preferences</label><br><br>\n";
                echo "<input type='radio' id='act2' onclick='submit()' name='action' value='test'>";
                echo "<label for='act2'> Test LDAP settings</label><br>\n";
                echo "<input type='radio' id='act2' onclick='submit()' name='action' value='import Users'>";
                echo "<label for='act2'> Import LDAP users</label><br>\n";
                echo "<input type='password' style='width:120px;margin-left:20px' name='bpw' value=''> Bind password - see Instructions<br>\n";
		echo "<br>\n";
		echo "<p><b>Currently installed calendar(s):</b></p>\n";
		if ($curCalList) {
			echo $curCalList;
			echo "<br><br>\n<div class=\"center\">\n";
			echo "<input type='button' onclick=\"window.location='index.php?cal={$dbDef}'\" value='start default calendar'/>\n";
			echo "</div>\n";
		} else {
		 echo 'none';
		}
	} else {
		echo "<input type='hidden' id='action' name='action' value='{$action}'/>\n";
	}
	switch ($action) {
	    case 'set Calendar':
		echo "<h5>Set default calendar</h5>\n<br>\n";
		echo "<p><b>Select calendar</b></p>\n";
		foreach ($calIDs as $k =>$v) {
			$checked = (!empty($_POST['defCal'])) ? " checked='checked'" : ($k == $dbDef ? " checked='checked'" : '');
			$curDef = ($k == $dbDef) ? " <span class='mark'>(current default)</span>" : '';
			echo "<input type='radio' id='{$k}' name='defCal' value='{$k}' onclick=\"check1('defCal',this);\"{$checked}><label for='{$k}'> {$k} - {$v}{$curDef}</label><br>\n";
		}
		echo "<br>\n";
		break;
            case 'set Values':
                loadLDAPSettings(); 
                echo "<h5>Alter and save Values</h5>\n<br>\n";
                echo "<table>\n";
                echo "<tr><td colspan='2'><b>LDAP settings:</b></td></tr>\n";
                echo "<tr><td>Enable LDAP:</td><td>
                      <input type='checkbox' name='lf[ldapServer]' value='1'".($ldapSet['ldapServer'][0] == 1 ? " checked='checked'" : '')."></td></tr>\n";
                echo "<tr><td>LDAP version:</td><td>
                     <select name='lf[ldapProto]'>
                     <option value='2'".($ldapSet['ldapProto'][0] == "2" ? " selected='selected'" : '')."> 2 </option>
                     <option value='3'".($ldapSet['ldapProto'][0] == "3" ? " selected='selected'" : '')."> 3 </option>
                     </select></td></tr>\n";
                echo "<tr><td>Environment String:</td><td><input type='text' name='lf[ldapEnv]' value='{$ldapSet['ldapEnv'][0]}'></td></tr>\n";
                echo "<tr><td>ServerURI:</td><td><input type='text' name='lf[ldapURI]' value='{$ldapSet['ldapURI'][0]}'></td></tr>\n";
                echo "<tr><td>Server Port:</td><td><input type='text' name='lf[ldapPort]' value='{$ldapSet['ldapPort'][0]}'></td></tr>\n";
                echo "<tr><td>Bind DN:</td><td><input type='text' name='lf[ldapBindDN]' value='{$ldapSet['ldapBindDN'][0]}'></td></tr>\n";
                echo "<tr><td>Base DN:</td><td><input type='text' name='lf[ldapDN]' value='{$ldapSet['ldapDN'][0]}'></td></tr>\n";
                echo "<tr><td>Filter:</td><td><input type='text' name='lf[ldapFilter]' value='{$ldapSet['ldapFilter'][0]}'></td></tr>\n";
                echo "<tr><td>Unique user attribute:</td><td><input type='text' name='lf[ldapUID]' value='{$ldapSet['ldapUID'][0]}'></td></tr>\n";
                echo "<tr><td>Real user name:</td><td><input type='text' name='lf[ldapRN]' value='{$ldapSet['ldapRN'][0]}'></td></tr>\n";
                echo "<tr><td>User name extraction pattern:</td><td><input type='text' name='lf[ldapRNpattern]' value='{$ldapSet['ldapRNpattern'][0]}'></td></tr>\n";
                echo "<tr><td>Mail address:</td><td><input type='text' name='lf[ldapMail]' value='{$ldapSet['ldapMail'][0]}'></td></tr>\n";
                echo "</table>\n";
                echo "<br>\n";
                break;
            case 'test':
                loadLdapSettings();
                if($ldapSet['ldapServer'][0] != 1){
                     echo "<h4>Enable LDAP in settings first !<h4>\n";
                     echo "<input type='submit' name='back' value='Ok'>\n";
                     $action='';
                     break;
                }
                echo "<h5>Test connection</h5>\n<br>\n";
                echo "<table>\n";
                echo "<tr><td colspan='2'><b>Current  settings:</b></td></tr>\n";
                echo "<tr><td>Protocol version:</td><td>{$ldapSet['ldapProto'][0]}</td></tr>\n";
                echo "<tr><td>Env String:</td><td>{$ldapSet['ldapEnv'][0]}</td></tr>\n";
                echo "<tr><td>ServerURI:</td><td>{$ldapSet['ldapURI'][0]}</td></tr>\n";
                echo "<tr><td>Server Port:</td><td>{$ldapSet['ldapPort'][0]}</td></tr>\n";
                echo "<tr><td>bindDN:</td><td>{$ldapSet['ldapBindDN'][0]}</td></tr>\n";
                echo "<tr><td>baseDN:</td><td>{$ldapSet['ldapDN'][0]}</td></tr>\n";
                echo "<tr><td>filter:</td><td>{$ldapSet['ldapFilter'][0]}</td></tr>\n";
                echo "<tr><td>User login:</td><td>{$ldapSet['ldapUID'][0]}</td></tr>\n";
                echo "<tr><td>User real name:</td><td>{$ldapSet['ldapRN'][0]}</td></tr>\n";
                echo "<tr><td>Real name pattern:</td><td>{$ldapSet['ldapRNpattern'][0]}</td></tr>\n";
                echo "<tr><td>User mail:</td><td>{$ldapSet['ldapMail'][0]}</td></tr>\n";
                echo "</table><br><br>\n";
                echo "<input type='hidden' name='bpw' value={$_POST['bpw']}>\n";
                break;
             case 'import Users':
                loadLDAPSettings();
                if($ldapSet['ldapServer'][0] != 1){
                     echo "<h4>Enable LDAP in settings first !</h4>\n";
                     echo "<input type='submit' name='back' value='Ok'>\n";
                     $action='';
                     break;
                }

                $found=array();
                $res=getLdapUsers($found);

                if($res == 0){
                  echo"<h4>No entries found - test LDAP settings !</h4>\n";
                  echo "<input type='submit' name='back' value='Ok'>\n";
                  $action='';
                  break;
                }else{
                  $groups=array();
                  getGroups($groups);
                }
                checkLdapUsers($found); // check if importable

                echo "<div class='sValue'>Import to group <select name='ldapgroup'>\n";
                foreach($groups as $id=>$name){
                   echo "<option value={$id}>{$name}</option>\n";
                }
                echo "</select></div><br><br>\n";
      

                  //echo '<div class="resultBox">'."\n";
                  echo "<table>
                  <tr><th>UID</th><th>Full Name</th><th>Email</th></tr>\n";
                  foreach($found as $u=>$n){
                     if (!isset($found[$u]['flag'])){
                       // put all info into encoded string
                       $v=urlencode($u.'|'.$found[$u]['rn'].'|'.$found[$u]['ml']);
                       echo "<tr><td><input type='checkbox' name='ldapsel[]' value=$v>";
                     }else{
                       echo "<tr><td>";
                       // todo: find a way to re-enable deleted users (status != 0)
                     }
                     echo "<td>$u</td><td>{$found[$u]['rn']}</td><td>{$found[$u]['ml']}</td></tr>\n";
                  }
                  echo "</table>\n";
                  //echo '</div>'."\n";
                  $resMsg="foo";
                
             break;
	}
	echo "<div class='center'>\n";
	if ($action) {
		echo "<input type='submit' id='start' name='start' onclick='return valForm()' value='".ucfirst($action)."'>\n";
		echo "<input type='submit' name='back' value='Back'>\n";
	}
	echo "</div>\n";
	echo "</form>\n";
}
?>
</div>
</div>
<div class='bLine mark'><h4>AFTER USE MAKE THE FILE <?php echo basename(__FILE__); ?> INACCESSIBLE OR REMOVE IT FROM THE SERVER !</h4></div>
<div class='endBar'>
	design 2016 - powered by <a href='http://www.luxsoft.eu'><span class='footLB'>Lux</span><span class='footLR'>Soft</span></a>
</div>
<br>&nbsp;
</body>
</html>
