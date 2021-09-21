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


        input,
        textarea {
            border-radius: 10px;
            padding: 2px 10px;
            border: 1px groove navy;
            background: transparent;
            margin: 15px auto;
            color: navy;
        }

        input[type=submit] {
            color: white;
            background-color: navy;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 10px;

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
            vertical-align: center;
        }

        .col-5 {
            color: navy;
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

    $items = "";
    $total = "";

    // Create connection
    $connection = mysqli_connect($servername, $username, $pswd, $db);



    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (!isset($_SESSION["ploggedin"]) || $_SESSION["ploggedin"] === false) {
    ?><div class="text-center" style="color:navy;font-size:30px;font-weight:bold;text-decoration:underline"> <a href="login.php">Log In First</a></div>;

    <?php
    } else {
        $email = $_SESSION["pemail"];
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
                    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin:0px 260px;font-weight:bolder;color:navy;font-size:30px;">
                        Furbabies Shop | Checkout
                    </div>
                    <div>
                        <a href="viewcart.php" class="btn btn-primary " style="margin-right:55px">My Cart</a>
                    </div>
                    <div>
                        <a href="shop.php" class="btn btn-primary ">Back to Shop</a>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == 'GET') {
                $items = $_GET["items"];
                $total = $_GET["total"];
            }
            ?>
            <?php
                $sql="SELECT address from users WHERE email='".$email."'";
                $result=mysqli_query($connection,$sql);
                if(mysqli_num_rows($result)>0){
                    $rows=mysqli_fetch_assoc($result);
                    $address=$rows["address"];
                }else{
                    $address="";
                }
            ?>
            <div class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-7">
                            <form action="placeorder.php" method="POST">
                                <div class="row text-center" style="margin: 15px 35px;font-size: 18px;">
                                    <input type="text" name="name" id="name" placeholder="Enter Your Name" required>
                                    <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
                                    <textarea name="address" id="address" cols="30" rows="5" maxlength="150" placeholder="Enter Your Shipping Address..." required><?php echo $address;?></textarea>
                                    <input type="text" name="city" id="city" placeholder="Enter Your City" required>
                                    <input type="text" name="state" id="state" placeholder="Enter Your State" required>
                                    <input type="number" name="pincode" id="pincode" placeholder="Enter Your Pincode" required>
                                    <input type="hidden" name="amount" id="amount" value="<?php echo $total;?>" required>
                                    <input type="hidden" name="ordertime" id="ordertime" value="<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y-m-d H:i:s"); ?>">
                                    <input type="hidden" name="paymentmode" id="paymentmode" value="COD">
                                    <input type="submit" value="Place Order" name="place">
                                    <p style="font-size: 16px;font-weight:normal;color:navy">[Note: Payment Mode is Cash On Delivery Only!]</p>
                                </div>
                            </form>
                        </div>
                        <div class="col-5">
                            <table>
                                <tr style="font-weight:bold;font-size:20px">
                                    <h4 style="margin:10px;">
                                        <th colspan="2">Cart</th>
                                        <th><span><i class="fa fa-shopping-cart"></i> <b><?php echo $items; ?></b></span></th>
                                </tr>
                                </h4>
                                <?php
                                $sql = "SELECT mycart.*,products.* FROM `mycart` INNER JOIN `products` ON mycart.product_id=products.product_id where mycart.email='" . $email . "'";
                                $result = mysqli_query($connection, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <td><img src="<?php echo $row['product_image']; ?>" alt="product" height="60" width="60"></td>
                                            <td>
                                                <p><?php echo $row["product_name"]; ?></p>
                                            </td>
                                            <td><span> &#8377;<?php echo $row["price"] * $row["quantity"]; ?></span></td>
                                        </tr>
                                        </p>
                                <?php
                                    }
                                }
                                ?>
                                </form>
                                <tr style="font-weight:bolder;font-size:24px;">
                                    <td colspan="2">
                                        Total<p style="font-size: small;">[Incl. Delivery Charges]</p>
                                    </td>
                                    <td><span><b>&#8377;<?php echo $total; ?></b></span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </main>
    <?php
    }
    ?>
</body>