<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Blog Site</title>
  
  <?php include('./header.php'); ?>
  <?php 
  session_start();
  if(isset($_SESSION['login_id']))
  header("location:index.php?page=home");
  ?>

</head>
<style>
  body {
    width: 100%;
    height: 100%;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f5f5f5;
  }
  main#main {
    width: 100%;
    height: 100vh;
    display: flex;
  }
  #login-left {
    flex: 60%;
    background: #00000061;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  #login-left .logo {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  #login-right {
    flex: 40%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  .card {
    width: 100%;
    max-width: 400px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
  }
  .form-group {
    margin-bottom: 15px;
  }
  .form-group label {
    display: block;
    margin-bottom: 5px;
  }
  .form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  .btn-primary {
    background-color: #007bff;
    border: none;
    color: white;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
  }
  .btn-primary:hover {
    background-color: #0056b3;
  }
  .alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 4px;
  }
</style>

<body>

<main id="main" class="alert-info">
	<div id="login-left">
		<img src="bg.jpg" alt="Logo" class="logo">
	</div>
	<div id="login-right">
		<div class="card col-md-8">
			<div class="card-body">
				<form id="login-form">
					<div class="form-group">
						<label for="username" class="control-label">Username</label>
						<input type="text" id="username" name="username" class="form-control">
					</div>
					<div class="form-group">
						<label for="password" class="control-label">Password</label>
						<input type="password" id="password" name="password" class="form-control">
					</div>
					<center>
						<button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button>
					</center>
				</form>
			</div>
		</div>
	</div>
</main>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'ajax.php?action=login',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
			},
			success: function(resp){
				if(resp == 1){
					location.reload('index.php?page=home');
				} else {
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>
</html>
