<?php
include('utils/constants.php');

session_destroy();
header('location: ' . URL . 'backend/login.php');
