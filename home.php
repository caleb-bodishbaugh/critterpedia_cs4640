<?php include('header.php'); ?>
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
  

  <div class="container-fluid ml-auto">
  <h1 class="display-3 text-center" id="banner">Welcome to Critterpedia!</h1>
  <p class="lead text-center">
    A fan-made website to find all your favorite critters from Animal Crossing: New Horizons!
  </p>
  </div>


  <div class="container" id="logoLinksContainer" style="margin-top: 2.5%;">
    <div class="row justify-content-center">
      <img src="img/ac_logo_upscaled.png" class="col-sm"/>

      <div class="col-sm" id="critterLinks">
        <p class="text-justify h1">What are you looking for?</p>
        <div class="row justify-content-center">
          <div class="col text-justify ml-auto" id="bugLink">
            <a href="bugs.php" class="customLink">
              <img class="img_unfocused" src="img/NH-Net_icon.png" id="netIcon"/><img class="img_focused" src="img/NH-Net_icon_focus.png"/>
              <p class="h2 link">Bugs!</p>
            </a>
          </div>
          <div class="col text-justify ml-auto" id="fishLink">
            <a href="fish.php" class="customLink">
              <img class="img_unfocused" src="img/NH-Fishing_rod_icon.png" id="rodIcon"/><img class="img_focused" src="img/NH-Fishing_rod_icon_focus.png"/>
              <p class="h2 link">Fish!</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <p class="text-muted text-center">
      &copy Caleb Bodishbaugh 2021 | <a href="https://angular-webpl-kbod.uk.r.appspot.com/">Contact Me</a>
    </p>
  </footer>
  <script type="text/javascript">
    
    
  </script>
  <script src="js/scripts.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>