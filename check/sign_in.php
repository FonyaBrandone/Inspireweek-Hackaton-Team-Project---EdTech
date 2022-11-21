<?php
session_start();
?>

<?php
    include 'connect.php';
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Sign in directives and security protocols:
        $_SESSION['stat1'] = $_POST['email'];
        $_SESSION['stat2'] = $_POST['password'];
        $_SESSION['last_signin_timestamp'] = time();


        $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) > 0){
            if($email){
                $_SESSION['status'] = true;
                header("Location: ../admin/profile.php");
            }
        }else{
            exit;
            header("Location: sign_in.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <title>Sign In</title>

    <style>
        body{
            background: #cccc;
            width: 100%;
        }
        input[type=email],
        input[type=password] {
            margin: 20px auto;
            display: flex;
            align-items: center;
            width: 60%;
            height: 50px;
            font: 20px grey;
            border-color: white;
            background-color: none;
            border-right: 5px;
            border-top: 5px;
            border-radius: 10px;
        }

        input[type=email]:hover,
        input[type=password]:hover {
            border-color: rgb(108, 108, 248);
            box-shadow: 0px 20px 30px grey;
        }

        label {
            display: flex;
            width: 60%;
            align-items: center;
            margin: auto auto;
        }

        ::placeholder {
            color: gray;
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
            padding-left: 10px;
        }

        label {
            color: black;
            font-size: 30px;
        }

        h2 {
            color: solid black;
            text-align: center;
            font-size: 40px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        #sign-button {
            color: white;
            font-size: 30px;
            background-color: rgb(15, 214, 15);
            display: flex;
            width: auto;
            align-items: left;
            margin-left: 46%;
            cursor: pointer;
            border-radius: 10px;
            border-color: rgb(15, 214, 15);
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        button:hover{
            color: white;
            background-color: black;
            box-shadow: 0px 1px 2px black;
        }
        p{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            text-align: center;
            font-size: 20px;
        }
        a{
            text-decoration: none;
        }
        a:hover{
            color: black;
        }
    </style>
</head>
<body>
    <h2>Sign In</h2>
    <form method="post">
        <label for="">Email Address</label>
        <input type="email" name="email" placeholder="Email" required>
        <label for="">Password</label>
        <input type="password" name="password" min="7" max="15" placeholder="Must be 7 - 15 characters" required>
        <button id="sign-button" name="submit" type="submit">Sign In</button>
    </form>
    <p>
        Not yet registered ? <a href="sign_up.php" style="color: solid black;"><span style="color: blue; font-size: 20px;">Sign up</span></a>
    </p>
</body>
</html>