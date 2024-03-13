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

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/favicon.ico">    
    <title>Task Record System - HomePage</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
      body {
            background-color: #f2f2f2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            text-align: justify;
        }

        .about-section {
            background-color: rgba(19, 170, 5, 0.801);
            color: white;
            padding: 40px 0;
            width: 100vw; /* Set section width to full viewport width */
            box-sizing: border-box;
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }
        
        .section-container h1 {
            color: #fff;
            text-transform: uppercase;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            .section-container {
                padding: 0 20px; /* Adjust padding for smaller screens */
            }
        }
    </style>
  </head>
  <body>

    <?php
    include('header.php');
    ?>

<section class="about-section">
    <div class="section-container">
      <h1><strong>Task Record System</strong></h1>
      <p style="color: #fff;">
            The Task Record System is a comprehensive solution for efficient task management and tracking. It comprises key components such as tasks, users, records, and attributes. The workflow includes task creation, assignment, progress tracking, and completion.
        </p>

        <p style="color: #fff;">
            The user interface features a dashboard displaying task lists, filters, and status indicators, along with a detailed task page. Reporting capabilities enable users to analyze task performance, identify bottlenecks, and assess productivity. The system integrates with other tools like calendars and project management software.
        </p>

        <p style="color: #fff;">
            Benefits of the Task Record System include increased productivity, improved collaboration, and streamlined workflows. Security measures are in place to protect task data. In conclusion, this system enhances overall task management by providing a user-friendly interface, robust workflow, and valuable reporting features.
        </p>
    </div>
  </section>
    
  </body>
</html>