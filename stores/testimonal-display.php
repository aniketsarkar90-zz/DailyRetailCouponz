<?php
session_start();//Start a new session or continuous the session
require_once("db_info.php");//include the file containing database credentials
mysql_connect($db_host,$db_username,$db_password) or die(mysql_error());

//Checks if the user is logined in
if(isset($_SESSION['username']) && isset($_SESSION['password']))// to check if the user/employee logged in or not
{if (isset($_GET['testimonial'])){


					//based on the vendor id, the vendor details are fetched
                 
                
               $all_coupons = mysql_query("SELECT * FROM testimonial where test_id='$test_id'");
                    while($row = mysql_fetch_assoc($all_coupons)){
					$full_name=$row['full_name'];	
					$message=$row['message'];
	      }
}

?>

<!DOCTYPE html>
<html>
<head>
 <link rel="stylesheet" type="text/css" href="../css/mystyle.css">
 
 <meta name="viewport" content="width=device-width, initial-scale=1">
<script src="../js/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
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

                        <p>Details: <?php echo $row['full_name']; ?></p>
						<p>Details: <?php echo $row['message']; ?></p>
                     
                                           
                        <input type="hidden" name="test_id" value="<?=$row['test_id'];?>">
                    
                        <p>
                          
                          <br />
                        </p>
                       
						</div> <!-- couponcomment -->
                      </form>
                      
                        </div>  <!-- single-deal-footer -->
                      </div> <!-- end of single-dealtext -->
                    </div>  <!-- end of single-deal -->
                
      <!-- end of wrapper -->
                 
                      
                   </div>   
                </div>
                  </div>
             
                  
      </div>   
                      
                      
        
        <?php
       }
        include 'footer.php';/*to gat the foolter page  */
        ?>
</div> <!-- end of container-outer -->
</body>
</html>
 