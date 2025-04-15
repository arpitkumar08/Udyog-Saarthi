<?php
$host = "localhost";
$dbname = "udyog";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = htmlspecialchars($_POST['email']);
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($pass, $user['password'])) {
        echo "<script>alert('Login successful!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Incorrect password'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('User not found'); window.history.back();</script>";
}

$conn->close();
?>
