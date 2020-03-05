<?php


$groups = $_db->select('api_groups',['id','name','description'],['ORDER'=>['name'=>'ASC']]);
echo $tpl->render("group/list",[
    'groups'=>$groups
]);