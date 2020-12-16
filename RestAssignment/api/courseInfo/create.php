<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../db_config/Database.php';
include_once '../../model/courseInfo.php';


//Instantiate a database connection and create a connection
$database = new Database();
$db = $database->connect();



//Instantiate the model class
$courseInfo = new courseInfo($db);


//Obtain json data that will be sent with the request
$data = json_decode(file_get_contents("php://input"));

//Assign the course name
$courseInfo->course_name = $data->course_name;


// echo json_encode(
//     array("message" => $courseInfo->course_name)
// );


if($courseInfo->insertCourse()){
    echo json_encode(
        array("message" => "Course Created")
    );

}
else{
    echo json_encode(
        array("message" => "Course Not Created")
    );

}