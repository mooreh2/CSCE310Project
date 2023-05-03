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

if(isset($_GET['deleteid']))
{
    $id = $_GET['deleteid'];
    $sql="Delete from `user` where UserID=$id";
    $result=mysqli_query($con, $sql);
    if($result){
        echo "Deleted!";
    }
    else{
        die(mysqli_error($con));
    }
}

?>