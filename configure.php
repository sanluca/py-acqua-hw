<?php
session_start();
//se non c'è la sessione registrata
//meta http-equiv="refresh" content="10"
//if (!session_is_registered('autorizzato')) {
  //echo "<h1>Area riservata, accesso negato.</h1>";
//  echo "<script type='text/javascript'>alert('Login Error!');</script>";
//  echo '<script language=javascript>document.location.href="index.php"</script>';
 // echo "Per effettuare il login clicca <a href='index.php'><font color='blue'>qui</font></a>";
 // die;
//}
 
//Altrimenti Prelevo il codice identificatico dell'utente loggato
//session_start();
//$cod = $_SESSION['cod']; //id cod recuperato nel file di verifica
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
//cursor.execute("create table if not exists configure (Id INTEGER PRIMARY KEY, label VARCHAR(150), start_hour INT, start_min INT, stop_hour INT, stop_min INT, rele1 INT, rele2 INT, rele3 INT, rele4 INT, manual INT, calendar INT, sunrise INT);")
$db = new PDO("sqlite:/media/data/py-acqua-hw/py/db/configure.db");

$sql = $db->prepare("SELECT * FROM configure");
$sql->execute();
$data = $sql->fetchAll();
foreach($data as $real_time){
	$configure = $real_time;
}
 
// richiamo le funzioni visualizzazione
//$data->connetti();

//$rows = $sql->numRows();

$numfields = 4;

// valorizzazione delle variabili con i parametri dal form pulsante save
if(isset($_POST['submit'])&&($_POST['submit']=="Save")){
$a=1;
$b=0;
//echo "sono dentro save";
$id = $_POST['id'];

  if(isset($_POST['ore'])){
  	//echo "sono dentro ore";
  	$label = addslashes(filter_var($_POST['label'], FILTER_SANITIZE_STRING));
    $ore = addslashes(filter_var($_POST['ore'], FILTER_SANITIZE_STRING));
    $minuti = addslashes(filter_var($_POST['minuti'], FILTER_SANITIZE_STRING));
    $ore_stop = addslashes(filter_var($_POST['ore_stop'], FILTER_SANITIZE_STRING));
    $minuti_stop = addslashes(filter_var($_POST['minuti_stop'], FILTER_SANITIZE_STRING));
    //se non fa update settare i permessi chmod -R a+xrw
    $sql=$db->prepare("update configure set label='$label', start_hour='$ore', start_min='$minuti', stop_hour='$ore_stop', stop_min='$minuti_stop' where id='$id'");
    $sql->execute();
    
    $autor = $_POST['auto'];
    $temp = $_POST['check1'];
    $ph = $_POST['check2'];
    
    	if($temp ==1){
    		$sql=$db->prepare("update configure set temperature='$a'");
    		$sql->execute();}
    		else{
    			$sql=$db->prepare("update configure set temperature='$b'");
    			$sql->execute();
    		}
    		
    		if($ph ==1){
    			$sql=$db->prepare("update configure set ph='$a'");
    			$sql->execute();}
    			else{
    				$sql=$db->prepare("update configure set ph='$b'");
    				$sql->execute();
    			}
    		
    		
    	if($autor == 1){
    		$sql=$db->prepare("update configure set calendar='$a', manual='$b', sunrise='$b' where id='$id'");
    		$sql->execute();
    		//$db->commit();
    		}
    		elseif($autor == 2) {
    			$sql=$db->prepare("update configure set calendar='$b', manual='$a', sunrise='$b' where id='$id'");
    		$sql->execute();
    		//$db->commit();
    			}
    			
    		elseif($autor == 3) {
    			$sql=$db->prepare("update configure set calendar='$b', manual='$b', sunrise='$a' where id='$id'");
    		$sql->execute(); 
    		//$db->commit();
    			}
    				
    	}
    echo '<script language=javascript>document.location.href="configure.php"</script>'; 	
}

elseif(isset($_POST['submit'])&&($_POST['submit']=="Uphours")){
	if(isset($_POST['tot_hours'])){
    $tot = addslashes(filter_var($_POST['tot_hours'], FILTER_SANITIZE_STRING));
    $tot = $tot*3600;
			$data->update_work('tot',$tot);
}}

elseif(isset($_POST['submit'])&&($_POST['submit']=="Coordinate")){
	if(isset($_POST['long'])){
		$long = addslashes(filter_var($_POST['long'], FILTER_SANITIZE_STRING));
		$lat = addslashes(filter_var($_POST['lat'], FILTER_SANITIZE_STRING));
		$zone =addslashes(filter_var($_POST['zone'], FILTER_SANITIZE_STRING));
		
		$sql=$db->prepare("update sunrise set long='$long', lat='$lat', timezone='$zone' where id=1");
		$sql->execute();
		
	}}
	
	elseif(isset($_POST['submit'])&&($_POST['submit']=="SetTemp")){
		$id = $_POST['id'];
		if(isset($_POST['setemp'])){
			$temp = addslashes(filter_var($_POST['setemp'], FILTER_SANITIZE_STRING));
	
			$sql=$db->prepare("update configure set setemp='$temp' where id='$id'");
			$sql->execute();
	
		}}
		
		elseif(isset($_POST['submit'])&&($_POST['submit']=="SetPh")){
			$id = $_POST['id'];
			if(isset($_POST['setph'])){
				$ph = addslashes(filter_var($_POST['setph'], FILTER_SANITIZE_STRING));
		
				$sql=$db->prepare("update configure set setph='$ph' where id='$id'");
				$sql->execute();
		
			}}

?>

<div id="templatemo_content_wrapper">
<div id="templatemo_content">
<table><FORM name=form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
<tr>

<td>
<table><tr><td>

<table><th><?php echo $output[25] ?></th>

<tr>
<td><?php echo $output[27] ?></td><td><?php echo $output[28] ?></td>
</tr>

<tr>
<!--<td><input class="input" type="text" name="id" value=""/></td>-->
<td><input class="input" type="number" min="1" max="4" name="id" value="1"/></td>
<td><input class="input" type="text" name="label" value=""/></td>
</tr>

<tr>
<td><?php echo $output[13] ?></td>
<td><?php echo $output[14] ?></td>
<td><?php echo $output[15] ?></td>
<td><?php echo $output[16] ?></td>

</tr>
<tr>
<td><input class="input" type="number" min="0" max="23" name="ore" value="0"/></td>
<td><input class="input" type="number" min="0" max="59" name="minuti" value="0"/></td>
<td><input class="input" type="number" min="0" max="23" name="ore_stop" value="0"/></td>
<td><input class="input" type="number" min="0" max="59" name="minuti_stop" value="0"/></td>
</tr>
<tr>
<td><?php echo $output[1] ?></td>
<td><?php echo $output[19] ?></td>
<td><?php echo $output[26] ?></td>
<td><?php echo $output[7] ?></td>
<td><?php echo $output[8] ?></td>
</tr>

<tr>
<td><input type="radio" name="auto" value="1"  /></td>
<td><input type="radio" name="auto" value="2" /></td>
<td><input type="radio" name="auto" value="3" /></td>
<td><input type="checkbox" name="check1" value="1" /></td>
<td><input type="checkbox" name="check2" value="1" /></td>

</tr>
</table></td></tr>

<tr><td><table>
<td>
<input class="button aqua" name="submit" type="submit" value="Save">
</td>
</table></td>
</tr></table>
</td>

<td><table>
<tr>
<td><?php echo $output[20] ?></td></tr>
<tr><td><?php echo $output[21] ?></td></tr>
<tr><td>
<div class="scroll"><table><?php

$sql = $db->prepare('SELECT * FROM configure');
$sql->execute();
$result = $sql->fetchAll();


foreach($result as $row) {
	echo "Id: " . $row['Id'] . "\n";
	echo "Label: " . $row['label'] . "\n";
	echo "Start Ora: " . $row['start_hour'] . "\n";
	echo "Start Minuti: " . $row['start_min'] . "\n";
	echo "Stop Ora: " . $row['stop_hour'] . "\n";
	echo "Stop Minuti: " . $row['stop_min'] . "\n";
	echo "Manual: " . $row['manual'] . "\n";
	echo "Calendar: " . $row['calendar'] . "\n";
	echo "SunRise: " . $row['sunrise'] . "\n";
	echo "Temperature: " . $row['temperature'] . "\n";
	echo "PH: " . $row['ph'] . "\n";
	echo "Set Temp: " . $row['setemp'] . "\n";
	echo "Set PH: " . $row['setph'] . "<br/>\n";
	echo "\n";
}

?></table></div>
</td></tr><tr><td>

<div class="scroll"><table>
<?php

$sql = $db->prepare('SELECT * FROM sunrise');
$sql->execute();
$result = $sql->fetchAll();


foreach($result as $row) {
	echo "Long: " . $row['long'] . "\n";
	echo "Lat: " . $row['lat'] . "\n";
	echo "TimeZone: " . $row['timezone'] . "\n";
	echo "\n";
}

?>
</table></div></td></tr>

</table></td>


<td></td></tr>
<tr>
<td><table>
<tr>
<td><?php echo $output[12] ?></td>
<td><?php echo $output[7] ?></td>
<td><?php echo $output[8] ?></td>

</tr>
<tr>
<td><input class="input" type="text" name="tot_hours" value=""/></td>
<td><input class="input" type="text" name="setemp" value=""/></td>
<td><input class="input" type="text" name="setph" value=""/></td>


</tr>
<tr><td><input class="button aqua" name="submit" type="submit" value="UpPulse"></td>
<td><input class="button aqua" name="submit" type="submit" value="SetTemp"></td>
<td><input class="button aqua" name="submit" type="submit" value="SetPh"></td>

</tr>
</table></td>

<td>
<table>
<tr>
<td><?php echo $output[33]?></td></tr>
<tr><td><?php echo $output[34]?></td><td><?php echo $output[35]?></td><td><?php echo $output[36]?></td></tr>
<tr><td><input class="input" type="text" name="long" value=""/></td>
<td><input class="input" type="text" name="lat" value=""/></td>
<td><input class="input" type="text" name="zone" value=""/></td></tr>
<tr><td><input class="button aqua" name="submit" type="submit" value="Coordinate"></td></tr>
</tr>
</table></td>

</tr>
</form>
</table></div>

<?php 
//$data->disconnetti();
?>

</div></div>
</body>

</html>