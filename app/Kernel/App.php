<?php

namespace App\Kernel;

use Mx\Http\Front;
use Mx\Base\Kernel\AppAbstract;

/**
 * App
 *
 * @see AppAbstract
 * @author huangjide <huangjide@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class App extends AppAbstract
{
    public function __construct()
    {
        $env = getenv('DXPHP_ENV') ?: 'dev';
        $config = require __DIR__ . '/../config/' . $env . '.php';
        parent::__construct($config);
    }

    public function run()
    {
        $font = new Front($this);

        $font->registerPhase(new \Mx\Http\Phase\PhaseInit());
        $font->registerPhase(new \Mx\Http\Phase\PhaseAdapter());
        $font->registerPhase(new \Mx\Http\Phase\PhaseDispatch());
        $font->registerPhase(new \Mx\Http\Phase\PhaseOutput());

        $font->run();
    }
}
