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

// session_start();
// $currentUser = $_SESSION['typedUser'];
// $otherUserFirstName = $_SESSION['otherUserFirstName'];
// $otherUserLastName = $_SESSION['otherUserLastName'];

// $userSql = "Select * from `user`;";
// //$users = $conn->query($userSql);
// //$users = $users->fetch_all();
// $result = mysqli_query($conn, $userSql);
// if($result)
// {
//   while($row=mysqli_fetch_assoc($result))
//   {
//     $id = $row['UserID'];
//     //$adminid = $row['AdminID'];
//     $fname = $row['FName'];
//     $lname = $row['LName'];
//     echo '<button type="submit" class="registerbtn">Register</button>';
//   }
// }

/*
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
*/

//INSERT

if(isset($_POST['send'])) {
  $newMessage = $_POST['username'];
  $userID = $_POST['userid']
  $adminID = $_POST['adminid']
  $otherUserFirstName = $_POST['fname'];
  $otherUserLastName = $_POST['lname'];
  
  
  // // Send a query to the db with a new message
  $insertSql = "insert into user (`UserID`, `AdminID`, `FName`, `LName`, `UserName`)
  VALUES ('$userID', '$adminID', '$otherUserFirstName', '$otherUserLastName', '$newMessage')";

  // Error checking
  if (!($conn->query($insertSql) === TRUE)) {
    echo "Error: " . $insertSql . "<br>" . $conn->error;
  }

  // The page will automatically refresh thanks to line below
  header('Location: /profile.php');
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

<form method="post">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="username"><b>User ID number</b></label>
    <input type="text" placeholder="Enter a number" name="userid" id="userid" required>

    <label for="username"><b>Admin ID number</b></label>
    <input type="text" placeholder="Enter a number" name="adminid" id="adminid" required>

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