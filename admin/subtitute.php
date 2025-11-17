<?php
// auth 
include('components/global/auth.php');

// module and controllers

include_once('../controllers/subtituteController.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Section Assignment Tool</title>
  <?php include_once('components/global/header.php') ?>
<style>
  :root {
    --primary: #4f46e5;
    --secondary: #10b981;
  }
  .sidebar { transition: all 0.3s; }
  tr.selected { background-color: #dbeafe; }
  @media print {
    body * { visibility: hidden; }
    #certificateContent, #certificateContent * { visibility: visible; }
    #certificateContent { position: absolute; top: 0; left: 0; width: 100%; }
  }
  .certificate {
    width: 100%;
    max-width: 800px;
    margin: 20px auto;
    padding: 40px;
    border: 5px solid var(--primary);
    text-align: center;
    position: relative;
    background: #fff;
  }
  .certificate table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  .certificate table, .certificate th, .certificate td {
    border: 1px solid #333;
  }
  .certificate th, .certificate td {
    padding: 6px;
    text-align: center;
    font-size: 0.9rem;
  }
</style>
</head>
<body class="bg-white font-sans">
    <section class="flex h-screen overflow-hidden">
      <?php include_once('components/global/sidebar.php') ?>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white content-transition lg:ml-72" id="main-content">
           <section class="min-h-screen p-4 sm:p-6 lg:p-8 transition-all duration-300">
    <div class="flex-1 overflow-auto p-6 max-w-7xl mx-auto space-y-6">

        <!-- Page Title -->
        <div class="mb-8 bg-gradient-to-r from-blue-50 to-white rounded-xl shadow-lg p-6 sm:p-8 border border-blue-100">
            <h1 class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">Substitute Tracker</h1>
            <p class="text-gray-600">Track teacher substitutes and their assignments.</p>
        </div>

        <!-- Dashboard Cards -->
       <?php 
$subController = new SubtituteController();
$summary = $subController->getSubstituteSummary();
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Total Substitutes -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Substitutes</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $summary['total'] ?></p>
            </div>
            <div class="p-3 bg-blue-100 rounded-full">
                <i class="fas fa-user-clock text-blue-500 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Morning Substitutes -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Morning</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $summary['morning'] ?></p>
            </div>
            <div class="p-3 bg-green-100 rounded-full">
                <i class="fas fa-sun text-green-500 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Afternoon Substitutes -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Afternoon</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $summary['afternoon'] ?></p>
            </div>
            <div class="p-3 bg-yellow-100 rounded-full">
                <i class="fas fa-cloud-sun text-yellow-500 text-xl"></i>
            </div>
        </div>
    </div>

    <!-- Status Cards: Pending, Assigned, Completed -->


</div>

 <div class="grid grid-cols-3 gap-2">
        <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-yellow-500">
            <p class="text-sm font-medium text-gray-500">Pending</p>
            <p class="text-lg font-bold text-gray-800 mt-1"><?= $summary['pending'] ?></p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-blue-500">
            <p class="text-sm font-medium text-gray-500">Assigned</p>
            <p class="text-lg font-bold text-gray-800 mt-1"><?= $summary['assigned'] ?></p>
        </div>
        <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-green-500">
            <p class="text-sm font-medium text-gray-500">Completed</p>
            <p class="text-lg font-bold text-gray-800 mt-1"><?= $summary['completed'] ?></p>
        </div>
    </div>



        <!-- Substitute Table -->
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Substitute List</h2>
                <button 
                    data-modal-target="createSubModal" 
                    data-modal-toggle="createSubModal"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                    + Add Substitute
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead class="bg-blue-600 text-white uppercase text-sm">
                        <tr>
                            <th class="px-6 py-3 text-left">Teacher Name</th>
                            <th class="px-6 py-3 text-left">Date</th>
                            <th class="px-6 py-3 text-left">Period</th>
                            <th class="px-6 py-3 text-left">Subject</th>
                            <th class="px-6 py-3 text-left">Assigned Teacher</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                  <tbody class="divide-y divide-gray-200 text-gray-800">

<?php 
    $subs = new SubtituteController();
    $subs = $subs->getAllAssignedAssignments();
?>

<?php foreach ($subs as $sub): ?>

    <?php  
        // AM or PM
        $period = (strtotime($sub['startTime']) < strtotime("12:00")) ? "AM" : "PM";

        // Format time
        $timeFormatted = date("h:i A", strtotime($sub['startTime'])) . 
                         " - " . 
                         date("h:i A", strtotime($sub['endTime']));

        // Day
        $day = $sub['day']; 
    ?>

    <tr>
        <!-- Original Teacher -->
        <td class="px-6 py-3 font-medium">
            <?= htmlspecialchars($sub['originalTeacherName']) ?>
        </td>

        <!-- Date / Day -->
        <td class="px-6 py-3">
            <?= htmlspecialchars($day) ?>
        </td>

        <!-- AM / PM -->
        <td class="px-6 py-3">
            <?= $period ?>
        </td>

        <!-- Subject + Section + Room -->
        <td class="px-6 py-3">
            <div class="font-semibold"><?= htmlspecialchars($sub['subjectName']) ?></div>
            <div class="text-sm text-gray-500">
                <?= htmlspecialchars($sub['sectionName']) ?> (<?= htmlspecialchars($sub['yearLevel']) ?>) <br>
                Room: <?= htmlspecialchars($sub['roomName']) ?>
            </div>
        </td>

        <!-- Substitute Teacher + Status + Time -->
        <td class="px-6 py-3 text-sm">
            <div class="font-medium text-blue-600">
                Substitute: <?= htmlspecialchars($sub['substituteTeacherName']) ?>
            </div>

            <div class="text-gray-700">Time: <?= $timeFormatted ?></div>

            <div class="text-gray-600">
                Status: 
              <?php
// Map status values to labels and colors
$statusLabels = [
    'pending'   => ['label' => 'Pending', 'color' => 'text-yellow-500'],
    'assigned'  => ['label' => 'Assigned', 'color' => 'text-blue-600'],
    'completed' => ['label' => 'Completed', 'color' => 'text-green-600'],
    'inactive'  => ['label' => 'Inactive', 'color' => 'text-red-600'], // optional
];

// Fallback in case status is not in the mapping
$status = $sub['status'];
$label = isset($statusLabels[$status]) ? $statusLabels[$status]['label'] : ucfirst($status);
$colorClass = isset($statusLabels[$status]) ? $statusLabels[$status]['color'] : 'text-gray-600';
?>

<span class="font-semibold <?= $colorClass ?>">
    <?= $label ?>
</span>
            </div>
        </td>

        <!-- Actions -->
        <td class="px-6 py-3 text-center space-x-2">
            <button 
                data-modal-target="editSubModal_<?= $sub['subAssignmentID'] ?>" 
                data-modal-toggle="editSubModal_<?= $sub['subAssignmentID'] ?>"
                class="text-blue-600 font-medium">
                Edit
            </button>

            <button 
                data-id="<?= $sub['subAssignmentID'] ?>"
                class="text-red-600 font-medium deleteSubBtn">
                Delete
            </button>
        </td>
    </tr>

<?php endforeach ?>

</tbody>
                </table>
            </div>
        </div>

        <!-- Create Substitute Modal -->
        <div id="createSubModal" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
                <h3 class="text-lg font-semibold mb-4">Add Substitute</h3>

                <form action="../routes/subtituteroute.php" method="POST" class="space-y-4">
                    <div>
                        <?php 
                          $schedules = new SubtituteController();
                          $schedules = $schedules->getAllAssignments();  
                        
                        ?>
                        <label class="block font-medium text-sm mb-1">Schedule</label>
                        <select class="w-full p-2 border rounded-lg" name="sectionAssignmentID" id="">
                          <?php foreach ($schedules as $sched): ?>
                                    <option value="<?= $sched['assignmentID'] ?>">
                                        <?= $sched['sectionName'] ?> -
                                        <?= $sched['yearLevel'] ?> -
                                        <?= $sched['roomName'] ?> -
                                        <?= $sched['day'] ?> -
                                        <?= date("g:i A", strtotime($sched['startTime'])) ?> to 
                                        <?= date("g:i A", strtotime($sched['endTime'])) ?> -
                                        <?= $sched['username'] ?>
                                    </option>
                                <?php endforeach ?>
                        </select>
                    </div>
                    <div>
                        <?php 
                            $teacher = new SubtituteController();
                            $teacher = $teacher->getTeacherFromUsers();
                        ?>
                        <label class="block font-medium text-sm mb-1">Subtitute Teacher</label>
                        <select name="substituteTeacherID" class="w-full p-2 border rounded-lg">
                            <?php foreach ($teacher as $teachers): ?>
                            <option value="<?= $teachers['id'] ?>"><?= $teachers['username'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                   
                    <div class="flex justify-end gap-2 mt-4">
                        <button data-modal-hide = "createSubModal" type="button" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Cancel
                        </button>
                        <button name="createSubtitute" type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <?php foreach($subs as $sub): ?>
                <div id="editSubModal_<?= $sub['subAssignmentID'] ?>" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
        <h3 class="text-lg font-semibold mb-4">Edit Substitute</h3>

        <form action="../routes/subtituteroute.php" method="POST" class="space-y-4">
            <!-- Hidden ID -->
            <input type="hidden" name="subAssignmentID" value="<?= $sub['subAssignmentID'] ?>">

            <!-- Select Schedule -->
            <div>
                <label class="block font-medium text-sm mb-1">Schedule</label>
                <select class="w-full p-2 border rounded-lg" name="sectionAssignmentID">
                    <?php 
                        $schedules = new SubtituteController();
                        $schedules = $schedules->getAllAssignments();
                    ?>
                    <?php foreach ($schedules as $sched): ?>
                        <option value="<?= $sched['assignmentID'] ?>" 
                            <?= $sched['assignmentID'] == $sub['sectionAssignmentID'] ? 'selected' : '' ?>>
                            <?= $sched['sectionName'] ?> - <?= $sched['yearLevel'] ?> - <?= $sched['roomName'] ?> -
                            <?= date("g:i A", strtotime($sched['startTime'])) ?> to <?= date("g:i A", strtotime($sched['endTime'])) ?> -
                            <?= $sched['username'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Select Substitute Teacher -->
            <div>
                <label class="block font-medium text-sm mb-1">Substitute Teacher</label>
                <select name="substituteTeacherID" class="w-full p-2 border rounded-lg">
                    <?php 
                        $teachers = new SubtituteController();
                        $teachers = $teachers->getTeacherFromUsers();
                    ?>
                    <?php foreach ($teachers as $teacher): ?>
                        <option value="<?= $teacher['id'] ?>" 
                            <?= $teacher['id'] == $sub['substituteTeacherID'] ? 'selected' : '' ?>>
                            <?= $teacher['username'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Status -->
            <div>
                <label class="block font-medium text-sm mb-1">Status</label>
                <select name="status" class="w-full p-2 border rounded-lg">
                    <option value="Pending" <?= $sub['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Assigned" <?= $sub['status'] == 'Assigned' ? 'selected' : '' ?>>Assigned</option>
                     <option value="Completed" <?= $sub['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" data-modal-hide="editSubModal_<?= $sub['subAssignmentID'] ?>" 
                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Cancel</button>
                <button name="modifySubtitute" type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Save Changes</button>
            </div>
        </form>
    </div>
</div>

        <?php endforeach ?>   

    </div>
</section>

        </main>
    </section>

    <script src="../javascript/sidebar.js">

    </script>
</body>
</html>
