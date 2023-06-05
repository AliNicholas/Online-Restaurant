<?php

include('utils/constants.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];

  // check whether the image is available or not and delete only if available
  if ($image_name != "") {
    // get image path
    $path = 'images/food/' . $image_name;
    // remove image from the folder
    $remove = unlink($path);

    // check whether the image is removed or not
    if ($remove == false) {
      $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File</div>";
      header('location: ' . URL . 'backend/manage-food.php');
      die();
    }

    // delete food from database
    $sql = "DELETE FROM food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
      $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
      header('location: ' . URL . 'backend/manage-food.php');
    } else {
      $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
      header('location: ' . URL . 'backend/manage-food.php');
    }
  }
} else {
  // redirect and set session
  $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
  header('location: ' . URL . 'backend/manage-food.php');
}
