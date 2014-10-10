<?php
require 'mysql.php';
$data = new db();
$daData = $_POST['theDate2'];
$aData = $_POST['theDate3'];
$array = explode(".",$daData);
$array1 = explode(".",$aData);
 
// richiamo le funzioni visualizzazione
$data->connetti();

$hours=$data->view_hours($array[0],$array1[0],$array[1],$array1[1],$array[2],$array1[2]);
 
$numfields = mysql_num_fields($hours);
for ( $i = 0; $i < $numfields; $i++ )
{
    $header .= mysql_field_name( $hours , $i ) . "\t";
}

while( $row = mysql_fetch_row( $hours ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $datas .= trim( $line ) . "\n";
}
$datas = str_replace( "\r" , "" , $datas );

if ( $datas == "" )
{
    $datas = "\n(0) Records Found!\n";                        
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=download.csv");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$datas";
$data->disconnetti();
//echo '<script language=javascript>document.location.href="download.php"</script>'; 
?>