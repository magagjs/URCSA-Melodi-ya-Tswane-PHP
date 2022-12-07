<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Define website meta-data and SEO content below -->
	<meta name="description" content="URCSA Melodi ya Tshwane website. Access Denied">
	<meta name="robots" content="noindex, follow">
	<meta name="revisit-after" content="1 days">
	<link rel="canonical" href="http://mytchurch.co.za/noaccess.php">
	<!-- Open Graph Metadata for Social Media Optimisation -->
	<meta property="og:url" content="http://mytchurch.co.za/noaccess.php"> 
	<meta property="og:title" content="URCSA Melodi ya Tshwane Access Denied"> 
	<meta property="og:site_name" content="URCSA Melodi ya Tshwane">
	<meta property="og:description" content="URCSA Melodi ya Tshwane Congregation website. Access Denied"> 
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
	<meta name="twitter:title" content="URCSA Melodi ya Tshwane">
	<meta name="twitter:description" content="URCSA Melodi ya Tshwane Congregation website. Access Denied">
	<meta name="twitter:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta name="twitter:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
	
	<title>Access Denied</title>
	<?php require 'inc/mytStyling.php';?>		<!-- Include all css and shiv/normalize  -->
</head>	
<body>
	<?php 
		$header_flag = 'noaccess';
		require "inc/header.php";	// Include header section
	?>
	<div class="container main-body">	<!-- Main Body -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div aria-label="breadcrumb">	<!-- Breadcrumbs -->
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Access Denied</li>
					</ol>
				</div>							<!-- End Breadcrumbs -->	
				<aside id="submit-confirm" class="submit-confirm-hide myt-cen-txt">
					<div id="submit-confirm-msg" class="alert alert-success"></div>
				</aside>									
				<article class="myt-cen-txt" aria-labelledby="no-access-title">
					<h1 id="no-access-title">Access Denied</h1>
					<p style="font-size:120%;"><strong>Sorry, you do not have access to this resource!</strong></p>
					<p><strong>Please go to the <a href="index.php">home page</a> to view what you may have access to.</strong></p>	
					<img class="img-responsive center-block" alt="Construction sign" src="assets/accessDenied760x405.jpg" width="320" height="200">
				</article>
			</div>
		</div>
	</div>		<!-- End Main Body -->

	<?php require "inc/footer.php"; // Include footer section ?>
</body>
</html>