<?php
session_start();
$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST["message"];

    // Connect to MySQL and insert notification
    $conn = new mysqli("localhost", "username", "password", "ecommerce");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO notifications (user_id, message) VALUES ($user_id, '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Notification sent successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

