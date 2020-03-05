<?php


$data = $_db->get('api_routes',
                ['group_id', 'name', 'description', 'environment', 'version', 'category', 'function', 'methods', 
                'route_type', 'content_type', 'db_id', 'auth_id', 'content', 'retry', 'retry_delay', 'timeout', 
                'enabled'],['api_routes.id'=>$_path[0]]);
$data['name'] = "CLONE ".$data['name'];
$data['created'] = date("Y-m-d H:i:s");
$data['updated'] = date("Y-m-d H:i:s");

$_db->insert('api_routes',$data);
$id = $_db->id();
if($id>0){
    die($tpl->render("alert",['msg'=>'Route Cloned','msgType'=>'success',
    'url'=>'/'.$crumbs[0].'/'.$crumbs[1]."/edit/".$id]));
}else{
    die($tpl->render("alert",['msg'=>'Failed to clone Route<br>'.implode("<br>",$_db->error()),'msgType'=>'danger',
    'url'=>'/'.$crumbs[0].'/'.$crumbs[1]]));
}