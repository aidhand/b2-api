<?php
require "../b2_api.php"; // Include the API wrapper

$account_id = ""; // Account ID, obtained from your B2 bucket page
$app_key    = ""; // Application ID, obtained from your B2 bucket page
$bucket_id  = "";  // The ID of the bucket you want to delete

$b2 = new b2_api; // Create a new instance of b2_api
$output = $b2->b2_authorize_account($account_id, $app_key); // Runs b2_authorize_account
$output = $b2->b2_delete_bucket($bucket_id); // Runs b2_delete_bucket

echo "b2_delete_bucket\n\n";
var_dump($output);