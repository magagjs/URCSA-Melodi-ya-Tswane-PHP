<?php 
    require "../../mytConfig/mytComponents.php";
    require "../../mytConfig/mytUploadImg.php";

    $headers = array();
    $headers[] = 'Accept: multipart/form-data';
    $headers[] = 'Content-Type: multipart/form-data';
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';

    // prepare and assign default values to array to be used as HTTP response
    $addEventResponse["addEventStatus"] = "";        
    $addEventResponse["addEventErrorMsg"] = "";
    $addEventResponse["addEventEmailSent"] = "";

    // check server request method for this script
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // get raw data after HTTP headers into data stream
        $addEventRequestObj = null; //tests
        //$addEventRequestObj = file_get_contents('php://input');  // Only works when sending application/json-Use POST[attributeName] for multiform data
        //$addEventRequestJson = json_decode($addEventRequestObj); // Dont decode since we already JSON.stringify()'d it in request header
        $addEventRequestJson = null;    // used for decode of JSON sent with form data attribute 'addEventRequest'
        //$addEventRequestObj = print_r($_POST["addEventRequest"],true);

        mytLog("mytAdminAddEvents: POST is: " . print_r(json_decode($_POST["addEventRequest"],true)));
        mytLog("mytAdminAddEvents: FILES names Contents: " . print_r($_FILES["eventsFile"]["name"],true));
        //mytLog("mytAdminAddEvents: FILES Contents: " . file_get_contents('php://input'));

        if( empty($addEventRequestObj) ){
            mytLog("mytAdminAddEvents: addEventRequest form attribute value is null");
            $addEventResponse["addEventStatus"] = "Failure";
            $addEventResponse["addEventErrorMsg"]  = "Could not get Event Request from browser! Submitted request is empty! Try again later!";
            $addEventResponse["addEventEmailSent"] = "false";
        }
        else{
            $addEventRequestJson = json_decode($addEventRequestObj); // decode the JSON sent with request in 'addEventRequest' form attribute
            mytLog("mytAdminAddEvents: EventRequestObject from Request: " . $addEventRequestJson);
        }

        // check if posted data is not null
        //if( !is_null($addEventRequestObj) ){
        // check if decoded request JSON is not null
        if(!is_null($addEventRequestJson)){
            mytLog("mytAdminAddEvents: Got AddEventRequestInfo Object from Observable UI! Processing...");
            mytLog("mytAdminAddEvents: EventRequestObject from Request: " . $addEventRequestJson);
            // below only work when we havent't stringified object (json_decode($addEventRequestObj))
            $title = $addEventRequestJson->title;           // Not null
            $owner = $addEventRequestJson->owner;
            $date = $addEventRequestJson->date;
            $content = $addEventRequestJson->content;
            $adminUser = $addEventRequestJson->adminUser;   // Not null
            $adminToken = $addEventRequestJson->adminToken; // Not null
            $hasContent = $addEventRequestJson->hasContent;
            $hasImage = $addEventRequestJson->hasImage;
            
            mytLog("mytAdminAddEvents: title is: " . $title);
            mytLog("mytAdminAddEvents: owner is: " . $owner); 
            mytLog("mytAdminAddEvents: date is: " . $date); 
            mytLog("mytAdminAddEvents: hasContent is: " . $hasContent); 
            mytLog("mytAdminAddEvents: hasImage is: " . $hasImage); 
            mytLog("mytAdminAddEvents: adminUser is: " . $adminUser); 
            mytLog("mytAdminAddEvents: adminToken is: " . $adminToken); 

            // below only works if we have stringified object at request stage
            /* $title = $addEventRequestObj->title;           // Not null
            $owner = $addEventRequestObj->owner;
            $date = $addEventRequestObj->date;
            $content = $addEventRequestObj->content;
            $adminUser = $addEventRequestObj->adminUser;   // Not null
            $adminToken = $addEventRequestObj->adminToken; // Not null
            $hasContent = $addEventRequestObj->hasContent;
            $hasImage = $addEventRequestObj->hasImage;
            
            mytLog("mytAdminAddEvents: title is: " . $title);
            mytLog("mytAdminAddEvents: owner is: " . $owner); 
            mytLog("mytAdminAddEvents: date is: " . $date); 
            mytLog("mytAdminAddEvents: hasContent is: " . $hasContent); 
            mytLog("mytAdminAddEvents: hasImage is: " . $hasImage); 
            mytLog("mytAdminAddEvents: adminUser is: " . $adminUser); 
            mytLog("mytAdminAddEvents: adminToken is: " . $adminToken);*/

            if( !is_null($title) && !is_null($adminUser) && !is_null($adminToken) ){ // SUCCESS
                mytLog("mytAdminAddEvents: Add Event is a SUCCESS on call to webservice! Adding data...");

                //================================================= Include UPLOAD Image Function =====================================
                $iImageDir = uploadImg($hasImage, "eventsFile", "AddEvents");
                //================================================= Include UPLOAD Image Function =====================================

                if( !is_null($iImageDir) ){
                // ADD event data
                    $addEventResponse = processMytAddEvent( $title, $owner, $date, $content, $adminUser, 
                        $adminToken, $hasContent, $hasImage, $iImageDir); 
                }
            }else{
                mytLog("mytAdminAddEvents: Null data, check data logs above!");
                $addEventResponse["addEventStatus"] = "Failure";
                $addEventResponse["addEventErrorMsg"] = "Missing data, check your input!";
                $addEventResponse["addEventEmailSent"] = "false";
            }
                
        }else{
            mytLog("mytAdminAddEvents: AddEventRequestInfo Object from Observable UI is NULL!");
            $addEventResponse["addEventStatus"] = "Failure";
            $addEventResponse["addEventErrorMsg"]  = "Could not get Event Data from server! No values in browser request!";
            $addEventResponse["addEventEmailSent"] = "false";
        }
    }else{
        mytLog("mytAdminAddEvents: Request Method on call to webservice is NOT POST!");
        $addEventResponse["addEventStatus"] = "Failure";
        $addEventResponse["addEventErrorMsg"] = "Could not get Event Data from server! Browser request not submitted to server! Try again later!";
        $addEventResponse["addEventEmailSent"] = "false";
    }

    // encode response array for HTTP response as JSON
    echo json_encode($addEventResponse);
?>