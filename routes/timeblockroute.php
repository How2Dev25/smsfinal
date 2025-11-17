<?php 

include_once('../connections/connections.php');
include_once('../controllers/timeblockController.php');


$timeblock = new TimeblockController();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['createtimeblock'])){
        $blockName =  $_POST['blockName'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];

        $timeblock->create($blockName, $startTime, $endTime);
    }

      if(isset($_POST['updatetimeblock'])){
        $timeblockID = $_POST['timeblockID'];
        $blockName =  $_POST['blockName'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];

        $timeblock->update($blockName, $startTime, $endTime, $timeblockID);
    }
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['deletetimeblock'])){
    $timeblockID = $_GET['deletetimeblock'];

    $timeblock->delete($timeblockID);
    }
}