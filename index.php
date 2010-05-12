<?php

// Get these from http://developers.facebook.com
$api_key = 'facebook api key';
$secret  = 'facebook secret key';

require_once 'facebook.php';

$facebook = new Facebook($api_key, $secret);
$facebook->require_frame();
$user = $facebook->require_login();

$user_details = $facebook->api_client->users_getInfo($user, "email");

if (!is_array($user_details)) {
 $data["email"] = '';
}
 else {
 $emails = $data["email"] = $user_details[0]["email"];
}

$mysqli = mysqli_connect ("localhost", "username", "password", "database");
$sql = "INSERT INTO emails (email_address) VALUES ('$emails')";
$res = mysqli_query($mysqli, $sql);

mysqli_close($mysqli);