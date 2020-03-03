<?php
/**
 * API MANAGEMENT Created by Ibnu Maksum
 */

header('Access-Control-Allow-Origin: *');
date_default_timezone_set("Asia/Jakarta");
error_reporting(E_ERROR);

include "vendor/autoload.php";
include "config.php";
include "function.php";

use Medoo\Medoo;

$_db = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => $db_name,
	'server' => $db_host,
	'username' => $db_user,
    'password' => $db_pass
]);


$_path = array_values(array_filter(explode("/",explode("?",$_SERVER['REQUEST_URI'])[0])));
$_jml = count($_path);

$_admin = 'admin';

if(isset($_path[0]) && $_path[0]==$_admin){
    $tpl = new League\Plates\Engine('template');
    //All Methods
    $tpl->addData(['_methods' => ['GET','POST','PUT','DELETE','PATCH']]);
    $tpl->addData(['_types' => ['http','sql','php','plain','echo']]);

    //foo/bar.php
    if(file_exists($modul = "modules/".$_path[1]."/".$_path[2].".php")){
            $tpl->addData(['crumbs' => [$_path[0],$_path[1],$_path[2]]]);
            unset($_path[0],$_path[1],$_path[2]);
            $_path = array_values($_path);
            include $modul;
    //foo/foo.php
    }else if(file_exists($modul = "modules/".$_path[1]."/".$_path[1].".php")){
            $tpl->addData(['crumbs' => [$_path[0],$_path[1]]]);
            unset($_path[0],$_path[1]);
            $_path = array_values($_path);
            include $modul;
            die();
    //foo.php
    }else if(file_exists($modul = "modules/".$_path[1].".php")){
        $tpl->addData(['crumbs' => [$_path[0],$_path[1]]]);
        unset($_path[0],$_path[1]);
        $_path = array_values($_path);
        include $modul;
        die();
    }else{
        $tpl->addData(['crumbs' => [$_path[0]]]);
        include "modules/home.php";
    }
}else{
    if(isset($_path[0],$_path[1],$_path[2])){
        $route = $_db->get('api_routes',
                ['id','methods', 'route_type', 'content_type', 'db_id', 'content', 'retry', 'retry_delay', 'timeout'],
                ['AND'=>['version'=>$_path[0], 'category'=>$_path[1], 'function'=>$_path[2],'enabled'=>1]]
            );
        if(!isset($route) || !is_array($route) || count($route)==0){
            $route = $_db->debug()->get('api_routes',
                ['id','methods', 'route_type', 'content_type', 'db_id', 'content', 'retry', 'retry_delay', 'timeout'],
                ['AND'=>['version'=>$_path[0], 'category'=>$_path[1],'enabled'=>1]]
            );
            unset($_path[0],$_path[1]);
            $_path = array_values($_path);
        }else{
            unset($_path[0],$_path[1],$_path[2]);
            $_path = array_values($_path);
        }
    }else if(isset($_path[0],$_path[1])){
        $route = $_db->get('api_routes',
                ['id','methods', 'route_type', 'content_type', 'db_id', 'content', 'retry', 'retry_delay', 'timeout'],
                ['AND'=>['version'=>$_path[0], 'category'=>$_path[1],'enabled'=>1]]
            );
        unset($_path[0],$_path[1]);
        $_path = array_values($_path);
    }

    if(!isset($route) || !is_array($route) || count($route)==0){
        sendError('no Route matched ');
    }

    //CHECK METHOD
    if(strpos($route['methods'],$_SERVER["REQUEST_METHOD"])===false){
        sendError("Method Not Allowed",'HTTP/1.0 405 Method Not Allowed');
    }

    //recount
    $_jml = count($_path);

    //analytics
    analytics($route['id']);

    //find processor based route type
    if(file_exists('processor/'.$route['route_type'].'.php')){
        include 'processor/'.$route['route_type'].'.php';
    }else{
        sendError('no Route matched.');
    }
}
