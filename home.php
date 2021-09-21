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

<body style="background-image: url('assets/img/ images\ \(1\).jpg');background-position: center;">
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
    
    $upppic = "";
    $email=$_SESSION["pemail"];
    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["upppic"])) {
                $upppic = $_POST["upppic"];
                $quere = "UPDATE `users` SET `profilepic` = '$upppic' WHERE `email`='$email'";
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
                            <a class="nav-link nav-link-custom active" href="home.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-custom" href="vet.php">Veterinary</a>
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
                            <a class="nav-link nav-link-custom" href="#faqs">FAQs</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-custom" href="#contactus">Contact Us</a>
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
                            $email=$_SESSION["pemail"];
                            $name=$_SESSION["pname"];

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

                                                    <h3 style="color:navy;font-weight:bolder;margin:10px"><?php echo $_SESSION["pname"] ?></h3>

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
        <div id="carouselExampleCaptions" class="carousel slide container" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            <div class="carousel-inner m-2" style="background-color: powderblue;">
                <div class="carousel-item active">
                    <img src="assets/img/vets_team.jpg" class="d-block w-100" alt="vet team">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="caroh" style="color: navy;font-weight: bolder;">Our Vet Team</h5>
                        <p class="carop" style="color: green;font-weight: bolder;">Consult through chat our Veteritary
                            team even at emergency</p>
                        <a href="vet.php"><button class="buttonn">Consult Now</button></a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/pet_appointment.jpg" class="d-block w-100" alt="book appoitment in pet hospital">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="caroh" style="color:navy;font-weight: bolder;">Book Appointment in hospital
                            near you</h5>
                        <p class="carop" style="color: green;font-weight: bolder;">Find the nearest hospitals/clinics and book an appointment</p>
                        <a href="hospital.php"><button class="buttonn">Appoint Now</button></a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/pet_shop.jpg" class="d-block w-100" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="caroh" style="color: navy;font-weight: bolder;">Online Shopping</h5>
                        <p class="carop" style="color: green;font-weight: bolder;">Shop food, medicines and lot more
                            24x7 for your pets online</p>
                        <a href="shop.php"><button class="buttonn">Shop Now</button></a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/pet_blogs.jpg" class="d-block w-100" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="caroh" style="color:navy; font-weight: bolder;">Blogs</h5>
                        <p class="carop" style="color: green; font-weight: bolder;">Read blogs for your better pet
                            parenting and care</p>
                        <a href="blogs.html"><button class="buttonn">Explore Now</button></a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/img/pet_Services.jpg" class="d-block w-100" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class="caroh" style="color:navy; font-weight: bolder;">Services</h5>
                        <p class="carop" style="color: green; font-weight: bolder;">Get benefits of various services and
                            book an appointment now</p>
                        <a href="services.php"><button class="buttonn">Book Now</button></a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container fluid" style="background-color:rgb(195, 248, 188);">
            <div class="container">
                <div class="row p-4">
                    <div class="col">
                        <h2 class="text-center" style="color:navy;font-weight:500;text-shadow:2px 2px lightblue;"> with vets/doctors anytime for your pets</h2>
                    </div>
                </div>
                <div class="row text-white m-2">
                    <div class="col-3 card m-2" style="width: 15rem;background: transparent;">
                        <img src="assets/img/dr1.jpg" class="card-img-top" alt="..." height="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: navy;font-weight: bold;">Dr. Jain</h5>
                            <p class="card-text" style="color: darkslategray;font-weight: bolder;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary ">Consult Now</a>
                        </div>
                    </div>
                    <div class="col-3 card m-2" style="width: 15rem;background: transparent;">
                        <img src="assets/img/dr2.jpg" class="card-img-top" alt="..." height="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: navy;font-weight: bold;">Dr. Pandya</h5>
                            <p class="card-text" style="color: darkslategray;font-weight: bolder;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary ">Consult Now</a>
                        </div>
                    </div>
                    <div class="col-3 card m-2" style="width: 15rem;background: transparent;">
                        <img src="assets/img/dr3.jpg" class="card-img-top" alt="..." height="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: navy;font-weight: bold;">Dr. Tanna</h5>
                            <p class="card-text" style="color: darkslategray;font-weight: bolder;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary ">Consult Now</a>
                        </div>
                    </div>
                    <div class="col-3 card m-2" style="width: 15rem;background: transparent;">
                        <img src="assets/img/dr4.jpg" class="card-img-top" alt="..." height="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: navy;font-weight: bold;">Dr. Joshi</h5>
                            <p class="card-text" style="color: darkslategray;font-weight: bolder;">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary ">Consult Now</a>
                        </div>
                    </div>
                </div>
                <div class="row mx-auto pb-4" style="width: auto;margin-top:25px;margin-bottom: 30px;">
                    <a href="assets/img/vet.html" class="btn btn-primary ">View More</a>
                </div>
            </div>
        </div>
        <div class="container fluid mt-2" style="background-color:powderblue; background-repeat: no-repeat;background-size: cover;background-origin: content-box;">
            <div class="container">
                <div class="row p-4">
                    <h2 class="text-center mainheading" style="color: navy;">Furbabies Shop</h2>
                    <h5 class="text-center ">Shop Latest collection of pet accessories and Big-branded Food
                        items and much more</h5>
                </div>
                <div class="row text-white m-2">
                    <div class="col-3 card m-2" style="width: 15rem;background: transparent;">
                        <img src="assets/img/pedigree.jpg" class="card-img-top" alt="..." height="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: navy;font-weight: bold;">Shop branded pet foods</h5>
                            <p class="card-text" style="color: darkslategray;font-weight: bolder;">35% off on 50+ food brands</p>
                            <a href="#" class="btn btn-primary ">Shop Now</a>
                        </div>
                    </div>
                    <div class="col-2 card m-2" style="width: 15rem;background: transparent;">
                        <img src="assets/img/pet_accessories.jpg" class="card-img-top" alt="..." height="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: navy;font-weight: bold;">Shop Pet Accessories</h5>
                            <p class="card-text" style="color: darkslategray;font-weight: bolder;">50% off on pet accessories</p>
                            <a href="#" class="btn btn-primary ">Shop Now</a>
                        </div>
                    </div>
                    <div class="col-3 card m-2" style="width: 15rem;background: transparent;">
                        <img src="assets/img/pet_toys.jpg" class="card-img-top" alt="..." height="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: navy;font-weight: bold;">Shop Amazing Pet Toys</h5>
                            <p class="card-text" style="color: darkslategray;font-weight: bolder;">25% off on Amazing Pet Toys</p>
                            <a href="#" class="btn btn-primary ">Shop Now</a>
                        </div>
                    </div>
                    <div class="col-4 card m-2" style="width: 15rem;background: transparent;">
                        <img src="assets/img/pet_medicine.jpg" class="card-img-top" alt="..." height="200px">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="color: navy;font-weight: bold;">Shop Medicines and other pets medicare</h5>
                            <p class="card-text" style="color: darkslategray;font-weight: bolder;">20% off on Healthcare products 24x7</p>
                            <a href="#" class="btn btn-primary ">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="row mx-auto pb-4" style="width: auto;">
                    <a href="shop.html" class="btn btn-primary ">View More</a>
                </div>
            </div>
        </div>
        <a href="#faqs" name="faqs">
            <div class="container-fluid mt-2 mb-3">
                <div class="container" style="background-color:rgb(195, 248, 188);">
                    <div class="row my-2 p-3">
                        <div class="col-4 m-2 p-3" style="border: 2px solid navy;border-radius: 25px;">
                            <h2 class="abtus p-2" style="color: navy;">Why Us?</h2>
                            <h5 class="abtuss p-2" style="color: rgb(12, 90, 42);">Passionate and Energetic about our work
                            </h5>
                        </div>
                        <div class="col-7 m-2 p-3" style="border: 2px solid navy;border-radius: 25px;">
                            <h2 class="abtus2 p-2" style="color: navy;">Who We Are...</h2>
                            <h5 class="abtus2s p-2" style="color:rgb(12, 90, 42);">A Strong, Self-less, Confident and handy
                                team, looking forward to help care
                                and nurture your lovely pets effortlessly and a will to provide satisfactorial services to
                                the pet parents</h5>
                        </div>
                    </div>
                    <div class="row m-2 p-3" style="border-bottom: 5px solid navy;border-left: 5px solid navy;">
                        <div class="col">
                            <h3 style="color: navy;">Some of our popular & successful clients</h3>
                        </div>
                    </div>

                    <div class="row p-3">
                        <div class="col-4 card m-2 p-3" style="background: transparent;padding: 5px;border-bottom:none;">
                            <h5 class="parname card-title" style="color: navy;text-align: center;">Mr. Thakkar</h5>
                            <img src="assets/img/client1.jpg" class="card-img-top" alt="..." height="170px">
                        </div>
                        <div class="col card m-5 pt-5" style="background: transparent;">
                            <q class="parnamedet card-text" style="color: rgb(12, 90, 42);font-weight:500;display: inline-block;"> Furbabies is an awesome
                                platform for pet parents to consult immediately for pets and shop
                                whenever we want. </q>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col card m-5 pt-5" style="background: transparent;">
                            <q class="parnamedet card-text" style="color: rgb(12, 90, 42);font-weight:500;display: inline-block;"> I've
                                always had worries and anxious about my dog's fitness and health but
                                after using furbabies' several services I'm relieved </q>
                        </div>
                        <div class="col-4 card m-2 p-3" style="background: transparent;;padding: 5px;border-bottom:none;background: transparent;">
                            <h5 class="parname card-title" style="color: navy;text-align: center;">Mr. Shah</h5>
                            <img src="assets/img/client2.jpg" class="card-img-top" alt="..." height="170px">
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-4 card m-2 p-3" style="background: transparent;padding: 5px;border-bottom:none;">
                            <h5 class="parname card-title" style="color: navy;text-align: center;">Mr. & Mrs. Patel</h5>
                            <img src="assets/img/client3.jpg" class="card-img-top" alt="..." height="170px">
                        </div>
                        <div class="col card m-5 pt-5" style="background: transparent;">
                            <q class="parnamedet card-text" style="color: rgb(12, 90, 42);font-weight:500;display: inline-block;">I've
                                always had worries and anxious about my dog's fitness and health but
                                after using furbabies' several services I'm relieved</q>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col card m-5 pt-5" style="background: transparent;">
                            <q class="parnamedet card-text" style="color: rgb(12, 90, 42);font-weight:500;display: inline-block;">I've
                                always had worries and anxious about my dog's fitness and health but
                                after using furbabies' several services I'm relieved</q>
                        </div>
                        <div class="col-4 card m-2 p-3" style="background: transparent;padding: 5px;border-bottom:none;">
                            <h5 class="parname card-title" style="color: navy;text-align: center;">Ms. Sharma</h5>
                            <img src="assets/img/client4.jpg" class="card-img-top" alt="..." height="170px">
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </main>
    <!-- Footer -->
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
            <a style="color: navy;" href="home.php">furbabies</a>
        </div>
        <!-- Copyright -->



    </footer>
    <!-- Footer -->
</body>

</html>