<?php
include "../../CastleConnect.php";
session_start();

$sign = intval($_GET["sign"]);
$postid = $_GET["poid"];
// $parentid = $_SESSION["postid"];
$mainuserid = $_SESSION["User_Id"];

if ($sign == 1) {
    $sql = "SELECT * FROM UNLIKES_" . $postid . " WHERE User_Id ='$mainuserid'";
    $get = dataRequest($sql, $conn);

    // we check if the value exists in the likes table, if it doesn't exist then we 
    // proceed
    if (($row = oci_fetch_array($get)) < 1) {
        // increasing unlikes in the post table
        $sql = "UPDATE Post SET Post_Unlikes = (Post_Unlikes + 1) WHERE Post_Id ='$postid'";
        dataInsert($sql, $conn);

        // adding the user to the likes table
        $sql = "INSERT INTO UNLIKES_" . $postid . "(Post_Id, User_Id) 
                    VALUES ('$postid','$mainuserid')";
        dataInsert($sql, $conn);
        
        // see if the user exists in the likes table, and remove it
        $sql = "SELECT * FROM LIKES_" . $postid . " WHERE User_Id ='$mainuserid'";
        $get = dataRequest($sql, $conn);

        // IF THE row was bigger than 0, then we will remove the user from the likes table
        if (($row = oci_fetch_array($get)) > 0) {
            $sql = "DELETE FROM LIKES_" . $postid . " WHERE User_Id ='$mainuserid'";
            dataInsert($sql, $conn);

            $sql = "UPDATE Post SET Post_Likes = (Post_Likes - 1) WHERE Post_Id ='$postid'";
            dataInsert($sql, $conn);
        
        } else {
            echo "there was no unlikes from this user";
        }
        echo "done";
    } else {
        echo "The user already liked this post";
    }
} else {
    if ($sign == 0) {
        $sql = "UPDATE POST SET Post_Unlikes = (Post_Unlikes - 1) WHERE Post_Id ='$postid'";
        dataInsert($sql, $conn);

        $sql = "DELETE FROM UNLIKES_" . $postid . " WHERE User_Id ='$mainuserid'";
        dataInsert($sql, $conn);
        
    }
} 


echo "AnsUnlike";