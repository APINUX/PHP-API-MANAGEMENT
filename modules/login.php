<?php
//redirect for failed attempt
if($_SESSION['FAILED']>4){
    header("location: https://google.com");
}


if($_POST['login']==true){
    if($login_email){
        if(function_exists('imap_open')){
            //3 second will set failed
            ini_set('default_socket_timeout',3);
            if($mbox=@imap_open('{'.$smtp_server.':'.$smtp_port.'/imap/'.$smtp_encryption.'/novalidate-cert}',$_POST['email'],$_POST['password'])){
                $result = $_db->get('api_admin',['name', 'password', 'email', 'role'],['email'=>$_POST['email']]);
                if($result['email']==$_POST['email']){
                    $_SESSION['EMAIL'] = $result['email'];
                    $_SESSION['ROLE'] = $result['role'];
                    $_SESSION['NAME'] = $result['name'];
                }
            }else{
                $_SESSION['FAILED'] +=1;
                $msg = "Username or Password Wrong";
                $msgType = "danger";
            }
        }else{
            $msg = "PHP IMAP module not installed or not enabled";
            $msgType = "warning";
        }
    }else{
        $result = $_db->get('api_admin',['name', 'password', 'email', 'role'],['email'=>$_POST['email']]);
        if(password_verify($_POST['password'],$result['password'])){
            $_SESSION['EMAIL'] = $result['email'];
            $_SESSION['ROLE'] = $result['role'];
            $_SESSION['NAME'] = $result['name'];
        }else{
            $_SESSION['FAILED'] +=1;
            $msg = "Username or Password Wrong";
            $msgType = "danger";
        }
    }
}
$_SESSION['CHECK'] = rand(0000,9999)."-".rand(0000,9999)."-".rand(0000,9999);
if(empty($_SESSION['EMAIL'])){
    die($tpl->render("login",[
        'msg' => $msg,
        'msgType' => $msgType
    ]));
}