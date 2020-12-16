<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../db_config/Database.php';
include_once '../../model/studentInfo.php';


//Instantiate a database connection and create a connection
$database = new Database();
$db = $database->connect();



//Instantiate the model class
$studentInfo = new studentInfo($db);

//Obtain json data that will be sent with the request
$data = json_decode(file_get_contents("php://input"));

$studentInfo->student_num = $data->studentNum; 
$studentInfo->course_id = $data->courseId;
$studentInfo->course_name = $data->courseName;
$studentInfo->fname = $data->fname; 
$studentInfo->lname = $data->lname;
$studentInfo->email = $data->email;
$studentInfo->phone_number = $data->phoneNumber;
$studentInfo->address = $data->address;
$studentInfo->entry_points = $data->entryPoints;




if($studentInfo->insert()){
    echo json_encode(
        array("message" => "Student created")
    );

}
else{
    echo json_encode(
        array("message" => "Student Not Created")
    );

}



// // $student_num = "";
// // $fname = "";
// // $lname = "";
// // $email = "";
// // $phone_number = "";
// // $address = "";

// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     $student_num = $_POST['snumber'];
//     $fname = $_POST['fname'];
//     $lname = $_POST['lname'];
//     $email = $_POST['myEmail'];
//     $phone_number = $_POST['myPhone'];
//     $address = $_POST['address'];

//     // if(empty($_POST['snumber'])){
//     //     echo "NO data recieved there";
        
//     // }
//     // else{
//     //     echo $student_num;
//     // }

// }

// // echo $student_num;  
