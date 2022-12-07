<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Define website meta-data and SEO content below -->
	<meta name="description" content="MyT Skills Audit. Submit you Qualifications, skills and CV 
		for the congregation to assist you to find employment">
	<meta name="keywords" content="URCSA, Melodi ya Tshwane, MyT, CYM, MyT Youth">
	<meta name="robots" content="noindex, follow">
	<meta name="revisit-after" content="1 days">
	<link rel="canonical" href="http://mytchurch.co.za/mytSkills.php">
	<!-- Open Graph Metadata for Social Media Optimisation -->
	<meta property="og:url" content="http://mytchurch.co.za/mytSkills.php"> 
	<meta property="og:title" content="URCSA Melodi ya Tshwane Skills"> 
	<meta property="og:site_name" content="URCSA Melodi ya Tshwane">
	<meta property="og:description" content="MyT Skills Audit. Submit you Qualifications/Skills and CV"> 
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
	<meta name="twitter:title" content="URCSA Melodi ya Tshwane Skills">
	<meta name="twitter:description" content="MyT Skills Audit. Submit you Qualifications/Skills and CV">
	<meta name="twitter:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta name="twitter:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
	
	<title>Skills Audit</title>
	<?php require 'inc/mytStyling.php';?>		<!-- Include all css and shiv/normalize  -->
</head>	
<body>
	<?php 
		$header_flag = 'youthSkills';
		require "inc/header.php";	// Include header section
	?>
	<div class="container clearfix main-body">		<!-- Main Body Container -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div aria-label="breadcrumb">	<!-- Breadcrumbs -->
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item"><a href="congregation.php">Congregation</a></li>
						<li class="breadcrumb-item active" aria-current="page">Skills Audit</li>
					</ol>
				</div>							<!-- End Breadcrumbs -->
				<aside id="submit-confirm" class="submit-confirm-hide myt-cen-txt">
					<div id="submit-confirm-msg" class="alert alert-success"></div>
				</aside>					
				<article id="skillsAudit-content">
					<h1>&nbsp;<i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;MyT Skills Audit</h1>
					<div id="skillsAudit-home">
						<p>Please complete the form below to have your details captured for the Melodi ya Tshwane skills audit. 
							The relevant ministry/committee will contact you when any opportunities that match your skills are found. 
							You can also submit your CV by clicking the 'Upload a CV' button at the end!</p>
						<p><strong>Note: You can still submit your qualifications/skills without uploading a CV!</strong></p>
						<span id="mytSkillsForm" class="sr-only">MyT Skills Audit Form</span>
						<form id="skills-form" aria-labelledby="mytSkillsForm" method="post" enctype="multipart/form-data" 
							action="scripts/mytProcess.php">
							<div class="form-group">
								<label>First Name</label>
								<input type="text" name="skillsfname"  class="form-control" placeholder="Enter First Names">
								<span class="help-block" id="fname-skills-error"></span>
							</div>
							<div class="form-group">
								<label>Surname</label>
								<input type="text" name="skillslname"  class="form-control" placeholder="Enter Surname">
								<span class="help-block" id="lname-skills-error"></span>
							</div>							
							<div class="form-group">
								<label>Phone</label>
								<input type="tel" name="skillstel" class="form-control" placeholder="Enter Phone Number">
								<span class="help-block" id="phone-skills-error"></span>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="skillsemail" class="form-control" placeholder="Enter Email Address">
								<span class="help-block" id="email-skills-error"></span>
							</div>	
							<div class="form-group">
								<label>Residential Location</label>
								<input type="text" name="skillsres"  class="form-control" placeholder="Enter Residential Location">
								<span class="help-block" id="res-skills-error"></span>
							</div>
							<div class="form-group">
								<label>Qualifications/Skills</label>
								<textarea name="skillsqual" class="form-control" rows="4" placeholder="Enter Qualification Name or Skills or Both"
									aria-multiline="true"></textarea>
								<span class="help-block" id="qual-skills-error"></span>
							</div>	
							<!-- <div class="form-group">
								<label>Upload a CV</label>
								<input type="file" name="skillsfile" id="skill-cv">
								<span class="help-block" id="file-skills-error"></span>
							</div> -->
							<label>Upload a PDF or MS WORD CV of 5MB or less in size</label><br>
							<label class="btn btn-primary">
							    <input type="file" id="skills-cv" name="skillsfile" style="display:none" 
							    	onchange="validateFileUpload(this);">
							    Upload a CV
							</label>
							<span id="file-name" style="margin-left:15px">No file uploaded</span>
							<div id="upload-msg" class="alert alert-danger fade in upload-msg-hide"></div>
									    
							<input id="idSkillsForm" name="formId" type="hidden" value="skillsForm">
							<input id="urlSkillsForm" name="formUrl" type="hidden" value="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
							
							<!-- Google ReCaptcha v2 -->
							<div class="g-recaptcha" data-sitekey="6LdinFwUAAAAAGBdcLBhJPx7LUnjGSe8-h21bacW" data-callback="enableSkillsSubmit"></div>
							<span class="captcha-block" id="captcha-message-error-skills"></span>
							
							<button id="skillssubmit" type="submit" class="btn btn-primary" aria-labelledby="skillsMytBtn">
								<span id="skillsMytBtn">Submit</span>
							</button>				
						</form>						
					</div>
				</article>
			</div>
		</div>
	</div>		<!-- End Main Body Container -->

	<?php require "inc/footer.php"; // Include footer section ?>
</body>
</html>