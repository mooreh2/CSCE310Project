<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "csce_310_punch";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if($conn -> connect_error) {
  die("Connection failed:" . $conn->connect_error);
}

// Check connection
if($conn -> connect_error) {
  die("Connection failed:" . $conn->connect_error);
}

// Grabbing the current user from previous page
session_start();
$currentUser = $_SESSION['typedUser'];

// querying messages from db
$msgSql = "SELECT * FROM `message`;";
$msgResult = $conn->query($msgSql);
$msgResult = $msgResult->fetch_all();

// Querying users from db
$userSql = "SELECT * FROM `user`;";
$userResult = $conn->query($userSql);
$userResult = $userResult->fetch_all();


// Finding the user's the current user has messages with
$usersWithMessagesDup = [];
$usersWithMessages = [];
foreach($msgResult as $a) {
  // Cross checking sender IDs with current user's ID
  if ($a[1] == $currentUser[0]) {
    // Add the recipeient's id to array (note this array could have duplicates)
    array_push($usersWithMessagesDup, $a[2]);
  }
}
// Use array_unique to remove duplicates
$usersWithMessages = array_unique($usersWithMessagesDup);

// Based off of user IDs stored in above array, fill array with actual user datatypes of those users
$usersWithMessagesAsUsers = [];
foreach($usersWithMessages as $b) {
  foreach($userResult as $c) {
    if ($b == $c[0]) {
      array_push($usersWithMessagesAsUsers, $c);
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #eee;">
<div>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Punch</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="/">Login</a></li>
        <li><a href="/profile.php">My Profile</a></li>
      <li><a href="/">Appointments</a></li>
      <li><a href="/inbox.php">Inbox</a></li>
    </ul>
  </div>
</nav>
</div>
<br/><br/><br/>


<div class="container d-flex justify-content-center">
  <div class="page-header">
    <h1 class="text-center"><?php echo $currentUser[1] .' ' .$currentUser[2] .'\'s Inbox';?></h1>
  </div>
		<ul class="list-group mt-5 text-white">
      <?php
        foreach($usersWithMessagesAsUsers as $d) {
          echo '<li class="list-group-item d-flex justify-content-between align-content-center">
            <a href="/message.php">
            <div class="d-flex flex-row">
              <div class="ml-2">
                <h3 class="mb-0">' .$d[1] .' ' .$d[2] .'</h3>
                <div class="about">
                  <span>Click to view messages</span>
                </div>
              </div>
            </div>
          </li>';
        }
      ?>
		</ul>
	</div>

</body>
</html>