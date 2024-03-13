<?php

session_start();

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

if (isset($_SESSION["admins_id"])) {
    
    $mysqli = require __DIR__ . "/db.php";
    
    $sql = "SELECT * FROM admins
            WHERE id = {$_SESSION["admins_id"]}";
            
    $result = $mysqli->query($sql);
    
    $admin = $result->fetch_assoc();

    if (isset($_GET['delete_task'])) {
        $taskId = $_GET['delete_task'];
    
        // Delete the task from the database
        $deleteSql = "DELETE FROM tasks WHERE task_id = $taskId";
        if (mysqli_query($conn, $deleteSql)) {
            $message = "<p style='color:green; text-align: center;'>Task deleted successfully!</p>";
        } else {
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }
    }
}
else {
    header ("Location: adminsignin.php");
}

// Fetch tasks from the database
$selectSql = "SELECT * FROM tasks";
$result = mysqli_query($conn, $selectSql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico">
    <title>Task Record System | Task List</title>
    <style>
        table {
            text-align: center;
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        h2 {
            text-align: center;
            color: #333;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <?php 
        include('header.php');
    ?>
    
    <h2>Task List</h2>
    <?php if(isset($message)) { echo $message; } ?>
    <table>
        <tr>
            <th>Task ID</th>
            <th>Task Name</th>
            <th>Task Description</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['task_id']}</td>";
            echo "<td>{$row['task_name']}</td>";
            echo "<td>{$row['task_description']}</td>";
            echo "<td>{$row['created_at']}</td>";
            echo "<td><button class='delete-btn' onclick='deleteTask({$row['task_id']})'>Delete</button></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <script>
        function deleteTask(taskId) {
            if (confirm("Are you sure you want to delete this task?")) {
                window.location.href = "viewtasks.php?delete_task=" + taskId;
            }
        }
    </script>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
