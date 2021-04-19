<?php
$servername = "localhost";
$username = "usuario1";
$password = "usuario1";
$db = "Kevin";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>