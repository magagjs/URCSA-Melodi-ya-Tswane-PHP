<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Define website meta-data and SEO content below -->
	<meta name="description" content="URCSA MyT 404 Page Unavailable">
	<meta name="robots" content="noindex, follow">
	<meta name="revisit-after" content="1 days">
	<link rel="canonical" href="http://mytchurch.co.za/unavailable.php">
	<!-- Open Graph Metadata for Social Media Optimisation -->
	<meta property="og:url" content="http://mytchurch.co.za/unavailable.php"> 
	<meta property="og:title" content="URCSA Melodi ya Tshwane 404 Unavailable"> 
	<meta property="og:site_name" content="URCSA Melodi ya Tshwane">
	<meta property="og:description" content="URCSA MyT 404 Page Unavailable"> 
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
	<meta name="twitter:description" content="URCSA MyT 404 Page Unavailable">
	<meta name="twitter:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta name="twitter:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
	
	<title>Unavailable</title>
	<?php require 'inc/mytStyling.php';?>		<!-- Include all css and shiv/normalize  -->
</head>	
<body>
	<?php 
		$header_flag = 'unavailable';
		require "inc/header.php";	// Include header section
	?>
	<div class="container main-body">	<!-- Main Body -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div aria-label="breadcrumb">	<!-- Breadcrumbs -->
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Page Unavailable</li>
					</ol>
				</div>							<!-- End Breadcrumbs -->	
				<aside id="submit-confirm" class="submit-confirm-hide myt-cen-txt">
					<div id="submit-confirm-msg" class="alert alert-success"></div>
				</aside>					
				<article class="myt-cen-txt" aria-labelledby="unavailable-title">
					<h1 id="unavailable-title">Page Under Construction</h1>
					<p style="font-size:120%;"><strong>Sorry, this page is under construction!</strong></p>
					<p><strong>An announcement will be made in church once construction is complete.</strong></p>	
					<img class="img-responsive center-block" alt="Construction sign" src="assets/siteUnderConstruction.jpg" width="320" height="200">
				</article>
			</div>
		</div>
	</div>		<!-- End Main Body -->

	<?php require "inc/footer.php"; // Include footer section ?>
</body>
</html>