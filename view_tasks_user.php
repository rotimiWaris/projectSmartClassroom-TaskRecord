<?php

session_start();

if (isset($_SESSION["users_id"])) {
    
    $mysqli = require __DIR__ . "/db.php";
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["users_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}
else {
    header ("Location: signin.php");
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
 
// Check if the task ID is provided in the URL
if (isset($_GET['task_id'])) {
    $taskId = $_GET['task_id'];

    // Assume you have a session variable containing the current user's ID (replace 'user_id' with your actual session variable)
    $userId = isset($_SESSION['users_id']) ? $_SESSION['users_id'] : null;

        // Fetch the user's confirmed tasks from the database
        $selectSql = "SELECT confirmed_tasks FROM users WHERE id = $userId";
        $result = mysqli_query($conn, $selectSql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $confirmedTasks = json_decode($row['confirmed_tasks'], true);

            // Check if the task is not already confirmed
            if ($confirmedTasks === null) {
                // Initialize confirmedTasks as an empty array if it's null
                $confirmedTasks = [];
            }

            if ($userId !== null) {
                if (is_array($confirmedTasks)) {
                    if (!in_array($taskId, array_column($confirmedTasks, 'task_id'))) {
                        // Fetch the task details from the database
                        $taskSelectSql = "SELECT task_name, task_description, status FROM tasks WHERE task_id = $taskId";
                        $taskResult = mysqli_query($conn, $taskSelectSql);
                        $taskRow = mysqli_fetch_assoc($taskResult);

                        // Add the task to the user's confirmed tasks
                        $confirmedTasks[] = [
                            'task_id' => $taskId,
                            'task_name' => $taskRow['task_name'],
                            'task_description' => $taskRow['task_description'],
                            'status' => 'Achieved'
                        ];

                        // Update the user's confirmed tasks in the database
                        $updateSql = "UPDATE users SET confirmed_tasks = '" . json_encode($confirmedTasks) . "' WHERE id = $userId";
                        if (mysqli_query($conn, $updateSql)) {
                            $_SESSION['message'] = "Task confirmed as achieved!";
                        } else {
                            $_SESSION['error'] = "Error: " . mysqli_error($conn);
                        }
                    } else {
                        $_SESSION['error'] = "Error: Task already confirmed.";
                    }
                } else {
                    $_SESSION['error'] = "Error: Existing confirmed tasks is not an array.";
                }
            } else {
                $_SESSION['error'] = "Error fetching user data: " . mysqli_error($conn);
            }
        } else {
            header ("Location: signin.php");
        }
}

// Fetch tasks from the database
$selectSql = "SELECT * FROM tasks";
$result = mysqli_query($conn, $selectSql);

// Assume you have a session variable containing the current user's ID (replace 'user_id' with your actual session variable)
$userId = isset($_SESSION['users_id']) ? $_SESSION['users_id'] : null;

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

        .confirm-btn {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }

        .confirm-btn:hover {
            background-color: #0b7dda;
        }

        .unconfirm-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
        }

        .unconfirm-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <?php 
        include('header.php');
    ?>
    
    <h2>Task List</h2>
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
            <th>Task ID</th>
            <th>Task Name</th>
            <th>Task Description</th>
            <th>Created At</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['task_id']}</td>";
            echo "<td>{$row['task_name']}</td>";
            echo "<td>{$row['task_description']}</td>";
            echo "<td>{$row['created_at']}</td>";
            // Display the status if it exists in the confirmed_tasks
            echo "<td>";
            if ($userId !== null) {
                $selectUserSql = "SELECT confirmed_tasks FROM users WHERE id = $userId";
                $userResult = mysqli_query($conn, $selectUserSql);
                if ($userResult) {
                    $userRow = mysqli_fetch_assoc($userResult);
                    $confirmedTasks = json_decode($userRow['confirmed_tasks'], true);
                    $status = 'Unachieved'; // Default status
                    if (is_array($confirmedTasks)) {
                        // Check if the task is confirmed by the user and get the status
                        foreach ($confirmedTasks as $confirmedTask) {
                            if ($confirmedTask['task_id'] == $row['task_id']) {
                                $status = $confirmedTask['status'];
                                break;
                            }
                        }
                    }
                    echo $status;
                }
            }
            echo "</td>";
            echo "<td><button class='confirm-btn' onclick='confirmTask({$row['task_id']})'>Confirm</button></td>";
            echo "</tr>";
        }
        ?>

    </table>

    <script>
        function confirmTask(taskId) {
            if (confirm("Have you achieved this task?")) {
                window.location.href = "view_tasks_user.php?task_id=" + taskId;
            }
        }
    </script>
    </body>

    </html>

<?php
// Close the connection
$conn->close();
?>
