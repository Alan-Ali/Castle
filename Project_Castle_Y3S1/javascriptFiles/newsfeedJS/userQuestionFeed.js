var castleSvg = document.getElementById('castle');
var searchSvg = document.getElementById('search-img');
var userDefaultImage = document.getElementsByClassName('userpic');
var icon = document.getElementsByClassName("nav-img");
var upper = document.getElementsByClassName('upper-img');
var userSvgs = document.getElementsByClassName('user-svgs');
var ans_imgs = document.getElementsByClassName('ans-imgs');
var logoutSvg = document.getElementById('logout-svg');
// these svg injectors were used to make the svgs editable through the javascript itself.
// and not adding the whole svg into the html, and make it such long lines of code.
// SVGInjector(castleSvg);
// SVGInjector(searchSvg);
// SVGInjector(icon);

for (var index = 0; index < userDefaultImage.length; index++) {
    SVGInjector(userDefaultImage[index]);
}
for (var index = 0; index < userSvgs.length; index++) {
    SVGInjector(userSvgs[index]);
}
for (var index = 0; index < upper.length; index++) {
    SVGInjector(upper[index]);
}
for (var index = 0; index < ans_imgs.length; index++) {
    SVGInjector(ans_imgs[index]);
}
// for (var index = 0; index < ans_imgs.length; index++) {
//     SVGInjector(icon[index]);
// }
for (var index = 0; index < upper.length; index++) {
    upper[index].style.width = '30px';
    upper[index].style.height = '30px';
}
for (var index = 0; index < userSvgs.length; index++) {
    userSvgs[index].style.width = '50px';
    userSvgs[index].style.height = '50px';
}
for (var index = 0; index < ans_imgs.length; index++) {
    ans_imgs[index].style.height = '20px';
    ans_imgs[index].style.width = '20px';
}

// styling svg injected image tags
logoutSvg.style.height = '25px';
logoutSvg.style.width = '25px';
castleSvg.style.width = '55px';
castleSvg.style.height = '55px';
searchSvg.style.height = '25px';
searchSvg.style.width = '25px';
for (var index = 0; index < icon.length; index++) {
    icon[index].style.height = '40px';
    icon[index].style.width = '30px';
}
for (var index = 0; index < userDefaultImage.length; index++) {
    userDefaultImage[index].style.width = '18px';
    userDefaultImage[index].style.height = '18px';
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



var buttonUp = document.getElementsByClassName('upper');
var lowerUp = document.getElementsByClassName('lower')
var userAnswer = document.getElementById('A-container');
var navigation = document.getElementsByClassName('nav');

navigation[0].addEventListener('click',
    function () {
        window.location.assign('./newsfeed.php');
    });
navigation[1].addEventListener('click',
    function () {
        window.location.assign('../userProfile/userProfile.php');
    });

var equalize = [3];
for (var index = 0; index < equalize.length; index++) {
    equalize[index] = false;
}

// Answer button
buttonUp[1].addEventListener('click', (event) => {
    if (!equalize[1]) {
        userAnswer.style.visibility = 'visible';
        userAnswer.style.minHeight = '200px';
        buttonUp[1].style.backgroundColor = 'white';
        equalize[1] = true;
    } else {
        userAnswer.style.minHeight = '0';
        userAnswer.style.visibility = 'hidden';
        buttonUp[1].style.backgroundColor = 'transparent';
        equalize[1] = false;
    }

});





// like and unlik buttons
buttonUp[0].addEventListener('click', () => {
    // on clicking we check if the button is white, if not, we make it white,
    // else we remove the color, this is for the like button
    if (!equalize[0]) {
        buttonUp[0].style.backgroundColor = 'white';
        // the first time, appearance of like is dependent on javascript,
        // the number will increase depending on javscript, but on load
        // the data is kept on the database and can be seen.
        lowerUp[0].innerHTML = (parseInt(lowerUp[0].innerHTML) + 1);
        equalize[0] = true;
        // we make an ajax call to add the like
        $.ajax({
            type: "GET",
            async: true,
            url: "./like.php?sign=1",
            success: function (result) {
                console.log('like colored, ' + result);
            }
        });
        // we see if the unlike button is set
        if (equalize[2]) {
            buttonUp[2].style.backgroundColor = 'transparent';
            lowerUp[2].innerHTML = (parseInt(lowerUp[2].innerHTML) - 1);
            equalize[2] = false;
        }
    }
    // this is the else for removing the color
    else {
        buttonUp[0].style.backgroundColor = 'transparent';
        lowerUp[0].innerHTML = (parseInt(lowerUp[0].innerHTML) - 1);
        equalize[0] = false;
        $.ajax({
            type: "GET",
            async: true,
            url: "./like.php?sign=0",
            success: function (result) {
                console.log('like not colored, ' + result);
            }
        });
    }

});

// on clicking we check if the button is white, if not, we make it white,
// else we remove the color, this is for the unlike button
buttonUp[2].addEventListener('click', () => {
    if (!equalize[2]) {
        buttonUp[2].style.backgroundColor = 'white';
        // the first time, appearance of unlike is dependent on javascript,
        // the number will increase depending on javscript, but on load
        // the data is kept on the database and can be seen.
        lowerUp[2].innerHTML = (parseInt(lowerUp[2].innerHTML) + 1);
        equalize[2] = true;
        // we make an ajax call to add the unlike
        $.ajax({
            type: "GET",
            async: true,
            url: "./unlike.php?sign=1",
            success: function (result) {
                console.log('unlike colored, ' + result);
            }
        });
        if (equalize[0]) {
            buttonUp[0].style.backgroundColor = 'transparent';
            lowerUp[0].innerHTML = (parseInt(lowerUp[0].innerHTML) - 1);
            equalize[0] = false;
        }
    } else {
        buttonUp[2].style.backgroundColor = 'transparent';
        lowerUp[2].innerHTML = (parseInt(lowerUp[2].innerHTML) - 1);
        equalize[2] = false;
        $.ajax({
            type: "GET",
            async: true,
            url: "./unlike.php?sign=0",
            success: function (result) {
                console.log('unlike not colored, ' + result);
            }
        });
    }

});

window.addEventListener('load', function () {
    // here on window load, we should check if the like, unlike buttons are there
    $.ajax({
        type: "GET",
        async: true,
        url: "./checklikeunlike.php",
        success: function (result) {
            console.log(result)
            var data = result;
            data = parseInt(data);
            console.log();
            if (data == 1) {
                console.log(data + ", post liked");
                buttonUp[0].style.backgroundColor = 'white';
                equalize[0] = true;
            } else if (data == 0) {
                console.log(data + ", post not liked");
                buttonUp[2].style.backgroundColor = 'white';
                equalize[2] = true;
            } else {
                console.log(data + ", post like and unlike is nertral");
            }

        }
    });
});

// adding the answer to the database
var answer = document.getElementById('A-container-answer');
var addButton = document.getElementById('A-container-button');

addButton.addEventListener('click', function () {
    if (empty(answer.value)) {
        alert("Please Don't Leave The Answer Field Empty!");
    } else {
        alert("done");
        $.ajax({
            type: "GET",
            async: true,
            url: "./addingAnswer.php?sign=1&answer=" + answer.value,
            success: function (result) {
                console.log("done");
                window.location.reload();
            }

        });

    }
});

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

    // function takeTime() {
    //     return new Promise(function(resolve) {
    //         setTimeout(() => {
    //             userAnswer.style.visibility = 'hidden';
    //             resolve('resolved');
    //         }, 10);
    //     })
    // }