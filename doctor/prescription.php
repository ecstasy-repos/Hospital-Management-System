<?php
session_start();
?>

<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){
						include("../include/connection.php");
						$doc=$_SESSION['doctor'];
                                if(isset($_POST['update'])){
                                    if(isset($_POST['prescription'])){
                                        $presc=$_POST['prescription'];
                                        $pid=$_POST['id'];
                                        $col1="''{$presc}''";
                                        $col2="''{$pid}'',''{$doc}''";
                                        // echo $id;
                                        // $query="UPDATE employee set employee.name='$uname' where employee_id='$doc' ";
                                        $query="CALL TableUpdate('assigned_doctor','prescription','$col1','patient_id,doctor_id','$col2')";
                                        // $querys="CALL TableUpdate('assigned_doctor','appointment_status','2','patient_id,doctor_id','$col2')";
                                        $res=mysqli_query($connect,$query);
										if($res)
										{
											
											header( "Location:prescription.php" ); 
										}
										else{
											echo "<script>alert('failed')</script>";
										}
                                    }
                                   
								}
							
								//  header("Refresh:5");
							}
?>							
<?php if($_SERVER['REQUEST_METHOD'] === 'GET') {?>


<!DOCTYPE html>
<html>
<head>
	<title>Prescription Record</title>
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
								$doc=$_SESSION['doctor'];
								// echo "<h1>".$doc."</h1>";
								$query="SELECT patient_id,patient_name,prescription FROM assigned_doctor NATURAL JOIN patient where doctor_id= '$doc' and appointment_status=2";
								$res= mysqli_query($connect,$query);

								echo "
									<table class='table  table-bordered'>
									<tr>
										<th>ID</th>
										<th>Name</th>
                                        <th>Prescription</th>
                                        <th style='width: 10%;'>Action</th>
									</tr>

								";
								if(mysqli_num_rows($res)<1){
									echo "<tr><td class='text-center'>No Patient </td></tr>";
								}
								while($row=mysqli_fetch_array($res)){
									$id=$row['patient_id'];
									$username=$row['patient_name'];
                                    $prescription=$row['prescription'];
									echo "
										<tr>
										<form method='POST'  action ='prescription.php' class='my-2' enctype='mulitpart/from-data'>
										<td> <input type='text' name='id' value=$id class='from-control' autocomplete='off' readonly> </td>
										<td>$username</td>
								

                                    <td>
                                    <div class='from-group'>
                                        <input type='textarea' name='prescription' value='$prescription' class='from-control' autocomplete='off'>       
                                    </div>
                                    </td>
                                    <td>
                                    <input type='submit' name='update' value='Update' class='btn btn-success' >
                                    </td>
                                </form>

									";
								}
								echo "
									</tr>
									
								</table>
								";
								
								// echo $output;
								?>
								
								
						</div>	
					</div>
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>
<?php } ?>