<?php
include "../../CastleConnect.php";
// include "../userProfile/userProfilePic.php";
session_start();

$data = $_POST['info'];
$length = count($data);
$userid = $_SESSION['User_Id'];

for($index = 0; $index < $length ; $index++){
    $postid = $data[$index];
    $dataStat[$index]['like'] = 0;
    $dataStat[$index]['unlike'] = 0;

    $sql = "SELECT COUNT(*) AS NUM_ROWS FROM UNLIKES_" . $postid . " WHERE User_Id = '$userid'";
    $rows = dataCount($sql, $conn);
        if($rows > 0){
            $dataStat[$index]['unlike'] = 1;
        }else{
        $sql = "SELECT COUNT(*) AS NUM_ROWS FROM LIKES_" . $postid . " WHERE User_Id = '$userid'";
        $rows = dataCount($sql, $conn);
                if($rows > 0){
                    $dataStat[$index]['like'] = 1;
                }else{
                    continue;
                }
        }


}

echo json_encode($dataStat);






