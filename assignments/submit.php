<?php
require_once __DIR__ . '/../utils/db.php';
require_once __DIR__ . '/../utils/response.php';

$aid = $_POST['assignment_id'] ?? '';
$sid = $_POST['student_id'] ?? '';

if (!$aid || !$sid || !isset($_FILES['file'])) {
    json_response(false, null, 'Missing fields');
}

$dir = __DIR__ . '/../uploads/';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

$target = $dir . time() . '_' . basename($_FILES['file']['name']);
if (!move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
    json_response(false, null, 'Upload failed');
}

$db = DB::connect();
$q = $db->prepare("INSERT INTO submissions (assignment_id, student_id, file_url) VALUES (?, ?, ?)");
$q->execute([$aid, $sid, basename($target)]);

json_response(true, null, 'File uploaded');
?>
