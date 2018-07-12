<?php
/**
 * User: Kitetop
 * Date: 2018/7/10
 * Time: 13:58
 */

namespace App\Service;


use Mx\Service\ServiceAbstract;
use App\Biz\Users;

class UserCreate extends ServiceAbstract
{
    //在Action上用户的注册信息都会保存在$this->props之中
    //在调用Service时，用户的信息就会变成Service的成员属性了
    protected function execute()
    {
        // TODO: Implement execute() method.
        $this->props['username']=$this->username;
        $this->props['password']=$this->password;
        try{
            $biz=(new Users())->import($this->props)->save();
        }catch(\exception $e){
            throw new Exc("写入数据库失败：".$e->getMessage(),500);
    }
    return $biz;
    }

}
