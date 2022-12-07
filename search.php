<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Define website meta-data and SEO content below -->
	<meta name="description" content="URCSA Melodi ya Tshwane Site search results">
	<meta name="robots" content="noindex, follow">
	<meta name="revisit-after" content="1 days">
	<link rel="canonical" href="http://mytchurch.co.za/search.php">
	<!-- Open Graph Metadata for Social Media Optimisation -->
	<meta property="og:url" content="http://mytchurch.co.za/search.php"> 
	<meta property="og:title" content="URCSA Melodi ya Tshwane Search Engine"> 
	<meta property="og:site_name" content="URCSA Melodi ya Tshwane">
	<meta property="og:description" content="URCSA Melodi ya Tshwane site search results"> 
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
	<meta name="twitter:title" content="URCSA Melodi ya Tshwane Search Engine">
	<meta name="twitter:description" content="URCSA MyT site search results">
	<meta name="twitter:image" content="http://mytchurch.co.za/assets/urcsaEmblemOGImage.png">
	<meta name="twitter:image:alt" content="An emblem of URCSA Melodi ya Tshwane">
	
	<title>Search Results</title>
	<?php require 'inc/mytStyling.php';?>		<!-- Include all css and shiv/normalize  -->
	
	<script type="application/ld+json">
    {
    	"@context": "http://schema.org",
		"@type": "SearchResultsPage",
	    "accessModeSufficient" : "[textual,visual]",
		"name" : "About Us",
		"url" : "http://mytchurch.co.za/search.php",
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
						"@id" : "http://mytchurch.co.za/search.php",
						"name" : "Search Results"
					}
				}
			]
		},
		"mainEntity" : {
			"@type" : "WebPage",
			"name" : "Search Results"
		}		
    }
    </script>		
</head>	
<body>
	<?php 
		$header_flag = 'search';
		require "inc/header.php";	// Include header section
	?>
	<div class="container main-body">	<!-- Main Body -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div aria-label="breadcrumb">	<!-- Breadcrumbs -->
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Search Results</li>
					</ol>
				</div>							<!-- End Breadcrumbs -->	
				<aside id="submit-confirm" class="submit-confirm-hide myt-cen-txt">
					<div id="submit-confirm-msg" class="alert alert-success"></div>
				</aside>					
				<article id="search-results-content" aria-labelledby="search-title">
					<h1 id="search-title">&nbsp;<i class="fas fa-search"></i>&nbsp;&nbsp;Search Results</h1>
					<div id="tipue_search_content"></div>
				</article>
			</div>
		</div>
	</div>		<!-- End Main Body -->

	<?php require "inc/footer.php"; // Include footer section ?>
	<!-- Tipue Search -->
	<script src="js/tipuesearch_set.js"></script>		
	<script src="js/tipuesearch_content.js"></script>
	<script src="js/tipuesearch.js"></script>	
	<!-- Call Tipue Search Method on search box -->
	<script>
		$(document).ready(function() {
		     $('#search-box-input').tipuesearch({
		    	 'descriptiveWords': 50,
		    	 'highlightTerms': 'true',
		    	 'mode': 'live',
				 'showURL': false,
				 'show': 10,
				 'highlightTerms': true,
				 'liveDescription': '#home-content, #aboutus-content, #announcements-content, #choir-content, #communications-content, #congregation-content, #academic-content, #events-content, #finance-content, #gallery-content, #health-content, #ministries-content, #cmm-content, #cwl-content, #cwm-content, #cym-content, #mytyouth-content, #outreach-content, #privacy-content, #scripture-content, #wards-content, #footer-content',
				 'liveContent': '#home-content, #aboutus-content, #announcements-content, #choir-content, #communications-content, #congregation-content, #academic-content, #events-content, #finance-content, #gallery-content, #health-content, #ministries-content, #cmm-content, #cwl-content, #cwm-content, #cym-content, #mytyouth-content, #outreach-content, #privacy-content, #scripture-content, #wards-content, #footer-content'
		     });
		});
	</script>
</body>
</html>
