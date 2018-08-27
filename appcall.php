<?php


/* This file make use of bearer Token*/
require "config.php";
use Abraham\TwitterOAuth\TwitterOAuth;

/* Build TwitterOAuth object with client credentials. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

$request_token = $connection->oauth2('oauth2/token', ['grant_type' => 'client_credentials']);
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token->access_token);
//$content = $connection->get("account_activity/all/webhooks");
$content = $connection->get("account_activity/all/your:envName/subscriptions/list");

print "<pre>";
print_r($content);


?>