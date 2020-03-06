<?php
use Medoo\Medoo;

//if not admin
if($_SESSION['ROLE']>2){
    die($tpl->render("alert",['msg'=>'Unauthorized','msgType'=>'warning',
                    'url'=>'/'.$crumbs[0].'/'.$crumbs[1]."/".$id]));
}

if(isset($_POST['save']) && $_POST['save']==true){
    $_POST['methods'] = implode(',',array_filter($_POST['methods']));
    $_POST['version'] = preg_replace("/[^0-9]+/","",$_POST['version']);
    $_POST['category'] = preg_replace("/[^a-zA-Z0-9-._]+/","",$_POST['category']);
    $_POST['function'] = preg_replace("/[^a-zA-Z0-9-._]+/","",$_POST['function']);
    $_POST['name'] = strtolower($_POST['category']).ucwords(strtolower($_POST['function']));
    $_POST['description'] = $_POST['description'];
    $_POST['created'] = date("Y-m-d H:i:s");
    $_POST['updated'] = date("Y-m-d H:i:s");

    if(!empty($_POST['version']) && !empty($_POST['category']) && !empty($_POST['name'])){
        unset($_POST['save']);
        $_db->insert('api_routes',$_POST);
        $id = $_db->id();
        if($id>0){
             echo $tpl->render("alert",['msg'=>'Route Added','msgType'=>'success',
                    'url'=>'/'.$crumbs[0].'/'.$crumbs[1]."/view/".$id]);
            die();
        }else{
            $msg = 'Failed to Save data:<br>'.implode("<br>",$_db->error());
            $msgType = 'danger';
        }
    }else{
        $msg = 'Failed to Save data: Please fill all required fields';
        $msgType = 'warning';
        $data = $_POST;
    }
}

$versions = $_db->select('api_routes',['version'=>Medoo::raw('DISTINCT(`version`)')],['ORDER'=>['version'=>'DESC']]);
$categories = $_db->select('api_routes',['category'=>Medoo::raw('DISTINCT(`category`)')],['ORDER'=>['category'=>'ASC']]);
$functions = $_db->select('api_routes',['function'=>Medoo::raw('DISTINCT(`function`)')],['function[!]'=>null,'ORDER'=>['function'=>'ASC']]);
$databases = $_db->select('api_db',['id','name', 'db_type', 'environment'],['ORDER'=>['name'=>'ASC']]);
$groups = $_db->select('api_groups',['id','name'],['ORDER'=>['name'=>'ASC']]);
$auths = $_db->select('api_auth',['id','name'],['ORDER'=>['name'=>'ASC']]);

echo $tpl->render("routes/addEdit",[
    'edit' => false,
    'msg' => $msg,
    'data' => $data,
    'msgType' => $msgType,
    'groups'=>$groups,
    'versions'=>$versions,
    'auths'=>$auths,
    'categories'=>$categories,
    'functions'=>$functions,
    'databases'=>$databases
]);