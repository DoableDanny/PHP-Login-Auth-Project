<?php include('./includes/header.php') ?>

<?php 
session_start();

if(empty($_SESSION['username'])) {
  $_SESSION['error_msg'] = 'Please log in to view this resource';

  header('location: login.php');
}

$username = $_SESSION['username'] ?? 'Guest';
?>

<h1 class="mt-4">Dashboard</h1>
<p>Welcome <?php echo $username; ?></p>
<a href="handlers/logout.php" class="btn btn-secondary">Logout</a>

<?php include('./includes/footer.php') ?>