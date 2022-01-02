<?php
include "../CastleConnect.php";
session_start();

$userid =  $_SESSION['User_Id'];
$sql = "SELECT * FROM USER_ WHERE User_Id = '$userid'";
$get =  oci_parse($conn, $sql);
oci_execute($get) or die(oci_error());
$row = oci_fetch_array($get);
    if($row > 0){
            // $row = oci_fetch_array($get);
            $data[] = $row;
            echo json_encode($data);
    }else{
        echo json_encode(0);
    }
    
?>