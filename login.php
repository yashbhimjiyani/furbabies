<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <title>Welcome Back!</title>
    <link rel="stylesheet" href="assets/css/signup.css">
</head>

<body style="background-image: url('assets/img/istockphoto-1185878014-170667a.jpg');">
    <?php
    session_start();

    
    $servername = "localhost";
    $username = "root";
    $pswd = "";
    $db = "petcareusers";
    // Create connection
    $connection = mysqli_connect($servername, $username, $pswd, $db);

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = $password = $usertype = $name = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_POST["email"];
        $password = $_POST["password"];
        $usertype = $_POST["usertype"];
        if ($email == 'yash@gmail.com' && $password=='Yashas1admin' && $usertype=="") {
            $_SESSION["aloggedin"] = true;
            $_SESSION["aemail"] = $email;
            header("location:admin.php");
        } else {
            switch ($usertype) {
                case 'petparent':
                    $sql = "SELECT `name`,`email`,`password` from `users` where `email`='$email' AND `password`='$password'";
                    $result = mysqli_query($connection, $sql);
                    $rows = mysqli_num_rows($result);
                    $name = "";
                    if ($rows == 1) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $name = $row["name"];
                        }
                        session_start();
                        $_SESSION["ploggedin"] = true;
                        $_SESSION["pemail"] = $email;
                        $_SESSION["pname"] = $name;
                        header("location:home.php");
                    } else {
                        header("location:login.php?Incorrect Password or new user");
                    }
                    break;
                case 'vet':
                    $sql = "SELECT `name`,email,`password` from `vets` where `email`='$email' AND `password`='$password'";
                    $result = mysqli_query($connection, $sql);
                    $rows = mysqli_num_rows($result);
                    $name = "";
                    if ($rows == 1) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $name = $row["name"];
                        }
                        session_start();
                        $_SESSION["vloggedin"] = true;
                        $_SESSION["vemail"] = $email;
                        $_SESSION["vname"] = $name;
                        header("location:vetpage.php");
                    } else {
                        header("location:login.php?Incorrect Password or new user");
                    }
                    break;
                case 'service_provider':
                    $sql = "SELECT `name`,email,`password` from `services` where `email`='$email' AND `password`='$password'";
                    $result = mysqli_query($connection, $sql);
                    $rows = mysqli_num_rows($result);
                    $name = "";
                    if ($rows == 1) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $name = $row["name"];
                        }
                        session_start();
                        $_SESSION["sloggedin"] = true;
                        $_SESSION["semail"] = $email;
                        $_SESSION["sname"] = $name;
                        header("location:home.php");
                    } else {
                        header("location:login.php?Incorrect Password or new user");
                    }
                    break;
                case 'hospital':
                    $sql = "SELECT `name`,email,`password` from `hospitals` where `email`='$email' AND `password`='$password'";
                    $result = mysqli_query($connection, $sql);
                    $rows = mysqli_num_rows($result);
                    $name = "";
                    if ($rows == 1) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $name = $row["name"];
                        }
                        session_start();
                        $_SESSION["hloggedin"] = true;
                        $_SESSION["hemail"] = $email;
                        $_SESSION["hname"] = $name;
                        header("location:hospitalpage.php");
                    } else {
                        header("location:login.php?Incorrect Password or new user");
                    }
                    break;
                default:
                    header("location:login.php?Incorrect Password or new user");
                    break;
            }
        }
    }
    ?>
    <header class="h1">
        <img src="assets/img/Screenshot (500).png" alt="" class="logo" style="margin-top: 10px;">
        <h2 class="h2">Welcome Back, Pawrents!</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="qs">
                <?php
                echo str_replace('%20', ' ', $_SERVER["QUERY_STRING"]);
                ?>
            </div>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <input type="password" name="password" id="password" placeholder="Enter your Password" required>
            <select name="usertype" id="usertype" required>
                <option value="Log in as" disabled selected>Log in as</option>
                <option value="petparent">Pet Parent</option>
                <option value="vet">Vet</option>
                <option value="service_provider">Service Provider</option>
                <option value="hospital">Hospital</option>
            </select>

            <a href="#" class="fp">forgot password?</a>
            <input type="submit" name="signup" id="signup" value="Sign In">
            <div class="already" style="margin-left:270px;margin-top:5px">New User? <a href="signup.php">Sign Up</a></div>
        </form>

</body>

</html>