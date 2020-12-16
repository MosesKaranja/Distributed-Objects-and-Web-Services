<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../db_config/Database.php';
  include_once '../../model/courseInfo.php';


//Instantiate a database connection and create a connection
$database = new Database();
$db = $database->connect();


//Instantiate the model class
$courseInfo = new courseInfo($db);

$courseInfo->id = isset($_GET['id']) ? $_GET['id'] : die();

$courseInfo->getSingleCourse();

$single_course_array = array(
    "id" => $courseInfo->id,
    "courseName" => $courseInfo->course_name
);

print_r(json_encode($single_course_array));

