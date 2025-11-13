 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-5">
                              <?php 
            $counts = new counts();
            $counts = $counts->getAllCounts();


        ?>
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