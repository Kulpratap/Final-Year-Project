<?php
namespace app\controller;

use app\core\Controller;
use app\models\Post;
use app\core\Config;

class Setdetails extends Controller
{
  use Post;

  public function check()
  {
    new Config();
    if (isset($_POST['submit'])) {
      $username = $_SESSION['username'];
      $currentUrl = $_SERVER['REQUEST_URI'];
      $urlParts = explode('/', $currentUrl);
      $postId = end($urlParts);
      $name = $_POST['name'];
      $address = $_POST['address'];
      $landmark = $_POST['landmark'];
      $pincode = $_POST['pincode'];
      $username = $_SESSION['username'];
      $this->connection(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
      $order_details = $this->readFromOrderDetails($username);
      if (isset($order_details)) {
        echo "<script>window.location.href='/public/payment/$postId'</script>";
      } else {
        $this->inertIntoOrderDetailsPayement($postId,$name, $address, $landmark, $pincode);
      }
    }
    if ($_SESSION['loggedin'] == true) {
      $this->view('setdetails');
    } else {
      header('Location: login');
    }
  }
}