<?php

namespace App\Kernel;

use Mx\Http\Front;
use Mx\Http\Message\Router;
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
        $env = $this->getRuntimeEnvName();
        $config = require __DIR__ . '/../config/' . $env . '.php';

        parent::__construct($config);
    }

    public function run()
    {
        $router = new Router($this->routes(), $this->config['action']);
        $font = new Front($this, $router);

        $font->registerPhase(new \Mx\Http\Phase\PhaseInit());
        $font->registerPhase(new \Mx\Http\Phase\PhaseRoute());
        $font->registerPhase(new \Mx\Http\Phase\PhaseOutput());

        $font->run();
    }

    public function routes()
    {
        $routes = [
            ['path' => '/hello', 'action' => 'Main', 'name' => 'helloname'],
            ['path' => '/alias', 'alias' => 'helloname'],
            ['path' => '/redirect', 'redirect' => 'hello'],
            ['path' => '/', 'action' => 'Main'],
            ['path'=>'/me','action'=>'Register','method'=>'POST'],
            ['path'=>'/login','action'=>'Login','method'=>'POST'],
            ['path'=>'/vote','action'=>'Vote','method'=>'POST'],
            ['path'=>'/vote_v1','action'=>'Vote_v1','method'=>'POST'],
            ['path'=>'/result','action'=>'Result','method'=>'POST'],
            ['path'=>'/result','action'=>'Result','method'=>'GET'],
            ['path'=>'/result_v1','action'=>'Result_v1','method'=>'POST'],
            ['path'=>'/result_v1','action'=>'Result_v1','method'=>'GET'],
            ['path'=>'/showlist','action'=>'Show','method'=>'GET'],
            ['path'=>'/showlist_v1','action'=>'Show_v1','method'=>'GET'],

        ];
        return $routes;
    }
}
