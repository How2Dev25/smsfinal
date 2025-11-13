     <style>
        :root {
            --primary: #1e3a8a;
            --primary-dark: #1e40af;
            --secondary: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }
        
        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .content-transition {
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .animate-slide-in {
            animation: slideIn 0.3s ease-out forwards;
        }
        
        .menu-item {
            transition: all 0.2s ease;
        }
        
        .menu-item:hover {
            transform: translateX(4px);
        }
        
        @keyframes pulse-soft {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .notification-badge {
            animation: pulse-soft 2s infinite;
        }
        
        /* Collapsed sidebar - smaller width */
        .collapsed-sidebar {
            width: 4.5rem !important;
        }
        
        .collapsed-sidebar .sidebar-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
            visibility: hidden;
        }
        
        .collapsed-sidebar .logo-text {
            opacity: 0;
            width: 0;
            visibility: hidden;
        }

        /* Profile collapsed state - show only image */
        .collapsed-sidebar .profile-details {
            opacity: 0;
            width: 0;
            overflow: hidden;
            visibility: hidden;
        }

        .collapsed-sidebar .profile-footer {
            padding: 0.75rem !important;
            justify-content: center !important;
        }

        .collapsed-sidebar .profile-content {
            justify-content: center !important;
        }

        .collapsed-sidebar .logout-btn {
            display: none !important;
        }

        /* Keep toggle button visible when collapsed */
        #collapse-btn {
            min-width: 32px;
            min-height: 32px;
        }
        
        .tooltip {
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.2s;
            z-index: 1000;
            pointer-events: none;
        }
        
        .collapsed-sidebar .menu-item:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }

        /* Scrollbar styling */
        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }
        
        .scrollbar-thin::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: #1e3a8a30;
            border-radius: 10px;
        }
        
        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: #1e3a8a60;
        }

        /* Ensure main content doesn't overflow */
        #main-content {
            max-width: 100%;
            overflow-x: hidden;
        }

        /* Custom dark blue gradient */
        .bg-dark-blue {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        }

        /* Disable horizontal scroll on sidebar */
        #sidebar {
            overflow-x: hidden;
        }

        #sidebar nav {
            overflow-x: hidden;
        }

        /* Smooth transitions */
        .sidebar-text, .logo-text, .profile-details {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Section header hide on collapse */
        .collapsed-sidebar .section-header {
            opacity: 0;
            visibility: hidden;
            height: 0;
            margin: 0;
        }

        /* Center icons when collapsed */
        .collapsed-sidebar .menu-item {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        /* Hide search when collapsed */
        .collapsed-sidebar #search-wrapper {
            opacity: 0;
            height: 0;
            overflow: hidden;
            margin: 0;
        }

        /* Profile image hover effect */
        .profile-img {
            transition: transform 0.2s ease;
        }

        .profile-img:hover {
            transform: scale(1.05);
        }
    </style>
   
   
   <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-dark-blue text-white rounded-lg shadow-lg hover:opacity-90 transition-all">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Overlay for mobile -->
        <div id="sidebar-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden transition-opacity"></div>

        <!-- Sidebar -->
          <aside id="sidebar" class="sidebar-transition fixed top-0 left-0 h-screen bg-white shadow-2xl z-40 w-64 -translate-x-full lg:translate-x-0 flex flex-col border-r border-gray-200">
        <!-- Header -->
        <div class="p-4 bg-dark-blue border-b border-blue-950">
            <div class="flex items-center justify-between mb-3">
                <div class="flex  items-center space-x-3 flex-1 min-w-0">
                    <div class="bg-white rounded">
                    <img src="../sms.png" alt="Logo" class="w-10 h-10 object-contain flex-shrink-0 logo-icon">
                    </div>
                    <div class="logo-text overflow-hidden">
                        <h4 class="font-bold text-white text-base leading-tight whitespace-nowrap">Class<br>Scheduler<br>System</h4>
                    </div>
                </div>
                <!-- Desktop Toggle -->
                <button id="collapse-btn" class="hidden lg:block p-2 hover:bg-white/10 rounded-lg transition-colors flex-shrink-0">
                    <i class="fas fa-angles-left text-white text-sm"></i>
                </button>
                <!-- Mobile Close -->
                <button id="mobile-close-btn" class="lg:hidden p-2 hover:bg-white/10 rounded-lg transition-colors flex-shrink-0">
                    <i class="fas fa-times text-white text-sm"></i>
                </button>
            </div>
            
            <!-- Search Bar -->
            <div class="relative sidebar-text" id="search-wrapper">
                <input type="text" id="menu-search" placeholder="Search menu..." class="w-full px-3 py-2 pl-9 text-xs border border-blue-800 bg-blue-900/20 text-white placeholder-blue-200 rounded-lg focus:ring-2 focus:ring-white focus:border-white transition-all">
                <i class="fas fa-search absolute left-3 top-2.5 text-blue-200 text-xs"></i>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto px-3 py-4 scrollbar-thin">
            <!-- Main Section -->
            <div class="mb-4 animate-slide-in">
                <p class="sidebar-text section-header text-xs font-semibold text-gray-400 uppercase tracking-wider px-2 mb-2">Main</p>
                <a href="dashboard.php" class="menu-item flex items-center px-3 py-2.5 bg-dark-blue rounded-lg text-white font-medium shadow-sm hover:shadow-md relative group">
                    <i class="fas fa-tachometer-alt mr-3  w-5 text-center text-white"></i>
                    <span class="sidebar-text text-sm text-white">Dashboard</span>
                    <div class="tooltip absolute left-full ml-2 px-2.5 py-1.5 bg-gray-900 text-white text-xs rounded-lg whitespace-nowrap shadow-lg">
                        Dashboard
                    </div>
                </a>
            </div>
            
            <!-- Management Section -->
            <div class="mb-4 animate-slide-in" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between px-2 mb-2">
                    <p class="sidebar-text section-header text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</p>
                    <button class="sidebar-text text-gray-400 hover:text-blue-900" onclick="toggleSection('management')">
                        <i id="management-icon" class="fas fa-chevron-down text-xs transition-transform"></i>
                    </button>
                </div>
                <div id="management-section" class="space-y-1">
                    <a href="sectionassignment.php" class="menu-item flex items-center px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900 rounded-lg group relative">
                        <i class="fas fa-user-graduate mr-3 w-5 text-center text-sm"></i>
                        <span class="sidebar-text text-sm">Section Assignment</span>
                        <div class="tooltip absolute left-full ml-2 px-2.5 py-1.5 bg-gray-900 text-white text-xs rounded-lg whitespace-nowrap shadow-lg">
                            Section Assignment Tool
                        </div>
                    </a>
                    <a href="teachershedmap.php" class="menu-item flex items-center px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900 rounded-lg group relative">
                        <i class="fas fa-clipboard-list mr-3 w-5 text-center text-sm"></i>
                        <span class="sidebar-text text-sm">Schedule Mapping</span>
                        <div class="tooltip absolute left-full ml-2 px-2.5 py-1.5 bg-gray-900 text-white text-xs rounded-lg whitespace-nowrap shadow-lg">
                            Teacher Schedule Mapping
                        </div>
                    </a>
                    <a href="examtimetable.php" class="menu-item flex items-center px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900 rounded-lg group relative">
                        <i class="fas fa-calendar-alt mr-3 w-5 text-center text-sm"></i>
                        <span class="sidebar-text text-sm">Exam Timetable</span>
                        
                        <div class="tooltip absolute left-full ml-2 px-2.5 py-1.5 bg-gray-900 text-white text-xs rounded-lg whitespace-nowrap shadow-lg">
                            Exam Timetable Generator
                        </div>
                    </a>
                    <a href="subtitute.php" class="menu-item flex items-center px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900 rounded-lg group relative">
                        <i class="fas fa-user-clock mr-3 w-5 text-center text-sm"></i>
                        <span class="sidebar-text text-sm">Substitute Tracker</span>
                        <div class="tooltip absolute left-full ml-2 px-2.5 py-1.5 bg-gray-900 text-white text-xs rounded-lg whitespace-nowrap shadow-lg">
                            Substitute Assignment Tracker
                        </div>
                    </a>
                </div>
            </div>
            
            <!-- Tools Section -->
            <div class="mb-4 animate-slide-in" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between px-2 mb-2">
                    <p class="sidebar-text section-header text-xs font-semibold text-gray-400 uppercase tracking-wider">Tools</p>
                    <button class="sidebar-text text-gray-400 hover:text-blue-900" onclick="toggleSection('tools')">
                        <i id="tools-icon" class="fas fa-chevron-down text-xs transition-transform"></i>
                    </button>
                </div>
                <div id="tools-section" class="space-y-1">
                    <a href="specialsched.php" class="menu-item flex items-center px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900 rounded-lg group relative">
                        <i class="fas fa-chalkboard-teacher mr-3 w-5 text-center text-sm"></i>
                        <span class="sidebar-text text-sm">Special Scheduler</span>
                        <div class="tooltip absolute left-full ml-2 px-2.5 py-1.5 bg-gray-900 text-white text-xs rounded-lg whitespace-nowrap shadow-lg">
                            Special Class Scheduler
                        </div>
                    </a>
                    <a href="roomavailability.php" class="menu-item flex items-center px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900 rounded-lg group relative">
                        <i class="fas fa-door-open mr-3 w-5 text-center text-sm"></i>
                        <span class="sidebar-text text-sm">Room Checker</span>
                        <div class="tooltip absolute left-full ml-2 px-2.5 py-1.5 bg-gray-900 text-white text-xs rounded-lg whitespace-nowrap shadow-lg">
                            Room Availability Checker
                        </div>
                    </a>
                   
                    <a href="../cons/timeblock.html" class="menu-item flex items-center px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900 rounded-lg group relative">
                        <i class="fas fa-clock mr-3 w-5 text-center text-sm"></i>
                        <span class="sidebar-text text-sm">Time Blocks</span>
                        <div class="tooltip absolute left-full ml-2 px-2.5 py-1.5 bg-gray-900 text-white text-xs rounded-lg whitespace-nowrap shadow-lg">
                            Time Block Customizer
                        </div>
                    </a>
                    <a href="../cons/calendar.html" class="menu-item flex items-center px-3 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-900 rounded-lg group relative">
                        <i class="fas fa-calendar-check mr-3 w-5 text-center text-sm"></i>
                        <span class="sidebar-text text-sm">Calendar Sync</span>
                        <div class="tooltip absolute left-full ml-2 px-2.5 py-1.5 bg-gray-900 text-white text-xs rounded-lg whitespace-nowrap shadow-lg">
                            Calendar Integration
                        </div>
                    </a>
                </div>
            </div>
        </nav>

        <!-- User Profile Footer -->
        <div class="profile-footer p-3 border-t border-gray-200 bg-gray-50">
            <div class="profile-content flex items-center justify-between p-3 bg-dark-blue rounded-lg shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer group">
                <div class="flex items-center space-x-3">
                    <div class="relative flex-shrink-0">
                        <img src="../uploads/users/<?php echo htmlspecialchars($authUser['photo']) ?>" alt="Profile" class="profile-img w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm">
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-400 border-2 border-white rounded-full"></span>
                    </div>
                    <div class="profile-details">
                        <p class="text-sm font-semibold text-white leading-tight"><?php echo htmlspecialchars($authUser['username']) ?></p>
                        <p class="text-xs text-blue-200"><?php echo htmlspecialchars($authUser['role']) ?></p>
                    </div>
                </div>
                <a href="../routes/logout.php" class="logout-btn text-white hover:text-blue-200 transition-colors duration-200 p-1.5 hover:bg-white/10 rounded-lg" title="Logout">
                    <i class="fas fa-sign-out-alt text-base"></i>
                </a>
            </div>
        </div>
    </aside>


        