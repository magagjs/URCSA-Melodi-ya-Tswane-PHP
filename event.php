<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Define website meta-data and SEO content below -->
	<meta name="description" content="Upcoming events at URCSA MyT. Find information about revivals, ministry events, 
		congregation events and much more!">
	<meta name="keywords" content="URCSA, Melodi ya Tshwane, MyT, CWM, CMM, CYM, MyTC, Youth">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 days">
	<link rel="canonical" href="http://mytchurch.co.za/event.php">
	<!-- Open Graph Metadata for Social Media Optimisation -->
	<meta property="og:url" content="http://mytchurch.co.za/event.php"> 
	<meta property="og:title" content="URCSA Melodi ya Tshwane Events"> 
	<meta property="og:site_name" content="URCSA Melodi ya Tshwane">
	<meta property="og:description" content="Upcoming events at URCSA MyT"> 
	<meta property="og:type" content="website"> 
	<meta property="og:image:width" content="256"> 
	<meta property="og:image:height" content="60"> 
	<meta property="og:image:type" content="image/jpeg"> 
	<meta property="og:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta property="og:image:alt" content="An emblem of URCSA Melodi ya Tshwane. Find information about revivals, ministry events, 
		congregation events and much more" />
	<!-- Twitter Cards for Social Media Optimisation on Twitter -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site/" content="@urcsamyt">
	<meta name="twitter:creator" content="@urcsamyt">
	<meta name="twitter:title" content="URCSA Melodi ya Tshwane Events. Find information about revivals, ministry events, 
		congregation events and much more">
	<meta name="twitter:description" content="Upcoming events at URCSA MyT">
	<meta name="twitter:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta name="twitter:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
	
	<title>Events</title>
	<?php require 'inc/mytStyling.php';?>		<!-- Include all css and shiv/normalize  -->
	
	<!-- Begin Schema.org JSON-LD Markup -->
	<script type="application/ld+json">
    {
    	"@context": "http://schema.org",
		"@type" : "LocalBusiness",
		"name" : "Melodi ya Tshwane",
		"url" : "http://mytchurch.co.za/event.php",
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
      		"email": "events@mytchurch.co.za",
			"url" : "http://mytchurch.co.za/event.php",
      		"contactType": "customer support",
			"areaServed" : "Tshwane"
    	},		
		"mainEntityOfPage" : "http://mytchurch.co.za/event.php",
		"openingHours" : "Su 10:00-12:00",
		"priceRange" : 0,
		"hasMap" : "https://goo.gl/maps/veYV3usrNSK2",
		"address" : {
			"@type" : "PostalAddress",
			"streetAddress" : "Corner Bosman & Madiba Street",
			"addressCountry" : "ZA",
			"addressLocality" : "Tshwane"
		}
	}
    </script>
    <!-- End Schema.org JSON-LD Markup -->	
</head>	
<body>
	<?php 
		$header_flag = 'events';
		require "inc/header.php";	// Include header section
	?>
	<div class="container clearfix main-body">		<!-- Main Body Container -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div aria-label="breadcrumb">	<!-- Breadcrumbs -->
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item"><a href="congregation.php">Congregation</a></li>
						<li class="breadcrumb-item active" aria-current="page">Events</li>
					</ol>
				</div>							<!-- End Breadcrumbs -->		
				<aside id="submit-confirm" class="submit-confirm-hide myt-cen-txt">
					<div id="submit-confirm-msg" class="alert alert-success"></div>
				</aside>						
				<article id="events-content" aria-labelledby="event-title">
					<h1 id="event-title">&nbsp;<i class="fas fa-bullhorn"></i>&nbsp;&nbsp;Events</h1>
					<section id="post1" aria-labelledby="event-post1">
						<h2 id="event-post1">Sanitary Towel Drive</h2>
						<img class="img-thumbnail img-responsive" src="assets/eventSanitary900x1280.jpeg	"
							alt="Sanitary Towel Drive" width="550" height="550">
					</section>
					<!-- NO EVENTS 
					<section id="no_event" aria-labelledby="event-post0">
						<h2 id="event-post0">There are currently no events</h2>
						<p>Please check the <a href="calendar.php" target="blank">MyT Calendar</a> for future events.</p>
					</section>
					-->
					<!--
					 <section id="event1" aria-labelledby="event-post1" itemprop="subjectOf" itemscope itemtype="http://schema.org/Event">
						<meta itemprop="startDate" content="2018-10-27T09:00"/>
						<meta itemprop="endDate" content="2018-10-28T20:00"/>
						<h2><i class="fas fa-calendar-alt"></i>&nbsp;27-28 October 2018&nbsp;<i class="far fa-clock"></i>&nbsp;09:00</h2>
						<h3 id="event-post1" itemprop="name">MyT CYM Revival</h3>
						<p itemprop="description">Annual Spiritual and Fundraising revival at
							<span itemprop="performer" itemscope itemtype="http://schema.org/Organization">
								<span itemprop="name">URCSA Melodi ya Tshwane</span>.
							</span>
						</p>		
						<img class="img-responsive" src="assets/cymRevival-201810.jpeg" alt=" MyT CYM Revival Poster"
							width="400" height="550">				
						<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
							<meta itemprop="embedUrl" content="assets/cymRevival-201810.jpeg"/>
							<meta itemprop="url" content="http://mytchurch.co.za/assets/cymRevival-201810.jpeg"/>
						</div>
						<div itemprop="location" itemscope itemtype="http://schema.org/Church">
							<meta itemprop="name" content="URCSA MYT"/>
							<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
								<meta itemprop="addressCountry" content="South Africa"/>
								<meta itemprop="addressLocality" content="Pretoria/Tshwane"/>
								<meta itemprop="addressRegion" content="Gauteng"/>
								<meta itemprop="streetAddress" content="Corner Bosman and Madiba Street"/>
							</div>	
						</div>												
						<div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
							<link itemprop="url" href="#" />
						    <meta itemprop="price" content="0"/>
						    <meta itemprop="priceCurrency" content="ZAR" />
						    <link itemprop="availability" href="http://schema.org/InStock"/>
						    <meta itemprop="validFrom" content="2018-10-24"/>
					    </div>												
					</section> -->	
					<section id="events-contacts" aria-labelledby="events-contacts-title">
						<h2 id="events-contacts-title">Contact Info</h2>
						<p>Email any events in your ministry/committee: <strong>events@mytchurch.co.za</strong></p>
					</section>									
				</article>
				<?php require "inc/sharebutton.php"; // include sharebuttons ?>				
			</div>
		</div>
	</div>		<!-- End Main Body Container -->

	<!-- Include the footer here -->
	<?php require "inc/footer.php"; ?>
</body>
</html>