<?php 
require 'validator.inc.php';

function validateData($username,$email,$password,$passwordRepeat,$conn){
	if(emptyFieldCheck($username,$email,$password,$passwordRepeat)!==1){
		return array(
			'statusCode' => emptyFieldCheck($username,$email,$password,$passwordRepeat),
			'message' => 'Fill in the Empty Fields'
			);
	}

	else if (emailCheck($email)!=1) {
		return array(
			'statusCode' => emailCheck($email),
			'message' => 'Please provide a valid Email'
			);
	}

	else if(usernameCheck($username)!=1){
		return array(
			'statusCode' => usernameCheck($username),
			'message' => 'Please provide a valid Username'
			);
	} 
	
	else if (passwordConfirmationCheck($password,$passwordRepeat)!=1) {
		return array(
			'statusCode' => passwordConfirmationCheck($password,$passwordRepeat),
			'message' => 'Both of your passwords are not matching'
			);	
	}

	else if (duplicateUsernameCheck($username,$conn)!==1) {
		return array(
			'statusCode' => duplicateUsernameCheck($username,$conn),
			'message' => 'Username already exists'
			);
	} 

	else {
		return success();	
	}
}

function signup($username,$email,$password,$conn)
{
	$sql = "INSERT INTO users (uidUsers,emailUsers,pwdUsers) VALUES (?,?,?)";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		return array(
			'statusCode' => '700',
			'message' => 'Mysql database connection error'
			);
	} else {
		// hash password					
		$hashedPwd = password_hash($password,PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hashedPwd);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
		return array(
			'statusCode' => success(),
			'message' => 'Sign up Successfull'
			);
	}
}