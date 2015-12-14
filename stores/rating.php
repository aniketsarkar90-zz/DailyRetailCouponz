<?php
session_start();	//Start a new session or resume a session
require_once("../db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name);
mysql_select_db($db_name);
	
	//This method gets all the likes and dislike from the coupons table.
	function getAllrating($couponId)  
	 {  //rating array is used to display the like and dislike
		$rating = array();  
		//fetchs the like and dislike from the coupons table
		$coupon_details = "SELECT * FROM coupon WHERE coupon_id = '$couponId'";  
		$coupon_row = mysql_query($coupon_details);  
		$row = mysql_fetch_array($coupon_row);  
		//the like is stored as the 1st element of rating array
		$rating[0] = $row['coupon_like'];  
		//the dislike is stored as the 2nd element of rating array
		$rating[1] = $row['coupon_dislike'];  
	 return $rating;  
	 }  
	//checks if the fields are not empty
	if (isset($_POST['couponId']) && isset($_POST['type']) && isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		$couponId = $_POST['couponId'];
		$cur_rating = getAllrating($couponId);  
		// fetched if the user has voted for a particular coupon before.
		$voting_details = mysql_fetch_array(mysql_query("select * from ratings where username='$username' and coupon_id='$couponId'"));
		if(!($voting_details['voted'])=='yes'){
		if($_POST['type'] == 'like'){
		//if the user has not voted,the like count is increased by 1 and updated back to the coupon table		
		    $rating_up = $cur_rating[0]+1;  
			mysql_query("UPDATE coupon SET coupon_like = '$rating_up' WHERE coupon_id = '$couponId'");
			$new_rating = getAllrating($couponId); 
			//the new count is send back to the ajax
			echo $new_rating[0];
		}elseif($_POST['type'] == 'dislike'){
		//if the user has not voted,the dislike count is increased by 1 and updated back to the coupon table		
			$couponId = $_POST['couponId'];
		    $rating_up = $cur_rating[1]+1;  
			mysql_query("UPDATE coupon SET coupon_dislike = '$rating_up' WHERE coupon_id = '$couponId'");
			$new_rating = getAllrating($couponId);  
			//the new count is send back to the ajax
			echo $new_rating[1];
		}	
		//if the user has not voted , a new entry is made into the rating table with the coupon id, username and the vote- like or dislike
		mysql_query("INSERT INTO ratings(coupon_id,username,voted) VALUES('$couponId','$username','yes')");

		}else{
			//if the user has already voted, display the old votes without updating any records.
			if($_POST['type'] == 'like'){
				echo $cur_rating[0];
			}elseif($_POST['type'] == 'dislike'){
				echo $cur_rating[1];
			}
	
		
		}
		
	}

	?>