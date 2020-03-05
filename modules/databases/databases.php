<?php

$databases = $_db->select('api_db',['id','name','db_type', 'db_host', 'environment'],['ORDER'=>['name'=>'ASC']]);

echo $tpl->render("databases/list",[
    'databases'=>$databases
]);