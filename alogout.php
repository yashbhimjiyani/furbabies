<?php
    session_start();
    unset($_SESSION["aemail"]);
    unset($_SESSION["aname"]);
    unset($_SESSION["aloggedin"]);
    header("location:login.php");
?>