<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "hmhy";


$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " .mysqli_connect_error());
}

$sql = "CREATE TABLE registered_Users (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`userName` VARCHAR(50) NOT NULL UNIQUE,
`email` VARCHAR(50) NOT NULL UNIQUE,
`password` VARCHAR(50) NOT NULL UNIQUE,
`passwordHashed` VARCHAR(255) NOT NULL,
`created_Date_Time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($conn, $sql)) {
    echo "Table signUp created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>