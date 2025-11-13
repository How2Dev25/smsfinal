<?php
// auth 
include('components/global/auth.php');

// module and controllers

include_once('../controllers/sectionassignmentcontroller.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Section Assignment Tool</title>
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
    <!-- 📊 Metric Cards Grid -->
    <!-- ========================================================= -->
            <div class="mb-8 bg-gradient-to-r from-blue-50 to-white rounded-xl shadow-lg p-6 sm:p-8 border border-blue-100">
                        <h1 class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">Section Assignment</h1>
                 </div>
    

        <?php 
            $counts = new counts();
            $counts = $counts->getAllCounts();


        ?>
       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Students Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-primary">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Students</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1"><?=  $counts['students'] ?></p>
                </div>
                <div class="p-3 bg-indigo-100 rounded-full">
                    <i class="fas fa-users text-primary text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-xs font-medium text-green-500 bg-green-100 px-2 py-1 rounded-full">
                    <i class="fas fa-arrow-up mr-1"></i> 
                </span>
            </div>
        </div>

        <!-- Total Sections Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-secondary">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Sections</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1"><?=  $counts['sections'] ?></p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <i class="fas fa-layer-group text-secondary text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-xs font-medium text-green-500 bg-green-100 px-2 py-1 rounded-full">
                    <i class="fas fa-arrow-up mr-1"></i> 
                </span>
            </div>
        </div>

        <!-- Total Subjects Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-accent">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Subjects</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1"><?=  $counts['subjects'] ?></p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-book text-accent text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-xs font-medium text-green-500 bg-green-100 px-2 py-1 rounded-full">
                    <i class="fas fa-arrow-up mr-1"></i> 
                </span>
            </div>
        </div>

        <!-- Total Teachers Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Teachers</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1"><?=  $counts['teachers'] ?></p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full">
                    <i class="fas fa-chalkboard-teacher text-yellow-500 text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-xs font-medium text-green-500 bg-green-100 px-2 py-1 rounded-full">
                    <i class="fas fa-arrow-up mr-1"></i> 
                </span>
            </div>
        </div>
    </div>
        

    <!-- ========================================================= -->
    <!-- 🧩 Tables / Modules Grid -->
    <!-- ========================================================= -->

    <?php 
    include_once('components/sectionassignment/studentlist.php')
    
    ?>





         <div class="bg-white rounded-xl shadow-md p-4">
            <?php include_once('components/sectionassignment/addsection.php') ?>
        </div>
        
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
   
</div>
            </section>
        </main>
    </section>

    <script src="../javascript/sidebar.js">

    </script>
</body>




<script>
const courseInput = document.getElementById('courseInput');
const autocompleteList = document.getElementById('autocompleteList');
const tableBody = document.getElementById('studentTableBody');
const courses = ["BSIT", "BSCRIM", "BSTOURISM", "BSED", "BSBA", "ALL"];
let students = JSON.parse(localStorage.getItem('students') || '[]');
students.forEach(addStudentToTable);

// Modals
const openModalBtn = document.getElementById('openModalBtn');
const modal = document.getElementById('studentModal');
const cancelBtn = document.getElementById('cancelBtn');
const studentForm = document.getElementById('studentForm');



// Certificate Modal Logic
const certModal = document.getElementById('certificateModal');
const closeCert = document.getElementById('closeCertificate');
const certName = document.getElementById('certName');
const certSection = document.getElementById('certSection');
const certRoom = document.getElementById('certRoom');
const certAdviser = document.getElementById('certAdviser');
const certSchedule = document.getElementById('certSchedule');
const printCertModalBtn = document.getElementById('printCertificateModal');

function openCertificateModal(student) {
  certName.textContent = student.name;
  certSection.textContent = "Section: " + student.yearCourse;
  certRoom.textContent = "Room: " + student.room;
  certAdviser.textContent = "Adviser: " + student.adviser;

  const scheduleData = student.schedule || [
    { day: 'Mon', time: '08:00-09:00', subject: 'Math' },
    { day: 'Tue', time: '09:00-10:00', subject: 'English' },
    { day: 'Wed', time: '10:00-11:00', subject: 'Science' }
  ];

  certSchedule.innerHTML = '';
  scheduleData.forEach(s => {
    const tr = document.createElement('tr');
    tr.innerHTML = `<td class="border border-gray-700 px-3 py-1">${s.day}</td>
                    <td class="border border-gray-700 px-3 py-1">${s.time}</td>
                    <td class="border border-gray-700 px-3 py-1">${s.subject}</td>`;
    certSchedule.appendChild(tr);
  });

  certModal.classList.remove('hidden');
}

printCertModalBtn.addEventListener('click', () => {
  window.print();
});

closeCert.addEventListener('click', () => certModal.classList.add('hidden'));
</script>

</html>
