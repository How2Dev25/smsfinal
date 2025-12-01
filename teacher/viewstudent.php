<?php
$id = include('components/global/auth.php'); // now $id is defined

include_once('../controllers/teacherController.php');


if(isset($_GET['assignmentID'])){
    $assignmentID = $_GET['assignmentID'];
}
else{
    echo "Assignment ID Not Found";
}

?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Dashboard</title>
    <?php include_once('components/global/header.php') ?>
    
 
</head>
<body class="bg-white font-sans">
    <section class="flex h-screen overflow-hidden">
      <?php include_once('components/global/sidebar.php') ?>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white content-transition lg:ml-72" id="main-content">

                 <section class="min-h-screen p-4 sm:p-6 lg:p-8 transition-all duration-300">
             <div class="flex-1 overflow-auto p-6 max-w-7xl mx-auto space-y-6">



    <!-- ========================================================= -->
    <!-- 🧩 Tables / Modules Grid -->
    <!-- ========================================================= -->
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
        <!-- Student List Module -->
        <div class="bg-white rounded-xl shadow-md p-4">
            <?php include_once('components/sectionassignment/viewstudent.php') ?>
        </div>

        </div>
    </div>
            </section>


        </main>
    </section>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="../javascript/sidebar.js">

    </script>
</body>
</html>