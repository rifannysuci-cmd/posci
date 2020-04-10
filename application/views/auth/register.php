<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    		<!-- Bootstrap CSS -->
		<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/a-design.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/awesome.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/plugins/dataTables/dataTables.bootstrap.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/plugins/morris.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- jQuery -->
		<script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js') ?>"></script>
		<!-- Bootstrap JavaScript -->
		<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <title>Register</title>
  </head>
  <body>
    <div class="container">
      <div class="card card-auth mx-auto mt-5">
        <div class="card-header bg-success text-white">Register</div>
        <div class="card-body">
          <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success">
              <?php echo $_SESSION['success']; ?>
            </div>
          <?php endif; ?>
          <form action="<?php echo base_url('auth/register'); ?>" method="post">
            <div class="form-group">
              <label for="username" class="col-form-label">Username</label>
              <input type="text" class="form-control" name="username">
              <span class="text-danger form-error"><?php echo form_error('username'); ?></span>
            </div>
            <div class="form-group">
              <label for="nama" class="col-form-label">Nama</label>
              <input type="nama" class="form-control" name="nama">
              <span class="text-danger form-error"><?php echo form_error('nama'); ?></span>
            </div>
            <div class="form-group">
              <label for="password" class="col-form-label">Password</label>
              <input type="password" class="form-control" name="password">
              <span class="text-danger form-error"><?php echo form_error('password'); ?></span>
            </div>
            <div class="form-group">
              <label for="confirm_password" class="col-form-label">Confirm Password</label>
              <input type="password" class="form-control" name="confirm_password">
              <span class="text-danger form-error"><?php echo form_error('confirm_password'); ?></span>
            </div>
            <p class="text-center">Have an account? <a href="<?php echo base_url('/'); ?>">Sign in!</a></p>
            <button type="submit" class="btn btn-block btn-outline-success">Register</button>
          </form>
        </div>
      </div>
    </div>

  </body>
</html>