<?php

if(isset($_POST['delete']) && $_POST['delete']==true){
    if($_db->delete('api_auth',['id'=>$_path[0]])->rowCount()>0){
        die($tpl->render("alert",['msg'=>'Auth Deleted','msgType'=>'success','url'=>'/'.$crumbs[0].'/'.$crumbs[1].'/']));
    }else{
        $msg = 'Failed to delete auth:<br>'.implode("<br>",$_db->error());
        $msgType = 'danger';
    }
}

if(isset($_POST['save']) && $_POST['save']==true){
    $_POST['name'] = strip_tags($_POST['name']);
    $_POST['jwt_secret'] = strip_tags($_POST['jwt_secret']);
    $_POST['expired'] = strip_tags($_POST['expired'])*1;
    $_POST['header'] = strip_tags($_POST['header']);
    unset($_POST['save']);
    //TODO add to log if exists

    if($_db->update('api_auth',$_POST,['id'=>$_path[0]])->rowCount()>0){
        $msg = 'Auth Saved!';
        $msgType = 'success';
    }else{
        $msg = 'Failed to Save auth:<br>'.implode("<br>",$_db->error());
        $msgType = 'danger';
    }
}

$data = $_db->get('api_auth',['id','name', 'jwt_secret', 'expired', 'header'],['id'=>$_path[0]]);

echo $tpl->render("databases/addEdit",[
    'data' => $data,
    'edit' => true,
    'msg' => $msg,
    'msgType' => $msgType
]);