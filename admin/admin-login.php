<?php
  include_once 'header.php';
  include_once '../includes/libs/dbh.php';
  
  $errorMessage = '';
  if (isset($_POST['username']))
  {
    $dbConnection = new dbConnection();
    $conn = $dbConnection->connect();
    $uname = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM admin WHERE username='$uname'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
      $row = $result->fetch_assoc();
      if ($password == $row['password'])
      {
        // $_SESSION['admin'] = 
        header('Location: home.php');
      }
      else {
        $errorMessage = 'Username or password error, try again!'; 
      }
    }
    else {
      $errorMessage = 'Username or password error, try again!'; 
    }
  }
?>

<div class="container">
  <div class="row justify-content-center" style="margin-top: 10%">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          Yahweh English School Admin Login
        </div>
        <div class="card-body">
          <form action="" method="post">
            <div class="form-group">
              <input class="form-control" type="text" name="username" placeholder="User Name">
            </div>
            <div class="form-group">
              <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
              <input class="btn btn-success btn-block" type="submit" name="submit" value="Login">
            </div>
            <div>
              <small class="text-danger" id="errorMessage"><?php echo $errorMessage; ?></small>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>