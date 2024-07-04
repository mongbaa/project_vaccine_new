<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_project_vaccine";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


date_default_timezone_set('Asia/Bangkok');
mysqli_set_charset($conn,"utf8");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>