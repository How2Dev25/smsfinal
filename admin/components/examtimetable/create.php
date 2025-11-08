  <div id="createExamModal" tabindex="-1" aria-hidden="true" 
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
           justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-lg max-h-full">
      <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
        
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-700">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Create Exam Schedule
          </h3>
          <button type="button" 
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 
                   rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-700 dark:hover:text-white" 
            data-modal-hide="createExamModal">
            ✕
          </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-4">
          <form action="../routes/examtimetableroute.php" method="POST" class="space-y-4">

            <div>
                <?php
                $subject = new ExamTimetable();
                $subject = $subject->fetchsubject();
                ?>  
              <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Subject</label>
              <select name="subjectID" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                <?php foreach ($subject as $subjects): ?>
                <option value="<?php echo htmlspecialchars($subjects['subjectID']) ?>"><?php echo htmlspecialchars($subjects['subjectName']) ?></option>
                <?php endforeach ?>
              </select>
            </div>

            <div>
              <?php 
              $section = new ExamTimetable();
              $section = $section->fetchSectionList();
              ?>
              <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Section</label>
              <select name="sectionID" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                <?php foreach ($section as $sections): ?>
                <option value="<?php echo htmlspecialchars($sections['sectionID']) ?>"><?php echo htmlspecialchars($sections['sectionName']) ?></option>
                <?php endforeach ?>
              </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Exam Date</label>
                <input type="date" name="examDate" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
              </div>
              <div>
                <?php 
                $room =  new ExamTimetable();
                $room = $room->fetchRoom();
                ?>
                <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Room</label>
                <select name="roomID" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                    <?php foreach ($room as $rooms): ?>
                  <option value="<?php echo htmlspecialchars($rooms['roomID']) ?>"><?php echo htmlspecialchars($rooms['roomName']) ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Start Time</label>
                <input type="time" name="startTime" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
              </div>
              <div>
                <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">End Time</label>
                <input type="time" name="endTime" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
              </div>
            </div>

            <div>
                  <?php 
                $teacher = new ExamTimetable();
                $teacher = $teacher->getTeacherFromUsers();
                ?>
              <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Invigilator</label>
              <select name="invigilatorID" class="w-full border border-gray-300 rounded-lg p-2 dark:bg-gray-700 dark:text-white">
                <?php foreach($teacher as $teachers): ?>
                <option value="<?php echo ($teachers['id']) ?>"><?php echo ($teachers['username']) ?></option>
                <?php endforeach ?>
              </select>
            </div>

            <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b dark:border-gray-700">
          <button 
            data-modal-hide="createExamModal" 
            type="button" 
            class="text-gray-600 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-4 py-2 mr-2 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
            Cancel
          </button>
          <button 
            type="submit" 
            name="addExam"
            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
            Save Exam
          </button>
        </div>
          </form>
        </div>

        <!-- Modal Footer -->
        

      </div>
    </div>
  </div>