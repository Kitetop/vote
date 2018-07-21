<?php

namespace App\Service;

use Mx\Service\ServiceAbstract;
use App\Biz\Votes;
use App\Biz\Results;
use App\Service\Exc;

class ShowResult_v1 extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $vote = (new Votes(['id' => $this->voteId]));
        if (false == $vote->exist()) {
            throw new Exc('该投票结果不存在', 400);
        }
        $result = (new Results(['voteId' => $this->voteId]))->result;
        $show['title'] = $vote->title;
        for ($i = 0; $i < count($result); $i++) {
            $result[$i]['question'] = $vote->vote[$i]['question'];
        };
        $show['result'] = $result;
        return $show;
    }
}