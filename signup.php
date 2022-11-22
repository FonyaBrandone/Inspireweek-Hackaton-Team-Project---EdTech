<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your free account | WikkiLearn</title>
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
            overflow-y: scroll;
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
            border: 2px rgb(33, 33, 63);
            padding: 5px 5px;
            border-radius: 50%;
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
        textarea{
          max-width: 100%;
          max-height: 200px;
        }
    </style>
</head>




<?php  require_once 'inc/header.php'; ?>
 <section class="container" style="width: 100%;">
  <div class="row" style="width: 100%;">
   <div class="col-xl-6 col-lg-6 col-sm-8 col-md-8 justify-content-center align-items-center" style="width: 100%;">
    <div class="signup-card justify-content-center align-items-center">
    <center>
                            
                            <div class="col-6 my-2 text-center border" style="width: 100px; height: 100px; background-image: url(../assets/wikki.svg); border-radius: 50%; border-width: 5px; background-size: 100% 100%; background-color: white; border-color: rgb(33, 33, 63);">
                        </center>

                        <div id="ruler" class="">
                            <center>
                                <p><b style="color: rgb(33, 33, 63); font-size:20px; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Create your free account</b></p>
                                <hr />
                            </center>
                        </div>
    <?php 
      if($_SERVER['REQUEST_METHOD'] == "POST"){

        $uname = $_POST['username'];
        $mail  = $_POST['email'];
        $pass  = $_POST['pass'];
        $bio = $_POST['bio'];
        $class = $_POST['class'];
        $major = $_POST['major'];
        $address = $_POST['address'];
        $rdate = date('Y-m-d');
      
      $permited  = array('jpg', 'jpeg', 'png', 'gif');
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_temp = $_FILES['image']['tmp_name'];
      
      $div = explode('.', $file_name);
      $file_ext = strtolower(end($div));
      $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
      $uploaded_image = "uploads/".$unique_image;
      
      
      if($uname == ""){
        echo "<div class='alert alert-danger'>Enter Name</div>";
      }else{
        if($mail == ""){
          echo "<div class='alert alert-danger'>Enter Email</div>";
      }else{
        if(filter_var($mail, FILTER_VALIDATE_EMAIL) == false){
          echo "<div class='alert alert-danger'>Invalid Email!</div>";
          }else{
            if($pass==""){
              echo "<div class='alert alert-danger'>Enter Password</div>";
            }else{
              if(strlen($pass) < 6){
                echo "<div class='alert alert-danger'>Enter Minimum 6 Character Password</div>";
              }else{
      
                if(empty($file_name)) {
                  echo "<div class='alert alert-danger'>Choose Image</div>";
                  }else{
                
                  if ($file_size >10048567) {
                    echo "<div class='alert alert-danger'>Image Size too large!</div>";
                    }else{
                
                    if (in_array($file_ext, $permited) === false) {
                      echo "<div class='alert alert-danger'>Only images of type ".implode(', ', $permited)." are allowed</div>";
                      }else{
        
                    $chk = "SELECT * FROM user WHERE email='$mail'";
                    $res = $db->select($chk);
                    if(@count($res) > 0){
                      echo "<div class='alert alert-danger'>Account already Exists!</div>";        
                    }else{ 

                    move_uploaded_file($file_temp, $uploaded_image);

                    $unique_id = rand(time(), 10000); 
                    $status = "Offline";
                    $crypt = password_hash($pass, PASSWORD_DEFAULT);  

                    $query = "INSERT INTO user(unique_id, img, username, email, pass, bio, class, major, address, date_registered, status)VALUES('$unique_id', '$uploaded_image', '$uname', '$mail', '$crypt', '$bio', '$class', '$major', '$address', '$rdate', '$status')";
                    $res = $db->insert($query);
                    if($res){
                      echo "<script>alert('Account Created Successfully!');</script>";
                    }else{
                        echo "Sorry, ann Error Occured!";
                  }
                 }
                }
               }
              }
             }
            }
           }
          }
        } 
      }
      ?>
     <form method="POST" enctype="multipart/form-data">
      <input type="text" name="username" class="form-control mb-3" placeholder="User Name" required aria-required="This field is neccessary &#129312!">
      <input type="text" name="email" class="form-control mb-3" placeholder="Email" required aria-required="This field is neccessary!">
      <input type="password" name="pass" class="form-control mb-3" placeholder="Password" required aria-required="This field is neccessary!">
      <input type="text" name="address" class="form-control mb-3" placeholder="Your Address" required aria-required="This field is also important &#128512">
      <input type="text" name="major" class="form-control mb-3" placeholder="Your Major e.g Science, Arts, Technical..." required aria-required="This field is neccessary!">
      <input type="text" name="class" class="form-control mb-3" placeholder="What class are you ?">
      <textarea type="text" name="bio" class="form-control mb-3" placeholder="Brief Introduction &#128526"></textarea>
      <div class="mb-3">
        <input class="form-control" type="file" name="image">
     </div>
     <button class="btn btn-sm btn-primary">Sign Up</button><br>
     <h6 class="text-center">Already have an account? <a href="login" style="text-decoration:none; color: rgb(33, 33, 63);"><u>Login</u></a></h6>

     </form>
    </div>
   </div>
  </div>
 </section>
<?php  require_once 'inc/footer.php'; ?>
