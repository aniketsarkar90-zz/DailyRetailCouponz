<?php
session_start();	//Start a new session or resume a session
require_once("db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name);
mysql_select_db($db_name);
//checks if the update button is clicked

if (($_SESSION['username'] == 'khadyea') || ($_SESSION['username'] == 'alqahtanis4') || ($_SESSION['username'] == 'sarkara') || ($_SESSION['username'] == 'khopkarp'))
		{

if(isset($_SESSION['username']) && isset($_SESSION['password']))// to check if the employee logged in or not
{



if (isset($_POST['update'])){
	//updates the coupon table
	$UpdateQuery= mysql_query("UPDATE coupon SET coupon_title='$_POST[coupon_title]',coupon_description='$_POST[coupon_description]',coupon_code='$_POST[coupon_code]',coupon_expiry_date='$_POST[coupon_expiry_date]',coupon_link='$_POST[coupon_link]' where coupon_id = '$_POST[coupon_id]'");
	if($UpdateQuery){
		//if the update is succesfull, success message is displayed 
		echo '<script language="javascript">';
		echo 'alert("Coupon Updated Sucessfully")';
		echo '</script>';
	}else{
		//else error message is displayed
		echo '<script language="javascript">';
		echo 'alert("Please try updating the coupon again")';
		echo '</script>';
		}
}else if (isset($_POST['delete'])){
//checks if the Delete button is clicked
	$DeleteQuery= mysql_query("DELETE FROM coupon where coupon_id = '$_POST[coupon_id]'");
	if($DeleteQuery){
		//if the delete is succesfull, success message is displayed 
		echo '<script language="javascript">';
		echo 'alert("Coupon Deleted Sucessfully")';
		echo '</script>';
	}else{
		//else error message is displayed
		echo '<script language="javascript">';
		echo 'alert("Please try deleting the coupon again")';
		echo '</script>';
		}	
	
}

}
else
{

header("Location: login.php");//go to my-account.php page

}//end else if looking for the 4 employees
?>

<!DOCTYPE html>
<html>
<head>
<title>All Coupons | DailyRetailCouponz</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/mystyle.css">
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<script src="../js/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
</head>

<body>

<div class="container-outer">
<?php
include 'header.php';
?>
<div id="wrapper">
	<!-- displays all featured deals on homepage -->
	<div id="deals-container" class="deals-container">
		<div class="container-inner"> 
			
				<div class="row">
						<!-- call sidebar specific to single vendor page -->
						<?php 
						include 'sidebar-vendor-page-emp.php'
						?>
						
						<!-- main content page -->
				<div class="col-9">
						<div class="single-page-title">
							<h1><?php print $_SESSION['display_name']; ?>'s Account Details: Edit All Coupons</h1>
							
						<!-- menu for all the pages -->
					<div class="myaccount-tabs">
						<ul id="myaccount-tabs-menu" class="myaccount-tabs-menu emp-account-tabs">
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
								<a class="current-tab" href="http://www.dailyretailcouponz.com/all-coupons.php">Edit All Coupons</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/submitted-coupons.php">Submitted Coupons By Users</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/upload-coupons.php">Upload Coupons (Excel)</a>
							</li>
							
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/add-vendor.php">Add Vendors</a>
							</li>
							<li>
								<a class="" href="http://www.dailyretailcouponz.com/generate-report.php">Get Report</a>
							</li>
						</ul>
					</div>
					
							<div class="extra-spacing">
							
							<!-- we have to right a loop and fetch data from the database  -->
									<?php		// fetched al the coupons from the coupon table
												$all_coupons = mysql_query("SELECT * FROM coupon");
												while($row = mysql_fetch_assoc($all_coupons)){
													$vendor_id = $row['vendor_id'];
													//based on the vendor id from the coupon table, vendor data is fetched.
													$vendor =mysql_query("SELECT * FROM vendor WHERE vendor_id='$vendor_id'");
													$vendor_row = mysql_fetch_assoc($vendor);
													$vendor_logo = $vendor_row['vendor_logo'];
													$vendor_name = $vendor_row['vendor_name'];
												 ?>
										
											<form action="all-coupons.php" method="POST">

												<div class="single-deal">
													
													<!--Displays the vendor logo-->
													<img class="storelogo" src="<?php echo $vendor_logo; ?>" height="150px" width="240px">
													
													<div class="single-dealtext">		
													
														<!--Displays the coupon id-->
														<p>
															<span class="allcoupons-id">
																<strong>Id: </strong><input id="coupon_id" name="coupon_id" type="text" value="<?php echo $row['coupon_id']; ?>" readonly style="width:50%"/>
															</span>
														</p>
														
														<!--Displays the coupon title-->
														
														<p>
															<span class="allcoupons-title">
																<strong>Title: </strong><input id="coupon_title" name="coupon_title" type="text" value="<?php echo $row['coupon_title']; ?>" style="width:100%"/>
															</span>
														</p>	
														
														<!--Displays the coupon Description-->
														<p>
															<span class="allcoupons-dealdesc">
																<strong>Description: </strong><textarea rows="1" cols="72" name="coupon_description" id="coupon_description" type="text" ><?php echo $row['coupon_description']; ?></textarea></span>
														</p>
														
														<!--Displays the coupon code-->
														<p>
															<span class="allcoupons-showcouponbtn">
																<strong>Promo Code: </strong><input style="width:50%" id="coupon_code" name="coupon_code" type="text" value="<?php echo $row['coupon_code']; ?>"/>
															</span>
														</p>
														
														<!--Displays the coupon link-->
														<p>
															<span class="allcoupons-couponlink">
																<strong>Link: </strong><input style="width:50%" id="coupon_link" name="coupon_link" type="text" value="<?php echo $row['coupon_link']; ?>"/>
															</span>
														</p>
														
														
														<!--Displays the coupon expiry Date-->
														<p>
															<span class="allcoupons-expirydate">
																<strong>Expiration Date: </strong><input style="width:50%" id="coupon_expiry_date" name="coupon_expiry_date" type="text" value="<?php echo $row['coupon_expiry_date']; ?>"/>
															</span>
														</p>
														
														
														<!--On click of update or delete button,the action is called-->
														<input type="submit" name="update" value="Update" class="searchbutton">
														
														<!--Displays a confirmation box. If ok then deletes otherwise cancels the transaction-->
														<input type="submit" name="delete" value="Delete" class="searchbutton" onclick="return confirm('Are you sure you want to delete this coupon?')">
													</div>												
												</div>
													
													</form>
												
										<?php }
										
										 ?>
							</div> <!-- closing div for extra spacing -->
						
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
}//end if logged in or not

else
{ 
//header("Location: login.php");// go to login page
//if a user or guest tries to access this page , he will be displayed with the below content

include 'authorization-failed.php';
 }//end else if logged in or not ?>