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
    <title>Welcome To FurBabies</title>
    <link rel="stylesheet" href="assets/css/signup.css">
    <script src="assets/js/pet_breed.js"></script>

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
    $nameErr = $emailErr = "";
    $msg = "";
    $email = $password = $name = $category = $breed = $color = $age = $profilepic = "";
    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $category = $_POST["category"];
            $breed = $_POST["breed"];
            $color = $_POST["color"];
            $age = $_POST["age"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $profilepic = $_POST["email"];
            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {

                if ($email === 'yash@gmail.com') {
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
            
            

            if($msg==="" || $emailErr===""){
                $sql = "SELECT * from `users` where email='$email'";
                $result = mysqli_query($connection, $sql);
                $rows = mysqli_num_rows($result);
                if ($rows == 1) {
                    header("location:signup.php?User Already Exists!");
                } else {
                    $sql1 = "INSERT INTO `users` (`name`, `pet_category`, `breed`, `color`, `age`, `email`, `password`,`profilepic`) VALUES ('$name', '$category', '$breed', '$color', '$age', '$email', '$password','$profilepic')";
                    if (mysqli_query($connection, $sql1)) {
                        session_start();
                        $_SESSION["ploggedin"] = true;
                        $_SESSION["pemail"] = $email;
                        $_SESSION["pname"] = $name;
                        header("location:home.php");
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
    <header class="h1">
        <img src="assets/img/Screenshot (500).png" alt="" class="logo">
        <h2 class="h2">Hello Pawrents, Join us Now!</h2>
        <div class="btn-group">
            <a href="signup.php" class="btn btn-primary active" aria-current="page">Sign up as Pet Parent</a>
            <a href="vetsignup.php" class="btn btn-primary">Sign up as a Vet</a>
            <a href="servicesignup.php" class="btn btn-primary">Sign up as a Service provider</a>
            <a href="hospitalsignup.php" class="btn btn-primary">Sign up as a Hospital</a>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" name="name" id="name" placeholder="Enter Pet's name" required>
            
            <select name="category" id="category" onchange="setPet()" required>
                <option value="Select Pet" selected="selected disabled">Select Pet</option>
                <option value="Dog">Dog</option>
                <option value="Cat">Cat</option>
                <option value="Rabbit">Rabbit</option>
                <option value="Birds">Birds</option>
                <option value="Aquarium Pets">Aquarium Pets</option>
                <option value="Squirrel">Squirrel</option>
                <option value="Tortoise">Tortoise</option>
                <option value="Turtle">Turtle</option>
                <option value="Cattles">Cattles</option>
                <option value="Poultry">Poultry</option>
                <option value="Horse">Horse</option>
            </select>
            <select name="breed" id="breed">
                <option value="Select Pet Breed">Select Pet Breed</option>
                <option></option>
            </select>
            <select name="color" id="color">
                <option value="Select Pet Color">Select Pet Color</option>
                <option></option>
            </select>
            <input type="number" name="age" id="age" placeholder="Enter Pet's age" required>
            <input type="email" name="email" id="email" placeholder="Enter email Address" required>
            <div class="error"><?php echo $emailErr; ?></div>
            <input type="password" name="password" id="password" placeholder="Enter password" required>
            <div class="error"><?php echo $msg; ?></div>
            <input type="text" name="profilepic" id="profilepic" placeholder="Profile Pic: Copy Image URL Here...">
            <input type="submit" name="signup" id="signup" value="Sign Up">
            <div class="qs">
                <?php
                echo str_replace('%20', ' ', $_SERVER["QUERY_STRING"]);
                ?>
            </div>
            <div class="already">Already a User? <a href="login.php">Sign In</a></div>
            <span class="skip"><a href="home.php">Skip for Now</a></span>
        </form>
    </header>

</body>

</html>