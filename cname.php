<?php
require_once("db_info.php");	//include the file containing database credentials
session_start();	//Start a new session or continues the session
if(!isset($_SESSION['username']) || !isset($_SESSION['password']))// to check if the customer/employee logged in or not
{
header("Location: login.php");//if one is not logged in then go to login page
}//close if isset 
if(isset($_POST['new_name']))//to Check if the submit button clicked or not
{
if(!empty($_POST['new_name']))//to change the display name, use the input 'new_name'
	{
	$old_name=$_SESSION['display_name'];//assign the current display_name to old_name
	$new_name=stripslashes(trim($_POST['new_name']));//the new name
	$uname=$_SESSION['username'];//assign the user name
	mysql_connect($db_host,$db_username,$db_password,$db_name); //to authenticate the database information from db_info.php
	mysql_select_db($db_name); //connecting to the database with the help of information fetched from db_info.php
	mysql_query("UPDATE login SET full_name='$new_name' WHERE username='$uname'"); // update the login table with the new name
	$_SESSION['display_name']=$new_name; //fetch the new name and display it
	//print "Your Account name has been changed from $old_name to $new_name";
	$info_success = "Your Account name has been changed from $old_name to $new_name";//assign the this message to info_success
	}//end if empty
else
{

	$info_empty = "Field cannot be blank";// display this message if the textbox is empty and assign the this message to info_empty
}//end else
}//end if isset new name

//checking if employee
if (($_SESSION['username'] == 'khadyea') || ($_SESSION['username'] == 'alqahtanis4') || ($_SESSION['username'] == 'sarkara') || ($_SESSION['username'] == 'khopkarp'))
	{ //look for these 4 users //if any emplooyee signs in - he should see the following layout ?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title>Change Name | DailyRetailCouponz</title>

</head>
<body>

<div class="container-outer">
<?php
include 'header.php';// to get the header
?>
	<div id="wrapper"> <!-- start of full-container -->
		<div class="container-inner">
			<div class="row">
					<?php 
						include 'sidebar-vendor-page-emp.php';//to get the sidebar
					?>
				
				<div class="col-9">
				<div id="single-page-layout">
				<!-- menu for all the pages -->
				
					<div id="myaccountdetails">
						<div class="single-page-title">
						<!-- <h1>Welcome <?php //print $_SESSION['display_name']; ?></h1> -->
						<h1><?php print $_SESSION['display_name'];//display the employee's diplay name ?>'s Account Details: Change Name</h1>
						</div>
						
					</div>
					
					<!-- menu for all the pages -->
					<div class="myaccount-tabs">
						<ul id="myaccount-tabs-menu" class="myaccount-tabs-menu emp-account-tabs">
							<li>
								<a class="current-tab" href="http://www.dailyretailcouponz.com/cname.php">Change Name</a>
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
					
					<div class="extra-spacing">
						<p class="form_success_info"><?php  echo  $info_success; // to diplay the message that assigned to info_success?></p>
						<p class="form_error_info"><?php  echo  $info_empty; // to diplay the message that assigned to info_empty?></p>
						<div id="change-name">	
							
							<form action="cname.php" method="post">
								<p><span class="customformtitle">Current Display Name is: </span><b style="font-size:18px;"><?php print $_SESSION['display_name']; // to diplay the the current new display name ?></b><br /></p>
								<p><span class="customformtitle">Enter a new display name: </span><input type="text" name="new_name" size="30" required/><br /></p>
								<p><input type="submit" value="change" /></p>
							</form>
						
						</div>
					</div>
					</div>
				</div>	
				</div>
			</div>




</div> <!-- end of wrapper -->

<?php
include 'footer.php';//to get the footer
?>

</div> <!-- end of container-outer -->
</body>
</html>


<?php }
	else {
?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title>Change Name | DailyRetailCouponz</title>

</head>
<body>

<div class="container-outer">
<?php
include 'header.php';// to get the header
?>
	<div id="wrapper"> <!-- start of full-container -->
		<div class="container-inner">
			<div class="row">
					<?php 
						//include 'sidebar-vendor-page.php';//to get the sidebar
					?>
				
				<div class="col-12">
				<div id="single-page-layout">
				<!-- menu for all the pages -->
				
					<div id="myaccountdetails">
						<div class="single-page-title">
						<!-- <h1>Welcome <?php //print $_SESSION['display_name']; ?></h1> -->
						<h1>My Account Details: Change Name</h1>
						</div>
						
					</div>
					
					<div class="myaccount-tabs">
						<ul id="myaccount-tabs-menu" class="myaccount-tabs-menu">
							<li>
								<a class="current-tab" href="http://www.dailyretailcouponz.com/cname.php">Change Name</a>
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
					
					<p class="form_success_info"><?php  echo  $info_success; // to diplay the message that assigned to info_success?></p>
					<p class="form_error_info"><?php  echo  $info_empty; // to diplay the message that assigned to info_empty?></p>
				<div id="change-name">	
						
					<form action="cname.php" method="post">
						<p><span class="customformtitle">Current Display Name is: </span><b style="font-size:18px;"><?php print $_SESSION['display_name']; // to diplay the the current new display name ?></b><br /></p>
						<p><span class="customformtitle">Enter a new display name: </span><input type="text" name="new_name" size="30" required/><br /></p>
						<p><input type="submit" value="change" /></p>
					</form>
					
					
				</div>
				</div>
			</div>	
			</div>
		</div>




</div> <!-- end of wrapper -->

<?php
include 'footer.php';//to get the footer
?>

</div> <!-- end of container-outer -->
</body>
</html>
<?php } //end of else where only users would be able to view
?>