<?php

namespace App\Action;

use Mx\Http\ActionAbstract;
use App\Service\Exc;

class Result_v1 extends ActionAbstract
{
    protected $postRules = [
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
    protected $getRules = [
        'voteId' => [
            'desc' => '投票票编号',
            'rules' => ['required'],
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
        $url = $this->config('externalUrl') . 'results_v1/' . $this->props['voteId'];
        $show['uri'] = $url;
        $this->code(200);
        $this->response($show);
    }

    /**
     * 进行投票
     * @throws Exc
     */
    protected function handlePost()
    {
        //不仅会验证数据还会把不需要的数据给过滤掉
        $this->validate($this->postRules);
        if (count($this->props) == 1) {
            throw new Exc('投票选项不能为空', 403);
        } elseif (count($this->props) != 2) {
            throw new Exc('投票选项不能多个', 403);
        }
        $service = $this->service('VoteResult');
        $service->voteId = $this->props['voteId'];
        $service->voteChose = $this->props['voteChoseA'] ? $this->props['voteChoseA'] : $service->voteChose;
        $service->voteChose = $this->props['voteChoseB'] ? $this->props['voteChoseB'] : $service->voteChose;
        $service->voteChose = $this->props['voteChoseC'] ? $this->props['voteChoseC'] : $service->voteChose;
        $service->voteChose = $this->props['voteChoseD'] ? $this->props['voteChoseD'] : $service->voteChose;
        $result = $service->run();
        $url = $this->config('externalUrl') . 'results/' . $result->id;
        $this->code(201);
        $this->response('chose', $service->voteChose);
        $this->response('id', $result->id);
        $this->response('uri', $url);
    }

}