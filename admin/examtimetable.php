<?php
// auth 
include('components/global/auth.php');

// module and controllers
include_once('../controllers/timetablecontroller.php')

 
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Exam Timetable</title>
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
<body class="bg-gray-100 font-sans">
<div class="flex h-screen overflow-hidden">


  <!-- Sidebar -->
  <?php 
    include_once('components/global/sidebar.php')
  ?>

<!-- modals alert -->




<!--  -->
 <!-- Main Content Wrapper -->
<div class="flex-1 overflow-auto p-6 max-w-7xl mx-auto space-y-6">

  <!-- ========================================================= -->
  <!-- 🧩 Exam Timetable Table -->
  <!-- ========================================================= -->
  <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b">
      <h2 class="text-xl font-semibold text-gray-800">Exam Timetable</h2>
      <button 
        data-modal-target="createExamModal" 
        data-modal-toggle="createExamModal"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
        + Create Exam
      </button>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full border-collapse">
        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
          <tr>
            <th class="px-6 py-3 text-left">Date</th>
            <th class="px-6 py-3 text-left">Subject</th>
            <th class="px-6 py-3 text-left">Section</th>
            <th class="px-6 py-3 text-left">Room</th>
            <th class="px-6 py-3 text-left">Time</th>
            <th class="px-6 py-3 text-left">Invigilator</th>
            <th class="px-6 py-3 text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 text-gray-800">
          <!-- Example Row -->
           <?php
      $exam = new ExamTimetable();
      $examSchedules = $exam->fetch(); // fetch() should return mysqli_result
                  ?>
                    
                    <?php foreach ($examSchedules as $schedule): ?>
                      <tr>
                     <td class="px-6 py-3">
<?php 
    if (!empty($schedule['examDate'])) {
        // Display day name and full date
        echo date('l, F j, Y', strtotime($schedule['examDate'])); 
        // Example output: Monday, November 10, 2025
    } else {
        echo '-';
    }
?>
</td>
            <td class="px-6 py-3"><?php echo htmlspecialchars($schedule['subjectName']) ?></td>
            <td class="px-6 py-3"><?php echo htmlspecialchars($schedule['sectionName']) ?></td>
            <td class="px-6 py-3"><?php echo htmlspecialchars($schedule['roomName']) ?></td>
            <td class="px-6 py-3">
    <?php 
        if (!empty($schedule['startTime']) && !empty($schedule['endTime'])) {
            echo date("g:i A", strtotime($schedule['startTime'])) . " - " . date("g:i A", strtotime($schedule['endTime']));
        } else {
            echo '-';
        }
    ?>
</td>
            <td class="px-6 py-3"><?php echo htmlspecialchars($schedule['invigilator']) ?></td>
            <td class="px-6 py-3 text-center space-x-2">
              <button data-modal-target="editExamModal<?= $schedule['examID'] ?>" data-modal-toggle="editExamModal<?= $schedule['examID'] ?>" class="text-blue-600 hover:text-blue-800 font-medium">Edit</button>
              <button data-id="<?= $schedule['examID'] ?>" class="text-red-600 hover:text-red-800 font-medium deleteBtnid">Delete</button>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>


  <!-- ========================================================= -->
  <!-- 🧩 Flowbite Modal: Create Exam -->
  <!-- ========================================================= -->
<?php include_once('components/examtimetable/create.php') ?>


<?php foreach ($examSchedules as $schedule): ?>
<div id="editExamModal<?= $schedule['examID'] ?>" tabindex="-1" aria-hidden="true" 
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
            justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">

            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Exam Schedule
                </h3>
                <button type="button" 
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 
                               rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white" 
                        data-modal-hide="editExamModal<?= $schedule['examID'] ?>">
                    ✕
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 space-y-4">
                <form action="../routes/examtimetableroute.php" method="POST" class="space-y-4">
                    <input type="hidden" name="examID" value="<?= $schedule['examID'] ?>">

                    <div>

                    
                        <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Subject</label>
                        <select name="subjectID" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                            <?php foreach ($subject as $subjects): ?>
                                <option value="<?= $subjects['subjectID'] ?>" <?= $subjects['subjectID'] == $schedule['subjectID'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($subjects['subjectName']) ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Section</label>
                        <select name="sectionID" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                            <?php foreach ($section as $sections): ?>
                                <option value="<?= $sections['sectionID'] ?>" <?= $sections['sectionID'] == $schedule['sectionID'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($sections['sectionName']) ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Exam Date</label>
                            <input type="date" name="examDate" value="<?= $schedule['examDate'] ?>" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Room</label>
                            <select name="roomID" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                                <?php foreach ($room as $rooms): ?>
                                    <option value="<?= $rooms['roomID'] ?>" <?= $rooms['roomID'] == $schedule['roomID'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($rooms['roomName']) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Start Time</label>
                            <input type="time" name="startTime" value="<?= $schedule['startTime'] ?>" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">End Time</label>
                            <input type="time" name="endTime" value="<?= $schedule['endTime'] ?>" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Invigilator</label>
                        <select name="invigilatorID" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                            <?php foreach ($teacher as $teachers): ?>
                                <option value="<?= $teachers['id'] ?>" <?= $teachers['id'] == $schedule['invigilatorID'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($teachers['username']) ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b dark:border-gray-700">
                        <button data-modal-hide="editExamModal<?= $schedule['examID'] ?>" type="button" class="text-gray-600 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-4 py-2 mr-2 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                        <button type="submit" name="editExam" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-4 py-2 text-center">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
<?php endforeach; ?>


<?php include_once('components/examtimetable/calendar.php') ?>


</div>


</div>
<script>
document.querySelectorAll('.deleteBtnid').forEach(btn => {
    btn.addEventListener('click', () => { // <-- use btn here, not id
        const id = btn.dataset.id; // get the examID
        Swal.fire({
            title: 'Remove this Exam Schedule?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = '../routes/examtimetableroute.php?deletesched=' + id;
            }
        });
    });
});
</script>




</body>
</html>
