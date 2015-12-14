<?php
session_start();	//Start a new session 
require_once("db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name);
mysql_select_db($db_name);

?>
<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<title>DailyRetailCouponz.com</title>


</head>
<script>
	//this method is called when the user clicks on the code button.
     function openCodePopUp(code,url) {
		//checks if the url is present.if its present a new tab is opened in the window with the url
		//also the focus is passed to the new tab from the current window.
		if(url!=''){
		 var win = window.open(url,'_blank');
			win.focus();
		}
	   //displays the pop up by setting the display property of css to block
       var e = document.getElementById(code);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else{
          e.style.display = 'block';
		}
    }

</script>
<body>
<style>
  .popup-position{display:none;position:fixed;top :0;left:0; background-color:rgba(0,0,0,0.7); width:100%;height:100%; z-index:99999;}
  #popup-wrapper{width:900px;margin:70px auto;text-align:center;}
  #popup-container{background-color:#FFF; padding:20px;border-radius:20px;}
  </style>
<div class="container-outer">

	<?php 
		include 'header-front.php'
	?>



<div id="wrapper"> <!-- start of full-container -->
	<!-- only for inner pages
	<section id="titlebar"> <!-- title goes here
		<div class="container">
		</div>
	</section> -->
	
	<!-- displays about us section -->
	 <div id="about-us-container" class="about-us-container">
		<div class="container-inner"> 
		<h2 class="homepage-aboutus">About Us</h2>
		<p style="font-size:16px;">
		As the world is getting closer and closer, the need to travel from one location to other has increased tremendously. With this need, the demand for airlines and reduced airline fares is a necessity. Daily Retail Couponz is a platform which offers discounts and deals for the airline, train and bus tickets.</p>

		<p style="font-size:16px;">
		Daily Retail Couponz provides all the customers and users with various types of bus, train and air coupons for international as well as domestic airlines. Daily Retail Couponz is affiliated with various airlines which in turn provide coupons for their airlines. <a style="color:#fff;" href="http://www.dailyretailcouponz.com/about-us.php">Read More</a>
		</p>
		
		</div>
	</div>

	<!-- displays all featured deals on homepage -->
	<div id="featured-deals-container" class="featured-deals-container">
		<div class="container-inner"> 
			
				<!-- CATEGORY 2 -->
				
				<div class="row">
					<div class="col-12">
						
						<div class="tabs">
						<h2>Airways</h2>
						   <!-- Radio button and lable for #tab-content1 -->
						   <input type="radio" name="tabs" id="tab1" checked >
						   <label for="tab1">
							   <span>Top Trending Deals</span>
						   </label>
						 
						   <!-- Radio button and lable for #tab-content2 -->
						   <input type="radio" name="tabs" id="tab2">
						   <label for="tab2">
							   <span>Featured Stores</span>
						   </label>

							<div id="tab-content1" class="tab-content">

								<div class="container-inner"> 
			
									<div class="row">
										
										<div class="container-inner">
											<h2 style="text-align:center;">Check out our Featured Deals</h2>
											<?php 	
											$select_vendor_id = mysql_query("SELECT * FROM vendor where vendor_type='Airways' LIMIT 3");
												while($row = mysql_fetch_assoc($select_vendor_id)){
													$vendor_id = $row['vendor_id'];
													$vendor_logo =$row['vendor_logo'];
													$coupon =mysql_query("SELECT * FROM coupon WHERE vendor_id='$vendor_id'");
													$coupon_row = mysql_fetch_assoc($coupon);
													$coupon_title = $coupon_row['coupon_title'];
													$coupon_code = $coupon_row['coupon_code'];
												 ?>
											 <div id="<?php echo $coupon_code; ?>" class="popup-position">
													<div id="popup-wrapper">
														<div id="popup-container">
															<p style="text-align:right"><a href="javascript:void(0)" onclick="openCodePopUp('<?php echo $coupon_code; ?>','');">X</a></p>
															<h3>Code for <strong><?php echo $coupon_title; ?></strong></h3>
															<h3>Just Copy the code and use it</h3>
															<p class="showcouponbtn"><?php echo $coupon_code; ?></p>
															<p>Details: <?php echo $coupon_row['coupon_description']; ?></p>
															<h3><a href="<?php echo $coupon_row['coupon_link']; ?>" target="_blank">Go to Store</a></h3>
														</div>
													</div>
												</div>
											
											<div class="col-4">
												<div class="fdeal">
													<img src="<?php echo $vendor_logo; ?>" height="190px" width="323px">
														<div class="fdealtext">
														<p><span class="dealtitle"><?php echo $coupon_title; ?></span></p>
														<button class="showcouponbtn" type="submit" name="countButton" onclick="openCodePopUp('<?php echo $coupon_code; ?>','<?php echo $coupon_row['coupon_link']; ?>');"><span class="promocode">Promo Code: </span><span class="couponcode"><?php echo $coupon_code; ?></button></span>

														</div>	
											
												</div>
											  
											</div>
											<?php } //while ?>
								
										</div>
											
									</div>
									
								</div>

							</div> <!-- #tab-content1 -->
						   
						    <div id="tab-content2" class="tab-content">
								<div class="container-inner"> 
			
									<div class="row">
										
										<div class="container-inner">
											<h2 style="text-align:center;">Most Popular Stores</h2>
											
											<?php 	$find_coupons = mysql_query("SELECT * FROM vendor where vendor_type='Airways' LIMIT 3");
													while($row = mysql_fetch_assoc($find_coupons)){
													$vendor_logo = $row['vendor_logo'];
													$vendor_name = $row['vendor_name'];
												 ?>
											
												<div class="col-4">
												<div class="fstore">
											
													<a href="../stores/vendor.php?id=<?php echo $row['vendor_id']; ?>"><img class="display-stores-logo" src="<?php echo $vendor_logo; ?>" type="submit" height="165px" width="270px">
												</a>
													<div class="fstorename">
													<p><a href="../stores/vendor.php?id=<?php echo $row['vendor_id']; ?>"><?php echo $vendor_name; ?></a></p>
											
											</div>												
												</div>
											  
											</div>
											<?php } //while ?>
										
										</div>
											
									</div>
									
								</div>
							</div> <!-- #tab-content2 -->
								   
						</div>
						
					</div>
				</div>
				
				
				
				
				<!-- CATEGORY 2 -->
				
				<div class="row">
					<div class="col-12">
						
						<div class="tabsecond">
						<h2>Bus</h2>
						   <!-- Radio button and lable for #tab-content1 -->
						   <input type="radio" name="tabsecond" id="tabsecond1" checked >
						   <label for="tabsecond1">
							   <span>Top Trending Deals</span>
						   </label>
						 
						   <!-- Radio button and lable for #tab-content2 -->
						   <input type="radio" name="tabsecond" id="tabsecond2">
						   <label for="tabsecond2">
							   <span>Featured Stores</span>
						   </label>

							<div id="tabsecond-content1" class="tabsecond-content">

								<div class="container-inner"> 
			
									<div class="row">
										
										<div class="container-inner">
											<h2 style="text-align:center;">Check out our Featured Deals</h2>
											<?php 	
											$select_vendor_id = mysql_query("SELECT * FROM vendor where vendor_type='Bus' LIMIT 3");
												while($row = mysql_fetch_assoc($select_vendor_id)){
													$vendor_id = $row['vendor_id'];
													$vendor_logo =$row['vendor_logo'];
													$coupon =mysql_query("SELECT * FROM coupon WHERE vendor_id='$vendor_id'");
													$coupon_row = mysql_fetch_assoc($coupon);
													$coupon_title = $coupon_row['coupon_title'];
													$coupon_code = $coupon_row['coupon_code'];
												 ?>
											 <div id="<?php echo $coupon_code; ?>" class="popup-position">
													<div id="popup-wrapper">
														<div id="popup-container">
															<p style="text-align:right"><a href="javascript:void(0)" onclick="openCodePopUp('<?php echo $coupon_code; ?>','');">X</a></p>
															<h3>Code for <strong><?php echo $coupon_title; ?></strong></h3>
															<h3>Just Copy the code and use it</h3>
															<p class="showcouponbtn"><?php echo $coupon_code; ?></p>
															<p>Details: <?php echo $coupon_row['coupon_description']; ?></p>
															<h3><a href="<?php echo $coupon_row['coupon_link']; ?>" target="_blank">Go to Store</a></h3>
														</div>
													</div>
												</div>
											
											<div class="col-4">
												<div class="fdeal">
													<img src="<?php echo $vendor_logo; ?>" height="190px" width="323px">
														<div class="fdealtext">
														<p><span class="dealtitle"><?php echo $coupon_title; ?></span></p>
														<button class="showcouponbtn" type="submit" name="countButton" onclick="openCodePopUp('<?php echo $coupon_code; ?>','<?php echo $coupon_row['coupon_link']; ?>');"><span class="promocode">Promo Code: </span><span class="couponcode"><?php echo $coupon_code; ?></button></span>
											</div>												
												</div>
											  
											</div>
											<?php } //while ?>
								
										</div>
											
									</div>
									
								</div>

							</div> <!-- #tab-content1 -->
						   
						    <div id="tabsecond-content2" class="tabsecond-content">
								<div class="container-inner"> 
			
									<div class="row">
										
										<div class="container-inner">
											<h2 style="text-align:center;">Most Popular Stores</h2>
											
											<?php 	$find_coupons = mysql_query("SELECT * FROM vendor where vendor_type='Bus' LIMIT 3");
													while($row = mysql_fetch_assoc($find_coupons)){
													$vendor_logo = $row['vendor_logo'];
													$vendor_name = $row['vendor_name'];
												 ?>
											
												<div class="col-4">
												<div class="fstore">
												<a href="../stores/vendor.php?id=<?php echo $row['vendor_id']; ?>"><img class="display-stores-logo" src="<?php echo $vendor_logo; ?>" type="submit" height="165px" width="270px">
												</a>
												<div class="fstorename">
													<p><a href="../stores/vendor.php?id=<?php echo $row['vendor_id']; ?>"><?php echo $vendor_name; ?></a></p>
												</div>												
												</div>
											  
											</div>
											<?php } //while ?>
										
										</div>
											
									</div>
									
								</div>
							</div> <!-- #tab-content2 -->
							   
						</div>
						
					</div>
				</div>
			
			

			
			<!-- CATEGORY 3 -->
				
				<div class="row">
					<div class="col-12">
						
						<div class="tabthird">
						<h2>Trains</h2>
						   <!-- Radio button and lable for #tab-content1 -->
						   <input type="radio" name="tabthird" id="tabthird1" checked >
						   <label for="tabthird1">
							   <span>Top Trending Deals</span>
						   </label>
						 
						   <!-- Radio button and lable for #tab-content2 -->
						   <input type="radio" name="tabthird" id="tabthird2">
						   <label for="tabthird2">
							   <span>Featured Stores</span>
						   </label>
							<div id="tabthird-content1" class="tabthird-content">

								<div class="container-inner"> 
			
									<div class="row">
										
										<div class="container-inner">
											<h2 style="text-align:center;">Check out our Featured Deals</h2>
											<?php 	
											$select_vendor_id = mysql_query("SELECT * FROM vendor where vendor_type='Trains' LIMIT 3");
												while($row = mysql_fetch_assoc($select_vendor_id)){
													$vendor_id = $row['vendor_id'];
													$vendor_logo =$row['vendor_logo'];
													$coupon =mysql_query("SELECT * FROM coupon WHERE vendor_id='$vendor_id'");
													$coupon_row = mysql_fetch_assoc($coupon);
													$coupon_title = $coupon_row['coupon_title'];
													$coupon_code = $coupon_row['coupon_code'];
												 ?>
											 <div id="<?php echo $coupon_code; ?>" class="popup-position">
													<div id="popup-wrapper">
														<div id="popup-container">
															<p style="text-align:right"><a href="javascript:void(0)" onclick="openCodePopUp('<?php echo $coupon_code; ?>','');">X</a></p>
															<h3>Code for <strong><?php echo  $coupon_row['coupon_title']; ?></strong></h3>
															<h3>Just Copy the code and use it</h3>
															<p class="showcouponbtn"><?php echo $coupon_code; ?></p>
															<p>Details: <?php echo $coupon_row['coupon_description']; ?></p>
															<h3><a href="<?php echo $coupon_row['coupon_link']; ?>" target="_blank">Go to Store</a></h3>
														</div>
													</div>
												</div>
											
											<div class="col-4">
												<div class="fdeal">
													<img src="<?php echo $vendor_logo; ?>" height="190px" width="323px">
														<div class="fdealtext">
														<p><span class="dealtitle"><?php echo $coupon_title; ?></span></p>
														<button class="showcouponbtn" type="submit" name="countButton" onclick="openCodePopUp('<?php echo $coupon_code; ?>','<?php echo $coupon_row['coupon_link']; ?>');"><span class="promocode">Promo Code: </span><span class="couponcode"><?php echo $coupon_code; ?></button></span>
											</div>												
												</div>
											  
											</div>
											<?php } //while ?>
						
										</div>
											
									</div>
									
								</div>

							</div> <!-- #tab-content1 -->
						   
						    <div id="tabthird-content2" class="tabthird-content">
								<div class="container-inner"> 
			
									<div class="row">
										
										<div class="container-inner">
											<h2 style="text-align:center;">Most Popular Stores</h2>
											<?php 	$find_coupons = mysql_query("SELECT * FROM vendor where vendor_type='Trains' LIMIT 3");
													while($row = mysql_fetch_assoc($find_coupons)){
													$vendor_logo = $row['vendor_logo'];
													$vendor_name = $row['vendor_name'];
												 ?>
											
											<div class="col-4">
											<div class="fstore">
										
												<a href="../stores/vendor.php?id=<?php echo $row['vendor_id']; ?>"><img src="<?php echo $vendor_logo; ?>" type="submit" height="165px" width="270px">
												</a>													
												<div class="fstorename">
												<p><a href="../stores/vendor.php?id=<?php echo $row['vendor_id']; ?>"><?php echo $vendor_name; ?></a></p>
												</div>												
											</div>
											</div>
											<?php } //while ?>
											
										</div>
											
									</div>
									
								</div>
							</div> <!-- #tab-content2 -->
				
						</div>
						
					</div>
				</div>
			
		</div>
	</div>
	
		
	<!-- displays all featured testimonials on homepage -->
	<div id="featured-testimonials-container" class="featured-testimonials-container">
		<div class="container-inner"> 
			
			<div class="row">
				<div class="col-12">
					<h2 style="text-align:center;">Testimonials</h2>
					<div class="testimonial-text">
						<p>I have been couponing since last couple of months and have saved round about $100, just with using 3-4 coupons from DailyRetailCouponz.com! I had no clue that one could save money on airfare, clothing, food, restaurants I like. I would like to thank this site for making such a huge difference in my life and my credit card bills! People, if you are looking for some serious savings, DailyRetailCouponz is your best bet!</p>
						<p class="testimonial-author">- Barney</p>
						<p class="testimonial-read-more"><a href="testimonial.php">Read More</a></p>
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