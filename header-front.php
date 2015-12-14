<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['password']))
{
	//this condition will check if the logged in user is a employee
	if (($_SESSION['username'] == 'khadyea') || ($_SESSION['username'] == 'alqahtanis4') || ($_SESSION['username'] == 'sarkara') || ($_SESSION['username'] == 'khopkarp'))
	{
		//EMPLOYEE SPECIFIC HEADER
		?>
		
		<header id="header">

		<!-- area for banner -->
			<div class="fullwidthbanner-container intro">
			<!-- code for banner goes here -->
			
				<div class="header-menu-item mobile-only">
					<ul class="ul-mobile-only">
						
						<li>
							<?php print $_SESSION['display_name'];// to display the users name ?>!
						</li>
						
						<li>
							<a href="http://www.dailyretailcouponz.com/all-coupons.php">Coupons</a>
						</li>
						
						<li>
							<a href="http://www.dailyretailcouponz.com/my-account.php">My Account</a>
						</li>
						
						<li>
							<a href="http://www.dailyretailcouponz.com/logout.php">Logout</a>
						</li>
					</ul>
				</div>
				
				<div class="header-menu-item desktop-only">
			
					<div class="container-inner">
						<div class="row">
							<div class="col-4">
								<div class="greeting-message">
									<span>Welcome, <?php print $_SESSION['display_name']; ?></span>
								</div>
							</div>
							
							<div class="col-8">
								<div class="nav-div">
									<nav id="navigation" class="menu">
										<ul id="responsive" class="navbar-menu">
											<li>
												<a href="http://www.dailyretailcouponz.com">Home</a>
											</li>
											
											<li>
												<a href="http://www.dailyretailcouponz.com/all-coupons.php">Edit All Coupons</a>
											</li>
											
											<li>
												<a href="http://www.dailyretailcouponz.com/upload-coupons.php">Add Coupons</a>
											</li>
											
											<li>
												<a href="http://www.dailyretailcouponz.com/submitted-coupons.php">Submitted Coupons</a>
											</li>
											
											<li>
												<a href="http://www.dailyretailcouponz.com/emp-account.php">My Account</a>
												 <!-- <ul class="dropdown">
													<li><a href="http://www.dailyretailcouponz.com/logout.php">Logout</a></li>
													
												</ul> -->
											</li>
											
											<li>
												<a href="http://www.dailyretailcouponz.com/logout.php">Logout</a>
											</li>
																
										</ul>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- end of div header-menu-item -->
			
				<div class="container-inner extraspace">
					<div class="row">
						<div class="col-12">
							<div align="middle" class="logo">
								<a title="Home Page" href="http://www.dailyretailcouponz.com/"><img src="images/logo-drc-2.png"></a>
							</div>
							<h1 style="text-align:center; font-size: 70px;">Daily Retail Couponz</h1>
							<h2 style="text-align:center; color:#fff;"> Over 50 discount &amp; coupon codes available! </h2>
						</div>
					</div>
					
					<div class="row singlepageheader">
				<!-- HTML for SEARCH BAR -->
						<div id="searchbar" class="col-12">
							<form action="../search.php" method="GET">
									<input type="text" class="searchbarinput" name="searchterm" required size="70" placeholder="&nbsp;Search for Best Travel Deals..." maxlength="120">
									<input type="submit" value="Search" class="searchbutton">
							</form>
						</div>
					</div>
					
				</div>
			</div>

			
		</header> <!-- end of header -->
		
		<?php 
	}
	else {
			?>
			<?php 
			// FOR CUSTOMERS/USERS
			//print $_SESSION['display_name']; ?>
			
		<header id="header">

		<!-- area for banner -->
			<div class="fullwidthbanner-container intro">
			<!-- code for banner goes here -->
			
				<div class="header-menu-item mobile-only">
					<ul class="ul-mobile-only">
						
						<li>
							<?php print $_SESSION['display_name'];// to display the users name ?>!
						</li>
						
						<li>
							<a title="Displays All Stores" href="http://www.dailyretailcouponz.com/stores/">All Stores</a>
						</li>
						
						<li>
							<a href="http://www.dailyretailcouponz.com/my-account.php">My Account</a>
						</li>
						
						<li>
							<a href="http://www.dailyretailcouponz.com/logout.php">Logout</a>
						</li>
					</ul>
				</div>
				<div class="header-menu-item desktop-only">
			
					<div class="container-inner">
						<div class="row">
							<div class="col-4">
								<div class="greeting-message">
									<span>Welcome, <?php print $_SESSION['display_name']; ?></span>
								</div>
							</div>
							
							<div class="col-8">
								<div class="nav-div">
									<nav id="navigation" class="menu">
										<ul id="responsive" class="navbar-menu">
											<li>
												<a href="http://www.dailyretailcouponz.com">Home</a>
											</li>
											
											<li>
												<a href="http://www.dailyretailcouponz.com/stores">All Stores</a>
											</li>
											
											<li>
												<a href="http://www.dailyretailcouponz.com/submit-a-coupon.php">Submit A Coupon</a>
											</li>
											
											<li>
												<a href="http://www.dailyretailcouponz.com/write-a-testimonial.php">Write A Testimonial</a>
												<ul class="dropdown">
													<li><a href="http://www.dailyretailcouponz.com/testimonial.php">All Testimonials</a></li> 
													
												</ul>
											</li>
											
											<li>
												<a href="http://www.dailyretailcouponz.com/my-account.php">My Account</a>
												<!-- <ul class="dropdown">
													<li><a href="http://www.dailyretailcouponz.com/my-wishlist.php">Wishlist</a></li>
													<li><a href="http://www.dailyretailcouponz.com/account-history.php">History</a></li>
													<li><a href="http://www.dailyretailcouponz.com/logout.php">Logout</a></li>
												</ul> -->
											</li>	
										
										
											<li>
												<a href="http://www.dailyretailcouponz.com/logout.php">Logout</a>
											</li>
										
											
										</ul>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- end of div header-menu-item -->
			
				<div class="container-inner extraspace">
					<div class="row">
						<div class="col-12">
							<div align="middle" class="logo">
								<a title="Home Page" href="http://www.dailyretailcouponz.com/"><img src="images/logo-drc-2.png"></a>
							</div>
							<h1 style="text-align:center; font-size: 70px;">Daily Retail Couponz</h1>
							<h2 style="text-align:center; color:#fff;"> Over 50 discount &amp; coupon codes available! </h2>
						</div>
					</div>
					
					<div class="row singlepageheader">
				<!-- HTML for SEARCH BAR -->
						<div id="searchbar" class="col-12">
							<form action="../search.php" method="GET">
									<input type="text" class="searchbarinput" name="searchterm" required size="70" placeholder="&nbsp;Search for Best Travel Deals..." maxlength="120">
									<input type="submit" value="Search" class="searchbutton">
							</form>
						</div>
					</div>
					
				</div>
			</div>

			
		</header> <!-- end of header -->	
			
			<?php
		}
}
else 
{
?>	
<header id="header">

		<!-- area for banner -->
	<div class="fullwidthbanner-container intro">
	<!-- code for banner goes here -->
		<div class="header-menu-item mobile-only">
			<ul class="ul-mobile-only">
				<li>
					Guest!
				</li>
				<li>
					<a title="Displays All Stores" href="http://www.dailyretailcouponz.com/stores/">All Stores</a>
				</li>
				
				<li>
					<a title="Login Page" href="http://www.dailyretailcouponz.com/login.php">Login</a>
				</li>
				
				<li>
					<a title="Register Page" href="http://www.dailyretailcouponz.com/register.php">Register</a>
				</li>
			</ul>
		</div>
	
		<div class="header-menu-item desktop-only">
	
		<div class="container-inner">
			<div class="row">
				<div class="col-4">
					<div class="greeting-message">
						<span>Welcome, Guest!</span>
					</div>
				</div>
				
				<div class="col-8">
					<div class="nav-div">
						<nav id="navigation" class="menu">
							<ul id="responsive" class="navbar-menu">
								<li>
									<a title="Home Page" href="http://www.dailyretailcouponz.com">Home</a>
								</li>
								
								<li>
									<a title="Displays All Stores" href="http://www.dailyretailcouponz.com/stores/">All Stores</a>
								</li>
								
								<li>
									<a title="Displays All Testimonials" href="http://www.dailyretailcouponz.com/testimonial.php">Testimonials</a>
								</li>
								
								<li>
									<a href="http://www.dailyretailcouponz.com/contact-us.php">Contact</a>
								</li>
											
								<li>
								<a title="Login Page" href="http://www.dailyretailcouponz.com/login.php">Login</a>
								</li>
								
								<li>
									<a title="Register Page" href="http://www.dailyretailcouponz.com/register.php">Register</a>
								</li>
							
								
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- end of div header-menu-item -->
	
		<div class="container-inner extraspace">
			<div class="row">
				<div class="col-12">
					<div align="middle" class="logo">
						<a title="Home Page" href="http://www.dailyretailcouponz.com/"><img src="images/logo-drc-2.png"></a>
					</div>
					<h1 style="text-align:center; font-size: 70px;">Daily Retail Couponz</h1>
					<h2 style="text-align:center; color:#fff;"> Over 50 discount &amp; coupon codes available! </h2>
				</div>
			</div>
			
			<div class="row singlepageheader">
		<!-- HTML for SEARCH BAR -->
				<div id="searchbar" class="col-12">
					<form action="../search.php" method="get">
							<input type="text" class="searchbarinput" name="searchterm" required size="70" placeholder="&nbsp;Search for Best Travel Deals..." maxlength="120">
							<input type="submit" value="Search" class="searchbutton">
					</form>
				</div>
			</div>
			
		</div>
	</div>

	
</header> <!-- end of header -->
<?php } ?>