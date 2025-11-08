<?php
// Fetch exam schedules
$exam = new ExamTimetable();
$examSchedules = $exam->fetch();

// Group exams by date
$examsByDate = [];
foreach ($examSchedules as $schedule) {
    if (!empty($schedule['examDate'])) {
        $date = $schedule['examDate'];
        $examsByDate[$date][] = $schedule;
    }
}

// Handle month navigation
$month = isset($_GET['month']) ? intval($_GET['month']) : date('m');
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');

$firstDayOfMonth = strtotime("$year-$month-01");
$daysInMonth = date('t', $firstDayOfMonth);
$startDay = date('N', $firstDayOfMonth);

$prevMonth = date('m', strtotime('-1 month', $firstDayOfMonth));
$prevYear = date('Y', strtotime('-1 month', $firstDayOfMonth));
$nextMonth = date('m', strtotime('+1 month', $firstDayOfMonth));
$nextYear = date('Y', strtotime('+1 month', $firstDayOfMonth));
?>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.calendar-day {
    animation: fadeIn 0.3s ease-out;
}

.exam-item {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.exam-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.nav-button {
    transition: all 0.3s ease;
}

.nav-button:hover {
    transform: translateX(var(--translate-x, 0));
}

.modal-backdrop {
    animation: fadeIn 0.2s ease-out;
}

.modal-content {
    animation: slideIn 0.3s ease-out;
}
</style>

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-white py-8 px-4">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border-t-4 border-blue-500">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-1">Exam Schedule Calendar</h1>
                    <p class="text-gray-500 text-sm">Manage and view all upcoming examinations</p>
                </div>
                <div class="bg-blue-100 rounded-full p-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Month Navigation -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center">
                <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>" 
                   class="nav-button flex items-center gap-2 px-6 py-3 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 font-semibold group"
                   style="--translate-x: -4px">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Previous
                </a>
                
                <h2 class="text-3xl font-bold text-gray-800">
                    <span class="text-blue-600"><?= date('F', $firstDayOfMonth) ?></span> 
                    <span class="text-gray-600"><?= $year ?></span>
                </h2>
                
                <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>" 
                   class="nav-button flex items-center gap-2 px-6 py-3 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 font-semibold group"
                   style="--translate-x: 4px">
                    Next
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Calendar Grid -->
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="grid grid-cols-7 gap-4">
                <!-- Day Headers -->
                <?php foreach (['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day): ?>
                    <div class="text-center py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white font-bold rounded-lg shadow-md">
                        <div class="hidden md:block"><?= $day ?></div>
                        <div class="md:hidden"><?= substr($day, 0, 3) ?></div>
                    </div>
                <?php endforeach; ?>

                <!-- Empty cells before first day -->
                <?php for ($i = 1; $i < $startDay; $i++): ?>
                    <div class="border-2 border-gray-100 rounded-lg h-36 bg-gray-50"></div>
                <?php endfor; ?>

                <!-- Days of the month -->
                <?php for ($day = 1; $day <= $daysInMonth; $day++): 
                    $dateKey = sprintf('%04d-%02d-%02d', $year, $month, $day);
                    $isToday = $dateKey === date('Y-m-d');
                    $hasExams = isset($examsByDate[$dateKey]);
                ?>
                    <div class="calendar-day border-2 <?= $isToday ? 'border-blue-500 bg-blue-50' : 'border-gray-100' ?> rounded-lg h-36 p-2 hover:border-blue-300 transition-all duration-300 hover:shadow-lg relative overflow-hidden group">
                        
                        <!-- Date Number -->
                        <div class="flex justify-between items-start mb-2">
                            <span class="<?= $isToday ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700' ?> font-bold text-sm px-2 py-1 rounded-lg">
                                <?= $day ?>
                            </span>
                            <?php if ($hasExams): ?>
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-semibold animate-pulse">
                                    <?= count($examsByDate[$dateKey]) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Exams List -->
                        <?php if ($hasExams): ?>
                            <div class="space-y-1.5 overflow-y-auto max-h-24">
                                <?php foreach ($examsByDate[$dateKey] as $exam): ?>
                                    <div class="exam-item bg-blue-50 border-2 border-blue-200 rounded-lg px-2 py-1.5 cursor-pointer shadow-md">
                                        <div class="font-bold text-xs truncate text-blue-900">
                                            <?= htmlspecialchars($exam['subjectName']) ?>
                                        </div>
                                        <div class="text-xs text-blue-700 flex items-center gap-1 mt-0.5">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <?php 
                                            if (!empty($exam['startTime']) && !empty($exam['endTime'])) {
                                                echo date("g:i A", strtotime($exam['startTime']));
                                            } else {
                                                echo 'TBA';
                                            }
                                            ?>
                                        </div>
                                        
                                        <!-- Action Buttons -->
                                        <div class="mt-1.5 flex gap-1">
                                            <button data-modal-target="editExamModal<?= $exam['examID'] ?>" 
                                                    data-modal-toggle="editExamModal<?= $exam['examID'] ?>" 
                                                    class="bg-blue-600 text-white px-2 py-0.5 rounded text-xs font-bold hover:bg-blue-700 transition-colors">
                                                Edit
                                            </button>
                                            <button data-id="<?= $schedule['examID'] ?>" class="bg-red-600 text-white px-2 py-0.5 rounded text-xs font-bold hover:bg-red-700 transition-colors deleteBtnid">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Hover Effect Background -->
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-600 opacity-0 group-hover:opacity-5 transition-opacity duration-300 rounded-lg pointer-events-none"></div>
                    </div>
                <?php endfor; ?>

                <!-- Fill empty cells at the end -->
                <?php 
                $totalCells = $startDay - 1 + $daysInMonth;
                $remainingCells = 7 - ($totalCells % 7);
                if ($remainingCells < 7) {
                    for ($i = 0; $i < $remainingCells; $i++) {
                        echo '<div class="border-2 border-gray-100 rounded-lg h-36 bg-gray-50"></div>';
                    }
                }
                ?>
            </div>
        </div>

        <!-- Legend -->
        <div class="mt-6 bg-white rounded-2xl shadow-lg p-4">
            <div class="flex flex-wrap gap-4 justify-center items-center text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-blue-500 rounded"></div>
                    <span class="text-gray-700">Scheduled Exam</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 border-2 border-blue-500 bg-blue-50 rounded"></div>
                    <span class="text-gray-700">Today</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-red-500 text-white text-xs rounded-full flex items-center justify-center font-bold">3</div>
                    <span class="text-gray-700">Number of Exams</span>
                </div>
            </div>
        </div>
    </div>
</div>