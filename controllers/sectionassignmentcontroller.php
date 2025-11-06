<?php


class sectionAssignment {
    public function getStudentFromUsers(){
        global $connections;

        $sql = "SELECT * FROM users WHERE role = 'Student'";
        $result = mysqli_query($connections, $sql);

        $getStudents = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                   $getStudents[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $getStudents;

    }

    public function getTeacherFromUsers(){
            global $connections;

        $sql = "SELECT * FROM users WHERE role = 'Teacher'";
        $result = mysqli_query($connections, $sql);

        $getTeacher = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                  $getTeacher[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $getTeacher;
    }

 public function addSection($sectionName, $yearLevel, $course, $adviserID, $schoolYear, $semester, $roomID)
{
    global $connections;

    $sql = "INSERT INTO section_tbl (sectionName, yearLevel, course, adviserID, schoolYear, semester, roomID)
            VALUES ('$sectionName', '$yearLevel', '$course', '$adviserID', '$schoolYear', '$semester', '$roomID')";
    $result = mysqli_query($connections, $sql);

    if ($result) {
        echo "
        <script>
            alert('Section added successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('Error adding section: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    }
}

public function updateSection($sectionID, $sectionName, $yearLevel, $course, $adviserID, $schoolYear, $semester, $roomID)
{
    global $connections;

    $sql = "UPDATE section_tbl 
            SET sectionName = '$sectionName',
                yearLevel = '$yearLevel',
                course = '$course',
                adviserID = '$adviserID',
                schoolYear = '$schoolYear',
                semester = '$semester',
                roomID = '$roomID'
            WHERE sectionID = '$sectionID'";

    $result = mysqli_query($connections, $sql);

    if ($result) {
        echo "
        <script>
            alert('Section updated successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('Error updating section: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    }
}

public function deleteSection($sectionID){
    global $connections;

    $sql = "DELETE FROM section_tbl WHERE sectionID = $sectionID";
    $result = mysqli_query($connections, $sql);

      if ($result) {
        echo "
        <script>
            alert('Section removed successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('Error updating section: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    }

}

public function fetchSectionList(){
          global $connections;

       $sql = "SELECT * 
        FROM section_tbl s
        INNER JOIN users u ON s.adviserID = u.id
        INNER JOIN room_tbl r ON s.roomID = r.roomID";

        $result = mysqli_query($connections, $sql);

        $getsectionList = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                   $getsectionList[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $getsectionList;
}

     public function fetchRoom(){
        global $connections;


      $sql = "SELECT * FROM room_tbl WHERE roomStatus = 'Available'";
        $result = mysqli_query($connections, $sql);

        $fetchRoom = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                  $fetchRoom[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $fetchRoom;
    }



   
}

class subject {
    public function addsubject($subjectCode, $subjectName, $units){
        global $connections;

       $sql = "INSERT INTO subject_tbl (subjectCode, subjectName, units) 
        VALUES ('$subjectCode', '$subjectName', $units)";
$result = mysqli_query($connections, $sql);

    if ($result) {
        echo "
        <script>
            alert('Subject Added successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('Error updating Subject: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    }


    }

    public function editsubject($subjectID, $subjectCode, $subjectName, $units){
        global $connections;

        $sql = "UPDATE subject_tbl 
        SET subjectCode = '$subjectCode', subjectName = '$subjectName', units = '$units' 
        WHERE subjectID = $subjectID
        ";

        $result = mysqli_query($connections, $sql);

    if ($result) {
        echo "
        <script>
            alert('Subject Updated successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('Error updating Subject: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";

    }
}


    public function removesubject ($subjectID){
        global $connections;

          $sql = "DELETE FROM subject_tbl 
        WHERE subjectID = $subjectID
        ";

        $result = mysqli_query($connections, $sql);
         if ($result) {
        echo "
        <script>
            alert('Subject Deleted successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('Error Deleting Subject: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";

    }

    }

    public function fetchsubject(){
        global $connections;


      $sql = "SELECT * FROM subject_tbl";
        $result = mysqli_query($connections, $sql);

        $getsubject = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                  $getsubject[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $getsubject;
    }

}

class professorAssign{

public function getStudentFromUsers(){

        global $connections;

        $sql = "SELECT * FROM users WHERE role = 'Student'";
        $result = mysqli_query($connections, $sql);

        $getStudents = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                   $getStudents[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $getStudents;

    }

    public function getTeacherFromUsers(){
            global $connections;

        $sql = "SELECT * FROM users WHERE role = 'Teacher'";
        $result = mysqli_query($connections, $sql);

        $getTeacher = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                  $getTeacher[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $getTeacher;
    }


     public function fetchsubject(){
        global $connections;


      $sql = "SELECT * FROM subject_tbl";
        $result = mysqli_query($connections, $sql);

        $getsubject = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                  $getsubject[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $getsubject;
    }

     public function fetchRoom(){
        global $connections;


      $sql = "SELECT * FROM room_tbl WHERE roomStatus = 'Available'";
        $result = mysqli_query($connections, $sql);

        $fetchRoom = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                  $fetchRoom[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $fetchRoom;
    }

    
public function fetchSectionList(){
          global $connections;

        $sql = "SELECT * FROM section_tbl s INNER JOIN users u ON s.adviserID = u.id";
        $result = mysqli_query($connections, $sql);

        $getsectionList = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                   $getsectionList[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $getsectionList;
}

        public function createAssignment($teacherID, $subjectID, $sectionID, $roomID, 
        $day, $startTime, $endTime, $notes){
            global $connections;


            $sql = "INSERT INTO section_assignments 
            (teacherID, subjectID, sectionID, roomID, day, startTime, endTime, notes )
            VALUES ($teacherID, $subjectID, $sectionID, $roomID, '$day', '$startTime', '$endTime', '$notes')
            ";
            $result = mysqli_query($connections, $sql);

     if ($result) {
        echo "
        <script>
            alert('Section Assignemnt added successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('Error adding section Assignment: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    }


        }

       public function updateAssignment($assignmentID, $teacherID, $subjectID, $sectionID, $roomID, $day, $startTime, $endTime, $notes) {
    global $connections;

    $sql = "UPDATE section_assignments 
            SET teacherID = $teacherID, 
                subjectID = $subjectID, 
                sectionID = $sectionID, 
                roomID = $roomID, 
                day = '$day', 
                startTime = '$startTime', 
                endTime = '$endTime', 
                notes = '$notes'
            WHERE assignmentID = $assignmentID";

    $result = mysqli_query($connections, $sql);

    if ($result) {
        echo "
        <script>
            alert('Section Assignment updated successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('Error updating section assignment: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    }
}

        public function deleteAssignment($assignmentID) {
    global $connections;

    $sql = "DELETE FROM section_assignments WHERE assignmentID = $assignmentID";
    $result = mysqli_query($connections, $sql);

    if ($result) {
        echo "
        <script>
            alert('Section Assignment deleted successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('Error deleting section assignment: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    }
}

public function getAllAssignments() {
    global $connections;

    $sql = "SELECT *
            FROM section_assignments sa
            JOIN users u ON sa.teacherID = u.id AND u.role = 'teacher'
            JOIN subject_tbl s ON sa.subjectID = s.subjectID
            JOIN section_tbl sec ON sa.sectionID = sec.sectionID
            JOIN room_tbl r ON sa.roomID = r.roomID
            ORDER BY sa.day, sa.startTime ASC";

    $result = mysqli_query($connections, $sql);
    $assignments = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $assignments[] = $row;
        }
    }

    return $assignments;
}


}

class student {
    public function addStudent($studentuserID, $sectionID, $student_name, $gender){
        global $connections;

        $sql = "INSERT INTO section_list_tbl (studentuserID, sectionID, student_name, gender)
                VALUES ('$studentuserID', '$sectionID', '$student_name', '$gender')";
        $result = mysqli_query($connections, $sql);

        if ($result) {
            echo "
            <script>
                alert('Student added successfully!');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
            </script>";
        } else {
            $error = addslashes(mysqli_error($connections));
            echo "
            <script>
                alert('Error adding student: $error');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
            </script>";
        }
    }

public function modifyStudent($studentID, $student_name, $gender){
    global $connections;

    // Update gender in section_list_tbl
    $sql1 = "UPDATE section_list_tbl 
             SET gender = '$gender'
             WHERE studentID = '$studentID'";

    // Update student name in users table
    $sql2 = "UPDATE users 
             SET username = '$student_name'
             WHERE id = (SELECT studentuserID FROM section_list_tbl WHERE studentID = '$studentID')";

    $result1 = mysqli_query($connections, $sql1);
    $result2 = mysqli_query($connections, $sql2);

    if ($result1 && $result2) {
        echo "<script>
                alert('Student updated successfully!');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
              </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "<script>
                alert('Error updating student: $error');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
              </script>";
    }
}


    public function deleteStudent($studentID){
        global $connections;

        $sql = "DELETE FROM section_list_tbl WHERE studentID = '$studentID'";
        $result = mysqli_query($connections, $sql);

        if ($result) {
            echo "
            <script>
                alert('Student deleted successfully!');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
            </script>";
        } else {
            $error = addslashes(mysqli_error($connections));
            echo "
            <script>
                alert('Error deleting student: $error');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
            </script>";
        }
    }

 public function getSection($sectionID){
    global $connections;

    $sql = "SELECT * FROM section_tbl s INNER JOIN room_tbl r ON s.roomID = r.roomID WHERE sectionID = '$sectionID' LIMIT 1";
    $result = mysqli_query($connections, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the first row like Laravel's first()
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}

  public function getStudentFromUsers(){
        global $connections;

        $sql = "SELECT * FROM users WHERE role = 'Student'";
        $result = mysqli_query($connections, $sql);

        $getStudents = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                   $getStudents[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $getStudents;

    }

  public function studentlistinsection($sectionID){
    global $connections;

$sql = "
    SELECT 
        s.sectionName,
        s.yearLevel,
        s.course,
        s.schoolYear,
        s.semester,
        sl.studentID as primarytableID,
        sl.student_name as primaryName,
        a.username AS adviserName,
        u.id AS studentID,
        u.userid AS studentuserID,
        u.username AS studentName,
        sl.gender
    FROM section_list_tbl sl
    INNER JOIN section_tbl s ON sl.sectionID = s.sectionID
    LEFT JOIN users u ON sl.studentuserID = u.id   -- CHANGE TO LEFT JOIN
    LEFT JOIN users a ON s.adviserID = a.id        -- Keep adviser join flexible too
    WHERE sl.sectionID = '$sectionID'
    ORDER BY u.username ASC
";

    $result = mysqli_query($connections, $sql);
    $sectionlist = [];

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $sectionlist[] = $row;
            }
        } else {
          
        }
    } else {
        echo "Query Error: " . mysqli_error($connections);
    }

    return $sectionlist;
}

}

