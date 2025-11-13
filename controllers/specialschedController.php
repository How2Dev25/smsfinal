<?php 

class Specialsched {
     public function store($eventName, $eventType, $teacherID, $subjectID, $sectionID, $roomID, $date, $startTime, $endTime, $createdBy, $remarks) {
        global $connections;

        $sql = "INSERT INTO special_schedule_tbl 
                (eventName, eventType, teacherID, subjectID, sectionID, roomID, date, startTime, endTime, createdBy, remarks)
                VALUES 
                ('$eventName', '$eventType', 
                 " . ($teacherID ?: 'NULL') . ", 
                 " . ($subjectID ?: 'NULL') . ", 
                 " . ($sectionID ?: 'NULL') . ", 
                 " . ($roomID ?: 'NULL') . ", 
                 '$date', '$startTime', '$endTime', '$createdBy', '$remarks')";

        $result = mysqli_query($connections, $sql);

       
    }


      public function update($specialScheduleID, $eventName, $eventType, $teacherID, $subjectID, $sectionID, $roomID, $date, $startTime, $endTime, $remarks) {
        global $connections;

        $sql = "UPDATE special_schedule_tbl 
                SET eventName='$eventName',
                    eventType='$eventType',
                    teacherID=" . ($teacherID ?: 'NULL') . ",
                    subjectID=" . ($subjectID ?: 'NULL') . ",
                    sectionID=" . ($sectionID ?: 'NULL') . ",
                    roomID=" . ($roomID ?: 'NULL') . ",
                    date='$date',
                    startTime='$startTime',
                    endTime='$endTime',
                    remarks='$remarks'
                WHERE specialScheduleID='$specialScheduleID'";

        $result = mysqli_query($connections, $sql);

        if ($result) {
            echo "<script>alert('Special Schedule Updated Successfully!'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        } else {
            $error = addslashes(mysqli_error($connections));
            echo "<script>alert('Failed to Update Schedule: $error'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }
    }

     public function destroy($specialScheduleID) {
        global $connections;

        $sql = "DELETE FROM special_schedule_tbl WHERE specialScheduleID='$specialScheduleID'";
        $result = mysqli_query($connections, $sql);

        if ($result) {
            echo "<script>alert('Special Schedule Deleted Successfully!'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        } else {
            $error = addslashes(mysqli_error($connections));
            echo "<script>alert('Failed to Delete Schedule: $error'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }
    }

      public function clone($specialScheduleID, $createdBy) {
        global $connections;

        $query = "SELECT * FROM special_schedule_tbl WHERE specialScheduleID='$specialScheduleID'";
        $result = mysqli_query($connections, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $sql = "INSERT INTO special_schedule_tbl 
                    (eventName, eventType, teacherID, subjectID, sectionID, roomID, date, startTime, endTime, createdBy, remarks)
                    VALUES 
                    ('" . addslashes($row['eventName']) . " (Copy)', 
                     '" . addslashes($row['eventType']) . "',
                     " . ($row['teacherID'] ?: 'NULL') . ",
                     " . ($row['subjectID'] ?: 'NULL') . ",
                     " . ($row['sectionID'] ?: 'NULL') . ",
                     " . ($row['roomID'] ?: 'NULL') . ",
                     '" . $row['date'] . "',
                     '" . $row['startTime'] . "',
                     '" . $row['endTime'] . "',
                     '$createdBy',
                     '" . addslashes($row['remarks']) . "')";

            $insert = mysqli_query($connections, $sql);

            if ($insert) {
                echo "<script>alert('Special Schedule Cloned Successfully!'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
            } else {
                $error = addslashes(mysqli_error($connections));
                echo "<script>alert('Failed to Clone Schedule: $error'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
            }
        } else {
            echo "<script>alert('Schedule Not Found!'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }
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

public function fetchSpecialSchedules() {
    global $connections;

    // Join related tables for more readable data
   $sql = "SELECT 
            ss.specialScheduleID,
            ss.eventName,
            ss.eventType,
            ss.date,
            ss.startTime,
            ss.endTime,
            ss.remarks,
            ss.createdBy,
            ss.teacherID,
            ss.subjectID,
            ss.sectionID,
            ss.roomID,
            u.username AS createdByName,
            t.username AS teacherName,
            subj.subjectName,
            s.sectionName,
            r.roomName
        FROM special_schedule_tbl ss
        LEFT JOIN users t ON ss.teacherID = t.id
        LEFT JOIN subject_tbl subj ON ss.subjectID = subj.subjectID
        LEFT JOIN section_tbl s ON ss.sectionID = s.sectionID
        LEFT JOIN room_tbl r ON ss.roomID = r.roomID
        LEFT JOIN users u ON ss.createdBy = u.id
        ORDER BY ss.date DESC, ss.startTime ASC";

    $result = mysqli_query($connections, $sql);

    $schedules = [];

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $schedules[] = $row;
            }
        } else {
            // no data found
            // return an empty array for consistency
        }
    } else {
        die("Database Error: " . mysqli_error($connections));
    }

    return $schedules;
}

}