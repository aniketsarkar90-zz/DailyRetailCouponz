<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']))
{
require_once("db_info.php");
mysql_connect($db_host,$db_username,$db_password) or die(mysql_error());

mysql_select_db('grabxgvz_dev2couponz') or die(mysql_query());
$username = $_SESSION['username'];
	if (isset($_POST['message']))
	{
	$full_name_result=mysql_query("select full_name from login where username='$username'");
	$full_name_rows=mysql_fetch_array($full_name_result);
	$full_name=$full_name_rows['full_name'];
	$message=stripslashes(trim($_POST['message']));
	$add_message=mysql_query("INSERT INTO testimonial(full_name,message,username) VALUES('$full_name','$message','$username')");

		if ($add_message)
		{	
			$t_success = 'Your testimonial has been submitted successfully. Please find all the testimonials on our Testimonial Page.';
			$username = $_SESSION['username'];
			$result=mysql_query("select email from login where username='$username'");
			$rows = mysql_fetch_array($result);
			
			$to = $rows['email']; //fetching email
			
			$contacts = array (
				"ss201ss@gmail.com",
				$to,
			);
			
			//echo "You will receive a confirmation email on ".($to)."";
			$receive_confirmation = "You will receive a confirmation email on ".($to)."";
			//Details for sending E-mail
			$from = "Daily Retail Couponz";
			$url = "http://www.dailyretailcouponz.com/";
			$from = "info@dailyretailcouponz.com";
			$subject = "Submitted Testimonial";
			$body  =  "<h2>Thank you for writing a testimonial for Daily Retail Couponz.</h2>";
			$body .="<br/>";
			$body .= "<h4>Testimonial Message: </h4><br/>";
			$body .= $message;
			$body .="<br/><br/><br/><h4>Testimonial By:</h4><br/> ";
			$body .=$full_name;
			$headers = "From: $from\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			//sending email to the employee as well as to the user
			foreach($contacts as $contact) {
				$mail_to      =  $contact;
				$newsubject = $subject;
				$newmessage = $body;
				//$newheaders = "From: noreply@siftex.com";
				
				
				$sentmail = mail($mail_to, $newsubject, $newmessage, $headers);

			}
			
			//$sentmail = mail( $to, $subject, $body, $headers);
			
		}
		else
		{
		//print "Tesmonial not added.";
		$t_fail = 'Testimonial not added.';
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title>Write A Testimonials | DailyRetailCouponz</title>

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
						//include 'sidebar-vendor-page.php'
					?>
				
				<div class="col-12">
				<div id="single-page-layout">
				<!-- menu for all the pages -->
				
					<div id="myaccountdetails">
						<div class="single-page-title">
						<!-- <h1>Welcome <?php //print $_SESSION['display_name']; ?></h1> -->
						<h1>Write A Testimonial</h1>
						<p><span><?php print $_SESSION['display_name']; ?></span>, we really appreciate your efforts to write an testimonial for us. You can view all testimonials <a href="http://www.dailyretailcouponz.com/testimonial.php">here</a></p>
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
								<a class="current-tab" href="http://www.dailyretailcouponz.com/write-a-testimonial.php">Write A Testomonial</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/submit-a-coupon.php">Submit A Coupon</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/my-submitted-coupons.php">My Submitted Coupons</a>
							</li>
						
						</ul>
					</div>
						
						<!-- error/success message -->
						<p class="form_error_info"><?php  echo  $t_fail;// to diplay the message that to passfail ?></p>
						<p class="form_success_info"><?php  echo  $t_success; // to diplay the message that to passsuccess ?><br><br>
						<?php echo $receive_confirmation; ?>
						</p>
						
						<div id="write-a-testimonial">	
							
						<form action="write-a-testimonial.php" method="post">
						<p><span class="customformtitle">Testimonial: </span><textarea name="message" required type="text"/></textarea><br /></p>
						<p><input type="submit" value="Submit" /></p>
						</form>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>

</div> <!-- end of wrapper -->

<?php
include 'footer.php';
?>

</div> <!-- end of container-outer -->
</body>
</html>

<?php	
}
else
{
//Redirects the user to the login page if he is not logged in
//header("Location: login.php");
header("Location: login.php");
}
?>