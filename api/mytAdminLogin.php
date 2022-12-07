<?php 
    require "../../mytConfig/mytComponents.php";

    // prepare and assign default values to array to be used as HTTP response
    $loginResponse = array();
    $loginResponse["loginUserFullName"] = "";
    $loginResponse["loginStatus"] = "";
    $loginResponse["loginErrorMsg"] = "";
    $loginResponse["loginToken"] = "";

    // check server request method for this script
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // get raw data after HTTP headers into data stream
        $loginRequestObj = file_get_contents('php://input');
        $loginRequestJson = json_decode($loginRequestObj);

        // check if posted data is not null
        if( !is_null($loginRequestObj) ){
            mytLog("mytAdminLogin: Got LoginRequestInfo Object from Observable UI! Processing...");
            $loginUser = $loginRequestJson->username;
            $loginPass = $loginRequestJson->password;
            mytLog("mytAdminLogin: Login Username is: " . $loginUser);
            mytLog("mytAdminLogin: Login Password is: " . $loginPass); 

            if( !is_null($loginUser) ){
                if( !is_null($loginPass) ){ // SUCCESS
                    mytLog("mytAdminLogin: Login is a SUCCESS on call to webservice! Querying data...");
                    $loginResponse = processMytLogin( $loginUser, $loginPass ); // get login data
                    $loginResponse["loginToken"] = randToken();                 // generate login token
                }else{  
                    mytLog("mytAdminLogin: Login password is null!");
                    $loginResponse["loginStatus"] = "Failure";
                    $loginResponse["loginErrorMsg"] = "Could not get Login Password!";
                }
            }else{
                mytLog("mytAdminLogin: Login username is null!");
                $loginResponse["loginStatus"] = "Failure";
                $loginResponse["loginErrorMsg"] = "Could not get Login Username!";
            }
                
        }else{
            mytLog("mytAdminLogin: LoginRequestInfo Object from Observable UI is NULL!");
            $loginResponse["loginStatus"] = "Failure";
            $loginResponse["loginErrorMsg"] = "Could not get Login Username & Password!";
        }
    }else{
        mytLog("mytAdminLogin: Request Method on call to webservice is NOT POST!");
        $loginResponse["loginStatus"] = "Failure";
        $loginResponse["loginErrorMsg"] = "Could not POST Login Username & Password!";
    }

    // encode response array for HTTP response as JSON
    echo json_encode($loginResponse);
?>