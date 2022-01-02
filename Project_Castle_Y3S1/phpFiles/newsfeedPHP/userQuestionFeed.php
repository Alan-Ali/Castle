<?php
include "../CastleConnect.php";
// include "../userProfile/userProfilePic.php";
session_start();
$_SESSION['signed_up'] = false;

if (!$_SESSION['login']) {
    header("location: ../RegistrationPHP/RegistrationPage.php");
} else {
    $name = $_SESSION['User_Name'];
    $nameId = $_SESSION['User_Name_Id'];
    $Quserid = $_GET['userid'];
    $Qpostid = $_GET['postid'];
    $mainuser = $_SESSION['User_Id'];
    // $_SESSION['postid'] = $_GE['postid'];


    $sql = "SELECT * FROM Post WHERE Post_Id = '$Qpostid'";
    $get = oci_parse($conn, $sql);
    oci_execute($get) or die(oci_error());
    if (($row = oci_fetch_array($get)) > 0) {
        $sql = "SELECT * FROM User_ WHERE User_Id = '$Quserid'";
        $get = oci_parse($conn, $sql);
        oci_execute($get) or die(oci_error());
        if (($row1 = oci_fetch_array($get)) > 0) {
            // $_SESSION['User_Id'] = $row1['USER_ID'];
            $Qusername = $row1['USER_NAME'];
            $Qusernameid = $row1['USER_NAME_ID'];
            $_SESSION['Quserid'] = $row1['USER_ID']; // this is for the like, unlike and answer
            // $_SESSION['User_Password'] = $row1['USER_PASSWORD'];
            // $_SESSION['User_Age'] = $row1['USER_AGE'];
            // $_SESSION['User_Gender'] = $row1['User_Gender'];
            // $_SESSION['User_Telephone_No'] = $row1['USER_TELEPHONE_NO'];
            // $_SESSION['User_Address'] = $row1['USER_ADDRESS'];header = $row['POST_CONTENT_HEADER']
            // $_SESSION['User_Topics'] = $row1['USER_TOPICS'];
            // $_SESSION['User_Date_Created'] = $row1['USER_DATE_CREATED'];
            $Quserrole = $row1['USER_ROLE'];
            // $_SESSION['User_Role_Confirmation'] = $row1['User_Role_Confirmation'];
            // $_SESSION['User_Status'] = $row1['USER_STATUS'];
            // $_SESSION['User_Content_No'] = $row1['USER_CONTENT_NO'];
            // $_SESSION['User_Block_Status'] = $row1['USER_BLOCK_STATUS'];
            $Qpostheader = $row['POST_CONTENT_HEADER'];
            $Qpostcontent = $row['POST_CONTENT'];
            $Qpostdate = $row['POST_DATE'];
            $Qposttopic = $row['POST_TOPIC'];
            $Qpostlikes = $row['POST_LIKES'];
            $Qpostunlikes = $row['POST_UNLIKES'];
            $Qpostcomments = $row['POST_COMMENTS'];
            $_SESSION['postid'] = $row['POST_ID'];
            $Qpostcontent1 = $row['POST_CONTENT1'];
            $Qpostcontent2 = $row['POST_CONTENT2'];
            $Qpostcontent3 = $row['POST_CONTENT3'];
        }
    }

    $userid = $_SESSION['User_Id'];
    $sql = "SELECT * FROM USER_PROFILE_PIC WHERE User_Id = '$userid' AND Pic_Status = 1";
    $get = oci_parse($conn, $sql);
    oci_execute($get) or die(oci_error());
    $rowUserImage = oci_fetch_array($get);
    if ($rowUserImage > 0) {
        $dir = $rowUserImage['PIC_DIRECTORY'];
        $picname = $rowUserImage['PIC_NAME'];
        $datatype = $rowUserImage['PIC_DATA_TYPE'];
    }

    $sql = "SELECT * FROM USER_PROFILE_PIC WHERE User_Id = '$Quserid' AND Pic_Status = 1";
    $get = oci_parse($conn, $sql);
    oci_execute($get) or die(oci_error());
    $rowUserImageQ = oci_fetch_array($get);
    if ($rowUserImageQ > 0) {
        $dirQuestion = $rowUserImageQ['PIC_DIRECTORY'];
        $picnameQuestion = $rowUserImageQ['PIC_NAME'];
        $datatypeQuestion = $rowUserImageQ['PIC_DATA_TYPE'];
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>
        Castle
    </title>
    <style>

    </style>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
    <link rel='stylesheet' type='text/css' href='../../cssFiles/newsfeedStyles/newsfeed.css'>
    <link rel='stylesheet' type='text/css' href='../../cssFiles/newsfeedStyles/newsfeedQuestions.css'>
    <link rel='stylesheet' type='text/css' href='../../cssFiles/newsfeedStyles/userQuestionFeed.css'>

    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->

</head>

<body id='center' onload="document.getElementById('date').innerHTML = time(parseInt(document.getElementById('date').innerHTML))">

    <div id='top'>
        <div id='top-left'>
        </div>
        <div id='top-center'>
            <div id='castle-tag'>
                <img src='../../SVGs/CASTLE.png' id='castle' />
                <p>Castle Q&A</p>
            </div>
            <div id='search-holder'>
                <div id='search-items' class='search-items2'>
                    <img src='../../SVGs/loupe.svg' id='search-img' />
                    <form id='search-form'>
                        <input type='search' name='search' placeholder='Search...' id='search-input'>
                    </form>
                </div>
            </div>
            <div id='user-profile'>
                <div id='user-name-and-pic'>
                    <div id='user-pic'>
                        <?php
                        if ($rowUserImage > 0) {
                            echo "<div class='before-image'><img src='" . $dir . $picname . "." . $datatype . "' /></div>";
                        } else {
                            echo "<img id='userpic1' src='../../SVGs/user-alt-solid.svg' />";
                        }
                        ?>
                    </div>
                    <div id='user-name'>
                        <?php
                        echo "<p style='overflow:hidden; width: 60%; text-overflow: ellipsis;'>" . $name . "</p>";
                        echo "<p style='overflow:hidden; width: 60%; text-overflow: ellipsis;'>" . "@" . $nameId . "</p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id='top-right'>
            <div class='button-parts'>
                <form id='logout' action='../../phpFiles/RegistrationPHP/logout.php' method='POST'>
                    <button id='logout-svg-holder'>
                        <div id='logout-svg-positioner'>
                            <img id='logout-svg' src='../../SVGs/log-out.svg'>
                        </div>
                        <p id='logout-writing'>Logout</p>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div id='left'>
        <div class='nav'>
            <div class='image-holder'>
                <img class='nav-img' src='../../SVGs/newspaper-solid.svg' />
            </div>
            <p>Newsfeed</p>
        </div>
        <div class='nav'>
            <div class='image-holder'>
                <img class='nav-img' src='../../SVGs/user-alt-solid.svg' />
            </div>
            <p>Profile</p>
        </div>
        <div class='nav'>
            <div class='image-holder'>
                <img class='nav-img' src='../../SVGs/bell-solid.svg' />
            </div>
            <p>Notifications</p>
        </div>
        <div class='nav'>
            <div class='image-holder'>
                <img class='nav-img' src='../../SVGs/info.svg' />
            </div>
            <p>About</p>
        </div>
    </div>
    <div id='right'>
        <div id='right-left'>
            <div id='QA-container-first'>
                <div id='QA-container-second'>
                    <div id='Q-container'>
                        <div id='Q-container-left' class='QA-container-left'>
                            <div id='Q-container-user' class='QA-container-user'>
                                <div id='Q-container-user-pic' class='QA-container-user-pic'> <?php
                                                                                                if ($rowUserImageQ > 0) {
                                                                                                    echo "<img class='userimage' src='" . $dirQuestion . $picnameQuestion . "." . $datatypeQuestion . "' />";
                                                                                                } else {
                                                                                                    echo "<img class='userdefault' src='../../SVGs/user-alt-solid.svg' />";
                                                                                                }

                                                                                                ?></div>
                                <div id='Q-container-user-name' class='QA-container-user-name'>
                                    <?php
                                    echo $Qusername;
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div id='Q-container-right'>
                            <div id='Q-container-header' class='border'>
                                <?php
                                echo $Qpostheader;
                                ?>
                            </div>
                            <div id='Q-container-details' class='border'>
                                <?php
                                echo $Qpostcontent . $Qpostcontent1 . $Qpostcontent2 . $Qpostcontent3;
                                ?>
                            </div>
                            <div id='Q-container-possession' class='question-holder border'>
                                <div class='question-left'>
                                    <div class='items-Qfeed'>
                                        <div id='' class='upper'><img class='upper-img' src='../../SVGs/chevron-up-solid.svg' /></div>
                                    </div>
                                    <div class='items-Qfeed'>
                                        <div id='' class='upper'><img class='upper-img' src='../../SVGs/comment-solid.svg' /></div>
                                    </div>
                                    <div class='items-Qfeed'>
                                        <div id='' class='upper'><img class='upper-img' src='../../SVGs/chevron-down-solid.svg' /></div>
                                    </div>
                                    <div class='items-Qfeed'>
                                        <div class='lower'><?php echo $Qpostlikes; ?></div>
                                    </div>
                                    <div class='items-Qfeed'>
                                        <div class='lower'><?php echo $Qpostcomments; ?></div>
                                    </div>
                                    <div class='items-Qfeed'>
                                        <div class='lower'><?php echo $Qpostunlikes; ?></div>
                                    </div>
                                </div>
                                <div class='question-right'>
                                    <div><img class='user-svgs' src='../../SVGs/calendar (1).svg' /></div>
                                    <div><img class='user-svgs' src='../../SVGs/settings.svg' /></div>
                                    <div><img class='user-svgs' src='../../SVGs/chat.svg' /></div>
                                    <div>
                                        <div id='date' class='low'><?php echo $Qpostdate; ?></div>
                                    </div>
                                    <div>
                                        <div class='low'><?php echo $Quserrole; ?></div>
                                    </div>
                                    <div>
                                        <div class='low'><?php echo $Qposttopic; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id='A-container' class=''>
                        <div id='A-container-left' class='QA-container-left'>
                            <div id='A-container-user' class='QA-container-user'>
                                <div id='Q-container-user-pic' class='QA-container-user-pic'>
                                    <?php
                                    if ($rowUserImage > 0) {
                                        echo "<img class='userimage' src='" . $dir . $picname . "." . $datatype . "' />";
                                    } else {
                                        echo "<img class='userdefault' src='../../SVGs/user-alt-solid.svg' />";
                                    }

                                    ?>
                                </div>
                                <div id='Q-container-user-pic' class='QA-container-user-name'>
                                    <?php echo $name; ?>
                                </div>
                            </div>
                        </div>
                        <div id='A-container-right' class='border'>
                            <textarea id='A-container-answer' placeholder='Answer...'></textarea>
                            <div id='A-container-button-holder'>
                                <div id='A-container-button'>Add</div>
                            </div>
                        </div>
                    </div>
                    <!-- this part will hold all the answers that the question recieved -->
                    <div id='A-other-answers' class='A-other-answers'>
                        <!-- answer and replies will hold one answer, and replies that belong to them -->
                        <!-- section 0 -->
                        <div class="answer-replies">
                            <!-- is a combination of user-answer-->
                            <!-- The classes that start with QA, are derived from other divs 
                                    in the file above-->
                            <!-- section 1 -->
                            <div class='answer' data-paid=''>
                                <!-- section 1-1 -->
                                <div class='userdetails QA-container-left'>
                                    <div class='QA-container-user'>
                                        <div class='QA-container-user-pic'>
                                            <!-- <img class='userpic' src='../../SVGs/user-alt-solid.svg' /> -->
                                            <?php
                                            if ($rowUserImage > 0) {
                                                echo "<img class='userimage' src='" . $dir . $picname . "." . $datatype . "' />";
                                            } else {
                                                echo "<img class='userdefault' src='../../SVGs/user-alt-solid.svg' />";
                                            }

                                            ?>
                                        </div>
                                        <div class='QA-container-user-name'>Ansusername</div>
                                    </div>
                                </div>
                                <!-- section 1-2 -->
                                <div class='user-answer'>
                                    <div class='holding-answer-specs'>
                                        <div class='answer-holder'>Anstext</div>
                                        <div class='answer-possessions'>
                                            <div class='button-holder'>
                                                <div class='ans-buttons ans-upvote'><img src='../../SVGs/chevron-up-solid.svg' class='ans-imgs' /></div>
                                                <div class='ans-pos-border ans-like-place'>Anslike</div>
                                                <div class='ans-buttons combutton'><img src='../../SVGs/comment-solid.svg' class='ans-imgs' /></div>
                                                <div class='ans-pos-border '>Ansreply</div>
                                                <div class='ans-buttons ans-downvote'><img src='../../SVGs/chevron-down-solid.svg' class='ans-imgs' /></div>
                                                <div class='ans-pos-border ans-unlike-place'>Ansunlike</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- section 1-3 -->
                                <div class='user-reply'>
                                    <!-- The classes that start with QA, are derived from other divs 
                                    in the file above-->
                                    <div class='reply-user-details-0 QA-container-left'>
                                        <div class='QA-container-user'>
                                            <div class='QA-container-user-pic'>
                                                <?php
                                                if ($rowUserImage > 0) {
                                                    echo "<img class='userimage' src='" . $dir . $picname . "." . $datatype . "' />";
                                                } else {
                                                    echo "<img class='userdefault' src='../../SVGs/user-alt-solid.svg' />";
                                                }

                                                ?>
                                            </div>
                                            <div class='QA-container-user-name'>Repusername</div>
                                        </div>
                                    </div>
                                    <div class='reply-holder-0'>
                                        <textarea class='reply-text-0' placeholder='Reply...'></textarea>
                                        <div class='reply-adder' data-parent=''>
                                            <div class='reply-adder-button'>
                                                Add
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- section 2 -->
                            <div class='replies'>
                                <!-- section 2-1 -->
                                <div class='reply-user-details-1 QA-container-left' data-replyid=''>
                                    <div class='QA-container-user'>
                                        <div class='QA-container-user-pic'>
                                            <img class='userpic' src='../../SVGs/user-alt-solid.svg' />
                                        </div>
                                        <div class='QA-container-user-name'>username</div>
                                    </div>
                                </div>
                                <!-- section 2-2 -->
                                <div class='reply-holder-1'>
                                    <div class='reply-text-1'>
                                        <div class='reply-content'>Reptext</div>
                                        <div class='reply-possessions'>
                                            <div class='reply-possession-corrector button-holder'>
                                                <div class='ans-buttons rep-upvote'><img src='../../SVGs/chevron-up-solid.svg' class='ans-imgs' /></div>
                                                <div class='ans-pos-border rep-like-place'>Replike</div>
                                                <div class='ans-buttons rep-downvote'><img src='../../SVGs/chevron-down-solid.svg' class='ans-imgs' /></div>
                                                <div class='ans-pos-border rep-unlike-place'>Repunlike</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- this is the end div for A-other-answers -->
                </div>
            </div>

        </div>

    </div>
    <div id=' right-right'>

    </div>
    </div>


</body>
<script type='text/javascript' src='../../../JSLib/svg-injector.min.js'></script>
<script type='text/javascript' src='../../../JSLib/JQuery.min.js'></script>
<script type='text/javascript' src='../../javascriptFiles/newsfeedJS/addingAnswers&Re.js'></script>
<script type='text/javascript' src='../../javascriptFiles/newsfeedJS/userQuestionFeed.js'></script>
<!-- <script type='text/javascript' src='../../javascriptFiles/newsfeedJS/newsfeedAddingQuestion.js'></script> -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->



</html>