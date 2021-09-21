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
    <style>
        select {
            color: navy;
            font-weight: bold;
            height: 30px;
            background: transparent;
            overflow: auto;
            border-radius: 15px;
            padding: 5px;
            border: 1px groove navy;
        }

        select>option> {
            background: transparent;
        }

        input[type=submit],
        input[type=text] {
            border-radius: 15px;
            padding: 2px 10px;
            border: 1px groove navy;
            background: transparent;
        }

        .disabled-link {
            pointer-events: none;
        }

        table,
        th,
        td {
            border: 1px solid lightgray;
            margin: 5px auto;
            color: navy;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            vertical-align: center;
        }
    </style>
</head>

<body style="background-color:rgb(195, 248, 188);">
    <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $pswd = "";
    $db = "petcareusers";
    $email = $_SESSION["pemail"];

    // Create connection
    $connection = mysqli_connect($servername, $username, $pswd, $db);



    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>
    <header style="width: 100%;">
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand navbar-brand-custom" href="#">
                    <img src="assets/img/Screenshot (500).png" alt="" width="80" height="80">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin:0px 440px;font-weight:bolder;color:navy;font-size:30px;">
                    My Cart
                </div>
                <div>
                    <a href="shop.php" class="btn btn-primary ">Back to Shop</a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container fluid my-3">
            <div class="container p-3">
                <?php
                $sql = "SELECT mycart.*,products.* FROM `mycart` INNER JOIN `products` ON mycart.product_id=products.product_id where mycart.email='" . $email . "'";
                $result = mysqli_query($connection, $sql);
                $grandtotal = 0;
                $count = 0;
                $acount = 0;
                $rcount = 0;

                if (mysqli_num_rows($result) > 0) {
                    echo "<table><th>Product ID</th><th>Product</th><th>Name</th><th>Category</th><th>Pet Category</th><th>Quantity</th><th>Amount</th><th>Total Amount</th><th>Remove From Cart</th></tr>";
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $rcount += 1;
                        echo "<tr><td>" . $row["product_id"] . "</td><td><img src='" . $row["product_image"] . "' alt='' width='100' height='100'></td><td>" . $row["product_name"] . "</td><td>" . $row["product_category"] . " </td><td>" . $row["pet_category"] . "</td><td>" . $row["quantity"] . "</td><td>&#8377;" . $row["price"] .  "</td><td>&#8377;" . $row["price"] * $row["quantity"] .  "</td><td><a href=\"delitem.php?product_id=" . $row["product_id"] . "\"><span style='font-size:25px;'><i class='fa fa-trash'></i></span></a></td></tr>";
                        $grandtotal += $row["price"] * $row["quantity"];
                        if ($row["product_category"] === 'Food') {
                            $count = $count + 1;
                        } else if ($row["product_category"] === 'Accessories' || $row["product_category"] === 'Toys') {
                            $acount = $acount + 1;
                        }
                    }
                    if ($count > 0 && $acount == 0) {
                        $dcharge = 29;
                    } else if ($acount > 0 && $count == 0) {
                        $dcharge = 49;
                    } else if ($count > 0 && $acount > 0) {
                        $dcharge = 69;
                    } else if ($count == 0 && $acount == 0) {
                        $dcharge = 0;
                    }
                    $grandtotal+=$dcharge;
                ?>
                    <tr>
                        <td colspan="6" style="font-size:24px;font-weight:bold">Delivery Charges:</td>
                        <td colspan="3" style="font-size:24px;font-weight:bold">&#8377;<?php echo $dcharge; ?></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="font-size:28px;font-weight:bold">Grand Total</td>
                        <td colspan="3" style="font-size:28px;font-weight:bold">&#8377;<?php echo $grandtotal; ?></td>
                    </tr>
                    </table>
                    <div class="row m-3 text-center">
                        <form action="checkout.php">
                            <input type="hidden" name="items" value="<?php echo $rcount;?>">
                            <input type="hidden" name="total" value="<?php echo $grandtotal; ?>">
                            <input type="submit" value="Proceed to Checkout (<?php echo $rcount; ?>)" style="background-color: navy;color:white;padding:5px 10px;">
                        </form>
                    </div>
                <?php
                } else {
                ?><div style="text-align:center;color:navy;font-size:34px;">Heh....Cart Seems Empty</div>
                    <div style="text-align:center;color:navy;font-size:26px;padding-bottom:55px;">Shop Something Now...</div>
                <?php
                }
                ?>
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
            <a style="color: navy;" href="home.html">furbabies.com</a>
        </div>
        <!-- Copyright -->
    </footer>
</body>

</html>