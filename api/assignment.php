<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // optional CORS

include "../connections/connections.php"; // adjust path

$sql = "SELECT 
    sa.assignmentID,
    sa.day,
    sa.startTime, 
    sa.endTime,

    u.id AS teacherID,
    u.username AS teacherName,

    s.subjectID,
    s.subjectName,

    sec.sectionID,
    sec.sectionName,

    r.roomID,
    r.roomName

FROM section_assignments sa
JOIN users u ON sa.teacherID = u.id AND u.role = 'teacher'
JOIN subject_tbl s ON sa.subjectID = s.subjectID
JOIN section_tbl sec ON sa.sectionID = sec.sectionID
JOIN room_tbl r ON sa.roomID = r.roomID
ORDER BY sa.day, sa.startTime ASC;
";

$result = mysqli_query($connections, $sql);

if (!$result) {
    echo json_encode([
        "status" => "error",
        "message" => "Query failed"
    ]);
    exit;
}

if (mysqli_num_rows($result) === 0) {
    echo json_encode([
        "status" => "empty",
        "message" => "No assignments found"
    ]);
    exit;
}

$assignments = [];

while ($row = mysqli_fetch_assoc($result)) {
    $assignments[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $assignments
]);

exit;
