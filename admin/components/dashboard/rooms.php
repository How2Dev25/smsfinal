<div class="flex gap-5 max-md:flex-col">
    <div class="w-1/2 max-md:w-full">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

        <?php 
        $roomCounts = new Roomcontroller();
        $roomCounts = $roomCounts->fetchRoomCounts();
        
        ?>
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Rooms</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $roomCounts['totalRooms'] ?></p>
            </div>
            <div class="p-3 bg-blue-100 rounded-full">
                <i class="fas fa-door-open text-blue-500 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Available Rooms</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $roomCounts['availableRooms'] ?></p>
            </div>
            <div class="p-3 bg-green-100 rounded-full">
                <i class="fas fa-check-circle text-green-500 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Occupied Rooms</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $roomCounts['occupiedRooms'] ?></p>
            </div>
            <div class="p-3 bg-red-100 rounded-full">
                <i class="fas fa-users text-red-500 text-xl"></i>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Under Maintenance</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $roomCounts['underMaintenance'] ?></p>
            </div>
            <div class="p-3 bg-yellow-100 rounded-full">
                <i class="fas fa-tools text-yellow-500 text-xl"></i>
            </div>
        </div>
    </div>
     </div>
    </div>

    <div class="flex-1">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

               
            <?php 
            $examTimetable = new ExamTimetable();
            $dashboardData = $examTimetable->fetchtimetableCounts();
            ?>

    <!-- Total Exams Card -->
 

    <!-- Upcoming Exams Card -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Upcoming Exams</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $dashboardData['upcomingExams'] ?></p>
            </div>
            <div class="p-3 bg-purple-100 rounded-full">
                <i class="fas fa-calendar-alt text-purple-500 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-xs font-medium text-green-500 bg-green-100 px-2 py-1 rounded-full">
                <i class="fas fa-arrow-up mr-1"></i> 
            </span>
        </div>
    </div>

    <!-- Exam Rooms Card -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Available Rooms</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?=  $dashboardData['availableRooms'] ?> </p>
            </div>
            <div class="p-3 bg-green-100 rounded-full">
                <i class="fas fa-door-open text-green-500 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-xs font-medium text-green-500 bg-green-100 px-2 py-1 rounded-full">
                <i class="fas fa-arrow-up mr-1"></i> 
            </span>
        </div>
    </div>

    <!-- Assigned Proctors Card -->
      </div>

      <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500 mt-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Assigned Proctors</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?=  $dashboardData['assignedProctors'] ?></p>
            </div>
            <div class="p-3 bg-yellow-100 rounded-full">
                <i class="fas fa-user-tie text-yellow-500 text-xl"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-xs font-medium text-green-500 bg-green-100 px-2 py-1 rounded-full">
                <i class="fas fa-arrow-up mr-1"></i> 
            </span>
        </div>
    </div>
           
    </div>

</div>         
