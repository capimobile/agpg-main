<?php
//ob_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

function send_sms ($number, $message) {
	$base_url = 'http://5.189.176.218:2124/sms/post';
	$token = '8F251EF1-5B1A-4423-8AD7-2F1DR37B969C';
	$user = 'agpg';
	$pass = '1365';
	$trxid = uniqid();
	$sig = md5($token.':'.$user.'@'.$number);
	$curl = curl_init($base_url);


	$json = json_encode(
		array(
	        "destination" => $number,
	        "text" => $message,
	        "user" => $user,
	        "pass" => $pass,
	        "trxid" => $trxid,
	        "sig" => $sig
	     )
	);

	$headers = array(
	    'Content-type: application/json'
	);

	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
	    $info = curl_getinfo($curl);
	    curl_close($curl);
	    die( "<br/>".'error occured during curl exec. Additional info: ' . var_export($info));
	}
	curl_close($curl);
	if (isset($curl_response->response->status) && $curl_response->response->status == 'ERROR') {
	   die('error occured: ' . $curl_response->response->errormessage);
	}
}
?>