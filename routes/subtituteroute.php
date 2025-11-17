<?php 

include_once('../connections/connections.php');
include_once('../controllers/subtituteController.php');


$subtitute = new SubtituteController();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['createSubtitute'])){
       $sectionAssignmentID = $_POST['sectionAssignmentID'];
       $substituteTeacherID = $_POST['substituteTeacherID'];

       $subtitute->create($sectionAssignmentID, $substituteTeacherID);
    }
    if(isset($_POST['modifySubtitute'])){
        $sectionAssignmentID = $_POST['sectionAssignmentID'];
       $substituteTeacherID = $_POST['substituteTeacherID'];
       $status = $_POST['status'];
       $subAssignmentID = $_POST['subAssignmentID'];

       $subtitute->modify($sectionAssignmentID, $substituteTeacherID, $status, $subAssignmentID);

    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['deletesubtitute'])){
         $subAssignmentID = $_GET['deletesubtitute'];

         $subtitute->delete($subAssignmentID);
    }
}

