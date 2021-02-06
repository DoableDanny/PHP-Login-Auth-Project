<?php
include_once('config/Database.php');
include_once('models/User.php');

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = [];

  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $password2 = trim($_POST['password2']);

  // Validation
  if(!$name || !$email || !$password || !$password2) {
    array_push($errors, ['msg' => 'All fields are required']);
  }

  if(strlen($password) < 6) {
    array_push($errors, ['msg' => 'Password needs to be at least 6 characters']);
  }

  if($password !== $password2) {
    array_push($errors, ['msg' => 'Passwords do not match']);
  }

  // If no errors so far, check if user already exists
  if(empty($errors)) {
    $database = new Database();
    $db = $database->connect();
    $newUser = new User($db);

    // Set email and see if user exists
    $newUser->email = $email;
    $newUser->read_single();


    if(isset($newUser->name)) {
      array_push($errors, ['msg' => 'That email is already registered']);
      
      // $_SESSION['errors'] = $errors;
    } else {
        // No errors up to here so create new user account
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        $newUser->name = $name;
        $newUser->password = $hashed_password;

        if($newUser->create()) {
          $_SESSION['success_msg'] = 'Your account is now registered. You can now log in';
          
          header('location: login.php');
        }
    }
  }
} 