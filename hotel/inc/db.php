<?php
session_start();

$servername = "localhost"; 
$username = "root";  // Default XAMPP MySQL username
$password = "";      // Default XAMPP MySQL password (empty)
$database = "hhh_db";

// Creating a connection
$con = mysqli_connect($servername, $username, $password, $database);

// Checking the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>