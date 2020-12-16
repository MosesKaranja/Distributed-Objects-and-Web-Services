<?php
class courseInfo{
    private $conn;
    private $table="courseInfo";

    public $id;
    public $course_name;

    public function __construct($db){
        $this->conn = $db;

    }

    //Return all courses offered
    public function getAllCourses(){
        //query to select all courses
        $query = "SELECT  courseInfo.id,courseInfo.course_name FROM $this->table";


        //Prepare query
        $stmt = $this->conn->prepare($query);

        //Execute Query
        $stmt->execute();

        return $stmt;

    }

    //FUnction to return a single student 
    public function getSingleCourse(){
        //Query to select 1 student
        $query = "SELECT courseInfo.id,courseInfo.course_name FROM courseInfo WHERE courseInfo.id = ?";

        //Prepare our statement
        $stmt = $this->conn->prepare($query);

        //Bind the snumber parameter
        $stmt->bindParam(1, $this->id);
        
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->course_name = $row['course_name'];


        

    }


    //Function to insert a course
    public function insertCourse(){
        
        //Query to insert a course  
        $query = 'INSERT INTO ' . $this->table . ' SET course_name = :course_name';

        //Prepare Statement 
        $stmt = $this->conn->prepare($query);
        
        //Clean Data
        $this->course_name = htmlspecialchars(strip_tags($this->course_name));

        //Bind Param
        $stmt->bindParam(':course_name',$this->course_name);

        //Lets execute our query    
        if($stmt->execute()){
            return true;

        }

        printf("Error: %s. \n", $stmt->error);

        return false;       

    }


            //Update a course    
            public function update_course(){
                $query = 'UPDATE ' .$this->table. '
                SET
                    course_name = :course_name
                WHERE 
                    id = :id';
    
    
                //Prepare statement
                $stmt = $this->conn->prepare($query);
    
                //Clean Data
                $this->course_name = htmlspecialchars(stripslashes($this->course_name));
                $this->id = htmlspecialchars(stripslashes($this->id));

    
                //Bind Param
                $stmt->bindParam(':course_name', $this->course_name);
                $stmt->bindParam(':id', $this->id);


                if($stmt->execute()){
                    return true;
            
                  }
            
                  //Print Error if something goes wrong
                  printf("Error: %s. \n", $stmt->error);
            
                  return false;
          
            
            }


        //Delete a course  
        public function delete(){
            //Delete query
            //$query = "DELETE FROM studentInfo WHERE student_num=:student_num";
            $queryOther = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            //Prepare Statement
            $stmt = $this->conn->prepare($queryOther);

            $this->id = htmlspecialchars(strip_tags($this->id));

            //BindParam
            $stmt->bindParam(':id', $this->id);
            
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