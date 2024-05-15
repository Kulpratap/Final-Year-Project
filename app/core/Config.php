<?php
namespace app\core;

require ('../stripe-php-master/init.php');

class Config
{
  public function __construct()
  {
    define('publishableKey', 'pk_test_51P7JOmSAmoY4etSU0s7NoBSIgdaLA625TbNpojH06byFqcEJHtyRPO8uTHMB5taQerDuekxqvCykhQKSuudpa1Hh00sKv3XVPt');
    define('secretKey', 'sk_test_51P7JOmSAmoY4etSUJoVQuacxbRwXqom0qeLIkHIhW9bPh3peW3FZHT0c8lhZosDXS19KmWMjnUjk4VmjkMJ1eAVR00gvhe80t7');
    define('ROOT', 'http://bageecha.com');
    define('SERVER_NAME', 'localhost');
    define('USER_NAME', 'kul');
    define('PASSWORD', 'Kul@123456');
    define('DB_NAME', 'USER');
    define('YOUR_CLIENT_ID', '230317580924-f9h5hibq6h1psub601huea5nnauga3l5.apps.googleusercontent.com');
    define('YOUR_CLIENT_SECRET', "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");
    define('YOUR_REDIRECT_URI', 'http://bageecha.com/public/googlelogin');
    \Stripe\Stripe::setApiKey(secretKey);
  }
}



