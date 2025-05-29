<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if(!isset($_SESSION['auth'])){
  $_SESSION['status']="Login to access dashboard";
  header("Location: login.php");
  exit(0);
}
?>