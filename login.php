<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_phone = $_POST["email_phone"];
    $password = $_POST["password"];

    // Connect to MySQL and check user credentials
    $conn = new mysqli("localhost", "username", "password", "ecommerce");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE email='$email_phone' OR phone='$email_phone'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            echo "Login successful";
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }

    $conn->close();
}
?>

