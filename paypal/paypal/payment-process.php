<?php
  // require('session.php');
  require 'config.php';
  require 'paypalExpress.php';
  
  if (!empty($_GET['paymentID']) && !empty($_GET['payerID']) && !empty($_GET['token'])) {
    $paypalExpress = new PaypalExpress();
    $paymentID = $_GET['paymentID'];
    $payerID = $_GET['payerID'];
    $token = $_GET['token'];


      $ch = curl_init();
      $clientId = PayPal_CLIENT_ID;
      $secret = PayPal_SECRET;
      curl_setopt($ch, CURLOPT_URL, PayPal_BASE_URL.'oauth2/token');
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $secret);
      curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
      $result = curl_exec($ch);
      $accessToken = null;

        $json = json_decode($result);
        $accessToken = $json->access_token;
        $curl = curl_init(PayPal_BASE_URL.'payments/payment/' . $paymentID);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $accessToken,
        'Accept: application/json',
        'Content-Type: application/xml'
        ));
        $response = curl_exec($curl);
        $result = json_decode($response);


        $state = $result->state;
        $total = $result->transactions[0]->amount->total;
        $currency = $result->transactions[0]->amount->currency;
        $subtotal = $result->transactions[0]->amount->details->subtotal;
        $recipient_name = $result->transactions[0]->item_list->shipping_address->recipient_name;
        curl_close($ch);
        curl_close($curl);

        echo $state."<br>";
        echo $total."<br>";
        echo $currency."<br>";
        echo $subtotal."<br>";
        echo $recipient_name."<br>";
    
    // $paypalCheck = $paypalExpress->paypalCheck($paymentID, $payerID, $token);
    // if ($paypalCheck)
    // {
    //   header('Location: index.php');
    // }
  }
  else {
    header('Location: a.php');
  }
?>