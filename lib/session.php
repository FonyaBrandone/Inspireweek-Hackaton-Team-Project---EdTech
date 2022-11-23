<?php 
/*Session Mechanism*/
class session{

    public static function checkSession(){
        session_start();
        if(!isset($_SESSION['unique_id'])){
             self::destroy();
             echo "<script>window.location='login.php';</script>";
        }
    }

    public static function checkLogin(){
            session_start();
            if(isset($_SESSION['unique_id'])){
            echo "<script>window.location='index.php';</script>";
        }
    }

    public static function destroy(){
        session_destroy();
        echo "<script>window.location='login.php';</script>";
    }

 }
?>