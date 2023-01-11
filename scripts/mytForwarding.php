<?php
	//require "../../../config/mytComponents.php"; // LOCAL ONLY
	require "../../config/mytComponents.php";

	global $logFileName, $mailForwardRedir, $errPageRedir;
	$name = $tel = $email = $message = "";				// define form variables for 'Contacts us' form
	$nameErr = $telErr = $emailErr = $messageErr = "";	// define form errorMessage for 'Contact us' form
	// log all errors and warnings to log file
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);	//////////	PROD: SET TO FALSE ////////////////////
	ini_set('log_errors', TRUE);
	ini_set('error_log', $logFileName);
	
	// get server details
	$webProtocol = ( !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
			|| $_SERVER['SERVER_PORT'] == 443)
			? 'https://' : 'http://';
	$protocalHost = $webProtocol . $_SERVER['HTTP_HOST'];
	$mailForwardRedirectPage = $protocalHost . $mailForwardRedir;
	$errorPageRedirecting = $protocalHost . $errPageRedir;
			
 	if( processForward() ){
 		mytLog("mytForwarding: Redirecting to: $mailForwardRedirectPage");
 		header("Location: $mailForwardRedirectPage");
		exit();
	}else{
		mytLog("mytForwarding: Redirecting to: $errorPageRedirecting");
		header("Location: $errorPageRedirecting");
		exit();
	} 
	
	function processForward (){
		$isForwaded = false;
		
		try{
			if ( !empty($_GET) ){
				global $revParam, $careParam, $secretarParam, $conductParam, $acadCommParam,
					$reqTypeParam, $joinTypeParam, $choirTypeParam, $acadTypeParam;
				// determine receiver
				if ( !empty($_GET["tok"]) && !empty($_GET["sel"]) && !empty($_GET["type"]) ){
					$reqIdentifier = $_GET["tok"];
					$selectForward = $_GET["sel"];
					$typeForward = $_GET["type"];
					
					if( ($selectForward == $revParam) && ($typeForward == $reqTypeParam) )
						$isForwaded = forwardRequestRev( $reqIdentifier );
					else if ( ($selectForward == $revParam) && ($typeForward == $joinTypeParam) )
						$isForwaded = forwardJoinRev($reqIdentifier);
					else if ( ($selectForward == $careParam) && ($typeForward == $reqTypeParam) )
						$isForwaded = forwardRequestCare($reqIdentifier);
					else if ( ($selectForward == $secretarParam) && ($typeForward == $reqTypeParam) )
						$isForwaded = forwardRequestSec($reqIdentifier);
					else if ( ($selectForward == $conductParam) && ($typeForward == $choirTypeParam) )
						$isForwaded = forwardChoirCond($reqIdentifier);
					else if ( ($selectForward == $acadCommParam) && ($typeForward == $acadTypeParam) )
						$isForwaded = forwardAcadComm($reqIdentifier);
				}
			}else
				mytLog('processForward: Could not get url parameters for forward emails');
		} catch (Exception $e) {
			mytLog('processForward: Exception in processForward', $e->getMessage());
			header('Location: ' . $errPageRedir);
			exit();
		}
		
		return $isForwaded;
	} // end processForward
	
	function forwardRequestRev ( $reqSelector ){
		global $mytSendFromEmail, $mytFullRevEmail, $mytReverend, $mytWebAdmin;
		$detailSize = 0;
		$isMailSent = false;
		$reqDetails = reqByToken( $reqSelector );
		
		foreach( $reqDetails as $key=>$value ){		// check size of details
			$detailSize++;
		}
		// get details only if there are any
		if( $detailSize >0 ){
			$reqName = $reqDetails['name'];
			$reqPhone = $reqDetails['phone'];
			$reqEmail = $reqDetails['email'];
			$reqMsg = $reqDetails['message'];
		
			$subjectField = 'MyT Website: New message submmitted';
			$messageField = "<p>Dear $mytReverend</p>";
			$messageField .= '<p>A message has been posted via the MyT Church website for your action. The details are below:</p>';
			$messageField .= "<p>Name of contact: <strong>$reqName</strong></p>";
			$messageField .= "<p>Phone Number of contact: <strong>$reqPhone</strong></p>";
			$messageField .= "<p>Email Address of contact: <strong>$reqEmail</strong></p>";
			$messageField .= "<p>Message from contact: <strong>$reqMsg</strong></p><br>";
			$messageField .= "<p>The message has already been verified for spam emailing by <strong>$mytWebAdmin</strong> and it is legitimate.</p>";
			$messageField .= "<p>Please take action on this message or forward to the relevent parties</p>";
			$messageField .= "<p>Kind regards</p><p>$mytWebAdmin</p>";
			$headerField = "From:$mytSendFromEmail \r\n";
			$headerField .= "MIME-Version: 1.0\r\n";
			$headerField .= "Content-type: text/html; charset=UTF-8\r\n";
		
			$isMailSent = sendMytEmail($mytFullRevEmail, $subjectField, $messageField, $headerField);
			if($isMailSent){
				$forwardMailLog = 'forwardRequestRev: Mail fordward successfull to "' . $mytFullRevEmail . '" with subject "' . $subjectField . '"';
				mytLog($forwardMailLog);
			}else{
				$forwardMailLog = 'forwardRequestRev: Mail fordward failure to "' . $mytFullRevEmail . '" with subject "' . $subjectField . '"';
				mytLog($forwardMailLog);
			}
		}
		return $isMailSent;
	} // end forwardRequestRev
	
	function forwardRequestCare ( $reqSelector ){
		global $mytSendFromEmail, $mytCaretakerEmail, $mytCaretaker, $mytWebAdmin;
		$detailSize = 0;
		$isMailSent = false;
		$reqDetails = reqByToken( $reqSelector );
	
		foreach( $reqDetails as $key=>$value ){		// check size of details
			$detailSize++;
		}
		// get details only if there are any
		if( $detailSize >0 ){
			$reqName = $reqDetails['name'];
			$reqPhone = $reqDetails['phone'];
			$reqEmail = $reqDetails['email'];
			$reqMsg = $reqDetails['message'];
	
			$subjectField = 'MyT Website: New message submmitted';
			$messageField = "<p>Dear $mytCaretaker</p>";
			$messageField .= '<p>A message has been posted via the MyT Church website for your action. The details are below:</p>';
			$messageField .= "<p>Name of contact: <strong>$reqName</strong></p>";
			$messageField .= "<p>Phone Number of contact: <strong>$reqPhone</strong></p>";
			$messageField .= "<p>Email Address of contact: <strong>$reqEmail</strong></p>";
			$messageField .= "<p>Message from contact: <strong>$reqMsg</strong></p><br>";
			$messageField .= "<p>The message has already been verified for spam emailing by <strong>$mytWebAdmin</strong> and it is legitimate.</p>";
			$messageField .= "<p>Please take action on this message or forward to the relevent parties</p>";
			$messageField .= "<p>Kind regards</p><p>$mytWebAdmin</p>";
			$headerField = "From:$mytSendFromEmail \r\n";
			$headerField .= "MIME-Version: 1.0\r\n";
			$headerField .= "Content-type: text/html; charset=UTF-8\r\n";
	
			$isMailSent = sendMytEmail($mytCaretakerEmail, $subjectField, $messageField, $headerField);
			if($isMailSent){
				$forwardMailLog = 'forwardRequestCare: Mail fordward successfull to "' . $mytCaretakerEmail . '" with subject "' . $subjectField . '"';
				mytLog($forwardMailLog);
			}else{
				$forwardMailLog = 'forwardRequestCare: Mail fordward failure to "' . $mytCaretakerEmail . '" with subject "' . $subjectField . '"';
				mytLog($forwardMailLog);
			}
		}
		return $isMailSent;
	} // end forwardRequestCare
	
	function forwardRequestSec ( $reqSelector ){
		global $mytSendFromEmail, $mytSecretaryEmail, $mytSecretary, $mytWebAdmin;
		$detailSize = 0;
		$isMailSent = false;
		$reqDetails = reqByToken( $reqSelector );
	
		foreach( $reqDetails as $key=>$value ){		// check size of details
			$detailSize++;
		}
		// get details only if there are any
		if( $detailSize >0 ){
			$reqName = $reqDetails['name'];
			$reqPhone = $reqDetails['phone'];
			$reqEmail = $reqDetails['email'];
			$reqMsg = $reqDetails['message'];
	
			$subjectField = 'MyT Website: New message submmitted';
			$messageField = "<p>Dear $mytSecretary</p>";
			$messageField .= '<p>A message has been posted via the MyT Church website for your action. The details are below:</p>';
			$messageField .= "<p>Name of contact: <strong>$reqName</strong></p>";
			$messageField .= "<p>Phone Number of contact: <strong>$reqPhone</strong></p>";
			$messageField .= "<p>Email Address of contact: <strong>$reqEmail</strong></p>";
			$messageField .= "<p>Message from contact: <strong>$reqMsg</strong></p><br>";
			$messageField .= "<p>The message has already been verified for spam emailing by <strong>$mytWebAdmin</strong> and it is legitimate.</p>";
			$messageField .= "<p>Please take action on this message or forward to the relevent parties</p>";
			$messageField .= "<p>Kind regards</p><p>$mytWebAdmin</p>";
			$headerField = "From:$mytSendFromEmail \r\n";
			$headerField .= "MIME-Version: 1.0\r\n";
			$headerField .= "Content-type: text/html; charset=UTF-8\r\n";
	
			$isMailSent = sendMytEmail($mytSecretaryEmail, $subjectField, $messageField, $headerField);
			if($isMailSent){
				$forwardMailLog = 'forwardRequestSec: Mail fordward successfull to "' . $mytSecretaryEmail . '" with subject "' . $subjectField . '"';
				mytLog($forwardMailLog);
			}else{
				$forwardMailLog = 'forwardRequestSec: Mail fordward failure to "' . $mytSecretaryEmail . '" with subject "' . $subjectField . '"';
				mytLog($forwardMailLog);
			}
		}
		return $isMailSent;
	} // end forwardRequestSec
	
	function forwardJoinRev ( $reqSelector ){
		global $mytSendFromEmail, $mytFullRevEmail, $mytReverend, $mytWebAdmin;
		$detailSize = 0;
		$isMailSent = false;
		$joinDetails = joinMytByToken( $reqSelector );
	
		foreach( $joinDetails as $key=>$value ){		// check size of details
			$detailSize++;
		}
		// get details only if there are any
		if( $detailSize >0 ){
			$reqName = $joinDetails['name'];
			$reqPhone = $joinDetails['phone'];
			$reqEmail = $joinDetails['email'];
	
			$subjectField = 'MyT Website: New Member Request';
			$messageField = "<p>Dear $mytReverend</p>";
			$messageField .= '<p>A new member has requested to join Melodi ya Tshwane via the MyT Church website. The details are below:</p>';
			$messageField .= "<p>Name of contact: <strong>$reqName</strong></p>";
			$messageField .= "<p>Phone Number of contact: <strong>$reqPhone</strong></p>";
			$messageField .= "<p>Email Address of contact: <strong>$reqEmail</strong></p><br>";
			$messageField .= "<p>The message has already been verified for spam emailing by <strong>$mytWebAdmin</strong> and it is legitimate.</p>";
			$messageField .= "<p>Please take action on this message or forward to the relevent parties</p>";
			$messageField .= "<p>Kind regards</p><p>$mytWebAdmin</p>";
			$headerField = "From:$mytSendFromEmail \r\n";
			$headerField .= "MIME-Version: 1.0\r\n";
			$headerField .= "Content-type: text/html; charset=UTF-8\r\n";
	
			$isMailSent = sendMytEmail($mytFullRevEmail, $subjectField, $messageField, $headerField);
			if($isMailSent){
				$forwardMailLog = 'forwardJoinRev: Mail fordward successfull to "' . $mytFullRevEmail . '" with subject "' . $subjectField . '"';
				mytLog($forwardMailLog);
			}else{
				$forwardMailLog = 'forwardJoinRev: Mail fordward failure to "' . $mytFullRevEmail . '" with subject "' . $subjectField . '"';
				mytLog($forwardMailLog);
			}
		}
		return $isMailSent;
	} // end forwardJoinRev
	
	function forwardChoirCond ( $reqSelector ){
		global $mytSendFromEmail, $mytConductorEmail, $mytConductor, $mytWebAdmin;
		$detailSize = 0;
		$isMailSent = false;
		$choirDetails = joinChoirByToken( $reqSelector );
	
		foreach( $choirDetails as $key=>$value ){		// check size of details
			$detailSize++;
		}
		// get details only if there are any
		if( $detailSize >0 ){
			$reqName = $choirDetails['name'];
			$reqPhone = $choirDetails['phone'];
			$reqEmail = $choirDetails['email'];
	
			$subjectField = 'MyT Website: New Choir Member Request';
			$messageField = "<p>Dear $mytConductor</p>";
			$messageField .= '<p>A new member has requested to join Melodi ya Tshwane via the MyT Church website. The details are below:</p>';
			$messageField .= "<p>Name of contact: <strong>$reqName</strong></p>";
			$messageField .= "<p>Phone Number of contact: <strong>$reqPhone</strong></p>";
			$messageField .= "<p>Email Address of contact: <strong>$reqEmail</strong></p><br>";
			$messageField .= "<p>The message has already been verified for spam emailing by <strong>$mytWebAdmin</strong> and it is legitimate.</p>";
			$messageField .= "<p>Please take action on this message or forward to the relevent parties</p>";
			$messageField .= "<p>Kind regards</p><p>$mytWebAdmin</p>";
			$headerField = "From:$mytSendFromEmail \r\n";
			$headerField .= "MIME-Version: 1.0\r\n";
			$headerField .= "Content-type: text/html; charset=UTF-8\r\n";
	
			$isMailSent = sendMytEmail($mytConductorEmail, $subjectField, $messageField, $headerField);
			if($isMailSent){
				$forwardMailLog = 'forwardChoirCond: Mail fordward successfull to "' . $mytConductorEmail . '" with subject "' . $subjectField . '"';
				mytLog($forwardMailLog);
			}else{
				$forwardMailLog = 'forwardChoirCond: Mail fordward failure to "' . $mytConductorEmail . '" with subject "' . $subjectField . '"';
				mytLog($forwardMailLog);
			}
		}
		return $isMailSent;
	} // end forwardChoirCond
	
	function forwardAcadComm ( $reqSelector ){
		global $mytSendFromEmail, $mytAcadCommitEmail, $mytAcadCommit, $mytWebAdmin, $cvFileName;
		$detailSize = 0;
		$isMailSent = false;
		$skillAuditDetails = submitSkillsByToken( $reqSelector );
	
		foreach( $skillAuditDetails as $key=>$value ){		// check size of details
			$detailSize++;
		}
		// get details only if there are any
		if( $detailSize >0 ){
			$reqName = $skillAuditDetails['name'];
			$reqSurname = $skillAuditDetails['surname'];
			$reqPhone = $skillAuditDetails['phone'];
			$reqEmail = $skillAuditDetails['email'];
			$reqResident = $skillAuditDetails['resident'];
			$reqQual = $skillAuditDetails['qualification'];
			$reqAttach = $skillAuditDetails['cv_attach'];
	
			$subjectField = 'MyT Website: New Skills Audit Member';
			$messageField = "<p>Dear $mytAcadCommit</p>";
			$messageField .= '<p>A congregation member has uploaded a skill for skills audit via the MyT Church website. The details are below</p>';
			$messageField .= "<p>First Name: <strong>$reqName</strong></p>";
			$messageField .= "<p>Surname: <strong>$reqSurname</strong></p>";
			$messageField .= "<p>Phone Number: <strong>$reqPhone</strong></p>";
			$messageField .= "<p>Email Address: <strong>$reqEmail</strong></p><br>";
			$messageField .= "<p>Residential Location: <strong>$reqResident</strong></p><br>";
			$messageField .= "<p>Qualification/Skills: <strong>$reqQual</strong></p><br>";
			
			if( $reqAttach != $cvFileName ){
				$messageField .= "<p>The congregation member has uploaded a CV that is attached with this email message</p>";
			}
			
			$messageField .= "<p>This email message and any attachments are legitimate since it has already been verified for spam emailing by <strong>$mytWebAdmin</strong>.</p>";
			$messageField .= "<p>Please take action on this email message or forward to the relevent parties</p>";
			$messageField .= "<p>Kind regards</p><p>$mytWebAdmin</p>";
	
			$isMailSent = sendMytEmailAttach( $mytAcadCommitEmail, $subjectField, $messageField, $mytSendFromEmail, $reqAttach );
			//$isMailSent = sendMytEmail($mytAcadCommitEmail, $subjectField, $messageField, $headerField);
			if($isMailSent){
				$forwardMailLog = 'forwardAcadComm: Mail fordward successfull to "' . $mytAcadCommitEmail . '" with subject "' . $subjectField . '"';
				mytLog($forwardMailLog);
			}else{
				$forwardMailLog = 'forwardAcadComm: Mail fordward failure to "' . $mytAcadCommitEmail . '" with subject "' . $subjectField . '"';
				mytLog($forwardMailLog);
			}
		}
		return $isMailSent;
	} // end forwardAcadComm
	
?>