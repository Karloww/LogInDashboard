<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "mydb"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function addUser($username, $password, $email) {
    global $conn;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
    $sql = "INSERT INTO user (Username, Password, Email) VALUES ('$username', '$hashed_password', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "New user added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


function getUserByEmail($email) {
    global $conn;
    $sql = "SELECT * FROM user WHERE Email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}


function getUserByUsername($username) {
    global $conn;
    $sql = "SELECT * FROM user WHERE Username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}


function deleteUser($id) {
    global $conn;
    $sql = "DELETE FROM user WHERE `ID#`=$id";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
}


function updateUser($id, $username, $password, $email) {
    global $conn;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
    $sql = "UPDATE user SET Username='$username', Password='$hashed_password', Email='$email' WHERE `ID#`=$id";
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . $conn->error;
    }
}


function selectUsers() {
    global $conn;
    $sql = "SELECT `ID#`, Username, Email FROM user";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        while($row = $result->fetch_assoc()) {
            echo "ID#: " . $row["ID#"]. " - Username: " . $row["Username"]. " - Email: " . $row["Email"]. "<br>";
        }
    } else {
        echo "0 results";
    }
}
?>
