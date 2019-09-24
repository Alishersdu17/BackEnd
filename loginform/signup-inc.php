<?php 
if(isset($_POST['SignUp'])){
	require'db_conn.php';
	$UserName = $_POST['Username'];
    $UserEmail = $_POST['mail'];
    $UserPassword = $_POST['password'];
    $UserRepeatedPssword = $_POST['password-repeat'];
    if (empty($UserName) || empty($UserEmail) || empty($UserPassword) || empty($UserRepeatedPssword)) {
    	header("Location:signup.php?error=emptyFields&Username=".$UserName."&mail=".$UserEmail);
    	exit();
    	# code...
    }
    elseif (!filter_var($UserEmail,FILTER_VALIDATE_EMAIL)&& !preg_match("/^[a-zA-Z0-9]*$/",$UserName)) {
    	header("Location:signup.php?error=invalidmailuid");
    	exit();
    }
    elseif (!filter_var($UserEmail,FILTER_VALIDATE_EMAIL)) {
    	header("Location:signup.php?error=invalidmail&Username=".$UserName);
    	exit();
    	# code...
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/",$UserName)) {
    	header("Location:signup.php?error=invaliduid&mail=".$UserEmail);
    	exit();
    	# code...
    }
    elseif ($UserPassword !== $UserRepeatedPssword) {
    	header("Location:signup.php?error=passwordcheck&mail=".$UserEmail."&Username=".$UserName);
    	exit();
}
else{
	$sql = "SELECT Username FROM loginform WHERE Username=?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("Location:signup.php?error=sqlerror");
    	exit();
    }
    else{
    	mysqli_stmt_bind_param($stmt,"s",$UserName);
    	mysqli_stmt_execute($stmt);	
    	mysqli_stmt_store_result($stmt);
    	$resultCheck = mysqli_stmt_num_rows($stmt);
    	if($resultCheck>0){
    		header("Location:signup.php?error=usertaken&mail=".$UserEmail);
    		exit();
    	}
    	else{
    		$sql = "INSERT INTO loginform (Username,Email,Password) VALUES(?,?,?)";
    		$stmt = mysqli_stmt_init($conn); 
    		if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("Location:signup.php?error=sqlerror");
    			exit();
    		}
    		else{
    			$hashedPassword = password_hash($UserPassword, PASSWORD_DEFAULT);
    			mysqli_stmt_bind_param($stmt,"sss",$UserName,$UserEmail,$hashedPassword);
    			mysqli_stmt_execute($stmt);
    			header("Location:signup.php?signup=success");
    			include'index.php';
    			exit();
    	}	

    		}
    	}
    }


mysqli_stmt_close($stmt);
mysql_close();
} 
else{
	header("Location:index.php");
    exit();

}