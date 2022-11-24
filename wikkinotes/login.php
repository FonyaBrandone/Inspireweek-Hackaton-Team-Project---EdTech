<?php
session_start();
?>

<?php
    include 'connect.php';
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Sign in directives and security protocols:
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['pass'] = $_POST['password'];
        $_SESSION['last_signin_timestamp'] = time();


        $sql = "SELECT * FROM user WHERE email='$email' AND pass='$password'";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) > 0){
            if($email){
                $_SESSION['status'] = true;
                header("Location: index.php");
            }
        }else{
            exit;
            header("Location: login.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to WikkiNote</title>
    <link rel="shortcut icon" href="../../assets/wikki.svg">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!--Bootstrap cdn:-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            overflow-y: hidden;
        }

        input:focus,
        button:focus,
        .custom-file {
            box-shadow: none !important;
            outline: none !important;
        }

        #form_col {
            border-radius: 5px;
            display: flex;
            margin-top: 100px;
            justify-content: center;
            align-items: center;
            height: auto;
            background-color: lightgray;
        }

        hr {
            width: 80%;
        }

        #main {
            height: 100vh;
            width: 100vw;
            background-color: #E8ECFB;
            width: 100%;
        }

        .form_row {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .custom-file-label {
            overflow-x: hidden;
        }

        #btn_login {
            background-color: #272A2E;
        }

        #btn_login span {
            color: white;
            font-family: 'poppins', sans-serif;
        }

        .profile {
            display: block;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 105px;
            height: 105px;
            background-color: white;
            border-width: 2px;
            border-radius: 50%;
            border-color: rgb(33, 33, 63);
            backdrop-filter: blur(5px);
        }

        .profile img {
            width: 80px;
            height: 95px;
            border-radius: 50%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: auto;
            margin-bottom: auto;
            padding-top: 5px;
        }
    </style>
</head>

<body style="background-color: white;">
    <section id="main" class="bg-white">
        <center>
            <div class="row align-items-center justify-content-center bg-white">
                <div class="col-9 col-lg-4 d-block align-items-center justify-content-center px-3 py-3" id="form_col">
                    <form autocomplete="off" id="form_login" method="POST">
                        <center>
                            <div class="profile">
                                <img src="../../assets/e-notes-transparent.png" alt="">
                            </div>
                        </center>

                        <div id="ruler" class="">
                            <center>
                                <p><b style="color: rgb(33, 33, 63); font-size:20px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Login to access your Notes</b></p>
                                <hr />
                            </center>
                        </div>
                        <div class="field_container">
                            <div class="form-group">
                                <input type="email" name="email" id="email_addr" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group mb-0">
                                <input type="password" name="password" placeholder="Password" class="form-control" id="pass1">
                            </div>
                            <div class="form-group my-0 pt-2 justify-content-end d-flex">

                            </div>
                            <div class="form-group">
                                <button class="btn btn-block" style="background-color:#4caf50; border-radius:0%;" id="btn_login" name="submit">
                                    <span>Login</span>
                                </button>
                            </div>

                            <h6 class="text-center">Don't have an account? <a href="signup.php" style="text-decoration:none; color: rgb(33, 33, 63);"><u>Signup Now</u></a></h6>

                        </div>

                    </form>
                </div>
            </div>
            <button id="back" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-arrow-left"></i> Back</button> 
            <button id="home" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-house"></i> Home</button> 
       
     </center>
    </section>
    </div>

    <script>
        document.getElementById('back').addEventListener("click", function(){
            history.back();
        });

        document.getElementById('home').addEventListener("click", function(){
            location.href = '../../';
        });
    </script>
    <script src="login.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
</body>

</html>