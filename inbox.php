<!-- 
  File Author: Hayden Moore
  File Description:
    This page holds the inbox for the current user.
    The current user will have a list displayed of all of the other users that they have either sent or received a message from.
    Each name displayed will have a button for the user to click to enter the message room specific to them and that other user.
-->

<!-- 
  In the PHP portion, a database connection is created, the connection is checked, 
  and a session is started to find the currently logged in user.
  Both users and messages are queried from our database.
  Based on the results of these queries, an algorithm finds the users the current user has messages with.
  Finally, once one of the buttons is clicked by the user, they will be redirected to message.php
-->
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

// Grabbing the current user from previous page
session_start();
$currentUser = $_SESSION['typedUser'];

// querying messages from db
$msgSql = "SELECT * FROM `message`;";
$msgResult = $conn->query($msgSql);
$msgResult = $msgResult->fetch_all();

// Querying users from db
$userSql = "SELECT * FROM `user`;";
$userResults = $conn->query($userSql);
$userResults = $userResults->fetch_all();

// Finding the user's the current user has messages with
$usersWithMessagesDuplicates = [];
$usersWithMessages = [];
foreach($msgResult as $msg) {
  // Cross checking sender IDs with current user's ID
  if ($msg[1] == $currentUser[0]) {
    // Add the recipeient's id to array (note this array could have duplicates)
    array_push($usersWithMessagesDuplicates, $msg[2]);
  }
}
// Use array_unique to remove duplicates
$usersWithMessages = array_unique($usersWithMessagesDuplicates);

// Based off of user IDs stored in above array, fill array with actual user datatypes of those users
$usersWithMessagesAsUsers = [];
foreach($usersWithMessages as $user) {
  foreach($userResults as $userResult) {
    if ($user == $userResult[0]) {
      array_push($usersWithMessagesAsUsers, $userResult);
    }
  }
}

// Based on clicked user, send info to messages.php
if(isset($_POST['submit'])) {
  $otherUserFirstName = $_POST['postId'];
  session_start();
  $_SESSION['otherUserFirstName'] = $otherUserFirstName;
  header('Location: /message.php');
  exit;
}

?>

<!-- 
  Styling for this page consists of the nav bar,
  a header showing who is logged in,
  and a list of all of the other users that the logged in user has messages with.
  Within each list element, the name of the given user, and a button that can be clicked to enter that user's message room is available.
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Page setup -->
  <title>Inbox</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body style="background-color: #eee;">
  <div>
  <!-- Nav Bar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Punch</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/">Login</a></li>
            <li><a href="/profile.php">My Profile</a></li>
            <li><a href="/appointments.php">Appointments</a></li>
            <li><a href="/inbox.php">Inbox</a></li>
            <li><a href="/display_blog.php">Post</a></li>
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
        <!-- 
          On this page, we have to embed PHP within the HTML to loop through the users queried above.
          Within the for loop, the echo command can be used to return html code.
        -->
        <?php
          foreach($usersWithMessagesAsUsers as $desiredUser) {
            echo '<li class="list-group-item d-flex justify-content-between align-content-center">
              
              <div class="d-flex flex-row">
                <div class="ml-2">
                  <h3 class="mb-0">' .$desiredUser[1] .' ' .$desiredUser[2] .'</h3>
                  <div class="about">
                    <form method="post">
                      <input type="hidden" id="postId" name="postId" value=' .$desiredUser[1] .'>
                      <button name="submit" class="btn btn-outline-light btn-lg px-5" type="submit">Click to view messages</button>
                    </form>
                  </div>
                </div>
              </div>
            </li>';
          }
        ?>
      </ul>
    </div>
  </div>
</body>
</html>