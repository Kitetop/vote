<?php

namespace App\Service;

use Mx\Service\ServiceAbstract;
use App\Service\Exc;
use App\Biz\Votes;
use App\Biz\Users;

class ShowLists_v1 extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $user = (new Users(['id' => $this->userId]));
        if (!$user->exist()) {
            throw new Exc('没有权限查询', 403);
        }
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
        $row['createTime'] = date("Y-m-d H:m:s", $row['createTime']);
        return $row;
    }
}