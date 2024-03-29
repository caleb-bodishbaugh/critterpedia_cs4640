<?php
require('connect-db.php');

session_start();
$error_msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  
  $email_to_check = $_POST['email-login'];
  $pwd_to_check = $_POST['pwd-login'];

  try {
    global $db;

    $query = 'SELECT * FROM accounts WHERE email = :email';
    
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email_to_check);
	  $statement->execute();


    if ($statement->rowCount() > 0) {
      $results = $statement->fetch();
      if (password_verify($pwd_to_check, $results['password'])) {
        $_SESSION['user'] = $results['username'];
        $statement->closeCursor();
        echo "<script>window.location.href='home.php';</script>";
        exit;
      }

      else {
        $statement->closeCursor();
        $error_msg = "Incorrect password! <br/>";
      }
    }
  
    else { 
      $error_msg = "Email or password maybe incorrect! </br>";
      $statement->closeCursor();
    }
  } catch (Exception $e) {
    $error_message = $e->getMessage();
    echo "<p>Error message: $error_message </p>";
  }
  
} ?>




<!doctype html>
<html lang="en">
  <!-- using Bootstrap Login template from https://getbootstrap.com/docs/4.0/examples/sign-in/-->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="180x180" href="https://storage.googleapis.com/webpl-kbod/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://storage.googleapis.com/webpl-kbod/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://storage.googleapis.com/webpl-kbod/favicon-16x16.png">
    <link rel="manifest" href="https://storage.googleapis.com/webpl-kbod/site.webmanifest">
    <link rel="mask-icon" href="https://storage.googleapis.com/webpl-kbod/safari-pinned-tab.svg" color="#f3cf69">
    <meta name="msapplication-TileColor" content="#f3cf69">
    <meta name="theme-color" content="#f3cf69">

    <title>Critterpedia - Log-In</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="post" onsubmit="" action="<?php $_SERVER['PHP_SELF'] ?>">
      <a href="home.php"><img class="mb-4" src="img/app_icon.png" alt="" width="72" height="72"></a> 
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email-login">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="pwd-login">
      <small id="msg_pwd" class="form-text text-danger"><?php echo $error_msg;?></small>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="show-password" onclick="showPassword()"> Show Password
        </label>
      </div>
      <button class="btn btn-lg btn-info btn-block" type="submit">Sign in</button>
      <a href="signup.php">Don't have an account? Sign up here!</a>
      <p class="mt-5 mb-3 text-muted">&copy; Caleb Bodishbaugh 2021</p>
    </form>

    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>