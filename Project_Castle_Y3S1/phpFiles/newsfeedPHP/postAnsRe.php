<?php
include "../CastleConnect.php";
session_start();

// first we look to see if the post has any other answers or replies.
    $postid = $_SESSION['postid'];
      $sql2 = "SELECT count(*) AS NUMBER_OF_ROWS FROM POST  WHERE Post_Root = '$postid'";
            $stmt = oci_parse($conn, $sql2);
            oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $number_of_rows);
            oci_execute($stmt);
            oci_fetch($stmt);
            oci_free_statement($stmt);
// 
            if($number_of_rows == 0){
                echo 0;
            }else{ 
                $sql = "SELECT * FROM POST WHERE Post_Root = '$postid' ORDER BY POST_DATE DESC";
                $get = oci_parse($conn, $sql);
                oci_execute($get) or die(oci_error());
            
                   while($row = oci_fetch_array($get)){
                      
                        $data[0][] = $row; 
                        $userid = $row['USER_ID'];
                        $sql1 = "SELECT * FROM User_ WHERE User_Id = '$userid'";
                        $get1 = oci_parse($conn, $sql1);
                        oci_execute($get1) or die(oci_error());
                        $row1 = oci_fetch_array($get1);
                            if($row1 > 0){
                                $data[1][] = $row1;
                                $sql2 = "SELECT * FROM USER_PROFILE_PIC WHERE User_Id = '$userid' AND Pic_Status = 1";
                                $get2 = oci_parse($conn, $sql2);
                                oci_execute($get2) or die(oci_error());
                                $row2 = oci_fetch_array($get2);
                                   if($row2 > 0){
                                       $data[2][] = $row2;
                                   }else{
                                        $data[2][] = null;
                                }
                        }else{
                            $data[1][] = null;
                            $data[2][] = null;
                        }
                }
                
                    
            echo json_encode($data);
            }
        
    
          
         

?>
