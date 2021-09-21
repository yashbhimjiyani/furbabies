<?php
if (isset($_GET["product_id"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "petcareusers";
    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $id = $_GET["product_id"];
    $sql = "DELETE FROM mycart WHERE product_id=" . $id;
    if ($connection->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: http://localhost/furbabies/web/viewcart.php");
    } else {
        echo "Error deleting record: " . $connection->error;
    }
} else {
    echo $_GET["product_id"] ?? null;
    header("location:viewcart.php");
}
