<?php
use Medoo\Medoo;

/**
 * SQL Processor, will execute SQL based your setup
 *
 *
 * POST {key1 : valuea, key2:valueb}
 * select from table where field1=':key1' AND field2=':key2'
 * example:
 * POST {key1 : valuea, key2:valueb}
 * select from users where field1='valuea' AND field2='valueb'
 *
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

sendResult($result,'Content-Type: '.$route['content_type']);