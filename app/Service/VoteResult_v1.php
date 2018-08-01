<?php

namespace App\Service;

use Mx\Service\ServiceAbstract;
use App\Biz\Votes;
use App\Biz\Results;
use App\Service\Exc;

class VoteResult_v1 extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $vote = new Votes(['id' => $this->voteId]);
        //辅助检查
        if (false == $vote->exist()) {
            throw new Exc('无效的投票编号', 400);
        }
        $chose = new Results(['voteId' => $this->voteId]);
        //确保当所有提交都是正确的时候才会存储到数据库
        $chose->result = $this->sumResult($chose->result, $vote);
        return $chose->save();
    }

    private function sumResult($chose, $vote)
    {
        for ($i = 0; $i < count($this->result); $i++) {
            foreach ($this->result[$i] as  $value) {
                if (isset($chose[$i][$value])) {
                    $chose[$i][$value] += 1;
                } else if ($vote->vote[$i]['type'] === 'checkbox') {
                    continue;
                } else {
                    throw new Exc("数据格式错误", 406);
                }
            }
        }
        return $chose;
    }
}