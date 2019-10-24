<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../utils/dbconnect.php';
 
// instantiate product object
include_once '../object/User.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));
//$data = JSON.parse($data);
$data = (array) $data;
// get posted data
//echo $data->name;
 //var_dump($data);
 //exit();
// make sure data is not empty
if(
    //!empty($data->id) &&
    !empty($data['name']) &&
    !empty($data['password']) &&
    !empty($data['email'])
){
 	//echo "in";    // set product property values
    //$user->id= $data->id;
 	$user->name = $data['name'];
    $user->email = $data['email'];
    $user->password = $data['password'];
   // $user->created = date('Y-m-d H:i:s');
 
    // create the product
    if($user->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "User was created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create user."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create user. Data is incomplete."));
}
?>