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

        form {
            margin: 15px 35px;
            font-size: 18px;
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
                    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin:0px 220px;font-weight:bolder;color:navy;font-size:30px;">
                        Furbabies Shop | Order Details
                    </div>
                    <div>
                        <a href="shop.php" class="btn btn-primary ">Back to Shop</a>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["place"])) {
                    $name = $_POST["name"];
                    $address = $_POST["address"];
                    $city = $_POST["city"];
                    $state = $_POST["state"];
                    $pincode = $_POST["pincode"];
                    $amount = $_POST["amount"];
                    $ordertime = $_POST["ordertime"];
                    $paymode = $_POST["paymentmode"];
                    
                    

                    $sql = "INSERT INTO `orders` (`name`, `email`, `address`, `city`, `state`, `pincode`, `amount`, `ordertime`,`paymode`) VALUES ('$name', '$email', '$address', '$city', '$state', '$pincode', '$amount', '$ordertime','$paymode')";
                    if (mysqli_query($connection, $sql)) {
            ?><p style="display: none;">ok</p>
            <?php
                    } else {
                        echo "Error: " . $sql . "<br>" . $connection->error;
                    }
                }
            }
            ?>
            <div class="container-fluid">
                <div class="container">
                    <div class="row" style="color:navy;font-weight:bolder;font-size:26px;text-align:center;">Thanks For Shopping...</div>
                    <?php
                    $que = "SELECT * FROM orders WHERE email='" . $email . "'";
                    $sq="SELECT * FROM products INNER JOIN mycart ON products.product_id = mycart.product_id where email='".$email."'";
                    $res=mysqli_query($connection,$sq);
                    
                    $result = mysqli_query($connection, $que);
                    $roww=mysqli_fetch_assoc($result);
                    if (mysqli_num_rows($result)) {
                        
                    ?>

                            <table>
                                <tr>
                                    <th colspan="4">Order Details</th>
                                </tr>
                                <tr>
                                    <th>Order ID</th>
                                    <td colspan="3"><?php echo $roww["orderid"];?></td>
                                </tr>
                                
                                <tr>
                                    <th>Your Name</th>
                                    <td colspan="3"><?php echo $roww["name"];?></td>
                                </tr>
                                <tr>
                                    <th>Your Email</th>
                                    <td colspan="3"><?php echo $roww["email"];?></td>
                                </tr>
                                <tr>
                                    <th colspan="4">Product Details</th>
                                </tr>
                                <?php
                                if(mysqli_num_rows($res)>0){
                                    while($roow=mysqli_fetch_assoc($res)){
?>
                                <tr>
                                    <td colspan="2"><?php echo $roow["product_name"];?></td>
                                    <td><?php echo $roow["quantity"];?></td>
                                    <td><?php echo $roow["price"];?></td>
                                </tr>
                                <?php
                                    }
                                }?>
                                <tr>
                                    <th>Your Shipping Address</th>
                                    <td><?php echo $roww["address"];?></td>
                                    <td><?php echo $roww["city"];?></td>
                                    <td><?php echo $roww["state"];?></td>
                                </tr>
                                <tr>
                                    <th>Pincode</th>
                                    <td colspan="3"><?php echo $roww["pincode"];?></td>
                                </tr>
                                <tr>
                                    <th>Payment Mode</th>
                                    <td colspan="3"><?php echo $roww["paymode"];?></td>
                                </tr>
                            </table>
                    <?php
                        
                    }?>
                    <div class="row text-center" style="color:navy;font-size:22px;font-weight:bold;text-align:center;">
                        Your Order Will be delivered within a week! <a href="mailto:yashbhimjiyani07@gmail.com">Contact Admin for queries</a>
                    </div>
                    
                </div>
            </div>
        </main>

    <?php
    }
    ?>
</body>
</html>