<?php

//if not admin
if($_SESSION['ROLE']>2){
    die($tpl->render("alert",['msg'=>'Unauthorized','msgType'=>'warning',
                    'url'=>'/'.$crumbs[0].'/'.$crumbs[1]."/".$id]));
}

if(isset($_POST['delete']) && $_POST['delete']==true){
    if($_db->delete('api_admin',['id'=>$_path[0]])->rowCount()>0){
        die($tpl->render("alert",['msg'=>'User Deleted','msgType'=>'success','url'=>'/'.$crumbs[0].'/'.$crumbs[1].'/']));
    }else{
        $msg = 'Failed to delete User:<br>'.implode("<br>",$_db->error());
        $msgType = 'danger';
    }
}

if(isset($_POST['save']) && $_POST['save']==true){
    $_POST['name']  = strip_tags($_POST['name']);
    $_POST['email'] = strip_tags($_POST['email']);
    $_POST['role']  = $_POST['role']*1;
    $_POST['enable'] = $_POST['enable']*1;

    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    unset($_POST['pass1'],$_POST['pass2']);
    unset($_POST['save']);
    $msg = "";
    if(!$login_email){
        if(!empty($pass1) && !empty($pass2) && strlen($pass1)>3){
            if($pass1==$pass2){
                $_POST['password'] = password_hash($pass1,PASSWORD_DEFAULT);
                $msg = "Password changed<br>";
            }else{
                $msg = "Password different<br>";
            }
        }else{
            $msg = "Password not changed or password to short<br>";
        }
    }

    //TODO add to log if exists

    if($_db->update('api_admin',$_POST,['id'=>$_path[0]])->rowCount()>0){
        $msg .= 'User Saved!';
        $msgType = 'success';
    }else{
        $msg .= 'Failed to Save User:<br>'.implode("<br>",$_db->error());
        $msgType = 'danger';
    }
}

$data = $_db->get('api_admin',['id','name', 'email', 'enable','role'],['id'=>$_path[0]]);

echo $tpl->render("admin/addEdit",[
    'data' => $data,
    'edit' => true,
    'msg' => $msg,
    'msgType' => $msgType
]);