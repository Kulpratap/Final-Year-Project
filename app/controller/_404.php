<?php

/**
 * @file
 * Contains \app\controller\_404.
 */

namespace app\controller;

use app\core\Controller;

/**
 * Provides a controller for handling 404 errors.
 */
class _404 extends Controller {
  
  /**
   * Displays the 404 error page.
   *
   * @return void
   *   Displays a message indicating that the page is not found.
   */
  public function check() {
    // Display 404 error message
    echo "<h1>404 page not found</h1>";
  }
}
