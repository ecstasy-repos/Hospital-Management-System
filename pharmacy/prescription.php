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
							<h5 class="text-center"> ALL Prescription</h5>
							<?php
								$ad=$_SESSION['Pharmacy'];
								$query="SELECT * FROM prescription ";
								$res= mysqli_query($connect,$query);

								$output="
									<table class='table  table-bordered'>
									<tr>
										<th>Patient_ID</th>
										<th>Prescription</th>
									</tr>

								";
								if(mysqli_num_rows($res)<1){
									$output.="<tr><td class='text-center'>No Patient </td></tr>";
								}
								while($row=mysqli_fetch_array($res)){
									$id=$row['patient_id'];
									$presc=$row['presc'];
									

									$output.="
										<tr>
										<td>$id</td>
										<td>$presc</td>
									
										

									";
								}
								$output .="
									</tr>
									
								</table>
								";

								echo $output;


								
							?> 	

						</div>


						<div class="col-md-6">

							<?php
								if(isset($_POST['sell'])){
									$pid=$_POST['pid'];
									$mid= $_POST['mid'];

							

									$error=array();
									if(empty($pid)){
										$error['u']="Enter patient_id";
									}else if(empty($mid)){
										$error['u']="Enter  medicine_id";
									}
									
									if(count($error)==0){
										$qm="SELECT * from medicine where medicine_id=$mid";
										// $med=10;
										$res=mysqli_query($connect,$qm);
										// echo"$pid";
										while($row=mysqli_fetch_array($res)){
											$med=$row['medicine_cost'];
											// echo"$med";
											mysqli_query($connect,"SET AUTOCOMMIT=0");
											mysqli_query($connect,"START TRANSACTION");
											$q2="UPDATE medicine  set medicine_stock=medicine_stock-1 where  medicine_id=$mid";
											echo"$med, $pid";
											$q="UPDATE bill  set medicine_cost=medicine_cost+'$med' ,bill_date = NOW() where bill_id='$pid'";
											echo "$q";							

											// echo "$q2";
											$a1=mysqli_query($connect,$q);
											$a2=mysqli_query($connect,$q2);
											echo "$a1";
											if($a1 and $a2)
											{
												mysqli_query($connect,"COMMIT");	
											}
											else
											{
												mysqli_query($connect,"ROLLBACK");	
											}
											mysqli_query($connect,"SET AUTOCOMMIT=1");
										}
										// echo "$qm";
										
										// echo"$q";
										// echo "$qm";
										
										
									}
								}

								
								if(isset($error['u'])){
									$er=$error=['u'];

									$show ="<h5 class='text-center alert-danger'>$er </h5>";
								}else{
									$show="";
								}

							?>
							<h5 class="text-center"> Give Medicine</h5>
							<form method="post"  class="my-2" enctype="mulitpart/from-data">
								
								<div>
									<?php echo $show;?>
								</div>
								<div class="from-group">
									<label>Patient_ID</label><br>
									<input type="text" name="pid" class="from-control" autocomplete="off">
									
								</div>
								
								
								
								<div class="from-group">
									<label>Medicine_ID</label><br>
									<input type="number" name="mid" class="from-control" >
									
								</div>
								
								<br>
						
								<input type="submit" name="sell" value="Sell" class="btn btn-success" >
								
							</form>
							
						</div>	
				</div>
			</div>
			
		</div>
	</div>
</body>
</html>