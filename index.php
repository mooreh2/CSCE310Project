<!-- 
  File Author: Hayden Moore
  File Description:
    This is the home page for our application.
    The user will be prompted to enter their username to log into the system.
    If the entered username is valid, they will be redirected to their profile page.
    Otherwise, an error message will pop up and they will be asked to re-enter a valid username.
-->

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

// Retrieving user information to match user's typed username with db
$userSql = "SELECT * FROM `user`;";
$userResults = $conn->query($userSql);
$userResults = $userResults->fetch_all();


// After user click's submit button, run through existing user's in db
// and check to see if the entered username matches
if(isset($_POST['submit'])) {
  // The POST variable holds the text the user typed into the username textbox
  $typedUser = $_POST['typedUser'];
  $found = false;
  foreach($userResults as $result) {
    if ($typedUser == $result[3]) {
      // Found a match -> set bool to true, start session to pass user to next page, send user ot profile page
      $found = true;
      session_start();
      $_SESSION['typedUser'] = $result;
      
      header('Location: /profile.php');
      exit;
    }
  }
  if (!$found) {
    // Error check if the username entered is not stored in the db
    echo 'ERROR: Please enter a valid username.</br>';
  }
}
?>

<!-- 
  Beginning of HTML portion 
  The styling for this page is simple: 
  essentially only holding the application's nav bar and a prompt to enter their username to log in.
-->
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Page setup -->
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body style="background-color: #eee;">

  <div>
    <!-- Nav bar -->
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
  <br></br><br></br>

  <!-- Below the nav bar, the user will be able to type their username -->
  <div class="justify-content-center align-items-center h-500">
    <section class="vh-100 gradient-custom justify-content-center align-center">
      <div class="container py-5 h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">
                <div class="mb-md-5 mt-md-4 pb-5">
                  <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                  <p class="text-white-50 mb-5">Please enter your username.</p>
                  <form method="post">
                    <div class="form-outline form-white mb-4">
                      <!-- Specifications for input element allow text to be manipulated in PHP portion -->
                      <input name="typedUser" type="Username" id="typeEmailX" class="form-control form-control-lg" />
                      <label class="form-label" for="typeEmailX">Username</label>
                    </div>
                    <button name="submit" class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                  </form>
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