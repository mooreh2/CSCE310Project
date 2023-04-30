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

<h1 class="text-center">Appointments</h1>

<div class="schedule-body">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th style="text-align:center">Date</th>
                <th style="text-align:center">Time</th>
                <th style="text-align:center">User</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Date1</td>
                <td>Time1</td>
                <td>User1</td>
            </tr>
            <tr>
                <td>Date2</td>
                <td>Time2</td>
                <td>User2</td>
            </tr>
            <tr>
                <td>Date3</td>
                <td>Time3</td>
                <td>User3</td>
            </tr>
        </tbody>
    </table>
</div>

<button class="create-apt-btn">Create Appointment</button>

</body>
</html>