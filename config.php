<?php
// Database configuration
$servername = "localhost";
$username   = "root";      // default XAMPP username
$password   = "";          // default XAMPP has empty password
$dbname     = "stylehub";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
