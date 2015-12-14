<?php
session_start();	//Start a new session or resume a session
require_once("db_info.php");
mysql_connect($db_host,$db_username,$db_password,$db_name);
mysql_select_db($db_name);
?>
<div class="sidebar-vendor-page">
	<aside>
	
		<div class="sidebar-content">
		<h3>Daily Retail Couponz's Statistics</h3>
	
		 <?php
					//based on the vendor id, the coupons are fetched.
                    $all_coupons_active = mysql_query("SELECT COUNT(coupon_id) as coupon_count FROM coupon where DATE(coupon_expiry_date) >= CURDATE()");
					$row_acount=mysql_fetch_assoc($all_coupons_active);
					$active_count = $row_acount['coupon_count'];
					
					 $all_coupons_inactive = mysql_query("SELECT COUNT(coupon_id) as coupon_count FROM coupon where DATE(coupon_expiry_date) < CURDATE()");
					$row_incount=mysql_fetch_assoc($all_coupons_inactive);
					$inactive_count = $row_incount['coupon_count'];
				
				?>
			<p>
				<span class="active-inactive">
					Total Registered User(s): <strong><?php echo mysql_result(mysql_query("SELECT COUNT(`username`) FROM `login`"),0);?></strong>
				</span>
			</p>
			<p>
				<span class="active-inactive">
					Total Coupon(s) Found: <strong><?php echo mysql_result(mysql_query("SELECT COUNT(`coupon_code`) FROM `coupon`"),0);?></strong>
				</span>
			</p>
			<p>
				<span class="active-inactive">Active Coupon(s) Found: <strong><?php echo $active_count;?></strong></span>
			</p>
			<p>
				<span class="active-inactive">Unrelieble Coupon(s) Found: <strong><?php echo $inactive_count;?></strong></span>
			</p>
			
		</div>

		
	</aside>
</div>