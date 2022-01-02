<?php
    include '../CastleConnect.php';
    // include('Arabic.php');
    
session_start();

        // this is how we make the ids, 8 of them, made of both numbers and 
        // alphabet characters, and 5 only numbers.
        // 8characters_and 5 number characters
        // but all of them 


      
    if(isset($_POST['topics'])){

        $userId;
        $username = $_POST['sign_username'];
        $role = $_POST['sign_role'];
        $password = $_POST['sign_password'];
        $date = $_POST['sign_date'];
        $month = $_POST['sign_month'];
        $year = $_POST['sign_year'];
        $telephone = $_POST['sign_telephoneno'];
        $email = $_POST['sign_email'];
        $address = $_POST['sign_address'];
        $gender = $_POST['sign_gender'];
        $topics = $_POST['topics'];
        $privacy = $_POST['sign_privacy'];
        echo $topics;
        echo $username;
        // this is how we make the ids, 8 of them, made of both numbers and 
        // alphabet characters, and 5 only numbers.
        // 8characters_and 5 number characters
        // but all of them 

        // the databases we name, will all have the same 
        $str1 = "0123456789ABCDEFGHIGKLMNOPQRSTUVWXYZ";
        $str2 = "0123456789";
        $str3 = "ABCDEFGHIGKLMNOPQRSTUVWXYZ";
        $nameid = substr(str_shuffle($str2), 0, 5); // this is the User_Name_Id
        
        


            do {
                $userid1 = substr(str_shuffle($str1), 0, 7);
                $userid2 = substr(str_shuffle($str2), 0, 5);
                $userid3 = substr(str_shuffle($str3), 0, 1);
                $fulluserid = $userid3.$userid1 . "_" . $userid2; // this is the User_Id
                $sql = "SELECT * FROM USER_ WHERE User_Id = '$fulluserid'";

                $get = oci_parse($conn, $sql);
                oci_execute($get) or die(oci_error());  

            }while(oci_fetch_array($get) > 0);

                $age = $date."-".$month."-".$year;
                // there was a problem with the todate function in the insertion part,
                // so you collected the date parts into age, and turned it to php date.
                $age = date('d-m-Y', strtotime($age));
                // echo $age;
                $telephone = intval($telephone);
                // echo gettype($telephone);
                // then you changed the date format to the way that is better read in the to_date function
                $sql = "INSERT INTO USER_ (User_Id, User_Name, User_Name_Id, User_Password, User_Email, User_Age, User_Gender, 
                User_Telephone_No, User_Address, User_Topics, User_Date_Created , User_Role, User_Role_Confirmation, User_Status, User_Content_No, User_Block_Status) 
                VALUES('$fulluserid', '$username', '$nameid', '$password', '$email', to_date('$age','DD-MM-YYYY') ,
                '$gender',  0, '$address', '$topics', SYSDATE , '$role', 0,0,0,0)";


                // creating the blocked users for the user
                $get = oci_parse($conn, $sql);
                oci_execute($get) or die(oci_error());

                $sql = "CREATE TABLE USERS_BLOCKED_$fulluserid(
                    User_Id VARCHAR2(256) NOT NULL REFERENCES USER_(User_Id),
                    User_Blocked VARCHAR2(256) NOT NULL REFERENCES USER_(User_Id),
                    FOREIGN KEY(User_Id)  REFERENCES USER_(User_Id),
                    FOREIGN KEY(User_Blocked) REFERENCES USER_(User_Id) )";

                $get =  oci_parse($conn, $sql);
                        oci_execute($get) or die(oci_error());
                
                // creating the table for the users the user follows.
                $sql = "CREATE TABLE ".$fulluserid."_Followed(
                     User_Id VARCHAR2(256) NOT NULL REFERENCES USER_(User_Id),
                     FOREIGN KEY(User_Id)  REFERENCES USER_(User_Id),
                     Followed_Id VARCHAR2(256) NOT NULL REFERENCES USER_(User_Id),
                     FOREIGN KEY(Followed_Id)  REFERENCES USER_(User_Id) )";

                // creating a table for the users that follow the user
                $get =  oci_parse($conn, $sql);
                        oci_execute($get) or die(oci_error());

                $sql = "CREATE TABLE ".$fulluserid."_Followers(
                     User_Id VARCHAR2(256) NOT NULL REFERENCES USER_(User_Id),
                     FOREIGN KEY(User_Id)  REFERENCES USER_(User_Id),
                     Follower_Id VARCHAR2(256) NOT NULL REFERENCES USER_(User_Id),
                     FOREIGN KEY(Follower_Id)  REFERENCES USER_(User_Id))";

                $get =  oci_parse($conn, $sql);
                        oci_execute($get) or die(oci_error());

    
                $_SESSION['signed_up'] = true;
                // header("location: ../newsfeedPHP/newsfeed.php");
                header("location: ./RegistrationPage.php");
                
        //   $sql = "SELECT * FROM USER_";
        // $get = oci_parse($conn, $sql);
        //  oci_execute($get) or die(oci_error());

        // while(oci_fetch($get)){
        //     echo "<p>" . oci_result($get, "USER_NAME") . oci_result($get, "USER_NAME_ID") . "</p>";
        //     echo "<p>" . oci_result($get, "USER_EMAIL") . "</p>";
        //     }
      
    }else{
        $sign = $_SESSION['signed_up'];
        if($sign){
            echo json_encode($sign);
            $_SESSION['signed_up']= "";
        }
    }
    

?> 