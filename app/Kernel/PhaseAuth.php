<?php

namespace App\Kernel;

use Mx\Http\Phase\PhaseInterface;
use Mx\Http\Cycle;
use Mx\Http\Message\Request;
use Mx\Http\Message\Response;
use Mx\Service\ServiceExc;

/**
 * 认证阶段
 *
 * 当前只支持session方式的认证
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
        $authPassed = false;
        $route = $cycle->getRouter()->getRoute();
        $needAuth = isset($route['needAuth']) ? $route['needAuth'] : false;
        //session方式
        $sessionId = isset($_SERVER['HTTP_DXSESSIONID']) ? $_SERVER['HTTP_DXSESSIONID'] : 
            (isset($_GET['DXSESSIONID']) ? $_GET['DXSESSIONID'] : null);
        $session = $cycle->getApp()->getServiceManager()
            ->call('Account\GetSession', ['sessionId' => $sessionId]);

        if (is_array($session) && isset($session['uid'])) {
            $authPassed = true;
            $cycle->setMeta('authUid', $session['uid']);
            $cycle->setMeta('authType', 'session');
            $cycle->setMeta('authSession', $session);
        }

        //todo 支持apikey / oauth2 方式的认证

        if ($needAuth && false == $authPassed) {
            $this->fault($cycle, 401);
        }
        $cycle->setMeta('authPassed', $authPassed);
    }

    private function fault($cycle, $code) {
        $cycle->getResponse()->setCode($code);
        $cycle->interrupt(true);
    }
}
