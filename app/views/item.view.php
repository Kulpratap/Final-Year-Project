<?php
use app\controller\Item;
use app\core\Config;
new Config();
$currentUrl = $_SERVER['REQUEST_URI'];
$urlParts = explode('/', $currentUrl);
$postId = end($urlParts);
$item = new Item();
$item->connection(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
$post = $item->readPost($postId); 
$imagePathFromDatabase = $post['image_path']; // Example path from database
$imagePath = substr($imagePathFromDatabase, 2);
use app\controller\Cart;
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
  <link rel="stylesheet" href="<?= ROOT ?>/public/assests/css/item.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <title>Bagheecha.com</title>
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
          <li><a href="/public/CreatePost" class="nav-link create">Create +</a></li>
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
  </div>
  <div class="container-plant headp">
    <p><a href="/public/home">Home > </a><a href="/public/plants">Plant > </a><span
        class="info"><?php echo $post['Title'] ?></span></p>
  </div>
  <div class="container-plant each-post-desc">
    <div class="post">
      <div class="post-image-div">
        <img class="post-image" src='<?php echo $imagePath ?>' alt="Post Image">
      </div>
    </div>
    <div class="item-container ">
      <div class="item-details">
        <h2><?php echo $post['Title'] ?></h2>
        <p><span class="save-btn">Save 20%</span> <span class="cut-price">₹<?php echo $post['amount']; ?></span> <span
            class="original-price"><?php echo floor((-($post['amount'] * 20) / 100) + $post['amount']) ?></span> (MRP
          Inclusive of all taxes)</p>
        <p>Shipping ₹79 for entire order</p>
        <p>Dispatch in 7 days</p>
        <p>Country of origin: India</p>
      </div>
      <div class="item-actions">
        <div class="quantity-container">
          <label for="quantity">Quantity:</label>
          <select id="quantity" name="quantity">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          </select>
        </div>
        <button class="add-to-cart-button" id="add-button<?php echo $postId?>">Add to Cart</button>
      </div>
      <div class="info-div">
        <h2>Plant Description</h2>
        <p class="content-post"><?php echo $post['content']?></p>
        <h2>Gardening Tips</h2>
        <p class="content-post"><?php echo $post['gardening_tips']?></p>
    </div>
  </div>
  </div>
</body>

</html>
<script src="<?php echo ROOT ?>/public/assests/javascript/item.js"></script>