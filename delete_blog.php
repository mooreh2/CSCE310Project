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

if(isset($_GET['deleteid'])){

    $postid=$_GET['deleteid'];

    $sql="DELETE FROM post WHERE PostId=$postid";
    $result = $conn->query($sql);
    if($result){
        header('location:display_blog.php');
    }
    else{
        die("Connection failed:" . $conn->connect_error);
    }
    
}


?>