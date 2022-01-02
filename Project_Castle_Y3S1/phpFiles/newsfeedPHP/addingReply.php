<?php
include "../CastleConnect.php";
session_start();

$str1 = "0123456789ABCDEFGHIGKLMNOPQRSTUVWXYZ";
$str2 = "0123456789";
$str3 = "ABCDEFGHIGKLMNOPQRSTUVWXYZ";

do {
    $postid1 = substr(str_shuffle($str1), 0, 7);
    $postid2 = substr(str_shuffle($str2), 0, 5);
    $postid3 = substr(str_shuffle($str3), 0, 1);
    $postid4 = substr(str_shuffle($str3), 0, 5);


    $fullpostid = $postid3 . $postid1 . "_" . $postid2 . "_" . $postid4; // this is the Post_Id
    $sql = "SELECT * FROM Post WHERE Post_Id ='$fullpostid'";
    $get = dataRequest($sql, $conn);
} while (($row = oci_fetch_array($get)) > 0);


$userid = $_SESSION['User_Id'];
$parentid = $_GET['parid'];
$reply = $_GET['reply'];
$reply = str_replace('"', "\042", $reply);
$reply = str_replace("'", "''", $reply);
// $sign = intval($_GET['sign']);
$rootid = $_SESSION['postid'];


$DetailLen = strlen($reply);
while (($DetailLen - 1) % 4 != 0) {
    $reply .= " ";
    $DetailLen = strlen($reply);
}
$DetailDev = ($DetailLen - 1) / 4;

$content = substr($reply, 0, $DetailDev);
$content1 = substr($reply, $DetailDev, $DetailDev);
$content2 = substr($reply, $DetailDev * 2, $DetailDev);
$content3 = substr($reply, $DetailDev * 3, ($DetailDev + 1));

$time = date("U");
$sql = "INSERT INTO POST(Post_Id, User_Id, Post_Parent_Id, Post_Level, Post_Root, Post_Content,Post_Date ,Post_Content1,Post_Content2,Post_Content3) 
VALUES('$fullpostid', '$userid', '$parentid' , 2, '$rootid', '$content', '$time', '$content1','$content2','$content3')"; // for the first level paarentid and root will be same
dataInsert($sql, $conn);

$sql = "UPDATE POST SET Post_Comments = (Post_Comments + 1) WHERE Post_Id ='$parentid'";
dataInsert($sql, $conn);

$sql = "INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
            VALUES('$fullpostid', 1,0,0)";

dataInsert($sql, $conn);


$sql = "UPDATE USER_ SET USER_CONTENT_NO = (USER_CONTENT_NO + 1) WHERE User_Id ='$userid'";

dataInsert($sql, $conn);


// creating the LIKES_ table for the psot
$sql = "CREATE TABLE LIKES_" . $fullpostid . "(
    Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id) 
)";

dataInsert($sql, $conn);


// creating the UNLIKES_ table for the psot
$sql = "CREATE TABLE UNLIKES_" . $fullpostid . "(
    Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id) 
)";

dataInsert($sql, $conn);
