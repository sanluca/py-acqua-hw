<?php
//session_start();
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
<link href='style_mob.css' media="only screen and (min-width: 0px) and (max-width: 500px)" rel='stylesheet' type='text/css'>

<script type='text/javascript'>
var currenttime = '<?php echo date("F d, Y H:i:s", time()) ?>'
 
var montharray=new Array('Gennaio','Febraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre')
var serverdate=new Date(currenttime)
 
function padlength(what){
var output=(what.toString().length==1)? '0'+what : what
return output
}
 
function displaytime(){
serverdate.setSeconds(serverdate.getSeconds()+1)
var datestring=montharray[serverdate.getMonth()]+' '+padlength(serverdate.getDate())+', '+serverdate.getFullYear()
var timestring=padlength(serverdate.getHours())+':'+padlength(serverdate.getMinutes())+':'+padlength(serverdate.getSeconds())
document.getElementById('servertime').innerHTML=datestring+' '+timestring
}
 
window.onload=function(){
setInterval('displaytime()', 1000);
}
 
 
</script>
</head>
<body>
<div id="templatemo_wrapper">
<div id="templatemo_header">
<div id="site_title"><h1>Py-Acqua</h1></div>
<div id="templatemo_menu">
	<div class="home"><a href="index.php"></a></div>
<ul>
    <li><a href="status.php"><?php echo $output[0] ?></a></li>
    <li><a href="calendarix/index.php"><?php echo $output[1] ?></a></li>
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

$db = new PDO("sqlite:/var/tmp/real_time.db");

$sql = $db->prepare("SELECT * FROM real_time where id=1");
$sql->execute();
$data = $sql->fetchAll();
foreach($data as $real_time){
	$real_time = $real_time;
}


?>
<div id="templatemo_content_wrapper">
	
<div id="templatemo_content">


<th><?php echo $output[6] ?></th>
<table>
<tr>
<td><?php echo $output[7] ?></td>
<td><?php echo $real_time[1]; ?></td>
<td><?php echo $output[8] ?></td>
<td><?php echo $real_time[2]; ?></td>
</tr>
<tr>
<td><?php echo $output[9] ?></td>
<td><?php echo $real_time[3] ?></td>
</tr>
<tr>
<td><?php echo $output[11] ?></td>
<td><span id="servertime"></span></td>
</tr>
<tr>
<td><?php echo $output[12] ?></td>
<td></td>
</tr>
<tr>

</tr>
<tr>

</tr>
</table></div>
</div>
</body>
</html>