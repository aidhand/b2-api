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
  public function b2_authorize_account($acctt_id, $app_key)
  {
    $account_id = $acctt_id; 
    $application_key = $app_key; 
    $credentials = base64_encode($account_id . ":" . $application_key);
    $url = "https://api.backblaze.com/b2api/v1/b2_authorize_account";

    $session = curl_init($url);

    // Add headers
    $headers = array();
    $headers[] = "Accept: application/json";
    $headers[] = "Authorization: Basic " . $credentials;
    curl_setopt($session, CURLOPT_HTTPHEADER, $headers);  // Add headers

    curl_setopt($session, CURLOPT_HTTPGET, true);  // HTTP GET
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true); // Receive server response

    $http_result = curl_exec($session); //results
    $error       = curl_error($session); //Error return
    $http_code   = curl_getinfo($session, CURLINFO_HTTP_CODE); //Result type: 200, 404, 500, etc.

    curl_close ($session);

    //Print result code if it doesn't equal 200
    if ($http_code != 200) {
      return print $http_code;
    } 
    else {
      //Return results 
      return $http_result;
    }


  }
}

?>