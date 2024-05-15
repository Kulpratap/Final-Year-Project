<?php
namespace app\controller;
use app\core\Controller;
use app\core\Config;
class Logout extends Controller
{
 
  public function check()
  {
    new Config();
    session_start();
    $_SESSION = array(); // Clear all session variables
    session_destroy();

    // Redirect to the home page or login page
    header('Location: /public/home'); // Change the URL as needed
    exit;
  }
}