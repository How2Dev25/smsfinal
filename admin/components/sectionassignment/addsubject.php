<div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Subject List</h3>
                <button
                    data-modal-target="subjectModal"
                    data-modal-toggle="subjectModal"
                    class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2.5 transition-all"
                >
                    + Add Subject
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border border-gray-200">
                    <thead class="text-xs uppercase bg-green-600 text-white">
                        <tr>
                            <th class="px-4 py-3">Subject ID</th>
                            <th class="px-4 py-3">Subject Code</th>
                            <th class="px-4 py-3">Subject Name</th>
                            <th class="px-4 py-3">Units</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php 
                        $fetchsubject = new subject();
                        $fetchsubject = $fetchsubject->fetchsubject();
                        ?>

                        <?php foreach ($fetchsubject as $subjects): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2"><?php echo htmlspecialchars($subjects['subjectID']) ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($subjects['subjectCode']) ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($subjects['subjectName']) ?></td>
                            <td class="px-4 py-2"><?php echo htmlspecialchars($subjects['units']) ?></td>
                            <td class="px-4 py-2 text-center">
                                <button
                                data-modal-target="editsubjectModal(<?php echo htmlspecialchars($subjects['subjectID']) ?>)"
                                data-modal-toggle="editsubjectModal(<?php echo htmlspecialchars($subjects['subjectID']) ?>)"
                                 class="text-blue-600 hover:text-blue-800 font-medium">Edit</button>
                                <button data-id="<?php echo htmlspecialchars($subjects['subjectID']) ?>" class="text-red-600 hover:text-red-800 font-medium deleteBtnSubject ">Delete</button>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- create -->

            <!-- ========================================================= -->
    <div id="subjectModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
            justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-lg border border-green-200 overflow-hidden">
                
                <!-- Header -->
                <div class="flex justify-between items-center p-5 bg-green-600">
                    <h3 class="text-lg font-semibold text-white">Add New Subject</h3>
                    <button type="button" data-modal-hide="subjectModal"
                        class="text-white hover:bg-green-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                        ✕
                    </button>
                </div>

                <!-- Body -->
                <form action="../routes/sectionsubject.php" method="POST" class="p-6 space-y-6 text-green-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 font-semibold">Subject Code</label>
                            <input name="subjectCode" type="text" placeholder="e.g. IT401" 
                                class="w-full border border-green-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold">Subject Name</label>
                            <input name="subjectName" type="text" placeholder="e.g. Web Development" 
                                class="w-full border border-green-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">Units</label>
                        <input name="units" type="number" placeholder="e.g. 3" min="1" max="5"
                            class="w-full border border-green-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex justify-end gap-4 pt-4 border-t border-green-100">
                        <button type="button" data-modal-hide="subjectModal"
                            class="px-4 py-2 rounded-lg border border-green-400 text-green-700 font-medium hover:bg-green-50 transition">
                            Cancel
                        </button>
                        <button type="submit"
                            name="addsubject"
                            class="px-4 py-2 rounded-lg bg-green-700 text-white font-medium hover:bg-green-800 shadow-md transition">
                            Save Subject
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit -->

     <?php foreach ($fetchsubject as $subjects): ?>

        <div id="editsubjectModal(<?php echo htmlspecialchars($subjects['subjectID']) ?>)" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
            justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-lg border border-green-200 overflow-hidden">
                
                <!-- Header -->
                <div class="flex justify-between items-center p-5 bg-green-600">
                    <h3 class="text-lg font-semibold text-white">Add New Subject</h3>
                    <button type="button" data-modal-hide="subjectModal"
                        class="text-white hover:bg-green-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                        ✕
                    </button>
                </div>

                <!-- Body -->
                <form action="../routes/sectionsubject.php" method="POST" class="p-6 space-y-6 text-green-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                     
                        <div hidden>
                            <label class="block mb-2 font-semibold">Subject ID</label>
                            <input value="<?php echo htmlspecialchars($subjects['subjectID']) ?>" name="subjectID" type="text" placeholder="e.g. IT401" 
                                class="w-full border border-green-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                             </div>
                        <div>
                            <label class="block mb-2 font-semibold">Subject Code</label>
                            <input value="<?php echo htmlspecialchars($subjects['subjectCode']) ?>" name="subjectCode" type="text" placeholder="e.g. IT401" 
                                class="w-full border border-green-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold">Subject Name</label>
                            <input value="<?php echo htmlspecialchars($subjects['subjectName']) ?>" name="subjectName" type="text" placeholder="e.g. Web Development" 
                                class="w-full border border-green-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">Units</label>
                        <input value="<?php echo htmlspecialchars($subjects['units']) ?>" name="units" type="number" placeholder="e.g. 3" min="1" max="5"
                            class="w-full border border-green-300 rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500">
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex justify-end gap-4 pt-4 border-t border-green-100">
                        <button type="button" data-modal-hide="editsubjectModal(<?php echo htmlspecialchars($subjects['subjectID']) ?>)"
                            class="px-4 py-2 rounded-lg border border-green-400 text-green-700 font-medium hover:bg-green-50 transition">
                            Cancel
                        </button>
                        <button type="submit"
                            name="updatesubject"
                            class="px-4 py-2 rounded-lg bg-green-700 text-white font-medium hover:bg-green-800 shadow-md transition">
                            Save Subject
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


        <?php endforeach ?>


        
    <script>
        document.querySelectorAll('.deleteBtnSubject').forEach(btn => {
    btn.addEventListener('click', () => {
        const subjectID = btn.dataset.id;
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
                window.location.href = '../routes/sectionsubject.php?deletesubject=' + subjectID;
            }
        });
    });
});
    </script>