<?php 
require_once("db_info.php");	//include the file containing database credentials
session_start();  //session is started to retrieve data like the username to be displayed
if (isset($_POST['username']) && empty($_POST['pass'])){ //condition if username is given but the password is field is empty
	$username = $_POST['username']; //the value from username field is assigned to variable username
	
	mysql_connect($db_host,$db_username,$db_password,$db_name); //to authenticate the database information from db_info.php
	mysql_select_db($db_name); //connecting to the database with the help of information fetched from db_info.php

	$query="select * from login where username='$username'"; //fetching the record where username is same as given variable username
	$result = mysql_query($query);  //mysql_query sends a unique query and returns true if a recordset is found
	$count=mysql_num_rows($result);  //mysql_rows retieves the number of rows from the resultset

	if($count==1)  	// If the count is equal to one, we will send message other wise display an error message.
	{	
		$rows = mysql_fetch_array($result); //fetches the array from the resultset
		$pass  =  $rows['password']; //fetching the password from the array and storing it in variable $pass
		$to = $rows['email']; //fetching email from recordset
		echo "your email is ::".($to)." ";   //Details for sending E-mail
		//$from = "daily retail couponz";  //the mail sent will have information of 'from' as given here
		$url = "http://www.dailyretailcouponz.com/login.php"; //the message body will have this url 
		$from = "info@dailyretailcouponz.com";  //the mail sent will have information of 'from' as given here
		$subject = "DailyRetailCouponz Password recovered"; //subject for the mail to be sent
		$body  =  " Password Recovery Email  <br>
		-----------------------------------------------
		<br>Url : $url;<br>
		email Details is : $to;<br>
		Here is your password  : $pass;
		<br/><br>
		Sincerely,<br>
		<i>Daily Retail Couponz</i>"; // body of the mail will have the above content
		
		$headers = "From: $from\n";   // email header showing the from email part
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";  //declaring that the content in the body of the mail will be html or text	
		$sentmail = mail( $to, $subject, $body, $headers); //passing the mail function having parameters recepient, subject of the mail, body message content in the mail and the header
	}// end of if condition 
	else //else condition if even the email is not provided on the form
	{
		if ($_POST ['email'] != "") 
		{
			//echo "<span style='color: #ff0000;'> Not found your email in our database</span>";
			$notfoundemail = "Not found your email in our database";  //
		}
		else 
		{
			// put email as required
		}
	}
	
		//If the mail is sent successfully, notify the user that the mail is sent
	if($sentmail==1) //
		{
			//echo "<span style='color: #ff0000;'> Your Password Has Been Sent To Your Email Address.</span>";
			$passwordsent ="Your Password Has Been Sent To Your Email Address.";
		}
	else
		{
		if($_POST['email']!="") //if email is not found in the database, 
			{
			//echo "<span style='color: #ff0000;'> Cannot send password to your e-mail address.Problem with sending mail...</span>";
			$cannotsendpass = "Cannot send password to your e-mail address.Problem with sending mail...";
			} 
			else {
	//echo "no username received";
	$nousername = "No Such Username."; 
			}
		}
}	//end of main if
	 ?>
	
<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<title>Forgot Password | DailyRetailCouponz</title>

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
						include 'sidebar-vendor-page.php'
					?>
				
				<div class="col-9">
					<div id="single-page-layout">
					<!-- menu for all the pages -->
					
						<div id="myaccountdetails">
							<div class="single-page-title">
							<!-- <h1>Welcome <?php //print $_SESSION['display_name']; ?></h1> -->
							<h1>Forgot Password</h1>
							</div>
							
						</div>
						
						<p class="form_error_info"><?php  echo  $cannotsendpass; ?></p>
						<p class="form_error_info"><?php  echo  $nousername; ?></p>
						<p class="form_error_info"><?php  echo  $notfoundemail; ?></p>
						<p class="form_success_info"><?php  echo  $passwordsent; ?></p>
						
						
						<div id="forgot-password">	
							<form action="forgot-password.php" method="post">
								<p><span class="customformtitle">Enter your User ID : </span><input id="username" type="text" name="username" required/><br /></p>
								<p><input id="button" type="submit" name="button" value="Submit" /></p>
							</form>
						
						</div>
					</div>
				</div>
			</div>
		</div>

</div> <!-- end of wrapper -->

<?php //calling the footer file. Calling a single file for footer makes the code efficient
include 'footer.php';
?>

</div> <!-- end of container-outer -->
</body>
</html>