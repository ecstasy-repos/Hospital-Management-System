<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Profile</title>
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
								$ad=$_SESSION['admin'];
								// $doc=$_SESSION['admin'];
								$query="SELECT  name,email,address,dob FROM employee  where employee_id='$ad'";
								$res= mysqli_query($connect,$query);
								if(mysqli_num_rows($res)<1){
									$output.="<tr><td class='text-center'>No Admin </td></tr>";
								}
								while($row=mysqli_fetch_array($res)){
									$id=$row['employee_id'];
									$username=$row['name'];
                                    $email=$row['email'];
                                    $add=$row['address'];
                                    $dob=$row['dob'];
									$output.="
                                    <form method='post'  class='my-2' enctype='mulitpart/from-data'>
								
                                    <div>
                                        <?php echo $show;?>
                                    </div>
                                    <div class='from-group'>
                                        <label>Name</label><br>
                                        <input type='text' name='uname' value=$username class='from-control' autocomplete='off'>
                                        
                                    </div>
                                    <div class='from-group'>
                                        <label>DOB</label><br>
                                        <input type='date' name='dob' value=$dob class='from-control' >
                                        
                                    </div>
                                    <div class='from-group'>
                                        <label>Email</label><br>
                                        <input type='email' name='email' class='from-control' value=$email >
                                        
                                    </div>
                                    <div class='from-group'>
                                        <label>Address</label><br>
                                        <input type='text' name='address' class='from-control' value='$add' >
                                        
                                    </div>
                                   
                                   
                                    <br>
                            
                                    <input type='submit' name='update' value='Update' class='btn btn-success' >
                                    
                                </form>
									";
								}
                                ob_start();
                                echo $output;
                                if(isset($_POST['update']))
                                {
									// $names=$_POST['names'];
                                    // $doc=$_SESSION['admin'];
									// echo $id;
                                    if(isset($_POST['uname'])){
                                        $uname=$_POST['uname'];
                                        $doc=$_SESSION['admin'];
                                        $col1="''{$uname}''";
                                        $col2="''{$ad}''";
                                        // echo $id;
                                        // $query="UPDATE employee set employee.name='$uname' where employee_id='$doc' ";
                                        $query="CALL TableUpdate('employee','name','$col1','employee_id','$col2')";
                                        mysqli_query($connect,$query);
                                    }
                                    if(isset($_POST['dob'])){
                                        $dob=$_POST['dob'];
                                        $doc=$_SESSION['admin'];
                                        $ndob = date("Y-m-d", strtotime($dob));
                                        $col1="''{$ndob}''";
                                        $col2="''{$ad}''";
                                        // echo $id;
                                        // $query="UPDATE employee set dob='$ndob' where employee_id='$doc' ";
                                        $query="CALL TableUpdate('employee','dob','$col1','employee_id','$col2')";
                                        mysqli_query($connect,$query);
                                    }
                                    if(isset($_POST['email'])){
                                        $email=$_POST['email'];
                                        $doc=$_SESSION['admin'];
                                        $col1="''{$email}''";
                                        $col2="''{$ad}''";
                                        // echo $id;
                                        // $query="UPDATE employee set email='$email' where employee_id='$doc' ";
                                        $query="CALL TableUpdate('employee','email','$col1','employee_id','$col2')";
                                        mysqli_query($connect,$query);
                                    }
                                    if(isset($_POST['address'])){
                                        $adds=$_POST['address'];
                                        $doc=$_SESSION['admin'];
                                        $col1="''{$adds}''";
                                        $col2="''{$ad}''";
                                        // echo $id;
                                        // $query="UPDATE employee set employee.address='$adds' where employee_id='$doc' ";
                                        $query="CALL TableUpdate('employee','address','$col1','employee_id','$col2')";
                                        mysqli_query($connect,$query);
                                    }
                                  
                                    if(isset($_POST['pass'])){
                                        $pass=$_POST['pass'];
                                        $doc=$_SESSION['admin'];
                                        $col1="''{$pass}''";
                                        $col2="''{$ad}''";
                                        // $ndob = date("Y-m-d", strtotime($dob));
                                        // echo $id;
                                        // $query="UPDATE login_details set login_details.password='$pass' where id='$doc' ";
                                        $query="CALL TableUpdate('login_details','password','$col1','id','$col2')";
                                        mysqli_query($connect,$query);
                                    }
                                    header("Refresh:0");
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