<html>
<head>
<title>Py-Acqua</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
<meta name="generator" content="Bluefish 2.2.5" >
<meta name="viewport" content="width=device-width" />
<!--<link rel="stylesheet" type="text/css" href="../style.css">-->
<!--<link href='../style_mob.css' media='only screen and (max-width: 480px), only screen and (max-device-width: 480px)' rel='stylesheet' type='text/css'>-->
</head>
<body>
<div id="templatemo_wrapper">
<div id="templatemo_header">
<div id="site_title"><h1>Py-Acqua</h1></div>
<div id="templatemo_menu">
	<div class="home"><a href="../index.php"></a></div>
<ul>
  <!--<li><a href="../status.php"><?php echo $output[0] ?></a></li>
    <li><a href="../calendar/index.php"><?php echo $output[1] ?></a></li>
    <li><a href="../download.php"><?php echo $output[2] ?></a></li>
    <li><a href="../configure.php"><?php echo $output[3] ?></a></li>
    <li><a href="../logout.php"><?php echo $output[4] ?></a></li> -->
    
    <li><a href="../status.php">Stato</a></li>
    <li><a href="../calendarix/index.php">Calendario</a></li>
    <li><a href="../download.php">Scarica</a></li>
    <li><a href="../configure.php">Configurazione</a></li>
    <li><a href="../logout.php">Esci</a></li>
    
</ul>
</div></div>
<div id="templatemo_content_wrapper">
<div id="templatemo_content">

<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.7.20070307 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2007 Vincent Hor
##########################################################################

require ("cal_config.inc.php");
$dname = dirname($_SERVER['PHP_SELF']);
if ($dname=="\\") $dname = '' ;	// fix windows based root hosting returning just "\"
header("location: http://".$_SERVER['HTTP_HOST'].$dname."/calendar.php");
?></div></div></body></html>
