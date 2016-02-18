<?php
require "../b2_api.php"; // Include the API wrapper

$account_id  = ""; // Account ID, obtained from your B2 bucket page
$app_key     = ""; // Application ID, obtained from your B2 bucket page
$bucket_id   = ""; // Bucket ID, obtained from your B2 bucket page
$bucket_type = ""; // Type to change to, either allPublic or allPrivate

$b2 = new b2_api; // Create a new instance of b2_api
$output = $b2->b2_authorize_account($account_id, $app_key); // Runs b2_authorize_account
$output = $b2->b2_update_bucket($bucket_id, $bucket_type); // Runs b2_update_bucket

echo "b2_update_bucket\n\n";
var_dump($output);