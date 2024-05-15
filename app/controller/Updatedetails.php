<?php
namespace app\controller;

use app\core\Controller;
use app\models\Post;
use app\core\Config;

class Updatedetails extends Controller
{
  use Post;

  public function check()
  {
    new Config();
    if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $address = $_POST['address'];
      $landmark = $_POST['landmark'];
      $pincode = $_POST['pincode'];
      $username = $_SESSION['username'];
      $this->connection(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
      $order_details = $this->readFromOrderDetails($username);
      if (isset($order_details)) {
        $this->editOrderDetails($name, $address, $landmark, $pincode);
      } else {
        $this->inertIntoOrderDetails($name, $address, $landmark, $pincode);
      }
    }
    if ($_SESSION['loggedin'] == true) {
      $this->view('updatedetails');
    } else {
      header('Location: login');
    }
  }
}