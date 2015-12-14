<?php
require_once("db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name) or die(mysql_error());
//$createdb=mysql_query("CREATE DATABASE users") or die(mysql_error());
//mysql_select_db('grabxgvz_dev2couponz') or die(mysql_query());
mysql_select_db($db_name) or die(mysql_query());

$create_table = mysql_query('CREATE TABLE login( '.
'full_name VARCHAR(30) NOT NULL, '.
'username VARCHAR(11) NOT NULL, '. 
'password VARCHAR(30) NOT NULL, '.
'email VARCHAR(30) NOT NULL, '.
'PRIMARY KEY (username))');

//if($createdb)
//{
//print "Database successfully created<br />";
//}

if($create_table)
{
print "Table successfully created";
}
?>