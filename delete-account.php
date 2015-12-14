<?php require_once("db_info.php");	//include the file containing database credentials

session_start();	//Start a new session or resume a session

if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
{
//If user isn't logged in redirects to the login page

header("Location: login.php");
}
if(isset($_POST['confirm']))
{
//Checks if Yes or No has been clicked
if($_POST['confirm']=='Yes')
{
//Deletes rthe user if yes is clicked

mysql_connect($db_host,$db_username,$db_password,$db_name);
//mysql_select_db("grabxgvz_www");
mysql_select_db($db_name);
mysql_query("delete from login where username='".$_SESSION['username']."'");
print "Your account has been deleted";
session_destroy();
}
else
{
//Redirects the user to myaccount.php if no is clicked

header("Location: my-account.php");
exit();
}
}
else
{
//Displays the HTML form if this page is viewed without POSTing anything

?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title>Delete Account | DailyRetailCouponz</title>

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
						<h1>My Account Details: Delete Account</h1>
						
						</div>
						
					</div>
				<h3><p><?php print $_SESSION['display_name']; ?>, we are sorry to hear that you want to leave us. We would really appreciate if you could <a href="http://www.dailyretailcouponz.com/contact-us.php">let us know</a> the reason so that we could improve on our end.</p>
				<p>Are you sure you want to delete your account ?</p>
				</h3>
				
				<div class="delete-account" id="change-name">	
					<form method="post" action="delete-account.php">
						
						<input type="submit" value="Yes" name="confirm" />
						<input type="submit" value="No" name="confirm" />
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

<?php
}
?>