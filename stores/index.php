<?php
session_start();	//Start a new session or resume a session
require_once("../db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name);
mysql_select_db($db_name);

?>
<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/mystyle.css">
<script src="../js/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<title>All Stores | DailyRetailCouponz</title>
</head>

<body>

<div class="container-outer">
<?php
include '../header.php';
?>
<div id="wrapper"> <!-- start of full-container -->
	<!-- only for inner pages
	<section id="titlebar"> <!-- title goes here
		<div class="container">
		</div>
	</section> -->

	<!-- displays all featured deals on homepage -->
	<div id="deals-container" class="deals-container">
		<div class="container-inner"> 
			
				<div class="row">
						<!-- call sidebar specific to single vendor page -->
						<?php 
						//include '../sidebar-vendor-page.php'
						?>
						
						<!-- main content page -->
						<div class="col-12">
							<div class="single-page-title">
							<h1 style="text-align:center;">All Stores</h1>
							</div>
							
							<div class="all-store-images">
							<!-- we have to right a loop and fetch data from the database  -->
									<?php
											$all_vendors = mysql_query("SELECT * FROM vendor");
											while($row = mysql_fetch_assoc($all_vendors)){
												$vendor_logo = $row['vendor_logo'];
												$vendor_id = $row['vendor_id'];

												 ?>
												<a href="vendor.php?id=<?php echo $vendor_id; ?>"><img class="display-stores-logo" src="<?php echo $vendor_logo; ?>" type="submit" height="150px" width="240px">
												</a>
										<?php } ?>
							</div>
						
						</div>

				
				</div>
			
		</div>
	</div>
	

</div> <!-- end of wrapper -->

<?php
include '../footer.php';
?>

</div> <!-- end of container-outer -->
</body>
</html>