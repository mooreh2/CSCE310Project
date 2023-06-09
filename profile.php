<!-- 
  File Author: Vardaan Kola
  File Description: 
    In the profile page, there are four options: Register, Update profile, Login, and Delete profile. These four options are basically hyperlinks to different pages. Each page has its own functionality, and hence the user will be redirected to the respective page and php functionalities.
-->

<!-- 
  There is not much to this PHP section. Only a connection is established with the database.
-->

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
      <li><a href="/appointments.php">Appointments</a></li>
      <li><a href="/inbox.php">Inbox</a></li>
      <li><a href="/display_blog.php">Post</a></li>
    </ul>
  </div>
</nav>
</div>
<br/><br/><br/>

<!-- The following classes below are hyperlinks to each function for the profile page: Register, Login, Update Profile, and Delete Profile. -->

<div class="container d-flex justify-content-center">
  <div class="page-header">
    <h1 class="text-center">Profile</h1>
  </div>
		<ul class="list-group mt-5 text-white">

		  <li class="list-group-item d-flex justify-content-between align-content-center">
      <a href="/registration.php">
		  	<div class="d-flex flex-row">
		  		<div class="ml-2">
		  			<h3 class="mb-0">Register</h3>
		  			<div class="about">
		  				<span>Click here to register</span>
		  			</div>
		  		</div>
		  	</div>
		  </li>

      <li class="list-group-item d-flex justify-content-between align-content-center">
        <a href="/index.php">
        <div class="d-flex flex-row">
          <div class="ml-2">
            <h3 class="mb-0">Login</h3>
            <div class="about">
              <span>Click here to login</span>
            </div>
          </div>
        </div>
      </li>

      <li class="list-group-item d-flex justify-content-between align-content-center">
        <a href="/update_profile.php">
        <div class="d-flex flex-row">
          <div class="ml-2">
            <h3 class="mb-0">Update Profiles</h3>
            <div class="about">
              <span>Click here to update profile</span>
            </div>
          </div>
        </div>
      </li>

      <li class="list-group-item d-flex justify-content-between align-content-center">
        <a href="/delete_profile.php">
        <div class="d-flex flex-row">
          <div class="ml-2">
            <h3 class="mb-0">Delete</h3>
            <div class="about">
              <span>Click here to delete a profile</span>
            </div>
          </div>
        </div>
      </li>

		</ul>
	</div>

</body>
</html>
