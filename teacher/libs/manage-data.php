<?php

  include_once '../includes/libs/dbh.php';

  class ManageData
  {
    private $conn;

    function __construct()
    {
      $dbConnection = new dbConnection();
      $this->conn = $dbConnection->connect();
      return $this->conn;
    }

    public function getTeacherApply($tid)
    {
      $sql = "SELECT * FROM teacher_apply WHERE teacher_id=$tid";
      
      if ($result = $this->conn->query($sql))
      {
        $data = $result->fetch_object();
      }
      return $data;
    }

    public function getTeacherInfo($tid)
    {
      $sql = "SELECT * FROM teachers WHERE teacher_id=$tid";
      
      if ($result = $this->conn->query($sql))
      {
        $data = $result->fetch_object();
      }
      return $data;
    }
  }
?>