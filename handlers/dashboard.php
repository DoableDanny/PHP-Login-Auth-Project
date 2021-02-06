<?php
session_start();

// Check if user is logged in
if(empty($_SESSION['username'])) {
  $_SESSION['error_msg'] = 'You need to log in to view this resource';
  header('location: ../login.php');
} else {
  header('location: ../dashboard.php');
}

?>