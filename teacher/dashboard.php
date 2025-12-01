<?php
$id = include('components/global/auth.php'); // now $id is defined
include_once('../controllers/teacherController.php');



$teachers = new TeacherController();

$teacherSubjects = $teachers->fetchSubjectsForTeacher($id);
$teacherSectionInfo =  $teachers->getTeacherSectionInfo($id);

$totalTeacherSubjects = count($teacherSubjects);
$totalTeacherSections = count(array_unique(array_column($teacherSubjects, 'sectionName')));
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

<section class="min-h-screen p-4 sm:p-6 lg:p-8">
    <?php include_once('components/global/greetings.php') ?>
    <div class="max-w-7xl mx-auto">

        <!-- Dashboard Header -->
        <div class="mb-8 bg-gradient-to-r from-blue-50 to-white rounded-xl shadow-lg p-6 sm:p-8 border border-blue-100">
            <h1 class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">Teacher Dashboard</h1>
            <p class="text-gray-500">Overview of your subjects, schedule, and advisory section.</p>
        </div>

        <!-- Summary Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <!-- Total Subjects -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-gray-100 transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-100 rounded-full -mr-10 -mt-10 opacity-50 group-hover:scale-150 transition-transform duration-300"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Subjects Handled</p>
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5-1.253"></path>
                        </svg>
                    </div>
                    <p class="text-4xl font-bold text-gray-800"><?= $totalTeacherSubjects ?></p>
                </div>
            </div>

            <!-- Total Sections Handled -->
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-gray-100 transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-green-100 rounded-full -mr-10 -mt-10 opacity-50 group-hover:scale-150 transition-transform duration-300"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Sections Handled</p>
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"></path>
                        </svg>
                    </div>
                    <p class="text-3xl font-bold text-gray-800"><?= $totalTeacherSections ?></p>
                </div>
            </div>

            <!-- Adviser Section -->
            <?php 
    $teacherAdvisorySections = $teachers->getAdvisorySections($id)
?>

<?php foreach($teacherAdvisorySections as $adv): ?>
<div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-gray-100 transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-20 h-20 bg-amber-100 rounded-full -mr-10 -mt-10 opacity-50 group-hover:scale-150 transition-transform duration-300"></div>
    
    <div class="relative z-10">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Advisory Section</p>
            <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zm-4 7a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>

        <p class="text-2xl font-bold text-gray-800">
            <?= htmlspecialchars($adv['sectionName']) ?>
        </p>

        <p class="text-sm text-gray-600">
            Grade <?= htmlspecialchars($adv['yearLevel']) ?> • SY <?= htmlspecialchars($adv['schoolYear']) ?>
        </p>

           <div class="mt-5">
        <a href="this_section.php?section=<?= $adv['sectionID'] ?>"
            class="w-full inline-block text-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl shadow hover:bg-blue-700 hover:shadow-lg transition">
            View Section
        </a>
    </div>

    </div>
</div>
<?php endforeach; ?>
        </div>

        <!-- Subjects Section -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Subjects You Handle</h2>
            <p class="text-gray-600">Here are all your subjects, sections, and schedules.</p>
        </div>

        <!-- Subjects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php foreach($teacherSubjects as $subj): ?>
<div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl p-6 border border-gray-100 transition-all duration-300 hover:-translate-y-2 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
    
    <div class="mb-4">
        <h3 class="text-xl font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
            <?= htmlspecialchars($subj['subjectName']) ?>
        </h3>
        <p class="text-sm text-gray-500"><?= htmlspecialchars($subj['sectionName']) ?></p>
    </div>

    <div class="space-y-3">

        <!-- Room -->
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase">Room</p>
                <p class="text-sm text-gray-800 font-medium"><?= htmlspecialchars($subj['roomName']) ?></p>
            </div>
        </div>

        <!-- Schedule -->
        <div class="flex items-start">
            <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase">Schedule</p>
                <p class="text-sm text-gray-800 font-medium"><?= $subj['day'] ?></p>
                <p class="text-sm text-gray-600">
                    <?= date("g:i A", strtotime($subj['startTime'])) ?> -
                    <?= date("g:i A", strtotime($subj['endTime'])) ?>
                </p>
            </div>
        </div>

        <!-- Students -->
        <div class="flex items-start">
            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-3-3h-4v5zm-6 0h5v-5H9a3 3 0 00-3 3v2h5zm-6 0h5v-2a3 3 0 00-3-3H3v5zm14-7a4 4 0 10-8 0 4 4 0 008 0zm-6-7a3 3 0 116 0v1a2 2 0 01-2 2h-4a2 2 0 01-2-2V6z" />
            </svg>
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase">Students</p>
                <p class="text-sm text-gray-800 font-medium">
                    <?= $subj['studentCount'] ?> Student<?= ($subj['studentCount'] > 1 ? 's' : '') ?>
                </p>
            </div>
        </div>

    </div>

    <!-- VIEW SECTION BUTTON -->
    <div class="mt-5">
        <a href="viewstudent.php?assignmentID=<?= $subj['assignmentID'] ?>"
            class="w-full inline-block text-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-xl shadow hover:bg-blue-700 hover:shadow-lg transition">
            View Section
        </a>
    </div>

</div>
<?php endforeach; ?>

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