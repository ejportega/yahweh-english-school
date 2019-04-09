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

  // Make my_db the current database
  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();
  $db_selected = mysql_select_db('x6rbzgexpamkxp96', $conn);

  if (!$db_selected) {
    $sql = "CREATE TABLE `admin` (
      `username` varchar(50) NOT NULL,
      `password` varchar(50) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    
    CREATE TABLE `class_reports` (
    `class_reports_id` int(50) NOT NULL,
    `teacher_id` int(50) NOT NULL,
    `student_id` int(50) NOT NULL,
    `report` varchar(300) NOT NULL,
    `date` date NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
  CREATE TABLE `course_offered` (
    `course_offered_id` int(50) NOT NULL,
    `row_index` int(50) NOT NULL,
    `course_title` varchar(300) NOT NULL,
    `course_content` text NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
  CREATE TABLE `demo_class` (
    `demo_class_id` int(50) NOT NULL,
    `student_id` int(50) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
  CREATE TABLE `session_details` (
    `session_details_id` int(50) NOT NULL,
    `payment_id` int(50) NOT NULL,
    `teacher_id` int(50) NOT NULL,
    `student_id` int(50) NOT NULL,
    `session_count` int(50) NOT NULL,
    `start_date` date NOT NULL,
    `end_date` date NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
  CREATE TABLE `session_schedules` (
    `session_schedule_id` int(50) NOT NULL,
    `session_details_id` int(50) NOT NULL,
    `date_schedule` date NOT NULL,
    `day_schedule` varchar(50) NOT NULL,
    `time_schedule` varchar(50) NOT NULL,
    `session_status` varchar(50) DEFAULT NULL,
    `session_remark` varchar(300) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
  CREATE TABLE `students` (
    `student_id` int(50) NOT NULL,
    `first_name` varchar(50) NOT NULL,
    `last_name` varchar(50) NOT NULL,
    `email` varchar(30) NOT NULL,
    `password` varchar(50) NOT NULL,
    `country` varchar(50) NOT NULL,
    `skype` varchar(50) NOT NULL,
    `age` int(50) NOT NULL,
    `level` varchar(50) DEFAULT NULL,
    `date` varchar(30) NOT NULL,
    `time` varchar(30) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
  CREATE TABLE `student_apply` (
    `student_apply_id` int(50) NOT NULL,
    `student_id` int(50) NOT NULL,
    `image` longblob,
    `preferred_schedule` varchar(700) NOT NULL,
    `experience` varchar(50) NOT NULL,
    `goals` varchar(300) NOT NULL,
    `hobbies` varchar(300) NOT NULL,
    `ambition` varchar(300) NOT NULL,
    `date` date NOT NULL,
    `time` varchar(50) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
  ALTER TABLE `class_reports`
    ADD PRIMARY KEY (`class_reports_id`);

  ALTER TABLE `course_offered`
    ADD PRIMARY KEY (`course_offered_id`);

  ALTER TABLE `demo_class`
    ADD PRIMARY KEY (`demo_class_id`);

  ALTER TABLE `session_details`
    ADD PRIMARY KEY (`session_details_id`);

  ALTER TABLE `session_schedules`
    ADD PRIMARY KEY (`session_schedule_id`);

  ALTER TABLE `students`
    ADD PRIMARY KEY (`student_id`);

  ALTER TABLE `student_apply`
    ADD PRIMARY KEY (`student_apply_id`),
    ADD KEY `student_id` (`student_id`);

  ALTER TABLE `student_payment`
    ADD PRIMARY KEY (`payment_id`);

  ALTER TABLE `teachers`
    ADD PRIMARY KEY (`teacher_id`);

  ALTER TABLE `teacher_apply`
    ADD PRIMARY KEY (`information_sheet_id`);

  ALTER TABLE `teacher_availability`
    ADD PRIMARY KEY (`teacher_availability_id`);

  ALTER TABLE `class_reports`
    MODIFY `class_reports_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

  ALTER TABLE `course_offered`
    MODIFY `course_offered_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

  ALTER TABLE `demo_class`
    MODIFY `demo_class_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  ALTER TABLE `session_details`
    MODIFY `session_details_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

  ALTER TABLE `session_schedules`
    MODIFY `session_schedule_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

  ALTER TABLE `students`
    MODIFY `student_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  ALTER TABLE `student_apply`
    MODIFY `student_apply_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  ALTER TABLE `student_payment`
    MODIFY `payment_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  ALTER TABLE `teachers`
    MODIFY `teacher_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  ALTER TABLE `teacher_apply`
    MODIFY `information_sheet_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

  ALTER TABLE `teacher_availability`
    MODIFY `teacher_availability_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

  DELIMITER $$

  CREATE DEFINER=`root`@`localhost` EVENT `session_schedules_event` ON SCHEDULE EVERY 1 SECOND STARTS '2018-01-22 16:38:27' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE session_schedules SET session_status = 'done' WHERE date_schedule < curdate() AND session_status IS NULL$$

  DELIMITER ;
  COMMIT;";
      if (mysql_query($sql, $conn)) {
        echo "Database my_db created successfully\n";
    } else {
        echo 'Error creating database: ' . mysql_error() . "\n";
    }
  }

  mysql_close($conn);  
?>
