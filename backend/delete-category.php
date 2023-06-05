<?php
include('utils/constants.php');

// check whether the id and image name is set or not
if (isset($_GET['id']) and isset($_GET['image_name'])) {
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];

  // remove the image file 
  if ($image_name != "") {
    $path = "images/category/" . $image_name;

    $remove = unlink($path);

    // if failed to remove image file
    if ($remove == false) {
      // set session msg
      $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image</div>";
      // redirect
      header('location: ' . URL . 'admin/manage-category.php');
      die();
    }
  }

  //Delete Data from Database
  $sql = "DELETE FROM category WHERE id = $id";

  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    // set session and redirect
    $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
    header('location: ' . URL . 'backend/manage-category.php');
  } else {
    // set session and redirect
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
    header('location: ' . URL . 'backend/manage-category.php');
  }

  // redirect 

} else {
  // redirect to manage-category
  header('location: ' . URL . 'backend/manage-category.php');
}
