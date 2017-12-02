<?php
namespace App\Console;

use Mx\Console\CommandAbstract;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * 测试命令
 *
 * @see CommandAbstract
 * @author huangjide <hjd@duxze.com>
 * @license proprietary
 * @copyright Copyright (c) duxze.com
 */
class Test extends CommandAbstract
{
    protected function configure()
    {
        $this->setName('test')->setDescription('控制台demo');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        echo "test\n";
    }
}
