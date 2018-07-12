<?php

namespace App\Action;

use Mx\Http\ActionAbstract;

class Vote extends ActionAbstract
{
    protected $postRules = [
        'userId' => [
            'desc' => '用户id',
            'rules' => ['required'],
            'message' => '没有权利投票',
        ],
        'voteText' => [
            'desc' => '投票内容',
            'rules' => ['required'],
            'message' => '无效投票',
        ],
        'voteChoseA' => [
            'desc' => '投票选项A',
            'rules' => ['required'],
            'message' => '无效投票',
        ],
        'voteChoseB' => [
            'desc' => '投票选项B',
            'rules' => ['required'],
            'message' => '无效投票',
        ],
        'voteChoseC' => [
            'desc' => '投票选项C',
        ],
        'voteChoseD' => [
            'desc' => '投票选项D',
        ],
    ];

    protected function handlePost()
    {
        $this->validate($this->postRules);
        $service = $this->service('VoteCreate');
        $service->userId = $this->props['userId'];
        $service->voteText = $this->props['voteText'];
        $service->voteChoseA = $this->props['voteChoseA'];
        $service->voteChoseB = $this->props['voteChoseB'];
        $service->voteChoseC = $this->props['voteChoseC'] ?: null;
        $service->voteChoseD = $this->props['voteChoseD'] ?: null;
        $vote = $service->run();
        $url = $this->config('externalUrl') . 'votes/' . $vote->id;
        $this->code(201);
        $this->header('Location:', $url);
        $this->response('id', $vote->id);
        $this->response('uri', $url);
    }
}