<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $username = $_POST["uname"];
  $password = $_POST["psw"];

  
  $existingUser = getUserByEmail($email);
  if ($existingUser) {
      $error = "Email already exists!";
  } else {
      
      addUser($username, $password, $email);
      header("Location: logInPage.php");
      exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
<style>
  h2 {
    text-align: center;
  }
</style>
</head>
<body>
<h2>Register</h2>
<form method="post">
  <div class="container">
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <button type="submit">Register</button>
    
    <?php if(isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
    <div class="login-text">
      Already have an account? <a href="logInPage.php">Login</a>
    </div>
  </div>
</form>
</body>
</html>
