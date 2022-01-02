<?php
    include '../CastleConnect.php';
    $email = $_GET['email'];
    $sql = "SELECT * FROM USER_ WHERE User_Email = '$email'";

    $get = oci_parse($conn, $sql);
    oci_execute($get) or die(oci_error());

    if(oci_fetch($get) > 0)
        echo 1;
    else
        echo 0;
    
?>