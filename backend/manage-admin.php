<?php include('partials/menu.php'); ?>

<?php

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
?>

<!-- Main Section Starts -->
<div class="main-content">
  <div class="wrapper">
    <h1>Manage Admin</h1>

    <br><br>

    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add']; // display
      unset($_SESSION['add']); // remove
    }
    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete']; // display
      unset($_SESSION['delete']); // remove
    }
    if (isset($_SESSION['update'])) {
      echo $_SESSION['update']; // display
      unset($_SESSION['update']); // remove
    }
    if (isset($_SESSION['user-not-found'])) {
      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']);
    }
    if (isset($_SESSION['pwd-not-match'])) {
      echo $_SESSION['pwd-not-match'];
      unset($_SESSION['pwd-not-match']);
    }
    if (isset($_SESSION['change-pwd'])) {
      echo $_SESSION['change-pwd'];
      unset($_SESSION['change-pwd']);
    }
    ?>

    <br><br>

    <!-- button to add admin -->
    <a href="add-admin.php" class="btn-primary">Add Admin</a>

    <br><br><br>

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
      </tr>

      <?php
      $sql = "SELECT * FROM admin";
      $admin =  query($sql);
      ?>

      <?php if (empty($admin)) : ?>
        <tr>
          <td align="center">student data not found</td>
        </tr>
      <?php endif; ?>

      <?php $i = 1; ?>
      <?php foreach ($admin as $row) { ?>
        <tr>
          <td><?= $i ?></td>
          <td><?= $row["full_name"]; ?></td>
          <td><?= $row["username"]; ?></td>
          <td>
            <a href="update-password.php?id=<?php echo $row["id"]; ?>" class="btn-primary">Change Password</a>
            <a href="update-admin.php?id=<?php echo $row["id"]; ?>" class="btn-secondary">Update</a>
            <a href="delete-admin.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('are you sure?')" class="btn-danger">Delete</a>
          </td>
        </tr>
        <?php $i++; ?>
      <?php } ?>
    </table>

  </div>
</div>
<!-- Main Section Ends -->

<?php include('partials/footer.php'); ?>