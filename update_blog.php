<!-- Fisher Byers coded everything on this page -->


<!-- The purpose of this code is to is to create a UI for the user to be able to update their posts and reflect these changes within the database -->


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
$id=$_GET['updateid'];      //grabbing updateid
if(isset($_POST['submit'])){       
  $content=$_POST['content'];
  $date=$_POST['date'];

  

  $sql="UPDATE post set PostId=$id,content='$content',date=$date where PostId=$id";  //database query updating
  $result = $conn->query($sql);
  if($result){
    header('location:display_blog.php');
  }
  else{
    die("Connection failed:" . $conn->connect_error);
  }

}



?>

<!-- Beginning of HTML portion -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>blog page</title>
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
      <li><a href="/display_blog.php">Post</a></li>
    </ul>
  </div>
</nav>
</div>
<br></br>
<br></br>
<br></br>
<br></br>
<div class="container">
    <form method="post">
      <div class="form-group">
        <label>Content</label>
        <input type="text" class="form-control"
        placeholder="Enter content"
        name="content" autocomplete="off">
      </div>

      <div class="form-group">
        <label>Date</label>
        <input type="text" class="form-control"
        placeholder="Enter date"
        name="date" autocomplete="off">
      </div>

<div class="col-auto">
    <button type="submit" class="btn btn-primary" name="submit">Update</button>
  </div>


</div>





</body>
</html>