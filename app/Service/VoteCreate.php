<?php

namespace App\Service;


use Mx\Service\ServiceAbstract;
use App\Biz\Users;
use App\Biz\Votes;
use App\Biz\Results;
use App\Service\Exc;

class VoteCreate extends ServiceAbstract
{
    protected function execute()
    {
        //TODO: Implement execute() method.
        $query = $this->getQuery();
        $user = new Users($query);
        if (false == $user->exist()) {
            throw new Exc('无权发起投票，请先登录:', 400);
        }
        $this->props['userId'] = $this->userId;
        $this->props['voteText'] = $this->voteText;
        $this->props['voteChoseA'] = $this->voteChoseA;
        $this->props['voteChoseB'] = $this->voteChoseB;
        $this->props['voteChoseC'] = $this->voteChoseC;
        $this->props['voteChoseD'] = $this->voteChoseD;
        $this->props['createTime'] = time();
        try {
            $biz = (new Votes())->import($this->props)->save();
            //查询出该投票记录
            $vote = new Votes(['userId' => $this->userId, 'voteText' => $this->voteText, 'createTime' => $this->props['createTime']]);
            $voteId = $vote->id;
            (new Results())->import(['voteId' => $voteId, 'voteChoseA' => 0, 'voteChoseB' => 0, 'voteChoseC' => 0, 'voteChoseD' => 0])->save();
        } catch (\exception $e) {
            throw new Exc("写入数据库失败：" . $e->getMessage(), 500);
        }
        return $biz;
    }

    private function getQuery()
    {
        return ['id' => $this->userId];
    }
}