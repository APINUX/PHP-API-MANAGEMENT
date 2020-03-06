<?php

$admins = $_db->select('api_admin',['id','name', 'email', 'enable'],['ORDER'=>['name'=>'ASC']]);

echo $tpl->render("admin/list",[
    'admins'=>$admins
]);