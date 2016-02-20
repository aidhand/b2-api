<?php
require "../b2_api.php"; // Include the API wrapper

$account_id = ""; // Account ID, obtained from your B2 bucket page
$app_key    = ""; // Application ID, obtained from your B2 bucket page
$bucket_id  = ""; // Bucket ID, obtained from your B2 bucket page
$file_path  = ""; // Path to the file you wish to upload

$b2 = new b2_api; // Create a new instance of b2_api
$auth = $b2->b2_authorize_account($account_id, $app_key); // Runs b2_authorize_account
$url = $b2->b2_get_upload_url($auth->apiUrl, $auth->accountId, $auth->authorizationToken, $bucket_id); // Runs b2_get_upload_url
$output = $b2->b2_upload_file($url->uploadUrl, $auth->authorizationToken, $file_path); // Runs b2_get_upload_url

echo "b2_upload_file\n\n";
var_dump($output);