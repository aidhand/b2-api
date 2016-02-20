<?php
require "../b2_api.php"; // Include the API wrapper

$account_id = ""; // Account ID, obtained from your B2 bucket page
$app_key    = ""; // Application ID, obtained from your B2 bucket page
$bucket_id  = ""; // The ID of the bucket containing the files you wish to list

$options = array( // None of these options are required but may be used
    "max_count" => "", // The maxiumum amount of file names to list in a call
    "start_name" => "" // If the specified file name exists, it's the first listed
);

$b2 = new b2_api; // Create a new instance of b2_api
$auth = $b2->b2_authorize_account($account_id, $app_key); // Runs b2_authorize_account
$output = $b2->b2_list_file_names($auth->apiUrl, $auth->authorizationToken, $bucket_id, $options); // Runs b2_list_file_names

echo "b2_list_file_names\n\n";
var_dump($output);