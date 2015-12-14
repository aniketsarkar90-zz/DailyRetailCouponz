<?php
require_once("db_info.php");	 //include the file containing database credentials called 'db_info.php'
session_start();//Start a new session or resume a session.session is started to retrieve data like the username to be displayed
//the folloing if clause if the username and password is not set,i.e. if user is not logged in, then it will enter the if clause
if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
{
//that means the user isn't logged in, redirect to the login page
header("Location: login.php");
}

				mysql_connect($db_host,$db_username,$db_password,$db_name); //to authenticate the database information from db_info.php
				mysql_select_db($db_name); //connecting to the database with the help of information fetched from db_info.php

$user_name=$_SESSION['username']; //obtaining the username from the current session
?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/mystyle.css">
<script src="../js/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
<title>My Submitted Coupons | DailyRetailCouponz</title>
</head>

<body>

<div class="container-outer">
<?php
include 'header.php';
?>
<div id="wrapper"> <!-- start of full-container -->
	<!-- only for inner pages
	<section id="titlebar"> <!-- title goes here
		<div class="container">
		</div>
	</section> -->

	<!-- displays all featured deals on homepage -->
	<div id="deals-container" class="deals-container">
		<div class="container-inner"> 
			
				<div class="row">
						<!-- call sidebar specific to single vendor page -->
						<?php 
						//include 'sidebar-vendor-page.php'
						?>
					
						<!-- main content page -->
						<div class="col-12">
						<div id="single-page-layout">
							<div id="submit-a-coupon">
								<div class="single-page-title">
								<h1>My Submitted Coupons</h1>
								<!--Displays the name of the Logined User-->
								<p><span><?php print $_SESSION['display_name']; ?></span>, checkout all your submitted coupons here.</p>

								</div>
								
							</div>
						<div class="myaccount-tabs">
						<ul id="myaccount-tabs-menu" class="myaccount-tabs-menu">
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/cname.php">Change Name</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/cpassword.php">Change Password</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/cemail.php">Change Email</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/write-a-testimonial.php">Write A Testomonial</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/submit-a-coupon.php">Submit A Coupon</a>
							</li>
							<li>
								<a class="current-tab" href="http://www.dailyretailcouponz.com/my-submitted-coupons.php">My Submitted Coupons</a>
							</li>
						
						</ul>
					</div>
					
						<div class="extra-spacing">
							<!-- we have to right a loop and fetch data from the database  -->
									<?php
											// fetching all the submitted coupons based on username of the session 
												$all_coupons = mysql_query("SELECT * FROM submitted_coupons where username='$user_name'");
												//looping through all the coupons and obtaining their details
												while($row = mysql_fetch_assoc($all_coupons)){
													$vendor_name = $row['submitted_vendor_name'];
													//obtaining the vendor details from vendor table by comparing the provided vendor name
													$vendor =mysql_query("SELECT * FROM vendor WHERE vendor_name='$vendor_name'");
													$vendor_row = mysql_fetch_assoc($vendor);
													$vendor_logo = $vendor_row['vendor_logo'];
													$vendor_name = $vendor_row['vendor_name'];
												 ?>
												
													<div class="single-deal">
													<img class="storelogo" src="<?php echo $vendor_logo; ?>" height="150px" width="240px">
													<div class="single-dealtext">									
													<div class="dealtitle"><?php echo $row['submitted_coupon_title']; ?></div>
													<p><span class="dealdesc"><?php echo $row['submitted_coupon_description']; ?></span></p>
													
													<p><span class="showcouponbtn"><strong>Promo Code: </strong><?php echo $row['submitted_coupon_code']; ?></span></p>
													<p><span class="dealdesc"><?php echo $row['submitted_coupon_expiry_date']; ?></span></p>
													
													</div>
													</div>												
												
													
										<?php }
										
										 ?>
							</div>
						
						</div>

				
				</div>
			
		</div>
	</div>
	
</div> <!-- end of wrapper -->

<?php //calling the footer file 
include 'footer.php';
?>

</div> <!-- end of container-outer -->
</body>
</html>