<?php


/**
 * HTTP Processor is the proxy to another API
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

//settimeout
ini_set('default_socket_timeout',$route['timeout']);

$headers = array();
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

// If no
header('Content-Type: '.(!empty($route['content_type'])?$route['content_type']:$headers['content_type']));

// if need redirect, then send it
if(!empty($headers['redirect_url'])){
    header("location: ".$headers['redirect_url']);
}

echo $response;

//remove every upload files
if(isset($_FILES) && count($_FILES)>0){
    foreach($_FILES as $k => $v){
        if (file_exists($v['tmp_name'])){
            unlink($v['tmp_name']);
        }
    }
}
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
    global $headers;
    $ch = initCurl($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $headers = curl_getinfo($ch);
    return $response;
}

function makeGetRequest($url) {
    global $headers;
    $ch = initCurl($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $headers = curl_getinfo($ch);
    return $response;
}

function makePCurl($type, $data, $url) {
    global $headers;
    $ch = initCurl($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);
    $headers = curl_getinfo($ch);
    return $response;
}


function initCurl($url) {
    global $route;
    // STill need to filter which headers need to exclude
    $headers = array();
    foreach (getallheaders() as $key => $val) {
        if(strpos($val,'multipart/form-data')===false)
            if(strtolower($key)!='content-length')
                $headers[] = "$key: $val";
    }
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $route['timeout']);
    curl_setopt($ch, CURLOPT_TIMEOUT, $route['timeout']);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    return $ch;
}
