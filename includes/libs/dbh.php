<?php

  class dbConnection {
    private $db_host = "otwsl2e23jrxcqvx.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $db_user = "anjb50rkl50502uv	";
    private $db_pass = "fu0o4lwhgtus36hw";
    private $db_name = "x6rbzgexpamkxp96";

    function connect() {
      $conn = new mysqli($this->db_host,$this->db_user, $this->db_pass, $this->db_name);

      if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
      }
      return $conn;
    }
  }
?>
