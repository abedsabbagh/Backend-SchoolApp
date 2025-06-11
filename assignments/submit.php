<?php
require_once __DIR__.'/../utils/db.php';
require_once __DIR__.'/../utils/jwt.php';
require_once __DIR__.'/../utils/response.php';

$auth=$_SERVER['HTTP_AUTHORIZATION'] ?? '';
if(!preg_match('/Bearer\s(\S+)/',$auth,$m)) json_response(false,null,'No token');
try{ Token::verify($m[1]); }catch(Exception $e){ json_response(false,null,'Invalid token'); }

$aid=$_POST['assignment_id']??0; $sid=$_POST['student_id']??0;
if(!$aid||!$sid||!isset($_FILES['file'])) json_response(false,null,'Missing fields');

$dir=__DIR__.'/../uploads/'; if(!is_dir($dir)) mkdir($dir,0777,true);
$target=$dir.time().'_'.basename($_FILES['file']['name']);
if(!move_uploaded_file($_FILES['file']['tmp_name'],$target))
    json_response(false,null,'Upload failed');

DB::connect()->prepare("INSERT INTO submissions(assignment_id,student_id,file_url) VALUES (?,?,?)")
             ->execute([$aid,$sid,basename($target)]);

json_response(true,null,'File uploaded');
