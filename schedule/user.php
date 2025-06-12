<?php
require_once __DIR__ . '/../utils/db.php';
require_once __DIR__ . '/../utils/response.php';

$uid = $_GET['uid'] ?? '';

if (!$uid) {
    json_response(false, null, 'Missing user ID');
}

$db = DB::connect();
$q = $db->prepare("SELECT subjects.title AS subject, schedules.day_of_week AS day, schedules.start_time AS start, schedules.end_time AS end
                   FROM schedules 
                   JOIN subjects ON schedules.subject_id = subjects.id 
                   WHERE schedules.user_id = ?");
$q->execute([$uid]);
$schedule = $q->fetchAll(PDO::FETCH_ASSOC);

json_response(true, ['schedule' => $schedule]);
?>
