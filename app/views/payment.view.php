<?php
$currentUrl = $_SERVER['REQUEST_URI'];
$urlParts = explode('/', $currentUrl);
$postId = end($urlParts);
use app\controller\Profile;
$cart_data=new Profile();
$username=$_SESSION['username'];
$cart_data->connection(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
$data=$cart_data->readPostfromCartbypostId($username,$postId);
$amount=(-$data['amount'] *100)*(0.2)+$data['amount']*100;
?>
<form action="/public/submit/<?php echo $postId?>" method="post">
<script
src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="<?php echo publishableKey?>"
data-amount=<?php echo $amount?>:
data-name="Bageecha.com"
data-description="<?php echo $data['content'] ?>"
data-image="https://cdn.shopify.com/s/files/1/0284/2450/files/logo_1024x1024_new.jpg?height=628&pad_color=fff&v=1701166926&width=1200"
data-currency="inr"
data-email="<?php echo $data['Title'] ?>"
>
</script>
</form>