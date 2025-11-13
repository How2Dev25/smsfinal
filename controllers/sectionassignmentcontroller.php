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

    $sql = "
        SELECT 
            s.*,
            u.username AS adviserName,
            r.roomName,
            IFNULL(r.capacity, 0) AS capacity,
            (SELECT COUNT(*) FROM section_list_tbl sl WHERE sl.sectionID = s.sectionID) AS studentCount
        FROM section_tbl s
        LEFT JOIN users u ON s.adviserID = u.id
        LEFT JOIN room_tbl r ON s.roomID = r.roomID
    ";

    $result = mysqli_query($connections, $sql);

    $getsectionList = [];

    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $getsectionList[] = $row;
        }
    } else {
        // Optional: log the SQL error
        // error_log("fetchSectionList SQL error: " . mysqli_error($connections));
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
    $day, $startTime, $endTime, $notes) {
    global $connections;

    // 🧩 1. Check Teacher Conflict (same teacher, overlapping time)
    $checkTeacher = mysqli_query($connections, "
        SELECT * FROM section_assignments
        WHERE teacherID = $teacherID
        AND day = '$day'
        AND ('$startTime' < endTime AND startTime < '$endTime')
    ");

    if (mysqli_num_rows($checkTeacher) > 0) {
        echo "<script>alert('❌ Conflict: This teacher already has a class during this time.'); window.history.back();</script>";
        exit;
    }

    // 🧩 2. Check Section Conflict (same section, overlapping time — any teacher)
    $checkSection = mysqli_query($connections, "
        SELECT * FROM section_assignments
        WHERE sectionID = $sectionID
        AND day = '$day'
        AND ('$startTime' < endTime AND startTime < '$endTime')
    ");

    if (mysqli_num_rows($checkSection) > 0) {
        echo "<script>alert('❌ Conflict: This section already has a class scheduled at this time.'); window.history.back();</script>";
        exit;
    }

    // 🧩 3. Check Room Conflict (same room, overlapping time — any teacher)
    $checkRoom = mysqli_query($connections, "
        SELECT * FROM section_assignments
        WHERE roomID = $roomID
        AND day = '$day'
        AND ('$startTime' < endTime AND startTime < '$endTime')
    ");

    if (mysqli_num_rows($checkRoom) > 0) {
        echo "<script>alert('❌ Conflict: This room is already booked for that time.'); window.history.back();</script>";
        exit;
    }

    // ✅ If No Conflicts → Insert Schedule
    $sql = "INSERT INTO section_assignments 
            (teacherID, subjectID, sectionID, roomID, day, startTime, endTime, notes)
            VALUES ($teacherID, $subjectID, $sectionID, $roomID, '$day', '$startTime', '$endTime', '$notes')";
    
    $result = mysqli_query($connections, $sql);

    if ($result) {
        echo "<script>alert('✅ Section Assignment added successfully!'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "<script>alert('❌ Error: $error'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }
}

public function cloneAssignment($originalID, $newTeacherID, $notes = '') {
    global $connections;

    // Sanitize inputs
    $originalID = intval($originalID);
    $newTeacherID = intval($newTeacherID);
    $notes = addslashes($notes);

    // 0️⃣ Fetch original schedule
    $query = mysqli_query($connections, "SELECT * FROM section_assignments WHERE assignmentID = $originalID");
    $original = mysqli_fetch_assoc($query);

    if (!$original) {
        echo "<script>alert('❌ Original schedule not found.'); window.history.back();</script>";
        exit;
    }

    $subjectID = $original['subjectID'];
    $sectionID = $original['sectionID'];
    $roomID = $original['roomID'];
    $day = $original['day'];
    $startTime = $original['startTime'];
    $endTime = $original['endTime'];

    // 1️⃣ Teacher conflict only (skip section/room)
    $checkTeacher = mysqli_query($connections, "
        SELECT * FROM section_assignments
        WHERE teacherID = $newTeacherID
        AND day = '$day'
        AND ('$startTime' < endTime AND startTime < '$endTime')
    ");
    if (mysqli_num_rows($checkTeacher) > 0) {
        echo "<script>alert('❌ Conflict: Teacher already has a class in this time slot.'); window.history.back();</script>";
        exit;
    }

    // ✅ Insert cloned assignment
    $sql = "INSERT INTO section_assignments
            (teacherID, subjectID, sectionID, roomID, day, startTime, endTime, notes)
            VALUES ($newTeacherID, $subjectID, $sectionID, $roomID, '$day', '$startTime', '$endTime', '$notes')";
    $result = mysqli_query($connections, $sql);

    if ($result) {
        echo "<script>alert('✅ Schedule cloned successfully!'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "<script>alert('❌ Error cloning schedule: $error'); window.history.back();</script>";
    }
}



     public function updateAssignment($assignmentID, $teacherID, $subjectID, $sectionID, $roomID, $day, $startTime, $endTime, $notes) {
    global $connections;

    // Exclude current assignment when checking conflict
    $exclude = "AND assignmentID != $assignmentID";

    // 1. Teacher conflict
    $checkTeacher = mysqli_query($connections, "
        SELECT * FROM section_assignments
        WHERE teacherID = $teacherID
        AND day = '$day'
        AND ('$startTime' < endTime AND startTime < '$endTime')
        $exclude
    ");
    if(mysqli_num_rows($checkTeacher) > 0){
        echo "<script>alert('❌ Conflict: Teacher already has a class in this time slot.'); window.history.back();</script>";
        exit;
    }

    // 2. Section conflict
    $checkSection = mysqli_query($connections, "
        SELECT * FROM section_assignments
        WHERE sectionID = $sectionID
        AND day = '$day'
        AND ('$startTime' < endTime AND startTime < '$endTime')
        $exclude
    ");
    if(mysqli_num_rows($checkSection) > 0){
        echo "<script>alert('❌ Conflict: Section already has a class at this time.'); window.history.back();</script>";
        exit;
    }

    // 3. Room conflict
    $checkRoom = mysqli_query($connections, "
        SELECT * FROM section_assignments
        WHERE roomID = $roomID
        AND day = '$day'
        AND ('$startTime' < endTime AND startTime < '$endTime')
        $exclude
    ");
    if(mysqli_num_rows($checkRoom) > 0){
        echo "<script>alert('❌ Conflict: The room is already used at this time.'); window.history.back();</script>";
        exit;
    }

    // ✅ Safe to update
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
        echo "<script>alert('✅ Section Assignment updated successfully!'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "<script>alert('❌ Error updating assignment: $error'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
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

    // 1. Get capacity of the section's room
    $capacityQuery = mysqli_query($connections, "
        SELECT r.capacity
        FROM section_tbl s
        LEFT JOIN room_tbl r ON s.roomID = r.roomID
        WHERE s.sectionID = '$sectionID'
    ");

    $capacityRow = mysqli_fetch_assoc($capacityQuery);
    $capacity = isset($capacityRow['capacity']) ? (int)$capacityRow['capacity'] : 0;

    // 2. Count current students in that section
    $countQuery = mysqli_query($connections, "
        SELECT COUNT(*) AS studentCount
        FROM section_list_tbl
        WHERE sectionID = '$sectionID'
    ");
    $countRow = mysqli_fetch_assoc($countQuery);
    $studentCount = (int)$countRow['studentCount'];

    // 3. Check if room is full
    if ($capacity > 0 && $studentCount >= $capacity) {
        echo "
        <script>
            alert('❌ Cannot add student — Room capacity reached ($studentCount / $capacity).');
            window.history.back();
        </script>";
        exit;
    }

    // 4. If not full → Proceed insert
    $sql = "INSERT INTO section_list_tbl (studentuserID, sectionID, student_name, gender)
            VALUES ('$studentuserID', '$sectionID', '$student_name', '$gender')";
    
    $result = mysqli_query($connections, $sql);

    if ($result) {
        echo "
        <script>
            alert('✅ Student added successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('❌ Error adding student: $error');
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

class studentlist {
   
   
    public function studentlist(){
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
    INNER JOIN users u ON sl.studentuserID = u.id   -- CHANGE TO LEFT JOIN
    INNER JOIN users a ON s.adviserID = a.id        -- Keep adviser join flexible too
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

public function assignsubject($assignmentID, $id){
    global $connections;

    // 1. Get day + time of the class the student is trying to add
    $target = mysqli_fetch_assoc(mysqli_query($connections, "
        SELECT day, startTime, endTime 
        FROM section_assignments 
        WHERE assignmentID = $assignmentID
    "));

    $day = $target['day'];
    $startTime = $target['startTime'];
    $endTime = $target['endTime'];

    // 2. Check if student already has a subject at the same day & overlapping time
    $checkConflict = mysqli_query($connections, "
        SELECT ss.student_subject_id, sa.subjectID, sa.sectionID
        FROM student_subject_tbl ss
        INNER JOIN section_assignments sa ON ss.assignmentID = sa.assignmentID
        WHERE ss.studentID = $id
        AND sa.day = '$day'
        AND ('$startTime' < sa.endTime AND sa.startTime < '$endTime')
    ");

    if(mysqli_num_rows($checkConflict) > 0){
        echo "
        <script>
            alert('❌ Conflict: Student already enrolled in a subject scheduled during this time.');
            window.history.back();
        </script>";
        exit;
    }

    // 3. If no conflicts → proceed to enroll student
    $sql = "INSERT INTO student_subject_tbl (assignmentID, studentID) VALUES ($assignmentID, $id)";
    $result = mysqli_query($connections, $sql);

    if ($result){
        echo "
        <script>
            alert('✅ Subject Assigned Successfully!');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "
        <script>
            alert('❌ Failed to Assign Subject: $error');
            window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    }
}


public function getstudent ($studentID){

      global $connections;

        $sql = "SELECT * FROM users WHERE id = $studentID ";
        $result = mysqli_query($connections, $sql);

        $getStudents = [];

      if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the first row like Laravel's first()
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }

        return $getStudents;

}

public function removesubject($student_subject_id){
    global $connections;

    $sql = "DELETE FROM student_subject_tbl WHERE student_subject_id = $student_subject_id";
    $result = mysqli_query($connections, $sql);


     if ($result){
            echo "
            <script>
                alert('Subject Removed Successfully!');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
            </script>";
        } else {
            $error = addslashes(mysqli_error($connections));
            echo "
            <script>
                alert('Subject Removed Successfully: $error');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
            </script>";
        }



}

public function fetchsubjectforstudent($studentID){   
    global $connections;

    $sql = "
        SELECT 
            sst.student_subject_id,
            sub.subjectName,
            u.username AS teacherName,
            sec.sectionName,
            r.roomName,
            sa.day,
            sa.startTime,
            sa.endTime,
            sa.notes

        FROM student_subject_tbl sst
        INNER JOIN section_assignments sa ON sst.assignmentID = sa.assignmentID
        INNER JOIN subject_tbl sub ON sa.subjectID = sub.subjectID
        INNER JOIN users u ON sa.teacherID = u.id AND u.role = 'Teacher'
        INNER JOIN section_tbl sec ON sa.sectionID = sec.sectionID
        INNER JOIN room_tbl r ON sa.roomID = r.roomID

        WHERE sst.studentID = '$studentID'
    ";

    return mysqli_query($connections, $sql);
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

class counts{
       public function getAllCounts() {
        global $connections;

        // Count all students
        $sqlStudents = "SELECT COUNT(*) as total FROM users WHERE role = 'Student'";
        $resultStudents = mysqli_query($connections, $sqlStudents);
        $totalStudents = mysqli_fetch_assoc($resultStudents)['total'];

        // Count all teachers
        $sqlTeachers = "SELECT COUNT(*) as total FROM users WHERE role = 'Teacher'";
        $resultTeachers = mysqli_query($connections, $sqlTeachers);
        $totalTeachers = mysqli_fetch_assoc($resultTeachers)['total'];

        // Count all subjects
        $sqlSubjects = "SELECT COUNT(*) as total FROM subject_tbl";
        $resultSubjects = mysqli_query($connections, $sqlSubjects);
        $totalSubjects = mysqli_fetch_assoc($resultSubjects)['total'];

        // Count all sections
        $sqlSections = "SELECT COUNT(*) as total FROM section_tbl";
        $resultSections = mysqli_query($connections, $sqlSections);
        $totalSections = mysqli_fetch_assoc($resultSections)['total'];

        // Return all counts as an array
        return [
            'students' => $totalStudents,
            'teachers' => $totalTeachers,
            'subjects' => $totalSubjects,
            'sections' => $totalSections
        ];
    }
}



