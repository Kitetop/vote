<?php

namespace App\Service;


use Mx\Service\ServiceAbstract;
use App\Biz\Users;
use App\Biz\Votes;
use App\Biz\Results;
use App\Service\Exc;

class VoteCreate_v1 extends ServiceAbstract
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
        $this->props['title'] = $this->title;
        $this->props['vote'] = $this->vote;
        $this->props['createTime'] = time();
        try {
            $biz = (new Votes())->import($this->props)->save();
            //查询出该投票记录
            $vote = new Votes(['userId' => $this->userId, 'vote' => $this->vote, 'createTime' => $this->props['createTime']]);
            $voteId = $vote->id;
            $result = $this->getChoseValue();
            (new Results())->import(['voteId' => $voteId, 'result' => $result])->save();
        } catch (\exception $e) {
            throw new Exc("写入数据库失败：" . $e->getMessage(), 500);
        }
        return $biz;
    }

    private function getQuery()
    {
        return ['id' => $this->userId];
    }

    private function getChoseValue()
    {
        for ($i = 0; $i < count($this->props['vote']); $i++) {
            //将一个数组的值作为另外一个数组的键值，且将数组初始化
            $result[] = array_fill_keys($this->props['vote'][$i]['chose'], 0);
        }
        return $result;
    }
}