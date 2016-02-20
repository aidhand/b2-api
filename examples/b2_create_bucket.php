<?php
require "../b2_api.php"; // Include the API wrapper

$account_id  = ""; // Account ID, obtained from your B2 bucket page
$app_key     = ""; // Application ID, obtained from your B2 bucket page
$bucket_name = ""; // 6 char min, 50 char max: letters, digits, - and _
$bucket_type = ""; // Either allPublic or allPrivate

$b2 = new b2_api; // Create a new instance of b2_api
$auth = $b2->b2_authorize_account($account_id, $app_key); // Runs b2_authorize_account
$output = $b2->b2_create_bucket($auth->apiUrl, $auth->accountId, $auth->authorizationToken, $bucket_name, $bucket_type); // Runs b2_create_bucket

echo "b2_create_bucket\n\n";
var_dump($output);