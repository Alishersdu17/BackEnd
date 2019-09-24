<?php  
$conn = mysqli_connect('localhost','Alisher','alisher_99','users');
 	if(!$conn){
	echo 'Connection error:'. mysqli_connect_errror();
	}