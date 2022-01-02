// import jquery from 'JSLib\\JQuery.min.js';


// var next = document.getElementById('next');
// var UserData = document.getElementsByClassName('sign_All_User_Data')[0];
// next.addEventListener('click', function () {
//     var signFormWidth = '800px', topicWidth = '300px';
//     UserData.style.left = "-500px";
// });




// var roundUp = Math.ceil(Topics.length / remain);
// var modulus = (Topics.length % remain);
// console.log(roundUp + " " + modulus);
// var Login = document.querySelectorAll('.item1');
// console.log(Login.innerHTML);

var Topics;
$.ajaxSetup({
    async: false,
});

$.getJSON('../../JSON/Topics.json', (response)=>{
    Topics = response.Topics;
});



// var nextFlag = false;
const remain = 8; 
var Created = false, roundUp, modulus;
// this will hold the topic for the form.
var TopicString = document.createElement('div');
TopicString.setAttribute('id','TopicString');

roundUp = Math.ceil(Topics.length / remain);
modulus = (Topics.length % remain);

// this one is for making the value inside the addEventListener available for
// other functions.
var TopicHolder = [roundUp], TopicLeft = [roundUp];

// we have to make the first one manually because we are neglecting the first value because of being 0
// while creating the topic holder.
TopicLeft[0] = 0;

// we also make a one value holder for TextAndTopic, to be held in PrevGoBack


var signup = document.getElementsByClassName('Registration_Holder_SignUp')[0];

var castle = document.getElementsByClassName('sign_Castle_Tag_Holder')[0];
var TextAndTopicHolder;
var UserData = document.getElementsByClassName('sign_All_User_Data')[0];


var email = document.getElementById('signemail'); // 1
window.onload = () => {if(email.value != ''){
    email.value = '';
}}
var username = document.getElementById('signusername'); // 2
var role = document.getElementById('signrole'); // 3
var password = document.getElementById('signpassword'); // 4
var conPassword = document.getElementById('signconfirmpassword'); // 5
var date = document.getElementById('signdate'); // 6
var month = document.getElementById('signmonth'); // 7
var year = document.getElementById('signyear'); // 8
var address = document.getElementById('signaddress'); // 9
var tel = document.getElementById('signtelephoneno'); // 10
var male = document.getElementById('signmale'); // 11 
var female = document.getElementById('signfemale'); // 12
var checkbox = document.getElementById('signcheckbox'); //13
// this one holds data of the ajax database call.
var data;

function checkValues(nameValue){
    if (nameValue.match(/['.%+-]/g)){
        return true;
    }else{
        return false;
    }   
}


// this functin is for checking if the username field is emtpy or not.
function usernameEmpty(){
    if(empty(username.value)){
        alert('The Username field must not be empty!');
        return false;
    }
     else if (checkValues(username.value)){
        alert("Your name must not contain ( ' . _ % + -)");
        return false;
    }
    else{
        return true;
    }
}

// looking to check if we have a password
function passwordPass(){
    if(empty(password.value)){
        alert('The Password Field Must Not Be Empty!');
        return false;
    }else if(password.value.length < 8){
        alert('You Must Not Enter Less Than 8 Characters!');
    }
    else{
        return true;
    }
}



// see if both password match, for password confirmation.
function passwordConfirmPass() {
    if(empty(conPassword.value)){
        alert('Please Confirm Your Password!');
        return false;
    }else if(conPassword.value != password.value){
        alert("The Password Fields Don't Match!");
        return false;
    }else{
        return true;
    }
}


// to check if the user chose his/her gender.
function radioButtonsCheck(){
    if((male.checked) || (female.checked)){
        return true;
    }else{
        alert("Please Choose Your Gender!");
        return false;
    }
}

var Year = [
    { month: 'January', Days: 31 },
    { month: 'February', Days: (28 || 29) },
    { month: 'March', Days: 31 },
    { month: 'April', Days: 30 },
    { month: 'May', Days: 31 },
    { month: 'June', Days: 30 },
    { month: 'July', Days: 31 },
    { month: 'August', Days: 31 },
    { month: 'September', Days: 30 },
    { month: 'October', Days: 31 },
    { month: 'November', Days: 30 },
    { month: 'December', Days: 31 }
];

// age confirmation, for date, month, year.
function ageConfirmation(){
    var da = new Date();
    var monthHold = $('#signmonth option:selected').text();
    var yearHold = $('#signyear option:selected').text();
    var day = $('#signdate').val();
        if ((monthHold != 'Month') && (yearHold != 'Year') && (!empty(day))){
            // console.log(yearHold + " " + monthHold + " " + day);
            for (var index = 0; index < Year.length; index++) {
                // console.log(Year[index].month);
                if (monthHold == Year[index].month){
                    if(day > Year[index].Days){
                        alert(Year[index].month + " Has " + Year[index].Days +" Days, The Date Input Is Wrong!");
                        return false;
                    } else if ((da.getFullYear() - parseInt(yearHold)) < 13) {
                        alert("Age must be Above 13");
                        return false;
                    }else if(!(/^[0-9]*$/g).test(day)){
                        alert("Please Only Input Numbers!");
                        return false;
                    }else{
                        return true;
                    }
                }else{
                    continue;
                }
            }
        }else if(empty(day) || monthHold == 'Month' || yearHold == 'Year'){
            alert("Please Enter Your Age Details!");
            return false;
        } else{
            return true;
        }
}

// an always active function for telephone No
$(function (){
    $('#signtelephoneno').on('keydown', function(){
        $(this).val($(this).val().replace(/[^0-9]$/g, ''));
    })

});

function telephoneConfirmation(){
    if (!(/^[0-9]*$/).test(tel.value)){
        alert('The Phone Number Must Not Contain A Letter!');
        return false;
    } else if (!empty(tel.value)){
        if (!(/^[0-9]{1,16}$/).test(tel.value)){
            alert('The Phone Number Must Be A Maximum Of 16 Characters!');
            return false;
        }else{
            return true;
        }
    }else{
        return true;
    }
}

function checkBoxCheck(){
    if(!(checkbox.checked)){
        alert("Please Accept Our Privacy Policy To Proceed!");
        return false;
    }else{
        return true;
    }
}


// function resolveAfter2Seconds() {
//     return new Promise(resolve => {
//         setTimeout(() => {
//             resolve('resolved');
//         }, 2000);
//     });
// }


// async function asyncCallEmail() {
//     var promise;
//     console.log(data);
//     return promise = await resolveAfter2Seconds();
// }

// to check integrity of the email, meaning to see if the email, matches an email formation. 
function emailPass() {
    if (empty(email.value)) {
        alert("The Email Field Must Not Be Empty");
        return false;
    } else if (!(/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/).test(email.value)) {
        alert("The Email Field Value Doesn't Match An Email Address!");
        return false;
    }else{
        return true;
    }
}

// an active function to monitor the formation of the email address, and see if the 
// email address exist in the database.
$(function () {
    $('#signemail').on('keyup', function () {
        if ((/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/).test(this.value)) {
            console.log('here');
            $.ajax({
                type: "GET",
                url: "./signupEmail.php?email=" + this.value,
                async: true,
                success: function (result) {
                    result = parseInt(result);
                    data = result;
                    if (data == 1) {
                        alert("Someone Already Registered With This Email Address!");
                    }
                }
            });
        }
    });
});

// this email check, is the same as the one in the active function
//  
function emailCheck() {
    console.log(data);
    if (data) {
        alert('Someone Already Registered With This Email Address!');
        return false;
    } else {
        return true;
    }
}

next.addEventListener('click', function () {

    // passwordPass()
    // passwordConfirmPass()
    // emailPass()
    // radioButtonsCheck()
    // ageConfirmation()
    // telephoneConfirmation()
    // asyncCallEmail();

        if(usernameEmpty()){
            if (passwordPass()){
                if (passwordConfirmPass()){
                    if (emailPass()){
                        if(emailCheck()){
                            if (radioButtonsCheck()){
                                if (ageConfirmation()){
                                    if (telephoneConfirmation()){
                                        if (checkBoxCheck()){
                                                if(!Created){    
                                                    // this is used to get the number of the topics available correctly. 

                                                    var loop1, count = 0;
                                                    var topic = [roundUp], parts = [Topics.length];
                                                    var TextAndTopic, TextHolder, TextHint, NextPrevAndDone, 
                                                    Next,TextNext, Prev, TextPrev, Done, TextDone, hiddenInput;
                                                    // begginning part of TextAndTopic Holder
                                                    // 1 - text and topic must hold as it's name refers, the topic must be movable,
                                                    // according to how many topics are inside.
                                                    TextAndTopic = document.createElement('div');
                                                    TextAndTopic.setAttribute('class', 'TextAndTopic');
                                                    // 2 - we create the text holder and node for the text.
                                                    TextHolder = document.createElement('div');
                                                    TextHolder.setAttribute('class', 'TextHolder');
                                                    TextHint = document.createElement('p');
                                                    TextHint.setAttribute('class', 'text');
                                                    TextHint.innerHTML = 'Please enter the Topics you Prefer: ';
                                                    // 3 - append the textHint to the textHolder, and the TextHolder to the TextAndTopic
                                                    TextHolder.appendChild(TextHint);
                                                    TextAndTopic.appendChild(TextHolder);
                                                    // creating the hidden input, to add the topic values
                                                    $('#signup').append("<input type='hidden' name='topics' id='hidden'>");
                                                    hiddenInput = document.getElementById('hidden');
                                                    hiddenInput.style.display = 'none';
                                                    // middle part of TextAndTopic Holder
                                                    // 
                                                        for(loop1 = 0; loop1 < roundUp; loop1++){
                                                                        
                                                            topic[loop1]= document.createElement('div');
                                                            topic[loop1].setAttribute('class', 'sign_Topics');
                                                            TopicHolder[loop1] = topic[loop1];
                                                                if(loop1 == (roundUp - 1) && (modulus > 0)){
                                                                    var loop2;
                                                                    for (loop2 = 0; loop2 < modulus && count < Topics.length;loop2++, count++){
                                                                        topic[loop1].style.left = (100 * loop1 ) + "%";
                                                                        topic[loop1].style.display = 'none';
                                                                        TopicLeft[loop1] = (100 * loop1);
                                                                        parts[count] = document.createElement('div');
                                                                        parts[count].innerHTML = Topics[count].topic;
                                                                        parts[count].setAttribute('class', 'Topic_Items');
                                                                        parts[count].addEventListener('click', function () {

                                                                            this.classList.toggle('Black');
                                                                            // console.log(this.innerHTML);
                                                                            if (this.classList.contains('Black')) {
                                                                                if (empty(TopicString.innerHTML)) {
                                                                                    TopicString.innerHTML = this.innerHTML;
                                                                                } else {
                                                                                    TopicString.innerHTML += "," + this.innerHTML;
                                                                                }
                                                                            }
                                                                            else {
                                                                                // if indexOf was found it will send back a number bigger than 0,
                                                                                // if not found it will return a -1.
                                                                                if ((TopicString.innerHTML.indexOf(',' + this.innerHTML)) > 0) {
                                                                                    // instead of trying to take part of the string out, because after using some solutions,
                                                                                    // it ended up in failure, so we used one .
                                                                                    var topicHold, index, startPos = TopicString.innerHTML.indexOf(this.innerHTML);
                                                                                    console.log('startPos = ' + startPos);
                                                                                    index = startPos + (this.innerHTML.length);
                                                                                    topicHold = TopicString.innerHTML;
                                                                                    TopicString.innerHTML = TopicString.innerHTML.substring(0, startPos - 1);
                                                                                    TopicString.innerHTML += topicHold.slice(index);
                                                                                    console.log(TopicString.innerHTML);
                                                                                }
                                                                                else {
                                                                                    if ((TopicString.innerHTML.indexOf(this.innerHTML)) > 0) {
                                                                                        var topicHold, index, startPos = TopicString.innerHTML.indexOf(this.innerHTML);
                                                                                        console.log('startPos = ' + startPos);
                                                                                        index = startPos + (this.innerHTML.length - 1);
                                                                                        topicHold = TopicString.innerHTML;
                                                                                        TopicString.innerHTML = TopicString.innerHTML.substring(0, startPos);
                                                                                        TopicString.innerHTML += topicHold.slice(index);
                                                                                        console.log(TopicString.innerHTML);
                                                                                    }
                                                                                }

                                                                            }
                                                                        });
                                                                        topic[loop1].appendChild(parts[count]);
                                                                        TextAndTopic.appendChild(topic[loop1]);
                                                                    }
                                                                }else{
                                                                    var loop3;
                                                                    for (loop3 = 0; loop3 < remain && count < Topics.length; loop3++, count++) {
                                                                        if(loop1 != 0){
                                                                            topic[loop1].style.left = (100 * loop1 ) + "%";
                                                                            topic[loop1].style.display = 'none';
                                                                            TopicLeft[loop1] = (100 * loop1);
                                                                        }
                                                                        parts[count] = document.createElement('div');
                                                                        parts[count].setAttribute('class', 'Topic_Items');
                                                                        parts[count].innerHTML = Topics[count].topic;
                                                                        parts[count].setAttribute('id', count);
                                                                        // here we add the addEventListener
                                                                        parts[count].addEventListener( 'click', function (){
                                                                                        
                                                                        this.classList.toggle('Black');
                                                                            // console.log(this.innerHTML);
                                                                            if(this.classList.contains('Black')){
                                                                                if (empty(TopicString.innerHTML)) {
                                                                                    TopicString.innerHTML = this.innerHTML;
                                                                                } else {
                                                                                    TopicString.innerHTML += "," + this.innerHTML;
                                                                                }
                                                                            }
                                                                            else{
                                                                                // if indexOf was found it will send back a number bigger than 0,
                                                                                // if not found it will return a -1.
                                                                                if ((TopicString.innerHTML.indexOf(',' + this.innerHTML)) > 0){
                                                                                    var topicHold, index, startPos = TopicString.innerHTML.indexOf(this.innerHTML);
                                                                                    console.log('startPos = ' + startPos);
                                                                                    index = startPos + (this.innerHTML.length);
                                                                                    topicHold = TopicString.innerHTML;
                                                                                    TopicString.innerHTML = TopicString.innerHTML.substring(0,startPos - 1);
                                                                                    TopicString.innerHTML += topicHold.slice(index);
                                                                                    console.log(TopicString.innerHTML);
                                                                                }
                                                                                else{
                                                                                    if (TopicString.innerHTML.indexOf(this.innerHTML) >= 0){
                                                                                        var topicHold, index, startPos = TopicString.innerHTML.indexOf(this.innerHTML);
                                                                                        console.log('startPos = ' + startPos);
                                                                                        index = startPos + (this.innerHTML.length);
                                                                                        topicHold = TopicString.innerHTML;
                                                                                        TopicString.innerHTML = TopicString.innerHTML.substring(0, startPos);
                                                                                        TopicString.innerHTML += topicHold.slice(index);
                                                                                        console.log(TopicString.innerHTML);
                                                                                    }
                                                                                }
                                                                                                
                                                                            }
                                                                                            
                                                                                            
                                                                        });
                                                                        topic[loop1].appendChild(parts[count]);
                                                                        TextAndTopic.appendChild(topic[loop1]);
                                                                    }
                                                                }
                                                            }


                                                    // bottom part of textAndtopic holder
                                                    NextPrevAndDone = document.createElement('div');
                                                    NextPrevAndDone.setAttribute('class', 'NextPrevAndDone');
                                                    // next button
                                                    Next = document.createElement('div');
                                                    TextNext = document.createTextNode('Next');
                                                    Next.setAttribute('class', 'items');
                                                    Next.appendChild(TextNext);
                                                    // Previous button
                                                    Prev = document.createElement('div');
                                                    Prev.setAttribute('class', 'items');
                                                    TextPrev = document.createTextNode('Previous');
                                                    Prev.appendChild(TextPrev);
                                                    // Done button
                                                    Done = document.createElement('div');
                                                    Done.setAttribute('class', 'items');
                                                    TextDone = document.createTextNode('Done');
                                                    Done.appendChild(TextDone);

                                                    NextPrevAndDone.appendChild(Prev);
                                                    NextPrevAndDone.appendChild(Done);
                                                    NextPrevAndDone.appendChild(Next);
                                                    TextAndTopic.appendChild(NextPrevAndDone);
                                                    // this one holds textAndTopic, to be used in the PrevGoBack().
                                                    TextAndTopicHolder = TextAndTopic;
                                                    signup.appendChild(TextAndTopic);

                                                    Prev.addEventListener('click', function (){
                                                                        moveNextAndPrev(1, TextAndTopicHolder, UserData);
                                                    });
                                                    Next.addEventListener('click', function(){
                                                        moveNextAndPrev(2, TextAndTopicHolder, UserData);
                                                    });
                                                    // $('.items')
                                                    $(Done).click( function () {
                                                        var hiddenInput = document.getElementById('hidden');
                                                            hiddenInput.value = TopicString.innerHTML;
                                                                            $('#signup').submit();
                                                    });

                                                    // after finishing next button's functions, we add the animation to the move.
                                                    moveTextAndTopic(TextAndTopicHolder, UserData);
                                                    Created = true;
                                                }else{
                                                    moveTextAndTopic(TextAndTopicHolder, UserData);
                                            // }//11
                                        }// 10
                                    }// 9
                                } // 8
                            } // 7
                        } // 6
                    } // 5
                } // 4
            } // 3
        }// 2
    } // 1
});




// we put this function inside the prev and next buttons of textAndTopic  
// and this function contains separate functions for both of them.
// and one that leads back to the prevous page that is the sign_All_User_Data
function moveNextAndPrev(_Source, TextAndTopicHolder, UserData){

    if(_Source == 1){
        if(TopicLeft[0] == 0){
            console.log(TopicLeft[0]);
            PrevGoBack(TextAndTopicHolder, UserData);
        }else{
            PrevAnimation();
        }
    }else{
        if(_Source == 2){
            NextAnimation();
        }
    }
}

// this function is for the prev button
function PrevAnimation(){
    var _opacity1 = 1.0, _opacity2 = 0.0;
    var center;
    for (var index = (roundUp - 1); index  >= 0 && TopicLeft[0] != 0; index--) {

        if (TopicLeft[index] == 0) {
            center = index;
            index--;
        } else {
            TopicLeft[index] += 100;
            TopicHolder[index].style.left = TopicLeft[index] + '%';
            TopicHolder[index].style.display = 'none';
        }

    }

    if (TopicHolder[center - 1] != undefined) {
        TopicHolder[center - 1].style.display = 'grid';
        var move = setInterval(frameForNext, 10);
        function frameForNext() {

            if (TopicLeft[center - 1].toString() == (0).toString()) {
                clearInterval(move);
            } else {
                if (_opacity1 != 0.0) {
                    _opacity1 -= 0.1;
                    _opacity2 += 0.1;
                }
                // for the one that is in 0 left
                TopicLeft[center] += 10;
                TopicHolder[center].style.opacity = _opacity1;
                TopicHolder[center].style.left = TopicLeft[center] + '%';
                // for the one that is in 100 left
                TopicLeft[center - 1] += 10;
                TopicHolder[center - 1].style.opacity = _opacity2;
                TopicHolder[center - 1].style.left = TopicLeft[center - 1] + '%';
            }

        }
    }
}



// values needed:
// display
// left 
// opacity
// this function is for the Next button
function NextAnimation(){
    
    // we search to see which one is equal to zero, to make 
    // that one the center of appearance.
    var _opacity1 = 1.0, _opacity2 = 0.0;
    var center;
    for (var index = 0; index < roundUp && TopicLeft[roundUp - 1] != 0; index++){
       
            if(TopicLeft[index] == 0){
                    center = index;
                    index++;
            }else{
                        TopicLeft[index] -= 100;
                        TopicHolder[index].style.left = TopicLeft[index] + '%';
                        TopicHolder[index].style.display = 'none';
                }
        
    }
   
    if(TopicHolder[center + 1] != undefined){
        TopicHolder[center + 1].style.display = 'grid';
        var move = setInterval(frameForNext, 10);
        function frameForNext(){

            if (TopicLeft[center + 1].toString() == (0).toString()) {
                clearInterval(move);
            } else {
                if (_opacity1 != 0.0) {
                    _opacity1 -= 0.1;
                    _opacity2 += 0.1;
                }
                // for the one that is in 0 left
                TopicLeft[center] -= 10;
                TopicHolder[center].style.opacity = _opacity1;
                TopicHolder[center].style.left = TopicLeft[center] + '%';
                // for the one that is in 100 left
                TopicLeft[center + 1] -= 10;
                TopicHolder[center+ 1].style.opacity = _opacity2;
                TopicHolder[center + 1].style.left = TopicLeft[center + 1] + '%';
            }
        
        }
    }
}

// this one is for the last prvious of the TextAndtopic Holder
// to go back to the sign_All_User_Data part.
function PrevGoBack(TextAndTopicHolder, UserData){

    var posTandP = 0;
    var posSignData = 100;
    var opacityTandP = 1.0;
    var opacitySignData = 0.0;
    var mover = setInterval(frameGoBack, 10);
    signup.style.width = '800px';
    castle.style.width = '100%';
    function frameGoBack() {
        if (posSignData == 0) {
            clearInterval(mover);
        } else {
            if (opacitySignData != 1.0) {
                opacitySignData += 0.1;
                opacityTandP -= 0.1;
            }
            posTandP += 10;
            posSignData -= 10;
            TextAndTopicHolder.style.opacity = opacityTandP;
            UserData.style.opacity = opacitySignData;
            TextAndTopicHolder.style.left = posTandP + '%';
            UserData.style.left = posSignData + '%';

        }
    }

    // this part of the interval is used for making the textAndTopic part to dissapear
    // and don't take place in the screen.
    var index = 0;
    var disappear1 = setInterval(noDisplay, 10);

    function noDisplay() {
        if (index == 75) {
            TextAndTopicHolder.style.display = 'none';
            clearInterval(disappear1);
        } else {
            index++;
        }

    }
    
}

// this is for the next button of the sign_All_User_Data
function moveTextAndTopic(TextAndTopicHolder, UserData) {
    signup.style.width = "400px";
    // signup.style.height = "550px";
    castle.style.width = "400px";

    var posTandP = 100;
    var posSignData = 0;
    var opacityTandP = 0.0;
    var opacitySignData = 1.0;
    var move = setInterval(frame, 10);
    if (TextAndTopicHolder)
        TextAndTopicHolder.style.display = 'grid';

    function frame() {
        if (posTandP == 0) {
            clearInterval(move);
        } else {
            if (opacityTandP != 1.0) {
                opacitySignData -= 0.5;
                opacityTandP += 0.5;
            }
            posTandP -= 10;
            posSignData -= 10;
            TextAndTopicHolder.style.opacity = opacityTandP;
            UserData.style.opacity = opacitySignData;
            TextAndTopicHolder.style.left = posTandP + '%';
            UserData.style.left = posSignData + '%';

        }
    }

}
// empty function is used for knowing whether a variable is empty or not
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

// export const Topics;
// function PrevAndNext(Prev, next, ){

    
//     function frame(){

//     }
// }