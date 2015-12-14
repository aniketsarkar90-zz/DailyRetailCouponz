<?php session_start();//Start a new session 
require_once("db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name);
mysql_select_db($db_name);
?>

<html>
<head>
 <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
  <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon" />
 <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="../js/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
<title>Testimonials | DailyRetailCouponz</title>
</head>
 <body>
    <div class="container-outer">
    
    <?php
        include 'header.php';/*to get the header page  */
    ?>
	<div id="wrapper"> <!-- start of full-container --> 
          
      <!-- displays all featured deals on homepage -->
      <div id="deals-container" class="deals-container">
        <div class="container-inner">
          <div class="row"> 
            <!-- call sidebar specific to single vendor page -->
            <?php 
                include 'sidebar-vendor-page.php';/*to get the sidebar page  */
            ?>
            <!-- main content page -->
            <div class="col-9">
              <div class="single-page-title">
				<h1>Testimonials</h1>
			  </div>
              <?php
               $all_testimonials = mysql_query("SELECT * FROM testimonial;");
                    while($row = mysql_fetch_assoc($all_testimonials)){
					$full_name=$row['full_name'];	
					$message=$row['message'];
					?>
					<div class="testimonial-holder"> 
							<!-- <p><span class="dealdesc"><?php //echo $message; ?></span></p> -->
							<img src="images/blockquote.png" style="height:40px; float:left; padding-right: 20px;">
							<blockquote>
								<p><span class="testimonial-message"><?php echo $message; ?></span></p>
							</blockquote>
							<div class="testimonial-author"><?php echo  '- ' . $full_name; ?></div>
					</div>
				<?php	
	      } //end of while
			
?>
          
		  </div>
		  </div>
		  </div>
      <?php
        include 'footer.php';/*to gat the footer page  */
        ?>

</div> <!-- end of container-outer -->
</body>
</html>