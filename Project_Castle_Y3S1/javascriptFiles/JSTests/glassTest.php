<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            background-color: rgb(243, 241, 241);
            ;
            position: relative;
        }

        .glass {
            /* background: white; */
            min-height: 80vh;
            width: 60%;
            background: linear-gradient(to right bottom,
                    rgba(255, 255, 255, 0.7),
                    rgba(255, 255, 255, 0.3));
            border-radius: 2rem;
            /* z-index: 2; */
            backdrop-filter: blur(.25rem);
            display: flex;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .card {
            width: 300px;
            height: 300px;
            border-radius: 25px;
            position: absolute;
            top: 50px;
            left: 300px;
            z-index: -1;
            background-color: rgba(255, 255, 255);
        }

        .hello {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <!-- <div class='glass'>


    </div>

    <div class='card'>
        <img class='hello' src='./discord_v2.1225443.svg' />
    </div> -->

    <div id='demo'></div>



    <script type='text/javascript' src='../../../JSLib/JQuery.min.js'></script>
    <script type='text/javascript' >

     var demo = $('#demo');
    
     var data;
     $.ajax({
         url: "../../JSON/Topics.json",
         type: "GET",
         async: true,
         dataType: 'json',
         success: (response)=>{
            // console.log(response.Topics);
            data = response.Topics;
            console.log(data.length);
         }
     })

    </script>
</body>

</html>