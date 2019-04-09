<?php
  require 'libs/paypal-config.php';
  // require 'libs/session.php';
  include_once 'libs/manage-payments.php';

  if (!empty($_GET['paymentID']) AND !empty($_GET['payerID']) AND !empty($_GET['token']) AND !empty($_GET['amount']) AND !empty($_GET['session_count']) AND !empty($_GET['sid']))
  {
    $managePayments = new ManagePayments();
    $paymentID = $_GET['paymentID'];
    $payerID = $_GET['payerID'];
    $token = $_GET['token'];
    $sessionCount = $_GET['session_count'];
    $amount = $_GET['amount'];
    $sid = $_GET['sid'];

    $paypalCheck = $managePayments->paypalCheck($paymentID, $payerID, $token, $sid, $sessionCount, $amount);
    if ($paypalCheck) {
      header('Location: make-payment.php');
    }
    else {
      header('Location: make-payment.php');
    }
  }

?>