<?php require('connect-db.php'); ?>
<?php include('header.php'); ?>
<?php if (!isset($_SESSION['user'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
  }
?>
<?php


try {
  global $db;
  $query = 'SELECT * FROM accounts WHERE username = :usr';
  $statement = $db->prepare($query);
  $statement->bindValue(':usr', $_SESSION['user']);
  $statement->execute();

  $results = $statement->fetch();
  $user_id = $results["accountID"];
  $statement->closeCursor();

  $query = 'SELECT fishID FROM accountFish WHERE accountID = :id';
  $statement = $db->prepare($query);
  $statement->bindValue(':id', $user_id);
  $statement->execute();
  $results = $statement->fetchAll();

} catch (Exception $e) {
  $error_message = $e->getMessage();
  echo "<p>Error message: $error_message </p>";
}

$fish_names = Array('1' => 'Bitterling', '2' => 'Pale chub', '3' => 'Crucian Carp', '4' => 'Dace',
  '5' => 'Carp', '6' => 'Koi', '7' => 'Goldfish', '8' => 'Pop-eyed goldfish',             
  '9' => 'Ranchu goldfish', '10' => 'Killifish', '11' => 'Crawfish', '12' => 'Soft-shelled turtle',
  '13' => 'Snapping Turtle', '14' => 'Tadpole', '15' => 'Frog', '16' => 'Freshwater goby',
  '17' => 'Loach', '18' => 'Catfish', '19' => 'Giant snakehead', '20' => 'Bluegill',
  '21' => 'Yellow perch', '22' => 'Black bass', '23' => 'Tilapia', '24' => 'Pike',
  '25' => 'Pond smelt', '26' => 'Sweetfish', '27' => 'Cherry salmon', '28' => 'Char',
  '29' => 'Golden trout', '30' => 'Stringfish', '31' => 'Salmon', '32' => 'King salmon',
  '33' => 'Mitten crab', '34' => 'Guppy', '35' => 'Nibble fish', '36' => 'Angelfish',
  '37' => 'Betta', '38' => 'Neon tetra', '39' => 'Rainbowfish', '40' => 'Piranha',
  '41' => 'Arowana', '42' => 'Dorado', '43' => 'Gar', '44' => 'Arapaima',
  '45' => 'Saddled bichir', '46' => 'Sturgeon', '47' => 'Sea butterfly', '48' => 'Sea horse',
  '49' => 'Clown fish', '50' => 'Surgeonfish', '51' => 'Butterfly fish', '52' => 'Napoleonfish',
  '53' => 'Zebra turkeyfish', '54' => 'Blowfish', '55' => 'Puffer fish', '56' => 'Anchovy',
  '57' => 'Horse mackerel', '58' => 'Barred knifejaw', '59' => 'Sea bass', '60' => 'Red snapper',
  '61' => 'Dab', '62' => 'Olive flounder', '63' => 'Squid', '64' => 'Moray eel',
  '65' => 'Ribbon eel', '66' => 'Tuna', '67' => 'Blue marlin', '68' => 'Giant trevally',
  '69' => 'Mahi-mahi', '70' => 'Ocean sunfish', '71' => 'Ray', '72' => 'Saw shark',
  '73' => 'Hammerhead shark', '74' => 'Great white shark', '75' => 'Whale shark', '76' => 'Suckerfish',
  '77' => 'Football fish', '78' => 'Oarfish', '79' => 'Barreleye', '80' => 'Coelacanth'
);



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


  <h1 class="text-center">
      Hi, <?php echo $_SESSION['user']; ?>!
  </h1>


  <h3 class="text-center p-2">Fish you've caught: </h3>
  <ul class="text-center list-group p-2">
    <?php foreach ($results as $fish) { ?>
    <li class="list-group-item"><?php echo $fish_names[$fish['fishID']]; ?></li>
    <?php } ?>
  </ul>

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