<?php
    include "../CastleConnect.php";
    session_start();
    $postid = $_SESSION['postid']; // this is added from the userQuestionFeed
    // $postuserid = $_SESSION['Quserid']; // this is added from the userQuestionFeed.php
    $mainuserid = $_SESSION['User_Id']; // this is added from the login.php
    $sign = intval($_GET['sign']); // this is to see whether we have to increase the like, or remove it

    if($sign == 1){
        $sql = "SELECT * FROM LIKES_" . $postid . " WHERE User_Id ='$mainuserid'";
        $get = dataRequest($sql, $conn);
        
        // we check if the value exists in the likes table, if it doesn't exist then we 
        // proceed
        if(($row = oci_fetch_array($get)) < 1){

            // we update the like attribute in the post table, by adding 1
            $sql = "UPDATE POST SET Post_Likes = (Post_Likes + 1) WHERE Post_Id ='$postid'";
            dataInsert($sql, $conn);
        

                // adding the user to the likes table
                $sql = "INSERT INTO LIKES_" . $postid . "(Post_Id, User_Id) 
                        VALUES ('$postid','$mainuserid')";
                       dataInsert($sql, $conn);
        

                // see if the user exists in the unlikes table, and remove it
                $sql = "SELECT * FROM UNLIKES_" . $postid . " WHERE User_Id ='$mainuserid'";
                $get = dataRequest($sql, $conn);
        

                    // IF THE row was bigger than 0, then we will remove the user from the likes table
                    if(($row = oci_fetch_array($get)) > 0){
                        $sql = "DELETE FROM UNLIKES_" . $postid . " WHERE User_Id ='$mainuserid'";
                        dataInsert($sql, $conn);
        
                        $sql = "UPDATE Post SET Post_Unlikes = (Post_Unlikes - 1) WHERE Post_Id ='$postid'";
                        dataInsert($sql, $conn);
        
                    }else{
                        echo "there was no unlikes from this user";        
                    }
                echo "done";
            } else {
                echo "The user already liked this post";
            }
        }else{

            // if the 0 sign sent back then we will just remove the like
            if($sign == 0){
                $sql = "UPDATE POST SET Post_Likes = (Post_Likes - 1) WHERE Post_Id ='$postid'";
                dataInsert($sql, $conn);
        
                $sql = "DELETE FROM LIKES_" . $postid . " WHERE User_Id ='$mainuserid'";
                dataInsert($sql, $conn);
        
        }
    }



?>