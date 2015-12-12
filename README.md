#Backblaze B2 API Wrapper by [OhioValleyPHP](https://www.ohiovalleyphp.com)
This is a PHP wrapper for the [Backblaze B2](https://www.backblaze.com/b2/cloud-storage.html) API.

This wrapper is in active development.

##From the B2 Website
> B2 Cloud Storage is a cloud service for storing files in the cloud.
> Files are available for download at any time, either through the API
> or through a browser-compatible URL.

##Usage

All responses are JSON

Add to your composer.json

```php
  "ohiovalleyphp/backblaze-b2-api-wrapper": "dev-master"
```

##Below you'll find more information on how to carry out the specific functions of the API wrapper.

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

You will receive a response similar to the following:

```javascript
{
"accountId": "YOUR_ACCOUNT_ID",
"apiUrl": "https://api900.backblaze.com",
"authorizationToken": "2_20150807002553_443e98bf57f978fa58c284f8_24d25d99772e3ba927778b39c9b0198f412d2163_acct",
"downloadUrl": "https://f900.backblaze.com"
}
```

The Authorization Token will change everytime this function is used.

###Create a Bucket

This part requires that you use the response received from the Authorization instructions above.  You'll need to follow the requirements from B2 for creating a bucket.  The request must contain the following:

 - Authorization
 - accountId
 - bucketName
 - bucketType (Either "allPublic", meaning that files in this bucket can be downloaded by anybody, or "allPrivate", meaning that you need a bucket authorization token to download files

####Sample Code

I recommend retrieving your accountId, apiUrl, and authorizationToken from the Authorization function above.

You can pass all the information you need to create a bucket by using this code (Remember, we are using values returned from the Authorization function from above):

```php
$new_bucket = $b2->b2_create_bucket(ACCOUNTID, APIURL, AUTHORIZATIONTOKEN, YOURBUCKETNAME, BUCKETTYPE);
return json_decode($new_bucket);
```

You will receive a response similar to the following:

```javascript
{
"bucketId" : "4a48fe8875c6214145260818",
"accountId" : "010203040506",
"bucketName" : "any_name_you_pick",
"bucketType" : "allPrivate"
}
```

If the bucket name is in use by anyone else you will receive a response similar to this:

```javascript
{
"code": "duplicate_bucket_name",
"message": "Bucket name is already in use.",
"status": 400
}
```