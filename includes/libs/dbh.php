<?php

  class dbConnection {
    private $db_host = "s54ham9zz83czkff.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $db_user = "mii6scoyegstu9r4";
    private $db_pass = "wbocaa2to9l3gkca";
    private $db_name = "k0x01vy4rhl4p237";

    function connect() {
      $conn = new mysqli($this->db_host,$this->db_user, $this->db_pass, $this->db_name);

      if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
      }
      return $conn;
    }
  }
?>
