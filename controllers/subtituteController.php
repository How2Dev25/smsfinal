<?php 

class SubtituteController{
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

    public function create($sectionAssignmentID, $substituteTeacherID){
        global $connections;

              $sql = "INSERT INTO substitute_assignments (sectionAssignmentID, substituteTeacherID) 
        VALUES ('$sectionAssignmentID', '$substituteTeacherID')";
              $result = mysqli_query($connections, $sql);

                    if ($result) {
                            echo "<script>alert('Subtitute Added'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        } else {
                            $error = addslashes(mysqli_error($connections));
                            echo "<script>alert('Timeblock Error: $error'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        }
    }

   public function modify($sectionAssignmentID, $substituteTeacherID, $status, $subAssignmentID){
    global $connections;

    $sql = "UPDATE substitute_assignments 
            SET sectionAssignmentID = $sectionAssignmentID, 
                substituteTeacherID = $substituteTeacherID, 
                status = '$status' 
            WHERE subAssignmentID = $subAssignmentID";

    $result = mysqli_query($connections, $sql);

    if ($result) {
        echo "<script>
                alert('Substitute Modified'); 
                window.location.href='" . $_SERVER['HTTP_REFERER'] . "';
              </script>";
    } else {
        $error = addslashes(mysqli_error($connections));
        echo "<script>
                alert('Substitute Error: $error'); 
                window.location.href='" . $_SERVER['HTTP_REFERER'] . "';
              </script>";
    }
}


    public function delete($subAssignmentID){
        global $connections;

        $sql = "DELETE FROM subtitute_assignments WHERE subAssignmentID = $subAssignmentID ";

        $result = mysqli_query($connections, $sql);

                    if ($result) {
                            echo "<script>alert('Subtitute Removed); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        } else {
                            $error = addslashes(mysqli_error($connections));
                            echo "<script>alert('Timeblock Error: $error'); window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
                        }
    }

    


public function getAllAssignedAssignments() {
    global $connections;

    $sql = "
        SELECT 
            sub.subAssignmentID,
            sub.sectionAssignmentID,
            sub.substituteTeacherID,
            sub.assignedAt,
            sub.status,
            sub.notes,

            sa.assignmentID,
            sa.sectionID,
            sa.subjectID,
            sa.teacherID AS originalTeacherID,
            sa.roomID,
            sa.day,
            sa.startTime,
            sa.endTime,

            u.username AS originalTeacherName,
            su.username AS substituteTeacherName,

            sec.sectionName,
            sec.yearLevel,

            s.subjectName,

            r.roomName

        FROM substitute_assignments sub

        -- link substitute to the original schedule
        JOIN section_assignments sa 
            ON sub.sectionAssignmentID = sa.assignmentID

        -- original teacher
        JOIN users u 
            ON sa.teacherID = u.id 
            AND u.role = 'teacher'

        -- substitute teacher
        JOIN users su 
            ON sub.substituteTeacherID = su.id 
            AND su.role = 'teacher'

        -- subject details
        JOIN subject_tbl s 
            ON sa.subjectID = s.subjectID

        -- section details
        JOIN section_tbl sec 
            ON sa.sectionID = sec.sectionID

        -- room details
        JOIN room_tbl r 
            ON sa.roomID = r.roomID

        ORDER BY sa.day, sa.startTime ASC
    ";

    $result = mysqli_query($connections, $sql);
    $assigned = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $assigned[] = $row;
        }
    }

    return $assigned;
}

    

public function getSubstituteSummary() {
    $subs = $this->getAllAssignedAssignments();

    $summary = [
        'total' => 0,
        'morning' => 0,
        'afternoon' => 0,
        'pending' => 0,
        'assigned' => 0,
        'completed' => 0
    ];

    foreach ($subs as $sub) {
        $summary['total']++;

        // Determine AM or PM
        $hour = (int)date('H', strtotime($sub['startTime']));
        if ($hour < 12) {
            $summary['morning']++;
        } else {
            $summary['afternoon']++;
        }

        // Count based on status
        switch (strtolower($sub['status'])) {
            case 'pending':
                $summary['pending']++;
                break;
            case 'assigned':
                $summary['assigned']++;
                break;
            case 'completed':
                $summary['completed']++;
                break;
        }
    }

    return $summary;
}

}