<?php
include('partials/menu.php');

function query($sql)
{
  global $conn;
  $result = mysqli_query($conn, $sql);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

$id = $_GET["id"];
$admin = query("SELECT * FROM admin WHERE id = $id")[0];

function updateAdmin($data)
{
  global $conn;

  // Get data from  form
  $full_name = mysqli_real_escape_string($conn, $data['full_name']);
  $username = mysqli_real_escape_string($conn, $data['username']);
  $id = $data['id'];

  $sql = "UPDATE admin SET
          full_name = '$full_name',
          username = '$username' 
          WHERE id = $id";

  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
    header("location: " . URL . 'backend/manage-admin.php');
  } else {
    $_SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
    header('location: ' . URL . 'backend/update-admin.php');
  }
}

if (isset($_POST["update"])) {
  // if (updateAdmin($_POST) > 0) {
  //   echo "<script>
  // 			alert('data updated succesfully!');
  // 			document.location.href = 'main.php';
  // 		  </script>";
  // } else {
  //   echo "<script>
  // 			alert('data failed to update!');
  // 			document.location.href = 'main.php';
  // 		  </script>";
  // }
  updateAdmin($_POST);
  if (isset($_SESSION['update'])) {
    echo $_SESSION['update']; // display
    unset($_SESSION['update']); // remove
  }
}


?>
<div class="main-content">
  <div class="wrapper">
    <h1>Update Admin</h1>

    <br><br>

    <form action="" method="POST">

      <table class="tbl-30">
        <tr>
          <td>Full Name: </td>
          <td><input type="text" name="full_name" value="<?= $admin['full_name'] ?>"></td>
        </tr>
        <tr>
          <td>Username: </td>
          <td><input type="text" name="username" value="<?= $admin['username'] ?>"></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?= $admin['id'] ?>">
            <input type="submit" name="update" value="Update Admin" class="btn-secondary">
          </td>
        </tr>

      </table>

    </form>
  </div>
</div>

<?php include('partials/footer.php') ?>;