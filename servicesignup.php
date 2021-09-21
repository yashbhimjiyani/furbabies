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
    <script src="assets/js/vet.js"></script>
    <link rel="stylesheet" href="assets/css/signup.css">
    <title>Document</title>
    <style>
        textarea {
            color: navy;
            font-weight: bold;
            display: block;
            margin: 10px auto;
            background: transparent;
            border: 1px solid navy;
        }

        textarea::placeholder {
            color: navy;
            font-weight: bold;
        }
    </style>
</head>

<body style="background-image: url('assets/img/istockphoto-1185878014-170667a.jpg');">
    <?php
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
    $emailErr = "";
    $msg = "";
    $name = $email = $password = $name = $state = $city = $address = $category = $profilepic = "";
    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $state = $_POST["set_state"];
            $city = $_POST["set_city"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $address = $_POST["address"];
            $profilepic = $_POST["profilepic"];
            $name = $_POST["username"];
            $category = $_POST["category"];

            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                if ($email === 'yashbhimjiyani07@gmail.com') {
                    $emailErr = "User Already Exists";
                }
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }

            $number = preg_match('@[0-9]@', $password);
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $msg = "";
            if (strlen($password) < 6 || !$number || !$uppercase || !$lowercase) {
                $msg = "password must contain atleast one uppercase & digit";
            } else {
                $msg = "";
            }

            if (empty($emailErr) && empty($msg)) {

                $sql = "SELECT * from `services` where email='$email'";
                $result = mysqli_query($connection, $sql);
                $rows = mysqli_num_rows($result);
                if ($rows == 1) {
                    header("location:servicesignup.php?User Already Exists!");
                } else {
                    $sql1 = "INSERT INTO `services` (`name`, `state`, `city`, `email`, `password`,`address`,`profilepic`,`category`) VALUES ('$name', '$state', '$city', '$email', '$password','$address','$profilepic','$category')";
                    if (mysqli_query($connection, $sql1)) {
                        session_start();
                        $_SESSION["sloggedin"] = true;
                        $_SESSION["semail"] = $email;
                        $_SESSION["sname"] = $name;
                        header("location:services.php");
                    } else {
                        echo "Error: " . $sql1 . "<br>" . mysqli_error($connection);
                    }
                }
            }
        }
    } catch (Exception $e) {
        echo "";
    }
    ?>
    <main>
        <img src="assets/img/Screenshot (500).png" alt="" class="logo">
        <h2 class="h2" style="margin-bottom:10px;">Hello Service Proviers! Join Us Now!</h2>
        <div class="btn-group">
            <a href="signup.php" class="btn btn-primary" aria-current="page">Sign up as Pet Parent</a>
            <a href="vetsignup.php" class="btn btn-primary">Sign up as a Vet</a>
            <a href="servicesignup.php" class="btn btn-primary active">Sign up as a Service provider</a>
            <a href="hospitalsignup.php" class="btn btn-primary">Sign up as a Hospital</a>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" name="username" id="username" placeholder="Enter Company/Service name" required>
            <input type="email" name="email" id="email" placeholder="Enter Your Email" required><br><h3 class="error"><?php echo $emailErr?></h3>
            <input type="password" name="password" id="password" placeholder="Enter Your Password" required>
            <select name="category" id="category" required>
                <option value="Pet Service" selected disabled>Pet Service</option>
                <option value="Multiple">Multiple</option>
                <option value="Pet Training">Pet Training</option>
                <option value="Dog Hostelling and breeding">Dog Hostelling and breeding</option>
                <option value="Grooming">Pet Grooming</option>
                <option value="Pet Day Care">Pet Day Care</option>
                <option value="Pet Boarding">Pet Boarding</option>
                <option value="House Call Vet Services">House Call Vet Services</option>
            </select>
            <select name="set_state" id="set_state" onchange="setState()">
                <option value="Select Your State" selected disabled>Your State</option>
                <option value="Gujarat">Gujarat</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Rajshthan">Rajshthan</option>
                <option value="Delhi">Delhi</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Uttar Pradesh">Uttar Pradesh</option>
                <option value="Punjab">Punjab</option>
                <option value="J & K">J & K</option>
                <option value="Goa">Goa</option>
                <option value="Diu, Daman & Dadra Nagar">Diu, Daman & Dadra Nagar</option>
            </select>
            <select name="set_city" id="set_city">
                <option value="Select City/District">Select City/District</option>
                <option value=""></option>
            </select>
            <textarea name="address" id="address" cols="33" rows="3" placeholder="Enter Service Address..."></textarea>
            <input type="text" name="profilepic" id="profilepic" placeholder="Profile Pic: Copy image URL Here...">
            <input type="submit" value="Sign Up">
            <div class="qs">
                <?php
                echo str_replace('%20', ' ', $_SERVER["QUERY_STRING"]);
                ?>
            </div>
            <div class="already" style="margin-bottom: -5px;">Already a User? <a href="login.php">Sign In</a></div>
            
        </form>
    </main>
</body>

</html>