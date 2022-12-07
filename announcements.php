<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Define website meta-data and SEO content below -->
	<meta name="description" content="Church announcements at URCSA MyT. Stay updated with current church news">
	<meta name="keywords" content="URCSA, Melodi ya Tshwane, MyT, CWM, CMM, CYM, MyTC, Youth">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 days">
	<link rel="canonical" href="http://mytchurch.co.za/announcements.php">
	<!-- Open Graph Metadata for Social Media Optimisation -->
	<meta property="og:url" content="http://mytchurch.co.za/announcements.php"> 
	<meta property="og:title" content="URCSA Melodi ya Tshwane Announcements"> 
	<meta property="og:site_name" content="URCSA Melodi ya Tshwane">
	<meta property="og:description" content="Church announcements at URCSA MyT. Stay updated with current church news"> 
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
	<meta name="twitter:title" content="URCSA Melodi ya Tshwane Announcements">
	<meta name="twitter:description" content="Church announcements at URCSA MyT. Stay updated with current church news">
	<meta name="twitter:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta name="twitter:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
	
	<title>Announcements</title>
	<?php require 'inc/mytStyling.php';?>		<!-- Include all css and shiv/normalize  -->
</head>	
<body>
	<?php 
		$header_flag = 'announcements';
		require "inc/header.php";	// Include header section
	?>
	<div class="container clearfix main-body">		<!-- Main Body Container -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div aria-label="breadcrumb">	<!-- Breadcrumbs -->
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item"><a href="congregation.php">Congregation</a></li>
						<li class="breadcrumb-item active" aria-current="page">Announcements</li>
					</ol>
				</div>							<!-- End Breadcrumbs -->	
				<aside id="submit-confirm" class="submit-confirm-hide myt-cen-txt">
					<div id="submit-confirm-msg" class="alert alert-success"></div>
				</aside>								
				<article id="announcements-content" aria-labelledby="announce-content-title">
					<h1 id="announce-content-title">&nbsp;<i class="fas fa-bullhorn"></i>&nbsp;&nbsp;Announcements</h1>	
					<!-- NO ANNOUNCEMENTS -->
					<section id="no-announce" aria-labelledby="announce-post0">
						<h2 id="announce-post0">There are currently no announcements</h2>
					</section>		
					<!--		
					<section id="post3" aria-labelledby="announce-post3">
						<h2><i class="fas fa-calendar-alt"></i>&nbsp;17 March 2019</h2>
						<h3 id="announce-post3">Church Council Meeting</h3>
						<p>Church Council meeting on 17 March 2019</p>
						<p>Agenda: The Calling of The Minister of the Word</p>
					</section>-->											
					<section id="announcements-contacts" aria-labelledby="announcements-contacts-title">
						<h2 id="announcements-contacts-title">Contact Info</h2>
						<p>Email Anything you need to announce to: <strong>announce@mytchurch.co.za</strong></p>
					</section>
				</article>
				<?php require "inc/sharebutton.php"; // include sharebuttons ?>				
			</div>
		</div>
	</div>		<!-- End Main Body Container -->

	<?php require "inc/footer.php"; // Include footer section ?>
</body>
</html>