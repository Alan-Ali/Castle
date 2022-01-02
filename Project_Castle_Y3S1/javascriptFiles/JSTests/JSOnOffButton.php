<!DOCTYPE html>
<?php


?>
<html>

<head>

    <style>
        /* body {
            position: relative;
        } */

        #demo {
            width: 150px;
            height: 60px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid black;
            margin: 0px auto;
            cursor: pointer;
            pointer-events:painted;
        }

        #demo #button-follower {
            height: 100%;
            width: 0%;
            background-color: red;
            transition: 600ms all;
            position: relative;
        }

        /* #demo:hover #button-follower {
            width: 100%;
        } */

        #demo #button {
            width: 50px;
            height: 130%;
            left: -15%;
            top: -115%;
            transition: 600ms all;
            position: relative;
            background-color: skyblue;
        }

        /* #demo:hover #button {
            left: 85%;
        } */
    </style>
</head>

<body>




    <div id='demo'>
        <div id='button-follower'>

        </div>
        <div id='button'>

        </div>
    </div>


</body>
<script type='text/javascript' src='../../../JSLib/JQuery.min.js'></script>
<script type='text/javascript'>
    var demo = "#demo";
    var button = "#button";
    var Bfollow = "#button-follower";
    var bool = false;
    $(demo).click(function() {
        if (!bool) {
            $(button).css({
                left: "85%"
            });
            $(Bfollow).css({
                width: "100%"
            });
            bool = true;
        } else {
            $(button).css({
                left: "-15%"
            });
            $(Bfollow).css({
                width: "0%"
            });
            bool = false;
        }
    });
</script>

</html>