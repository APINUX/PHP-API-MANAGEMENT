<?php

if(isset($_POST['save']) && $_POST['save']==true){
    $_POST['name'] = strip_tags($_POST['name']);
    $_POST['db_host'] = strip_tags($_POST['db_host']);
    $_POST['db_name'] = strip_tags($_POST['db_name']);
    $_POST['db_user'] = strip_tags($_POST['db_user']);
    $_POST['updated'] = date("Y-m-d H:i:s");
    $_POST['created'] = date("Y-m-d H:i:s");
    unset($_POST['save']);
    if(!empty($_POST['name'])){
        $_db->insert('api_db',$_POST);
        $id = $_db->id();
        if($id>0){
            echo $tpl->render("alert",['msg'=>'DB Added','msgType'=>'success',
                    'url'=>'/'.$crumbs[0].'/'.$crumbs[1].'/']);
            die();
        }else{
            $msg = 'Failed to add DB:<br>'.implode("<br>",$_db->error());
            $msgType = 'danger';
        }
    }else{
        $msg = 'Failed to add DB: Please fill all required fields';
        $msgType = 'warning';
        $data = $_POST;
    }
}

echo $tpl->render("databases/addEdit",[
    'edit' => false,
]);