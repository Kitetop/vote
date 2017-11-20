<?php

namespace App;

/*
 * 开发环境配置信息 覆盖正式的部分内容
 */

$config = require __DIR__ . '/prod.php';

$config['env'] = 'dev';
$config['debug'] = true;

return $config;
