<?php
namespace app\models;

use app\core\Database;

trait Post
{
  use Database;
  public function createPost($content, $image_path, $category, $title, $amount,$gardening_tips)
  {
    $user_name = $_SESSION['username'];
    $this->conn->begin_transaction();
    $sql = "INSERT INTO posts (user_name, content, image_path, amount, Title, category,gardening_tips) VALUES ('$user_name', '$content', '$image_path', '$amount', '$title', '$category','$gardening_tips')";
    try {
      // Execute queries  
      $query = $this->conn->query($sql);
      // Check if all queries were successful
      if ($query) {
        // Commit transaction
        $this->conn->commit();
        // Display success message and redirect after 3 seconds
        echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">';
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>';
        echo '<div class="alert alert-success" role="alert">Post created successfully.</div>';
        echo '<script>setTimeout(function() { window.location.href = "home"; }, 3000);</script>';
      } else {
        // Rollback transaction
        $this->conn->rollback();
        echo '<div class="alert alert-danger" role="alert">Failed to create post. Please try again.</div>';
      }
    } catch (\mysqli_sql_exception $e) {
      $this->conn->rollback();
      echo '<div class="alert alert-danger" role="alert">' . $e->getMessage() . '</div>';
    }
  }


  public function readPost($postId)
  {
    $sql = "SELECT * FROM posts where post_id=$postId";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $posts = $result->fetch_assoc();
    $stmt->close();
    return $posts;
  }
  public function UpdatePost($content, $title, $amount, $postId)
  {
    $sql = "UPDATE  posts SET Title='$title',amount='$amount',content='$content' where post_id=$postId";
    $query = $this->conn->query($sql);
    // Check if all queries were successful
    if ($query) {
      // Commit transaction
      echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">';
      echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>';
      echo '<div class="alert alert-success" role="alert">Post Edited successfully.</div>';
      echo '<script>setTimeout(function() { window.location.href = "/public/profile"; }, 2000);</script>';
    }
  }
  public function displayPosts($posts)
  {
    foreach ($posts as $post):
      $profile = $this->getUserByUsername($post['user_name']); ?>
      <div class="post" data-post-id="<?php $post['post_id'] ?>">
        <div class="img-div">
          <?php $y = $profile['profile_img']; ?>
          <div class="image-container">
            <img class="profile-image" src="<?= $y ?>" alt="profile-img">
          </div>
          <p class="post_head">
            <?= $post['user_name'] ?>
          </p>
          <div class="edit-btn-div">
            <button class="edit-post-btn">Edit Post</button>
          </div>
        </div>
        <div class="post_content">
          <?php $x = $post['image_path']; ?>
          <img class="post-image" src="<?= $x ?>" alt="Post Image">
          <p class="user_name">
            <span class="user_name">
              <?= $post['user_name'] ?>
            </span>
            <span class="content">
              <?= $post['content']; ?>
            </span>
          </p>
        </div>
        <div class="reactions">
          <a href="#" id="like-btn<?php echo $post['post_id']; ?>"><i class="fa-regular fa-thumbs-up"
              id="like-button-i<?php echo $post['post_id']; ?>"></i></a>
          <span class="like-count-container">
            <span class="like-count">
              <?php echo $post['like_count']; ?>
            </span> Likes
          </span>
          <a href="#" id="comment-btn<?php echo $post['post_id']; ?>"><i class="fa-regular fa-comment"></i></a>
          <div class="comment-container<?php echo $post['post_id'] ?> commentbox">
            <h1>this is my comment</h1>
          </div>
        </div>

      </div>
    <?php endforeach;
  }
  public function readPostfromCart($user_name)
  {
    $username = $_SESSION['username'];
    $sql = "SELECT posts.*, cart.quantity AS item_quantity FROM cart JOIN posts ON cart.post_id = posts.post_id WHERE cart.user_name = '$username'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $posts;
  }
  public function readPostfromCartbypostId($user_name,$postId)
  {
    $username = $_SESSION['username'];
    $sql = "SELECT posts.*, cart.quantity AS item_quantity 
    FROM cart 
    JOIN posts ON cart.post_id = posts.post_id 
    WHERE cart.user_name = '$username' 
        AND posts.post_id = '$postId';
    ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $posts = $result->fetch_assoc();
    $stmt->close();
    return $posts;
  }
  public function inertIntoOrderDetails($name, $address, $landmark, $pincode)
  {
    $username = $_SESSION['username'];
    $sql = "INSERT INTO order_details (name,username,landmark,pincode,address) VALUES('$name','$username','$landmark','$pincode','$address')";
    $this->conn->query($sql);
    echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">';
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>';
    echo '<div class="alert alert-success" role="alert">Details submited successfully.</div>';
    echo '<script>setTimeout(function() { window.location.href = "/public/profile"; }, 1500);</script>';
  }
  public function inertIntoOrderDetailsPayement($postId, $name, $address, $landmark, $pincode)
  {
    $username = $_SESSION['username'];
    $sql = "INSERT INTO order_details (name,username,landmark,pincode,address) VALUES('$name','$username','$landmark','$pincode','$address')";
    $this->conn->query($sql);
    echo "<script>window.location.href='/public/payment/$postId'</script>";
  }
  public function editOrderDetails($name, $address, $landmark, $pincode)
  {
    $username = $_SESSION['username'];
    $sql = "UPDATE order_details SET name='$name', landmark='$landmark', pincode='$pincode', address='$address' WHERE username='$username'";
    echo '<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">';
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>';
    echo '<div class="alert alert-success" role="alert">Details Updated successfully.</div>';
    echo '<script>setTimeout(function() { window.location.href = "/public/profile"; }, 1500);</script>';
    $this->conn->query($sql);
  }
  public function readFromOrderDetails($username)
  {
    $sql = "SELECT * from order_details where username='$username'";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $order_details = $result->fetch_assoc();
    $stmt->close();
    return $order_details;
  }

  public function deletefromCart($postId,$username){
    $sql="DELETE from cart where post_id=$postId AND user_name='$username'";
    $this->conn->query($sql);
  }
  public function insertIntoOrders($postId,$username){
    $sql="INSERT INTO orders (post_id,user_name,payment) values($postId,'$username','successfull')";
    $this->conn->query($sql);
  }
  public function getdatafromorder($username){
    $sql="SELECT posts.*, orders.payment, 
    (SELECT quantity FROM cart WHERE cart.post_id = posts.post_id) AS item_quantity 
FROM posts 
JOIN orders ON posts.post_id = orders.post_id 
WHERE orders.payment = 'successfull' 
    AND orders.user_name = '$username'";

    ;
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $orders;
  }
}