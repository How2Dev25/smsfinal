<?php 
session_start();
include_once('../connections/connections.php');
include_once('../controllers/specialschedController.php');


if (!isset($_SESSION['id']) || !isset($_SESSION['verified']) || $_SESSION['verified'] !== true) {
    // not authorized
    header('Location: ../errors/401.php');
    exit();
}


$specialSchedule = new Specialsched();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['addSpecialSchedule'])) {
    $specialSchedule->store(
        $_POST['eventName'],
        $_POST['eventType'],
        $_POST['teacherID'],
        $_POST['subjectID'],
        $_POST['sectionID'],
        $_POST['roomID'],
        $_POST['date'],
        $_POST['startTime'],
        $_POST['endTime'],
        $_SESSION['id'],
        $_POST['remarks']
    );
}

if (isset($_POST['updateSpecialSchedule'])) {
    $specialSchedule->update(
        $_POST['specialScheduleID'],
        $_POST['eventName'],
        $_POST['eventType'],
        $_POST['teacherID'],
        $_POST['subjectID'],
        $_POST['sectionID'],
        $_POST['roomID'],
        $_POST['date'],
        $_POST['startTime'],
        $_POST['endTime'],
        $_POST['remarks']
    );
}

if (isset($_POST['deleteSpecialSchedule'])) {
    $specialSchedule->destroy($_POST['specialScheduleID']);
}




    if(isset($_POST['cloneSpecialSchedule'])) {
        $specialScheduleID = $_POST['specialScheduleID'];
        $createdBy = $_SESSION['id']; // use session to track who cloned
        $specialSchedule->clone($specialScheduleID, $createdBy);
    }


}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['deleteSpecial'])){
        $specialScheduleID = $_GET['deleteSpecial'];
        $specialSchedule->destroy($specialScheduleID);
    }
}