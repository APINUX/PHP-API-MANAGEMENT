<?php
use Medoo\Medoo;

$max = 25;
$search = $_REQUEST['search'];
$version = $_REQUEST['version'];
$environment = $_REQUEST['environment'];

$page = $_POST['p']*1;
$pagenow = $page*$max;

$and = array();
$where = array();
if(!empty(trim($search))){
    $and['name[~]'] = $search;
}

if($version>0){
    $and['version'] = $version;
}

if(!empty($environment) && $environment!='all'){
    $and['environment'] = $environment;
}

if(count($and)>1){
    $where['AND'] = $and;
}else{
    $where = $and;
}

$where['ORDER'] = ['version'=>'DESC'];
$where['LIMIT'] = [$pagenow,$max];

$result = $_db->select('api_routes',['id','name', 'environment', 'version', 'category', 'function', 'methods', 'route_type','enabled'], $where);
unset($where['LIMIT']);
$total = $_db->count('api_routes',$where);

$versions = $_db->select('api_routes',['version'=>Medoo::raw('DISTINCT(version)')],['ORDER'=>['version'=>'DESC']]);

echo $tpl->render("routes/list",[
    'routes' => $result,
    'versions'=>$versions,
    'page' => $page,
    'max' => $max,
    'total' => $total,
    'count' => ($page==0)? count($result) : count($result)+($max*($page-1)),
    'search' => $search,
    'version' => $version,
    'environment' => $environment
]);