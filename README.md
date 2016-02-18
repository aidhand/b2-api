#Backblaze B2 PHP API Wrapper 
Forked by [Aidhan Dossel](https://aidhan.net/), originally by [Dan Rovito](https://www.danrovito.com)

This is a PHP wrapper for the [Backblaze B2](https://www.backblaze.com/b2/cloud-storage.html) API.

This wrapper is in active development.

##Usage

Add to your composer.json

```php
  "ukn0me/b2-api": "dev-master"
```

##Functions.

NOTE: All responses are returned as an array.

###Authorization

You'll need to authorize your B2 account to retrieve certain information to use in later API calls. The response body will contain the following:

 - acccountId
 - authorizationToken
 - apiUrl
 - downloadUrl

####Sample code
You need to pass your Account ID and Application key from your B2 account to get your authorization response. To call the authorization function do the following:

```php
$b2 = new b2_api;
$response = $b2->b2_authorize_account("ACCOUNTID", "APPLICATIONKEY");
return $response;
```

###Other calls

Currently only the following API calls are supported, see the examples directory for full examples or see [B2 API](https://www.backblaze.com/b2/docs/) for more information about each call.

#### b2_create_bucket
```php
b2_create_bucket($bucket_name, $bucket_type)

$bucket_name // The new bucket's name. 6 char min, 50 char max, letters, digits, - and _ are allowed
$bucket_type // Type to change to, either allPublic or allPrivate
```

#### b2_delete_bucket
```php
b2_delete_bucket($bucket_id)

$bucket_id // The ID of the bucket you want to delete
```

#### b2_delete_file_version
```php
b2_delete_file_version($file_id, $file_name)

$file_id // The ID of the file you want to delete
$file_name // The file name of the file you want to delete
```

#### b2_get_file_info
```php
b2_get_file_info($file_id)

$file_id // The ID of the file you wish to recieve the info of
```

#### b2_get_upload_url
```php
b2_get_upload_url($bucket_id)

$bucket_id // The ID of the bucket you want to upload to
```

#### b2_update_bucket
```php
b2_update_bucket($bucket_id, $bucket_type)

$bucket_id // The ID of the bucket you want to update
$bucket_type // Type to change to, either allPublic or allPrivate
```

#### b2_upload_file
```php
b2_upload_file($file_path)

$file_path // The path to the file you wish to upload
```