<?php
session_start(); //inizio la sessione
//includo i file necessari a collegarmi al db con relativo script di accesso
// richiamo il file di configurazione
require 'sqlite.php';
$data = new db();
 
// richiamo le funzioni visualizzazione
//$data->connetti();

//mi collego
//mysql_select_db("$db_database",$connessione); 
 
//variabili POST con anti sql Injection
$username=mysql_real_escape_string($_POST['username']); //faccio l'escape dei caratteri dannosi
$password=mysql_real_escape_string($_POST['password']);
//$password=mysql_real_escape_string(sha1($_POST['password'])); //sha1 cifra la password anche qui in questo modo corrisponde con quella del db
 
//$query = "SELECT * FROM login WHERE username = '$username' AND password = '$password' ";
$query = $data->view_login($username,$password); 
 //$ris = mysql_query($query, $connessione) or die (mysql_error());
//$ris = mysql_query($query) or die (mysql_error());
 $riga=mysql_fetch_array($query);  
 
/*Prelevo l'identificativo dell'utente */
$cod=$riga['username'];
 
/* Effettuo il controllo */
if ($cod == NULL) $trovato = 0 ;
else $trovato = 1;  
 
/* Username e password corrette */
if($trovato === 1) {
 
 /*Registro la sessione*/
  session_register('autorizzato');
 
  $_SESSION["autorizzato"] = 1;
 
  /*Registro il codice dell'utente*/
  $_SESSION['cod'] = $cod;
 
 /*Redirect alla pagina riservata*/
   echo '<script language=javascript>document.location.href="status.php"</script>'; 
 
} else {
 
/*Username e password errati, redirect alla pagina di login*/
 echo '<script language=javascript>document.location.href="index.php"</script>';
 
}?>
<?php 
$data->disconnetti();
?>