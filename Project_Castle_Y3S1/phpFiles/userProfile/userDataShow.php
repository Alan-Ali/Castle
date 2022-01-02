<?php
include "../CastleConnect.php";
session_start();

$userid =  $_SESSION['User_Id'];
    if(isset($_GET["email"])){
        $email = intval($_GET["email"]);
        $sql = "UPDATE USER_ SET USER_EMAIL_SHOW = '$email' WHERE User_Id = '$userid'";
        $get =  oci_parse($conn, $sql);
        oci_execute($get) or die(oci_error());
    }else if(isset($_GET["telephone"])){
        $telephone = intval($_GET["telephone"]);
        $sql = "UPDATE USER_ SET USER_TELEPHONE_NO_SHOW = '$telephone' WHERE User_Id = '$userid'";
        $get =  oci_parse($conn, $sql);
        oci_execute($get) or die(oci_error());
    }else if(isset($_GET["address"])){
        $address = intval($_GET["address"]);
        $sql = "UPDATE USER_ SET USER_ADDRESS_SHOW = '$address' WHERE User_Id = '$userid'";
        $get =  oci_parse($conn, $sql);
        oci_execute($get) or die(oci_error());
    }

?>