<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Define website meta-data and SEO content below -->
	<meta name="description" content="The official Congregation website for URCSA Melodi ya Tshwane. View Announcements, Events, 
		Sumbit your Qualifications to find jobs and do much more at the URCSA MyT Congregation website">
	<meta name="keywords" content="URCSA, Melodi ya Tshwane, MyT">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 days">
	<link rel="canonical" href="http://mytchurch.co.za">
	<!-- Open Graph Metadata for Social Media Optimisation -->
	<meta property="og:url" content="http://mytchurch.co.za"> 
	<meta property="og:title" content="URCSA Melodi ya Tshwane"> 
	<meta property="og:site_name" content="URCSA MyT">
	<meta property="og:description" content="The official Congregation website for URCSA Melodi ya Tshwane"> 
	<meta property="og:type" content="website"> 
	<meta property="og:image:width" content="256"> 
	<meta property="og:image:height" content="60"> 
	<meta property="og:image:type" content="image/jpeg"> 
	<meta property="og:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta property="og:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
	<!-- Twitter Cards for Social Media Optimisation on Twitter -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@urcsamyt">
	<meta name="twitter:creator" content="@urcsamyt">
	<meta name="twitter:title" content="URCSA Melodi ya Tshwane">
	<meta name="twitter:description" content="The official Congregation website for URCSA Melodi ya Tshwane">
	<meta name="twitter:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta name="twitter:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
		
	<title>URCSA Melodi ya Tshwane</title>
	<?php require 'inc/mytStyling.php';?>		<!-- Include all css and shiv/normalize  -->
	
	<!-- Begin Schema.org JSON-LD Markup -->
	<script type="application/ld+json">
    	{
    		"@context": "http://schema.org",
			"@type" : "LocalBusiness",
			"name" : "URCSA Melodi ya Tshwane",
			"url" : "http://mytchurch.co.za",
			"logo" : "http://mytchurch.co.za/assets/urcsaEmblem373x373.jpg",
			"image" : [
				"http://mytchurch.co.za/assets/urcsaEmblem373x373.jpg",
				"http://mytchurch.co.za/assets/urcsaEmblemOGImage.png",
				"http://mytchurch.co.za/assets/urcsaEmblem133x129.jpeg"
			],
			"sameAs" : [
				"https://web.facebook.com/URCSAMYT/",
				"https://twitter.com/urcsamyt",
				"https://www.instagram.com/urcsamyt/",
				"https://www.youtube.com/channel/UCYT4hwfjKNDJ_2gCSLeQARQ"
			],
  			"contactPoint": { 
					"@type": "ContactPoint",
					"url" : "http://mytchurch.co.za",
      				"email": "admin@mytchurch.co.za",
      				"contactType": "customer support",
					"areaServed" : "Tshwane"
    		},
			"geo" : {
				"@type" : "GeoCoordinates",
				"address" : {
					"@type" : "PostalAddress",
					"streetAddress" : "Bosman and Madiba Street",
					"addressLocality" : "Pretoria"
				},
				"addressCountry" : "ZA",
  				"latitude": "-25.7455728",
    			"longitude": "28.1850805"
			},
			"description" : "We are a congregation of the Uniting Reformed Church in Southern Africa located on corner Bosman and Madiba Streets in the city center of Pretoria. Melodi ya Tshwane is a multi-racial, multi-cultural and multi-lingual congregation consisting of diverse people who believe that they are called to bring a message of hope and encouragement to people living in and around the city.",
			"hasMap" : "https://goo.gl/maps/veYV3usrNSK2",
			"isAccessibleForFree" : "True",
			"openingHours" : "Su 10:00-12:00",
			"openingHoursSpecification" : {
				"@type" : "OpeningHoursSpecification",
				"opens" : "10:00",
				"closes" : "12:00",
				"dayOfWeek" : "Sunday"
			},
			"publicAccess" : "True",
			"smokingAllowed" : "False",
			"address" : {
					"@type" : "PostalAddress",
					"streetAddress" : "Bosman and Madiba Street",
					"addressLocality" : "Pretoria"
			},
			"priceRange" : "0",
			"telephone" : "0127513250"
    	}
    </script>
	<!-- End Schema.org JSON-LD Markup -->	
</head>
<body id="myt-Top-Page" data-spy="scroll" data-target=".navbar">
	<?php 
		$header_flag = 'index';
		require "inc/header.php";	// Include header section
	?>
	<div class="container clearfix main-body"> <!-- Main Body Container -->			
		<aside id="submit-confirm" class="submit-confirm-hide myt-cen-txt col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div id="submit-confirm-msg" class="alert alert-success"></div>
		</aside>
		<?php 
			require "inc/homeCarouselLg.php"; // Include image slideshow aside on large devices-hide on small devices
		?>	
		<?php 
			require "inc/homeCarouselSm.php"; // Include image slideshow aside on small devices-hide on large devices
		?>	
		<?php 
			require "inc/newsCarouselLg.php"; // Include news sildeshow aside on large devices-hide on small devices
		?>		
		<article id="home-content" class="col-lg-8 col-md-8 col-sm-12 col-xs-12" aria-labelledby="welcome-title">
				<h1 id="welcome-title" style="margin-top:0px;">&nbsp;
					<i class="fas fa-church"></i>&nbsp;<abbr title="Uniting Reformed Church in Southern Africa">URCSA</abbr> Melodi ya Tshwane
				</h1>
				<section id="welcome-content">
					<p>Welcome to the homepage of Melodi ya Tshwane (<abbr title="Melodi ya Tshwane">MyT</abbr>). 
						We are a congregation of the Uniting Reformed Church in Southern Africa located on corner Bosman and Madiba Streets in 
						the city center of Pretoria. Melodi ya Tshwane is a multi-racial, multi-cultural and multi-lingual congregation consisting 
						of diverse people who believe that they are called to bring a message of hope and encouragement to people living in and around 
						the city. It is always the congregation’s wish and prayer that through the grace of Jesus Christ and the power of the Holy Spirit, 
						God will enable it to strive for the realization of its vision of:</p>
					<p class="myt-cen-txt"><em>Being a vibrant and caring Christian community, uniting diverse people in worship, empowering one another in 
						working for justice and peace in the city.</em></p>
					<p>Melodi ya Tshwane is slightly different from many other urban or city ministry organizations and institutions which are more project-based, 
						helping the poor and the needy by way of either accommodating them in an institution or distributing hand-outs to them. Though Melodi ya 
						Tshwane church do give some handouts occasionally, it nevertheless does so within the context of firstly being a congregation which preaches 
						the word and serves sacraments whilst at the same time reaching out to the poor and needy in its surroundings.</p>
					<p>To know more about Melodi ya Tshwane congregation please feel free to surf our web page.</p>
					<p>You can find out:</p>
					<div class="row">
						<div id="panel-container" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<a href="about.php" aria-labelledby="aboutus-home-link">
									<div class="panel-body">
										<div class="panel-head"><img src="assets/question43x43.png" alt="Icon of a question mark"></div>
										<div><h4 id="aboutus-home-link">Who we are</h4></div>
									</div>
								</a>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<a href="about.php#urcsa-name" aria-labelledby="history-home-link">
									<div class="panel-body">
										<div class="panel-head"><img src="assets/history43x43.png" alt="Icon of a clock"></div>
										<div><h4 id="history-home-link">How we began</h4></div>
									</div>
								</a>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<a href="ministries.php" aria-labelledby="ministries-home-link">
									<div class="panel-body">
										<div class="panel-head"><img src="assets/handshake43x43.png" alt="Icon of a handshake"></div>
										<div><h4 id="ministries-home-link">What we are doing</h4></div>
									</div>
								</a>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
								<a href="congregation.php#committees" aria-labelledby="committees-home-link">
									<div class="panel-body">
										<div class="panel-head"><img src="assets/community43x43.png" alt="Icon of a family surrounded 
											by giant hands underneath them to represent a community"></div>
										<div><h4 id="committees-home-link">How and why we are doing it</h4></div>
									</div>												
								</a>
							</div>																																	
						</div>
					</div>
					<p>If you are already attending our church visit the <a href="galleries.php" aria-labelledby="gallery-home-link">
						<span id="gallery-home-link">galleries</span></a> to see yourself in the church activities.</p>
					<p>Once more, welcome to our site!</p>
					<p><strong>The Late Rev. Dr. Tipi Jacob Nthakhe</strong></p>							
				</section>
				<?php require "inc/sharebutton.php"; // include sharebuttons ?>
		</article>	
		<section id="highlights-sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12" 
			 aria-labelledby="high-title">
			<h2 id="high-title"><span class="glyphicon glyphicon-facetime-video"></span>&nbsp;&nbsp;Highlights</h2>
			<div class="embed-responsive embed-responsive-16by9">
				<iframe src="https://www.youtube.com/embed/mAYoVe9U03A"></iframe>
			</div>
		</section>					
		<?php 
			require "inc/newsCarouselSm.php";	 // Include news aside carousel for (extra)small devices-hide on large devices
		?>	
		<?php 
			require "inc/scriputureSidebar.php"; // Include weekly scripture aside
		?>	
		<aside id="google-app-sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			<h2><span class="glyphicon glyphicon-phone"></span>
				<span id="google-play-link-txt">App Coming Soon!</span>
				<!-- <a href="unavailable.php" target="_blank" aria-labelledby="google-play-link-txt">
					<span id="google-play-link-txt">MyT App Coming Soon!</span></a> -->
			</h2>
			<p><span id="google-play-link">
					<img class="img-responsive center-block" src="assets/googlePlayBadge320x200.png" width="200" height="150" alt="Google Play badge, 
						black with transparent background and contains Google Play logo and the the words: GET IT ON GOOLGLE PLAY"/>
				</span>
				<!-- <a href="unavailable.php" target="_blank" aria-labelledby="google-play-link"><span id="google-play-link">
				<img class="img-responsive center-block" src="assets/googlePlayBadge320x200.png" width="200" height="150" alt="Google Play badge, 
					black with transparent background and contains Google Play logo and the the words: GET IT ON GOOLGLE PLAY"/></span></a> -->
			</p>
		</aside>												
		<aside id="social-sidebar" class="col-lg-4 col-md-4 col-sm-12 col-xs-12 myt-cen-txt">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<a href="https://web.facebook.com/URCSAMYT/" target="_blank" aria-labelledby="facebook-icon-link">
					<img class="img-responsive center-block" src="assets/fbIcon64x64.png" alt="Facebook Icon. White background with 
						a Black Facebook logo centered."><span id="facebook-icon-link">Facebook</span> 
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<a href="https://twitter.com/urcsamyt" target="_blank" aria-labelledby="twitter-icon-link">
					<img class="img-responsive center-block" src="assets/twitterIcon64x64.png" alt="Twitter Icon. White background with 
						a Black Twitter logo centered."><span id="twitter-icon-link">Twitter</span>
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<a href="https://www.instagram.com/urcsamyt/" target="_blank" aria-labelledby="instagram-icon-link">
					<img class="img-responsive center-block" src="assets/instagramIcon64x64.png" alt="Instagram Icon. White 
						background with a Black Instagram logo centered."><span id="instagram-icon-link">Insta</span>
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
				<a href="https://www.youtube.com/channel/UCYT4hwfjKNDJ_2gCSLeQARQ" target="_blank" 
					aria-labelledby="youtube-icon-link">
					<img class="img-responsive center-block" src="assets/youTubeIcon64x64.png" alt="YouTube Icon. 
						White background with a Black and White YouTube logo centered."><span id="youtube-icon-link">YouTube</span>
				</a>
			</div>
		</aside>							
	</div> 				<!-- End Main Body Container -->
	
	<?php require "inc/footer.php"; // Include footer section ?>
</body>	
</html>
