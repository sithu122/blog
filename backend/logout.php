<?php 
 session_start();
 unset($_SESSION['user_id']);
 unset($_SESSION['name']);
 unset($_SESSION['email']);
 unset($_SESSION['profile']);

 header("location:login.php");

?>