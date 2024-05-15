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
  <link rel="stylesheet" href="<?php echo ROOT ?>/public/assests/css/order.css">
  <title>Order</title>
</head>

<body>
  <div class="container-plant">
    <nav class="navbars nav-container">
      <a href="/public/home" class="navbar-brand">Bageecha.com.<i class="fa-solid fa-seedling"></i>.</a>
        <li class="nav-item"><a href="/public/home" class="nav-link">Home</a></li>
      <ul class="navbar-navs">
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
        <li class="nav-item"><a href="/public/cart" class="nav-link"><i class="fa-solid fa-cart-shopping"></i></a></li>
        <li> <a href="/public/profile"><i class="fa-regular fa-user pro"></i></a></li>
      </ul>
    </nav>
    <div class="container">
      <h1>Enter Your Details</h1>
      <form  method="post">
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" placeholder="Enter Your name here" required value="<?php
          if(isset($order_details))
          echo $order_details['name']?>">
        </div>
        <div class="form-group">
          <label for="address">Address:</label>
          <textarea id="address" name="address" placeholder="Enter Your Address here" rows="4" required><?php  if(isset($order_details)) echo $order_details['address']?></textarea>
        </div>
        <div class="form-group">
          <label for="landmark">Landmark:</label>
          <input type="text" id="landmark" name="landmark" placeholder="Enter Landmark here" name="landmark" required value="<?php  if(isset($order_details)) echo $order_details['landmark']?>">
        </div>
        <div class="form-group">
          <label for="pincode">Pincode:</label>
          <input type="text" id="pincode" name="pincode" placeholder="Enter Your Pincode here" name="pincode" required value="<?php  if(isset($order_details)) echo $order_details['pincode']?>">
        </div>
        <input type="submit" name="submit" value="Proceed to Payment"></input>
      </form>
    </div>
  </div>
</body>

</html>