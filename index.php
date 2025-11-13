<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Management System</title>
  <link rel="icon" type="image/png" href="img/sms.png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(-30px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .float-animation {
      animation: float 3s ease-in-out infinite;
    }

    .fade-in-up {
      animation: fadeInUp 0.8s ease-out forwards;
    }

    .slide-in {
      animation: slideIn 0.8s ease-out forwards;
    }

    .nav-link-hover {
      position: relative;
    }

    .nav-link-hover::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: -4px;
      left: 50%;
      background: #3b82f6;
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }

    .nav-link-hover:hover::after {
      width: 100%;
    }

    .gradient-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .feature-card {
      transition: all 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-10px);
    }

    .stat-counter {
      font-size: 3rem;
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .stat-counter {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body class="bg-gray-50">

<!-- Navbar -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md shadow-md border-b-2 border-blue-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-20">
      <!-- Logo & Brand -->
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-lg">
          <img src="img/sms.png" alt="SMS Logo" class="w-10 h-10 object-contain">
        </div>
        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent hidden sm:block">
          Student Management System
        </span>
        <span class="text-lg font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent sm:hidden">
          SMS
        </span>
      </div>

      <!-- Desktop Navigation -->
      <div class="hidden lg:flex items-center gap-8">
        <a href="#" class="nav-link-hover text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-200">Home</a>
        <a href="#features" class="nav-link-hover text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-200">Features</a>
        <a href="#benefits" class="nav-link-hover text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-200">Benefits</a>
        <a href="#testimonials" class="nav-link-hover text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-200">Testimonials</a>
        <a href="#about-us" class="nav-link-hover text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-200">About Us</a>
        <a href="#contact" class="nav-link-hover text-gray-700 hover:text-blue-600 font-semibold transition-colors duration-200">Contact</a>
      </div>

      <!-- CTA Button (Desktop) -->
      <div class="hidden lg:block">
        <a href="login.php" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center gap-2">
          <span>Sign In</span>
          <i class="fas fa-arrow-right text-sm"></i>
        </a>
      </div>

      <!-- Mobile Menu Button -->
      <button id="mobile-menu-btn" class="lg:hidden w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center hover:bg-blue-200 transition-colors">
        <i class="fas fa-bars text-blue-600 text-xl"></i>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200 shadow-lg">
    <div class="px-4 py-6 space-y-4">
      <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg font-semibold transition-all">
        <i class="fas fa-home w-6 text-blue-600"></i> Home
      </a>
      <a href="#features" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg font-semibold transition-all">
        <i class="fas fa-star w-6 text-blue-600"></i> Features
      </a>
      <a href="#benefits" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg font-semibold transition-all">
        <i class="fas fa-trophy w-6 text-blue-600"></i> Benefits
      </a>
      <a href="#testimonials" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg font-semibold transition-all">
        <i class="fas fa-comments w-6 text-blue-600"></i> Testimonials
      </a>
      <a href="#about-us" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg font-semibold transition-all">
        <i class="fas fa-info-circle w-6 text-blue-600"></i> About Us
      </a>
      <a href="#contact" class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg font-semibold transition-all">
        <i class="fas fa-envelope w-6 text-blue-600"></i> Contact
      </a>
      <a href="login.php" class="block px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-full shadow-lg text-center hover:shadow-xl transform hover:scale-105 transition-all">
        Get Started <i class="fas fa-arrow-right ml-2"></i>
      </a>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center pt-20 overflow-hidden bg-gradient-to-br from-blue-50 via-white to-indigo-50">
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-400 rounded-full opacity-10 float-animation"></div>
    <div class="absolute top-1/2 -left-40 w-96 h-96 bg-indigo-400 rounded-full opacity-10 float-animation" style="animation-delay: 1s;"></div>
    <div class="absolute bottom-20 right-1/4 w-64 h-64 bg-purple-400 rounded-full opacity-10 float-animation" style="animation-delay: 2s;"></div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="slide-in">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
          Welcome to <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Student Management System</span>
        </h1>
        <p class="text-xl text-gray-600 mb-8">
          Manage students, faculty, and school operations seamlessly — all in one easy-to-use platform.
        </p>
        <div class="flex flex-col sm:flex-row gap-4">
          <a href="login.php" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all text-center">
            Get Started <i class="fas fa-arrow-right ml-2"></i>
          </a>
          <a href="#features" class="px-8 py-4 bg-white border-2 border-blue-600 text-blue-600 font-semibold rounded-full shadow-md hover:bg-blue-50 transition-all text-center">
            Learn More
          </a>
        </div>
      </div>
    
    </div>
  </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-gradient-to-r from-blue-600 to-indigo-600">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
      <div class="fade-in-up">
        <div class="stat-counter">5K+</div>
        <p class="text-lg opacity-90">Active Students</p>
      </div>
      <div class="fade-in-up" style="animation-delay: 0.1s;">
        <div class="stat-counter">200+</div>
        <p class="text-lg opacity-90">Faculty Members</p>
      </div>
      <div class="fade-in-up" style="animation-delay: 0.2s;">
        <div class="stat-counter">50+</div>
        <p class="text-lg opacity-90">Classrooms</p>
      </div>
      <div class="fade-in-up" style="animation-delay: 0.3s;">
        <div class="stat-counter">100%</div>
        <p class="text-lg opacity-90">Satisfaction Rate</p>
      </div>
    </div>
  </div>
</section>

<!-- Core Features Section -->
<section id="features" class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Core Features</h2>
      <p class="text-xl text-gray-600">Explore what our Student Management System offers</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
      <!-- Feature 1 -->
      <div class="feature-card bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-100 hover:border-blue-300 hover:shadow-xl">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mb-4">
          <i class="fas fa-user-graduate text-2xl text-white"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Enrollment</h3>
        <p class="text-gray-600 text-sm">Student registration made simple and efficient.</p>
      </div>

      <!-- Feature 2 -->
      <div class="feature-card bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-100 hover:border-blue-300 hover:shadow-xl">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mb-4">
          <i class="fas fa-book-open text-2xl text-white"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Subjects</h3>
        <p class="text-gray-600 text-sm">Manage courses and subjects with ease.</p>
      </div>

      <!-- Feature 3 -->
      <div class="feature-card bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-100 hover:border-blue-300 hover:shadow-xl">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mb-4">
          <i class="fas fa-users text-2xl text-white"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Students</h3>
        <p class="text-gray-600 text-sm">View and update student profiles seamlessly.</p>
      </div>

      <!-- Feature 4 -->
      <div class="feature-card bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-100 hover:border-blue-300 hover:shadow-xl">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mb-4">
          <i class="fas fa-chalkboard-teacher text-2xl text-white"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Faculty</h3>
        <p class="text-gray-600 text-sm">Manage faculty members and their classes.</p>
      </div>

      <!-- Feature 5 -->
      <div class="feature-card bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-100 hover:border-blue-300 hover:shadow-xl">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mb-4">
          <i class="fas fa-calendar-alt text-2xl text-white"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Schedule</h3>
        <p class="text-gray-600 text-sm">Efficient class scheduling at your fingertips.</p>
      </div>

      <!-- Feature 6 -->
      <div class="feature-card bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-100 hover:border-blue-300 hover:shadow-xl">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mb-4">
          <i class="fas fa-clipboard-list text-2xl text-white"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Grades</h3>
        <p class="text-gray-600 text-sm">Record and track academic performance.</p>
      </div>

      <!-- Feature 7 -->
      <div class="feature-card bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-100 hover:border-blue-300 hover:shadow-xl">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mb-4">
          <i class="fas fa-user-shield text-2xl text-white"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">User Roles</h3>
        <p class="text-gray-600 text-sm">Manage permissions and access levels.</p>
      </div>

      <!-- Feature 8 -->
      <div class="feature-card bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-100 hover:border-blue-300 hover:shadow-xl">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mb-4">
          <i class="fas fa-bell text-2xl text-white"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Notifications</h3>
        <p class="text-gray-600 text-sm">Stay updated with real-time announcements.</p>
      </div>

      <!-- Feature 9 -->
      <div class="feature-card bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-100 hover:border-blue-300 hover:shadow-xl">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mb-4">
          <i class="fas fa-chart-line text-2xl text-white"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Analytics</h3>
        <p class="text-gray-600 text-sm">Track performance with visual insights.</p>
      </div>

      <!-- Feature 10 -->
      <div class="feature-card bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-100 hover:border-blue-300 hover:shadow-xl">
        <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mb-4">
          <i class="fas fa-cogs text-2xl text-white"></i>
        </div>
        <h3 class="text-lg font-bold text-gray-900 mb-2">Settings</h3>
        <p class="text-gray-600 text-sm">Configure your system preferences easily.</p>
      </div>
    </div>
  </div>
</section>



<!-- About Us Section -->
<section id="about-us" class="py-20 bg-gradient-to-r from-blue-600 to-indigo-600">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid md:grid-cols-2 gap-12 items-center">
      <div class="text-white">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">About Us</h2>
        <p class="text-lg mb-6 opacity-90">
          Our Student Management System is a modern solution designed to make academic and administrative 
          processes simple, efficient, and unified. Built for both educators and learners, we aim to provide 
          a digital space where everything just works — from enrollment to graduation.
        </p>
        <p class="text-lg opacity-90">
          With years of experience in educational technology, we understand the unique challenges schools face 
          in managing student information. That's why we've created a comprehensive platform that adapts to your needs, 
          not the other way around.
        </p>
       
      </div>
      <div class="relative">
        <img src="img/studs.jpg" alt="About Us" class="rounded-2xl shadow-2xl w-full">
        <div class="absolute -bottom-6 -right-6 w-full h-full bg-white/20 rounded-2xl -z-10"></div>
      </div>
    </div>
  </div>
</section>

<!-- Contact Us Section -->
<section id="contact" class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-16">
      <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Contact Us</h2>
      <p class="text-xl text-gray-600">Get in touch with our team</p>
    </div>

    <div class="grid md:grid-cols-2 gap-12">
      <!-- Contact Information -->
      <div class="space-y-6">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
          </div>
          <div>
            <h3 class="font-bold text-gray-900 text-lg mb-2">Address</h3>
            <p class="text-gray-600">Bestlink College of the Philippines, Quirino Highway, Quezon City, Metro Manila</p>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fas fa-phone text-blue-600 text-xl"></i>
          </div>
          <div>
            <h3 class="font-bold text-gray-900 text-lg mb-2">Contact Number</h3>
            <p class="text-gray-600">(02) 1234-5678</p>
            <p class="text-gray-600">0917-123-4567</p>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fas fa-envelope text-blue-600 text-xl"></i>
          </div>
          <div>
            <h3 class="font-bold text-gray-900 text-lg mb-2">Email</h3>
            <p class="text-gray-600">sms.support@bestlink.edu.ph</p>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fas fa-clock text-blue-600 text-xl"></i>
          </div>
          <div>
            <h3 class="font-bold text-gray-900 text-lg mb-2">Office Hours</h3>
            <p class="text-gray-600">Monday - Friday</p>
            <p class="text-gray-600">8:00 AM to 5:00 PM</p>
          </div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 border-2 border-blue-100">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Send us a message</h3>
        <form class="space-y-4">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
            <input type="text" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition-colors" placeholder="Enter your name">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
            <input type="email" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition-colors" placeholder="your@email.com">
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
            <textarea rows="4" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:outline-none transition-colors resize-none" placeholder="How can we help you?"></textarea>
          </div>
          <button type="submit" class="w-full px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
            Send Message <i class="fas fa-paper-plane ml-2"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->


<!-- Footer Section -->
<footer class="bg-gray-900 text-white py-12">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid md:grid-cols-4 gap-8 mb-8">
      <!-- Company Info -->
      <div class="col-span-2">
        <div class="flex items-center gap-3 mb-4">
          <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center">
            <img src="img/sms.png" alt="SMS Logo" class="w-10 h-10 object-contain">
          </div>
          <span class="text-xl font-bold">School Management System</span>
        </div>
        <p class="text-gray-400 mb-4">Empowering education through innovative technology. Making school management simple, efficient, and accessible for everyone.</p>
        <div class="flex gap-4">
          <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
            <i class="fab fa-instagram"></i>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div>
        <h4 class="font-bold text-lg mb-4">Quick Links</h4>
        <ul class="space-y-2">
          <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Home</a></li>
          <li><a href="#features" class="text-gray-400 hover:text-blue-400 transition-colors">Features</a></li>
          <li><a href="#about-us" class="text-gray-400 hover:text-blue-400 transition-colors">About Us</a></li>
          <li><a href="#contact" class="text-gray-400 hover:text-blue-400 transition-colors">Contact</a></li>
        </ul>
      </div>

      <!-- Resources -->
      <div>
        <h4 class="font-bold text-lg mb-4">Resources</h4>
        <ul class="space-y-2">
          <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Documentation</a></li>
          <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Help Center</a></li>
          <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Privacy Policy</a></li>
          <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">Terms of Service</a></li>
        </ul>
      </div>
    </div>

    <div class="border-t border-gray-800 pt-8 text-center">
      <p class="text-gray-400">&copy; 2025 School Management System. All rights reserved.</p>
    </div>
  </div>
</footer>

<script>
  // Mobile menu toggle
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const menuIcon = mobileMenuBtn.querySelector('i');

  mobileMenuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
    if (mobileMenu.classList.contains('hidden')) {
      menuIcon.classList.remove('fa-times');
      menuIcon.classList.add('fa-bars');
    } else {
      menuIcon.classList.remove('fa-bars');
      menuIcon.classList.add('fa-times');
    }
  });

  // Smooth scroll
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
        // Close mobile menu if open
        mobileMenu.classList.add('hidden');
        menuIcon.classList.remove('fa-times');
        menuIcon.classList.add('fa-bars');
      }
    });
  });

  // Navbar scroll effect
  const navbar = document.querySelector('nav');
  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 50) {
      navbar.classList.add('shadow-xl');
    } else {
      navbar.classList.remove('shadow-xl');
    }
  });

  // Intersection Observer for fade-in animations
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('fade-in-up');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  document.querySelectorAll('.feature-card').forEach(card => {
    observer.observe(card);
  });
</script>

</body>
</html>