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
 * 内建工具
 */
$config['builtInTool'] = [
    'runtimeDir' => [
        'runtime/logs',
    ],
    'publishPath' => [
        'app/',
        'public/',
        'runtime/',
        'vendor/',
        'composer.*',
    ],
];

/*
 * Action
 */
$config['action'] = [
    'format' => 'json', //默认输出格式
    'default' => 'Main', //默认Action
    'catch' => false, //是否自动捕获异常
    'faultTpl' => 'fault', //异常输出的模版
    'namespace' => __NAMESPACE__ . '\\Action' //action的子命名空间
];


/**
 * 错误日志
 */
$config['logger'] = [
    'name' => 'errorlog',
    'write' => $config['root'] . '/runtime/logs/default_error.log',
    'level' => 7
];

$config['db'] = 'mongodb://10.0.0.26:27017?dbname=test';

return $config;
