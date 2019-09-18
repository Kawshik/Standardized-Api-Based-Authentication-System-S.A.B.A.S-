<?php 

if(isset($_POST['login-submit'])){

	require 'dbh.inc.php';
	require 'validator.inc.php';

	$mailuid = $_POST['mailuid'];
	$password = $_POST['pwd'];

	if(emptyFieldsCheck($mailuid,$password)!=1){
		header("Location: ../index.php?error=emptyfields".emptyFieldsCheck($mailuid,$password));
		exit();
	} else if (passwordCheck($mailuid,$password,$conn)!=1) {
		header("Location: ../index.php?error=wrongPwd".passwordCheck($mailuid,$password,$conn));
		exit();
	} else {
		login($conn,$mailuid,$password);
	}

} else {
	header("Location: ../index.php");
	exit();
}


function logIn($conn,$mailuid,$password)
{
	$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("Location: ../index.php?error=SQLError100");
		exit();
	} else {
		mysqli_stmt_bind_param($stmt,"ss",$mailuid,$mailuid);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result);
		session_start();
		$_SESSION['userId'] = $row['idUsers'];
		$_SESSION['userUid'] = $row['uidUsers'];	
		header("Location: ../index.php?login=success");
		exit();
	}
}