<?php
use app\core\Config;
use app\controller\Cart;
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
    <link rel="stylesheet" href="<?= ROOT ?>/public/assests/css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>                                               
    <title>Bageecha.com</title>
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
                    <li><a href="CreatePost" class="nav-link create">CREATE +</a></li>
                <?php endif; ?>
                <li>
                    <?php 
                    if(isset($_SESSION['loggedin'])&& ($_SESSION['loggedin']==true)){
                        echo "<a href='/public/logout' class='nav-link logout-btn'>Logout</a>";
                    }
                    else{
                        echo "<a href='/public/login' class='nav-link logout-btn'>Login / SignUp</a>";

                    }
                    ?></li>
                <li class="nav-item"><a href="/public/cart" class="nav-link"><i class="fa-solid fa-cart-shopping"></i><?php echo "(".$post_count.")" ?></a></li>
                <li> <a href="/public/profile"><i class="fa-regular fa-user pro"></i></a></li>
            </ul>
        </nav>
    </div>
    <div class="container-plant round_img_div">
        <a href="/public/plants"><img src="../images/gardening.webp" alt="plants"></a>
        <a href="/public/seeds"><img src="../images/seeds.avif" alt="seeds"></a>
        <a href="/public/stationary"><img src="../images/accessories.webp" alt="stationaries"></a>
    </div>
    <div class="container-plant">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="/public/plants"><img class="d-block w-100" src="../images/slide3.webp" alt="First slide"></a>
                </div>
                <div class="carousel-item">
                    <a href="/public/seeds"><img class="d-block w-100" src="../images/slide2.webp" alt="Second slide"></a>
                </div>
                <div class="carousel-item">
                    <a href="/public/stationary"><img class="d-block w-100" src="../images/slide1.webp" alt="Third slide"></a>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="container-plant headingfortest">
        <h2 class="headingfortest">What our customers says about us.</h2>
    </div>
    <div class="testimonials-container container-plant">
        <div class="testimonial" data-aos="fade-right">
            <div class="testimonial-content">
                <p>"Bagheecha.com has been my go-to destination for all things green! Their wide selection of plants,
                    from exotic specimens to everyday favorites, never fails to impress. The quality of the plants I've
                    received has always been top-notch, and their customer service is exceptional. Thanks to Bagheecha,
                    my home has been transformed into a lush oasis"</p>
            </div>
            <div class="testimonial-author">
                <img src="../images/emily.jpeg" alt="Emily R.">
                <p>Emily R.</p>
            </div>
        </div>
        <div class="testimonial" data-aos="fade-left">
            <div class="testimonial-content">
                <p>"As an urban gardener with limited space, I rely on Bagheecha.com to fulfill my gardening needs.
                    Their collection of compact and low-maintenance plants is perfect for my balcony garden. Not only do
                    they offer a variety of plant species, but their detailed care instructions have been invaluable in
                    helping me keep my green companions thriving. Bagheecha has truly elevated my urban gardening
                    experience!"</p>
            </div>
            <div class="testimonial-author">
                <img src="../images/Raj.jpeg" alt="Rajesh K.">
                <p>Rajesh K.</p>
            </div>
        </div>
        <div class="testimonial" data-aos="fade-right">
            <div class="testimonial-content">
                <p>"Bagheecha.com has exceeded all my expectations when it comes to purchasing plants online. From
                    browsing their user-friendly website to receiving my carefully packaged plants, the entire process
                    has been seamless. What sets Bagheecha apart is their commitment to customer satisfaction. They
                    truly care about the well-being of their plants and go above and beyond to ensure that customers are
                    happy. I wouldn't hesitate to recommend Bagheecha to fellow plant lovers!"</p>
            </div>
            <div class="testimonial-author">
                <img src="../images/Rajesh.jpeg" alt="Sarah M.">
                <p>John dear</p>
            </div>
        </div>
        <div class="testimonial" data-aos="fade-left">
            <div class="testimonial-content">
                <p>"Bagheecha.com has exceeded all my expectations when it comes to purchasing plants online. From
                    browsing their user-friendly website to receiving my carefully packaged plants, the entire process
                    has been seamless. What sets Bagheecha apart is their commitment to customer satisfaction. They
                    truly care about the well-being of their plants and go above and beyond to ensure that customers are
                    happy. I wouldn't hesitate to recommend Bagheecha to fellow plant lovers!"</p>
            </div>
            <div class="testimonial-author">
                <img src="../images/Rajesh.jpeg" alt="Sarah M.">
                <p>John dear</p>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
<script>
    AOS.init();
</script>
<script src="<?= ROOT ?>/public/assests/javascript/home.js"></script>