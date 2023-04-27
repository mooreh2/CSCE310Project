<!-- 
  PHP Portion of code
  Here we will connect to the database and query important data from said DB
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

$sql = "SELECT * FROM `user`;";
$result = $conn->query($sql);
$result = $result->fetch_all();

?>

<!-- Beginning of HTML portion -->
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
      <li><a href="/">Appointments</a></li>
      <li><a href="/inbox.php">Inbox</a></li>
    </ul>
  </div>
</nav>
</div>
<br></br><br></br>

<!-- Testing query results -->
<?php
  foreach($result as $a) {
    echo '<strong>Username</strong>: ' .$a[3];
    echo '<br/>';
  }
?>

<div class="justify-content-center align-items-center h-500">
<section class="vh-100 gradient-custom justify-content-center align-center">
  <div class="container py-5 h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your username.</p>

              <div class="form-outline form-white mb-4">
                <input type="Username" id="typeEmailX" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX">Username</label>
              </div>

              <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>


            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>

</body>
</html>