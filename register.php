<?php require_once("db_info.php");	//include the file containing database credentials
session_start();	//Start a new session or resume a session

if(isset($_SESSION['username']) && isset($_SESSION['password']))
{
//Checks whether user is already logged in if so redirects the user to myaccount.php
//header("Location: myaccount.php");

	if (($_SESSION['username'] == 'khadyea') || ($_SESSION['username'] == 'alqahtanis4') || ($_SESSION['username'] == 'sarkara') || ($_SESSION['username'] == 'khopkarp'))
		{
			//if a customer (not employee), redirect him back to myaccount.php page
			?>
				<script type="text/javascript">
							window.location.href = '/emp-account.php';
				</script>
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

if (isset($_POST['fname']) && isset($_POST['email']) && isset($_POST['uname']) && isset($_POST['pass1']) && isset($_POST['pass2']))
{
//Checks whether the form is submitted

$fname=stripslashes(trim($_POST['fname']));
$email=stripslashes(trim($_POST['email']));
$uname=stripslashes(trim($_POST['uname']));
$pass1=stripslashes(trim($_POST['pass1']));
$pass2=stripslashes(trim($_POST['pass2']));
	if(!empty($fname) && !empty($email) && !empty($uname) && !empty($pass1) && !empty($pass2))
	{
	//Checks if all the text boxes are filled
		if($pass1==$pass2)
		{
		//Adds the user into the database if both the passwords match
		mysql_connect($db_host,$db_username,$db_password,$db_name);
		//mysql_select_db("grabxgvz_www");
		mysql_select_db($db_name);
		$add_user = mysql_query("INSERT INTO login VALUES ('$fname','$uname','$pass1','$email')");
		echo $add_user;
		 //$add_user = mysql_query("INSERT INTO login '.
		    //  '(full_name,username, password) '.
			//  'VALUES ( '$fname', '$uname' , '$pass1')");


			if ($add_user)
			{
			//print "You've sucessfully registered on our website";
			$alert_success = "You've sucessfully registered on our website";
					?>
						<script type="text/javascript">
							window.alert("You've sucessfully registered on our website.");
							window.location.href = '/my-account.php';
						</script> 
					<?php
			}
			else
			{
			//If the INSERT query encounters an error it because the username already exists
			//print "Username already exists";
			$alert_username = "Username Already Exists";
					?>
					<!--	<script type="text/javascript">
							window.alert("Username already exists.");
						</script> -->
					<?php
			}
		}
		else
		{
		//Displays if passwords don't match
		//print "passwords do not match";
		$alert_pass = "Passwords Do Not Match";
				?>
					<!-- <script type="text/javascript">
						window.alert("passwords do not match");
						
					</script> -->
				<?php
		}
	}
	else
	{
	//This message is shown if anyone or all fields are left empty
	//print "Please Fill All the details";
	$alert_fill = "Please Fill All Details";
			?>
				<!--<script type="text/javascript">
					window.alert("Please Fill All the details");
				</script> -->
			<?php
	}
}
//else
//{
//Displays the HTML form if this page is viewed without POSTing anything
?>
<!-- start of html page -->
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/mystyle.css">

<title>Register | DailyRetailCouponz</title>

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
				
				
				<!-- main content page -->
				<div class="col-9">
				<div id="single-page-layout">
				<div id="register">
					<div class="single-page-title">
						<h1>Register</h1> 
					</div>
					
					<p class="form_error_info"><?php  echo  $alert_fill; ?></p>
					<p class="form_error_info"><?php  echo  $alert_username; ?><p>
					<p class="form_error_info"><?php  echo  $alert_pass; ?></p>
					
					<form action="register.php" method="post">
						<p><span class="customformtitle">Your Name: </span><input type="text" name="fname" size="30" required/><br /></p>
						<p><span class="customformtitle">Your Email: </span><input type="email" name="email" size="30" required /><br /></p>
						<p><span class="customformtitle">Username: </span><input type="text" name="uname" size="11" required /><br /></p>
						<p><span class="customformtitle">Password: </span><input type="password" name="pass1" size="30" required /><br /></p>
						<p><span class="customformtitle">Retype Password: </span><input type="password" name="pass2" size="30" required /><br /></p>
						<p><input type="submit" value="Register" /></p>
						
					</form>
				</div> <!-- end of div id register -->		
				</div>
		</div>
		</div>
			
	</div>

<?php
//}
?>
	</div> <!-- end of wrapper -->
	<?php
include 'footer.php';
?>
</div> <!-- end of container-outer -->
</body>
</html>