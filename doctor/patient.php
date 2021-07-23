<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Patient Record</title>
</head>
<body>
	<?php
	include("../include/header.php");
	?>
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2" style="margin-left: -30px;">
					<?php
					include("sidenav.php");
					include("../include/connection.php");
					?>
				</div>
				<div class="col-md-10">
					<div class="row">
						
						<!-- Show patient/ remove him/her -->
						<!--  need to handle session part -->
						<div class="col-md-6">
							<h5 class="text-center"> ALL Patient appointed </h5>
							<?php
								$ad=$_SESSION['admin'];
								$doc=$_SESSION['doctor'];
								$query="SELECT patient_id,patient_name FROM assigned_doctor NATURAL JOIN patient where doctor_id= '$doc' and appointment_status=2";
								$res= mysqli_query($connect,$query);

								$output="
									<table class='table  table-bordered'>
									<tr>
										<th>ID</th>
										<th>Name</th>
									
									</tr>

								";
								if(mysqli_num_rows($res)<1){
									$output.="<tr><td class='text-center'>No Patient </td></tr>";
								}
								while($row=mysqli_fetch_array($res)){
									$id=$row['patient_id'];
									$username=$row['patient_name'];

									$output.="
										<tr>
										<td>$id</td>
										<td>$username</td>

									";
								}
								$output .="
									</tr>
									
								</table>
								";

								echo $output;


								
							?> 	
								
						</div>	

						

						



					</div>
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>