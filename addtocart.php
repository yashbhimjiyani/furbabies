<?php
session_start();
$email = $_SESSION["pemail"];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petcareusers";
$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


if (isset($_REQUEST["product_id"]) || isset($_REQUEST["quantity"])) {
    $pid = $_REQUEST["product_id"];
    $quantity = (int)$_REQUEST["quantity"];
    $price = $_REQUEST["price"];
    $sel = "SELECT * FROM `mycart` WHERE email='" . $email . "' AND product_id=" . $pid;
    $result = mysqli_query($connection, $sel);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $quantity = $quantity + (int)$row["quantity"];
        $sql = "UPDATE `mycart` SET quantity='" . $quantity . "' WHERE product_id=" . $pid . " AND email='" . $email . "'";
        if ($connection->query($sql) === TRUE) {
            header("location:shop.php?q=Added to cart successfully!");
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    } else {

        $sql = "INSERT INTO `mycart` (`email`, `product_id`,`quantity`,`price`) VALUES ('$email', '$pid','$quantity','$price')";
        if ($connection->query($sql) === TRUE) {
            header("location:shop.php?q=Added to cart successfully!");
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }
}
