<?php

namespace App\Service;

use Mx\Service\ServiceAbstract;
use App\Service\Exc;
use App\Biz\Votes;

class ShowLists extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $this->all ? $query = null : $query = ['userId' => $this->userId];
        $result = Votes::makeDao()->page($this->page, $this->limit ?: 20)
            ->order('_id', 'DESC')
            ->find($query);
        return $result->export(function ($item) {
            return $this->genItem($item);
        });
    }

    private function genItem($item)
    {
        $row = $item->export();
        unset($row['userId']);
        unset($row['createTime']);
        return $row;
    }
}