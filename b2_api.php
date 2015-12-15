<?php

    /**
     * Backblaze B2 API Wrapper
     *
     * @author Dan Rovito
     * @copyright OhioValleyPHP.com
     * @version dev-master
     *
     */
    class b2_api
    {

        //Account Authorization
        public function b2_authorize_account($acct_id, $app_key)
        {
            $this->account_id = $acct_id;
            $application_key  = $app_key;
            $credentials      = base64_encode($this->account_id . ":" . $application_key);
            $url              = "https://api.backblaze.com/b2api/v1/b2_authorize_account";

            $session = curl_init($url);

            // Add headers
            $headers   = array();
            $headers[] = "Accept: application/json";
            $headers[] = "Authorization: Basic " . $credentials;
            curl_setopt($session, CURLOPT_HTTPHEADER, $headers);  // Add headers

            curl_setopt($session, CURLOPT_HTTPGET, true);  // HTTP GET
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true); // Receive server response

            $http_result = curl_exec($session); //results
            $error       = curl_error($session); //Error return
            $http_code   = curl_getinfo($session, CURLINFO_HTTP_CODE); //Result type: 200, 404, 500, etc.

            curl_close($session);

            $json            = json_decode($http_result);
            $this->apiUrl    = $json->apiUrl;
            $this->authToken = $json->authorizationToken;

            //Print result code if it doesn't equal 200
            if ($http_code != 200)
            {
                return print $http_code;
            } else
            {
                //Return results
                return $http_result;
            }


        }

        //Create Bucket
        public function b2_create_bucket($api_bucket_name, $bucket_type)
        {
            $account_id  = $this->account_id; // Obtained from your B2 account page
            $api_url     = $this->apiUrl; // From b2_authorize_account call
            $auth_token  = $this->authToken; // From b2_authorize_account call
            $bucket_name = $api_bucket_name; // 6 char min, 50 char max: letters, digits, - and _
            $bucket_type = $bucket_type; // Either allPublic or allPrivate

            $session = curl_init($api_url . "/b2api/v1/b2_create_bucket");

            // Add post fields
            $data        = array("accountId" => $account_id, "bucketName" => $bucket_name, "bucketType" => $bucket_type);
            $post_fields = json_encode($data);
            curl_setopt($session, CURLOPT_POSTFIELDS, $post_fields);

            // Add headers
            $headers   = array();
            $headers[] = "Authorization: " . $auth_token;
            curl_setopt($session, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($session, CURLOPT_POST, true); // HTTP POST
            curl_setopt($session, CURLOPT_RETURNTRANSFER, true);  // Receive server response
            //$server_output = curl_exec($session); // Let's do this!

            $http_result = curl_exec($session); //results

            curl_close($session); // Clean up

            return json_encode($http_result); // Tell me about the rabbits, George!
        }
        
        //Delete Bucket
        public function b2_delete_bucket()
        {
            
        }
        
        //Delete file version
        public function b2_delete_file_version()
        {
            
        }
        
        //Download file by ID
        public function b2_download_file_by_id()
        {
            
        }
        
        //Download file by Name
        public function b2_download_file_by_name()
        {
            
        }
        
        //Get File Info
        public function b2_get_file_info()
        {
            
        }
        
        //Get upload URL
        public function b2_get_upload_url()
        {
            
        }
    }
