<?php
// Database connection
$host = "localhost";
$dbname = "udyog"; // Replace with your actual DB name
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize inputs
$full_name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$subject = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);

// Insert query
$sql = "INSERT INTO contact_messages (full_name, email, phone, subject, message)
        VALUES ('$full_name', '$email', '$phone', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Message sent successfully!'); window.location.href='thankyou.html';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
