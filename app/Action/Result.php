<?php

namespace App\Action;

use Mx\Http\ActionAbstract;
use Mx\Service\ServiceAbstract;
use App\Service\Exc;
use App\Biz\Votes;

class Result extends ActionAbstract
{
    protected $patchRules = [
        'voteId' => [
            'desc' => '投票编号',
            'rules' => ['required'],
            'message' => '无效提交结果'
        ],
        'voteChoseA' => [
            'desc' => '投票选项A',
        ],
        'voteChoseB' => [
            'desc' => '投票选项B',
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
        $this->validate($this->patchRules);
        $vote = new Votes(['id' => $this->props['voteId']]);
        //辅助检查
        if (false == $vote->exist()) {
            throw new Exc('无效的投票编号', 400);
        } elseif (!isset($this->props['voteChoseA'])
            && !isset($this->props['voteChoseB'])
            && !isset($this->props['voteChoseC'])
            && !isset($this->props['voteChoseD'])
        ) {
            throw new Exc('投票选择不能为空', 403);
        }
        $service = $this->service('VoteResult');
        $service->voteId=$this->props['voteId'];
        $service->voteChose=$this->props['voteChoseA']?$this->props['voteChoseA']:$service->voteChose;
        $service->voteChose=$this->props['voteChoseB']?$this->props['voteChoseB']:$service->voteChose;
        $service->voteChose=$this->props['voteChoseC']?$this->props['voteChoseC']:$service->voteChose;
        $service->voteChose=$this->props['voteChoseD']?$this->props['voteChoseD']:$service->voteChose;
        $result=$service->run();
        $url=$this->config('externalUrl').'results/'.$result->id;
        $this->code(201);
        $this->response('id',$result->id);
        $this->response('uri',$url);
    }

}