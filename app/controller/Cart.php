<?php

/**
 * @file
 * Contains \app\controller\Cart.
 */

namespace app\controller;

use app\core\Controller;
use app\models\Post;
use app\models\User;

/**
 * Provides a controller for managing the shopping cart.
 */
class Cart extends Controller {
  
  use User, Post;
  
  /**
   * Checks if the user is logged in and displays the cart.
   *
   * @return void
   *   Displays the cart view if the user is logged in,
   *   otherwise redirects to the login page.
   */
  public function check() {
    // Check if the user is logged in
    if ($_SESSION['loggedin'] == true) {
      // If logged in, display the cart view
      $this->view('cart');
    } else {
      // If not logged in, redirect to the login page
      header('Location: /public/login');
    }
  }
}
