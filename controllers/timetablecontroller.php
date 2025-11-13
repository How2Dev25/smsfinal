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


    public function cloneExam($originalExamID, $newInvigilatorID) {
    global $connections;

    $originalExamID = intval($originalExamID);
    $newInvigilatorID = intval($newInvigilatorID);

    // 1️⃣ Fetch original exam schedule
    $query = mysqli_query($connections, "SELECT * FROM exam_timetable WHERE examID = $originalExamID");
    $original = mysqli_fetch_assoc($query);

    if (!$original) {
        echo "<script>
            alert('❌ Original exam schedule not found.');
            window.history.back();
        </script>";
        exit;
    }

    $subjectID = $original['subjectID'];
    $sectionID = $original['sectionID'];
    $roomID = $original['roomID'];
    $examDate = $original['examDate'];
    $startTime = $original['startTime'];
    $endTime = $original['endTime'];

    // 2️⃣ Optional: Check if new invigilator already has an exam at this date/time
    $checkInvigilator = mysqli_query($connections, "
        SELECT * FROM exam_timetable
        WHERE invigilatorID = $newInvigilatorID
        AND examDate = '$examDate'
        AND ('$startTime' < endTime AND startTime < '$endTime')
    ");
    if (mysqli_num_rows($checkInvigilator) > 0) {
        echo "<script>
            alert('❌ Conflict: This invigilator already has an exam at this time.');
            window.history.back();
        </script>";
        exit;
    }

    // 3️⃣ Insert cloned exam
    $insert = mysqli_query($connections, "
        INSERT INTO exam_timetable
        (subjectID, sectionID, roomID, examDate, startTime, endTime, invigilatorID)
        VALUES ($subjectID, $sectionID, $roomID, '$examDate', '$startTime', '$endTime', $newInvigilatorID)
    ");

    if ($insert) {
        echo "<script>
            alert('✅ Exam schedule cloned successfully!');
            window.location.href='" . $_SERVER['HTTP_REFERER'] . "';
        </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "<script>
            alert('❌ Error cloning exam schedule: $error');
            window.history.back();
        </script>";
    }
}

public function fetchtimetableCounts() {
    // Fetch all rooms
    $rooms = $this->fetchRoom();
    $totalRooms = count($rooms);
    $availableRooms = count(array_filter($rooms, fn($r) => $r['roomStatus'] === 'Available'));
    $occupiedRooms = count(array_filter($rooms, fn($r) => $r['roomStatus'] === 'Occupied'));
    $underMaintenance = count(array_filter($rooms, fn($r) => $r['roomStatus'] === 'Maintenance'));

    // Fetch all exams
    $examList = $this->fetch();
    $totalExams = count($examList);

    // Upcoming exams (from today onward)
    $today = date('Y-m-d');
    $upcomingExams = count(array_filter($examList, fn($exam) => $exam['examDate'] >= $today));

    // Rooms used in exams
    $examRoomIDs = array_map(fn($exam) => $exam['roomID'], $examList);
    $uniqueExamRooms = array_unique($examRoomIDs);
    $availableExamRooms = $totalRooms - count($uniqueExamRooms); // optional, just rooms not used in any exam

    // Assigned proctors
    $invigilatorIDs = array_filter(array_map(fn($exam) => $exam['invigilatorID'], $examList));
    $assignedProctors = count(array_unique($invigilatorIDs));

    return [
        'totalRooms' => $totalRooms,
        'availableRooms' => $availableRooms,
        'occupiedRooms' => $occupiedRooms,
        'underMaintenance' => $underMaintenance,
        'totalExams' => $totalExams,
        'upcomingExams' => $upcomingExams,
        'availableExamRooms' => $availableExamRooms,
        'assignedProctors' => $assignedProctors
    ];
}



}


