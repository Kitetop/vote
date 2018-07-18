<?php

namespace App\Action;

use Mx\Http\ActionAbstract;
use Mx\Helper\Page;

class Show extends ActionAbstract
{
    protected $getRules = [
        'page' => [
            'desc' => '分页页码',
            'rules' => ['Logic:gte:0'],
            'message' => '页码错误',
            'default' => 1,
        ],
        'limit' => [
            'desc' => '每页显示数据条数',
            'rules' => ['Logic:gte:0'],
            'default' => 2,
        ],
        'userId' => [
            'desc' => '用户ID',
            'rules' => ['mongoid', 'required'],
            'message' => '用户ID不能为空',
        ],
        'all' => [
            'desc' => '显示类型',
            'default' => false,
        ],
    ];

    protected function handleGet()
    {
        $this->validate($this->getRules);
        $service = $this->service('ShowLists');
        $service->page = $this->props['page'];
        $service->limit = $this->props['limit'];
        $service->userId = $this->props['userId'];
        $service->all = $this->props['all'];
        $data = $service->run();
        //获得当前页面的请求路径
        $url = $this->config('externalUrl') . 'showlist?';
        list($data['prev'], $data['next']) = Page::simple($data['meta'], $url, $this->props);
        $data['count'] = $data['meta']['total'];
        $data['list'] = (array)$data['list'];
        $this->response($data);
        $this->code(200);
    }
}
