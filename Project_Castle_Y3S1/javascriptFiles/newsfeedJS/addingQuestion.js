// import Topics from '../RegistrationJS/Topics.js';
// $(function () {
//     $('select').selectmenu().selectmenu("menuWidget").addClass('here');
// })

var Question = document.getElementsByClassName('careTextarea')[0];
var QuestionHeader = document.getElementById('topic');
var AddButton = document.getElementById('comment-part-add-button');
var topicValue = document.createElement('div');

AddButton.onclick = () => {
    // console.log(first.toString() + "  " + second);
    if(empty(Question.value)){
        alert("Please Don't Leave The Question Details Empty!");
    } else if (empty(QuestionHeader.value)){
        alert("Please Don't Leave The Question Header Empty!");
    }else if(getTopic()){
        alert("Please Choose a Topic!");
    }else{
        // console.log(topicValue.);
        addQuestionToDB();
        // window.location.assign("../../phpFiles/newsfeedPHP/newsfeed.php")
        // $('#comment-parts-holder').submit();
    }
}
// how to create the comment section 
// 1- first create the css styles in the newsfeed
// 2- then create them using javscript for addition, instantly
// 3- then the one that is added in the newsfeed, add the php values and refresh it
// according to the user topics
function getTopic(){
    var parts = document.getElementsByClassName('part1');
    var index = 0;    
    for(;index < parts.length; index++){
        if(parts[index].classList.contains('colorful')){
            topicValue.value = parts[index].innerHTML;
            return false;
        }
    }return true;
}


function addQuestionToDB(){
    var QDetails = Question.value;
    var QHeader = QuestionHeader.value;
    
    $.ajax({ 
        type: "GET",
        url: "../../phpFiles/newsfeedPHP/addingQuestion.php?qd="
            + QDetails + "&qh=" + QHeader + "&tp=" + topicValue.value  + "&sign=0",
        async: true,
        success: function(result){
            // console.log(result);
            window.location.reload();
        }
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

// export {empty};