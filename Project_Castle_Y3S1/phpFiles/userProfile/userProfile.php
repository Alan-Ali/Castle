<?php
include "../CastleConnect.php";
// include "./userProfilePic.php";
session_start();
$_SESSION['signed_up'] = false;
$name = $_SESSION['User_Name'];
$nameId = $_SESSION['User_Name_Id'];
$userid = $_SESSION['User_Id'];
// $rowUserBackVisitor = "";
if (isset($_GET['visit'])) {
    $visited = $_GET['visit'];
    $visitedId =  $_GET['visited_id'];
} else {
    // $visited = "";
    $visitedId = $userid;
}

if (!$_SESSION['login']) {
    header("location: ../RegistrationPHP/RegistrationPage.php");
}  // this condition is used for the user. 
else if (((isset($_GET['visit']) && ($visitedId == $userid)) || !isset($_GET['visit']))) {

    $sql = "SELECT * FROM USER_ WHERE User_Id = '$userid'";
    $get = oci_parse($conn, $sql);
    oci_execute($get) or die(oci_error());
    $row = oci_fetch_array($get);
    $email = $row['USER_EMAIL'];
    $email_show = $row['USER_EMAIL_SHOW'];
    // $age = $_SESSION['User_Age'];
    // $gender = $_SESSION['User_Gender'];
    $telNo = $row['USER_TELEPHONE_NO'];
    $telNo_show = $row['USER_TELEPHONE_NO_SHOW'];
    $address = $row['USER_ADDRESS'];
    $address_show = $row['USER_ADDRESS_SHOW'];
    $role = $row['USER_ROLE'];
    $role_confirmation = $row['USER_ROLE_CONFIRMATION'];
    $user_description = $row['USER_DESCRIPTION'];

    // this part is for the users profile pic
    $sql = "SELECT * FROM USER_PROFILE_PIC WHERE User_Id = '$userid' AND Pic_Status = 1";
    $get = oci_parse($conn, $sql);
    oci_execute($get) or die(oci_error());
    $rowUserImage = oci_fetch_array($get);
    if ($rowUserImage > 0) {
        $dir = $rowUserImage['PIC_DIRECTORY'];
        $picname = $rowUserImage['PIC_NAME'];
        $datatype = $rowUserImage['PIC_DATA_TYPE'];
    }
    // this part is for the users background pic
    $sql = "SELECT * FROM USER_BACKGROUND_PIC WHERE User_Id = '$userid' AND Back_Pic_Status = 1";
    $get = oci_parse($conn, $sql);
    oci_execute($get) or die(oci_error());
    $rowUserBack = oci_fetch_array($get);
    if ($rowUserBack > 0) {
        $backDir = $rowUserBack['BACK_PIC_DIRECTORY'];
        $backPicname = $rowUserBack['BACK_PIC_NAME'];
        $backDatatype = $rowUserBack['BACK_PIC_DATA_TYPE'];
    }


    $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM " . $userid . "_FOLLOWED WHERE User_Id = '$userid'";
    $stmt = oci_parse($conn, $sql2);
    oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $UserFollowed);
    oci_execute($stmt);
    oci_fetch($stmt);
    oci_free_statement($stmt);

    $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM " . $userid . "_FOLLOWERS WHERE User_Id = '$userid'";
    $stmt = oci_parse($conn, $sql2);
    oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $UserFollowers);
    oci_execute($stmt);
    oci_fetch($stmt);
    oci_free_statement($stmt);

    $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM POST WHERE User_Id = '$userid' AND Post_Level = 0";
    $stmt = oci_parse($conn, $sql2);
    oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $Question);
    oci_execute($stmt);
    oci_fetch($stmt);
    oci_free_statement($stmt);

    $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM POST WHERE User_Id = '$userid' AND Post_Level = 1";
    $stmt = oci_parse($conn, $sql2);
    oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $Answer);
    oci_execute($stmt);
    oci_fetch($stmt);
    oci_free_statement($stmt);

    $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM POST WHERE User_Id = '$userid' AND Post_Level = 2";
    $stmt = oci_parse($conn, $sql2);
    oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $Reply);
    oci_execute($stmt);
    oci_fetch($stmt);
    oci_free_statement($stmt);
} // this condition is used for the visited
elseif (isset($_GET['visit']) && $visitedId != $userid) {
    // this line is for showing the users data
    $sql = "SELECT * FROM USER_PROFILE_PIC WHERE User_Id = '$userid' AND Pic_Status = 1";
    $get = oci_parse($conn, $sql);
    oci_execute($get) or die(oci_error());
    $rowUserImage = oci_fetch_array($get);
    if ($rowUserImage > 0) {
        $dir = $rowUserImage['PIC_DIRECTORY'];
        $picname = $rowUserImage['PIC_NAME'];
        $datatype = $rowUserImage['PIC_DATA_TYPE'];
    }


    // $visited = $_GET['visit'];
    // $visitedId =  $_GET['visited_id'];
    // these parts are for collecting visited's data
    $sql = "SELECT * FROM USER_ WHERE User_Id = '$visitedId'";
    $get = oci_parse($conn, $sql);
    oci_execute($get) or die(oci_error());

    $row = oci_fetch_array($get);
    $visitorName = $row['USER_NAME'];
    $visitorEmail = $row['USER_EMAIL'];
    // $visitor = $row['USER_GENDER'];
    $visitorTel = $row['USER_TELEPHONE_NO'];
    $visitorAddress = $row['USER_ADDRESS'];
    $visitorRole = $row['USER_ROLE'];
    $visitorDescription = $row['USER_DESCRIPTION'];
    $visitorEmail_show = $row['USER_EMAIL_SHOW'];
    $visitorTelNo_show = $row['USER_TELEPHONE_NO_SHOW'];
    $visitorAddress_show = $row['USER_ADDRESS_SHOW'];
    $visitorRole_confirmation = $row['USER_ROLE_CONFIRMATION'];

    $sql = "SELECT * FROM USER_PROFILE_PIC WHERE User_Id = '$visitedId' AND Pic_Status = 1";
    $get = oci_parse($conn, $sql);
    oci_execute($get) or die(oci_error());
    $rowUserImageVisitor = oci_fetch_array($get);
    if ($rowUserImageVisitor > 0) {
        $dirVisitor = $rowUserImageVisitor['PIC_DIRECTORY'];
        $picnameVisitor = $rowUserImageVisitor['PIC_NAME'];
        $datatypeVisitor = $rowUserImageVisitor['PIC_DATA_TYPE'];
    }

    // this part is for the users background pic
    $sql = "SELECT * FROM USER_BACKGROUND_PIC WHERE User_Id = '$visitedId' AND Back_Pic_Status = 1";
    $get = oci_parse($conn, $sql);
    oci_execute($get) or die(oci_error());
    $rowUserBackVisitor = oci_fetch_array($get);
    if ($rowUserBackVisitor > 0) {
        $backDir = $rowUserBackVisitor['BACK_PIC_DIRECTORY'];
        $backPicname = $rowUserBackVisitor['BACK_PIC_NAME'];
        $backDatatype = $rowUserBackVisitor['BACK_PIC_DATA_TYPE'];
    }


    $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM " . $visitedId . "_FOLLOWED WHERE User_Id = '$visitedId'";
    $stmt = oci_parse($conn, $sql2);
    oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $VisitorFollowed);
    oci_execute($stmt);
    oci_fetch($stmt);
    oci_free_statement($stmt);

    $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM  " . $visitedId . "_FOLLOWERS WHERE User_Id = '$visitedId'";
    $stmt = oci_parse($conn, $sql2);
    oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $VisitorFollowers);
    oci_execute($stmt);
    oci_fetch($stmt);
    oci_free_statement($stmt);



    $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM POST WHERE User_Id = '$visitedId' AND Post_Level = 0";
    $stmt = oci_parse($conn, $sql2);
    oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $QuestionVisitor);
    oci_execute($stmt);
    oci_fetch($stmt);
    oci_free_statement($stmt);

    $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM POST WHERE User_Id = '$visitedId' AND Post_Level = 1";
    $stmt = oci_parse($conn, $sql2);
    oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $AnswerVisitor);
    oci_execute($stmt);
    oci_fetch($stmt);
    oci_free_statement($stmt);

    $sql2 = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM POST WHERE User_Id = '$visitedId' AND Post_Level = 2";
    $stmt = oci_parse($conn, $sql2);
    oci_define_by_name($stmt, 'NUMBER_OF_ROWS', $ReplyVisitor);
    oci_execute($stmt);
    oci_fetch($stmt);
    oci_free_statement($stmt);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>
        Castle
    </title>
    <!-- <meta name=”viewport” content="width=device-width, initial-scale=1.0"> -->
    <style>

    </style>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
    <link rel='stylesheet' type='text/css' href='../../cssFiles/newsfeedStyles/newsfeed.css'>
    <link rel='stylesheet' type='text/css' href='../../cssFiles/newsfeedStyles/newsfeedQuestions.css'>
    <link rel='stylesheet' type='text/css' href='../../cssFiles/userProfile/userProfile.css'>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
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
                <div id='search-items'>
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
                        if ($rowUserImage == 0) {
                            echo "<img id='userpic' src='../../SVGs/user-alt-solid.svg' />";
                        } else {
                            echo "<img style='object-fit: cover' src='" . $dir . $picname . "." . $datatype . "' class='userimage' />";
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
            <div id='user-profile-holder'>
                <div id='user-profile-part1'>
                    <!-- <div id='item1'>
                        <div id='header'>User Profile</div>
                    </div> -->
                    <div id='item2'>
                        <div id='partBackground'>
                            <?php
                            if (isset($_GET['visit']) && ($visitedId != $userid)) {
                                if ($rowUserBackVisitor == 0) {
                                    echo "<div id='background-holder'>
                                                <div id='backimg-container'><img id='backimg' src='../../SVGs/image-solid.svg' /></div>
                                                <div id='view-back-button'><img class='backset' src='../../SVGs/view.svg' /></div>
                                            </div>";
                                } else {
                                    echo "<div id='background-holder'>
                                                <div id='backimg-container'><img id='set-backimg' src='" . $backDir . $backPicname . "." . $backDatatype . "' /></div>
                                                <div id='view-back-button'><img class='backset' src='../../SVGs/view.svg' /></div>
                                            </div>";
                                }
                            } else {
                                if ($rowUserBack == 0) {
                                    echo "<div id='background-holder'>
                                                <div id='backimg-container'><img id='backimg' src='../../SVGs/image-solid.svg' /></div>
                                                <div id='add-back-button'><img class='backset' src='../../SVGs/image.svg' /></div>
                                                <div id='view-back-button'><img class='backset' src='../../SVGs/view.svg' /></div>
                                            </div>";
                                } else {
                                    echo "<div id='background-holder'>
                                                <div id='backimg-container'><img id='set-backimg' src='" . $backDir . $backPicname . "." . $backDatatype . "' /></div>
                                                <div id='add-back-button'><img class='backset' src='../../SVGs/image.svg' /></div>
                                                <div id='view-back-button'><img class='backset' src='../../SVGs/view.svg' /></div>
                                            </div>";
                                }
                            }
                            ?>

                            <div id='view-background-screen'>
                                <div class='background-cancel'><img class='background-cancel-img' src='../../SVGs/cancel-button.svg'></div>
                                <div id='view-background-image'>
                                    <?php
                                    if (isset($_GET['visit']) && ($visitedId != $userid)) {
                                        if ($rowUserBackVisitor == 0) {
                                            echo "<img class='back-show' src='../../SVGs/image-solid.svg' />";
                                        } else {
                                            echo "<img id='back-show' src='" . $backDir . $backPicname . "." . $backDatatype . "' />";
                                        }
                                    } else {
                                        if ($rowUserBack == 0) {
                                            echo "<img class='back-show' src='../../SVGs/image-solid.svg' />";
                                        } else {
                                            echo "<img id='back-show' src='" . $backDir . $backPicname . "." . $backDatatype . "' />";
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                            <div id='add-background-screen'>
                                <div class='background-cancel'><img class='background-cancel-img' src='../../SVGs/cancel-button.svg'></div>
                                <div id='add-background-image'>
                                    <div id='add-background-image-container'>
                                        <img class='back-show' id='user-background' src='../../SVGs/image-solid.svg' />
                                    </div>
                                    <!--  action='./userProfilePic.php' -->
                                    <form id='background-form' method='POST' enctype='multipart/form-data' action='./userProfilePic.php?backimage=true' name='backform'>
                                        <label id='form-label-1'>
                                            <i><img class='final-step' style='position: relative; top: 3px;' src='../../SVGs/image.svg' /></i>Upload Image
                                            <input id='background-input' type='file' name='userbackground'>
                                        </label>
                                        <div id='background-image-save' onclick='saveImage(2)' name='userbacksave'>Save</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--  part1 is all about user profile photo -->
                        <div id='part1'>
                            <div id='pic-holder'>
                                <?php
                                if (isset($_GET['visit']) && ($visitedId != $userid)) {
                                    if ($rowUserImageVisitor == 0) {
                                        echo "<div id='default-img-holder'><img id='userpic1' src='../../SVGs/user-alt-solid.svg' /></div>
                                                <div id='view-visitor'><img class='profile-twicks' alt='show image' src='../../SVGs/view.svg'></div>";
                                    } else {
                                        echo "<img style='object-fit: cover' src='" . $dirVisitor . $picnameVisitor . "." . $datatypeVisitor . "' class='userimage'>";
                                        echo "  <!-- view image  src='../../SVGs/image.svg'-->
                                                <div id='view-visitor'><img class='profile-twicks' alt='show image' src='../../SVGs/view.svg'></div>";
                                    }
                                } else {
                                    if ($rowUserImage == 0) {
                                        echo "<div id='default-img-holder'><img id='userpic1' src='../../SVGs/user-alt-solid.svg' /></div>";
                                        echo "  <!-- view image  src='../../SVGs/image.svg'-->
                                                <div id='view'><img class='profile-twicks' alt='show image' src='../../SVGs/view.svg'></div>

                                                <div id='add'><img class='profile-twicks' alt='add image' src='../../SVGs/image.svg'></div>";
                                    } else {
                                        echo "<img style='object-fit: cover' src='" . $dir . $picname . "." . $datatype . "' class='userimage'>";
                                        echo "  <!-- view image  src='../../SVGs/image.svg'-->
                                                <div id='view'><img class='profile-twicks' alt='show image' src='../../SVGs/view.svg'></div>

                                                <div id='add'><img class='profile-twicks' alt='add image' src='../../SVGs/image.svg'></div>";
                                    }
                                }
                                ?>

                            </div>
                            <!-- this is image that will be viewed -->
                            <div id='view-image'>
                                <div id='image'>
                                    <?php
                                    if (isset($_GET['visit']) && ($visitedId != $userid)) {
                                        if ($rowUserImageVisitor == 0) {
                                            echo "<img src='../../SVGs/user-alt-solid.svg' alt='show image' class='image1'>";
                                        } else {
                                            echo "<img style='object-fit: cover' src='" . $dirVisitor . $picnameVisitor . "." . $datatypeVisitor . "' alt='show image' class='image1'>";
                                        }
                                    } else {
                                        if ($rowUserImage == 0) {
                                            echo "<img src='../../SVGs/user-alt-solid.svg' alt='show image' class='image1'>";
                                        } else {
                                            echo "<img style='object-fit: cover' src='" . $dir . $picname . "." . $datatype . "' alt='show image' class='image1'>";
                                        }
                                    }
                                    ?>
                                </div>
                                <div id='cancel'><img alt='show image' class='image1' src='../../SVGs/cancel-button.svg'></div>
                            </div>

                            <div id='add-image'>
                                <div id='image-holder'>
                                    <div id='image-details'><img id='user-image' src='../../SVGs/user-alt-solid.svg' /></div>
                                    <form id='image-form' method='POST' enctype='multipart/form-data' action='./userProfilePic.php' name='form'>
                                        <label>
                                            <i><img class='final-step' style='position: relative; top: 3px;' src='../../SVGs/image.svg' /></i>Upload Image
                                            <input id='image-input' type='file' name='userimage'>
                                        </label>
                                        <div id='image-submit' onclick='saveImage(1)' name='usersave'>Save</div>
                                    </form>
                                </div>
                                <div id='cancel1'><img class='image1' src='../../SVGs/cancel-button.svg' /></div>
                            </div>
                        </div>
                    </div>
                    <!--  iteme is all about users data -->
                    <div id='item3'>
                        <div id='user-status'>
                            <div class='noButton'>
                                <?php
                                if (isset($_GET['visit']) && ($visitedId != $userid)) {
                                    echo "<p class='statusFont1' id='user-name-for-id' data-visited-id='" . $visitedId . "'>User Name:</p>";
                                } else {
                                    echo "<p class='statusFont1'>User Name:</p>";
                                }
                                ?>

                                <p class='statusFont2 statusFontConditon2'>
                                    <?php
                                    if (isset($_GET['visit']) && ($visitedId != $userid)) {
                                        echo $visitorName;
                                    } else {
                                        echo $name;
                                    }
                                    ?></p>
                            </div>
                            <?php
                            if (isset($_GET['visit']) && ($visitedId != $userid)) {
                                echo "<div class='noButton'>";
                            } else {
                                echo "<div class='Button'>";
                            }
                            ?>

                            <p class='statusFont1'>Email:</p>
                            <?php
                            if (isset($_GET['visit']) && ($visitedId != $userid)) {
                                echo "<div class='statusFont2 statusFontConditon2'>";
                            } else {
                                echo "<div class='statusFont2 statusFontConditon1'>";
                            }
                            ?>
                            <div id='email'>
                                <?php
                                if (isset($_GET['visit']) && ($visitedId != $userid)) {
                                    if ($visitorEmail_show == 0) {
                                        echo "(Unauthorized)</div>";
                                    } else {
                                        echo $visitorEmail . "</div>";
                                    }
                                } else {
                                    if ($email_show == 0) {
                                        echo "(Unauthorized)</div>";
                                    } else {
                                        echo $email . "</div>";
                                    }
                                }
                                if (!isset($_GET['visit']) || ($visitedId == $userid)) {
                                    echo "<div class='on-off-button'>
                                    <div class='button-back'></div>
                                    <div class='button-front'></div>
                                </div>";
                                }
                                ?>
                            </div>

                        </div>
                        <?php
                        if (isset($_GET['visit']) && ($visitedId != $userid)) {
                            echo "<div class='noButton'>";
                        } else {
                            echo "<div class='Button'>";
                        }
                        ?>
                        <p class='statusFont1'>Telephone:</p>
                        <?php
                        if (isset($_GET['visit']) && ($visitedId != $userid)) {
                            echo "<div class='statusFont2 statusFontConditon2'>";
                        } else {
                            echo "<div class='statusFont2 statusFontConditon1'>";
                        }
                        ?>
                        <div id='telNo'>
                            <?php
                            if (isset($_GET['visit']) && ($visitedId != $userid)) {
                                if ($visitorTelNo_show == 0) {
                                    echo "(Unauthorized)</div>";
                                } else if ($visitorTel == 0) {
                                    echo "(Telephone NO. not Specified)</div>";
                                } else {
                                    echo $visitorTel . "</div>";
                                }
                            } else {
                                if ($telNo_show == 0) {
                                    echo "(Unauthorized)</div>";
                                } else if ($telNo == 0) {
                                    echo "(Telephone NO. not Specified)</div>";
                                } else {
                                    echo $telNo . "</div>";
                                }
                            }
                            if (!isset($_GET['visit']) || ($visitedId == $userid)) {
                                echo "<div class='on-off-button'>
                                        <div class='button-back'></div>
                                        <div class='button-front'></div>
                                        </div>";
                            }
                            ?>
                        </div>

                    </div>
                    <?php
                    if (isset($_GET['visit']) && ($visitedId != $userid)) {
                        echo "<div class='noButton'>";
                    } else {
                        echo "<div class='Button'>";
                    }
                    ?>
                    <p class='statusFont1'>Address:</p>
                    <?php
                    if (isset($_GET['visit']) && ($visitedId != $userid)) {
                        echo "<div class='statusFont2 statusFontConditon2'>";
                    } else {
                        echo "<div class='statusFont2 statusFontConditon1'>";
                    }
                    ?>
                    <div id='address'>
                        <?php
                        if (isset($_GET['visit']) && ($visitedId != $userid)) {
                            if ($visitorAddress_show == 0) {
                                echo "(Unauthorized)</div>";
                            } else if ($visitorAddress == 0) {
                                echo "(Telephone NO. not Specified)</div>";
                            } else {
                                echo $visitorAddress . "</div>";
                            }
                        } else {
                            if ($address_show == 0) {
                                echo "(Unauthorized)</div>";
                            } else if ($address == "") {
                                echo "(Address not Specified)</div>";
                            } else {
                                echo $address . "</div>";
                            }
                        }
                        if (!isset($_GET['visit']) || ($visitedId == $userid)) {
                            echo "<div class='on-off-button'>
                                    <div class='button-back'></div>
                                    <div class='button-front'></div>
                                    </div>";
                        }
                        ?>
                    </div>
                </div>
                <div class='noButton'>
                    <p class='statusFont1'>Role: </p>
                    <?php
                    if (isset($_GET['visit']) && ($visitedId != $userid)) {
                        if (($visitorRole_confirmation != 0) || ($visitorRole == "Normal User")) {
                            echo "<p class='statusFont2 statusFontConditon2'>";
                        } else if ($visitorRole_confirmation == 0) {
                            echo "<p class='statusFont2 statusFontConditon3'>";
                        }
                    } else {
                        if (($role_confirmation != 0) || ($role == "Normal User")) {
                            echo "<p class='statusFont2 statusFontConditon2'>";
                        } else if ($role_confirmation == 0) {
                            echo "<p class='statusFont2 statusFontConditon3'>";
                        }
                    }

                    ?>
                    <?php
                    if (isset($_GET['visit']) && ($visitedId != $userid)) {
                        if ($visitorRole == "Normal User") {
                            echo $visitorRole;
                        } else if ($visitorRole_confirmation == 0) {
                            echo $visitorRole . "<p class='statusFont3'>(Unconfirmed)</p>";
                        } else {
                            echo $visitorRole;
                        }
                    } else {
                        if ($role == "Normal User") {
                            echo $role;
                        } else if ($role_confirmation == 0) {
                            echo $role . "<p class='statusFont3'>(Unconfirmed)</p>";
                        } else {
                            echo $role;
                        }
                    }
                    ?>
                    </p>
                </div>
                <div class='noButton'>
                    <p class='statusFont1'>Answers:</p>
                    <p class='statusFont2 statusFontConditon2'>
                        <?php
                        if (isset($_GET['visit']) && ($visitedId != $userid)) {
                            echo $AnswerVisitor;
                        } else {
                            echo $Answer;
                        }
                        ?>
                    </p>
                </div>
                <div class='noButton'>
                    <p class='statusFont1'>Questions:</p>
                    <p class='statusFont2 statusFontConditon2'>
                        <?php
                        if (isset($_GET['visit']) && ($visitedId != $userid)) {
                            echo $QuestionVisitor;
                        } else {
                            echo $Question;
                        }
                        ?></p>
                </div>
                <div class='noButton'>
                    <p class='statusFont1'>Replies:</p>
                    <p class='statusFont2 statusFontConditon2'>
                        <?php
                        if (isset($_GET['visit']) && ($visitedId != $userid)) {
                            echo $ReplyVisitor;
                        } else {
                            echo $Reply;
                        }
                        ?></p>
                </div>
            </div>
            <div id='user-description'>
                <?php
                if (isset($_GET['visit']) && ($visitedId != $userid)) {
                    echo "<div id='description-holder-visitor'>";
                    if ($visitorDescription == "0") {
                        echo "No Description Specified";
                    } else {
                        echo $visitorDescription;
                    }
                    echo "</div>";
                } else {
                    echo "<div id='description-holder'>";
                    if ($user_description == "0") {
                        echo "No Description Specified";
                    } else {
                        echo $user_description;
                    }
                    echo "</div>  
                             <div id='edit-button'>Edit</div>";
                }
                ?>

            </div>
            <div id='user-subscription'>
                <?php
                if (isset($_GET["visit"]) && ($visitedId != $userid)) {
                    echo "<div id='follow-unfollow-button' class='follow-button center'>Follow + </div>
                    <div class='transparent center'>Followers:</div>
                    <div class='visible center'>" . $VisitorFollowers . "</div>
                    <div class='transparent center'>Following:</div>
                    <div class='visible center'>" . $VisitorFollowed . "</div>";
                } else {
                    echo "
                     <div class='transparent center'>Followers:</div>
                     <div class='visible center'>" . $UserFollowers . "</div>
                     <div class='transparent center'>Following:</div>
                     <div class='visible center'>" . $UserFollowed . "</div>";
                }
                ?>

            </div>
        </div>
        <!-- <div id='item4'>

                    </div> -->
    </div>

    </div>
    </div>
    <div id='right-right'>

    </div>
    </div>


</body>
<script type='text/javascript' src='../../../JSLib/svg-injector.min.js'></script>
<script type='text/javascript' src='../../../JSLib/JQuery.min.js'></script>
<!-- <script type='text/javascript' src='../../../Project_Castle_Y3S1/javascriptFiles/userProfile/userFollowShip.js'></script> -->
<!-- <script type='text/javascript' src='../../javascriptFiles/newsfeedJS/addingQuestion.js'></script> -->
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

<script type='text/javascript'>
    var castleSvg = document.getElementById('castle');
    var searchSvg = document.getElementById('search-img');
    var userDefaultImage = document.getElementById('userpic');
    var userDefaultImage1 = document.getElementById('userpic1');
    var icon = document.getElementsByClassName("nav-img");
    var profile_pic = document.getElementById('profile-pic');
    var profile_twicks = document.getElementsByClassName('profile-twicks');
    var logoutSvg = document.getElementById('logout-svg');
    var backImg = document.getElementById('backimg');
    var backSet = document.getElementsByClassName('backset');
    var backCancel = document.getElementsByClassName('background-cancel-img');
    var backShow = document.getElementsByClassName('back-show');
    // these svg injectors were used to make the svgs editable through the javascript itself.
    // and not adding the whole svg into the html, and make it such long lines of code.
    // SVGInjector(castleSvg);
    // SVGInjector(searchSvg);
    // SVGInjector(profile_pic);
    // SVGInjector(userDefaultImage);
    // SVGInjector(userDefaultImage1);
    // SVGInjector(logoutSvg);
    // SVGInjector(icon);
    // SVGInjector(image2);
    // SVGInjector(cancel1);
    // SVGInjector(backImg);


    var index;
    for (index = 0; index < profile_twicks.length; index++) {
        SVGInjector(profile_twicks[index]);
    }
    for (index = 0; index < backSet.length; index++) {
        SVGInjector(backSet[index]);
    }
    for (index = 0; index < backCancel.length; index++) {
        SVGInjector(backCancel[index]);
    }
    if (backShow) {
        for (index = 0; index < backShow.length; index++) {
            SVGInjector(backShow[index]);
        }
    }
    for (index = 0; index < backSet.length; index++) {
        backSet[index].style.width = '100px';
        backSet[index].style.height = '70px';
    }
    for (index = 0; index < backCancel.length; index++) {
        backCancel[index].style.width = '30px';
        backCancel[index].style.height = '30px';
    }

    // styling svg injected image tags
    if (backShow) {
        for (index = 0; index < backShow.length; index++) {
            backShow[index].style.width = '500px';
            backShow[index].style.height = '450px';
        }
    }

    if (backImg) {
        backImg.style.width = '150px';
        backImg.style.height = '120px';
    }

    castleSvg.style.width = '55px';
    castleSvg.style.height = '55px';
    searchSvg.style.height = '25px';
    searchSvg.style.width = '25px';
    logoutSvg.style.height = '25px';
    logoutSvg.style.width = '25px';

    if (userDefaultImage) {
        userDefaultImage.style.height = '15px';
        userDefaultImage.style.width = '15px';
    }

    if (userDefaultImage1) {
        userDefaultImage1.style.height = '130px';
        userDefaultImage1.style.width = '130px';
    }

    if (profile_pic) {
        profile_pic.style.width = '100px';
        profile_pic.style.height = '100px';
    }

    for (index = 0; index < profile_twicks.length; index++) {
        profile_twicks[index].style.height = '60px';
        profile_twicks[index].style.width = '60px';
    }

    for (index = 0; index < icon.length; index++) {
        icon[index].style.height = '30px';
        icon[index].style.width = '30px';
    }

    // search input variables
    var searchItems = document.getElementById('search-items');
    var searchInput = document.getElementById('search-input');
    var count = false;

    searchInput.addEventListener('focusin', () => {
        searchItems.style.width = "90%";
    });

    searchInput.addEventListener('focusout', () => {
        searchItems.style.width = '200px';
    });


    var navigation = document.getElementsByClassName('nav');
    var image_view = document.getElementById('view-image');
    var view = document.getElementById('view');
    var viewVisitor = document.getElementById('view-visitor');
    var add = document.getElementById('add');
    var image1 = document.getElementsByClassName('image1');
    var cancel = document.getElementById('cancel');
    var cancel1 = document.getElementById('cancel1');
    var add_image = document.getElementById('add-image');
    var final_image = document.getElementsByClassName('final-step');
    var user_image = document.getElementById('user-image');

    var assign = false;

    for (index = 0; index < image1.length; index++) {
        SVGInjector(image1[index]);
    }
    for (index = 0; index < final_image.length; index++) {
        SVGInjector(final_image[index]);
    }

    for (index = 0; index < final_image.length; index++) {
        final_image[index].style.height = '30px';
        final_image[index].style.width = '30px';
    }
    image1[1].style.width = '30px';
    image1[1].style.height = '30px';
    image1[2].style.width = '30px';
    image1[2].style.height = '30px';
    user_image.style.width = '100px';
    user_image.style.height = '100px';

    cancel.addEventListener('click', function(event) {
        event.stopPropagation();
        image_view.style.display = 'none';
    });
    cancel1.addEventListener('click', function(event) {
        event.stopPropagation();
        add_image.style.display = 'none';
    });

    if (view) {
        view.addEventListener('click', function(event) {
            event.stopPropagation();
            image_view.style.display = 'flex';
        });
    }
    if (viewVisitor) {
        viewVisitor.addEventListener('click', function(event) {
            event.stopPropagation();
            image_view.style.display = 'flex';
        });
    }
    if (add) {
        add.addEventListener('click', function(event) {
            event.stopPropagation();
            add_image.style.display = 'flex';
        });

    }


    navigation[0].addEventListener('click',
        function() {
            window.location.assign('../newsfeedPHP/newsfeed.php');
        });
    navigation[1].addEventListener('click',
        function() {
            window.location.assign('../userProfile/userProfile.php');
        });


    const fileTypes = [
        "image/apng",
        // "image/bmp",
        "image/gif",
        "image/jpeg",
        "image/pjpeg",
        "image/png",
        "image/jpg"
        // "image/svg+xml",
        // "image/tiff",
        // "image/webp",
        // "image/x-icon"
    ];

    function validFileType(file) {
        return fileTypes.includes(file.type);
    }

    function returnFileSize(number) {
        // if (number < 1024) {
        //     return number + 'bytes';
        // } else if (number >= 1024 && number < 1048576) {
        //     return (number / 1024).toFixed(1) + 'KB';
        // } else if (number >= 1048576) {
        //     return (number / 1048576).toFixed(1) + 'MB';
        // }
        if ((number / 1048576).toFixed(1) < 10) {
            return true;
        } else {
            alert('Sorry The File Size Is Too Big!');
            return false;
        }
    }


    var image_input = document.getElementById('image-input');
    var image_details = document.getElementById('image-details');


    image_input.addEventListener('change', function() {
        while (image_details.firstChild) {
            image_details.removeChild(image_details.firstChild);
        }

        var file = image_input.files[0];

        if (validFileType(file)) {
            if (returnFileSize(file.size)) {
                var image = document.createElement('img');
                image.src = URL.createObjectURL(file);
                image.style.height = '100%';
                image.style.width = '100%';
                image.style.borderRadius = '5px';
                image_details.appendChild(image);
            } else {
                alert('Sorry, The file is Too large! must be less than 10MBs');
            }

        } else {
            alert('Sorry, File Type Not Supported!');
        }
    });


    var background_input = document.getElementById('background-input');
    var backImage_details = document.getElementById('add-background-image-container');

    background_input.addEventListener('change', function() {
        while (backImage_details.firstChild) {
            backImage_details.removeChild(backImage_details.firstChild);
        }

        var file = background_input.files[0];
        if (validFileType(file)) {
            if (returnFileSize(file.size)) {
                var back_img = document.createElement('img');
                back_img.src = URL.createObjectURL(file);
                back_img.style.height = '100%';
                back_img.style.width = '100%';
                back_img.style.borderRadius = '5px';
                backImage_details.appendChild(back_img);
            } else {
                alert('Sorry, The file is Too large! must be less than 10MBs');
            }
        } else {
            alert('Sorry, File Type Not Supported!');
        }
    });

    // this is placed on the div as onclick attribute
    function saveImage(num) {
        var string1 = 'user-image';
        var string2 = 'user-background';
        if (num == 1) {
            if (image_details.firstChild.id == string1) {
                alert("You Didn't Choose An Image!");
            } else {
                $('#image-form').submit();
            }
        } else if (num == 2) {
            if (backImage_details.firstChild.id == string2) {
                alert("You Didn't Choose A Background!");
            } else {
                $('#background-form').submit();
            }
        }

    }

    var butBack = document.getElementsByClassName("button-back");
    var butFront = document.getElementsByClassName("button-front");
    var buttonOnOff = document.getElementsByClassName("on-off-button");
    var email, telephone, telephone_content, address, address_content;
    // var age, gender;

    var first = function() {
        $.ajax({
            type: "GET",
            url: "./userData.php",
            async: true,
            success: function(result) {
                var data = JSON.parse(result);
                // console.log(data);
                email = parseInt(data[0][16]);
                // age = parseInt(data["USER_AGE_SHOW"]);
                // gender = parseInt(data["USER_GENDER_SHOW"]);
                telephone = parseInt(data[0][19]);
                address = parseInt(data[0][20]);
                email_content = data[0][4];

                if (data[0][8] === null) {
                    address_content = "(Address not Specified)";
                } else {
                    address_content = data[0][8];
                }
                console.log(address_content);
                if (parseInt(data[0][7]) == 0) {
                    telephone_content = "(Telephone NO. not Specified)";
                } else {
                    telephone_content = data[0][7];
                }
                console.log(telephone_content);

                console.log(email + " " + address + " " + telephone + " ");
                // for email
                if (butBack[0] && butFront[0]) {
                    if (email == 0) {
                        butFront[0].style.left = 0 + "%";
                        butBack[0].style.width = 0 + "%";
                    } else {
                        butBack[0].style.width = 100 + "%";
                        butFront[0].style.left = 100 + "%";
                    }
                }
                // for telephone
                if (butBack[1] && butFront[1]) {
                    if (telephone == 0) {
                        butFront[1].style.left = 0 + "%";
                        butBack[1].style.width = 0 + "%";
                    } else {
                        butBack[1].style.width = 100 + "%";
                        butFront[1].style.left = 100 + "%";
                    }
                }
                if (butBack[2] && butFront[2]) {
                    // for address
                    if (address == 0) {
                        butFront[2].style.left = 0 + "%";
                        butBack[2].style.width = 0 + "%";
                    } else {
                        butBack[2].style.width = 100 + "%";
                        butFront[2].style.left = 100 + "%";

                    }
                }
            }
        });
    }


    //?visitedId=" + visitedId
    var follow;
    var visitedIdHolder = document.getElementById("user-name-for-id");
    if (visitedIdHolder) {
        var visitedId = visitedIdHolder.getAttribute("data-visited-id");
        var second = function() {
            $.ajax({
                type: "POST",
                data: {
                    "visited_id": visitedId
                },
                url: "./userFollowShip.php",
                // async: true,
                success: function(result) {
                    var data = parseInt(JSON.parse(result));
                    console.log(data);
                    if (data == 1) {
                        if (followButton.classList.contains("follow-button")) {
                            followButton.classList.remove("follow-button");
                        }
                        followButton.classList.add('unfollow-button');
                        followButton.textContent = "Unfollow";
                        follow = true;
                    } else {
                        if (followButton.classList.contains("unfollow-button")) {
                            followButton.classList.remove("unfollow-button");
                        }
                        followButton.classList.add('follow-button');
                        followButton.textContent = "Follow + ";
                        follow = false;
                    }
                }
            });
        }
    }


    // subscription buttons
    var followButton = document.getElementById("follow-unfollow-button");
    var visible = document.getElementsByClassName('visible')[0];
    if (followButton && visitedId) {
        followButton.addEventListener('click', function(event) {
            if (!follow) {
                followButton.classList.toggle('follow-button');
                followButton.classList.add('unfollow-button');
                followButton.textContent = "Unfollow";
                $.ajax({
                    type: "POST",
                    data: {
                        "follow": "1",
                        "visited_id": visitedId
                    },
                    url: "./userFollowsUnfollows.php",
                    success: function(result) {
                        // console.log(result);
                        visible.innerHTML = 1 + parseInt(visible.innerHTML);
                    }
                });
                follow = true;
            } else {
                followButton.classList.toggle('unfollow-button');
                followButton.classList.add('follow-button');
                followButton.textContent = "Follow + ";
                $.ajax({
                    type: "POST",
                    data: {
                        "follow": "0",
                        "visited_id": visitedId
                    },
                    url: "./userFollowsUnfollows.php",
                    success: function(result) {
                        // console.log(result);
                        visible.innerHTML = parseInt(visible.innerHTML) - 1;
                    }
                });
                follow = false;
            }
        });
    }
    var loading = new Promise((loaded) => {
        window.onload = loaded;
    });
    loading.then(first);
    loading.then(second);

    if (buttonOnOff[0]) {
        buttonOnOff[0].addEventListener('click', function(event) {
            var emailId = document.getElementById('email');
            if (email == 0) {
                email = 1;
                butBack[0].style.width = 100 + "%";
                butFront[0].style.left = 100 + "%";
                $.ajax({
                    type: "GET",
                    url: "./userDataShow.php?email=" + email,
                    async: true,
                    success: function(result) {
                        console.log("email:" + email);
                        emailId.innerHTML = email_content;

                    }
                });

            } else {
                email = 0;
                butBack[0].style.width = 0 + "%";
                butFront[0].style.left = 0 + "%";
                $.ajax({
                    type: "GET",
                    url: "./userDataShow.php?email=" + email,
                    async: true,
                    success: function(result) {
                        console.log("email:" + email);
                        emailId.innerHTML = "(Unauthorized)";
                    }
                });
            }
        });
    }

    if (buttonOnOff[1]) {
        buttonOnOff[1].addEventListener('click', function(event) {
            var telNoId = document.getElementById('telNo');
            if (telephone == 0) {
                telephone = 1;
                butBack[1].style.width = 100 + "%";
                butFront[1].style.left = 100 + "%";
                $.ajax({
                    type: "GET",
                    url: "./userDataShow.php?telephone=" + telephone,
                    async: true,
                    success: function(result) {
                        console.log("telephone:" + telephone);
                        telNoId.innerHTML = telephone_content;
                    }
                });

            } else {
                telephone = 0;
                butBack[1].style.width = 0 + "%";
                butFront[1].style.left = 0 + "%";
                $.ajax({
                    type: "GET",
                    url: "./userDataShow.php?telephone=" + telephone,
                    async: true,
                    success: function(result) {
                        console.log("telephone:" + telephone);
                        telNoId.innerHTML = "(Unauthorized)";

                    }
                });
            }
        });
    }

    if (buttonOnOff[2]) {
        buttonOnOff[2].addEventListener('click', function(event) {
            var addressId = document.getElementById('address');
            if (address == 0) {
                address = 1;
                butBack[2].style.width = 100 + "%";
                butFront[2].style.left = 100 + "%";
                $.ajax({
                    type: "GET",
                    url: "./userDataShow.php?address=" + address,
                    async: true,
                    success: function(result) {
                        console.log("address:" + address);
                        addressId.innerHTML = address_content;
                    }
                });

            } else {
                address = 0;
                butBack[2].style.width = 0 + "%";
                butFront[2].style.left = 0 + "%";
                $.ajax({
                    type: "GET",
                    url: "./userDataShow.php?address=" + address,
                    async: true,
                    success: function(result) {
                        console.log("address:" + address);
                        addressId.innerHTML = "(Unauthorized)";
                    }
                });
            }
        });
    }

    // CODE for self Description
    var userDescription = document.getElementById('user-description');
    var userDescriptionHolder = document.createElement('div');;
    userDescriptionHolder.innerHTML = userDescription.innerHTML;
    var descriptionHolder = document.getElementById('description-holder');
    var editButton = document.getElementById('edit-button');

    if (editButton) {
        editButton.addEventListener('click', function(event) {
            var textDescription = document.createElement('textarea');
            textDescription.id = "textarea";
            var saveButton = document.createElement('div');
            saveButton.id = "save-button";
            saveButton.textContent = "Save";
            textDescription.textContent = descriptionHolder.textContent.trim();
            userDescription.innerHTML = "";
            userDescription.appendChild(textDescription);
            userDescription.appendChild(saveButton);
            textDescription.focus();
            saveButton.addEventListener('click', function() {
                var newDescription = textDescription.value;
                console.log(textDescription.textContent.toString());
                descriptionHolder.textContent = textDescription.value;
                userDescription.innerHTML = "";
                userDescription.appendChild(descriptionHolder);
                // console.log(descriptionHolder.innerHTML);
                userDescription.appendChild(editButton);
                $.ajax({
                    type: "GET",
                    url: "./userAddDescription.php?description=" + newDescription,
                    async: true,
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    }


    var addBackButton = document.getElementById('add-back-button');
    var viewBackButton = document.getElementById('view-back-button');
    var addBackScreen = document.getElementById('add-background-screen');
    var viewBackScreen = document.getElementById('view-background-screen');
    var backCancelButton = document.getElementsByClassName('background-cancel');

    viewBackButton.addEventListener('click', function() {
        viewBackScreen.style.display = "flex";
    });

    backCancelButton[0].addEventListener('click', function() {
        viewBackScreen.style.display = "none";
    });

    if (addBackButton) {
        addBackButton.addEventListener('click', function() {
            addBackScreen.style.display = "flex";
        })
    }


    backCancelButton[1].addEventListener('click', function() {
        addBackScreen.style.display = "none";
    })
</script>

</html>