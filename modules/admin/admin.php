<?php

$auths = $_db->select('api_auth',['id','name', 'expired', 'header'],['ORDER'=>['name'=>'ASC']]);

echo $tpl->render("auth/list",[
    'auths'=>$auths
]);