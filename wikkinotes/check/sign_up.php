<?php
include 'connect.php';
if(isset($_POST['submit'])){
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $number = $_POST['phoneNumber'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $confirm = $_POST['confirmPassword'];
    if($password != $confirm){
        $err = "*password not match";
        return false;
        header("Location: sign_up.php");
    } else{
        $sql = "insert into admin(fullName,email,phoneNumber,gender,address,password) VALUES('$name', '$email', $number, '$gender', '$address', '$password');";
        $result = mysqli_query($con, $sql);
        if(!$result){
            die(mysqli_error($con));
        } else{
            echo "<script>windows.alert('Registration Successful');</script>";
            header("Location: sign_in.php");
        }
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
    <title>Create Account</title>

    <style>
        body{
            background: #cccc;
            width: 100%;
        }
        input[type=text],
        input[type=email],
        input[type=password],
        input[type=number] {
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

        input[type=text]:hover,
        input[type=email]:hover,
        input[type=password]:hover,
        input[type=number]:hover {
            border-color: rgb(108, 108, 248);
            box-shadow: 0px 20px 30px grey;
        }

        .rad-div,
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
            margin-left: 20%;
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
    <h2><span style="font-size: 60px;">S</span>ign Up</h2>
    <form method="post">
        <?php $err = "";?>
        <label for="">Full Name</label>
        <input type="text" name="fullName" placeholder="Name" required>
        <label for="">Email Address</label>
        <input type="email" name="email" placeholder="Email" required>
        <label for="">Phone Number</label>
        <input type="number" name="phoneNumber" placeholder="Contact" required>
        <label for="">Gender</label><br>
        <div class="rad-div">
            <input type="radio" value="Male" name="gender" required>Male
            <input type="radio" value="Female" name="gender" required>Female
        </div><br>
        <label for="">Street address/Location</label>
        <input type="text" name="address" placeholder="Address" required>
        <label for="">Password</label>
        <input type="password" name="password" min="7" max="15" placeholder="Must be 7 - 15 characters" required>
        <label for="">confirm password</label>
        <input type="password" name="confirmPassword">
        <span style="color: red;"><?php echo $err; ?></span><?php echo $err; ?>
        <button id="sign-button" name="submit" type="submit">Sign Up</button>
    </form>
    <p>
        Already Registered ? <a href="sign_in.php" style="color: solid black; text-decoration: none;"><span style="color: blue; font-size: 22px;">Sign in</span></a>
    </p>
</body>

</html>