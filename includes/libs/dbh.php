<?php

  class dbConnection {
    private $db_host = "m7wltxurw8d2n21q.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    private $db_user = "fryabvokbvmhbo9t";
    private $db_pass = "kf5glaf1yypttyod";
      private $db_name = "iki2qhvn8ah9asdg";

    function connect() {
      $conn = new mysqli($this->db_host,$this->db_user, $this->db_pass, $this->db_name);

      if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
      }
      return $conn;
    }
  }
?>
