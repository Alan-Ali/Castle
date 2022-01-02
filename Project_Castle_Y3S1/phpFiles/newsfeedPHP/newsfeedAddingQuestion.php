
<?php
include "../CastleConnect.php";
session_start();


$topic = $_GET['tp'];
$QuestionHeader = $_GET['qh'];
$QuestionDetails = $_GET['qd'];
$userid = $_SESSION['User_Id'];

$str1 = "0123456789ABCDEFGHIGKLMNOPQRSTUVWXYZ";
$str2 = "0123456789";
$str3 = "ABCDEFGHIGKLMNOPQRSTUVWXYZ";

do{
    $postid1 = substr(str_shuffle($str1), 0, 7);
    $postid2 = substr(str_shuffle($str2), 0, 5);
    $postid3 = substr(str_shuffle($str3), 0, 1);
    $postid4 = substr(str_shuffle($str3), 0, 5);


    $fullpostid = $postid3 . $postid1 . "_" . $postid2."_".$postid4; // this is the Post_Id
    $sql = "SELECT * FROM Post WHERE Post_Id ='$fullpostid'";
    $get = oci_parse($conn, $sql);
    oci_execute($get) or die(oci_error());

}while(($row = oci_fetch_array($get)) > 0);

// inserting the post into the POST table
$time = date("U");
$sql = "INSERT INTO POST(Post_Id, User_Id, Post_Content, Post_Content_Header, Post_Topic, Post_Date)
VALUES('$fullpostid', '$userid', '$QuestionDetails', '$QuestionHeader', '$topic', '$time')";

$get = oci_parse($conn, $sql);
oci_execute($get) or die(oci_error());

// inserting the post status
$sql = "INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
VALUES('$fullpostid', 0,1,0)";

$get = oci_parse($conn, $sql);
oci_execute($get) or die(oci_error());

// creating the LIKES_ table for the psot
$sql = "CREATE TABLE LIKES_" . $fullpostid . "(
    Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id) 
)";

$get = oci_parse($conn, $sql);
oci_execute($get) or die(oci_error());


// creating the UNLIKES_ table for the psot
$sql = "CREATE TABLE UNLIKES_" . $fullpostid . "(
    Post_Id VARCHAR2(256) NOT NULL REFERENCES Post(Post_Id),
    FOREIGN KEY(Post_Id) REFERENCES Post(Post_Id),
    User_Id VARCHAR2(256) NOT NULL REFERENCES User_(User_Id),
    FOREIGN KEY(User_Id)  REFERENCES User_(User_Id) 
)";

$get = oci_parse($conn, $sql);
oci_execute($get) or die(oci_error());

?>