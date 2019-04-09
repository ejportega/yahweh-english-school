<?php
  error_reporting(0);
  error_reporting(E_ALL); 
  ini_set('display_errors', 1);
  // define("BASE_URL", "139.59.235.196/student/");
  define("BASE_URL", "http://139.59.235.196/paypal/");
  define('PRO_PayPal', 0); //  PayPal live change 0 to 1

  if (PRO_PayPal) {
    define("PayPal_CLIENT_ID", "production");
    define("PayPal_SECRET", "production");
    define("PayPal_BASE_URL", "https://api.paypal.com/v1/");
  }
  else {
    define("PayPal_CLIENT_ID", "AYy1M5n9Rq41NFqp7gM8Ce0hJgIeiQA5viGSHDEy7Ub9qaF3fbw36jl4nB7ONpsGCOEq3fxVgE4Ql0ds");
    define("PayPal_SECRET", "EDRBjlB1Cv53HC85wf8b-ft2N9JiitNBsLT_hYxVKja3GdWIeOLT4K5anBQPggMxmLg5r_ZXN8KOsVjN");
    define("PayPal_BASE_URL", "https://api.sandbox.paypal.com/v1/");
  }

?>