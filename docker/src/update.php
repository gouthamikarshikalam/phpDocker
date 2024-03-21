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

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $rollno = $_POST['rollno'];
    $year = $_POST['year'];

    // Update student details in the database
    $sql = "UPDATE student SET name='$name', rollno='$rollno', year='$year' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // If update is successful, redirect back to view.php
        header("Location: view.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>