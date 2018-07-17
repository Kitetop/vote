<?php

namespace App;

/*
 * 全局
 */
$config = [
    'env' => 'prod', //识别当前部署环境,需在dev|test中覆写
    'debug' => false,
    'root' => realpath(__DIR__ . '/../../')
];

/*
 * Action 路由配置
 */
$config['action'] = [
    'base' => '/vote/v1/', //基础路径 默认为根路径
    'default' => 'Main', //默认Action
    'catch' => true, //是否自动捕获异常
    'format' => 'json', //默认输出格式
    'namespace' => '\\' . __NAMESPACE__ . '\\Action' //action的子命名空间
];
if (PHP_SAPI !='cli')
{
    $config['rootUrl']="http://10.0.20.190:8090";
    $config['externalUrl']=$config['rootUrl'].$config['action']['base'];
    $config['assetUrl']=$config['rootUrl'].'/assets';
}else{
    $config['rootUrl']=$config['externaUrl']=$config['assetsUrl']='';
}

/**
 * 错误日志
 */
$config['logger'] = [
    'name' => 'errorlog',
    'write' => $config['root'] . '/runtime/logs/default_error.log',
    'level' => 7
];

$config['db'] = 'mongodb://127.0.0.1:27017?dbname=db';

return $config;
