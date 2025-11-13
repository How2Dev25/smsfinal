<?php
// auth 
include('components/global/auth.php');
include('../controllers/roomcontroller.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Room Availability Checker</title>
  <?php include('components/global/header.php') ?>
</head>

<body class="bg-white font-sans">
    <section class="flex h-screen overflow-hidden">
      <?php include_once('components/global/sidebar.php') ?>
      
        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white content-transition lg:ml-72" id="main-content">

                  
              <div class="flex-1 overflow-auto p-5 space-y-10">

               <div class="mb-8 bg-gradient-to-r from-blue-50 to-white rounded-xl shadow-lg p-6 sm:p-8 border border-blue-100 mt-5">
                        <h1 class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">Room Availability Checker</h1>
                 </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">


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
  

    <!-- ===================================================== -->
    <!-- 🏫 ROOM AVAILABILITY CHECKER -->
    <!-- ===================================================== -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6 mt-5">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Room Availability Checker</h3>

        <div class="flex gap-3 items-center">
          <input id="searchRoomInput" type="text" placeholder="Search room name..."
            class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-64 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
          <button id="checkAvailabilityBtn"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
            Check Availability
          </button>
        </div>
      </div>

      <div id="availabilityResult" class="hidden p-4 rounded-lg border mt-3">
        <h4 class="font-semibold text-gray-800 text-lg mb-2">Room Status:</h4>
        <p id="roomStatusText" class="text-base"></p>
      </div>
    </div>

    <!-- ===================================================== -->
    <!-- 🧾 ROOM LIST TABLE -->
    <!-- ===================================================== -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 space-y-3 md:space-y-0">
        <h3 class="text-lg font-semibold text-gray-800">Room List</h3>

        <!-- Search + Add Button -->
        <div class="flex items-center gap-2 w-full md:w-auto">
          <div class="relative w-full md:w-64">
            <input
              id="roomInput"
              type="text"
              placeholder="Type room name or 'ALL' to view all"
              class="block w-full text-sm rounded-lg border border-gray-300 p-2.5 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
              autocomplete="off"
            />
          </div>

          <button
            data-modal-target="roomModal"
            data-modal-toggle="roomModal"
            class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2.5 transition-all"
          >
            Add Room
          </button>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border border-gray-200">
          <thead class="text-xs uppercase bg-indigo-600 text-white">
            <tr>
              <th class="px-4 py-3">Room ID</th>
              <th class="px-4 py-3">Room Name</th>
              <th class="px-4 py-3">Capacity</th>
              <th class="px-4 py-3">Location</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3 text-center">Action</th>
            </tr>
          </thead>
          <tbody id="roomTableBody" class="divide-y divide-gray-100">
            <?php 
              $roomcontroller = new Roomcontroller();
              $roomlist = $roomcontroller->fetchRoom();
              foreach($roomlist as $rooms): 
            ?>
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2"><?= htmlspecialchars($rooms['roomID']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($rooms['roomName']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($rooms['capacity']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($rooms['location']) ?></td>
              <td class="px-4 py-2">
                <?php
                  $status = htmlspecialchars($rooms['roomStatus']);
                  $color = $status == 'Available' ? 'bg-green-100 text-green-800' :
                           ($status == 'Occupied' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');
                ?>
                <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $color ?>">
                  <?= $status ?>
                </span>
              </td>
              <td class="px-4 py-2 text-center space-x-2">
                <button data-modal-target="editroomModal<?= htmlspecialchars($rooms['roomID']) ?>"
                        data-modal-toggle="editroomModal<?= htmlspecialchars($rooms['roomID']) ?>"
                        class="text-blue-600 hover:text-blue-800 font-medium">
                  Edit
                </button>
                <button data-id="<?= htmlspecialchars($rooms['roomID']) ?>" 
                        class="text-red-600 hover:text-red-800 font-medium deleteBtnRoom">
                  Delete
                </button>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>


    <!-- ============================== -->
<!-- 🏫 Add Room Modal -->
<!-- ============================== -->
<div id="roomModal" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center overflow-y-auto overflow-x-hidden w-full h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg border border-blue-200 overflow-hidden">

            <!-- Header -->
            <div class="flex justify-between items-center p-5 bg-blue-600">
                <h3 class="text-lg font-semibold text-white">Add Room</h3>
                <button type="button" data-modal-hide="roomModal"
                    class="text-white hover:bg-blue-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                    ✕
                </button>
            </div>

            <!-- Body -->
            <form action="../routes/roomroutes.php" method="POST" class="p-6 space-y-6 text-blue-900" id="roomForm">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Room Name</label>
                        <input type="text" name="roomName" placeholder="e.g. Lab 203"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Capacity</label>
                        <input type="number" name="capacity" placeholder="e.g. 30"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">Location</label>
                        <input type="text" name="location" placeholder="e.g. 2nd Floor"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-4 pt-4 border-t border-blue-100">
                    <button type="button" data-modal-hide="roomModal"
                        class="px-4 py-2 rounded-lg border border-blue-400 text-blue-700 font-medium hover:bg-blue-50 transition">
                        Cancel
                    </button>
                    <button name="addRoom" type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-700 text-white font-medium hover:bg-blue-800 shadow-md transition">
                        Save Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ============================== -->
<!-- ✏️ Edit Room Modal -->
<!-- ============================== -->
<?php foreach ($roomlist as $rooms): ?>
<div id="editroomModal<?php echo htmlspecialchars($rooms['roomID']); ?>" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center overflow-y-auto overflow-x-hidden w-full h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg border border-blue-200 overflow-hidden">

            <!-- Header -->
            <div class="flex justify-between items-center p-5 bg-blue-600">
                <h3 class="text-lg font-semibold text-white">Edit Room</h3>
                <button type="button" data-modal-hide="editroomModal<?php echo htmlspecialchars($rooms['roomID']); ?>"
                    class="text-white hover:bg-blue-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                    ✕
                </button>
            </div>

            <!-- Body -->
            <form action="../routes/roomroutes.php" method="POST" class="p-6 space-y-6 text-blue-900">
                <input type="hidden" name="roomID" value="<?php echo htmlspecialchars($rooms['roomID']); ?>">

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Room Name</label>
                        <input type="text" name="roomName" value="<?php echo htmlspecialchars($rooms['roomName']); ?>"
                            placeholder="e.g. Lab 203"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Capacity</label>
                        <input type="number" name="capacity" value="<?php echo htmlspecialchars($rooms['capacity']); ?>"
                            placeholder="e.g. 30"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">Location</label>
                        <input type="text" name="location" value="<?php echo htmlspecialchars($rooms['location']); ?>"
                            placeholder="e.g. 2nd Floor"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Room Status</label>
                        <select name="roomStatus"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Status</option>
                            <option value="Available" <?php if ($rooms['roomStatus'] == 'Available') echo 'selected'; ?>>
                                Available</option>
                            <option value="Occupied" <?php if ($rooms['roomStatus'] == 'Occupied') echo 'selected'; ?>>
                                Occupied</option>
                            <option value="Maintenance"
                                <?php if ($rooms['roomStatus'] == 'Maintenance') echo 'selected'; ?>>
                                Maintenance</option>
                        </select>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-4 pt-4 border-t border-blue-100">
                    <button type="button"
                        data-modal-hide="editroomModal<?php echo htmlspecialchars($rooms['roomID']); ?>"
                        class="px-4 py-2 rounded-lg border border-blue-400 text-blue-700 font-medium hover:bg-blue-50 transition">
                        Cancel
                    </button>
                    <button name="updateRoom" type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-700 text-white font-medium hover:bg-blue-800 shadow-md transition">
                        Save Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>


    <!-- ===================================================== -->
<!-- 🏢 FLOOR PLAN MAP (Room Status Overview) -->
<!-- ===================================================== -->
<div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
  <h3 class="text-lg font-semibold text-gray-800 mb-4">Building Floor Plan</h3>
  <p class="text-sm text-gray-500 mb-6">Visual overview of room availability status</p>

  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <?php foreach ($roomlist as $room): 
      $status = htmlspecialchars($room['roomStatus']);
      $color = $status === 'Available' ? 'bg-green-100 text-green-800 border-green-300' :
               ($status === 'Occupied' ? 'bg-yellow-100 text-yellow-800 border-yellow-300' :
               'bg-red-100 text-red-800 border-red-300');
    ?>
    <div class="border <?= $color ?> rounded-xl p-4 shadow-sm hover:shadow-md transition cursor-pointer">
      <div class="text-base font-semibold mb-1"><?= htmlspecialchars($room['roomName']) ?></div>
      <div class="text-sm text-gray-600"><?= htmlspecialchars($room['location']) ?></div>
      <div class="mt-2">
        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold <?= $color ?>">
          <?= $status ?>
        </span>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Legend -->
  <div class="flex flex-wrap gap-3 mt-6 text-sm">
    <div class="flex items-center gap-2">
      <div class="w-4 h-4 bg-green-300 rounded"></div> <span>Available</span>
    </div>
    <div class="flex items-center gap-2">
      <div class="w-4 h-4 bg-yellow-300 rounded"></div> <span>Occupied</span>
    </div>
    <div class="flex items-center gap-2">
      <div class="w-4 h-4 bg-red-300 rounded"></div> <span>Maintenance</span>
    </div>
  </div>
</div>

  </div>
        </main>
    </section>

    <script src="../javascript/sidebar.js">

    </script>
</body>



<!-- ===================================================== -->
<!-- 🧠 JAVASCRIPT -->
<!-- ===================================================== -->
<script>
document.addEventListener('DOMContentLoaded', () => {

  // 🔍 Room Availability Checker
  document.getElementById('checkAvailabilityBtn').addEventListener('click', () => {
    const roomName = document.getElementById('searchRoomInput').value.trim();
    const resultBox = document.getElementById('availabilityResult');
    const resultText = document.getElementById('roomStatusText');

    if (roomName === '') {
      Swal.fire('Please enter a room name!', '', 'warning');
      return;
    }

    fetch('../routes/checkRoomAvailability.php?roomName=' + encodeURIComponent(roomName))
      .then(res => res.json())
      .then(data => {
        resultBox.classList.remove('hidden');
        if (data.success) {
          let color = data.status === 'Available' ? 'text-green-600' :
                      data.status === 'Occupied' ? 'text-yellow-600' :
                      'text-red-600';
          resultText.innerHTML = `<strong>${data.roomName}</strong> is currently <span class="${color} font-semibold">${data.status}</span>.`;
        } else {
          resultText.innerHTML = `<span class="text-gray-600">${data.message}</span>`;
        }
      })
      .catch(() => {
        Swal.fire('Error', 'Unable to check room availability.', 'error');
      });
  });

  // 🗑️ Delete confirmation
  document.querySelectorAll('.deleteBtnRoom').forEach(btn => {
    btn.addEventListener('click', () => {
      const roomID = btn.dataset.id;
      Swal.fire({
        title: 'Delete this room?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
      }).then(result => {
        if (result.isConfirmed) {
          window.location.href = '../routes/roomroutes.php?deleteRoom=' + roomID;
        }
      });
    });
  });
});
</script>

</html>
