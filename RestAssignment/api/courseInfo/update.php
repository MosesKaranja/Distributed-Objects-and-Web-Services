<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../db_config/Database.php';
include_once '../../model/courseInfo.php';




// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//echo "Here now";

//Instantiate the model class
$courseInfo = new courseInfo($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));


//Remember we'll be using the id number to update
$courseInfo->id = $data->id; 
$courseInfo->course_name = $data->course_name;
//echo json_encode(array('id' => $courseInfo->id, 'c name' => $courseInfo->course_name));




if($courseInfo->update_course()){
    echo json_encode(array('message' => 'Course Updated'));
}

else{
    echo json_encode(array('message' => 'Course Not Updated'));
}

