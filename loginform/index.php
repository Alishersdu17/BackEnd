<?php 
session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div>
	<form action="login.php" method="post">
		<input type="name" name="Email" placeholder="Email">
		<input type="password" name="password" placeholder="password">
		<button type="submit" name="loginbtn">Login</button>
	</form>
	<?php 
	if(isset($_SESSION['userid'])){
		echo "login success!";
	} else{
		echo "you  logged out!";}
	if(isset($_POST['logoutbtn'])){
		session_unset();
		session_destroy();
	}
	?>
	<a href="signup.php"> Are you new user?</a>
	<form  method="post">
		<button type="submit" name="logoutbtn">Logout</button>
	</form>
</div>
</body>
</html>