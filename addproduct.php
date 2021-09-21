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
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["aloggedin"])) {
        echo "You do not have right to access this page";
    } else {
        

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
                                <a class="nav-link nav-link-custom active" href="addproduct.php">Home</a>
                            </li>
                            <li class="nav-item mx-2">
                                <a class="nav-link nav-link-custom" href="admin.php">Show Products</a>
                            </li>
                            <li class="nav-item mx-2">
                            <li class="nav-item mx-2"><a class="nav-link nav-link-custom" href="alogout.php">Log Out</a></li>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container " style="margin-top:50px;">
                <h2 style="margin-bottom:20px;">Fill Product Details and add to Store</h2>
                <form action="" method="POST">
                    Product Name: <input type="text" name="pname" id="pname"><br><br>
                    Product Category: <input type="text" name="pcategory" id="pcategory"><br><br>
                    Pet Category: <input type="text" name="prcategory" id="prcategory"><br><br>
                    Product Price: <input type="number" name="price" id="price"><br><br>
                    Product Stock: <input type="number" name="pstock" id="pstock"><br><br>
                    Product Image: <input type="text" name="pimg" id="pimg"><br><br>
                    <input type="submit" value="Add Product">
                </form>
            </div>
        </main>
    <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "petcareusers";
        $connection = new mysqli($servername, $username, $password, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }



        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pname = $_REQUEST["pname"];
            $pcategory = $_REQUEST["pcategory"];
            $prcategory = $_REQUEST["prcategory"];
            $price = $_REQUEST["price"];
            $pstock = $_REQUEST["pstock"];
            $pimg = $_REQUEST["pimg"];



            $query = "INSERT INTO `products` (`product_name`, `product_category`,`pet_category`,`product_price`,`product_stock`,`product_image`) VALUES ('$pname', '$pcategory','$prcategory',$price,$pstock,'$pimg')";

            if ($connection->query($query) === TRUE) {
                echo "New record inserted successfully";
            } else {
                echo "Error: " . $query . "<br>" . $connection->error;
            }
        }
    }
    ?>

</body>

</html>