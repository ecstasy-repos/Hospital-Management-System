<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>BillRecord</title>
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
							<h5 class="text-center"> ALL Bill</h5>
							<?php
								$ad=$_SESSION['admin'];
								$query="SELECT * FROM bill";
								$res= mysqli_query($connect,$query);

								$output="
									<table class='table  table-bordered'>
									<tr>
										<th>Bill_id</th>
										
										<th>Medicine_cost</th>
										<th>Doctor_fee</th>
										
										<th>Total_cost</th>
										<th>Bill_date</th>
										<th style='width: 10%;'>Action</th>
									</tr>

								";
								if(mysqli_num_rows($res)<1){
									$output.="<tr><td class='text-center'>No Bill </td></tr>";
								}
								while($row=mysqli_fetch_array($res)){
									$id=$row['bill_id'];
						
									$medicine_c=$row['medicine_cost'];
									$doctor_fee=$row['doctor_fee'];
									
									$total_c=$row['total_cost'];
									$bill_date=$row['bill_date'];
									

									$output.="
										<tr>
										<td>$id</td>
										
										<td>$medicine_c</td>
										<td>$doctor_fee</td>
										
										<td>$total_c</td>
										<td>$bill_date</td>
										<td>
											<a href='bill.php?id=$id'><button id='$id' class='btn btn-danger'> Remove</button></a>
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
									$query="DELETE FROM bill WHERE bill_id = '$id'";
									mysqli_query($connect,$query);
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