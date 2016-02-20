<?php
require "../b2_api.php"; // Include the API wrapper

$account_id = ""; // Account ID, obtained from your B2 bucket page
$app_key    = ""; // Application ID, obtained from your B2 bucket page
$bucket_id  = ""; // The ID of the bucket containing the file you wish to hide
$file_name  = ""; // The name of the file you wish to hide

$b2 = new b2_api; // Create a new instance of b2_api
$auth = $b2->b2_authorize_account($account_id, $app_key); // Runs b2_authorize_account
$output = $b2->b2_hide_file($auth->apiUrl, $auth->authorizationToken, $bucket_id, $file_name); // Runs b2_hide_file

echo "b2_hide_file\n\n";
var_dump($output);