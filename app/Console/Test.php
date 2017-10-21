<?php

namespace App\Console;

use Mx\Console\CommandAbstract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * 内建命令 build
 *
 * 使用phpmd, phpcs, phpunit, phpdox 进行代码质量自动化处理
 * 可以通过扩展此类来适应项目特殊性处理
 *
 * @see CommandAbstract
 * @author huangjide <huangjide@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Test extends CommandAbstract
{
    protected function configure()
    {
        $this->setName('build')
            ->setDescription('检查代码语法，生成文档')
            ->addOption(
                'env',
                'E',
                InputOption::VALUE_OPTIONAL,
                '运行环境  dev | test | prod',
                'dev'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $params = [];
        $params['env'] = $input->getOption('env');
        var_dump($params);
    }
}
