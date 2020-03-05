<?php

if(isset($_POST['delete']) && $_POST['delete']==true){
    if($_db->delete('api_groups',['id'=>$_path[0]])->rowCount()>0){
        die($tpl->render("alert",['msg'=>'Group Deleted','msgType'=>'success','url'=>'/'.$crumbs[0].'/'.$crumbs[1].'/']));
    }else{
        $msg = 'Failed to delete group:<br>'.implode("<br>",$_db->error());
        $msgType = 'danger';
    }
}

if(isset($_POST['save']) && $_POST['save']==true){
    $_POST['name'] = strip_tags($_POST['name']);
    $_POST['description'] = strip_tags($_POST['description']);
    //TODO add to log if exists

    unset($_POST['save']);
    if($_db->update('api_groups',$_POST,['id'=>$_path[0]])->rowCount()>0){
        $msg = 'Group Saved!';
        $msgType = 'success';
    }else{
        $msg = 'Failed to Save group:<br>'.implode("<br>",$_db->error());
        $msgType = 'danger';
    }
}

$data = $_db->get('api_groups',['name','description'],['id'=>$_path[0]]);

echo $tpl->render("group/addEdit",[
    'data' => $data,
    'edit' => true,
    'msg' => $msg,
    'msgType' => $msgType
]);