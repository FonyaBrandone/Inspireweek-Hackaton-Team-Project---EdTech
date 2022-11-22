<?php
   include_once 'lib/session.php';
   session::checkSession();
?>
<?php  
require_once 'inc/header.php';
$id = $_SESSION['unique_id'];
$sql = "SELECT * FROM user WHERE unique_id='$id'";
$res = $db->select($sql);
foreach($res as $result){ 

    ?>

<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $result['username']; ?> | WikkiLearn App</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../assets/wikki.svg">


    <!--Bootstrap cdn:-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <style>
        body {
            overflow-x: hidden;
        }

        .wikki-title {
            font-size: 24px;
        }

        .imgs {
            width: 40px;
            height: 30px;
            border-radius: 50%;
        }

        .lnk {
            text-decoration: none;
            color: white;
            transition: 500ms;
        }

        .lnk:hover {
            color: white;
        }

        i {
            font-size: 24px;
        }

        i:hover {
            color: black;
        }

        #bot-screenshot {
            height: 700px;
            width: 100%;
        }

        .intro-desc {
            margin-top: 3px;
            font-family: 'Times New Roman', Times, serif;
            font-size: 20px;
        }

        .clear {
            color: #021867;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 22px;
        }

        .intro-img {
            height: 290px;
            border-radius: 5px;
            max-height: max-content;
        }

        .get {
            width: 210px;
            height: auto;
        }

        .tools {
            background-color: rgb(252, 189, 87);
            width: 145px;
            height: 135px;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        i {
            font-size: 40px;
        }

        h4 {
            font-family: 'Times New Roman', Times, serif;
            font-weight: 600;
            color: rgb(35, 35, 63);
        }

        .links {
            cursor: pointer;
            transition: 400ms;
        }

        .links:hover {
            background-color: rgb(35, 35, 63);
        }

        .misc {
            background-color: rgb(35, 35, 63);
            width: 110px;
            height: 110px;
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .imgs {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .intro {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <!-- Top Navigation Menu -->
    <div class="header mb-4 shadow-sm">
        <div class="topnav" style="background-color:rgb(35, 35, 63);">
            <div class="col-6 my-2 flex-start justify-content-start align-items-start text-start border" style="width: 50px; height: 50px; background-image: url(../assets/wikki.svg); border-radius: 50%; border-width: 5px; background-size: 100% 100%; margin-left: 30px; background-color: white;">
            </div>
            <a href="javascript:void(0);" class="icon justify-content-center align-items-center me-4" style="background-color:rgb(35, 35, 63); font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">
                <span class="col-6 flex-end justify-content-end align-items-end text-end" style="color: rgb(252, 189, 87);"><?php echo $result['username']; ?></span>
            </a>
        </div>
    </div>
    <div class="mt-5 d-flex justify-content-center align-items-center">
        <span>
            <p class="text-start text-dark pt-3 ps-4 wikki-title" style="font-family: 'Times New Roman', Times, serif; font-size: 30px;"><img class="imgs" src="../assets/wikki.svg"> <span>Wikki<span style="color: rgb(252, 189, 87);">Learn</span></span> </p>
        </span>
    </div>

    <p class="text-center mb-5" style="margin-top:-18px; color:rgb(35, 35, 63); font-family: cursive; font-size: 22px;">"Quality Education For All"</p>


    <h4 class="ms-5 mt-3 mb-2 text-lg-center">Learning Tools</h4>
    <div class="container-lg-12 row mb-4 mt-3 justify-content-center align-items-center">
        <div class="col-4 tools ms-sm-1 ms-lg-5 text-center pt-3 shadow-lg links" onclick="location.href='learn'">
            <span>
                <i class="bi bi-robot text-white"></i>
                <p>STUDY BOT</p>
            </span>
        </div>
        <div class="col-4 tools ms-3 ms-lg-5 text-center pt-3 shadow-lg links" onclick="location.href='tutorials'">
            <span>
                <i class="bi bi-award-fill text-white"></i>
                <p>ANIMATION LESSONS</p>
            </span>
        </div>
        <div class="col-4 tools ms-3 ms-lg-5 text-center pt-3 shadow-lg links" onclick="location.href='wikkinotes'">
            <span>
                <i class="bi bi-book-fill text-white"></i>
                <p>NOTES</p>
            </span>
        </div>
    </div>
    <div class="container-lg-12 row mb-5 justify-content-center align-items-center">
        <div class="col-4 tools ms-sm-1 ms-lg-5 text-center pt-3 shadow-lg links" onclick="location.href='counselling'">
            <span>
                <i class="bi bi-chat-left-dots text-white"></i>
                <p>COUNSELLING</p>
            </span>
        </div>
        <div class="col-4 tools ms-3 ms-lg-5 text-center pt-3 shadow-lg links" onclick="location.href='quiz'">
            <span>
                <i class="bi bi-activity text-white"></i>
                <p>QUIZ</p>
            </span>
        </div>
        <div class="col-4 tools ms-3 ms-lg-5 text-center pt-3 shadow-lg links" onclick="location.href='math-solver'">
            <span>
                <i class="bi bi-calculator text-white"></i>
                <p>MATH SOLVER</p>
            </span>
        </div>
    </div>

    <hr style="background-color:rgb(35, 35, 63);">

    <h4 class="containerlg-6 ms-5 mt-5 mb-4 text-lg-center">Miscellaneous</h4>
    <div class="container-lg-12 row mb-4 mt-3 justify-content-center align-items-center">
        <div class="col-4 misc ms-sm-1 ms-lg-5 text-center pt-3 shadow-lg links" onclick="location.href='faq'">
            <span>
                <i class="bi bi-chat-quote text-white"></i>
                <p>FAQs</p>
            </span>
        </div>
        <div class="col-4 misc ms-3 ms-lg-5 text-center pt-3 shadow-lg links" id="logout">
            <span>
                <i class="bi bi-box-arrow-left text-white pe-1"></i> 
                <p>LOGOUT</p>
            </span>
        </div>
        <div class="col-4 misc ms-3 ms-lg-5 text-center pt-3 shadow-lg links" onclick="location.href='setting'">
            <span>
                <i class="bi bi-gear text-white"></i>
                <p>SETTINGS</p>
            </span>
        </div>
    </div>

    <p class="text-center"></p>

    <script>
         document.getElementById('logout').addEventListener("click", function() {
            location.href = 'check/sign_out.php';
        });
    </script>
</body>

</html>

<?php
    $_SESSION['uname'] = $result['username'];
} 

?>