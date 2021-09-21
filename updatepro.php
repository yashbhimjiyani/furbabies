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
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petcareusers";
    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    
        if(isset($_REQUEST["product_id"])){
            if($_SERVER['REQUEST_METHOD']=="POST"){
                if(isset($_POST["submit"])){
                $name=$_POST['product_name'];
                $stock=$_POST['product_stock'];
                $img=$_POST["product_image"];
                $price=$_POST["product_price"];
                $id=$_REQUEST['product_id'];
                $sql="UPDATE products set product_name='".$name."',product_stock='".$stock."',product_price='".$price."',product_image='".$img."' WHERE product_id=".$id;

                if ($connection->query($sql) === TRUE) {
                    echo "Record Updated successfully";
                    header("Location: http://localhost/furbabies/web/admin.php");
                } else {
                    echo "Error Updating record: " . $connection->error;
                }
            }
        }
        }
    ?>
        <form action="" method="POST">
            <?php
                $quer="SELECT * FROM products WHERE product_id=".$_REQUEST["product_id"];
                $result = mysqli_query($connection, $quer);
                $rows = mysqli_fetch_assoc($result);
            ?>
            <label for="product_name">Update Product Name</label>
            <input type="text" name="product_name" id="product_name" value=<?php echo $rows["product_name"];?>><br>
            <label for="product_image">Update Image</label>
            <input type="text" name="product_image" id="product_image" value=<?php echo $rows["product_image"];?>><br>
            
            <label for="product_stock">Update stock</label>
            <input type="number" name="product_stock" id="product_stock" value=<?php echo $rows["product_stock"];?>><br>
            <label for="product_price">Update price</label>
            <input type="number" name="product_price" id="product_price" value=<?php echo $rows["product_price"];?>><br>
            <input type="submit" value="Update" name="submit">
        </form>
</body>

</html>