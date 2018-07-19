<?php

namespace App;

/*
 * 测试环境配置信息 覆盖正式的部分内容
 */

$config = require __DIR__ . '/prod.php';

$config['env'] = 'staging';
$config['debug'] = true;


$config['db'] = 'mongodb://db-mongodb.kube-public:27017?dbname=xsz_vote';

return $config;
