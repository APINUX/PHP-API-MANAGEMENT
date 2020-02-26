<?php
use Medoo\Medoo;
/**
 * POST {key1 : valuea, key2:valueb}
 * select from table where field1=':key1' AND field2=':key2'
 * example:
 * POST {key1 : valuea, key2:valueb}
 * select from users where field1='valuea' AND field2='valueb'
 *
 * $route ['id','method', 'route_type', 'content_type', 'db_id', 'content', 'retry', 'retry_delay', 'timeout']
 * ignoring 'content_type','method', 'retry', 'retry_delay', 'timeout'
 */

$dbinfo = $_db->get('api_db',['db_type', 'db_host', 'db_name', 'db_user', 'db_pass'],['id'=>$route['db_id']]);

$db = new Medoo([
	// required
	'database_type' => $dbinfo['db_type'],
	'database_name' => $dbinfo['db_name'],
	'server' => $dbinfo['db_host'],
	'username' => $dbinfo['db_user'],
    'password' => $dbinfo['db_pass']
]);

$sql = $route['content'];

foreach($_POST as $k => $v){
    $sql = str_replace(":$k",$v,$sql);
}

$result = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: '.$route['content_type']);
sendResult($result);