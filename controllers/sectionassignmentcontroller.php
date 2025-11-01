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

 public function addSection($sectionName, $yearLevel, $course, $adviserID, $schoolYear, $semester)
{
    global $connections;

    $sql = "INSERT INTO section_tbl (sectionName, yearLevel, course, adviserID, schoolYear, semester)
            VALUES ('$sectionName', '$yearLevel', '$course', '$adviserID', '$schoolYear', '$semester')";
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

public function updateSection($sectionID, $sectionName, $yearLevel, $course, $adviserID, $schoolYear, $semester)
{
    global $connections;

    $sql = "UPDATE section_tbl 
            SET sectionName = '$sectionName',
                yearLevel = '$yearLevel',
                course = '$course',
                adviserID = '$adviserID',
                schoolYear = '$schoolYear',
                semester = '$semester'
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



    public function addStudent(){

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