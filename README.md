#Backblaze B2 PHP API Wrapper 
Forked by [Aidhan Dossel](https://aidhan.net/), originally by [Dan Rovito](https://www.danrovito.com)

This is a PHP wrapper for the [Backblaze B2](https://www.backblaze.com/b2/cloud-storage.html) API.

This wrapper is in alpha and should not be used on production sites.

##Usage
1. Clone the repository

```
git clone https://github.com/UKn0Me/b2-api.git
```

2. Include b2_api.php when required

```php
include "/path/to/b2_api.php"; // Include the API wrapper
```

OR

For you folks that use Composer

```
  composer require ukn0me/b2-api
```

####Requirements
- PHP 5.3.3+ (works on 7.0)
- php-curl
- php-json
- php-mbstring
If you're using Composer, it should get all the dependencies figured out but you still need to have the PHP extensions installed.

###Sample code
You need to pass your Account ID and Application key from your B2 account to get your authorization response. To call the authorization function do the following:

```php
$b2 = new b2_api;
$response = $b2->b2_authorize_account("ACCOUNTID", "APPLICATIONKEY");
return $response;
```

The response will contain the following as an array:
- acccountId
- authorizationToken
- apiUrl
- downloadUrl

##Calls

Currently only the following API calls are supported, see the examples directory for full examples or see [B2 API](https://www.backblaze.com/b2/docs/) for more information about each call.

#### b2_create_bucket
```php
b2_create_bucket($api_url, $account_id, $auth_token, $bucket_name, $bucket_type)

$api_url // The API URL, obtained from the b2_authorize_account call
$account_id // Obtained from your B2 account page or from the b2_authorize_account call
$auth_token // The authentication token, obtained from the b2_authorize_account call
$bucket_name // The new bucket's name. 6 char min, 50 char max, letters, digits, - and _ are allowed
$bucket_type // Type to create the bucket as, either allPublic or allPrivate
```

#### b2_delete_bucket
```php
b2_delete_bucket($api_url, $account_id, $auth_token, $bucket_id)

$api_url // The API URL, obtained from the b2_authorize_account call
$account_id // Obtained from your B2 account page or from the b2_authorize_account call
$auth_token // The authentication token, obtained from the b2_authorize_account call
$bucket_id // The ID of the bucket you want to delete
```

#### b2_delete_file_version
```php
b2_delete_file_version($api_url, $auth_token, $file_id, $file_name)

$api_url // The API URL, obtained from the b2_authorize_account call
$auth_token // The authentication token, obtained from the b2_authorize_account call
$file_id // The ID of the file you want to delete
$file_name // The file name of the file you want to delete
```

#### b2_download_file_by_id
```php
b2_download_file_by_id($download_url, $file_id, [$auth_token])

$download_url // The download URL, obtained from the b2_authorize_account call
$file_id // The ID of the file you wish to download
$auth_token // Only required if bucket is private, obtained from the b2_authorize_account call
```

#### b2_download_file_by_name
```php
b2_download_file_by_name($download_url, $bucket_name, $file_name, [$auth_token]);

$download_url // The download URL, obtained from the b2_authorize_account call
$bucket_name // The name of the bucket you wish to download from
$file_name // The name of the file you wish to download
$auth_token // Only required if bucket is private, obtained from the b2_authorize_account call
```

#### b2_get_file_info
```php
b2_get_file_info($api_url, $auth_token, $file_id)

$api_url // The API URL, obtained from the b2_authorize_account call
$auth_token // The authentication token, obtained from the b2_authorize_account call
$file_id // The ID of the file you wish to recieve the info of
```

#### b2_get_upload_url
```php
b2_get_upload_url($api_url, $account_id, $auth_token, $bucket_id)

$api_url // The API URL, obtained from the b2_authorize_account call
$account_id // Obtained from your B2 account page or from the b2_authorize_account call
$auth_token // The authentication token, obtained from the b2_authorize_account call
$bucket_id // The ID of the bucket you want to upload to
```

#### b2_hide_file
```php
b2_hide_file($api_url, $auth_token, $bucket_id, $file_name)

$api_url // The API URL, obtained from the b2_authorize_account call
$auth_token // The authentication token, obtained from the b2_authorize_account call
$bucket_id // The ID of the bucket containing the file you wish to hide
$file_name // The name of the file you wish to hide
```

#### b2_list_buckets
```php
b2_list_buckets($api_url, $auth_token, $account_id)

$api_url // The API URL, obtained from the b2_authorize_account call
$auth_token // The authentication token, obtained from the b2_authorize_account call
$account_id // Obtained from your B2 account page or from the b2_authorize_account call
```

#### b2_list_file_names
```php
b2_list_file_names($api_url, $auth_token, $bucket_id, [$options])

$api_url // The API URL, obtained from the b2_authorize_account call
$auth_token // The authentication token, obtained from the b2_authorize_account call
$bucket_id // The ID of the bucket containing the files you wish to list

$options = array( // None of these options are required but may be used
    "max_count" => "", // The maxiumum amount of file names to list in a call
    "start_name" => "" // If the specified file name exists, it's the first listed
);
```

#### b2_list_file_versions
```php
b2_list_file_versions($api_url, $auth_token, $bucket_id, [$options])

$api_url // The API URL, obtained from the b2_authorize_account call
$auth_token // The authentication token, obtained from the b2_authorize_account call
$bucket_id // The ID of the bucket containing the files you wish to list

$options = array( // None of these options are required but may be used
    "max_count" => "", // The maxiumum amount of file names to list in a call
    "start_id" => "", // If the specified file ID exists, it's the first listed
    "start_name" => "" // If the specified file name exists, it's the first listed
);
```

#### b2_update_bucket
```php
b2_update_bucket($api_url, $account_id, $auth_token, $bucket_id, $bucket_type)

$api_url // The API URL, obtained from the b2_authorize_account call
$account_id // Obtained from your B2 account page or from the b2_authorize_account call
$auth_token // The authentication token, obtained from the b2_authorize_account call
$bucket_id // The ID of the bucket you want to update
$bucket_type // Type to change to, either allPublic or allPrivate
```

#### b2_upload_file
```php
b2_upload_file($upload_url, $auth_token, $file_path)

$upload_url // Upload URL, obtained from the b2_get_upload_url call
$auth_token // The authentication token, obtained from the b2_authorize_account call
$file_path // The path to the file you wish to upload
```