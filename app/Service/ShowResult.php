<?php

namespace App\Service;

use Mx\Service\ServiceAbstract;
use App\Biz\Votes;
use App\Biz\Results;
use App\Service\Exc;

class ShowResult extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $vote = (new Votes(['id' => $this->voteId]));
        if (false == $vote->exist()) {
            throw new Exc('该投票结果不存在', 400);
        }
        $value = new Results(['voteId' => $this->voteId]);
        $result['vote'] = $vote->voteText;
        if ($vote->voteChoseA != null) {
            $result[$vote->voteChoseA] = $value->voteChoseA;
        }
        if ($vote->voteChoseB != null) {
            $result[$vote->voteChoseB] = $value->voteChoseB;
        }
        if ($vote->voteChoseC != null) {
            $result[$vote->voteChoseC] = $value->voteChoseC;
        }
        if ($vote->voteChoseD != null) {
            $result[$vote->voteChoseD] = $value->voteChoseD;
        }
        return $result;
    }
}