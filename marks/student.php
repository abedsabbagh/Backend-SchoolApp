<?php
require_once __DIR__ . '/../utils/db.php';
require_once __DIR__ . '/../utils/response.php';

$sid = $_GET['student_id'] ?? '';

if (!$sid) {
    json_response(false, null, 'Missing student ID');
}

$db = DB::connect();
$q = $db->prepare("
    SELECT subjects.title AS subject, marks.exam_type, marks.mark
    FROM marks
    JOIN subjects ON marks.subject_id = subjects.id
    WHERE marks.student_id = ?
");
$q->execute([$sid]);
$marks = $q->fetchAll(PDO::FETCH_ASSOC);

json_response(true, ['marks' => $marks]);
?>
