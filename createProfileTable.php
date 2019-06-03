<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "hmhy";

$conn = mysqli_connect($hostname, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " .mysqli_connect_error());
}

$sql = "CREATE TABLE user_Profile ( 
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`profile picture` LONGBLOB NOT NULL,
`username` VARCHAR(50) NOT NULL UNIQUE,
`email` VARCHAR(50) NOT NULL UNIQUE,
`password` VARCHAR(50) NOT NULL UNIQUE,
`passwordHashed` VARCHAR(255) NOT NULL,
`birthday` DATE NOT NULL,
`Occupation` VARCHAR(50) NOT NULL,
PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($conn, $sql)) {
	echo "Table profile has been successfully created.";
}else{
	echo "Error creating table: " .mysqli_error($conn);
}