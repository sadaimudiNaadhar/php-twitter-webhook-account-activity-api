<?php

include "../config.php";

if(isset($_REQUEST['crc_token'])) {
	 
	$myfile = fopen("crc_token.txt", "w") or die("Unable to open file!");
	$txt = $_REQUEST['crc_token'];
	fwrite($myfile, $txt);
	fclose($myfile);

	$signature = hash_hmac('sha256', $_REQUEST['crc_token'], CONSUMER_SECRET, true);
	$response['response_token'] = 'sha256='.base64_encode($signature);
	print json_encode($response);

} else {
	
    	$eventJSON = file_get_contents('php://input');
	$myfile = fopen("events.txt", "w") or die("Unable to open file!");
	$myfile = fopen($path, "a");
        fwrite($myfile, $eventJSON . PHP_EOL);
        fclose($myfile);
}



?>
