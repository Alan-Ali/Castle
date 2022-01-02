<?php
include "../CastleConnect.php";
// include "./userProfilePic.php";
session_start();

// $sql = "";
$userid =  $_SESSION['User_Id'];
$visitedId = $_POST['visited_id'];
$sql = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM ".$visitedId."_FOLLOWERS WHERE FOLLOWER_ID = '$userid'";
$stmt = oci_parse($conn, $sql);
oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $numOfRows);
oci_execute($stmt);
oci_fetch($stmt);
oci_free_statement($stmt);

if($numOfRows > 0){
    echo json_encode("1");
    // echo "1";
}else{
    echo json_encode("0");
    // echo "0";
}




