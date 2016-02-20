<?php
require "../b2_api.php"; // Include the API wrapper

$account_id   = ""; // Account ID, obtained from your B2 bucket page
$app_key      = ""; // Application ID, obtained from your B2 bucket page
$download_url = ""; // Obtained from the b2_authorize_account call
$file_id      = ""; // The ID of the file you wish to download

$b2 = new b2_api; // Create a new instance of b2_api

// Public buckets
$public = $b2->b2_download_file_by_id($download_url, $file_id); // Runs b2_download_file_by_id

// Private buckets
$auth = $b2->b2_authorize_account($account_id, $app_key); // Runs b2_authorize_account
$private = $b2->b2_download_file_by_id($download_url, $file_id, $auth->authorizationToken); // Runs b2_download_file_by_id with auth

// Output the results
echo "b2_download_file_by_id\n";

echo "\npublic\n";
var_dump($public);

echo "\nprivate\n";
var_dump($private);