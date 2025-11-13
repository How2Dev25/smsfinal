 
 <div class="grid grid-cols-2 max-md:grid-cols-1 mt-5 mb-5 gap-5">
 <div class="bg-white rounded-xl shadow-md p-6">
        <?php 
        $roomCounts = new Roomcontroller();
        $roomCounts = $roomCounts->fetchRoomCounts();
        
        ?>
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Room Status Overview</h3>
    <canvas width="200" height="400" id="roomStatusChart" ></canvas>

    <script>
    const roomData = {
        total: <?= $roomCounts['totalRooms'] ?>,
        available: <?= $roomCounts['availableRooms'] ?>,
        occupied: <?= $roomCounts['occupiedRooms'] ?>,
        maintenance: <?= $roomCounts['underMaintenance'] ?>
    };

    const ctx = document.getElementById('roomStatusChart').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut', // Try 'bar', 'pie', or 'polarArea' too
        data: {
            labels: ['Available', 'Occupied', 'Under Maintenance'],
            datasets: [{
                label: 'Room Status',
                data: [roomData.available, roomData.occupied, roomData.maintenance],
                backgroundColor: [
                    'rgba(34, 197, 94, 0.8)',  // green
                    'rgba(239, 68, 68, 0.8)',  // red
                    'rgba(234, 179, 8, 0.8)'   // yellow
                ],
                borderColor: [
                    'rgb(34, 197, 94)',
                    'rgb(239, 68, 68)',
                    'rgb(234, 179, 8)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: `Total Rooms: ${roomData.total}`,
                    font: { size: 18 }
                },
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.parsed} rooms`;
                        }
                    }
                }
            }
        }
    });
</script>

</div>
<div class="bg-white rounded-xl shadow-md p-6">
    <?php 
        $counts = new counts();
        $counts = $counts->getAllCounts();
    ?>

    <h3 class="text-lg font-semibold text-gray-800 mb-4">School Overview</h3>

    <!-- Chart Container -->
    <div class="relative w-full h-[400px]"> <!-- ✅ Adjust height here -->
        <canvas id="schoolOverviewChart"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const dataCounts = {
        students: Number(<?= $counts['students'] ?>),
        sections: Number(<?= $counts['sections'] ?>),
        subjects: Number(<?= $counts['subjects'] ?>),
        teachers: Number(<?= $counts['teachers'] ?>)
    };

    const ctx = document.getElementById('schoolOverviewChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Students', 'Sections', 'Subjects', 'Teachers'],
            datasets: [{
                label: 'Total Count',
                data: [
                    dataCounts.students,
                    dataCounts.sections,
                    dataCounts.subjects,
                    dataCounts.teachers
                ],
                backgroundColor: [
                    'rgba(99, 102, 241, 0.8)',   // primary
                    'rgba(34, 197, 94, 0.8)',    // secondary
                    'rgba(59, 130, 246, 0.8)',   // accent
                    'rgba(234, 179, 8, 0.8)'     // yellow
                ],
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // ✅ allows chart to fill container height
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Summary of School Data',
                    font: { size: 18 }
                }
            },
            scales: {
                x: {
                    ticks: { font: { size: 14 } }
                },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, font: { size: 14 } }
                }
            }
        }
    });
});
</script>

<!-- ✅ Chart.js CDN (MUST be before your script) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





</div>
     