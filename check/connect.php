<?php
$con = new mysqli('localhost', 'root', '', 'mytest');
//checking if connected:
    if(!$con){
        die(mysqli_error($con));
    }
?>