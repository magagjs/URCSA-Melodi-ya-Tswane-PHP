<?php 
    require "../../mytConfig/mytComponents.php";

    // prepare and assign default values to array to be used as HTTP response
    $addEventResponse["addEventStatus"] = "";        
    $addEventResponse["addEventErrorMsg"] = "";
    $addEventResponse["addEventEmailSent"] = "";

    try{
        // check server request method for this script
        if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
            $addEventRequestObj = null;
            $addEventRequestJson = null;

            // get raw data after HTTP headers into data stream
            $addEventRequestObj = file_get_contents('php://input');  // only works when sending application/json-Use POST[attributeName] for multiform data

            //mytLog("mytAdminAddEvents: addEventRequestObj is: " . $addEventRequestObj);   // TEST VALUES
            //mytLog("mytAdminAddEvents: POST Contents: " . var_dump($_POST));              // TEST VALUES

            // check if posted data is not null 
            if( empty($addEventRequestObj) ) {
                mytLog("mytAdminAddEvents: addEventRequest form attribute value is null");
                $addEventResponse["addEventStatus"] = "Failure";
                $addEventResponse["addEventErrorMsg"]  = "Could not get Event Request from browser! Submitted request is empty! Try again later!";
                $addEventResponse["addEventEmailSent"] = "false";
            }
            else {
                $addEventRequestJson = json_decode($addEventRequestObj); // decode the JSON sent with request in 'addEventRequest' form attribute
                // mytLog("mytAdminAddEvents: EventRequestObject from Request: " . $addEventRequestJson);
            }

            // check if decoded request JSON is not null
            if( !is_null($addEventRequestJson) ) {
                mytLog("mytAdminAddEvents: Got AddEventRequestInfo Object from Observable UI! Processing...");
                // mytLog("mytAdminAddEvents: EventRequestObject from Request: " . $addEventRequestJson);
                // assign Json object data to php variables
                $title = $addEventRequestJson->title;           // Not null
                $owner = $addEventRequestJson->owner;
                $date = $addEventRequestJson->date;
                $content = $addEventRequestJson->content;
                $adminUser = $addEventRequestJson->adminUser;   // Not null
                $adminToken = $addEventRequestJson->adminToken; // Not null
                $hasContent = $addEventRequestJson->hasContent;
                $hasImage = $addEventRequestJson->hasImage;
                $imagePath = $addEventRequestJson->imagePath;

                mytLog("mytAdminAddEvents: title is: " . $title);
                mytLog("mytAdminAddEvents: owner is: " . $owner); 
                mytLog("mytAdminAddEvents: date is: " . $date); 
                mytLog("mytAdminAddEvents: content is: " . $content); 
                mytLog("mytAdminAddEvents: adminUser is: " . $adminUser); 
                mytLog("mytAdminAddEvents: adminToken is: " . $adminToken); 
                mytLog("mytAdminAddEvents: hasContent is: " . $hasContent); 
                mytLog("mytAdminAddEvents: hasImage is: " . $hasImage); 
                mytLog("mytAdminAddEvents: imagePath is: " . $imagePath); 

                // check if non-nullables have values and proceed with DB processesing
                if( !is_null($title) && !is_null($adminUser) && !is_null($adminToken) ) { // SUCCESS-DB PROCESS
                    mytLog("mytAdminAddEvents: Add Event is a SUCCESS on call to webservice! Adding data...");
                    // ADD event data
                        $addEventResponse = processMytAddEvent( $title, $owner, $date, $content, $adminUser, 
                            $adminToken, $hasContent, $hasImage, $imagePath); 
                }else {  // FAILURE-DB PROCESS
                    mytLog("mytAdminAddEvents: Null data, check data logs above!");
                    $addEventResponse["addEventStatus"] = "Failure";
                    $addEventResponse["addEventErrorMsg"] = "Missing data, check your input!";
                    $addEventResponse["addEventEmailSent"] = "false";
                }
                    
            }else {
                mytLog("mytAdminAddEvents: AddEventRequestInfo Object from Observable UI is NULL!");
                $addEventResponse["addEventStatus"] = "Failure";
                $addEventResponse["addEventErrorMsg"]  = "Could not get Event Data from server! No values in browser request!";
                $addEventResponse["addEventEmailSent"] = "false";
            } // end if-else(!is_null($addEventRequestJson))

        }else {
            mytLog("mytAdminAddEvents: Request Method on call to webservice is NOT POST!");
            $addEventResponse["addEventStatus"] = "Failure";
            $addEventResponse["addEventErrorMsg"] = "Could not get Event Data from server! Browser request not submitted to server! Try again later!";
            $addEventResponse["addEventEmailSent"] = "false";
        } // end if-else($_SERVER["REQUEST_METHOD"] == "POST")
    }catch(Exception $e){
        mytLog("mytAdminAddEvents: Error in AddEvents! Error message: " . $e->getMessage());
        // encode response array for HTTP response as JSON
        echo json_encode($addEventResponse);
    }

    // encode response array for HTTP response as JSON
    echo json_encode($addEventResponse);
?>