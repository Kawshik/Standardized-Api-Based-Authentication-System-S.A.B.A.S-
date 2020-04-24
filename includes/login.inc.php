<?php 
require 'validator.inc.php';

function validateData($mailuid,$password,$conn){
	if(emptyFieldsCheck($mailuid,$password)!=1){
		return array(
			'statusCode' => emptyFieldsCheck($mailuid,$password),
			'message' => 'Fill in the Empty Fields'
			);
	} else if (passwordCheck($mailuid,$password,$conn)!=1) {
		if(passwordCheck($mailuid,$password,$conn)==111){
			return array(
				'statusCode' => passwordCheck($mailuid,$password,$conn),
				'message' => 'Incorrect password'
				);
		}

		if(passwordCheck($mailuid,$password,$conn)==112){
			return array(
				'statusCode' => passwordCheck($mailuid,$password,$conn),
				'message' => 'User not found, Create a new one'
				);
		}

	} else {
		return success();
	}
}

function logIn($mailuid,$password,$conn)
{
	$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)) {
		return array(
			'statusCode' => '700',
			'message' => 'Mysql database connection error'
			);

	} else {
		mysqli_stmt_bind_param($stmt,"ss",$mailuid,$mailuid);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($result);
		$arr = array(
			'statusCode' => '200',
			'message' => 'success',
			'userId' => $row['idUsers'],
			'userName' => $row['uidUsers']
			);	

		return $arr;
	}
}