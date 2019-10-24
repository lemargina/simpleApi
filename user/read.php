<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// include database and object files
include_once '../utils/dbconnect.php';
include_once '../object/User.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$user = new User($db);
// query products
$stmt = $user->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
	
	// products array
	$users_arr=array();
	$users_arr["records"]=array();
	
	// retrieve our table contents
	// fetch() is faster than fetchAll()
	// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		// extract row
		// this will make $row['name'] to
		// just $name only
		extract($row);
		
		$product_item=array(
				"id" => $id,
				"name" => $name,
				"password" => html_entity_decode($password),
				"email" => $email,

		);
		
		array_push($users_arr["records"], $product_item);
	}
	
	// set response code - 200 OK
	http_response_code(200);
	
	// show products data in json format
	echo json_encode($users_arr);
}else{
	
	// set response code - 404 Not found
	http_response_code(404);
	
	// tell the user no products found
	echo json_encode(
			array("message" => "No users found.")
			);
}
?>