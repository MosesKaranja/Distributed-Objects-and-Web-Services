<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../db_config/Database.php';
  include_once '../../model/studentInfo.php';


    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //echo "Here now";

    //Instantiate the model class
    $studentInfo = new studentInfo($db);

    //Call the read function

    $readData = $studentInfo->getStudents();

    $num = $readData->rowCount();
    
    //echo $num;

    if($num > 0) {

        //echo $num;

         // Post array
         $posts_arr = array();
         // $posts_arr['data'] = array();

        //echo $num;
    
         while($row = $readData->fetch(PDO::FETCH_ASSOC)) {
           extract($row);
    
           $post_item = array(
             'studentNum' => $student_num,
             'courseId' => $course_id,
             'courseName' => $course_name,
             'fname' => $fname,
             'lname' => $lname,
            'email' => $email,
             'phoneNumber' => $phone_number,
             'address' => $address,
             'entryPoints' => $entry_points    
           );
    
           // Push to "data"
           array_push($posts_arr, $post_item);
           // array_push($posts_arr['data'], $post_item);
         }
    
         // Turn to JSON & output
         echo json_encode($posts_arr);
    
      } 

      else {
        // No Posts

        echo json_encode(
          array('message' => 'No Posts Found')
        );

        //echo $num;

      }
