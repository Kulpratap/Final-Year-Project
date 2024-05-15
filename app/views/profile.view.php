<?php
use app\controller\Profile;
$x = new Profile();
$x->connection(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
$profile = $x->getUserByUsername($_SESSION['username']);
$profile_post = $x->getPostsByUsername($_SESSION['username']);

use app\controller\Cart;
$cart = new Cart();
$cart->connection(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
$posts = $cart->readPostfromCart($_SESSION['username']);
$post_count = count($posts);
$username=$_SESSION['username'];
$orders=$x->getdatafromorder($username);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php
    if($_SESSION['username']==="Kul_2000"){?>
      <link rel="stylesheet" href="<?= ROOT ?>/public/assests/css/profile.css">
    <?php }
    else{?>
      <link rel="stylesheet" href="<?= ROOT ?>/public/assests/css/profile.css">
  <link rel="stylesheet" href="<?= ROOT ?>/public/assests/css/cart.css">

    <?php }?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <div class="container-plant">
    <nav class="navbars nav-container">
      <a href="home" class="navbar-brand">Bageecha.com.<i class="fa-solid fa-seedling"></i>.</a>
      <ul class="navbar-navs">
      <li class="nav-item"><a href="home" class="nav-link">Home</a></li>

        <li class="nav-item"><a href="plants" class="nav-link">Plants</a></li>
        <li class="nav-item"><a href="seeds" class="nav-link">Seeds</a></li>
        <li class="nav-item"><a href="plants" class="nav-link">Plant Stationary</a></li>

        <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'Kul_2000'): ?>
          <li><a href="CreatePost" class="nav-link create">CREATE+</a></li>
        <?php endif; ?>
        <li><?php 
                    if(isset($_SESSION['loggedin'])&& ($_SESSION['loggedin']==true)){
                        echo "<a href='/public/logout' class='nav-link logout-btn'>Logout</a>";
                    }
                    else{
                        echo "<a href='/public/login' class='nav-link logout-btn'>Login / SignUp</a>";

                    }?></li>
        <li class="nav-item"><a href="cart" class="nav-link"><i class="fa-solid fa-cart-shopping"></i><?php echo "(".$post_count.")" ?></a></li>
        <li> <a href="profile"><i class="fa-regular fa-user pro"></i></a></li>
      </ul>
    </nav>
  </div>
  <div class="container">
    <div class="profile-header">
      <img src="<?php echo $profile['profile_img']; ?>" alt="Profile Picture">
      <div class="profile-info">
        <h1>
          <?php echo $_SESSION['username'] ?>
        </h1>
        <?php
        if($_SESSION['username']=="Kul_2000"){
          echo "<a class='btn' href='Update'>Edit Profile</a>";
        }
        else{
          echo "<a class='btn' href='updatedetails'>Edit Details</a>";
        }
        ?>
        
      </div>
    </div>
    <p>Bio:
      <?php echo $profile['bio'] ?>
    </p>
    <h2 class="label">
      <?php
      if ($_SESSION['username'] === "Kul_2000") {
        echo "<h2 class=\"label\">POSTS: " . count($profile_post) . "</h2>";
      } else {
        echo "<h2 class=\"label\">ORDERS ". "</h2>";
      }
      ?>
    </h2>
    <?php
if ($_SESSION['username'] === "Kul_2000") {
    // Display all posts for the admin
    echo '<div class="post-grid">';
    foreach ($profile_post as $post):
        $x = $post['image_path'];
?>
        <div class="post" id="<?php echo $post['post_id'] ?>">
            <div class="edit-btn-div">
                <span class="user_name bold">
                    <?php echo $post['user_name'] ?>
                </span>
                <img class="edit-btn" src="<?= ROOT ?>/public/assests/images/three_dot.png">
                <div class="post-menu">
                    <button class="edit-post-btn" data-postid="<?php echo $post['post_id'] ?>">Edit Post</button>
                    <button class="delete-post-btn" data-postid="<?php echo $post['post_id'] ?>">Delete Post</button>
                </div>
            </div>
            <div class="image-container">
                <img src="<?= $x ?>" alt="Post Image">
            </div>
            <p class="user_name">
                <span class="user_name">
                    <?php echo $post['user_name'] ?>
                </span>
                <span class="content">
                    <?php echo $post['Title']; ?>
                </span>
            </p>
        </div>
<?php 
    endforeach; 
    echo '</div>'; // Close the post-grid div
} else {
    foreach ($orders as $ordered_post):
?>
            <div class="each-post-desc">
                <div class="post">
                    <div class="post-image-div">
                        <img class="post-image" src='<?php echo $ordered_post['image_path'] ?>' alt="Post Image">
                    </div>
                </div>
                <div class="item-container">
                    <div class="item-details">
                        <h2><?php echo $ordered_post['Title'] ?></h2>
                        <p> <span class="cut-price">₹<?php echo $ordered_post['amount'] * 1; ?></span> <span class="original-price"><?php echo floor((-($ordered_post['amount'] * 20) / 100) + $ordered_post['amount'] * 1) ?></span> (MRP Inclusive of all taxes)</p>
                        <p class="save-btn">Order Deliver in 3 Days</p>
                        <!-- <a class="delete_post_btn" data-postid="<?php echo $post['post_id']?>"><i class="fa-solid fa-trash"></i> Cancel order</a> -->

                    </div>
                </div>
            </div>
<?php 
    endforeach; 
}
?>
  </div>
</body>

</html>
<script src="<?= ROOT ?>/public/assests/javascript/profile.js"></script>