<?php

namespace App\Kernel;

use Mx\Http\Phase\PhaseInterface;
use Mx\Http\Cycle;
use Mx\Http\Message\Request;
use Mx\Http\Message\Response;

/**
 * 认证阶段
 *
 * @see PhaseInterface
 * @author huangjide <hjd@duxze.com>
 * @license proprietary
 * @copyright Copyright (c) duxze.com
 */
class PhaseAuth implements PhaseInterface
{
    public function run(Cycle $cycle)
    {
        $router = $cycle->getRouter();
        $route = $router->getRoute();
        if (isset($route['needAuth']) && false === $route['needAuth']) {
            return ;
        }

        if (isset($_SERVER['HTTP_DX_AUTH_TOKEN'])) {
            $token =  $_SERVER['HTTP_DX_AUTH_TOKEN'];
        } else if (isset($_GET['authToken'])) {
            $token =  $_GET['authToken'];
        } else {
            return $this->fault($cycle);
        }

        $session = $cycle->getApp()->getServiceManager()
            ->call('Session\GetSession', ['token' => $token]);

        if (!$session->_id) {
            return $this->fault($cycle);
        }

        $cycle->setMeta('session', $session);
    }

    private function fault($cycle) {
        $cycle->getResponse()->fault([
            'code' => 400, 'message' => '验证失败'
        ]);
        $cycle->interrupt(true);
    }
}
