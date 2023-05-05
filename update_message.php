<!-- 
    File Author: Hayden Moore
    File Description:
        The user will be redirected to this page after clicking the update button for a certain message.
        They will have the previous message that they desire to update displayed first,
        and below they will be prompted to enter the new message.
        After clicking the update button, the user will be sent back to message.php, where they were earlier,
        and on the UI, the message will be properly changed.
        Similarly, in the database, that specific message will hold different contents, as well.
 -->

 <!-- 
    In the PHP section,
    again, a database connection is established,
    a session is started to grab the logged in user and selected message to update,
    and after the user interacts with the page by typing in a new message and clicking update,
    the handling of the POST variable will allow for an update query and send the current user back to message.php
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

// Collecting variables being passed
session_start();
$currentUser = $_SESSION['typedUser'];
$previousMessage = $_SESSION['msgToBeUpdated'];

// Based on what the user types in the new message box, update the database and send user back to message.php
if(isset($_POST['submit'])) {
    $newMessage = $_POST['newMsg'];
    $updateQuery = "UPDATE message
        SET `Content` = '$newMessage'
        WHERE `MessageID` = '$previousMessage'";
    
    if (!($conn->query($updateQuery) === TRUE)) {
        echo "Error: " . $updateQuery . "<br>" . $conn->error;
    }
    
    header('Location: /message.php');
    exit;
}
?>

<!-- 
    As far as styling goes,
    this page displays the nav bar, the contents of the previous message at the top,
    and a prompt for the user to change said message.
    After typing in the desired new message, this user can click the update butotn to be redirected.
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Page setup -->
        <title>Update Message</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body style="background-color: #eee;">
        <!-- Nav Bar -->
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
                    <li><a href="/display_blog.php">Post</a></li>
                </ul>
            </div>
        </nav>
        </br></br></br></br>

        <!-- 
            Below the nav bar, the page contains two sections:
            One with the previous message, and another with the opportunity to update that message.
        -->
        <div class="container d-flex justify-content-center">
            <ul class="list-group mt-5 text-white">
                <!-- First list item, for the previous message -->
                <li class="list-group-item d-flex justify-content-between align-content-center">
                    <div class="d-flex flex-row">
                        <div class="ml-2">
                            <h2 class="mb-0">Previous Message:</h2>
                            <div class="about">
                                <?php
                                    // This PHP query finds the message with the matching MessageID to the one we want to change.
                                    // With this information, we can easily change that specific message's contents.
                                    $prevMsgQuery = "SELECT `Content` FROM message WHERE `MessageID` = '$previousMessage'";
                                    $prevMsg = $conn->query($prevMsgQuery);
                                    $prevMsg = $prevMsg->fetch_all();
                                    echo '<h4>' .$prevMsg[0][0] .'</h4>';
                                ?>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- Second list item, for the prompt to update the message -->
                <li class="list-group-item d-flex justify-content-between align-content-center">
                    <div class="d-flex flex-row">
                        <div class="ml-2">
                            <h2 class="mb-0">New Message:</h2>
                            <div class="about">
                            <form method="post">
                                <input type="text" name="newMsg">
                                <button name="submit" class="btn btn-outline-light btn-lg px-5" type="submit">Update</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </body>
</html>