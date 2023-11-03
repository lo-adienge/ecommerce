<?php
session_start();
$user_id = $_SESSION["user_id"];

// Connect to MySQL and fetch cart items for the logged-in user
$conn = new mysqli("localhost", "username", "password", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM cart WHERE user_id=$user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $product_id = $row["product_id"];
        $quantity = $row["quantity"];

        // Fetch product details from 'products' table and display them
        $product_sql = "SELECT * FROM products WHERE id=$product_id";
        $product_result = $conn->query($product_sql);

        if ($product_result->num_rows > 0) {
            $product_row = $product_result->fetch_assoc();
            echo "Product Name: " . $product_row["name"] . ", Quantity: " . $quantity . "<br>";
        }
    }
} else {
    echo "No items in the cart";
}

$conn->close();
?>

