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
    <link rel="stylesheet" href="assets/css/pethome.css">
    <script src="assets/js/vet.js"></script>
    <title>Furbabies</title>
    <style>
        .col>select {
            color: navy;
            font-weight: bold;
            height: 30px;
            background: transparent;
            overflow: auto;
            width: 130px;
            border-radius: 15px;
            padding: 5px;
            border: 1px groove navy;
        }

        .col>select>option> {
            background: transparent;
        }

        .col-1>input[type=submit] {
            border-radius: 15px;
            padding: 5px 10px;
            border: 1px groove navy;
            background: transparent;
        }
    </style>
</head>

<body style="background-image: url('assets/img/images\ \(1\).jpg')" ;>
    <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $pswd = "";
    $db = "petcareusers";
    // Create connection
    $connection = mysqli_connect($servername, $username, $pswd, $db);
    $category = $state = $city = "";
    $condition = "1=1";
    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {



            if (isset($_POST["category"])) {
                $category = $_POST["category"];
                $condition = "`category`='" . $category . "'";
            } else if (isset($_POST["set_state"]) || !(isset($_POST["category"]))) {
                $state = $_POST["set_state"];
                if (isset($_POST["set_city"])) {
                    $city = $_POST["set_city"];
                    $condition = "`state`='" . $state . "' AND `city`='" . $city . "'";
                } else {
                    $condition = "`state`='" . $state . "'";
                }
            }
            if (isset($_POST["category"]) && isset($_POST["set_state"])) {
                $category = $_POST["category"];
                $state = $_POST["set_state"];
                if (isset($_POST["set_city"])) {
                    $city = $_POST["set_city"];
                    $condition = "(`state`='" . $state . "' AND `city`='" . $city . "') AND `category`='" . $category . "";
                } else {
                    $condition = "`state`='" . $state . "' AND `category`='" . $category . "'";
                }
            }
        }
        if (isset($_POST["clear"])) {
            $condition = "1=1";
        }
    }
    ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand navbar-brand-custom" href="#">
                    <img src="assets/img/Screenshot (500).png" alt="" width="80" height="80">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mx-auto" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-custom" href="home.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-custom active" href="vet.php">Veterinary</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-custom" href="hospital.php">Hospitals</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-custom" href="services.php">Services</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-custom" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-custom" href="home.html#faqs">FAQs</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-custom" href="home.html#contactus">Contact Us</a>
                        </li>
                    </ul>
                    <?php
                    try {
                        if (!isset($_SESSION["ploggedin"]) || $_SESSION["ploggedin"] === false) {
                    ?>
                            <div class="d-flex">
                                <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
                                <a href="signup.php"><button class="btn btn-outline-success mx-2" type="submit">Sign Up</button></a>
                                <a href="login.php"><button class="btn btn-outline-success mx-2" type="submit">Sign In</button></a>
                            </div>
                        <?php
                        } else {
                            $email = $_SESSION["pemail"];
                            $name = $_SESSION["pname"];
                        ?>
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="margin-right:80px;">My Profile</button>

                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width: 300px;background-color:powderblue;color:navy;">
                                <div class="offcanvas-header">
                                    <div id="offcanvasRightLabel" style="color:navy;font-weight:bolder;font-size:26px;margin-top:20px;">Welcome <?php echo $_SESSION["pname"] ?></div>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body" style="background-color: powderblue;color:navy;">
                                    <div>
                                        <?php
                                        $qquer = "SELECT `profilepic` from `users` WHERE `email`='$email'";
                                        $result = mysqli_query($connection, $qquer);
                                        if (mysqli_num_rows($result)) {
                                            while ($rows = mysqli_fetch_assoc($result)) {
                                                if ($rows["profilepic"] == "") {
                                        ?>
                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                        <input type="text" name="upppic" id="upppic" placeholder="Copy Image URL here.">
                                                        <input type="submit" value="Update">
                                                    </form>

                                                <?php
                                                } else {
                                                ?>

                                                    <img src="<?php echo $rows['profilepic'] ?>" alt="" width="120" height="120" style="display:block;margin-left:5px;">

                                                    <button style="display: block;margin-top:10px" onclick="updateppic()">Update Profile Pic</button>
                                                    <script>
                                                        function updateppic() {
                                                            document.getElementById("editpic").style.display = "block";
                                                        }
                                                    </script>
                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="editpic" id="editpic" style="display: none;">
                                                        <input type="text" name="upppic" id="upppic" placeholder="Copy Image URL here.">
                                                        <input type="submit" value="Update">
                                                    </form>
                                        <?php
                                                }
                                            }
                                        }

                                        ?>
                                    </div>
                                    <ul style="list-style-type: none;">
                                        <li style="margin:5px;"><a href="#">My Appointments</a></li>
                                        <li style="margin:5px;"><a href="plogout.php">Log Out</a></li>
                                    </ul>
                                </div>
                            </div>
                    <?php

                        }
                    } catch (Exception $e) {
                        echo "";
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>
    <main>

        <div class="container fluid mt-2" style="background-color:rgb(195, 248, 188);">
            <div class="container">
                <div class="row p-4">
                    <div class="col">
                        <h2 class="text-center" style="color:navy;font-weight:500;text-shadow:2px 2px lightblue;">Available Doctors/Vets...</h2>
                    </div>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <h3 style="color: navy;font-weight: bolder;">Filter Category: </h3>
                    <div class="row">
                        <div class="col">
                            <select name="category" id="category">
                                <option value="Pet Category" selected disabled>Pet Category</option>
                                <option value="MultiSpecialist">MultiSpecialist</option>
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
                        </div>
                        <div class="col">
                            <select name="set_state" id="set_state" onchange="setState()">
                                <option value="State" selected disabled>State</option>
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
                        </div>
                        <div class="col">
                            <select name="set_city" id="set_city">
                                <option value="City/District">City/District</option>
                                <option value="Select State First" disabled>Select State First</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-1">
                            <input type="submit" value="Apply" name="submit">
                        </div>
                        <div class="col-1">
                            <input type="submit" value="Clear" name="clear">
                        </div>


                        <!-- <div class="col">
                        <select name="availability" id="availability">
                            <option value="Availability" selected disabled>Availability</option>
                            <option value="Online">Online</option>
                            <option value="Offline">Offline</option>
                        </select>
                    </div> -->
                    </div>
                </form>
            </div>
            <hr style="color: gray;">
            <div class="container">
                <div class="row text-white m-2">
                    <?php
                    $sql = "SELECT * FROM `vets` WHERE " . $condition;
                    $result = mysqli_query($connection, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                    ?>

                            <div class="col-3 card m-2" style="width: 15rem;background: transparent;">
                                <img src="<?php echo $rows["profilepic"] ?>" class="card-img-top" alt="..." height="200px">
                                <div class="card-body text-center">
                                    <h5 class="card-title" style="color: navy;font-weight: bold;"><?php echo $rows["name"] ?></h5>
                                    <p class="card-text" style="color: darkslategray;font-weight: bolder;"><?php echo $rows["bio"] ?></p>
                                    <a href="#" class="btn btn-primary ">Consult Now</a>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?><h2 style="color:navy;font-weight:bold;text-align:center;">No Results</h2><?php
                                                                                                }
                                                                                                    ?>
                </div>
            </div>
        </div>
    </main>
    <footer class=" text-white" style="background-color: powderblue;">
        <!-- Grid container -->
        <div class="container p-4">

            <section class="mt-3">
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                        <h5 style="color: navy;">Policies</h5>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#!" style="color: navy;">Shipping & Delivery Policies</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Order Cancellation</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Replacement</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Refund & Return</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Terms & Conditions</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase" style="color: navy;">Top Categories</h5>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#!" style="color: navy;">Pet Health Consultation</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Dog Food</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Cat Food</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Cat Toys</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Tortoise Care Chart</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Dog Training</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Pets Grooming</a>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase" style="color: navy;">Other Categories</h5>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#!" style="color: navy;">Dogs Health Care</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">One Day Pet Care</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">House Call Vet Services</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Tortoise Food</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Water Animal Care Blogs</a>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase" style="color: navy;">Contact & Support Us</h5>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#!" style="color: navy;">Call Us: +91 1234112341</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Email us: ujefniug.fn@furbabies.in</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Support Us</a>
                            </li>
                            <li>
                                <a href="#!" style="color: navy;">Join Us</a>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </section>
            <!-- Section: Links -->
        </div>
        <!-- Grid container -->

        <!-- Section: Social media -->
        <section class="mb-4 text-center">
            <!-- Facebook -->
            <a class="btn btn-outline-light btn-floating m-1" style="color: blue;background-color:white;" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

            <!-- Twitter -->
            <a class="btn btn-outline-light btn-floating m-1" style="color: rgb(122, 215, 243);background-color: white;" href="#!" role="button"><i class="fab fa-twitter"></i></a>

            <!-- Google -->
            <a class="btn btn-outline-light btn-floating m-1" style="color: red;background-color: aliceblue;" href="#!" role="button"><i class="fab fa-google"></i></a>

            <!-- Instagram -->
            <a class="btn btn-outline-light btn-floating m-1" style="color: rgb(236, 37, 153);background: white;" href="#!" role="button"><i class="fab fa-instagram"></i></a>
        </section>
        <!-- Section: Social media -->

        <!-- Copyright -->
        <div class="text-center p-3 stayl" style="background-color: rgba(0, 0, 0, 0.2);color: navy;">
            © 2021 Copyright :
            <a style="color: navy;" href="home.php">furbabies</a>
        </div>
        <!-- Copyright -->
    </footer>
</body>

</html>