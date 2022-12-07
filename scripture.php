<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Define website meta-data and SEO content below -->
	<meta name="description" content="Weekly Scripture Reading from Sunday's Sermon at URCSA MyT">
	<meta name="keywords" content="URCSA, Melodi ya Tshwane, MyT">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 days">
	<link rel="canonical" href="http://mytchurch.co.za/scripture.php">
	<!-- Open Graph Metadata for Social Media Optimisation -->
	<meta property="og:url" content="http://mytchurch.co.za/scripture.php"> 
	<meta property="og:title" content="URCSA Melodi ya Tshwane Weekly Scripture"> 
	<meta property="og:site_name" content="URCSA Melodi ya Tshwane">
	<meta property="og:description" content="Weekly Scripture Reading from Sunday's Sermon at URCSA MyT"> 
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
	<meta name="twitter:title" content="URCSA Melodi ya Tshwane Weekly Scripture">
	<meta name="twitter:description" content="Weekly Scripture Reading from Sunday's Sermon at URCSA MyT">
	<meta name="twitter:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta name="twitter:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
		
	<title>Scripture</title>
	<?php require 'inc/mytStyling.php';?>		<!-- Include all css and shiv/normalize  -->
</head>
<body id="myt-Top-Page" data-spy="scroll" data-target=".navbar">
	<?php 
		$header_flag = 'index';
		require "inc/header.php";	// Include header section
	?>
	<!-- Insert Carousel here -->
	<div class="container clearfix main-body"> <!-- Main Body Container -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div aria-label="breadcrumb">	<!-- Breadcrumbs -->
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>					
						<li class="breadcrumb-item active" aria-current="page">Scripture</li>
					</ol>
				</div>							<!-- End Breadcrumbs -->
				<aside id="submit-confirm" class="submit-confirm-hide myt-cen-txt">
					<div id="submit-confirm-msg" class="alert alert-success"></div>
				</aside>					
				<article id="scripture-reading" aria-labelledby="scripture-title">
					<h1 id="scripture-title">&nbsp;<i class="fas fa-book"></i>&nbsp;&nbsp;Scriputure Reading</h1>
					<!-- include html for scripture of the week-html include used for real-time editing of scripture -->
					<div class="jumbotron col-lg-12 col-md-12 col-sm-12 col-xs-12">	
						<blockquote id="scripture-content">
							<!-- !!!!!!!!!!!!!!!!!!!! Start Edit below !!!!!!!!!!!!!! -->
							<strong>2 Corinthians 5:1-10</strong><br>
							<p><strong>Title: Awaiting the New Body</strong></p>
							<div id="vers">
								<p><sup>1</sup> For we know that if the earthly tent we live in is destroyed, we have a building from God, an eternal house in heaven, 
									not built by human hands.</p>
								<p><sup>2</sup> Meanwhile we groan, longing to be clothed instead with our heavenly dwelling, </p>
								<p><sup>3</sup> because when we are clothed, we will not be found naked. </p>
								<p><sup>4</sup> For while we are in this tent, we groan and are burdened, because we do not wish to be unclothed but to be clothed 
									instead with our heavenly dwelling, so that what is mortal may be swallowed up by life. </p>
								<p><sup>5</sup> Now the one who has fashioned us for this very purpose is God, who has given us the Spirit as a deposit, guaranteeing 
									what is to come.</p>
								<p><sup>6</sup> Therefore we are always confident and know that as long as we are at home in the body we are away from the Lord. </p>
								<p><sup>7</sup> For we live by faith, not by sight. </p>
								<p><sup>8</sup> We are confident, I say, and would prefer to be away from the body and at home with the Lord. </p>
								<p><sup>9</sup> So we make it our goal to please him, whether we are at home in the body or away from it. </p>
								<p><sup>10</sup> For we must all appear before the judgment seat of Christ, so that each of us may receive what is due us for the 
									things done while in the body, whether good or bad.</p>
							</div>
							<!-- !!!!!!!!!!!!!!!!!!!! End Edit above !!!!!!!!!!!!!!! -->
						</blockquote>				
					</div>		
					<p><cite>Source: <a href="https://www.biblegateway.com/passage/?search=2+Corinthians+5%3A1-10&version=NIV" target="_blank">
						Bible Gatewey</a></cite></p>												
				</article>
			</div>
		</div>
	</div>
	
	<?php require "inc/footer.php"; // Include footer section ?>
</body>	
</html>
