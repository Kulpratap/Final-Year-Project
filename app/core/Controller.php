<?php

/**
 * @file
 * Contains \app\core\Controller.
 */

namespace app\core;

/**
 * Provides a base controller class.
 */
class Controller {
  
  /**
   * Displays a view.
   *
   * @param string $name
   *   The name of the view file to be displayed.
   *
   * @return void
   *   Renders the specified view file.
   */
  public function view($name) {
    // Construct the file path for the view file.
    $filename = "../app/views/" . $name . ".view.php";
    
    // Check if the view file exists.
    if (file_exists($filename)) {
      // Require the view file.
      require $filename;
    }
    else {
      // If the view file does not exist, display the 404 view.
      $filename = "../app/views/404.view.php";
      require $filename;
    }
  }
}
