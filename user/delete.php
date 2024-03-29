
<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../utils/dbconnect.php';
include_once '../object/User.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare User object
$user = new User($db);

// get User id
$data = json_decode(file_get_contents("php://input"));

// set User id to be deleted
$user->id = $data->id;

// delete the USer
if($user->delete()){
	
	// set response code - 200 ok
	http_response_code(200);
	
	// tell the user
	echo json_encode(array("message" => "User was deleted."));
}

// if unable to delete the User
else{
	
	// set response code - 503 service unavailable
	http_response_code(503);
	
	// tell the user
	echo json_encode(array("message" => "Unable to delete user."));
}
?>
