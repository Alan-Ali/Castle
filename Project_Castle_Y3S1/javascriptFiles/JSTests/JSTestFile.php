<!DOCTYPE html>
<?php


?>
<html>

<head>

    <style>
        #demo {
            width: 800px;
            border: 1px solid black;
            margin: 0px auto;
        }

        #status {
            position: fixed;
            top: 100px;
            left: 50px;
            width: 150px;
            height: 100px;
            background-color: white;
        }

        .newdata {
            height: 2000px;
            /* width: 300px; */
            background-color: skyblue;
        }
    </style>
</head>

<body>

    <div id="status">0 | 0</div>


    <div id='demo'>
        <div style='width: 300px; height: 800px; margin: 0px auto;'>You</div>
    </div>

    <!-- <label for="FileInput">
        <img class='profile-twicks' src="../SVGs/view.svg" style="cursor:pointer" 
        onmouseover="this.src='C:/xampp/htdocs/Castle/Project_Castle_Y3S1/SVGs/bell-solid.svg'" onmouseout="this.src='../SVGs/view.svg'" alt="Injaz Msila" style="float:right;margin:7px" />
    </label>
    <form action="">
        <input type="file" id="FileInput" style="cursor: pointer;  display: none" />
        <input type="submit" id="Up" style="display: none;" />
    </form> -->


    <!-- <form method="post" enctype="multipart/form-data">
        <div>
            <label for="image_uploads">Choose images to upload (PNG, JPG)</label>
            <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png">
        </div> -->
    <!-- <div class="preview">
            <p>No files currently selected for upload</p>
        </div>
        <div>
            <button>Submit</button>
        </div>
    </form> -->

    <!-- <form method='POST' action='' enctype="multipart/form-data">
        <label id='add'>
            <input type="file" />
            <img class='profile-twicks' src='../SVGs/view.svg'>
        </label>
    </form> -->


</body>
<script type='text/javascript' src='../../../JSLib/JQuery.min.js'></script>
<script type='text/javascript'>
    // var image = document.getElementsByClassName('profile-twicks');
    // for (var index = 0; index < image.length; index++) {
    //     image[index].style.width = '40px';
    //     image[index].style.height = '40px';
    // }
    // $("#FileInput").change(function() {
    //     for (var index = 0; index < image.length; index++) {
    //         image[index].style.width = '40px';
    //         image[index].style.height = '40px';
    //     }
    //     $("#Up").click();
    // });




    // const input = document.querySelector('input');
    // const preview = document.querySelector('.preview');
    // const demo = document.querySelector('#demo');

    // input.addEventListener('change', showImage);

    // function showImage(){
    //     var file = input.files;
    //     console.log("here");
    //     const show = URL.createObjectURL(file[0]);
    //     const image = document.createElement('img');
    //     image.src = show;
    //     demo.appendChild(image);
    // }
        

    window.onscroll = function yHandler() {
        var demo = document.getElementById('demo');
        // the offsetHeight will give the demo's height
        var contentHeight = demo.offsetHeight;
        // pageYOffset will give the position from the left corner of the page
        // and when you go down it increases, same with pageXOffset but pageXOffset 
        // is from left to right
        var yOffset = window.pageYOffset;
        // we are going to 
        var y = yOffset + window.innerHeight;

        if (y >= contentHeight) {
            demo.innerHTML += "<div class='newdata'> hello </div>";
        }
        var status = document.getElementById('status');
        status.innerHTML = contentHeight + " | " + y;
    }
    
</script>

</html>