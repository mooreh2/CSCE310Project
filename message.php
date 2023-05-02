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

// Collecting variables being passed
session_start();
$currentUser = $_SESSION['typedUser'];
$otherUserFirstName = $_SESSION['otherUserFirstName'];

// Querying users to match passed on first name
$userSql = "SELECT * FROM `user`;";
$users = $conn->query($userSql);
$users = $users->fetch_all();

// Based off of passed along user, match with full user data type in db
foreach($users as $user) {
  if ($user[1] == $otherUserFirstName) {
    $otherUser = $user;
    break;
  }
}

// Query messages between these two users
$msgSql = "SELECT * FROM `message` WHERE ((`SenderID`=$currentUser[0] AND `ReceiverId`=$otherUser[0]) OR (`SenderID`=$otherUser[0] AND `ReceiverId`=$currentUser[0]))";
$msgs = $conn->query($msgSql);
$msgs = $msgs->fetch_all();

// INSERT QUERY
// If the user sends a message, the database must update, and that message should be displayed
if(isset($_POST['send'])) {
  $newMessage = $_POST['addedContent'];
  // Send a query to the db with a new message
  $insertSql = "INSERT INTO message (`SenderID`, `ReceiverID`, `Content`)
  VALUES ('$currentUser[0]', '$otherUser[0]', '$newMessage')";

  // Error checking
  if (!($conn->query($insertSql) === TRUE)) {
    echo "Error: " . $insertSQL . "<br>" . $conn->error;
  }

  // The page will automatically refresh thanks to line below
  header('Location: /message.php');
  exit;
}

// DELETE QUERY
// If the user hits the delete button, the given message should be removed
if(isset($_POST['delete'])) {
  $deletedMessage = $_POST['msgToBeDeleted'];

  $deleteQuery = "DELETE FROM message
  WHERE `MessageID` = '$deletedMessage'";

  if (!($conn->query($deleteQuery) === TRUE)) {
    echo "Error: " . $deleteQuery . "<br>" . $conn->error;
  }

  // The page will automatically refresh thanks to line below
  header('Location: /message.php');
  exit; 
}

// UPDATE QUERY
// If the user hits the update button, they should be able to update the specific message's contents
if (isset($_POST['update'])) {
  $updateMessage = $_POST['msgToBeUpdated'];
  
  session_start();
  $_SESSION['msgToBeUpdated'] = $updateMessage;

  header('Location: /update_message.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Messages</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
        <li><a href="/">Appointments</a></li>
        <li><a href="/inbox.php">Inbox</a></li>
    </ul>
  </div>
</nav>
</br></br></br></br>



<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
          <div class="col-md-6">
            <div class="card card-bordered">
              <div class="card-header">
                <h4 class="card-title"><strong><?php echo $currentUser[1] .' ' .$currentUser[2] .'\'s Chat with ' .$otherUser[1] .' ' .$otherUser[2];?></strong></h4>
              </div>


              <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:400px !important;">
                <div class="media media-chat">
                  <div class="media-body">
                    <?php 
                      foreach($msgs as $msg) {
                        foreach($users as $user) {
                          if($user[0] == $msg[1]) {
                            $currentSenderFName = $user[1];
                            $currentSenderLName = $user[2];
                            break;
                          }
                        }
                        echo '<p><u>' .$currentSenderFName .' ' .$currentSenderLName .':</u> ' .$msg[3] .'
                            <span class="publisher bt-1">
                              <form method="post">
                                <input type="hidden" name="msgToBeUpdated" value=' . $msg[0] .'>
                                <button name="update" class="publisher-input">Update</button>
                              </form>
                              <form method="post">
                                <input type="hidden" name="msgToBeDeleted" value=' . $msg[0] . '>
                                <button name="delete" class="publisher-input">Delete</button>
                              </form>
                            </span></p>
                          </form>
                          '
                        ;
                      }
                    ?>
                  </div>
                </div>

              <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div></div></div>
              
              <form method="post">
                <div class="publisher bt-1 border-light">
                  <input name="addedContent"class="publisher-input" type="text" placeholder="Write something">
                  <button name="send" class="publisher-input" type="submit">Send</button>              
                </div>
              </form>
             </div>
          </div>
          </div>
          </div>
          </div>
        
        
  </body>
</html>