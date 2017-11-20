<?php

namespace App\Action;

use Mx\Http\HttpFaultExc;
use Mx\Http\ActionAbstract;
use App\Service\Exc;

/**
 * Acion页面例子
 *
 * @see ActionAbstract
 * @author huangjide <huangjide@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Main extends ActionAbstract
{
    protected function handleGet()
    {
        $this->response("hello");
    }
}
