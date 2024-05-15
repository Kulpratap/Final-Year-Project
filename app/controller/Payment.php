<?php
namespace app\controller;

use app\core\Config;
use app\core\Controller;
use app\models\Post;
use app\models\User;

class Payment extends Controller
{
    use User, Post;
    public function check()
    {
        new Config();
        if ($_SESSION['loggedin'] == true) {
            $this->view('payment');
        } else {
            header('Location: login');
        }
    }
}