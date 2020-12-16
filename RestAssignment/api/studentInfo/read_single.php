<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

include_once '../../db_config/Database.php';
include_once '../../model/studentInfo.php';


//Instantiate a database connection and create a connection
$database = new Database();
$db = $database->connect();



//Instantiate the model class
$studentInfo = new studentInfo($db);

$studentInfo->student_num = isset($_GET['snum']) ? $_GET['snum'] : die();

$studentInfo->getSingleStudent();

$single_student_array = array(
    "StudentNum" => $studentInfo->student_num,
    "courseID" => $studentInfo->course_id,
    "courseName" => $studentInfo->course_name,
    "fname" => $studentInfo->fname,
    "lname" => $studentInfo->lname,
    "email" => $studentInfo->email,
    "phone_number" => $studentInfo->phone_number,
    "address" => $studentInfo->address,
    "entry_points" => $studentInfo->entry_points 
);

  print_r(json_encode($single_student_array));