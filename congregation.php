<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Define website meta-data and SEO content below -->
	<meta name="description" content="Information about the URCSA MyT congregation. Find out about our ministries, committees and much more">
	<meta name="keywords" content="URCSA, Melodi ya Tshwane, MyT, CWM, CMM, CYM, MyTC, Youth">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 days">
	<link rel="canonical" href="http://mytchurch.co.za/congregation.php">
	<!-- Open Graph Metadata for Social Media Optimisation -->
	<meta property="og:url" content="http://mytchurch.co.za/congregation.php"> 
	<meta property="og:title" content="URCSA Melodi ya Tshwane Congregation"> 
	<meta property="og:site_name" content="URCSA Melodi ya Tshwane">
	<meta property="og:description" content="Information about the URCSA MyT congregation. Find out about our ministries, committees and much more"> 
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
	<meta name="twitter:title" content="URCSA Melodi ya Tshwane Congregation">
	<meta name="twitter:description" content="Information about the URCSA MyT congregation. Find out about our ministries, committees and much more">
	<meta name="twitter:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta name="twitter:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
	
	<title>Congregation</title>
	<?php require 'inc/mytStyling.php';?>		<!-- Include all css and shiv/normalize  -->
</head>	
<body>
	<?php 
		$header_flag = 'congregation';
		require "inc/header.php";	// Include header section
	?>
	<div class="container clearfix main-body">		<!-- Main Body Container -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div aria-label="breadcrumb">	<!-- Breadcrumbs -->
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Congregation</li>
					</ol>
				</div>							<!-- End Breadcrumbs -->		
				<aside id="submit-confirm" class="submit-confirm-hide myt-cen-txt">
					<div id="submit-confirm-msg" class="alert alert-success"></div>
				</aside>							
				<article id="congregation-content" aria-labelledby="congregate-title">
					<h1 id="congregate-title">&nbsp;<i class="fas fa-church"></i>&nbsp;&nbsp;Congregation</h1>
					<section id="announcements" aria-labelledby="congregate-announce">
						<h2 id="congregate-announce">Announcements</h2>
						<p>Recent announcements in Melodi ya Tshwane.
							&nbsp;<a href="announcements.php">Read more recent announcements here and stay updated!</a></p>
					</section>	
					<section id="events">
						<h2 id="congregate-event">Events</h2>
						<p>Upcoming events in Melodi ya Tshwane.&nbsp;<a href="event.php">Find Melodi ya Tshwane 
							upcoming events here!</a></p>
					</section>	
					<section id="calendar">
						<h2 id="congregate-calendar">Calendar</h2>
						<p>MyT Year Calendar with a year schedule of key events, meetings and gatherings.&nbsp;<a href="calendar.php">Find Melodi ya Tshwane 
							year calendar here!</a></p>
					</section>						
					<section id="committees" aria-labelledby="congregate-committee">
						<h2 id="congregate-committee">Committees</h2>
						<p>We have a church council made up of representatives of all committees. Each of these members 
							report to the church council on behalf of the committee.</p>
						<section id="health-com" aria-labelledby="congregate-health">
							<!-- <h3 id="congregate-health"><a href="healthcom.php">
								<i class="fas fa-briefcase-medical"></i>&nbsp;Health Committee</a></h3> -->
							<h3 id="congregate-health"><i class="fas fa-briefcase-medical"></i>&nbsp;Health Committee</h3>
							<p>Comprises of health Professional; that is, your Medical Doctors, Nurses etc.&nbsp;
								<!-- <a href="healthcom.php">Read more about the Health Committee here.</a> --></p>
						</section>	
						<section id="academic-com" aria-labelledby="congregate-academic">					
							<!-- <h3 id="congregate-academic"><a href="academiccom.php">
								<i class="fas fa-graduation-cap"></i>&nbsp;Academic Committee</a></h3> -->
							 <h3 id="congregate-academic"><i class="fas fa-graduation-cap"></i>&nbsp;Academic Committee</h3> 
							<p>Assist church members with academics and career development.&nbsp;
								<!-- <a href="academiccom.php">Read more about the Academic Committee here.</a> --></p>
						</section>
						<section id="outreach-com" aria-labelledby="congregate-outreach">
							<!-- <h3 id="congregate-outreach"><a href="outreachcom.php">
								<i class="fas fa-hands-helping"></i>&nbsp;Outreach Committee</a></h3> -->
							 <h3 id="congregate-outreach"><i class="fas fa-hands-helping"></i>&nbsp;Outreach Committee</h3> 
							<p>The Outreach Committee is responsible for social responsibility.&nbsp;
								<!-- <a href="outreachcom.php">Read more about the Outreach committee here.</a> --></p>
						</section>
						<section id="finance-com" aria-labelledby="congregate-finance">
							<!-- <h3 id="congregate-finance"><a href="financecom.php">
								<i class="far fa-money-bill-alt"></i>&nbsp;Finance Committee</a></h3> -->
							<h3 id="congregate-finance"><i class="far fa-money-bill-alt"></i>&nbsp;Finance Committee</h3>
							<p>The Finance committee manages the finances of the church.&nbsp;
								<!-- <a href="financecom.php">Read more about the Finance Committee here.</a> --></p>
						</section>
						<section id="communications-com" aria-labelledby="congregate-comms">
							<h3 id="congregate-comms"><a href="communicationscom.php">
								<i class="fas fa-comments"></i>&nbsp;Communications Committee</a></h3>
							<p>Manages communication.&nbsp;
								<a href="communicationscom.php">Read more about the Communications Committee here.</a></p>
						</section>
					</section>	
					<section id="wards" aria-labelledby="congregate-wards">
						<h2 id="congregate-wards"><a href="wards.php">Wards</a></h2>
						<p>The congregation also has a number of wards which meet weekly in members’ homes across the city. These are 
							sharing groups where members care for one another, study the bible and pray for one another's needs. There 
							are also afternoon wards for domestic workers which meet on Sundays.</p>
						<p> The wards are led by ward leaders nominated by the Church Council. Wards were established to provide pastoral 
							care and support to members in their daily lives, struggles and difficulties. Special attention is given to visiting 
							the sick, lonely, bereaved, imprisoned and traumatised.</p>
						<p><a href="wards.php">Read more about the MyT Wards here.</a></p>
					</section>				
				</article>
			</div>
		</div>
	</div>		<!-- End Main Body Container -->
	
	<?php require "inc/footer.php"; // Include footer section?>
</body>
</html>