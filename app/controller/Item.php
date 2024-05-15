<?php
namespace app\controller;

use app\core\Controller;
use app\models\Post;
use app\models\User;

/**
 * This class handles the logic related to items.
 */
class Item extends Controller {
  use User, Post;
  /**
   * @var array $_SESSION The session array containing login information.
   */
  public function check() {
    // Check if the user is logged in.
    if ($_SESSION['loggedin'] == true) {
      $this->view('item');
    } else {
      header('Location: /public/login');
    }
  }
}
