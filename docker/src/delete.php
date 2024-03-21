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

// Check if ID is provided in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the row from the database
    $sql_delete = "DELETE FROM student WHERE id = $id";
    if ($conn->query($sql_delete) === TRUE) {
        // Update the IDs of the remaining rows
        $sql_update_ids = "SET @num := 0;
                           UPDATE stud SET id = @num := (@num+1);
                           ALTER TABLE stud AUTO_INCREMENT = 1;";
        $conn->multi_query($sql_update_ids);

        // Redirect back to view.php
        header("Location: view.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Student ID not provided";
}

$conn->close();
?>
