<?php

namespace App\Kernel;

use Mx\Console\ConsoleAppAbstract;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * 控制台APP
 *
 * @see ConsoleAppAbstract
 * @author huangjide <hjd@duxze.com>
 * @license proprietary
 * @copyright Copyright (c) duxze.com
 */
class Console extends ConsoleAppAbstract
{
    public function __construct()
    {
        $name = "DX PHP APP Command Line Tool";
        $env = $this->getRuntimeEnvName();
        $config = require __DIR__ . '/../config/' . $env .'.php';
        parent::__construct($config, $name);
    }
}
