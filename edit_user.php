<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mydb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = '';
$username = '';
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $sql = "SELECT * FROM user WHERE ID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (isset($row["Username"])) {
            $username = $row["Username"];
        }
        if (isset($row["Email"])) {
            $email = $row["Email"];
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = intval($_POST["id"]);
    $username = $_POST["username"];
    $email = $_POST["email"];
    
    $sql = "UPDATE user SET Username='$username', Email='$email' WHERE ID=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: landing_page.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: url('https://img.freepik.com/free-photo/artistic-blurry-colorful-wallpaper-background_58702-8553.jpg?size=626&ext=jpg&ga=GA1.1.553209589.1715040000&semt=ais') no-repeat center center fixed;
  background-size: cover;
  color: whitesmoke;
  text-align: center;
  padding-top: 50px;
}

.form-container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

form {
  background-color: rgba(0, 0, 0, 0.5);
  padding: 20px;
  border-radius: 10px;
  width: 50%;
  box-sizing: border-box;
}

label {
  display: block;
  text-align: left;
  margin-bottom: 5px;
}

input[type="text"], input[type="email"] {
  width: calc(100% - 22px);
  padding: 10px;
  margin-bottom: 20px;
  border: none;
  border-radius: 5px;
  box-sizing: border-box;
}

button {
  padding: 10px 20px;
  cursor: pointer;
  background-color: white;
  color: black;
  border: none;
  border-radius: 5px;
  font-family: 'Poppins', sans-serif;
}

.cancel-button {
  background-color: white;
  color: black;
}

.button-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

h2 {
  margin-bottom: 20px;
}
</style>
</head>
<body>

<div class="form-container">
  <h2>Edit User</h2>
  <form method="post" action="edit_user.php">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
      <div class="button-container">
        <button type="button" class="cancel-button" onclick="window.location.href='landing_page.php'">Cancel</button>
        <button type="submit">Update</button>
      </div>
  </form>
</div>

</body>
</html>