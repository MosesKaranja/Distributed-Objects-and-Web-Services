<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../db_config/Database.php';
include_once '../../model/studentInfo.php';




// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//echo "Here now";

//Instantiate the model class
$studentInfo = new studentInfo($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));


//Remember we'll be using the student number to update
$studentInfo->student_num = $data->student_num;

$studentInfo->course_id = $data->course_id;
$studentInfo->course_name = $data->course_name; 
$studentInfo->fname = $data->fname;
$studentInfo->lname = $data->lname;
$studentInfo->email = $data->email;
$studentInfo->phone_number = $data->phone_number;
$studentInfo->address = $data->address;
$studentInfo->entry_points = $data->entry_points;   



if($studentInfo->update_student()){
    echo json_encode(array('message' => 'post Updated'));
}

else{
    echo json_encode(array('message' => 'Post Not Updated'));
}

