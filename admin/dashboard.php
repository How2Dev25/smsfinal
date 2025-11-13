<?php
// auth 
include('components/global/auth.php');

include_once('../controllers/sectionassignmentcontroller.php');
include_once('../controllers/timetablecontroller.php');
include('../controllers/roomcontroller.php');
include_once('../controllers/specialschedController.php');

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
                <?php include_once('components/global/greetings.php') ?>
                <div class="max-w-7xl mx-auto">
                    <!-- Header -->
                 <div class="mb-8 bg-gradient-to-r from-blue-50 to-white rounded-xl shadow-lg p-6 sm:p-8 border border-blue-100">
                        <h1 class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">Dashboard</h1>
                 </div>

                    <!-- Stats Cards -->
    
                <?php include_once('components/dashboard/studentmetric.php') ?>



                       <?php include_once('components/dashboard/graph.php')   ?> 

                       <!-- room -->


                  <?php include_once('components/dashboard/rooms.php') ?>

               

             



                <?php include_once('components/dashboard/special.php') ?>



                

        

                
                 
                </div>
            </section>
        </main>
    </section>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="../javascript/sidebar.js">

    </script>
</body>
</html>