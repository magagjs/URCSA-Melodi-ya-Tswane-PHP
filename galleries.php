<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Define website meta-data and SEO content below -->
	<meta name="description" content="The Photo Gallery of URCSA Melodi ya Tshwane. View photos from MyT events - you might just see yourself!">
	<meta name="keywords" content="URCSA, Melodi ya Tshwane, Myt">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 days">
	<link rel="canonical" href="http://mytchurch.co.za/galleries.php">
	<!-- Open Graph Metadata for Social Media Optimisation -->
	<meta property="og:url" content="http://mytchurch.co.za/galleries.php"> 
	<meta property="og:title" content="URCSA Melodi ya Tshwane Gallery"> 
	<meta property="og:site_name" content="URCSA Melodi ya Tshwane">
	<meta property="og:description" content="The Photo Gallery of URCSA Melodi ya Tshwane. View photos from MyT events - you might just see yourself!"> 
	<meta property="og:type" content="website"> 
	<meta property="og:image:width" content="256"> 
	<meta property="og:image:height" content="60"> 
	<meta property="og:image:type" content="image/jpeg"> 
	<meta property="og:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta property="og:image:alt" content="An emblem of URCSA Melodi ya Tshwane" />
	<!-- Twitter Cards for Social Media Optimisation on Twitter -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@urcsamyt">
	<meta name="twitter:creator" content="@urcsamyt">
	<meta name="twitter:title" content="URCSA Melodi ya Tshwane Gallery">
	<meta name="twitter:description" content="The Photo Gallery of URCSA Melodi ya Tshwane. View photos from MyT events - you might just see yourself!">
	<meta name="twitter:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta name="twitter:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
	
	<title>Gallery</title>
	<?php require 'inc/mytStyling.php';?>		<!-- Include all css and shiv/normalize  -->
	<!-- Magnific-popup stylesheet adding image slider -->	  
	<link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">	
	
	<script type="application/ld+json">
    {
    	"@context": "http://schema.org",
		"@type": "ImageGallery",
	    "accessModeSufficient" : "[textual,visual]",
		"name" : "About Us",
		"url" : "http://mytchurch.co.za/galleries.php",
        "breadcrumb": {
	  		"@type" : "BreadcrumbList",
			"itemListElement" : 
			[
				{
					"@type" : "ListItem",
					"position" : 1,
					"item" : {
						"@id" : "http://mytchurch.co.za/index.php",
						"name" : "Home"
					}
				},
				{
					"@type" : "ListItem",
					"position" : 2,
					"item" : {
						"@id" : "http://mytchurch.co.za/galleries.php",
						"name" : "Gallery"
					}
				}
			]
		},
		"mainEntity" : {
			"@type" : "Organization",
			"name" : "URCSA Melodi ya Tshwane",
			"logo" : "http://mytchurch.co.za/assets/urcsaEmblem373x373.jpg"
		}		
    }
    </script>	
</head>	
<body>
	<?php 
		$header_flag = 'gallery';
		require "inc/header.php";	// Include header section
	?>
	<div class="container clearfix main-body">		<!-- Main Body Container -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div aria-label="breadcrumb">	<!-- Breadcrumbs -->
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Gallery</li>
					</ol>
				</div>							<!-- End Breadcrumbs -->	
				<aside id="submit-confirm" class="submit-confirm-hide myt-cen-txt">
					<div id="submit-confirm-msg" class="alert alert-success"></div>
				</aside>							
				<article class="row" id="gallery-content" aria-labelledby="gallery-title">
					<h1 id="gallery-title">&nbsp;<span class="glyphicon glyphicon-camera"></span>&nbsp;&nbsp;Melodi ya Tshwane Gallery</h1>
					<div>
						<div id="instafeed">
						</div>
					</div>
				</article>
				<div id="insta-feed-alert" class="row">
					<div class="myt-cen-txt instafeed-btn">
						<button type="button" class="btn btn-primary btn-lg" id="load-feed-btn">See More</button>	
					</div>
				</div>
			</div>
		</div>
	</div>		<!-- End Main Body Container -->

	<!-- Include the footer here -->
	<?php require "inc/footer.php"; ?>
	<!-- Instafeed JS for Instagram feed on Gallery page-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/instafeed.js/1.4.1/instafeed.min.js"></script>
    <!-- Magnific-popup JS for adding image slider to Instagram feed Gallery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script> 
    <script src="js/myt-custom-gallery.js"></script>	<!-- URCSA Myt custom JS for Instagram feed -->
</body>
</html>