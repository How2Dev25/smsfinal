<?php

include_once('../connections/connections.php');
include_once('../controllers/sectionassignmentcontroller.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['addsubject'])){
        $subjectCode = $_POST['subjectCode'];
        $subjectName = $_POST['subjectName'];
        $units = $_POST['units'];

        $addsubject = new subject();
        $addsubject->addsubject($subjectCode, $subjectName, $units);
    }

    if(isset($_POST['updatesubject'])){
        $subjectID = $_POST['subjectID'];
        $subjectCode = $_POST['subjectCode'];
        $subjectName = $_POST['subjectName'];
        $units = $_POST['units'];

        $addsubject = new subject();
        $addsubject->editsubject($subjectID, $subjectCode, $subjectName, $units);
    }

}

if($_SERVER['REQUEST_METHOD'] == 'GET'){

     if (isset($_GET['deletesubject'])) 
    { 
        $sectionID = $_GET['deletesubject'];
        $section =new subject();
        $section->removesubject($sectionID); 
    }
}

