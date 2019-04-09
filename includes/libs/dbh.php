<?php

  class dbConnection {
    private $db_host = "m7wltxurw8d2n21q.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $db_user = "uanqgufoe2p1rak4";
    private $db_pass = "lwm235m6m8ijtmf5";
    private $db_name = "b6z6fnfthd2pmv58";

    function connect() {
      $conn = new mysqli($this->db_host,$this->db_user, $this->db_pass, $this->db_name);

      if ($conn->connect_error) {
        die("Connection failed: hehe".$conn->connect_error);
      }
      return $conn;
    }
  }
?>