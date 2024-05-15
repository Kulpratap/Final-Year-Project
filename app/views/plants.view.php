<?php
use app\core\Config;
new Config();
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
    <link rel="stylesheet" href="<?= ROOT ?>/public/assests/css/home.css">
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
        <a href="home" class="navbar-brand">Bageecha.com.<i class="fa-solid fa-seedling"></i>.</a>
        <ul class="navbar-navs">
        <li class="nav-item"><a href="home" class="nav-link">Home</a></li>

            <li class="nav-item"><a href="plants" class="nav-link">Plants</a></li>
            <li class="nav-item"><a href="seeds" class="nav-link">Seeds</a></li>
            <li class="nav-item"><a href="stationary" class="nav-link">Plant Stationary</a></li>
            
            <?php if(isset($_SESSION['username']) && $_SESSION['username'] === 'Kul_2000'): ?>
                <li><a href="CreatePost" class="nav-link create">CREATE +</a></li>
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
    <div class="container-plant round_img_div">
        <a href="plants"><img src="../images/gardening.webp" alt="plants"></a>
        <a href="seeds"><img src="../images/seeds.avif" alt="seeds"></a>
        <a href="stationary"><img src="../images/accessories.webp" alt="stationaries" ></a>
    </div>
    <div class="container-plant para">
      <h3>Gardening is not just an activity – for some, it is a stress release. For others, it is an escape into a world filled with hope and joy.</h3>
    </div>
    <div class="posts-container" id="load-more">
        
    </div>
    <div class="container-plant button-container" style="display: none;">
        <button id="load-more-btn">Load More</button>
    </div>
</body>
</html>
<script src="<?php echo ROOT?>/public/assests/javascript/script.js"></script>
<!-- SELECT posts.* FROM cart JOIN posts ON cart.post_id = posts.post_id WHERE cart.user_name = 'Kriti'; -->