<?php
include('partials/menu.php');

function addAdmin($data)
{
  global $conn;

  // Get data from  form
  $full_name = mysqli_real_escape_string($conn, $data['full_name']);
  $username = mysqli_real_escape_string($conn, $data['username']);
  $raw_password = md5($data['password']); // password Encrypted using MD5
  $password = mysqli_real_escape_string($conn, $raw_password);

  $sql = "INSERT INTO admin (full_name, username, password)
             VALUES ('$full_name', '$username', '$password')";

  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
    header('location: ' . URL . 'backend/manage-admin.php');
  } else {
    $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
    header('location: ' . URL . 'backend/add-admin.php');
  }
}

// submit button
if (isset($_POST['submit'])) {
  addAdmin($_POST);
}

if (isset($_SESSION['add'])) {
  echo $_SESSION['add']; // display
  unset($_SESSION['add']); // remove
}
?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Admin</h1>

    <br><br>

    <form action="" method="POST">

      <table class="tbl-30">
        <tr>
          <td>Full Name: </td>
          <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
        </tr>
        <tr>
          <td>Username: </td>
          <td><input type="text" name="username" placeholder="Enter Your Username"></td>
        </tr>
        <tr>
          <td>Password: </td>
          <td><input type="password" name="password" placeholder="Enter Your Password"></td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
          </td>
        </tr>

      </table>

    </form>
  </div>
</div>

<?php include('partials/footer.php') ?>;