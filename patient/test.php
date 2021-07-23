<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Tests</title>
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
							<h5 class="text-center"> ALL Test</h5>
							<?php
								$ad=$_SESSION['patient'];
								$query="SELECT * FROM test NATURAL JOIN had_test WHERE patient_id = '$ad' ";
								$res= mysqli_query($connect,$query);

								$output="
									<table class='table  table-bordered'>
									<tr>
										<th>Test_id</th>
										<th>Test_name</th>
										<th>Test_cost</th>
									
									</tr>

								";
								if(mysqli_num_rows($res)<1){
									$output.="<tr><td class='text-center'>No Test </td></tr>";
								}
								while($row=mysqli_fetch_array($res)){
									$id=$row['test_id'];
									$test_n=$row['test_name'];
									$test_c=$row['test_cost'];
									
									

									$output.="
										<tr>
										<td>$id</td>
										<td>$test_n</td>
										<td>$test_c</td>
										
										
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