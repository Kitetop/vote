<?php

namespace App\Action;

use Mx\Http\ActionAbstract;
use MongoDB\BSON\ObjectId;
use Mx\Http\HttpFaultExc;

/**
 * 对不定数量的题量以及选项进行限定
 * Class Vote_v1
 * @package App\Action
 */
class Vote_v1 extends ActionAbstract
{
    protected $postRules = [
        'vote' => [
            'desc' => '投票内容',
            'rules' => ['required'],
            'message' => '无效的投票'
        ],
        'userId' => [
            'desc' => '创建者id',
            'rules' => ['required', 'mongoid']
        ],
        'title' => [
            'desc' => '当前投票的标题',
            'rules' => ['required'],
            'message' => '标题不能为空',
        ]
    ];

    protected function handlePost()
    {
        //对于多个验证规则的情况
        //$this->validate($this->postRules + $this->baseRules);
        $this->validate($this->postRules);
        $this->check();
        $service = $this->service('VoteCreate_v1');
        $service->title = $this->props['title'];
        $service->vote = $this->props['vote'];
        $service->userId = $this->props['userId'];
        $vote = $service->run();
        $url = $this->config('externalUrl') . 'vote-v1/' . $vote->id;
        $this->code(201);
        $this->header('Location:', $url);
        $this->response('id', $vote->id);
        $this->response('uri', $url);
    }

    private function check()
    {
        foreach ($this->props['vote'] as $vote) {
            if (!$vote['type'] || !$vote['question'] || count($vote['chose']) < 2) {
                throw new HttpFaultExc('此投票不符合规范', 403);
            }
        }
    }
}