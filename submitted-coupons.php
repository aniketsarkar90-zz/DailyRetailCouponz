<?php
session_start();	//Start a new session or resume a session.session is started to retrieve data like the username to be displayed
require_once("db_info.php"); //include the file containing database credentials called 'db_info.php'
mysql_connect($db_host,$db_username,$db_password,$db_name); //to authenticate the database information from db_info.php
mysql_select_db($db_name);  //connecting to the database with the help of information fetched from db_info.php

if (($_SESSION['username'] == 'khadyea') || ($_SESSION['username'] == 'alqahtanis4') || ($_SESSION['username'] == 'sarkara') || ($_SESSION['username'] == 'khopkarp'))
		{
			
//if value submitted from the form is update then, the following if clause. this condition is occurs when customer submitted coupon is updated in the same table
if (isset($_POST['update'])) 
{	//mysql_query carries out the sql query and stores a true or false value accordingly
	$UpdateQuery= mysql_query("UPDATE submitted_coupons SET submitted_coupon_title='$_POST[coupon_title]',submitted_coupon_description='$_POST[coupon_description]',submitted_coupon_code='$_POST[coupon_code]',submitted_coupon_link='$_POST[coupon_link]',submitted_coupon_expiry_date='$_POST[coupon_expiry_date]',submitted_vendor_name='$_POST[vendor_name]',submitted_vendor_id='$_POST[vendor_id]' where submitted_coupon_id = '$_POST[coupon_id]'");
	if($UpdateQuery)
	{ // if variable UpdateQuery is set true, then user is notified 
		echo '<script language="javascript">';
		echo 'alert("Coupon Updated Sucessfully")';
		echo '</script>';
	}else{ //if variable UpdateQuery is set false, then user is notified 
		echo '<script language="javascript">';
		echo 'alert("Please try updating the coupon again")';
		echo '</script>';
		} 
		}
		//end of update button
//if value submitted from the form is insert then, the following if clause occurs when the user want to insert the submitted_coupons into the main coupon table
if (isset($_POST['insert'])){

	if(($_POST['sub_review'])=='1') //this if will take place only if the value of input is set to 1, then it will first update the sub_review in submitted_coupon table and then insert the same coupon in main coupons table
	{
				//the coupon from submitted_coupon table is now inserted in main coupons table
				$InsertQuery= mysql_query("INSERT INTO coupon (coupon_code, coupon_title, coupon_description, coupon_link, coupon_expiry_date, vendor_id) VALUES ('$_POST[coupon_code]','$_POST[coupon_title]','$_POST[coupon_description]','$_POST[coupon_link]','$_POST[coupon_expiry_date]','$_POST[vendor_id]')");
				
				// if variable InsertQuery is set true, then user is notified 
				if($InsertQuery){
					echo '<script language="javascript">';
					echo 'alert("Congratulations! Your Coupon Is Now Live. ")';
					echo '</script>';
					$reviewUpdate=mysql_query("UPDATE submitted_coupons SET submitted_coupon_title='$_POST[coupon_title]',submitted_coupon_description='$_POST[coupon_description]',submitted_coupon_code='$_POST[coupon_code]',submitted_coupon_link='$_POST[coupon_link]',submitted_coupon_expiry_date='$_POST[coupon_expiry_date]',submitted_vendor_name='$_POST[vendor_name]',submitted_vendor_id='$_POST[vendor_id]', submitted_reviewed='1' where submitted_coupon_id = '$_POST[coupon_id]'");
					
				}else{ //if variable InsertQuery is set false, then user is notified 
					echo '<script language="javascript">';
					echo 'alert("Please try updating the coupon again, check all the fields")';
					echo '</script>';
					} 
					
	}// if sub_review input is not marked
	else{echo '<script language="javascript">';
		echo 'alert("Coupon is not marked reviewed")';
		echo '</script>';
	}
	
	}	//end of insert
	
	//if value submitted from the form is delete then, the following if clause occurs when the user want to delete the submitted_coupons 
else if (isset($_POST['delete'])){

	//the coupon from submitted_coupon table is now deleted 
	$DeleteQuery= mysql_query("DELETE FROM submitted_coupons where submitted_coupon_id = '$_POST[coupon_id]'");
	if($DeleteQuery){
	// if variable DeleteQuery is set true, then user is notified 
		echo '<script language="javascript">';
		echo 'alert("Coupon Deleted Sucessfully")';
		echo '</script>';
	}else{
	//if variable DeleteQuery is set false, then user is notified 
		echo '<script language="javascript">';
		echo 'alert("Please try deleting the coupon again")';
		echo '</script>';
		}	
	
}

?>
<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../css/mystyle.css">
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<title>All Submitted Coupons | DailyRetailCouponz.com</title>
<script src="../js/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
</head>

<body>

<div class="container-outer">
<?php
//calling the header section from the header file
include 'header.php';
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
						include 'sidebar-vendor-page-emp-submit-a-coupon.php'
						?>
						
						<!-- main content page -->
						<div class="col-9">
							<div class="single-page-title">
							<h1><?php print $_SESSION['display_name']; ?>'s Account Details: All Submitted Coupons</h1>
							
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
								<a class="" href="http://www.dailyretailcouponz.com/all-coupons.php">Edit All Coupons</a>
							</li>
							<li>
								<a class="current-tab" href="http://www.dailyretailcouponz.com/submitted-coupons.php">Submitted Coupons By Users</a>
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
									<?php 
									//fetching all the coupons submitted by the various customers
												$all_coupons = mysql_query("SELECT * FROM submitted_coupons where submitted_reviewed='0'");
												
												//looping to display the details of the fetched coupons
												while($row = mysql_fetch_assoc($all_coupons)){
													$vendor_name = $row['submitted_vendor_name'];
													//obtaining the vendor details from vendor table by comparing the provided vendor name
													$vendor =mysql_query("SELECT * FROM vendor WHERE vendor_name='$vendor_name'");
													$vendor_row = mysql_fetch_assoc($vendor);
													$vendor_logo = $vendor_row['vendor_logo'];
													$vendor_name = $vendor_row['vendor_name'];
												 ?>
												 <form action="submitted-coupons.php" method="POST">

													<div class="single-deal">
													<!--Displays the vendor logo-->
													
													<img class="storelogo" src="<?php echo $vendor_logo; ?>" height="150px" width="240px">
													
													<div class="single-dealtext">	
													<!--Displays the coupon id-->
													<p>
														<span class="submittedcoupons-id">
															<strong>Id: </strong><input id="coupon_id" name="coupon_id" type="text" value="<?php echo $row['submitted_coupon_id']; ?>" readonly style="width:50%"/>
														</span>
													</p>
													
													<!--Displays the coupon title-->
													<p>
														<span class="submittedcoupons-title">
															<strong>Title: </strong><input id="coupon_title" name="coupon_title" type="text" value="<?php echo $row['submitted_coupon_title']; ?>" style="width:100%"/>
														</span>
													</p>
													
													<!--Displays the coupon description-->
													
													<p>
														<span class="submittedcoupons-dealdesc">
															<strong>Description: </strong><textarea rows="1" cols="72" name="coupon_description" id="coupon_description" type="text" ><?php echo $row['submitted_coupon_description']; ?></textarea>
														</span>
													</p>
													
													<!--Displays the coupon code-->
													<p>
														<span class="submittedcoupons-showcouponbtn">
															<strong>Promo Code: </strong><input id="coupon_code" name="coupon_code" type="text" value="<?php echo $row['submitted_coupon_code']; ?>" style="width:50%"/>
														</span>
													</p>
													
													<!--Displays the coupon link-->
													<p>
														<span class="submittedocoupons-couponlink">
															<strong>Link: </strong><input id="coupon_link" name="coupon_link" type="text" value="<?php echo $row['submitted_coupon_link']; ?>" style="width:50%"/>
														</span>
													</p>
													
													<!--Displays the vendor id-->
													<p>
														<span class="submittedcoupons-vendorid">
															<strong>Vendor ID: </strong><input id="vendor_id" name="vendor_id" type="text" value="<?php echo $row['submitted_vendor_id']; ?>" style="width:50%"/></span>
													</p>
													
													<!--Displays the vendor name-->
													<p>
														<span class="submittedcoupons-vendorname">
															<strong>Vendor: </strong><input id="vendor_name" name="vendor_name" type="text" value="<?php echo $row['submitted_vendor_name']; ?>" style="width:50%"/>
														</span>
													</p>
													
													<!--Displays the coupon expiry date -->
													<p>
														<span class="submittedcoupons-expirydate">
															<strong>Expiry: </strong><input id="coupon_expiry_date" name="coupon_expiry_date" type="text" value="<?php echo $row['submitted_coupon_expiry_date']; ?>" style="width:50%"/></span>
													</p>
															
													
												
													<p>
														<span class="submittedcoupons-review"><strong>If reviewed enter 1 else 0 : </strong><input id="sub_review" name="sub_review" type="text" value="<?php echo $row['submitted_reviewed']; ?>" style="width:50%"/></span>
													</p> 
														
													
													<input type="submit" name="update" value="Update" class="searchbutton">
													<input type="submit" name="insert" value="Insert" class="searchbutton">
													<input type="submit" name="delete" value="Delete" class="searchbutton" onclick="return confirm('Are you sure you want to delete this coupon?')">
													</div>												
													</div>
													</form>
										<?php }
										
										 ?>
							
							</div> <!-- end of <div class="extra-spacing"> -->
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
		<?php } //end if employee logged in  
		else {
				//if anyone other than employee tries to access this page he will be taken to this page
				include 'authorization-failed.php';
		} ?>