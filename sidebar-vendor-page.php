<?php
session_start();	//Start a new session or resume a session
require_once("db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name);
mysql_select_db($db_name);
?>
<div class="sidebar-vendor-page">
	<aside>
		<div class="sidebar-content">
		<h3><strong>Daily Retail Couponz</strong></h3>
		
		<p>Daily Retail Couponz provides all the customers and users with various types of bus, train and air coupons for international as well as domestic airlines.</p>
		<p>
			<span class="active-inactive">
					Total Coupon(s) Found: <strong><?php echo mysql_result(mysql_query("SELECT COUNT(`coupon_code`) FROM `coupon`"),0);?></strong>
			</span>
		</p>
		</div>
		
		<div class="sidebar-content">
		<h3><strong>Quick Links</strong></h3>

		<ul class="sidebar-links">
		<li><a href="http://www.dailyretailcouponz.com/stores/">All Stores</a></li>
		<li><a href="http://www.dailyretailcouponz.com/testimonial.php">Testimonials</a></li>
		<?php if(isset($_SESSION['username']) && isset($_SESSION['password'])) {?>
		<li><a href="http://www.dailyretailcouponz.com/my-account.php">My Account</a></li>
		<li><a href="http://www.dailyretailcouponz.com/my-submitted-coupons.php">View Submitted Coupons</a></li>
		<li><a href="http://www.dailyretailcouponz.com/submit-a-coupon.php">Submit A Coupon</a></li>
		<li><a href="http://www.dailyretailcouponz.com/logout.php">Logout</a></li>
		<li><a href="http://www.dailyretailcouponz.com/contact-us.php">Contact Us</a></li>
		<?php } else {?>
		<li><a href="http://www.dailyretailcouponz.com/register.php">Register</a></li>
		<li><a href="http://www.dailyretailcouponz.com/contact-us.php">Contact Us</a></li>
		<?php }?>
		</ul>
		
		</div>
		
	</aside>
</div>