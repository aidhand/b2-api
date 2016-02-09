#Backblaze B2 PHP API Wrapper 
Forked by [Aidhan Dossel](https://aidhan.net/), originally by [Dan Rovito](https://www.danrovito.com)

This is a PHP wrapper for the [Backblaze B2](https://www.backblaze.com/b2/cloud-storage.html) API.

This wrapper is in active development.

##Usage

All responses are returned as an array

Add to your composer.json

```php
  "ukn0me/b2-api": "dev-master"
```

##Functions.

###Authorization

You'll need to authorize your B2 account to retrieve certain information to use in later API calls.  The response body will contain the following:

 - acccountId
 - authorizationToken
 - apiUrl
 - downloadUrl

####Sample code
You need to pass your Account ID and Application key from your B2 account to get your authorization response.  To call the authorization function do the following:

```php
$b2 = new b2_api;
$response = $b2->b2_authorize_account("ACCOUNTID", "APPLICATIONKEY");
return $response;
```

###Other calls

Currently only the following API calls are supported, see the [B2 API](https://www.backblaze.com/b2/docs/) for more information about each call.

#### b2_create_bucket
```php
b2_create_bucket($api_bucket_name, $bucket_type)
```

#### b2_delete_bucket
```php
b2_delete_bucket($api_bucket_id)
```

#### b2_delete_file_version
```php
b2_delete_file_version($api_file_id, $api_file_name)
```

#### b2_get_file_info
```php
b2_get_file_info($api_file_id)
```

#### b2_get_upload_url
```php
b2_get_upload_url($api_bucket_id)
```

#### b2_upload_file
```php
b2_upload_file($upload_url, $file_path)
```