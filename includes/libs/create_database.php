<?php
    include_once('dbh.php');

    $dbConnection = new dbConnection();
    $conn = $dbConnection->connect();
    $sql = 'CREATE DATABASE my_db';
  
    if (!$db) {
      echo "CHECK";
    } 
    else {
      echo "ChEkERS";
    }

    $conn->close();
?>