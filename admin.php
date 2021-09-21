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
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            margin: 5px auto;
        }

        th,
        td {
            padding: 10px;
        }

        select {
            color: navy;
            font-weight: bold;
            height: 30px;
            background: transparent;
            overflow: auto;
            margin:5px 20px;
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
            padding: 5px 10px;
            border: 1px groove navy;
            background: transparent;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION["aloggedin"])) {


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
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  mb-2 mb-lg-0 mx-auto">
                            <li class="nav-item">
                                <h2 style="text-align: center;color: navy;"> Admin Product Management</h2>
                            </li>
                            <li class="nav-item " style="right:165px;position:absolute">
                                <a class="nav-link nav-link-custom" href="addproduct.php" style="border: 1px solid navy;background:transparent;border-radius:7px;padding:5px 10px">Add Product(s)</a>
                            </li>
                            <li class="nav-item mx-2" style="right:45px;position:absolute">
                                <a class="nav-link nav-link-custom" href="alogout.php" style="border: 1px solid navy;background:transparent;border-radius:7px;padding:5px 10px">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="container " style="margin-top:30px;text-align:center;">
                <?php

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "petcareusers";
                $condition="1=1";
                
                $age=$category="";
                $search="";
                $connection = new mysqli($servername, $username, $password, $dbname);
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }


                ?>
                <h2 style="text-align:center;color:green;margin:5px;">Available Products In Store</h2>
                <form action="">
                    <input type="text" name="searchitem" id="search" placeholder="Search product...">
                    <input type="submit" value="Search" name="search">
                </form>
                <form action="">
                    <select name="product_category" id="product_category">
                        <option value="Product Category" selected disabled>Product Category</option>
                        <option value="Food">Food</option>
                        <option value="Toys">Toys</option>
                        <option value="Accessories">Accessories</option>
                        <option value="Medicines">Medicines</option>
                    </select>
                    <select name="pet_category" id="pet_category">
                            <option value="Pet Category" selected disabled>Pet Category</option>
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
                    
                    <input type="submit" value="Apply" name="submit">
                    <input type="submit" value="clear" name="clear">
                </form>
                
            <?php
            try {
                if($_SERVER["REQUEST_METHOD"]=="GET"){
                    
                    if(isset($_GET["search"])){
                        if(isset($_GET["searchitem"])){
                            $search=$_GET["searchitem"];
                            $condition="product_name LIKE '%".$search."%'";
                        }
                    }
                else if (isset($_GET["submit"])) {

                    if (isset($_GET["pet_category"]) || !(isset($_GET["product_category"]))) {
                        $pcategory = $_GET["pet_category"];
                        $condition = "`pet_category`='" . $pcategory . "'";
                    } else if (isset($_GET["product_category"]) || !(isset($_GET["pet_category"]))) {
                        
                        $category = $_GET["product_category"];
                        $condition = "`product_category`='" . $category . "'";
                    }
                    
                    if (isset($_GET["product_category"]) && isset($_GET["pet_category"])) {
                        $category = $_GET["product_category"];
                        $pcategory = $_GET["pet_category"];
                        $condition = "`product_category`='" . $category . "' AND `pet_category`='" . $pcategory . "'";
                    }
                }
                if (isset($_GET["clear"])) {
                    $condition = "1=1";
                }
                    $sql = "SELECT * FROM `products` where ".$condition;
                    $result = mysqli_query($connection, $sql);
                    echo "<table><tr><th>Product ID</th><th>Product</th><th>Name</th><th>Category</th><th>Pet Category</th><th>Price</th><th>Stock</th><th>Delete</th><th>Update</th></tr>";

                    if (mysqli_num_rows($result)>0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr><td>" . $row["product_id"] . "</td><td><img src='" . $row["product_image"] ."' alt='pedigree' width='70' height='70'></td><td>" . $row["product_name"] . "</td><td>" . $row["product_category"] ." </td><td>" . $row["pet_category"] . "</td><td>" . $row["product_price"] . "</td><td>" . $row["product_stock"] .  "</td><td><a href=\"delpro.php?product_id=" . $row["product_id"] . "\">Delete</a></td><td><a href=\"updatepro.php?product_id=" . $row["product_id"] . "\">Update</a></td></tr>";
                        }
                    }else{
                        echo "No Results!";
                    }
                }
            } catch (Exception $e) {
                echo "";
            }
        }else{
            echo "You have no access to this page!!";
        }
            ?>
        </main>
</body>

</html>