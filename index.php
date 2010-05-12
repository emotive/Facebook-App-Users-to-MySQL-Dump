<?php

// Get these from http://developers.facebook.com
$api_key = 'facebook api key';
$secret  = 'facebook secret key';

require_once 'facebook.php';

$facebook = new Facebook($api_key, $secret);
$facebook->require_frame();
$user = $facebook->require_login();

//retrieve the logged in users first name, last name and email address
$user_details = $facebook->api_client->users_getInfo($user, "first_name, last_name, email");

//check to make sure facebook returns values

if (!is_array($user_details)) {
 $data["email"] = '';
 $data["first_name"] = '';
 $data["last_name"] = '';
}

//if facebook returns values then create php variables for returned data
 else {
$emails = $data["email"] = $user_details[0]["email"];
$first_name = $data["first_name"] = $user_details[0]["first_name"];
$last_name = $data["last_name"] = $user_details[0]["last_name"];
}

//connect to your database
$mysqli = mysqli_connect ("localhost", "username", "password", "database");

//run sql query to insert php variables into your database
$sql = "INSERT INTO [[YOUR TABLE]] (email_address, first_name, last_name) VALUES ('$emails', '$first_name', '$last_name')";
$res = mysqli_query($mysqli, $sql);

//close database connection
mysqli_close($mysqli);