<?php
session_start();

$servername = "localhost";
$user = "root";
$password = "";
$database = "online-restaurant";

$conn = new mysqli($servername, $user, $password, $database);

define('URL', 'http://localhost:8080/online-restaurant/');
define('IMAGE_URL', 'http://localhost:8080/online-restaurant/backend/images/');
