<?php

    /**
     * Backblaze B2 API wrapper for PHP
     *
     * @author Aidhan Dossel
     * @copyright aidhan.net
     * @version dev-master
     *
     */

    // Base function for further calls
    function b2_call($call_url, $headers, $data = NULL) 
    {
        $session = curl_init($call_url);

        if(!empty($data)) // Check if POST data exists
        {
            if(is_array($data)) // Check if the data is an array
            {
                $data = json_encode($data); // Encode the data as JSON
            }

            curl_setopt($session, CURLOPT_POST, true); // Make the request a POST
            curl_setopt($session, CURLOPT_POSTFIELDS, $data); // Add the data to the request
        }

        else
        {
            curl_setopt($session, CURLOPT_HTTPGET, true); // Make the request a GET
        }
        
        curl_setopt($session, CURLOPT_HTTPHEADER, $headers); // Include the headers
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  // Receive server response
        $http_result = curl_exec($session); // Execute the request
        curl_close($session); // Clean up

        json_decode($http_result);

        if(json_last_error() == JSON_ERROR_NONE || json_last_error() == 0) // Check if the response is JSON
        {
            return json_decode($http_result); // Return the result, as an array.
        }
        
        else
        {
            return $http_result; // Return the result as it was recieved
        }
    }

    class b2_api
    {
        // Account authorization
        public function b2_authorize_account($account_id, $app_key)
        {
            $call_url   = "https://api.backblaze.com/b2api/v1/b2_authorize_account";
            $account_id = $account_id; 
            $app_key    = $app_key;

            $credentials = base64_encode($account_id.":".$app_key);

            // Add headers
            $headers = array(
                "Accept: application/json",
                "Authorization: Basic {$credentials}"
            );

            $result = b2_call($call_url, $headers);
            return $result; // Return the result
        }

        // Cancel large file
        // Part of the large files API, not functional at time of writing
        public function b2_cancel_large_file()
        {

        }

        // Create bucket
        public function b2_create_bucket($api_url, $account_id, $auth_token, $bucket_name, $bucket_type)
        {
            $call_url    = $api_url."/b2api/v1/b2_create_bucket";
            $account_id  = $account_id; // Obtained from your B2 account page
            $auth_token  = $auth_token; // Obtained from the b2_authorize_account call
            $bucket_name = $bucket_name; // The new bucket's name. 6 char min, 50 char max, letters, digits, - and _ are allowed
            $bucket_type = $bucket_type; // Type to change to, either allPublic or allPrivate

            // Add POST fields
            $data = array(
                "accountId"  => $account_id,
                "bucketName" => $bucket_name,
                "bucketType" => $bucket_type
            );

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}"
            );

            $result = b2_call($call_url, $headers, $data);
            return $result; // Return the result
        }

        // Delete bucket
        public function b2_delete_bucket($api_url, $account_id, $auth_token, $bucket_id)
        {
            $call_url   = $api_url."/b2api/v1/b2_delete_bucket";
            $account_id = $account_id; // Obtained from your B2 account page
            $auth_token = $auth_token; // Obtained from the b2_authorize_account call
            $bucket_id  = $bucket_id; // The ID of the bucket you want to delete

            // Add POST fields
            $data = array(
                "accountId" => $account_id,
                "bucketId"  => $bucket_id
            );

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}"
            );

            $result = b2_call($call_url, $headers, $data);
            return $result; // Return the result
        }

        // Delete file version
        public function b2_delete_file_version($api_url, $auth_token, $file_id, $file_name)
        {
            $call_url   = $api_url."/b2api/v1/b2_delete_file_version";
            $auth_token = $auth_token; // Obtained from the b2_authorize_account call
            $file_id    = $file_id; // The ID of the file you want to delete
            $file_name  = $file_name; // The file name of the file you want to delete

            // Add POST fields
            $data = array(
                "fileId"   => $file_id, 
                "fileName" => $file_name
            );

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}"
            );

            $result = b2_call($call_url, $headers, $data);
            return $result; // Return the result
        }

        // Download file by ID
        public function b2_download_file_by_id($download_url, $file_id, $auth_token = NULL)
        {
            $call_url     = $download_url."/b2api/v1/b2_download_file_by_id?fileId=".$file_id;
            $auth_token   = $auth_token; // Obtained from the b2_authorize_account call
            $download_url = $download_url; // Obtained from the b2_authorize_account call
            $file_id      = $file_id; // The ID of the file you wish to download

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}"
            );

            $result = b2_call($call_url, $headers);
            return $result; // Return the result
        }

        // Download file by name 
        public function b2_download_file_by_name($download_url, $bucket_name, $file_name, $auth_token = NULL)
        {
            $call_url     = $download_url."/file/".$bucket_name."/".$file_name;
            $auth_token   = $auth_token; // Obtained from the b2_authorize_account call
            $download_url = $download_url; // Obtained from the b2_authorize_account call
            $bucket_name  = $bucket_name; // The name of the bucket you wish to download from
            $file_name    = $file_name; // The name of the file you wish to download

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}"
            );

            $result = b2_call($call_url, $headers);
            return $result; // Return the result
        }

        // Finish large file
        // Part of the large files API, not functional at time of writing
        public function b2_finish_large_file()
        {

        }

        // Get file info
        public function b2_get_file_info($api_url, $auth_token, $file_id)
        {
            $call_url   = $api_url."/b2api/v1/b2_get_file_info";
            $auth_token = $auth_token; // Obtained from the b2_authorize_account call
            $file_id    = $file_id; // The ID of the file you wish to recieve the info of

            // Add POST fields
            $data = array(
                "fileId" => $file_id
            );

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}"
            );

            $result = b2_call($call_url, $headers, $data);
            return $result; // Return the result
        }

        // Get upload URL
        public function b2_get_upload_url($api_url, $account_id, $auth_token, $bucket_id)
        {
            $call_url   = $api_url."/b2api/v1/b2_get_upload_url";
            $account_id = $account_id; // Obtained from your B2 account page
            $auth_token = $auth_token; // Obtained from the b2_authorize_account call
            $bucket_id  = $bucket_id; // The ID of the bucket you want to upload to

            // Add POST fields
            $data = array(
                "bucketId" => $bucket_id
            );

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}"
            );

            $result = b2_call($call_url, $headers, $data);
            return $result; // Return the result
        }

        // Hide file
        public function b2_hide_file($api_url, $auth_token, $bucket_id, $file_name)
        {
            $call_url   = $api_url."/b2api/v1/b2_hide_file";
            $auth_token = $auth_token; // Obtained from the b2_authorize_account call
            $bucket_id  = $bucket_id; // The ID of the bucket containing the file you wish to hide
            $file_name  = $file_name; // The name of the file you wish to hide

            // Add POST fields
            $data = array(
                "bucketId" => $bucket_id,
                "fileName" => $file_name
            );

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}"
            );

            $result = b2_call($call_url, $headers, $data);
            return $result; // Return the result
        }

        // List buckets
        public function b2_list_buckets($api_url, $account_id, $auth_token)
        {
            $call_url   = $api_url."/b2api/v1/b2_list_buckets";
            $auth_token = $auth_token; // Obtained from the b2_authorize_account call
            $account_id = $account_id; // Obtained from your B2 account page

            // Add POST fields
            $data = array(
                "accountId" => $account_id
            );

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}"
            );

            $result = b2_call($call_url, $headers, $data);
            return $result; // Return the result
        }

        // List file names
        public function b2_list_file_names($api_url, $auth_token, $bucket_id, $options = NULL)
        {
            $call_url   = $api_url."/b2api/v1/b2_list_file_names";
            $auth_token = $auth_token; // Obtained from the b2_authorize_account call
            $bucket_id  = $bucket_id; // The ID of the bucket containing the files you wish to list
            $max_count  = $options["max_count"]; // The maxiumum amount of file names to list in a call
            $start_name = $options["start_name"]; // If the specified file name exists, it's the first listed

            // Add POST fields
            $data = array(
                "bucketId"      => $bucket_id,
                "startFileName" => $start_name,
                "maxFileCount"  => $max_count
            );

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}"
            );

            $result = b2_call($call_url, $headers, $data);
            return $result; // Return the result
        }

        // List file versions
        public function b2_list_file_versions($api_url, $auth_token, $bucket_id, $options = NULL)
        {
            $call_url   = $api_url."/b2api/v1/b2_list_file_versions";
            $auth_token = $auth_token; // Obtained from the b2_authorize_account call
            $bucket_id  = $bucket_id; // The ID of the bucket containing the files you wish to list
            $max_count  = $options["max_count"]; // The maxiumum amount of file names to list in a call
            $start_id   = $options["start_id"]; // If the specified file ID exists, it's the first listed
            $start_name = $options["start_name"]; // If the specified file name exists, it's the first listed

            // Add POST fields
            $data = array(
                "bucketId"      => $bucket_id,
                "startFileId"   => $start_id,
                "startFileName" => $start_name,
                "maxFileCount"  => $max_count
            );

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}"
            );

            $result = b2_call($call_url, $headers, $data);
            return $result; // Return the result
        }

        // List parts
        // Part of the large files API, not functional at time of writing
        public function b2_list_parts()
        {

        }

        // List unfinished large files
        // Part of the large files API, not functional at time of writing
        public function b2_list_unfinished_large_files()
        {

        }

        // Start large file
        // Part of the large files API, not functional at time of writing
        public function b2_start_large_file()
        {

        }

        // List update bucket
        public function b2_update_bucket($api_url, $account_id, $auth_token, $bucket_id, $bucket_type)
        {
            $call_url    = $api_url."/b2api/v1/b2_update_bucket";
            $account_id  = $account_id; // Obtained from your B2 account page
            $auth_token  = $auth_token; // Obtained from the b2_authorize_account call
            $bucket_id   = $bucket_id; // The ID of the bucket you want to update
            $bucket_type = $bucket_type; // Type to change to, either allPublic or allPrivate

            // Add POST fields
            $data = array(
                "accountId"  => $account_id,
                "bucketId"   => $bucket_id,
                "bucketType" => $bucket_type
            );

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}"
            );

            $result = b2_call($call_url, $headers, $data);
            return $result; // Return the result
        }

        // List upload file
        public function b2_upload_file($upload_url, $auth_token, $file_path)
        {
            $call_url   = $upload_url; // Upload URL, obtained from the b2_get_upload_url call
            $auth_token = $auth_token; // Obtained from the b2_authorize_account call
            $file_path  = $file_path; // The path to the file you wish to upload

            $handle = fopen($file_path, 'r');
            $read_file = fread($handle, filesize($file_path));

            $file_name = basename($file_path);
            $file_type = mime_content_type($file_path);
            $file_hash = sha1_file($file_path);

            // Add headers
            $headers = array(
                "Authorization: {$auth_token}",
                "X-Bz-File-Name: {$file_name}",
                "Content-Type: {$file_type}",
                "X-Bz-Content-Sha1: {$file_hash}"
            );

            $result = b2_call($call_url, $headers, $read_file);
            return $result; // Return the result
        }

        // Upload part
        // Part of the large files API, not functional at time of writing
        public function b2_upload_part()
        {

        }
    }
