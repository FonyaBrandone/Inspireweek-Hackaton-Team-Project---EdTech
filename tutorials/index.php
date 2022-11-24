<?php
include 'session.php';
session::checkSession();

//header authentication:
 if(isset($_GET['action']) && $_GET['action'] == "logout"){
  session_destroy();
  $sql = "UPDATE user SET status='Offline' WHERE unique_id='$id'";
  $db->update($sql);
  echo "<script>window.location='../login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animation Tutorials</title>
    
    <!--Bootstrap cdn:-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <style>
        body{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
    </style>
</head>
<body>
        <span class="d-block justify-content-center text-center align-items-center my-3" style="margin-bottom: -50px;">
            <button id="back" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-arrow-left me-1"></i> Back</button>
            <button id="logout" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-box-arrow-left pe-1"></i>Logout</button>
        </span><br>
    <div class="container-lg border-dark rounded mb-5 mt-3 flex align-items-center justify-content-center shadow-sm" style="width: 70vw;">
        <div class="text-white rounded shadow-sm" style="width: 100%; background-color: rgb(33, 33, 63);">
            <p class="text-center fs-3 py-3"> Biology Animation Tutorials </p>
        </div>
        <p class="text-dark fs-5">Topics Covered: (<b>10</b>)</p>
        <button id="math" onclick="location.href='animation/?sub=biology'" style="background-color:rgb(33, 33, 63); color: white; width: 100px;" class="btn mb-2 p-1">Open</button>
    </div>

    <div class="container-lg border-dark rounded mb-5 flex align-items-center justify-content-center shadow-sm" style="width: 70vw;">
        <div class="text-white rounded shadow-sm" style="width: 100%; background-color: rgb(33, 33, 63);">
            <p class="text-center fs-3 py-3"> Chemistry Animation Tutorials  </p>
        </div>
        <p class="text-dark fs-5">Topics Covered: (<b>5</b>)</p>
        <button id="math" onclick="location.href='animation/?sub=chemistry'" style="background-color:rgb(33, 33, 63); color: white; width: 100px;" class="btn mb-2 p-1">Open</button>
    </div>

    <div class="container-lg border-dark rounded mb-5 flex align-items-center justify-content-center shadow-sm" style="width: 70vw;">
        <div class="text-white rounded shadow-sm" style="width: 100%; background-color: rgb(33, 33, 63);">
            <p class="text-center fs-3 py-3"> Physics Animation Tutorials  </p>
        </div>
        <p class="text-dark fs-5">Topics Covered: (<b>13</b>)</p>
        <button id="math" onclick="location.href='animation/?sub=physics'" style="background-color:rgb(33, 33, 63); color: white; width: 100px;" class="btn mb-2 p-1">Open</button>
    </div>

    <script>
         document.getElementById('logout').addEventListener("click", function() {
            location.href = '../app/check/sign_out.php';
        });
        document.getElementById('back').addEventListener("click", function() {
            history.back();
        });

    </script>
</body>
</html>