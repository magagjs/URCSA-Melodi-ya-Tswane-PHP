$(document).ready(function() {	
	
	// function for getting Instagram feed using Instagram API
	var userFeed = new Instafeed({
	    get: 'user',
	    userId: '3991179505',
	    limit: '12',
	    sortBy: 'most-recent',
	    resolution: 'standard_resolution',
	    clientId: 'c400f2940c624504a67b87ad2159d976',
		accessToken: '3991179505.1677ed0.bb3a32b98f384983bfaac7340fec426e',
		target:  'instafeed',
		orientation: 'potrait',
		template: '<div class="col-lg-3 col-md-4 col-sm-5 col-xs-5">'+
				  '<a href="{{image}}" title="{{caption}}" target="_blank">'+
				  '<img src="{{image}}" alt="{{caption}}" class="img-rounded img-responsive"></a>'+
				  '<p>{{caption}}</p><br></div>',
				  
		// load only photos from Instagram for the feed - no videos
		filter: function(image){
			return image.type == 'image'; // && image.orientation == 'square';
		},		  
		
		// process the following function after every time 'userFeed' function runs
		after: function () {
			if(instaLoadButton!=null){		// could be null when running on page other than Gallery page
				instaLoadButton.removeAttribute('disabled');
				instaLoadButton.innerHTML="See More"; 
				if(!this.hasNext()) {	
					instaLoadButton.style.display = 'none';		// remove feed load button when feed has no more images
					// add alert message to the parent instafeed <div> when feed has no more images
					document.getElementById("insta-feed-alert").appendChild(infoAlertDiv);	//Add below all the images	
				}
			}
			
			// truncate long captions
			var captionDiv = document.getElementById("instafeed");				// get instagram feed div
			var imageCaptions = captionDiv.querySelectorAll("p"); 				// get array of captions under image
			for ( var i=0; i<imageCaptions.length; i++ ){						// loop through captions array
				var captionText = imageCaptions[i].innerHTML					// get the text of caption
				if( captionText.length > 34 ){									// truncate caption text if has more than 34 characters
					var newCaptionText = captionText.substring(0,33) + "...";	// only use first 34 characters of caption text and append ellipsis
					imageCaptions[i].innerHTML = newCaptionText;				// use truncated text as new caption 
				}
			} // End truncate long captions
		} // End after: function()
	});
	
	var instaLoadButton = document.getElementById("load-feed-btn");			// get button by ID to load more feeds
	if(instaLoadButton!=null){
		var infoAlertDiv = document.createElement("DIV");					// create <div> to set alert classes when feed has no more images
		infoAlertDiv.setAttribute('class', 'alert alert-info myt-cen-txt');	// insert classes 'alert alert-info' to <div> 'infoAlertDiv'
		var infoAlertPara = document.createElement("P");					// create <p> to display info message when feed has no more images
		var infoMsg = document.											
			createTextNode("There are no more images to display!");	// create text message for info alert	
		infoAlertPara.appendChild(infoMsg);							// add text message for info alert to <p>		
		infoAlertDiv.appendChild(infoAlertPara);					// add the <p> text to the alert <div>
		
		instaLoadButton.addEventListener("click", function() {		// function to load next feed images on button click	
			instaLoadButton.innerHTML="Loading..."; 				// change button text to 'Loading' on click
			instaLoadButton.setAttribute('disabled', 'disabled'); 	// disable feed load button on click until after userFeed runs
			userFeed.next();
		});
	}
	
	userFeed.run();

	// this will create a single gallery from all elements that have class "instafeed"
	$('#instafeed').magnificPopup({
	  type: 'image',
	  delegate: 'a',	// target anchor <a> tag
	  gallery:{
	  enabled:true
	  }
	});
	
});