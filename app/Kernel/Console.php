<?php

namespace App\Kernel;

use Mx\Console\ConsoleAppAbstract;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

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
        $name = "DX PHP APP Command Line Tool";
        $env = $this->configureRuntimeEnv();
        $config = require __DIR__ . '/../config/' . $env .'.php';
        parent::__construct($config, $name);
    }

    /**
     * 获取运行时环境 dev|test|prod
     *
     * @return string
     */
    private function configureRuntimeEnv()
    {
        global $argv;
        $input = new ArgvInput($argv);
        $definition = new InputDefinition([
            new InputArgument('cmd', InputArgument::REQUIRED),
                new InputOption('env', 'E', InputOption::VALUE_OPTIONAL, '', 'dev')
            ]);
        $input->bind($definition);
        $env = $input->getOption('env');
        return $env;
    }
}
