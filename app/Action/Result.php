<?php

namespace App\Action;

use Mx\Http\ActionAbstract;
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
    protected function handlePatch()
    {
        $this->validate($this->patchRules);
        $vote=new Votes();

    }

}