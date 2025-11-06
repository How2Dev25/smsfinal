<div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Section Assignments</h3>
                <button
                    data-modal-target="assignSectionModal"
                    data-modal-toggle="assignSectionModal"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 transition-all"
                >
                    + New Assignment
                </button>
            </div>

            <!-- Table -->
         <div class="overflow-x-auto">
    <table class="w-full text-sm text-left border border-gray-200 rounded-lg shadow-sm">
        <thead class="text-xs uppercase bg-blue-600 text-white">
            <tr>
                <th class="px-4 py-3">Instructor</th>
                <th class="px-4 py-3">Subject</th>
                <th class="px-4 py-3">Section</th>
                <th class="px-4 py-3">Room</th>
                <th class="px-4 py-3">Schedule</th>
                <th class="px-4 py-3">Notes</th>
                <th class="px-4 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 bg-white">
            <?php 
            $assignmentController = new professorAssign();
            $assignments = $assignmentController->getAllAssignments();
            ?>

            <?php foreach ($assignments as $assign): ?>
            <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-2 font-medium text-gray-700">
                    <?php echo htmlspecialchars($assign['username']) ?>
                </td>
                <td class="px-4 py-2"><?php echo htmlspecialchars($assign['subjectName']) ?></td>
                <td class="px-4 py-2"><?php echo htmlspecialchars($assign['sectionName']) ?></td>
                <td class="px-4 py-2"><?php echo htmlspecialchars($assign['roomName']) ?></td>

                <!-- ✅ Combine day + time properly -->
                <td class="px-4 py-2">
                    <?php
                        $day = htmlspecialchars($assign['day']);
                        $start = date("g:iA", strtotime($assign['startTime']));
                        $end = date("g:iA", strtotime($assign['endTime']));
                        echo "$day $start – $end";
                    ?>
                </td>

                <td class="px-4 py-2"><?php echo htmlspecialchars($assign['notes']) ?></td>

                <!-- ✅ Action buttons -->
                <td class="px-4 py-2 text-center space-x-3">
                    <button data-modal-target="editSectionModal_<?= $assign['assignmentID'] ?>" data-modal-toggle="editSectionModal_<?= $assign['assignmentID'] ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                        
                        Edit
                    </button>
                    <button data-id ="<?= $assign['assignmentID'] ?>" class="text-red-600 hover:text-red-800 font-medium deleteBtnAssignment">
                        Delete
                    </button>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

        </div>

        <div id="assignSectionModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
            justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-3xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-lg border border-blue-200 overflow-hidden">
                <!-- Header -->
                <div class="flex justify-between items-center p-5 bg-blue-600">
                    <h3 class="text-lg font-semibold text-white">Assign Section</h3>
                    <button type="button" data-modal-hide="assignSectionModal"
                        class="text-white hover:bg-blue-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                        ✕
                    </button>
                </div>

                <!-- Modal Body -->
            <form method="POST" action="../routes/sectionassignreal.php" class="p-6 space-y-6 text-blue-900">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <?php 
                $teacherlist = new professorAssign();
                $teachers = $teacherlist->getTeacherFromUsers();
            ?>
            <label class="block mb-2 font-semibold">Instructor Name</label>
            <select name="teacherID" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Select Teacher</option>
                <?php foreach($teachers as $teacher): ?>
                    <option value="<?= $teacher['id'] ?>"><?= htmlspecialchars($teacher['username']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <?php 
                $subjectlist = new professorAssign();
                $subjects = $subjectlist->fetchsubject();
            ?>
            <label class="block mb-2 font-semibold">Subject</label>
            <select name="subjectID" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Select Subject</option>
                <?php foreach($subjects as $subject): ?>
                    <option value="<?= $subject['subjectID'] ?>"><?= htmlspecialchars($subject['subjectName']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
             <?php 
                $sectionlist = new professorAssign();
                $sections = $sectionlist->fetchSectionList();
            ?>
            <label class="block mb-2 font-semibold">Section</label>
            <select name="sectionID" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Select Section</option>
                <?php foreach($sections as $section): ?>
                    <option value="<?= $section['sectionID'] ?>"><?= htmlspecialchars($section['sectionName']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
             <?php 
                $roomslist = new professorAssign();
                $rooms = $roomslist->fetchRoom();
            ?>
            <label class="block mb-2 font-semibold">Room</label>
            <select name="roomID" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Select Room</option>
                <?php foreach($rooms as $room): ?>
                    <option value="<?= $room['roomID'] ?>"><?= htmlspecialchars($room['roomName']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label class="block mb-2 font-semibold">Day</label>
            <select name="day" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">Select Day</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                 <option value="Friday">Saturday</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block mb-2 font-semibold">Start Time</label>
            <input type="time" name="startTime" class="w-full border border-blue-300 rounded-lg px-3 py-2" required>
        </div>
        <div>
            <label class="block mb-2 font-semibold">End Time</label>
            <input type="time" name="endTime" class="w-full border border-blue-300 rounded-lg px-3 py-2" required>
        </div>
    </div>

    <div>
        <label class="block mb-2 font-semibold">Additional Notes</label>
        <textarea name="notes" rows="3" class="w-full border border-blue-300 rounded-lg px-3 py-2"></textarea>
    </div>

    <div class="flex justify-end gap-4 pt-4 border-t border-blue-100">
        <button  type="button" data-modal-hide="assignSectionModal" class="px-4 py-2 rounded-lg border border-blue-400 text-blue-700 font-medium hover:bg-blue-50 transition">Cancel</button>
        <button name="addAssignment"  type="submit" class="px-4 py-2 rounded-lg bg-blue-700 text-white font-medium hover:bg-blue-800 shadow-md transition">Save</button>
    </div>
            </form>

            </div>
        </div>
    </div>




     <?php foreach ($assignments as $assign): ?>
    <!-- Edit Section Modal -->
    <div id="editSectionModal_<?= $assign['assignmentID'] ?>" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
        justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

        <div class="relative p-4 w-full max-w-3xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-lg border border-blue-200 overflow-hidden">
                
                <!-- Header -->
                <div class="flex justify-between items-center p-5 bg-blue-600">
                    <h3 class="text-lg font-semibold text-white">Edit Section Assignment</h3>
                    <button type="button" data-modal-hide="editSectionModal_<?= $assign['assignmentID'] ?>"
                        class="text-white hover:bg-blue-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                        ✕
                    </button>
                </div>

                <!-- Modal Body -->
                <form method="POST" action="../routes/sectionassignreal.php" class="p-6 space-y-6 text-blue-900">
                    <input type="hidden" name="assignmentID" value="<?= $assign['assignmentID'] ?>">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Instructor -->
                        <div>
                            <?php 
                                $teacherlist = new professorAssign();
                                $teachers = $teacherlist->getTeacherFromUsers();
                            ?>
                            <label class="block mb-2 font-semibold">Instructor Name</label>
                            <select name="teacherID" class="w-full border border-blue-300 rounded-lg px-3 py-2" required>
                                <option value="">Select Teacher</option>
                                <?php foreach($teachers as $teacher): ?>
                                    <option value="<?= $teacher['id'] ?>" 
                                        <?= $assign['teacherID'] == $teacher['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($teacher['username']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Subject -->
                        <div>
                            <?php 
                                $subjectlist = new professorAssign();
                                $subjects = $subjectlist->fetchsubject();
                            ?>
                            <label class="block mb-2 font-semibold">Subject</label>
                            <select name="subjectID" class="w-full border border-blue-300 rounded-lg px-3 py-2" required>
                                <option value="">Select Subject</option>
                                <?php foreach($subjects as $subject): ?>
                                    <option value="<?= $subject['subjectID'] ?>" 
                                        <?= $assign['subjectID'] == $subject['subjectID'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($subject['subjectName']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Section -->
                        <div>
                            <?php 
                                $sectionlist = new professorAssign();
                                $sections = $sectionlist->fetchSectionList();
                            ?>
                            <label class="block mb-2 font-semibold">Section</label>
                            <select name="sectionID" class="w-full border border-blue-300 rounded-lg px-3 py-2" required>
                                <option value="">Select Section</option>
                                <?php foreach($sections as $section): ?>
                                    <option value="<?= $section['sectionID'] ?>"
                                        <?= $assign['sectionID'] == $section['sectionID'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($section['sectionName']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Room -->
                        <div>
                            <?php 
                                $roomslist = new professorAssign();
                                $rooms = $roomslist->fetchRoom();
                            ?>
                            <label class="block mb-2 font-semibold">Room</label>
                            <select name="roomID" class="w-full border border-blue-300 rounded-lg px-3 py-2" required>
                                <option value="">Select Room</option>
                                <?php foreach($rooms as $room): ?>
                                    <option value="<?= $room['roomID'] ?>"
                                        <?= $assign['roomID'] == $room['roomID'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($room['roomName']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Day -->
                        <div>
                            <label class="block mb-2 font-semibold">Day</label>
                            <select name="day" class="w-full border border-blue-300 rounded-lg px-3 py-2" required>
                                <option value="">Select Day</option>
                                <?php 
                                    $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                                    foreach($days as $day): 
                                ?>
                                    <option value="<?= $day ?>" <?= $assign['day'] == $day ? 'selected' : '' ?>>
                                        <?= $day ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 font-semibold">Start Time</label>
                            <input type="time" name="startTime" value="<?= $assign['startTime'] ?>"
                                class="w-full border border-blue-300 rounded-lg px-3 py-2" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold">End Time</label>
                            <input type="time" name="endTime" value="<?= $assign['endTime'] ?>"
                                class="w-full border border-blue-300 rounded-lg px-3 py-2" required>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">Additional Notes</label>
                        <textarea name="notes" rows="3" class="w-full border border-blue-300 rounded-lg px-3 py-2"><?= htmlspecialchars($assign['notes']) ?></textarea>
                    </div>

                    <div class="flex justify-end gap-4 pt-4 border-t border-blue-100">
                        <button type="button" data-modal-hide="editSectionModal_<?= $assign['assignmentID'] ?>"
                            class="px-4 py-2 rounded-lg border border-blue-400 text-blue-700 font-medium hover:bg-blue-50 transition">
                            Cancel
                        </button>
                        <button name="updateAssignment" type="submit"
                            class="px-4 py-2 rounded-lg bg-blue-700 text-white font-medium hover:bg-blue-800 shadow-md transition">
                            Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>


<script>
document.querySelectorAll('.deleteBtnAssignment').forEach(btn => {
    btn.addEventListener('click', () => {
        const assignmentID = btn.dataset.id;
        Swal.fire({
            title: 'Delete this Assignment?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = '../routes/sectionassignreal.php?deleteAssignment=' + assignmentID;
            }
        });
    });
});
    </script>