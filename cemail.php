<?php
require_once("db_info.php");	//include the file containing database credentials
session_start();	//Start a new session or continuous a session
mysql_connect($db_host,$db_username,$db_password,$db_name); //to authenticate the database information from db_info.php
mysql_select_db($db_name); //connecting to the database with the help of information fetched from db_info.php
$username=$_SESSION['username'];
$email_fetch = mysql_query("SELECT email FROM login where username='$username'");
                    while($row = mysql_fetch_assoc($email_fetch)){
					$email=$row['email'];
}					

if(!isset($_SESSION['username']) || !isset($_SESSION['password']))// to check if the user/employee logged in or not
{ //if not logged in then redirect to login page
header("Location: login.php");//go to login page
}//end if isset username and email



if (isset($_POST['cur_email']) && isset($_POST['email1']) && isset($_POST['email2']))//to Check if the submit button clicked or not and with inputs emails1,2,c
{
if (!empty($_POST['cur_email']) && !empty($_POST['email1']) && !empty($_POST['email2']))//if all inputs are filled
{
$current_email=stripslashes(trim($_POST['cur_email']));//fetch the current email
$email1=stripslashes(trim($_POST['email1']));//the new email
$email2=stripslashes(trim($_POST['email2']));// retype the new email
	if($email1==$email2)//to check if the new emails are match or not
	{
		if($current_email==$email)//Checks if the current email is correct or not
			{
				
				mysql_query("UPDATE login SET email='$email1' WHERE username='".$_SESSION['username']."'");//to update the email to the new one by using the username as reference
				$_SESSION['email']=$email1; //assign the session email value by the new set value
				
				$emailsuccess = "Email successfully changed";//display the message and assign it to emailsuccess
			}//end if current email
		else
			{
				$emailfail = "The current email is incorrect";//display the message and assign it to emailfail
			}//end else if current email
	}//end if emails1,2
	else
	{
		//print "Both the passwords do not match";
		$emailnotmatch = "Both the email do not match";//display the message and assign it to emailnotmatch
	}//end else if emails1,2
}//end if empty
else
{

	$fillall = "Please fill all the fields";//display the message and assign it to fillall
}//end else if empty
}//end if isset post current email

//checking if employee
if (($_SESSION['username'] == 'khadyea') || ($_SESSION['username'] == 'alqahtanis4') || ($_SESSION['username'] == 'sarkara') || ($_SESSION['username'] == 'khopkarp'))
	{ //look for these 4 users //if any emplooyee signs in - he should see the following layout ?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title>Change Email | DailyRetailCouponz</title>

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
						<h1><?php print $_SESSION['display_name'];//display the employee's diplay name ?>'s Account Details: Change Email</h1>
						</div>
					</div>
					
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
								<a class="current-tab" href="http://www.dailyretailcouponz.com/cemail.php">Change Email</a>
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
					<p class="form_success_info"><?php  echo  $emailsuccess; // to diplay the message that to emailsuccess ?></p>
					<p class="form_error_info"><?php  echo  $emailfail;// to diplay the message that to passfail ?></p>
					<p class="form_error_info"><?php  echo  $emailnotmatch;  // to diplay the message that to emailnotmatch ?></p>
					<p class="form_error_info"><?php  echo  $fillall; // to diplay the message that to fillall ?></p>
				<div id="change-password">	
					
					<form action="cemail.php" method="post">
					
						<p><span class="customformtitle">Current Email: </span><input type="text" name="cur_email" size="30" required /><br /></p>
						<p><span class="customformtitle">New Email: </span><input type="text" name="email1" size="30" required /><br /></p>
						<p><span class="customformtitle">Retype New Email: </span><input type="text" name="email2" size="30" required /><br /></p>
						<p><input type="submit" value="Change Email" /></p>
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


<?php	}
	else { 
	//user specific page
	?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title>Change Email | DailyRetailCouponz</title>

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
						<!-- <h1>Welcome <?php //print $_SESSION['display_name']; 
						?></h1> -->
						<h1>My Account Details: Change Email</h1>
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
								<a class="current-tab" href="http://www.dailyretailcouponz.com/cemail.php">Change Email</a>
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
					
					<p class="form_success_info"><?php  echo  $emailsuccess; // to diplay the message that to emailsuccess ?></p>
					<p class="form_error_info"><?php  echo  $emailfail;// to diplay the message that to passfail ?></p>
					<p class="form_error_info"><?php  echo  $emailnotmatch;  // to diplay the message that to emailnotmatch ?></p>
					<p class="form_error_info"><?php  echo  $fillall; // to diplay the message that to fillall ?></p>
				<div id="change-password">	
					
					<form action="cemail.php" method="post">
					
					
						<p><span class="customformtitle">Current Email: </span><input type="text" name="cur_email" size="30" required /><br /></p>
						<p><span class="customformtitle">New Email: </span><input type="text" name="email1" size="30" required /><br /></p>
						<p><span class="customformtitle">Retype New Email: </span><input type="text" name="email2" size="30" required /><br /></p>
						<p><input type="submit" value="Change Email" /></p>
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
<?php 	} // end if
?>
