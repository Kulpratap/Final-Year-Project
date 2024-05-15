<?php

/**
 * @file
 * Contains \app\controller\CreatePost.
 */

namespace app\controller;

use app\core\Controller;
use app\models\Post;
use app\core\Config;

/**
 * Provides a controller for creating posts.
 */
class CreatePost extends Controller {
  
  use Post;
  
  /**
   * Checks if the user is logged in and handles post creation.
   *
   * @return void
   *   Displays the create post view if the user is logged in,
   *   otherwise redirects to the 404 page.
   */
  public function check() {
    // Initialize Config class
    new Config();
    
    // Check if form is submitted
    if (isset($_POST['submit'])) {
      // Retrieve form data
      $content = $_POST['description'];
      $category = $_POST['category'];
      $title = $_POST['title'];
      $amount = $_POST['amount'];
      $gardening_tips=$_POST['gardening_tips'];
      // Check if file is uploaded
      if ($_FILES['filetoupload']['error'] === UPLOAD_ERR_OK) {
        // Move uploaded file to images folder
        $filename = $_FILES["filetoupload"]["name"];
        $tempname = $_FILES["filetoupload"]["tmp_name"];
        $folder = "../images/" . $filename;
        move_uploaded_file($tempname, $folder);

        // Create post
        $this->connection(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
        $this->createPost($content, $folder, $category, $title, $amount,$gardening_tips);
      } else {
        // Display error if no image uploaded
        echo "<p style='color:red;'>Error: Please upload an image.</p>";
      }
    }
    
    // Check if user is logged in
    if ($_SESSION['loggedin'] == true) {
      // If logged in, display create post view
      $this->view('createpost');
    } else {
      // If not logged in, display 404 page
      $this->view('404');
    }
  }
}
