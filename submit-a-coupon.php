<?php
session_start();
//Checks if the user is logined in
if(isset($_SESSION['username']) && isset($_SESSION['password']))
{
require_once("db_info.php");
mysql_connect($db_host,$db_username,$db_password) or die(mysql_error());
$user_sub=$_SESSION['username'];

mysql_select_db('grabxgvz_dev2couponz') or die(mysql_query());
	//checks if all the fields are not empty
	if (isset($_POST['store_name']) && isset($_POST['coupon_code']) && isset($_POST['coupon_title']) && isset($_POST['description']) && isset($_POST['coupon_link'])&& isset($_POST['expiry_date']))
	{
	//removes backslashes
	$store_name=stripslashes(trim($_POST['store_name']));
	$coupon_code=stripslashes(trim($_POST['coupon_code']));
	$coupon_title=stripslashes(trim($_POST['coupon_title']));
	$description=stripslashes(trim($_POST['description']));
	$coupon_link=stripslashes(trim($_POST['coupon_link']));
	$expiry_date=stripslashes(trim($_POST['expiry_date']));
	//$category_name=stripslashes(trim($_POST['categoryName']));
	//inserts data into the submitted_coupons
	$add_coupon=mysql_query("INSERT INTO submitted_coupons(submitted_coupon_title,submitted_coupon_description,submitted_coupon_code,submitted_coupon_link,submitted_coupon_expiry_date,submitted_vendor_name,username) VALUES('$coupon_title','$description','$coupon_code','$coupon_link','$expiry_date','$store_name','$user_sub')");
		
		if ($add_coupon)
		{	//if data is inserted. Success message is displayed. 
			$info_success = "Your Coupon is under Review. After the approval of the coupon it will be added to the website.";

			//The username is used to get the email id of the user to email the person about the details of the coupons submitted
			$username = $_SESSION['username'];
			$result=mysql_query("select email from login where username='$username'");
			$rows = mysql_fetch_array($result);
	
			$to = $rows['email']; //fetching email
			
			$contacts = array (
				"khopkarp@sacredheart.edu",
				$to,
			);
			
			$info_success_email =  "You will receive a confirmation email on ".($to)."";
			//Details for sending E-mail
			$from = "daily retail couponz";
			$url = "http://www.dailyretailcouponz.com/";
			$from = "info@dailyretailcouponz.com";
			$subject = "Coupon ".($coupon_code)." Submitted";
			$body = "<h2>Thank you for submitting the coupon. We will get back to you shortly</h2>";
			$body .= "<h4>The Coupon details are as following</h4>";
			$body .= "Store Name: ";
			$body .= $store_name;
			$body .= "<br>Coupon Code:";
			$body .= $coupon_code;
			$body .= "<br>Coupon Title: ";
			$body .= $coupon_title;
			$body .= "<br>Coupon Description: "; 
			$body .= $description;;
			$body .= "<br>Coupon Link: ";
			$body .= $coupon_link;
			$body .= "<br>Expiry Date: ";
			$body .= $expiry_date;
			//$body .= "<br>Category Name: ";
			//$body .= $category_name;
			$headers = "From: $from\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//mail is a function in php which directly send email from script
			//sending email to the employee as well as to the user
			foreach($contacts as $contact) {
				$mail_to      =  $contact;
				$newsubject = $subject;
				$newmessage = $body;
			
				
				$sentmail = mail($mail_to, $newsubject, $newmessage, $headers);
			}
		}
		else
		{
		// Displays a messsge if the message is already present in the system.
		$passfail = "This coupon already exist.";
		}
	}

?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<title>Submit A Coupon | DailyRetailCouponz</title>

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
				
					<div id="submit-a-coupon">
						<div class="single-page-title">
						<h1>Submit A Coupon</h1>
						<!--Displays the name of the Logined User-->
						<p><span><?php print $_SESSION['display_name']; ?></span>, we are glad that you decided to submit a coupon. Your efforts will help someone else to save on their purchases.</p>

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
								<a class="" href="http://www.dailyretailcouponz.com/write-a-testimonial.php">Write A Testomonial</a>
							</li>
							<li>
								<a class="current-tab" href="http://www.dailyretailcouponz.com/submit-a-coupon.php">Submit A Coupon</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/my-submitted-coupons.php">My Submitted Coupons</a>
							</li>
						
						</ul>
					</div>
					
					<p class="form_success_info"><?php  echo  $info_success; ?></p>
					<p class="form_success_info"><?php  echo  $info_success_email; ?></p>
						
						<div id="change-password">	
							<!--For the action the same form is used -->	
							<form action="submit-a-coupon.php" method="post">
								<!-- Displays the input field for user to enter various coupon data-->
								<!--Input data for Store Name-->
								<p><span class="customformtitle">Store Name: </span><input name="store_name" type="text" required /><br /></p>
								<!--Input data for Coupon Title-->
								<p><span class="customformtitle">Coupon Title: </span><input type="text" name="coupon_title" size="11" required /><br/></p>
								<!--Input data for Coupon Code-->
								<p><span class="customformtitle">Couple Code: </span><input type="text" name="coupon_code" size="11" required ><br /></p>
								<!--Input data for Coupon Description-->
								<p><span class="customformtitle">Coupon Description: </span><input type="text" name="description" size="11" required /><br /></p>
								<!--Input data for Coupon Link-->
								<p><span class="customformtitle">Coupon Link: </span><input type="text" name="coupon_link" size="30" required /><br /></p>
								<!--Input data for Coupon Expriy Date-->
								<p><span class="customformtitle">Coupon Expiry Date: </span><input type="date" name="expiry_date" size="11" required /><br /></p>
								<!--On clicking on submit button , the action is called and the input data is inserted into the table-->
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