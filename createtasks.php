<?php
//include auth_session.php file on all user panel pages
session_start();

if (isset($_SESSION["admins_id"])) {
    
    $mysqli = require __DIR__ . "/db.php";
    
    $sql = "SELECT * FROM admins
            WHERE id = {$_SESSION["admins_id"]}";
            
    $result = $mysqli->query($sql);
    
    $admin = $result->fetch_assoc();
}
else {
    header ("Location: adminsignin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico">
    <title>Task Record System | Create Task</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 70%;
            text-align: center;
            margin: 20px auto;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php 
    include('header.php');

    // Assuming you have a database connection
// Replace these with your actual database credentials
$host = "localhost";
$dbname = "LoginSystem";
$username = "root";
$password = "";

// Create a connection
$conn = new mysqli(hostname: $host,
                    username: $username,
                    password: $password,
                    database: $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get task details from the form
    $taskName = $_POST['task_name'];
    $taskDescription = $_POST['task_description'];

    // Insert task into the database
    $sql = "INSERT INTO tasks (task_name, task_description) VALUES ('$taskName', '$taskDescription')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Task created successfully!')</script>";
        echo '<script>window.location.href = "admindashboard.php";</script>';
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()">
    <h2>Create Task</h2>

    <label for="task_name">Task Name:</label>
    <input type="text" name="task_name" id="task_name" required>
    <br>

    <label for="task_description">Task Description:</label>
    <textarea name="task_description" id="task_description" rows="4" required></textarea>
    <br>

    <input type="submit" value="Create Task">
</form>

<script>
    function validateForm() {
        var taskName = document.getElementById('task_name').value;
        var taskDescription = document.getElementById('task_description').value;

        if (taskName.trim() === '' || taskDescription.trim() === '') {
            alert('Please fill in all fields.');
            return false;
        }

        return true;
    }
</script>

</body>
</html>
