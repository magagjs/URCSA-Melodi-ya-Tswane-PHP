<?php
	require ("PHPMailer.php");
	require ("SMTP.php");
	require ("Exception.php");
	
	use PHPMailer\SMTP;
	use PHPMailer\PHPMailer;
	use PHPMailer\Exception;
	
	date_default_timezone_set("Africa/Johannesburg");
	echo "current user: ".get_current_user();

echo "\nscript was executed under user: ".exec('whoami');
	
	// get server details
	$webProtocol = ( !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
			|| $_SERVER['SERVER_PORT'] == 443)
			? 'https://' : 'http://';
	$protocalHost = $webProtocol . $_SERVER['HTTP_HOST'];
	
	$fileTargetDir = "../../mytUploads/";	// files directory
	$cvFileName = "No CV Attached";			// default file name for Skills CV
	$cvTargetfile = "No CV Attached";		// default file path for Skills CV when no CV uploaded
	$uploadSizeLimit = 5242880;				// file size limit [5MB]
	$adminUploadSizeLimit = 10485760;		// file size limit-for web(content)master uploads [10MB]	
	$fileUploadTargetDir = "../assets/content/"; // file directory for web(content)

	try {
		// Since the file will be included from website directory, use relative path to load properties file
		$props =  simplexml_load_file(__DIR__ . '/mytProperties.config');
		
		$dbhost = (string) $props->mytHost;
		$dbport = (float) $props->port;	// cast to long data type
		$dbuser = (string) $props->user;
		$dbpass = (string) $props->pass;
		$dbName = (string) $props->db;
		$dbcontacts = (string) $props->contacts;
		$dbmembers = (string) $props->members;
		$dbchoir = (string) $props->choirJoin;
		$dbskills = (string) $props->skillsAudit;
		$dbadminMembers = (string) $props->adminMembers;
		$dbevents = (string) $props->events;
		$mytSendFromEmail = (string) $props->mytSendFrom;
		$mytFullRevEmail = (string) $props->fullrevSend;
		$mytPartRevEmail = (string) $props->partrevSend;
		$mytCaretakerEmail = (string) $props->caretakerSend;
		$mytSecretaryEmail = (string) $props->secretarySend;
		$mytConductorEmail = (string) $props->conductorSend;
		$mytAcadCommitEmail = (string) $props->academicComSend;
		$mytWebAdmin = (string)$props->webadmin;
		$mytCaretaker = (string) $props->caretaker;
		$mytReverend = (string) $props->reverend;
		$mytSecretary = (string) $props->secretary;
		$mytConductor = (string) $props->conductor;
		$mytAcadCommit = (string) $props->academicCom;
		$careParam = (string) $props->forwardCaretakerParam;
		$revParam = (string) $props->forwardRevParam;
		$secretarParam = (string) $props->forwardSecretaryParam;
		$conductParam = (string) $props->forwardConductorParam;
		$acadCommParam = (string) $props->forwardAcadLeadParam;
		$reqTypeParam = (string) $props->forwardReqParam;
		$joinTypeParam = (string) $props->forwardJoinParam;
		$choirTypeParam = (string) $props->forwardChoirParam;
		$acadTypeParam = (string) $props->forwardAcadComParam;
		$logFile = (string) $props->logFile;
		$logFileExt = (string) $props->logFileExt;
		$errPageRedir = (string) $props->errorPage;
		$mailForwardRedir = $props->mailForwardPage;

		echo "\nlogFile: ". $logFile;
		echo "\nlogFileExt: ". $logFileExt;
		echo "\nerrPageRedir: ". $errPageRedir;
		echo "\ndbhost: ". $dbhost;
		echo "\ndbuser: ". $dbuser;

		//exit();


	} catch (Exception $e) {
		$e->getMessage();
		// log errors/before setting error function
		$logFileDate = date("j-m-Y");
		$logFileDir = "../../logs/";
		$logFileExt = ".log";
		$logFileName = "$logFileDir" . "myt_" . "$logFileDate$logFileExt";
		// log all errors and warnings to log file
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);	//////////	PROD: SET TO FALSE ////////////////////
		ini_set('log_errors', TRUE);
		ini_set('error_log', $logFileName);
		header('Location: ' . $protocalHost . '../html/mytchurch.co.za/errorPage.php');
		exit();
	}
	
	// prepare log file 
	$logFileDate = date("j-m-Y");
	$logFileDir = "$logFile";
	$logFileExt = "$logFileExt";
	$logFileName = "$logFileDir" . "myt_" . "$logFileDate$logFileExt";
	// log all errors and warnings to log file
	error_reporting(E_ALL);
	ini_set('display_errors', FALSE);	//////////	PROD: SET TO FALSE ////////////////////
	ini_set('log_errors', TRUE);
	ini_set('error_log', $logFileName);
	
	$errorRedirect = $protocalHost . $errPageRedir;
	
	function processMytGeneral( $iName, $iPhone, $iEmail, $iMessage, $forwardUrl ) {
	    global $dbhost, $dbuser, $dbpass, $dbName, $dbcontacts, $errorRedirect;
	    $dbSuccess = false;
	    $mailSuccess = false;
	    
	    try {
	        $dbInsertLog = 'processMytGeneral: Attempting Insert into "' . $dbcontacts . '". Name="' . $iName .
	        '", Phone="' . $iPhone . '", Email="' . $iEmail . '", Message="' . $iMessage . '"';
	        mytLog($dbInsertLog);
	        $dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbName);
	        
	        if($dblink->connect_errno){
	            $dbLinkError = 'Failed connection: (' . $dblink->connect_errno . ') '. $dblink->connect_error;
	            mytLog('processMytGeneral: Db connection error', $dbLinkError);
	            header('Location: ' . $errorRedirect);
	            exit();
	        }
	        
	        $formToken = randToken();	// create new token
	        $iToken = uniqueToken( $formToken, $dblink, $dbcontacts );	// find unique random Token
	        if( empty($iToken) ){
	            $iToken = $formToken;	// in case uniqueToken() fails
	            mytLog('processMytGeneral: Contact us Token: ' . $iToken);
	        }
	        
	        // prepared statement for general
	        $prepStmt = $dblink->prepare("INSERT INTO " . $dbcontacts . " (name,phone,email,message,token)" .
	            "values (?,?,?,?,?)");
	        if( !$prepStmt ){
	            $dbPrepError = 'Failed prepare: (' . $dblink->errno . ') ' . $dblink->error;
	            mytLog('processMytGeneral: Db Prepared Statement Error', $dbPrepError);
	            header('Location: ' . $errorRedirect);
	            exit();
	        }
	        
	        // bind params
	        if( !$prepStmt->bind_param('sssss', $iName, $iPhone, $iEmail, $iMessage, $iToken) ){
	            $dbBindError = 'Failed to bind params: (' . $dblink->errno . ') ' . $dblink->error;
	            mytLog('processMytGeneral: Db Bind Parameters Error', $dbBindError);
	            header('Location: ' . $errorRedirect);
	            exit();
	        }
	        
	        //execute prepared statement with bound params
	        if( !$prepStmt->execute() ){
	            $dbExecuteError = 'Failed to execute: (' . $dblink->errno . ') ' . $dblink->error;
	            mytLog('processMytGeneral: Db Execute Error',$dbExecuteError);
	            header('Location: ' . $errorRedirect);
	            exit();
	        }else{
	            mytLog('processMytGeneral: Db Insert into ' . $dbcontacts . ' successfull!');
	            $dbSuccess = true;
	        }
	        
	        // close prepared statement and db connection
	        $prepStmt->close();
	        $dblink->close();
	        
	        if( $dbSuccess ){
	            $mailRetVal = sendGeneralMail( $iName, $iPhone, $iEmail, $iMessage,
	                $iToken, $forwardUrl );
	            if( $mailRetVal ){
	                $mailSendLog = 'processMytGeneral: Contact us Mail sent! Name="' . $iName . '", Phone="' .
	   	                $iPhone . '", Email="' . $iEmail . '", Message="' . $iMessage . '", Token="' . $iToken . '"';
	   	                mytLog($mailSendLog);
	   	                
	   	                $mailSuccess = true;
	            }
	        }
	    } catch (Exception $e) {
	        mytLog('processMytGeneral: Exception in processMytGeneral', $e->getMessage());
	        header('Location: ' . $errorRedirect);
	        exit();
	    }
	    
	    return $mailSuccess;
	} // end processMytGeneral()
	
	function processMytContact( $iName, $iPhone, $iEmail, $iMessage, $forwardUrl ) {
		global $dbhost, $dbuser, $dbpass, $dbName, $dbcontacts, $errorRedirect;
		$dbSuccess = false;
		$mailSuccess = false;
				
		try {
			$dbInsertLog = 'processMytContact: Attempting Insert into "' . $dbcontacts . '". Name="' . $iName . 
				'", Phone="' . $iPhone . '", Email="' . $iEmail . '", Message="' . $iMessage . '"';
			mytLog($dbInsertLog);
			$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbName);
			
			if($dblink->connect_errno){
				$dbLinkError = 'Failed connection: (' . $dblink->connect_errno . ') '. $dblink->connect_error;
				mytLog('processMytContact: Db connection error', $dbLinkError);
				header('Location: ' . $errorRedirect);
				exit();
			}
			
			$formToken = randToken();	// create new token
			$iToken = uniqueToken( $formToken, $dblink, $dbcontacts );	// find unique random Token
			if( empty($iToken) ){
				$iToken = $formToken;	// in case uniqueToken() fails
				mytLog('processMytContact: Contact us Token: ' . $iToken);
			}
								
			// prepared statement for contact us
			$prepStmt = $dblink->prepare("INSERT INTO " . $dbcontacts . " (name,phone,email,message,token)" .
					"values (?,?,?,?,?)");
			if( !$prepStmt ){
				$dbPrepError = 'Failed prepare: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytContact: Db Prepared Statement Error', $dbPrepError);
				header('Location: ' . $errorRedirect);
				exit();
			}
			
			// bind params
			if( !$prepStmt->bind_param('sssss', $iName, $iPhone, $iEmail, $iMessage, $iToken) ){
				$dbBindError = 'Failed to bind params: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytContact: Db Bind Parameters Error', $dbBindError);
				header('Location: ' . $errorRedirect);
				exit();
			}
			
			//execute prepared statement with bound params
			if( !$prepStmt->execute() ){
				$dbExecuteError = 'Failed to execute: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytContact: Db Execute Error',$dbExecuteError);
				header('Location: ' . $errorRedirect);
				exit();
			}else{
				mytLog('processMytContact: Db Insert into ' . $dbcontacts . ' successfull!');
				$dbSuccess = true;
			}
			
			// close prepared statement and db connection
			$prepStmt->close();
			$dblink->close();
			
			if( $dbSuccess ){
				$mailRetVal = sendRequestMail( $iName, $iPhone, $iEmail, $iMessage, 
							$iToken, $forwardUrl );
				if( $mailRetVal ){
					$mailSendLog = 'processMytContact: Contact us Mail sent! Name="' . $iName . '", Phone="' . 
							$iPhone . '", Email="' . $iEmail . '", Message="' . $iMessage . '", Token="' . $iToken . '"';
					mytLog($mailSendLog);
					
					$mailSuccess = true;
				}
			}
									
		} catch (Exception $e) {
			mytLog('processMytContact: Exception in processMytContact', $e->getMessage());
			header('Location: ' . $errorRedirect);
			exit();
		}
	
		return $mailSuccess;
	}
	
	function processMytJoin( $jName, $jPhone, $jEmail, $forwardUrl) {
		global $dbhost, $dbuser, $dbpass, $dbName, $dbmembers, $errorRedirect, $dbport;
		$dbSuccess = false;
		$mailSuccess = false;
				
		try {
			$dbInsertLog = 'processMytJoin: Attempting Insert into "' . $dbmembers . '". Name="' . $jName .
				'", Phone="' . $jPhone . '", Email="' . $jEmail . '"';
			mytLog($dbInsertLog);
			$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbName, $dbport);
			
			if($dblink->connect_errno){
				$dbLinkError = 'Failed connection: (' . $dblink->connect_errno . ') '. $dblink->connect_error;
				mytLog('processMytJoin: Db connection error', $dbLinkError);
				//header('Location: ' . $errorRedirect);
				exit();
			}
						
			$formToken = randToken();	
			$jToken = uniqueToken( $formToken, $dblink, $dbmembers );	
			if( empty($jToken) ){
				$jToken = $formToken;	
				mytLog('processMytJoin: Join Myt Token: ' . $jToken);
			}			
			
			$prepStmt = $dblink->prepare("INSERT INTO " . $dbmembers . "(name,phone,email,token)" .
					"values (?,?,?,?)");
			if( !$prepStmt ){
				$dbPrepError = 'Failed prepare: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytJoin: Db Prepared Statement Error', $dbPrepError);
				//header('Location: ' . $errorRedirect);
				exit();
			}
						
			if( !$prepStmt->bind_param('ssss', $jName, $jPhone, $jEmail, $jToken) ){
				$dbBindError = 'Failed to bind params: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytJoin: Db Bind Parameters Error', $dbBindError);
				//header('Location: ' . $errorRedirect);
				exit();
			}
						
			if( !$prepStmt->execute() ){
				$dbExecuteError = 'Failed to execute: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytJoin: Db Execute Error',$dbExecuteError);
				//header('Location: ' . $errorRedirect);
				exit();
			}else{
				mytLog('Db Insert into ' . $dbmembers . ' successfull!');
				$dbSuccess = true;
			}
			
			$prepStmt->close();
			$dblink->close();
			
			if( $dbSuccess ){
				$mailRetVal = sendJoinMail( $jName, $jPhone, $jEmail, $jToken, $forwardUrl );
				if( $mailRetVal ){
					$mailSendLog = 'processMytJoin: Contact us Mail sent! Name="' . $jName . '", Phone="' .
							$jPhone . '", Email="' . $jEmail . '", Token="' . $jToken . '"';
					mytLog($mailSendLog);	
									
					$mailSuccess = true;
				}
			}
			
		} catch (Exception $e) {
			mytLog('processMytJoin: Exception in processMytJoin', $e->getMessage());
			//header('Location: ' . $errorRedirect);
			exit();
		}
		
		return $mailSuccess;
	}
	
	function processMytChoir( $cName, $cPhone, $cEmail, $forwardUrl ) {
		global $dbhost, $dbuser, $dbpass, $dbName, $dbchoir, $errorRedirect;	
		$dbSuccess = false;
		$mailSuccess = false;
				
		try {
			$dbInsertLog = 'processMytChoir: Attempting Insert into "' . $dbchoir . '". Name="' . $cName .
				'", Phone="' . $cPhone . '", Email="' . $cEmail . '"';
			mytLog($dbInsertLog);
			$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbName);
			
			$formToken = randToken();	
			$cToken = uniqueToken( $formToken, $dblink, $dbchoir );	
			if( empty($cToken) ){
				$cToken = $formToken;
				mytLog('Join Myt Token: ' . $cToken);
			}
			
			if($dblink->connect_errno){
				$dbLinkError = 'Failed connection: (' . $dblink->connect_errno . ') '. 
					$dblink->connect_error;
				mytLog('processMytChoir: Db connection error', $dbLinkError);
				header('Location: ' . $errorRedirect);
				exit();
			}
			
			$prepStmt = $dblink->prepare("INSERT INTO " . $dbchoir . "(name,phone,email,token)" .
					"values (?,?,?,?)");
			if( !$prepStmt ){
				$dbPrepError = 'Failed prepare: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytChoir: Db Prepared Statement Error', $dbPrepError);
				header('Location: ' . $errorRedirect);
				exit();
			}
						
			if( !$prepStmt->bind_param('ssss', $cName, $cPhone, $cEmail, $cToken ) ){
				$dbBindError = 'Failed to bind params: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytChoir: Db Bind Parameters Error', $dbBindError);
				header('Location: ' . $errorRedirect);
				exit();
			}
						
			if( !$prepStmt->execute() ){
				$dbExecuteError = 'Failed to execute: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytChoir: Db Execute Error',$dbExecuteError);
				header('Location: ' . $errorRedirect);
				exit();
			}else{ 
				mytLog('processMytChoir: Db Insert into ' . $dbchoir . ' successfull!');
				$dbSuccess = true;
			}
			
			$prepStmt->close();
			$dblink->close();
			
			if( $dbSuccess ){
				$mailRetVal = sendChoirMail( $cName, $cPhone, $cEmail, $cToken, $forwardUrl );
				if( $mailRetVal ){
					$mailSendLog = 'processMytChoir: Contact us Mail sent! Name="' . $cName . '", Phone="' .
							$cPhone . '", Email="' . $cEmail . '", Token="' . $cToken . '"';
					mytLog($mailSendLog);
										
					$mailSuccess = true;
				}
			}
				
		} catch (Exception $e) {
			mytLog('processMytChoir: Exception in processMytChoir', $e->getMessage());
			header('Location: ' . $errorRedirect);
			exit();
		}
				
		return $mailSuccess;
	}
	
	function processMytSkills( $sName, $sLName, $sPhone, $sEmail, $sLocat, $sQual, $sFileNameCV, 
			$sFilePathCV, $forwardUrl ) {
		global $dbhost, $dbuser, $dbpass, $dbName, $dbskills, $errorRedirect;
		$dbSuccess = false;
		$mailSuccess = false; 		
	
		try {
			$dbInsertLog = 'processMytSkills: Attempting Insert into "' . $dbskills . '". FirstName="' . $sName . 
					'"; Surname="' . $sLName . '"; Phone="' . $sPhone . '"; Email="' . $sEmail . '"; Location="' . 
					$sLocat . '"; Qualification="' . $sQual . '"; CV Name="' . $sFileNameCV . '"';
			mytLog($dbInsertLog);
			$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbName);
				
			$formToken = randToken();
			$cToken = uniqueToken( $formToken, $dblink, $dbskills );
			if( empty($cToken) ){
				$cToken = $formToken;
				mytLog('Skills Audit Token: ' . $cToken);
			}
				
			if($dblink->connect_errno){
				$dbLinkError = 'Failed connection: (' . $dblink->connect_errno . ') '.
						$dblink->connect_error;
				mytLog('processMytSkills: Db connection error', $dbLinkError);
				header('Location: ' . $errorRedirect);
				exit();
			}
				
			$prepStmt = $dblink->prepare("INSERT INTO " . $dbskills . "(name,surname,phone,email,resident,qualification,cv_name,cv_attach,token)" .
					"values (?,?,?,?,?,?,?,?,?)");
			if( !$prepStmt ){
				$dbPrepError = 'Failed prepare: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytSkills: Db Prepared Statement Error', $dbPrepError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->bind_param('sssssssss', $sName, $sLName, $sPhone, $sEmail, $sLocat, $sQual, $sFileNameCV, $sFilePathCV, $cToken ) ){
				$dbBindError = 'Failed to bind params: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytSkills: Db Bind Parameters Error', $dbBindError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->execute() ){
				$dbExecuteError = 'Failed to execute: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytSkills: Db Execute Error',$dbExecuteError);
				header('Location: ' . $errorRedirect);
				exit();
			}else{
				mytLog('processMytSkills: Db Insert into ' . $dbskills . ' successfull!');
				$dbSuccess = true;
			}
				
			$prepStmt->close();
			$dblink->close();
				
			if( $dbSuccess ){  
				$mailRetVal = sendSkillsMail( $sName, $sLName, $sPhone, $sEmail, $sLocat, $sQual, $sFileNameCV, 
					$sFilePathCV, $cToken, $forwardUrl );
				if( $mailRetVal ){
					$mailSendLog = 'processMytSkills: Skills Audit Mail sent! First Name="' . $sName . '"; Surname="' .
							$sLName . '"; Phone="' . $sPhone . '"; Email="' . $sEmail . '"; Location="' . $sLocat . 
							'", Qualification="' . $sQual . '"; CV File Name="' . $sFileNameCV . '"; CV File Path="' . 
							$sFilePathCV . '"; Token="' . $cToken . '"';
					mytLog($mailSendLog);
					$mailSuccess = true;
				}
			}
	
		} catch (Exception $e) {
			mytLog('processMytSkills: Exception in processMytSkills', $e->getMessage());
			header('Location: ' . $errorRedirect);
			exit();
		}
	
		return $mailSuccess;
	}	
	
	// send Mail to MyT Admin - WITHOUT attachment
	function sendMytEmail( $recipient, $subject, $message, $header ){
		$isEmailSend = false;
		global $mytSendFromEmail, $errorRedirect;
		try {
			ini_set('sendmail_from', "$mytSendFromEmail");	// MyT hosting did not set this in php.ini
				
			date_default_timezone_set("UTC");
			if ( mail($recipient, $subject, $message, $header) ){
				$isEmailSend = true;
				mytLog('sendMytEmail: Mail sent to "' . $recipient . '" with subject "' . $subject . '"');
			}else
				mytLog('sendMytEmail: Mail NOT sent to "' . $recipient . '" with subject "' . $subject . '"');
		} catch (Exception $e) {
			mytLog('sendMytEmail: Exception in sendMytEmail', $e->getMessage());
			header('Location: ' . $errorRedirect);
			exit();
		}
		return $isEmailSend;
	}
	
	// send Mail to MyT Admin - WITH attachment
	function sendMytEmailAttach( $recipient, $subject, $message, $replyTo, $attachFile ){	
		$isEmailSend = false;
		global $mytSendFromEmail, $errorRedirect;
		try {
			ini_set('sendmail_from', "$mytSendFromEmail");	// MyT hosting did not set this in php.ini
			date_default_timezone_set("UTC");
			
			// setup PHPMailer
			$sendMailAttach = new PHPMailer();
			$sendMailAttach->isHTML(true);
			$sendMailAttach->SetFrom( $mytSendFromEmail );
			$sendMailAttach->AddAddress($recipient);
			$sendMailAttach->addReplyTo($mytSendFromEmail);
			$sendMailAttach->Subject = $subject;
			$sendMailAttach->Body = $message;
			$sendMailAttach->addAttachment($attachFile);
			
			if ( $sendMailAttach->send() ){
				$isEmailSend = true;
				mytLog('sendMytEmailAttach: Mail sent to "' . $recipient . '" with subject "' . $subject . '"');
			}else
				mytLog('sendMytEmailAttach: Mail NOT sent to "' . $recipient . '" with subject "' . $subject . '"');
		} catch (Exception $e) {
			mytLog('sendMytEmailAttach: Exception in sendMytEmailAttach', $e->getMessage());
			header('Location: ' . $errorRedirect);
			exit();
		}
		return $isEmailSend;
	}
	
	function sendGeneralMail( $nameForm, $telForm, $emailForm, $messageForm, $token, $redirectUrl ){	// General Form
	    global $mytSendFromEmail;
	    
	    // setup mail
	    $subjectField = 'MyT Website: New Competition Entry Submitted';                   // Change here as required: TO-DO->Use XML
	    $messageField = '<p>Dear MyT Admin</p>';
	    $messageField .= '<p>A competition entry has been submitted via the MyT Church website. The details are below:</p>';
	    $messageField .= "<p>Name of contact: <strong>$nameForm</strong></p>";
	    $messageField .= "<p>Phone Number of contact: <strong>$telForm</strong></p>";
	    $messageField .= "<p>Email Address of contact: <strong>$emailForm</strong></p>";
	    $messageField .= "<p>Newsletter Name: <strong>$messageForm</strong></p><br>";      // Change here as required: TO-DO->Use XML
	    $messageField .= "<p>Kind regards</p><p>MyT Church Website</p>";
	    $headerField = "From:$mytSendFromEmail \r\n";
	    $headerField .= "MIME-Version: 1.0\r\n";
	    $headerField .= "Content-type: text/html; charset=UTF-8\r\n";
	    
	    return sendMytEmail($mytSendFromEmail, $subjectField, $messageField, $headerField);
	}
	
	function sendRequestMail( $nameForm, $telForm, $emailForm, $messageForm, $token, $redirectUrl ){	// Contact us
		global $mytSendFromEmail, $mytCaretaker, $mytReverend, $mytSecretary, $careParam,
			$revParam, $reqTypeParam, $secretarParam;
		$urlCareParams = "tok=" . urlencode($token) . "&sel=" . urlencode($careParam) . "&type=" . urlencode($reqTypeParam);
		$urlRevParams = "tok=" . urlencode($token) . "&sel=" .urlencode($revParam) . "&type=" . urlencode($reqTypeParam);
		$urlSecParams = "tok=" . urlencode($token) . "&sel=" . urlencode($secretarParam) . "&type=" . urlencode($reqTypeParam);
		$forwardCareUrl = "$redirectUrl/scripts/mytForwarding.php?" . $urlCareParams;
		$forwardRevUrl = "$redirectUrl/scripts/mytForwarding.php?" . $urlRevParams;
		$forwardSecUrl = "$redirectUrl/scripts/mytForwarding.php?" . $urlSecParams;
				
		// setup mail
		$subjectField = 'MyT Website: New message submmitted';
		$messageField = '<p>Dear MyT Admin</p>';
		$messageField .= '<p>A message has been posted via the MyT Church website. The details are below:</p>';
		$messageField .= "<p>Name of contact: <strong>$nameForm</strong></p>";
		$messageField .= "<p>Phone Number of contact: <strong>$telForm</strong></p>";
		$messageField .= "<p>Email Address of contact: <strong>$emailForm</strong></p>";
		$messageField .= "<p>Message from contact: <strong>$messageForm</strong></p><br>";
		$messageField .= "<p>Please verify if the above details are not a result of spam emailing and attend to the request.</p>";
		$messageField .= "<p>If this message needs the attention of <strong>$mytCaretaker</strong> you can forward it to";
		$messageField .= " <strong>$mytCaretaker</strong> by clicking <a href=\"$forwardCareUrl\">here</a>.</p>";
		$messageField .= "<p>If this message needs the attention of <strong>$mytReverend</strong>, you can forward it to";
		$messageField .= " <strong>$mytReverend</strong> by clicking <a href=\"$forwardRevUrl\">here</a>.</p>";
		$messageField .= "<p>If this message needs the attention of <strong>$mytSecretary</strong>, you can forward it to";
		$messageField .= " <strong>$mytSecretary</strong> by clicking <a href=\"$forwardSecUrl\">here</a>.</p>";
		$messageField .= "<p>Kind regards</p><p>MyT Church Website</p>";
		$headerField = "From:$mytSendFromEmail \r\n";
		$headerField .= "MIME-Version: 1.0\r\n";
		$headerField .= "Content-type: text/html; charset=UTF-8\r\n";
		
		return sendMytEmail($mytSendFromEmail, $subjectField, $messageField, $headerField);
	}
	
	function sendJoinMail( $nameForm, $telForm, $emailForm, $token, $redirectUrl ){		// Join us
		global $mytSendFromEmail, $mytReverend, $revParam, $joinTypeParam;
		$urlParams = "tok=" . urlencode($token) . "&sel=" . urlencode($revParam) . "&type=" . urlencode($joinTypeParam);
		$forwardUrl = "$redirectUrl/scripts/mytForwarding.php?" . $urlParams;
				
		// setup mail
		$subjectField = 'MyT Website: New Member Request';
		$messageField = '<p>Dear MyT Admin</p>';
		$messageField .= '<p>A new member has requested to join Melodi ya Tshwane via the MyT Church website. The details are below:</p>';
		$messageField .= "<p>Name of contact: <strong>$nameForm</strong></p>";
		$messageField .= "<p>Phone Number of contact: <strong>$telForm</strong></p>";
		$messageField .= "<p>Email Address of contact: <strong>$emailForm</strong></p><br>";
		$messageField .= "<p>Please verify if the above details are not a result of spam emailing and forward this email";
		$messageField .= " to <strong>$mytReverend</strong> by clicking <a href=\"$forwardUrl\">here</a>.</p>";	
		$messageField .= "<p>Kind regards</p><p>MyT Church Website</p>";
		$headerField = "From:$mytSendFromEmail \r\n";
		$headerField .= "MIME-Version: 1.0\r\n";
		$headerField .= "Content-type: text/html; charset=UTF-8\r\n";
	
		return sendMytEmail($mytSendFromEmail, $subjectField, $messageField, $headerField);
	}
	
	function sendChoirMail( $nameForm, $telForm, $emailForm, $token, $redirectUrl ){		// Join Choir
		global $mytSendFromEmail, $mytConductor, $conductParam, $choirTypeParam;
		$urlParams = "tok=" . urlencode($token) . "&sel=" . urlencode($conductParam) . "&type=" . urlencode($choirTypeParam);
		$forwardUrl = "$redirectUrl/scripts/mytForwarding.php?" . $urlParams;
		
		// setup mail
		$subjectField = 'MyT Website: New Choir Member Request';
		$messageField = '<p>Dear MyT Admin</p>';
		$messageField .= '<p>A new member has requested to join Melodi ya Tshwane Choir via the MyT Church website. The details are below:</p>';
		$messageField .= "<p>Name of contact: <strong>$nameForm</strong></p>";
		$messageField .= "<p>Phone Number of contact: <strong>$telForm</strong></p>";
		$messageField .= "<p>Email Address of contact: <strong>$emailForm</strong></p><br>";
		$messageField .= "<p>Please verify if the above details are not a result of spam emailing and forward this email";
		$messageField .= " to <strong>$mytConductor</strong> by clicking <a href=\"$forwardUrl\">here</a>.</p>";
		$messageField .= "<p>Kind regards</p><p>MyT Church Website</p>";
		$headerField = "From:$mytSendFromEmail \r\n";
		$headerField .= "MIME-Version: 1.0\r\n";
		$headerField .= "Content-type: text/html; charset=UTF-8\r\n";
	
		return sendMytEmail($mytSendFromEmail, $subjectField, $messageField, $headerField);
	}
	
	function sendSkillsMail( $sName, $sLName, $sPhone, $sEmail, $sLocat, $sQual, $sFileNameCV,
			$sFilePathCV, $sToken, $forwardUrl ){		// Skills Audit
		global $mytSendFromEmail, $mytAcadCommit, $acadCommParam, $acadTypeParam, $cvFileName, $cvTargetfile;
		$urlParams = "tok=" . urlencode($sToken) . "&sel=" . urlencode($acadCommParam) . "&type=" . urlencode($acadTypeParam);
		$forwardUrl = "$forwardUrl/scripts/mytForwarding.php?" . $urlParams;
	
		$subjectField = 'MyT Website: New Skills Audit Member';
		$messageField = '<p>Dear MyT Webmasters</p>';
		$messageField .= '<p>A congregation member has uploaded a skill for skills audit via the MyT Church website. The details are below:</p>';
		$messageField .= "<p>First Name: <strong>$sName</strong></p>";
		$messageField .= "<p>Surname: <strong>$sLName</strong></p>";
		$messageField .= "<p>Phone Number: <strong>$sPhone</strong></p>";
		$messageField .= "<p>Email Address: <strong>$sEmail</strong></p>";
		$messageField .= "<p>Residential Location: <strong>$sLocat</strong></p>";
		$messageField .= "<p>Qualification/Skills: <strong>$sQual</strong></p>";
		
		if( ($sFileNameCV != $cvFileName) || ($sFilePathCV != $cvTargetfile) ){
			$messageField .= "<p>File Name of CV: <strong>$sFileNameCV</strong></p>";
			$messageField .= "<p>Please verify if the above details are not a result of spam emailing and " . 
				"also verify if the file attached is a real CV in PDF or DOC format and then forward this email" . 
				" to the <strong>$mytAcadCommit</strong> by clicking <a href=\"$forwardUrl\">here</a>.</p>";
		}else{
			$messageField .= "<p>Please verify if the above details are not a result of spam emailing and forward this email";
			$messageField .= " to the <strong>$mytAcadCommit</strong> by clicking <a href=\"$forwardUrl\">here</a>.</p>";
		}
		
		$messageField .= "<p>Kind regards</p><p>MyT Church Website</p>";
	
		return sendMytEmailAttach($mytSendFromEmail, $subjectField, $messageField, $mytSendFromEmail, $sFilePathCV, $sToken);
	}
	
	// format input by trimming whitespaces, stripping quotes and special html characters
	function formatFormInput($formInput){
		$formattedInput = '';
		$formattedInput = trim($formInput);
		$formattedInput = stripslashes($formInput);
		$formattedInput = htmlspecialchars($formInput);
	
		return $formattedInput;
	}
	
	// validate if phone number is digits only and 10 numbers only
	function validatePhone($phoneNumber){
		$isPhone = false;
		$phoneNumber = str_replace(' ', '', $phoneNumber);
		$phonelength = strlen($phoneNumber);
	
		if ( !preg_match('/[[:alpha:]]/i', $phoneNumber, $matches)
				&& $phonelength == 10 ){
			// check if all input is digits
			if(ctype_digit($phoneNumber))
				$isPhone = true;
		}
	
		return $isPhone;
	}
	
	function randToken(){
		$tokenSet = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$tokenResult = '';
		for($i=0; $i<45; $i++)
			$tokenResult .= $tokenSet[mt_rand(0,61)];
	
		return $tokenResult;
	}

	// shorter token for file uploads
	function randFileUploadToken(){
		$tokenSet = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$tokenResult = '';
		for($i=0; $i<6; $i++)
			$tokenResult .= $tokenSet[mt_rand(0,61)];
	
		return $tokenResult;
	}
	
	// generate unique token while new token is a duplicate token
	function uniqueToken( $generatedToken, $linkName, $tblName ){
		$newToken = $generatedToken;	// new token is initially equal to generated token
		$existToken = getDuplicateToken($generatedToken, $linkName, $tblName);
		
 		if ( !empty($existToken) ){
 			// if existing token is equal to generated token-generate a new token
 			if ( $existToken == $generatedToken ){
 				$newToken = randToken();
 				// keep generating a new token until new token is not equal to existing token
				while ( $newToken == $existToken ){
					$newToken = randToken();
				}
 			}
		}
	
		return $newToken;
	}
	
	function getDuplicateToken ( $generatedToken, $linkName, $tblName){
		global $errorRedirect;
		$tokenExist = '';
		$tokenRetVal = '';
	
		try{
			$prepStmt = $linkName->prepare("SELECT token from " . $tblName . " where token=? LIMIT 1;");
			if( !$prepStmt ){
				$dbPrepError = 'getDuplicateToken: Failed prepare: (' . $linkName->errno . ') ' . $linkName->error;
				mytLog('getDuplicateToken: Db Prepared Statement Error', $dbPrepError);
				header('Location: ' . $errorRedirect);
				exit();
			}
				
			if( !$prepStmt->bind_param('s', $generatedToken ) ){
				$dbBindError = 'getDuplicateToken: Failed Bind Params: (' . $linkName->errno . ') ' . $linkName->error;
				mytLog('getDuplicateToken: Db Bind Params Error', $dbBindError);	
				header('Location: ' . $errorRedirect);
				exit();
			}
				
			if( !$prepStmt->execute() ){
				$dbExecuteError = 'getDuplicateToken: Failed Execute: (' . $linkName->errno . ') ' . $linkName->error;
				mytLog('getDuplicateToken: Db Execute Error', $dbExecuteError);	
				header('Location: ' . $errorRedirect);
				exit();
			}
				
			if( !$prepStmt->bind_result($tokenExist) ){
				$dbBindError = 'getDuplicateToken: Failed Bind Results: (' . $linkName->errno . ') ' . $linkName->error;
				mytLog('getDuplicateToken: Db Bind Results Error', $dbBindError);
				header('Location: ' . $errorRedirect);
				exit();						
			}
		
			if( $prepStmt->fetch() == false ){
				mytLog('getDuplicateToken: No Results to fetch for token: ' . $generatedToken);
				$tokenRetVal = $tokenExist;
			}else if( $prepStmt->fetch() == null ){
				$dbFetchError = 'Failed to fetch result(Null results): (' . 
					$linkName->errno . ') ' . $linkName->error;
				mytLog('getDuplicateToken: Db Prepared Statement Error', $dbFetchError);				
			}else
				$tokenRetVal = $tokenExist;
		
			$prepStmt->close();
		} catch (Exception $e) {
			mytLog('getDuplicateToken: Exception in getDuplicateToken', $e->getMessage());
			header('Location: ' . $errorRedirect);
			exit();
		}
	
		return $tokenRetVal;
	}
	
	// get contact us request details using Token
	function reqByToken ( $reqToken ){
		global $dbhost, $dbuser, $dbpass, $dbName, $dbcontacts, $errorRedirect;
		$reqInfo = array();
		
		try{
			$dbSelectLog = 'processMytJoin: Attempting Select from ' . $dbcontacts . 
				' for token=' . $reqToken;
			mytLog($dbSelectLog);
			
			$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbName);
			if($dblink->connect_errno){
				$dbLinkError = 'Failed connection: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('reqByToken: Db Connection Error', $dbLinkError);
				header('Location: ' . $errorRedirect);
				exit();
			}
			
			$prepStmt = $dblink->prepare("SELECT name, phone, email, message from " . $dbcontacts . " where token=? LIMIT 1");
			if( !$prepStmt ){
				$dbPrepError = 'Failed prepare: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('reqByToken: Db Prepared Statement Error', $dbPrepError);
				header('Location: ' . $errorRedirect);
				exit();
			}
				
			if( !$prepStmt->bind_param('s', $reqToken ) ){
				$dbBindError = 'Failed Bind Params: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('reqByToken: Db Bind Params Error', $dbBindError);
				header('Location: ' . $errorRedirect);
				exit();
			}
				
			if( !$prepStmt->execute() ){
				$dbExecuteError = 'Failed Execute: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('reqByToken: Db Execute Error', $dbExecuteError);
				header('Location: ' . $errorRedirect);
				exit();
			}
			
			if( !$prepStmt->store_result() ){
				$dbStoreError = 'Failed Store Resuts: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('reqByToken: Db Store Results Error', $dbStoreError);
				header('Location: ' . $errorRedirect);
				exit();
			}
		
			if( !$prepStmt->bind_result( $resultArray['name'], $resultArray['phone'], $resultArray['email'], 
						$resultArray['message'] ) ){
				$dbBindError = 'Failed Bind Resuts: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('reqByToken: Db Bind Results Error', $dbBindError);
				header('Location: ' . $errorRedirect);
				exit();
			}
					
			// fetch and store results in array
			if( $prepStmt->fetch() == false )
				mytLog('reqByToken: No Results to fetch for token: ' . $reqToken);
			else{
				foreach( $resultArray as $key=>$value ){
					$reqInfo[$key]=$value;
				}
			}
		
			$prepStmt->free_result();
			$prepStmt->close();
			$dblink->close();
		} catch (Exception $e) {
			mytLog('reqByToken: Exception in reqByToken', $e->getMessage());
			header('Location: ' . $errorRedirect);
			exit();
		}
	
		return $reqInfo;
	}
	
	// get join myt request details using Token
	function joinMytByToken ( $reqToken ){
		global $dbhost, $dbuser, $dbpass, $dbName, $dbmembers, $errorRedirect;
		$joinInfo = array();
	
		try{
			$dbSelectLog = 'joinMytByToken: Attempting Select from ' . $dbmembers .
				' for token=' . $reqToken;
			mytLog($dbSelectLog);
						
			$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbName);
			if($dblink->connect_errno){
				$dbLinkError = 'Failed connection: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('joinMytByToken: Db Connection Error', $dbLinkError);
				header('Location: ' . $errorRedirect);
				exit();
			}
				
			$prepStmt = $dblink->prepare("SELECT name, phone, email from " . $dbmembers . " where token=? LIMIT 1");
			if( !$prepStmt ){
				$dbPrepError = 'Failed prepare: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('joinMytByToken: Db Prepared Statement Error', $dbPrepError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->bind_param('s', $reqToken ) ){
				$dbBindError = 'Failed Bind Params: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('joinMytByToken: Db Bind Params Error', $dbBindError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->execute() ){
				$dbExecuteError = 'Failed Execute: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('joinMytByToken: Db Execute Error', $dbExecuteError);
				header('Location: ' . $errorRedirect);
				exit();
			}
				
			if( !$prepStmt->store_result() ){
				$dbStoreError = 'Failed Store Resuts: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('joinMytByToken: Db Store Results Error', $dbStoreError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->bind_result( $resultArray['name'], $resultArray['phone'], 
						$resultArray['email'] ) ){
				$dbBindError = 'Failed Bind Resuts: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('joinMytByToken: Db Bind Results Error', $dbBindError);
				header('Location: ' . $errorRedirect);
				exit();
			}
				
			if( $prepStmt->fetch() == false )
				mytLog('joinMytByToken: No Results to fetch for token: ' . $reqToken);
			else{
				foreach( $resultArray as $key=>$value ){
					$joinInfo[$key]=$value;
				}
			}
	
			$prepStmt->free_result();
			$prepStmt->close();
			$dblink->close();
		} catch (Exception $e) {
			mytLog('joinMytByToken: Exception in joinMytByToken', $e->getMessage());
			header('Location: ' . $errorRedirect);
			exit();
		}
	
		return $joinInfo;
	}
	
	// get join choir request details using Token
	function joinChoirByToken ( $reqToken ){
		global $dbhost, $dbuser, $dbpass, $dbName, $dbchoir, $errorRedirect;
		$choirInfo = array();
	
		try{
			$dbSelectLog = 'joinChoirByToken: Attempting Select from ' . $dbchoir .
				' for token=' . $reqToken;
			mytLog($dbSelectLog);
						
			$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbName);
			if($dblink->connect_errno){
				$dbLinkError = 'Failed connection: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('joinChoirByToken: Db Connection Error', $dbLinkError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			$prepStmt = $dblink->prepare("SELECT name, phone, email from " . $dbchoir . " where token=? LIMIT 1");
			if( !$prepStmt ){
				$dbPrepError = 'Failed prepare: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('joinChoirByToken: Db Prepared Statement Error', $dbPrepError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->bind_param('s', $reqToken ) ){
				$dbBindError = 'Failed Bind Params: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('joinChoirByToken: Db Bind Params Error', $dbBindError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->execute() ){
				$dbExecuteError = 'Failed Execute: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('joinChoirByToken: Db Execute Error', $dbExecuteError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->store_result() ){
				$dbStoreError = 'Failed Store Resuts: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('joinChoirByToken: Db Store Results Error', $dbStoreError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->bind_result( $resultArray['name'], $resultArray['phone'], 
						$resultArray['email'] ) ){
				$dbBindError = 'Failed Bind Resuts: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('joinChoirByToken: Db Bind Results Error', $dbBindError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			// fetch and store results in array
			if( $prepStmt->fetch() == false ){
				mytLog('joinChoirByToken: No Results to fetch for token: ' . $reqToken);
			}
			else{
				foreach( $resultArray as $key=>$value ){
					$choirInfo[$key]=$value;
				}
			}
	
			$prepStmt->free_result();
			$prepStmt->close();
			$dblink->close();
		} catch (Exception $e) {
			mytLog('joinChoirByToken: Exception in joinMytByToken', $e->getMessage());
			header('Location: ' . $errorRedirect);
			exit();
		}
	
		return $choirInfo;
	}
	
	// get skill audit submission request details using Token
	function submitSkillsByToken ( $reqToken ){
		global $dbhost, $dbuser, $dbpass, $dbName, $dbskills, $errorRedirect;
		$skillsInfo = array();
	
		try{
			$dbSelectLog = 'submitSkillsByToken: Attempting Select from ' . $dbskills .
			' for token=' . $reqToken;
			mytLog($dbSelectLog);
	
			$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbName);
			if($dblink->connect_errno){
				$dbLinkError = 'Failed connection: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('submitSkillsByToken: Db Connection Error', $dbLinkError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			$prepStmt = $dblink->prepare("SELECT name, surname, phone, email, resident, qualification, cv_attach from " . 
					$dbskills . " where token=? LIMIT 1");
			if( !$prepStmt ){
				$dbPrepError = 'Failed prepare: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('submitSkillsByToken: Db Prepared Statement Error', $dbPrepError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->bind_param('s', $reqToken ) ){
				$dbBindError = 'Failed Bind Params: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('submitSkillsByToken: Db Bind Params Error', $dbBindError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->execute() ){
				$dbExecuteError = 'Failed Execute: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('submitSkillsByToken: Db Execute Error', $dbExecuteError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->store_result() ){
				$dbStoreError = 'Failed Store Resuts: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('submitSkillsByToken: Db Store Results Error', $dbStoreError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			if( !$prepStmt->bind_result( $resultArray['name'], $resultArray['surname'], $resultArray['phone'], 
					$resultArray['email'], $resultArray['resident'], $resultArray['qualification'], $resultArray['cv_attach']) ){
				$dbBindError = 'Failed Bind Resuts: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('submitSkillsByToken: Db Bind Results Error', $dbBindError);
				header('Location: ' . $errorRedirect);
				exit();
			}
	
			// fetch and store results in array
			if( $prepStmt->fetch() == false ){
				mytLog('submitSkillsByToken: No Results to fetch for token: ' . $reqToken);
			}
			else{
				foreach( $resultArray as $key=>$value ){
					$skillsInfo[$key]=$value;
				}
			}
	
			$prepStmt->free_result();
			$prepStmt->close();
			$dblink->close();
		} catch (Exception $e) {
			mytLog('submitSkillsByToken: Exception in joinMytByToken', $e->getMessage());
			header('Location: ' . $errorRedirect);
			exit();
		}
	
		return $skillsInfo;
	}	
	
	function mytLog($log, $err=null){
		date_default_timezone_set("Africa/Johannesburg");
		global $logFileName;
		$logTime = date("H:i:s");
		
		if( !$err )
			$logText = $logTime . ": " . $log . "\r\n";
		else if( $err )
			$logText = $logTime . ": ERROR: " . $log . ": " . $err . "\r\n";
		
		// open and write to file
		try{
			$file = fopen( $logFileName,"a" );
			if($file){
				fwrite($file, $logText);
				fclose($file);
			}
		} catch (Exception $e) {
			$e->getMessage();
			header('Location: ' . $errorRedirect);
			exit();
		} 
	}


	// MYT ADMIN LOGIN: Call this function from public login script
	function processMytLogin( $iUserName, $iPassword ) {
		global $dbhost, $dbuser, $dbpass, $dbName, $dbadminMembers;
		$dbSuccess = false;
		$loginResponseInfo = array();
		// assign default login status to 'loginResponseInfo'
		$loginResponseInfo["loginStatus"] = "Failure";
		$loginResponseInfo["loginErrorMsg"] = "null";
				
		try {
			$dbReadLog = 'processMytLogin: Attempting Read From "' . $dbadminMembers . '". Username="' . $iUserName . 
				'", Password="' . $iPassword . '"';
			mytLog($dbReadLog);
			$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbName);
			
			if($dblink->connect_errno){
				$dbLinkError = 'Failed connection: (' . $dblink->connect_errno . ') '. $dblink->connect_error;
				mytLog('processMytLogin: Db connection error', $dbLinkError);
				$loginResponseInfo["loginErrorMsg"] = $dbLinkError;
				return $loginResponseInfo;
			}
								
			// prepared statement for login
			$prepStmt = $dblink->prepare("SELECT admin_username, admin_password, admin_full_name FROM " . $dbadminMembers .
					" WHERE admin_username=? AND admin_password=?");
			if( !$prepStmt ){
				$dbPrepError = 'Failed prepare: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytLogin: Db Prepared Statement Error', $dbPrepError);
				$loginResponseInfo["loginErrorMsg"] = $dbPrepError;
				return $loginResponseInfo;
			}
			
			// bind params
			if( !$prepStmt->bind_param('ss', $iUserName, $iPassword) ){
				$dbBindError = 'Failed to bind params: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytLogin: Db Bind Parameters Error', $dbBindError);
				$loginResponseInfo["loginErrorMsg"] = $dbBindError;
				return $loginResponseInfo;
			}
			
			//execute prepared statement with bound params
			if( !$prepStmt->execute() ){
				$dbExecuteError = 'Failed to execute: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytLogin: Db Execute Error',$dbExecuteError);
				$loginResponseInfo["loginErrorMsg"] = $dbExecuteError;
				return $loginResponseInfo;
			}else{
				if( !$prepStmt->store_result() ){
					$dbStoreError = 'Failed Store Resuts: (' . $dblink->errno . ') ' . $dblink->error;
					mytLog('processMytLogin: Db Store Results Error', $dbStoreError);
					$loginResponseInfo["loginErrorMsg"] = $dbStoreError;
					return $loginResponseInfo;
				}else{
					if( !$prepStmt->bind_result( $resultArray['admin_username'], $resultArray['admin_password'], 
							$resultArray['admin_full_name']) ){
						$dbBindError = 'Failed Bind Resuts: (' . $dblink->errno . ') ' . $dblink->error;
						mytLog('processMytLogin: Db Bind Results Error', $dbBindError);
						$loginResponseInfo["loginErrorMsg"] = $dbBindError;
						return $loginResponseInfo;
					}else{
						// fetch and store results in array-fetch and assign result (a single row)
						if( $prepStmt->fetch() == false ){
							mytLog('processMytLogin: No Results to fetch for username: ' . $iUserName);
						}
						else{
							$dbSuccess = true;
							mytLog('processMytLogin: Db Select from ' . $dbadminMembers . ' successfull!');
							// first get results from binding array into 'loginResults' array-Format like loginResponseInfo JSON object
							//$loginResults = array();
							$loginResults = $resultArray["admin_full_name"]; // assign into variable instead of array
							mytLog( 'processMytLogin: Fetched admin_full_name; Value is: ' . $loginResults );
							// push results value into loginInfo array to be returned for JSON response
							$loginResponseInfo["loginUserFullName"] = $loginResults;
							// assign login status to 'loginResponseInfo'
							$loginResponseInfo["loginStatus"] = "Success";
						}
				
						$prepStmt->free_result();
					}
				}
			}
			// close prepared statement and db connection
			$prepStmt->close();
			$dblink->close();
			
			if( $dbSuccess ){
				// send mail to myt admin whenever login is a success
				$mailRetVal = sendAdminLoginMail( $iUserName );
				if( $mailRetVal ){
					$mailSendLog = 'processMytLogin: Admin has Logged into MYT Admin Website! Username="' . $iUserName . 
							'", Password="' . $iPassword;
					mytLog($mailSendLog);
				}else{
					mytLog("processMytLogin: Could not send email for login of " . $iUserName .
						"but login was successfull!" );
				}
			}
									
		} catch (Exception $e) {
			mytLog('processMytLogin: Exception in processMytLogin', $e->getMessage());
			return $loginResponseInfo;
		}

		// return the response info array to be formatted into JSON
		return $loginResponseInfo;

	} // end processMytLogin

	// MYT ADMIN EMAIL SEND - Sent everytime an Admin logs in
	function sendAdminLoginMail( $usernameForm ){	
		global $mytSendFromEmail;
				
		// setup mail
		$subjectField = 'MyT Website: Admin Login';
		$messageField = '<p>Dear MyT Admin</p>';
		$messageField .= '<p>There was a login to the MYT Admin Website with the details below:</p>';
		$messageField .= "<p>Username of Admin: <strong>$usernameForm</strong></p>";
		$messageField .= "<p>Kind regards</p><p>MyT Church Website</p>";
		$headerField = "From:$mytSendFromEmail \r\n";
		$headerField .= "MIME-Version: 1.0\r\n";
		$headerField .= "Content-type: text/html; charset=UTF-8\r\n";
	
		return sendMytEmail($mytSendFromEmail, $subjectField, $messageField, $headerField);
	}


	// MYT ADD EVENT: Call this function from public addEvents script
	function processMytAddEvent( $iTitle, $iOwner, $iDate, $iContent, $iAdminUser, 
			$iAdminToken, $iHasContent, $iHasImage, $iImageDir) {
		global $dbhost, $dbuser, $dbpass, $dbName, $dbevents;
		$dbSuccess = false;
		$addEventResponseInfo = array();
		// assign default login status to 'addEventResponseInfo'
		$addEventResponseInfo["addEventStatus"] = "Failure";
		$addEventResponseInfo["addEventErrorMsg"] = "null";
		$addEventResponseInfo["addEventEmailSent"] = "false";
				
		try {
			$dbInsertLog = 'processMytAddEvent: Attempting Insert Into "' . $dbevents . '". Title="' . $iTitle . 
				'", Owner="' . $iOwner . '", Date="' . $iDate . '", Content="' . $iContent . 
				'", AdminUser="' . $iAdminUser . '", AdminToken="' . $iAdminToken . '", HasContent="' . $iHasContent . 
				'", HasImage="' . $iHasImage .'"';
			mytLog($dbInsertLog);
			$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbName);
			
			if($dblink->connect_errno){
				$dbLinkError = 'Failed connection: (' . $dblink->connect_errno . ') '. $dblink->connect_error;
				mytLog('processMytAddEvent: Db connection error', $dbLinkError);
				$addEventResponseInfo["addEventErrorMsg"] = $dbLinkError;
				return $addEventResponseInfo;
			}
								
			// prepared statement for Event Insert
			$prepStmt = $dblink->prepare(
				"INSERT INTO " . $dbevents . 
					"(event_title,event_owner,event_date,event_content,event_added_by_user,event_added_by_token,event_has_content,
						event_has_image,event_image_dir)" . "values (?,?,?,?,?,?,?,?,?)");
			if( !$prepStmt ){
				$dbPrepError = 'Failed prepare: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytAddEvent: Db Prepared Statement Error', $dbPrepError);
				$addEventResponseInfo["addEventErrorMsg"] = $dbPrepError;
				return $addEventResponseInfo;
			}
			
			// bind params
			if( !$prepStmt->bind_param('ssssssiis', $iTitle, $iOwner, $iDate, $iContent, $iAdminUser, 
					$iAdminToken, $iHasContent, $iHasImage, $iImageDir) ){
				$dbBindError = 'Failed to bind params: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytAddEvent: Db Bind Parameters Error', $dbBindError);
				$addEventResponseInfo["addEventErrorMsg"] = $dbBindError;
				return $addEventResponseInfo;
			}
			
			//execute prepared statement with bound params
			if( !$prepStmt->execute() ){
				$dbExecuteError = 'Failed to execute: (' . $dblink->errno . ') ' . $dblink->error;
				mytLog('processMytAddEvent: Db Execute Error',$dbExecuteError);
				$addEventResponseInfo["addEventErrorMsg"] = $dbExecuteError;
				return $addEventResponseInfo;
			}else{
				mytLog('processMytAddEvent: Db Insert into ' . $dbevents . ' successfull!');
				$addEventResponseInfo["addEventStatus"] = "Success";
				$dbSuccess = true;
			}
			// close prepared statement and db connection
			$prepStmt->close();
			$dblink->close();
			
			if( $dbSuccess ){
				// send mail to myt admin whenever login is a success
				$mailRetVal = sendAdminEventContentMail( $iTitle, $iDate, $iHasContent, $iHasImage, 
						$iAdminUser, $iAdminToken );
				if( $mailRetVal ){
					$mailSendLog = 'processMytAddEvent: Admin has Added an event for MYT Website! Please review. 
						Admin Name="' . $iAdminUser . '", Admin Token="' . $iAdminToken;
					mytLog($mailSendLog);
					$addEventResponseInfo["addEventEmailSent"] = "true";
				}else{
					mytLog("processMytAddEvent: Could not send email for Event Add of " . $iAdminUser .
						"but Event Add was successfull!" );
				}
			}
									
		} catch (Exception $e) {
			mytLog('processMytAddEvent: Exception in processMytAddEvent', $e->getMessage());
			return $addEventResponseInfo;
		}

		// return the response info array to be formatted into JSON
		return $addEventResponseInfo;

	} // end processMytAddEvent

	// MYT ADMIN EMAIL SEND - Sent everytime an Admin logs in
	function sendAdminEventContentMail($eventTitle, $eventDate, $eventHasContent, $eventHasImage, 
			$adminName, $adminToken){	
		global $mytSendFromEmail;
				
		// setup mail
		$subjectField = 'MyT Website: Event Added';
		$messageField = '<p>Dear MyT Admin</p>';
		$messageField .= '<p>There was an event added to the MYT Website with the details below:</p>';
		$messageField .= "<p>Event Title: <strong>$eventTitle</strong></p>";
		$messageField .= "<p>Event Date: <strong>$eventDate</strong></p>";
		$messageField .= "<p>Event has Content: <strong>$eventHasContent</strong></p>";
		$messageField .= "<p>Event has Image: <strong>$eventHasImage</strong></p>";
		$messageField .= "<p>Event Added by: <strong>$adminName</strong></p>";
		$messageField .= "<p>Event Added by admin token: <strong>$adminToken</strong></p>";
		$messageField .= "<p>Please login to the MyT Admin Website to review and approve event!!</strong></p>";
		$messageField .= "<p>Kind regards</p><p>MyT Church Website</p>";
		$headerField = "From:$mytSendFromEmail \r\n";
		$headerField .= "MIME-Version: 1.0\r\n";
		$headerField .= "Content-type: text/html; charset=UTF-8\r\n";
	
		return sendMytEmail($mytSendFromEmail, $subjectField, $messageField, $headerField);
	}
	
?>