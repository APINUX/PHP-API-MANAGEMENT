<?php

function sendError($txt,$header=["HTTP/1.0 202 Accepted","Content-Type: Application/json"]){
    if(is_array($header)){
        foreach($header as $head)
        header($head);
    }else if(!empty($header))
        header($header);
    header($header);
    die(json_encode(['status'=>'failed','message'=>$txt]));
}

function sendResult($data,$header=["HTTP/1.0 200 OK","Content-Type: Application/json"]){
    if(is_array($header)){
        foreach($header as $head)
        header($head);
    }else if(!empty($header))
        header($header);
    die(json_encode(['status'=>'success','data'=>$data]));
}

function showAlert($msg, $type){
    ?><div class="alert alert-<?=$type?> alert-dismissible fade show" role="alert"><?=$msg?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div><?php
}

function analytics($routeID){
    global $_db;
    $date = date("Y-m-d");
    $hour = date("H")*1;
    $where = ['AND'=>['route_id'=>$routeID,'date'=>$date]];
    $val = $_db->get('api_stats',"$hour",$where);
    if($val=="0"||$val>0){
        $_db->update('api_stats',[$hour=>$val+1],$where);
    }else{
        $_db->insert('api_stats',['route_id'=>$routeID,'date'=>$date,"$hour"=>1]);
    }
}
