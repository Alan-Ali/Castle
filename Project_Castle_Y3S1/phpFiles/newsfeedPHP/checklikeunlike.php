<?php
include "../CastleConnect.php";
session_start();
$postid = $_SESSION['postid']; // this is added from the userQuestionFeed
$postuserid = $_SESSION['Quserid']; // this is added from the userQuestionFeed.php
$mainuserid = $_SESSION['User_Id']; // this is added from the login.php
// $sign = intval($_GET['sign']); // this is to see whether we have to increase the like, or remove it


$sql = "SELECT * FROM LIKES_" . $postid . " WHERE User_Id ='$mainuserid'";
$get = dataRequest($sql, $conn);
    if(($row = oci_fetch_array($get)) > 0){
        $data = 1;
        echo $data;
    }else{
        $sql = "SELECT * FROM UNLIKES_" . $postid . " WHERE User_Id ='$mainuserid'";
        $get = dataRequest($sql, $conn);
            if(($row = oci_fetch_array($get)) > 0){
                $data = 0;
                echo $data;
            }else{
                $data = -1;
                echo $data;
            }
    }
oci_free_statement($get);