<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Medicine Record</title>
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
							<h5 class="text-center"> ALL Medicine</h5>
							<?php
								$ad=$_SESSION['Pharmacy'];
								$query="SELECT * FROM medicine ";
								$res= mysqli_query($connect,$query);

								$output="
									<table class='table  table-bordered'>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Cost</th>
										<th>Quantity</th>
										<th style='width: 10%;'>Action</th>
									</tr>

								";
								if(mysqli_num_rows($res)<1){
									$output.="<tr><td class='text-center'>No Medicine </td></tr>";
								}
								while($row=mysqli_fetch_array($res)){
									$id=$row['medicine_id'];
									$name=$row['medicine_name'];
									$cost=$row['medicine_cost'];
									$quantity=$row['medicine_stock'];

									$output.="
										<tr>
										<td>$id</td>
										<td>$name</td>
										<td>$cost</td>
										<td>$quantity</td>
										<td>
											<a href='medcine.php?id=$id'><button id='$id' class='btn btn-danger'> Remove</button></a>
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
									echo $id;
									$query="DELETE FROM medicine WHERE medicine_id = '$id'";
									mysqli_query($connect,$query);
								}
							?> 	
								
						</div>	

						<!-- Doctor add part -->
						<!-- need to insert into doctors table too only employee table is used -->
						<div class="col-md-6">

							<?php
								if(isset($_POST['add_med'])){
									$name=$_POST['name'];
									$cost= $_POST['cost'];
									$quantity= $_POST['quantity'];
								

									// $image=$_FILES['img']['name'];

									$error=array();
									if(empty($name)){
										$error['u']="Enter Name";
									}
									else if(empty($cost)){
										$error['u']="Enter Cost";
									}
									else if(empty($quantity)){
										$error['u']="Enter quantity";
									}
									
									$q2 = "select * from medicine";
					                $result=mysqli_query($connect,$q2);
					                $rowcount=mysqli_num_rows($result);
									$next=$rowcount+1;	
							$id=$next;
							echo"$id";
									if(count($error)==0){
										$q="INSERT INTO medicine VALUES('$id' ,'$name','$cost','$quantity')";

										$result=mysqli_query($connect,$q);
										header("Location: medicine.php");


									}
								}

								
								if(isset($error['u'])){
									$er=$error=['u'];

									$show ="<h5 class='text-center alert-danger'>$er </h5>";
								}else{
									$show="";
								}

							?>
							<h5 class="text-center"> Add Medicine</h5>
							<form method="post"  class="my-2" enctype="mulitpart/from-data">
								
								<div>
									<?php echo $show;?>
								</div>
								<div class="from-group">
									<label>Medicine Name</label><br>
									<input type="text" name="name" class="from-control" autocomplete="off">
									
								</div>
								<div class="from-group">
									<label>Medicine cost</label><br>
									<input type="text" name="cost" class="from-control" >
									
								</div>
								<div class="from-group">
									<label>Medicine Quantity</label><br>
									<input type="text" name="quantity" class="from-control" >
									
								</div>
								
								
								<br>
						
								<input type="submit" name="add_med" value="Add New Medicine" class="btn btn-success" >
								
							</form>
							
						</div>	


						



					</div>
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>
