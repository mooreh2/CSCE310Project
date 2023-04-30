<?php

$servername = "localhost";
$username = "root";

// Create connection
$conn = new mysqli($servername, $username);

// Check connection
if($conn -> connect_error)
{
die("Connection failed:" . $conn->connect_error);

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="appointments.css">
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
        <li><a href="/appointments.php">Appointments</a></li>
        <li><a href="/inbox.php">Inbox</a></li>
    </ul>
  </div>
</nav>


<div class="container d-flex justify-content-center">
  <div class="page-header">
    <h1 class="text-center">Appointments</h1>
  </div>
    <ul class="list-group mt-5 text-white">

		<li class="list-group-item d-flex justify-content-between align-content-center">
        <a href="/update_appointment.php">
        <div class="d-flex flex-row">
            <div class="ml-2">
                <h3 class="mb-0">John Smith</h3>
                <div class="about">
                    <span>Date: Jan 21, 2020</span>
                </div>
                    <div class="about">
                    <span>Time: 3:00 pm</span>
                </div>
            </div>
		</div>
		</li>

      <li class="list-group-item d-flex justify-content-between align-content-center">
      <a href="/update_appointment.php">
      <div class="d-flex flex-row">
          <div class="ml-2">
            <h3 class="mb-0">John Smith</h3>
            <div class="about">
		  		<span>Date: Jan 21, 2020</span>
			</div>
            <div class="about">
		  	    <span>Time: 3:00 pm</span>
		  	</div>
          </div>
        </div>
      </li>

      <li class="list-group-item d-flex justify-content-between align-content-center">
        <a href="/update_appointment.php">
        <div class="d-flex flex-row">
          <div class="ml-2">
            <h3 class="mb-0">John Smith</h3>
            <div class="about">
		  	    <span>Date: Jan 21, 2020</span>
		  	</div>
            <div class="about">
		  		<span>Time: 3:00 pm</span>
		  	</div>
          </div>
        </div>
      </li>
      
      <li class="list-group-item d-flex justify-content-between align-content-center">
        <a href="/update_appointment.php">
        <div class="d-flex flex-row">
          <div class="ml-2">
            <h3 class="mb-0">John Smith</h3>
            <div class="about">
		  		<span>Date: Jan 21, 2020</span>
			</div>
            <div class="about">
    			<span>Time: 3:00 pm</span>
  			</div>
          </div>
        </div>
      </li>

		</ul>
    <a href="/create_appointment.php" class="create-apt-btn" role="button">Create Appointment</a>
</div>

</body>
</html>