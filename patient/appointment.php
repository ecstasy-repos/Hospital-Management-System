<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Appointments Record</title>
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
							<h5 class="text-center"> Doctor available</h5>
							<?php
								$ad=$_SESSION['admin'];
								$doc=$_SESSION['doctor'];
								$query="SELECT doctor_id,employee.name FROM doctors INNER JOIN employee  on doctors.doctor_id = employee.employee_id";
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
									$id=$row['doctor_id'];
									$username=$row['name'];

									$output.="
									<tr>
									
										<td>$id</td>
										<td>$username</td>
                                    </tr>
                                    

									";
								}
								$output .="
									
								</table>
								";
								// echo $output;
								$sql = "SELECT doctor_id FROM doctors";
								$res= mysqli_query($connect,$sql);
								$output.="<form  method='post' ><label>Choose Doctor: </label>";
								$output.="<select name='docselect'>";
								while ($row = mysqli_fetch_array($res)) {
									$id=$row['doctor_id'];
								$output.="<option value='$id'>$id</option>";
								}
								$output.="</select> ";
								$output.="<input type='submit' name='book' value='book' class='btn btn-success' ></form>"; 
								echo $output;

								if(isset($_POST['book'])){
                                    if(isset($_POST['docselect'])){
                                        $appdate=$_POST['docselect'];
                                        $pid=$_SESSION['patient'];
                                        // $query="UPDATE employee set employee.name='$uname' where employee_id='$doc' ";
                                        // $query="update assigned_doctor set appointment_date='$nappdate' where patient_id='$pid'";
										// $query1="update assigned_doctor set appointment_status = 2 where patient_id='$pid'";
										$qs="INSERT INTO assigned_doctor(patient_id,doctor_id) VALUES ('$pid' , '$appdate')";
                                        mysqli_query($connect,$qs);
                                    }
									// header("Refresh:0");
								}
								
							?> 	
								
						</div>	

						

						



					</div>
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>
