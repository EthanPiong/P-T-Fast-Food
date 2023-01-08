

<!DOCTYPE html>
<?php require_once("database.php");?>
<html lang="en">
<head>
	<title>Sign Up In | P&T Fast Food</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="CSS/Login.css" type="text/css" >
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<!--Login Page-->
			<form class="sign-in-htm" method="post" action="">
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
					<label for="nick" class="label" >Fullname</label>
					<input id="nick" type="text" class="input" name="R_fullname" required>
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
					<input id="cpassword" type="password" class="input" data-type="password" onchange="checkPass();" name="R_Cpassword" required>
				</div>
				<div class="group">
					<label for="email" class="label" >Email Address</label>
					<input id="email" type="email" pattern=".+@gmail\.com" size="30" class="input" name="R_email" required>
				</div>
                <div class="group">
					<label for="phone" class="label" >Phone Number</label>
					<input type="tel" id="phone" pattern="[0]{1}[1]{1}[0-9]{1}[0-9]{3}[0-9]{4}" class="input" name="R_phoneNum" required>
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


<script>
	var phone_input = document.getElementById("phone");
	

phone_input.addEventListener('input', () => {
  phone_input.setCustomValidity('');
  phone_input.checkValidity();
});

phone_input.addEventListener('invalid', () => {
  if(phone_input.value === '') {
    phone_input.setCustomValidity('Enter phone number!');
  } else {
    phone_input.setCustomValidity('Enter phone number in this format: 011 1111111');
  }
});

function checkPass()
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

<?php
//Sign In Identify
session_start();
 
if(isset($_POST["Loginbtn"]))
{
	$username = $_POST["L_username"];
	$password = $_POST["L_password"];

	if($username && $password)
	{
		//Check User
		$resultU = mysqli_query($connect,"select * from customer where cusName = '$username' and cusPass = '$password'");
		$rowU = mysqli_fetch_array($resultU,MYSQLI_ASSOC);
		

		//Check Admin
		$resultA = mysqli_query($connect,"select * from addAdmin where adminName = '$username' and adminPassword = '$password'");
		$rowA = mysqli_fetch_array($resultA,MYSQLI_ASSOC);
		

		if(mysqli_num_rows($resultU) == 1)
		{
			$_SESSION['id']=$username;
			echo "<script>alert('You're successfully login!')</script>";
			echo "<script>window.open('Customer/product.php','_self')</script>";
			exit;
		}

		else if(mysqli_num_rows($resultA) == 1)
		{
			$_SESSION["id"]=$username;
			echo "<script>alert('You're successfully login!')</script>";
			header("refresh:0.5; url=Admin/admin dashboard.php");
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
	$fullname = $_POST['R_fullname'];
	$username = $_POST['R_username'];
	$password = $_POST['R_password'];
	$cpassword = $_POST['R_Cpassword'];
	$email = $_POST['R_email'];
	$phone = $_POST['R_phoneNum'];
	$uppercase = preg_match('@[A-Z]@',$password);
	$lowercase = preg_match('@[a-z]@',$password);
	$number    = preg_match('@[0-9]@',$password);

	 extract($_POST);
	 	if(strlen($fullname)<3){ // Minimum 
		 	?><script>alert('Please enter fullname using 3 charaters at least.');</script><?php
		}
   		if(strlen($fullname)>30){  // Max 
		 	?><script>alert('FullName: Max length 30 Characters Not allowed');</script><?php
		}
   		if(!preg_match("/^[A-Za-z _]*[A-Za-z ]+[A-Za-z _]*$/", $fullname)){
			?><script>alert('Invalid Entry First Name. Please Enter letters without any Digit or special symbols like ( 1,2,3#,$,%,&,*,!,~,`,^,-,)');</script><?php
		}      
		if(strlen($username)<3){ // Change Minimum Lenghth   
			?><script>alert('Please enter username using 3 charaters at least.');</script><?php
		}
	 	if(strlen($username)>20){ // Change Max Length 
			?><script>alert('Username : Max length 20 Characters Not allowed');</script><?php
		}
	 	if(!preg_match("/^^[^0-9][A-Za-z0-9]+([_-]?[A-Za-z0-9])*$/", $username)){
			?><script>alert('Invalid Entry for Username. Enter letters without any space and No number at the start- Eg - myusername, okuniqueuser or myusername123');</script><?php
		}  
   		if(strlen($email)>50){  // Max 
			?><script>alert('Email: Max length 50 Characters Not allowed');</script><?php
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			?><script>alert('Invalid Entry for Email. Exp:myusername@gmail.com');</script><?php
		}
	  	if($cpassword ==''){
			?><script>alert('Please confirm the password.');</script><?php
		}
		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8){
			?><script>alert("Password must containing at least 1 uppercase,lowercase,number and length of 8 character!");</script><?php
		}
			
		
		$sql="select * from customer where (cusName='$username' or cusEmail='$email');";
		$res=mysqli_query($connect,$sql);
	  	if (mysqli_num_rows($res) > 0) {
   			$row = mysqli_fetch_assoc($res);
   
			if($username==$row['cusName']){
				?><script>alert('Username alredy Exists.');</script><?php
			} 
		  	if($email==$row['cusEmail']){
			   	?><script>alert('Email alredy Exists.');</script><?php
			} 
		}

   
		else{
			// $options = array("cost"=>4);
			// $password = password_hash($password,PASSWORD_BCRYPT,$options);
					
			mysqli_query($connect,"INSERT INTO customer (cusName,cusFullName,cusPass,cusEmail,cusPhone)
			VALUES('$username','$fullname','$password','$email','$phone')");
			?><script>alert('Registered Successfull ~ ');</script><?php
		}	
			   
	mysqli_close($connect);
}
?>


</body>

</html>