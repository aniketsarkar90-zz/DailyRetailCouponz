<?php
require_once("db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name) or die(mysql_error());
//$createdb=mysql_query("CREATE DATABASE users") or die(mysql_error());
//mysql_select_db('grabxgvz_www') or die(mysql_query());

mysql_select_db($db_name) or die(mysql_query());

$insert_values1 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type,vendor_logo) '.
'VALUES( '.
'"British Airways", '.
'"Airways",'.
'"http://www.dailyretailcouponz.com/images/store-logos/British-Airways-logo.png")');

$insert_values2 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type,vendor_logo) '.
'VALUES( '.
'"Virgin Atlantic", '.
'"Airways",'.
'"http://www.dailyretailcouponz.com/images/store-logos/Virgin-Atlantic-logo.jpg")');

$insert_values3 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type,vendor_logo) '.
'VALUES( '.
'"Emirates", '.
'"Airways",'.
'"http://www.dailyretailcouponz.com/images/store-logos/emirates-logo.png")');

$insert_values4 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type,vendor_logo) '.
'VALUES( '.
'"United Airlines", '.
'"Airways",'.
'"http://www.dailyretailcouponz.com/images/store-logos/united-airlines.jpg")');

$insert_values5 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type,vendor_logo) '.
'VALUES( '.
'"Delta Air Lines", '.
'"Airways",'.
'"http://www.dailyretailcouponz.com/images/store-logos/Delta-Airlines-Logo.jpg")');

$insert_values2 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type,vendor_logo) '.
'VALUES( '.
'"MTA", '.
'"Trains",'.
'"http://www.dailyretailcouponz.com/images/store-logos/mta-logo.jpg")');

$insert_values2 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type,vendor_logo) '.
'VALUES( '.
'"Amtrak", '.
'"Trains",'.
'"http://www.dailyretailcouponz.com/images/store-logos/amtrak.jpg")');

$insert_values2 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type,vendor_logo) '.
'VALUES( '.
'"Greyhound", '.
'"Bus",'.
'"http://www.dailyretailcouponz.com/images/store-logos/greyhound.jpg")');

$insert_values2 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type,vendor_logo) '.
'VALUES( '.
'"Mega Bus", '.
'"Bus",'.
'"http://www.dailyretailcouponz.com/images/store-logos/megabus_logo.jpg")');

$insert_values2 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type,vendor_logo) '.
'VALUES( '.
'"Peter Pan", '.
'"Bus",'.
'"http://www.dailyretailcouponz.com/images/store-logos/Peter_Pan_bus_logo.jpg")');



/*
$insert_values2 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type) '.
'VALUES( '.
'"Southwest Airways", '.
'"Airways")');

$insert_values3 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type) '.
'VALUES( '.
'"Amtrak", '.
'"Trains")');

$insert_values4 = mysql_query('INSERT INTO vendor( '.
'vendor_name,vendor_type) '.
'VALUES( '.
'"MTA", '.
'"Trains")');
*/
if($insert_values1 && $insert_values2)
{
print "values inserted";

}
else  {
print "not inserted";
}
?>