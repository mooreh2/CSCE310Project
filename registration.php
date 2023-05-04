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


//INSERT Query
//The user can register for an account by entering desired username, first and last name. Upon clicking the register button, the account with the following information will be created.

if(isset($_POST['send'])) {
  //initialize username, firstname, lastname
  $userName = $_POST['username'];
  $otherUserFirstName = $_POST['fname'];
  $otherUserLastName = $_POST['lname'];
  echo "Initialized variables";
  
  
  // insert SQL query
  $insertSql = "insert into `user` (`FName`, `LName`, `UserName`)
  VALUES ('$otherUserFirstName', '$otherUserLastName', '$userName')";
  echo "Insert row into query";

  // Error checking
  if (!($conn->query($insertSql) === TRUE)) {
    echo "Error: " . $insertSql . "<br>" . $conn->error;
  }

  echo "Page refreshed";
  exit;
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


<!-- Form to register for an account. All the user has to do is enter the username, first and last name of the account they want to create. -->
<form method="post">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>


    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>

    <label for="fname"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="fname" id="fname" required>

    <label for="lname"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="lname" id="lname" required>


    <hr>

    <button name="send" type="submit" class="registerbtn">Register</button>
  </div>

</form>