<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
  case '/':
    require 'home.php';
    break;
  case '/home.php':                   // URL (without file name) to a default screen
    require 'home.php';
    break;
  case '/fish.php':     // if you plan to also allow a URL with the file name 
    require 'fish.php';
    break;              
  case '/bugs.php':
    require 'bugs.php';
    break;
  case '/login.php':
    require 'login.php';
    break;
  case '/logout.php':
    require 'logout.php';
    break;
  case '/signup.php':
    require 'signup.php';
    break;  
  case '/profile.php':
    require 'profile.php';
    break;
  case '/fish-detail.php':
    require 'fish-detail.php';
    break;
  case '/bug-detail.php':
    require 'bug-detail.php';
    break;
  case '/comment.php':
    require 'comment.php';
    break;
  default:
    http_response_code(404);
    exit('Not Found');
}  
?>