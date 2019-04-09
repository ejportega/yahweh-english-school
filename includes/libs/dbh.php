<?php

  class dbConnection {
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "123456";
    private $db_name = "yes";

    function connect() {
      $conn = new mysqli($this->db_host,$this->db_user, $this->db_pass, $this->db_name);

      if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
      }
      return $conn;
    }
  }
?>