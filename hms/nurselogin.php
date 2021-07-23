
<?php

	session_start();
	include("include/connection.php");

	if (isset($_POST['login'])){
		$username=$_POST['uname'];
		$password=$_POST['pass'];

		$error= array();

		if(empty($username)){
			$error['nurse']="Enter Username";
		}else if(empty($password)){
			$error['nurse']="Enter Password";
		}
		if(count($server)==0){
			$query="SELECT * FROM login_details WHERE id='$username' AND password='$password'";
			$result=mysqli_query($connect,$query);

			if(mysqli_num_rows($result)==1){
				echo"<script>alert('You have login as an admin')</script>";

				$_SESSION['nurse']=$username;

				header("Location: nurse/index.php");
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
	<title>Nurse Login Page</title>

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
					<h5 class="text-center my-3">Nurse Login</h5>
					<img src="image/nurse_logo.jpeg" width ="200px" height="200px" class="colr-md-12" style="border-radius: 50%">
					<form method="post"  class="my-2">
						
						<div class="alert alert-danger">
							<?php
								if(isset($error['nurse'])){
									$sh=$error['nurse'];
									$show="<h4 class=alert alert-danger'>$sh</h4>";
								}else{
									$show="";
								}
								echo $show; 
							?>
						</div>

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