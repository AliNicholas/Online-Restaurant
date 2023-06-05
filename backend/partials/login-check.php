<?php

// Access Controll

// check the user is logged or not
if (!isset($_SESSION['user'])) { // if user session is not set
  // user not logged
  //redirect
  $_SESSION['not-logged-msg'] = "<div class='error text-center'>Please Login to access Admin Panel.</div>";
  header('location: ' . URL . 'backend/login.php');
}
