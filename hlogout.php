<?php
    session_start();
    unset($_SESSION["hemail"]);
    unset($_SESSION["hname"]);
    unset($_SESSION["hloggedin"]);
    header("location:login.php");
?>