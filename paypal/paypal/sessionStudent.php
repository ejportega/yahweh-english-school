<?php
  if (empty($_SESSION['studentID']))
  {
    session_destroy();
    header('Location: ../index.php');
  }
?>