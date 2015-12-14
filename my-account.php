<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password'])) // to check if the user/employee logged in or not
{
	
	if (($_SESSION['username'] == 'khadyea') || ($_SESSION['username'] == 'alqahtanis4') || ($_SESSION['username'] == 'sarkara') || ($_SESSION['username'] == 'khopkarp'))
	{
		//to check if the looged in one of the above will take him/her to emp-account.php
		?>
			<script type="text/javascript">
						window.location.href = '/emp-account.php';//go to emp-account.php
			</script>
		<?php 
	}//close second if
	else {
		//display my account information for all the users 
			?>
		
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title>My Account | DailyRetailCouponz</title>

</head>
<body>

<div class="container-outer">
<?php
include 'header.php';//get the header
?>
	<div id="wrapper"> <!-- start of full-container -->
		<div class="container-inner">
			<div class="row">
					<?php 
						//include 'sidebar-vendor-page.php';//gat the sidebar
					?>
				
				<div class="col-12">
					<div id="single-page-layout">
						<div class="single-page-title">
						<!-- <h1>Welcome <?php //print $_SESSION['display_name']; ?></h1> -->
						<h1><?php print $_SESSION['display_name']; ?>'s Account Details</h1>
						</div>
						<p><?php print $_SESSION['display_name']; ?>, welcome to Daily Retail Couponz. We are really happy to have you on board with us.</p>
						<p>Here, you can edit/view your specific account details by clicking below tabs.</p>
					
					
					<!-- menu for all the pages -->
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
								<a class="" href="http://www.dailyretailcouponz.com/my-submitted-coupons.php">My Submitted Coupons</a>
							</li>
						
						</ul>
					</div>
					
					<div id="myaccountdetails">
						<div class="single-page-title">
							<h2>Overview of Your Account</h2>
							
						</div>
					</div>
					<?php
					$username = $_SESSION['username'];
					require_once("db_info.php");
					mysql_connect($db_host,$db_username,$db_password,$db_name);
					mysql_select_db($db_name);
					$email = mysql_query("SELECT email FROM login where username = '$username'");

						while($row = mysql_fetch_assoc($email)){
							$email_id = $row['email'];
							//based on the vendor id from the coupon table, vendor data is fetched.
						}							
						
					?>
					<!-- content for my account page -->
						<p><span class="customformtitle">Name: </span><span style="font-weight:bold; font-size:18px;"><?php print $_SESSION['display_name'];//to diplay the display name  ?></span></p>
						<p><span class="customformtitle">Username: </span><span style="font-weight:bold; font-size:18px;"><?php print $_SESSION['username'];//to diplay the name ?></span></p>
						<p><span class="customformtitle">Registered Email Address: </span><span style="font-weight:bold; font-size:18px;"><?php echo $email_id;//to diplay the email; ?></span></p>
						<br>
						<p><span class="showcouponbtn"><a href="http://www.dailyretailcouponz.com/logout.php">Logout</a></span>
						<span class="showcouponbtn"><a href="http://www.dailyretailcouponz.com/delete-account.php">Delete Account</a></span></p><br>
				</div>
			</div>
			</div>
		</div>



			<?php
		} //close else ?>
		
</div> <!-- end of wrapper -->

<?php
include 'footer.php';//get the footer
?>

</div> <!-- end of container-outer -->
</body>
</html>
		
<?php }//close first if
else
{
//if he/she is not logged in, take him/her to the login page
header("Location: login.php");
}//close else
?>