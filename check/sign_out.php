<?php
    session_start();
    //destroy previous session variables:
    session_destroy();
    //direct to the sign in page:
    header("Location: ../login.php");
?>