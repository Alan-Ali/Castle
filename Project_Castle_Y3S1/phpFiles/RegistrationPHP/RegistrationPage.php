<!DOCTYPE html>
<?php
include '../CastleConnect.php';
session_start();
// session_start();

?>
<html>


<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Castle, castle, قەڵا,
         Project Castle, project castle">
    <meta name="author" content="Alan Ace">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links -->
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../../cssFiles/RegistrationStyles/signup.css">
    <link rel="stylesheet" type="text/css" href="../../cssFiles/RegistrationStyles/login.css">
    <link rel='stylesheet' type='text/css' href='../../cssFiles/RegistrationStyles/separateClasses.css'>
    <!--this may not work-->

    <title>Castle</title>
</head>

<body>

    <div class='main'>

        <!-- left of the grid -->
        <div class='grid_left'>

        </div>


        <!-- center of the grid -->
        <div class='grid_center'>
            <!-- center Signup -->
            <form class='Registration_Holder_SignUp' autocomplete='off' method='POST' action='./signup.php' id='signup' name='signupform'>
                <!--First part -->
                <div class='sign_Castle_Tag_Holder'>
                    <svg aria-hidden='true' focusable='false' data-prefix='fas' data-icon='chess-rook' class='svg-inline--fa fa-chess-rook fa-w-12' role='img' xmlns='http://www.w3.org/2000/   svg' viewBox='0 0 384 512'>
                        <path fill='#5A5A5A' d='M368 32h-56a16 16 0 0 0-16 16v48h-48V48a16 16 0 0 0-16-16h-80a16 16 0 0 0-16 16v48H88.1V48a16 16 0 0 0-16-16H16A16 16 0 0 0 0 48v176l64 32c0 48.33-1.54 95-13.21 160h282.42C321.54 351 320 303.72 320 256l64-32V48a16 16 0 0 0-16-16zM224 320h-64v-64a32 32 0 0 1 64 0zm144 128H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h352a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z'></path>
                    </svg>
                    <div class='Castle_Word'>Castle</div>
                </div>
                <!--Second Part -->
                <div class='sign_All_User_Data'>
                    <!--UserName-->
                    <div class='sign_UserName'>
                        <input id='signusername' type='text' name='sign_username' value='' placeholder='UserName...'>
                    </div>
                    <!--Role-->
                    <div class='sign_Role'>
                        <label>Role:</label>
                        <select name='sign_role' id='signrole'>
                            <option> Normal User</option>
                            <option> University Instructor</option>
                            <option> Kinder Garten Teacher</option>
                            <option> Teacher</option>
                        </select>
                    </div>
                    <!--Password-->
                    <div class='sign_Password'>
                        <input type='password' name='sign_password' placeholder='Password...' id='signpassword'>
                    </div>
                    <!--Age-->
                    <div class='sign_Age'>
                        <label for='date' for='month' for='year'>Age:</label>
                        <!--Date Selection-->
                        <input text='number' name='sign_date' placeholder='Date...' value='' id='signdate'>
                        <!--Month Selection-->
                        <!-- <input type="month" name="month" placeholder="Month..."/> -->
                        <select name='sign_month' id='signmonth' value=''>
                            <option>Month</option>
                            <option>January</option>
                            <option>February</option>
                            <option>March</option>
                            <option>April</option>
                            <option>May</option>
                            <option>June</option>
                            <option>July</option>
                            <option>August</option>
                            <option>September</option>
                            <option>October</option>
                            <option>November</option>
                            <option>December</option>
                        </select>
                        <!--Year Selection -->
                        <select name='sign_year' id='signyear' value=''>
                            <option>Year</option>
                            <option>2021</option>
                            <option>2020</option>
                            <option>2019</option>
                            <option>2018</option>
                            <option>2017</option>
                            <option>2016</option>
                            <option>2015</option>
                            <option>2014</option>
                            <option>2013</option>
                            <option>2012</option>
                            <option>2011</option>
                            <option>2010</option>
                            <option>2009</option>
                            <option>2008</option>
                            <option>2007</option>
                            <option>2006</option>
                            <option>2005</option>
                            <option>2004</option>
                            <option>2003</option>
                            <option>2002</option>
                            <option>2001</option>
                            <option>2000</option>
                            <option>1999</option>
                            <option>1998</option>
                            <option>1997</option>
                            <option>1996</option>
                            <option>1995</option>
                            <option>1994</option>
                            <option>1993</option>
                            <option>1992</option>
                            <option>1991</option>
                            <option>1990</option>
                            <option>1989</option>
                            <option>1988</option>
                            <option>1987</option>
                            <option>1986</option>
                            <option>1985</option>
                            <option>1984</option>
                            <option>1983</option>
                            <option>1982</option>
                            <option>1981</option>
                            <option>1980</option>
                            <option>1979</option>
                            <option>1978</option>
                            <option>1977</option>
                            <option>1976</option>
                            <option>1975</option>
                            <option>1974</option>
                            <option>1973</option>
                            <option>1972</option>
                            <option>1971</option>
                            <option>1970</option>
                            <option>1969</option>
                            <option>1968</option>
                            <option>1967</option>
                            <option>1966</option>
                            <option>1965</option>
                            <option>1964</option>
                            <option>1963</option>
                            <option>1962</option>
                            <option>1961</option>
                            <option>1960</option>
                            <option>1959</option>
                            <option>1958</option>
                            <option>1957</option>
                            <option>1956</option>
                            <option>1955</option>
                            <option>1954</option>
                            <option>1953</option>
                            <option>1952</option>
                            <option>1951</option>
                            <option>1950</option>
                            <option>1949</option>
                            <option>1948</option>
                            <option>1947</option>
                            <option>1946</option>
                            <option>1945</option>
                            <option>1944</option>
                            <option>1943</option>
                            <option>1942</option>
                            <option>1941</option>
                            <option>1940</option>
                            <option>1939</option>
                            <option>1938</option>
                            <option>1937</option>
                            <option>1936</option>
                            <option>1935</option>
                            <option>1934</option>
                            <option>1933</option>
                            <option>1932</option>
                            <option>1931</option>
                            <option>1930</option>
                            <option>1929</option>
                            <option>1928</option>
                            <option>1927</option>
                            <option>1926</option>
                            <option>1925</option>
                            <option>1924</option>
                            <option>1923</option>
                            <option>1922</option>
                            <option>1921</option>
                            <option>1920</option>
                            <option>1919</option>
                            <option>1918</option>
                            <option>1917</option>
                            <option>1916</option>
                            <option>1915</option>
                            <option>1914</option>
                            <option>1913</option>
                            <option>1912</option>
                            <option>1911</option>
                            <option>1910</option>
                            <option>1909</option>
                            <option>1908</option>
                            <option>1907</option>
                            <option>1906</option>
                            <option>1905</option>
                            <option>1904</option>
                            <option>1903</option>
                            <option>1902</option>
                            <option>1901</option>
                            <option>1900</option>

                        </select>
                    </div>
                    <!--Confirm Password-->
                    <div class='sign_Confirm_Password'>
                        <input type='password' name='sign_confirm_password' placeholder='Confirm Password...' id='signconfirmpassword'>
                    </div>
                    <!--Telephone No.-->
                    <div class='sign_Telephone_No'>
                        <input type='text' name='sign_telephoneno' value='' placeholder='Phone No...(optional)' id='signtelephoneno' value='' optional>
                    </div>
                    <!--Email-->
                    <div class='sign_Email'>
                        <input type='email' name='sign_email' value='' placeholder='Email...' id='signemail' required>
                    </div>
                    <!--sign_Address-->
                    <div class='sign_Address'>
                        <input type='text' name='sign_address' value='' placeholder='Address...(optional)' value='' id='signaddress' optional>
                    </div>
                    <!--sign Gender-->
                    <div id='gender' class='sign_Gender'>
                        <label id='Gen'>Gender:</label>
                        <label for='male'>Male</label>
                        <input type='radio' id='signmale' name='sign_gender' value='male' required>
                        <label for='male'>Female</label>
                        <input type='radio' id='signfemale' name='sign_gender' value='female' required>
                    </div>
                    <!-- Sign_Privacy Policy-->
                    <div class='sign_PrivacyPolicy'>
                        <input type='checkbox' id='signcheckbox' name='sign_privacy'>
                        <div>You accepted all our <a href='#age'>Privacy Policies</a> by proceeding to the next step.</div>
                    </div>
                    <!--Login_CreateNew-->
                    <div class='sign_Login_CreateNew'>
                        <div id='previous'>
                            <p><object data='../../SVGs/black-triangular-arrowhead-pointing-to-left-direction.svg' width='20' height='20' style='margin-right: 5px;'></object></p>
                            <p>Previous</p>
                        </div>
                        <div id='next'>
                            <p>Next</p>
                            <p><object data='../../SVGs/black-triangular-arrowhead-pointing-to-left-direction.svg' width='20' height='20' style='margin-right: 5px;'></object></p>
                        </div>
                    </div>
                    <!--Sign_Symbol-->
                    <div class='sign_Symbol'>
                        <p>Castle Softwares <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" style="width:10px; height: 10;" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492.185 492.185" style="enable-background:new 0 0 492.185 492.185;" xml:space="preserve">
                                <g id="XMLID_545_">
                                    <path id="XMLID_547_" d="M246.093,0C110.172,0,0.001,110.172,0.001,246.094c0,135.904,110.172,246.092,246.093,246.092
            c135.905,0,246.092-110.188,246.092-246.092C492.185,110.172,381.999,0,246.093,0z M246.093,443.113
            c-108.638,0-197.021-88.383-197.021-197.02c0-108.639,88.384-197.021,197.021-197.021c108.639,0,197.021,88.383,197.021,197.021
            C443.115,354.73,354.732,443.113,246.093,443.113z" />
                                    <path id="XMLID_546_" d="M299.045,108.846c-11.645-2.49-26.182-4.248-42.841-4.248c-82.154,0-148.221,51.564-148.221,144.211
            c0,77.361,48.352,135.777,142.183,135.777c17.475,0,32.827-1.691,45.061-4.105c13.913-2.762,22.972-16.213,20.272-30.141
            c-2.508-12.955-14.968-21.486-27.955-19.154c-8.977,1.615-18.785,2.619-28.082,2.619c-54.823,0-87.025-34.23-87.025-88.621
            c0-60.414,37.857-89.807,86.595-89.807c10.686,0,20.301,1.166,28.8,2.957c13.035,2.762,25.925-5.209,29.232-18.131l0.416-1.629
            c1.629-6.389,0.59-13.18-2.892-18.787C311.106,114.182,305.5,110.236,299.045,108.846z" />
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                            </svg>
                            2021 </p>
                    </div>
                </div>
                <!--Third Part-->
            </form>


            <!-- center Login ? ../PHPTests\RandomTest\Test6.php-->
            <form class='Registration_Holder_Login' id='loginForm' action='login.php' method='POST'>
                <div class='Castle_Tag_Holder'>
                    <svg aria-hidden='true' focusable='false' data-prefix='fas' data-icon='chess-rook' class='svg-inline--fa fa-chess-rook fa-w-12' role='img' xmlns='http://www.w3.org/2000/   svg' viewBox='0 0 384 512'>
                        <path fill='#5A5A5A' d='M368 32h-56a16 16 0 0 0-16 16v48h-48V48a16 16 0 0 0-16-16h-80a16 16 0 0 0-16 16v48H88.1V48a16 16 0 0 0-16-16H16A16 16 0 0 0 0 48v176l64 32c0 48.33-1.54 95-13.21 160h282.42C321.54 351 320 303.72 320 256l64-32V48a16 16 0 0 0-16-16zM224 320h-64v-64a32 32 0 0 1 64 0zm144 128H16a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h352a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z'></path>
                    </svg>
                    <div class='Castle_Word'>Castle</div>
                </div>
                <div class='Email'>
                    <input type='email' name='login_email' placeholder='Email...' styles='border-bottom: 2px grey solid ;'>
                </div>
                <div class='Password'>
                    <input type='password' name='login_password' placeholder='Password...'>
                </div>
                <div class='Login_CreateNew'>
                    <div class='item1'>
                        Login
                    </div>
                    <button class='item2'>
                        Forgot Password
                    </button>
                    <div class='item3'>
                        Create a New Account
                    </div>
                </div>
                <div class='Symbol'>
                    <p>Castle Softwares <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" style="width:10px; height: 10;" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 492.185 492.185" style="enable-background:new 0 0 492.185 492.185;" xml:space="preserve">
                            <g id="XMLID_545_">
                                <path id="XMLID_547_" d="M246.093,0C110.172,0,0.001,110.172,0.001,246.094c0,135.904,110.172,246.092,246.093,246.092
		c135.905,0,246.092-110.188,246.092-246.092C492.185,110.172,381.999,0,246.093,0z M246.093,443.113
		c-108.638,0-197.021-88.383-197.021-197.02c0-108.639,88.384-197.021,197.021-197.021c108.639,0,197.021,88.383,197.021,197.021
		C443.115,354.73,354.732,443.113,246.093,443.113z" />
                                <path id="XMLID_546_" d="M299.0405,108.846c-11.645-2.49-26.182-4.248-42.841-4.248c-82.154,0-148.221,51.564-148.221,144.211
		c0,77.361,48.352,135.777,142.183,135.777c17.475,0,32.827-1.691,45.61-4.105c13.913-2.762,22.972-16.213,20.272-30.141
		c-2.508-12.955-14.968-21.486-27.955-19.154c-8.977,1.615-18.785,2.619-28.082,2.619c-54.823,0-87.025-34.23-87.025-88.621
		c0-60.414,37.857-89.807,86.595-89.807c10.686,0,20.301,1.166,28.8,2.957c13.035,2.762,25.925-5.209,29.232-18.131l0.416-1.629
		c1.629-6.389,0.59-13.18-2.892-18.787C311.106,114.182,305.5,110.236,299.045,108.846z" />
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                        </svg>
                        2021 </p>
                </div>

            </form>
        </div>
        <!-- right of the grid -->
        <div class='grid_right'>
        </div>
    </div>




    </div>

</body>

<script type='text/javascript' src='../../../JSLib/JQuery.min.js'></script>
<script type='text/javascript' src='../../javascriptFiles/RegistrationJS/Topics.js'></script>
<!-- <script type='text/javascript' src='../../javascriptFiles/SigningUpPartTwicks.js'></script> -->
<script type='text/javascript' src='../../../JSLib/svg-injector.min.js'></script>
<script type='text/javascript' id='moveNext'>
    var login = document.getElementsByClassName('Registration_Holder_Login')[0];
    var item3 = document.getElementsByClassName('item3')[0];
    var signup = document.getElementsByClassName('Registration_Holder_SignUp')[0];
    // var main = document.getElementsByClassName('main')[0];

    function move() {
        let opacityLogin = 1.0;
        let opacitySign = 0.0;
        let posLeft = 50,
            index = 0;
        let pos = 150;
        let hello = setInterval(frame, 10);
        signup.style.display = "grid";
        // console.log(posLeft);

        function frame() {
            if (pos == 50) {
                clearInterval(hello);
            } else {
                if (opacityLogin != 0.0) {
                    opacityLogin -= 0.5;
                    opacitySign += 0.5;
                }
                posLeft += -20;
                pos += -20;
                signup.style.left = pos + "%";
                login.style.left = posLeft + "%";
                login.style.opacity = opacityLogin;
                signup.style.opacity = opacitySign;
            }
            // console.log(posLeft);

            let disappear = setInterval(noDisplay, 20);

            // turns the dislay of the login to none.
            function noDisplay() {

                if (index == 150) {
                    login.style.display = 'none';
                    clearInterval(disappear);
                } else {
                    index++;
                }
            }

        }

        // main.style.height = "1000px";
        // login.style.display = "none";        
    }

    item3.addEventListener("click", function() {
        move();
    });

    // adding click submit to divs
    // function submit() {
    //     $(document).ready(function() {
    //         $('.item1').click(function (){
    //             $('#form').submit();
    //         });
    //     });
    // }


    // $(document).ready(function() {
    //     $(item3).click(function() {
    //         $(login).hide("slow");
    //         $(signup).styles.display = "grid";
    //     })
    // });


    // function change() {
    //     login.style.left = "-150%";
    //     signup.style.left = "50%";
    //     login.style.opacity = "0.0";
    //     // login.style.display = "none";
    // }
    // item3.addEventListener("click", function() {
    //     change();
    // });
</script>

<script type='text/javascript' id='moveNew'>
    const previous = document.getElementById('previous');
    var login = document.getElementsByClassName('Registration_Holder_Login')[0];
    var signup = document.getElementsByClassName('Registration_Holder_SignUp')[0];

    function movePre() {
        let posLogin = -50;
        let posSign = 50;
        let opacityLogin = 0.0,
            opacitySign = 1.0;
        login.style.display = 'grid';
        let move = setInterval(frame1, 10);

        function frame1() {
            if (posLogin == 50 || posSign == 150) {
                // previous.stopPropagation();
                clearInterval(move);
            } else {
                if (opacityLogin != 1.0) {
                    opacityLogin += 0.5;
                    opacitySign -= 0.5;
                }
                posSign += 20;
                posLogin += 20;
                login.style.opacity = opacityLogin;
                signup.style.opacity = opacitySign;
                login.style.left = posLogin + '%';
                signup.style.left = posSign + '%';
            }
        }

        var index = 0;
        var disappear1 = setInterval(noDisplay, 11);

        function noDisplay() {
            if (index == 75) {
                signup.style.display = 'none';
                clearInterval(disappear1);
            } else {
                index++;
            }

        }

    }

    previous.addEventListener('click', function() {
        movePre();
    }, true)
</script>

<script type='text/javascript' id='separateClasses'>
    var Login = document.getElementsByClassName('item1')[0];
    Login.addEventListener('click', function() {
        var circle = document.createElement('div');
        circle.setAttribute('class', 'CircleLoader');
        Login.innerHTML = '';
        Login.appendChild(circle);
        $('#loginForm').submit();
        // function sub() {
        //     $('#loginForm').submit();
        // }
        // setTimeout(sub, 500);



    });


    window.onload = () => {
        $.ajax({
            type: "GET",
            url: "./signup.php",
            async: true,
            success: (result) => {
                console.log(result);
                if (result != "") {
                    var data = JSON.parse(result);
                    console.log(data);
                        alert("The Registration Was A Success!.");
                }

            }
        });
    }


    // $('#next').click(function() {
    //     $('#signup').submit();
    // })
</script>


</html>