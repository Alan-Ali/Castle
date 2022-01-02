<!DOCTYPE html>
<?php
include "./CastleConnect.php";
/* this disable the warning_messages*/
// error_reporting(E_ALL ^ E_WARNING);
// session_start();
// $conn = oci_connect("Test", "alanff13!xv", "localhost/XE", "AL32UTF8");

// $string = "lasjksdflasdjklajslkdjf al sksdjf df";
// $len = strlen($string);

/* ONE WAY HOW NUMERIC TIME WORKS IN SECONDS IN PHP AND JAVASCRIPT

-> The time we get in php is somethime like that in php: 1633644000 = this is seconds
    -> this is using date("U");

-> the time we get in Javascript 1633714541560 = this is milliseconds
    -> to make it to seconds we simply divide it by 1000.
    -> we get these milliseconds using : Date.now() and don't forget to use Math.round(), like this:
        -> const secondsSinceEpoch = Math.round(Date.now() / 1000);
    -> the other way: 
        -> const now = new Date()  
           const secondsSinceEpoch = Math.round(now.getTime() / 1000)

*/

// ................test....................

// $text = 'بۆچی ئەمە ڕوو ئەدات';


// $time = date('Y-m-d H:i:s');
// $time1 = date("U");
// $time2 = getdate(date("U"));
// echo $time . " --- " . $time1 . " --- " . "$time2[weekday], $time2[month], $time2[year], ";
// echo "<br>";
// // echo "";

// $sql1 = "SELECT * FROM user1 WHERE raneom IS NULL";
// $get1 = oci_parse($conn, $sql1);
// oci_execute($get1) or die(oci_error());
// $row = oci_fetch_array($get1);

// $orgDate = "2019-09-15";
// $newDate = date("d-m-Y H:i:s", strtotime($orgDate));
// echo "New date format is: " . $newDate . " (MM-DD-YYYY), <br>";

// do {
//     // echo $row['DAYTIME'];
//     $time = date("U", strtotime($row['DAYTIME']));
//     echo $time;

//     $row = oci_fetch_array($get1);
//     echo "<br>";
// } while ($row > 0);
// ................test....................


// ................test....................
// $test = "falsjdf lasjdfl alkljsdf asdjf asdjksdf alkjsdflajlksdj dsj dfsjfla slkjdfla sdjf''aslksjf a;asdkfjalksjdfaaa";
// $test1 = "falsjdf lasjdfl alkljsdf asdjf asdjksdf alkjsdflajlksdj dsj dfsjfla slkjdfla sdjf''aslksjf a;asdkfjalksjdf ";
// $test2 = "falsjdf lasjdfl alkljsdf asdjf asdjksdf alkjsdflajlksdj dsj dfsjfla slkjdfla sdjf''aslksjf a;asdkfjalksjdf ";


// $time = "1300";
// $time = substr($time, 0, 2) . ':' . substr($time, 2, 2);

// $DetailLen = strlen($test);
// // if()
// while (($DetailLen - 1) % 4 != 0) {
//     $test .= "b";
//     $DetailLen = strlen($test);
// }
// $DetailDev = ($DetailLen - 1) / 4;


// $content1 = substr($test, 0, $DetailDev);
// $content2 = substr($test, $DetailDev, $DetailDev);
// $content3 = substr($test, $DetailDev*2, $DetailDev);
// $content4 = substr($test, $DetailDev*3, $DetailDev+1);

// echo $test . "</br>";


// echo $content1 . "</br>";
// echo $content2 . "</br>";
// echo $content3 . "</br>";
// echo $content4 . "</br>";
// ................test....................

// $sql = "INSERT INTO USER1(RANDOM, RANDOM1, RANDOM2) VALUES('$test','$test1','$test2')";
// $get = oci_parse($conn, $sql);
// oci_execute($get) or die(oci_error());


///////////////////////// START json test
$json_data = file_get_contents("../JSON/Topics.json");

// the true is for making the data associative data
$json_data = json_decode($json_data, true);
// $json_data = json_encode($json_data);

print_r(count($json_data["Topics"]));

// for ($index = 0; $index < count($json_data["Topics"]); $index++) {
//     $Topics[$index][0] = $json_data["Topics"][$index]['topic'];
//     $Topics[$index][1] = 0;
//     echo $Topics[$index][0]. " ";
// }


echo "<br>";

/* this holds 2 arrays, one for topics, one for answer, replies and questions etc... */
$data = userStatus("F68M9GAF_34927", $conn, ["../JSON/Topics.json",]);
print_r($data);

    for($index = 0; $index < count($data[1]); $index++){
    echo $data[1]["questions"]."</br>";
    }
// echo $data[1][0]["upvotes"] . "</br>";

///////////////////////// END json test


// $test = dataRequest("SELECT 1 FROM USER", $conn);
// $data = oci_fetch_array($test);

// if($data){
//     print 1;
// }else{
//     print 0;
// }


// $connect = oci_pconnect("Test", "alanff13!xv",'localhost/XE', 'AL32UTF8');

// $values[0] = 1;
// $values[1] = 2;

// $get = oci_parse($connect, "INSERT INTO USER1(RANDOM1, RANDOM2) VALUES($values[0], $values[1])");
// oci_execute($get) or die(oci_error());  


?>
<html>

<head>

</head>

<body>
    <!-- <form action='../javascriptFiles/JSTestFile.php' method='GET'>
        <a href='../javascriptFiles/JSTestFile.php'>clickme</a>
    </form> -->

    <div id='demo'></div>

</body>
<script type='text/javascript'>
    // var demo = document.getElementById('demo');

    // // var time = Math.round(Date.now() / 1000) + 86400;
    // var time1 = new Date();

    // var hello = Math.round(Date.now());

    // var time = new Date();

    // // var time2 = new Date().tolo

    // const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    // // const timezone = Intl.DateTimeFormat().resolvedOptions().hour12 ;

    // demo.innerHTML += time + "<br>" +
    //     hello + "<br>" +
    //     time1.getSeconds() + "<br>";

    // ;
</script>

</html>