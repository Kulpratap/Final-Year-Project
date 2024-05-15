<?php

namespace app\controller;

use app\core\Controller;
use app\models\Post;
use app\core\Config;

/**
 * Controller class for editing posts.
 */
class EditPost extends Controller {

  use Post;

  /**
   * Checks submitted post data and updates post if needed.
   *
   * @return void
   */
  public function check() {
    new Config();

    // Check if form is submitted.
    if (isset($_POST['submit'])) {
      // Get the current URL.
      $currentUrl = $_SERVER['REQUEST_URI'];
      $urlParts = explode('/', $currentUrl);
      $postId = end($urlParts);
      $title = $_POST['title'];
      $amount = $_POST['amount'];
      $newContent = $_POST['content'];

      // Connect to the database.
      $this->connection(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);

      // Update the post.
      $this->updatePost($newContent, $title, $amount, $postId);
    }

    // Render the edit post view.
    $this->view('editpost');
  }
}
