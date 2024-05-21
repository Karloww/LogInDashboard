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

.table-container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 80%;
  margin-bottom: 20px;
}

table {
  border-collapse: collapse;
  width: 80%;
}

th, td {
  border: 1px solid white;
  padding: 8px;
  text-align: center;
}

th {
  background-color: rgba(0, 0, 0, 0.5);
}

td {
  background-color: rgba(0, 0, 0, 0.3);
}

.title {
  text-align: left;
}

button {
  font-family: 'Poppins', sans-serif;
  padding: 5px 10px;
  margin: 0 5px;
  cursor: pointer;
  background-color: white;
  color: black;
  border: none;
  border-radius: 5px;
}

.logout-button {
  background-color: white;
  color: black;
}
</style>
</head>
<body>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "mydb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ID, Username, Email FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='table-container'>
            <header>
                <div class='title'><h2>List of Users</h2></div>
                <button class='logout-button' onclick=\"window.location.href='logInPage.php'\">Logout</button>
            </header>
            <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["ID"]. "</td>
                <td>" . $row["Username"]. "</td>
                <td>" . $row["Email"]. "</td>
                <td>
                    <button onclick='editUser(" . $row["ID"] . ")'>Edit</button>
                    <button onclick='deleteUser(" . $row["ID"] . ")'>Delete</button>
                </td>
            </tr>";
    }
    echo "</table></div>";
} else {
    echo "<div class='table-container'><header><div class='title'><h2>List of Users</h2></div><button class='logout-button' onclick=\"window.location.href='logInPage.php'\">Logout</button></header>0 results</div>";
}

$conn->close();
?>

<script>
function editUser(id) {
    window.location.href = 'edit_user.php?id=' + id;
}

function deleteUser(id) {
    if (confirm('Are you sure you want to delete this user?')) {
        window.location.href = 'delete_user.php?id=' + id;
    }
}
</script>

</body>
</html>