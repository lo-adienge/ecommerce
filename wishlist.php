<?php
session_start();
$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];

    // Connect to MySQL and insert wishlist item
    $conn = new mysqli("localhost", "username", "password", "ecommerce");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO wishlist (user_id, product_id) VALUES ($user_id, $product_id)";

    if ($conn->query($sql) === TRUE) {
        echo "Product added to wishlist successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

