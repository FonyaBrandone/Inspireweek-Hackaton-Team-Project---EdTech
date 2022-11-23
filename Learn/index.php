<?php
include 'session.php';
session::checkSession();

//header authentication:
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    session_destroy();
    $sql = "UPDATE user SET status='Offline' WHERE unique_id='$id'";
    $db->update($sql);
    echo "<script>window.location='../login.php';</script>";
}
?>
<?php
if (isset($_SESSION['uname'])) {
    $uname =  $_SESSION['uname'];
} else {
    $uname = 'friend';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WikkiBot | WkkiLearn Study Robot</title>
    <link rel="stylesheet" href="css/try.css">
    <link rel="shortcut icon" href="../assets/wikki.svg">
    <link rel="stylesheet" href="css/style.css">

    <!--Bootstrap cdn:-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <style>
        /* Unique css styles, customized or added */

        .wrapper .title {
            background-color: pink;
        }

        p {
            font-family: 'Times New Roman', Times, serif;
        }

        img {
            width: 40px;
            height: 30px;
            border-radius: 50%;
        }

        body {
            background-color: solid black;
            height: 100vh;
            overflow-x: hidden;
        }

        .wrapper {
            background-color: white;
            box-shadow: 2px 1px 3px 1px solid lightgrey;
        }

        .form {
            opacity: 0.9;
        }

        #start {
            height: 30px;
            background-color: transparent;
            color: white;
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif;
            display: block;
            margin-top: auto;
            margin-bottom: auto;
            border: 0px lightcoral;
            border-radius: 3px;
        }

        #start img {
            width: 32px;
            height: 32px;
        }

        .mic {
            font-size: 36px;
            cursor: pointer;
            color: pink;
        }

        ::placeholder {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 18px;
            opacity: 0.5;
        }

        .wikki {
            width: auto;
            max-width: 70%;
            padding: 1px 1px;
        }

        #research,
        .research {
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            padding: 18px 20px;
            background-color: rgba(42, 41, 41, 0.463);
        }

        #user {
            width: auto;
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            padding: 5px 5px;
        }

        .link1 {
            padding-top: 80px;
        }

        a {
            font-size: 22px;
            text-decoration: none;
            color: black;
            transition: 600ms;
        }

        a:hover {
            color: pink;
            transition: 500ms;
        }

        i {
            cursor: pointer;
        }

        li {
            list-style-type: none;
        }

        .svg {
            color: rgb(112, 112, 112);
        }

        .svg:hover {
            color: rgb(252, 189, 87);
        }

        .svg-text {
            font-size: 20px;
            opacity: 0.7;
        }

        .wikki-title {
            font-size: 24px;
        }

        #send {
            background-color: pink;
            font-weight: bold;
        }

        #links:hover li {
            color: rgb(252, 189, 87);
        }

        .bd-highlight {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
    </style>
</head>

<body>

    <!-- Menu Modal:-->
    <div class="container">
        <div id="login-modal" class="modal fade" tabindex="-1" aria-hidden="true" aria-labelledby="modal-title">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button class="btn-close" aria-label="modal-title" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="toggle">
                        <div class="modal-body">
                            <button onclick="return false" style="background-color: rgb(33, 33, 63); color:white;" class="btn mt-4 fs-5 ps-3" id="mute"><i id="mute-icon" class="bi bi-volume-up fs-4"></i> Mute Speech</button>
                        </div>
                        <div class="modal-footer">
                            <div class="svg-text text-secondary py-2 container-lg flex justify-content-start align-items-start">
                                <ul id="links">
                                    <li><button onclick="return false" id="back" style="background-color: rgb(33, 33, 63); color: white;" class="btn mt-4"><i class="bi bi-arrow-left me-1 pe-1"></i> Back</button></li>
                                    <li><button onclick="return false" id="logout" style="background-color: rgb(33, 33, 63); color: white;" class="btn mt-4"><i class="bi bi-box-arrow-left pe-1"></i> Logout</button></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="header mb-1 shadow-sm" style="width: 100vw;">
        <div class="container hh py-3">
            <div class="row">
                <div class="col-6 flex-start justify-content-start align-items-start text-start">
                    <p class="text-start wikki-title"><img src="../assets/wikki.svg"> Wikki<span style="color: rgb(252, 189, 87);">Learn</span> </p>
                </div>
                <div class="col-6 flex-end justify-content-end align-items-end text-end">
                    <button class="btn btn-outline-dark pt-1" onclick="location.href = '../'">Home</button>
                    <i class="bi bi-three-dots-vertical px-3 text-dark fw-bolder fs-4 tt" title=" Menu " data-bs-placement="bottom" data-bs-toggle="modal" data-bs-target="#login-modal"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="width: 100vw; height: 98vh;">
        <div class="row">

            <div class="col-lg-11 col-sm-12 col-md-10">

                <div class="wrapper" style="width: 100%; background-image: url(images/bg.png); background-size: 200%;">
                    <div class="title" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; display: block; margin-top:auto; margin-bottom:auto;">
                        <span class="col align-items-cener justify-content-center mt-3"> WikkiBot </span>
                    </div>
                    <div class="form">

                        <!--Contains icon and message replies-->
                        <div class="bot-inbox ai">
                            <div class="icon">
                                <img src="../assets/wikki.svg">
                            </div>
                            <div class="msg wikki">
                                <p id="research" style=" background-color: rgba(42, 41, 41, 0.616);">Hello dear <?php echo $uname; ?> I'm WikkiBot, a study robot <i class="bi bi-robot" style="color: white;"></i>, let's study together I am here for your academic research, i'll help you define words, get explanations, past questions and study resources &#128516. Send <b>"Hello"</b>!
                                    message below!

                                </p>
                            </div>
                        </div>
                    </div>

                    <!--Fixed Bottom Input field-->
                    <div class="field" style="background-image: url(images/pp.jpg); background-size: cover; display: flex; justify-content: center; align-items: center;">
                        <div id="start">
                            <span class="mic" id="mic">&#127897</span><img id="mic-image" src="images/images (5).png" style="display: none; opacity: 1;" alt="">
                        </div>
                        <div class="data">
                            <input type="text" id="message" placeholder="&#128072 Use the Mic OR Type here..." required>
                            <button id="send">Send</button>
                        </div>
                    </div>
                </div>
                <div id="results"></div>


            </div>
        </div>
    </div>


 

    <!--Bootstrap Javascript:-->
    <!-- Other useful scripts-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js " integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM " crossorigin="anonymous "></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="preloader.js"></script>
    

    <!--Bot Scripts and Algorithms:-->
    <script>

        //Speech Recording to text NLP, using google NLP API
        var speechRecognition = window.webkitSpeechRecognition;
        var recognition = new speechRecognition();
        var textarea = $("#message");
        var content = '';
        recognition.continuous = true;
        var notification = new Audio("sounds/notification.mp3");


        //Navigation buttonscontrols:
        document.getElementById('logout').addEventListener("click", function() {
            location.href = '../check/sign_out.php';
        });
        document.getElementById('back').addEventListener("click", function() {
            history.back();
        });


        //On click mic, should start recognition:
        $("#start").on("click", function(event) {
            if (content.length) {
                content += '';
            }
            var plug = true
            document.getElementById("mic-image").src = "images/giphy (1).gif"
            document.getElementById("mic").style.display = "none"
            recognition.start();
        })

        //When Mic is started:
        recognition.onstart = function() {
            document.getElementById("mic-image").style.display = "block"
        }

        //When recording, to transfer data to text area:
        recognition.onresult = function(event) {
            var current = event.resultIndex
            var transcript = event.results[current][0].transcript
            content = "";
            content += transcript
            textarea.val(content)
            $val = content
            serchWiki();
            content = ''
        }

        //Handling speech cases:
        recognition.onspeechend = function() {
            alert("Mic is Off!")
            document.getElementById("mic-image").src = "images/images (5).png"
            document.getElementById("mic-image").style.display = "none"
            document.getElementById("mic").style.display = "block"
        }
        recognition.onerror = function(event) {
            var errors = event.error;
            alert(errors)
            document.getElementById("mic-image").src = "images/images (5).png"
            document.getElementById("mic-image").style.display = "none"
            document.getElementById("mic").style.display = "block"
        }

        textarea.on("input", function() {
            content = $(this).val();
        })


        //getting components values to get going:
        const submitButton = document.querySelector('#send');
        const input = document.querySelector('#message');
        const resultsContainer = document.querySelector('#results');



        //Setting the Wikipedia endpoint - API requests
        const endpoint = 'https://en.wikipedia.org/w/api.php?';
        const params = {
            origin: '*',
            format: 'json',
            exsentences: 5,
            action: 'query',
            prop: 'extracts',
            exintro: true,
            explaintext: true,
            generator: 'search',
            gsrlimit: 2,
        };

        //Displaying filtered Requested Articles and research responses, by the bot:
        const showResults = results => {

            //preloader
            $preloader = `<div class="spin"><div class="icon"><img src="../assets/wikki.svg"><div class="spinner-grow text-primary ms-4" role="status">
                <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-secondary ms-2" role="status">
                <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-success ms-2" role="status">
                <span class="sr-only"></span>
                </div></div>`;
                $(".form").append($preloader);

            results.forEach(result => {

                setTimeout(function() {

                    $(".spin").remove();
                    $replay = `
                    <div class="bot-inbox ai"><div class="icon"><img src="../assets/wikki.svg"> </div><div class="msg wikki"><p id="research"> ${result.intro} </p></div></div>
                    `;
                    $(".form").append($replay);

                    //scroll to see latest message automatically:
                    $(".form").scrollTop($(".form")[0].scrollHeight);
                    
                }, 1500);

            });
        };

        //Function that gathers the endpoint resources into JSON Objects:
        const gatherData = pages => {
            const results = Object.values(pages).map(page => ({
                pageId: page.pageid,
                title: page.title,
                intro: page.extract,
            }));

            //Calling display Reseaches or answers:
            showResults(results);

        };

        //Function that sends requested data or questions/inputs:
        const getData = async () => {
            const userInput = input.value;
            $msg = '<div class="user-inbox ai"><div class="msg user"><p id="user" style="background-color: rgb(252, 189, 87); color: white;" class="research">' + userInput + '</p></div></div>';
            $(".form").append($msg);
            $("#message").val('');
            params.gsrsearch = userInput;
            //scroll to see latest message automatically:
            $(".form").scrollTop($(".form")[0].scrollHeight);


            //Conversing Algorithms for bot interactions
            //Preprogrammed bot conversations:
            const quests = [
                ["hello", "hello dr", "hi", "hello there", "hello bot", "hello wikkibot", "hello wikki", "hello wikkibot", "wikkilearn", "hi bot", "hi wikki", "hi wikkibot", "hi wikkilearn", "hi there", "i extend my greetings"],
                ["good morning", "good afternoon", "good evening"],
                ["good day", "good afternoon", "good evening", "gd day"],
                ["good night", "goodnight", "bonne nuit", "bon nuit", ""],
                ["have a wonderful night", "have a great night", "have a wonderful day"],
                ["how are you", "how are you today", "how are you this day", "how", "what's up", "whats up", "how are you doing today", "what says", "how are you doing", "hope all is well", "hope all is good", "how you"],
                ["Thank you", "Thanks", "merci", "merci beaucoup"]
            ];

            //set of predefined matched array responses:
            const wikkiAI = [
                ["hello dear <?php echo $uname; ?>! I am wikkibot and will help you carryout research and learn in an interactive and fun way. Use the mic or type your 'Term' bellow!"],
                ["A wonderful day to you too. I am here to help you carryout research and learn in an interactive and fun way. Use the mic or type your 'Term' bellow!"],
                ["Same to you, dear learner! Let's get interactive, carryout research and learn in an interactive together. Use the mic or type your 'Term' bellow!"],
                ["Sleep well human, see you tommorow."],
                ["Thank you and same there. I am wikkibot and help you carryout research and learn in an interactive and fun way. Use the mic or type your 'Term' bellow!"],
                ["All good, thank you very much!"],
                ["You're most welcome dear <?php echo $uname; ?>! Use the mic or space below to get started with studies."]
            ];

            //Function to refine user conversation inputs before processing:
            function botProcessing(quests, wikkiAI, string) {
                string = string.toLowerCase();
                let item, i, j;
                for (i = 0; i < quests.length; i++) {
                    for (j = 0; j < quests[i].length; j++) {
                        if (quests[i][j] == string) {
                            items = wikkiAI[i];
                            item = items[Math.floor(Math.random() * items.length)];
                        }
                    }
                }
                return item;
            };

            //reply with found data from array of possible conversations:
            //  Could also use open source conversation AI API's !!
            function botReply(data) {

                $preloader = `<div class="spin"><div class="icon"><img src="../assets/wikki.svg"><div class="spinner-grow text-primary ms-4" role="status">
                <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-secondary ms-2" role="status">
                <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-success ms-2" role="status">
                <span class="sr-only"></span>
                </div></div>`;
                $(".form").append($preloader);
                setTimeout(function() {
                    $replay = `
                    <div class="bot-inbox ai"><div class="icon"><img src="../assets/wikki.svg"> </div><div class="msg wikki"><p id="research"> ${data} </p></div></div>
                    `;
                    $(".spin").remove();
                    $(".form").append($replay);
                    notification.play();

                    //scroll to see latest message automatically:
                    $(".form").scrollTop($(".form")[0].scrollHeight);
                }, 1500);



            }

            let found = botProcessing(quests, wikkiAI, userInput);
            
            //checking and processing Downloads for study resources
            let entry = userInput;

            if (found != null) {
                botReply(found);
            } else if (entry.indexOf("download") !== -1) {

                //Case of Downloading resources:
                function chatAI() {
                    let vals = entry.replace("download ", "");
                    $val = vals;

                    //Query through resouce database for required paper orresouce for downloads, Using Ajax:
                    //chats.php is the querry code that checks database for Ajax request:
                        $.ajax({
                        url: 'chats.php',
                        type: 'POST',
                        data: 'text=' + $val,
                        success: function(result) {
                            if (result != false) {
                                speech = "Click to open!";
                                $replay = '<div class="bot-inbox ai"><div class="icon"><img src="../assets/wikki.svg"></div><div class="msg wikki"><p id="research">Resource Found: <br><a href="library/' + result + '" download="' + result + '"><button class="btn btn-dark rounded"><i class="bi bi-download"></i> Click to Save</button></a></p></div></div>';
                            } else {
                                speech = "Sorry! no paper or resources found!"
                                $replay = '<div class="bot-inbox ai"><div class="icon"><img src="../assets/wikki.svg"></div><div class="msg wikki"><p id="research">Sorry! no paper or resources found!</p></div></div>';
                            }


                            $preloader = `<div class="spin"><div class="icon"><img src="../assets/wikki.svg"><div class="spinner-grow text-primary ms-4" role="status">
                <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-secondary ms-2" role="status">
                <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-success ms-2" role="status">
                <span class="sr-only"></span>
                </div></div>`;
                            $(".form").append($preloader);
                            setTimeout(function() {
                                $(".spin").remove();
                                $(".form").append($replay);
                                notification.play();

                            //scroll to see latest message automatically:
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                            }, 1500);

                            
                        }
                    });
                }
                chatAI();
            } else {

                //connecting to wikipedia  endpoints as last resort, using Axios:
                try {
                    const {
                        data
                    } = await axios.get(endpoint, {
                        params
                    });

                    //error handling cases
                    if (data.error) throw new Error(data.error.info);
                    gatherData(data.query.pages);
                } catch (error) {

                    //error signaling:
                    $preloader = `<div class="spin"><div class="icon"><img src="../assets/wikki.svg"><div class="spinner-grow text-primary ms-4" role="status">
                <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-secondary ms-2" role="status">
                <span class="sr-only"></span>
                </div>
                <div class="spinner-grow text-success ms-2" role="status">
                <span class="sr-only"></span>
                </div></div>`;
                    $(".form").append($preloader);
                    setTimeout(function() {
                        $(".spin").remove();
                        $replay = '<div class="bot-inbox ai"><div class="icon"><img src="../assets/wikki.svg"></div><div class="msg wikki"><p id="research">Sorry something went wrong, could not fetch your article! Please try again <span style="opacity: 0.8;">&#128543</span>. Remember to be straight forward and specific with your research <span style="opacity: 0.8;">&#128591</span></p></div></div>';
                        $(".form").append($replay);

                        //scroll to see latest message automatically:
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                        notification.play();
                    }, 1500);

                    //alert((Object.keys(data)).length)
                } finally {
                    //
                }
            }
        };

        //Getting send request from the "Enter" button:
        const handleKeyEvent = e => {
            if (e.key === 'Enter') {
                getData();
            }
        };

        //handling events of researher or student input:
        const registerEventHandlers = () => {
            input.addEventListener('keydown', handleKeyEvent);
            submitButton.addEventListener('click', getData);
        };

        registerEventHandlers();

        //Mute speech module:
        var muter = document.querySelector("#mute");
        var iconn = document.querySelector("#mute-icon");
        var cntrl = true;
        muter.addEventListener('click', () => {
            if (cntrl == true) {
                speechSynthesis.pause();
                muter.innerHTML = "<i class='bi bi-volume-mute'></i> Enable Speech";
                cntrl = false;

            } else {
                speechSynthesis.resume();
                muter.innerHTML = "<i class='bi bi-volume-up'></i> Mute Speech";
                cntrl = true;
            }
        });


 
    </script>

</body>

</html>