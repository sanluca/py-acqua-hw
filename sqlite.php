<?php
class db {
// implementazione della classe db...
//db
$sq = sqlite_open("/var/tmp/real_time.db", 0666, $sqlite_error);
if(!$sq)
{
    die(“Errore Sqlite: “.$sqlite_error);
}

 

//database view real_time
public function view_real_time(){
$result=sqlite_query($sq,"select * from real_time where id=1 ");
$real_time = sqlite_fetch_array($result);
return $real_time;
sqlite_close($sq);
}
//database view configure
public function view_configure(){
	$result=sqlite_query($sq,"select * from configure where id=1 ");
	$work=sqlite_fetch_array($result);
	return $work;
}

public function view_configure1(){
	$result=sqlite_query($sq,"select * from configure");
	return $result;
}

//database update configure
public function update_configure($par,$value,$id){
	sqlite_query($sq,"update configure set $par='$value' where id='$id'");
}

}?>