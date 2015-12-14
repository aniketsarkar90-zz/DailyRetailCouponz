<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title>Authorization Failed | DailyRetailCouponz</title>

</head>
<body>

<div class="container-outer">
<?php
include 'header.php';// to get the header
?>
		<div id="wrapper"> <!-- start of full-container -->
			<div class="container-inner extraheight">
				<div class="row">
						<?php 
							include 'sidebar-vendor-page.php';//to get the sidebar
						?>
				
					<div class="col-9">
						<div id="single-page-layout">
						<!-- menu for all the pages -->
						
							<div id="myaccountdetails">
								<div class="single-page-title">
								<!-- <h1>Welcome <?php //print $_SESSION['display_name']; ?></h1> -->
								<h1>Authorization Failed</h1>
								
								<?php 
								if(isset($_SESSION['username']) && isset($_SESSION['password']))// to check if the user logged in or not
									{ ?>
								<h2><p><?php print $_SESSION['display_name'];//display the employee's diplay name ?>, you do not have access to this page. You need to be an employee to access this page.</p></h2>
									<?php }
									else{ ?>
								<h2><p>Hello Guest, you do now have access to this page. You need to be an employee to access this page.</p></h2>
								<h3><p>Please <a href="http://www.dailyretailcouponz.com/register.php">register</a> or <a href="http://www.dailyretailcouponz.com/login.php">login</a> to access.</p></h3>
									<?php } ?>
								
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