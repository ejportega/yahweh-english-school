<?php

  // class dbConnection {
  //   private $db_host = "localhost";
  //   private $db_user = "root";
  //   private $db_pass = "123456";
  //   private $db_name = "yes";

  //   function connect() {
  //     $conn = new mysqli($this->db_host,$this->db_user, $this->db_pass, $this->db_name);

  //     if ($conn->connect_error) {
  //       die("Connection failed: ".$conn->connect_error);
  //     }
  //     return $conn;
  //   }
  // }
    
  $url  = "mysql://uanqgufoe2p1rak4:lwm235m6m8ijtmf5@m7wltxurw8d2n21q.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/b6z6fnfthd2pmv58";
  $dbparts = parse_url($url);

  $hostname = $dbparts['host'];
  $username = $dbparts['user'];
  $password = $dbparts['pass'];
  $database = ltrim($dbparts['path'],'/');
  
  class dbConnection {
    function connect() {
      // Create connection
      $conn = new mysqli($hostname, $username, $password, $database);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      // echo "Connection was successfully established!";
      return $conn;
    }
  }
?>