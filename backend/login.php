<?php
include('utils/constants.php');

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $raw_password = md5($_POST['password']);
  $password = mysqli_real_escape_string($conn, $raw_password);

  $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

  $res = mysqli_query($conn, $sql);

  // check user exist or not
  $count = mysqli_num_rows($res);
  if ($count == 1) {
    $_SESSION['login'] = "<div class='success text-center'>Login Successful</div>";
    $_SESSION['user'] = $username;
    header('location:' . URL . 'backend/');
  } else {
    $_SESSION['login'] = "<div class='error text-center'>Username or Password is Wrong/div>";
    header('location:' . URL . 'backend/login.php');
  }
}



?>
<html>

<head>
  <title>Login - Online Restaurant</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="login ">
    <h1 class="text-center">Login</h1>
    <br>

    <?php
    if (isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }
    if (isset($_SESSION['not-logged-msg'])) {
      echo $_SESSION['not-logged-msg'];
      unset($_SESSION['not-logged-msg']);
    }
    ?>
    <br><br>

    <!-- form login -->
    <form action="" method="POST" class="text-center">
      Username: <br>
      <input type="text" name="username" placeholder="Enter Username">
      <br><br>
      Password: <br>
      <input type="password" name="password" placeholder="Enter Password">
      <br><br>
      <input type="submit" name="submit" value="login" class="btn-primary">
      <br><br>
    </form>


    <p class="text-center">Created By </br><a href="#">Nicholas Ali & M.Raihan F</a></p>
  </div>
</body>

</html>