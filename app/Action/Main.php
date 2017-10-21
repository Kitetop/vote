<?php

namespace App\Action;

use Mx\Http\HttpFaultExc;
use Mx\Http\ActionAbstract;

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
    /**
     * validateRules
     *
     * todo: 输入验证规则配置
     * 规则格式: http://inner.imoxiu.cn/pm/rds/wiki
     *
     * @var array
     */
    protected $validateRules        = [];
    protected $validateRulesGet     = [];
    protected $validateRulesPost    = [];

    /**
     * handleGet
     *
     * @return void
     */
    protected function handleGet()
    {
        $this->response(["message" => "hello world"]);

        $dbconf = $this->config('db');
        $this->response('dbconf', $dbconf);

        $service = $this->service('Example');
        $service->param1 = 'param1';
        $service->param2 = 'param2';
        $result = $service->run();

        $this->response('service1', $result);

        $result = $this->callService('Example', ['param1' => 'service2_param1', 'param2' => 2]);
        $this->response('service2', $result);
    }
}
