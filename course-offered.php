<?php
  include_once('includes/libs/dbh.php');
  include_once 'includes/home/header.php';

  $dbConnection = new dbConnection();
  $conn = $dbConnection->connect();

  function getContent($conn) {
    $sql = "SELECT course_content, course_title, row_index FROM course_offered ORDER BY row_index ASC";
    $result = $conn->query($sql);
    $rowCount = $result->num_rows;

    if ($rowCount > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
      return $data;
    }
    else {
      return $rowCount;
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Yahweh English School</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="dist/css/style.css">
    <script src="https://use.fontawesome.com/b365c50be6.js"></script>  
  </head>
  <style>
    .navbar {
    background: #fff !important;
    border-bottom: 1px solid #e1e1e1;
    }
    #btn-login:hover {
      color: #fff;
    }
    dt {
      font-size: 19px;
    }
  </style>
<body>
  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <a class="navbar-brand font-weight-bold" href="#">YAHWEH ENGLISH SCHOOL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ourschool.php">OUR SCHOOL</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">COURSE OFFERED<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact-us.php">CONTACT US</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item mr-2">
          <a id="btn-login" class="mt-1 btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#modal-login">LOG IN</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
        </li>
      </ul>
    </div>
  </nav>

  <div id="wrapper">
    <div class="container-fluid">
      <div class="row p-5"> 
        <div id="sub-header" class="col-lg-12"></div>
        <div class="col-lg-12 my-4 p-0">
          <h2 class="font-weight-bold">COURSE OFFERED</h2>
        </div>
        <!-- /.col-lg-12 -->
        <?php
          $contents = getContent($conn);
          function mb_unserialize($string) {
            $string = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $string);
            return unserialize($string);
          }
        
          if ($contents > 0) {
            foreach ($contents AS $row) {
              $title = $row['course_title'];
              $content = unserialize(base64_decode($row['course_content']));

              echo 
              '<div class="col-lg-12 p-0">
              <dl>
              <dt>'.$title.'</dt>';
              for ($i = 0; $i < count($content); $i++) {
                echo 
                '<dd class="m-0">'.$content[$i].'</dd>';
              }
              echo '</dl></div>';
            }
          }
        ?>
        <!-- <div class="col-lg-12 p-0">
          <dl>
            <dt>Level 01 Pre-Beginner GEARING UP I</dt>
            <dd class="m-0">1. Learn English Through Nursery Rhymes or Songs</dd>
          </dl>
        </div> -->
        
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.wrapper -->
  <?php include_once('includes/home/modals.php') ?>
  <?php include_once 'includes/home/footer.php'; ?> 
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>