<?php
namespace App\Biz;
use Mx\Biz\RowGateway;

class Votes extends RowGateway
{
    public function getTable()
    {
        return 'votes';
    }
//    public function save()
//    {
//        parent::save();
//    }
}