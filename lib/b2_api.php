<?php

namespace b2apiwrapper;


trait b2api
{
  //The URL of the API
  private static $url = "https://api.backblaze.com/b2api/v1/b2_authorize_account";
  
  //Stores the api key
  private $account_id;
  private $application_key;
  
  //Timeout for the API requests in seconds
  const TIMEOUT = 5;
  
  /**
     * Make a new instance of the API client
  */
  public function __construct()
  {
    $parameters = func_get_args();
      //User Request
      $this->account_id     = $parameters[0];
      $this->application_key = $parameters[1];
    }
  }
  
  public function setAccount($account_id)
  {
      $this->account_id = $account_id;
  }
  public function setToken($application_key)
  {
      $this->application_key = $application_key;
  }
  
  //Authorize Account
  public function b2_authorize_account()
  {
    $credentials = base64_encode($account_id . ":" . $application_key);
      
    $session = curl_init($url);

    // Add headers
    $headers = array();
    $headers[] = "Accept: application/json";
    $headers[] = "Authorization: Basic " . $credentials;
    curl_setopt($session, CURLOPT_HTTPHEADER, $headers);  // Add headers
    
    curl_setopt($session, CURLOPT_HTTPGET, true);  // HTTP GET
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true); // Receive server response
    $server_output = curl_exec($session);
    curl_close ($session);
    if ($http_code != 200) {
        return array(
            'error' => $error
        );
    } else {
        return json_decode($server_output, true);;
    }
  }
  
  /**
     * GLOBAL API CALL
     * HTTP POST a specific task with the supplied data
  */
  private function http_post($auth, $data)
  {
    $api_url = $auth["apiUrl"];
    $auth_token = $auth["authorizationToken"];
  }  
}
