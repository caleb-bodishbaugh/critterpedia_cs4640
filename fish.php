<?php include('header.php'); ?>
<?php
$nookipedia_api_key = "631bc88e-43c9-4e23-8368-ae7eca156c8d";
$one_fish = FALSE; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['name']) && $_POST['name'] != "") {
    $one_fish = TRUE;
    $fish_name = $_POST['name'];
    $fish_name = str_replace(" ", "_", $fish_name);
    $fish_name = strtolower($fish_name);
    $fish_name = ucfirst($fish_name);
    try {
      $response = file_get_contents("https://api.nookipedia.com/nh/fish/". $fish_name . "?api_key=" . $nookipedia_api_key);
      $response = json_decode($response);
    } catch (Exception $e) {
      $error_message = $e->getMessage();
      echo "<p>Error message: $error_message </p>";
    }
  }

  else {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];

    $month = substr($date, 5, 2);

    if (substr($month, 0 , 1) == "0") {
      $month = substr($month, 1, 1);
    }
    try {
      $response = file_get_contents("https://api.nookipedia.com/nh/fish?month=" . $month . "&api_key=" . $nookipedia_api_key);
      $response = json_decode($response);
    } catch (Exception $e) {
      $error_message = $e->getMessage();
      echo "<p>Error message: $error_message </p>";
    }
  }
} ?>


<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

  <title>Critterpedia - Fish Database</title>
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

<body style="background-color: #F3CF69;" onload="setDefaultDateandTime()">

  <div class="container-fluid col-md-11">
    <h1 style="margin-top: 2%" class="">Fish Database</h1>

    <form method="POST" name="searchFish" action="<?php $_SERVER['PHP_SELF'] ?>">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputDate">Date</label>
          <input type="date" class="form-control" id="inputDate" placeholder="" name="date">
        </div>
        <div class="form-group col-md-6">
          <label for="inputTime">Time</label>
          <input type="time" class="form-control" id="inputTime" placeholder="" step="60" name="time">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputLocation">Hemisphere</label>
          <select class="form-control" id="inputLocation" name="location">
            <option>Northern</option>
            <option>Southern</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="inputName">Name</label>
          <input type="Name" class="form-control" id="inputName" placeholder="Name" name="name">
          <small id="msg_name" class="form-text text-danger"></small>
        </div>
      </div>
      <button type="submit" class="btn btn-info">Search</button>
    </form>
  </div>

  <div class="container-fluid col-md-11" style="margin-top: 2%">
    <table class="table table-striped table-bordered table-hover table-info">
      <thead class="thead-light">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Icon</th>
          <th scope="col">Location</th>
          <th scope="col">Shadow</th>
          <th scope="col">Bell Value</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      if ($one_fish) {
      ?>
        <tr>
          <th scope="row"><?php echo $response->number; ?></th>
          <td>
            <a href="fish-detail.php?name=<?php echo str_replace(" ", "_", $response->name); ?>" class="customLink">
            <?php echo $response->name; ?>
            </a>
          </td>
          <td class="w-25">
            <a href="fish-detail.php?name=<?php echo str_replace(" ", "_", $response->name); ?>" class="customLink">
            <img class="img-thumbnail" src="<?php echo $response->image_url; ?>" height="40px" width="40px"/>
            </a>
          </td>
          <td><?php echo $response->location; ?></td>
          <td><?php echo $response->shadow_size; ?></td>
          <td><?php echo $response->sell_nook; ?></td>
        </tr>
      <?php 
      }
      else {

        if (isset($_POST['location']) and isset($_POST['time'])) {
          $time = intval($_POST['time']);
          $time = $time * 100;
          if ($_POST['location'] == "Northern") {
            foreach ($response->north as $critter) {
              $can_catch = FALSE;
              $time_available = $critter->north->times_by_month->$month;
              if ($time_available == "4 PM – 9 AM") {
                if ($time >= 1600 or $time <= 900) {
                  $can_catch = TRUE;
                }
              }

              elseif ($time_available == "4 AM – 9 PM") {
                if ($time >= 400 or $time <= 2100) {
                  $can_catch = TRUE;
                }
              }

              elseif ($time_available == "All day") {
                $can_catch = TRUE;
              }

              if ($can_catch) {
              ?>
            <tr>
              <th scope="row"><?php echo $critter->number; ?></th>
              <td>
                <a href="fish-detail.php?name=<?php echo str_replace(" ", "_", $critter->name); ?>" class="customLink">
                <?php echo $critter->name; ?>
                </a>
              </td>
              <td class="w-25">
                <a href="fish-detail.php?name=<?php echo str_replace(" ", "_", $critter->name); ?>" class="customLink">
                <img class="img-thumbnail" src="<?php echo $critter->image_url; ?>" height="40px" width="40px"/>
                </a>
              </td>
              <td><?php echo $critter->location; ?></td>
              <td><?php echo $critter->shadow_size; ?></td>
              <td><?php echo $critter->sell_nook; ?></td>
            </tr>
      <?php }
      }
          }

          else {
            foreach ($response->south as $critter) { 
              $can_catch = FALSE;
              $time_available = $critter->south->times_by_month->$month;
              if ($time_available == "4 PM – 9 AM") {
                if ($time >= 1600 or $time <= 900) {
                  $can_catch = TRUE;
                }
              }

              elseif ($time_available == "4 AM – 9 PM") {
                if ($time >= 400 or $time <= 2100) {
                  $can_catch = TRUE;
                }
              }

              elseif ($time_available == "All day") {
                $can_catch = TRUE;
              }

              if ($can_catch) {
              ?>
              <tr>
                <th scope="row"><?php echo $critter->number; ?></th>
                <td>
                  <a href="fish-detail.php?name=<?php echo str_replace(" ", "_", $critter->name); ?>" class="customLink">
                  <?php echo $critter->name; ?>
                  </a>
                </td>
                <td class="w-25">
                  <a href="fish-detail.php?name=<?php echo str_replace(" ", "_", $critter->name); ?>" class="customLink">
                  <img class="img-thumbnail" src="<?php echo $critter->image_url; ?>" height="40px" width="40px"/>
                  </a>
                </td>
                <td><?php echo $critter->location; ?></td>
                <td><?php echo $critter->shadow_size; ?></td>
                <td><?php echo $critter->sell_nook; ?></td>
              </tr>
          <?php
              }
            }
          }
      }
     } ?>
      </tbody>
    </table>
  </div>
  <footer>
    <p class="text-muted text-center">
      &copy Caleb Bodishbaugh 2021
    </p>
  </footer>
  <script src="js/scripts.js"></script>
  <script type="text/javascript">
    var search_name = document.getElementById("inputName");
    search_name.addEventListener('blur', checkSearchName, false);
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>