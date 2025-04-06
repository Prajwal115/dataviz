<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}
?>
<html>
    <head>
        <title>Register | DataViz</title>
        <link rel="stylesheet" href = "CSS/register.css">
</head>

    <body>
        <form onsubmit = "return validatePasswords()" id = "register" action="insert.php" method="POST">
            <div class = "left" id = "left">
                <img id = "abstract" src = "IMG/pattern.png">
            </div>
            <div class = "right" id = "right">
                <div class = "fields" id = "fields">
                <h1>Register</h1>
                <h2>Create a new account to use our services.</h2>

                <label for="username">Enter your Username:</label>
                <input type="text" name="username" id="username">
                <label for="password">Create your Password:</label>
                <input type="password" name="password" id="password">
                <label for="cpassword">Confirm your Password:</label>
                <input type="password" name="cpassword" id="cpassword">
                <input type="submit" name="submit" id="submit">
                <h2><text>Already have an account?</text> <a href = "login.php"><strong>Login here.</strong></a></h2>    
            </div>

            </div>
        </form>

        <script>
            function validatePasswords() {
  const password = document.getElementById("password").value;
  const cpassword = document.getElementById("cpassword").value;

  if (password !== cpassword) {
    alert("Passwords do not match!");
    return false;
  }
  return true;
}
        </script>
    </body>
</html>