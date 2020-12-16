<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../db_config/Database.php';
include_once '../../model/courseInfo.php';



//Create a connection to the database class
$database = new Database();
$db = $database->connect();

//Instantiate the courseInfo model
$courseInfo = new courseInfo($db);



//Lets call the read the function

$readData = $courseInfo->getAllCourses();

$num = $readData->rowCount();



// echo json_encode(
//     array('message' => $num)
//   );



if($num>0){
    $posts_array = array();


    while($row = $readData->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item = array(
            'id' => $id,
            'course_name' => $course_name
  
          );

          array_push($posts_array, $post_item);
   


    }

    echo json_encode($posts_array);

}

else{

    echo json_encode(
        array('message' => 'No Course Found')
      );

}

