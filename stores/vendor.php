<?php
session_start();	//Start a new session or resume a session
require_once("../db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name);
mysql_select_db($db_name);
	
    if(isset($_POST['texttext']) && $_POST['texttext']!=''){
        	@extract($_POST);
			$timeanddate = date("Y/m/d h:i:sa");/* to set up the time and assign it to timeanddate*/
			
			
      /* to insert comment, comment time, who add the comment, and the comment date to the comment table for each coupon code */
            $stmt = "insert into coupon_comments set coupon_code='$coupon_code', username='".$_SESSION['username']."', comment_comment='$texttext', date_time='$timeanddate'";
        	if(mysql_query($stmt)){	
			 header('Location: '.$_SERVER['REQUEST_URI']); /* after inserting the comment this code will take you back to where you were */
			/* fetching for the user email */
			$username = $_SESSION['username'];
			$result=mysql_query("select email from login where username='$username'");
			//we have to change the email address, right now it is sending the email to users' email , we have to change it and send the email 
			// to the employee's email address
			
			$rows = mysql_fetch_array($result);
			$to = $rows['email']; 
			
			/* sending the email from info@dailyretailcouponz.com */
			$from = "daily retail couponz";
			$url = "http://www.dailyretailcouponz.com/";
			$from = "info@dailyretailcouponz.com";
			$subject = "Comment ".($texttext)." Submitted";
			$body  =  "Thank you for submitting the comment";
			$headers = "From: $from\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$sentmail = mail( $to, $subject, $body, $headers);
		
		}
	     
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Vendor Page | DailyRetailCouponz</title>
 <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
 <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="../js/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>

  <style>
  .popup-position{display:none;position:fixed;top :0;left:0; background-color:rgba(0,0,0,0.7); width:100%;height:100%}
  #popup-wrapper{width:900px;margin:70px auto;text-align:center;}
  #popup-container{background-color:#FFF; padding:20px;border-radius:20px;}
  </style>
    <script language="javascript">
	//ratingCliked is called on the click of like or dislike button.
        function ratingCliked(coupon_id,type){ 
	//a ajax post request is made to the rating.php page.
	//couponId and type - like or dislike is passed to the page
        $.post("rating.php",{couponId:coupon_id,type:type},function(data){
		//on success of the function, the text is appended to the coupon and the buttons are disabled as the user can only vote once.
		$('#'+coupon_id+'_'+type).text(data);
        document.getElementById('button_'+coupon_id+'_like').disabled = true; 
        document.getElementById('button_'+coupon_id+'_dislike').disabled = true; 
        });
        }
        
    function get_comment_date($d, $comment_ID){
		$d = "l, F jS, Y";
		$comment_date = get_comment_date( $d, $comment_ID );
	}

    //allows only logined users to vote. If the user is not logined in, message is displayed.
	function loginRequest(){
			alert("Please login in to vote");
        }
	
	//this method is called when the user clicks on the code button.
    function openCodePopUp(code,url) {
		//checks if the url is present.if its present a new tab is opened in the window with the url
		//also the focus is passed to the new tab from the current window.
		if(url!=''){
		 var win = window.open(url,'_blank');
			win.focus();
		}
	   //displays the pop up by setting the display property of css to block
       var e = document.getElementById(code);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else{
          e.style.display = 'block';
		//calls the ajax method and popUp.php is called  
	   $.post("popUp.php",{code:code},function(data){
		//on success of the function, the text is appended to the count
		$('#'+code+'_count').text(data);
        });
	  }

	  
	  
    }
//-->
	</script>
	<script>
// this code will generate the dropdown menu for individual comments 
$(document).ready(function(){
	
   // $(".displaycouponcomment").click(function(){
    //    $(".couponcomments").toggle(1000);
  //  });

$(".displaycouponcomment").click(function(){
      $(this).next("div.couponcomments").toggle(200);
});  
  
}); 

</script>
</head>
 <body>
    <div class="container-outer">
    
    <?php
        include '../header.php';/*to get the header page  */
    ?>
	<div id="wrapper"> <!-- start of full-container --> 
          
      <!-- displays all featured deals on homepage -->
      <div id="deals-container" class="deals-container">
        <div class="container-inner extraheight">
          <div class="row"> 
            <!-- call sidebar specific to single vendor page -->
            <?php 
				include '../sidebar-vendor-page.php'; /*to get the sidebar page  */
            ?>
            <!-- main content page -->
            <div class="col-9">
              <div class="single-page-title">
                <?php
				
				//as this page is called from the stores page action. It fetches data from the stores page using GET method
				//fetches the vendor id from the stores page.
                if (isset($_GET['id'])){
                    $vendor_id=$_GET['id'];	
					//based on the vendor id, the vendor details are fetched
                    $vendor =mysql_query("SELECT * FROM vendor WHERE vendor_id='$vendor_id'");
                    $vendor_row = mysql_fetch_assoc($vendor);
                    $vendor_logo = $vendor_row['vendor_logo'];
                    $vendor_name = $vendor_row['vendor_name'];
                ?>
                <h1 style="text-align:center;"><?php echo $vendor_name ?> Featured Deals</h1>
                
				<!--  loop that fetches data from the database -->
                <?php
				if(isset($_SESSION['username']) && isset($_SESSION['password'])){//TO check if the user/employee logged in or not
					//based on the vendor id, the coupons are fetched.
                    $all_coupons = mysql_query("SELECT * FROM coupon where vendor_id='$vendor_id' and coupon_expiry_date >= CURDATE()");
					$count=mysql_num_rows($all_coupons);
				?>
				
				
				
				<br>
				<p><h2><span class="active-inactive">Active Coupon(s) Found: <?php echo $count;?></span></h2></p>
				<?php
                    while($row = mysql_fetch_assoc($all_coupons)){
					$coupon_code=$row['coupon_code'];	
					$coupon_count=$row['coupon_count'];
				
				 $coupon_comments_c = mysql_query("SELECT COUNT(comment_comment) as comment_count FROM coupon_comments where coupon_code='".$row['coupon_code']."'");
					 while($com_count=mysql_fetch_assoc($coupon_comments_c)){
					   
					
					
                ?>
				<div id="<?php echo $coupon_code; ?>" class="popup-position">
					<div id="popup-wrapper">
						<div id="popup-container">
							<p style="text-align:right"><a href="javascript:void(0)" onclick="openCodePopUp('<?php echo $coupon_code; ?>','');">X</a></p>
							<h3>Code for <strong><?php echo $row['coupon_title']; ?></strong></h3>
							<h3>Just Copy the code and use it</h3>
							<p class="showcouponbtn"><?php echo $coupon_code; ?></p>
							<p>Details: <?php echo $row['coupon_description']; ?></p>
							<h3><a href="<?php echo $row['coupon_link']; ?>" target="_blank">Go to Store</a></h3>
						</div>
					</div>
				</div>
			
                <div class="single-deal"> 
				<!--Displays the vendor logo-->
                  <img class="storelogo" src="<?php echo $vendor_logo; ?>" height="150px" width="240px">
                  <div class="single-dealtext">
				 
				  <!--Displays the coupon code-->
					<input name="code" value="<?php echo $coupon_code; ?>" type="hidden"/>
					<!--Displays the coupon title-->
                    <div class="dealtitle"><?php echo $row['coupon_title']; ?></div>
                    <!--Displays the coupon Description-->
					<p><span class="dealdesc"><?php echo $row['coupon_description']; ?></span></p>
                    <input name="countButton" type="hidden"/>
					
					
					
					<button class="showcouponbtn" type="submit" onclick="openCodePopUp('<?php echo $coupon_code; ?>','<?php echo $row['coupon_link']; ?>');"><span class="promocode">Promo Code: </span><span class="couponcode"><?php echo $coupon_code; ?></button></span>
					
          
                    <?php
					//checks the username as only login user can vote
                    $_SESSION['display_name'] = $_SESSION['username'];
                    $username = $_SESSION['username'];
                    if (!empty($username)){ 
                    ?>
                    <!--On the click of the like or dislike button, ratingClicked method is called and the coupons table is updated-->
                    <div class="likedislikebtn">
                      <button class="like" onclick="ratingCliked('<?php echo $row['coupon_id']; ?>','like');" id="button_<?php echo $row['coupon_id'];?>_like" > <img src="images/vote-up.png"><span class="like-dislike-count" id="<?php echo $row['coupon_id'];?>_like"><?php echo $row['coupon_like']?></span> </button>
                      <button class="dislike" onclick="ratingCliked('<?php echo $row['coupon_id']; ?>','dislike');" id="button_<?php echo $row['coupon_id'];?>_dislike"> <img src="images/vote-down.png"><span class="like-dislike-count" id="<?php echo $row['coupon_id'];?>_dislike"><?php echo $row['coupon_dislike']?></span></button>
                    </div>
                    
                    <?php }
                    else {
                    ?>
					<!--If the user is not login,loginRequest method is called  and message is displayed-->		
                    <div class="likedislikebtn">
                      <button class="like" onclick="loginRequest();"><img src="images/vote-up.png"><span class="like-dislike-count"><?php echo $row['coupon_like']?></span></button>
                      <button class="dislike" onclick="loginRequest();"><img src="images/vote-down.png"><span class="like-dislike-count"><?php echo $row['coupon_dislike']?></span></button>
                    </div>
                   
                    <?php } 
                    ?>
                    
					<!--Displays the coupon expiry-->                    
					<div class="single-deal-footer">
					
                    <div class="single-deal-expiry"><span>Expiration Date: </span><?php echo $row['coupon_expiry_date']; ?></div>
					<!--Displays the coupon used. Setting the coupon code and "count" as id-->
                   
					<div class="couponsused"  id="<?php echo $row['coupon_code'];?>_count" name="count"><span>Coupons Used: </span><?php echo $coupon_count; ?></div>
                      
  					<!--Displays the coupon comment--> 
					
					<div class="displaycouponcomment"><span>Comments (<?php echo $com_count['comment_count'];?>) </span></div>	
					<div style="display:none;margin-top:30px;" class="couponcomments">
					<form action="" method="post">
                      <?php
					   /* to assign each comment to its coupon on that the user want to comment  */
                      $commentassign = mysql_query("select * from coupon_comments where coupon_code='".$row['coupon_code']."'");
					  
					  //query to fetch the coupon comments count
					 
						
						$result_coupon_count = mysql_fetch_array($coupon_comments_c);
						
						//while($row = mysql_fetch_assoc($coupon_comments_c)){
							//$email_id = $row['email'];
							//based on the vendor id from the coupon table, vendor data is fetched.
						//}	
					
					  
                      while ($allcomment = mysql_fetch_object($commentassign)){
						  
				echo ' <div class="comments-box"><p class="commenting-attr"><span>Name:</span> '. (($allcomment->username=='')? 'Guest':$allcomment->username) .'</p>';
                          echo '<p class="commenting-attr"><span>Comment:</span> '.$allcomment->comment_comment.'</p>'; /* loop to display all comments that have been added */
						  echo '<p class="commenting-attr"><span>TimeStamp:</span> '.$allcomment->date_time.'</p></div>'; /* loop to display all the comment's time and date */
                          //echo "<hr />";/* a separate between comments */
						   
					  }?>
                      
                     
                           
                        <input type="hidden" name="coupon_code" value="<?=$row['coupon_code']/*Where the comment is going to be displayed  */?>">
                        
              
                        <p><span class="addcomments"><strong>Add Comment:</strong></span></p>
                    
                        <p>
                          <textarea name="texttext" cols="50"></textarea>
                          
                          <br />
                        </p>
                        <p>
                          <input class="coupon-comments-btn" type="submit" value="Submit" />
                        </p>
						</div> <!-- couponcomment -->
                      </form>
                      
                        </div>  <!-- single-deal-footer -->
                      </div> <!-- end of single-dealtext -->
                    </div>  <!-- end of single-deal -->
                
      <!-- end of wrapper -->
                     <?php
						} //while of count comment
							}//main while
						?>
	
	 <?php
					//based on the vendor id, the coupons are fetched.
                    $all_coupons = mysql_query("SELECT * FROM coupon where vendor_id='$vendor_id' and coupon_expiry_date < CURDATE()");
					$count=mysql_num_rows($all_coupons);
				?>
				<br>
				<p><h2><span class="active-inactive">Unreliable Coupon(s) Found: <?php echo $count;?></span></h2></p>
				<?php
                    while($row = mysql_fetch_assoc($all_coupons)){
					$coupon_code=$row['coupon_code'];	
					$coupon_count=$row['coupon_count'];
				
					 $coupon_comments_c = mysql_query("SELECT COUNT(comment_comment) as comment_count FROM coupon_comments where coupon_code='".$row['coupon_code']."'");
					 while($com_count=mysql_fetch_assoc($coupon_comments_c)){
					   
					
					
					
                ?>
				<div id="<?php echo $coupon_code; ?>" class="popup-position">
					<div id="popup-wrapper">
						<div id="popup-container">
							<p style="text-align:right"><a href="javascript:void(0)" onclick="openCodePopUp('<?php echo $coupon_code; ?>','');">X</a></p>
							<h3>Code for <strong><?php echo $row['coupon_title']; ?></strong></h3>
							<h3>Just Copy the code and use it</h3>
							<p class="showcouponbtn"><?php echo $coupon_code; ?></p>
							<p>Details: <?php echo $row['coupon_description']; ?></p>
							<h3><a href="<?php echo $row['coupon_link']; ?>" target="_blank">Go to Store</a></h3>
						</div>
					</div>
				</div>
			
                <div class="single-deal"> 
				<!--Displays the vendor logo-->
                  <img class="storelogo" src="<?php echo $vendor_logo; ?>" height="150px" width="240px">
                  <div class="single-dealtext">
				 
				  <!--Displays the coupon code-->
					<input name="code" value="<?php echo $coupon_code; ?>" type="hidden"/>
					<!--Displays the coupon title-->
                    <div class="dealtitle"><?php echo $row['coupon_title']; ?></div>
                    <!--Displays the coupon Description-->
					<p><span class="dealdesc"><?php echo $row['coupon_description']; ?></span></p>
                    <input name="countButton" type="hidden"/>
					
					<button class="showcouponbtn" type="submit" onclick="openCodePopUp('<?php echo $coupon_code; ?>','<?php echo $row['coupon_link']; ?>');"><span class="promocode">Promo Code: </span><span class="couponcode"><?php echo $coupon_code; ?></button></span>
					
                    
                    <?php
					//checks the username as only login user can vote
                    $_SESSION['display_name'] = $_SESSION['username'];
                    $username = $_SESSION['username'];
                    if (!empty($username)){ 
                    ?>
                    <!--On the click of the like or dislike button, ratingClicked method is called and the coupons table is updated-->
                    <div class="likedislikebtn">
                      <button class="like" onclick="ratingCliked('<?php echo $row['coupon_id']; ?>','like');" id="button_<?php echo $row['coupon_id'];?>_like" > <img src="images/vote-up.png"><span class="like-dislike-count" id="<?php echo $row['coupon_id'];?>_like"><?php echo $row['coupon_like']?></span> </button>
                      <button class="dislike" onclick="ratingCliked('<?php echo $row['coupon_id']; ?>','dislike');" id="button_<?php echo $row['coupon_id'];?>_dislike"> <img src="images/vote-down.png"><span class="like-dislike-count" id="<?php echo $row['coupon_id'];?>_dislike"><?php echo $row['coupon_dislike']?></span></button>
                    </div>
                    
                    <?php }
                    else {
                    ?>
					<!--If the user is not login,loginRequest method is called  and message is displayed-->		
                    <div class="likedislikebtn">
                      <button class="like" onclick="loginRequest();"><img src="images/vote-up.png"><span class="like-dislike-count"><?php echo $row['coupon_like']?></span></button>
                      <button class="dislike" onclick="loginRequest();"><img src="images/vote-down.png"><span class="like-dislike-count"><?php echo $row['coupon_dislike']?></span></button>
                    </div>
                   
                    <?php } 
                    ?>
                    
					<!--Displays the coupon expiry-->                    
					<div class="single-deal-footer">
					
                    <div class="single-deal-expiry"><span>Expiration Date: </span><?php echo $row['coupon_expiry_date']; ?></div>
					<!--Displays the coupon used. Setting the coupon code and "count" as id-->
                   
					<div class="couponsused"  id="<?php echo $row['coupon_code'];?>_count" name="count"><span>Coupons Used: </span><?php echo $coupon_count; ?></div>
                      
  					<!--Displays the coupon comment--> 
					
					<div class="displaycouponcomment"><span>Comments (<?php echo $com_count['comment_count'];?>)</span></div>	
					<div style="display:none;margin-top:30px;" class="couponcomments">
					<form action="" method="post">
                      <?php
					   /* to assign each comment to its coupon on that the user want to comment  */
                      $commentassign = mysql_query("select * from coupon_comments where coupon_code='".$row['coupon_code']."'");
                      while ($allcomment = mysql_fetch_object($commentassign)){
						  
				echo ' <div class="comments-box"><p class="commenting-attr"><span>Name:</span> '. (($allcomment->username=='')? 'Guest':$allcomment->username) .'</p>';
                          echo '<p class="commenting-attr"><span>Comment:</span> '.$allcomment->comment_comment.'</p>'; /* loop to display all comments that have been added */
						  echo '<p class="commenting-attr"><span>TimeStamp:</span> '.$allcomment->date_time.'</p></div>'; /* loop to display all the comment's time and date */
                          //echo "<hr />";/* a separate between comments */
					  }?>
                      
                     
                           
                        <input type="hidden" name="coupon_code" value="<?=$row['coupon_code']/*Where the comment is going to be displayed  */?>">
                        
              
                        <p><span class="addcomments"><strong>Add Comment:</strong></span></p>
                    
                        <p>
                          <textarea name="texttext" cols="50"></textarea>
                          
                          <br />
                        </p>
                        <p>
                          <input class="coupon-comments-btn" type="submit" value="Submit" />
                        </p>
						</div> <!-- couponcomment -->
                      </form>
                      
                        </div>  <!-- single-deal-footer -->
                      </div> <!-- end of single-dealtext -->
                    </div>  <!-- end of single-deal -->
                
      <!-- end of wrapper -->
                     <?php
							}	//end of while comment_count
								} //end of main while ?>
					 
				<?php	 
				 
					} 	
		
				else{//TO check if the user/employee logged in or not
					//based on the vendor id, the coupons are fetched.
                    $all_coupons = mysql_query("SELECT * FROM coupon where vendor_id='$vendor_id' and coupon_expiry_date >= CURDATE() LIMIT 2");
					$count=mysql_num_rows($all_coupons);
				?>
				
				
				
				<br>
				<p><h2><span class="active-inactive">Active Coupon(s) Found: <?php echo $count;?></span></h2></p>
				<?php
                    while($row = mysql_fetch_assoc($all_coupons)){
					$coupon_code=$row['coupon_code'];	
					$coupon_count=$row['coupon_count'];
				
				 $coupon_comments_c = mysql_query("SELECT COUNT(comment_comment) as comment_count FROM coupon_comments where coupon_code='".$row['coupon_code']."'");
					 while($com_count=mysql_fetch_assoc($coupon_comments_c)){
					   
					
					
                ?>
				<div id="<?php echo $coupon_code; ?>" class="popup-position">
					<div id="popup-wrapper">
						<div id="popup-container">
							<p style="text-align:right"><a href="javascript:void(0)" onclick="openCodePopUp('<?php echo $coupon_code; ?>','');">X</a></p>
							<h3>Code for <strong><?php echo $row['coupon_title']; ?></strong></h3>
							<h3>Just Copy the code and use it</h3>
							<p class="showcouponbtn"><?php echo $coupon_code; ?></p>
							<p>Details: <?php echo $row['coupon_description']; ?></p>
							<h3><a href="<?php echo $row['coupon_link']; ?>" target="_blank">Go to Store</a></h3>
						</div>
					</div>
				</div>
			
                <div class="single-deal"> 
				<!--Displays the vendor logo-->
                  <img class="storelogo" src="<?php echo $vendor_logo; ?>" height="150px" width="240px">
                  <div class="single-dealtext">
				 
				  <!--Displays the coupon code-->
					<input name="code" value="<?php echo $coupon_code; ?>" type="hidden"/>
					<!--Displays the coupon title-->
                    <div class="dealtitle"><?php echo $row['coupon_title']; ?></div>
                    <!--Displays the coupon Description-->
					<p><span class="dealdesc"><?php echo $row['coupon_description']; ?></span></p>
                    <input name="countButton" type="hidden"/>
					
					
					
					<button class="showcouponbtn" type="submit" onclick="openCodePopUp('<?php echo $coupon_code; ?>','<?php echo $row['coupon_link']; ?>');"><span class="promocode">Promo Code: </span><span class="couponcode"><?php echo $coupon_code; ?></button></span>
					
          
                    <?php
					//checks the username as only login user can vote
                    $_SESSION['display_name'] = $_SESSION['username'];
                    $username = $_SESSION['username'];
                    if (!empty($username)){ 
                    ?>
                    <!--On the click of the like or dislike button, ratingClicked method is called and the coupons table is updated-->
                    <div class="likedislikebtn">
                      <button class="like" onclick="ratingCliked('<?php echo $row['coupon_id']; ?>','like');" id="button_<?php echo $row['coupon_id'];?>_like" > <img src="images/vote-up.png"><span class="like-dislike-count" id="<?php echo $row['coupon_id'];?>_like"><?php echo $row['coupon_like']?></span> </button>
                      <button class="dislike" onclick="ratingCliked('<?php echo $row['coupon_id']; ?>','dislike');" id="button_<?php echo $row['coupon_id'];?>_dislike"> <img src="images/vote-down.png"><span class="like-dislike-count" id="<?php echo $row['coupon_id'];?>_dislike"><?php echo $row['coupon_dislike']?></span></button>
                    </div>
                    
                    <?php }
                    else {
                    ?>
					<!--If the user is not login,loginRequest method is called  and message is displayed-->		
                    <div class="likedislikebtn">
                      <button class="like" onclick="loginRequest();"><img src="images/vote-up.png"><span class="like-dislike-count"><?php echo $row['coupon_like']?></span></button>
                      <button class="dislike" onclick="loginRequest();"><img src="images/vote-down.png"><span class="like-dislike-count"><?php echo $row['coupon_dislike']?></span></button>
                    </div>
                   
                    <?php } 
                    ?>
                    
					<!--Displays the coupon expiry-->                    
					<div class="single-deal-footer">
					
                    <div class="single-deal-expiry"><span>Expiration Date: </span><?php echo $row['coupon_expiry_date']; ?></div>
					<!--Displays the coupon used. Setting the coupon code and "count" as id-->
                   
					<div class="couponsused"  id="<?php echo $row['coupon_code'];?>_count" name="count"><span>Coupons Used: </span><?php echo $coupon_count; ?></div>
                      
  					<!--Displays the coupon comment--> 
					
					<div class="displaycouponcomment"><span>Comments (<?php echo $com_count['comment_count'];?>) </span></div>	
					<div style="display:none;margin-top:30px;" class="couponcomments">
					<form action="" method="post">
                      <?php
					   /* to assign each comment to its coupon on that the user want to comment  */
                      $commentassign = mysql_query("select * from coupon_comments where coupon_code='".$row['coupon_code']."'");
					  
					  //query to fetch the coupon comments count
					 
						
						$result_coupon_count = mysql_fetch_array($coupon_comments_c);
						
						//while($row = mysql_fetch_assoc($coupon_comments_c)){
							//$email_id = $row['email'];
							//based on the vendor id from the coupon table, vendor data is fetched.
						//}	
					
					  
                      while ($allcomment = mysql_fetch_object($commentassign)){
						  
				echo ' <div class="comments-box"><p class="commenting-attr"><span>Name:</span> '. (($allcomment->username=='')? 'Guest':$allcomment->username) .'</p>';
                          echo '<p class="commenting-attr"><span>Comment:</span> '.$allcomment->comment_comment.'</p>'; /* loop to display all comments that have been added */
						  echo '<p class="commenting-attr"><span>TimeStamp:</span> '.$allcomment->date_time.'</p></div>'; /* loop to display all the comment's time and date */
                          //echo "<hr />";/* a separate between comments */
						   
					  }?>
                      
                     
                           
                        <input type="hidden" name="coupon_code" value="<?=$row['coupon_code']/*Where the comment is going to be displayed  */?>">
                        
              
                        <p><span class="addcomments"><strong>Add Comment:</strong></span></p>
                    
                        <p>
                          <textarea name="texttext" cols="50"></textarea>
                          
                          <br />
                        </p>
                        <p>
                          <input class="coupon-comments-btn" type="submit" value="Submit" />
                        </p>
						</div> <!-- couponcomment -->
                      </form>
                      
                        </div>  <!-- single-deal-footer -->
                      </div> <!-- end of single-dealtext -->
                    </div>  <!-- end of single-deal -->
                
      <!-- end of wrapper -->
                     <?php
						} //while of count comment
							}//main while
						?>
						<div align="middle" class="register-for-more">
							<a  href="http://www.dailyretailcouponz.com/register.php">
								<button class="register-showcouponbtn">Register to view more coupons...</button>
							</a>
						</div>
				<?php	 
				 
					} 	
				
				}
				?>
                      
                   </div>   
                </div>
                  </div>
             
                  
      </div>   
                      
                      
                  
                   
              
      
      <?php
        include '../footer.php';/*to gat the foolter page  */
        ?>
</div> <!-- end of container-outer -->
</body>
</html>