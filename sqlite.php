<?php
class db {
// implementazione della classe db...
//db
//$db = new PDO("sqlite:///media/data/py-acqua-hw/py/db/configure.db"); 

//$result = $db->query("select * from configure where id=1"); 
//$conf = $result->fetch(PDO::FETCH_ARRAY);
 
$db = new PDO("sqlite:///var/tmp/real_time.db");
$db_conf = new PDO("sqlite:///media/data/py-acqua-hw/py/db/configure.db"); 
//if(!$sq)
//{
 //   die(“Errore Sqlite: “.$sqlite_error);
//}

//database view real_time
public function view_real_time(){
	$result=$db->query("select * from real_time where id=1 ");
	$real_time = $result->fetch(PDO::FETCH_ARRAY);
	$db->close();
	return $real_time;
}
//database view configure
public function view_configure(){
	$result=$db_conf->query("select * from configure where id=1 ");
	$conf=$result->fetch(PDO::FETCH_ARRAY);
	$db_conf->close();
	return $conf;
}

public function view_configure1(){
	$result=$db_conf->query("select * from configure");
	$conf=$result->fetch(PDO::FETCH_ARRAY);
	$db_conf->close();
	return $result;
}

//database update configure
public function update_configure($par,$value,$id){
	$db_conf->query("update configure set $par='$value' where id='$id'");
	$db_conf->close();
}

}?>