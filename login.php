<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}
?>
<html>
    <head>
        <title>Login | DataViz</title>
        <link rel="stylesheet" href = "CSS/login.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

    <body>
    
        <form id = "login" action="process.php" method="POST">
            <div class = "left" id = "left">
                <img id = "abstract" src = "IMG/pattern.png">
            </div>
            <div class = "right" id = "right">
                <div class = "fields" id = "fields">
                <h1>Login</h1>
                <h2>Use an existing account to sign in. <text>Forgot your password?</text> <strong>Click here.</strong></h2>

                <label for="username">Enter your Username:</label>
                <input type="text" name="username" id="username">
                <label for="password">Enter your Password:</label>
                <input type="password" name="password" id="password">

                <input type="submit" name="submit" id="submit">
                <h2><text>Don't have an account?</text> <a href = "register.php"><strong>Register here.</strong></a></h2>    
            </div>

            </div>
        </form>
    </body>
</html>