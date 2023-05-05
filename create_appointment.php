<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "csce_310_punch";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

session_start();
$currentUser = $_SESSION['typedUser'];


// Querying users from db
$userSql = "SELECT * FROM `user`;";
$userResult = $conn->query($userSql);
$userResult = $userResult->fetch_all();

// Finding the user's the current user has messages with
$users = [];
foreach($userResult as $u) {
  // Cross checking sender IDs with current user's ID
  if ($u[0] != $currentUser[0]) {
    // Add the recipeient's id to array (note this array could have duplicates)
    array_push($users, $u);
  }
}

// INSERT QUERY
// If the user sends a message, the database must update, and that message should be displayed
if(isset($_POST['submit'])) {
    $selectedApptTime = $_POST['addedTime'];
    $selectedApptLocation = $_POST['addedLocation'];
    $selectedApptUser = $_POST['addedUser']; 

    // Send a query to the db with a new message
    $insertSql = "INSERT INTO appointment (`User1ID`, `User2ID`, `Time`, `Location`)
    VALUES ('$currentUser[0]', '$addedUser', '$selectedApptTime', '$selectedApptLocation')";
  
    // Error checking
    if (!($conn->query($insertSql) === TRUE)) {
      echo "Error: " . $insertSQL . "<br>" . $conn->error;
    }
  
    // The page will automatically refresh thanks to line below
    header('Location: /appointments.php');
    exit;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
  <script src ="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
  <script src ="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  <script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>  
  <script>  
    $(function() {  
        $('#datetimepicker1').datetimepicker();  
    });  

    $('.selectpicker').change(function () {
        var selectedItem = $('.selectpicker').val();
        alert(selectedItem);
    });
  </script> 
    <link rel ="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
    <link rel ="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">  
</head>
<body style="background-color: #eee;">

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Punch</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="/">Login</a></li>
        <li><a href="/">My Profile</a></li>
        <li><a href="/appointments.php">Appointments</a></li>
        <li><a href="/inbox.php">Inbox</a></li>
    </ul>
  </div>
</nav>
</br></br></br></br>



<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="container d-flex justify-content-center">
            <div class="page-header">
                <h1 class="text-center">Create Appointment</h1>
            </div>
            <form method="post">
            <div class="form-group">  
                <div class="container">
                    <h3> Choose User </h3>
                        <?php
                            foreach($users as $u) {
                                echo '<div class="form-check">
                                    <input type="radio" class="form-check-input" name="addedUser" value="'. $u[0].'">'.$u[1].' '.$u[2].' 
                                    <label class="form-check-label"></label>
                              </div>';
                            }
                        ?>
                </div>
            </div>
            <div class="form-group">  
                <div class="container">
                    <h3> Appointment Time </h3>
                    <div class ='input-group date' id='datetimepicker1'>  
                        <input type ='text' class="form-control" name="addedTime"/>  
                        <span class ="input-group-addon">  
                        <span class ="glyphicon glyphicon-calendar"></span>  
                        </span>  
                    </div> 
                </div>
            </div>
            <div class="form-group">  
                <div class="container">
                    <h3> Appointment Location </h3>
                    <input type="text" class="form-control" name="addedLocation">
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Save</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>