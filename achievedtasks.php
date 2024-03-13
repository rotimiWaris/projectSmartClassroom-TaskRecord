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

// Check if the task ID and user ID are provided in the URL
if (isset($_GET['task_id']) && isset($_GET['user_id'])) {
    $taskId = $_GET['task_id'];
    $userId = $_GET['user_id'];

    // Fetch the existing confirmed tasks from the database
    $selectUserSql = "SELECT confirmed_tasks FROM users WHERE id = $userId";
    $userResult = mysqli_query($conn, $selectUserSql);

    if ($userResult) {
        $userRow = mysqli_fetch_assoc($userResult);
        $confirmedTasks = json_decode($userRow['confirmed_tasks'], true);

        // Check if $confirmedTasks is an array before updating it
        if (is_array($confirmedTasks)) {
            // Find the index of the task with the given task ID
            $taskIndex = array_search($taskId, array_column($confirmedTasks, 'task_id'));

            // Check if the task is found
            if ($taskIndex !== false) {
                // Remove the task from the confirmed tasks array
                array_splice($confirmedTasks, $taskIndex, 1);

                // Update the user's confirmed tasks in the database
                $updateSql = "UPDATE users SET confirmed_tasks = '" . json_encode($confirmedTasks) . "' WHERE id = $userId";
                if (mysqli_query($conn, $updateSql)) {
                    echo "<script>alert('Task deleted successfully!')</script>";
                    echo '<script>window.location.href = "achievedtasks.php";</script>';
                } else {
                    $_SESSION['error'] = "Error: " . mysqli_error($conn);
                }
            } else {
                $_SESSION['error'] = "Error: Task not found in confirmed tasks.";
            }
        } else {
            $_SESSION['error'] = "Error: Confirmed tasks is not an array.";
        }
    } else {
        $_SESSION['error'] = "Error fetching user data: " . mysqli_error($conn);
    }
}

$selectSql = "SELECT id, username, confirmed_tasks FROM users";
    $result = mysqli_query($conn, $selectSql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico">
    <title>Task Record System | Achieved Task List</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
    </style>
</head>

<body>
    <?php 
        include('header.php');
    ?>

    <h2>Achieved Task List</h2>
    <?php
    // Check for success or error messages and display them
    if (isset($_SESSION['message'])) {
        echo "<p style='color: green; text-align: center'>{$_SESSION['message']}</p>";
        unset($_SESSION['message']); // Clear the message to avoid displaying it on subsequent page loads
    }

    if (isset($_SESSION['error'])) {
        echo "<p style='color: red; text-align: center'>{$_SESSION['error']}</p>";
        unset($_SESSION['error']); // Clear the error to avoid displaying it on subsequent page loads
    }
    ?>
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Task ID</th>
            <th>Task Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $userId = $row['id'];
            $username = $row['username'];

            // Decode the JSON array from confirmed_tasks
            $confirmedTasks = json_decode($row['confirmed_tasks'], true);

            // Check if confirmedTasks is an array before looping through it
            if (is_array($confirmedTasks)) {
                foreach ($confirmedTasks as $confirmedTask) {
                    echo "<tr>";
                    echo "<td>{$userId}</td>";
                    echo "<td>{$username}</td>";
                    echo "<td>{$confirmedTask['task_id']}</td>";
                    echo "<td>{$confirmedTask['task_name']}</td>";
                    echo "<td>{$confirmedTask['status']}</td>";
                    echo "<td><a href='achievedtasks.php?user_id={$userId}&task_id={$confirmedTask['task_id']}&action=delete'>Delete</a></td>";
                    echo "</tr>";
                }
            }
        }
        ?>
    </table>

</body>

</html>