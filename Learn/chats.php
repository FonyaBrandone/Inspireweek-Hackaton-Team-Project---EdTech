<?php
$con = mysqli_connect("localhost", "root", "", "chatroom") or die(mysqli_error($con));
//Get user message through Ajax
$getMsg = mysqli_real_escape_string($con, $_POST['text']);

//Searching query database of my chatbot system AI:
$sql = "SELECT resource_name, paper FROM library WHERE title LIKE '%$getMsg%' or title = '$getMsg' or title like '$getMsg%' or title LIKE '%$getMsg'";
$result =mysqli_query($con, $sql) or die(mysqli_error($con));
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $replay = $row['resource_name'];
    $paper = $row['paper'];
    echo $replay;
}else{
    $_POST['result'] = false;
}
?>