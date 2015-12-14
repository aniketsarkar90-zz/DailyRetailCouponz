<?php session_start();//Start a new session or resume a session.session is started to retrieve data like the username to be displayed
	if (($_SESSION['username'] == 'khadyea') || ($_SESSION['username'] == 'alqahtanis4') || ($_SESSION['username'] == 'sarkara') || ($_SESSION['username'] == 'khopkarp')) //usernames of all the employee names, if customer accesses this page it will redirect to login page
	{

if(isset($_SESSION['username']) && isset($_SESSION['password'])) //if the username and password inputs are set then the if clause will occur
{

include ("db_info.php"); 
require_once("db_info.php"); //include the file containing database credentials called 'db_info.php'

$conn = mysql_connect($db_host,$db_username,$db_password,$db_name);	//to authenticate the database information from db_info.php
mysql_select_db($db_name, $conn); //connecting to the database with the help of information fetched from db_info.php
	?>
			<!-- ALL THE OPTIONS FOR EMPLOYEES -->
			
<!DOCTYPE html>
<html>
<head>
 <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<title>Add Bulk Coupons | DailyRetailCouponz</title>
</head>
<body>
<div class="container-outer">
<?php
include 'header.php';
?>
	<div id="wrapper"> <!-- start of full-container -->
		<div class="container-inner">
			<div class="row">
				<?php 
					include 'sidebar-vendor-page-emp.php'
				?>
				
				<div class="col-9">
					<div id="single-page-layout">
						<div class="single-page-title">
						<!-- <h1>Welcome <?php //print $_SESSION['display_name']; ?></h1> -->
						<h1><?php print $_SESSION['display_name']; ?>'s Account Details: Upload Coupons (Excel)</h1>
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
								<a class="current-tab" href="http://www.dailyretailcouponz.com/upload-coupons.php">Upload Coupons (Excel)</a>
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
				<form class="form-horizontal well" action="import-coupons.php" method="post" name="upload_excel" enctype="multipart/form-data">
					
					<p><strong>Import CSV/Excel file</strong></p>
													
					<p><strong>CSV/Excel File:</strong></p>

					<p><input type="file" class="searchbutton browse-file" id="file" name="file" required></p>
					<p><button data-loading-text="Loading..." class="searchbutton" name="import" id="submit" type="submit">Upload</button></p>
			
					
				</form>
			</div>
			</div>
		</div>
	</div>
	</div>
	</div>
		<?php
include 'footer.php';
?>


<?php 
	}
	else {
			
			?>
			<script type="text/javascript">
						window.location.href = '/my-account.php';
			</script>
			<?php 
		}
}
else
{
//Redirects the user to the login page if the user is not an employee or is not logged in
//header("Location: login.php");
////if a user or guest tries to access this page , he will be displayed with the below content
include 'authorization-failed.php';
}
?>