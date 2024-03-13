<?php
//include auth_session.php file on all user panel pages
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

?>

<!DOCTYPE html>
<html>
    <!-- Font Icon -->
<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> -->
<link rel="stylesheet" href="css/style.css">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Task Record System | Student Dashboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <link rel="icon" href="images/favicon.ico">

        <style>
        .user-info {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            max-width: 400px;
        }

        .user-info h2 {
            color: #333;
        }

        .user-info p {
            margin: 5px 0;
            color: #666;
        }
    </style>
    </head>
    <body>
    <?php
        include('header.php');
    ?>
    <div class="form">
        <div class="container-style">
        <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Hey, Welcome <?= htmlspecialchars($user["username"]) ?>!</h2>

                    <h3>Task Record System</h3>
                    <!-- <p>You will receive the daily notification of next day classes on <?php echo $_SESSION['your_name']; ?></p>
                    <p>Use below buttons to navigate.</p> -->
                    <br>
                    <?php if (!empty($user['matricnumber'])) : ?>
                    <div class="user-info">
                        <h2>User Profile</h2>
                        <p><strong>Name:</strong> <?php echo $user['firstname'] . ' ' . $user['lastname']; ?></p>
                        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                        <p><strong>Matriculation Number:</strong> <?php echo $user['matricnumber']; ?></p>
                        <p><strong>Gender:</strong> <?php echo $user['gender']; ?></p>
                        <p><strong>Date of Birth:</strong> <?php echo $user['dob']; ?></p>
                        <p><strong>Faculty:</strong> <?php echo $user['faculty']; ?></p>
                        <p><strong>Department:</strong> <?php echo $user['department']; ?></p>
                    </div>
                    <?php endif; ?>
                    <a type="button" class="btn btn-info" href="view_tasks_user.php">View Task List</a>
                    <br><br>
                    <a type="button" class="btn btn-primary" href="updateprofile.php">Update Your Profile</a>
                  <!--  <a type="button" class="btn btn-primary" href="changepassword.php">Change Password</a> -->
                </div>
                <div class="signup-image">
                    <figure><img src="images/student.png" alt="admin image"></figure>
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