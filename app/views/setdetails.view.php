<?php
use app\controller\Order;
$order=new Order;
$username=$_SESSION['username'];
$order->connection(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
$order_details=$order->readFromOrderDetails($username);
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
  <link rel="stylesheet" href="<?php echo ROOT ?>/public/assests/css/order.css">
  <title>Order</title>
</head>

<body>
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
</body>

</html>