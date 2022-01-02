<?php
include "../CastleConnect.php";
// include "./userProfilePic.php";
session_start();

if(isset($_POST['follow'])){
    $follow = $_POST['follow'];
    $visitedId = $_POST['visited_id'];
    $userid =  $_SESSION['User_Id'];
    if($follow == "0"){
        $sql = "DELETE FROM " . $visitedId . "_FOLLOWERS WHERE FOLLOWER_ID = '$userid'";
        $get = oci_parse($conn, $sql);
        oci_execute($get) or die(oci_error());

    }else{
         $sql = "INSERT INTO ".$visitedId."_FOLLOWERS(USER_ID, FOLLOWER_ID) VALUES('$visitedId','$userid')";
        $get = oci_parse($conn, $sql);
        oci_execute($get) or die(oci_error());
    }
}else{
    echo "Sorry, There was an error. Please try again.";
    }