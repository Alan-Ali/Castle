
var follow = false;

var visitedIdHolder = document.getElementById("user-name-for-id");
// if (visitedIdHolder){
//     var visitedId = visitedIdHolder.getAttribute("data-visited-id");
    
    window.onload= function(){
        $.ajax({
            type: "GET",
            // data: {"visited_id": visitedId}, 
            url: "../../phpFiles/userProfile/userFollowShip.php",
            async: true,
            success: function(result) {
                // var data = JSON.parse(result);
                console.log("result");
            }
        });
    }
// }

// ?visited_id=" + visitedId



// subscription buttons
var followButton = document.getElementById("follow-unfollow-button");

if (followButton) {
        followButton.addEventListener('click', function (event) {
            if (!follow) {
                followButton.classList.toggle('follow-button');
                followButton.classList.add('unfollow-button');
                followButton.textContent = "Unfollow";
                follow = true;
            } else {
                followButton.classList.toggle('unfollow-button');
                followButton.classList.add('follow-button');
                followButton.textContent = "Follow + ";
                follow = false;
            }
        });
    }