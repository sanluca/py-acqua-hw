<?php
session_start();
if(isset($_GET['lang']))
{
$lang =$_GET['lang'];
$_SESSION['lang']=$lang ;
}
else
{
if(isset($_SESSION['lang']))
{
$lang = $_SESSION['lang'];
}
else
{
//valore di default
$lang = "it";
}
}
# Includo il file di linguaggio interessato
require("{$lang}.php");
?>
<html>
<head>
<title>Py-Acqua</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
<meta name="generator" content="Bluefish 2.2.5" >
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" type="text/css" href="style.css">
<link href='style_mob.css' media='only screen and (max-width: 480px), only screen and (max-device-width: 480px)' rel='stylesheet' type='text/css'>

 	<SCRIPT type="text/javascript" src="javascript/calendar.js?random=20060118"></script> 
</head>
<body>
<div id="templatemo_wrapper">
<div id="templatemo_header">
<div id="site_title"><h1>Py-Acqua</h1></div>
<div id="templatemo_menu">
<div class="home"><a href="index.php"></a></div>
<ul>
    <li><a href="status.php"><?php echo $output[0] ?></a></li>
    <li><a href="luxcal410-calendar/index.php"><?php echo $output[1] ?></a></li>
    <li><a href="download.php"><?php echo $output[2] ?></a></li>
    <li><a href="configure.php"><?php echo $output[3] ?></a></li>
    <li><a href="logout.php"><?php echo $output[4] ?></a></li>
    <li><?php echo "<a href='" . $_SERVER['PHP_SELF'] . "?lang=it'>IT</a>";
	      echo "<a href='" . $_SERVER['PHP_SELF'] . "?lang=en'>EN</a>";
	    ?></li>  
    
</ul>
</div></div>
<?php
// richiamo il file di configurazione
//require 'sqlite.php';
//$data = new db();
$db = new PDO("sqlite:/media/data/py-acqua-hw/py/db/storage.db");
 
// richiamo le funzioni visualizzazione
//$data->connetti();
$day = date("d");
$month = date("m");
$year = date("Y");
$cal1 = array($day,$month,$year);
$cal1=implode(".", $cal1);

//temp_h2o, ph, pulse, hour, day, month, year, lu
//$work=$data->view_work1($day,$day,$month,$month,$year,$year);
 
//$numfields = mysql_num_fields($work);

?>

<div id="templatemo_content_wrapper">
<div id="templatemo_content">
<table><FORM name=form action="download_hours.php" method='POST'>
<tr>
<td><div class="scroll"><?php
//Id INTEGER PRIMARY KEY, temp_h2o FLOAT, ph FLOAT, pulse INT, hour INT, day INT, month INT, year INT, lu INT
$sql = $db->prepare('SELECT * FROM storage');
$sql->execute();
$result = $sql->fetchAll();


foreach($result as $row) {
	echo "Id: " . $row['Id'] . "\n";
	echo "Temperature: " . $row['temp_h2o'] . "\n";
	echo "PH: " . $row['ph'] . "\n";
	echo "Pulse: " . $row['pulse'] . "\n";
	echo "Ora: " . $row['hour'] . "\n";
	echo "Day: " . $row['day'] . "\n";
	echo "Mese: " . $row['month'] . "\n";
	echo "Year: " . $row['year'] . "\n";
	echo "Len: " . $row['lu'] . "<br/>\n";
	echo "\n";
}

?></div></td>

</tr>

<tr><table>
<td>
<?php echo $output[23] ?></td><td><td><input type="text" value="<?php echo "$cal1" ?>" readonly name="theDate2"><input type="button" value="Cal" onclick="displayCalendar(document.forms[0].theDate2,'dd.mm.yyyy',this)"></td></td>
<td><?php echo $output[24] ?></td><td><td><input type="text" value="<?php echo "$cal1" ?>" readonly name="theDate3"><input type="button" value="Cal" onclick="displayCalendar(document.forms[0].theDate3,'dd.mm.yyyy',this)"></td></td>
</table></tr>
<tr>
<td></td>
<td></td>
<td><input class="button aqua" name="submit" type="submit" value="Download"></td>
</tr>
<tr>
<td>						</td></tr>
</table></td></td>
</tr>
<tr>
<td></td>
<td></td>
</table></form></div>
<?php 
//$data->disconnetti();
?></div></div>
</body>
</html>