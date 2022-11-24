<?php
session_start();
if (!$_SESSION['email'] && !$_SESSION['pass']) {
    header("Location: ../login.php");
}
include '../connect.php';
$mymail = $_SESSION['email'];
$_SESSION['cntrl'] = "pass";

$sql = "SELECT * FROM user WHERE email = '$mymail'";
$result = mysqli_query($con, $sql);
if (!$result) {
    echo "Connection Failed";
    die(mysqli_error($con));
} else {
    $row = mysqli_fetch_assoc($result);
    $fname = $row['username'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Records - WikkiNote</title>
    <link rel="shortcut icon" href="../../../assets/wikki.svg">
    <link rel=preconnect href=//fonts.googleapis.com crossorigin>
    <link rel=preconnect href=//ajax.googleapis.com crossorigin>
    <link href="style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!--Bootstrap cdn:-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">


    <style>
        body,
        div,
        h1,
        form {
            margin: 0;
            padding: 0;
            border: 0;
            outline: none;
        }

        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            line-height: 40px;
            text-transform: uppercase;
        }

        #container {
            width: 800px;
            margin: 100px auto;
            padding: 51px 0 0 0;
            background: url(lines.png);
            position: relative;
            height: auto;
        }

        #container:before {
            content: "";
            width: 19px;
            height: 365px;
            position: absolute;
            left: -19px;
            top: 0;
            background: url(shadow.png);
        }

        u {
            font-weight: bold;
        }

        input {
            width: 80%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            height: 150px;
            float: left;
            margin: -14px 0 0 0;
            font-family: 'Shadows Into Light', cursive;
            font-size: 24px;
            color: #18326d;
            letter-spacing: 3px;
            border: 2px #18326d;
            border-radius: 5px;
        }

        #subject {
            color: red;
            width: 315px;
        }

        #topic {
            color: #021867;
            width: 500px;
        }

        title {
            background-color: #021867;
            color: white;
        }

        img {
            -webkit-touch-callout: none;
        }
    </style>
</head>

<body>

    <?php
    $sql = "SELECT subjects FROM wikkinote WHERE user_email = '$mymail';";
    $result = mysqli_query($con, $sql);
    $total = mysqli_num_rows($result);
    if (mysqli_num_rows($result) > 0) {
    ?>
        <span class="d-block justify-content-center text-center align-items-center" style="margin-bottom: -50px;">
            <button id="lamp" onclick="lamp()" style="color:rgb(33, 33, 63); background-color: white;" class="btn mt-4 me-1"><i class="bi bi-lamp fs-4" id="power"></i></button>
            <button id="back" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-arrow-left me-1"></i> Back</button>
            <button id="logout" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-box-arrow-left pe-1"></i>Logout</button>
        </span><br><br>

        <center>
            <h3 id="head"><?php echo "All" . " " . $row['username'] . "'" . "s" . " " . "Notes and Summaries:"; ?></h3>
        </center>
    <?php } ?>
    <div class="container my-3 py-3">
        <?php

        while ($row = mysqli_fetch_assoc($result)) {
            $subject = $row['subjects'];
        ?>
            <div class="container" id="data">
                <h4 id="subject" class="mt-5"><?php echo $subject; ?></h4>

                <?php
                $sql1 = "SELECT * FROM wikkinote WHERE subjects = '$subject' AND user_email = '$mymail';";
                $result1 = mysqli_query($con, $sql1);
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $_SESSION['cnt'] = $row1['noteid'];

                ?>
                    <div class="container mb-5 py-1">
                        <p id="topic"><b><?php echo $row1['topic'] ?></b></p>
                        <input type="text" value="<?php echo $row1['content'] ?>" readonly>
                    </div><br><br>

                    <span class="container-lg d-block mt-2">
                        <button onclick="location.href='edit?target=<?php echo $row1['noteid']; ?>'" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-pencil-square me-1"></i> Edit</button>
                        <button onclick="location.href='view?target=<?php echo $row1['noteid']; ?>'" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-file-text me-1"></i> Open</button>
                        <button onclick="copying('<?php echo $row1['content']; ?>')" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-clipboard me-1"></i> Copy</button>
                        <button onclick="lecture('<?php echo $row1['topic'] . ': ' . $row1['content']; ?>')" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-mic pe-1"></i> Lecture</button>
                    </span>
                    <br><br>
                <?php } ?>

            </div>

        <?php }; ?>
    </div>

    <?php
    if (mysqli_num_rows($result) == 0) {
    ?>
        <span class="d-block justify-content-center text-center align-items-center" style="margin-bottom: -50px;">
            <div class="container" style="background-image:url(assets/notebook_turn_page_300_wht.gif); background-size: 100% 100%; width: 300px; height: 250px;"></div>
            <h5 class="pt-2 mt-2" style="color: #021867;">No Notes Registered yet. Let's get started <?php echo $fname; ?></h5>
            <button id="back2" style="background-color:rgb(33, 33, 63); color:white;" class="btn"><i class="bi bi-arrow-left me-1"></i> Back</button>
        </span><br><br>
    <?php } ?>
    <script>
        document.getElementById('back2').addEventListener("click", function() {
            history.back();
        });
        document.getElementById('logout').addEventListener("click", function() {
            location.href = '../../../app/check/sign_out.php';
        });

        cntrl = true;

        function lamp() {
            power = document.getElementById('power');
            control = document.getElementById('lamp');
            let head = document.getElementById('head');
            if (cntrl == true) {
                document.body.style.background = "black";
                control.style.background = "white";
                head.style.color = "white";

                power.classList.remove("bi-lamp");
                power.classList.add("bi-lamp-fill");
                cntrl = false;
            } else {
                control.style.background = "white";
                document.body.style.background = "white";
                head.style.color = "rgb(33, 33, 63)";

                power.classList.remove("bi-lamp-fill");
                power.classList.add("bi-lamp");

                cntrl = true;
            }

        };
    </script>
    <script>
        function copying(arg) {
            cText = arg;

            navigator.clipboard.writeText(cText);
            alert("Text Copied!");
        }

        function lecture(arg) {
            texts = arg;
            let $utterance = new SpeechSynthesisUtterance(texts);
            $utterance.rate = 0.5;
            $utterance.volume = 0.8;
            $utterance.pitch = 3;
            speechSynthesis.speak($utterance);
        }
    </script>
</body>

</html>