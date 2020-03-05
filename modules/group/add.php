<?php

if(isset($_POST['save']) && $_POST['save']==true){
    $_POST['name'] = strip_tags($_POST['name']);
    $_POST['description'] = strip_tags($_POST['description']);
    unset($_POST['save']);
    if(!empty($_POST['name'])){
        $_db->insert('api_groups',$_POST);
        $id = $_db->id();
        if($id>0){
             echo $tpl->render("alert",['msg'=>'Group Added','msgType'=>'success',
                    'url'=>'/'.$crumbs[0].'/'.$crumbs[1].'/']);
            die();
        }else{
            $msg = 'Failed to add group:<br>'.implode("<br>",$_db->error());
            $msgType = 'danger';
        }
    }else{
        $msg = 'Failed to add group: Please fill all required fields';
        $msgType = 'warning';
        $data = $_POST;
    }
}

echo $tpl->render("group/addEdit",[
    'edit' => false,
]);