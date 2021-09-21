<?php
    session_start();
    unset($_SESSION["pemail"]);
    unset($_SESSION["pname"]);
    unset($_SESSION["ploggedin"]);
    header("location:login.php");
?>