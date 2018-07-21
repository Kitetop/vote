<?php

namespace App\Action;

use Mx\Http\ActionAbstract;
use App\Service\Exc;
use MongoDB\BSON\ObjectId;

class Result_v1 extends ActionAbstract
{
    protected $postRules = [
        'voteId' => [
            'desc' => '投票编号',
            'rules' => ['required', 'mongoid'],
            'message' => '无效提交结果'
        ],
        'result' => [
            'desc' => '结果集',
            'rules' => ['required'],
            'message' => '结果不能为空',
        ]
    ];
    protected $getRules = [
        'voteId' => [
            'desc' => '投票票编号',
            'rules' => ['required', 'mongoid'],
            'message' => '投票号不能为空'
        ]
    ];

    /**
     * 根据传入的投票Id返回此投票的结果
     */
    protected function handleGet()
    {
        $this->validate($this->getRules);
        //取得投票的结果
        $service = $this->service('ShowResult_v1');
        $service->voteId = $this->props['voteId'];
        //数组
        $show = $service->run();
        $this->code(200);
        $this->response($show);
    }

    /**
     * 进行投票
     */
    protected function handlePost()
    {
        //不仅会验证数据还会把不需要的数据给过滤掉
        $this->validate($this->postRules);
        $service = $this->service('VoteResult_v1');
        $service->voteId = $this->props['voteId'];
        $service->result=$this->props['result'];
        $result = $service->run();
        $this->code(201);
        $this->response('id', $result->id);
        $this->response('message', '投票成功，感谢您的参与！');
    }

}