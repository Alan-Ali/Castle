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
}

$userid = $_SESSION['User_Id'];
$sql = "SELECT * FROM USER_PROFILE_PIC WHERE User_Id = '$userid' AND Pic_Status = 1";
$get = dataRequest($sql,$conn);
$rowUserImage = oci_fetch_array($get);

if ($rowUserImage > 0) {
    $dir = $rowUserImage['PIC_DIRECTORY'];
    $picname = $rowUserImage['PIC_NAME'];
    $datatype = $rowUserImage['PIC_DATA_TYPE'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>
        Castle
    </title>
    <style>

    </style>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
    <link rel='stylesheet' type='text/css' href='../../cssFiles/newsfeedStyles/newsfeed.css'>
    <link rel='stylesheet' type='text/css' href='../../cssFiles/newsfeedStyles/newsfeedQuestions.css'>
    <link rel='stylesheet' type='text/css' href='../../cssFiles/newsfeedStyles/scroll.css'>
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
</head>

<body id='center'>
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
                            echo "<img class='userpic' src='../../SVGs/user-alt-solid.svg' />";
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
            <div id='comment-holder'>
                <div id='comment-parts-holder'>
                    <div id='comment-part-user-detail'>
                        <div id='comment-part-user-pic-holder'>
                            <div id='comment-part-user-pic'>
                                <?php
                                if ($rowUserImage > 0) {
                                    echo "<div class='before-image'><img src='" . $dir . $picname . "." . $datatype . "' /></div>";
                                } else {
                                    echo "<img class='userpic' src='../../SVGs/user-alt-solid.svg' />";
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div id='comment-part-body'>
                        <div id='comment-part-question-details'>
                            <textarea id='details' placeholder='Question Details...' class='careTextarea'></textarea>
                        </div>
                        <div id='comment-part-question-topic'>
                            <textarea id='topic' placeholder='Question Header...' class='careTextarea careTextareaTopic'></textarea>
                        </div>
                        <div id='comment-part-topic-button'>
                            <div class='topic-parts'></div>
                        </div>
                    </div>
                    <div id='comment-part-add-button-holder'>
                        <div id='comment-part-add-button'>
                            <div class='care'>Add</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id='question-utopia'>
                <div class='question-holder'>
                    <div id='question-right' class='question-right'>
                        <div class='header'>
                            <div class='header-inside'><a class='question-profile' href='./userQuestionFeed.php?userid=usid1&postid=poid1'>Header</a></div>
                        </div>
                        <div class='user'>
                            <div class='user-inside'>
                                <div class='user-inside-left'>
                                    <div class='user-pic'>
                                        <img class='userpic1' src='../../SVGs/user-alt-solid.svg' />
                                    </div>
                                    <a class='visit-profile' href='../userProfile/userProfile.php?visit=true&visited_id=profileid'>
                                        <div class='user-name'>
                                            <p style='text-align:center; color: white;'><b>Username</b></p>
                                        </div>
                                    </a>
                                </div>
                                <div class='user-inside-right'>
                                    <div class='user-data'>Postdate</div>
                                    <!-- <img src='../../SVGs/circleFull.svg' class='dot' /> -->
                                    <div class='user-data'>Userrole</div>
                                    <!-- <img src='../../SVGs/circleFull.svg' class='dot' /> -->
                                    <div class='user-data post-topic'>Posttopic</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id='question-left' class='question-left'>
                        <div class='items up-icons'>
                            <div class='upper'><img class='upper-img first' src='../../SVGs/like-icon.svg' /></div>
                        </div>
                        <div class='items up-icons'>
                            <div class='upper'><img class='upper-img' src='../../SVGs/iconq1.svg' /></div>
                        </div>
                        <div class='items up-icons'>
                            <div class='upper'><img class='upper-img third' src='../../SVGs/dislike-icon.svg' /></div>
                        </div>
                        <div class='items down-icons'>
                            <div class='lower'>Likes</div>
                        </div>
                        <div class='items down-icons'>
                            <div class='lower'>Comments</div>
                        </div>
                        <div class='items down-icons'>
                            <div class='lower'>Unlikes</div>
                        </div>
                    </div>

                    <div id='pref-answer' class="pref-answer">
                        <div class='up-detail'>
                            <div class='pref'>Preffered Answer</div>
                            <!-- <div class='sign'>User:</div> -->
                            <div class='info'>
                                <div class='pref-user'>
                                    <img class='pref-user-img' src=''>
                                </div>
                                <div class='pref-username'>PrefUserName</div>
                            </div>
                            <!-- <div class='sign'>Role:</div> -->
                            <div class='info'>PrefUserRole</div>
                            <!-- <div class='sign'>Time:</div> -->
                            <div class='info'>PrefUserTime</div>
                        </div>
                        <div class='down-answer'>
                            <div class='answer-parts'>
                                <div class='part-answer'>PrefUserAnswer</div>
                                <div class='part-status'>
                                    <div class='part-status-left'>
                                        <div class='prefer-like status-icon prefer-like-colorless' data-like='addition'>
                                            <img class='img-icon' src='../../SVGs/chevron-up-solid.svg'>
                                        </div>
                                        <div class='status-number status-change-like'>PrefLike</div>
                                        <div class='status-icon'>
                                            <img class='img-icon' src='../../SVGs/comment-solid.svg'>
                                        </div>
                                        <div class='status-number status-change-comment'>PrefComment</div>
                                        <div class='prefer-unlike status-icon prefer-unlike-colorless' data-unlike='addition'>
                                            <img class='img-icon' src='../../SVGs/chevron-down-solid.svg'>
                                        </div>
                                        <div class='status-number status-change-unlike'>PrefUnlike</div>
                                    </div>
                                    <div class='part-status-right'>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <!-- <div id='refresh-holder'>
                <div class="refresh-button">More...</div>
            </div> -->
        </div>

        <div id='right-right'>
            <div id='same-interest-holder'>
                <div id='people-interest-header'>
                    <div id='header'>People with same interests</div>
                </div>
                <div id='people-interest-people'>
                    <div class='follow-parts center'>
                        <div class='person-holder'>
                            <div class='person-data-holder'>
                                <div class='person-data-image-name'>
                                    <div class='person-data-image-name-1'>
                                        <div class='person-data-image-holder'>
                                            <img class='person-data-image' src='../../SVGs/user-alt-solid.svg' />
                                        </div>
                                        <div class='person-data-name'>
                                            <p>username</p>
                                        </div>
                                    </div>
                                </div>
                                <div class='person-data-follows'>
                                    <div class='person-data-follow-image-holder'>
                                        <img class='person-follow-image' src='../../SVGs/users-solid-1.svg' />
                                    </div>
                                    <div class='person-data-follow-amount'>
                                        <p>Followers</p>
                                    </div>
                                </div>
                                <div class='person-data-answers'>
                                    <div class='person-data-answer-image-holder center'>
                                        <img class='person-answer-image' src='../../SVGs/iconq1.svg' />
                                    </div>
                                    <div class='person-data-answer-amount'>
                                        <p>Answers</p>
                                    </div>
                                </div>
                            </div>
                            <div class='person-follow-holder'>
                                <div class='person-follow-favtopic-logo center'>Fav Topic</div>
                                <div class='person-follow-favtopic center'>Technology</div>
                                <div class='person-following-button center'>Follow +</div>
                            </div>
                        </div>
                    </div>


                </div>
                <div id='people-interest-refresh' class='center'>
                    <div id='refresh' class='center'>Refresh</div>
                </div>
            </div>
            <div id='hello'>

            </div>
        </div>
    </div>


</body>
<script type='text/javascript' src='../../../JSLib/svg-injector.min.js'></script>
<script type='text/javascript' src='../../../JSLib/JQuery.min.js'></script>
<script type='text/javascript' src='../../javascriptFiles/newsfeedJS/addingQuestion.js'></script>
<script type='text/javascript' src='../../javascriptFiles/newsfeedJS/newsfeedScroll.js'></script>
<script type='text/javascript' src='../../javascriptFiles/newsfeedJS/peopleInterests.js'></script>
<script type='text/javascript' src='../../javascriptFiles/newsfeedJS/newsfeed.js'> </script>
<!-- <script type='text/javascript' src='../../javascriptFiles/newsfeedJS/likeButtons.js'></script> -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --> 

</html>