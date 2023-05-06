<!-- 

Filename: 'update_appointment.php'
Author: Izzy Rhoads
Purpose: Functionality to delete a given appointment based on session "updateid". 
Users involved with appointment cannot be changed.

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

$id=$_GET['updateid'];

// UPDATE QUERY
// If the user hits the update button, they should be able to update only the location and time of the appointment by session "updateid", but not the user.
if(isset($_POST['submit'])){
  $time=$_POST['apptTime'];
  $location=$_POST['apptLocation'];

  $sql="UPDATE appointment SET `Time`='$time', `Location`='$location' WHERE ApptNumber='$id'";
  $result = $conn->query($sql);
  if($result){
    header('location:/appointments.php');
  }
  else{
    die("Connection failed:" . $conn->connect_error);
  }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  
  <script src ="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>  
  <script src ="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  <script src ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>  
  <script>  
    $(function() {  
        $('#datetimepicker1').datetimepicker();  
    });  
  </script> 
    <link rel ="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
    <link rel ="stylesheet" href ="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">  
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
        <li><a href="/">Appointments</a></li>
        <li><a href="/inbox.php">Inbox</a></li>
    </ul>
  </div>
</nav>
</br></br></br></br>



<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="container d-flex justify-content-center">
            <div class="page-header">
                <h1 class="text-center">Edit Appointment</h1>
            </div>
            <form method="post">
            <div class="form-group">  
                <div class="container">
                  <!-- Edit time of appointment with dateTime picker from bootstrap -->
                    <h3> Edit Appointment Time </h3>
                    <div class ='input-group date' id='datetimepicker1'>  
                        <input type ='text' class="form-control" name="apptTime"/>  
                        <span class ="input-group-addon">  
                        <span class ="glyphicon glyphicon-calendar"></span>  
                        </span>  
                    </div> 
                </div>
            </div>
            <div class="form-group">  
                <div class="container">
                  <!-- Edit appointment location via text field -->
                    <h3> Edit Appointment Location </h3>
                    <input type="text" class="form-control" name="apptLocation">
                </div>
            </div>
              <button type="submit" class="btn btn-primary" name="submit">Save</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>