<?php
  
  include_once '../includes/libs/dbh.php';

  class ManagePayments
  {
    private $conn;
    private $dbConnection;

    function __construct() 
    {
      $this->dbConnection = new dbConnection();
      $this->conn = $this->dbConnection->connect();
      return $this->conn;
    }

    public function isPending($studentID) {
      $sql = "SELECT payment_id FROM student_payment WHERE student_id=$studentID AND status='pending'";
      $result = $this->conn->query($sql);
      $rowCount = $result->num_rows;
  
      if ($rowCount > 0) {
        return true;
      }
      else {
        return $rowCount;
      }
    }

    public function isEnrolled($sid) 
    {
      $sql = "SELECT end_date FROM session_details WHERE student_id=$sid  AND end_date >= curdate()";
			$result = $this->conn->query($sql);
      $rowCount = $result->num_rows;
      
      if ($rowCount > 0) {
        return $result->fetch_object();
      }
      else {
        return $rowCount;
      }
    }

    public function isApplied($sid)
    {
      $sql = "SELECT * FROM student_apply WHERE student_id=$sid";
      $result = $this->conn->query($sql);
      $rowCount = $result->num_rows;

      return $rowCount;
    }

    public function demoClass($sid) 
    {
      $sql = "SELECT * FROM demo_class WHERE student_id=$sid";
      
      $result = $this->conn->query($sql);
      $rowCount = $result->num_rows;

      return $rowCount;
    }

    public function insertPayments($sid, $sessionCount, $amount, $type) 
    {
      $sql = "INSERT INTO student_payment(student_id, session_count, amount, date, time, type)
              VALUES($sid, $sessionCount, $amount, curdate(), curtime(), '$type')";
      
      if ($this->conn->query($sql) === true)
      {
        // success
      }
      else 
      {
        // error
        // echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    public function insertDemoClass($sid) 
    {
      $sql = "INSERT INTO demo_class(student_id)
              VALUES($sid)";
      
      if ($this->conn->query($sql) === true)
      {
        // success
      }
      else 
      {
        // error
        // echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    public function paypalCheck($paymentID, $payerID, $token, $sid, $sessionCount, $amount)
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

        if($state == 'approved' AND $amount == $total)
        {   
            $classType='Regular Class';
            if (!$this->demoClass($sid)) {
              $this->insertDemoClass($sid);
              $classType = 'Demo Class';
            }
            $this->insertPayments($sid, $sessionCount, $total, $classType);
            return true;
        }
        else{
          return false;
        }
      }
    } 
  }
?>