<?php

/**
 * @file
 * Contains \app\controller\Forgotpassword.
 */

namespace app\controller;

use app\core\Controller;
use app\models\User;

/**
 * Provides a controller for handling the forgot password functionality.
 */
class Forgotpassword extends Controller {
  
  use User;
  
  /**
   * Checks if the user has submitted the forgot password form.
   *
   * @return void
   *   Retrieves mail and triggers the forgot password process if submitted.
   *   Displays the forgot password form if the user is not logged in.
   *   Redirects to the home page if the user is already logged in.
   */
  public function check() {
    // Check if the forgot password form is submitted
    if (isset($_POST["submit"])) {
      // Retrieve mail and trigger the forgot password process
      $this->retriveMail($_POST['mail']);
      $this->forgotPassword();
    }

    // Check if the user is not logged in
    if ($_SESSION['loggedin'] == false) {
      // Display the forgot password form
      $this->view('forgotpassword');
    } else {
      // Redirect to the home page if the user is already logged in
      header("Location:home");
    }
  }
}
