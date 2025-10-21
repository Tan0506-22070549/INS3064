<?php
session_start();
$servername = "localhost"; 
$username   = "root";      
$password   = "";           
$dbname     = "LoginReg";   

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['user'] ?? '';
$pass = $_POST['password'] ?? '';

if (empty($name) || empty($pass)) {
    die("Please enter both username and password");
}

$sql_check = "SELECT * FROM userReg WHERE name = ?";
$stmt = $conn->prepare($sql_check);
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Username already exists";
} else {
 
    $sql_insert = "INSERT INTO userReg (name, password) VALUES (?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ss", $name, $pass);

    if ($stmt_insert->execute()) {
        echo "Registration successful";
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$stmt->close();
$conn->close();
?>

