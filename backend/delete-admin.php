<?php
include 'utils/constants.php';

$id = $_GET["id"];

function deleteAdmin($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM admin WHERE id = $id");

  // return mysqli_affected_rows($conn);

  if (mysqli_affected_rows($conn) > 0) {
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
    header('location:' . URL . 'backend/manage-admin.php');
  } else {
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin</div>";
    header('location:' . URL . 'backend/manage-admin.php');
  }
}

deleteAdmin($id);
