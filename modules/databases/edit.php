<?php

//if not admin
if($_SESSION['ROLE']>2){
    die($tpl->render("alert",['msg'=>'Unauthorized','msgType'=>'warning',
                    'url'=>'/'.$crumbs[0].'/'.$crumbs[1]."/".$id]));
}


if(isset($_POST['delete']) && $_POST['delete']==true){
    if($_db->delete('api_db',['id'=>$_path[0]])->rowCount()>0){
        die($tpl->render("alert",['msg'=>'Auth Deleted','msgType'=>'success','url'=>'/'.$crumbs[0].'/'.$crumbs[1].'/']));
    }else{
        $msg = 'Failed to delete db:<br>'.implode("<br>",$_db->error());
        $msgType = 'danger';
    }
}

if(isset($_POST['save']) && $_POST['save']==true){
    $_POST['name'] = strip_tags($_POST['name']);
    $_POST['db_host'] = strip_tags($_POST['db_host']);
    $_POST['db_name'] = strip_tags($_POST['db_name']);
    $_POST['db_user'] = strip_tags($_POST['db_user']);
    $_POST['updated'] = date("Y-m-d H:i:s");
    unset($_POST['save']);
    //TODO add to log if exists

    if($_db->update('api_db',$_POST,['id'=>$_path[0]])->rowCount()>0){
        $msg = 'DB Saved!';
        $msgType = 'success';
    }else{
        $msg = 'Failed to Save DB:<br>'.implode("<br>",$_db->error());
        $msgType = 'danger';
    }
}

$data = $_db->get('api_db',['name', 'db_type', 'db_host', 'db_name', 'db_user', 'db_pass', 'environment'],['id'=>$_path[0]]);

echo $tpl->render("databases/addEdit",[
    'data' => $data,
    'edit' => true,
    'msg' => $msg,
    'msgType' => $msgType
]);