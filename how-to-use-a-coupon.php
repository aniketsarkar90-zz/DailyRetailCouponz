<?php
session_start();/* starting a new session */
?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<title> How To Use A Coupon | DailyRetailCouponz</title>
</head>
<body>
<div class="container-outer">
<?php
include 'header.php';/* get the header */
?>
	<div id="wrapper"> <!-- start of full-container -->
		<div class="container-inner">
			<div class="row">
					<?php 
					
						include 'sidebar-vendor-page.php';/* get the sidebar */
					?>
				
<div class="col-9">
				<div id="single-page-layout">
				<!-- menu for all the pages -->
				
				<div id="myaccountdetails">
					<div class="single-page-title">
						<h1 align="center"> How To Use Our Coupons </h1>
					</div>
				</div>
					
					<!--<div class="myaccount-tabs">
						<ul id="myaccount-tabs-menu" class="myaccount-tabs-menu">  -->
    
                    

                <div class="single-deal">  
				 <h3><p>Determine the coupon which you want to use</p></h3>	
						<img src="/images/guide/first.png" alt="1" width="300" height="300" align="top" />
				
						<img class="desktop-only" src="/images/guide/fr1.png" alt="1" width="700" height="500" align="middle" />
				</div>
                
				
				
				<div class="single-deal"> 
				
						 <h3><p>After determine the coupon that you want to use, click on the promo code as it is shown in the picture below</p></h3>	
				
                 
						<img src="/images/guide/second.png" alt="2" width="300" height="300" align="top"/>
				 
						<img class="desktop-only" src="/images/guide/sn2.png" alt="2" width="700" height="500" align="middle" />
				</div>
					
					
				<div class="single-deal"> 
					   <h3><p>Copy the code that pop-up on the screen as it is shown below.</p></h3>	
					   
						<img src="/images/guide/third.png" alt="3" width="300" height="300" align="top" />
				
						<img class="desktop-only" src="/images/guide/th3.png" alt="3" width="700" height="500" align="middle" />
					</div>
					 
					 
                <div class="single-deal">   
						<h3><p>Click on the "go to store" to take you to the vendor website. </p></h3>
                
						<img src="/images/guide/fourth.png" alt="4" width="300" height="300" align="top" /> 
				 
						<img class="desktop-only" src="/images/guide/fo4.png" alt="4" width="700" height="500" align="middle" /> 
					</div>
                   
                    
				<h3><p>Paste the copied  coupon on the textbox as it is shown above. Some other websits do not show you the promo textbox until you get to the payment step.</p></h3>	
                  
  </div>
                     
         
</div><!-- end of wrapper -->
</div><!-- end of single page -->
</div><!-- end of col 9 -->
</div><!-- end of row-->
<?php
include 'footer.php';/* get the footer */
?>
</div><!-- end of container-inner-->

</div><!-- wrapper -->


</div> <!-- end of container-outer -->
</body>
</html>