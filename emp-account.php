<?php session_start();
	if (($_SESSION['username'] == 'khadyea') || ($_SESSION['username'] == 'alqahtanis4') || ($_SESSION['username'] == 'sarkara') || ($_SESSION['username'] == 'khopkarp'))
	{ //look for these 4 users 
if(isset($_SESSION['username']) && isset($_SESSION['password']))// to check if the user/employee logged in or not
{
?>

	
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title>Employee Account | DailyRetailCouponz</title>

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
					include 'sidebar-vendor-page-emp.php';//get the sidebar which would only be displayed for employees
				?>
				
				<div class="col-9">
					<div id="single-page-layout">
						<div class="single-page-title">
						
						<h1><?php print $_SESSION['display_name'];//display the employee's diplay name ?>'s Account Details</h1>
						</div>
						<p>Edit, view or manage</p>
					
					
					<!-- menu for all the pages -->
					<div class="myaccount-tabs">
						<ul id="myaccount-tabs-menu" class="myaccount-tabs-menu emp-account-tabs">
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
								<a class="" href="http://www.dailyretailcouponz.com/all-coupons.php">Edit All Coupons</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/submitted-coupons.php">Submitted Coupons By Users</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/upload-coupons.php">Upload Coupons (Excel)</a>
							</li>
							
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/add-vendor.php">Add Vendors</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/generate-report.php">Get Report</a>
							</li>
						</ul>
					</div>
					<br><br>
					<div id="myaccountdetails">
						<div class="single-page-title">
							<h2>Overview of Your Account</h2>
							
						</div>
					</div>
					<?php
					$username = $_SESSION['username'];
					//echo $username;
					require_once("db_info.php");
					mysql_connect($db_host,$db_username,$db_password,$db_name);
					mysql_select_db($db_name);
					$email = mysql_query("SELECT email FROM login where username = '$username'");
						while($row = mysql_fetch_assoc($email)){
							$email_id = $row['email'];
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


</div> <!-- end of wrapper -->

<?php
include 'footer.php';//get footer
?>

</div> <!-- end of container-outer -->
</body>
</html>
			

	<?php 
	}//close second if
	else {
			
			?>
			<script type="text/javascript">
						window.location.href = '/my-account.php';//if it's not one of the 4 users above in the if taking to my-account.php
			</script>
			<?php 
		}//close first else
}//close the first if
else
{
//if anyone other than employee tries to access this page he will be taken to this page
include 'authorization-failed.php';
//Redirects the user to the login page if he is not logged in
//header("Location: login.php");
}//close second else
?>