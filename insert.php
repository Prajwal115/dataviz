<?php
// 1) Connect to MySQL (localhost) with database "DataViz"
$servername = "localhost";
$username = "root"; // default for MAMP
$password = "root"; // default for MAMP (change if you customized it)
$dbname = "DataViz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$user = $_POST['username'];
$pass = $_POST['password'];

$user = $conn->real_escape_string($user);


$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);


$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $user, $hashedPassword);

if ($stmt->execute()) {
    //Start session and store username
    session_start();
    $_SESSION['username'] = $user;

    echo "Signup successful! Welcome, " . htmlspecialchars($user);
    header("Location: home.php");
} else {
    echo "Error: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>