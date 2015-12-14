<?php
require_once("db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name) or die(mysql_error());
//$createdb=mysql_query("CREATE DATABASE users") or die(mysql_error());
//mysql_select_db('grabxgvz_www') or die(mysql_query());

mysql_select_db($db_name) or die(mysql_query());

$insert_values = mysql_query('INSERT INTO coupon( '.
'coupon_title,coupon_description,coupon_code,coupon_link,coupon_expiry_date,vendor_id,coupon_like,coupon_dislike) '.
'VALUES( '.
'"20% OFF on British Airways domestic flights", '.
'"On purchase of any Bristish Airways domestic flights avail an off of 20% by using this coupon", '.
'"20DOMBA", '.
'"www.google.com", '.
'"2015/11/14", '.
'"1",'.
'"4",'.
'"1")');


$insert_values1 = mysql_query('INSERT INTO coupon( '.
'coupon_title,coupon_description,coupon_code,coupon_link,coupon_expiry_date,vendor_id) '.
'VALUES( '.
'"5% OFF on Virgin Airways International flights", '.
'"Enjoy In-flight Movies, Delicious Complimentary Meals, & Device Connectivity on Virgin Atlantic", '.
'"5VA", '.
'"www.google.com", '.
'"2015/12/31", '.
'"2")');



if($insert_values)
{
print "values inserted";

}
else  {
print "not inserted";
}

if($insert_values1)
{
print "values inserted";

}
else  {
print "not inserted";
}

?>