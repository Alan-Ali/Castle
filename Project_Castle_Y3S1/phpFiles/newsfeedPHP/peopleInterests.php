<?php
include "../CastleConnect.php";
session_start();


function run($conn){

    $userid = $_SESSION['User_Id'];
     
    $topicArray[] = explode(',', $_SESSION['User_Topics']);

    $path = "../../JSON/Topics.json";
    $firstUserStatus = userStatus($userid, $conn, [$path,]);

    $get = dataRequest("SELECT USER_CONTENT_NO, USER_ID, USER_TOPICS 
                        FROM USER_ WHERE USER_ID != '$userid'", $conn);
    $row = oci_fetch_array($get);

    if($row == 0) return 0;/* If there was no user return 0 */ $count = 0; /* to get number of users with usercontent more than 0*/

    do{
        $num = $row["USER_CONTENT_NO"];
            if($num > 0 && followedBlocked($userid, $row['USER_ID'], $conn)){
                /* Filter is a variable for holding the user data that can be viewed by the user
                    and filter the ones that are not necessary */
                $Filter[$count][] = $row;
                $count++;
            }

            $row = oci_fetch_array($get);
    }while($row > 0);
    
    // print_r($Filter[0]);
    /* in the loop we are going to create the counting according to the length 
    of the topicArray, which is the topics the user likes */  
   for($index = 0; $index < count($topicArray); $index++){

      /* the second array is the amount of users we filtered in the query */
      for($index1 = 0; $index1 < count($Filter); $index1++){

        // $topics[] = explode(',', $Filter[$index1][0]["USER_TOPICS"]);
            /* we are going to send back only the topics */
            $topics = userStatus($Filter[$index1][0]['USER_ID'], $conn, [$path,])[0];
            /* filtering the topics that are their value is above 0*/
            $topicFilter = topicFilter($topics);
        /*  */
         for($index2 = 0; $index2 < count($topics); $index2++){
               if($topicArray[$index] == $topics[$index2]){
                  $count = $count1 = 0;
                  // $collect[$count][$count1] = $Filter

                }
            }
        }
    }
}

function topicFilter($item){
    for($index = 0; $index < count($item); $index++){
        if($item[$index][1] > 0){
            $filtered[] = $item[$index];
        }else{
            
        }
    }    
    
    return $filtered; 
}



function followedBlocked($userid, $secondid, $conn){

    $get = dataRequest("SELECT USER_ID FROM ".$userid."_FOLLOWED WHERE FOLLOWED_ID = '$secondid'", $conn);
    $followed = oci_fetch_array($get);

    $get = dataRequest("SELECT USER_ID FROM USERS_BLOCKED_" . $secondid . " WHERE USER_BLOCKED = '$userid'", $conn);
    $blockedBySecondUser = oci_fetch_array($get);

    $get = dataRequest("SELECT USER_ID FROM USERS_BLOCKED_" . $userid . " WHERE USER_BLOCKED = '$secondid'", $conn);
    $blockedByFirstUser = oci_fetch_array($get);

    if($blockedByFirstUser > 0) return false;
    else if($blockedBySecondUser > 0) return false;
    else if($followed > 0) return false;
    else return true;

}


function filter(){

}

// here we run the function, inside the json_ecode()
function main($conn){

    echo json_encode(run($conn));

}main($conn);
// echo json_encode($topicArray);









