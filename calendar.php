<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Define website meta-data and SEO content below -->
	<meta name="description" content="The Yearly Congregational Calendar for Melodi ya Tshwane">
	<meta name="keywords" content="URCSA, Melodi ya Tshwane, Calendar, MyT, CWM, CMM, CYM, MyTC, Youth">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 days">
	<link rel="canonical" href="http://mytchurch.co.za/calendar.php">
	<!-- Open Graph Metadata for Social Media Optimisation -->
	<meta property="og:url" content="http://mytchurch.co.za/calendar.php"> 
	<meta property="og:title" content="Melodi ya Tshwane Calendar"> 
	<meta property="og:site_name" content="URCSA Melodi ya Tshwane">
	<meta property="og:description" content="The Yearly Congregational Calendar for Melodi ya Tshwane"> 
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
	<meta name="twitter:title" content="Melodi ya Tshwane Calendar">
	<meta name="twitter:description" content="The Yearly Congregational Calendar for Melodi ya Tshwane">
	<meta name="twitter:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta name="twitter:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
	
	<title>Calendar</title>
	<?php require 'inc/mytStyling.php';?>		<!-- Include all css and shiv/normalize  -->
</head>	
<body>
	<?php 
		$header_flag = 'calendar';
		require "inc/header.php";	// Include header section
	?>
	<div class="container clearfix main-body">		<!-- Main Body Container -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div aria-label="breadcrumb">	<!-- Breadcrumbs -->
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item"><a href="congregation.php">Congregation</a></li>
						<li class="breadcrumb-item active" aria-current="page">Calendar</li>
					</ol>
				</div>							<!-- End Breadcrumbs -->	
				<aside id="submit-confirm" class="submit-confirm-hide myt-cen-txt">
					<div id="submit-confirm-msg" class="alert alert-success"></div>
				</aside>								
				<article id="calendar-content" aria-labelledby="calendar-content-title">
					<h1 id="calendar-content-title">&nbsp;<i class="far fa-calendar-alt"></i>&nbsp;&nbsp;MyT Calendar</h1>
					<?php require 'inc/gCalendarLg.php';?>	<!-- Include Calendar Month default view on Large Screens / Hide on Small and Medium Screens -->
					<?php require 'inc/gCalendarSm.php';?>	<!-- Include Calendar Agenda default view on Small and Medium Screens / Hide on Large Screens -->
				</article>
				<?php require "inc/sharebutton.php"; // include sharebuttons ?>				
			</div>
		</div>
	</div>		<!-- End Main Body Container -->

	<?php require "inc/footer.php"; // Include footer section ?>
</body>
</html>