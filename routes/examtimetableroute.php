<?php
include_once('../connections/connections.php');
include_once('../controllers/timetablecontroller.php');

$exam = new ExamTimetable();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['addExam'])){
    $subjectID = $_POST['subjectID'];
    $sectionID = $_POST['sectionID'];
    $roomID = $_POST['roomID'];
    $examDate = $_POST['examDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $invigilatorID = $_POST['invigilatorID'];

    $exam->store($subjectID, $sectionID, $roomID, $examDate, $startTime, $endTime, $invigilatorID);
    exit;
  }

  if (isset($_POST['editExam'])) {
        // Get the submitted form data
        $examID = $_POST['examID'];
        $subjectID = $_POST['subjectID'];
        $sectionID = $_POST['sectionID'];
        $roomID = $_POST['roomID'];
        $examDate = $_POST['examDate'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $invigilatorID = $_POST['invigilatorID'];

        // Call the modify method
        $exam->modify($examID, $subjectID, $sectionID, $roomID, $examDate, $startTime, $endTime, $invigilatorID);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['deletesched'])) {
        $examID = $_GET['deletesched'];
        
        // Call the delete method
        $exam->delete($examID);
        exit;
    }
  }