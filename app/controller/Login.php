<?php
namespace app\controller;

use app\core\Controller;
use app\models\User;

/**
 * Controller for Login 
 * @extends Controller
 */
class Login extends Controller
{
  use User;
  public function check()
  {
    if (isset($_POST['login'])) {
      // Create an instance of the Database class
      $this->connection('localhost', 'kul', 'Kul@123456', 'USER');
      // Get form data
      $username = $_POST["username"];
      $password = $_POST["password"];
      $this->checkUserCredentails($username, $password);
      // Close the database connection
      $this->closeConnection();
    }
    $this->view('login');
  }
}
