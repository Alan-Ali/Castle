
<?php
include "../CastleConnect.php";
session_start();

// function fixWord($string)
// {
//     $map = array(
//         '33' => '!', '34' => '"', '35' => '#', '36' => '$', '37' => '%', '38' => '&', '39' => "'", '40' => '(', '41' => ')', '42' => '*',
//         '43' => '+', '44' => ',', '45' => '-', '46' => '.', '47' => '/', '48' => '0', '49' => '1', '50' => '2', '51' => '3', '52' => '4',
//         '53' => '5', '54' => '6', '55' => '7', '56' => '8', '57' => '9', '58' => ':', '59' => ';', '60' => '<', '61' => '=', '62' => '>',
//         '63' => '?', '64' => '@', '65' => 'A', '66' => 'B', '67' => 'C', '68' => 'D', '69' => 'E', '70' => 'F', '71' => 'G', '72' => 'H',
//         '73' => 'I', '74' => 'J', '75' => 'K', '76' => 'L', '77' => 'M', '78' => 'N', '79' => 'O', '80' => 'P', '81' => 'Q', '82' => 'R',
//         '83' => 'S', '84' => 'T', '85' => 'U', '86' => 'V', '87' => 'W', '88' => 'X', '89' => 'Y', '90' => 'Z', '91' => '[', '92' => '\\',
//         '93' => ']', '94' => '^', '95' => '_', '96' => '`', '97' => 'a', '98' => 'b', '99' => 'c', '100' => 'd', '101' => 'e', '102' => 'f',
//         '103' => 'g', '104' => 'h', '105' => 'i', '106' => 'j', '107' => 'k', '108' => 'l', '109' => 'm', '110' => 'n', '111' => 'o', '112' => 'p',
//         '113' => 'q', '114' => 'r', '115' => 's', '116' => 't', '117' => 'u', '118' => 'v', '119' => 'w', '120' => 'x', '121' => 'y', '122' => 'z',
//         '123' => '{', '124' => '|', '125' => '}', '126' => '~', '127' => ' ', '128' => '&#8364;', '129' => ' ', '130' => ',', '131' => ' ', '132' => '"',
//         '133' => '.', '134' => ' ', '135' => ' ', '136' => '^', '137' => ' ', '138' => ' ', '139' => '<', '140' => ' ', '141' => ' ', '142' => ' ',
//         '143' => ' ', '144' => ' ', '145' => "'", '146' => "'", '147' => '"', '148' => '"', '149' => '.', '150' => '-', '151' => '-', '152' => '~',
//         '153' => ' ', '154' => ' ', '155' => '>', '156' => ' ', '157' => ' ', '158' => ' ', '159' => ' ', '160' => ' ', '161' => '¡', '162' => '¢',
//         '163' => '£', '164' => '¤', '165' => '¥', '166' => '¦', '167' => '§', '168' => '¨', '169' => '©', '170' => 'ª', '171' => '«', '172' => '¬',
//         '173' => '­', '174' => '®', '175' => '¯', '176' => '°', '177' => '±', '178' => '²', '179' => '³', '180' => '´', '181' => 'µ', '182' => '¶',
//         '183' => '·', '184' => '¸', '185' => '¹', '186' => 'º', '187' => '»', '188' => '¼', '189' => '½', '190' => '¾', '191' => '¿', '192' => 'À',
//         '193' => 'Á', '194' => 'Â', '195' => 'Ã', '196' => 'Ä', '197' => 'Å', '198' => 'Æ', '199' => 'Ç', '200' => 'È', '201' => 'É', '202' => 'Ê',
//         '203' => 'Ë', '204' => 'Ì', '205' => 'Í', '206' => 'Î', '207' => 'Ï', '208' => 'Ð', '209' => 'Ñ', '210' => 'Ò', '211' => 'Ó', '212' => 'Ô',
//         '213' => 'Õ', '214' => 'Ö', '215' => '×', '216' => 'Ø', '217' => 'Ù', '218' => 'Ú', '219' => 'Û', '220' => 'Ü', '221' => 'Ý', '222' => 'Þ',
//         '223' => 'ß', '224' => 'à', '225' => 'á', '226' => 'â', '227' => 'ã', '228' => 'ä', '229' => 'å', '230' => 'æ', '231' => 'ç', '232' => 'è',
//         '233' => 'é', '234' => 'ê', '235' => 'ë', '236' => 'ì', '237' => 'í', '238' => 'î', '239' => 'ï', '240' => 'ð', '241' => 'ñ', '242' => 'ò',
//         '243' => 'ó', '244' => 'ô', '245' => 'õ', '246' => 'ö', '247' => '÷', '248' => 'ø', '249' => 'ù', '250' => 'ú', '251' => 'û', '252' => 'ü',
//         '253' => 'ý', '254' => 'þ', '255' => 'ÿ'
//     );

//     $search = array();
//     $replace = array();

//     foreach ($map as $s => $r) {
//         $search[] = chr((int)$s);
//         $replace[] = $r;
//     }

//     return str_replace($search, $replace, $string);
// }


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
    $get = dataRequest($sql, $conn);

}while(($row = oci_fetch_array($get)) > 0);

   $userid = $_SESSION['User_Id'];
   $sign = intval($_GET['sign']);

    $topic = $_GET['tp'];
    $QuestionHeader = $_GET['qh'];
    $QuestionDetails = $_GET['qd'];

$QuestionHeader = str_replace('"', "\042",$QuestionHeader);
$QuestionHeader = str_replace("'", "''", $QuestionHeader);
$QuestionDetails = str_replace('"', "\042", $QuestionDetails);
$QuestionDetails = str_replace("'", "''", $QuestionDetails);
// $countLen = strlen($QuestionDetails);

// $QuestionHeader = fixWord($QuestionHeader);
// $QuestionDetails = fixWord($QuestionDetails);

    // here we want to make sure the characters are well divisible by 
    // 
    $DetailLen = strlen($QuestionDetails);
    while(($DetailLen - 1) % 4 != 0){
        $QuestionDetails .= " ";
        $DetailLen = strlen($QuestionDetails);
    }
    $DetailDev = ($DetailLen - 1) / 4;

    $content = substr($QuestionDetails, 0, $DetailDev);
    $content1 = substr($QuestionDetails, $DetailDev, $DetailDev);
    $content2 = substr($QuestionDetails, $DetailDev * 2, $DetailDev);
    $content3 = substr($QuestionDetails, $DetailDev * 3, ($DetailDev + 1));


    $time = date("U");
    $sql = "INSERT INTO POST(Post_Id, User_Id, Post_Content, Post_Content_Header, Post_Topic, Post_Date, Post_Content1,Post_Content2,Post_Content3)
    VALUES('$fullpostid', '$userid', '$content', '$QuestionHeader', '$topic', '$time', '$content1','$content2','$content3')";
dataInsert($sql, $conn);

    

$sql = "INSERT INTO Post_Status(Post_Id, Reply, Question, Answer)
        VALUES('$fullpostid', 0,1,0)";

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

?>