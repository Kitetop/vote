<?php

namespace App\Service;

use Mx\Service\ServiceAbstract;
use App\Biz\Votes;
use App\Biz\Results;
use App\Service\Exc;

class VoteResult extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $this->props['voteId'] = $this->voteId;
        $this->props['voteChose'] = $this->voteChose;
        $vote = new Votes(['id' => $this->voteId]);
        //辅助检查
        if (false == $vote->exist()) {
            throw new Exc('无效的投票编号', 400);
        }
        $chose = new Results(['voteId' => $this->voteId]);

        if ($vote->voteChoseA == $this->voteChose) {
            $chose->voteChoseA += 1;
            $chose->save();
        } elseif ($vote->voteChoseB == $this->voteChose) {
            $chose->voteChoseB += 1;
            $chose->save();
        } elseif ($vote->voteChoseC == $this->voteChose) {
            $chose->voteChoseC += 1;
            $chose->save();
        } else {
            $chose->voteChoseD += 1;
            $chose->save();
        }
        return $chose;
    }
}