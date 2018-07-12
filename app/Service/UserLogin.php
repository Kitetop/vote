<?php

namespace App\Service;

use Mx\Service\ServiceAbstract;
use App\Biz\Users;
use App\Biz\Login;
use App\Service\Exc;

class UserLogin extends ServiceAbstract
{
    protected function execute()
    {
        // TODO: Implement execute() method.
        $query = $this->getQuery();
        $user = new Users($query);
        if (false == $user->exist()) {
            throw new Exc('用户不存在', 404);
        } elseif (!($user->password === $this->password)) {
            throw new Exc('密码不匹配', 403);
        }
        //写入到session表中
        //$session=$this->initSession($user);
        return $user;
    }

    private function getQuery()
    {
        //对于多种选择登陆的时候需要验证当前选择的登陆方式
        return ['username' => $this->username];
    }
//    private function initSession($user)
//    {
//        $session=new Session();
//        $session->uid=$user->id;
//        $session->username=$user->username;
//        $session->client=$this->clinetInfo;
//        $session->save();
//        return $session;
//    }
}