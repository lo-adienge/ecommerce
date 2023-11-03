<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];
    $user_id = $_SESSION["user_id"];

    // Connect to MySQL and insert order data
    $conn = new mysqli("localhost", "username", "password", "ecommerce");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO orders (user_id, product_id, quantity, total_price) VALUES ($user_id, $product_id, $quantity, $total_price)";

    if ($conn->query($sql) === TRUE) {
        echo "Order placed successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

