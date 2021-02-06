<?php
include('./handlers/register.php');

// Get session variables
if(isset($_SESSION['errors'])) {
  $errors = $_SESSION['errors'];
  unset($_SESSION['errors']);
}

$errors = $errors ?? "";
$name = $name ?? "";
$email = $email ?? "";
?>

<?php include('./includes/header.php') ?>

<div class="row mt-5">
  <div class="col-md-6 m-auto">
    <div class="card card-body">
      <h1 class="text-center mb-3">
        <i class="fas fa-user-plus"></i> Register
      </h1>
      <?php if(!empty($errors)) {
        foreach($errors as $error) { ?>
      <div class="alert alert-warning" role="alert">
        <?php echo $error['msg']; ?>
      </div>
      <?php  }
      } ?>
      <form action="register.php" method="POST">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="name" id="name" name="name" class="form-control" placeholder="Enter Name"
            value="<?php echo $name; ?>" required />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email"
            value="<?php echo $email; ?>" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Create Password"
            required />
        </div>
        <div class="form-group">
          <label for="password2">Confirm Password</label>
          <input type="password" id="password2" name="password2" class="form-control" placeholder="Confirm Password"
            required />
        </div>
        <button type="submit" class="btn btn-primary btn-block">
          Register
        </button>
      </form>
      <p class="lead mt-4">Have An Account? <a href="login.php">Login</a></p>
    </div>
  </div>
</div>

<?php include('./includes/footer.php') ?>