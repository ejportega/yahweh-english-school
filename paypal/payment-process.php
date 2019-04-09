<?php
  // require('session.php');
  require 'config.php';
  require 'paypalExpress.php';
  
  if (!empty($_GET['paymentID']) && !empty($_GET['payerID']) && !empty($_GET['token'])) {
    $paypalExpress = new PaypalExpress();
    $paymentID = $_GET['paymentID'];
    $payerID = $_GET['payerID'];
    $token = $_GET['token'];

    $paypalCheck = $paypalExpress->paypalCheck($paymentID, $payerID, $token);
    if ($paypalCheck)
    {
      header('Location: index.php');
    }
  }
  else {
    header('Location: a.php');
  }
?>