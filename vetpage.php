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
    <title>Furbabies</title>
</head>

<body style="background-image: url('assets/img/ \(1\).jpg');background-position: center;">
    <?php
    session_start();
    // error_reporting(1);

    ?>

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
    $bio = "";
    $upbio = "";
    $uppic = "";
    if ($_SESSION["vloggedin"]) {
        $email = $_SESSION["vemail"];
        $name = $_SESSION["vname"];
    }
    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["upbio"])) {
                $upbio = $_POST["upbio"];
                $quer = "UPDATE `vets` SET `bio` = '$upbio' WHERE `email`='$email'";
                if (mysqli_query($connection, $quer)) {
    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Profile Bio Updated Successfully!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php

                } else {
                    echo "Error: " . $que . "<br>" . mysqli_error($connection);
                }
            }
            if (isset($_POST["uppic"])) {
                $uppic = $_POST["uppic"];
                $quere = "UPDATE `vets` SET `profilepic` = '$uppic' WHERE `email`='$email'";
                if (mysqli_query($connection, $quere)) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong></strong> Profile Pic Updated Successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div><?php

                        } else {
                            echo "Error: " . $que . "<br>" . mysqli_error($connection);
                        }
                    }
                }
            } catch (Exception $e) {
                echo $e;
            }
                            ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand navbar-brand-custom" href="home.php">
                    <img src="assets/img/Screenshot (500).png" alt="" width="80" height="80">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mx-auto" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-custom active" href="vetpage.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-custom" href="blogs.html">Blogs</a>
                        </li>

                    </ul>
                    <?php
                    try {
                        if (!isset($_SESSION["vloggedin"]) || $_SESSION["vloggedin"] === false) {
                    ?>
                            <div class="d-flex">
                                <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
                                <a href="vetsignup.php"><button class="btn btn-outline-success mx-2" type="submit">Sign Up</button></a>
                                <a href="login.php"><button class="btn btn-outline-success mx-2" type="submit">Sign In</button></a>
                            </div>
                        <?php
                        } else {

                        ?>
                            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="margin-right:80px;">My Profile</button>

                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width: 300px;background-color:powderblue;color:navy;">
                                <div class="offcanvas-header">
                                    <div id="offcanvasRightLabel" style="color:navy;font-weight:bolder;font-size:26px;margin-top:20px;">Welcome <?php echo $_SESSION["vname"] ?></div>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body" style="background-color: powderblue;color:navy;">
                                    <div>
                                        <?php
                                        $qquer = "SELECT `profilepic` from `vets` WHERE `email`='$email'";
                                        $result = mysqli_query($connection, $qquer);
                                        if (mysqli_num_rows($result)) {
                                            while ($rows = mysqli_fetch_assoc($result)) {
                                                if ($rows["profilepic"] == "") {
                                        ?>
                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                                        <input type="text" name="uppic" id="uppic" placeholder="Copy Image URL here.">
                                                        <input type="submit" value="Update">
                                                    </form>

                                                <?php
                                                } else {
                                                ?>

                                                    <img src="<?php echo $rows['profilepic'] ?>" alt="" width="120" height="120" style="display:block;margin-left:5px;">

                                                    <h3 style="color:navy;font-weight:bolder;margin:10px"><?php echo $_SESSION["name"] ?></h3>

                                                    <button style="display: block;margin-top:10px" onclick="updatepic()">Update Profile Pic</button>
                                                    <script>
                                                        function updatepic() {
                                                            document.getElementById("editpic").style.display = "block";
                                                        }
                                                    </script>
                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="editpic" id="editpic" style="display: none;">
                                                        <input type="text" name="uppic" id="uppic" placeholder="Copy Image URL here.">
                                                        <input type="submit" value="Update">
                                                    </form>
                                        <?php
                                                }
                                            }
                                        }

                                        ?>
                                    </div>
                                    <ul style="list-style-type: none;">
                                        <li style="margin:5px;"><a href="#">My Bio</a></li>
                                        <li style="margin:5px;"><a href="#">My Blogs</a></li>
                                        <li style="margin:5px;"><a href="#">Saved Blogs</a></li>
                                        <li style="margin:5px;"><a href="#">Settings</a></li>
                                        <li style="margin:5px;"><a href="vlogout.php">Log Out</a></li>
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
        <?php
        try {
            if (!isset($_SESSION["vloggedin"]) || $_SESSION["vloggedin"] === false) {
        ?>
                <div class="conainer-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col m-5 text-center">
                                Log in First!
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {

            ?>
                <div class="container-fluid mt-2 mb-3">
                    <div class="container" style="background-color:rgb(195, 248, 188);">
                        <div class="row my-2 p-3">
                            <div class="col m-2 p-3" style="border: 2px solid navy;border-radius: 25px;">
                                <h2 class="abtus p-2" style="color: navy;">About Me</h2>
                                <h5 class="abtuss p-2" style="color: rgb(12, 90, 42);">
                                    <?php
                                    $querry = "SELECT `bio` from `vets` WHERE `email`='$email'";
                                    $result = mysqli_query($connection, $querry);
                                    $rows = mysqli_fetch_assoc($result);
                                    if ($rows["bio"] == "") {
                                    ?>
                                        <button style="display: block;margin-top:10px;" onclick="update()">Update Bio</button>
                                        <script>
                                            function update() {
                                                document.getElementById("edit").style.display = "block";
                                            }
                                        </script>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="edit" style="display:none;" id="edit">
                                            <textarea name="upbio" id="upbio" cols="30" rows="3" maxlength="100" placeholder="Update bio"></textarea>
                                            <input type="submit" value="Update" style="display: block;margin:5px">
                                        </form>
                                    <?php
                                    } else {
                                        echo $rows["bio"];

                                    ?>
                                        <button style="display: block;margin-top:10px;" onclick="update()">Update Bio</button>
                                        <script>
                                            function update() {
                                                document.getElementById("edit").style.display = "block";
                                            }
                                        </script>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" name="edit" style="display:none;" id="edit">
                                            <textarea name="upbio" id="upbio" cols="30" rows="3" maxlength="100" placeholder="Update bio"><?php echo $rows["bio"] ?></textarea>
                                            <input type="submit" value="Update" style="display: block;margin:5px">
                                        </form>

                                    <?php
                                    }
                                    ?>
                                </h5>

                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } catch (Exception $e) {
            echo $e;
        }
        ?>
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
                                <a href="#!" name="contactus" style="color: navy;">Call Us: +91 1234112341</a>
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
            <a style="color: navy;" href="home.html">furbabies.com</a>
        </div>
        <!-- Copyright -->



    </footer>
</body>

</html>