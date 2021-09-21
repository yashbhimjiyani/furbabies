<?php
    session_start();
    unset($_SESSION["vemail"]);
    unset($_SESSION["vname"]);
    unset($_SESSION["vloggedin"]);
    header("location:login.php");
?>