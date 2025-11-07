<?php
$servername = "localhost";
$username = "root";  // default in XAMPP/WAMP
$password = "";      // default in XAMPP/WAMP
$dbname = "technova_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Database Connection Failed: " . $conn->connect_error);
}
?>
