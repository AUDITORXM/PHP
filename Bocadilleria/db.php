<?php
$servername = "localhost";
$username = "id16239711_admin";
$password = "mcc|0yXObVkyw%Pn";
$db = "id16239711_db_bocadilleria";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>