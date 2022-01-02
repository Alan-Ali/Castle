<?php
include "../CastleConnect.php";
// include "./userProfilePic.php";
session_start();

$desc = $_GET['description'];
$userid =  $_SESSION['User_Id'];

$sql = "UPDATE USER_ SET USER_DESCRIPTION = '$desc' WHERE USER_ID = '$userid'";
$get = oci_parse($conn, $sql);
oci_execute($get) or die(oci_error());
 echo "done";