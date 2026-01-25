<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>School Management System</title>
  <link rel="icon" type="image/png" href="../img/sms.png" />
  <link rel="stylesheet" href="../css/sms(1).css">
     <?php include('landingheader.php') ?>
</head>

<?php
// Start session
session_start();





include('connections/connections.php');




// ✅ Handle sign up form submission

?>

<!-- ✅ Optional: Simple success/error display -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
</head>
<body>
    <?php if (!empty($errorMsg)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($errorMsg); ?></p>
    <?php endif; ?>

    <?php if (!empty($successMsg)): ?>
        <p style="color:green;"><?php echo htmlspecialchars($successMsg); ?></p>
    <?php endif; ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="icon" type="image/png" href="sms-logo.png" />
  <title>School Management System - Sign Up</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover p-4 sm:p-5 bg-center bg-no-repeat min-h-screen flex items-center justify-center font-sans"
  style="background-image: linear-gradient(rgba(250, 250, 250, 0.937), rgba(8, 52, 117, 0.942)), url('img.jpg');">

  <div class="bg-white/90 backdrop-blur-md rounded-xl sm:rounded-2xl shadow-lg sm:shadow-2xl max-w-5xl w-full mx-2 sm:mx-4 flex flex-col md:flex-row overflow-hidden border border-gray-200">
    
    <!-- Left panel -->
    <div class="md:w-1/2 p-6 sm:p-8 md:p-10 flex flex-col justify-center items-center bg-blue-50 text-center space-y-4 sm:space-y-5">
      <!-- Image -->
      <div class="w-full flex justify-center">
        <img src="sms.png" alt="School Management System" class="max-w-[200px] sm:max-w-xs md:max-w-sm w-full">
      </div>

      <!-- Headings -->
      <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold sm:font-extrabold text-blue-700 leading-tight px-2">
        SCHOOL MANAGEMENT SYSTEM
      </h2>
      
      <!-- Additional text for mobile -->
      <p class="text-blue-600 text-sm sm:text-base md:hidden mt-2">
        Create your account to get started
      </p>
    </div>

    <!-- Right panel -->
    <div class="md:w-1/2 bg-white p-4 sm:p-6 md:p-8 flex flex-col justify-center">
      <div class="mb-6 md:mb-8 text-center">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-black bg-gradient-to-r from-blue-800 to-blue-600 bg-clip-text text-transparent mb-1">
          CLASS SCHEDULING SYSTEM
        </h1>
        <p class="text-gray-600 text-sm sm:text-base mt-2">Create your administrator account</p>
      </div>
      
      <div class="flex items-center justify-center">
        <div class="w-full max-w-md p-4 sm:p-6 md:p-8">
          <!-- Progress Indicator -->
          <div class="mb-6 md:mb-8">
            <div class="flex justify-between items-center mb-2">
              <span class="text-xs sm:text-sm font-semibold" id="stepIndicator">Step 1 of 2</span>
              <span class="text-xs sm:text-sm text-gray-500" id="stepLabel">Account Details</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5 sm:h-2">
              <div id="progressBar" class="bg-blue-600 h-1.5 sm:h-2 rounded-full transition-all duration-300" style="width: 50%"></div>
            </div>
          </div>

          <!-- Header -->
          <div class="mb-4 sm:mb-6 text-center">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-1 sm:mb-2">Create Account</h2>
            <p class="text-gray-600 text-xs sm:text-sm">Join us today</p>
          </div>

          <form id="signupForm" method="POST" action="routes/userroutes.php" enctype="multipart/form-data">
            <!-- Error/Success Messages -->
            <div id="errorMsg" class="hidden bg-red-50 border border-red-200 text-red-700 px-3 py-2 sm:px-4 sm:py-3 rounded-lg mb-3 sm:mb-4 text-xs sm:text-sm"></div>
            <div id="successMsg" class="hidden bg-green-50 border border-green-200 text-green-700 px-3 py-2 sm:px-4 sm:py-3 rounded-lg mb-3 sm:mb-4 text-xs sm:text-sm"></div>

            <!-- Step 1: Account Details -->
            <div id="step1" class="space-y-4 sm:space-y-5">
              <!-- Username -->
              <div>
                <label for="username" class="block text-gray-700 font-medium sm:font-semibold mb-1 sm:mb-2 text-xs sm:text-sm">Username</label>
                <input
                  type="text"
                  id="username"
                  name="username"
                  placeholder="Choose a username"
                  class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                  required
                />
              </div>

              <!-- Email -->
              <div>
                <label for="email" class="block text-gray-700 font-medium sm:font-semibold mb-1 sm:mb-2 text-xs sm:text-sm">Email Address</label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  placeholder="you@example.com"
                  class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                  required
                />
              </div>

              <!-- Password -->
              <div>
                <label for="password" class="block text-gray-700 font-medium sm:font-semibold mb-1 sm:mb-2 text-xs sm:text-sm">Password</label>
                <div class="relative">
                  <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Create a strong password"
                    class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition pr-10"
                    required
                  />
                  <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 text-sm">
                    Show
                  </button>
                </div>

                <!-- Password Strength Indicator -->
                <div class="mt-2 h-1.5 sm:h-2 bg-gray-200 rounded-full overflow-hidden">
                  <div id="passwordStrengthBar" class="h-1.5 sm:h-2 w-0 bg-red-500 transition-all duration-300"></div>
                </div>

                <!-- Password Notes -->
                <ul id="passwordNotes" class="mt-2 text-xs text-gray-600 space-y-1">
                  <li id="lenNote" class="flex items-center gap-1">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-gray-300 inline-block"></span>
                    At least 8 characters
                  </li>
                  <li id="upperNote" class="flex items-center gap-1">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-gray-300 inline-block"></span>
                    Contains uppercase letter
                  </li>
                  <li id="numNote" class="flex items-center gap-1">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-gray-300 inline-block"></span>
                    Contains a number
                  </li>
                  <li id="specNote" class="flex items-center gap-1">
                    <span class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-gray-300 inline-block"></span>
                    Contains special character (!, @, #, etc.)
                  </li>
                </ul>
              </div>

              <!-- Confirm Password -->
              <div>
                <label for="confirmPassword" class="block text-gray-700 font-medium sm:font-semibold mb-1 sm:mb-2 text-xs sm:text-sm">Confirm Password</label>
                <div class="relative">
                  <input
                    type="password"
                    id="confirmPassword"
                    name="confirmPassword"
                    placeholder="Re-enter your password"
                    class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2 sm:py-2.5 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition pr-10"
                    required
                  />
                  <button type="button" id="toggleConfirmPassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 text-sm">
                    Show
                  </button>
                </div>
                <small id="passwordMatchNote" class="text-xs sm:text-sm mt-1 block"></small>
              </div>

              <!-- Next Button -->
              <div class="pt-1 sm:pt-2">
                <button
                  type="button"
                  id="nextBtn"
                  class="w-full bg-blue-600 text-white font-medium sm:font-semibold py-2.5 sm:py-3 rounded-lg hover:bg-blue-700 transition duration-200 shadow-md hover:shadow-lg text-sm sm:text-base"
                >
                  Next: Add Profile Photo
                </button>
              </div>
            </div>

            <!-- Step 2: Photo Upload -->
            <div id="step2" class="hidden space-y-4 sm:space-y-5">
              <!-- Photo Preview -->
              <div class="flex flex-col items-center">
                <div class="relative mb-3 sm:mb-4">
                  <div id="photoPreview" class="w-24 h-24 sm:w-32 sm:h-32 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden border-4 border-gray-300">
                    <svg class="w-12 h-12 sm:w-16 sm:h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                  </div>
                  <label for="profilePhoto" class="absolute bottom-0 right-0 bg-blue-600 text-white p-1.5 sm:p-2 rounded-full cursor-pointer hover:bg-blue-700 transition shadow-lg">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                  </label>
                </div>
                <p class="text-xs sm:text-sm text-gray-600 mb-1 sm:mb-2">Upload your profile photo</p>
                <p class="text-xs text-gray-500 text-center">(Optional - you can skip this step)</p>
              </div>

              <!-- Hidden File Input -->
              <input
                type="file"
                id="profilePhoto"
                name="photo"
                accept="image/*"
                class="hidden"
              />

              <!-- File Name Display -->
              <div id="fileNameDisplay" class="hidden text-center text-xs sm:text-sm text-gray-600 bg-gray-50 py-1.5 sm:py-2 rounded-lg">
                <span id="fileName" class="truncate px-2 block"></span>
              </div>

              <!-- Buttons -->
              <div class="flex gap-2 sm:gap-3 pt-1 sm:pt-2">
                <button
                  type="button"
                  id="backBtn"
                  class="flex-1 bg-gray-200 text-gray-700 font-medium sm:font-semibold py-2.5 sm:py-3 rounded-lg hover:bg-gray-300 transition duration-200 text-sm sm:text-base"
                >
                  Back
                </button>
                <button
                  type="submit"
                  name="register"
                  class="flex-1 bg-blue-600 text-white font-medium sm:font-semibold py-2.5 sm:py-3 rounded-lg hover:bg-blue-700 transition duration-200 shadow-md hover:shadow-lg text-sm sm:text-base"
                >
                  Complete Sign Up
                </button>
              </div>

              <div class="text-center">
                <button
                  type="submit"
                  name="register"
                  class="text-xs sm:text-sm text-gray-500 hover:text-gray-700 hover:underline transition"
                >
                  Skip for now
                </button>
              </div>
            </div>
          </form>

          <!-- Divider -->
          <div class="relative my-4 sm:my-6">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-xs sm:text-sm">
              <span class="px-2 bg-white text-gray-500">OR</span>
            </div>
          </div>

          <!-- Login Link -->
          <div class="text-center">
            <p class="text-gray-600 text-xs sm:text-sm">
              Already have an account? 
              <a href="login.php" class="text-blue-600 font-medium sm:font-semibold hover:text-blue-700 hover:underline transition">
                Sign in
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // ==========================
    // STEP FORM HANDLING
    // ==========================
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const nextBtn = document.getElementById('nextBtn');
    const backBtn = document.getElementById('backBtn');
    const progressBar = document.getElementById('progressBar');
    const stepIndicator = document.getElementById('stepIndicator');
    const stepLabel = document.getElementById('stepLabel');
    const profilePhotoInput = document.getElementById('profilePhoto');
    const photoPreview = document.getElementById('photoPreview');
    const fileNameDisplay = document.getElementById('fileNameDisplay');
    const fileName = document.getElementById('fileName');

    // Validation for Step 1
    function validateStep1() {
      const username = document.getElementById('username').value.trim();
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirmPassword').value;

      if (!username || !email || !password || !confirmPassword) {
        showError('Please fill in all fields');
        return false;
      }

      if (password.length < 6) {
        showError('Password must be at least 6 characters long');
        return false;
      }

      if (password !== confirmPassword) {
        showError('Passwords do not match');
        return false;
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        showError('Please enter a valid email address');
        return false;
      }

      return true;
    }

    function showError(message) {
      const errorMsg = document.getElementById('errorMsg');
      errorMsg.textContent = message;
      errorMsg.classList.remove('hidden');
      setTimeout(() => {
        errorMsg.classList.add('hidden');
      }, 5000);
    }

    // Next button → Go to Step 2
    nextBtn.addEventListener('click', () => {
      if (validateStep1()) {
        step1.classList.add('hidden');
        step2.classList.remove('hidden');
        progressBar.style.width = '100%';
        stepIndicator.textContent = 'Step 2 of 2';
        stepLabel.textContent = 'Profile Photo';
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    });

    // Back button → Return to Step 1
    backBtn.addEventListener('click', () => {
      step2.classList.add('hidden');
      step1.classList.remove('hidden');
      progressBar.style.width = '50%';
      stepIndicator.textContent = 'Step 1 of 2';
      stepLabel.textContent = 'Account Details';
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Profile photo preview
    profilePhotoInput.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (file) {
        if (!file.type.startsWith('image/')) {
          showError('Please select an image file');
          return;
        }

        // File size check (5MB max)
        const maxSize = 5 * 1024 * 1024; // 5MB
        if (file.size > maxSize) {
          showError('File size must be less than 5MB');
          return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
          photoPreview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
          fileName.textContent = file.name;
          fileNameDisplay.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      }
    });

    // Prevent submitting if step 1 is invalid
    document.getElementById('signupForm').addEventListener('submit', (e) => {
      const currentStep = step1.classList.contains('hidden') ? 2 : 1;
      if (currentStep === 1 && !validateStep1()) {
        e.preventDefault();
      }
    });

    // ==========================
    // PASSWORD TOGGLE + STRENGTH + MATCH CHECK
    // ==========================
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const passwordStrengthBar = document.getElementById('passwordStrengthBar');
    const passwordMatchNote = document.getElementById('passwordMatchNote');

    const lenNote = document.getElementById('lenNote');
    const upperNote = document.getElementById('upperNote');
    const numNote = document.getElementById('numNote');
    const specNote = document.getElementById('specNote');

    // Toggle visibility: Password
    togglePassword?.addEventListener('click', () => {
      const type = passwordInput.type === 'password' ? 'text' : 'password';
      passwordInput.type = type;
      togglePassword.textContent = type === 'password' ? 'Show' : 'Hide';
    });

    // Toggle visibility: Confirm Password
    toggleConfirmPassword?.addEventListener('click', () => {
      const type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
      confirmPasswordInput.type = type;
      toggleConfirmPassword.textContent = type === 'password' ? 'Show' : 'Hide';
    });

    // Strength meter
    passwordInput?.addEventListener('input', () => {
      const value = passwordInput.value;
      const hasLength = value.length >= 8;
      const hasUpper = /[A-Z]/.test(value);
      const hasNumber = /[0-9]/.test(value);
      const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(value);

      updateNote(lenNote, hasLength);
      updateNote(upperNote, hasUpper);
      updateNote(numNote, hasNumber);
      updateNote(specNote, hasSpecial);

      const strength = [hasLength, hasUpper, hasNumber, hasSpecial].filter(Boolean).length;
      const colors = ['red', 'orange', 'yellow', 'blue', 'green'];
      passwordStrengthBar.style.width = `${(strength / 4) * 100}%`;
      passwordStrengthBar.style.backgroundColor = colors[strength] || 'red';
    });

    // Live password match check
    confirmPasswordInput?.addEventListener('input', () => {
      if (!passwordMatchNote) return;
      if (confirmPasswordInput.value === '') {
        passwordMatchNote.textContent = '';
        return;
      }
      if (confirmPasswordInput.value === passwordInput.value) {
        passwordMatchNote.textContent = '✔ Passwords match';
        passwordMatchNote.className = 'text-green-600 text-xs sm:text-sm mt-1 block';
      } else {
        passwordMatchNote.textContent = '✖ Passwords do not match';
        passwordMatchNote.className = 'text-red-600 text-xs sm:text-sm mt-1 block';
      }
    });

    function updateNote(element, condition) {
      const dot = element.querySelector('span');
      if (condition) {
        dot.classList.remove('bg-gray-300');
        dot.classList.add('bg-green-500');
        element.classList.add('text-green-600');
      } else {
        dot.classList.add('bg-gray-300');
        dot.classList.remove('bg-green-500');
        element.classList.remove('text-green-600');
      }
    }

    // Mobile menu toggle (if needed later)
    function toggleMobileMenu() {
      const menu = document.getElementById('mobileMenu');
      menu.classList.toggle('hidden');
    }

    // Add keyboard support for accessibility
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        // Close any open modals or menus
      }
    });
  </script>
</body>
</html>
