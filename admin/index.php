<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
</head>
<body>
	<?php
		include("../include/header.php");

		include("../include/connection.php");
	?>

	<div class="container-fluid">
		<div class="col-md-12">
			<div class = "row">
				<div class="col-md-2" style="margin-left: -30px;">
					<?php
						include("sidenav.php");
					?>
				</div>
				<div class="col-md-10">
					<h4 class="my-2">Admin Dashboard</h4>
					<div class="col-md-12 my-1">
						<div class="row">
							<div class="col-md-3 bg-success mx-2" style="height: 130px;">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												<?php
													$ad=mysqli_query($connect,"SELECT * FROM employee where is_admin=1");
													$num=mysqli_num_rows($ad);
												?>
												<h5 class="my-2 text-white" style="font-size:30px"><?php echo ""; ?></h5>
												<h5 class="text-white"></h5>
												<h5 class="text-white">Profile</h5>
											</div>
											<div class="col-md-4">
												<a href="profile.php"><i class="fa fa-users-cog fa-3x my-4"  style="color: white;"></i></a>
												
											</div>
											
										</div>
										
									</div>
							</div>
							<div class="col-md-3 bg-info mx-2" style="height: 130px;">
								<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												<?php
													$ad=mysqli_query($connect,"SELECT * FROM doctors");
													$num=mysqli_num_rows($ad);
												?>
												<h5 class="my-2 text-white" style="font-size:30px"><?php echo ""; ?></h5>
												<h5 class="text-white">Total</h5>
												<h5 class="text-white">Doctor</h5>
											</div>
											<div class="col-md-4">
												<a href="doctor.php"><i class="fa fa-user-md fa-3x my-4"  style="color: white;"></i></a>
												
											</div>
											
										</div>
										
									</div>
							</div>
							<div class="col-md-3 bg-warning mx-2" style="height: 130px;">
								<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												<?php
													$ad=mysqli_query($connect,"SELECT * FROM patient ");
													$num=mysqli_num_rows($ad);
												?>
												<h5 class="my-2 text-white" style="font-size:30px"><?php echo ""; ?></h5>
												<h5 class="text-white">Total</h5>
												<h5 class="text-white">Patient</h5>
											</div>
											<div class="col-md-4">
												<a href="patient.php"><i class="fa fa-procedures fa-3x my-4"  style="color: white;"></i></a>
												
											</div>
											
										</div>
										
									</div>
							</div>
							<div class="col-md-3 bg-danger mx-2 my-2" style="height: 130px;">
								<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												<?php
													$ad=mysqli_query($connect,"SELECT * FROM bill");
													$num=mysqli_num_rows($ad);
												?>
												<h5 class="my-2 text-white" style="font-size:30px"><?php echo ""; ?></h5>
												<h5 class="text-white">Total</h5>
												<h5 class="text-white">Bill</h5>
											</div>
											<div class="col-md-4">
												<a href="bill.php"><i class="fa fa-flag fa-3x my-4"  style="color: white;"></i></a>
												
											</div>
											
										</div>
										
									</div>
							</div>
							
							<div class="col-md-3 bg-success mx-2 my-2" style="height: 130px;">
								<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												<?php
													$ad=mysqli_query($connect,"SELECT * FROM pharmacy");
													$num=mysqli_num_rows($ad);
												?>
												<h5 class="my-2 text-white" style="font-size:30px"><?php echo ""; ?></h5>
												<h5 class="text-white">Total</h5>
												<h5 class="text-white">Pharmacist</h5>
											</div>
											<div class="col-md-4">
												<a href="pharmacist.php"><i class="fa fa-diagnoses fa-3x my-4"  style="color: white;"></i></a>
												
											</div>
											
										</div>
										
									</div>
							</div>

						</div>
						
					</div>
						
					</div>
				</div>
			</div>
		</div>
		
	</div>

</body>
</html>