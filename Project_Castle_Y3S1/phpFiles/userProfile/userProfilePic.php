<?php
    include "../CastleConnect.php";
    // require "../users";
    session_start();

    // this sql part must be concerned with userprofile picture, 
    // that will be worked on later.  
            $backimage = false;
            if(isset($_GET['backimage'])){
                $backimage = true;
            }
            $userid = $_SESSION['User_Id'];
            if($backimage){
                $fileName = $_FILES['userbackground']['name'];
                $fileTempName = $_FILES['userbackground']['tmp_name'];
                $fileSize = $_FILES['userbackground']['size'];
                $fileError = $_FILES['userbackground']['error'];
                $fileType = $_FILES['userbackground']['type']; 
            }else{
                $fileName = $_FILES['userimage']['name'];
                $fileTempName = $_FILES['userimage']['tmp_name'];
                $fileSize = $_FILES['userimage']['size'];
                $fileError = $_FILES['userimage']['error'];
                $fileType = $_FILES['userimage']['type'];
            }
            $fileExt = explode('.', $fileName);
            $length = count($fileExt);  
            $ActualExt = strtolower(end($fileExt));
            $collectName = "";
            
            // this collects all the name inside the fileName variable, except the file type
            for($index = 0; $index < $length -1; $index++){
                $collectName .= $fileExt[$index];
            }
                // $allowed = array('jpeg', 'jpg', 'png', 'pdf');

                // echo $fileType. ", " . $fileName. ", ". $fileTempName. ", " . $fileSize .", " . $fileError;
                $str1 = "0123456789ABCDEFGHIGKLMNOPQRSTUVWXYZ";
                $str2 = "0123456789";
                $str3 = "ABCDEFGHIGKLMNOPQRSTUVWXYZ";
                do {
                        $picid1 = substr(str_shuffle($str1), 0, 7);
                        $picid2 = substr(str_shuffle($str2), 0, 5);
                        $picid3 = substr(str_shuffle($str3), 0, 1);
                        $picid4 = substr(str_shuffle($str3), 0, 5);
                        $fullpicid = $picid3.$picid1. "_" . $picid2."_".$picid4; // this is the User_Id
                    if($backimage){
                        $sql = "SELECT * FROM USER_BACKGROUND_PIC WHERE BACKGROUND_PIC_ID = '$fullpicid'";
                        $get = oci_parse($conn, $sql);
                        oci_execute($get) or die(oci_error());
                    }else{
                        $sql = "SELECT * FROM USER_PROFILE_PIC WHERE PROFILE_PIC_ID = '$fullpicid'";
                        $get = oci_parse($conn, $sql);
                        oci_execute($get) or die(oci_error());
                    }
                   

                } while (oci_fetch_array($get) > 0);
                // $sql = "SELECT * FROM USER_PRFILE_PIC WHERE User_Id = '$userid'";
                // $get = oci_parse($conn, $sql);
                // oci_execute($get) or die(oci_error());


                /////////////////////// choosing pic number for different parts
                if($backimage){
                    $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM USER_BACKGROUND_PIC WHERE User_Id = '$userid'";
                }else{
                    $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM USER_PROFILE_PIC WHERE User_Id = '$userid'";
                }   
                    $stmt = oci_parse($conn, $sql2);
                    oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $numrows);
                    oci_execute($stmt) or die(oci_error());
                    oci_fetch($stmt);
                    oci_free_statement($stmt);
                /////////////////////// choosing pic number for different parts

                // WE check if the file has errors
                if($fileError == 0){
                    // here we are checking through the user profile pic table, and 
                    // we are updating the last set pic status to 0, so that we can update it to the new one.
                    if($backimage){
                        $sqlUpdate = "UPDATE USER_BACKGROUND_PIC SET Back_Pic_Status = 0 WHERE User_Id = '$userid' AND Back_Pic_Status = 1";
                    }else{
                        $sqlUpdate = "UPDATE USER_PROFILE_PIC SET Pic_Status = 0 WHERE User_Id = '$userid' AND Pic_Status = 1";
                    }
                    $get =  oci_parse($conn, $sqlUpdate);
                    oci_execute($get) or die(oci_error());

                        $permission = 0777;
                        if($backimage){
                            $Insertion_Directory = "../users/user_" . $userid . "/backimages/";
                        }else{
                            $Insertion_Directory = "../users/user_" . $userid . "/images/";
                        }
                    if(!(is_dir($Insertion_Directory))){
                        // here we faced a problem, it got solved by adding the true, 
                        // because the true enabled the recursive directories in the 
                        // specified directory.
                        mkdir($Insertion_Directory, $permission, true);  
                        // $Insertion_Directory = opendir($Insertion_Directory);
                        $fullDestination = $Insertion_Directory.$collectName.".".$ActualExt;
                        move_uploaded_file($fileTempName, $fullDestination);       
                    }else{
                        $fullDestination = $Insertion_Directory . $collectName . "." . $ActualExt;
                        move_uploaded_file($fileTempName, $fullDestination); 
                    } 
                       
                    if(is_dir($Insertion_Directory)){
                        $numrows += 1;
                        $status = 1;
                        if($backimage){
                            $sql = "INSERT INTO USER_BACKGROUND_PIC(Background_Pic_Id, User_Id,
                            Back_Pic_Data_Type, Back_Pic_Name, Back_Pic_Directory, Back_User_Pic_Number, Back_Pic_Status, 
                            Back_Pic_Date) VALUES('$fullpicid', '$userid', '$ActualExt','$collectName',
                            '$Insertion_Directory', '$numrows', '$status', SYSDATE)";
                        }else{
                            $sql = "INSERT INTO USER_PROFILE_PIC(Profile_Pic_Id, User_Id,
                            Pic_Data_Type, Pic_Name, Pic_Directory, User_Pic_Number, Pic_Status, Pic_Date)
                            VALUES('$fullpicid', '$userid', '$ActualExt','$collectName',
                            '$Insertion_Directory', '$numrows', '$status', SYSDATE)";
                        }
                       

                        $get =  oci_parse($conn, $sql);
                        oci_execute($get) or die(oci_error());
                        header("location: ./userProfile.php");
                    }else{
                        echo "Sorry, There was an error with file submission.";
                    }

                }else{
                    echo "Sorry, There Was An Error With The File Submission.";
                }



?>  