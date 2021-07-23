
<?php

	session_start();
	include("include/connection.php");

	if (isset($_POST['login'])){
		$username=$_POST['uname'];
		$password=$_POST['pass'];

		$error= array();

		if(empty($username)){
			$error['admin']="Enter Username";
		}else if(empty($password)){
			$error['admin']="Enter Password";
		}
		if(count($server)==0){
			$query="SELECT * FROM login_details WHERE id='$username' AND password='$password'";
			$result=mysqli_query($connect,$query);

			if(mysqli_num_rows($result)==1){
				echo"<script>alert('You have login as an admin')</script>";

				$_SESSION['admin']=$username;

				header("Location: admin/index.php");
				exit();
			}else{
				echo"<script>alert('Invalid username of password')</script>";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Login Page</title>
</head>
<body style="background-image: url(image/hospital2.jpeg);background-repeat: no-repeat;background-size: cover;">
	<?php
		include("include/header.php")
	?>
	<div style="margin-top:60px;"></div>
	<div class="container">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 jumpbotron">
					<h5 class="text-center my-3">Admin Login</h5>
					<img src="image/admin.jpeg" class="colr-md-12">
					<form method="post"  class="my-2">
						
						

						<div class="form-group">
									<label> Username</label>
									<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
						</div>
						<div class="form-group">
								<label>Password</label>
								<input type="password" name="pass" class="form-control">
						</div>
						<input type="submit" name="login" class="btn btn-success" value="Login">

						
					</form>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
	</div>
</body>
</html>