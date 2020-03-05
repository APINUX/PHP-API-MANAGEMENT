<?php

if(isset($_POST['save']) && $_POST['save']==true){
    $_POST['name'] = strip_tags($_POST['name']);
    $_POST['jwt_secret'] = strip_tags($_POST['jwt_secret']);
    $_POST['expired'] = strip_tags($_POST['expired'])*1;
    $_POST['header'] = strip_tags($_POST['header']);
    unset($_POST['save']);
    if(!empty($_POST['name'])){
        $_db->insert('api_auth',$_POST);
        $id = $_db->id();
        if($id>0){
            echo $tpl->render("alert",['msg'=>'Auth Added','msgType'=>'success',
                    'url'=>'/'.$crumbs[0].'/'.$crumbs[1].'/']);
            die();
        }else{
            $msg = 'Failed to add Auth:<br>'.implode("<br>",$_db->error());
            $msgType = 'danger';
        }
    }else{
        $msg = 'Failed to add Auth: Please fill all required fields';
        $msgType = 'warning';
        $data = $_POST;
    }
}

echo $tpl->render("auth/addEdit",[
    'edit' => false,
]);