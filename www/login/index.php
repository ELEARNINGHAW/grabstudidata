<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>HALLMONITOR LOGIN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  href="../css/bootstrap.min.css" rel="stylesheet">
  <script src="../js/jquery-1.11.0.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <style type="text/css">
  body{ background-color: lightgrey; }
  </style>
</head>
<body>

<div class="container">
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">

		<div class="jumbotron" style="margin-top:30%">
			<h2 style="text-align:center">Login</h2>
    		<form action="login.php" method="POST">
			<div class="form-group">
				<label>Username:</label>
				<input type="email" name="user_email" class="form-control"  value="<?php if(isset($_COOKIE["user_email"])) { echo $_COOKIE["user_email"]; } ?>" required>
			</div>
			<div class="form-group">
				<label>Password:</label>
				<input type="password" name="user_password" class="form-control" value="<?php if(isset($_COOKIE["user_password"])) { echo $_COOKIE["user_password"]; } ?>" required>
			</div>
			
			<!--
			<div class="form-group">
			<label for="login-remember"><input type="checkbox" id="remember" name="remember" <?php  if(isset($_COOKIE["user_email"])) { ?> checked <?php } ?>>Remember Me</label>
     		</div>
			-->
			
		    <input type="submit" name="login" value="Login" class="btn btn-primary">
		</form>
	</div>
	</div>
	<div class="col-md-4"></div>
</div>
<?php 
#include_once('inc/footer.php');
 ?>