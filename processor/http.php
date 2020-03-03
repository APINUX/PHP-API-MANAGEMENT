<?php

/**
 * Parsing based route
 * $route ['id','methods', 'route_type', 'content_type', 'content', 'retry', 'retry_delay', 'timeout']
 * ignoring 'content_type', will get from external source
 */
$url = $route['content'];
if($_jml>0){
    $path = implode("/",$_path);
    $url .= '/'.$path;
}

if(!empty($_SERVER['QUERY_STRING'])){
    $url .= "?".$_SERVER['QUERY_STRING'];
}

if(!$url) {
    sendError("You need to pass in a target URL.");
}

$response = "";
switch ($_SERVER["REQUEST_METHOD"]) {
case 'POST':
    $response = makePCurl('POST',getPostData(), $url);
    break;
case 'PUT':
    $response = makePCurl('PUT',getPostData(), $url);
    break;
case 'PATCH':
    $response = makePCurl('PATCH',getPostData(), $url);
    break;
case 'DELETE':
    $response = makeDeleteRequest($url);
    break;
case 'GET':
    $response = makeGetRequest($url);
    break;
default:
    echo "This proxy only supports POST, PUT, PATCH, DELETE AND GET REQUESTS.";
    return;
}

header('Content-Type: '.$route['content_type']);

echo $response;
die();


function getPostData(){
    $data = file_get_contents('php://input');
    if(!empty($data))
        return $data;
    $post = array();
    if(isset($_POST) && count($_POST)>0){
        $post = array_merge($post,$_POST);
    }
    if(isset($_FILES) && count($_FILES)>0){
        foreach($_FILES as $k => $v){
            if (function_exists('curl_file_create')) { // php 5.5+
                $post[$k] = curl_file_create($v['tmp_name'],$v['type'],$v['name']);
            } else { // 
                $post[$k] = "@".realpath($v['tmp_name']);
            }
        }
    }
    return $post;
}

function makeDeleteRequest($url) {
    $ch = initCurl($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function makeGetRequest($url) {
    $ch = initCurl($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function makePCurl($type, $data, $url) {
    $ch = initCurl($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}


function initCurl($url) {
    global $route;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $route['timeout']);
    curl_setopt($ch, CURLOPT_TIMEOUT, $route['timeout']);
    curl_setopt($ch, CURLOPT_HTTPHEADER, getallheaders());
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_HEADERFUNCTION, "handleHeaderLine");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    return $ch;
}

/**
 * Return some header to client
 */
function handleHeaderLine( $curl, $header_line ) {
    //if redirect, we tell them
    if(strpos('location',$header_line)!==false)
        header($header_line);
    return strlen($header_line);
}