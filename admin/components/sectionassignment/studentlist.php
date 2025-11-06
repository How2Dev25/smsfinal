<!-- STUDENT LIST -->
<div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Student List</h3>

        <div class="flex flex-col md:flex-row gap-3">
            <input id="searchInput" type="text" placeholder="Search student or course..."
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table id="studentTable" class="w-full text-sm text-left border border-gray-200">
            <thead class="text-xs uppercase bg-indigo-600 text-white">
                <tr>
                    <th class="px-4 py-3">Student ID</th>
                    <th class="px-4 py-3">Student Name</th>
                    <th class="px-4 py-3">Year Level</th>
                    <th class="px-4 py-3">Course</th>
                    <th class="px-4 py-3">Adviser</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

                <!-- SAMPLE STATIC ROWS -->
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">2024-001</td>
                    <td class="px-4 py-2">Juan Dela Cruz</td>
                    <td class="px-4 py-2">1st Year</td>
                    <td class="px-4 py-2">BSIT</td>
                    <td class="px-4 py-2">Mr. Santos</td>
                    <td class="px-4 py-2 text-center">
                        <a href="view_course.php?student=2024-001" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            View Course
                        </a>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">2024-002</td>
                    <td class="px-4 py-2">Maria Clara</td>
                    <td class="px-4 py-2">2nd Year</td>
                    <td class="px-4 py-2">BSBA</td>
                    <td class="px-4 py-2">Mrs. Reyes</td>
                    <td class="px-4 py-2 text-center">
                        <a href="view_course.php?student=2024-002" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            View Course
                        </a>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">2024-003</td>
                    <td class="px-4 py-2">Pedro Penduko</td>
                    <td class="px-4 py-2">3rd Year</td>
                    <td class="px-4 py-2">BSCE</td>
                    <td class="px-4 py-2">Engr. Cruz</td>
                    <td class="px-4 py-2 text-center">
                        <a href="view_course.php?student=2024-003" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            View Course
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>