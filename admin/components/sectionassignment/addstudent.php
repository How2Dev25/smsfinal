  
  
  
  <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 space-y-3 md:space-y-0">
                <h3 class="text-lg font-semibold text-gray-800">Student List For Section <?php echo  $section['sectionName'] ?></h3>

                <!-- Search + Add Button -->
                <div class="flex items-center gap-2 relative w-full md:w-auto">
                    <div class="relative w-full md:w-64">
                        <input
                            id="courseInput"
                            type="text"
                            placeholder="Type course or 'ALL' to view all"
                            class="block w-full text-sm rounded-lg border border-gray-300 p-2.5 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400"
                            autocomplete="off"
                        />
                        <ul
                            id="autocompleteList"
                            class="absolute top-full left-0 right-0 bg-white border border-gray-300 rounded-lg mt-1 max-h-40 overflow-y-auto hidden z-50"
                        ></ul>
                    </div>

                    <button
                        data-modal-target="studentModal"
                        data-modal-toggle="studentModal"
                        class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2.5 transition-all"
                    >
                        Add Student
                    </button>
                </div>
            </div>

            <!-- Student Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border border-gray-200">
                    <thead class="text-xs uppercase bg-indigo-600 text-white">
                        <tr>
                            <th scope="col" class="px-4 py-3">ID</th>
                            <th scope="col" class="px-4 py-3">Name</th>
                            <th scope="col" class="px-4 py-3">Gender</th>
                            <th scope="col" class="px-4 py-3">Program</th>
                            <th scope="col" class="px-4 py-3">Year & Course</th>
                            <th scope="col" class="px-4 py-3">Adviser</th>
                            <th scope="col" class="px-4 py-3">Room</th>
                            <th scope="col" class="px-4 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                 <tbody id="studentTableBody" class="divide-y divide-gray-100">
<?php 
    $studentObj = new student();
    $students = $studentObj->studentlistinsection($sectionID);

    if (!empty($students)) {
        foreach ($students as $row) {
?>
<tr class="hover:bg-gray-50">
    <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($row['studentID']); ?></td>
    <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($row['primaryName']); ?></td>
    <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($row['gender']); ?></td>
    <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($row['course'] ?? '—'); ?></td>
    <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($row['yearLevel'] ?? '—'); ?></td>
    <td class="px-4 py-2 text-gray-700"><?= htmlspecialchars($row['adviserName'] ?? '—'); ?></td>
    <td class="px-4 py-2 text-gray-700"><?= $section['roomName'] ?></td>

    <td class="px-4 py-2 text-center space-x-2">
        <button onclick="document.getElementById('editModal<?= $row['primarytableID']; ?>').classList.remove('hidden')"
            class="text-blue-600 hover:text-blue-800 font-medium">
            Edit
        </button>
        <button data-id="<?= htmlspecialchars($row['primarytableID']); ?>" 
            class="text-red-600 hover:text-red-800 font-medium deleteBtnSectionStudent">
            Delete
        </button>
    </td>
</tr>

<!-- ✅ EDIT MODAL MUST BE INSIDE FOREACH -->
<div id="editModal<?= $row['primarytableID']; ?>" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Student</h3>

        <form action="../routes/addstudentroute.php?section=<?= $_GET['section']; ?>" method="POST">
            <input type="hidden" name="primarytableID" value="<?= $row['primarytableID']; ?>">

            <div class="mb-3">
                <label class="text-sm font-medium text-gray-700">Student Name</label>
                <input type="text" name="studentName" value="<?= htmlspecialchars($row['primaryName']); ?>"
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-indigo-300">
            </div>

            <div class="mb-3">
                <label class="text-sm font-medium text-gray-700">Gender</label>
                <select name="gender" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="Male" <?= ($row['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= ($row['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="text-sm font-medium text-gray-700">Course</label>
                <input type="text" name="course" value="<?= htmlspecialchars($row['course']); ?>"
                    class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <div class="mb-3">
                <label class="text-sm font-medium text-gray-700">Year Level</label>
                <input type="text" name="yearLevel" value="<?= htmlspecialchars($row['yearLevel']); ?>"
                    class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button"
                    onclick="document.getElementById('editModal<?= $row['primarytableID']; ?>').classList.add('hidden')"
                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-lg">
                    Cancel
                </button>
                <button name="modifyStudent" type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white hover:bg-indigo-700 rounded-lg">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<?php
        }
    } else {
        echo '<tr><td colspan="8" class="px-4 py-6 text-center text-gray-500">No students found.</td></tr>';
    }
?>
</tbody>

                </table>
            </div>
        </div>


       <div id="studentModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
        justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg border border-blue-200 overflow-hidden">
            
            <!-- Header -->
            <div class="flex justify-between items-center p-5 bg-blue-600">
                <h3 class="text-lg font-semibold text-white">Add New Student</h3>
                <button type="button" data-modal-hide="studentModal"
                    class="text-white hover:bg-blue-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                    ✕
                </button>
            </div>

            <!-- Body -->
            <form id="addStudentForm" action="../routes/addstudentroute.php?section=<?php echo $_GET['section']; ?>" method="POST" class="p-6 space-y-6 text-blue-900">

                <!-- Student User ID (optional) -->
               <div>
                <?php 
                $studentlist = new student();
                $studentlist = $studentlist->getStudentFromUsers();
                
                ?>
    <label class="block mb-2 font-semibold">Student User ID (optional)</label>
    <select name="studentuserID" 
        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
        <option value=""></option>
        <?php foreach($studentlist as $students): ?>
        <option value="<?php echo htmlspecialchars($students['id']) ?>"><?php echo htmlspecialchars($students['username']) ?></option>
        <?php endforeach ?>
    </select>
</div>

                <!-- Student Name -->
                <div>
                    <label class="block mb-2 font-semibold">Full Name</label>
                    <input type="text" name="student_name" placeholder="e.g. Juan Dela Cruz" required
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Gender -->
                <div>
                    <label class="block mb-2 font-semibold">Gender</label>
                    <select name="gender" required
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <!-- Section -->
                <div>
                    <label class="block mb-2 font-semibold">Section</label>
                    <select name="sectionID" required
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="<?php echo $section['sectionID'] ?>"><?php echo $section['sectionName'] ?></option>
                    </select>
                </div>

                <!-- Footer Buttons -->
                <div class="flex justify-end gap-4 pt-4 border-t border-blue-100">
                    <button type="button" data-modal-hide="studentModal"
                        class="px-4 py-2 rounded-lg border border-blue-400 text-blue-700 font-medium hover:bg-blue-50 transition">
                        Cancel
                    </button>
                    <button name="addStudent" type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-700 text-white font-medium hover:bg-blue-800 shadow-md transition">
                        Save Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- EDIT MODAL FOR THIS STUDENT -->
 




<script>
    document.querySelectorAll('.deleteBtnSectionStudent').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        Swal.fire({
            title: 'Delete this student?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = '../routes/addstudentroute.php?deleteStudent=' + id;
            }
        });
    });
});
</script>