<?php

$servername = "localhost";
$username = "root";

// Create connection
$conn = new mysqli($servername, $username);

// Check connection
if($conn -> connect_error)
{
    die("Connection failed:" . $conn->connect_error);
}

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
            <form>
            <div class="form-group">  
                <div class="container">
                    <h3> Choose User </h3>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        <?php
                            foreach($users as $u) {
                                echo '<option value="'.$u[0] .'">' .$u[1] .' ' .$u[2] .'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">  
                <div class="container">
                    <h3> Appointment Time </h3>
                    <div class ='input-group date' id='datetimepicker1'>  
                        <input type ='text' class="form-control" />  
                        <span class ="input-group-addon">  
                        <span class ="glyphicon glyphicon-calendar"></span>  
                        </span>  
                    </div> 
                </div>
            </div>
            <button type="Save" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>