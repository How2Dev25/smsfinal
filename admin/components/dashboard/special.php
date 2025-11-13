<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-5">

            <?php
$specialSchedule = new Specialsched();
$allSchedules = $specialSchedule->fetchSpecialSchedules();

// Totals
$totalSpecialSchedules = count($allSchedules);
$makeupClasses = count(array_filter($allSchedules, fn($s) => $s['eventType'] === 'Makeup Class'));
$rescheduledExams = count(array_filter($allSchedules, fn($s) => $s['eventType'] === 'Exam')); // or use a flag if you have
$specialRequests = count(array_filter($allSchedules, fn($s) => !empty($s['remarks'])));
?>

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
