<?php
function json_response(bool $ok,$data=null,string $msg=''){
    header('Content-Type: application/json');
    echo json_encode(['success'=>$ok,'message'=>$msg,'data'=>$data]);
    exit;
}
