<?php include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["psw"];

    $user = getUserByUsername($username);

    if ($user && password_verify($password, $user['Password'])) {
        $_SESSION["username"] = $user["Username"];
        
        header("Location: landing_page.php");
        exit();
    } else {
        $error = "Invalid username or password!";
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
  input[type="text"], input[type="password"] {
    color: black;
  }
</style>
</head>
<body>
<h2>Please Login</h2>
<form id="loginForm" method="post">
  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <button type="submit">Login</button>
   
    <?php if(isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>
    <div class="registration-text">
      Don't have an account yet? <a href="register.php">Register</a>
    </div>
  </div>
</form>
</body>
</html>
