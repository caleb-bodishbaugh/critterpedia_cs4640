<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand text-dark font-weight-bold" href="home.php">
      <img src="img/app_icon.png" height="40px" width="40px" class="d-inline-block align-middle img-fluid" alt="Critterpedia Logo"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="collapsibleNavbar">  
      <ul class="navbar-nav">
        <li class="nav-item active navbar-text">
          <a class="nav-link" href="home.php" id="homeNavLink">Home</a>
        </li>
        <li class="nav-item navbar-text">
          <a class="nav-link" href="fish.php" id="fishNavLink">Fish</a>
        </li>
        <li class="nav-item navbar-text">
          <a class="nav-link" href="bugs.php" id="bugNavLink">Bugs</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item navbar-text">
          <?php if (isset($_SESSION['user'])) { ?>
          <a class="nav-link" href="profile.php"><?php echo $_SESSION['user']; ?></a>
        </li>
        <li class="nav-item navbar-text">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
          <?php }

          else { ?>
          <a class="nav-link" href="login.php">Login</a>
          <?php } ?>
        </li>
      </ul>
    </div>

  </nav>