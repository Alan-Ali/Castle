<?php
include "../CastleConnect.php";
// include "./userProfilePic.php";
session_start();
            
            $Topics = $_SESSION['User_Topics'];
            $Topics = explode(',', $Topics);
            $length = count($Topics);
            // this must be later equal to a $_GET[''] value
            $num = $_GET['num'];
            $userid = $_SESSION['User_Id'];
            $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM POST";
            $stmt = oci_parse($conn, $sql2);
            oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $numrows);
            oci_execute($stmt);
            oci_fetch($stmt);
            oci_free_statement($stmt);

            if (!(isset($_GET['load']))) {
                $num = intval($num);
                $_SESSION['number'] = $num;
            } else {
                $_SESSION['number'] = intval($_SESSION['number']) + intval($num);
                $num = intval($_SESSION['number']);
                if($num > $numrows){
                    $num = $numrows;
                }
            }

            // going through the post to see the amount of posts that has the same topic 
            // as the ones the user likes.
            if($numrows > 0){   
                // $num = intval($_SESSION['number']);
                $sql = "SELECT * FROM Post WHERE ROWNUM <= $num ORDER BY POST_DATE DESC";
                $get = oci_parse($conn, $sql);
                oci_execute($get) or die(oci_error());
                    while ($row = oci_fetch_array($get)) {
                        // this is for collecting data of the post   
                        $index = 0; 
                        $found = false;
                        // here starts the search to find if the query is in the range of what the user likes
                        while ($index < $length) {
                            // this part is to see if the post is equal to any of the topis preffered by the user
                            if ($Topics[$index] == $row['POST_TOPIC'] &&  $row['USER_ID'] != $userid && $row['POST_LEVEL'] == 0) {   
                                $data[0][] = $row;
                                $usid = $row['USER_ID'];
                                $sql1 = "SELECT * FROM USER_ WHERE USER_ID = '$usid'";
                                $get1 = oci_parse($conn, $sql1);
                                oci_execute($get1) or die(oci_error());
                                // $content = $row['POST_CONTENT'];
                                $row1 = oci_fetch_array($get1);
                                // this is for collecting data of the user with same topic interest.
                                $data[1][] = $row1;
                                    $sql2 = "SELECT * FROM USER_PROFILE_PIC WHERE User_Id = '$usid' AND Pic_Status = 1";
                                    $get2 = oci_parse($conn, $sql2);
                                    oci_execute($get2) or die(oci_error());
                                    $row2 = oci_fetch_array($get2);
                                    if($row2 > 0){
                                        $data[2][] = $row2;
                                    }else{
                                        $data[2][] = null;
                                    }
                                    // $data[3][] = null;
                                /////////////////////////////////////////////////////////////////////////////////////////
                                /////////////////////////////////////////////////////////////////////////////////////////
                                /////////////////////////////////////////////////////////////////////////////////////////
                                /////////////////////////////////////////////////////////////////////////////////////////
                                    // here we search for the most preffered answer
                                    $postid = $row['POST_ID'];
                                    $sql3 = "SELECT * FROM Post WHERE  Post_Level = 1 AND Post_Parent_Id = '$postid'";
                                    $get3 = oci_parse($conn, $sql3);
                                    oci_execute($get3) or die(oci_error());
                                    $row3 = oci_fetch_array($get3);
                                    if($row3  > 0){  
                                        // choosing the first one as the highest
                                        $highest =  $row3['POST_LIKES'];
                                        $index1 = 0;
                                        $index2 = 0;

                                        // the purpose of similars is collecting the post with similar likes
                                        // so we have 3 indexs, $index2 will increase when the previous incrementation
                                        // not needed and a new similar highest likes are found, so we are goind to a new set
                                        // of similars, $index1 is collecting the similars, the index besides $index1 is 0 and 1
                                        // 0 having the highest like value, 1 having the post id value.
                                        $similarLikes[$index2][$index1] = $row3; 
                                        $index1++;
                                        $similarLikes[$index2][$index1] = null;
                                        // going through the $rows to find the real highest in the likes
                                        while ($row3 = oci_fetch_array($get3)){
                                            $lowest = $row3['POST_LIKES'];
                                            // we check if there is more of highest likes in row3 
                                            if($highest < $lowest){
                                                $highest = $lowest;
                                                $index1 = 0;
                                                $index2++;
                                                $similarLikes[$index2][$index1] = $row3;
                                                $index1++;
                                                $similarLikes[$index2][$index1] = null;
                                                // continue;
                                            // this is for navigating throught the similars.    
                                            }else if($highest == $lowest){
                                                $similarLikes[$index2][$index1] = $row3;
                                                // this is for counting the similars
                                                $index1++;
                                                $similarLikes[$index2][$index1] = null;
                                                // continue;
                                                // $index1--;
                                            }
                                        }
                                        // we check if the position of $index1 have first index as null, 
                                        // if it has it as null, then we are going to put the answer as the favourite one
                                        if( $similarLikes[$index2][1] === null){
                                            // then we get first index of $index1 that contains the post id we want
                                            $chosen = $similarLikes[$index2][0]["POST_ID"];
                                            $sql4 = "SELECT * FROM Post WHERE  Post_Id = '$chosen'"; 
                                            $get4 = oci_parse($conn, $sql4);
                                            oci_execute($get4) or die(oci_error());
                                            $row4 = oci_fetch_array($get4);
                                            $data[3][] = $row4;
                                            $preferUserId = $similarLikes[$index2][0]["USER_ID"];
                                            $sql5 = "SELECT * FROM USER_ WHERE  User_Id = '$preferUserId'";
                                            $get5 = oci_parse($conn, $sql5);
                                            oci_execute($get5) or die(oci_error());
                                            $row5 = oci_fetch_array($get5);
                                            $data[4][] = $row5;

                                        }
                                        else{
                                            // after knowing that the likes have similarities, we are going to have 
                                            // those rows in another variable for easier user.
                                            $count1 = 0;
                                            while($count1 < $index1){
                                                $rowholder[$count1] = $similarLikes[$index2][$count1]; 
                                                $count1++;
                                            }
                                            $count1 = $count2 = $count3 = 0;
                                            $lowest = $rowholder[$count3]["POST_UNLIKES"];
                                            $similarUnlikes[$count2][$count1] = $rowholder[$count3];
                                            $count1++; // to go up in similar unlike count
                                            $similarUnlikes[$count2][$count1] = null;
                                            $count3++; // to go up in the row holder

                                            while($count3 < $index1){
                                                $highest = $rowholder[$count3]["POST_UNLIKES"];
                                                if($lowest > $highest){
                                                    $lowest = $highest;
                                                    $count1 = 0;
                                                    $count2++;
                                                    $similarUnlikes[$count2][$count1] = $rowholder[$count3];
                                                    $count1++;
                                                    $similarUnlikes[$count2][$count1] = null;
                                                }else if($lowest == $highest){
                                                    $similarUnlikes[$count2][$count1] = $rowholder[$count3];
                                                    $count1++;
                                                    $similarUnlikes[$count2][$count1] = null;
                                                }
                                                $count3++;
                                            }
                                                // because we use $count1 for other 
                                                $numCount1 = $count1;
                                            if ($similarUnlikes[$count2][1] === null) {
                                                $chosen = $similarUnlikes[$count2][0]["POST_ID"];
                                                $sql5 = "SELECT * FROM Post WHERE  Post_Id = '$chosen'";
                                                $get5 = oci_parse($conn, $sql5);
                                                oci_execute($get5) or die(oci_error());
                                                $row5 = oci_fetch_array($get5);
                                                $data[3][] = $row5;
                                                $preferUserId = $similarLikes[$index2][0]["USER_ID"];
                                                $sql6 = "SELECT * FROM USER_ WHERE  User_Id = '$preferUserId'";
                                                $get6 = oci_parse($conn, $sql6);
                                                oci_execute($get6) or die(oci_error());
                                                $row6 = oci_fetch_array($get6);
                                                $data[4][] = $row6;
                                            } else {
                                                $count1 = 0;
                                                while ($count1 < $numCount1) {
                                                    $rowholder[$count1] = $similarUnlikes[$count2][$count1];
                                                    $count1++;
                                                }
                                                $count1 = 0;
                                                $count2 = 0;
                                                $count3 = 0;
                                                $highest = $rowholder[$count3]["POST_COMMENTS"];

                                                $similarComments[$count2][$count1] = $rowholder[$count3];
                                                $count1++; // to go up in similar unlike count
                                                $similarComments[$count2][$count1] = null;
                                                $count3++; // to go up in the row holder

                                                while ($count3 < $numCount1) {
                                                    $lowest = $rowholder[$count3]["POST_COMMENTS"];
                                                    if ($highest < $lowest) {
                                                        $highest = $lowest;
                                                        $count1 = 0;
                                                        $count2++;
                                                        $similarComments[$count2][$count1] = $rowholder[$count3];
                                                        $count1++;
                                                        $similarComments[$count2][$count1] = null;
                                                    } else if ($highest == $lowest) {
                                                        $similarComments[$count2][$count1] = $rowholder[$count3];
                                                        $count1++;
                                                        $similarComments[$count2][$count1] = null;
                                                    }
                                                    $count3++;
                                                }
                                                if ($similarComments[$count2][1] === null) {
                                                    $chosen = $similarComments[$count2][0]["POST_ID"];
                                                    $sql6 = "SELECT * FROM Post WHERE  Post_Id = '$chosen'";
                                                    $get6 = oci_parse($conn, $sql6);
                                                    oci_execute($get6) or die(oci_error());
                                                    $row6 = oci_fetch_array($get6);
                                                    $data[3][] = $row6;
                                                    $preferUserId = $similarLikes[$index2][0]["USER_ID"];
                                                    $sql7 = "SELECT * FROM USER_ WHERE  User_Id = '$preferUserId'";
                                                    $get7 = oci_parse($conn, $sql7);
                                                    oci_execute($get7) or die(oci_error());
                                                    $row7 = oci_fetch_array($get7);
                                                    $data[4][] = $row7;
                                                } else {
                                                    $chosen = $similarComments[$count2][0]["POST_ID"];
                                                    $sql6 = "SELECT * FROM Post WHERE  Post_Id = '$chosen'";
                                                    $get6 = oci_parse($conn, $sql6);
                                                    oci_execute($get6) or die(oci_error());
                                                    $row6 = oci_fetch_array($get6);
                                                    $data[3][] = $row6;
                                                    $preferUserId = $similarLikes[$index2][0]["USER_ID"];
                                                    $sql7 = "SELECT * FROM USER_ WHERE  User_Id = '$preferUserId'";
                                                    $get7 = oci_parse($conn, $sql7);
                                                    oci_execute($get7) or die(oci_error());
                                                    $row7 = oci_fetch_array($get7);
                                                    $data[4][] = $row7;
                                                
                                                }
                                            }
                                        }
                                }else{
                                    $data[3][] = null;
                                    $data[4][] = null;
                                }
                                 /////////////////////////////////////////////////////////////////////////////////////////
                                 /////////////////////////////////////////////////////////////////////////////////////////
                                 /////////////////////////////////////////////////////////////////////////////////////////
                                 /////////////////////////////////////////////////////////////////////////////////////////

                                   $found = true;
                                    break;
                            }
                            $index++;
                        }  
                        // here starts the search to find if the query contains the user question and answer
                        if($row['USER_ID'] == $userid && $row['POST_LEVEL'] == 0 && $found != true){
                            $data[0][] = $row;
                            $usid = $row['USER_ID'];
                            $sql1 = "SELECT * FROM USER_ WHERE USER_ID = '$usid'";
                            $get1 = oci_parse($conn, $sql1);
                            oci_execute($get1) or die(oci_error());
                            // $content = $row['POST_CONTENT'];
                            $row1 = oci_fetch_array($get1);
                            // this is for collecting data of the user with same topic interest.
                            $data[1][] = $row1;
                            $sql2 = "SELECT * FROM USER_PROFILE_PIC WHERE User_Id = '$usid' AND Pic_Status = 1";
                            $get2 = oci_parse($conn, $sql2);
                            oci_execute($get2) or die(oci_error());
                            $row2 = oci_fetch_array($get2);
                            if ($row2 > 0) {
                                $data[2][] = $row2;
                            } else {
                                $data[2][] = null;
                            }
                            // $data[3][] = null;
                            /////////////////////////////////////////////////////////////////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////////////////
                            /////////////////////////////////////////////////////////////////////////////////////////
                            // here we search for the most preffered answer
                            $postid = $row['POST_ID'];
                            $sql3 = "SELECT * FROM Post WHERE  Post_Level = 1 AND Post_Parent_Id = '$postid'";
                            $get3 = oci_parse($conn, $sql3);
                            oci_execute($get3) or die(oci_error());
                            $row3 = oci_fetch_array($get3);
                            if ($row3  > 0) {
                                // choosing the first one as the highest
                                $highest =  $row3['POST_LIKES'];
                                $index1 = 0;
                                $index2 = 0;

                                // the purpose of similars is collecting the post with similar likes
                                // so we have 3 indexs, $index2 will increase when the previous incrementation
                                // not needed and a new similar highest likes are found, so we are goind to a new set
                                // of similars, $index1 is collecting the similars, the index besides $index1 is 0 and 1
                                // 0 having the highest like value, 1 having the post id value.
                                $similarLikes[$index2][$index1] = $row3;
                                $index1++;
                                $similarLikes[$index2][$index1] = null;
                                // going through the $rows to find the real highest in the likes
                                while ($row3 = oci_fetch_array($get3)) {
                                    $lowest = $row3['POST_LIKES'];
                                    // we check if there is more of highest likes in row3 
                                    if ($highest < $lowest) {
                                        $highest = $lowest;
                                        $index1 = 0;
                                        $index2++;
                                        $similarLikes[$index2][$index1] = $row3;
                                        $index1++;
                                        $similarLikes[$index2][$index1] = null;
                                        // continue;
                                        // this is for navigating throught the similars.    
                                    } else if ($highest == $lowest) {
                                        $similarLikes[$index2][$index1] = $row3;
                                        // this is for counting the similars
                                        $index1++;
                                        $similarLikes[$index2][$index1] = null;
                                        // continue;
                                        // $index1--;
                                    }
                                }
                                // we check if the position of $index1 have first index as null, 
                                // if it has it as null, then we are going to put the answer as the favourite one
                                if ($similarLikes[$index2][1] === null) {
                                    // then we get first index of $index1 that contains the post id we want
                                    $chosen = $similarLikes[$index2][0]["POST_ID"];
                                    $sql4 = "SELECT * FROM Post WHERE  Post_Id = '$chosen'";
                                    $get4 = oci_parse($conn, $sql4);
                                    oci_execute($get4) or die(oci_error());
                                    $row4 = oci_fetch_array($get4);
                                    $data[3][] = $row4;
                                    $preferUserId = $similarLikes[$index2][0]["USER_ID"];
                                    $sql5 = "SELECT * FROM USER_ WHERE  User_Id = '$preferUserId'";
                                    $get5 = oci_parse($conn, $sql5);
                                    oci_execute($get5) or die(oci_error());
                                    $row5 = oci_fetch_array($get5);
                                    $data[4][] = $row5;
                                } else {
                                    // after knowing that the likes have similarities, we are going to have 
                                    // those rows in another variable for easier user.
                                    $count1 = 0;
                                    while ($count1 < $index1) {
                                        $rowholder[$count1] = $similarLikes[$index2][$count1];
                                        $count1++;
                                    }
                                    $count1 = $count2 = $count3 = 0;
                                    $lowest = $rowholder[$count3]["POST_UNLIKES"];
                                    $similarUnlikes[$count2][$count1] = $rowholder[$count3];
                                    $count1++; // to go up in similar unlike count
                                    $similarUnlikes[$count2][$count1] = null;
                                    $count3++; // to go up in the row holder

                                    while ($count3 < $index1) {
                                        $highest = $rowholder[$count3]["POST_UNLIKES"];
                                        if ($lowest > $highest) {
                                            $lowest = $highest;
                                            $count1 = 0;
                                            $count2++;
                                            $similarUnlikes[$count2][$count1] = $rowholder[$count3];
                                            $count1++;
                                            $similarUnlikes[$count2][$count1] = null;
                                        } else if ($lowest == $highest) {
                                            $similarUnlikes[$count2][$count1] = $rowholder[$count3];
                                            $count1++;
                                            $similarUnlikes[$count2][$count1] = null;
                                        }
                                        $count3++;
                                    }
                                    // because we use $count1 for other 
                                    $numCount1 = $count1;
                                    if ($similarUnlikes[$count2][1] === null) {
                                        $chosen = $similarUnlikes[$count2][0]["POST_ID"];
                                        $sql5 = "SELECT * FROM Post WHERE  Post_Id = '$chosen'";
                                        $get5 = oci_parse($conn, $sql5);
                                        oci_execute($get5) or die(oci_error());
                                        $row5 = oci_fetch_array($get5);
                                        $data[3][] = $row5;
                                        $preferUserId = $similarLikes[$index2][0]["USER_ID"];
                                        $sql6 = "SELECT * FROM USER_ WHERE  User_Id = '$preferUserId'";
                                        $get6 = oci_parse($conn, $sql6);
                                        oci_execute($get6) or die(oci_error());
                                        $row6 = oci_fetch_array($get6);
                                        $data[4][] = $row6;
                                    } else {
                                        $count1 = 0;
                                        while ($count1 < $numCount1) {
                                            $rowholder[$count1] = $similarUnlikes[$count2][$count1];
                                            $count1++;
                                        }
                                        $count1 = 0;
                                        $count2 = 0;
                                        $count3 = 0;
                                        $highest = $rowholder[$count3]["POST_COMMENTS"];

                                        $similarComments[$count2][$count1] = $rowholder[$count3];
                                        $count1++; // to go up in similar unlike count
                                        $similarComments[$count2][$count1] = null;
                                        $count3++; // to go up in the row holder

                                        while ($count3 < $numCount1) {
                                            $lowest = $rowholder[$count3]["POST_COMMENTS"];
                                            if ($highest < $lowest) {
                                                $highest = $lowest;
                                                $count1 = 0;
                                                $count2++;
                                                $similarComments[$count2][$count1] = $rowholder[$count3];
                                                $count1++;
                                                $similarComments[$count2][$count1] = null;
                                            } else if ($highest == $lowest) {
                                                $similarComments[$count2][$count1] = $rowholder[$count3];
                                                $count1++;
                                                $similarComments[$count2][$count1] = null;
                                            }
                                            $count3++;
                                        }
                                        if ($similarComments[$count2][1] === null) {
                                            $chosen = $similarComments[$count2][0]["POST_ID"];
                                            $sql6 = "SELECT * FROM Post WHERE  Post_Id = '$chosen'";
                                            $get6 = oci_parse($conn, $sql6);
                                            oci_execute($get6) or die(oci_error());
                                            $row6 = oci_fetch_array($get6);
                                            $data[3][] = $row6;
                                            $preferUserId = $similarLikes[$index2][0]["USER_ID"];
                                            $sql7 = "SELECT * FROM USER_ WHERE  User_Id = '$preferUserId'";
                                            $get7 = oci_parse($conn, $sql7);
                                            oci_execute($get7) or die(oci_error());
                                            $row7 = oci_fetch_array($get7);
                                            $data[4][] = $row7;
                                        } else {
                                            $chosen = $similarComments[$count2][0]["POST_ID"];
                                            $sql6 = "SELECT * FROM Post WHERE  Post_Id = '$chosen'";
                                            $get6 = oci_parse($conn, $sql6);
                                            oci_execute($get6) or die(oci_error());
                                            $row6 = oci_fetch_array($get6);
                                            $data[3][] = $row6;
                                            $preferUserId = $similarLikes[$index2][0]["USER_ID"];
                                            $sql7 = "SELECT * FROM USER_ WHERE  User_Id = '$preferUserId'";
                                            $get7 = oci_parse($conn, $sql7);
                                            oci_execute($get7) or die(oci_error());
                                            $row7 = oci_fetch_array($get7);
                                            $data[4][] = $row7;
                                        }
                                    }
                                }
                            } else {
                                $data[3][] = null;
                                $data[4][] = null;
                            }
                                        /////////////////////////////////////////////////////////////////////////////////////////
                                        /////////////////////////////////////////////////////////////////////////////////////////
                                        /////////////////////////////////////////////////////////////////////////////////////////
                                        /////////////////////////////////////////////////////////////////////////////////////////
                                            $found = true;

                                            }
                                            $index = 0;
                                    // here starts the search to find if the query contains other topic
                                    while($index < $length){
                                        if ("Other" == $row['POST_TOPIC'] && $userid != $row['USER_ID'] && $found != true && $row['POST_LEVEL'] == 0) {
                                            $data[0][] = $row;
                                            $usid = $row['USER_ID'];
                                            $sql1 = "SELECT * FROM USER_ WHERE USER_ID = '$usid'";
                                            $get1 = oci_parse($conn, $sql1);
                                            oci_execute($get1) or die(oci_error());
                                            // $content = $row['POST_CONTENT'];
                                            $row1 = oci_fetch_array($get1);
                                            // this is for collecting data of the user with same topic interest.
                                            $data[1][] = $row1;
                                            $sql2 = "SELECT * FROM USER_PROFILE_PIC WHERE User_Id = '$usid' AND Pic_Status = 1";
                                            $get2 = oci_parse($conn, $sql2);
                                            oci_execute($get2) or die(oci_error());
                                            $row2 = oci_fetch_array($get2);
                                            if ($row2 > 0) {
                                                $data[2][] = $row2;
                                            } else {
                                                $data[2][] = null;
                                            }
                // $data[3][] = null;
                /////////////////////////////////////////////////////////////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////////
                // here we search for the most preffered answer
                $postid = $row['POST_ID'];
                $sql3 = "SELECT * FROM Post WHERE  Post_Level = 1 AND Post_Parent_Id = '$postid'";
                $get3 = oci_parse($conn, $sql3);
                oci_execute($get3) or die(oci_error());
                $row3 = oci_fetch_array($get3);
                if ($row3  > 0) {
                    // choosing the first one as the highest
                    $highest =  $row3['POST_LIKES'];
                    $index1 = 0;
                    $index2 = 0;

                    // the purpose of similars is collecting the post with similar likes
                    // so we have 3 indexs, $index2 will increase when the previous incrementation
                    // not needed and a new similar highest likes are found, so we are goind to a new set
                    // of similars, $index1 is collecting the similars, the index besides $index1 is 0 and 1
                    // 0 having the highest like value, 1 having the post id value.
                    $similarLikes[$index2][$index1] = $row3;
                    $index1++;
                    $similarLikes[$index2][$index1] = null;
                    // going through the $rows to find the real highest in the likes
                    while ($row3 = oci_fetch_array($get3)) {
                        $lowest = $row3['POST_LIKES'];
                        // we check if there is more of highest likes in row3 
                        if ($highest < $lowest) {
                            $highest = $lowest;
                            $index1 = 0;
                            $index2++;
                            $similarLikes[$index2][$index1] = $row3;
                            $index1++;
                            $similarLikes[$index2][$index1] = null;
                            // continue;
                            // this is for navigating throught the similars.    
                        } else if ($highest == $lowest) {
                            $similarLikes[$index2][$index1] = $row3;
                            // this is for counting the similars
                            $index1++;
                            $similarLikes[$index2][$index1] = null;
                            // continue;
                            // $index1--;
                        }
                    }
                    // we check if the position of $index1 have first index as null, 
                    // if it has it as null, then we are going to put the answer as the favourite one
                    if ($similarLikes[$index2][1] === null) {
                        // then we get first index of $index1 that contains the post id we want
                        $chosen = $similarLikes[$index2][0]["POST_ID"];
                        $sql4 = "SELECT * FROM Post WHERE  Post_Id = '$chosen'";
                        $get4 = oci_parse($conn, $sql4);
                        oci_execute($get4) or die(oci_error());
                        $row4 = oci_fetch_array($get4);
                        $data[3][] = $row4;
                        $preferUserId = $similarLikes[$index2][0]["USER_ID"];
                        $sql5 = "SELECT * FROM USER_ WHERE  User_Id = '$preferUserId'";
                        $get5 = oci_parse($conn, $sql5);
                        oci_execute($get5) or die(oci_error());
                        $row5 = oci_fetch_array($get5);
                        $data[4][] = $row5;
                    } else {
                        // after knowing that the likes have similarities, we are going to have 
                        // those rows in another variable for easier user.
                        $count1 = 0;
                        while ($count1 < $index1) {
                            $rowholder[$count1] = $similarLikes[$index2][$count1];
                            $count1++;
                        }
                        $count1 = $count2 = $count3 = 0;
                        $lowest = $rowholder[$count3]["POST_UNLIKES"];
                        $similarUnlikes[$count2][$count1] = $rowholder[$count3];
                        $count1++; // to go up in similar unlike count
                        $similarUnlikes[$count2][$count1] = null;
                        $count3++; // to go up in the row holder

                        while ($count3 < $index1) {
                            $highest = $rowholder[$count3]["POST_UNLIKES"];
                            if ($lowest > $highest) {
                                $lowest = $highest;
                                $count1 = 0;
                                $count2++;
                                $similarUnlikes[$count2][$count1] = $rowholder[$count3];
                                $count1++;
                                $similarUnlikes[$count2][$count1] = null;
                            } else if ($lowest == $highest) {
                                $similarUnlikes[$count2][$count1] = $rowholder[$count3];
                                $count1++;
                                $similarUnlikes[$count2][$count1] = null;
                            }
                            $count3++;
                        }
                        // because we use $count1 for other 
                        $numCount1 = $count1;
                        if ($similarUnlikes[$count2][1] === null) {
                            $chosen = $similarUnlikes[$count2][0]["POST_ID"];
                            $sql5 = "SELECT * FROM Post WHERE  Post_Id = '$chosen'";
                            $get5 = oci_parse($conn, $sql5);
                            oci_execute($get5) or die(oci_error());
                            $row5 = oci_fetch_array($get5);
                            $data[3][] = $row5;
                            $preferUserId = $similarLikes[$index2][0]["USER_ID"];
                            $sql6 = "SELECT * FROM USER_ WHERE  User_Id = '$preferUserId'";
                            $get6 = oci_parse($conn, $sql6);
                            oci_execute($get6) or die(oci_error());
                            $row6 = oci_fetch_array($get6);
                            $data[4][] = $row6;
                        } else {
                            $count1 = 0;
                            while ($count1 < $numCount1) {
                                $rowholder[$count1] = $similarUnlikes[$count2][$count1];
                                $count1++;
                            }
                            $count1 = 0;
                            $count2 = 0;
                            $count3 = 0;
                            $highest = $rowholder[$count3]["POST_COMMENTS"];

                            $similarComments[$count2][$count1] = $rowholder[$count3];
                            $count1++; // to go up in similar unlike count
                            $similarComments[$count2][$count1] = null;
                            $count3++; // to go up in the row holder

                            while ($count3 < $numCount1) {
                                $lowest = $rowholder[$count3]["POST_COMMENTS"];
                                if ($highest < $lowest) {
                                    $highest = $lowest;
                                    $count1 = 0;
                                    $count2++;
                                    $similarComments[$count2][$count1] = $rowholder[$count3];
                                    $count1++;
                                    $similarComments[$count2][$count1] = null;
                                } else if ($highest == $lowest) {
                                    $similarComments[$count2][$count1] = $rowholder[$count3];
                                    $count1++;
                                    $similarComments[$count2][$count1] = null;
                                }
                                $count3++;
                            }
                            if ($similarComments[$count2][1] === null) {
                                $chosen = $similarComments[$count2][0]["POST_ID"];
                                $sql6 = "SELECT * FROM Post WHERE  Post_Id = '$chosen'";
                                $get6 = oci_parse($conn, $sql6);
                                oci_execute($get6) or die(oci_error());
                                $row6 = oci_fetch_array($get6);
                                $data[3][] = $row6;
                                $preferUserId = $similarLikes[$index2][0]["USER_ID"];
                                $sql7 = "SELECT * FROM USER_ WHERE  User_Id = '$preferUserId'";
                                $get7 = oci_parse($conn, $sql7);
                                oci_execute($get7) or die(oci_error());
                                $row7 = oci_fetch_array($get7);
                                $data[4][] = $row7;
                            } else {
                                $chosen = $similarComments[$count2][0]["POST_ID"];
                                $sql6 = "SELECT * FROM Post WHERE  Post_Id = '$chosen'";
                                $get6 = oci_parse($conn, $sql6);
                                oci_execute($get6) or die(oci_error());
                                $row6 = oci_fetch_array($get6);
                                $data[3][] = $row6;
                                $preferUserId = $similarLikes[$index2][0]["USER_ID"];
                                $sql7 = "SELECT * FROM USER_ WHERE  User_Id = '$preferUserId'";
                                $get7 = oci_parse($conn, $sql7);
                                oci_execute($get7) or die(oci_error());
                                $row7 = oci_fetch_array($get7);
                                $data[4][] = $row7;
                            }
                        }
                    }
                } else {
                    $data[3][] = null;
                    $data[4][] = null; 
                }
        /////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////

                             break;
                                        
                             }
                            $index++;
                        }   
                    }
                     echo json_encode($data);
                }else{
                    echo 0;
                }

oci_close($conn);
?>


