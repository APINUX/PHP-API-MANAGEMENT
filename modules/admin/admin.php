<?php

//if not admin
if($_SESSION['ROLE']>2){
    die($tpl->render("alert",['msg'=>'Unauthorized','msgType'=>'warning',
                    'url'=>'/'.$crumbs[0].'/'.$crumbs[1]."/".$id]));
}

$admins = $_db->select('api_admin',['id','name', 'email', 'enable'],['ORDER'=>['name'=>'ASC']]);

echo $tpl->render("admin/list",[
    'admins'=>$admins
]);