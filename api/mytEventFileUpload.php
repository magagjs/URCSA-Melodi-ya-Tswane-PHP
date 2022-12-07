<?php
    require "../../mytConfig/mytComponents.php";

    // setup the response header as JSON - will ensure we return the fileUploadResponse
    header("content-type: application/json");

    // upload Image and return directory path
    $fileUploadResponse["filePath"] = "";   // prepare and assign default values to array to be used as HTTP response 
    $fileUploadResponse["errorMsg"] = "";
    $fileDirName = "";                      // file directory path opn server after upload

    try{
        // check if file uploaded and begin processing file upload
        if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
            //mytLog("POST array: " . print_r($_FILES,true));   // TEST FILE OUTPUT
            global $fileUploadTargetDir, $adminUploadSizeLimit;
            $checkFileUpload = FALSE;
            $checkFileUpload = is_uploaded_file($_FILES["eventsFile"]["tmp_name"]);	 	// check if file was uploaded
            mytLog("mytEventFileUpload: Checking and processing file upload. File Uploaded: " . $checkFileUpload);

            if( $checkFileUpload ){
                $fileTarget = $fileUploadTargetDir . basename($_FILES["eventsFile"]["name"]);  // path where file will be stored
                $fileExtenstion = '.' . strtolower(pathinfo($fileTarget,PATHINFO_EXTENSION));
                $fileUploadSize = $_FILES["eventsFile"]["size"];
                
                if( file_exists($fileTarget) ){	 // check if file exists
                    mytLog("mytEventFileUpload: File with file name '" . $fileTarget . "' already exists");
                }else if( $fileUploadSize > $adminUploadSizeLimit ){	  // check file size - 10MB Limit
                    mytLog("mytEventFileUpload: File with file name '" . $fileTarget . "' is larger than limit." .
                            " File size: " . $fileUploadSize);
                /*}else if( $fileExtenstion != ".pdf" && 
                        $fileExtenstion != ".doc" && 
                        $fileExtenstion != ".docx"){	// check file extension											
                    mytLog("uploadImg(): File with file name '" . $fileTarget . "' is not PDF or WORD." .
                        " File extension is: " . $fileExtenstion); */
                }else{
                    // create file with 'eventsFile_<uploadDate>_<xxxxx><fileExtenstion>' as new file name
                    $fileNameUpload = "events_" . date("Y-m-d_h-i-s") . "_" . randFileUploadToken() . $fileExtenstion;
                    $fileTarget = $fileUploadTargetDir . $fileNameUpload;
                    
                    // move file to new directory
                    if ( move_uploaded_file($_FILES["eventsFile"]["tmp_name"], $fileTarget) ) { // SUCCESS				
                        mytLog("mytEventFileUpload: File with file name '" . $fileNameUpload . "' has been uploaded");
                        $fileDirName = $fileTarget;
                        $fileUploadResponse["filePath"] = $fileNameUpload;  // File name in http response
                        mytLog("mytEventFileUpload: File Path is: " . $fileNameUpload);
                    }else{
                        mytLog("mytEventFileUpload: File with file name '" . $fileNameUpload . "' could not be uploaded. Error is: " . 
                            $_FILES["eventsFile"]["error"]);
                        $fileNameUpload = "File Upload Error";
                    }

                } // end if-else( file_exists($fileTarget) )

                clearstatcache(); // clear results of is_uploaded_file() when file WAS uploaded

            } // end if-else( $checkFileUpload )

            clearstatcache(); 	 // clear results of is_uploaded_file() when file WAS NOT uploaded

        }else {
            mytLog("mytEventFileUpload: Request Method on call to webservice is NOT POST!"); 
                   
        } // end if-else( $_SERVER["REQUEST_METHOD"] == "POST" )

        // encode response array for HTTP response as JSON - Without Upload Error!
        echo json_encode($fileUploadResponse);
        
    }catch(Exception $e){
        mytLog("mytEventFileUpload: Error in Uploading File! Error message: " . $e->getMessage());
        $fileUploadResponse["errorMsg"] = $e->getMessage();
        // encode response array for HTTP response as JSON - With Upload Error
        echo json_encode($fileUploadResponse);
    }
?>