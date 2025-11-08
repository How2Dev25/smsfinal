<?php

class ExamTimetable {

    public function store($subjectID, $sectionID, $roomID, $examDate, $startTime, $endTime, $invigilatorID) {
        global $connections;

        $sql = "INSERT INTO exam_timetable (subjectID, sectionID, roomID, examDate, startTime, endTime, invigilatorID)
                VALUES ('$subjectID', '$sectionID', '$roomID', '$examDate', '$startTime', '$endTime', '$invigilatorID')";

        $result = mysqli_query($connections, $sql);

        if ($result) {
            echo "
            <script>
                alert('Exam Schedule Added Successfully!');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
            </script>";
        } else {
            $error = addslashes(mysqli_error($connections));
            echo "
            <script>
                alert('Failed to Add Exam Schedule: $error');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
            </script>";
        }
    }

    public function modify($examID, $subjectID, $sectionID, $roomID, $examDate, $startTime, $endTime, $invigilatorID) {
        global $connections;

        $sql = "UPDATE exam_timetable 
                SET subjectID = '$subjectID',
                    sectionID = '$sectionID',
                    roomID = '$roomID',
                    examDate = '$examDate',
                    startTime = '$startTime',
                    endTime = '$endTime',
                    invigilatorID = '$invigilatorID'
                WHERE examID = '$examID'";

        $result = mysqli_query($connections, $sql);

        if ($result) {
            echo "
            <script>
                alert('Exam Schedule Updated Successfully!');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
            </script>";
        } else {
            $error = addslashes(mysqli_error($connections));
            echo "
            <script>
                alert('Failed to Update Exam Schedule: $error');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
            </script>";
        }
    }

    public function delete($examID) {
        global $connections;

        $sql = "DELETE FROM exam_timetable WHERE examID = '$examID'";
        $result = mysqli_query($connections, $sql);

        if ($result) {
            echo "
            <script>
                alert('Exam Schedule Deleted Successfully!');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
            </script>";
        } else {
            $error = addslashes(mysqli_error($connections));
            echo "
            <script>
                alert('Failed to Delete Exam Schedule: $error');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
            </script>";
        }
    }

   public function fetch() {
    global $connections;

    $sql = "SELECT 
                et.examID,
                et.subjectID,
                s.subjectCode,
                s.subjectName,
                et.sectionID,
                sec.sectionName,
                sec.yearLevel,
                et.roomID,
                r.roomName,
                et.invigilatorID,
                u.username AS invigilator,
                et.examDate,
                et.startTime,
                et.endTime,
                et.created_at
            FROM exam_timetable et
            INNER JOIN subject_tbl s ON et.subjectID = s.subjectID
            INNER JOIN section_tbl sec ON et.sectionID = sec.sectionID
            INNER JOIN room_tbl r ON et.roomID = r.roomID
            LEFT JOIN users u ON et.invigilatorID = u.id
            ORDER BY et.examDate ASC, et.startTime ASC";

    $result = mysqli_query($connections, $sql);
    $data = [];

    if($result){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }
        }
    }

    return $data;
}

     public function fetchRoom (){
        global $connections;

        $sql = "SELECT * FROM room_tbl";
        $result = mysqli_query($connections, $sql);

        $roomList = [];

        if($result){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                   $roomList[] = $row;
                }
            }
            else{
                echo "No Data Found";
            }
        }

        return $roomList;
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



}


