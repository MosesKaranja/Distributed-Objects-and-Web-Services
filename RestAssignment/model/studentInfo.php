<?php
class studentInfo{

    private $conn;
    private $table = "studentInfo";

    public $student_num;
    public $course_id;
    public $course_name;
    public $fname;
    public $lname;
    public $email;
    public $phone_number;
    public $address;
    public $entry_points;

    public function __construct($db){
        $this->conn = $db;

    }
    //Lets return all students
    public function getStudents(){
        // $query = 'SELECT c.course_name as course_name, s.student_num, s.course_id, s.fname, s.lname, s.email, s.phone_number, s.address, s.entry_points
        // FROM ' . $this->table . ' s
        // LEFT JOIN
        //   courseInfo c ON s.id = c.course_id
        // ';

        $queryOther = "SELECT studentInfo.student_num,courseInfo.course_name ,studentInfo.course_id,studentInfo.fname, studentInfo.lname ,studentInfo.email, studentInfo.phone_number, studentInfo.address, studentInfo.entry_points FROM studentInfo LEFT JOIN courseInfo ON studentInfo.course_id = courseInfo.id ORDER BY studentInfo.student_num";

        //Prepare Statement
        $stmt = $this->conn->prepare($queryOther);

        // if($this->conn){
        //     echo "Statement SUccess";

        // }
        // else{
        //     echo "Statement NUll";

        // }

        //Execute QUery
        $stmt->execute();

        return $stmt;
        

    }

    public function getSingleStudent(){
        //Query to select 1 student
        $query = "SELECT studentInfo.student_num,courseInfo.course_name ,studentInfo.course_id,studentInfo.fname, studentInfo.lname ,studentInfo.email, studentInfo.phone_number, studentInfo.address, studentInfo.entry_points FROM studentInfo LEFT JOIN courseInfo ON studentInfo.course_id=courseInfo.id WHERE studentInfo.student_num = ?";

        //Prepare our statement
        $stmt = $this->conn->prepare($query);

        //Bind the snumber parameter
        $stmt->bindParam(1, $this->student_num);
        
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->student_num = $row['student_num'];
        $this->course_id = $row['course_id'];
        $this->course_name = $row['course_name'];
        $this->fname = $row['fname'];
        $this->lname = $row['lname'];
        $this->email = $row['email'];
        $this->phone_number = $row['phone_number'];
        $this->address = $row['address'];
        $this->entry_points = $row['entry_points'];



        

    }






    //Insert student data into the students table
    public function insert(){
        $query = 'INSERT INTO ' . $this->table . ' SET student_num = :student_num, course_id = :course_id, fname = :fname, lname = :lname, email = :email, phone_number = :phone_number, address = :address, entry_points=:entry_points';

        // $queryOther = "INSERT INTO studentInfo(student_num, course_id, fname, lname, email, phone_number, address, entry_points) VALUES ( '$this->studentNum', '$this->courseId', '$this->fname', '$this->lname', '$this->email', '$this->phoneNumber', '$this->address',  '$this->entryPoints',)";

        //$queryOther = "INSERT INTO studentInfo(student_num, course_id, fname, lname, email, phone_number, address, entry_points) VALUES ( '$this->studentNum', '$this->courseId', '$this->fname', '$this->lname', '$this->email', '$this->phoneNumber', '$this->address',  '$this->entryPoints',)";


        //$query = $this->conn->prepare($queryOther);

        //Prepare Statement 
         $stmt = $this->conn->prepare($query);

        //Clean the data
        $this->student_num = htmlspecialchars(strip_tags($this->student_num));
        $this->course_id = htmlspecialchars(strip_tags($this->course_id));
        $this->course_name = htmlspecialchars(strip_tags($this->course_name));
        $this->fname = htmlspecialchars(strip_tags($this->fname));
        $this->lname = htmlspecialchars(strip_tags($this->lname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->entry_points = htmlspecialchars(strip_tags($this->entry_points));


        //Bind the parameters
        $stmt->bindParam(':student_num', $this->student_num);
        $stmt->bindParam(':course_id', $this->course_id);
        $stmt->bindParam(':fname', $this->fname);
        $stmt->bindParam(':lname', $this->lname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':phone_number', $this->phone_number);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':entry_points', $this->entry_points);

        // echo json_encode(
        //     array("message" => "Executed")
        // );  


        if($stmt->execute()){
            return true;

        }

        printf("Error: %s. \n", $stmt->error);

        return false;


        }



    //   if($query->execute()){
    //     //return true;
    //     echo json_encode(
    //         array("message" => "Reached the create method")
    //     );



    //   }

    //   //Print Error if something goes wrong
    //   printf("Error: %s. \n", $query->error);

    //   return false;

    




        // if($query->execute()){
        //     return true;

        // }

        // printf("Error: %s.\n", $query->error);
        

        // return false;


        //Update student data based on student_id    
        public function update_student(){
            $query = 'UPDATE ' .$this->table. '
            SET
                student_num = :student_num, 
                course_id = :course_id,
                fname = :fname, 
                lname = :lname, 
                email = :email, 
                phone_number = :phone_number,
                address = :address, 
                entry_points=:entry_points

            WHERE 
                student_num = :student_num';


            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean Data
            $this->student_num = htmlspecialchars(stripslashes($this->student_num));
            $this->course_id = htmlspecialchars(stripslashes($this->course_id));
            $this->course_name = htmlspecialchars(stripslashes($this->course_name));
            $this->fname = htmlspecialchars(stripslashes($this->fname));
            $this->lname = htmlspecialchars(stripslashes($this->lname));
            $this->email = htmlspecialchars(stripslashes($this->email));
            $this->phone_number = htmlspecialchars(stripslashes($this->phone_number));
            $this->address = htmlspecialchars(stripslashes($this->address));
            $this->entry_points = htmlspecialchars(stripslashes($this->entry_points));

            // echo json_encode(array(
            // "snum" => $this->student_num,
            // "CourseID" => $this->course_id,
            // "CourseName" => $this->course_name,
            // "FName" => $this->fname,
            // "LName" => $this->lname,
            // "Email" => $this->email,
            // "Phone" => $this->phone_number,
            // "Address" => $this->address,
            // "EntryPoints" => $this->entry_points
            
            // ));

            //Bind Param
            $stmt->bindParam(':student_num', $this->student_num);
            $stmt->bindParam(':course_id', $this->course_id);
            //$stmt->bindParam(':', $this->course_name);
            $stmt->bindParam(':fname', $this->fname);
            $stmt->bindParam(':lname', $this->lname);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':phone_number', $this->phone_number);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':entry_points', $this->entry_points);

            if($stmt->execute()){
                return true;
        
              }
        
              //Print Error if something goes wrong
              printf("Error: %s. \n", $stmt->error);
        
              return false;
      
        


        }

        //Delete a table    
        public function delete(){
            //Delete query
            $query = "DELETE FROM studentInfo WHERE student_num=:student_num";
            $queryOther = 'DELETE FROM ' . $this->table . ' WHERE student_num = :student_num';

            //Prepare Statement
            $stmt = $this->conn->prepare($queryOther);

            $this->student_num = htmlspecialchars(strip_tags($this->student_num));

            //BindParam
            $stmt->bindParam(':student_num', $this->student_num);
            
            // echo json_encode(
            //     array('message' => $this->student_num)
            //   );


            if($stmt->execute()){
                return true;

            }

            //Print Error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            return false;
                  


        }

    }


