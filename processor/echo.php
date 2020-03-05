<?php
/**
 * just echo content
 * $route ['id','method', 'route_type', 'content_type', 'content', 'retry', 'retry_delay', 'timeout']
 * ignoring 'method', 'retry', 'retry_delay', 'timeout'
 */

header('Content-Type: application/json');

echo json_encode([
    'HEADER'=>getallheaders(),
    'GET'=>$_GET,
    'POST'=>$_POST,
    'FILES'=>$_FILES
]);

//remove every upload files
if(isset($_FILES) && count($_FILES)>0){
    foreach($_FILES as $k => $v){
        if (file_exists($v['tmp_name'])){
            unlink($v['tmp_name']);
        }
    }
}