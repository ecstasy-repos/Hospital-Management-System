
<?php

	include("./include/connection.php");

	if(isset($_POST['create'])){
		// echo"hello motto";
		$name = $_POST['uname'];
		$gender = $_POST['gender'];
		// $disease = $_POST['disease'];
		$dob= $_POST['dob'];
		$phone = $_POST['phone'];
		$password = $_POST['pass'];
		$con_pass = $_POST['con_pass'];

		$error=array();
		$ndob = date("Y-m-d", strtotime($dob));
		if(empty($name)){
			$error['ac']="Enter Password";
		}else if($con_pass != $password){
			$error['ac']="Both password do not match";
		}
		$q2 = "select max(patient_id) as mx from patient";
        	$result=mysqli_query($connect,$q2);
        	$rowcount=mysqli_num_rows($result);
	//	$row=$mysqli_fetch_array($result);	
//		$id =uniqid();
	
		while($row=mysqli_fetch_array($result)){
		
                
			$id=$row['mx'] +1;
		
		}

		// echo $next;
		if(count($error)==0){
			$query= "CALL TableInsert('patient','patient_id,dob,gender,phone_no,patient_name',' \"{$id}\",\"{$ndob}\",\"{$gender}\",\"{$phone}\",\"{$name}\" ');";
    		$query .= "CALL TableInsert('login_details','id,designation,password',' \"{$id}\",\"patient\",\"{$password}\" ');";
    		$query .= "CALL TableInsert('bill','bill_id,medicine_cost,doctor_fee,bill_date,total_cost',' \"{$id}\",\"0\",\"0\",NOW(),\"0\" ')";
    		// echo "user_id $id ";
    		$res=$connect->multi_query($query);
    		// $connect->close();

    		
			// -- $query="INSERT INTO patient VALUES($id,'$ndob','$gender','$phone','$name')";
			// $res=mysqli_query($connect,$query);

			if($res){

				echo "<script> alert('Your ID is $id')</script>";
				// header("Location: account.php");
			}else{
				echo $query;
				echo "<script>alert('failed')</script>";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Account</title>
</head>
<body style="background-image: url(image/hospital2.jpeg);background-repeat; background-size: cover;">
	<?php
		include("include/header.php");
	?>

	<div class="container-fluid">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6  my-2 jumpbotron">
					<h5 class="text-center text-info my-2">Create Account</h5>
					<!-- <img src="image/admin.jpeg" class="colr-md-12"> -->
					<form method="post" >
						
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
									<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter name">
						</div>
						
						<div class="form-group">
								<label>Phone No</label>
								<input type="number" name="phone" class="form-control" autocomplete="off" placeholder="Enter Phone Number">
						</div>
						<div class="form-group">
								<label>Gender</label>
								<select name="gender" class="form-control" >
									<option value=""> Select Your Gender</option>
									<option value="Male"> Male</option>
									<option value="Female"> Female</option>
									
								</select>
						</div>
						<div class="form-group">
								<label>DOB</label>
								<input type="date" name="pass" class="form-control" autocomplete="off" placeholder="DOB">
						</div>

						

						<div class="form-group">
								<label>Password</label>
								<input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
						</div>
						<div class="form-group">
								<label> Confirm Password</label>
								<input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Enter Confirm Password">
						</div>

						<input type="submit" name="create"  value="Create Account" class="btn btn-info ">
						<p> I already have an account <a href="patientlogin.php">Click here.</a></p>
						
					</form>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
	</div>

</body>
</html>
