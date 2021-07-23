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
							<h5 class="text-center"> Appointments Recieved</h5>
							<?php
								$ad=$_SESSION['admin'];
								$doc=$_SESSION['doctor'];
								$query="SELECT patient_id,patient_name FROM assigned_doctor NATURAL JOIN patient where doctor_id= '$doc' and appointment_status=1";
								$res= mysqli_query($connect,$query);

								$output="
									<table class='table  table-bordered'>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Date</th>
                                        <th style='width: 10%;'>Action</th>
										<th style='width: 10%;'>Action</th>
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
									<form method='post'  class='my-2' enctype='mulitpart/from-data'>
										<td> <input type='text' name='id' value=$id class='from-control' autocomplete='off' readonly> </td>
										<td>$username</td>
								

                                    <td>
                                    <div class='from-group'>
                                        <input type='date' name='appdate' class='from-control' autocomplete='off'>       
                                    </div>
                                    </td>
                                    <td>
                                    <input type='submit' name='accept' value='ACCEPT' class='btn btn-success' >
                                    </td>
									<td>
                                    <input type='submit' name='reject' value='REJECT' class='btn btn-danger' >
                                    </td>
                                </form>

									";
								}
								$output .="
									</tr>
									
								</table>
								";

								echo $output;
								if(isset($_POST['accept'])){
                                    if(isset($_POST['appdate'])){
                                        $appdate=$_POST['appdate'];
                                        $pid=$_POST['id'];
										$doc=$_SESSION['doctor'];
                                        // $col1="''{$appdate}''";
                                        $col2="''{$pid}'',''{$doc}''";
										$nappdate = date("Y-m-d", strtotime($appdate));
										$col1="''{$nappdate}''";
                                       
										$query="CALL TableUpdate('assigned_doctor','appointment_date','$col1','patient_id,doctor_id','$col2')";
										$querys="CALL TableUpdate('assigned_doctor','appointment_status','2','patient_id,doctor_id','$col2')";
										// echo"$doc";
										// echo"hello";
										$qm="SELECT * from doctors where doctor_id='$doc'";
										// echo"$qm";
										$res=mysqli_query($connect,$qm);
										while($row=mysqli_fetch_array($res)){
											// echo"doctor";
											$df=$row['consultation_charge'];
											// echo"$df";
											$q="UPDATE bill  set doctor_fee= $df ,bill_date = NOW() where bill_id=$pid ";
																	

											// echo "$q";
											$result=mysqli_query($connect,$q);
											$result=mysqli_query($connect,$q2);
										}

                                        mysqli_query($connect,$query);
										mysqli_query($connect,$querys);
										header("Location: appointment.php");
                                    }
									// header("Refresh:0");
								}
								else if(isset($_POST['reject'])){
										if(isset($_POST['appdate'])){
											$appdate=$_POST['appdate'];
											// $doc=$_SESSION['doctor'];
											$pid=$_POST['id'];
											$col1="''{$appdate}''";
											$col2="''{$doc}''";
									
											$query="DELETE FROM assigned_doctor WHERE patient_id = '$id'";
											
											mysqli_query($connect,$query);
										header("Location: appointment.php");
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
