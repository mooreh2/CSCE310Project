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
echo "Connection established";


// Check connection
if($conn -> connect_error)
{
die("Connection failed:" . $conn->connect_error);

}

// $userSql = "Select * from `user`;";
// $users = $conn->query($userSql);
// $users = $users->fetch_all();
// $id = $_GET['updateUserID'];


// DELETE QUERY
// If the user hits the delete button, they should be able to delete an account
if (isset($_POST['delete'])) {
    //$id = $row['UserID'];
    //$adminid = $row['AdminID'];
    $userName = $_POST['username'];
    //$userID = $_POST['userid'];
    //$adminID = $_POST['adminid'];
    // $otherUserFirstName = $_POST['fname'];
    // $otherUserLastName = $_POST['lname'];
    echo "Initialized variable";

    $deleteSql = "delete from `user` 
    WHERE UserName='$userName'";

    echo "Delete Row";

    // Error checking
    if (!($conn->query($deleteSql) === TRUE)) {
        echo "Error: " . $deleteSql . "<br>" . $conn->error;
    }

    echo "Page refreshed";
  
    exit;
  }


?>

<form action="delete_profile.php" method="post">
  <div class="container">
    <h1>Delete Profile</h1>
    <p>Please enter the username of the profile you want to delete.</p>
    <hr>


    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>


    <hr>

    <button name="delete" type="submit" class="deleteprofilebtn">Delete Profile</button>
  </div>

</form>