<?php
namespace App\Biz;

use Mx\Biz\RowGateway;

class Users extends RowGateway
{
    public function getTable()
    {
        return 'users';
    }
    public function increase($attr,$value=1)
    {
        $update=['$inc'=>[$attr=>$value]];
        $this->dao()->rawUpdate($this->query,$update);
    }
}