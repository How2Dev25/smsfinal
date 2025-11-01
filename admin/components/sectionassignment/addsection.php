<!-- SECTION LIST -->
<div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Section List</h3>

        <div class="flex flex-col md:flex-row gap-3">
            <!-- Search Filter -->
            <input id="searchInput" type="text" placeholder="Search section, course, or year..."
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500">

            <!-- Add Button -->
            <button
                data-modal-target="sectionModal"
                data-modal-toggle="sectionModal"
                class="text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2.5 transition-all">
                + Add Section
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table id="sectionTable" class="w-full text-sm text-left border border-gray-200">
            <thead class="text-xs uppercase bg-indigo-600 text-white">
                <tr>
                    <th class="px-4 py-3">Section ID</th>
                    <th class="px-4 py-3">Section Name</th>
                    <th class="px-4 py-3">Year Level</th>
                    <th class="px-4 py-3">Course</th>
                    <th class="px-4 py-3">Adviser</th>
                    <th class="px-4 py-3">School Year</th>
                    <th class="px-4 py-3">Semester</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php
                $sectionlist = new sectionAssignment();
                $sectionlist = $sectionlist->fetchSectionList();
                ?>
                <?php foreach($sectionlist as $sections): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2"><?php echo htmlspecialchars($sections['sectionID']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($sections['sectionName']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($sections['yearLevel']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($sections['course']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($sections['username']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($sections['schoolYear']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($sections['semester']) ?></td>
                    <td class="px-4 py-2 text-center space-x-3">
                          <button 
            class="text-blue-600 hover:text-blue-800 font-medium"
            data-modal-target="editSectionModal<?php echo htmlspecialchars($sections['sectionID']) ?>"
            data-modal-toggle="editSectionModal<?php echo htmlspecialchars($sections['sectionID']) ?>">
            Edit
        </button>


                        <button class="text-red-600 hover:text-red-800 font-medium deleteBtnSection"
                            data-id="<?= $sections['sectionID'] ?>">Delete</button>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<!-- create section modal -->

  <div id="sectionModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
            justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-lg border border-indigo-200 overflow-hidden">
                
                <!-- Header -->
                <div class="flex justify-between items-center p-5 bg-indigo-600">
                    <h3 class="text-lg font-semibold text-white">Add New Section</h3>
                    <button type="button" data-modal-hide="sectionModal"
                        class="text-white hover:bg-indigo-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                        ✕
                    </button>
                </div>

                <!-- Body -->
                <form action="../routes/sectionassignment.php" method="POST" class="p-6 space-y-6 text-indigo-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 font-semibold">Section Name</label>
                            <input name="sectionName" type="text" placeholder="e.g. BSIT-401" 
                                class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold">Year Level</label>
                            <select name="yearLevel" class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select Year Level</option>
                                <option>1st Year</option>
                                <option>2nd Year</option>
                                <option>3rd Year</option>
                                <option>4th Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 font-semibold">Course</label>
                            <input name="course" type="text" placeholder="e.g. BSIT" 
                                class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold">Adviser ID</label>
                            <?php 
                            $getTeacher = new sectionAssignment();
                            $getTeacherData = $getTeacher->getTeacherFromUsers();
                            ?>
                           <select name="adviserID" class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select Adviser</option>
                                <?php foreach($getTeacherData as $getTeacherDataloop): ?>
                                <option value = "<?php echo htmlspecialchars($getTeacherDataloop['id']) ?>"><?php echo htmlspecialchars($getTeacherDataloop['username']) ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 font-semibold">School Year</label>
                            <input name="schoolYear" type="text" placeholder="e.g. 2024-2025" 
                                class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold">Semester</label>
                            <select name="semester" class="w-full border border-indigo-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select Semester</option>
                                <option>1st</option>
                                <option>2nd</option>
                            </select>
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex justify-end gap-4 pt-4 border-t border-indigo-100">
                        <button type="button" data-modal-hide="sectionModal"
                            class="px-4 py-2 rounded-lg border border-indigo-400 text-indigo-700 font-medium hover:bg-indigo-50 transition">
                            Cancel
                        </button>
                        <button name="addsection" type="submit"
                            class="px-4 py-2 rounded-lg bg-indigo-700 text-white font-medium hover:bg-indigo-800 shadow-md transition">
                            Save Section
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



<!-- EDIT SECTION MODAL -->

<?php foreach ($sectionlist as $sections): ?>
<div id="editSectionModal<?php echo htmlspecialchars($sections['sectionID']) ?>" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-full">
    <div class="relative p-4 w-full max-w-2xl">
        <div class="relative bg-white rounded-2xl shadow-lg border border-indigo-200">
            <div class="flex justify-between items-center p-5 bg-indigo-600">
                <h3 class="text-lg font-semibold text-white">Edit Section</h3>
                <button type="button" data-modal-hide="editSectionModal<?= htmlspecialchars($sections['sectionID']) ?>"
                    class="text-white hover:bg-indigo-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center">✕</button>
            </div>

            <form action="../routes/sectionassignment.php" method="POST" class="p-6 space-y-6">
                <input type="hidden" name="sectionID" value="<?= htmlspecialchars($sections['sectionID']) ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Section Name</label>
                        <input name="sectionName" type="text" value="<?= htmlspecialchars($sections['sectionName']) ?>"
                            class="w-full border border-indigo-300 rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">Year Level</label>
                        <select name="yearLevel"
                            class="w-full border border-indigo-300 rounded-lg px-3 py-2">
                            <?php 
                            $years = ['1st Year','2nd Year','3rd Year','4th Year'];
                            foreach($years as $year): ?>
                            <option value="<?= $year ?>" <?= $sections['yearLevel']==$year?'selected':'' ?>><?= $year ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Course</label>
                        <input name="course" type="text" value="<?= htmlspecialchars($sections['course']) ?>"
                            class="w-full border border-indigo-300 rounded-lg px-3 py-2">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold">School Year</label>
                        <input name="schoolYear" type="text" value="<?= htmlspecialchars($sections['schoolYear']) ?>"
                            class="w-full border border-indigo-300 rounded-lg px-3 py-2">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 font-semibold">Semester</label>
                        <select name="semester"
                            class="w-full border border-indigo-300 rounded-lg px-3 py-2">
                            <option value="1st" <?= $sections['semester']=='1st'?'selected':'' ?>>1st</option>
                            <option value="2nd" <?= $sections['semester']=='2nd'?'selected':'' ?>>2nd</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">Adviser ID</label>
                        <?php 
                        $getTeacher = new sectionAssignment();
                        $getTeacherData = $getTeacher->getTeacherFromUsers();
                        ?>
                        <select name="adviserID" class="w-full border border-indigo-300 rounded-lg px-3 py-2">
                            <option value="">Select Adviser</option>
                            <?php foreach($getTeacherData as $getTeacherDataloop): ?>
                                <option value="<?= htmlspecialchars($getTeacherDataloop['id']) ?>" 
                                    <?= $sections['adviserID']==$getTeacherDataloop['id']?'selected':'' ?>>
                                    <?= htmlspecialchars($getTeacherDataloop['username']) ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-4 border-t border-indigo-100">
                    <button type="button" data-modal-hide="editSectionModal<?= htmlspecialchars($sections['sectionID']) ?>"
                        class="px-4 py-2 rounded-lg border border-indigo-400 text-indigo-700 font-medium hover:bg-indigo-50">
                        Cancel
                    </button>
                    <button name="updatesection" type="submit"
                        class="px-4 py-2 rounded-lg bg-indigo-700 text-white font-medium hover:bg-indigo-800 shadow-md">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach ?>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
/* 🔍 Search Filter */
document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    document.querySelectorAll('#sectionTable tbody tr').forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});



  
/* 🗑️ Delete Confirmation */
document.querySelectorAll('.deleteBtnSection').forEach(btn => {
    btn.addEventListener('click', () => {
        const sectionID = btn.dataset.id;
        Swal.fire({
            title: 'Delete this section?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = '../routes/sectionassignment.php?deleteSection=' + sectionID;
            }
        });
    });
});
</script>