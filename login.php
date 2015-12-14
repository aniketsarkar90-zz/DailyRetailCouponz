<?php
require_once("db_info.php");	//include the file containing database credentials

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
?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/mystyle.css">

<title>Login | DailyRetailCouponz</title>

</head>
<body>

<div class="container-outer">
<?php
include 'header.php';
?>
<div id="wrapper"> <!-- start of full-container -->
<?php
	if (isset($_POST['uname']) && isset($_POST['pass']))
	{
//Checks if the submit button has been clicked

		if (!empty($_POST['uname']) && !empty($_POST['pass']))
		{
			$uname=stripslashes(trim($_POST['uname']));
			$pass=stripslashes(trim($_POST['pass']));
			mysql_connect($db_host,$db_username,$db_password,$db_name);
			//mysql_select_db("grabxgvz_www");
			mysql_select_db($db_name);
			$check=mysql_query("SELECT * FROM login WHERE username='$uname' AND password='$pass'");

			if(mysql_num_rows($check)!=0)
			{
				$details=mysql_fetch_array($check);

			//Creates session variables if the username and password match
			$_SESSION['display_name']=$details[0];
			$_SESSION['username']=$details[1];
			$_SESSION['password']=$details[2];
			
				//for all Employee's
				if (($details[1] == 'khadyea') || ($details[1] == 'alqahtanis4') || ($details[1] == 'sarkara') || ($details[1] == 'khopkarp'))
				{
					?>
					<script type="text/javascript">
						window.location.href = '/emp-account.php';
					</script>
					<?php 
				}
				//for all other customers redirects to myaccount.php
				else
				{
					?>
					<script type="text/javascript">
						window.location.href = '/my-account.php';
					</script>
					<?php 
				}
			}
			else
			{
			//Displays error if the credentials don't match
			//print "Invalid Username/Password";
			$alert_invalidusername = "Invalid Username/Password";
			?>
			<!--<script type="text/javascript">
				window.alert("Invalid Username/Password");
			</script> -->
			<?php
			}
		}
		else
		{
		//Displays this if the one or more text boxes are left empty
		//print "All fields must be filled";
		$alert_fillAll = "All fields must be filled";
		?>
			<!--<script type="text/javascript">
				window.alert("All fields must be filled");
			</script> -->
		<?php
		}
	}
	//else
	//{
		//Displays the HTML form if this page is viewed without POSTing anything
		?>

	<div class="container-inner"> 
			
		<div class="row">
					<?php 
						include 'sidebar-vendor-page.php'
					?>
				
				
				<!-- main content page -->
				<div class="col-9">
				<div id="single-page-layout">
					<div id="login">
						<div class="single-page-title">
						<h1>Log In</h1>
						</div>
						
						<p class="form_error_info"><?php  echo  $alert_fillAll; ?></p>
						<p class="form_error_info"><?php  echo  $alert_invalidusername; ?></p>
						
						
						<form action="login.php" method="post">
								<p><span class="customformtitle">Username: </span><input type="text" name="uname" size="11" required /><br /></p>
								<p><span class="customformtitle">Password: </span><input type="password" name="pass" size="30" required /><br /></p>
								<p><a href="http://www.dailyretailcouponz.com/forgot-password.php">Forgot Password?</a></p>
								<p><input type="submit" value="Login"></p>
						</form>
						<!-- <p><span class="btn-round">or</span></p> -->
					</div> <!-- end of div id login -->						
				</div>
				</div>
		</div>
			
	</div>
		<!-- login form -->
		
<?php // } ?>
</div> <!-- end of wrapper -->
<?php
include 'footer.php';
?>
</div> <!-- end of container-outer -->
</body>
</html>