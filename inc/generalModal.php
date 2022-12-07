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