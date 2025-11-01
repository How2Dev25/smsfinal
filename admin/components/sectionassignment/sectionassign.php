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
                <table class="w-full text-sm text-left border border-gray-200">
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
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">Prof. Dela Cruz</td>
                            <td class="px-4 py-2">Web Development</td>
                            <td class="px-4 py-2">BSIT-401</td>
                            <td class="px-4 py-2">Lab 201</td>
                            <td class="px-4 py-2">MWF 9:00–10:30AM</td>
                            <td class="px-4 py-2">Capstone project supervision</td>
                            <td class="px-4 py-2 text-center">
                                <button class="text-blue-600 hover:text-blue-800 font-medium">Edit</button>
                                <button class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                            </td>
                        </tr>
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
                <form class="p-6 space-y-6 text-blue-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 font-semibold">Instructor Name</label>
                            <input type="text" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold">Subject</label>
                            <input type="text" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block mb-2 font-semibold">Section</label>
                            <input type="text" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold">Room</label>
                            <input type="text" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold">Schedule</label>
                            <input type="text" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">Additional Notes</label>
                        <textarea rows="3" class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <div class="flex justify-end gap-4 pt-4 border-t border-blue-100">
                        <button type="button" data-modal-hide="assignSectionModal"
                            class="px-4 py-2 rounded-lg border border-blue-400 text-blue-700 font-medium hover:bg-blue-50 transition">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 rounded-lg bg-blue-700 text-white font-medium hover:bg-blue-800 shadow-md transition">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>