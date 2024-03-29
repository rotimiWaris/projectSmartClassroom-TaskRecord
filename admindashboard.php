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
<html>
    <!-- Font Icon -->
<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
<!-- Main css -->
<link rel="stylesheet" href="css/style.css">
<link rel="icon" href="images/favicon.ico">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Task Record System | Admin Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="icon" href="images/favicon.ico">
    </head>
    <body>
    <?php 
        include('header.php');
    ?>
    <div class="form">
        <div class="container-style">
        <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Welcome, <?= htmlspecialchars($admin["username"]) ?>!</h2>
                    <p style="color: #777">You are on admin panel now.</p>
                    <p style="color: #777;" >You can create and delete tasks from here.</p>
                    <p style="color: #777;">Use below button to navigate.</p>
                    <br>
                    <a type="button" class="btn btn-info" href="createtasks.php">Create Tasks</a>
                    <a type="button" class="btn btn-primary" href="viewtasks.php">View Task List</a>
                    <br><br>
                    <p style="color: #777;">Use below button to show the list of achieved tasks</p>
                    <a type="button" class="btn btn-primary notifybt" href="achievedtasks.php">Achieved Tasks</a>
                    <!--<br><br> -->
                    <!-- <p style="color: #777;">Use below button to send files to students</p>
                    <a type="button" class="btn btn-primary notifybt" href="sendmailtoall.php">Notify All</a>
                    <a type="button" class="btn btn-primary notifybt" href="sendmailtoone.php">Notify Student</a> -->
                </div>
                <div class="signup-image">
                    <figure><img src="images/admin.png" alt="admin image"></figure>
                    <a href="logout.php" class="signup-image-link">Logout</a>
                </div>
            </div>
        </div>  
    <!-- JS -->
    <!-- <script src="vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
    <script src="js/main.js"></script> -->
    <!--footer-->

    </body>
</html>