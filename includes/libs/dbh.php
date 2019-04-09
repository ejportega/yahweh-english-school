<?php

  class dbConnection {
    private $db_host = "otwsl2e23jrxcqvx.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $db_user = "l1jaqgen2zks3wc0";
    private $db_pass = "b2c0er3u92yj2mm6";
    private $db_name = "yahwehenglishschool";

    function connect() {
      $conn = new mysqli($this->db_host,$this->db_user, $this->db_pass, $this->db_name);

      if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
      }
      return $conn;
    }
  }
?>
