<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$token = $_GET['code'];
echo $token . "<br />";

// Execute cURL request to retrieve the access token
$params = [
    'code' => $_GET['code'],
    'client_id' => "516885558184-6amd2b1sma940uh2o7p3fbqocoh3qfkd.apps.googleusercontent.com",
    'client_secret' => "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",
    'redirect_uri' => "https://localhost/index.php",
    'grant_type' => 'authorization_code'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
$response = json_decode($response, true);
var_dump($response);
