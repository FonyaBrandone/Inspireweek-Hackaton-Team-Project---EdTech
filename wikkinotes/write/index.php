<?php
session_start();
if (!$_SESSION['email'] && !$_SESSION['pass']) {
    header("Location: ../login.php");
}
include '../connect.php';
$mymail = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email = '$mymail';";
$result = mysqli_query($con, $sql);
if (!$result) {
    echo "Connection Failed";
    die(mysqli_error($con));
} else {
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>WikkiNotes recordings</title>
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
        form,
        fieldset,
        input,
        textarea {
            margin: 0;
            padding: 0;
            border: 0;
            outline: none;
        }

        body {
            background: #abb5cb;
            font-family: Helvetica, Sans-Serif;
            color: #525c73;
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

        #h1 {
            font-size: 26px;
            text-align: center;
            letter-spacing: 5px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            margin: 0 0 44px 0;
        }

        u {
            font-weight: bold;
        }

        label {
            width: auto;
            display: block;
            text-align: right;
            float: left;
            font-size: 18px;
            letter-spacing: 3px;
            margin: 0 10px 40px 2px;
            margin-left: 30px;
            clear: left;
        }

        input {
            width: 300px;
            height: 40px;
            float: left;
            margin: -14px 0 0 0;
            background: url(dots.png);
            font-family: 'Shadows Into Light', cursive;
            font-size: 24px;
            color: #18326d;
            letter-spacing: 3px;
        }

        textarea {
            width: 620px;
            min-width: 620px;
            max-width: 650px;
            min-height: 500px;
            max-height: auto;
            height: 500px;
            display: block;
            margin-right: auto;
            float: center;
            margin-top: -20px;
            margin-left: 50px;
            margin-bottom: 12px;
            background: url(dots.png);
            font-family: 'Shadows Into Light', cursive;
            font-size: 24px;
            color: #18326d;
            letter-spacing: 3px;
        }

        input#send {
            width: 10px;
            height: 50px;
            float: right;
            margin: 0 70px 36px 0;
            margin-right: 123px;
            padding: 0 0 0 77px;
            background: url(disk.png);
            background-size: 100% 100%;
            font: bold 30px Helvetica, Sans-Serif;
            text-transform: uppercase;
            color: #525c73;
            cursor: pointer;
        }

        .imgs {
            width: 40px;
            height: 30px;
            border-radius: 50%;
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
    </style>
</head>

<body>
    <span class="d-block justify-content-center text-center align-items-center" style="margin-bottom: -50px;">
        <button id="lamp" onclick="lamp()" style="color:rgb(33, 33, 63); background-color: #abb5cb;" class="btn mt-4 me-1"><i class="bi bi-lamp fs-4" id="power"></i></button>
        <button id="back" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-arrow-left me-1"></i> Back</button>
        <button id="logout" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-box-arrow-left pe-1"></i>Logout</button>
    </span>
    <div id="container">

        <p id="h1"><img class="imgs" src="../../../assets/wikki.svg"><u>WikkiNote</u> - <?php echo $row['username'] . '\'s'; ?> Note record</p>

        <form action="" method="post">
            <fieldset>
                <label for="subject">Subject(or Course Name):</label>
                <input type="text" id="subject" name="subject" />

                <label for="topic">Topic title:</label>
                <input type="text" id="topic" name="topic" />

                <label for="note" style="margin-bottom: -15px;">Enter your notes:</label>
                <textarea id="note" name="note" spellcheck="true"></textarea>

                <input title="Save" name="save" type="submit" id="send" />

            </fieldset>
        </form>

        <?php
        if (isset($_POST['save'])) {
            $subject = $_POST['subject'];
            $topic = $_POST['topic'];
            $content = $_POST['note'];
            $mail = $mymail;

            $sql = "INSERT INTO wikkinote(subjects,topic,content,user_email) VALUES('$subject', '$topic', '$content', '$mail');";
            $result = mysqli_query($con, $sql);
            if (!$result) { ?>
                <script>
                    alert('Sorry, an error occured: <?php echo mysqli_error($con); ?>');
                </script>"
            <?php
                die(mysqli_error($con));
            } else { ?>
                <script>
                    alert('Notes successfully Saved!');
                </script>"
        <?php }
        }
        ?>

    </div>

    <script>
        document.getElementById('logout').addEventListener("click", function() {
            location.href = '../../../app/check/sign_out.php';
        });
        document.getElementById('back').addEventListener("click", function() {
            history.back();
        });

        cntrl = true;

        function lamp() {
            power = document.getElementById('power');
            control = document.getElementById('lamp');
            if (cntrl == true) {
                document.body.style.transitionDelay = "200ms";
                document.body.style.background = "black";
                control.style.background = "white";

                power.classList.remove("bi-lamp");
                power.classList.add("bi-lamp-fill");
                cntrl = false;
            } else {
                document.body.style.transitionDelay = "200ms";
                control.style.background = "#abb5cb";
                document.body.style.background = "#abb5cb";

                power.classList.remove("bi-lamp-fill");
                power.classList.add("bi-lamp");

                cntrl = true;
            }

        };
    </script>
</body>

</html>