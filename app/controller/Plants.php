<?php
namespace app\controller;
use app\core\Controller;
use app\models\Post;
use app\models\User;
class Plants extends Controller
{
    use User, Post;
    public function check()
    {
        // Check if the user is logged in
            $this->view('plants');
    }
}
