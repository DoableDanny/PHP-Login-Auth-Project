<?php include('./includes/header.php'); ?>
<?php include_once('./handlers/login.php'); ?>

<?php
session_start();
// Get success_msg for if just successfully registered
if(isset($_SESSION['success_msg'])) {
  $success_msg = $_SESSION['success_msg'];
  unset($_SESSION['success_msg']);
}

// Error message ("need to log in to view resource")
if(isset($_SESSION['error_msg'])) {
  $error_msg = $_SESSION['error_msg'];
  unset($_SESSION['error_msg']);
}

// Log in errors (e.g. incorrect pw)
$errors = $errors ?? [];
?>

<div class="row mt-5">
  <div class="col-md-6 m-auto">
    <div class="card card-body">
      <h1 class="text-center mb-3"><i class="fas fa-sign-in-alt"></i> Login</h1>

      <?php if(isset($success_msg)) : ?>
      <div class="alert alert-success"><?php echo $success_msg; ?></div>
      <?php endif; ?>

      <?php if(isset($error_msg)) : ?>
      <div class="alert alert-warning"><?php echo $error_msg; ?></div>
      <?php endif; ?>

      <?php if(!empty($errors)) {
        foreach($errors as $error) { ?>
      <div class="alert alert-warning" role="alert">
        <?php echo $error['msg']; ?>
      </div>
      <?php  }
      } ?>

      <form action="login.php" method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password"
            required />
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
      </form>
      <p class="lead mt-4">
        No Account? <a href="register.php">Register</a>
      </p>
    </div>
  </div>
</div>

<?php include('./includes/footer.php') ?>