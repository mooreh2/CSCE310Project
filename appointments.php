<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "csce_310_punch";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

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

$apptSQL = "SELECT * FROM `appointment`;";
$apptResult = $conn->query($apptSQL);
$apptResult = $apptResult->fetch_all();

// Finding the user's the current user has messages with
$users = [];
foreach($userResult as $u) {
  // Cross checking sender IDs with current user's ID
  //if ($a[1] == $currentUser[0] || $a[2] == $currentUser[0]) {
    // Add the recipeient's id to array (note this array could have duplicates)
    array_push($users, $u);
  //}
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="appointments.css">
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


<div class="container d-flex justify-content-center">
  <div class="page-header">
    <h1 class="text-center"><?php echo $currentUser[1] .' ' .$currentUser[2] .'\'s Appointments';?></h1>
  </div>
  <table class="table">
  <thead>
    <tr>
    <th scope="col">ID</th>
      <th scope="col">Who</th>
      <th scope="col">Date</th>
      <th scope="col">Location</th>
      <th scope="col"></th>
      
    </tr>
  </thead>
  <tbody>



  <?php
$ApptSQL = "SELECT * FROM appointment";
$appointments = $conn->query($ApptSQL);
if($appointments){
  while($row=mysqli_fetch_assoc($appointments)){
    $apptID=$row['ApptNumber'];
    $user1=$row['User1ID'];
    $user2=$row['User2ID'];

    if ($currentUser[0] == $user1) {
        foreach($users as $u) {
            if ($u[0] == $user2) {
                $otherUser = $u;
                break;
            }
        }
    }
    else if ($currentUser[0] == $user2) {
        foreach($users as $u) {
            if ($u[0] == $user1) {
                $otherUser = $u;
                break;
            }
        }
    }
    else {
        continue;
    }

    $otherUserFName=$otherUser[1];
    $otherUserLName=$otherUser[2];
    $date=$row['Time'];
    $location=$row['Location'];
    echo '<tr>
    <th scope="row">'.$apptID.'</th>
    <td>'.$otherUserFName.' '.$otherUserLName.'<td>
    <td>'.$date.'</td>
    <td>'.$location.'</td>
    <td>
        <button><a href="update_appointment.php?updateid=' . $apptID .'">update</a></button>
        <button><a href="delete_appointment.php?deleteid=' . $apptID .'">delete</a></button>
  </td>
  </tr>';
  }
  
}
  ?>
  
  </tbody>
</table>
    <a href="/create_appointment.php" class="create-apt-btn" role="button">Create Appointment</a>
</div>

</body>
</html>

<!-- <ul class="list-group mt-5 text-white">
    <?php 
        foreach($userResult as $appointment) {
            // if ($appointment[1] == $currentUser[0]) {
            //     $otherUserID = $appointment[2];
            // }
            // else {
            //     $otherUserID = $appointment[1];
            // }
            // foreach($userResult as $user) {
            //     if ($user[0] == $otherUserID) {
            //         $otherUser = $user;
            //     }
            // }
            echo `<li class="list-group-item d-flex justify-content-between align-content-center">
            <a href="/update_appointment.php">
            <div class="d-flex flex-row">
                <div class="ml-2">
                    <h3 class="mb-0">' .$appointment[1] .' ' .$appointment[2] .'</h3>
                    <div class="about">
                        <span>When: ' .$appointment[3] .'</span>
                    </div>
                        <div class="about">
                        <span>Where: ' .$appointment[4] .'</span>
                    </div>
                </div>
            </div>
            </li>`
            ;
        }
    ?>
    </ul> -->