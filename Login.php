

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up In | P&T Fast Food</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="CSS/Login.css" type="text/css" >
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	<script>
	
	function check()
	{
		if(document.getElementById('password').value == document.getElementById('cpassword').value)
		{
			document.getElementById('cpassword').style.color = '#77dd77';
		}
		else
		{
			document.getElementById('cpassword').style.color = 'red';
		}		
	}

</script>
	</head>
<body>
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<!--Login Page-->
			<form class="sign-in-htm" >
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" type="text" class="input" name="L_username" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password" name="L_password" required>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In" name="Loginbtn">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="Forgot Pass.php">Forgot Password?</a>
				</div>
			</form>
			<!--Register Page-->
			<form class="sign-up-htm" method="post" action="">
				<div class="group">
					<label for="nick" class="label" >Nickname</label>
					<input id="nick" type="text" class="input" name="R_nickname" required>
				</div>
				<div class="group">
					<label for="user" class="label" >Username</label>
					<input id="user" type="text" class="input" name="R_username" required>
				</div>
				<div class="group">
					<label for="pass" class="label" >Password</label>
					<input id="password" type="password" class="input" data-type="password" name="R_password" required>
				</div>
				<div class="group" data-validate = "Repeat Password is required">
					<label for="cpass" class="label">Repeat Password</label>
					<input id="cpassword" type="password" class="input" data-type="password" onchange="check();" name="R_Cpassword" required>
				</div>
				<div class="group">
					<label for="email" class="label" >Email Address</label>
					<input id="email" type="text" class="input" name="R_email" required>
				</div>
                <div class="group">
					<label for="phone" class="label" >Phone Number</label>
					<input id="phone" type="text" class="input" name="R_phoneNum" required>
				</div>
				<div class="group">
					<input type="submit" class="button" name="Signupbtn" value="Sign Up">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1">Already Registered?</a>
			</form>
			</div>
		</div>
	</div>



<?php
//Sign In Identify

include('database.php'); 

if(isset($_GET["Loginbtn"]))
{
	$name = $_GET["L_username"];
	$password = $_GET["L_password"];

	if($name && $password)
	{
		//Check User
		$resultU = mysqli_query($connect,"select * from customer where cusName = '$name' and cusPass = '$password'");
		$rowU = mysqli_fetch_array($resultU,MYSQLI_ASSOC);

		//Check Admin
		$resultA = mysqli_query($connect,"select * from addAdmin where adminName = '$name' and adminPassword = '$password'");
		$rowA = mysqli_fetch_array($resultA,MYSQLI_ASSOC);


		if(mysqli_num_rows($resultU) == 1)
		{
			header("refresh:0.5; url=Index.php");
			exit;
		}

		else if(mysqli_num_rows($resultA) == 1)
		{
			header("refresh:0.5; url=Forgot Pass.php");
			exit;
		}
		else
		{
			?><script>alert("Invalid Username or Password");</script><?php
			echo("Invalid");
		}	

	}
}

//Sign Up detail send to database
if(isset($_POST["Signupbtn"]))
{
	$nickname = $_POST['R_nickname'];
	$username = $_POST['R_username'];
	$password = $_POST['R_password'];
	$cpassword = $_POST['R_Cpassword'];
	$email = $_POST['R_email'];
	$phone = $_POST['R_phoneNum'];
	$uppercase = preg_match('@[A-Z]@',$password);
	$lowercase = preg_match('@[a-z]@',$password);
	$number    = preg_match('@[0-9]@',$password);

	if($password==$cpassword)
	{
		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8)
		{
			?><script>alert("Password must containing at least 1 uppercase,lowercase,number and length of 8 character!");</script><?php
		}
		else
		{
			mysqli_query($connect,"INSERT INTO customer (cusName,cusNickName,cusPass,cusEmail,cusPhone)
			VALUES('$username','$nickname','$password','$email','$phone')");
			echo "Your registration is completed..";
		}
		
	}

	else
	{
		?><script>alert("Password not matching!");</script><?php
	}
	mysqli_close($connect);
}
?>


</body>

</html>