<?php 

if(isset($_POST['signup-submit'])){
	require 'dbh.inc.php';
	require 'validator.inc.php';

// get data of the form
	$username = $_POST['uid'];
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];

// Validate the data
	if(emptyFieldCheck($username,$email,$password,$passwordRepeat)!==1){
		header("Location: ../signup.php?error=empty".emptyFieldCheck($username,$email,$password,$passwordRepeat));
		exit();
	}

	else if (emailCheck($email)!=1) {
		header("Location: ../signup.php?error=email".emailCheck($email));
		exit();
	}

	else if(usernameCheck($username)!=1){
		header("Location: ../signup.php?error=usermaneError".usernameCheck($username));
		exit();
	} 
	
	else if (passwordConfirmationCheck($password,$passwordRepeat)!=1) {
		header("Location: ../signup.php?error=PasswordError".passwordConfirmationCheck($password,$passwordRepeat));
		exit();	
	}

	else if (duplicateUsernameCheck($username,$conn)!==1) {
		header("Location: ../signup.php?error=duplicate".duplicateUsernameCheck($username,$conn));
		exit();	
	} 

	else {
		insertData($username,$email,$password,$conn);	
	}


	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	
} else {
	header("Location: ../signup.php");
	exit();
}

function insertData($username,$email,$password,$conn)
{
	$sql = "INSERT INTO users (uidUsers,emailUsers,pwdUsers) VALUES (?,?,?)";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("Location: ../signup.php?error=SQLError");
		exit();
	} else {
		// hash password					
		$hashedPwd = password_hash($password,PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hashedPwd);
		mysqli_stmt_execute($stmt);
		header("Location: ../signup.php?signup=Success");
		exit();
	}
}