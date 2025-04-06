<?php
session_start();

if (!isset($_SESSION['username'])) {
    die("Not logged in.");
    header("Location: login.php");
}

$username = $_SESSION['username'];

// DB connection (reuse the same one you're using)
$conn = new mysqli("localhost", "root", "root", "DataViz");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_id = $user['id'];

// Check if any threads exist for this user
$stmt = $conn->prepare("SELECT COUNT(*) AS thread_count FROM threads WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data['thread_count'] != 0) {
    header("Location: chat.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | DataViz</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <nav>
        <img src="IMG/logo black.png" id="logo" alt="Logo">
        <div>

            <a href="chat.php">My Threads</a>
            <a href="downloads.php">Downloads</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>
    <div class = "cre">
    <svg id = "whatthe" xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#4C1EE5"><path d="M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160Zm40 200q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
 
    <h2>NO THREADS FOUND.</h2>
  
    <a href = "newthread.php">
    <h1 id ="hero">Create your first thread</h1>
    </a>
    <h1 id ="nothero">Tailor your data to your precise needs.</h1>
    </div>
    


 

</body>

</html>
