<?php
include '../session.php';
session::checkSession();

//header authentication:
 if(isset($_GET['action']) && $_GET['action'] == "logout"){
  session_destroy();
  $sql = "UPDATE user SET status='Offline' WHERE unique_id='$id'";
  $db->update($sql);
  echo "<script>window.location='../../login.php';</script>";
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
        video, source{
            border: 1px rgb(33, 33, 63);
        }
    </style>
</head>
<body>
<span class="d-block justify-content-center text-center align-items-center my-3" style="margin-bottom: -50px;">
            <button id="back" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-arrow-left me-1"></i> Back</button>
            <button id="logout" style="background-color:rgb(33, 33, 63); color:white;" class="btn mt-4"><i class="bi bi-box-arrow-left pe-1"></i>Logout</button>
        </span><br>
    <div class="container-lg border-none rounded mt-3 mb-5 flex align-items-center justify-content-center shadow-sm" style="width: 80vw;">
        <div class="text-white rounded" style="width: 100%; height: auto; background-color: none;">     
        <p class="text-dark fs-5 ps-3 py-2"><i class="bi bi-star-fill px-3" style="color: rgb(33, 33, 63);"></i>Covered Topic: <b>Blood clothing in humans</b></p>
        <video width="100%" height="380" controlsList="nodownload" controls>
                <source src="assets/platelets_and_blood_clotting_biology_for_all_fuseschool_h264_75463.mp4" type="video/mp4">
                Browser Incompatible!
            </video>
            <p class="text-dark fs-5 ps-3 py-2">Courtesy: <i>Free Animation Tutorials</i></p>
        </div>
        <p class="py-2 mt-2 fs-5 mb-2">Red blood cells and platelets are found in the human boudy. Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
        <button id="math" onclick="share()" style="background-color: green; color: white; width: 100px;" class="btn mb-2 p-1"><i class="text-white bi bi-whatsapp"></i> Share</button>
        <button id="math" onclick="share()" style="background-color: blue; color: white; width: 100px;" class="btn mb-2 p-1"><i class="text-white bi bi-facebook"></i> Share</button>
        <button id="math" onclick="share()" style="background-color:rgb(33, 33, 63); color: white; width: 100px;" class="btn mb-2 p-1"><i class="text-white bi bi-save"></i> Save</button>
        

    </div>

    <div class="container-lg border-none rounded mt-3 mb-5 flex align-items-center justify-content-center shadow-sm" style="width: 80vw;">
        <div class="text-white rounded" style="width: 100%; height: auto; background-color: none;">     
        <p class="text-dark fs-5 ps-3 py-2"><i class="bi bi-star-fill px-3" style="color: rgb(33, 33, 63);"></i>Covered Topic: <b>DNA to Protein formation</b></p>
        <video width="100%" height="380" controlsList="nodownload" controls>
                <source src="assets/from_dna_to_protein_3d_h264_75532.mp4" type="video/mp4">
                Browser Incompatible!
            </video>
            <p class="text-dark fs-5 ps-3 py-2">Courtesy: <i>Free Animation Tutorials</i></p>
        </div>
        <p class="py-2 mt-2 fs-5 mb-2">Deoxyribonucleic acid to protein conversion in animal cells. Lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</p>
        <button id="math" onclick="share()" style="background-color: green; color: white; width: 100px;" class="btn mb-2 p-1"><i class="text-white bi bi-whatsapp"></i> Share</button>
        <button id="math" onclick="share()" style="background-color: blue; color: white; width: 100px;" class="btn mb-2 p-1"><i class="text-white bi bi-facebook"></i> Share</button>
        <button id="math" onclick="share()" style="background-color:rgb(33, 33, 63); color: white; width: 100px;" class="btn mb-2 p-1"><i class="text-white bi bi-save"></i> Save</button>
        

    </div>

    <script>
                 document.getElementById('logout').addEventListener("click", function() {
            location.href = '../../app/check/sign_out.php';
        });
        document.getElementById('back').addEventListener("click", function() {
            history.back();
        });
    </script>

</body>
</html>