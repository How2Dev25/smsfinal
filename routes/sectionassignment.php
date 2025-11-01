<?php

include_once('../connections/connections.php');
include_once('../controllers/sectionassignmentcontroller.php');


if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if (isset($_POST['addsection'])) {
    $sectionName = trim($_POST['sectionName']);
    $yearLevel = $_POST['yearLevel'];
    $course = $_POST['course'];
    $adviserID = $_POST['adviserID'];
    $schoolYear = $_POST['schoolYear'];
    $semester = $_POST['semester'];

    $insertsection = new sectionAssignment();
    $insertsection->addSection($sectionName, $yearLevel, $course, $adviserID, $schoolYear, $semester);
}

 if (isset($_POST['updatesection'])) {
    $sectionName = trim($_POST['sectionName']);
    $yearLevel = $_POST['yearLevel'];
    $course = $_POST['course'];
    $adviserID = $_POST['adviserID'];
    $schoolYear = $_POST['schoolYear'];
    $semester = $_POST['semester'];
    $sectionID = $_POST['sectionID'];

    $insertsection = new sectionAssignment();
    $insertsection->updateSection($sectionID,$sectionName, $yearLevel, $course, $adviserID, $schoolYear, $semester);
}

}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
   if (isset($_GET['deleteSection'])) 
    { 
        $sectionID = $_GET['deleteSection'];
        $section =new sectionAssignment();
        $section->deleteSection($sectionID); 
    }
}