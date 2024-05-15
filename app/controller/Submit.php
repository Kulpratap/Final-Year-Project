<?php
namespace app\controller;

use app\core\Controller;
use app\models\Post;
use app\core\Config;
use app\models\User;

class Submit extends Controller
{
  use User, Post;
  public function check()
  {
    new Config();
    $currentUrl = $_SERVER['REQUEST_URI'];
    $urlParts = explode('/', $currentUrl);
    $postId = end($urlParts);
    $username=$_SESSION['username'];
    $this->connection(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
    $this->deletefromCart($postId,$username);
    $this->insertIntoOrders($postId,$username);
    echo "<script>alert('Payment Successfull'); window.location.href='/public/profile'</script>";
  }
}