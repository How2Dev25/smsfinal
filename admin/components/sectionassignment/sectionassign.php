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

                    <button data-modal-target="cloneSectionModal_<?= $assign['assignmentID'] ?>" data-modal-toggle="cloneSectionModal_<?= $assign['assignmentID'] ?>" class="text-violet-600 hover:text-red-800 font-medium">
                        Clone Schedule
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




<?php foreach ($assignments as $assign): ?>
    <!-- Clone Section Modal -->
    <div id="cloneSectionModal_<?= $assign['assignmentID'] ?>" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
        justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-lg border border-blue-200 overflow-hidden">
                
                <!-- Header -->
                <div class="flex justify-between items-center p-5 bg-blue-600">
                    <h3 class="text-lg font-semibold text-white">Clone Schedule</h3>
                    <button type="button" data-modal-hide="cloneSectionModal_<?= $assign['assignmentID'] ?>"
                        class="text-white hover:bg-blue-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                        ✕
                    </button>
                </div>

                <!-- Modal Body -->
                <form method="POST" action="../routes/sectionassignreal.php" class="p-6 space-y-6 text-blue-900">
                    <input type="hidden" name="originalAssignmentID" value="<?= $assign['assignmentID'] ?>">

                    <!-- Teacher Selection Only -->
                    <div>
                        <?php 
                            $teacherlist = new professorAssign();
                            $teachers = $teacherlist->getTeacherFromUsers();
                        ?>
                        <label class="block mb-2 font-semibold">Select New Teacher</label>
                        <select name="newTeacherID" class="w-full border border-blue-300 rounded-lg px-3 py-2" required>
                            <option value="">Select Teacher</option>
                            <?php foreach($teachers as $teacher): ?>
                                <?php if ($teacher['id'] != $assign['teacherID']): ?>
                                    <option value="<?= $teacher['id'] ?>">
                                        <?= htmlspecialchars($teacher['username']) ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Optional: show original schedule details as read-only -->
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Subject</label>
                            <input type="text" value="<?= htmlspecialchars($assign['subjectName'] ?? $assign['subjectID']) ?>" readonly
                                class="w-full border border-gray-300 rounded px-2 py-1 bg-gray-100">
                        </div>
                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Section</label>
                            <input type="text" value="<?= htmlspecialchars($assign['sectionName'] ?? $assign['sectionID']) ?>" readonly
                                class="w-full border border-gray-300 rounded px-2 py-1 bg-gray-100">
                        </div>
                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Room</label>
                            <input type="text" value="<?= htmlspecialchars($assign['roomName'] ?? $assign['roomID']) ?>" readonly
                                class="w-full border border-gray-300 rounded px-2 py-1 bg-gray-100">
                        </div>
                        <div>
                            <label class="block mb-1 font-medium text-gray-700">Day / Time</label>
                            <input type="text" value="<?= $assign['day'] ?> <?= $assign['startTime'] ?> - <?= $assign['endTime'] ?>" readonly
                                class="w-full border border-gray-300 rounded px-2 py-1 bg-gray-100">
                        </div>
                    </div>

                    <!-- Notes (optional to edit) -->
                    <div>
                        <label class="block mb-2 font-semibold">Additional Notes</label>
                        <textarea name="notes" rows="3" class="w-full border border-blue-300 rounded-lg px-3 py-2"><?= htmlspecialchars($assign['notes']) ?></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-4 pt-4 border-t border-blue-100">
                        <button type="button" data-modal-hide="cloneSectionModal_<?= $assign['assignmentID'] ?>"
                            class="px-4 py-2 rounded-lg border border-blue-400 text-blue-700 font-medium hover:bg-blue-50 transition">
                            Cancel
                        </button>
                        <button name="cloneAssignment" type="submit"
                            class="px-4 py-2 rounded-lg bg-blue-700 text-white font-medium hover:bg-blue-800 shadow-md transition">
                            Clone Schedule
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Add this after the existing table but before the modals -->
<div class="mt-8">
    <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Schedule Calendar Powered By Reclaim.AI</h3>
            <div class="flex items-center space-x-4">
                <button id="prevWeek" class="p-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                    ← Prev
                </button>
                <span id="currentWeek" class="font-medium text-gray-700"></span>
                <button id="nextWeek" class="p-2 rounded-lg border border-gray-300 hover:bg-gray-50">
                    Next →
                </button>
                <button id="todayBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Today
                </button>
            </div>
        </div>

        <!-- Calendar Grid -->
        <div class="overflow-x-auto">
            <div id="calendarGrid" class="min-w-[1200px]">
                <!-- Calendar header will be generated by JavaScript -->
            </div>
        </div>
    </div>
</div>

<!-- Schedule Details Modal -->
<div id="scheduleDetailsModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
            justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg border border-blue-200 overflow-hidden">
            <div class="flex justify-between items-center p-5 bg-blue-600">
                <h3 class="text-lg font-semibold text-white">Schedule Details</h3>
                <button type="button" data-modal-hide="scheduleDetailsModal"
                    class="text-white hover:bg-blue-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                    ✕
                </button>
            </div>
            <div id="scheduleDetailsContent" class="p-6 space-y-4">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
    </div>
</div>




<script>
// UNIFIED SCRIPT - Calendar + Modal Handling
document.addEventListener('DOMContentLoaded', function() {
    
    // ========== MODAL HANDLING FUNCTIONS ==========
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
    }
    
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    }
    
    // Expose globally
    window.openModal = openModal;
    window.closeModal = closeModal;
    
    // ========== MODAL EVENT DELEGATION ==========
    // Using event delegation on document to handle dynamically added buttons
    document.addEventListener('click', function(event) {
        const target = event.target;
        
        // Handle modal toggle buttons
        const toggleBtn = target.closest('[data-modal-toggle]');
        if (toggleBtn) {
            event.preventDefault();
            event.stopPropagation();
            
            const targetModalId = toggleBtn.getAttribute('data-modal-toggle');
            const hideModalId = toggleBtn.getAttribute('data-modal-hide');
            
            // Close current modal if specified
            if (hideModalId) {
                closeModal(hideModalId);
            }
            
            // Open target modal
            if (targetModalId) {
                openModal(targetModalId);
            }
            return;
        }
        
        // Handle modal hide buttons (without toggle)
        const hideBtn = target.closest('[data-modal-hide]:not([data-modal-toggle])');
        if (hideBtn) {
            event.preventDefault();
            event.stopPropagation();
            
            const targetModalId = hideBtn.getAttribute('data-modal-hide');
            closeModal(targetModalId);
            return;
        }
        
        // Handle clicking on modal backdrop
        if (target.id && target.id.includes('Modal') && 
            !target.classList.contains('hidden') &&
            target.classList.contains('fixed')) {
            closeModal(target.id);
        }
    });
    
    // Handle Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const openModals = document.querySelectorAll('[id$="Modal"]:not(.hidden)');
            openModals.forEach(modal => {
                closeModal(modal.id);
            });
        }
    });
    
    // ========== CALENDAR FUNCTIONALITY ==========
    let currentDate = new Date();
    let assignments = <?php echo json_encode($assignments); ?>;
    
    console.log('Assignments loaded:', assignments);
    
    function getWeekRange(date) {
        const start = new Date(date);
        const day = start.getDay();
        const diff = start.getDate() - day + (day === 0 ? -6 : 1);
        start.setDate(diff);
        
        const end = new Date(start);
        end.setDate(start.getDate() + 5);
        
        return { start, end };
    }
    
    function formatTime(timeString) {
        const date = new Date('1970-01-01T' + timeString);
        return date.toLocaleTimeString('en-US', { 
            hour: 'numeric', 
            minute: '2-digit',
            hour12: true 
        });
    }
    
    function getTimeInMinutes(timeString) {
        const [hours, minutes] = timeString.split(':');
        return parseInt(hours) * 60 + parseInt(minutes);
    }
    
    function getColorForTeacher(teacherId) {
        const colors = [
            '#3B82F6', '#10B981', '#8B5CF6', '#EF4444',
            '#F59E0B', '#EC4899', '#14B8A6', '#F97316',
            '#6366F1', '#84CC16', '#06B6D4', '#F43F5E'
        ];
        const index = (parseInt(teacherId) || 0) % colors.length;
        return colors[index];
    }
    
    function generateCalendar() {
        const { start, end } = getWeekRange(currentDate);
        const calendarGrid = document.getElementById('calendarGrid');
        const currentWeekSpan = document.getElementById('currentWeek');
        
        currentWeekSpan.textContent = `${start.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })} - ${end.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}`;
        
        let html = `
            <div class="grid grid-cols-7 border-t border-l border-gray-200">
                <div class="border-r border-b border-gray-200 p-2 bg-gray-50 text-xs text-gray-500 font-medium">Time</div>
        `;
        
        const currentDay = new Date(start);
        const dayNames = [];
        for (let i = 0; i < 6; i++) {
            const dayDate = new Date(currentDay);
            const dayName = dayDate.toLocaleDateString('en-US', { weekday: 'long' });
            dayNames.push(dayName);
            
            html += `
                <div class="border-r border-b border-gray-200 p-2 bg-gray-50 text-center font-medium">
                    <div class="text-gray-600 text-sm">${dayDate.toLocaleDateString('en-US', { weekday: 'short' })}</div>
                    <div class="text-gray-900">${dayDate.getDate()}</div>
                </div>
            `;
            currentDay.setDate(currentDay.getDate() + 1);
        }
        
        const timeSlots = [];
        for (let hour = 7; hour <= 19; hour++) {
            timeSlots.push(`${hour.toString().padStart(2, '0')}:00`);
            if (hour < 19) {
                timeSlots.push(`${hour.toString().padStart(2, '0')}:30`);
            }
        }
        
        const renderedAssignments = new Set();
        
        timeSlots.forEach((time) => {
            const [hour, minute] = time.split(':');
            const timeInMinutes = parseInt(hour) * 60 + parseInt(minute);
            const displayTime = new Date('1970-01-01T' + time).toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
            
            html += `
                <div class="border-r border-b border-gray-200 p-2 text-xs text-gray-500 bg-gray-50">
                    ${minute === '00' ? displayTime : ''}
                </div>
            `;
            
            for (let dayIndex = 0; dayIndex < 6; dayIndex++) {
                const dayName = dayNames[dayIndex];
                
                const cellAssignments = assignments.filter(assign => {
                    if (assign.day.toLowerCase() !== dayName.toLowerCase()) return false;
                    
                    const startMinutes = getTimeInMinutes(assign.startTime);
                    const endMinutes = getTimeInMinutes(assign.endTime);
                    
                    return startMinutes <= timeInMinutes && timeInMinutes < endMinutes;
                });
                
                html += `<div class="border-r border-b border-gray-200 p-1 relative min-h-[60px]" 
                          data-day="${dayName}" data-time="${timeInMinutes}">`;
                
                cellAssignments.forEach(assign => {
                    const startMinutes = getTimeInMinutes(assign.startTime);
                    const endMinutes = getTimeInMinutes(assign.endTime);
                    const duration = endMinutes - startMinutes;
                    
                    const isStartSlot = timeInMinutes === startMinutes || 
                                       (timeInMinutes > startMinutes && timeInMinutes < startMinutes + 30);
                    
                    const assignmentKey = `${assign.assignmentID}-${dayName}`;
                    
                    if (isStartSlot && !renderedAssignments.has(assignmentKey)) {
                        renderedAssignments.add(assignmentKey);
                        
                        const slots = Math.ceil(duration / 30);
                        const heightPx = slots * 60;
                        
                        const subjectAbbr = assign.subjectName.substring(0, 20) + 
                                          (assign.subjectName.length > 20 ? '...' : '');
                        
                        html += `
                            <div class="absolute left-1 right-1 top-1 rounded-md p-2 shadow-sm cursor-pointer hover:shadow-md transition-shadow overflow-hidden"
                                 style="height: ${heightPx - 8}px; background-color: ${getColorForTeacher(assign.teacherID)}; z-index: 10;"
                                 onclick='showScheduleDetails(${JSON.stringify(assign).replace(/'/g, "\\'")})'
                                 title="${assign.subjectName} - ${assign.username}">
                                <div class="font-semibold text-xs text-white truncate">${subjectAbbr}</div>
                                <div class="text-xs text-white/90 truncate">${assign.sectionName}</div>
                                <div class="text-xs text-white/80 truncate">${assign.roomName}</div>
                                <div class="text-xs text-white/70 mt-1">${formatTime(assign.startTime)}</div>
                            </div>
                        `;
                    }
                });
                
                html += `</div>`;
            }
        });
        
        html += '</div>';
        calendarGrid.innerHTML = html;
        
        console.log('Calendar generated with', renderedAssignments.size, 'assignments');
    }
    
    // Show schedule details
    window.showScheduleDetails = function(assignment) {
        const modal = document.getElementById('scheduleDetailsModal');
        const content = document.getElementById('scheduleDetailsContent');
        
        const startTime = formatTime(assignment.startTime);
        const endTime = formatTime(assignment.endTime);
        
        content.innerHTML = `
            <div class="space-y-4">
                <div class="p-3 rounded-lg" style="background-color: ${getColorForTeacher(assignment.teacherID)};">
                    <h4 class="font-bold text-white text-lg">${assignment.subjectName}</h4>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Instructor</p>
                        <p class="font-medium">${assignment.username}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Section</p>
                        <p class="font-medium">${assignment.sectionName}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Room</p>
                        <p class="font-medium">${assignment.roomName}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Schedule</p>
                        <p class="font-medium">${assignment.day}<br>${startTime} - ${endTime}</p>
                    </div>
                </div>
                
                ${assignment.notes ? `
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Notes</p>
                        <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">${assignment.notes}</p>
                    </div>
                ` : ''}
                
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                    <button data-modal-target="editSectionModal_${assignment.assignmentID}" 
                            data-modal-toggle="editSectionModal_${assignment.assignmentID}"
                            data-modal-hide="scheduleDetailsModal"
                            class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg font-medium transition">
                        Edit
                    </button>
                    <button data-modal-target="cloneSectionModal_${assignment.assignmentID}"
                            data-modal-toggle="cloneSectionModal_${assignment.assignmentID}"
                            data-modal-hide="scheduleDetailsModal"
                            class="px-4 py-2 text-violet-600 hover:bg-violet-50 rounded-lg font-medium transition">
                        Clone
                    </button>
                </div>
            </div>
        `;
        
        openModal('scheduleDetailsModal');
    }
    
    // Navigation buttons
    document.getElementById('prevWeek').addEventListener('click', () => {
        currentDate.setDate(currentDate.getDate() - 7);
        generateCalendar();
    });
    
    document.getElementById('nextWeek').addEventListener('click', () => {
        currentDate.setDate(currentDate.getDate() + 7);
        generateCalendar();
    });
    
    document.getElementById('todayBtn').addEventListener('click', () => {
        currentDate = new Date();
        generateCalendar();
    });
    
    // Keyboard shortcuts for calendar
    document.addEventListener('keydown', function(event) {
        if (event.target.matches('input, textarea, select')) return;
        
        if (event.key === 'ArrowLeft') {
            document.getElementById('prevWeek').click();
        } else if (event.key === 'ArrowRight') {
            document.getElementById('nextWeek').click();
        } else if (event.key === 't' && (event.ctrlKey || event.metaKey)) {
            event.preventDefault();
            document.getElementById('todayBtn').click();
        }
    });
    
    // Initialize calendar
    generateCalendar();
});
</script>

<script>
// Delete functionality - separate to avoid conflicts
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