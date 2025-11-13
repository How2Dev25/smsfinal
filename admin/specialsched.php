<?php
// auth 
include('components/global/auth.php');

// module and controllers

include_once('../controllers/specialschedController.php');


?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Special Scheduler</title>
  <?php include_once('components/global/header.php') ?>

</head>
<body class="bg-white font-sans">
    <section class="flex h-screen overflow-hidden">
      <?php include_once('components/global/sidebar.php') ?>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white content-transition lg:ml-72" id="main-content">
            <section class="min-h-screen p-4 sm:p-6 lg:p-8 transition-all duration-300">
                <div class="flex-1 overflow-auto p-6 max-w-7xl mx-auto space-y-6">

                <div class="mb-8 bg-gradient-to-r from-blue-50 to-white rounded-xl shadow-lg p-6 sm:p-8 border border-blue-100">
                        <h1 class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">Special Schedule</h1>
                 </div>


    <!-- Special Schedule Overview -->
<h2 class="text-xl font-semibold text-gray-800 mb-4 mt-8">Special Schedule Overview</h2>

<?php
$specialSchedule = new Specialsched();
$allSchedules = $specialSchedule->fetchSpecialSchedules();

// Totals
$totalSpecialSchedules = count($allSchedules);
$makeupClasses = count(array_filter($allSchedules, fn($s) => $s['eventType'] === 'Makeup Class'));
$rescheduledExams = count(array_filter($allSchedules, fn($s) => $s['eventType'] === 'Exam')); // or use a flag if you have
$specialRequests = count(array_filter($allSchedules, fn($s) => !empty($s['remarks'])));
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Total Special Schedules -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Special Schedules</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $totalSpecialSchedules ?></p>
            </div>
            <div class="p-3 bg-indigo-100 rounded-full">
                <i class="fas fa-calendar-check text-indigo-500 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Make-Up Classes -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Make-Up Classes</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $makeupClasses ?></p>
            </div>
            <div class="p-3 bg-green-100 rounded-full">
                <i class="fas fa-chalkboard-teacher text-green-500 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Rescheduled Exams -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Rescheduled Exams</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $rescheduledExams ?></p>
            </div>
            <div class="p-3 bg-yellow-100 rounded-full">
                <i class="fas fa-clock text-yellow-500 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Special Requests -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Special Requests</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $specialRequests ?></p>
            </div>
            <div class="p-3 bg-red-100 rounded-full">
                <i class="fas fa-envelope-open-text text-red-500 text-xl"></i>
            </div>
        </div>
    </div>
</div>






                      <!-- Special Schedule Table -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg p-6">
  <h2 class="text-xl font-semibold mb-4 text-gray-800">Special Schedule List</h2>

   <!-- Add Button -->
  <div class="mt-4 flex justify-end mb-5">
    <button data-modal-target="specialScheduleModal" data-modal-toggle="specialScheduleModal"
      class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
      + Add Schedule
    </button>
  </div>

  <table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-white uppercase bg-blue-900">
      <tr>
        <th class="px-6 py-3">Event Name</th>
        <th class="px-6 py-3">Event Type</th>
        <th class="px-6 py-3">Teacher</th>
        <th class="px-6 py-3">Subject</th>
        <th class="px-6 py-3">Section</th>
        <th class="px-6 py-3">Room</th>
        <th class="px-6 py-3">Date</th>
        <th class="px-6 py-3">Time</th>
        <th class="px-6 py-3 text-center">Actions</th>
      </tr>
    </thead>

   <tbody>
<?php
    // Instantiate your controller
    $specialSchedule = new Specialsched();
    $schedules = $specialSchedule->fetchSpecialSchedules();

    if (!empty($schedules)) {
        foreach ($schedules as $row) {
            ?>
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4"><?= htmlspecialchars($row['eventName']) ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['eventType']) ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['teacherName'] ?? 'N/A') ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['subjectName'] ?? 'N/A') ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['sectionName'] ?? 'N/A') ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['roomName'] ?? 'N/A') ?></td>
                <td class="px-6 py-4"><?= htmlspecialchars($row['date']) ?></td>
                <td class="px-6 py-4">
                    <?= htmlspecialchars(date('g:i A', strtotime($row['startTime']))) ?> -
                    <?= htmlspecialchars(date('g:i A', strtotime($row['endTime']))) ?>
                </td>
                <td class="px-6 py-4 flex justify-center gap-2 flex-col gap-2">
                    <!-- Edit -->
                    <button 
                        data-modal-target="editSpecialScheduleModal<?= $row['specialScheduleID'] ?>" 
                        data-modal-toggle="editSpecialScheduleModal<?= $row['specialScheduleID'] ?>"
                        class="text-blue-600 hover:text-blue-800 font-medium edit-btn">
                        Edit
                    </button>

                   <button data-modal-target="cloneSpecialScheduleModal<?= $row['specialScheduleID'] ?>" 
                data-modal-toggle="cloneSpecialScheduleModal<?= $row['specialScheduleID'] ?>" 
                class="text-yellow-600 hover:text-yellow-800 font-medium">Clone</button>

                    <!-- Delete -->
                    <button 
                       
                        data-id="<?= $row['specialScheduleID'] ?>"
                        class="text-red-600 hover:text-red-800 font-medium deleteBtnid">
                        Delete
                    </button>
                </td>
            </tr>
            <?php
        }
    } else {
        echo '<tr><td colspan="9" class="text-center py-4 text-gray-500">No Special Schedules Found</td></tr>';
    }
?>
</tbody>
  </table>

 
</div>



   
                 </div>

            </section>
        </main>
    </section>

 <div id="specialScheduleModal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
            justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg border border-indigo-200 overflow-hidden">
            
            <!-- Header -->
            <div class="flex justify-between items-center p-5 bg-indigo-600">
                <h3 class="text-lg font-semibold text-white">Add Special Schedule</h3>
                <button type="button" data-modal-hide="specialScheduleModal"
                        class="text-white hover:bg-indigo-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                    ✕
                </button>
            </div>

            <!-- Body -->
            <form action="../routes/specialsched.php" method="POST" class="p-6 space-y-6 text-indigo-900">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Special Sched Name</label>
                        <input name="eventName" type="text" placeholder="e.g. Midterm Exam" 
                               class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">Special Sched Type</label>
                        <select name="eventType" 
                                class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Select Type</option>
                            <option>Exam</option>
                            <option>Makeup Class</option>
                            <option>School Event</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Date</label>
                        <input type="date" name="date" 
                               class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">Room</label>
                        <?php 
                        $fetchRoom = new Specialsched();
                        $roomData = $fetchRoom->fetchRoom(); // You can implement this method
                        ?>
                        <select name="roomID" 
                                class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Room</option>
                            <?php foreach($roomData as $room): ?>
                                <option value="<?= htmlspecialchars($room['roomID']) ?>"><?= htmlspecialchars($room['roomName']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Start Time</label>
                        <input type="time" name="startTime" 
                               class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">End Time</label>
                        <input type="time" name="endTime" 
                               class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div >
                        <label class="block mb-2 font-semibold">Teacher</label>
                        <select name="teacherID" 
                                class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Teacher</option>
                            <?php 
                            $getTeacher = new Specialsched();
                            $teachers = $getTeacher->getTeacherFromUsers(); // Implement this in controller
                            foreach($teachers as $t): ?>
                                <option value="<?= htmlspecialchars($t['id']) ?>"><?= htmlspecialchars($t['username']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div >
                        <label class="block mb-2 font-semibold">Subjects </label>
                        <select name="subjectID" 
                                class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Subjects</option>
                            <?php 
                            $getSubject = new Specialsched();
                            $getSubject= $getSubject->fetchsubject(); // Implement this in controller
                            foreach($getSubject as $subjects): ?>
                                <option value="<?= htmlspecialchars($subjects['subjectID']) ?>"><?= htmlspecialchars($subjects['subjectName']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                 <div >
                        <label class="block mb-2 font-semibold">Section </label>
                        <select name="sectionID" 
                                class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Section</option>
                            <?php 
                            $section = new Specialsched();
                            $section= $section->fetchSectionList(); // Implement this in controller
                            foreach($section as $sections): ?>
                                <option value="<?= htmlspecialchars($sections['sectionID']) ?>"><?= htmlspecialchars($sections['sectionName']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>



                <div>
                    <label class="block mb-2 font-semibold">Remarks</label>
                    <textarea name="remarks" placeholder="Optional notes" 
                              class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>

                <!-- Footer Buttons -->
                <div class="flex justify-end gap-4 pt-4 border-t border-indigo-100">
                    <button type="button" data-modal-hide="specialScheduleModal"
                            class="px-4 py-2 rounded-lg border border-indigo-400 text-indigo-700 font-medium hover:bg-indigo-50 transition">
                        Cancel
                    </button>
                    <button name="addSpecialSchedule" type="submit"
                            class="px-4 py-2 rounded-lg bg-indigo-700 text-white font-medium hover:bg-indigo-800 shadow-md transition">
                        Save Schedule
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>



<?php 
$specialSchedule = new Specialsched();
$allSchedules = $specialSchedule->fetchSpecialSchedules();

foreach ($allSchedules as $sched): 
?>
<div id="editSpecialScheduleModal<?= $sched['specialScheduleID'] ?>" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
            justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg border border-indigo-200 overflow-hidden">
            
            <!-- Header -->
            <div class="flex justify-between items-center p-5 bg-indigo-600">
                <h3 class="text-lg font-semibold text-white">Edit Special Schedule</h3>
                <button type="button" data-modal-hide="editSpecialScheduleModal<?= $sched['specialScheduleID'] ?>"
                        class="text-white hover:bg-indigo-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                    ✕
                </button>
            </div>

            <!-- Body -->
            <form action="../routes/specialsched.php" method="POST" class="p-6 space-y-6 text-indigo-900">

                <input type="hidden" name="specialScheduleID" value="<?= $sched['specialScheduleID'] ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Special Sched Name</label>
                        <input name="eventName" type="text" 
                               value="<?= htmlspecialchars($sched['eventName']) ?>"
                               class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">Special Sched Type</label>
                        <select name="eventType"
                                class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Select Type</option>
                            <option <?= $sched['eventType'] == 'Exam' ? 'selected' : '' ?>>Exam</option>
                            <option <?= $sched['eventType'] == 'Makeup Class' ? 'selected' : '' ?>>Makeup Class</option>
                            <option <?= $sched['eventType'] == 'School Event' ? 'selected' : '' ?>>School Event</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Date</label>
                        <input type="date" name="date" 
                               value="<?= htmlspecialchars($sched['date']) ?>"
                               class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">Room</label>
                        <select name="roomID"
                                class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Room</option>
                            <?php 
                            $rooms = $specialSchedule->fetchRoom();
                            foreach($rooms as $room): ?>
                                <option value="<?= $room['roomID'] ?>" <?= $sched['roomID'] == $room['roomID'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($room['roomName']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Start Time</label>
                        <input type="time" name="startTime" 
                               value="<?= htmlspecialchars($sched['startTime']) ?>"
                               class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">End Time</label>
                        <input type="time" name="endTime" 
                               value="<?= htmlspecialchars($sched['endTime']) ?>"
                               class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Teacher</label>
                        <select name="teacherID" 
                                class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Teacher</option>
                            <?php 
                            $teachers = $specialSchedule->getTeacherFromUsers();
                            foreach($teachers as $t): ?>
                                <option value="<?= $t['id'] ?>" <?= $sched['teacherID'] == $t['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($t['username']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">Subject</label>
                        <select name="subjectID" 
                                class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Subject</option>
                            <?php 
                            $subjects = $specialSchedule->fetchsubject();
                            foreach($subjects as $sub): ?>
                                <option value="<?= $sub['subjectID'] ?>" <?= $sched['subjectID'] == $sub['subjectID'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($sub['subjectName']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block mb-2 font-semibold">Section</label>
                    <select name="sectionID" 
                            class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Section</option>
                        <?php 
                        $sections = $specialSchedule->fetchSectionList();
                        foreach($sections as $sec): ?>
                            <option value="<?= $sec['sectionID'] ?>" <?= $sched['sectionID'] == $sec['sectionID'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($sec['sectionName']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-semibold">Remarks</label>
                    <textarea name="remarks"
                              class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"><?= htmlspecialchars($sched['remarks']) ?></textarea>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-4 pt-4 border-t border-indigo-100">
                    <button type="button" data-modal-hide="editSpecialScheduleModal<?= $sched['specialScheduleID'] ?>"
                            class="px-4 py-2 rounded-lg border border-indigo-400 text-indigo-700 font-medium hover:bg-indigo-50 transition">
                        Cancel
                    </button>
                    <button name="updateSpecialSchedule" type="submit"
                            class="px-4 py-2 rounded-lg bg-indigo-700 text-white font-medium hover:bg-indigo-800 shadow-md transition">
                        Update Schedule
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>


<?php foreach($allSchedules as $sched): ?>
<div id="cloneSpecialScheduleModal<?= $sched['specialScheduleID'] ?>" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg border border-indigo-200 overflow-hidden">
            
            <div class="flex justify-between items-center p-5 bg-yellow-600">
                <h3 class="text-lg font-semibold text-white">Clone Special Schedule</h3>
                <button type="button" data-modal-hide="cloneSpecialScheduleModal<?= $sched['specialScheduleID'] ?>"
                        class="text-white hover:bg-yellow-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">✕</button>
            </div>

            <div class="p-6 text-indigo-900">
                <p>Are you sure you want to clone "<strong><?= htmlspecialchars($sched['eventName']) ?></strong>"?</p>
                
                <form action="../routes/specialsched.php" method="POST" class="mt-4 flex justify-end gap-3">
                    <input type="hidden" name="specialScheduleID" value="<?= $sched['specialScheduleID'] ?>">
                    <button type="button" data-modal-hide="cloneSpecialScheduleModal<?= $sched['specialScheduleID'] ?>" 
                            class="px-4 py-2 rounded-lg border border-yellow-400 text-yellow-700 hover:bg-yellow-50 transition">
                        Cancel
                    </button>
                    <button type="submit" name="cloneSpecialSchedule" 
                            class="px-4 py-2 rounded-lg bg-yellow-600 text-white hover:bg-yellow-700 shadow-md transition">
                        Clone
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
<?php endforeach; ?>




<script>
    document.querySelectorAll('.deleteBtnid').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        Swal.fire({
            title: 'Remove this Schedule?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = '../routes/specialsched.php?deleteSpecial=' + id;
            }
        });
    });
});
</script>

    <script src="../javascript/sidebar.js">

    </script>
</body>
</html>
