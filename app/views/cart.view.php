<?php
use app\controller\Cart;
use app\core\Config;

new Config();
$cart = new Cart();
$cart->connection(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
$posts = $cart->readPostfromCart($_SESSION['username']);
$post_count = count($posts);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="<?php echo ROOT ?>/public/assests/css/cart.css">
  <title>Cart</title>
</head>

<body>
  <div class="container-plant">
    <nav class="navbars nav-container">
      <a href="/public/home" class="navbar-brand">Bageecha.com.<i class="fa-solid fa-seedling"></i>.</a>
      <ul class="navbar-navs">
      <li class="nav-item"><a href="/public/home" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="/public/plants" class="nav-link">Plants</a></li>
        <li class="nav-item"><a href="/public/seeds" class="nav-link">Seeds</a></li>
        <li class="nav-item"><a href="/public/stationary" class="nav-link">Plant Stationary</a></li>

        <?php if (isset($_SESSION['username']) && $_SESSION['username'] === 'Kul_2000'): ?>
          <li><a href="/public/CreatePost" class="nav-link create">CREATE +</a></li>
        <?php endif; ?>
        <li><?php 
                    if(isset($_SESSION['loggedin'])&& ($_SESSION['loggedin']==true)){
                        echo "<a href='/public/logout' class='nav-link logout-btn'>Logout</a>";
                    }
                    else{
                        echo "<a href='/public/login' class='nav-link logout-btn'>Login / SignUp</a>";

                    }?></li>
        <li class="nav-item"><a href="/public/cart" class="nav-link"><i class="fa-solid fa-cart-shopping"></i><?php echo "(".$post_count.")" ?></a></li>
        <li> <a href="/public/profile"><i class="fa-regular fa-user pro"></i></a></li>
      </ul>
    </nav>
  <div >
    <h1>Your Cart (<?php echo $post_count; ?>)</h1>
    <?php
    if ($post_count == 0) {
      echo "<a class='empty' href='/public/home'>Continue Shopping.</a>";
    }
    ?>
  </div>

  <?php foreach ($posts as $post):
    ?>
    <div class="each-post-desc">
      <div class="post" >
        <div class="post-image-div">
          <img class="post-image" src='<?php echo $post['image_path'] ?>' alt="Post Image">
        </div>
      </div>
      <div class="item-container ">
        <div class="item-details">
          <h2><?php echo $post['Title'] ?></h2>
          <p><span class="save-btn">Save 20%</span> <span class="cut-price">₹<?php echo $post['amount']*$post['item_quantity']; ?></span> <span
              class="original-price"><?php echo floor((-($post['amount'] * 20) / 100) + $post['amount']*$post['item_quantity']) ?></span> (MRP
            Inclusive of all taxes)</p>
            <p>You have selected <?php echo $post['item_quantity']; echo " ".$post['Title'] ?> item </p>
        </div>
        <div class="inner-div-button">
        <button class="container-plant place-order-button" id="place-order-button" data-postid="<?php echo $post['post_id']?>">Place This Order</button>
        <a class="delete_post_btn" data-postid="<?php echo $post['post_id']?>"><i class="fa-solid fa-trash"></i></a>
        </div>
   
      </div>
    </div>
  <?php endforeach; ?>
  </div>
</body>
</html>
<script src="<?= ROOT ?>/public/assests/javascript/cart.js"></script>