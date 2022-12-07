<?php
    require "../../mytConfig/mytComponents.php";
    // upload Image and return directory path
    
    $fileUploadResponse["filePath"] = "";   // prepare and assign default values to array to be used as HTTP response 
    $fileUploadResponse["errorMsg"] = "";
    $fileDirName = "";                      // file directory path opn server after upload
    $inputAttribArray = array();            // array to store all input attributes from form
    $inputNameAttrib = "";                  // input 'name' attribute from form

    try{
        // check if file uploaded and begin processing file upload
        if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
            mytLog("POST array: " . print_r($_FILES,true));
            // get POST attrib keys-The input 'name' differs with components where api is called
            foreach( array_keys($_POST) as $inputAttribs ) {
                array_push($inputAttribArray,$inputAttribs); // add input attributes in array
                mytLog("mytAdminFileUpload: Form input attribute key: " . $inputAttribs);
            }
            $fileNameAttrib=$inputAttribArray[0];            // will only have one input attribute 'name'
            mytLog("mytAdminFileUpload: Assigned form input 'name' attribute key: " . $fileNameAttrib);

            global $fileTargetDir, $adminUploadSizeLimit;
            $checkFileUpload = FALSE;
            $checkFileUpload = is_uploaded_file($_FILES["$fileNameAttrib"]["tmp_name"]);	 	// check if file was uploaded

            if( $checkFileUpload ){
                mytLog("mytAdminFileUpload: Checking and processing file upload");

                $fileTarget = $fileTargetDir . basename($_FILES["$fileNameAttrib"]["name"]);  // path where file will be stored
                $fileExtenstion = '.' . strtolower(pathinfo($fileTarget,PATHINFO_EXTENSION));
                $fileUploadSize = $_FILES["$fileNameAttrib"]["size"];
                
                if( file_exists($fileTarget) ){	 // check if file exists
                    mytLog("mytAdminFileUpload: File with file name '" . $fileTarget . "' already exists");
                }else if( $fileUploadSize > $adminUploadSizeLimit ){	  // check file size - 10MB Limit
                    mytLog("mytAdminFileUpload: File with file name '" . $fileTarget . "' is larger than limit." .
                            " File size: " . $fileUploadSize);
                /*}else if( $fileExtenstion != ".pdf" && 
                        $fileExtenstion != ".doc" && 
                        $fileExtenstion != ".docx"){	// check file extension											
                    mytLog("uploadImg(): File with file name '" . $fileTarget . "' is not PDF or WORD." .
                        " File extension is: " . $fileExtenstion); */
                }else{
                    // create file with 'typeOfUpload_uploadDate' as new file name
                    $fileNameUpload = $fileNameAttrib . "_" . date("Y-m-d_h-i-s") . $fileExtenstion; //$name . "_" . $lname . "_" . date("Y-m-d_h-i-s") . $fileExtenstion;
                    $fileTarget = $fileTargetDir . $fileNameUpload;
                    
                    // move file to new directory
                    if ( move_uploaded_file($_FILES["$fileNameAttrib"]["tmp_name"], $fileTarget) ) {   					
                        mytLog("mytAdminFileUpload: File with file name '" . $fileNameUpload . "' has been uploaded");
                        $fileDirName = $fileTarget;
                    }else{
                        mytLog("mytAdminFileUpload: File with file name '" . $fileNameUpload . "' could not be uploaded. Error is: " . 
                            $_FILES["$fileNameAttrib"]["error"]);
                        $fileNameUpload = "File Upload Error";
                    }
                } // end if-else( file_exists($fileTarget) )

                clearstatcache(); // clear results of is_uploaded_file() when file WAS uploaded

            } // end if-else( $checkFileUpload )

            clearstatcache(); 	 // clear results of is_uploaded_file() when file WAS NOT uploaded

        }else {
            mytLog("mytAdminFileUpload: Request Method on call to webservice is NOT POST!");        
        } // end if-else( $_SERVER["REQUEST_METHOD"] == "POST" )

        // encode response array for HTTP response as JSON - Without Upload Error!
        echo json_encode($fileUploadResponse);
        
    }catch(Exception $e){
        mytLog("mytAdminFileUpload: Error in Uploading File! Error message: " . $e->getMessage());
        $fileUploadResponse["errorMsg"] = $e->getMessage();
        // encode response array for HTTP response as JSON - With Upload Error
        echo json_encode($fileUploadResponse);
    }
?>