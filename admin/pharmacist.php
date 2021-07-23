<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pharmacist Record</title>
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
							<h5 class="text-center"> ALL Pharmacsit</h5>
							<?php
								$ad=$_SESSION['admin'];
								$query="SELECT * FROM employee WHERE employee_id like 'P%'";
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
									$output.="<tr><td class='text-center'>No Pharmacist </td></tr>";
								}
								while($row=mysqli_fetch_array($res)){
									$id=$row['employee_id'];
									$username=$row['name'];

									$output.="
										<tr>
										<td>$id</td>
										<td>$username</td>
										<td>
											<a href='pharmacist.php?id=$id'><button id='$id' class='btn btn-danger'> Remove</button></a>
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
									$qry="DELETE FROM provides WHERE pharmacist_id = '$id'";
									$query="DELETE FROM pharmacy WHERE pharmacist_id = '$id'";
									$query1="DELETE FROM works WHERE employee_id = '$id'";
									$query2="DELETE FROM employee WHERE employee_id = '$id'";
									$query3="DELETE FROM login_details WHERE id = '$id'";
									mysqli_query($connect,$qry);
									mysqli_query($connect,$query);
									mysqli_query($connect,$query1);
									mysqli_query($connect,$query2);
									mysqli_query($connect,$query3);
										header("Location: pharmacist.php");
								}
							?> 	
								
						</div>	

						<!-- Doctor add part -->
						<!-- need to insert into doctors table too only employee table is used -->
						<div class="col-md-6">

							<?php
								if(isset($_POST['add'])){
									$uname=$_POST['uname'];
									$dob= $_POST['dob'];
									$email= $_POST['email'];
									$address= $_POST['address'];
									$salary= $_POST['salary'];
									$pass= $_POST['pass'];

									// $image=$_FILES['img']['name'];

									$error=array();
									if(empty($uname)){
										$error['u']="Enter Name";
									}else if(empty($pass)){
										$error['u']="Enter  Passoword";
									}
									else if(empty($email)){
										$error['u']="Enter Email";
									}
									else if(empty($dob)){
										$error['u']="Enter DOB";
									}
									else if(empty($salary)){
										$error['u']="Enter Salary";
									}
									else if(empty($address)){
										$error['u']="Enter Address";
									}
									$q2 = "select * from pharmacy";
					             //   $result=mysqli_query($connect,$q2);
					              //  $rowcount=mysqli_num_rows($result);
							//	$next=$rowcount+1;	
									$next=uniqid();
									$id='P'.$next;
									if(count($error)==0){
										$q="INSERT INTO employee VALUES('$id' ,0,'$uname','$dob','$email','$address','$salary')";
										$q1="INSERT INTO login_details VALUES('$id' ,'pharmacist','$pass')";
										$q2="INSERT INTO pharmacy  VALUES('$id' ,'$uname')";
										$result=mysqli_query($connect,$q);
										$result=mysqli_query($connect,$q1);
										$result=mysqli_query($connect,$q2);
										header("Location: pharmacist.php");

									}
								}

								
								if(isset($error['u'])){
									$er=$error=['u'];

									$show ="<h5 class='text-center alert-danger'>$er </h5>";
								}else{
									$show="";
								}

							?>
							<h5 class="text-center"> Add Pharmacy</h5>
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
									<label>Email</label><br>
									<input type="email" name="email" class="from-control" >
									
								</div>
								<div class="from-group">
									<label>Address</label><br>
									<input type="text" name="address" class="from-control" >
									
								</div>
								<div class="from-group">
									<label>Salary</label><br>
									<input type="number" name="salary" class="from-control" >
									
								</div>
								<div class="from-group">
									<label>Password</label><br>
									<input type="password" name="pass" class="from-control" >
									
								</div>
								<br>
						
								<input type="submit" name="add" value="Add New Pharmacist" class="btn btn-success" >
								
							</form>
							
						</div>	


						



					</div>
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>
