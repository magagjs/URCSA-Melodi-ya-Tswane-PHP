	<footer id="footer-content">	 <!-- Footer -->
		<div class="container">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<p><span class="glyphicon glyphicon-time">&nbsp;</span>Service:</p>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
							<p>Every Sunday at 10:00</p>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<p><span class="glyphicon glyphicon-home">&nbsp;</span>Address:</p>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
							<p><a href="https://goo.gl/maps/veYV3usrNSK2" target="_blank" 
									aria-labelledby="google-map-link">
									<span id="google-map-link">Corner Bosman &amp; Madiba Street, Pretoria</span>
								</a>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<p><span class="glyphicon glyphicon-envelope">&nbsp;</span>Email:</p>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
							<p>admin@mytchurch.co.za</p>
						</div>
					</div>
					<!-- <div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
							<p><span class="glyphicon glyphicon-phone-alt">&nbsp;</span>Phone:</p>
						</div>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
							<p>012 234 5679</p>
						</div>
					</div> -->
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 myt-cen-txt">
					<span id="myt-newsletter-link" style="color:#DAA520">Newsletter</span>&nbsp;
					<span id="myt-downloads-link"  style="color:#DAA520">Downloads</span>&nbsp;
					<!-- <a href="unavailable.php" target="_blank" aria-labelledby="myt-newsletter-link">
						<span id="myt-newsletter-link">Newsletter</span></a>&nbsp;
					<a href="unavailable.php" target="_blank" aria-labelledby="myt-downloads-link">
						<span id="myt-downloads-link">Downloads</span></a>&nbsp; -->
					<a href="http://urcsa.net/" target="_blank" aria-labelledby="myt-affiliations-link">
						<span id="myt-affiliations-link">Affilations</span></a>		
				</div>
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 myt-cen-txt">
					<p style="font-size:130%">
						<a href="https://web.facebook.com/URCSAMYT/" target="_blank" aria-labelledby="facebook-link">
							<i id="facebook-link" class="fab fa-facebook"></i></a>&nbsp;
						<a href="https://twitter.com/urcsamyt" target="_blank" aria-labelledby="twitter-link">
							<i id="twitter-link" class="fab fa-twitter-square"></i></a>&nbsp;
						<a href="https://www.instagram.com/urcsamyt/" target="_blank" aria-labelledby="instagram-link">
							<i id="instagram-link" class="fab fa-instagram"></i></a>&nbsp;
						<a href="https://www.youtube.com/channel/UCYT4hwfjKNDJ_2gCSLeQARQ" target="_blank" aria-labelledby="youtube-link">
							<i id="youtube-link" class="fab fa-youtube-square"></i></a>&nbsp;&nbsp;&nbsp;</p>									
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 myt-cen-txt">
				<p>Copyright &copy; <?php date_default_timezone_set("Africa/Johannesburg"); echo date("Y");?> 
					<abbr title="Uniting Reformed Church in Southern Africa">URCSA</abbr>&nbsp;Melodi ya Tshwane | Website developed by 
					<a rel="author" href="communicationscom.php" target="_blank" aria-labelledby="myt-communications-link">
						<span id="myt-communications-link"><abbr title="Melodi ya Tshwane">MyT</abbr> Communications Committee</span></a></p>
				<p><a href="privacy.php#terms" aria-labelledby="myt-disclaimer-link">
					<span id="myt-disclaimer-link">Terms of use</span></a><span style="color: #DAA520"> | </span>
					<a href="privacy.php#privacy" aria-labelledby="myt-privacy-link">
						<span id="myt-privacy-link">Privacy</span></a></p>		
			</div>
		</div>
	</footer>	<!-- End Footer -->
	
	<a class="scrollIcon" href="#myt-Top-Page" aria-labelledby="scroll-Top-link">		<!-- Scroll back to top icon -->
		<i id="scroll-Top-link" class="glyphicon glyphicon-triangle-top"></i></a>
	
	<!-- 'Contact us' Modal -->
	<div id="myt-contact-modal" class="modal fade" tabindex="-1" role="dialog"
		aria-labelledby="myt-contact-label" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myt-contact-label">
						Contact Melodi ya Tshwane</h4>
				</div>
				<div class="modal-body">
					<span id="mytContactForm" class="sr-only">Contact MyT Church Form</span>
					<form id="contact-form" aria-labelledby="mytContactForm" method="post" action="scripts/mytProcess.php">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="contactname"  class="form-control" placeholder="Enter Full Name">
							<span class="help-block" id="name-contact-error"></span>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="tel" name="contacttel" class="form-control" placeholder="Enter Phone Number">
							<span class="help-block" id="phone-contact-error"></span>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="contactemail" class="form-control" placeholder="Enter Email Address">
							<span class="help-block" id="email-contact-error"></span>
						</div>	
						<div class="form-group">
							<label>Message</label>
							<textarea name="contactmessage" class="form-control" rows="4" aria-multiline="true"></textarea>
							<span class="help-block" id="message-contact-error"></span>
						</div>	
						<input id="idForm" name="formId" type="hidden" value="contactForm">
						<input id="urlContactForm" name="formUrl" type="hidden" value="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
						<div class="alert alert-info"><p>You can also use the contact information in 
							'About us' to contact us.</p></div>
						
						<!-- Google ReCaptcha v2 -->
						<div class="g-recaptcha" data-sitekey="6LdinFwUAAAAAGBdcLBhJPx7LUnjGSe8-h21bacW" data-callback="enableContactSubmit"></div>
						<span class="captcha-block" id="captcha-message-error-contact"></span>
						
						<button id="contactsubmit" type="submit" class="btn btn-primary" aria-labelledby="contactMytBtn">
							<span id="contactMytBtn">Send</span></button>		
						<button type="button" class="btn btn-primary" data-dismiss="modal" aria-labelledby="cancelContactBtn">
							<span id="cancelContactBtn">Cancel</span></button>			
					</form>
				</div>
			</div>
		</div>
	</div>				<!-- End 'Contact us' Modal -->
	
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>	
	<script src="js/myt-custom.js"></script>	<!-- URCSA MyT custom JS -->
	<script src='https://www.google.com/recaptcha/api.js'></script>		<!-- Google reCaptcha v2 -->   	
	    <!-- Add video support for Flash Player as a fallback to HTML5 <video> -->
	<!-- <script src="js/jwplayer.js"></script> -->
	<!-- <script src="js/swfobject.js"></script> -->