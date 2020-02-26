<?php

function sendError($txt,$header='HTTP/1.0 202 Accepted'){
    header($header);
    die(json_encode(['status'=>'failed','message'=>$txt]));
}

function sendResult($data,$header='HTTP/1.0 200 OK'){
    header($header);
    die(json_encode(['status'=>'success','data'=>$data]));
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
