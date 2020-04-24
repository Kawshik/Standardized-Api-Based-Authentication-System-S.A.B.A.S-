<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

	require '../includes/dbh.inc.php';
	require '../includes/login.inc.php';

	$data = json_decode(file_get_contents("php://input"));

	// Sample Input Data
	// {
	// 	"email" : "test@test.com",
	// 	"password" : "1234"
	// }

	$statuscode1 = validateData($data->email,$data->password,$conn);

	if($statuscode1==200){
		
		$statuscode2 = login($data->email,$data->password,$conn);

		if(!strcmp($statuscode2['statusCode'], "200")){
			//success message
			echo json_encode(array(
				'statusCode' => $statuscode2['statusCode'],
				'message' => $statuscode2['message'],
				'userId' => $statuscode2['userId'],
				'userName' => $statuscode2['userName']
			));
		} else {
			//error message
			echo json_encode(array(
				'statusCode' => $statuscode2['statusCode'],
				'message' => $statuscode2['message']
			));
		}
	} else {
		//error message
		echo json_encode(array(
				'statusCode' => $statuscode1['statusCode'],
				'message' => $statuscode1['message']
			));
	} 