<?php
session_start();

// 1) Connect to MySQL
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "root";
$dbname = "DataViz";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user = $_POST['username'];
$pass = $_POST['password'];

$user = $conn->real_escape_string($user);

// 4) Prepare and execute query to fetch hashed password
$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

 
    if (password_verify($pass, $hashedPassword)) {
        $_SESSION['username'] = $user;
        echo "Login successful! Welcome, " . htmlspecialchars($user);
        header("Location: home.php");
        exit();
    } else {
        echo "❌ Incorrect password.";
    }
} else {
    echo "❌ Username not found.";
}


$stmt->close();
$conn->close();
?>