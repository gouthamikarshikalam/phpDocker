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
    
    // Fetch student details based on the provided ID
    $sql = "SELECT * FROM student WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $rollno = $row["rollno"];
        $year = $row["year"];

        // Now you can display a form to edit the student details with pre-filled values
        // Example form:
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit Student Details</title>
            <!-- Include CSS styles if needed -->
        </head>
        <body>
            <h2>Edit Student Details</h2>
            <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $name; ?>"><br>
                <label for="rollno">Roll No:</label>
                <input type="text" name="rollno" value="<?php echo $rollno; ?>"><br>
                <label for="year">Year:</label>
                <input type="text" name="year" value="<?php echo $year; ?>"><br>
                <input type="submit" value="Update">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Student not found";
    }
} else {
    echo "Student ID not provided";
}
?>
