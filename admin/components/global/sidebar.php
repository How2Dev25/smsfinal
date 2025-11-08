  <style>
        :root {
            --primary: #4f46e5;
            --secondary: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }
        
        .sidebar {
            transition: all 0.3s;
        }
        
        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .progress-bar {
            height: 6px;
            border-radius: 3px;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            animation: pulse 1.5s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .glow-on-hover:hover {
            filter: drop-shadow(0 0 8px rgba(79, 70, 229, 0.3));
        }
        
        .floating-btn {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }
        
        .activity-item {
            transition: all 0.2s;
        }
        
        .activity-item:hover {
            background-color: rgba(249, 250, 251, 0.8);
            transform: translateX(5px);
        }
        
        .sidebar-item {
            transition: all 0.2s;
        }
        
        .sidebar-item:hover {
            background-color: rgba(79, 70, 229, 0.1);
        }
        
        .sidebar-item.active {
            background-color: rgba(79, 70, 229, 0.1);
            color: var(--primary);
            font-weight: 500;
        }
    </style>

<div class="sidebar bg-white w-64 px-4 py-6 flex flex-col justify-between border-r overflow-y-auto">
            <div>
                <!-- Logo -->
                <div class="flex items-center justify-center mb-8">
                    <h4 class="font-bold">Student Management System</h4>
                    <img src="../sms.png" alt="" class="h-20  ">
                </div>
                
                <!-- Menu -->
                <nav>
                    <div class="mb-4">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-2 mb-1">Main</p>
                        <a href="dashboard.php" class="flex items-center px-2 py-3 bg-indigo-50 rounded-lg text-indigo-700 font-medium">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-2 mb-1">Management</p>
                        <a href="sectionassignment.php" class="flex items-center px-2 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                            <i class="fas fa-user-graduate mr-3 w-5 text-center"></i>
                            Section Assignment Tool
                        </a>
                        <a href="teachershedmap.php" class="flex items-center px-2 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                            <i class="fas fa-clipboard-list mr-3 w-5 text-center"></i>
                            Teacher Schedule Mapping
                        </a>
                        
                        <a href="examtimetable.php" class="flex items-center px-2 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                            <i class="fas fa-certificate mr-3 w-5 text-center"></i>
                            Exam Timetable Generator
                        </a>
                        <a href="../cons/sat.html" class="flex items-center px-2 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                            <i class="fas fa-certificate mr-3 w-5 text-center"></i>
                            Substitute Assignment Tracker
                        </a>
                        <a href="../cons/specialss.html" class="flex items-center px-2 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                            <i class="fas fa-book mr-3 w-5 text-center"></i>
                            Special Class Scheduler
                        </a>
                        <a href="roomavailability.php" class="flex items-center px-2 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                            <i class="fas fa-book mr-3 w-5 text-center"></i>
                            Room Availability Checker
                        </a>
                        <a href="../cons/schedule.html" class="flex items-center px-2 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                            <i class="fas fa-book mr-3 w-5 text-center"></i>
                            Schedule Cloning Tool
                        </a>
                        <a href="../cons/timeblock.html" class="flex items-center px-2 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                            <i class="fas fa-book mr-3 w-5 text-center"></i>
                            Time Block Customizer
                        </a>
                        <a href="../cons/calendar.html" class="flex items-center px-2 py-2 text-gray-700 hover:bg-gray-100 rounded-lg mb-1">
                            <i class="fas fa-book mr-3 w-5 text-center"></i>
                            Calendar Integration
                        </a>
                    </div>
                    
            </div>
            
            <!-- User Profile -->
           <div class="flex items-center justify-between p-3 bg-blue-600 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200">
  <!-- Profile Info -->
  <div class="flex items-center space-x-3">
    <img
      src="../uploads/users/<?php echo htmlspecialchars($authUser['photo']) ?>"
      alt="Profile picture of <?php echo htmlspecialchars($authUser['username']) ?>"
      class="w-10 h-10 rounded-full object-cover border border-gray-300"
    >
    <div>
      <p class="text-sm font-semibold text-white">
        <?php echo htmlspecialchars($authUser['username']) ?>
      </p>
      <p class="text-xs text-white">
        <?php echo htmlspecialchars($authUser['role']) ?>
      </p>
    </div>
  </div>

  <!-- Logout Button -->
  <a href="../routes/logout.php"
     class="text-white hover:text-blue-200 transition-colors duration-200"
     title="Logout">
    <i class="fas fa-sign-out-alt text-lg"></i>
  </a>
</div>
        </div>