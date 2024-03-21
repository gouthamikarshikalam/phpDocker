<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 60%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn-container a {
            margin-right: 10px;
            text-decoration: none;
            color: #fff;
            padding: 8px 20px;
            border-radius: 5px;
        }
        .btn-container a.register {
            background-color: #007bff;
        }
        .btn-container a.register:hover {
            background-color: #0056b3;
        }
        .btn-container a.edit {
            background-color: #007bff;
        }
        .btn-container a.delete {
            background-color: #dc3545;
        }
        .btn-container a.edit, .btn-container a.delete {
            display: inline-block;
            color: #fff;
            padding: 8px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-container a.edit:hover, .btn-container a.delete:hover {
            opacity: 0.8;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <h2>View Students</h2>
        <form action="" method="GET">
            <input type="text" name="search" placeholder="Search by Name or Roll No">
            <input type="submit" value="Search">
        </form>
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

        // Search query
        if(isset($_GET['search'])) {
            $search = $_GET['search'];
            $sql = "SELECT * FROM student WHERE name LIKE '%$search%' OR rollno LIKE '%$search%'";
        } else {
            $sql = "SELECT * FROM student";
        }

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            echo "<table><tr><th>ID</th><th>Name</th><th>Roll No</th><th>Year</th><th>Actions</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["rollno"]. "</td><td>" . $row["year"]. "</td>";
                echo "<td class='btn-container'>";
                echo "<a href='edit.php?id=".$row['id']."' class='edit'>Edit</a>"; // Edit link with 'id'
                echo "<a href='delete.php?id=".$row['id']."' class='delete'>Delete</a>"; // Delete link with 'id'
                echo "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
        <div class="btn-container">
            <a href="index.html" class="register">Register</a> <!-- Added Register button -->
        </div>
    </div>
</body>
</html>