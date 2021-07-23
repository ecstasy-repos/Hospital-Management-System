<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Prescription</title>
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
						
						<!-- Show doctors / remove him/her -->
						<div class="col-md-6">
							<h5 class="text-center">  Prescription</h5>
							<?php
								$pa=$_SESSION['patient'];
								$query="SELECT doctor_id,prescription FROM assigned_doctor where patient_id= '$pa' and appointment_status=2";
								// echo"$query";
								$res= mysqli_query($connect,$query);

								$output="
									<table class='table  table-bordered'>
									<tr>
										<th>Doctor_ID</th>
				
										<th>Prescription</th>
										<th style='width: 10%;'>Action</th>
									</tr>

								";
								if(mysqli_num_rows($res)<1){
									$output.="<tr><td class='text-center'>No Prescription </td></tr>";
								}
								while($row=mysqli_fetch_array($res)){
									$id=$row['doctor_id'];
									$presc=$row['prescription'];
									

									$output.="
										<tr>
										<td>$id</td>
										<td>$presc</td>
										<td>
                                    <a href='prescription.php?id=$id'><button presc='$presc' class='btn btn-success'> Send to Pharmacist</button></a>
                                    </td>
									
										

									";
								}
								$output .="
									</tr>
									
								</table>
								";

								echo $output;


								if(isset($_GET['id'])){
									// echo"id";
									// echo"hello";
									$d_id=$_GET['id'];
									// $pa=$_SESSION['patient'];
									// echo "$d_id";
									// echo "$pa";
									// echo "$presc";
									// $query="INSERT INTO prescription VALUES('$pa',''P001'' ,'$presc')";
									
									$qry="SELECT *  FROM pharmacy";
									$res= mysqli_query($connect,$qry);
									while($row=mysqli_fetch_array($res) ){
										$ph=$row['pharmacist_id'];
									}	
											
									$col2="''{$presc}'',''{$pa}'',''{$ph}''";
                          
                                    $query="CALL TableInsert('prescription','presc,patient_id,pharmacist_id','$col2')";

                                    // echo"$query";
                                    // $querys="CALL TableUpdate('assigned_doctor','appointment_status','2','patient_id,doctor_id','$col2')";
                                    mysqli_query($connect,$query);
								}

								
							?> 	
								
							



						



					</div>
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>
