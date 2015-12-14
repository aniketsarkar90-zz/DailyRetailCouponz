<?php
session_start();	//Start a new session or resume a session
require_once("../db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name);
mysql_select_db($db_name);
	
	//checks if the code field is not empty
	if (isset($_POST['code'])){
		$coupon_code=$_POST['code'];
		//query is fired to the database based on the code from the coupons table
		$getCount=mysql_query("select * from coupon where coupon_code = '$coupon_code'");
		$rows = mysql_fetch_array($getCount);
		//fetched the count
		$oldCount = $rows['coupon_count'];
		// the count is incremented by 1
		$newCount=$oldCount+1;
		//updates the new count in the table
		$UpdateQuery= mysql_query("UPDATE coupon SET coupon_count='$newCount' where coupon_code = '$_POST[code]'");
		//return the new count to display in the page
		echo 'Coupons Used: '.$newCount;
	}
		
	

	?>