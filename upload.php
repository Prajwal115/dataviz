<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['username'])) {
    die("Not logged in.");
}

$username = $_SESSION['username'];
$targetDir = "res/" . $username;

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// ✅ Direct DB connection
$servername = "localhost";
$db_username = "root";
$db_password = "root"; // change if needed
$dbname = "DataViz"; // or your actual DB name

$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_FILES["file"]["error"] === UPLOAD_ERR_OK) {
    $filename = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . "/" . $filename;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // Write path to haha.txt
        file_put_contents("haha.txt", $targetFilePath);

        // ✅ Get user ID
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        if (!$stmt) {
            die("Prepare failed (user lookup): " . $conn->error);
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $user_id = $user['id'];

        // ✅ Create new thread
        $stmt = $conn->prepare("INSERT INTO threads (user_id, title, created_at) VALUES (?, ?, NOW())");
        if (!$stmt) {
            die("Prepare failed (insert thread): " . $conn->error);
        }
        $stmt->bind_param("is", $user_id, $filename);
        $stmt->execute();
        $thread_id = $conn->insert_id;

        // ✅ Insert first AI message
        $first_msg = "File Uploaded: $filename";
        $stmt = $conn->prepare("INSERT INTO messages (thread_id, sender, message, created_at) VALUES (?, 'ai', ?, NOW())");        if (!$stmt) {
            die("Prepare failed (insert AI message): " . $conn->error);
        }
        $stmt->bind_param("is", $thread_id, $first_msg);
        $stmt->execute();

        // ✅ Redirect to chat.php with thread ID
        $_SESSION['thread_id']=$thread_id;
        header("Location: chat.php?thread_id=$thread_id");
        exit();
    } else {
        echo "Error moving the uploaded file.";
    }
} else {
    echo "Upload failed. Error code: " . $_FILES["file"]["error"];
}
?>