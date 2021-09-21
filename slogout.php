<?php
    session_start();
    unset($_SESSION["wemail"]);
    unset($_SESSION["wname"]);
    unset($_SESSION["wloggedin"]);
    header("location:login.php");
?>