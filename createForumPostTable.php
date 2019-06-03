<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "hmhy";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " .mysqli_connect_error());
}

$sql = "CREATE TABLE user_Post (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`topic` VARCHAR(255) NOT NULL,
`details` LONGTEXT NOT NULL,
`created_by` VARCHAR(50) NOT NULL,
`datetime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($conn, $sql)) {
    echo "Table Post Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}  
