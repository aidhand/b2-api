<?php
require "../b2_api.php"; // Include the API wrapper

$account_id = ""; // Account ID, obtained from your B2 bucket page
$app_key    = ""; // Application ID, obtained from your B2 bucket page

$b2 = new b2_api; // Create a new instance of b2_api
$auth = $b2->b2_authorize_account($account_id, $app_key); // Runs b2_authorize_account
$output = $b2->b2_list_buckets($auth->apiUrl, $auth->accountId, $auth->authorizationToken); // Runs b2_list_buckets

echo "b2_list_buckets\n\n";
var_dump($output);