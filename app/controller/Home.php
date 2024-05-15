<?php
namespace app\controller;

use app\core\Controller;
use app\models\Post;
use app\models\User;

class Home extends Controller
{
  use User, Post;
  public function check()
  {
    $this->view('home');

  }
}
