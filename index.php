<?php

$servername = "localhost";
$username = "mooreh2";
$password = "duBhop-7huhpo-qavkyb";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if($conn -> connect_error)
{
die("Connection failed:" . $conn->connect_error);

}
print("Connection successful");


?>
<!DOCTYPE html>
<html>
<head>
<title>My First Website</title>
</head>
<body>

<h1>Hello, World!</h1>


</body>
</html>