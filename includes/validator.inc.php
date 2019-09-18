<?php

require 'errorhandler.inc.php';

$statusCode = 1;

//try to use for loop by taking arguments as array
function emptyFieldCheck($username,$email,$password,$passwordRepeat){
	if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
		$statusCode = 10;
	} else {
		$statusCode = 1;
	}
	return $statusCode;
}

function emailCheck($email){
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$statusCode = 20;
	} else {
		$statusCode = 1;
	} 
	return $statusCode;
}

function usernameCheck($username){
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {		
		$statusCode = 30;
	} else {
		$statusCode = 1;
	}
	return $statusCode;
}

function passwordConfirmationCheck($password,$passwordRepeat){
	if ($password !== $passwordRepeat) {
		$statusCode = 40;
	} else {
		$statusCode = 1;
	}
	return $statusCode;
}

function duplicateUsernameCheck($username,$conn){
	$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		$statusCode = 100;
	} else {
		mysqli_stmt_bind_param($stmt,"s",$username);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$resultCheck = mysqli_stmt_num_rows($stmt);
		if($resultCheck>0){
			$statusCode = 101;
		}else{
			$statusCode = 1;
		}
		
	}
	return $statusCode;
}


//Login Validators
function emptyFieldsCheck($mailuid,$password){
	if(empty($mailuid) || empty($password)){
		$statusCode = 10;
	} else {
		$statusCode = 1;
	}
	return $statusCode;
}

function passwordCheck($mailuid,$password,$conn) {

	$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		$statusCode = 100;
	} else {
		mysqli_stmt_bind_param($stmt,"ss",$mailuid,$mailuid);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if ($row = mysqli_fetch_assoc($result)) {
			$pwdCheck = password_verify($password,$row['pwdUsers']);
				if($pwdCheck==false){
					$statusCode = 111;
			 	}  
				else {
					$statusCode = 1;
				}
			}else {
				$statusCode = 112;
			} 			
		}
		return $statusCode;
}
