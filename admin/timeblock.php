<?php
// auth 
include('components/global/auth.php');

// module and controllers
include_once('../controllers/timeblockController.php')

 
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Exam Timetable</title>
  <?php include_once('components/global/header.php') ?>

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
                    <h1 class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">Time Block Customizer</h1>
                    <p class="text-gray-600">Manage block schedules used for timetable creation.</p>
                </div>

                <!-- Dashboard Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <?php 
                        $timeblock = new TimeblockController();
                        $blocks = $timeblock->fetchTimeblocksByPeriod();

                        $totalBlocks = count($blocks['AM']) + count($blocks['PM']);
                        $morningBlocks = count($blocks['AM']);
                        $afternoonBlocks = count($blocks['PM']);
                        $inactiveBlocks = 0; // optional, if you track inactive blocks
                        
                        ?>
                    <!-- Total Timeblocks -->
                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Total Timeblocks</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1"><?=  $totalBlocks ?></p>
                            </div>
                            <div class="p-3 bg-blue-100 rounded-full">
                                <i class="fas fa-clock text-blue-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Morning Blocks -->
                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Morning Blocks</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $morningBlocks ?></p>
                            </div>
                            <div class="p-3 bg-green-100 rounded-full">
                                <i class="fas fa-sun text-green-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Afternoon Blocks -->
                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Afternoon Blocks</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1"><?=  $afternoonBlocks ?></p>
                            </div>
                            <div class="p-3 bg-yellow-100 rounded-full">
                                <i class="fas fa-cloud-sun text-yellow-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Inactive Blocks -->
                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Inactive Blocks</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $inactiveBlocks ?></p>
                            </div>
                            <div class="p-3 bg-red-100 rounded-full">
                                <i class="fas fa-ban text-red-500 text-xl"></i>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Timeblock Table -->
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b">
                        <h2 class="text-xl font-semibold text-gray-800">Timeblock List</h2>
                        <button 
                            data-modal-target="createTimeblockModal" 
                            data-modal-toggle="createTimeblockModal"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                            + Create Timeblock
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse">
                            <thead class="bg-blue-600 text-white uppercase text-sm">
                                <tr>
                                    <th class="px-6 py-3 text-left">Block Name</th>
                                    <th class="px-6 py-3 text-left">Start Time</th>
                                    <th class="px-6 py-3 text-left">End Time</th>
                                    <th class="px-6 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-gray-800">
                                <?php 
                                $timeblock = new TimeblockController();
                                $timeblock = $timeblock->fetchtimeblock();
                                
                                ?>
                                <tr>

                                <?php foreach ($timeblock as $time): ?>
                                    <td class="px-6 py-3"><?=  $time['blockName'] ?></td>
                                   <td class="px-6 py-3"><?= date("g:i A", strtotime($time['startTime'])) ?></td>
                                    <td class="px-6 py-3"><?= date("g:i A", strtotime($time['endTime'])) ?></td>
                                    <td class="px-6 py-3 text-center space-x-2">
                                        <button data-modal-target="editModal_<?= $time['timeblockID'] ?>" data-modal-toggle="editModal_<?= $time['timeblockID'] ?>" class="text-blue-600 font-medium">Edit</button>
                                        <button data-id = "<?= $time['timeblockID'] ?>" class="text-red-600 font-medium deleteBtnid">Delete</button>
                                    </td>
                                </tr>
                                <?php endforeach ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Create Timeblock Modal -->
                <div id="createTimeblockModal" tabindex="-1" aria-hidden="true"
                    class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                        <h3 class="text-lg font-semibold mb-4">Create Timeblock</h3>

                        <form action="../routes/timeblockroute.php" method="POST" class="space-y-4">

                            <div>
                                <label class="block font-medium text-sm mb-1">Block Name</label>
                                <input name="blockName" type="text" class="w-full p-2 border rounded-lg" placeholder="e.g., Morning Block 1">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-medium text-sm mb-1">Start Time</label>
                                    <input name="startTime" type="time" class="w-full p-2 border rounded-lg">
                                </div>
                                <div>
                                    <label class="block font-medium text-sm mb-1">End Time</label>
                                    <input name="endTime" type="time" class="w-full p-2 border rounded-lg">
                                </div>
                            </div>

                            <div class="flex justify-end gap-2 mt-4">
                                <button type="button" data-modal-hide="createTimeblockModal"
                                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                                    Cancel
                                </button>
                                <button name="createtimeblock" type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Create
                                </button>
                            </div>

                        </form>
                    </div>
                </div>


                <!-- Edit Modals (Static Example) -->
                <?php foreach ($timeblock as $time): ?>
                <div id="editModal_<?= $time['timeblockID'] ?>" tabindex="-1" class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                        <h3 class="text-lg font-semibold mb-4">Edit Timeblock</h3>

                        <form method="POST" action="../routes/timeblockroute.php" class="space-y-4">
                            <input name="timeblockID" type="hidden" value="<?= $time['timeblockID'] ?>">

                            <div>
                                <label class="block font-medium text-sm mb-1">Block Name</label>
                                <input name="blockName" value="<?= $time['blockName'] ?>" type="text" class="w-full p-2 border rounded-lg" >
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block font-medium text-sm mb-1">Start Time</label>
                                    <input name="startTime" value="<?= $time['startTime'] ?>" type="time"  class="w-full p-2 border rounded-lg">
                                </div>
                                <div>
                                    <label class="block font-medium text-sm mb-1">End Time</label>
                                    <input name="endTime" value="<?= $time['endTime'] ?>" type="time"  class="w-full p-2 border rounded-lg">
                                </div>
                            </div>

                            <div class="flex justify-end gap-2">
                                <button type="button" data-modal-hide="editModal_<?= $time['timeblockID'] ?>"
                                    class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Cancel</button>
                                <button name="updatetimeblock" type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Save Changes
                                </button>
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
<script>
document.querySelectorAll('.deleteBtnid').forEach(btn => {
    btn.addEventListener('click', () => { // <-- use btn here, not id
        const id = btn.dataset.id; // get the examID
        Swal.fire({
            title: 'Remove this timeblock?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = '../routes/timeblockroute.php?deletetimeblock=' + id;
            }
        });
    });
});
</script>





</html>
