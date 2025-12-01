<!-- STUDENT LIST -->

<div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        

        <div class="flex flex-col md:flex-row gap-3">
            <input id="searchInput" type="text" placeholder="Search student or course..."
                class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500">

  

            <!-- New Preview PDF Button -->
            <button
                id="previewPdfBtn"
                class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700">
                Preview PDF
            </button>
        </div>
    </div>

    

   <div class="overflow-x-auto">
    <table id="studentTable" class="w-full text-sm text-left border border-gray-200">
        <thead class="text-xs uppercase bg-indigo-600 text-white">
            <tr>
             <thead class="text-xs uppercase bg-indigo-600 text-white">
    <tr>
        <th class="px-4 py-3">Subject</th>
        <th class="px-4 py-3">Teacher</th>
        <th class="px-4 py-3">Section</th>
        <th class="px-4 py-3">Room</th>
        <th class="px-4 py-3">Schedule</th>
       
      
    </tr>
</thead>
            </tr>
        </thead>

    <tbody class="divide-y divide-gray-100">
<?php

$TeacherController = new TeacherController();
$subjects = $TeacherController->fetchsubjectforstudent($assignmentID);

if ($subjects && mysqli_num_rows($subjects) > 0) {
    while($row = mysqli_fetch_assoc($subjects)){ ?>
        <tr class="hover:bg-gray-50">
            <td class="px-4 py-2"><?= htmlspecialchars($row['subjectName']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['teacherName']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['sectionName']) ?></td>
            <td class="px-4 py-2"><?= htmlspecialchars($row['roomName']) ?></td>
            <td class="px-4 py-2">
                <?= htmlspecialchars($row['day']) ?> 
                (<?= htmlspecialchars($row['startTime']) ?> - <?= htmlspecialchars($row['endTime']) ?>)
            </td>
           

          

        </tr>
<?php } 
} else { ?>
    <tr>
        <td colspan="7" class="text-center py-4 text-gray-500">
            No subjects assigned yet.
        </td>
    </tr>
<?php } ?>
</tbody>
    </table>
</div>

</div>





<!-- New PDF Preview Modal -->
<div id="pdfPreviewModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
        justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            
            <!-- Header -->
            <div class="flex justify-between items-center p-5 bg-gray-600">
                <h3 class="text-lg font-semibold text-white">PDF Preview - Subject List</h3>
                <button type="button" id="closePreviewModal"
                    class="text-white hover:bg-gray-700 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition">
                    ✕
                </button>
            </div>

            <!-- Body - Preview Content -->
            <div id="previewContent" class="p-6 overflow-y-auto max-h-96">
                <!-- Preview will be inserted here -->
            </div>

            <!-- Footer Buttons -->
            <div class="flex justify-end gap-4 pt-4 border-t border-gray-100 p-6">
                <button type="button" id="cancelPreview"
                    class="px-4 py-2 rounded-lg border border-gray-400 text-gray-700 font-medium hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button id="generatePdfFromPreview"
                    class="px-4 py-2 rounded-lg bg-red-700 text-white font-medium hover:bg-red-800 shadow-md transition">
                    Generate PDF
                </button>
            </div>
        </div>
    </div>
</div>


<script>
document.querySelectorAll('.deleteBtnsubjectassign').forEach(btn => {
    btn.addEventListener('click', () => {
        const student_subject_id = btn.dataset.id;
        Swal.fire({
            title: 'Remove this Subject?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                window.location.href = '../routes/subjectassign.php?deletestudentsubject=' + student_subject_id;
            }
        });
    });
});

// PDF Preview Functionality
document.getElementById('previewPdfBtn').addEventListener('click', () => {
    // Clone the table to modify for preview
    const originalTable = document.querySelector('#studentTable');
    const tableClone = originalTable.cloneNode(true);
    
    // Remove the Actions column (last column)
    const headers = tableClone.querySelectorAll('th');
    const rows = tableClone.querySelectorAll('tr');
    headers[headers.length - 1].remove(); // Remove Actions header
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 0) {
            cells[cells.length - 1].remove(); // Remove Actions cell
        }
    });
    
    // Create preview content with professional styling
    const previewContainer = document.createElement('div');
    previewContainer.style.fontFamily = 'Arial, sans-serif';
    previewContainer.style.fontSize = '12px';
    previewContainer.style.width = '100%';
    previewContainer.style.padding = '20px';
    previewContainer.innerHTML = `
        <div style="text-align: center; margin-bottom: 20px;">
            <h1 style="font-size: 18px; font-weight: bold; color: #333; margin: 0;">Student List</h1>
            <p style="font-size: 10px; color: #666; margin: 5px 0 0 0;">Generated on ${new Date().toLocaleDateString()}</p>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 10px; margin: 0 auto;">
                <thead>
                    <tr style="background-color: #f3f4f6; color: #374151;">
                        <th style="border: 1px solid #d1d5db; padding: 8px; text-align: center; font-weight: bold;">Subject</th>
                        <th style="border: 1px solid #d1d5db; padding: 8px; text-align: left; font-weight: bold;">Teacher</th>
                        <th style="border: 1px solid #d1d5db; padding: 8px; text-align: left; font-weight: bold;">Section</th>
                        <th style="border: 1px solid #d1d5db; padding: 8px; text-align: left; font-weight: bold;">Room</th>
                        <th style="border: 1px solid #d1d5db; padding: 8px; text-align: left; font-weight: bold;">Schedule</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    mysqli_data_seek($subjects, 0);
                    while($row = mysqli_fetch_assoc($subjects)) {
                        echo '<tr>';
                        echo '<td style="border: 1px solid #d1d5db; padding: 8px; text-align: center; font-weight: bold;">' . htmlspecialchars($row['subjectName']) . '</td>';
                        echo '<td style="border: 1px solid #d1d5db; padding: 8px;">' . htmlspecialchars($row['teacherName']) . '</td>';
                        echo '<td style="border: 1px solid #d1d5db; padding: 8px;">' . htmlspecialchars($row['sectionName']) . '</td>';
                        echo '<td style="border: 1px solid #d1d5db; padding: 8px;">' . htmlspecialchars($row['roomName']) . '</td>';
                        echo '<td style="border: 1px solid #d1d5db; padding: 8px;">' . htmlspecialchars($row['day']) . ' (' . htmlspecialchars($row['startTime']) . ' - ' . htmlspecialchars($row['endTime']) . ')</td>';
                        
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    `;
    
    // Insert into preview modal
    const previewContent = document.getElementById('previewContent');
    previewContent.innerHTML = '';
    previewContent.appendChild(previewContainer);
    
    // Show the modal
    document.getElementById('pdfPreviewModal').classList.remove('hidden');
});

// Close preview modal
document.getElementById('closePreviewModal').addEventListener('click', () => {
    document.getElementById('pdfPreviewModal').classList.add('hidden');
});

document.getElementById('cancelPreview').addEventListener('click', () => {
    document.getElementById('pdfPreviewModal').classList.add('hidden');
});

// Generate PDF from preview
document.getElementById('generatePdfFromPreview').addEventListener('click', () => {
    const previewContainer = document.querySelector('#previewContent > div');
    const opt = {
        margin: 0.5,
        filename: 'Subject_List.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    
    html2pdf().set(opt).from(previewContainer).save().then(() => {
        document.getElementById('pdfPreviewModal').classList.add('hidden'); // Close modal after generation
    });
});
</script>

<!-- Include html2pdf.js library (add this before the closing </body> tag in your HTML) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
