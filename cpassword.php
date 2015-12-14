<?php
require_once("db_info.php");	//include the file containing database credentials
session_start();	//Start a new session or continuous a session
if(!isset($_SESSION['username']) || !isset($_SESSION['password']))// to check if the user/employee logged in or not
{ //if not logged in then redirect to login page
header("Location: login.php");//go to login page
}//end if isset username and pass
if (isset($_POST['cur_pass']) && isset($_POST['pass1']) && isset($_POST['pass2']))//to Check if the submit button clicked or not and with inputs cur_pass,pass1,pass2
{
if (!empty($_POST['cur_pass']) && !empty($_POST['pass1']) && !empty($_POST['pass2']))//if all inputs are filled
{
$current_pass=stripslashes(trim($_POST['cur_pass']));//fetch the current password
$pass1=stripslashes(trim($_POST['pass1']));//the new password
$pass2=stripslashes(trim($_POST['pass2']));// retype the new password
	if($pass1==$pass2)//to check if the new passwords are match or not
	{
		if($current_pass==$_SESSION['password'])//Checks if the current password is correct or not
			{
				mysql_connect($db_host,$db_username,$db_password,$db_name); //to authenticate the database information from db_info.php
				mysql_select_db($db_name); //connecting to the database with the help of information fetched from db_info.php
				mysql_query("UPDATE login SET password='$pass1' WHERE username='".$_SESSION['username']."'");//to update the password to the new one by using the username as reference
				$_SESSION['password']=$pass1; //assign the session password value by the new set value
				
				$passsuccess = "Password successfully changed";//display the message and assign it to passsuccess
			}//end if current pass
		else
			{
				$passfail = "The current password is incorrect";//display the message and assign it to passfail
			}//end else if current pass
	}//end if pass1, pass2
	else
	{
		//print "Both the passwords do not match";
		$passnotmatch = "Both the passwords do not match";//display the message and assign it to passnotmatch
	}//end else if pass1, pass2
}//end if empty
else
{

	$fillall = "Please fill all the fields";//display the message and assign it to fillall
}//end else if empty
}//end if isset post current pas

//checking if employee
if (($_SESSION['username'] == 'khadyea') || ($_SESSION['username'] == 'alqahtanis4') || ($_SESSION['username'] == 'sarkara') || ($_SESSION['username'] == 'khopkarp'))
	{ //look for these 4 users //if any emplooyee signs in - he should see the following layout ?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title>Change Password | DailyRetailCouponz</title>

</head>
<body>

<div class="container-outer">
<?php
include 'header.php';//to get the header
?>
	<div id="wrapper"> <!-- start of full-container -->
		<div class="container-inner">
			<div class="row">
					<?php 
						include 'sidebar-vendor-page-emp.php'; //to get the sidebar
					?>
				
				<div class="col-9">
				<div id="single-page-layout">
				<!-- menu for all the pages -->
				
					<div id="myaccountdetails">
						<div class="single-page-title">
						<!-- <h1>Welcome <?php //print $_SESSION['display_name']; ?></h1> -->
						<h1><?php print $_SESSION['display_name'];//display the employee's diplay name ?>'s Account Details: Change Password</h1>
						</div>
						
					</div>
					
					<!-- menu for all the pages -->
					<div class="myaccount-tabs">
						<ul id="myaccount-tabs-menu" class="myaccount-tabs-menu emp-account-tabs">
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/cname.php">Change Name</a>
							</li>
							<li>
								<a class="current-tab" href="http://www.dailyretailcouponz.com/cpassword.php">Change Password</a>
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
					<p class="form_success_info"><?php  echo  $passsuccess; // to diplay the message that to passsuccess ?></p>
					<p class="form_error_info"><?php  echo  $passfail;// to diplay the message that to passfail ?></p>
					<p class="form_error_info"><?php  echo  $passnotmatch;  // to diplay the message that to passnotmatch ?></p>
					<p class="form_error_info"><?php  echo  $fillall; // to diplay the message that to fillall ?></p>
				<div id="change-password">	
					
					<form action="cpassword.php" method="post">
						<p><span class="customformtitle">Current Password: </span><input type="password" name="cur_pass" size="30" required/><br /></p>
						<p><span class="customformtitle">New Password: </span><input type="password" name="pass1" size="30" required /><br /></p>
						<p><span class="customformtitle">Retype New Password: </span><input type="password" name="pass2" size="30" required /><br /></p>
						<p><input type="submit" value="Change Password" /></p>
					</form>
					</div>
					
				</div>
				</div>
				</div>
			</div>
		</div>

</div> <!-- end of wrapper -->

<?php
include 'footer.php'; // to get the footer
?>

</div> <!-- end of container-outer -->
</body>
</html>

<?php
	}
	else {
?>		


<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title>Change Password | DailyRetailCouponz</title>

</head>
<body>

<div class="container-outer">
<?php
include 'header.php';//to get the header
?>
	<div id="wrapper"> <!-- start of full-container -->
		<div class="container-inner">
			<div class="row">
					<?php 
						//include 'sidebar-vendor-page.php'; //to get the sidebar
					?>
				
				<div class="col-12">
				<div id="single-page-layout">
				<!-- menu for all the pages -->
				
					<div id="myaccountdetails">
						<div class="single-page-title">
						<!-- <h1>Welcome <?php //print $_SESSION['display_name']; ?></h1> -->
						<h1>My Account Details: Change Password</h1>
						</div>
						
					</div>
					
					<div class="myaccount-tabs">
						<ul id="myaccount-tabs-menu" class="myaccount-tabs-menu">
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/cname.php">Change Name</a>
							</li>
							<li>
								<a class="current-tab" href="http://www.dailyretailcouponz.com/cpassword.php">Change Password</a>
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
					
					<p class="form_success_info"><?php  echo  $passsuccess; // to diplay the message that to passsuccess ?></p>
					<p class="form_error_info"><?php  echo  $passfail;// to diplay the message that to passfail ?></p>
					<p class="form_error_info"><?php  echo  $passnotmatch;  // to diplay the message that to passnotmatch ?></p>
					<p class="form_error_info"><?php  echo  $fillall; // to diplay the message that to fillall ?></p>
				<div id="change-password">	
					
					<form action="cpassword.php" method="post">
						<p><span class="customformtitle">Current Password: </span><input type="password" name="cur_pass" size="30" required /><br /></p>
						<p><span class="customformtitle">New Password: </span><input type="password" name="pass1" size="30" required /><br /></p>
						<p><span class="customformtitle">Retype New Password: </span><input type="password" name="pass2" size="30" required /><br /></p>
						<p><input type="submit" value="Change Password" /></p>
					</form>
					
					
				</div>
				</div>
				</div>
			</div>
		</div>

</div> <!-- end of wrapper -->

<?php
include 'footer.php'; // to get the footer
?>

</div> <!-- end of container-outer -->
</body>
</html>
<?php } //end if
?>