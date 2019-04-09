<?php
  require('config.php');


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
    // curl_setopt($ch, CURLOPT_URL, 'http://www.google.com.ph');
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $secret);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    curl_setopt($ch, CURLOPT_POSTFIELDS, "cmd=notify-validate&" . http_build_query($_POST));
    $result = curl_exec($ch);
    $accessToken = null;

    if (curl_error($ch)) {
      echo curl_error($ch);
    }
    else 
    {
      echo "okay";
    }

    if (empty($result)){
      echo "empty";
    }
    else 
    {
      echo "not empty";
    }

    curl_close($ch);
    print_r($result);    
?>