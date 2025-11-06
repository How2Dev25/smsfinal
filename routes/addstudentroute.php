<?php
include_once('../connections/connections.php');
include_once('../controllers/sectionassignmentcontroller.php');
$student = new student();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $sectionID = $_POST['sectionID'] ?? $_GET['section'];
    // ADD STUDENT
    if (isset($_POST['addStudent'])) {
        $studentuserID = !empty($_POST['studentuserID']) ? $_POST['studentuserID'] : "NULL";
        $sectionID     = $_POST['sectionID'];
        $student_name  = $_POST['student_name'];
        $gender        = $_POST['gender'];

        $student->addStudent($studentuserID, $sectionID, $student_name, $gender);
    }

    // MODIFY STUDENT
    if (isset($_POST['modifyStudent'])) {
        $studentID     = $_POST['primarytableID'];
        $student_name  = $_POST['studentName'];
        $gender        = $_POST['gender'];

        $student->modifyStudent($studentID, $student_name, $gender);
    }

    // DELETE STUDENT
    
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['deleteStudent'])) {
        $studentID = $_GET['deleteStudent'];
        $student->deleteStudent($studentID);
    }
}
