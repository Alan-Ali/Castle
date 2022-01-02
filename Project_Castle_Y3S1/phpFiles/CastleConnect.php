<?php

// use function PHPSTORM_META\override;

$conn = oci_pconnect('PROJECT_CASTLE', 'PROJECT_CASTLE', 'localhost/XE', 'AL32UTF8');
error_reporting(E_ALL ^ E_WARNING);

function dataRequest($request, $conn){
    // $fullpostid = $postid3 . $postid1 . "_" . $postid2 . "_" . $postid4; // this is the Post_Id
    $get = oci_parse($conn, $request);
    oci_execute($get) or die(oci_error());
    // return ($get != (null || 0) ? $get : null);
    return $get;
}

/* can be used for both insertion and update */
function dataInsert($insert, $conn){
    $get = oci_parse($conn, $insert);
    oci_execute($get) or die(oci_error());
    oci_free_statement($get);
}

function dataCount($request, $conn){
    $stmt = oci_parse($conn, $request);
    oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $number_of_rows);
    oci_execute($stmt);
    oci_fetch($stmt);
    oci_free_statement($stmt);
    return $number_of_rows;
}

  
 /* this is for sorting from highest to lowest value*/
function sorting($Topics){
        do {
        $swap = false;
            for($index = 0; $index < count($Topics) - 1; $index++){
                if($Topics[$index][1] < $Topics[$index + 1][1]){
                    $temp = $Topics[$index + 1];
                    $Topics[$index + 1] = $Topics[$index];
                    $Topics[$index] = $temp;
                    $swap = true;
                }
            }
        }while($swap);
        return $Topics;
}


/* path is an array for the amount of paths that maybe needed in the future */
function userStatus($userid, $conn, $path){
     /* a function for shortening search for topic values */
    function topicCollect($Topics, $json_data, $rootTopic, $value){
        for ($index = 0; $index < count($json_data["Topics"]); $index++) {
            if ($rootTopic == $Topics[$index][0]) {
                $Topics[$index][1] += $value;
                // echo $Topics[$index][1] . ", " . $Topics[$index][0]  . "</br>";
                break;
            }
        }
        return $Topics;
    }


    /* taking values from the Topics.json*/
    $json_data = file_get_contents($path[0]);
    /* the true is for making the data associative data,
    here we decode the data into php associative array */
    $json_data = json_decode($json_data, true);
    //  $json_data = json_encode($json_data); 

    //  print_r($json_data); 
    for($index = 0 ; $index < count($json_data["Topics"]); $index++){
        $Topics[$index][0] = $json_data["Topics"][$index]['topic'];
        $Topics[$index][1] = 0;    
    }

   
    /* going through the levels*/
    for($level = 0; $level < 3; $level++){
        /* giving different values according to the level */
        if($level == 0) $value = 3;         /* value for question */ 
        else if($level == 1) $value = 2;    /* value for answer */
        else $value = 1;                    /* value for reply */

        /* requesting for user post in the current $level */
        $request = "SELECT POST_ID, POST_ROOT FROM POST WHERE USER_ID = '$userid' AND POST_LEVEL = $level";
        $get = dataRequest($request, $conn);
        $post = oci_fetch_array($get);

        /* while the user has post in the current level */
        while ($post > 0) {
            /* getting the root id of the post, We make if and else since level 0 don't have a root id */
            if($level == 0) $root = $post["POST_ID"];  
            else $root = $post["POST_ROOT"];
            
            /* requesting the root id topic*/
            $get1 = dataRequest("SELECT POST_TOPIC FROM POST WHERE POST_ID = '$root'", $conn);
            $rootPost = oci_fetch_array($get1);
            $rootTopic = $rootPost['POST_TOPIC'];
            /* going through which topics the user was active in an add activity level*/
            $Topics = topicCollect($Topics, $json_data,$rootTopic, $value);

            /* fetching the $post for another value */
            $post = oci_fetch_array($get); 
        }

    }

    /* Number of questions */
    $que = $activityNum["questions"] = intval(dataCount("SELECT COUNT(*) AS NUMBER_OF_ROWS FROM POST WHERE USER_ID = '$userid' AND POST_LEVEL = 0", $conn));
    /* Number of Answers */
    $ans = $activityNum["answers"] = intval(dataCount("SELECT COUNT(*) AS NUMBER_OF_ROWS FROM POST WHERE USER_ID = '$userid' AND POST_LEVEL = 1", $conn));
    /* Number of Replies */
    $rep = $activityNum["replies"] = intval(dataCount("SELECT COUNT(*) AS NUMBER_OF_ROWS FROM POST WHERE USER_ID = '$userid' AND POST_LEVEL = 2", $conn));
    /* Number of Followers*/
    $followers = $activityNum["followers"] = intval(dataCount("SELECT COUNT(*) AS NUMBER_OF_ROWS FROM " . $userid . "_FOLLOWERS", $conn));
    /* Number of Followed */
    $followed = $activityNum["followed"] = intval(dataCount("SELECT COUNT(*) AS NUMBER_OF_ROWS FROM " . $userid . "_FOLLOWED", $conn));
    
    $get = dataRequest("SELECT POST_TOPIC, POST_ID FROM POST", $conn);
    $post = oci_fetch_array($get);
    $value = .25; $upvotes = 0; $downvotes = 0;

    /* this one is for collecting data from all the available posts, and on what the user upvoted and downvoted*/
    while($post > 0){
        $postid = $post["POST_ID"];
        
        
        $get = dataRequest("SELECT * FROM LIKES_" . $postid . " WHERE User_Id ='$userid'", $conn);
        $data = oci_fetch_array($get);
        /* if it exists it will add a value to the topic */
        if($data > 0){
            $gonext = false;
            // $upvotes += 1;
            $rootTopic = $post['POST_TOPIC'];
            $Topics = topicCollect($Topics, $json_data, $rootTopic, $value);
        }
        else $gonext = true;

        /* if it wasn't available in the upvotes we will search in the downvotes */
        if($gonext){
            $get1 = dataRequest("SELECT * FROM UNLIKES_" . $postid . " WHERE User_Id ='$userid'", $conn);
            $data = oci_fetch_array($get1);
            if($data > 0){
                // $downvotes += 1;
                $rootTopic = $post['POST_TOPIC'];
                $Topics = topicCollect($Topics, $json_data, $rootTopic, $value);
            }
        
        }
        
       $post = oci_fetch_array($get);
    }   

    /* Sorting the Topics */
    $Topics = sorting($Topics);

    /* request data from the post table to collect upvotes and downvotes */
    $votes = dataRequest("SELECT * FROM POST", $conn);
    $voteData = oci_fetch_array($votes);

        /* request data from */
        while($voteData > 0){
            $postUserId = $voteData['USER_ID'];
            $postPostId = $voteData['POST_ID'];

            /* getting the upvotes of the post */
            $postVote = dataRequest("SELECT * FROM LIKES_" . $postPostId . " WHERE User_Id ='$postUserId'", $conn);
            $upvoteRetrieve = oci_fetch_array($postVote);

                if($upvoteRetrieve > 0){
                    $upvotes += 1;
                }else{
                    /* getting the downvotes of the post */
                    $postVote = dataRequest("SELECT * FROM UNLIKES_" . $postPostId . " WHERE User_Id ='$postUserId'", $conn);
                    $downvoteRetrieve = oci_fetch_array($postVote);
                    if($downvoteRetrieve > 0){
                        $downvotes += 1;
                    }
                }
            $voteData = oci_fetch_array($votes);

        }

    /* NUMBER OF UPVOTES */
    $activityNum["upvotes"] = $upvotes ?? 0;
    /* NUMBER OF DOWNVOTES */
    $activityNum["downvotes"] = $downvotes ?? 0;


    ////////////////////////////////////// START OF THE TABLE INSERTION

    $exists = dataRequest("SELECT 1 FROM USER_DATA", $conn);
    $getData = oci_fetch_array($exists);

     /* Creating a table for holding data */
    if ($getData) {
        $get = dataRequest("SELECT USER_ID FROM USER_DATA WHERE USER_ID = '$userid'", $conn);
        $data = oci_fetch_array($get);
        
        /* If the data exists it will be updated*/
        if($data > 0){
            $sql = "UPDATE USER_DATA SET NUM_QUESTIONS=$que,NUM_ANSWERS=$ans,NUM_REPLIES=$rep,
             NUM_FOLLOWERS=$followers, NUM_FOLLOWED=$followed WHERE USER_ID = '$userid'";
            dataInsert($sql, $conn);
        }
        else{ /* else if the data doesn't exist we will create the data */
            $sql = "INSERT INTO USER_DATA(USER_ID, NUM_QUESTIONS, NUM_ANSWERS, NUM_REPLIES, NUM_FOLLOWERS, NUM_FOLLOWED, UPVOTES, DOWNVOTES)
                        VALUES ('$userid', $que, $ans, $rep, $followers, $followed, $upvotes, $downvotes)";
            dataInsert($sql, $conn);
        }

    }
    else {
        $sql = "CREATE TABLE USER_DATA(
            User_Id VARCHAR2(256) NOT NULL REFERENCES USER_(User_Id),
            FOREIGN KEY(User_Id) REFERENCES USER_(User_Id),
            NUM_QUESTIONS NUMBER(21) DEFAULT(0),
            NUM_ANSWERS NUMBER(21) DEFAULT(0),
            NUM_REPLIES NUMBER(21) DEFAULT(0),
            NUM_FOLLOWERS NUMBER(21) DEFAULT(0),
            NUM_FOLLOWED NUMBER(21) DEFAULT(0),
            UPVOTES NUMBER(21) DEFAULT(0),
            DOWNVOTES NUMBER(21) DEFAULT(0),
        )"; 
        dataInsert($sql, $conn);

    }
    ////////////////////////////////////// END OF THE TABLE INSERTION

    /* sending back the retrieved data */
    return [$Topics, $activityNum];
}
