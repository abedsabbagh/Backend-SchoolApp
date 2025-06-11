<?php
require_once __DIR__.'/../utils/db.php';
require_once __DIR__.'/../utils/jwt.php';
require_once __DIR__.'/../utils/response.php';

$in = json_decode(file_get_contents('php://input'), true);
$email = $in['email'] ?? '';
$pass  = $in['password'] ?? '';

$db = DB::connect();
$q  = $db->prepare("SELECT id,password_hash,role FROM users WHERE email=?");
$q->execute([$email]);
$u = $q->fetch();

if(!$u || !password_verify($pass,$u['password_hash']))
    json_response(false,null,'Invalid credentials');

$token = Token::generate(['uid'=>$u['id'],'role'=>$u['role']]);
json_response(true,['token'=>$token,'uid'=>$u['id'],'role'=>$u['role']]);
