<?php
// Database connection
$servername = 'database-container';
$username = 'php_test_user'; // Your MySQL username
$password = 'php_user_pass'; // Your MySQL password
$dbname = 'php_mysql_db'; // Your MySQL database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into database
$name = $_POST['name'];
$rollno = $_POST['rollno'];
$year = $_POST['year'];

$sql = "INSERT INTO student (name, rollno, year) VALUES ('$name', '$rollno', '$year')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>