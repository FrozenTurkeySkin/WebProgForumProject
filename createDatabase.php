<?php
$hostname = "localhost";
$username = "root";
$password = ""; // the password set in PHPMyAdmin
// Create connection
$conn = mysqli_connect($hostname, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "CREATE DATABASE hmhy";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
mysqli_close($conn);
?>