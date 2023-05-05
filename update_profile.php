<!-- 
  File Author: Vardaan Kola
  File Description: 
    In the update profile page, the user will be able to update a profile by changing the username and first and last names.
-->

<!-- 
  In the PHP section, similarly to other files, first a connection is established with the database.
  Then, the update query is written for the username, first and last name to be updated for a row the database. The latest row will be updated. Some echo statements and an error checking condition is included for us to make sure the development goes smoothly.
-->





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
</br></br></br></br>

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



// UPDATE QUERY
// If the user hits the update button, they should be able to update an account
if (isset($_POST['update'])) {
    //initialize username, firstname, lastname
    $userName = $_POST['username'];
    $otherUserFirstName = $_POST['fname'];
    $otherUserLastName = $_POST['lname'];

    //SQL query.
    $updateSql = "update `user` set FName='$otherUserFirstName', LName='$otherUserLastName', UserName='$userName' where UserID = (SELECT MAX(UserID) FROM `user`) LIMIT 1";

    // Error checking
    if (!($conn->query($updateSql) === TRUE)) {
        echo "Error: " . $updateSql . "<br>" . $conn->error;
    }

    header('Location: /profile.php');
  
    exit;
  }


?>

<!-- Form to delete the profile. All the user has to do is enter the username, first and last name of the account they wish to update the information of. -->
<form action="update_profile.php" method="post">
  <div class="container">
    <h1>Update Profile</h1>
    <p>Please fill in this form to update a user's profile.</p>
    <hr>


    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>

    <label for="fname"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="fname" id="fname" required>

    <label for="lname"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="lname" id="lname" required>


    <hr>

    <button name="update" type="submit" class="updateprofilebtn">Update Profile</button>
  </div>

</form>