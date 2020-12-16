<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../db_config/Database.php';
include_once '../../model/studentInfo.php';


//Instantiate a database connection and create a connection
$database = new Database();
$db = $database->connect();



//Instantiate the model class
$studentInfo = new studentInfo($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

$studentInfo->student_num = $data->student_num;





  // Delete post
  if($studentInfo->delete()) {
    echo json_encode(
      array('message' => 'Post Deleted got here')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Deleted')
    );
  }

