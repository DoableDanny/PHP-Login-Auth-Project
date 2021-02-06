<?php

session_start();
session_unset();

$_SESSION['success_msg'] = 'You have logged out successfully';

header('location: ../login.php');