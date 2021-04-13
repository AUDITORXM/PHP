<?php
$servername = "localhost";
$username = "id16239711_root";
$password = "U)l<!b7v?-v23PQ1";
$db = "id16239711_db_broker";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>