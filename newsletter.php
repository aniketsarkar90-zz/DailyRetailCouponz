<?php session_start(); //session is started to fetch the username variable
require_once("db_info.php");  //to authenticate the database information from db_info.php
mysql_connect($db_host,$db_username,$db_password) or die(mysql_error()); //connecting to the database with the help of information fetched from db_info.php
mysql_select_db('grabxgvz_dev2couponz') or die(mysql_query()); //from the above information, select the database mentioned

	if (isset($_POST['submit']))   //enter the if clause only if in the footer form the submit value is sent
	{
	$email_news=stripslashes(trim($_POST['news'])); //storing the email input in the email_news variable
	$add_email=mysql_query("INSERT INTO newsletter(email) VALUES('$email_news')"); //mysql_query will 
	
		if ($add_email)  //if the add_email has successfully inserted the values it will be set to true
		{	
			$to = $email_news; //fetching email input from 
			//Details for sending E-mail
			$from = "daily retail couponz";
			$url = "http://www.dailyretailcouponz.com/";
			$from = "info@dailyretailcouponz.com";
			$subject = "Subscribed to Daily Retail Couponz";
			$body  =  "Thank you for subscribing with us. You will now receive new discounts promo codes from Daily Retail Couponz every week. Stay Tuned!";
			$headers = "From: $from\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$sentmail = mail( $to, $subject, $body, $headers);
			$successful = "Thank you for subscribing to Daily Retail Couponz. An email has been sent to ". $to;
		}
		else
		{
		//print ".";
		$errorsubmitting = "Email Not Entered";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="/css/mystyle.css">

<title>Newsletter | DailyRetailCouponz</title>

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
						include 'sidebar-vendor-page.php';//gat the sidebar
					?>
				
				<div class="col-9">
					<div id="single-page-layout">
						<div class="single-page-title">
						<!-- <h1>Welcome <?php //print $_SESSION['display_name']; ?></h1> -->
							<h1>Subscribe to Our Newsletter</h1>
							<h3><p>Once subscribed, you will be notified when any new coupons/vendors are released in addition to our existing stores.</p></h3>
							
						</div>
					<p class="form_success_info"><?php echo $successful; //to display the success message?></p>
					<p class="form_error_info"><?php  echo  $errorsubmitting;// to diplay the error message ?></p>
					<div id="login">
					<!-- content for my account page -->
						<form action="" method="POST">
						<p><span class="customformtitle">Subscribe to Newsletter: </span><input type="email" name="news" required /><br /></p>
						<p><input type="submit" name='submit' value="Subscribe" /></p>
						
					</form>
					</div>
					
				</div>
			</div>
			</div>
		</div>
		
</div> <!-- end of wrapper -->

<?php
include 'footer.php';//get the footer
?>

</div> <!-- end of container-outer -->
</body>
</html>		