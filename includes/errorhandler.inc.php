<?php 

//Error Code
$EMPTY_FIELDS_ERROR_CODE = 106;
$INVALID_EMAIL_ERROR_CODE = 107;
$INVALID_USERNAME_ERROR_CODE = 108;
$PASSWORD_NOT_MATCHED_ERROR_CODE = 109;
$DUPLICATE_USERNAME_ERROR_CODE = 110;
$INCORRECT_PASSWORD_ERROR_CODE = 111;
$USER_NOT_FOUND_ERROR_CODE = 112;
$MYSQL_CONN_ERROR_CODE = 700;

//Error Message
$EMPTY_FIELDS_ERROR_MSG = "Fill in the Empty Fields";
$INVALID_EMAIL_ERROR_MSG = "Please provide a valid Email";
$INVALID_USERNAME_ERROR_MSG = "Please provide a valid Username";
$PASSWORD_NOT_MATCHED_ERROR_MSG = "Both of your passwords are not matching";
$DUPLICATE_USERNAME_ERROR_MSG = "Username already exists";
$INCORRECT_PASSWORD_ERROR_MSG = "Incorrect password";
$USER_NOT_FOUND_ERROR_MSG = "User not found, Create a new one";
$MYSQL_CONN_ERROR_MSG = "Mysql database connection error";


function errorHandler($errorCode) {
	switch ($errorCode) {
		case $EMPTY_FIELDS_ERROR_CODE:
			return "error=".$EMPTY_FIELDS_ERROR_MSG."errorcode=".$EMPTY_FIELDS_ERROR_CODE;
			break;
		case $INVALID_EMAIL_ERROR_CODE:
			return $INVALID_EMAIL_ERROR_MSG;
			break;
		case $INVALID_USERNAME_ERROR_CODE:
			return $INVALID_USERNAME_ERROR_MSG;
			break;
		case $PASSWORD_NOT_MATCHED_ERROR_CODE:
			return $PASSWORD_NOT_MATCHED_ERROR_MSG;
			break;
		case $DUPLICATE_USERNAME_ERROR_CODE:
			return $DUPLICATE_USERNAME_ERROR_MSG;
			break;
		case $INCORRECT_PASSWORD_ERROR_CODE:
			return $INCORRECT_PASSWORD_ERROR_MSG;
			break;
		case $USER_NOT_FOUND_ERROR_CODE:
			return $USER_NOT_FOUND_ERROR_MSG;
			break;
		case $MYSQL_CONN_ERROR_ERROR_CODE:
			return $MYSQL_CONN_ERROR_ERROR_MSG;
			break;
		default:
			return "404 Page Not Found";
			break;
	}
}

?>