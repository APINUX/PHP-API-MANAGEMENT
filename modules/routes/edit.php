<?php
use Medoo\Medoo;
if(isset($_POST['delete']) && $_POST['delete']==true){
    if($_db->delete('api_routes',['id'=>$_path[0]])->rowCount()>0){
        die($tpl->render("alert",['msg'=>'Route Deleted','msgType'=>'success','url'=>'/'.$crumbs[0].'/'.$crumbs[1]]));
    }else{
        $msg = 'Failed to delete:'.implode("<br>",$_db->error());
        $msgType = 'danger';
    }
}

if(isset($_POST['save']) && $_POST['save']==true){
    $_POST['methods'] = implode(',',array_filter($_POST['methods']));
    $_POST['version'] = preg_replace("/[^0-9]+/","",$_POST['version']);
    $_POST['category'] = preg_replace("/[^a-zA-Z0-9-._]+/","",$_POST['category']);
    $_POST['function'] = preg_replace("/[^a-zA-Z0-9-._]+/","",$_POST['function']);
    $_POST['name'] = strtolower($_POST['category']).ucwords(strtolower($_POST['function']));
    $_POST['description'] = strip_tags($_POST['description']);
    $_POST['updated'] = date("Y-m-d H:i:s");
    //TODO add to log if exists

    unset($_POST['save']);
    if($_db->update('api_routes',$_POST,['id'=>$_path[0]])->rowCount()>0){
        $msg = 'Route Saved!';
        $msgType = 'success';
    }else{
        $msg = 'Failed to Save data:'.implode("<br>",$_db->error());
        $msgType = 'danger';
    }
}

$versions = $_db->select('api_routes',['version'=>Medoo::raw('DISTINCT(`version`)')],['ORDER'=>['version'=>'DESC']]);
$categories = $_db->select('api_routes',['category'=>Medoo::raw('DISTINCT(`category`)')],['ORDER'=>['category'=>'ASC']]);
$functions = $_db->select('api_routes',['function'=>Medoo::raw('DISTINCT(`function`)')],['function[!]'=>null,'ORDER'=>['function'=>'ASC']]);
$databases = $_db->select('api_db',['id','name', 'db_type', 'environment'],['ORDER'=>['name'=>'ASC']]);
$groups = $_db->select('api_groups',['id','name'],['ORDER'=>['name'=>'ASC']]);
$auths = $_db->select('api_auth',['id','name'],['ORDER'=>['name'=>'ASC']]);

$data = $_db->get('api_routes',
                [
                    '[>]api_groups'=>['group_id'=>'id'],
                    '[>]api_auth'=>['auth_id'=>'id']
                ],
                ['api_routes.name', 'api_groups.name(group_name)', 'api_auth.name(auth_name)', 'api_routes.description', 
                'environment', 'version', 'category', 'function', 'group_id',
                'methods', 'route_type', 'content_type', 'db_id','auth_id', 'content', 'retry', 'retry_delay', 
                'timeout', 'enabled'],['api_routes.id'=>$_path[0],'ORDER'=>['name'=>'ASC']]);


echo $tpl->render("routes/addEdit",[
    'data' => $data,
    'edit' => true,
    'msg' => $msg,
    'msgType' => $msgType,
    'auths'=>$auths,
    'groups'=>$groups,
    'versions'=>$versions,
    'categories'=>$categories,
    'functions'=>$functions,
    'databases'=>$databases
]);