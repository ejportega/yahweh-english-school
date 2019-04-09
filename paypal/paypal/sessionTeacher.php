<?php
  if (empty($_SESSION['teacherID']))
  {
    session_destroy();
    header('Location: ../index.php');
  }
?>