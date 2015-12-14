<?php
session_start();/*to start a new session  */
?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
<style>
<!--to set the two dives next to each other and style them  -->
#wrap{
width: 100%;
height: 100%;
background-color: # FFF;

}
#div1{
width: 50%;
height: 100%;
background-color: # FFF;
float: left;

}
#dive2{
width:50%;
height: 100%;
background-color: # FFF;
float: right;

}
.single-deal .single-deal p .note {
	color: #000;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/mystyle.css">

<title> About Us | DailyRetailCouponz</title>

</head>
<body>

<div class="container-outer"><!--to set the two dives next to each other and style them  -->
<?php
include 'header.php';/*to call the header page  */
?>
<div id="wrapper"> <!-- start of full-container -->
<div class="container-inner">
<div class="row">
		<?php 
			include 'sidebar-vendor-page.php';/*to call the sidebar page  */
		?>
				
<div class="col-9">
				<div id="single-page-layout">
				<!-- menu for all the pages -->
				
					<div id="myaccountdetails">
						<div class="single-page-title">
						
						<h1 align="center">About Us </h1>
						</div>
						
					</div>
					
					<p class="form_success_info"></p>
                    
                    
                    
    <div class="single-deal">
    <span class="note">
	<p>As the world is getting closer and closer, the need to travel from one location to other has increased tremendously. With this need, the demand for airlines and reduced airline fares is a necessity. Daily Retail Couponz is a platform which offers discounts and deals for the airline, train and bus tickets.</p> 
	<p>Daily Retail Couponz provides all the customers and users with various types of bus, train and air coupons for international as well as domestic airlines. Daily Retail Couponz is affiliated with various airlines which in turn provide coupons for their airlines.</p>

	
	<p>We are a group of four students. Publishing this website for two reasons: </p>
     <p>First: as final project for our computer since master degree. </p>
     <p>Second: to provide all the customers and users with various types of transportation coupons for international as well as domestic transportation. DailyRetailCouponz intends to affiliate with various transportation companies which in turn provide coupons for their transportation companys.</p>
	
	
	 </span>
    </div>
        
        
        
    <div class="single-deal">
    <div id="wrap" class="row">
	
	
    <div id="div1" class="col-4">
		<img src="/images/social/image2.JPG" alt="Anik" width="100" height="100" align="top" />
		  <p>Name: Aniket Sarkar
		  <br>Email: sarkara@sacredheart.edu   
		<br>Education: Sacred Heart University </p>
    </div>
    <div id="div2" class="col-4">
		 <img src="/images/social/image1.JPG" alt="saeed" width="100" height="100" align="top" />
		<p>Name: Saeed Alqahtani	 
		<br>Email: alqahtanis4@sacredheart.edu
		<br>Education:	Sacred heart university</p>
    </div>

	</div> <!--End wrap-->
	</div> <!--End single deal-->

	
<div class="single-deal">
<div id="wrap" class="row">
    <div id="div1" class="col-4">
    <img src="/images/social/image4.JPG" alt="praj" width="100" height="100" align="top" />
    <p>Name: Prajacta Khopkar	
    <br>Email: khopkarp@sacredheart.edu 
	<br>Education: Sacred Heart University
    </p>
    </div>
	
    <div id="div2" class="col-4">
    <img src="/images/social/image3.JPG" alt="amr" width="100" height="100" align="top" />
    <p>Name: Amruta Khadye
    <br>Email: khadyea@sacredheart.edu 
    <br>Education: Sacred Heart University</p>
    </div>

</div><!--dev1-->
</div><!--End wrap div-->  
                     
         
  <p class="form_error_info">&nbsp;</p>
<!-- end of wrapper -->


</div>
</div><!-- single page -->
</div><!-- col 9 -->
</div><!-- row -->
</div> <!-- end of ffullcontainer-outer -->
</div><!-- wrapper -->
			<?php
			include 'footer.php';/*to call the footer page  */
			?>

</div> <!-- end of container-outer -->
</body>
</html>