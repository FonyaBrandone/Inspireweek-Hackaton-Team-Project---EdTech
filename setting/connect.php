<?php
$con = new mysqli('localhost', 'root', '', 'chatroom');
//checking if connected:
    if(!$con){
        die(mysqli_error($con));
    }
?>