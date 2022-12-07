<?php

    // upload Image and return directory path
    function uploadImg($isImgFlag, $formFieldName, $uploadType) {

        $fileDirName = null;
        // check if file uploaded and begin processing file upload
        if( $isImgFlag ){
            global $fileTargetDir, $adminUploadSizeLimit;
            $checkFileUpload = FALSE;
            $checkFileUpload = is_uploaded_file($_FILES["$formFieldName"]["tmp_name"]);	 	// check if file was uploaded
            mytLog("uploadImg(): Checking if file upload is enabled: " . $isImgFlag);

            if( $checkFileUpload ){
                mytLog("uploadImg(): Checking and processing file upload");

                $fileTarget = $fileTargetDir . basename($_FILES["$formFieldName"]["name"]);  // path where file will be stored
                $fileExtenstion = '.' . strtolower(pathinfo($fileTarget,PATHINFO_EXTENSION));
                $fileUploadSize = $_FILES["$formFieldName"]["size"];
                
                if( file_exists($fileTarget) ){	 // check if file exists
                    mytLog("uploadImg(): File with file name '" . $fileTarget . "' already exists");
                }else if( $fileUploadSize > $adminUploadSizeLimit ){	  // check file size
                    mytLog("uploadImg(): File with file name '" . $fileTarget . "' is larger than limit." .
                            " File size: " . $fileUploadSize);
                /*}else if( $fileExtenstion != ".pdf" && 
                        $fileExtenstion != ".doc" && 
                        $fileExtenstion != ".docx"){	// check file extension											
                    mytLog("uploadImg(): File with file name '" . $fileTarget . "' is not PDF or WORD." .
                        " File extension is: " . $fileExtenstion); */
                }else{
                    // create file with 'typeOfUpload_uploadDate' as new file name
                    $fileNameUpload = $uploadType . "_" . date("Y-m-d_h-i-s") . $fileExtenstion; //$name . "_" . $lname . "_" . date("Y-m-d_h-i-s") . $fileExtenstion;
                    $fileTarget = $fileTargetDir . $fileNameUpload;
                    
                    // move file to new directory
                    if ( move_uploaded_file($_FILES["$formFieldName"]["tmp_name"], $fileTarget) ) {   					
                        mytLog("uploadImg(): File with file name '" . $fileNameUpload . "' has been uploaded");
                        $fileDirName = $fileTarget;
                    }else{
                        mytLog("uploadImg(): File with file name '" . $fileNameUpload . "' could not be uploaded. Error is: " . 
                            $_FILES["$formFieldName"]["error"]);
                        $fileNameUpload = "File Upload Error";
                    }
                }
                clearstatcache(); // clear results of is_uploaded_file() when file WAS uploaded
            }
            clearstatcache(); 	 // clear results of is_uploaded_file() when file WAS NOT uploaded
        }
        
        return $fileDirName;
    }
?>