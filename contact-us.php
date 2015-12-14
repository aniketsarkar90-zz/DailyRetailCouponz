<?php session_start(); //session is started to retrieve data like the username to be displayed
if (isset($_POST['submit'])) //with the help of POST, data is collected from the form when input with the name='submit' is passed
{		
$cust_email = $_POST['email']; //the email value is fetched from the form 
if($_POST['category'] == 'advertisement') // if the category value is submitted as advertisement then following steps will be taken
	   {		
	   		//an array of contacts to be emailed is created. When the email function is called, it will notify the customer that they 
	   		//have mailed and also notify an employee. for every category there is one dedicated employee who will receive the 
	   		//email. since there are two emails to be send the array is created
	   
			   $contacts = array (    
					"khopkarp@mail.sacredheart.edu",
					$cust_email,
				);
				
				$from = "daily retail couponz"; //the variable from is set for the email function
				$url = "http://www.dailyretailcouponz.com/"; // the url variable is set to be used later in the body
				$from = "info@dailyretailcouponz.com"; // from variable is used in the mail function to tell the recepient from whom the mail is received
				$headers = "From: $from\n"; //headers variable for the mail function is optional 
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; //declaring that the body content will contain html as well as text

				// the for each loop below is looping the array of contacts created above with different contacts emailed with same body

				foreach($contacts as $contact) {
					$mail_to      =  $contact;
					$subject = $subject;
					$body = " Category: Advertisement<br/>";
					$body .= $_POST['message'];
					$body .= "<br/><br/><br/>";
					$body .= "Sincerely,
						<i>daily retail couponz</i>";

					$mail_status = mail($mail_to, $subject, $body, $headers); 
					//mail function which takes parameters 'to' which the recepient, 'subject' parameter is subject for the email, 
					//'body' parameter is email content, 'header' parameter is optional 

					}
					$emailsentsuccess = "Your Email Has Been Sent Successfully. We Will Get Back To You Soon.";
	   } //end of if for advertisement category
       
	  if($_POST['category'] == 'Feedback')
	  {
	   $to = "sarkara@mail.sacredheart.edu";
		//"khopkarp@mail.sacredheart.edu";//fetching email
		//Details for sending E-mail
		$from = "daily retail couponz";
		$url = "http://www.dailyretailcouponz.com/";
		$from = "info@dailyretailcouponz.com";
		$subject = "messgae from customers";
		$body  =  " following is the message";
		$body .= $_POST['message'];
		

		$body .= "Sincerely,
		<i>daily retail couponz</i>";
		
		//$messageh = "From: $from\n";
		//$messageh .= "Content-type: text/html;charset=iso-8859-1\r\n";
		$headers = "From: $from\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		//$header .= "X-Priority: 1\r\n";
		//$header .= "X-MSMail-Priority: High\r\n";
		//$header .= "X-Mailer: Just My Server\r\n";
		$sentmail = mail( $to, $subject, $body, $headers);
	
		//echo "Your Email Has Been Sent Successfully. We Will Get Back To You Soon.";
		$emailsentsuccess = "Your Email Has Been Sent Successfully. We Will Get Back To You Soon.";
	   }
	   
	    if($_POST['category'] == 'coupons')
	  {
	   $to = "khadyea@sacredheart.edu";
		//"khopkarp@mail.sacredheart.edu";//fetching email
		//Details for sending E-mail
		$from = "daily retail couponz";
		$url = "http://www.dailyretailcouponz.com/";
		$from = "info@dailyretailcouponz.com";
		$subject = "messgae from customers";
		$body  =  " following is the message";
		$body .= $_POST['message'];
		

		$body .= "Sincerely,
		<i>daily retail couponz</i>";
		
		//$messageh = "From: $from\n";
		//$messageh .= "Content-type: text/html;charset=iso-8859-1\r\n";
		$headers = "From: $from\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		//$header .= "X-Priority: 1\r\n";
		//$header .= "X-MSMail-Priority: High\r\n";
		//$header .= "X-Mailer: Just My Server\r\n";
		$sentmail = mail( $to, $subject, $body, $headers);
	
		//echo "Your Email Has Been Sent Successfully. We Will Get Back To You Soon.";
		$emailsentsuccess = "Your Email Has Been Sent Successfully. We Will Get Back To You Soon.";
	   }
}	   
?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
 <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<title>Contact Us | DailyRetailCouponz</title>

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
					<div class="single-page-title">
						<h1>Contact Us</h1>
						</div>
					<p class="form_success_info"><?php  echo  $emailsentsuccess; ?></p>
					<div id="contactusform">
					
						<form action="contact-us.php" method="post">
						<p><span class="customformtitle">Full Name: </span><input type="text" name="fullname" required /><br /></p>
						<p><span class="customformtitle">Email: </span><input type="email" name="email" id="email" required /><br /></p>
						<p><span class="customformtitle">Category </span><br />
						<select class="contact-category" name="category" required><br />
								<option value="Feedback">Feedback</option>
								<option value="coupons">Coupons Related Queries</option>
								<option value="advertisement">Advertisement</option>
						 </select></p>
						<p><span class="customformtitle">Subject: </span><input type="text" name="subject" required /><br /></p>
						<p><span class="customformtitle">Message: </span><textarea rows="4" cols="50" name ="message" required></textarea><br /></p>
						<p><input id="button" type="submit" name="submit" value="submit" /></p>
					
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