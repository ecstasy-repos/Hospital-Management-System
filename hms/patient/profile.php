<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
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
							<h5 class="text-center"> Profile </h5>
							<?php
								if(isset($_POST['update']))
                                {
									// $names=$_POST['names'];
                                    // $doc=$_SESSION['doctor'];
									// echo $id;
                                    if(isset($_POST['uname'])){
                                        $uname=$_POST['uname'];
                                        $patient=$_SESSION['patient'];
                                        $col1="''{$uname}''";
                                        $col2="''{$patient}''";
                                        // echo $id;
                                        // $query="UPDATE employee set employee.name='$uname' where employee_id='$doc' ";
                                        $query="CALL TableUpdate('patient','patient_name','$col1','patient_id','$col2')";
                                        mysqli_query($connect,$query);
                                    }
                                    if(isset($_POST['dob'])){
                                        $dob=$_POST['dob'];
                                        $patient=$_SESSION['patient'];
                                        $ndob = date("Y-m-d", strtotime($dob));
                                        $col1="''{$ndob}''";
                                        $col2="''{$patient}''";
                                        // echo $id;
                                        // $query="UPDATE employee set dob='$ndob' where employee_id='$doc' ";
                                        $query="CALL TableUpdate('patient','dob','$col1','patient_id','$col2')";
                                        mysqli_query($connect,$query);
                                    }
                                    if(isset($_POST['gender'])){
                                        $gender=$_POST['gender'];
                                        $patient=$_SESSION['patient'];
                                        $col1="''{$gender}''";
                                        $col2="''{$patient}''";
                                        // echo $id;
                                        // $query="UPDATE employee set email='$email' where employee_id='$doc' ";
                                        $query="CALL TableUpdate('patient','gender','$col1','patient_id','$col2')";
                                        mysqli_query($connect,$query);
                                    }
                                    if(isset($_POST['phone'])){
                                        $phone=$_POST['phone'];
                                        $patient=$_SESSION['patient'];
                                        $col1="''{$phone}''";
                                        $col2="''{$patient}''";
                                        // echo $id;
                                        // $query="UPDATE employee set employee.address='$adds' where employee_id='$doc' ";
                                        $query="CALL TableUpdate('patient','phone_no','$col1','patient_id','$col2')";
                                        mysqli_query($connect,$query);
                                    }
                                    
                                    header("Refresh:0");
								}
								$patient=$_SESSION['patient'];
								$query="SELECT * FROM patient WHERE patient_id = $patient";
								$res= mysqli_query($connect,$query);
								if(mysqli_num_rows($res)<1){
									$output.="<tr><td class='text-center'>No Profile</td></tr>";
								}
								while($row=mysqli_fetch_array($res)){
									$id=$row['patient_id'];
									$name=$row['patient_name'];
                                    $gender=$row['gender'];
                                    $dob=$row['dob'];
                                    $phone=$row['phone_no'];
									?>
                                    <form method="post" action="profile.php" >
						
                        <!-- 			<div class="alert alert-danger">
                                        <?php
                                            // if(isset($error['admin'])){
                                                // $sh=$error['admin'];
                                                // $show="<h4 class=alert alert-danger'>$sh</h4>";
                                            // }else{
                                        // 		$show="";
                                            // }
                                            // echo $show; 
                                        ?>
                                    </div> -->
            
                                    <div class="form-group">
                                                <label> Name</label>
                                                <?php echo"
                                                <input type=\"text\" name=\"uname\" class=\"form-control\" autocomplete=\"off\" value=\"$name\" required>"
                                                ?>
                                    </div>
                                    
                                    <div class="form-group">
                                            <label>Phone No</label>
                                            <?php echo "
                                            <input type=\"number\" name=\"phone\" class=\"form-control\" autocomplete=\"off\" value=\"$phone\" required>"
                                            ?>
                                    </div>
                                    <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control" required>
                                                <option value=""> Select Your Gender</option>
                                                <?php if($gender ==="MALE"){ ?>
                                                <option selected value="MALE"> MALE</option>
                                                <option value="FEMALE"> FEMALE</option>
                                                <?php } else if($gender === "FEMALE") { ?>
                                                <option value="MALE"> MALE</option>
                                                <option selected value="FEMALE"> FEMALE</option>
                                                <?php }?>
                                                
                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <label>DOB</label>
                                            <?php echo "<input type=\"date\" name=\"dob\" class=\"form-control\" autocomplete=\"off \" value=\"$dob\" required>"; ?>
                                    </div>
            
                                    
            
            
                                    <input type="submit" name="update"  value="Update Account" class="btn btn-info ">
                                    
                                    
                                </form>
								<?php }
                                ob_start();
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