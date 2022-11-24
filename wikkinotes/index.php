<?php
session_start();
?>
<?php
if (!$_SESSION['email'] && !$_SESSION['pass']) {
    header("Location: login.php");
}

$mymail = $_SESSION['email'];
include 'connect.php';
$sql = "SELECT * FROM user WHERE email = '$mymail'";
$result = mysqli_query($con, $sql);
if (!$result) {
    echo "Connection Failed";
    die(mysqli_error($con));
} else {
    $row = mysqli_fetch_assoc($result);
}
$auth = $mymail;
$check = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['username']; ?> | WikkiNote</title>
    <link rel="shortcut icon" href="../../assets/wikki.svg">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!--Bootstrap cdn:-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            background-color: white;
        }

        p {
            font-size: 22px;
        }

        .add {
            font-size: 30px;
            color: white;
        }

        .cl {
            background-color: rgb(33, 33, 63);
            color: white;
            height: 130px;
            cursor: pointer;
            border-radius: 20px 100px;
            font-weight: bold;
            transition: 300ms;
        }

        .cl:hover {
            box-shadow: 3px 2px 4px 5px lightgrey;
            color: wheat;
        }

        .cont {
            color: white;
        }



        /* Style the navigation menu */

        .topnav {
            overflow: hidden;
            color: white;
            background-size: cover;
            background-repeat: no-repeat;
            transition: 500ms ease;
        }


        /* Hide the links inside the navigation menu (except for logo/home) */

        .topnav #myLinks {
            display: none;
            color: white;
            padding: auto;
            padding-left: auto;
            width: 100%;
            background-color: rgb(36, 36, 35);
            border-radius: 4px;
            z-index: 1;
            transition: 700ms ease-in;
        }


        /* Style navigation menu links */

        .topnav a {
            color: white;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 25px;
            display: block;
            transition: 100ms ease-in;
        }

        .topnav a:hover {
            color: white;
        }


        /* Style the hamburger menu */

        .topnav a.icon {
            background: black;
            display: block;
            border-radius: 100%;
            position: relative;
            right: 0;
            top: 0;
        }


        /* Style the active link (or home/logo) */

        .active {
            color: white;
        }

        .logo {
            border: 2px pink;
            border-radius: 2px;
            padding: 10px 10px;
            text-align: center;
        }

        .topnav #myLinks a:hover {
            background-color: rgb(252, 189, 87);
            color: black;
        }

        #menu {
            font-size: 27px;
            color: rgb(33, 33, 63);
        }
    </style>

</head>

<body id="body">

    <?php
    if (date('G') >= 0 && date('G') <= 12) {
        $greetings = "Good Morning";
    } elseif (date('G') > 12 && date('G') <= 15) {
        $greetings = "Good Afternoon";
    } else {
        $greetings = "Good Evening";
    }
    ?>

    <div class="container-lg">
        <p class="row my-3">
            <span class="text-left">
                <i class="bi bi-pen" style="color: rgb(252, 189, 87); padding-right: 4px;"></i> <span id="wikki">Wikki</span><span style="color: rgb(252, 189, 87);">Note</span>
            </span>
            <span class="text-right align-items-right" style="margin-top: -50px;">
                <button id="lamp" onclick="lamp()" style="color:rgb(33, 33, 63); background-color:white;" class="btn mt-4"><i class="bi bi-lamp fs-4" id="power"></i></button>
                <button id="logout" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-box-arrow-left pe-1"></i>Logout</button>
            </span>
        </p>
    </div><br>
    <center>
        <p style="width: 75%;" class="mb-3" id="greeting"><?php echo $greetings . ' ' . '<b class="lead" style="color:  rgb(252, 189, 87);">' . $row['username'] . '</b>' . ', '; ?> welcome to your WikkiNote library!</p>
    </center>


    <div class="container my-5" style="width: 80%;">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5 cl col-sm-8 text-center mx-2  my-3 py-3" style="color: rgb(33, 33, 63);">
                <div class="cont" onclick="openAdd()">
                    <span><i class=" add bi-plus-square mb-2"></i></span>
                    <p>Add Notes or Summary</p>
                </div>
            </div>
            <div class="col-lg-5 cl col-sm-8 text-center mx-2 my-3 py-3" style="color: rgb(33, 33, 63);">
                <div class="cont" onclick="openNote()">
                    <span><i class=" add bi-journals mb-2"></i></span>
                    <p>See all Notes or Summary</p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="div">
        <center>
            <!-- Top Navigation Menu -->
            <div class="topnav">
                <!-- Navigation links (hidden by default) -->
                <div id="myLinks" class="text-center bg-secondary" style="transition: ease-in ; width: 87vw; margin-left: auto; margin-right: auto; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">

                    <a><button id="back" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-arrow-left"></i> Back</button></a>
                    <a><button id="home" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-house"></i> Home</button></a>


                </div>
                <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
                <a style="margin-top: 2px; width: 60px; height: 60px; border-radius:10px;" href="javascript:void(0);" id="icon" class="icon total-icon justify-content-center align-items-center bg-none me-4" onclick="myFunction()">
                    <i id="menu1" class="bi bi-list text-center justify-content-center"></i>
                </a>
            </div>
    </div>
    </center>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js " integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM " crossorigin="anonymous "></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

    <script>
        /* Toggle between showing and hiding the navigation menu links when the user clicks on the hamburger menu / bar icon */
        function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }

        cntrl = true;

        const time = new Date().getHours();
        if (time >= 19) {
            lamp();
        }

        function lamp() {
            power = document.getElementById('power');
            if (cntrl == true) {
                bd = document.getElementById('wikki');
                greet = document.getElementById('greeting');
                bd.style.color = "white";
                greet.style.color = "white"
                document.body.style.backgroundColor = "black";

                power.classList.remove("bi-lamp");
                power.classList.add("bi-lamp-fill");


                cntrl = false;
            } else {
                bd = document.getElementById('wikki');
                greet = document.getElementById('greeting');
                icon = document.getElementById('icon');
                menu = document.getElementById('menu');
                icon.style.backgroundColor = "white";
                menu.style.color = "rgb(33, 33, 63)";
                bd.style.color = "black";
                greet.style.color = "black"
                document.body.style.backgroundColor = "white";

                power.classList.remove("bi-lamp-fill");
                power.classList.add("bi-lamp");

                cntrl = true;
            }

        };

        function openAdd() {
            location.href = 'write/';
        }

        function openNote() {
            location.href = 'record/';
        }

                /* Toggle between showing and hiding the navigation menu links when the user clicks on the hamburger menu / bar icon */
                function myFunction() {
            var x = document.getElementById("myLinks");
            var icon = document.getElementById('menu1');
            if (x.style.display === "block") {
                icon.className = "bi bi-list";
                x.style.display = "none";
            } else {
                icon.className = "bi bi-x-lg";
                x.style.display = "block";
            }
        }

        
        document.getElementById('back').addEventListener("click", function() {
            history.back();
        });
        document.getElementById('home').addEventListener("click", function() {
            location.href = '../';
        });
        document.getElementById('logout').addEventListener("click", function() {
            location.href = '../../app/check/sign_out.php';
        });
    </script>
</body>

</html>