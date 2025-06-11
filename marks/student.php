<?php
require_once __DIR__.'/../utils/db.php';
require_once __DIR__.'/../utils/response.php';

$uid=intval(basename($_SERVER['REQUEST_URI'],'.php'));
$db=DB::connect();

$sql="SELECT sub.title AS subject, m.exam_type, m.mark
      FROM marks m JOIN subjects sub ON m.subject_id=sub.id
      WHERE m.student_id=?";
$st=$db->prepare($sql); $st->execute([$uid]);

json_response(true,['marks'=>$st->fetchAll()]);
