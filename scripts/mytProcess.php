<?php 
	require "../../../config/mytComponents.php";
	
	// prepare log file
	global $logFileName, $errPageRedir;	
	$name = $lname = $tel = $email = $message = $resLocat = $qual ="";					// input form variables
	$nameErr = $lnameErr = $telErr = $emailErr = $messageErr = $resErr = $qualErr = ""; // error logs for form variables
	
	// log all errors and warnings to log file
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);	//////////	PROD: SET TO FALSE ////////////////////
	ini_set('log_errors', TRUE);
	ini_set('error_log', $logFileName);
	ini_set('file uploads', TRUE);					 // allow uploading of files	
	ini_set('upload_max_filesize', 5242880);		 // allow uploading up to 5MB sized files
	ini_set('upload_tmp_dir ', "../../tmpUploads/"); // temporary directory for file uploads
	
	// detect http or https
	$webProtocol = ( !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
			|| $_SERVER['SERVER_PORT'] == 443)
			? 'https://' : 'http://';
	$protocalHost = $webProtocol . $_SERVER['HTTP_HOST'];
	$errorRedirect = $protocalHost . $errPageRedir;
	
	$contactUsFormId = 'contactForm';
	$joinFormId = 'joinForm';
	$choirFormId = 'choirForm';
	$skillsFormId = 'skillsForm';
	$generalFormId = 'generalForm';
	
	if( checkFormType($contactUsFormId) ){			    	// process form data for 'Contact us' form
		
		if( processContactUs( $protocalHost ) ){			// process form if input is validated
			$previousPage = $_POST["formUrl"];		    	// page that called script
				
			header("Location: $protocalHost$previousPage"); // redirect to page to previous page
			exit();
		}else{
			mytLog("mytProcess: Contact form was not processed. Check logs");
			header("Location: $errorRedirect");
			exit();
		}
	}else if( checkFormType($joinFormId) ){	   				// 'Join Myt' form
		
		if( processJoinMyt( $protocalHost ) ){		
			$previousPage = $_POST["formUrl"];		    
				
			header("Location: $protocalHost$previousPage"); 
			exit();
		}else{
			mytLog("mytProcess: Join form was not processed. Check logs");
			//header("Location: $errorRedirect");
			exit();
		}
	}else if( checkFormType($choirFormId) ){				// 'Join Choir' form
		if( processJoinChoir( $protocalHost ) ){					   
			$previousPage = $_POST["formUrl"];		     
				
			header("Location: $protocalHost$previousPage"); 
			exit();
		}else{
			mytLog("mytProcess: Choir form was not processed. Check logs");
			header("Location: $errorRedirect");
			exit();
		}
	}else if( checkFormType($skillsFormId) ){				// 'Skills Audit' form
		if( processSkillsAudit( $protocalHost ) ){					   
			$previousPage = $_POST["formUrl"];		     
				
			header("Location: $protocalHost$previousPage"); 
			exit();
		}else{
			mytLog("mytProcess: Skills Audit form was not processed. Check logs");
			header("Location: $errorRedirect");
			exit();
		}
	}else if( checkFormType($generalFormId) ){				// 'General' form
	    if( processGeneralForm( $protocalHost ) ){
	        $previousPage = $_POST["formUrl"];
	        
	        header("Location: $protocalHost$previousPage");
	        exit();
	    }else{
	        mytLog("mytProcess: General form was not processed. Check logs");
	        header("Location: $errorRedirect");
	        exit();
	    }
	}	
	
	function checkFormType($formType){
		$retCheck = false;
		$checkVal = $_POST["formId"];
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if ( !empty($checkVal) ){			
				if($checkVal == $formType)	// check value must be same as form hidden input - formId
					$retCheck = true;
			}else
				mytLog("checkFormType: Form id for form type $formType was not retrieved from form");
		} 
		return $retCheck;
	}
			
	function processContactUs( $redir ){
		$processRetVal = false;
		$isContactUsValid = false;
		
		// begin 'Contact us' form validation
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if ( empty($_POST["contactname"])){
				$nameErr = "Your Name is required!";
				mytLog("processContactUs: Empty name in Contact Form: $nameErr");
				$isContactUsValid = false;
			}else{
				(string) $name = formatFormInput($_POST["contactname"]);
				$isContactUsValid = true;
			}	
	
			if ( empty($_POST["contacttel"])){
				$telErr = "Your Phone Number is required!";
				mytLog("processContactUs: Empty phone in Contact Form: $telErr");
				$isContactUsValid = false;
			}else{
				$tel = formatFormInput($_POST["contacttel"]);
				if( !validatePhone($tel) ){		// check if a valid phone number was given
					$telErr = "Your Phone Number is invalid! Enter valid Phone Number!";
					mytLog("processContactUs: Invalid phone in Contact Form: $telErr");
					$isContactUsValid = false;
				}else{
					$isContactUsValid = true;
				}
			}
			
			if( empty($_POST["contactemail"])){
				$emailErr = "Your Email address is required!";
				mytLog("processContactUs: Empty email in Contact Form: $emailErr");
				$isContactUsValid = false;
			}else{
				$email = formatFormInput($_POST["contactemail"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)){	// validate valid email address
					$emailErr = "Your Email address is invalid! Enter email in format 'name@domain.co.za'!";
					mytLog("processContactUs: Invalid email in Contact Form: $emailErr");
					$isContactUsValid = false;
				}else{
					$isContactUsValid = true;
				}
			}			
			
			if ( empty($_POST["contactmessage"])){
				$messageErr = "Your Message is required! Please state the reason for contacting us!";
				$isContactUsValid = false;
			}else{
				$message = $_POST["contactmessage"];
				$isContactUsValid = true;
			}	
			
			// Test if captcha response is present
			if ( empty($_POST["g-recaptcha-response"]) ){
				mytLog("processContactUs: Google Captcha Challenge was not completed in contact form");
				$isContactUsValid = false;
			}
			
			if( $isContactUsValid ){
				$processRetVal = processMytContact( (string) $name, (string) $tel, (string) $email, $message, $redir );
				if( !$processRetVal ){
					mytLog('processMytContact: Could not process Contact form information. Name:"' . $name .
						'", Phone:"' . $tel . '", Email:"' . $email .'", Message:"' . $message . '"' );
					$isContactUsValid = false;
				}
			}
			else
				mytLog("processContactUs: Contact form information is incomplete");
		} // end 'Contact us' form validation
		
		return $isContactUsValid;
	} // end processContactUs
	
	function processJoinMyt( $redir ){
		$processRetVal = false;
		$isJoinMytValid = false;
		
		// begin 'Join' form validation
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if ( empty($_POST["joinname"])){
				$nameErr = "Your Name is required!";
				mytLog("processJoinMyt: Empty name in Join Form: $nameErr");
				$isJoinMytValid = false;
			}else{
				$name = formatFormInput($_POST["joinname"]);
				$isJoinMytValid = true;
			}
		
			if ( empty($_POST["jointel"])){
				$telErr = "Your Phone Number is required!";
				mytLog("processJoinMyt: Empty phone in Join Form: $telErr");
				$isJoinMytValid = false;
			}else{
				$tel = formatFormInput($_POST["jointel"]);
				if( !validatePhone($tel) ){		// check if a valid phone number was given
					$telErr = "Your Phone Number is invalid! Enter valid Phone Number!";
					mytLog("processJoinMyt: Invalid phone in Join Form: $telErr");
					$isJoinMytValid = false;
				}else
					$isJoinMytValid = true;
			}
			
			if( empty($_POST["joinemail"])){
				$emailErr = "Your Email address is required!";
				mytLog("processJoinMyt: Empty email in Join Form: $emailErr");
				$isJoinMytValid = false;
			}else{
				$email = formatFormInput($_POST["joinemail"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)){	// validate valid email address
					$emailErr = "Your Email address is invalid! Enter email in format 'name@domain.co.za'!";
					mytLog("processJoinMyt: Invalid email in Join Form: $emailErr");
					$isJoinMytValid = false;
				}else 
					$isJoinMytValid = true;
			}	

			if ( empty($_POST["g-recaptcha-response"]) ){	// Test if captcha response is present
				mytLog("processJoinMyt: Google Captcha Challenge was not completed in join form");
				$isJoinMytValid = false;
			}
			
			if( $isJoinMytValid ){
				$processRetVal = processMytJoin( (string) $name, (string) $tel, (string) $email, $redir );
				if( !$processRetVal ){
					mytLog('processJoinMyt: Could not process Join form information. Name:"' . $name . 
						'", Phone:"' . $tel . '", Email:"' . $email .'"');	
					$isJoinMytValid = false;
				}
			}			
			else
				mytLog("processJoinMyt: Join form information is incomplete");
		} // end 'Join' form validation
		
		return $isJoinMytValid;
	} //end processJoinMyt
	
	function processJoinChoir( $redir ){
		$processRetVal = false;
		$isJoinChoirValid = false;
		
		// begin 'Join Choir' form validation
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if ( empty($_POST["choirname"])){
				$nameErr = "Your Name is required!";
				mytLog("processJoinChoir: Empty name in Choir Form: $nameErr");
				$isJoinChoirValid = false;
			}else{
				$name = formatFormInput($_POST["choirname"]);
				$isJoinChoirValid = true;
			}
			
			if ( empty($_POST["choirtel"]) ){
				$telErr = "Your Phone Number is required!";
				mytLog("processJoinChoir: Empty phone in Choir Form: $telErr");
				$isJoinChoirValid = false;
			}else{
				$tel = formatFormInput($_POST["choirtel"]);
				if( !validatePhone($tel) ){		// check if a valid phone number was given
					$telErr = "Your Phone Number is invalid! Enter valid Phone Number!";
					mytLog("processJoinChoir: Invalid phone in Choir Form: $telErr");
					$isJoinChoirValid = false;
				}else
					$isJoinChoirValid = true;
			}			
		
			if( empty($_POST["choiremail"])){
				$emailErr = "Your Email address is required!";
				mytLog("processJoinChoir: Empty email in Choir Form: $emailErr");
				$isJoinChoirValid = false;
			}else{
				$email = formatFormInput($_POST["choiremail"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)){	// validate valid email address
					$emailErr = "Your Email address is invalid! Enter email in format 'name@domain.co.za'!";
					mytLog("processJoinChoir: Invalid email in Choir Form: $emailErr");
					$isJoinChoirValid = false;
				}else
					$isJoinChoirValid = true;
			}
			
			if ( empty($_POST["g-recaptcha-response"]) ){	// Test if captcha response is present
				$isJoinChoirValid = false;
				mytLog("processJoinChoir: Google Captcha Challenge was not completed in choir form");
			}
			
			if( $isJoinChoirValid ){
				$processRetVal = processMytChoir( (string) $name, (string) $tel, (string) $email, $redir );
				if( !$processRetVal ){
					mytLog('processJoinChoir: Could not process Choir form information. Name:"' . $name .
						'", Phone:"' . $tel . '", Email:"' . $email .'"');
					$isJoinChoirValid = false;
				}
			}			
			else
				mytLog("processJoinChoir: Choir form information is incomplete");
		} // end 'Choir' form validation
		
		return $isJoinChoirValid;
	} //end processJoinChoir
	
	function processSkillsAudit( $redir ){
		$processRetVal = false;
		$isSkillsAuditValid = false;
		$isCvUpload = 1;		// oppositely negated with empty(). When skillsfile is empty, there is no CV
		global $cvFileName, $cvTargetfile;
	
		// begin 'Skills Audit' form validation
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if ( empty($_POST["skillsfname"])){
			    $nameErr = "Your First Name is required!";
				mytLog("processSkillsAudit: Empty first name in Skills Audit Form: $nameErr");
				$isSkillsAuditValid = false;
			}else{
				$name = formatFormInput($_POST["skillsfname"]);
				$isSkillsAuditValid = true;
			}
			
			if ( empty($_POST["skillslname"])){
				$lnameErr = "Your Surname is required!";
				mytLog("processSkillsAudit: Empty surname in Skills Audit Form: $lnameErr");
				$isSkillsAuditValid = false;
			}else{
				$lname = formatFormInput($_POST["skillslname"]);
				$isSkillsAuditValid = true;
			}
				
			if ( empty($_POST["skillstel"]) ){
				$telErr = "Your Phone Number is required!";
				mytLog("processSkillsAudit: Empty phone in Skills Audit Form: $telErr");
				$isSkillsAuditValid = false;
			}else{
				$tel = formatFormInput($_POST["skillstel"]);
				if( !validatePhone($tel) ){		// check if a valid phone number was given
					$telErr = "Your Phone Number is invalid! Enter valid Phone Number!";
					mytLog("processSkillsAudit: Invalid phone in Skills Audit Form: $telErr");
					$isSkillsAuditValid = false;
				}else
					$isSkillsAuditValid = true;
			}
	
			if( empty($_POST["skillsemail"])){
				$emailErr = "Your Email address is required!";
				mytLog("processSkillsAudit: Empty email in Skills Audit Form: $emailErr");
				$isSkillsAuditValid = false;
			}else{
				$email = formatFormInput($_POST["skillsemail"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)){	// validate valid email address
					$emailErr = "Your Email address is invalid! Enter email in format 'name@domain.co.za'!";
					mytLog("processSkillsAudit: Invalid email in Skills Audit Form: $emailErr");
					$isSkillsAuditValid = false;
				}else
					$isSkillsAuditValid = true;
			}
			
			if ( empty($_POST["skillsres"])){
				$resErr = "Your Residential Location is required!";
				mytLog("processSkillsAudit: Empty Residential Location in Skills Audit Form: $resErr");
				$isSkillsAuditValid = false;
			}else{
				$resLocat = formatFormInput($_POST["skillsres"]);
				$isSkillsAuditValid = true;
			}
			
			if ( empty($_POST["skillsqual"])){
				$qualErr = "Your Qualification is required! Enter qualification or skills!";
				$isSkillsAuditValid = false;
			}else{
				$qual = $_POST["skillsqual"];
				$isSkillsAuditValid = true;
			}			
				
			if ( empty($_POST["g-recaptcha-response"]) ){	// Test if captcha response is present
				$isSkillsAuditValid = false;
				mytLog("processSkillsAudit: Google Captcha Challenge was not completed in Skills Audit form");
			}
		} // end 'Skills Audit' form validation
		
		// check if CV is uploaded
		if( empty($_FILES["skillsfile"]["name"]) )
			$isCvUpload = 0;
		
		// begin 'Skills Audit' file upload processing if CV is uploaded
		if( $isCvUpload == 1 ){
			global $fileTargetDir, $uploadSizeLimit;
			$checkFileUpload = FALSE;
			$checkFileUpload = is_uploaded_file($_FILES["skillsfile"]["tmp_name"]);	 	// check if file was uploaded
			
			if( $isSkillsAuditValid && $checkFileUpload ){
				$isFileAcceptable = FALSE;
				$fileTarget = $fileTargetDir . basename($_FILES["skillsfile"]["name"]);  // path where file will be stored
				$fileExtenstion = '.' . strtolower(pathinfo($fileTarget,PATHINFO_EXTENSION));
				$fileUploadSize = $_FILES["skillsfile"]["size"];
				
				if( file_exists($fileTarget) ){	 // check if file exists
					mytLog("processSkillsAudit: File with file name '" . $fileTarget . "' already exists");
				}else if( $fileUploadSize > $uploadSizeLimit ){	  // check file size
					mytLog("processSkillsAudit: File with file name '" . $fileTarget . "' is larger than limit." .
							" File size: " . $fileUploadSize);
				}else if( $fileExtenstion != ".pdf" && 
						  $fileExtenstion != ".doc" && 
						  $fileExtenstion != ".docx"){	// check file extension											
					mytLog("processSkillsAudit: File with file name '" . $fileTarget . "' is not PDF or WORD." .
						" File extension is: " . $fileExtenstion); 
				}else{
					// create file with 'name_surname_date' as new file name
					$fileNameCV = $name . "_" . $lname . "_" . date("Y-m-d_h-i-s") . $fileExtenstion;
					$fileTarget = $fileTargetDir . $fileNameCV;
					
					// move file to new directory
					if ( move_uploaded_file($_FILES["skillsfile"]["tmp_name"], $fileTarget) ) {   					
						mytLog("processSkillsAudit: File with file name '" . $fileNameCV . "' has been uploaded");
					}else{
						mytLog("processSkillsAudit: File with file name '" . $fileNameCV . "' could not be uploaded. Error is: " . 
							$_FILES["skillsfile"]["error"]);
						$fileNameCV = "CV Attachment Error";
					}
				}
				clearstatcache(); // clear results of is_uploaded_file() when file WAS uploaded
			}
			clearstatcache(); 	 // clear results of is_uploaded_file() when file WAS NOT uploaded
		} // end if($isCvUpload) - end 'Skills Audit' file upload processing
		
		// insert data into database if all form fields are validated
		if( $isSkillsAuditValid ){	
			$processRetVal = processMytSkills( (string) $name, (string) $lname, (string) $tel, (string) $email,
					(string) $resLocat, $qual, (string) $fileNameCV, (string) $fileTarget, $redir );
			
			if( !$processRetVal ){
				mytLog('processSkillsAudit: Could not process Skills Audit form information. First Name: "' . $name .
					'"; Surname: "' . $lname . '"; Phone: "' . $tel . '"; Email: "' . $email . '"; Resident: "' . 
					$resLocat . '"; Qualification: "' . $qual . '"; CV Name: "' . $fileNameCV . '"');
				$isSkillsAuditValid = false;
			}
		}else
			mytLog("processSkillsAudit: Skills Audit form information is incomplete");
		
		return $isSkillsAuditValid;
	} //end processSkillsAudit
	
	function processGeneralForm( $redir ){
	    $processRetVal = false;
	    $isGeneralValid = false;
	    
	    // begin 'General' form validation
	    if ($_SERVER["REQUEST_METHOD"] == "POST"){
	        if ( empty($_POST["generalname"])){
	            $nameErr = "Your First Name is required!";
	            mytLog("processGeneralForm: Empty first name in General Form: $nameErr");
	            $isGeneralValid = false;
	        }else{
	            $name = formatFormInput($_POST["generalname"]);
	            $isGeneralValid = true;
	        }
	     
	        if ( empty($_POST["generaltel"]) ){
	            $telErr = "Your Phone Number is required!";
	            mytLog("processGeneralForm: Empty phone in General Form: $telErr");
	            $isGeneralValid = false;
	        }else{
	            $tel = formatFormInput($_POST["generaltel"]);
	            if( !validatePhone($tel) ){		// check if a valid phone number was given
	                $telErr = "Your Phone Number is invalid! Enter valid Phone Number!";
	                mytLog("processGeneralForm: Invalid phone in General Form: $telErr");
	                $isGeneralValid = false;
	            }else
	                $isGeneralValid = true;
	        }
	        
	        if( empty($_POST["generalemail"])){
	            $isGeneralValid = true;    // accept empty email address
	        }else{
	            $email = formatFormInput($_POST["generalemail"]);
	            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){	// validate valid email address if not empty
	                $emailErr = "Your Email address is invalid! Enter email in format 'name@domain.co.za'!";
	                mytLog("processGeneralForm: Invalid email in Skills Audit Form: $emailErr");
	                $isGeneralValid = false;
	            }else
	                $isGeneralValid = true;
	        }
	            
            if ( empty($_POST["generalmessage"])){
                $messageErr = "Your chosen newsletter name is required!";
                $isGeneralValid = false;
            }else{
                $message = $_POST["generalmessage"];
                $isGeneralValid = true;
            }	
	        
	        if ( empty($_POST["g-recaptcha-response"]) ){	// Test if captcha response is present
	            $isGeneralValid = false;
	            mytLog("processGeneralForm: Google Captcha Challenge was not completed in Skills Audit form");
	        }
	    } // end 'General Form' form validation
	       
        // insert data into database if all form fields are validated
	    if( $isGeneralValid ){
	        $processRetVal = processMytGeneral( (string) $name, (string) $tel, (string) $email, $message, $redir );
	        if( !$processRetVal ){
	            mytLog('processGeneralForm: Could not process Choir form information. Name:"' . $name .
	                '", Phone:"' . $tel . '", Email:"' . $email .'", Message:"' . $message . '"' );
	            $isGeneralValid = false;
	        }
	    }
	    else
	        mytLog("processGeneralForm: Contact form information is incomplete");
            
            return $isGeneralValid;
	} //end processGeneralForm
	
?>