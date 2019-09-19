<?php 
	session_start();
	$conn = mysqli_connect('localhost','Alisher','alisher_99','users');
 	if(!$conn){
	echo 'Connection error:'. mysqli_connect_errror();
	}
	else{
	$name = "";
	$surname = "";
	$email = "";
	$id = 0;
	$update = false;
	if (isset($_POST['save'])) {
		$name = $_POST['Name'];
		$surname = $_POST['SurName'];
		$email = $_POST['Email'];
		mysqli_query($conn, "INSERT INTO user (name, surname, email) VALUES ('$name', '$surname', '$email')"); 
		$_SESSION['message'] = "Information saved"; 
		header('location: index.php');
	}
	if (isset($_POST['update'])) {
	$id = $_POST['ID'];
	$name = $_POST['Name'];
	$surname = $_POST['SurName'];
	$email = $_POST['Email'];
	mysqli_query($conn, "UPDATE user SET Name='$name', Surname='$surname', Email='$email' WHERE ID=$id");
	$_SESSION['message'] = "Information updated!"; 
	header('location: index.php');
}
	if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($conn, "DELETE FROM user WHERE ID=$id");
	$_SESSION['message'] = "Information deleted!"; 
	header('location: index.php');
}
}
?>