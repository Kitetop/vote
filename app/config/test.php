<?php

namespace App;

/*
 * 测试环境配置信息 覆盖正式的部分内容
 */

$config = require __DIR__ . '/prod.php';

$config['env'] = 'dev';
$config['debug'] = true;

$config['logger']['write'] = $config['root'] . '/runtime/logs/default_error.log';

return $config;
