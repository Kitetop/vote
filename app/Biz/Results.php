<?php
namespace App\Biz;

use Mx\Biz\RowGateway;

class Results extends RowGateway
{
    public function getTable()
    {
        return 'results_v1';
    }
}