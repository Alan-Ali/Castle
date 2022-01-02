var castleSvg = document.getElementById('castle');
var searchSvg = document.getElementById('search-img');
var userDefaultImage1 = document.getElementsByClassName('userpic');
var icon = document.getElementsByClassName("nav-img");
var userDefaultImage2 = document.getElementsByClassName('userpic1');
var dot = document.getElementsByClassName('dot');
var upper = document.getElementsByClassName('upper-img');
var logoutSvg = document.getElementById('logout-svg');
var statusIcons = document.getElementsByClassName('img-icon');
var index;
// these svg injectors were used to make the svgs editable through the javascript itself.
// and not adding the whole svg into the html, and make it such long lines of code.
// SVGInjector(castleSvg);
// SVGInjector(searchSvg);
// SVGInjector(userDefaultImage1);
// SVGInjector(logoutSvg);
// SVGInjector(icon);
// for (index = 0; index < userDefaultImage2.length; index++) {
//     SVGInjector(userDefaultImage2[index]);
// }
// for (index = 0; index < dot.length; index++) {
//     SVGInjector(dot[index]);
// }
// for (index = 0; index < upper.length; index++) {
//     SVGInjector(upper[index]);
// }
// for (index = 0; index < statusIcons.length; index++) {
//     SVGInjector(statusIcons[index]);
// }





// styling svg injected image tags
castleSvg.style.width = '55px';
castleSvg.style.height = '55px';
searchSvg.style.height = '25px';
searchSvg.style.width = '25px';
logoutSvg.style.height = '25px';
logoutSvg.style.width = '25px';

if (userDefaultImage1) {
    for (index = 0; index < userDefaultImage1.length; index++) {
        userDefaultImage1[index].style.height = '15px';
        userDefaultImage1[index].style.width = '15px';
    }

}

for (index = 0; index < statusIcons.length; index++) {
    statusIcons[index].style.height = '30px';
    statusIcons[index].style.width = '30px';
}

for (index = 0; index < icon.length; index++) {
    icon[index].style.height = '30px';
    icon[index].style.width = '30px';
}
// for (index = 0; index < userDefaultImage2.length; index++) {
//     userDefaultImage2[index].style.height = '15px';
//     userDefaultImage2[index].style.width = '15px';
// }

for (index = 0; index < dot.length; index++) {
    dot[index].style.width = '5px';
    dot[index].style.height = '5px';
}

for (index = 0; index < upper.length; index++) {
    upper[index].style.width = '30px';
    upper[index].style.height = '30px';
}

// search input variables
var searchItems = document.getElementById('search-items');
var searchInput = document.getElementById('search-input');
var count = false;

searchInput.addEventListener('focusin', () => {
    searchItems.style.width = "90%";
    searchItems.classList.toggle('search-items2');
    searchItems.classList.toggle('search-items1');
});

searchInput.addEventListener('focusout', () => {
    searchItems.style.width = '200px';
    searchItems.classList.toggle('search-items1');
    searchItems.classList.toggle('search-items2');
});


var navigation = document.getElementsByClassName('nav');
var assign = false;

navigation[0].addEventListener('click',
    function () {
        window.location.reload();
    });
navigation[1].addEventListener('click',
    function () {
        window.location.assign('../userProfile/userProfile.php');
    });

// this part is for the question adding part 

// var commentQuestion = document.getElementsByClassName('careTextarea')[0];

var details = document.getElementById('details');

// new squad
var commentHolder = document.getElementById('comment-holder');
var commentPHolder = document.getElementById('comment-parts-holder'); // this is the form   
var commentPBody = document.getElementById('comment-part-body');
var commentPartQueDetails = document.getElementById('comment-part-question-details');
var commentTopic = document.getElementById('comment-part-question-topic');
var commentButtonTopic = document.getElementById('comment-part-topic-button');
var commentPUserDetail = document.getElementById('comment-part-user-detail');
var addButtonHolder = document.getElementById('comment-part-add-button-holder');

// div height  255px on enlarging
commentPHolder.addEventListener('click', function () {
    // commentQuestion.style.minHeight = '100%';


    // commentHolder.style.minHeight = '15%';
    // commentHolder.style.maxHeight = '50%';

    commentPHolder.style.minHeight = '255px';
    commentPHolder.style.maxHeight = '700px';

    commentPartQueDetails.style.minHeight = '155px';
    commentPartQueDetails.style.maxHeight = '155px';

    details.style.minHeight = '140px';
    details.style.maxHeight = '140px';
    details.style.borderRadius = '10px';

    commentTopic.style.display = 'flex';

    commentButtonTopic.style.display = 'flex';
    // commentButtonTopic.style.minHeight = '255px';
    // commentButtonTopic.style.maxHeight = '255px';

    // new squad 
    commentPBody.style.minHeight = '255px';
    commentPBody.style.maxHeight = '700px';

    commentPUserDetail.style.minHeight = '255px';
    commentPUserDetail.style.maxHeight = '700px';

    addButtonHolder.style.minHeight = '255px';
    addButtonHolder.style.maxHeight = '700px';

    assign = true;
}, false);


window.addEventListener('dblclick', function () {
    if (assign) {
        // commentQuestion.style.height = '42.5px';
        // commentQuestion.style.borderRadius = '50px';

        // commentHolder.style.minHeight = '15%';
        // commentHolder.style.maxHeight = '15%';

        commentPHolder.style.minHeight = '75px';
        commentPHolder.style.maxHeight = '75px';

        commentPBody.style.minHeight = '75px';
        commentPBody.style.maxHeight = '75px';

        details.style.minHeight = '42.5px';
        details.style.maxHeight = '42.5px';
        details.style.borderRadius = '50px';

        commentTopic.style.display = 'none';
        commentButtonTopic.style.display = 'none';

        commentPartQueDetails.style.minHeight = '75px';
        commentPartQueDetails.style.maxHeight = '75px';

        // commentDetails.style.display = 'none';
        // commentTopic.style.height = '0';
        // commentTopic.style.borderRadius = '0';

        // new squad
        commentPUserDetail.style.minHeight = '75px';
        commentPUserDetail.style.maxHeight = '75px';

        addButtonHolder.style.minHeight = '75px';
        addButtonHolder.style.maxHeight = '75px';

        assign = false;
    }
}, false);


// end of question adding part



var holdingHeader = document.getElementById('question-utopia');
var divHolder = document.createElement('div');
divHolder.innerHTML = holdingHeader.innerHTML;

var Qright = document.getElementsByClassName('question-right')[0];
var Qleft = document.getElementsByClassName('question-left')[0];
var QrightHolder = document.createElement('div');
var QleftHolder = document.createElement('div');
QrightHolder.innerHTML = Qright.outerHTML;
QleftHolder.innerHTML = Qleft.outerHTML;

holdingHeader.style.display = 'none';
var refreshBtn = document.getElementsByClassName('refresh-button');

// var clickUser = document.getElementsByClassName("user-name");
var dataPost, dataUser, dataImage, num = 40,
    postIdHolder = [],
    postIdCount = 0;



// $.ajax({
//     url: "../../JSON/Topics.json",
//     type: "GET",
//     async: true,
//     dataType: 'json',
//     success: 
// })


// topic part

var Topics, TopLen;

$.ajaxSetup({  // setting up the default ajax for the page  
    async: false  // setting all default asyncs to false
});

$.getJSON("../../JSON/Topics.json", function (response) {
    Topics = response.Topics;
})



var commentPartAddQ = document.getElementById('comment-part-topic-button');
commentPartAddQ.innerHTML = "";
var newParts = [Topics.length];
var newParts1 = [Topics.length];
var newPartsAssign = [Topics.length];

for (index = 0; index < Topics.length; index++) {

    newPartsAssign[index] = false;
    newParts[index] = document.createElement('div');
    newParts[index].classList.add('topic-parts');
    // newParts[index].classList.add('colorless');
    newParts1[index] = document.createElement('div');
    newParts1[index].classList.add('part1');
    newParts1[index].classList.add('colorless');
    newParts1[index].innerHTML = Topics[index].topic;
    newParts[index].innerHTML = newParts1[index].outerHTML;
    commentPartAddQ.innerHTML += newParts[index].outerHTML;

}

var parts = document.getElementsByClassName('part1');
Array.prototype.forEach.call(parts,
    function (value, index) {

        parts[index] = value.addEventListener('click', function () {
            if (!newPartsAssign[index]) {
                if (parts[index].classList.contains("colorless")) {
                    parts[index].classList.remove("colorless");
                }
                var index1 = 0;
                for (; index1 < Topics.length; index1++) {
                    console.log(index1);
                    if (parts[index1].classList.contains("colorful")) {
                        parts[index1].classList.remove("colorful");
                        parts[index1].classList.add("colorless");
                    }
                }
                parts[index].classList.add("colorful");

                newPartsAssign[index] = true;
            } else {
                if (parts[index].classList.contains("colorful")) {
                    parts[index].classList.remove("colorful");
                }
                parts[index].classList.add("colorless");
                newPartsAssign[index] = false;
            }
        })

    });

var preferIndexCounter = null;
var preferUnlikeAssign = null;
var preferLikeAssign = null;

function likeUnlike() {
    var preferLike = document.getElementsByClassName('prefer-like');
    var preferUnlike = document.getElementsByClassName('prefer-unlike');
    if (preferUnlikeAssign === null) {
        preferUnlikeAssign = [];
        preferLikeAssign = [];
    }

    var data = [];
    data[0] = null;
    var index = 0,
        temp = null,
        prefid1, counter;


    if (preferIndexCounter === null) {
        preferIndexCounter = preferLike.length;

        for (index = 0; index < preferLike.length; index++) {
            prefid1 = preferLike[index].getAttribute('data-like');
            console.log(prefid1);
            data[index] = prefid1;
        }
    } else {
        temp = preferIndexCounter;
        preferIndexCounter = preferLike.length;
        counter = temp;

        for (index = 0; counter < preferLike.length; counter++, index++) {
            prefid1 = preferLike[counter].getAttribute('data-like');
            console.log(prefid1);
            data[index] = prefid1;
        }
    }

    if (data[0] != null) {
        $.ajax({
            type: "POST",
            async: false,
            data: {
                "info": data
            },
            url: "./AnsReLikeUnlike/retrieveStatus.php",
            success: function (result) {
                console.log(result);
                let data = JSON.parse(result);
                let index;
                // console.log(data);
                if (temp === null) {
                    for (index = 0; index < data.length; index++) {
                        preferLikeAssign[index] = parseInt(data[index]['like']);
                        preferUnlikeAssign[index] = parseInt(data[index]['unlike']);
                        console.log(index);
                    }

                    for (index = 0; index < preferLike.length; index++) {
                        if (preferLikeAssign[index] &&
                            preferLike[index].classList.contains("prefer-like-colorless")) {
                            preferLike[index].classList.remove("prefer-like-colorless");
                            preferLike[index].classList.add("prefer-like-colorful");
                            // preferUnlikeAssign[index] = false;

                        } else {
                            if (preferUnlikeAssign[index] && preferUnlike[index].classList.contains("prefer-unlike-colorless")) {
                                preferUnlike[index].classList.remove("prefer-unlike-colorless");
                                preferUnlike[index].classList.add("prefer-unlike-colorful");
                                // preferLikeAssign[index] = true;
                            }

                        }

                    }
                } else {
                    let counter = temp;
                    for (index = 0; index < data.length; counter++, index++) {
                        preferLikeAssign[counter] = parseInt(data[index]['like']);
                        preferUnlikeAssign[counter] = parseInt(data[index]['unlike']);
                        console.log(counter);
                    }
                    counter = temp;
                    for (; counter < preferLike.length; counter++) {
                        if (preferLikeAssign[counter] &&
                            preferLike[counter].classList.contains("prefer-like-colorless")) {
                            preferLike[counter].classList.remove("prefer-like-colorless");
                            preferLike[counter].classList.add("prefer-like-colorful");
                            // preferUnlikeAssign[index] = false;

                        } else {
                            if (preferUnlikeAssign[counter] && preferUnlike[counter].classList.contains("prefer-unlike-colorless")) {
                                preferUnlike[counter].classList.remove("prefer-unlike-colorless");
                                preferUnlike[counter].classList.add("prefer-unlike-colorful");
                                // preferLikeAssign[index] = true;
                            }

                        }
                    }
                }
            }
        });
        like(preferLike, preferUnlike, preferLikeAssign, preferUnlikeAssign, temp);
        unlike(preferUnlike, preferLike, preferUnlikeAssign, preferLikeAssign, temp);
    }

}

function like(preferLike, preferUnlike, preferLikeAssign, preferUnlikeAssign, temp) {
    let statusLike = document.getElementsByClassName('status-change-like');
    let statusUnlike = document.getElementsByClassName('status-change-unlike');
    let poid;
    Array.prototype.forEach.call(preferLike,
        function (value, index) {

            preferLike[index] = value.addEventListener('click', function () {

                if (!preferLikeAssign[index]) {
                    if (preferLike[index].classList.contains("prefer-like-colorless")) {
                        preferLike[index].classList.remove("prefer-like-colorless");
                        preferLike[index].classList.add("prefer-like-colorful");
                        preferLikeAssign[index] = true;
                        poid = preferLike[index].getAttribute('data-like');
                        $.ajax({
                            type: "GET",
                            async: false,
                            url: "./AnsReLikeUnlike/AnsLike.php?sign=1&poid=" + poid,
                            success: function (result) {

                            }
                        });
                        statusLike[index].innerHTML = parseInt(statusLike[index].innerHTML) + 1;

                    }

                    if (preferUnlikeAssign[index] && preferUnlike[index].classList.contains("prefer-unlike-colorful")) {
                        preferUnlike[index].classList.remove("prefer-unlike-colorful");
                        preferUnlike[index].classList.add("prefer-unlike-colorless");
                        preferUnlikeAssign[index] = false;
                        statusUnlike[index].innerHTML = parseInt(statusUnlike[index].innerHTML) - 1;
                    }

                } else {
                    if (preferLike[index].classList.contains("prefer-like-colorful")) {
                        preferLike[index].classList.remove("prefer-like-colorful");
                        preferLike[index].classList.add("prefer-like-colorless");
                        preferLikeAssign[index] = false;
                        poid = preferLike[index].getAttribute('data-like');
                        $.ajax({
                            type: "GET",
                            async: true,
                            url: "./AnsReLikeUnlike/AnsLike.php?sign=0&poid=" + poid,
                            success: function (result) {
                                console.log(result);
                            }
                        });
                        statusLike[index].innerHTML = parseInt(statusLike[index].innerHTML) - 1;
                    }


                }
            });
        });
}

function unlike(preferUnlike, preferLike, preferUnlikeAssign, preferLikeAssign, temp) {
    let statusLike = document.getElementsByClassName('status-change-like');
    let statusUnlike = document.getElementsByClassName('status-change-unlike');
    let poid;
    Array.prototype.forEach.call(preferUnlike,
        function (value, index) {
            preferUnlike[index] = value.addEventListener('click', function () {

                if (!preferUnlikeAssign[index]) {
                    if (preferUnlike[index].classList.contains("prefer-unlike-colorless")) {
                        preferUnlike[index].classList.remove("prefer-unlike-colorless");
                        preferUnlike[index].classList.add("prefer-unlike-colorful");
                        preferUnlikeAssign[index] = true;
                        poid = preferLike[index].getAttribute('data-like');
                        $.ajax({
                            type: "GET",
                            async: false,
                            url: "./AnsReLikeUnlike/AnsUnlike.php?sign=1&poid=" + poid,
                            success: function (result) {

                            }
                        });
                        statusUnlike[index].innerHTML = parseInt(statusUnlike[index].innerHTML) + 1;
                    }

                    if (preferLikeAssign[index] && preferLike[index].classList.contains("prefer-like-colorful")) {
                        preferLike[index].classList.remove("prefer-like-colorful");
                        preferLike[index].classList.add("prefer-like-colorless");
                        preferLikeAssign[index] = false;
                        statusLike[index].innerHTML = parseInt(statusLike[index].innerHTML) - 1;
                    }

                } else {
                    if (preferUnlike[index].classList.contains("prefer-unlike-colorful")) {
                        preferUnlike[index].classList.remove("prefer-unlike-colorful");
                        preferUnlike[index].classList.add("prefer-unlike-colorless");
                        preferUnlikeAssign[index] = false;
                        poid = preferLike[index].getAttribute('data-like');
                        $.ajax({
                            type: "GET",
                            async: false,
                            url: "./AnsReLikeUnlike/AnsUnlike.php?sign=0&poid=" + poid,
                            success: function (result) {

                            }
                        });
                        statusUnlike[index].innerHTML = parseInt(statusUnlike[index].innerHTML) - 1;
                    }

                }
            });
        });

}

function time(date) {
    let day = 86400 * 1000;
    let week = (day * 7);
    let month = (day * 30);
    let year = (month * 12);
    let temp = me = Math.round(Date.now());
    let period = Math.round(temp - (date * 1000));
    let time = new Date(date * 1000)
    // console.log(new Date(date * 1000));
    if (period < day) {
        return (date = (time.getHours() < 10 ? "0" + time.getHours() : (time.getHours() > 12 ? (time.getHours() - 12) : time.getHours())) +
            ":" + (time.getMinutes() < 10 ? "0" + time.getMinutes() : time.getMinutes()) + ":" +
            (time.getSeconds() < 10 ? "0" + time.getSeconds() : time.getSeconds()) + (time.getHours() > 12 ? " PM" : " AM"));
    } else if (period >= day && period < (day * 2)) {
        return (date = (Math.floor(period / day)) + " day ago");
    } else if (period < week && period >= (day * 2)) {
        return (date = (Math.floor(period / day)) + " days ago");
    } else if (period >= week && period < week * 2) {
        return (date = (Math.floor(period / week)) + " week ago");
    } else if (period >= (week * 2) && period < month) {
        return (date = (Math.floor(period / week)) + " weeks ago");
    } else if (period >= month && period < month * 2) {
        return (date = (Math.floor(period / month)) + " month ago");
    } else if (period >= (month * 2) && period < year) {
        return (date = (Math.floor(period / month)) + " months ago");
    } else if (period >= year && period < year * 2) {
        return (date = (Math.floor(period / month)) + " year ago");
    } else if (period >= (year * 2)) {
        return (date = (Math.floor(period / month)) + " years ago");
    }

    // return date;

}

window.addEventListener('load', () => {
    // const rxOne = /^[\],:{}\s]*$/;
    // const rxTwo = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g;
    // const rxThree = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g;
    // const rxFour = /(?:^|:|,)(?:\s*\[)+/g;
    // const isJSON = (input) => (
    //     input.length && rxOne.test(
    //         input.replace(rxTwo, '@')
    //         .replace(rxThree, ']')
    //         .replace(rxFour, '')
    //     )
    // );


    $.ajax({
        type: "GET",
        url: "../../phpFiles/newsfeedPHP/newsfeedRecievingQuestion.php?num=" + num,
        async: false,
        // contentType: "application/json; charset=utf-8",
        // datatype: "json",
        // data: JSON.stringify(result),
        // _parseJSON: function(response) {
        //     return response.text().then(function(text) {
        //         return isJSON(text) ? JSON.parse(text) : {}
        //     })
        // },
        success: function (result) {
            if (result == '0') {
                holdingHeader.style.display = 'none';
            } else {

                let data = JSON.parse(result);
                // console.log(data);
                dataPost = data[0];
                dataUser = data[1];
                dataImage = data[2];
                dataPrefer = data[3];
                dataPreferUser = data[4];
                let type, name, directory;
                console.log(data[0]);
                console.log(data[3]);
                let preferHolder, imageHolder, preferUserIdHolder;
                // console.log(data[2]);
                let index, count, count1, count2, count3;
                let found, preferFound;
                let preferCounter = null;
                let user, preferUser;
                let picSubstitute, newDivHolder, QuestionH, attribute;
                // const regex;
                // first for is for going through the Postdata
                holdingHeader.style.display = 'flex';
                holdingHeader.innerHTML = '';
                for (index = 0; index < dataPost.length; index++) {
                    // second for is for going through the userdata
                    for (count = 0; count < dataUser.length; count++) {
                        dataPost[index][2] = parseInt(dataPost[index][2]);
                        if ((dataUser[count][0] == dataPost[index][1])) {

                            // finding image of the one who questioned
                            for (count1 = 0; count1 < dataImage.length; count1++) {
                                if ((dataImage[count1]) && dataImage[count1][1] === dataUser[count][0]) {
                                    found = true;
                                    imageHolder = dataImage[count1];
                                    break;
                                } else {
                                    found = false;
                                }

                            }
                            // finding the prefered answer for the user's question
                            preferHolder = null;
                            for (count2 = 0; count2 < dataPrefer.length; count2++) {
                                if ((dataPrefer[count2]) && dataPrefer[count2][2] === dataPost[index][0]) {
                                    preferFound = true;
                                    preferHolder = dataPrefer[count2];
                                    if (preferCounter == null) {
                                        preferCounter = 0;
                                    } else {
                                        preferCounter++;
                                    }
                                    break;
                                } else {
                                    preferFound = false;
                                }
                            }
                            // finding the prefered answer's user
                            if (preferHolder) {
                                for (count3 = 0; count3 < dataPreferUser.length; count3++) {
                                    if ((dataPreferUser[count3]) && dataPreferUser[count3][0] === preferHolder[1]) {
                                        preferUserIdHolder = dataPreferUser[count3];
                                        break;
                                    }
                                }
                            }

                            // HelloWorld();
                            // here we must have userdata his/her image and the prefered answer
                            if (found && preferFound) {
                                user = time(parseInt(dataPost[index][11]));
                                preferUser = time(parseInt(preferHolder[11]));
                                postIdHolder[postIdCount] = dataPost[index][0];
                                postIdCount++;
                                type = imageHolder[2];
                                name = imageHolder[3];
                                directory = imageHolder[4];
                                picSubstitute = "../../SVGs/user-alt-solid.svg";
                                const regex = new RegExp(`${picSubstitute}`);
                                holdingHeader.innerHTML += divHolder.innerHTML
                                    .replace(/Likes/g, dataPost[index][6])
                                    .replace(/Unlikes/g, dataPost[index][7])
                                    .replace(/Comments/g, dataPost[index][5])
                                    .replace(/Header/g, dataPost[index][9])
                                    .replace(/Username/g, dataUser[count][1])
                                    .replace(/Postdate/g, user)
                                    .replace(/Posttopic/g, dataPost[index][10])
                                    .replace(/Userrole/g, dataUser[count][11])
                                    .replace(/usid1/g, dataUser[count][0])
                                    .replace(/poid1/g, dataPost[index][0])
                                    .replace(/profileid/g, dataUser[count][0])
                                    .replace(regex, directory + name + "." + type)
                                    .replace(/userpic1/g, "userpic2")
                                    .replace(/PrefUserName/g, preferUserIdHolder[1])
                                    .replace(/PrefUserRole/g, preferUserIdHolder[11])
                                    .replace(/addition/g, preferHolder[0])
                                    .replace(/PrefUserTime/g, preferUser)
                                    .replace(/PrefUserAnswer/g, preferHolder[8])
                                    .replace(/PrefLike/g, preferHolder[6])
                                    .replace(/PrefComment/g, preferHolder[5])
                                    .replace(/PrefUnlike/g, preferHolder[7]);

                                // var likeId = document.getElementsByClassName('prefer-like');
                                // likeId[preferCounter].setAttribute('data-preferid-1', preferHolder[0]);
                                // var unlikeId = document.getElementsByClassName('prefer-unlike');
                                // unlikeId[preferCounter].setAttribute('data-preferid-2', preferHolder[0]);
                                break;
                            } else if (!found && preferFound) {
                                user = time(parseInt(dataPost[index][11]));
                                preferUser = time(parseInt(preferHolder[11]));
                                postIdHolder[postIdCount] = dataPost[index][0];
                                postIdCount++;
                                holdingHeader.innerHTML += divHolder.innerHTML
                                    .replace(/Likes/g, dataPost[index][6])
                                    .replace(/Unlikes/g, dataPost[index][7])
                                    .replace(/Comments/g, dataPost[index][5])
                                    .replace(/Header/g, dataPost[index][9])
                                    .replace(/Username/g, dataUser[count][1])
                                    .replace(/Postdate/g, user)
                                    .replace(/Posttopic/g, dataPost[index][10])
                                    .replace(/Userrole/g, dataUser[count][11])
                                    .replace(/usid1/g, dataUser[count][0])
                                    .replace(/poid1/g, dataPost[index][0])
                                    .replace(/profileid/g, dataUser[count][0])
                                    .replace(/PrefUserName/g, preferUserIdHolder[1])
                                    .replace(/PrefUserRole/g, preferUserIdHolder[11])
                                    .replace(/addition/g, preferHolder[0])
                                    .replace(/PrefUserTime/g, preferUser)
                                    .replace(/PrefUserAnswer/g, preferHolder[8])
                                    .replace(/PrefLike/g, preferHolder[6])
                                    .replace(/PrefComment/g, preferHolder[5])
                                    .replace(/PrefUnlike/g, preferHolder[7]);


                                // var likeId = document.getElementsByClassName('prefer-like');
                                // likeId[preferCounter].setAttribute('data-preferid-1', preferHolder[0]);
                                // var unlikeId = document.getElementsByClassName('prefer-unlike');
                                // unlikeId[preferCounter].setAttribute('data-preferid-2', preferHolder[0]);

                                break;
                            } else if (found && !preferFound) {
                                user = time(parseInt(dataPost[index][11]));
                                postIdHolder[postIdCount] = dataPost[index][0];
                                postIdCount++;
                                type = imageHolder[2];
                                name = imageHolder[3];
                                directory = imageHolder[4];
                                picSubstitute = "../../SVGs/user-alt-solid.svg";
                                const regex = new RegExp(`${picSubstitute}`);

                                newDivHolder = document.createElement('div');
                                QuestionH = "question-holder";
                                attribute = document.createAttribute('class');
                                attribute.value = QuestionH;
                                newDivHolder.setAttributeNode(attribute);
                                newDivHolder.innerHTML = QrightHolder.innerHTML + QleftHolder.innerHTML;

                                holdingHeader.innerHTML += newDivHolder.outerHTML
                                    .replace(/Likes/g, dataPost[index][6])
                                    .replace(/Unlikes/g, dataPost[index][7])
                                    .replace(/Comments/g, dataPost[index][5])
                                    .replace(/Header/g, dataPost[index][9])
                                    .replace(/Username/g, dataUser[count][1])
                                    .replace(/Postdate/g, user)
                                    .replace(/Posttopic/g, dataPost[index][10])
                                    .replace(/Userrole/g, dataUser[count][11])
                                    .replace(/usid1/g, dataUser[count][0])
                                    .replace(/poid1/g, dataPost[index][0])
                                    .replace(/profileid/g, dataUser[count][0])
                                    .replace(regex, directory + name + "." + type)
                                    .replace(/userpic1/g, "userpic2");
                                break;
                            } else {
                                user = time(parseInt(dataPost[index][11]));
                                postIdHolder[postIdCount] = dataPost[index][0];
                                postIdCount++;

                                newDivHolder = document.createElement('div');
                                QuestionH = "question-holder";
                                attribute = document.createAttribute('class');
                                attribute.value = QuestionH;
                                newDivHolder.setAttributeNode(attribute);
                                newDivHolder.innerHTML = QrightHolder.innerHTML + QleftHolder.innerHTML;

                                holdingHeader.innerHTML += newDivHolder.outerHTML
                                    .replace(/Likes/g, dataPost[index][6])
                                    .replace(/Unlikes/g, dataPost[index][7])
                                    .replace(/Comments/g, dataPost[index][5])
                                    .replace(/Header/g, dataPost[index][9])
                                    .replace(/Username/g, dataUser[count][1])
                                    .replace(/Postdate/g, user)
                                    .replace(/Posttopic/g, dataPost[index][10])
                                    .replace(/Userrole/g, dataUser[count][11])
                                    .replace(/usid1/g, dataUser[count][0])
                                    .replace(/poid1/g, dataPost[index][0])
                                    .replace(/profileid/g, dataUser[count][0]);
                                break;
                            }

                        }
                        // break;

                    }

                }
                likeUnlike();

            }
        }
    });


});




function checkPost(post1, post2) {
    for (let index = 0; index < post2.length; index++) {
        console.log(post2[index]);
        if (post1 == post2[index]) {
            return false;
        }
    }
    return true;
}

// the refresh button
// if (refreshBtn) {
// refreshBtn.onload = (event) => {
//     var circle = document.createElement('div');
//     circle.style.width = '15px';
//     circle.style.height = '30px';
//     circle.style.borderBottomWidth = '2px';
//     circle.style.borderBottomColor = 'grey';
//     circle.style.borderBottomStyle = 'solid';
//     cirlcl.style.animation = 'circle infinite';
//     event.appendChild(circle);
// }

function holdingId(value) {
    let index;
    for (index = 0; index < postIdHolder.length; index++) {
        if (postIdHolder[index] == value) {
            return true;
        }
        // console.log(postIdHolder[index] + "\n\n");
    }
    return false;
}

var userDefault = document.getElementsByClassName('userpic1');
var rightLeft = document.getElementById('right-left');

rightLeft.addEventListener('scroll', function () {
    var Qheight = holdingHeader.offsetHeight + 180;
    var yOffset = rightLeft.scrollTop;
    var y = (yOffset + window.innerHeight);

    if (y >= Qheight) {
        // num += 20;
        $.ajax({
            type: "GET",
            url: "../../phpFiles/newsfeedPHP/newsfeedRecievingQuestion.php?num=" + num + "&load=true",
            async: true,
            success: function (result) {
                if (result == '0') {
                    holdingHeader.style.display = 'none';
                } else {
                    let data = JSON.parse(result);
                    // console.log(data);
                    dataPost = data[0];
                    dataUser = data[1];
                    dataImage = data[2];
                    dataPrefer = data[3];
                    let type, name, directory;
                    // console.log(data[3]);
                    // console.log(data[1]);
                    console.log(data[2]);
                    let preferHolder, imageHolder, preferUserIdHolder;
                    // console.log(data[2]);
                    let index, count, count1, count2, count3;
                    let found, preferFound;
                    let preferCounter = null;
                    let user, preferUser;
                    let picSubstitute, newDivHolder, QuestionH, attribute;
                    // const regex;
                    // first for is for going through the Postdata
                    holdingHeader.style.display = 'flex';
                    // holdingHeader.innerHTML = '';
                    for (index = 0; index < dataPost.length; index++) {
                        if (!holdingId(dataPost[index][0])) {
                            // second for is for going through the userdata
                            for (count = 0; count < dataUser.length; count++) {
                                dataPost[index][2] = parseInt(dataPost[index][2]);
                                if ((dataUser[count][0] == dataPost[index][1])) {

                                    // finding image of the one who questioned
                                    for (count1 = 0; count1 < dataImage.length; count1++) {
                                        if ((dataImage[count1]) && dataImage[count1][1] === dataUser[count][0]) {
                                            found = true;
                                            imageHolder = dataImage[count1];
                                            break;
                                        } else {
                                            found = false;
                                        }
                                    }

                                    // finding the prefered answer for the user's question
                                    preferHolder = null;
                                    for (count2 = 0; count2 < dataPrefer.length; count2++) {
                                        if ((dataPrefer[count2]) && dataPrefer[count2][2] === dataPost[index][0]) {
                                            preferFound = true;
                                            preferHolder = dataPrefer[count2];
                                            if (preferCounter == null) {
                                                preferCounter = 0;
                                            } else {
                                                preferCounter++;
                                            }
                                            break;
                                        } else {
                                            preferFound = false;
                                        }
                                    }
                                    // finding the prefered answer's user
                                    if (preferHolder) {
                                        for (count3 = 0; count3 < dataPreferUser.length; count3++) {
                                            if ((dataPreferUser[count3]) && dataPreferUser[count3][0] === preferHolder[1]) {
                                                preferUserIdHolder = dataPreferUser[count3];
                                                break;
                                            }
                                        }
                                    }

                                    // here we must have userdata his/her image and the prefered answer
                                    if (found && preferFound) {
                                        user = time(parseInt(dataPost[index][11]));
                                        preferUser = time(parseInt(preferHolder[11]));
                                        postIdHolder[postIdCount] = dataPost[index][0];
                                        postIdCount++;
                                        type = imageHolder[2];
                                        name = imageHolder[3];
                                        directory = imageHolder[4];
                                        picSubstitute = "../../SVGs/user-alt-solid.svg";
                                        const regex = new RegExp(`${picSubstitute}`);
                                        holdingHeader.innerHTML += divHolder.innerHTML
                                            .replace(/Likes/g, dataPost[index][6])
                                            .replace(/Unlikes/g, dataPost[index][7])
                                            .replace(/Comments/g, dataPost[index][5])
                                            .replace(/Header/g, dataPost[index][9])
                                            .replace(/Username/g, dataUser[count][1])
                                            .replace(/Postdate/g, user)
                                            .replace(/Posttopic/g, dataPost[index][10])
                                            .replace(/Userrole/g, dataUser[count][11])
                                            .replace(/usid1/g, dataUser[count][0])
                                            .replace(/poid1/g, dataPost[index][0])
                                            .replace(/profileid/g, dataUser[count][0])
                                            .replace(regex, directory + name + "." + type)
                                            .replace(/userpic1/g, "userpic2")
                                            .replace(/PrefUserName/g, preferUserIdHolder[1])
                                            .replace(/PrefUserRole/g, preferUserIdHolder[11])
                                            .replace(/addition/g, preferHolder[0])
                                            .replace(/PrefUserTime/g, preferUser)
                                            .replace(/PrefUserAnswer/g, preferHolder[8])
                                            .replace(/PrefLike/g, preferHolder[6])
                                            .replace(/PrefComment/g, preferHolder[5])
                                            .replace(/PrefUnlike/g, preferHolder[7]);
                                        break;
                                    } else if (!found && preferFound) {
                                        user = time(parseInt(dataPost[index][11]));
                                        preferUser = time(parseInt(preferHolder[11]));
                                        postIdHolder[postIdCount] = dataPost[index][0];
                                        postIdCount++;
                                        holdingHeader.innerHTML += divHolder.innerHTML
                                            .replace(/Likes/g, dataPost[index][6])
                                            .replace(/Unlikes/g, dataPost[index][7])
                                            .replace(/Comments/g, dataPost[index][5])
                                            .replace(/Header/g, dataPost[index][9])
                                            .replace(/Username/g, dataUser[count][1])
                                            .replace(/Postdate/g, user)
                                            .replace(/Posttopic/g, dataPost[index][10])
                                            .replace(/Userrole/g, dataUser[count][11])
                                            .replace(/usid1/g, dataUser[count][0])
                                            .replace(/poid1/g, dataPost[index][0])
                                            .replace(/profileid/g, dataUser[count][0])
                                            .replace(/PrefUserName/g, preferUserIdHolder[1])
                                            .replace(/PrefUserRole/g, preferUserIdHolder[11])
                                            .replace(/addition/g, preferHolder[0])
                                            .replace(/PrefUserTime/g, preferUser)
                                            .replace(/PrefUserAnswer/g, preferHolder[8])
                                            .replace(/PrefLike/g, preferHolder[6])
                                            .replace(/PrefComment/g, preferHolder[5])
                                            .replace(/PrefUnlike/g, preferHolder[7]);
                                        break;
                                    } else if (found && !preferFound) {
                                        user = time(parseInt(dataPost[index][11]));
                                        postIdHolder[postIdCount] = dataPost[index][0];
                                        postIdCount++;
                                        type = imageHolder[2];
                                        name = imageHolder[3];
                                        directory = imageHolder[4];
                                        picSubstitute = "../../SVGs/user-alt-solid.svg";
                                        const regex = new RegExp(`${picSubstitute}`);

                                        newDivHolder = document.createElement('div');
                                        QuestionH = "question-holder";
                                        attribute = document.createAttribute('class');
                                        attribute.value = QuestionH;
                                        newDivHolder.setAttributeNode(attribute);
                                        newDivHolder.innerHTML = QrightHolder.innerHTML + QleftHolder.innerHTML;

                                        holdingHeader.innerHTML += newDivHolder.outerHTML
                                            .replace(/Likes/g, dataPost[index][6])
                                            .replace(/Unlikes/g, dataPost[index][7])
                                            .replace(/Comments/g, dataPost[index][5])
                                            .replace(/Header/g, dataPost[index][9])
                                            .replace(/Username/g, dataUser[count][1])
                                            .replace(/Postdate/g, user)
                                            .replace(/Posttopic/g, dataPost[index][10])
                                            .replace(/Userrole/g, dataUser[count][11])
                                            .replace(/usid1/g, dataUser[count][0])
                                            .replace(/poid1/g, dataPost[index][0])
                                            .replace(/profileid/g, dataUser[count][0])
                                            .replace(regex, directory + name + "." + type)
                                            .replace(/userpic1/g, "userpic2");
                                        break;
                                    } else {
                                        user = time(parseInt(dataPost[index][11]));
                                        postIdHolder[postIdCount] = dataPost[index][0];
                                        postIdCount++;

                                        newDivHolder = document.createElement('div');
                                        QuestionH = "question-holder";
                                        attribute = document.createAttribute('class');
                                        attribute.value = QuestionH;
                                        newDivHolder.setAttributeNode(attribute);
                                        newDivHolder.innerHTML = QrightHolder.innerHTML + QleftHolder.innerHTML;

                                        holdingHeader.innerHTML += newDivHolder.outerHTML
                                            .replace(/Likes/g, dataPost[index][6])
                                            .replace(/Unlikes/g, dataPost[index][7])
                                            .replace(/Comments/g, dataPost[index][5])
                                            .replace(/Header/g, dataPost[index][9])
                                            .replace(/Username/g, dataUser[count][1])
                                            .replace(/Postdate/g, user)
                                            .replace(/Posttopic/g, dataPost[index][10])
                                            .replace(/Userrole/g, dataUser[count][11])
                                            .replace(/usid1/g, dataUser[count][0])
                                            .replace(/poid1/g, dataPost[index][0])
                                            .replace(/profileid/g, dataUser[count][0]);
                                        break;
                                    }

                                }
                            }
                        } else {
                            continue;
                        }

                    }
                    likeUnlike();

                }


            }
        });


    }

    var sl = document.getElementsByClassName('scroll-value-holder')[0];
    sl.innerHTML = Qheight + " | " + y;

});

