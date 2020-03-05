<?php
if(isset($_GET['on'])){
    $_db->update('api_routes',['enabled'=>1],['api_routes.id'=>$_path[0]]);
}

if(isset($_GET['off'])){
    $_db->update('api_routes',['enabled'=>0],['api_routes.id'=>$_path[0]]);
}


$data = $_db->get('api_routes',
                [
                    '[>]api_groups'=>['group_id'=>'id'],
                    '[>]api_auth'=>['auth_id'=>'id']
                ],
                ['api_routes.id','api_routes.name', 'api_groups.name(group_name)', 'api_auth.name(auth_name)', 'api_routes.description', 
                'environment', 'version', 'category', 'function', 'group_id',
                'methods', 'route_type', 'content_type', 'db_id','auth_id', 'content', 'retry', 'retry_delay', 
                'timeout', 'enabled'],['api_routes.id'=>$_path[0],'ORDER'=>['name'=>'ASC']]);


echo $tpl->render("routes/view",[
    'data' => $data
]);