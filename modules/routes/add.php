<?php
use Medoo\Medoo;

$versions = $_db->select('api_routes',['version'=>Medoo::raw('DISTINCT(`version`)')],['ORDER'=>['version'=>'DESC']]);
$categories = $_db->select('api_routes',['category'=>Medoo::raw('DISTINCT(`category`)')],['ORDER'=>['category'=>'ASC']]);
$functions = $_db->select('api_routes',['function'=>Medoo::raw('DISTINCT(`function`)')],['function[!]'=>null,'ORDER'=>['function'=>'ASC']]);
$databases = $_db->select('api_db',['name', 'db_type', 'environment'],['ORDER'=>['name'=>'ASC']]);

echo $tpl->render("routes/addEdit",[
    'edit' => false,
    'versions'=>$versions,
    'categories'=>$categories,
    'functions'=>$functions,
    'databases'=>$databases
]);