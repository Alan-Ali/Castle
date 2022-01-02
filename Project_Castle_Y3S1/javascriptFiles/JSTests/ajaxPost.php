<!DOCTYPE html>
<html>

<head>
    <style>

    </style>
</head>

<body>
    <div class='glass'>


    </div>
    <!-- 
    <div class='card'>
        <img class='hello' src='./discord_v2.1225443.svg' />
    </div> -->


</body>
<script type='text/javascript' src='../../../../JSLib/JQuery.min.js'></script>
<script type='text/javascript'>
    // var hello = [];
    // hello[0] = "alan";
    // hello[1] = "hi";
    // hello[2] = "why";

    // $.ajax({
    //     type: "POST",
    //     data: {info: hello},
    //     async: true,
    //     url: "./dataGrabber.php",
    //     success: function(result) {
    //         console.log(result);
    //     }
    // })
    class followers {
        constructor(value) {

        }

        dataGet(url, string, bool, fun) {
            $.ajax({
                type: "GET",
                url: url + string,
                async: bool,
                success: function(result) {
                    fun(result);
                }
            });
        }
        dataPost(url, ob, bool, fun) {
            $.ajax({
                type: "POST",
                data: ob,
                url: url,
                async: bool,
                success: function(result) {
                    fun(result);
                }
            });
        }
        // get ()  {return value};
    }

    var object = new followers();
    // object.dataGet("./dataGrabber.php", "", true, function(result) {
    //     console.log(result);
    // })

    object.dataPost("./dataGrabber.php", {
            "hello": "hi",
            "hi": "hello"
        }, true,
        function(result) {
            console.log(result);
        });
</script>

</html>