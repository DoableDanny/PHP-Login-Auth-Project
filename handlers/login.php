<?php
include_once("config/Database.php");
include_once("models/User.php");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Connect to DB
  $database = new Database();
  $db = $database->connect();
  $user = new User($db);

  $errors = [];

  if($_POST['email'] !== "" && $_POST['password'] !== "") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user has an account
    $user->email = $email;
    $user->read_single();

    if(isset($user->password)) {
      $hash = $user->password;

      // Check entered password matches that from DB
      if(password_verify($password, $hash)) {
        if(isset($user->name)) {
          session_start();
          $_SESSION['username'] = $user->name;
        }
        
        header('location: handlers/dashboard.php');
      } else {
        array_push($errors, ['msg' => 'Incorrect password']);
      }
    } else {
      array_push($errors, ['msg' => 'That email is not registered']);
    }
  } else {
    array_push($errors, ['msg' => 'Please enter an email and password']);
  }
}