<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Nurse Dashboard</title>
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
					<h4 class="my-2">Nurse Dashboard</h4>
					<div class="col-md-12 my-1">
						<div class="row">
							
						
							<div class="col-md-3 bg-warning mx-2" style="height: 130px;">
								<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												<?php
													$ad=mysqli_query($connect,"SELECT * FROM patient ");
													$num=mysqli_num_rows($ad);
												?>
												<h5 class="my-2 text-white" style="font-size:30px"><?php echo $num; ?></h5>
												<h5 class="text-white">Total</h5>
												<h5 class="text-white">Patient</h5>
											</div>
											<div class="col-md-4">
												<a href="patient.php"><i class="fa fa-procedures fa-3x my-4"  style="color: white;"></i></a>
												
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