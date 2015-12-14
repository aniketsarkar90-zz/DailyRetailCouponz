<?php
session_start();	//Start a new session or resume a session
require_once("db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name);
mysql_select_db($db_name);
$selectQuery = "SELECT  * from coupon order by coupon_id";
$header = '';
$result ='';
$couponData = mysql_query ($selectQuery );
 
$fields = mysql_num_fields ( $couponData );
 
for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $couponData , $i ) . "\t";
}
 
while( $row = mysql_fetch_row( $couponData ) )
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
    $result .= trim( $line ) . "\n";
}
$result = str_replace( "\r" , "" , $result );
//header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment;filename="userList.xls"');
header("Content-type: application/octet-stream");
$filename = "coupon_data_" . date('Ymd') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
print "$header\n$result";
 
?>