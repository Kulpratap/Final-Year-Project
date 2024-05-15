<?php
namespace app\controller;

use app\core\Config;
use app\core\Controller;
use app\models\Post;
use app\models\User;

class Order extends Controller
{
    use User, Post;
    public function check()
    {
        new Config();
        $username = $_SESSION['username'];
        $currentUrl = $_SERVER['REQUEST_URI'];
        $urlParts = explode('/', $currentUrl);
        $postId = end($urlParts);
        // Check if the user is logged in
        $this->connection(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
        $order_details = $this->readFromOrderDetails($username);
        if (isset($order_details)) {
            echo "<script>window.location.href='/public/payment/$postId'</script>";

        } else {
            echo "<script>window.location.href='/public/setdetails/$postId'</script>";
        }


        if ($_SESSION['loggedin'] == true) {
            $this->view('order');
        } else {
            header('Location: login');
        }
    }
}