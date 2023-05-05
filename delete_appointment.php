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

session_start();

if(isset($_GET['deleteid'])){

    $apptID=$_GET['deleteid'];

    $sql="DELETE FROM `appointment` WHERE `ApptNumber`='$apptID'";
    $result = $conn->query($sql);
    if($result){
        header('location:appointments.php');
    }
    else{
        die("Connection failed:" . $conn->connect_error);
    }
    
}


?>