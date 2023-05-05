<!-- Fisher Byers coded everything on this page -->

<!-- The purpose of this code is to create a UI for the user to be able to display their posts that are in the database and make it possible for the user to specific functionalities with their posts. -->


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
      <li><a href="/appointments.php">Appointments</a></li>
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
    <button ><a href="blog.php"
    class="text-light">Add Post</a>
    </button>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">PostId</th>
      <th scope="col">Content</th>
      <th scope="col">Date</th>
      <th scope="col">Operations</th>
      
    </tr>
  </thead>
  <tbody>



  <?php
$sql = "SELECT * FROM post";    //displaying posts from the database
$result = $conn->query($sql);
if($result){
  while($row=mysqli_fetch_assoc($result)){
    $postid=$row['PostId'];
    $content=$row['content'];
    $date=$row['date'];
    echo '<tr>
    <th scope="row">'.$postid.'</th>
    <td>'.$content.'</td>
    <td>'.$date.'</td>
    <td>
    <button><a href="update_blog.php?updateid='.$postid.'">update</a></button>
    <button><a href="delete_blog.php?deleteid='.$postid.'">delete</a></button>
  </td>
  </tr>';
  }
  
}
  ?>
  
  </tbody>
</table>
</div>




</body>
</html>
