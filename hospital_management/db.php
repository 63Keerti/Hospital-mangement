<?php
$host = "localhost";
$user = "root";
$pass = ""; // default XAMPP password
$db   = "hospital_db";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Optional: set character set to UTF-8 for proper encoding
mysqli_set_charset($conn, "utf8");

?>
