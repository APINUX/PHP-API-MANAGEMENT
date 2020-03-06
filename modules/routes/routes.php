<?php
use Medoo\Medoo;

if(isset($_POST['on'])){
    $_db->update('api_routes',['enabled'=>1],['api_routes.id'=>$_POST['on']]);
}

if(isset($_POST['off'])){
    $_db->update('api_routes',['enabled'=>0],['api_routes.id'=>$_POST['off']]);
}


$max = 25;
$search = $_REQUEST['search'];
$version = $_REQUEST['version'];
$environment = $_REQUEST['environment'];
$group = $_REQUEST['group'];

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

if($group>0){
    $and['group_id'] = $group;
}

if(!empty($environment) && $environment!='all'){
    $and['environment'] = $environment;
}

if(count($and)>1){
    $where['AND'] = $and;
}else{
    $where = $and;
}

$where['ORDER'] = ['api_routes.name'=>'ASC'];
$where['LIMIT'] = [$pagenow,$max];

$result = $_db->select('api_routes',['[>]api_groups'=>['group_id'=>'id']],['api_routes.id','group_id','api_groups.name(group_name)','api_routes.name', 'environment', 'version', 'category', 'function', 'methods', 'route_type','enabled'], $where);
unset($where['LIMIT']);
$total = $_db->count('api_routes',$where);

$versions = $_db->select('api_routes',['version'=>Medoo::raw('DISTINCT(version)')],['ORDER'=>['version'=>'DESC']]);
$groups = $_db->select('api_groups',['id','name'],['ORDER'=>['name'=>'ASC']]);

echo $tpl->render("routes/list",[
    'routes' => $result,
    'versions'=>$versions,
    'groups'=>$groups,
    'group' => $group,
    'page' => $page,
    'max' => $max,
    'total' => $total,
    'count' => ($page==0)? count($result) : count($result)+($max*($page-1)),
    'search' => $search,
    'version' => $version,
    'environment' => $environment
]);