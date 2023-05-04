<!-- 
  File Author: Vardaan Kola
  File Description: 
    In the delete profile page, the user will be able to enter the username of a profile they wish to delete. Upon clicking the 'delete' button, the account with the specified username will be deleted.
-->

<!-- 
  In the PHP section, similarly to other files, first a connection is established with the database.
  Then, the delete query is written for the username of the account that will be deleted. Some echo statements and an error checking condition is included for us to make sure the development goes smoothly.
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
echo "Connection established";


// Check connection
if($conn -> connect_error)
{
die("Connection failed:" . $conn->connect_error);

}



// DELETE QUERY
// If the user hits the delete button, they should be able to delete an account as long as they enter the username of the account they wish to delete.
if (isset($_POST['delete'])) {
    //Initialize only the username because we are deleting account based on username only
    $userName = $_POST['username'];
    echo "Initialized variable";

    // SQL query
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

<!-- Form to delete the profile. All the user has to do is enter the username of the account they wish to delete into the textbox, and then press the delete button that will delete the profile. -->
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