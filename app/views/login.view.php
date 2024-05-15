<?php
use app\core\Config;
new Config();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="<?php echo ROOT ?>assets/images/favicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?php echo ROOT ?>/public/assests/css/login.css">
  <title>Login</title>
</head>

<body>
  <section class="center-container">
    <section class="image-container">
      <img src="<?php echo ROOT ?>/public/assests/images/bg_back_login.jpg " alt="">
    </section>

    <section class="container">
      <form action="" class="name-form" method='post'>
        <h1 id="page-heading">Bageecha.com</h1>
        <p class="innerheading"></p>

        <div class="input-wrapper">
          <label for="username">
            <i class="fa-solid fa-user"></i>
          </label>
          <input type="text" name="username" id="username" required placeholder="Enter your username">
        </div>

        <div class="input-wrapper">
          <label for="password">
            <i class="fa-solid fa-lock icon"></i>
          </label>
          <input type="password" name="password" id="password" required placeholder="Enter your Password">
        </div>
        <input type="submit" value="Login" name='login'>
        <a class="forgot" href="/public/forgotpassword">Forgot Password?</a>
        <a class="google-btn" href="/public/googlelogin"><img id="google-img"
            src="<?php echo ROOT ?>/public/assests/images/google_icon.png" alt="Google Logo">
          Google Login</a>
        <div class="or-con">
          <hr>
          <p>OR </p>
          <hr>
        </div>
        

        <span class='signup-link'>Not a USER OR Don't have an account?                   
          <a href="/public/signup">Register here</a>
        </span>
      </form>
    </section>
  </section>
</body>

</html>