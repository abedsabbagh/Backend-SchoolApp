<?php
require_once __DIR__.'/../utils/db.php';
require_once __DIR__.'/../utils/response.php';

$uid=intval(basename($_SERVER['REQUEST_URI'],'.php'));
$db = DB::connect();

$sql="SELECT s.title AS subject, sc.day_of_week AS day,
            sc.start_time AS start, sc.end_time AS end
      FROM schedules sc JOIN subjects s ON sc.subject_id=s.id
      WHERE sc.user_id=?";
$stmt=$db->prepare($sql); $stmt->execute([$uid]);

json_response(true,['schedule'=>$stmt->fetchAll()]);
