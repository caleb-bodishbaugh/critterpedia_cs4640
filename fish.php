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
  <?php include('header.php'); ?>

  <div class="container-fluid col-md-11">
    <h1 class="">Fish Database</h1>

    <form method="POST" name="searchFish">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputDate">Date</label>
          <input type="date" class="form-control" id="inputDate" placeholder="">
        </div>
        <div class="form-group col-md-6">
          <label for="inputTime">Time</label>
          <input type="time" class="form-control" id="inputTime" placeholder="" step="60">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputLocation">Hemisphere</label>
          <select class="form-control" id="inputLocation">
            <option>Northern</option>
            <option>Southern</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="inputName">Name</label>
          <input type="Name" class="form-control" id="inputName" placeholder="Name">
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
          <th scope="col">Habitat</th>
          <th scope="col">Shadow</th>
          <th scope="col">Bell Value</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">5</th>
          <td>
            <a href="static-fish.html" class="customLink">
            Carp
            </a>
          </td>
          <td class="w-25">
            <a href="static-fish.html" class="customLink">
            <img class="img-thumbnail" src="img/Carp_NH_Icon.png" height="40px" width="40px"/>
            </a>
          </td>
          <td>River</td>
          <td>Large</td>
          <td>300</td>
        </tr>
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