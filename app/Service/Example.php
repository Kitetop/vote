<?php

namespace App\Service;

use Mx\Service\ServiceAbstract;
use App\Biz\ExampleBiz;

/**
 * Service例子
 *
 * @see ServiceAbstract
 * @author huangjide <huangjide@moxiu.net>
 * @license proprietary
 * @copyright Copyright (c) 魔秀科技(北京)股份有限公司
 */
class Example extends ServiceAbstract
{
    protected function execute()
    {
        $dbconf = $this->config('db');

        $biz = new ExampleBiz();
        $biz->username = 'test';
        $biz->dateline = date('Y-m-d h:i:s');
        $biz->save();

        return [
            'bizId' => $biz->id,
            'param1' => $this->param1,
            'param2' => $this->param2,
            'all_params' => $this->params,
            'dbconf' => $dbconf
        ];
    }
}
