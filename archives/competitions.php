<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Define website meta-data and SEO content below -->
	<meta name="description" content="Information about the URCSA MyT Competitions">
	<meta name="keywords" content="URCSA, Melodi ya Tshwane, MyT Competitions">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="1 days">
	<link rel="canonical" href="http://mytchurch.co.za/competitions.php">
	<!-- Open Graph Metadata for Social Media Optimisation -->
	<meta property="og:url" content="http://mytchurch.co.za/competitions.php"> 
	<meta property="og:title" content="URCSA Melodi ya Tshwane Competitions."> 
	<meta property="og:site_name" content="URCSA Melodi ya Tshwane">
	<meta property="og:description" content="Stand a chance to win awesome prized by entering the URCSA MyT Competitions"> 
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
	<meta name="twitter:title" content="URCSA Melodi ya Tshwane Competitions.">
	<meta name="twitter:description" content="Stand a chance to win awesome prized by entering URCSA MyT Competitions">
	<meta name="twitter:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta name="twitter:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
	
	<title>Competitions</title>
	<?php require 'inc/mytStyling.php';?>		<!-- Include all css and shiv/normalize  -->
</head>	
<body>
	<?php 
	    $header_flag = 'index';
		require "inc/header.php";	// Include header section
	?>
	<div class="container clearfix main-body">		<!-- Main Body Container -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div aria-label="breadcrumb">	<!-- Breadcrumbs -->
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Competitions</li>
					</ol>
				</div>							<!-- End Breadcrumbs -->
				<aside id="submit-confirm" class="submit-confirm-hide myt-cen-txt">
					<div id="submit-confirm-msg" class="alert alert-success"></div>
				</aside>								
				<article id="competition-content" aria-labelledby="competition-title">
					<h1 id="competition-title">&nbsp;<i class="fas fa-trophy"></i>&nbsp;&nbsp;Competitions</h1>
					<section id="competition-home" class="myt-cen-txt" aria-labelledby="competition-section">
						<h2 id="competition-section">MYT-DRC Newsletter</h2>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<img class="img-rounded img-responsive" src="assets/CompeteMYT427x413.png" alt="URCSA MYT Logo">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 compete-margin">
								<p style="font-size:180%">Stand a chance to win R100 for naming the MYT-DRC Newsletter.</p> 
								<p style="font-size:180%"><a href="#" data-toggle="modal" data-target="#myt-general-modal">Enter Now</a>!</p>
    						</div>							
    						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    							<img class="img-rounded img-responsive" src="assets/CompeteDRC427x419.jpg" alt="DRC Logo">
    						</div>
						</div>
						<p>MYT and DRC are combining to form a newsletter that will tell the stories of both congregations 25 years later. 
    						The newsletter needs a name that will represent both churches. The MYT Communications Committee is running a 
    						competition to select the best name for the newsletter. Are you up for challenge? Enter the competition by filling 
    						in the name you choose for the newsletter, your name and contact number and stand a chance to win yourself R100 
    						should the name you chose be selected for the MYT/DRC newsletter. All the best <i class="far fa-smile-wink"></i></p>
    					<p><a href="#" data-toggle="modal" data-target="#myt-general-modal">Click to Enter Competition</a></p>
					</section>
    				<section>
    					<ul>
    						<li>Closing Date: 12 April 2019</li>
    						<li>Voting/Draw Date: 13 April 2019</li>
    						<li>Announcement of winner and newsletter name: 14 April 2019</li>
    					</ul>
    				</section>
				</article>
				<?php require "inc/sharebutton.php"; // include sharebuttons ?>
			</div>		<!-- End Main Body Column -->
		</div>			<!-- End Main Body Row -->
	</div>				<!-- End Main Body Container -->

	<!-- 'General' Modal -->
	<div id="myt-general-modal" class="modal fade" tabindex="-1" role="dialog"
		aria-labelledby="myt-general-label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myt-general-label">
						Enter MYT-DRC Newsletter Competition</h4>
				</div>
				<div class="modal-body">
					<span id="mytGeneralForm" class="sr-only">Enter MYT-DRC Newsletter Competition Form</span>
					<form id="general-form" aria-labelledby="mytGeneralForm" method="post" action="scripts/mytProcess.php">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="generalname"  class="form-control" placeholder="Enter Full Name">
							<span class="help-block" id="name-general-error"></span>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="tel" name="generaltel" class="form-control" placeholder="Enter Phone Number">
							<span class="help-block" id="phone-general-error"></span>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="generalemail" class="form-control" placeholder="Email Address is NOT required!!">
							<span class="help-block" id="email-general-error"></span>
						</div>	
						<div class="form-group">
							<label>Newsletter Name</label>
							<textarea name="generalmessage" class="form-control" rows="2" aria-multiline="true"></textarea>
							<span class="help-block" id="message-general-error"></span>
						</div>	
						<input id="idFormGen" name="formId" type="hidden" value="generalForm">
						<input id="urlGeneralForm" name="formUrl" type="hidden" value="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
						
						<!-- Google ReCaptcha v2 -->
						<div class="g-recaptcha" data-sitekey="6LdinFwUAAAAAGBdcLBhJPx7LUnjGSe8-h21bacW" data-callback="enableGeneralSubmit"></div>
						<span class="captcha-block" id="captcha-message-error-general"></span>
						
						<button id="generalsubmit" type="submit" class="btn btn-primary" aria-labelledby="generalMytBtn">
							<span id="generalMytBtn">Send</span></button>		
						<button type="button" class="btn btn-primary" data-dismiss="modal" aria-labelledby="cancelGeneralBtn">
							<span id="cancelGeneralBtn">Cancel</span></button>			
					</form>
				</div>
			</div>
		</div>
	</div>				<!-- End 'General' Modal -->
	
	<?php require "inc/footer.php";        // Include footer section ?>
</body>
</html>
