<?php require('connect-db.php'); ?>
<?php include('header.php'); ?>
<?php 
function get_fish_json_api($name, $key) {
  $fish_name = strtolower($name);
  $fish_name = ucfirst($fish_name);

  try {
    $response = file_get_contents("https://api.nookipedia.com/nh/fish/". $fish_name . "?api_key=" . $key);
    $response = json_decode($response);
  } catch (Exception $e) {
    $error_message = $e->getMessage();
    echo "<p>Error message: $error_message </p>";
  }

  return $response;
}

$nookipedia_api_key = "631bc88e-43c9-4e23-8368-ae7eca156c8d";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['name'])) {
   $name = $_GET['name'];
   $fish_json = get_fish_json_api($name, $nookipedia_api_key);
  if (isset($_GET['btnaction'])) {
    try 
        { 	
            global $db;
            $query = 'SELECT * FROM accounts WHERE username = :usr';
            $statement = $db->prepare($query);
            $statement->bindValue(':usr', $_SESSION['user']);
            $statement->execute();

            $results = $statement->fetch();
            $user_id = $results["accountID"];
            $statement->closeCursor();
            switch ($_GET['btnaction']) 
            {
              case 'Insert': insertData($user_id, $fish_json->number);  break;
              case 'Delete': deleteData($user_id, $fish_json->number);  break;
            }
        }
        catch (Exception $e)       // handle any type of exception
        {
            $error_message = $e->getMessage();
            echo "<p>Error message: $error_message </p>";
        }
  }

}

else {
  header("Location: fish.php");
}


function insertData($userid, $fishid)
{
    global $db;

	// $query = "INSERT INTO courses (course_ID, course_desc) VALUES ('cs4640', 'WebPL')";
    $query = "INSERT INTO accountFish (accountID, FishID) VALUES (:accountID, :fishID)";
    $statement = $db->prepare($query);
    $statement->bindValue(':accountID', intval($userid));
    $statement->bindValue(':fishID', intval($fishid));
	  $statement->execute();

    $statement->closeCursor();
}

function deleteData($userid, $fishid)
{
    global $db;

    $query = "DELETE FROM accountFish WHERE accountID = :usr AND FishID = :fish";
    
    $statement = $db->prepare($query);
    $statement->bindValue(':usr', intval($userid));
    $statement->bindValue(':fish', intval($fishid));
	  $statement->execute();

    $statement->closeCursor();
}
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

  <title>Critterpedia: An Animal Crossing Resource</title>
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

<body style="background-color: #F3CF69;">



  <div class="container col-7" style="margin-top:2%">
    <div class ="rounded" id="infoBox">
      <div class="row justify-content-center">
      <div id="fishTitle" class="col-8 infoBoxEntry d-flex flex-row align-items-center rounded">
        <p class="col-sm float-left">#<?php echo $fish_json->number; ?></p>
        <center><p class="col-sm"><?php echo $fish_json->name; ?></p></center>
        <div class="col-sm">
          <img class="float-right" src="<?php echo $fish_json->image_url; ?>" height="40px" width="40px"/>
        </div>
      </div>
      </div>
      <center>
      <div class="row justify-content-center infoBoxEntry col-8">
      <ul class="list-group" style="color: black;">
        <li class="list-group-item">Time of day: <?php echo $fish_json->north->availability_array[0]->time; ?></li>
        <li class="list-group-item">Location: <?php echo $fish_json->location; ?></li>
        <li class="list-group-item">Shadow size: <?php echo $fish_json->shadow_size; ?></li>
        <li class="list-group-item">Bell value: <?php echo $fish_json->sell_nook; ?> (Nook price)   <?php echo $fish_json->sell_cj; ?> (CJ price)</li>
        <li class="list-group-item">Catchphrase: <?php echo $fish_json->catchphrases[0]; ?></li>
        <li class="list-group-item"><a href="<?php echo $fish_json->url; ?>">More Info</a></li>
      </ul>
      </div>
      </center>
    </div>


  </div>

<?php if (isset($_SESSION['user'])) { 
  $have_caught = FALSE;
  try {
    global $db;
    $query = 'SELECT * FROM accounts WHERE username = :usr';
    $statement = $db->prepare($query);
    $statement->bindValue(':usr', $_SESSION['user']);
    $statement->execute();

    $results = $statement->fetch();
    $user_id = $results["accountID"];
    $statement->closeCursor();

    $query = 'SELECT * FROM accountFish WHERE accountID = :id AND fishID = :fish';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $user_id);
    $statement->bindValue(':fish', $fish_json->number);
    $statement->execute();
    $results = $statement->fetchAll();

  } catch (Exception $e) {
    $error_message = $e->getMessage();
    echo "<p>Error message: $error_message </p>";
  }
  
  if ($statement->rowCount() > 0) {
    $have_caught = TRUE;
  }

  if ($have_caught) {
?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
<div class="row justify-content-center" style="margin-top: 2%;">
<p class="p-2">You <strong>HAVE</strong> caught this fish!</p>
<input type="submit" name="btnaction" value="Delete" class="btn btn-info p-2" data-toggle="button" />
</div>
<input type="hidden" name="name" value="<?php echo $_GET['name']; ?>"/>
</form>
<?php } 
else { ?>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
<div class="row justify-content-center" style="margin-top: 2%;">
<p class="p-2">You have <strong>NOT</strong> caught this fish!</p>
<input type="submit" name="btnaction" value="Insert" class="btn btn-info p-2" data-toggle="button" />
</div>
<input type="hidden" name="name" value="<?php echo $_GET['name']; ?>" />
</form>
<?php
} }
?>

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