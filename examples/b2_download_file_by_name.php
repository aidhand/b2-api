<?php
require "../b2_api.php"; // Include the API wrapper

$account_id  = ""; // Account ID, obtained from your B2 bucket page
$app_key     = ""; // Application ID, obtained from your B2 bucket page
$bucket_name = ""; // The name of the bucket you wish to download from
$file_name   = ""; // The name of the file you wish to download

$b2 = new b2_api; // Create a new instance of b2_api
$output = $b2->b2_authorize_account($account_id, $app_key); // Runs b2_authorize_account
$output = $b2->b2_download_file_by_name($bucket_name, $file_name); // Runs b2_download_file_by_name

echo "b2_download_file_by_name\n\n";
var_dump($output);