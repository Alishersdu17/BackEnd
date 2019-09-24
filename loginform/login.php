<?php 
if(isset($_POST['loginbtn'])){
	require'db_conn.php';
	$mail = $_POST['Email'];
	$password = $_POST['password'];
	if (empty($mail)||empty($password)) {
		header("Location:index.php?error=emptyFields");
		exit();
	}
	else{
		$sql = "SELECT * FROM loginform WHERE Email= ?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location:index.php?error=sqlerror");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"s",$mail);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result)){
				$passwordCheck = password_verify($password,$row['Password']);
				if($passwordCheck == false){
					header("Location:index.php?error=wrongpassword");
					exit();
				}
				elseif($passwordCheck == true){
					session_start();
					$_SESSION['userid'] = $row['ID'];
					$_SESSION['useruid'] = $row['Username'];
					header("Location:index.php?login=success");
					exit();


				}
			}
			else{
				header("Location:index.php?error=nouser");
				exit();

			}

		}

	}

}
else{
	header("Location:index.php");
    exit();
}