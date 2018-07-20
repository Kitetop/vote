<?php
namespace App\Biz;
use Mx\Biz\RowGateway;

class Votes extends RowGateway
{
    public function getTable()
    {
        return 'votes_v1';
    }
//    public function save()
//    {
//        parent::save();
//    }
}