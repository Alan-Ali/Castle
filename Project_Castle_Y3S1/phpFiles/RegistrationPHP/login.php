<?php
    include '../../phpFiles/CastleConnect.php';
    session_start();
    if(isset($_POST['login_email']) && isset($_POST['login_password'])){
       
        $sql = "SELECT * FROM USER_";
        $get = oci_parse($conn, $sql);
        oci_execute($get) or die(oci_error());
        
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        while($row = oci_fetch_array($get, OCI_BOTH)){
            if($email == $row['USER_EMAIL'] && $password == $row['USER_PASSWORD'] ){
                $value = true;
                $_SESSION['User_Id'] = $row['USER_ID'];
                $_SESSION['User_Name'] = $row['USER_NAME'];
                $_SESSION['User_Name_Id'] = $row['USER_NAME_ID'];
                // $_SESSION['User_Password'] = $row['USER_PASSWORD'];
                $_SESSION['User_Email'] = $row['USER_EMAIL'];
                $_SESSION['User_Age'] = $row['USER_AGE'];
                $_SESSION['User_Gender'] = $row['USER_GENDER'];
                $_SESSION['User_Telephone_No'] = $row['USER_TELEPHONE_NO'];
                $_SESSION['User_Address'] = $row['USER_ADDRESS'];
                $_SESSION['User_Topics'] = $row['USER_TOPICS'];
                $_SESSION['User_Date_Created'] = $row['USER_DATE_CREATED'];
                $_SESSION['User_Role'] = $row['USER_ROLE'];
                $_SESSION['User_Role_Confirmation'] = $row['USER_ROLE_CONFIRMATION'];
                $_SESSION['User_Status'] = $row['USER_STATUS'];
                $_SESSION['User_Content_No'] = $row['USER_CONTENT_NO'];
                $_SESSION['User_Block_Status'] = $row['USER_BLOCK_STATUS'];
                break;
            }else{
                $value = false;
            }
        }

        if($value){
            $_SESSION['login'] = true;
            echo 1;
            header("location: ../newsfeedPHP/newsfeed.php");
        }else{
            echo 0;
            header("location: RegistrationPage.php");
        }
    }else{
        echo 0;
    }

        // $sql = "SELECT * FROM USER_";
        // $get = oci_parse($conn, $sql);
        // oci_execute($get) or die(oci_error());
        
        // // $email = $_POST['login_email'];
        // // $password = $_POST['login_password'];

        // while($row = oci_fetch_array($get, OCI_BOTH)){
        //     echo $row['USER_EMAIL'];
        // }

?> 
