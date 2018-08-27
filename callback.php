<?php

require "config.php";
use Abraham\TwitterOAuth\TwitterOAuth;

if(empty($_SESSION['access_token'])){
    

/* Get temporary credentials from session. */

$request_token = [];
$request_token['oauth_token'] = $_SESSION['oauth_token'];
$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

/* If the oauth_token is not what we expect, bail. */
if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
    print "Old session"; 
    exit;
}
/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
/* Request access tokens from twitter */
$access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);
/* If HTTP response is 200 continue otherwise send to connect page to retry */
if (200 == $connection->getLastHttpCode()) {
    /* Save the access tokens. Normally these would be saved in a database for future use. */
    $_SESSION['access_token'] = $access_token;
    /* Remove no longer needed request tokens */
    unset($_SESSION['oauth_token']);
    unset($_SESSION['oauth_token_secret']);
    /* The user has been verified and the access tokens can be saved for future use */
    $_SESSION['status'] = 'verified';
    echo "Please Refresh";
} else {
    /* Save HTTP status for error dialog on connnect page.*/
    header('Location: index.php');
    exit;
}

} else {
    
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];
/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
/* If method is set change API call made. Test is called by default. */
$url = "Your webhook URL";
$content = $connection->post("account_activity/all/your:envName/webhooks", ["url" => $url]); // Register webhook
//$content = $connection->post("account_activity/all/your:envName/subscriptions");  // Subscribes user to registered webhook
//$content = $connection->delete("account_activity/all/your:envName/webhooks/webhook:id"); // Delete webhook 
//$content = $connection->put("account_activity/all/your:envName/webhooks/webhook:id"); // Triggers & crc request & verifies webhook again
print "<pre>";
print_r($content);

}
?>