<?php
/**
 * Echo Processor for testing purpose
 */

header('Content-Type: application/json');

echo json_encode([
    'HEADER'=>getallheaders(),
    'GET'=>$_GET,
    'POST'=>$_POST,
    'FILES'=>$_FILES,
    'RAW'=>file_get_contents('php://input')
]);

//remove every upload files
if(isset($_FILES) && count($_FILES)>0){
    foreach($_FILES as $k => $v){
        if (file_exists($v['tmp_name'])){
            unlink($v['tmp_name']);
        }
    }
}