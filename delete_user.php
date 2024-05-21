<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mydb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $sql = "DELETE FROM user WHERE ID = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: landing_page.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
