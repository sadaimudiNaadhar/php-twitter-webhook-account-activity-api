<?php

session_start();
require 'vendor/autoload.php';
define('CONSUMER_KEY', 'YOUR CONSUMER KEY');
define('CONSUMER_SECRET', 'YOUR CONSUMER SECRET');
define('OAUTH_CALLBACK', 'YOUR CALLBACK URL');

if (!CONSUMER_KEY || !CONSUMER_SECRET || !OAUTH_CALLBACK) {
    exit('The CONSUMER_KEY, CONSUMER_SECRET, and OAUTH_CALLBACK environment variables must be set to use this demo.'
         . 'You can register an app with Twitter at https://apps.twitter.com/.');
}



?>