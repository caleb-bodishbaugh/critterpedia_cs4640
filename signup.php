<?php require('connect-db.php');?>
<?php include('header.php'); ?>
<?php
$error_msg = "";
if (isset($_POST['username']) and isset($_POST['email']) and isset($_POST['pwd'])) {
  try {
    global $db;

    $username_form = $_POST['username'];
    $email_form = $_POST['email'];
    $password_form = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

    $query = "SELECT * FROM accounts WHERE email = :email OR username = :usr";
    
    $statement_exists = $db->prepare($query);
    $statement_exists->bindValue(':usr', $username_form);
    $statement_exists->bindValue(':email', $email_form);
	  $statement_exists->execute();

    if ($statement_exists->rowCount() > 0) {
      $error_msg = "User already exists! </br>";
      $statement_exists->closeCursor();
    }

    else {
      $query = "INSERT INTO accounts (username, email, password) VALUES (:usr, :email, :pwd)";
      $statement_new = $db->prepare($query);
      $statement_new->bindValue(':usr', $username_form);
      $statement_new->bindValue(':email', $email_form);
      $statement_new->bindValue(':pwd', $password_form);
	    $statement_new->execute();
      $statement_new->closeCursor();
      header('Location: home.php');
    }
  } catch (Exception $e) {
    $error_message = $e->getMessage();
    echo "<p>Error message: $error_message </p>";
  }
}
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

  <title>Critterpedia - Sign-Up</title>
  <meta name="description" content="Animal Crossing: New Horizons Fish and Bugs">
  <meta name="author" content="Caleb Bodishbaugh">
  <meta name="keywords" content="Animal Crossing, Animal Crossing: New Horizions, Fish, Bugs, Critters, Critterpedia">
  
  <link rel="apple-touch-icon" sizes="180x180" href="https://storage.googleapis.com/webpl-kbod/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="https://storage.googleapis.com/webpl-kbod/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="https://storage.googleapis.com/webpl-kbod/favicon-16x16.png">
  <link rel="manifest" href="https://storage.googleapis.com/webpl-kbod/site.webmanifest">
  <link rel="mask-icon" href="https://storage.googleapis.com/webpl-kbod/safari-pinned-tab.svg" color="#f3cf69">
  <meta name="msapplication-TileColor" content="#f3cf69">
  <meta name="theme-color" content="#f3cf69">

  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
</head>

<body style="background-color: #F3CF69;"">
  

  <div class="container-fluid col-md-6" style="margin-top: 2%;">
    <h1 class="">Create an Account!</h1>

    <form name="newUserInfo" method="post" onsubmit="return checkRegistration()" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="form-group">
            <label for="newUsername">Username</label>
            <input type="text" class="form-control" id="newUsername" aria-describedby="usernameHelp" placeholder="Username" autofocus required name="username">
            <small id="usernameHelp" class="form-text text-muted">Your username must be 4-16 characters long and must not contain spaces, special characters or emoji.</small>
            <small id="msg_usr" class="form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required name="email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="inputNewPassword">Password</label>
            <input type="password" class="form-control" id="inputNewPassword" placeholder="Password" required name="pwd">
            <small id="passwordHelpBlock" class="form-text text-muted">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
            </small>
            <small id="msg_pwd" class="form-text text-danger"></small>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" placeholder="Password" required>
            <small id="msg_pwd_confirm" class="form-text text-danger"></small>
        </div>
        <button type="submit" class="btn btn-info">Create</button>
        <small id="msg_pwd" class="form-text text-danger"><?php echo $error_msg;?></small>
    </form>
  </div>

  
  <footer>
    <p class="text-muted text-center">
      &copy Caleb Bodishbaugh 2021
    </p>
  </footer>
  
  <script src="js/scripts.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
