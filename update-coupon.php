<?php
session_start();	//Start a new session or resume a session
require_once("db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name);
mysql_select_db($db_name);

	function getAllrating($couponId)  
	 {   
		$rating = array();  
		$coupon_details = "SELECT * FROM coupon WHERE coupon_id = '$couponId'";  
		$coupon_row = mysql_query($coupon_details);  
		$row = mysql_fetch_array($coupon_row);  
		$rating[0] = $row['coupon_like'];  
		$rating[1] = $row['coupon_dislike'];  
	 return $rating;  
	 }  

	if (isset($_POST['title']) && isset($_POST['desc']) && isset($_POST['code']) && isset($_POST['expiryDate'])){
		echo $_POST['title'];
		$username = $_SESSION['username'];
		$couponId = $_POST['couponId'];
		$cur_rating = getAllrating($couponId);  

		$voting_details = mysql_fetch_array(mysql_query("select * from ratings where username='$username' and coupon_id='$couponId'"));
		if(!($voting_details['voted'])=='yes'){
		if($_POST['type'] == 'like'){
			
		    $rating_up = $cur_rating[0]+1;  
			mysql_query("UPDATE coupon SET coupon_like = '$rating_up' WHERE coupon_id = '$couponId'");
			$new_rating = getAllrating($couponId); 
			echo $new_rating[0];
		}elseif($_POST['type'] == 'dislike'){
			
			$couponId = $_POST['couponId'];
		    $rating_up = $cur_rating[1]+1;  
			mysql_query("UPDATE coupon SET coupon_dislike = '$rating_up' WHERE coupon_id = '$couponId'");
			$new_rating = getAllrating($couponId);  
			echo $new_rating[1];
		}	
		mysql_query("INSERT INTO ratings(coupon_id,username,voted) VALUES('$couponId','$username','yes')");

		}else{
			if($_POST['type'] == 'like'){
				echo $cur_rating[0];
			}elseif($_POST['type'] == 'dislike'){
				echo $cur_rating[1];
			}
			
		
		}
		
	}

	?>