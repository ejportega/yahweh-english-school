<?php
  
  include_once '../includes/libs/dbh.php';

  class ManageData
  {
    private $conn;
    private $dbConnection;

    function __construct() 
    {
      $this->dbConnection = new dbConnection();
      $this->conn = $this->dbConnection->connect();
      return $this->conn;
    }

    public function getStudentInfo($sid) 
    {
      $sql = "SELECT * FROM students WHERE student_id=$sid";

      if ($result = $this->conn->query($sql))
      {
        $data = $result->fetch_object();
      }
      return $data;
    }

    public function studRemainingSession($sid) {
      $sql = "SELECT ss.session_details_id, end_date, start_date, session_count,
      SUM(CASE
        WHEN session_status='done' THEN 1
        END) AS used, 
      SUM(CASE 
        WHEN session_status='teacher is AWOL' OR session_status='teacher is on leave' OR session_status='uncharged' OR session_status='student is on leave' THEN 1
        END)AS uncharged
      FROM session_schedules ss
      INNER JOIN session_details sd
      WHERE sd.student_id=$sid
      AND sd.session_details_id=ss.session_details_id
      GROUP BY ss.session_details_id, end_date, start_date, session_count";
      $result = $this->conn->query($sql);
      $rowCount = $result->num_rows;
  
      if ($rowCount > 0) {
        $data = $result->fetch_object();
        return $data;
      }
      else {
        return $rowCount;
      }
      return $data;
    }
  } 
?>