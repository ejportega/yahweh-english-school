<?php 

  class PaypalExpress 
  {
    private $conn;

    function __construct() 
    {
      $dbConnection = new dbConnection();
      $this->conn = $dbConnection->connect();
      return $this->conn;
    }

    public function insert_payments($studentId, $amount, $sessionCount) 
    {
      $sql = "INSERT INTO student_payment(student_id, session_count, amount, date, time) 
              VALUES($studentId, $sessionCount, $amount, curdate(), curtime())";
      if ($this->conn->query($sql) === true)
      {
        //successs
      }
      else 
      {
        //error
      }
    }

    public function paypalCheck($paymentID, $payerID, $token)
    {
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

      if (empty($result)){
        return false;
      }

      else {
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

        if($state == 'approved'){
            $this->insert_payments(1,1,1,1,1);
            return true;
        }
        else{
          return false;
        }
      }
    } 
  }
?>