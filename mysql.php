<?php
class db {
// implementazione della classe db...
//db

private $db_host = "127.0.0.1";
private $db_user = "root";
private $db_password = "root";
private $db_database = "acqua";
private $db_real_time = "real_time";
private $db_work = "work";
private $db_configure ="configure";
private $db_login ="calendar_users";


// controllo sulle connessioni attive
private $attiva = false;
 
// funzione per la connessione a MySQL
public function connetti()
  {
   if(!$this->attiva)
   {
    $connessione = mysql_connect($this->db_host,$this->db_user,$this->db_password);
       }else{
        return true;
       }
    }
// funzione per la chiusura della connessione
public function disconnetti()
{
        if($this->attiva)
        {
                if(mysql_close())
                {
         $this->attiva = false; 
             return true; 
                }else{
                        return false; 
                }
        }
 }
 // funzione per l'estrazione dei record 
public function estrai($risultato)
 {
  if(isset($this->attiva))
  {
  $r = mysql_fetch_object($risultato);
  return $r;
  }else{
  return false; 
  }
 }

//database view real_time
public function view_real_time(){
$result=mysql_db_query($this->db_database,"select * from ".$this->db_real_time." where id=1 ");
$real_time = mysql_fetch_row($result);
return $real_time;
}
//database view work
public function view_work(){
	$result=mysql_db_query($this->db_database,"select * from ".$this->db_work." where id=1 ");
	$work=mysql_fetch_row($result);
	return $work;
}

//database view work download
public function view_work1($day,$day2,$month,$month2,$year,$year2){
	$result=mysql_db_query($this->db_database,"select * from ".$this->db_work." where day >= '$day' and day <= '$day2' and month >= '$month' and month <= '$month2' and year >= '$year' and year <= '$year2' ");
	return $result;
	}

public function view_login($username,$password){
$crypt = "we6c21end2r4u" ;
$cryptpas = crypt($password,$crypt);
$query=mysql_db_query($this->db_database,"select * from ".$this->db_login." where username = '$username' AND password = '$cryptpas' ");
return $query;}

//database view configure
public function view_configure(){
	$result=mysql_db_query($this->db_database,"select * from ".$this->db_configure." where id=1 ");
	$configure=mysql_fetch_row($result);
	return $configure;
}

public function view_configure1(){
	$result=mysql_db_query($this->db_database,"select * from ".$this->db_configure);
	return $result;
}

//database update
public function update_work($par,$value){
	mysql_db_query($this->db_database,"update work set $par='$value' where id=1");
}

public function update_configure($par,$value,$id){
	mysql_db_query($this->db_database,"update configure set $par='$value' where id='$id'");
}



}?>