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
							<h5 class="text-center"> ALL Patient</h5>
							<?php
								$ad=$_SESSION['admin'];
								$query="SELECT * FROM patient";
								$res= mysqli_query($connect,$query);

								$output="
									<table class='table  table-bordered'>
									<tr>
										<th>ID</th>
										<th>Name</th>
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
										<td>$id</td>
										<td>$username</td>
										<td>
											<a href='patient.php?id=$id'><button id='$id' class='btn btn-danger'> Remove</button></a>
										</td>

									";
								}
								$output .="
									</tr>
									
								</table>
								";

								echo $output;


								if(isset($_GET['id'])){
									$id=$_GET['id'];
									// echo $id;
									$query="DELETE FROM pays WHERE patient_id = '$id'";
									$query1="DELETE FROM assigned_doctor WHERE patient_id = '$id'";
									$query2="DELETE FROM prescription WHERE patient_id = '$id'";
									$query3="DELETE FROM patient WHERE patient_id = '$id'";
									$query4="DELETE FROM login_details WHERE id = '$id'";
									$query5="DELETE FROM medicine_bill WHERE bill_id = '$id'";
									$query6="DELETE FROM bill WHERE bill_id = '$id'";
									
									mysqli_query($connect,($query));
									mysqli_query($connect,($query1));
									mysqli_query($connect,($query2));
									mysqli_query($connect,($query3));
									mysqli_query($connect,($query4));
									mysqli_query($connect,($query5));
									mysqli_query($connect,($query6));
									header("Location: patient.php");
								}
							?> 	
								
						</div>	

						<!-- Patient add part -->
						<!-- need to insert into doctors table too only employee table is used -->
						<div class="col-md-6">

							<?php
								if(isset($_POST['add'])){
									$uname=$_POST['uname'];
									$dobb= $_POST['dob'];
									$dob = date("Y-m-d", strtotime($dobb));
									$gender= $_POST['gender'];
									$phone= $_POST['phone'];
									$arrivall= $_POST['arrvial'];
									$newdate = date("Y-m-d", strtotime($arrivall));
									$diease= $_POST['disease'];
									$pass= $_POST['pass'];

									// $image=$_FILES['img']['name'];

									$error=array();
									if(empty($uname)){
										$error['u']="Enter Name";
									}else if(empty($pass)){
										$error['u']="Enter  Passoword";
									}
									
									$q2 = "select * from patient";
					                $result=mysqli_query($connect,$q2);
					                $rowcount=mysqli_num_rows($result);
									$next=$rowcount+1;	
									$id=$next;
									if(count($error)==0){
										$q="INSERT INTO patient VALUES('$id' ,dob,'$gender','$phone','$uname','$arrival','$disease')";
										$q1="INSERT INTO login_details VALUES('$id' ,'patient','$pass')";
										$result=mysqli_query($connect,$q);
										$result=mysqli_query($connect,$q1);
										header("Location: patient.php");

									}
								}

								
								if(isset($error['u'])){
									$er=$error=['u'];

									$show ="<h5 class='text-center alert-danger'>$er </h5>";
								}else{
									$show="";
								}

							?>
							<h5 class="text-center"> Add Patient</h5>
							<form method="post"  class="my-2" enctype="mulitpart/from-data">
								
								<div>
									<?php echo $show;?>
								</div>
								<div class="from-group">
									<label>Name</label><br>
									<input type="text" name="uname" class="from-control" autocomplete="off">
									
								</div>
								<div class="from-group">
									<label>DOB</label><br>
									<input type="date" name="dob" class="from-control" >
									
								</div>
								<div class="from-group">
									<label>Phone_no</label><br>
									<input type="number" name="phone" class="from-control" >
									
								</div>
								<div class="from-group">
									<label>Gender</label><br>
									<input type="text" name="gender" class="from-control" >
									
								</div>
								<div class="from-group">
									<label>Arrival_date</label><br>
									<input type="date" name="arrival" class="from-control" >
									
								</div>
								
								<div class="from-group">
									<label>Symptoms</label><br>
									<input type="text" name="disease" class="from-control" >
									
								</div>
								<div class="from-group">
									<label>Password</label><br>
									<input type="password" name="pass" class="from-control" >
									
								</div>
								<br>
						
								<input type="submit" name="add" value="Add New Patient" class="btn btn-success" >
								
							</form>
							
						</div>	


						



					</div>
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>
