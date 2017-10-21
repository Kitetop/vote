<?php

namespace App\Kernel;

use Mx\Console\ConsoleAppAbstract;

/**
 * Console
 *
 * @see ConsoleAppAbstract
 * @author huangjide <huangjide@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Console extends ConsoleAppAbstract
{
    public function __construct()
    {
        $name = "Command Line Tool";
        $env = 'current';
        if (getenv('MX2_ENV')) {
            $env = getenv('MX2_ENV');
        }
        $config = require __DIR__ . '/../config/' . $env .'.php';
        parent::__construct($config, $name);
    }
}
