<?php
session_start();//Start a new session or continuous the session
require_once("db_info.php");//include the file containing database credentials
mysql_connect($db_host,$db_username,$db_password) or die(mysql_error());


mysql_select_db('grabxgvz_dev2couponz') or die(mysql_query());
//Checks if the user is logined in


if (($_SESSION['username'] == 'khadyea') || ($_SESSION['username'] == 'alqahtanis4') || ($_SESSION['username'] == 'sarkara') || ($_SESSION['username'] == 'khopkarp'))
		{//looking for the 4 employees
	
if(isset($_SESSION['username']) && isset($_SESSION['password']))// to check if the user/employee logged in or not
{



	if (isset($_POST['vendor_name']) && isset($_POST['vendor_type']) && isset($_POST['vendor_logo']) )	//checks if all the fields are not empty
	{
	

	$vendor_name=stripslashes(trim($_POST['vendor_name']));//removes backslashes
	$vendor_type=stripslashes(trim($_POST['vendor_type']));//removes backslashes
	$vendor_logo=stripslashes(trim($_POST['vendor_logo']));//removes backslashes


	
	$add_vendor=mysql_query("INSERT INTO vendor(vendor_name,vendor_type,vendor_logo) VALUES('$vendor_name','$vendor_type','$vendor_logo')");//inserts into the vendor
		
	
	}	//end if fields are not empty	
else
		{
		
		$passfail = "This vendor already exist.";
		}//end else if fields are not empty	
								
}//end if fields are not empty	
else
{

header("Location: my-account.php");//go to my-account.php page
}//end else if looking for the 4 employees ?>

<!DOCTYPE html>
<html>
<head>
 <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title>Add A Vender | DailyRetailCouponz</title>

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
						include 'sidebar-vendor-page-emp.php';//to get the sidebar
					?>
				
				<div class="col-9">
				<div id="single-page-layout">
				<!-- menu for all the pages -->

					<div class="single-page-title">
						<!--Displays the name of the Logined User-->
						<h1><?php print $_SESSION['display_name']; ?>'s Account Details: Add A Vendor</h1>
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
								<a class="current-tab" href="http://www.dailyretailcouponz.com/add-vendor.php">Add Vendors</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/generate-report.php">Get Report</a>
							</li>
						</ul>
					</div>
					
					<div class="extra-spacing">
						<p class="form_error_info"><?php  echo  $fillall; ?></p>
						<div id="change-password">	
				
							<form action="add-vendor.php" method="post">									
							<p><span class="customformtitle">Vendor Name: </span><input type="text" name="vendor_name" required/><br /></p>						
							<p><span class="customformtitle">Vendor Type: </span><input type="text" name="vendor_type" size="11" required/><br/></p>						
							<p><span class="customformtitle">Vendor Logo's url: </span><input type="text" name="vendor_logo" size="11" required><br /></p>		
							<p><input type="submit" value="Submit" /></p>
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

<?php }//end if logged in or not

else
{
//if a user or guest tries to access this page , he will be displayed with the below content
include 'authorization-failed.php';
//header("Location: login.php");// go to login page
}//end else if logged in or not
?>