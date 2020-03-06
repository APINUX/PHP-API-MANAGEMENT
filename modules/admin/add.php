<?php

//if not admin
if($_SESSION['ROLE']>2){
    die($tpl->render("alert",['msg'=>'Unauthorized','msgType'=>'warning',
                    'url'=>'/'.$crumbs[0].'/'.$crumbs[1]."/".$id]));
}

if(isset($_POST['save']) && $_POST['save']==true){
    $_POST['name']  = strip_tags($_POST['name']);
    $_POST['email'] = strip_tags($_POST['email']);
    $_POST['role']  = $_POST['role']*1;
    $_POST['enable'] = $_POST['enable']*1;
    $_POST['created'] = date("Y-m-d H:i:s");
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    unset($_POST['pass1'],$_POST['pass2']);
    unset($_POST['save']);
    if(!$login_email){
        if(!empty($pass1) && !empty($pass2) && strlen($pass1)>3){
            if($pass1==$pass2){
                $_POST['password'] = password_hash($pass1,PASSWORD_DEFAULT);
                $msg = "Password changed<br>";
            }else{
                die($tpl->render("admin/addEdit",[
                    'edit' => false,
                    'data' => $_POST,
                    'msg' => 'Password different',
                    'msgType' => 'warning'
                ]));
            }
        }else{
            die($tpl->render("admin/addEdit",[
                'edit' => false,
                'data' => $_POST,
                'msg' => 'Please input password or password to short',
                'msgType' => 'warning'
            ]));
        }
    }
    if(!empty($_POST['name'])){
        $_db->insert('api_admin',$_POST);
        $id = $_db->id();
        if($id>0){
            echo $tpl->render("alert",['msg'=>'User Added','msgType'=>'success',
                    'url'=>'/'.$crumbs[0].'/'.$crumbs[1].'/']);
            die();
        }else{
            $msg = 'Failed to add User:<br>'.implode("<br>",$_db->error());
            $msgType = 'danger';
        }
    }else{
        $msg = 'Failed to add User: Please fill all required fields';
        $msgType = 'warning';
        $data = $_POST;
    }
}

echo $tpl->render("admin/addEdit",[
    'edit' => false,
]);