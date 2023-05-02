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

<!DOCTYPE html>
<html lang="en">
    <head>
    <title>Update Message</title>
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

        <div class="container d-flex justify-content-center">
            <ul class="list-group mt-5 text-white">
                <li class="list-group-item d-flex justify-content-between align-content-center">
                    <div class="d-flex flex-row">
                        <div class="ml-2">
                            <h2 class="mb-0">Previous Message:</h2>
                            <div class="about">
                                <?php
                                    $prevMsgQuery = "SELECT `Content` FROM message WHERE `MessageID` = '$previousMessage'";
                                    $prevMsg = $conn->query($prevMsgQuery);
                                    $prevMsg = $prevMsg->fetch_all();
                                    echo '<h4>' .$prevMsg[0][0] .'</h4>';
                                ?>
                            </div>
                        </div>
                    </div>
                </li>
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



</html>