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
					<h4 class="my-2">Pharmacy Dashboard</h4>
					<div class="col-md-12 my-1">
						<div class="row">
						
						
							<div class="col-md-3 bg-warning mx-2 my-2" style="height: 130px;">
								<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												<?php
													$ad=mysqli_query($connect,"SELECT * FROM patient ");
													$num=mysqli_num_rows($ad);
												?>
												<h5 class="my-2 text-white" style="font-size:30px"><?php echo ""; ?></h5>
												<h5 class="text-white"></h5>
												<h5 class="text-white">Prescription</h5>
											</div>
											<div class="col-md-4">
												<a href="prescription.php"><i class="fa fa-procedures fa-3x my-4"  style="color: white;"></i></a>
												
											</div>
											
										</div>
										
									</div>
							</div>
							<div class="col-md-3 bg-danger mx-2 my-2" style="height: 130px;">
								<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												<?php
													$ad=mysqli_query($connect,"SELECT * FROM medicine");
													$num=mysqli_num_rows($ad);
												?>
												<h5 class="my-2 text-white" style="font-size:30px"><?php echo ""; ?></h5>
												<h5 class="text-white">Medcine</h5>
												
											</div>
											<div class="col-md-4">
												<a href="medicine.php"><i class="fa fa-pills fa-3x my-4"  style="color: white;"></i></a>
												
											</div>
											
										</div>
										
									</div>
							</div>

							<div class="col-md-3 bg-warning mx-2 my-2" style="height: 130px;">
								<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												
											
												
												<h5 class="my-2 text-white">Profile</h5>
											</div>
											<div class="col-md-4">
												<a href="profile.php"><i class="fa fa-users-cog fa-3x my-4"  style="color: white;"></i></a>
												
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