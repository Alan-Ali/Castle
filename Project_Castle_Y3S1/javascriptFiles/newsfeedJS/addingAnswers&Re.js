// import { empty } from './addingQuestion.js';

// the getting answer and replies parts in case needed
// -> used
var other_answers = document.getElementById('A-other-answers'); 
var other_answers_imposter = document.createElement('div');
other_answers_imposter.classList.add('A-other-answers');
other_answers_imposter.innerHTML = other_answers.innerHTML;

var section_0 = document.getElementsByClassName('answer-replies');
var section_0_class = 'answer-replies';
section_0[0].style.display ='none';

var section_1 = document.getElementsByClassName('answer');
var section_1_class = 'answer';
// this doesn't work on classes
// var section_1_imposter = document.createElement('div');
// section_1_imposter.classList.add('answer');
// section_1_imposter.innerHTML = section_1.innerHTML;

var section_1_1 = document.getElementsByClassName('userdetails');
var section_1_1_class = 'userdetails';

var section_1_2 = document.getElementsByClassName('user-answer');
var section_1_2_class = 'user-answer';

var section_1_3 = document.getElementsByClassName('user-reply');
var section_1_3_class = 'user-reply';

//-> used
var section_2 = document.getElementsByClassName('replies');
var section_2_class = 'replies';
var section_2_imposter = document.createElement('div');
section_2_imposter.classList.add(section_2_class);
section_2_imposter.innerHTML = section_2[0].innerHTML;

var section_2_1 = document.getElementsByClassName('reply-user-details-1');
var section_2_1_class = 'reply-user-details-1'; 

var section_2_2 = document.getElementsByClassName('reply-holder-1');
var section_2_2_class = 'reply-holder-1';



// getting other necessary parts
var answerRep = document.getElementsByClassName('combutton');
// this one is for the Question
var equalize = [];

for (var index = 0; index < answerRep.length; index++) {
    equalize[index] = false;
}




// giving event to the comment button of answers
function replyGiver(){
    var comButton = document.getElementsByClassName('combutton');
// we add the necessary events to the reply buttons
Array.prototype.forEach.call(answerRep, function (value, index) {
    answerRep[index] = value.addEventListener('click', function () {
        if (!equalize[index]) {
            section_1_3[index].style.height = '180px';
            comButton[index].style.backgroundImage = 'linear-gradient(200deg, rgb(221, 221, 221), rgba(197, 197, 197, 0.801))';
            equalize[index] = true;
        } else {
            section_1_3[index].style.height = '0';
            comButton[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221, 0), rgba(197, 197, 197, 0))';
            equalize[index] = false;
            }
        });
    });

}




function replyButtons() {
    // getting text and buttons for the reply part of the answer;
  var reply_text = document.getElementsByClassName('reply-text-0');
var reply_adder = document.getElementsByClassName('reply-adder-button');
    Array.prototype.forEach.call(reply_adder,
        function (value, index) { 
            var holder = section_1[index].getAttribute('data-paid');    
            // var text = reply_text[index].value;
            reply_adder[index] = value.setAttribute('data-parent', holder);
            
            reply_adder[index] = value.addEventListener('click',
                function () {
                // if(index < reply_text.length){
                    if (empty(reply_text[index].value)) {
                        // console.log('here'); ansUnlike.forEach(
                        alert("Please Don't Leave The Reply Field Empty!");
                    } else {
                        
                        // console.log(holder);
                        $.ajax({
                            type: "GET",
                            url: "../../phpFiles/newsfeedPHP/addingReply.php?parid=" + holder
                                + "&reply=" + reply_text[index].value,
                            async: true,
                            success: (result) =>{
                                window.location.reload();
                            }
                        });
                    }
                // }
            });
         
        });
}

function SVGs(){ 
    // we get some of the images exist in the other_answers
    var ans_imgs = document.getElementsByClassName('ans-imgs');
    var userDefaultImage = document.getElementsByClassName('userpic');
    // then we run SVGInjector on them because the went out of the original files flow
    for (var index = 0; index < ans_imgs.length; index++) {
        SVGInjector(ans_imgs[index]);
    }
    for (var index = 0; index < userDefaultImage.length; index++) {
        SVGInjector(userDefaultImage[index]);
    }
    for (var index = 0; index < ans_imgs.length; index++) {
        ans_imgs[index].style.height = '20px';
        ans_imgs[index].style.width = '20px';
    }
    for (var index = 0; index < userDefaultImage.length; index++) {
        userDefaultImage[index].style.width = '18px';
        userDefaultImage[index].style.height = '18px';
    }
}



// other_answers_imposter.innerHTML = other_answers.innerHTML;
// other_answers.innerHTML = " ";
$(document).ready(function() {
    $.ajax({
    type: "GET",
    async: true,
    url: "../../phpFiles/newsfeedPHP/postAnsRe.php",
    success: function(result){ 
        // console.log(result);
        if(result == '0'){
            console.log("no answer is here");
        }else{
            // console.log(result);
            var data = JSON.parse(result);
            // console.log(data);
            // console.log(data.length);
            // contains post data
            var dataPost = [];
            dataPost = data[0];
            // console.log(dataPost);
            // contains the user data
            var dataUser = [];
            dataUser = data[1];
            // console.log(dataUser);
            var dataPic = [];
            dataPic = data[2];
            console.log(dataPic);

            var level;
            // the usrname will be used to put the the names in innerHTMLs
            var username, userid;
            // the collector is used to know that the for loop may proceed, but it may not always add 
            // other_answers innerHTML 
            var collector = 0;
            var collector1 = 0;   
            var index, index1, counter, counter1, counter2;
            var ansPicFound, ansPic, repPicFound, repPic;

            other_answers.innerHTML = ' ';
                // here we use the for to show the data in the ajax call.
                for(index = 0; index < dataPost.length; index++){
                    // if(count == 0){
                        level = parseInt(dataPost[index][3]);
                        if (dataPost[index][2] == dataPost[index][4] && level == 1){
                            // searching for the username
                            for(index1 = 0; index1 < dataUser.length; index1++){
                                if(dataUser[index1][0] == dataPost[index][1]){
                                        username = dataUser[index1][1];
                                        userid = dataUser[index1][0];
                                        break;
                                }
                            }
                                for (counter1 = 0; counter1 < dataPic.length; counter1++) {

                                    if (dataPic[counter1] && dataPic[counter1][1] == userid) {
                                        ansPic = dataPic[counter1];
                                        ansPicFound = true;
                                        break;
                                    }
                                    ansPicFound = false;
                                }
                          
                     
                            // when we found the pic for the answer post
                            if(ansPicFound){
                                picSubstitute = "../../SVGs/user-alt-solid.svg";
                                const regex = new RegExp(`${picSubstitute}`);
                                other_answers.innerHTML += other_answers_imposter.innerHTML
                                    .replace(/Anstext/g, dataPost[index][8] + (dataPost[index][12] == null ? "" : dataPost[index][12])
                                        + (dataPost[index][13] == null ? "" : dataPost[index][13])
                                        + (dataPost[index][14] == null ? "" : dataPost[index][14]))
                                    .replace(/Ansusername/g, username)
                                    .replace(/Repusername/g, username)
                                    .replace(/Ansreply/g, dataPost[index][5])
                                    .replace(/Anslike/g, dataPost[index][6])
                                    .replace(/Ansunlike/g, dataPost[index][7]);

                                section_1[collector].innerHTML = section_1[collector].innerHTML
                                    .replace(regex, ansPic[4] + ansPic[3] + "." + ansPic[2]);
                                // section_1_3[collector].innerHTML = section_1_3[collector].innerHTML
                                // .replace(regex, )
                            }
                            // when the pic is not found fort the answer
                            else{

                            other_answers.innerHTML += other_answers_imposter.innerHTML
                                .replace(/Anstext/g, dataPost[index][8] + (dataPost[index][12] == null ? "" : dataPost[index][12])
                                + (dataPost[index][13] == null ? "" : dataPost[index][13])
                                + (dataPost[index][14] == null ? "" : dataPost[index][14]))
                                .replace(/Ansusername/g, username)
                                .replace(/Repusername/g, username)
                                .replace(/Ansreply/g, dataPost[index][5])
                                .replace(/Anslike/g, dataPost[index][6])
                                .replace(/Ansunlike/g, dataPost[index][7]);

                            }
                  
                            section_2[collector].innerHTML = '';
                            // section_0[index].style.minHeight = '201px';
                            section_1[collector].setAttribute('data-paid', dataPost[index][0]);
                            section_0[collector].style.display = 'flex';
                            for (counter = 0; counter < dataPost.length; counter++){
                                // if the parent id was equal to the post id
                                // level = parseInt(dataPost[counter][4]);
                                if (dataPost[index][0] == dataPost[counter][2]){
                                    // searching for the username
                                    for (index1 = 0; index1 < dataUser.length; index1++) {
                                        if (dataUser[index1][0] == dataPost[counter][1]) {
                                            username = dataUser[index1][1];
                                            userid = dataUser[index1][0];
                                            break;
                                        }
                                    }

                                    for(counter2 = 0; counter2 < dataPic.length; counter2++) {
                                        if (dataPic[counter2] && dataPic[counter2][1] == userid) {
                                            repPic = dataPic[counter2];
                                            repPicFound = true;
                                            break;
                                        }
                                        repPicFound = false;
                                    }

                                    if(repPicFound){
                                        picSubstitute = "../../SVGs/user-alt-solid.svg";
                                        const regex = new RegExp(`${picSubstitute}`);
                                        section_2[collector].innerHTML += section_2_imposter.innerHTML
                                            .replace(/Reptext/g, dataPost[counter][8] + (dataPost[counter][12] == null ? "" : dataPost[counter][12])
                                                + (dataPost[counter][13] == null ? "" : dataPost[counter][13])
                                                + (dataPost[counter][14] == null ? "" : dataPost[counter][14]))
                                            .replace(/username/g, username)
                                            .replace(/Replike/g, dataPost[counter][6])
                                            .replace(/Repunlike/g, dataPost[counter][7]);  
                                            section_2_1[collector1].innerHTML = section_2_1[collector1].innerHTML
                                            .replace(regex, repPic[4] + repPic[3] + "." + repPic[2]);
                                        section_2_1[collector1].setAttribute('data-replyid', dataPost[counter][0]);
                                        section_2_1[collector1].style.minHeight = '201px';
                                       
                                        // section_1[collector].setAttribute('data-paid', dataPost[index][0]);
                                        collector1++;
                                    }else{
                                        section_2[collector].innerHTML += section_2_imposter.innerHTML
                                            .replace(/Reptext/g, dataPost[counter][8] + (dataPost[counter][12] == null ? "" : dataPost[counter][12])
                                                + (dataPost[counter][13] == null ? "" : dataPost[counter][13])
                                                + (dataPost[counter][14] == null ? "" : dataPost[counter][14]))
                                            .replace(/username/g, username)
                                            .replace(/Replike/g, dataPost[counter][6])
                                            .replace(/Repunlike/g, dataPost[counter][7]);
                                        section_2_1[collector1].setAttribute('data-replyid', dataPost[counter][0]);
                                        section_2_1[collector1].style.minHeight = '201px';
                                       
                                        collector1++;
                                    }
                                       

                                }
                            }
                            collector++; 
                            // count++;
                        // }
                       
                    }
                    
            }// end of the for loop for assigning functions.

            // injecting and setting sizes for the
            SVGs();
            // opening up the reply buttons.
            replyGiver();
            // adding the reply to the database.
            replyButtons();
            //making the like buttons work
            answerLikeUnlike();
            replyLikeUnlike();
            }
        }
        
    });   
});
  var RepEqualize = [];
  var AnsEqualize = [];
// this function here is used to give the answers their likes and unlikes
function answerLikeUnlike() {
    
    var ansLike = document.getElementsByClassName('ans-upvote');
    var ansUnlike = document.getElementsByClassName('ans-downvote');
    var ansLikePlace = document.getElementsByClassName('ans-like-place');
    var ansUnlikePlace = document.getElementsByClassName('ans-unlike-place');
    // we create a 2 dimensional array, to check the other side of the like
    // or unlike button is also checked.
        // reply_adder[index] = value.setAttribute('data-parent', holder);
    // var reply_adder = document.getElementsByClassName('reply-adder-button');


    for (var index = 0; index < ansLike.length; index++) {
        AnsEqualize[index] = [2];
        AnsEqualize[index][0] = false;
        AnsEqualize[index][1] = false;
    }

    Array.prototype.forEach.call(ansLike,
        function (value, index) {
            ansLike[index] = value.addEventListener('click', function () {
                var hold;
                if (!AnsEqualize[index][0]) {
                    ansLikePlace[index].innerHTML = (parseInt(ansLikePlace[index].innerHTML) + 1);
                    ansLike[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221), rgba(197, 197, 197))';
                    AnsEqualize[index][0] = true;
                    hold = section_1[index].getAttribute("data-paid");
                    console.log(section_1[index].getAttribute("data-paid"));
                    $.ajax({
                        type: "GET",
                        async: true,
                        url: "../../phpFiles/newsfeedPHP/AnsReLikeUnlike/AnsLike.php?sign=1&poid="+hold,
                        success: function (result) {
                            console.log("colored Answer like," + result);
                        }
                    });
                    if (AnsEqualize[index][1]) {
                        ansUnlikePlace[index].innerHTML = (parseInt(ansUnlikePlace[index].innerHTML) - 1);
                        ansUnlike[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221, 0), rgba(197, 197, 197,0))';
                        AnsEqualize[index][1] = false;
                    }
                } else {
                    ansLikePlace[index].innerHTML = (parseInt(ansLikePlace[index].innerHTML) - 1);
                    ansLike[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221, 0),rgba(197, 197, 197, 0))';
                    AnsEqualize[index][0] = false;
                    hold = section_1[index].getAttribute("data-paid");
                    $.ajax({
                        type: "GET",
                        async: true,
                        url: "../../phpFiles/newsfeedPHP/AnsReLikeUnlike/AnsLike.php?sign=0&poid=" +hold,
                        success: function (result) {
                            console.log("transparent Answer like," + result);
                        }
                    });
                }
            });
        });

    Array.prototype.forEach.call(ansUnlike,
        function (value, index) {
            ansUnlike[index] = value.addEventListener('click', function () {
                if (!AnsEqualize[index][1]) {
                    ansUnlikePlace[index].innerHTML = (parseInt(ansUnlikePlace[index].innerHTML) + 1);
                    ansUnlike[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221), rgba(197, 197, 197))';
                    AnsEqualize[index][1] = true;
                    hold = section_1[index].getAttribute("data-paid");
                    $.ajax({
                        type: "GET",
                        async: true,
                        url: "../../phpFiles/newsfeedPHP/AnsReLikeUnlike/AnsUnlike.php?sign=1&poid=" +
                           hold, // we should get the postid of the answer
                        success: function (result) {
                            console.log("colored Answer like," + result);
                        }
                    });
                    if (AnsEqualize[index][0]) {
                        ansLikePlace[index].innerHTML = (parseInt(ansLikePlace[index].innerHTML) - 1);
                        ansLike[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221, 0), rgba(197, 197, 197, 0))';
                        AnsEqualize[index][0] = false;
                    }
                } else {
                    ansUnlikePlace[index].innerHTML = (parseInt(ansUnlikePlace[index].innerHTML) - 1);
                    ansUnlike[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221, 0), rgba(197, 197, 197, 0))';
                    AnsEqualize[index][1] = false;
                    hold = section_1[index].getAttribute("data-paid");
                    $.ajax({
                        type: "GET",
                        async: true,
                        url: "../../phpFiles/newsfeedPHP/AnsReLikeUnlike/AnsUnlike.php?sign=0&poid=" + hold, 
                        success: function (result) {
                            console.log("transparent Answer like," + result);
                        }
                    });
                }
            });
        });
}






// under construction
// this function here is used to give the replies their likes and unlikes
function replyLikeUnlike() {

    // var section_2 = document.getElementsByClassName('replies');
    var repLike = document.getElementsByClassName('rep-upvote');
    var repUnlike = document.getElementsByClassName('rep-downvote');
    var repLikePlace = document.getElementsByClassName('rep-like-place');
    var repUnlikePlace = document.getElementsByClassName('rep-unlike-place');
     // reply_adder[index] = value.setAttribute('data-parent', holder);
    // var reply_adder = document.getElementsByClassName('reply-adder-button');
  

    for (var index = 0; index < repLike.length; index++) {
        RepEqualize[index] = [2];
        RepEqualize[index][0] = false;
        RepEqualize[index][1] = false;
    }

    Array.prototype.forEach.call(repLike,
        function (value, index) {
            repLike[index] = value.addEventListener('click', function () {
                var hold;
                if (!RepEqualize[index][0]) {
                    repLikePlace[index].innerHTML = (parseInt(repLikePlace[index].innerHTML) + 1);
                    repLike[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221), rgba(197, 197, 197))';
                    RepEqualize[index][0] = true;
                    hold = section_2_1[index].getAttribute('data-replyid');
                    $.ajax({
                        type: "GET",
                        async: true,
                        url: "../../phpFiles/newsfeedPHP/AnsReLikeUnlike/RepLike.php?sign=1&poid="
                            + hold, // we should get the postid of the answer
                        success: function (result) {
                            console.log("colored Answer like," + result);
                        }
                    });
                    if (RepEqualize[index][1]) {
                        repUnlikePlace[index].innerHTML = (parseInt(repUnlikePlace[index].innerHTML) - 1);
                        repUnlike[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221, 0), rgba(197, 197, 197, 0))';
                        RepEqualize[index][1] = false;
                    }
                } else {
                    repLikePlace[index].innerHTML = (parseInt(repLikePlace[index].innerHTML) - 1);
                    repLike[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221, 0), rgba(197, 197, 197, 0))';
                    RepEqualize[index][0] = false;
                    hold = section_2_1[index].getAttribute('data-replyid');
                    $.ajax({
                        type: "GET",
                        async: true,
                        url: "../../phpFiles/newsfeedPHP/AnsReLikeUnlike/RepLike.php?sign=0&poid="
                            + hold, // we should get the postid of the answer
                        success: function (result) {
                            console.log("transparent Answer like," + result);
                        }
                    });
                }
            });
        });

    Array.prototype.forEach.call(repUnlike,
        function (value, index) {
            repUnlike[index] = value.addEventListener('click', function () {
                if (!RepEqualize[index][1]) {
                    repUnlikePlace[index].innerHTML = (parseInt(repUnlikePlace[index].innerHTML) + 1);
                    repUnlike[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221), rgba(197, 197, 197))';
                    RepEqualize[index][1] = true;
                    console.log(section_2_1[index].getAttribute('data-replyid'));
                    hold = section_2_1[index].getAttribute('data-replyid');
                    $.ajax({
                        type: "GET",
                        async: true,
                        url: "../../phpFiles/newsfeedPHP/AnsReLikeUnlike/RepUnlike.php?sign=1&poid="
                            + hold, // we should get the postid of the answer
                        success: function (result) {
                            console.log("colored Answer like," + result);
                        }
                    });
                    if (RepEqualize[index][0]) {
                        repLikePlace[index].innerHTML = (parseInt(repLikePlace[index].innerHTML) - 1);
                        repLike[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221, 0), rgba(197, 197, 197, 0))';
                        RepEqualize[index][0] = false;
                    }
                } else {
                    repUnlikePlace[index].innerHTML = (parseInt(repUnlikePlace[index].innerHTML) - 1);
                    repUnlike[index].style.backgroundImage = 'linear-gradient(200deg, rgba(221, 221, 221, 0), rgba(197, 197, 197, 0))';
                    RepEqualize[index][1] = false;
                    hold = section_2_1[index].getAttribute('data-replyid');
                    $.ajax({
                        type: "GET",
                        async: true,
                        url: "../../phpFiles/newsfeedPHP/AnsReLikeUnlike/RepUnlike.php?sign=0&poid="
                            + hold, // we should get the postid of the answer
                        success: function (result) {
                            console.log("transparent Answer like," + result);
                        }
                    });
                }
            });
        });   
}



function empty(data) {
    if (typeof (data) == 'number' || typeof (data) == 'boolean') {
        return false;
    }
    if (typeof (data) == 'undefined' || data === null) {
        return true;
    }
    if (typeof (data.length) != 'undefined') {
        return data.length == 0;
    }
    var count = 0;
    for (var i in data) {
        if (data.hasOwnProperty(i)) {
            count++;
        }
    }
    return (count == 0);
}








// for(var index = 0; index < 10; index++){
//     other_answers.innerHTML += other_answers_imposter.innerHTML;
// }







// this is the test area///////////////////////////////////////////////////////////////////


// equalize.forEach(fun);
// function fun(value){
//      value = false;
// }



// var repl = {
//     hold: null,
//     repl1: { equalize: false}
// }


// var ans = [answerRep.length];
// for (var index = 0; index < answerRep.length; index++) {
//         ans[index] = new Object(); 
//         ans[index] = {
//         hold: answerRep[index],
//         repl1: { equalize: false, ind: index }
//     }
// }


// var ans = [34,32,23,32,32,34];
// console.log(ans[0]);

// Array.prototype.forEach.call(ans, function (value){
//     value = value + 4;
// });

// console.log(ans[4]);
//// this is the end of the test area///////////////////////////////////////////////////////////////////////









